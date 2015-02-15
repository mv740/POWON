<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Controller_thread extends CI_Controller {

    public function createThreadPage($group_id) {
        $data['title'] = "Create Thread";
        $data['group_id'] = $group_id;
        $this->load->view('templates/header',$data);
        $this->load->view('view_create_thread',$data);
        $this->load->view('templates/footer');
    }

    public function createThread($group_id) {

        $this->load->model('model_thread');

        $data['group_id'] = $group_id;
        $name = $this->input->post('name');
        $powon_id = $this->session->userdata('powon_id');

        //create new thread and add it to thread table
        $threadData = array (
            'name' => $name,
            'author_id' => $powon_id,
            'group_id' => $group_id,
        );



        $thread_id = $this->model_thread->insertNewThread($threadData);

        //create post and add it as the first post in thread
        $this->load->model('model_post');

        $content = $this->input->post('content');
        date_default_timezone_set('America/Montreal');
        $currentDateTime = date("Y-m-d H:i:s");

        $postData = array (
            'content' => $content,
            'author_id' => $powon_id,
            'thread_id' => $thread_id,
            'date' => $currentDateTime
        );

        //send notification to all member of new thread in thier group
        $this->load->model('model_email');
        $this->load->model('model_group');
        $groupMember = $this->model_group->getAllGroupMembersExceptUser($powon_id, $group_id);
        $GroupInfo  = $this->model_group->getGroupInfo($group_id);
        foreach($GroupInfo as $row)
        {
            $groupname = $row->name;
        }

        foreach($groupMember as $row)
        {
            $Member = $row->powon_id;
            $content = $groupname." New Thread Notification : ".$name;

            date_default_timezone_set('America/Montreal');
            $now = date("Y-m-d H:i:s");

            $data = array(
                //'message_send_id' => $powon_id,

                'content' => $content,
                'sender_powon_id' => $powon_id,
                'reciever_powon_id' => $Member,
                'date' => $now,
                'sent_visibility' => true,
                'recieved_visibility' =>true

            );

            $this->load->model('model_email');
            //$this->model_email->keepInSendBox($data);
            $this->model_email->sendEmail($data);
        }



        $this->model_post->insertNewPost($postData);
        //set restrictions for whole group
        $this->load->model('model_group');
        $allGroupMembers = $this -> model_group -> getAllGroupMembers($group_id);
        foreach($allGroupMembers as $row)
        {
            $MemberRestrictionData = array(
                'powon_id' => $row->powon_id,
                'thread_id' => $thread_id,
                'restriction' => 'unrestricted_comment'
            );
            $this->model_thread->insertNewThreadAccess($MemberRestrictionData);
        }
        //Restrictions
        $restrictionSelected = $this->input->post('restriction');
        if($restrictionSelected == 1) //if restricted selected
        {
            //redirect to thread access page
           // redirect("controller_thread/threadPage/$thread_id/$group_id", 'refresh');
            redirect("controller_thread/threadAccessPage/$group_id/$powon_id/$thread_id/$powon_id", 'refresh');
        }
        else
        {
            redirect("controller_thread/threadPage/$thread_id/$group_id", 'refresh');
        }
    }

    public function threadPage($thread_id, $group_id) {

        $this->load->model('model_thread');
        $this->load->model('model_post');
        $this->load->model('model_admin');

        $powon_id = $this->session->userdata('powon_id');
        $data['isAdmin'] = $this->model_admin->isAdmin($powon_id);

        $data['threadInfo'] = $this -> model_thread -> getThreadInfo($thread_id);
        $data['AuthorOrAdmin'] = $this -> model_thread -> getThreadAccessUser($thread_id);
        $data['postCapability'] = $this -> model_thread -> checkCanComment($thread_id, $powon_id);

        $data['title'] = 'Thread Page';
        $data['group_id'] = $group_id;
        $data['thread_id'] = $thread_id;
        $data['postInfo'] = $this -> model_post -> getAllThreadPosts($thread_id);

        $this->load->view('templates/header',$data);
        $this->load->view('view_thread');
        $this->load->view('templates/footer');
    }

    public function manageThreadAccessPage($group_id) {
        $data['title'] = "Manage Thread Access";
        $data['group_id'] = $group_id;
        $this->load->view('templates/header',$data);
        $this->load->view('view_manage_thread_access',$data);
        $this->load->view('templates/footer');
    }

    public function threadAccessPage($group_id, $author_id, $thread_id, $session_id) {
        $data['title'] = "Thread Access";
        $data['group_id'] = $group_id;
        $data['author_id'] = $author_id;
        $data['thread_id'] = $thread_id;
        $data['session_id'] = $session_id;

        $this->load->model('model_group');
        $data['membersList'] = $this->model_group->getAllGroupMembersExceptUser($author_id, $group_id);

        $this->load->view('templates/header',$data);
        $this->load->view('view_thread_access',$data);
        $this->load->view('templates/footer');
    }

    public function checkThreadAccess($thread_id, $group_id, $author_id){

        $this->load->model('model_thread');
        $powon_id = $this->session->userdata('powon_id');
        $memberToBeUpdated = $this->input->post('member');
        $postRestriction = $this->input->post('restriction');
        if ($postRestriction == 0)
        {
            $restriction = 'unrestricted_comment';
        }
        else if ($postRestriction == 1)
        {
            $restriction = 'unrestricted_no_comment';
        }
        else{
            $restriction = 'restricted';
        }

        $data = array(
            'powon_id' => $memberToBeUpdated,
            'thread_id' => $thread_id,
            'restriction' => $restriction,
        );

        $this->load->model('model_relation');
        $this->model_thread->checkThreadAccess($memberToBeUpdated, $thread_id, $data);

        redirect("/controller_thread/threadAccessPage/$group_id/$author_id/$thread_id/$powon_id", 'refresh');
    }

    public function deletePost($id, $thread_id, $group_id)
    {
        $this->load->model('model_post');

        $Data = array (
            'post_id' => $id
        );

        $this->model_post->deletePost($Data);
        redirect("controller_thread/threadPage/$thread_id/$group_id", 'refresh');
    }

    //THIS STUFF IS ADDED AFTER THE DEMO
    public function editPostPage($post_id, $thread_id, $group_id) {
        $this->load->model('model_post');
        $data['title'] = "Edit Post";
        $data['postText'] = $this->model_post->getPostContent($post_id);
        $data['group_id'] = $group_id;
        $data['thread_id'] = $thread_id;
        $data['post_id'] = $post_id;

        $this->load->view('templates/header',$data);
        $this->load->view('view_edit_post',$data);
        $this->load->view('templates/footer');
    }
    public function updatePost(){
        $this->load->model('model_post');

        $content = $this -> input -> post('content');
        $post_id = $this -> input -> post('post_id');
        $thread_id = $this -> input -> post('thread_id');
        $group_id = $this -> input -> post('group_id');

        $updateInfo = array(
            //'post_id' => $post_id,
            'content' => $content
        );
        $this->model_post->updatePostContents($updateInfo, $post_id);
        redirect("controller_thread/threadPage/$thread_id/$group_id", 'refresh');
    }

    //THIS ENDS HERE YUP IT ENDED ALRIGHT
}

