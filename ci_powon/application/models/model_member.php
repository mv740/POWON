<?php
class model_Member extends CI_Model{

    function getAllMembers() {
        $sql = "SELECT * FROM member";
        $query = $this->db->query($sql);
        return $query->result();

    }
    function getAllMembersNotSelfOrRelated($powon_id) {
        $sql = "SELECT * FROM member WHERE NOT powon_id = '$powon_id'";
        $query = $this->db->query($sql);
        return $query->result();

    }

    function getProfileInfo($powon_id) {
        $sql = "SELECT * FROM member WHERE powon_id = '$powon_id'";
        $query = $this->db->query($sql);
        return $query->result();

    }

    function addNewMember($memberInfo) {
        $this->db->insert("member",$memberInfo);
    }

    function addNewMemberToGroup($memberAndGroupId) {
        $this->db->insert("member_of_group",$memberAndGroupId);
    }

    function existingMemberCheck($existingMemberData) {
        $memberQuery = $this->db->get_where('member', $existingMemberData);
        if($memberQuery->num_rows() > 0) {
            return true;
        } else {
            return false;
        }
    }

    function existingMemberInGroupCheck($groupMemberData) {
        $memberQuery = $this->db->get_where('member_of_group', $groupMemberData);
        if($memberQuery->num_rows() > 0) {
            return true;
        } else {
            return false;
        }
    }

    function login($username, $password) {
    $sql = "SELECT powon_id, username, password, status, privilege
                FROM member WHERE username = '$username' AND password = '$password'";
    $query = $this->db->query($sql);
    if($query -> num_rows() == 1) {
        return $query->result();
    }
    else {
        return false;
    }
}

    //REFERENCE

    function insertMember($memberInfo) {
        $this->db->insert("member",$memberInfo);
    }

    function updateMember($updateInfo) {
        $this->db->update("member",$updateInfo,"powon_id = 5");
    }

    function deleteMember($deleteInfo) {
        $this->db->delete("member",$deleteInfo);

    }
}