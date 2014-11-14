<?php
class Model_relation extends CI_Model{
	function getAllFamily($powon_id){
		$sql = "SELECT member.first_name, member.last_name, member.powon_id FROM member_relates_member JOIN member ON relates_powon_id = member.powon_id WHERE family = true AND member_relates_member.powon_id = '$powon_id'";
        $query = $this->db->query($sql);
        return $query->result();
	}
	function getAllFriends($powon_id){
		$sql = "SELECT member.first_name, member.last_name, member.powon_id FROM member_relates_member JOIN member ON relates_powon_id = member.powon_id WHERE friend = true AND member_relates_member.powon_id = '$powon_id'";
        $query = $this->db->query($sql);
        return $query->result();
	}
	function getAllColleagues($powon_id){
		$sql = "SELECT member.first_name, member.last_name, member.powon_id FROM member_relates_member JOIN member ON relates_powon_id = member.powon_id WHERE colleague = true AND member_relates_member.powon_id = '$powon_id'";
        $query = $this->db->query($sql);
        return $query->result();
	}
	function insertRelation($data){
		 $this->db->insert("member_relates_member", $data);
	}
	
	function deleteRelation(){
		$this->db->delete('member_relates_member', array('relates_powon_id' => $relates_powon_id));
	}
	function checkRelation($powon_id, $relates_id, $data){
		$sql = "SELECT * FROM member_relates_member WHERE powon_id = '$powon_id' AND relates_powon_id = '$relates_id'";
		$query = $this->db->query($sql);
		if($query->num_rows() > 0){
			$this->updateRelation($powon_id, $relates_id, $data);
		}else{
			
			$this->insertRelation($data);
		}
	}
	function updateRelation($powon_id, $relates_id, $data){
		$this->db->where('powon_id', $powon_id);
		$this->db->where('relates_powon_id', $relates_id);
		$this->db->update('member_relates_member', $data);
	}
}
