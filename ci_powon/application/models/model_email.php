<?php
class model_Email extends CI_Model{

    function getAllReceivedEmail($powon_id) {
        $sql = "SELECT * FROM message_recieved WHERE reciever_powon_id = '$powon_id'";
        $query = $this->db->query($sql);
        return $query->result();

    }
    function getNumberOfReceivedEmail($powon_id){
        $sql = "SELECT count(message_id) AS numberOfmessage FROM message_recieved WHERE reciever_powon_id = '$powon_id'";
        $query = $this->db->query($sql);
        return $query->result();
    }

    function getAllSentEmail($powon_id){
        $sql = "SELECT * FROM message_sent WHERE sender_powon_id = '$powon_id'";
        $query = $this->db->query($sql);
        return $query->result();
    }

    function getNumberOfSentEmail($powon_id){
        $sql = "SELECT count(message_sent_id) AS numberOfmessage FROM message_sent WHERE sender_powon_id = '$powon_id'";
        $query = $this->db->query($sql);
        return $query->result();
    }

    function sendEmail($data){
        $this->db->insert("message_recieved",$data);
    }

    function keepInSendBox($data){
        $this->db->insert("message_sent",$data);
    }


}