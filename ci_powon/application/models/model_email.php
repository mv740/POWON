<?php
class model_Email extends CI_Model{

    function getAllReceivedEmail($powon_id) {
        $sql = "SELECT * FROM email WHERE reciever_powon_id = '$powon_id' and recieved_visibility = TRUE";
        $query = $this->db->query($sql);
        return $query->result();

    }
    function getNumberOfReceivedEmail($powon_id){
        $sql = "SELECT count(message_id) AS numberOfmessage FROM email WHERE reciever_powon_id = '$powon_id' and recieved_visibility = TRUE ";
        $query = $this->db->query($sql);
        return $query->result();
    }

    function getAllSentEmail($powon_id){
        $sql = "SELECT * FROM email WHERE sender_powon_id = '$powon_id' and sent_visibility = TRUE ";
        $query = $this->db->query($sql);
        return $query->result();
    }

    function getNumberOfSentEmail($powon_id){
        $sql = "SELECT count(message_id) AS numberOfmessage FROM email WHERE sender_powon_id = '$powon_id' and sent_visibility = TRUE ";
        $query = $this->db->query($sql);
        return $query->result();
    }

    function sendEmail($data){
        $this->db->insert("email",$data);
    }


    function deleteEmailFromInbox($message_id)
    {
        $this->db->set('recieved_visibility', false);
        $this->db->where('message_id',$message_id);
        $this->db->update('email');

        //$this->db->delete('message_recieved', array('message_id' => $message_id));
    }
    function deleteEmailFromSendBox($message_id)
    {
        $this->db->set('sent_visibility', false);
        $this->db->where('message_id',$message_id);
        $this->db->update('email');
    }

}