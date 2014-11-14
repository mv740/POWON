<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Controller_member extends CI_Controller {

    public function loginPage() {
        $data['title'] = "Login";
        $this->load->view('templates/header',$data);
        $this->load->view('view_login');
        $this->load->view('templates/footer');
    }

    function authenticateLogin() {
        $this->load->model('model_member');

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

            redirect('controller_main/homePage', 'refresh');
        }
    }

    function checkUsernameAndPassword() {
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

    public function registerPage() {
        $data['title'] = "Register";
        $this->load->view('templates/header',$data);
        $this->load->view('view_register');
        $this->load->view('templates/footer');
    }

    public function authenticateRegistration() {

        $this->load->model('model_member');

        //existing member details
        $this->form_validation->set_rules('existing_member_first_name', 'Existing Member First Name', 'trim|required|xss_clean');
        $this->form_validation->set_rules('existing_member_email', 'Existing Member Email', 'trim|required|xss_clean');
        $this->form_validation->set_rules('existing_member_dob', 'Existing Member Date Of Birth', 'trim|required|xss_clean|callback_checkFirstNameEmailDOB');

        //login details
        $this->form_validation->set_rules('username', 'Username', 'trim|required|xss_clean');
        $this->form_validation->set_rules('password', 'Password', 'trim|required|matches[retyped_password]|xss_clean');
        $this->form_validation->set_rules('retyped_password', 'Retyped Password', 'trim|required|xss_clean');

        //user data
        $this->form_validation->set_rules('first_name', 'First Name', 'trim|required|xss_clean');
        $this->form_validation->set_rules('last_name', 'Last Name', 'trim|xss_clean');
        $this->form_validation->set_rules('address', 'Address', 'trim|xss_clean');
        $this->form_validation->set_rules('email', 'Email', 'trim|required|xss_clean');
        $this->form_validation->set_rules('dob', 'Date Of Birth', 'trim|required|xss_clean');
        $this->form_validation->set_rules('description', 'Description', 'trim|xss_clean');


        if($this->form_validation->run() == FALSE) {
            //field validation fail, redirect to registration
            $data['title'] = "Registration Retry";
            $this->load->view('templates/header',$data);
            $this->load->view('view_register');
            $this->load->view('templates/footer');
        }
        else {
            $data['title'] = "Registration Successfull! Please Login";
            $this->load->view('templates/header',$data);
            $this->load->view('view_login');
            $this->load->view('templates/footer');
        }
    }

    function checkFirstNameEmailDOB() {
        //field validation success,  validate against database
        $existingMemberFirstName = $this->input->post('existing_member_first_name');
        $existingMemberEmail = $this->input->post('existing_member_email');
        $existingMemberDOB = $this->input->post('existing_member_dob');

        $existingMemberData = array(
            'first_name' => $existingMemberFirstName,
            'email' => $existingMemberEmail,
            'dob' => $existingMemberDOB
        );

        $result = $this->model_member->existingMemberCheck($existingMemberData);

        if($result) {
            $newMemberData = array(
                'username' => $this->input->post('username'),
                'password' => $this->input->post('password'),
                'first_name' => $this->input->post('first_name'),
                'last_name' => $this->input->post('last_name'),
                'address' => $this->input->post('address'),
                'email' => $this->input->post('email'),
                'dob' => $this->input->post('dob'),
                'description' => $this->input->post('description'),
            );

            $this->model_member->addNewMember($newMemberData);
            return true;
        }
        else {
            $this->form_validation->set_message('checkFirstNameEmailDOB', 'Invalid Existing Member Details');
            return false;
        }
    }

    public function logout() {
        $this->session->sess_destroy();
        redirect('controller_main', 'refresh');
    }

    public function searchMembersPage() {

        $this->load->model('model_member');
        $data['title'] = "Search Members";
        $data['result'] = $this->model_member->getAllMembers();

        $this->load->view('templates/header',$data);
        $this->load->view('view_search_member',$data);
        $this->load->view('templates/footer');

    }

    public function viewProfilePage() {

        $this->load->model('model_member');
        $powon_id = $this->session->userdata('powon_id');
        $data['self'] = true;

        $data['title'] = "Profile";
        $data['result'] = $this->model_member->getProfileInfo($powon_id);

        //Loading my functions for relations!
        $this->load->model('model_relation');
        //Grabbing a list of all members but myself so I cant relate myself.
        $data['membersList'] = $this->model_member->getAllMembersNotSelfOrRelated($powon_id);
        //grabbing the stuff to show all this dudes relations.
        $data['family'] = $this->model_relation->getAllFamily($powon_id);
        $data['friends'] = $this->model_relation->getAllFriends($powon_id);
        $data['colleagues'] = $this->model_relation->getAllColleagues($powon_id);

        $this->load->view('templates/header',$data);
        $this->load->view('view_profile',$data);
        $this->load->view('templates/footer');
    }

    public function viewMemberProfilePage($powon_id) {

        $this->load->model('model_member');
        

        $data['title'] = "Profile";
        $data['result'] = $this->model_member->getProfileInfo($powon_id);
        $data['self'] = false;

        $this->load->model('model_relation');

        $data['family'] = $this->model_relation->getAllFamily($powon_id);
        $data['friends'] = $this->model_relation->getAllFriends($powon_id);
        $data['colleagues'] = $this->model_relation->getAllColleagues($powon_id);
    

        $this->load->view('templates/header',$data);
        $this->load->view('view_profile',$data);
        $this->load->view('templates/footer');
    }
    public function checkRelation(){

        $this->load->model('model_member');
        $powon_id = $this->session->userdata('powon_id');
        $relates_id = $this->input->post('member');
        $family = $this->input->post('family');
        $friend = $this->input->post('friend');
        $colleague = $this->input->post('colleague');

        $data = array(
            'powon_id' => $powon_id,
            'relates_powon_id' => $relates_id,
            'family' => $family,
            'friend' => $friend,
            'colleague' => $colleague,
            );
        $this->load->model('model_relation');
        $this->model_relation->checkRelation($powon_id, $relates_id, $data);

        redirect('/controller_member/viewproFilePage/', 'refresh');
    }
}