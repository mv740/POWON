<?php
class model_Request extends CI_Model{

    function getGroupJoinRequests($group_id) {
        $sql = "SELECT * FROM join_request INNER JOIN member
                ON join_request.powon_id = member.powon_id AND group_id = '$group_id'";
        $query = $this->db->query($sql);
        return $query->result();
    }


    function insertRequest($requestData) {
        $this->db->insert("join_request",$requestData);
    }

    function deleteRequest($memberAndGroupId) {
        $this->db->delete('join_request', $memberAndGroupId);

    }

    function authenticateRequest($requestData){
        $groupQuery = $this->db->get_where('member_of_group', $requestData);
        $requestQuery = $this->db->get_where('join_request', $requestData);

        if($groupQuery->num_rows() == 0 && $requestQuery->num_rows() == 0 ) {
            return true;
        } else {
            return false;
        }
    }
}