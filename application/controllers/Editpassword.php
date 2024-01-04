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
        if (empty($data)) {
            redirect(site_url() . 'auth/login');
        }
        
        $dataInfo = array(
            'id' => $data['id']
        );
        
        $this->form_validation->set_rules('oldpassword', 'Current Password', 'required|min_length[5]');
        $this->form_validation->set_rules('newpassword', 'New Password', 'required|min_length[5]');
        $this->form_validation->set_rules('confnewpassword', 'Confirm Password Confirmation', 'required|matches[newpassword]');
        
        $data['groups'] = $this->editpass_model->getUserInfo($dataInfo['id']);
        
        if ($this->form_validation->run() == FALSE) {
            
            $this->load->view('navbar');
            $this->load->view('auth/edit_password', $data);
            
        } else {

            $this->load->library('password');
            $post = $this->input->post(NULL, TRUE);
            $cleanPost = $this->security->xss_clean($post);
            $hashed = $this->password->create_hash($cleanPost['newpassword']);
            $checkpassword = $this->password->create_hash($cleanPost['oldpassword']);
            
            $cleanPost['user_id'] = $dataInfo['id'];
            $cleanPost['oldpassword'] = $checkpassword;
            $cleanPost['newpassword'] = $hashed;

            $this->editpass_model->updatepassword($cleanPost);

            if($cleanPost == true)
            {
                echo 'nooo';
            } else {
                echo 'yesssss';
            }
            
            
        }
    }
    
    public function editpass_success()
    {
        $this->load->view('auth/edit_passwordsuccess');
    }
}