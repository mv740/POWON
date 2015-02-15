<?php
class model_Member extends CI_Model{

    function getAllMembers() {
        $sql = "SELECT * FROM member";
        $query = $this->db->query($sql);
        return $query->result();

    }

    //my method
    function deleteRelation($Data)
    {
        $this->db->delete("member_relates_member",$Data);
    }
    //add method

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

    function canSeeGroupProfile($powon_id, $profileID)
    {
        $sql = "Select * from member_of_group AS A INNER JOIN member_of_group AS B
                WHERE A. powon_id = $powon_id
                AND B.powon_id = $profileID
                AND A.group_id = B.group_id";

        $query =$this->db->query($sql);

        if($query->num_rows() > 0)
        {
            return true;
        } else
        {
            return false;
        }

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

    function checkSuspended($username, $password) {
        $sql = "SELECT * FROM member WHERE username = '$username'
                AND password = '$password'
                AND status = 'suspended'";
        $query = $this->db->query($sql);
        if($query -> num_rows() > 0) {
            return true;
        }
        else {
            return false;
        }
    }

//Dat Privacy settings
    function updatePrivacy($powon_id, $data){
        $sql = "SELECT * FROM member WHERE powon_id = '$powon_id'";
        $query = $this->db->query($sql);
        $this->db->where('powon_id', $powon_id);
        $this->db->update('member', $data);
    }

    function getPrivacy($powon_id){
        $sql = "SELECT * FROM member WHERE powon_id = '$powon_id'";
        $query = $this->db->query($sql);
        if($query -> num_rows() == 1) {
            return $query->result();
        }
        else {
            return false;
        }
    }
    function groupPrivacyVisibility($powon_id, $visitor_powon_id)
    {
        $sql = "SELECT * FROM (SELECT group.group_id FROM member_of_group INNER JOIN `group`
                ON member_of_group.powon_id = '$powon_id'
                AND member_of_group.group_id = group.group_id) as membersGroups LEFT JOIN member_of_group
                ON membersGroups.group_id = member_of_group.group_id
                WHERE member_of_group.powon_id = $visitor_powon_id";
        $query = $this->db->query($sql);
        if ($query->num_rows() >= 1) {
            return true;
        } else {
            return false;
        }

    }
    //Profession Update stuff
    function updateProfession($powon_id, $data){
        $sql = "SELECT * FROM member WHERE powon_id = '$powon_id'";
        $query = $this->db->query($sql);
        $this->db->where('powon_id', $powon_id);
        $this->db->update('member', $data);
    }

    //Interest stuff
    function addInterest($memberInfo) {
        $this->db->insert("member_interests",$memberInfo);
    }

    function deleteInterest($deleteInfo) {
        $this->db->delete("member_interests",$deleteInfo);

    }
    function getAllInterests($powon_id) {
        $sql = "SELECT * FROM member_interests
                WHERE powon_id = '$powon_id'";
        $query = $this->db->query($sql);
        return $query->result();

    }
    function checkInterest($powon_id, $interest) {
        $sql = "SELECT * FROM member_interests
                WHERE powon_id = '$powon_id' AND interests = '$interest'";
        $query = $this->db->query($sql);
        return $query->result();

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