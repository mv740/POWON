<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Controller_email extends CI_Controller {


    public function EmailUpdate()
    {
        $this->load->model('model_member');
        $powon_id = $this->session->userdata('powon_id');

        $this->load->model('model_email');
        $data['numberSent'] = $this->model_email->getNumberOfSentEmail($powon_id);
        $data['numberReceived'] = $this->model_email->getNumberOfReceivedEmail($powon_id);
        $data['GiftnumberSent'] = $this->model_email->getNumberOfSentGift($powon_id);
        $data['GiftnumberReceived'] = $this->model_email->getNumberOfReceivedGift($powon_id);

        $this->load->view('view_emailUpdate', $data);
    }


    public function  InviteToPowon()
    {
        $this->load->model('model_member');
        $data['title'] = "Create Email";
        $data['result'] = $this->model_member->getAllMembers();

        $powon_id = $this->session->userdata('powon_id');
        $this->load->model('model_email');
        $data['numberSent'] = $this->model_email->getNumberOfSentEmail($powon_id);
        $data['numberReceived'] = $this->model_email->getNumberOfReceivedEmail($powon_id);
        $data['GiftnumberSent'] = $this->model_email->getNumberOfSentGift($powon_id);
        $data['GiftnumberReceived'] = $this->model_email->getNumberOfReceivedGift($powon_id);
        $data['UserSelected'] = true;

        $this->load->view('templates/header',$data);
        $this->load->view('view_InviteToPowon',$data);
        $this->load->view('templates/footer');
    }

    public function InviteAuthentication()
    {
        $this->load->model('model_member');

        $this->form_validation->set_rules('email1', 'Email', 'trim|required|xss_clean');
        $this->form_validation->set_rules('email2', 'Email ', 'trim|required|xss_clean|callback_InviteConfirmation');

        if($this->form_validation->run() == FALSE)
        {
            $powon_id = $this->session->userdata('powon_id');
            //field validation fail, redirect to invite
            $this->load->model('model_email');
            $data['numberSent'] = $this->model_email->getNumberOfSentEmail($powon_id);
            $data['numberReceived'] = $this->model_email->getNumberOfReceivedEmail($powon_id);
            $data['GiftnumberSent'] = $this->model_email->getNumberOfSentGift($powon_id);
            $data['GiftnumberReceived'] = $this->model_email->getNumberOfReceivedGift($powon_id);

            $data['title'] = "Invite";
            $this->load->view('templates/header',$data);
            $this->load->view('view_InviteToPowon');
            $this->load->view('templates/footer');
        }
        else
        {

            redirect('controller_email/InviteSucess', 'refresh');
        }
    }

    public function InviteConfirmation()
    {
        $email1 = $this->input->post('email1');
        $email2 = $this->input->post('email2');

        if($email1 == $email2 )
        {
            return TRUE;
        }
        else{
            $this->form_validation->set_message('InviteConfirmation', 'emails do not match');
            return false;
        }
    }
    public function InviteSucess()
    {
        $data['title'] = "INVITE SENDED";
        $this->load->view('templates/header',$data);
        $this->load->view('view_InviteToPowonSuccess',$data);
        $this->load->view('templates/footer');
    }

    public function viewReceivedEmail() {
        $this->load->model('model_member');
        $powon_id = $this->session->userdata('powon_id');

        $this->load->model('model_email');

        $data['title'] = " Inbox";
        $data['result'] = $this->model_email->getAllReceivedEmail($powon_id);

        $data['numberSent'] = $this->model_email->getNumberOfSentEmail($powon_id);
        $data['numberReceived'] = $this->model_email->getNumberOfReceivedEmail($powon_id);
        $data['GiftnumberSent'] = $this->model_email->getNumberOfSentGift($powon_id);
        $data['GiftnumberReceived'] = $this->model_email->getNumberOfReceivedGift($powon_id);

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

        $data['numberSent'] = $this->model_email->getNumberOfSentEmail($powon_id);
        $data['numberReceived'] = $this->model_email->getNumberOfReceivedEmail($powon_id);
        $data['GiftnumberSent'] = $this->model_email->getNumberOfSentGift($powon_id);
        $data['GiftnumberReceived'] = $this->model_email->getNumberOfReceivedGift($powon_id);

        $this->load->view('templates/header',$data);
        $this->load->view('view_emailSent',$data);
        $this->load->view('templates/footer');
    }
    public function createEmail(){

        
        $data['title'] = "Create Email";
        

        $powon_id = $this->session->userdata('powon_id');
        //THIS WAS ADDED AFTER DEMO
        $this->load->model('model_relation');
        $this->load->model('model_email');
        $this->load->model('model_member');
        $data['peopleYouCanSendTo'] = $this->model_email->getAllRelatedAndGroupMembers($powon_id);
        $data['adminSend'] = $this->model_member->getAllMembers();
        //THIS WAS ADDED AFTER DEMO


        $data['numberSent'] = $this->model_email->getNumberOfSentEmail($powon_id);
        $data['numberReceived'] = $this->model_email->getNumberOfReceivedEmail($powon_id);
        $data['GiftnumberSent'] = $this->model_email->getNumberOfSentGift($powon_id);
        $data['GiftnumberReceived'] = $this->model_email->getNumberOfReceivedGift($powon_id);
        $data['UserSelected'] = true;

        $this->load->view('templates/header',$data);
        $this->load->view('view_createEmail',$data);
        $this->load->view('templates/footer');
    }



    public function  sendCreatedEmail(){
        $this->load->model('model_member');
        $powon_id = $this->session->userdata('powon_id');
        $content = $this->input->post('content');
        $sendTo  = $this->input->post('member');


        if($sendTo =="NotSelected")
        {
            $this->load->model('model_member');
            $data['title'] = "Create Email";
             $powon_id = $this->session->userdata('powon_id');
            //THIS WAS ADDED AFTER DEMO
            $this->load->model('model_email');
            $data['peopleYouCanSendTo'] = $this->model_email->getAllRelatedAndGroupMembers($powon_id);
            //THIS WAS ADDED AFTER DEMO

            $powon_id = $this->session->userdata('powon_id');
            $this->load->model('model_email');
            $data['numberSent'] = $this->model_email->getNumberOfSentEmail($powon_id);
            $data['numberReceived'] = $this->model_email->getNumberOfReceivedEmail($powon_id);
            $data['GiftnumberSent'] = $this->model_email->getNumberOfSentGift($powon_id);
            $data['GiftnumberReceived'] = $this->model_email->getNumberOfReceivedGift($powon_id);
            $data['UserSelected'] = false;

            $this->load->view('templates/header',$data);
            $this->load->view('view_CreateEmail',$data);
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
                'recieved_visibility' =>true

            );

            $this->load->model('model_email');
            $isActive = $this->model_email->checkActive($sendTo);
            if($isActive == false)
            {
                //user is not active
                redirect('/controller_email/emailError', 'refresh');
            }


            $this->load->model('model_email');
            //$this->model_email->keepInSendBox($data);
            $this->model_email->sendEmail($data);

            redirect('/controller_email/viewSentEmail', 'refresh');
        }

    }
    public function emailError()
    {
        $data['title'] = "ERROR";
        $this->load->view('templates/header' ,$data);
        $this->load->view('view_emailError');
        $this->load->view('templates/footer');
    }

    public function deleteSentEmail()
    {

        $message_id = $this->input->post('data');
        $this->load->model('model_email');
        $this->model_email->deleteEmailFromSendBox($message_id);
        redirect('/controller_email/viewSentEmail/', 'refresh');
    }
    public function deleteInboxEmail()
    {
        $message_id = $this->input->post('data');
        $this->load->model('model_email');
        $this->model_email->deleteEmailFromInbox($message_id);
        redirect('/controller_email/viewReceivedEmail/', 'refresh');
    }
}

