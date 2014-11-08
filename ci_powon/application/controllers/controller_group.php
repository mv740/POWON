<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Controller_group extends CI_Controller {



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
        $powon_id = $this->session->userdata('powon_id');

        //create new group in group table
        $groupData = array (
            'name' => $name,
            'description' => $description,
            'powon_id' => $powon_id,
        );
        $group_id = $this->model_group->insertNewGroup($groupData);

        //add owner to member of group table
        $groupMemberData = array (
            'powon_id' => $powon_id,
            'group_id' => $group_id,
        );
        $this->model_group->insertMemberOfGroup($groupMemberData);

        redirect("controller_group/groupPage/$group_id", 'refresh');

    }


    public function groupPage($group_id) {


        $this->load->model('model_group');
        $data['groupInfo'] = $this -> model_group -> getGroupInfo($group_id);
        $data['groupMemberInfo'] = $this -> model_group ->  getAllGroupMembers($group_id);

        $data['title'] = "Group Page";
        $this->load->view('templates/header',$data);
        $this->load->view('view_group');
        $this->load->view('templates/footer');
    }

    public function searchGroupsPage() {

        $this->load->model('model_group');
        $data['title'] = "Search Groups";
        $data['allGroups'] = $this->model_group->getAllGroups();

        $this->load->view('templates/header',$data);
        $this->load->view('view_search_group',$data);
        $this->load->view('templates/footer');
    }





}

