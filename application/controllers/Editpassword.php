<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Editpassword extends CI_Controller 
{
    
    public function index()
    {
        
    }
    
    public function profile()
    {
        $this->load->view('auth/edit_profile');
    }
    
    public function edit()
    {
        $data = $this->session->userdata;
        $this->load->model('editpass_model');
        
        
        $dataInfo = array(
            'id' => $data['id']
        );
        
        $this->form_validation->set_rules('password', 'Current Password', 'required|min_length[5]');
        $this->form_validation->set_rules('newpassword', 'New Password', 'required|min_length[5]');
        $this->form_validation->set_rules('confnewpassconf', 'Confirm Password Confirmation', 'required|matches[password]');
        
        $result = $this->editpass_model->getAllSettings();
        $data['recaptcha'] = $result->recaptcha;
        
        $data['groups'] = $this->editpass_model->getUserInfo($dataInfo['id']);
        
        if ($this->form_validation->run() == FALSE) {
            
            $this->load->view('navbar');
            $this->load->view('auth/edit_password', $data);
            
        } else {
            
            
//             $this->load->library('recaptcha');
//             $post = $this->input->post(NULL, TRUE);
//             $clean = $this->security->xss_clean($post);
//             $hashed = $this->password->create_hash($cleanPost['currentpassword']);
//          $check['currentpassword'] = $this->input->post('currentpassword');
//             $userInfo = $this->editpass_model->checkpassword($hashed);
            
//             if ($data['recaptcha'] == 'yes') {
//                 $recaptchaResponse = $this->input->post('g-recaptcha-response');
//                 $userIp = $_SERVER['REMOTE_ADDR'];
//                 $key = $this->recaptcha->secret;
//                 $url = "https://www.google.com/recaptcha/api/siteverify?secret=" . $key . "&response=" . $recaptchaResponse . "&remoteip=" . $userIp;
//                 $response = $this->curl->simple_get($url);
//                 $status = json_decode($response, true);
//             }
            
            $this->load->library('password');
            $post = $this->input->post(NULL, TRUE);
            $cleanPost = $this->security->xss_clean($post);
            $hashed = $this->password->create_hash($cleanPost['newpassword']);
            
            $cleanPost['user_id'] = $dataInfo['id'];
            $cleanPost['newpassword'] = $hashed;
            
            if (!$this->editpass_model->updatepassword($cleanPost)) {
                $this->session->set_flashdata('flash_message', 'There was a problem updating your profile');
            } else {
                $this->session->set_flashdata('success_message', 'Your profile has been updated.');
            }
        }
        redirect(site_url() . '');
    }
}