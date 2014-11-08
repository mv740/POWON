<?php
class model_Request extends CI_Model{

    function insertRequest($requestData) {
        $this->db->insert("request",$requestData);
        return $this->db->insert_id();
    }
}