<?php
class model_Member extends CI_Model{

    function getAllMembers() {
        $sql = "SELECT * FROM member";
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

    function registrationCheck($existingMemberFirstName, $existingMemberEmail,$existingMemberDOB) {
        $sql = "SELECT powon_id
                FROM member WHERE first_name = '$existingMemberFirstName' AND email = '$existingMemberEmail'
                AND dob = '$existingMemberDOB'";
        $query = $this->db->query($sql);
        if($query -> num_rows() == 1 ) {
            return true;
        }
        else {
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