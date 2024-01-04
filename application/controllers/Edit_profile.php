<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Edit_profile extends CI_Controller
{
    public function index()
    {
    }

    public function profile()
    {
        $data = $this->session->userdata;
        $this->load->model('editprofile_model');
        if (empty($data)) {
            redirect(site_url() . 'auth/login');
        }

        $dataInfo = array(
            'id' => $data['id']
        );

        $this->form_validation->set_rules('firstname', 'First Name', 'required|min_length[2]');
        $this->form_validation->set_rules('lastname', 'Last Name', 'required|min_length[2]');

        // $data['groups'] = $this->editprofile_model->getUserInfo($dataInfo['id']);

        if ($this->form_validation->run() == FALSE) {

            $query = $this->db->query("SELECT * FROM users LIMIT 1;");
            $this->db->where('id', $data['id']);

            $row = $query->row();

            if (isset($row)) {
                echo $row->firstname;
                echo $row->lastname;
            }
            $this->load->view('navbar');
            $this->load->view('auth/edit_profile', $data);
        } else {

            $post = $this->input->post(NULL, TRUE);
            $cleanPost = $this->security->xss_clean($post);

            $cleanPost['user_id'] = $dataInfo['id'];
            $cleanPost['firstname'] = $this->input->post('firstname');
            $cleanPost['lastname'] = $this->input->post('lastname');

            $this->editprofile_model->updateprofile($cleanPost);

            redirect(site_url() . '');
        }
    }
}
