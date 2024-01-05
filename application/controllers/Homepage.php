<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Homepage extends CI_Controller {
    
    public function index()
    {
        $data = $this->session->userdata;
        $this->load->view('navbar',$data);
        $this->load->view('homepage');
    }
}
