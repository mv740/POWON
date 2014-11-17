<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Controller_email extends Auth_Controller {

    public function emailPage() {
        $data['title'] = "Emails";
        $this->load->view('templates/header',$data);

        $this->load->model('model_member');
        $powon_id = $this->session->userdata('powon_id');

        $this->load->model('model_email');
        $data['numberSent'] = $this->model_email->getNumberOfSentEmail($powon_id);
        $data['numberReceived'] = $this->model_email->getNumberOfReceivedEmail($powon_id);

        $this->load->view('view_email', $data);
        $this->load->view('templates/footer');
    }

    public function viewReceivedEmail() {
        $this->load->model('model_member');
        $powon_id = $this->session->userdata('powon_id');

        $this->load->model('model_email');

        $data['title'] = " Inbox";
        $data['result'] = $this->model_email->getAllReceivedEmail($powon_id);

        $this->load->view('templates/header',$data);
        $this->load->view('view_emailReceived',$data);
        $this->load->view('templates/footer');
    }

    public function viewSentEmail() {
        $this->load->model('model_member');
        $powon_id = $this->session->userdata('powon_id');

        $this->load->model('model_email');

        $data['title'] = "Sent Email";
        $data['result'] = $this->model_email->getAllSentEmail($powon_id);

        $this->load->view('templates/header',$data);
        $this->load->view('view_emailSent',$data);
        $this->load->view('templates/footer');
    }
    public function createEmail(){

        $this->load->model('model_member');
        $data['title'] = "Create Email";
        $data['result'] = $this->model_member->getAllMembers();


        $this->load->view('templates/header',$data);
        $this->load->view('view_createEmail',$data);
        $this->load->view('templates/footer');
    }
    public function  sendCreatedEmail(){
        $this->load->model('model_member');
        $powon_id = $this->session->userdata('powon_id');
        $content = $this->input->post('content');
        $sendTo  = $this->input->post('member');

        $now = date("Y-m-d H:i:s");

        $data = array(
            //'message_send_id' => $powon_id,

            'content' => $content,
            'sender_powon_id' => $powon_id,
            'reciever_powon_id' => $sendTo,
            'date' => $now,
            'sent_visibility' => true,
            'recieved_visibility' =>true

        );

        $this->load->model('model_email');
        //$this->model_email->keepInSendBox($data);
        $this->model_email->sendEmail($data);

        redirect('/controller_email/emailPage/', 'refresh');
    }

    public function deleteSentEmail()
    {

        $message_id = $this->input->post('data');
        $this->load->model('model_email');
        $this->model_email->deleteEmailFromSendBox($message_id);
        redirect('/controller_email/emailPage/', 'refresh');
    }
    public function deleteInboxEmail()
    {
        $message_id = $this->input->post('data');
        $this->load->model('model_email');
        $this->model_email->deleteEmailFromInbox($message_id);
        redirect('/controller_email/emailPage/', 'refresh');
    }
}

