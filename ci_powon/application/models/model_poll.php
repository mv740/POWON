<?php
class Model_poll extends CI_Model{

function insertNewPoll($pollData) {
        $this->db->insert("poll", $pollData);
        return $this->db->insert_id();
    }

}