<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Edit_profile extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('edit_model');
        $this->load->helper('url_helper');
        $this->load->library('session');
    }

    public function index()
    {
    }

    public function profile()
    {
        if (empty($this->session->userdata['email'])) {
            redirect(site_url() . 'auth/login');
        } else {

            // $id = $this->uri->segment(3);
            $data = $this->session->userdata;
            $dataInfo = array(
                'id' => $data['id']
            );
            $this->load->model('edit_model');
            $this->load->model('editprofile_model');

            $data['news_item'] = $this->edit_model->get_news_by_id($dataInfo['id']);

            $this->form_validation->set_rules('firstname', 'First Name', 'required|min_length[2]');
            $this->form_validation->set_rules('lastname', 'Last Name', 'required|min_length[2]');

            // $data['groups'] = $this->editprofile_model->getUserInfo($dataInfo['id']);

            if ($this->form_validation->run() == FALSE) {

                $this->load->view('navbar');
                $this->load->view('auth/edit_profile', $data);
            } else {

                $post = $this->input->post(NULL, TRUE);
                $cleanPost = $this->security->xss_clean($post);

                $cleanPost['user_id'] = $dataInfo['id'];
                $cleanPost['firstname'] = $this->input->post('firstname');
                $cleanPost['lastname'] = $this->input->post('lastname');

                $this->editprofile_model->updateprofile($cleanPost);
                redirect('edit_profile_success');
            }
        }
    }

    public function editpro_success()
    {
        $this->load->view('auth/edit_profilesuccess');
    }
}
