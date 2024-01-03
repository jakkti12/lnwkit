<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Auth extends CI_Controller
{

	public function index()
	{
		$this->load->view('auth/login');
	}

	public function edit_profile()
	{
		$this->load->view('auth/edit_view');
	}
}
