<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Controller_admin extends CI_Controller {

    public function editDeleteMembersPage() {

        $this->load->model('model_member');
        $data['title'] = "Edit/Delete Members";
        $data['result'] = $this->model_member->getAllMembers();

        $this->load->view('templates/header',$data);
        $this->load->view('view_edit_delete_member',$data);
        $this->load->view('templates/footer');

    }

    public function updateMemberPrivilegeStatus($powon_id) {

        $this->load->model('model_admin');
        $privilege = $this -> input -> post('privilege');
        $status = $this -> input -> post('status');

        $updateInfo = array(
            'privilege' => $privilege,
            'status' => $status
        );

        $this->model_admin->updateMemberPrivilegeStatus($updateInfo,$powon_id);
        redirect('controller_admin/editDeleteMembersPage', 'refresh');
    }

    public function deleteMember($powon_id) {

        $this -> load-> model("model_admin");

        $memberData = array (
            'powon_id' => $powon_id
        );

        $this->model_admin->deleteMember($memberData);
        redirect('controller_admin/editDeleteMembersPage', 'refresh');
    }

    public function createPublicPostPage() {

        $data['title'] = "Create Public Post";

        $this->load->view('templates/header',$data);
        $this->load->view('view_create_public_post',$data);
        $this->load->view('templates/footer');
    }
    //THIS STUFF IS ADDED AFTER THE DEMO
    public function editPublicPostPage($public_post_id) {
        $this->load->model('model_admin');
        $data['title'] = "Edit Public Post";
        $data['publicPostText'] = $this->model_admin->getPublicPostContent($public_post_id);

        $this->load->view('templates/header',$data);
        $this->load->view('view_edit_public_post',$data);
        $this->load->view('templates/footer');
    }
    public function updatePublicPost(){
        $this->load->model('model_admin');
        $content = $this -> input -> post('content');
        $public_post_id = $this -> input -> post('public_post_id');
        $updateInfo = array(
            'public_post_id' => $public_post_id,
            'content' => $content
        );
        $this->model_admin->updatePublicPostContents($updateInfo);
        redirect("controller_member/", 'refresh');
    }   

    //THIS ENDS HERE YUP IT ENDED ALRIGHT

    public function createPublicPost() {

        $this->load->model('model_admin');
        $content = $this->input->post('content');
        $admin_id = $this->session->userdata('powon_id');

        date_default_timezone_set('America/Montreal');
        $currentDateTime = date("Y-m-d H:i:s");

        $postData = array (
            'content' => $content,
            'admin_id' => $admin_id,
            'date' => $currentDateTime
        );

        $this->model_admin->insertNewPublicPost($postData);
        redirect("controller_member/", 'refresh');
    }

    public function deletePublicPost($id)
    {
        //$message_id = $this->input->post('dataPost');
        $this->load->model('model_admin');

        $Data = array (
            'public_post_id' => $id
        );




        $this->model_admin->deletePublicPost($Data);
        redirect('/controller_member/', 'refresh');
    }


    //REPORTS STUFF
       public function reportsPage() {

        $this->load->model('model_admin');

        $data['title'] = "Reports Page";
        $data['interests'] = $this->model_admin->getReportInterests();
        $data['profession'] = $this->model_admin->getReportProfession();

        //UPDATED CODE AFTER DEMO BEGINS
        $data['numOfGrps'] = $this->model_admin->getNumberOfGroups();
        $data['numOfMembers'] = $this->model_admin->getNumberOfMembers();
        $data['numOfThreads'] = $this->model_admin->getNumberOfMembers();
        $data['numOfPosts'] = $this->model_admin->getNumberOfMembers();
        $data['avgAge'] = $this->model_admin->getAverageAge();
        $data['groupStats'] = $this->model_admin->getGroupStats();
        $data['usersStats'] = $this->model_admin->getUsersStats();
        //ENDS

        $this->load->view('templates/header',$data);
        $this->load->view('view_reports',$data);
        $this->load->view('templates/footer');

    }



}

