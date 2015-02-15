<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Controller_post extends CI_Controller {

    public function createPost($group_id, $thread_id) {
        $data['title'] = "Create Post";
        $data['group_id'] = $group_id;
        $data['thread_id'] = $thread_id;
        $this->load->view('templates/header',$data);

        $powon_id = $this->session->userdata('powon_id');

        //create post
        $post = $this->input->post('post');

        date_default_timezone_set('America/Montreal');
        $currentDateTime = date("Y-m-d H:i:s");


        ////testing
        //upload config

        $config['upload_path'] ='./uploads';
        $config['allowed_types'] ='gif|jpg|png|mp4';
         $config['max_size'] ='10000000000000000000';
        //$config['max_width'] ='1024';
        //$config['max_height'] ='768';

        $this->load->library('upload');
        $this->upload->initialize($config);

        //$this->upload->initialize($config);



        if($this->upload->do_upload())
        {
            $ret = $this->upload->data();
            $pathToFile = $ret['file_name'];
            $fileType = strtolower($ret['file_ext']);
        }
        else
        {
            $pathToFile = null;
            $fileType = null;
        }

        $postData = array (
            'content' => $post,
            'author_id' => $powon_id,
            'thread_id' => $thread_id,
            //set timezone?
//          date_default_timezone_set("America/New_York");
//          echo "The time is " . date("h:i:sa");
            'date' => $currentDateTime,
            'upload' => $pathToFile,
            'upload_type'=> $fileType
        );
        $this->load->model('model_post');


        $this->model_post->insertNewPost($postData);

        redirect("controller_thread/threadPage/$thread_id/$group_id", 'refresh');
    }
}

