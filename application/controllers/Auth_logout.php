<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Auth_logout extends CI_Controller
{
    public function logout()
    {
        $this->session->sess_destroy();
        redirect(site_url() . 'auth/login');
    }
}
