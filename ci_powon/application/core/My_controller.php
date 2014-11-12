<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Auth_Controller extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        if(!$this->session->userdata('logged_in'))
        {
            redirect('Controller_member /loginPage');
        }
    }
}