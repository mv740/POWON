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

    public function groupJoinRequestPage($group_id) {

        $this->load->model('model_request');

        $data['title'] = "Group Join Requests";
        $data['groupJoinRequests'] = $this->model_request-> getGroupJoinRequests($group_id);
        $data['group_id'] = $group_id;

        $this->load->view('templates/header',$data);
        $this->load->view('view_join_requests',$data);
        $this->load->view('templates/footer');

    }

    public function createJoinRequest($group_id) {

        $this->load->model('model_request');

        $powon_id = $this->session->userData('powon_id');

        $requestData = array (
            'powon_id' => $powon_id,
            'group_id' => $group_id
        );

        //verify that request doesn't already exist and member is not part of group already
        $result = $this->model_request->authenticateRequest($requestData);

        if($result) {
            $this->model_request->insertRequest($requestData);
            redirect('controller_main/homePage', 'refresh');
        } else {
            redirect('controller_main/homePage', 'refresh');
        }
    }

    public function acceptJoinRequest($group_id,$powon_id) {

        $this->load->model('model_member');
        $this->load->model('model_request');

        $memberAndGroupId = array (
            'group_id' => $group_id,
            'powon_id' => $powon_id
        );

        $this->model_member->addNewMemberToGroup($memberAndGroupId);
        $this->model_request->deleteRequest($memberAndGroupId);

        redirect("controller_group/groupPage/$group_id", 'refresh');
    }

    public function declineJoinRequest($group_id,$powon_id) {

        $this->load->model('model_request');

        $memberAndGroupId = array (
            'group_id' => $group_id,
            'powon_id' => $powon_id
        );

        $this->model_request->deleteRequest($memberAndGroupId);

        redirect("controller_group/groupPage/$group_id", 'refresh');
    }


    public function groupInviteRequestPage($group_id) {
        
        $data['title'] = "Invite Member";
        $data['group_id'] = $group_id;

        $this->load->view('templates/header',$data);
        $this->load->view('view_invite_request',$data);
        $this->load->view('templates/footer');

    }

    public function authenticateGroupInvite($group_id) {

        $this->load->model("model_member");
        $this->load->model("model_group");

        $existingMemberPowonID = $this->input->post('existing_member_powon_id');
        $existingMemberEmail = $this->input->post('existing_member_email');
        $existingMemberAddress = $this->input->post('existing_member_address');
        $existingMemberFirstName = $this->input->post('existing_member_first_name');
        $existingMemberDOB = $this->input->post('existing_member_dob');


        //check if not already member
        $groupMemberData = array(
            'powon_id' => $existingMemberPowonID,
            'group_id' => $group_id
        );

        $existingMemberData = array(
            'powon_id' => $existingMemberPowonID,
            'email' => $existingMemberEmail,
            'address' => $existingMemberAddress,
            'first_name' => $existingMemberFirstName,
            'dob' => $existingMemberDOB
        );

        $resultGroup = $this -> model_member -> existingMemberInGroupCheck($groupMemberData);

        if($resultGroup) {
            redirect("controller_group/groupPage/$group_id", 'refresh');
        } else {
            $resultMember = $this->model_member->existingMemberCheck($existingMemberData);
            if($resultMember) {
                $this->model_group->insertMemberOfGroup($groupMemberData);
                redirect("controller_group/groupPage/$group_id", 'refresh');
            } else {
                redirect("controller_group/groupPage/$group_id", 'refresh');
            }
        }
    }

    public function leaveGroup($group_id,$powon_id) {

        $this -> load-> model("model_group");

        $groupMemberData = array (
            'powon_id' => $powon_id,
            'group_id' => $group_id
        );

        $this->model_group->deleteMemberFromGroup($groupMemberData);
        redirect("controller_main/homePage", 'refresh');
    }

    public function removeFromGroup($group_id,$powon_id) {

        $this -> load-> model("model_group");

        $groupMemberData = array (
            'powon_id' => $powon_id,
            'group_id' => $group_id
        );

        $this->model_group->deleteMemberFromGroup($groupMemberData);
        redirect("controller_group/groupPage/$group_id", 'refresh');
    }

    public function deleteGroup($group_id) {

        $this -> load-> model("model_group");

        $groupData = array (
            'group_id' => $group_id
        );

        $this->model_group->deleteGroup($groupData);
        redirect("controller_main/homePage", 'refresh');
    }
}

