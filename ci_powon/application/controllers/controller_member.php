<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Controller_member extends CI_Controller {


    public function index()
    {
        $powon_id = $this->session->userdata('powon_id');

        $this->load->model("model_group");
        $this->load->model("model_admin");
        $this->load->model("model_thread");

        $data['memberOfGroup'] = $this->model_group->getGroupsMemberOf($powon_id);
        $data['publicPosts'] = $this->model_admin->getPublicPosts();
        $data['title'] = "Home";
        $data['membersGroupThreads'] = $this->model_thread->getAllMembersGroupThreads($powon_id);


        $data['isAdmin'] = $this->model_admin->isAdmin($powon_id);

        $this->load->view('templates/header', $data);
        $this->load->view('view_home', $data);
        $this->load->view('templates/footer');
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
        //Interest garbage
        $data['interests'] = $this->model_member->getAllInterests($powon_id);

        $this->load->view('templates/header',$data);
        $this->load->view('view_profile',$data);
        $this->load->view('templates/footer');
    }

    public function viewMemberProfilePage($powon_id) {

        $this->load->model('model_member');

        $sessionID = $this->session->userdata('powon_id');


        $data['title'] = "Profile";
        $data['result'] = $this->model_member->getProfileInfo($powon_id);
        $data['interests'] = $this->model_member->getAllInterests($powon_id);
        $data['self'] = false;

        $this->load->model('model_relation');

        $data['family'] = $this->model_relation->getAllFamily($powon_id);
        $data['friends'] = $this->model_relation->getAllFriends($powon_id);
        $data['colleagues'] = $this->model_relation->getAllColleagues($powon_id);

        //echo $this->model_member->canSeeGroupProfile($sessionID,$powon_id);

        $data['isSameGroup'] = $this->model_member->canSeeGroupProfile($sessionID,$powon_id);
    

        $this->load->view('templates/header',$data);
        $this->load->view('view_profile',$data);
        $this->load->view('templates/footer');
    }

    // RELATIONSHIT
    function deleteRelationship()
    {
        $this->load->model('model_member');
        $powon_id = $this->session->userdata('powon_id');
        $relates_id = $this->input->post('member');

        $data = array(
            'powon_id' => $powon_id,
            'relates_powon_id' => $relates_id,
        );
        $this->load->model('model_relation');
        $this->model_relation->deleteRelation($data);

        redirect('/controller_member/viewproFilePage/', 'refresh');
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
    //PRIVACY STUFF

    public function updatePrivacy(){
        $this->load->model('model_member');
        $powon_id = $this->session->userdata('powon_id');
        
        $fnprivacy = $this->input->post('fnameprivacy');
        $lnprivacy = $this->input->post('lnameprivacy');
        $addprivacy = $this->input->post('addressprivacy');
        $dobprivacy = $this->input->post('dobprivacy');
        $descprivacy = $this->input->post('descriptionprivacy');
        $emailprivacy = $this->input->post('emailprivacy');

        $dataprivacy = array(
            'powon_id' => $powon_id,
            'first_name_visibility' => $fnprivacy,
            'last_name_visibility' =>  $lnprivacy,
            'address_visibility' => $addprivacy,
            'dob_visibility' => $dobprivacy,
            'description_visibility' => $descprivacy,
            'email_visibility' => $emailprivacy
            );
        $this->load->model('model_member');
        $this->model_member->updatePrivacy($powon_id, $dataprivacy);

        redirect('/controller_member/viewproFilePage/', 'refresh');
    }

    //PROFESSION STUFF

    public function updateProfession(){
        $this->load->model('model_member');
        $powon_id = $this->session->userdata('powon_id');
        
        $profession = $this->input->post('profession');
        

        $dataprofession = array(
            'powon_id' => $powon_id,
            'profession' => $profession
            );
        $this->load->model('model_member');
        $this->model_member->updateProfession($powon_id, $dataprofession);

        redirect('/controller_member/viewproFilePage/', 'refresh');
    }


    //THE INTEREST SECTION

    public function addInterest(){
        $this->load->model('model_member');
        $powon_id = $this->session->userdata('powon_id');
        $newInterest = $this->input->post('interest');
        $dataInterest = array(
            'powon_id' => $powon_id,
            'interests' => $newInterest
            );
        $this->load->model('model_member');
        $exists = $this->model_member->checkInterest($powon_id, $newInterest);
        if (empty($exists)) {
            $this->model_member->addInterest($dataInterest);
        }
        else
        {
            //Add message interest is already in DB
        }

        redirect('/controller_member/viewproFilePage/', 'refresh');
    }
    public function deleteInterest()
    {
        $this->load->model('model_member');
        $powon_id = $this->session->userdata('powon_id');
        $interest = $this->input->post('interests');
        $dataInterest = array(
            'powon_id' => $powon_id,
            'interests' => $interest
        );
        $this->load->model('model_member');
        $this->model_member->deleteInterest($dataInterest);


        redirect('/controller_member/viewproFilePage/', 'refresh');
    }


}
