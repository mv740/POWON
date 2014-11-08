<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Controller_main extends CI_Controller {

    //default view public page for non members
    public function index()
    {
        $data['title'] = "Public";
        $this->load->view('templates/header',$data);
        $this->load->view('view_public');
        $this->load->view('templates/footer');
    }

    public function homePage()
    {
        $powon_id = $this->session->userdata('powon_id');

        $this->load->model("model_group");

        $data['memberOfGroup'] = $this->model_group->getGroupsMemberOf($powon_id);
        $data['title'] = "Home";

        $this->load->view('templates/header',$data);
        $this->load->view('view_home',$data);
        $this->load->view('templates/footer');
    }

}

