<?php
class Model_event extends CI_Model{
 	function insertNewEvent($eventData) {
        $this->db->insert("event",$eventData);
        return $this->db->insert_id();
    }
    function getAllGroupEvents($group_id) {
        $sql = "SELECT event.name, event.event_id
                FROM event
                WHERE event.group_id = '$group_id'";
        $query = $this->db->query($sql);
        return $query->result();
    }
    function getEventInfo($event_id) {
        $sql = "SELECT * FROM `event` WHERE event_id = '$event_id'";
        $query = $this->db->query($sql);
        return $query->result();
    }
    function insertNewPoll($pollData) {
        $this->db->insert("poll", $pollData);
        return $this->db->insert_id();
    }
    function insertNewSuggestion($sData) {
        $this->db->insert("suggestion",$sData);
        
    }
    function getPollInfo($event_id) {
        $sql = "SELECT * FROM `poll` WHERE event_id = '$event_id'";
        $query = $this->db->query($sql);
        return $query->result();
    }
    function getSuggInfo($poll_id) {
        $sql = "SELECT * FROM `suggestion` WHERE poll_poll_id = '$poll_id'";
        $query = $this->db->query($sql);
        return $query->result();
    }
    function vote($suggestion_id){
    	$sql = "UPDATE `suggestion` SET votecount = votecount + 1 WHERE suggestion_id = '$suggestion_id'";
        $query = $this->db->query($sql);
    }
    function memberVoted($memberVoted){
        $this->db->insert("member_voted",$memberVoted);
        
    }
    public function memberHasVoted($member, $poll_id)
    {
    	$sql = "SELECT * FROM member_voted WHERE powon_id = $member and poll_id = $poll_id";
    	 $query = $this->db->query($sql);
        if($query->num_rows() > 0) {
        	//he has already voted
            return true;
        } else {
        	//he can vote
            return false;
        }
    }

    //return the winner suggestiong 
    public function SelectedSuggestion()
    {
    	$sql = "SELECT * FROM suggestion WHERE votecount =(SELECT max(votecount) from suggestion)";
    	$query = $this->db->query($sql);
    	return $query->result(); 
    }

    //check if pool is closed
    public function isPoolOpen($poll_id)
    {
    	$sql = "SELECT * from poll WHERE poll_id = $poll_id and open = true";
    	$query = $this->db->query($sql);
    	if($query->num_rows() > 0) {
        	//poll is open 
            return true;
        } else {
        	//closed
            return false;
        }

    }
    //Close the poll
    function closePoll($poll_id) {
       $sql = "UPDATE `poll` SET open = 0 WHERE poll_id = '$poll_id'";
        $query = $this->db->query($sql);
    }
    function deleteEvent($eventData){
    	$this->db->delete("event",$eventData);
    }


}