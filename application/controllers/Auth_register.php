<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Auth extends CI_Controller
{

	public function index()
	{
		$this->load->view('auth/login');
	}
	
	public function register()
	{
		$data = $this->session->userdata;
		$this->load->model('register_model');

        $this->form_validation->set_rules('firstname', 'Firstname Name', 'required');
		$this->form_validation->set_rules('lastname', 'Last Name', 'required');
        $this->form_validation->set_rules('email', 'Email', 'required|valid_email');
        $this->form_validation->set_rules('password', 'Password', 'required|min_length[5]');
        $this->form_validation->set_rules('passconf', 'Password Confirmation', 'required|matches[password]');

        $data['title'] = "Add User";
        if ($this->form_validation->run() == FALSE) {
            $this->load->view('auth/register', $data);
        } else {
            if ($this->register_model->isDuplicate($this->input->post('email'))) {
                $this->session->set_flashdata('flash_message', 'User email already exists');
                redirect(site_url() . 'register');
            } else {
                $this->load->library('password');
                $post = $this->input->post(NULL, TRUE);
                $cleanPost = $this->security->xss_clean($post);
                $hashed = $this->password->create_hash($cleanPost['password']);
                
                $cleanPost['email'] = $this->input->post('email');
                $cleanPost['role'] = '4';
                $cleanPost['status'] = '1';
                $cleanPost['firstname'] = $this->input->post('firstname');
				$cleanPost['lastname'] = $this->input->post('lastname');
                $cleanPost['banned_users'] = 'unban';
                $cleanPost['password'] = $hashed;
                unset($cleanPost['passconf']);

                //insert to database
                if (!$this->register_model->addUser($cleanPost)) {
                    $this->session->set_flashdata('flash_message', 'There was a problem add new user');
                } else {
                    $this->session->set_flashdata('success_message', 'New user has been added.');
                }
                $this->session->sess_destroy();
				redirect(site_url() . 'auth/completed');
            };
        }
	}

	public function completed()
	{
		$this->load->view('auth/registercompleted');
	}
}
