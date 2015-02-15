<?php
class model_Email extends CI_Model{

    function getAllReceivedEmail($powon_id) {
        $sql = "SELECT * FROM email WHERE reciever_powon_id = '$powon_id' and recieved_visibility = TRUE AND gift=FALSE
                ORDER BY date DESC";
        $query = $this->db->query($sql);
        return $query->result();

    }
    function getNumberOfReceivedEmail($powon_id){
        $sql = "SELECT count(message_id) AS numberOfmessage FROM email WHERE reciever_powon_id = '$powon_id'
                and recieved_visibility = TRUE AND gift=FALSE";
        $query = $this->db->query($sql);
        return $query->result();
    }

    function getAllSentEmail($powon_id){
        $sql = "SELECT * FROM email WHERE sender_powon_id = '$powon_id' and sent_visibility = TRUE AND gift=FALSE
                ORDER BY date DESC";
        $query = $this->db->query($sql);
        return $query->result();
    }

    function getNumberOfSentEmail($powon_id){
        $sql = "SELECT count(message_id) AS numberOfmessage FROM email WHERE sender_powon_id = '$powon_id'
                and sent_visibility = TRUE AND gift=FALSE";
        $query = $this->db->query($sql);
        return $query->result();
    }

    //gifts

    // GIFT METHODS
    //ORDER BY date DESC
    function getAllReceivedGift($powon_id) {
        $sql = "SELECT * FROM email WHERE reciever_powon_id = '$powon_id' and recieved_visibility =TRUE and gift = TRUE
                ORDER BY date DESC ";
        $query = $this->db->query($sql);
        return $query->result();

    }
    function getNumberOfReceivedGift($powon_id){
        $sql = "SELECT count(message_id) AS numberOfmessage FROM email WHERE reciever_powon_id = '$powon_id'
                and recieved_visibility = TRUE and gift=TRUE ";
        $query = $this->db->query($sql);
        return $query->result();
    }

    function getAllSentGift($powon_id){
        $sql = "SELECT * FROM email WHERE sender_powon_id = '$powon_id' and sent_visibility = TRUE and gift= TRUE
                ORDER BY date DESC";
        $query = $this->db->query($sql);
        return $query->result();
    }

    function getNumberOfSentGift($powon_id){
        $sql = "SELECT count(message_id) AS numberOfmessage FROM email WHERE sender_powon_id = '$powon_id' and sent_visibility = TRUE and gift = TRUE ";
        $query = $this->db->query($sql);
        return $query->result();
    }


    //Check if active then send email
    function checkActive($sentTo)
    {
        $sql = "SELECT status FROM member Where powon_id = $sentTo";
        $query = $this->db->query($sql);
        $result = $query->result();

        if($result[0]->status == 'inactive')
            return false; //redirect to error page
        else
            return true; // it is ok send email


    }
    //ADDED AFTER DEMO WHO THEY CAN SEND EMAILS TOO
    function getAllRelatedAndGroupMembers($powon_id){
        $sql = "SELECT * FROM (SELECT A.first_name, A.last_name, A.powon_id FROM(SELECT member.first_name, member.last_name, member.powon_id, member_of_group.group_id FROM member JOIN member_of_group ON member.powon_id = member_of_group.powon_id) AS A WHERE A.group_id IN (SELECT group.group_id FROM member_of_group INNER JOIN `group` ON member_of_group.powon_id = '$powon_id' AND member_of_group.group_id = group.group_id)) AS C UNION (SELECT member.first_name, member.last_name, member.powon_id FROM member_relates_member JOIN member ON relates_powon_id = member.powon_id WHERE (colleague = true OR family = true OR friend = true) AND member_relates_member.powon_id = '$powon_id') ";
        $query = $this->db->query($sql);
        return $query->result();
    }
    //ENDS HERE


    
    //SENDING EMAILS
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