<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Controller_main extends CI_Controller {

    //default view public page for non members
    public function index() {
        $data['title'] = "Public";
        $this->load->model("model_admin");
        $data['publicPosts'] = $this->model_admin->getPublicPosts();
        $this->load->view('templates/header',$data);
        $this->load->view('view_public',$data);
        $this->load->view('templates/footer');
    }




}

