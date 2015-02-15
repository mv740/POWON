<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Controller_gift extends CI_Controller {




    public function viewReceivedGift() {
        $this->load->model('model_member');
        $powon_id = $this->session->userdata('powon_id');

        $this->load->model('model_email');

        $data['title'] = "Gifts";
        $data['result'] = $this->model_email->getAllReceivedGift($powon_id);
        $data['numberSent'] = $this->model_email->getNumberOfSentEmail($powon_id);
        $data['numberReceived'] = $this->model_email->getNumberOfReceivedEmail($powon_id);
        $data['GiftnumberSent'] = $this->model_email->getNumberOfSentGift($powon_id);
        $data['GiftnumberReceived'] = $this->model_email->getNumberOfReceivedGift($powon_id);




        $this->load->view('templates/header',$data);
        $this->load->view('view_giftReceived',$data);
        $this->load->view('templates/footer');
    }

    public function viewSentGift() {
        $this->load->model('model_member');
        $powon_id = $this->session->userdata('powon_id');

        $this->load->model('model_email');

        $data['title'] = "Gifts";
        $data['result'] = $this->model_email->getAllSentGift($powon_id);
        $data['numberSent'] = $this->model_email->getNumberOfSentEmail($powon_id);
        $data['numberReceived'] = $this->model_email->getNumberOfReceivedEmail($powon_id);
        $data['GiftnumberSent'] = $this->model_email->getNumberOfSentGift($powon_id);
        $data['GiftnumberReceived'] = $this->model_email->getNumberOfReceivedGift($powon_id);

        $this->load->view('templates/header',$data);
        $this->load->view('view_giftSent',$data);
        $this->load->view('templates/footer');
    }
    public function createGifts(){
        $powon_id = $this->session->userdata('powon_id');
        $this->load->model('model_member');
        $this->load->model('model_email');
        $data['UserSelected'] = true;

        $data['title'] = "Create Gift";
        $data['result'] = $this->model_member->getAllMembers();
        $data['numberSent'] = $this->model_email->getNumberOfSentEmail($powon_id);
        $data['numberReceived'] = $this->model_email->getNumberOfReceivedEmail($powon_id);
        $data['GiftnumberSent'] = $this->model_email->getNumberOfSentGift($powon_id);
        $data['GiftnumberReceived'] = $this->model_email->getNumberOfReceivedGift($powon_id);


        $this->load->view('templates/header',$data);
        $this->load->view('view_createGifts',$data);
        $this->load->view('templates/footer');
    }
    public function  sendCreatedGift(){
        $this->load->model('model_member');
        $powon_id = $this->session->userdata('powon_id');
        $content = $this->input->post('content');
        $sendTo  = $this->input->post('member');
        $gift_content = $this->input->post('gift_content');
        $this->load->model('model_email');
        //if not selected $gift_content is going to be null but value 0 will be store in database
        //so to fix this
        if($gift_content == null)
        {
            $gift_content = null;
        }

        if($sendTo =="NotSelected")
        {
            $this->load->model('model_member');

            $data['title'] = "Create Gift";
            $data['result'] = $this->model_member->getAllMembers();
            $data['numberSent'] = $this->model_email->getNumberOfSentEmail($powon_id);
            $data['numberReceived'] = $this->model_email->getNumberOfReceivedEmail($powon_id);
            $data['GiftnumberSent'] = $this->model_email->getNumberOfSentGift($powon_id);
            $data['GiftnumberReceived'] = $this->model_email->getNumberOfReceivedGift($powon_id);
            $data['UserSelected'] = false;


            $this->load->view('templates/header',$data);
            $this->load->view('view_createGifts',$data);
            $this->load->view('templates/footer');
        }
        else
        {
            date_default_timezone_set('America/Montreal');
            $now = date("Y-m-d H:i:s");



            $data = array(
                //'message_send_id' => $powon_id,

                'content' => $content,
                'sender_powon_id' => $powon_id,
                'reciever_powon_id' => $sendTo,
                'date' => $now,
                'sent_visibility' => true,
                'recieved_visibility' =>true,
                'gift' =>true,
                'gift_content' => $gift_content

            );

            $this->load->model('model_email');

            $IsActive = $this->model_email->checkActive($sendTo);
            if($IsActive == false)
            {
                //user is not active, therefore can't send him a email
                redirect('/controller_email/emailError/', 'refresh');
            }


            $this->model_email->sendEmail($data);

            redirect('/controller_gift/viewSentGift/', 'refresh');
        }


    }


    public function emailError()
    {
        //$data['title'] = "Emails";
        //$this->load->view('templates/header',$data);
        $this->load->view('view_emailError');
        //$this->load->view('templates/footer');
    }


    public function deleteSentGift()
    {

        $message_id = $this->input->post('data');
        $this->load->model('model_email');
        $this->model_email->deleteEmailFromSendBox($message_id);
        redirect('/controller_gift/viewSentGift/', 'refresh');
    }
    public function deleteInboxGift()
    {
        $message_id = $this->input->post('data');
        $this->load->model('model_email');
        $this->model_email->deleteEmailFromInbox($message_id);
        redirect('/controller_gift/viewReceivedGift/', 'refresh');
    }
}

