<?php
class Model_group extends CI_Model{

    function getAllGroups() {
        $sql = "SELECT * FROM `group`";
        $query = $this->db->query($sql);
        return $query->result();
    }

    function getAllGroupMembers($group_id) {
        $sql = "SELECT * FROM member_of_group INNER JOIN member
                ON group_id = '$group_id'
                AND member_of_group.powon_id = member.powon_id";
        $query = $this->db->query($sql);
        return $query->result();

    }

    function getGroupInfo($group_id) {
        $sql = "SELECT * FROM `group` WHERE group_id = '$group_id'";
        $query = $this->db->query($sql);
        return $query->result();
    }

    function getGroupsMemberOf($powon_id) {
        $sql = "SELECT * FROM member_of_group INNER JOIN `group`
                ON member_of_group.powon_id = '$powon_id'
                AND member_of_group.group_id = group.group_id";
        $query = $this->db->query($sql);
        return $query->result();

    }

    function getAllGroupMembersExceptUser($powon_id, $group_id) {
        $sql = "SELECT * FROM member_of_group INNER JOIN member
                ON group_id = '$group_id'
                AND member_of_group.powon_id = member.powon_id
                AND member.powon_id <> '$powon_id'";
        $query = $this->db->query($sql);
        return $query->result();

    }

    function insertNewGroup($groupData) {
        $this->db->insert("group",$groupData);
        return $this->db->insert_id();
    }

    function insertMemberOfGroup($groupMemberData) {
        $this->db->insert("member_of_group",$groupMemberData);
    }


    function deleteMemberFromGroup($groupMemberData) {
        $this->db->delete("member_of_group",$groupMemberData);
    }

    function deleteGroup($groupData) {
        $this->db->delete("group",$groupData);
    }


    function updateMember($updateInfo) {
        $this->db->update("member",$updateInfo,"powon_id = 5");
    }

}


