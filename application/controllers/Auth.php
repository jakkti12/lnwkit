<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Auth extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();

        $this->load->model('user_model');
        $this->load->library('password');
        $this->load->library('recaptcha');
        $this->load->library('tank_auth');
        $this->status = $this->config->item('status');
        $this->banned_users = $this->config->item('banned_users');
    }

    public function index()
    {
        $data = $this->session->userdata;

        //เช็คว่าใน data มีข้อมูลหรือไม่ ถ้าไม่มีให้ไปยังหน้า login
        if (empty($data)) {
            redirect(site_url() . 'auth/login');
        }

        //เช็คว่า user อยู่ในระดับไหน

        if (empty($this->session->userdata['email'])) {
            redirect(site_url() . 'auth/login');
        }
        //ถ้ามีข้อมูลแล้วให้ไปยังหน้าหลัก
        else {
            $this->load->view('navbar');
            $this->load->view('homepage');
        }
    }

    private function executeRedirection()
    {
        redirect('/');
    }

    public function login()
    {

        if ($this->tank_auth->is_logged_in()) {                                    // logged in
            $this->executeRedirection();
        } elseif ($this->tank_auth->is_logged_in(false)) {                        // logged in, not activated
            redirect('/auth/send_again/');
        } else {
            $data['login_by_username'] = ($this->config->item('login_by_username', 'tank_auth') and
                $this->config->item('use_username', 'tank_auth'));
            $data['login_by_email'] = $this->config->item('login_by_email', 'tank_auth');

            //เป็น library ที่ชื่อ form_validation
            $this->form_validation->set_rules('email', 'Email', 'required');
            $this->form_validation->set_rules('password', 'Password', 'required');

            // Get login for counting attempts to login
            if (
                $this->config->item('login_count_attempts', 'tank_auth') and
                ($login = $this->input->post('login'))
            ) {
                $login = $this->security->xss_clean($login);
            } else {
                $login = '';
            }

            $result = $this->user_model->getAllSettings();
            $data['recaptcha'] = $result->recaptcha;

            if ($this->form_validation->run() == FALSE) {
                $this->load->view('auth/login', $data);
            } else {
                $post = $this->input->post();
                $clean = $this->security->xss_clean($post);
                $userInfo = $this->user_model->checkLogin($clean);
                if ($data['recaptcha'] == 'yes') {
                    $recaptchaResponse = $this->input->post('g-recaptcha-response');
                    $userIp = $_SERVER['REMOTE_ADDR'];
                    $key = $this->recaptcha->secret;
                    $url = "https://www.google.com/recaptcha/api/siteverify?secret=" . $key . "&response=" . $recaptchaResponse . "&remoteip=" . $userIp;
                    $response = $this->curl->simple_get($url);
                    $status = json_decode($response, true);

                    if (!$userInfo) {
                        $this->session->set_flashdata('flash_message', 'Wrong password or email.');
                        redirect(site_url() . 'auth/login');
                    } elseif ($userInfo->banned_users == "ban") {
                        $this->session->set_flashdata('danger_message', 'You’re temporarily banned from our website!');
                        redirect(site_url() . 'auth/login');
                    } else if (!$status['success']) {

                        $this->session->set_flashdata('flash_message', 'Error...! Google Recaptcha UnSuccessful!');
                        redirect(site_url() . 'auth/login');
                        exit;
                    } elseif ($status['success'] && $userInfo && $userInfo->banned_users == "unban") {
                        foreach ($userInfo as $key => $val) {
                            $this->session->set_userdata($key, $val);
                        }
                        redirect(site_url() . 'auth/login');
                    } else {
                        $this->session->set_flashdata('flash_message', 'Something Error!');
                        redirect(site_url() . 'auth/login');
                        exit;
                    }
                } else {
                    if (!$userInfo) {
                        $this->session->set_flashdata('flash_message', 'Wrong password or email.');
                        redirect(site_url() . 'auth/login');
                    } elseif ($userInfo->banned_users == "ban") {
                        $this->session->set_flashdata('danger_message', 'You’re temporarily banned from our website!');
                        redirect(site_url() . 'auth/login');
                    } elseif ($userInfo && $userInfo->banned_users == "unban") {
                        foreach ($userInfo as $key => $val) {
                            $this->session->set_userdata($key, $val);
                        }
                        redirect(site_url() . 'auth/login');
                    } else {
                        $this->session->set_flashdata('flash_message', 'Something Error!');
                        redirect(site_url() . 'auth/login');
                        exit;
                    }
                }
            }
        }
    }

    public function logout()
    {
        $this->session->sess_destroy();
        redirect(site_url() . 'auth/login');
    }
}
