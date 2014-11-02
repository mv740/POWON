<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Controller_group extends CI_Controller {


    public function index()
    {
        $data['title'] = "Group Page";
        $this->load->view('templates/header',$data);
        $this->load->view('view_main');
        $this->load->view('templates/footer');
    }

    public function createGroupPage() {
        $data['title'] = "Create Group";
        $this->load->view('templates/header',$data);
        $this->load->view('view_create_group');
        $this->load->view('templates/footer');
    }

    public function createGroup() {

        $this->load->model('model_group');

        $name = $this->input->post('name');
        $description = $this->input->post('description');
        $owner_id = $this->session->userdata('powon_id');

        //create new group in group table
        $groupData = array (
            'name' => $name,
            'description' => $description,
            'owner_id' => $owner_id,
        );
        $group_id = $this->model_group->insertNewGroup($groupData);

        //add owner to member of group table
        $groupMemberData = array (
            'powon_id' => $owner_id,
            'group_id' => $group_id,
        );
        $this->model_group->insertMemberOfGroup($groupMemberData);

        //should direct to new group page
        redirect('controller_main/home', 'refresh');

    }

    //figure out how to load group with argument group_id
    public function loadGroupPage($group_id) {

        //$group_id
        //$group name
        //$group_description
        //$group onwer
        $this->load->model('model_group');
        $data['groupInfo'] = $this -> model_group -> getGroupInfo($group_id);
        $data['groupMemberInfo'] = $this -> model_group ->  getAllGroupMembers($group_id);

        $data['title'] = "Group Page";
        $this->load->view('templates/header',$data);
        $this->load->view('view_group');
        $this->load->view('templates/footer');
    }

    public function searchGroups() {

        $this->load->model('model_group');
        $data['title'] = "Search Groups";
        $data['allGroups'] = $this->model_group->getAllGroups();

        $this->load->view('templates/header',$data);
        $this->load->view('view_search_group',$data);
        $this->load->view('templates/footer');
    }





}

