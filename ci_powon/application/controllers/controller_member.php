<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Controller_member extends CI_Controller {

    public function login()
    {
        $data['title'] = "Login";
        $this->load->view('templates/header',$data);
        $this->load->view('view_login');
        $this->load->view('templates/footer');
    }

    function authenticateLogin()
    {
        $this->load->model('model_member');
        //$this->load->model('member','',TRUE);
        //set validation rules
        $this->form_validation->set_rules('username', 'Username', 'trim|required|xss_clean');
        $this->form_validation->set_rules('password', 'Password', 'trim|required|xss_clean|callback_checkUsernameAndPassword');

        if($this->form_validation->run() == FALSE)
        {
            //field validation fail, redirect to login
            $data['title'] = "Login Retry";
            $this->load->view('templates/header',$data);
            $this->load->view('view_login');
            $this->load->view('templates/footer');
        }
        else
        {

            redirect('controller_main/home', 'refresh');
        }
    }

    function checkUsernameAndPassword()
    {
        //field validation success,  validate against database
        $username = $this->input->post('username');
        $password = $this->input->post('password');

        $result = $this->model_member->login($username, $password);

        //set session data
        if($result) {
            foreach($result as $row) {
                $session_data = array(
                    'powon_id' => $row->powon_id,
                    'username' => $row->username,
                    'status' => $row->status,
                    'privilege' => $row->privilege,
                    'logged_in' => true
                );
            }

            $this->session->set_userdata($session_data);
            return TRUE;
        }
        else {
            $this->form_validation->set_message('checkUsernameAndPassword', 'Invalid username or password');
            return false;
        }
    }

    public function register() {
        $data['title'] = "Register";
        $this->load->view('templates/header',$data);
        $this->load->view('view_register');
        $this->load->view('templates/footer');
    }

    public function authenticateRegistration() {

    }


    public function logout() {
        $this->session->sess_destroy();
        redirect('controller_main', 'refresh');
    }

    public function searchMembers() {

    $this->load->model('model_member');
    $data['title'] = "Search Members";
    $data['result'] = $this->model_member->getAllMembers();



    $this->load->view('templates/header',$data);
    $this->load->view('view_search_member',$data);
    $this->load->view('templates/footer');

    }

    public function viewProfile() {

        $this->load->model('model_member');
        $powon_id = $this->session->userdata('powon_id');

        $data['title'] = "Profile";
        $data['result'] = $this->model_member->getProfileInfo($powon_id);

        $this->load->view('templates/header',$data);
        $this->load->view('view_profile',$data);
        $this->load->view('templates/footer');

    }

}