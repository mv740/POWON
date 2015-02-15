<?php
class Model_thread extends CI_Model{

    function getAllThreads() {
        $sql = "SELECT * FROM `thread`";
        $query = $this->db->query($sql);
        return $query->result();
    }
    //check for restriction status
    function getAllGroupThreads($group_id, $powon_id) {
        $sql = "SELECT thread.name, thread.thread_id
                FROM thread
                INNER JOIN member_has_thread_access
                ON thread.group_id = '$group_id'
                AND thread.thread_id = member_has_thread_access.thread_id
                AND member_has_thread_access.restriction <> 'restricted'
                AND member_has_thread_access.powon_id = '$powon_id'";
        $query = $this->db->query($sql);
        return $query->result();
    }

    //Get threads from all the members related groups, it will
    //not return threads where member has restricted access
    function getAllMembersGroupThreads($powon_id) {
        $sql = "SELECT *
                FROM thread
                INNER JOIN member_of_group
                ON thread.group_id = member_of_group.group_id
                AND member_of_group.powon_id = '$powon_id'
                INNER JOIN member_has_thread_access
                ON thread.thread_id = member_has_thread_access.thread_id
                AND member_has_thread_access.restriction <> 'restricted'
                AND member_has_thread_access.powon_id = '$powon_id'";
        $query = $this->db->query($sql);
        return $query->result();
    }

    //get thread all data from thread
    
    function getThreadInfo($thread_id) {
        $sql = "SELECT thread.name, thread.author_id, `group`.`name`as group_name , `group`.group_id FROM `thread`
                INNER JOIN `group` WHERE `thread`.`group_id` = `group`.`group_id` AND thread_id = '$thread_id'";
        $query = $this->db->query($sql);
        return $query->result();
    }

    //get thread name
    function getThreadName($thread_id) {
        $sql = "SELECT name FROM `thread` WHERE thread_id = '$thread_id'";
        $query = $this->db->query($sql);
        return $query->result();
    }

    //Insert new thread
    function insertNewThread($threadData) {
        $this->db->insert("thread",$threadData);
        return $this->db->insert_id();
    }

    //delete thread
    function deleteThread($threadData) {
        $this->db->delete("thread",$threadData);
    }

    //set restrictions to thread access
    function insertNewThreadAccess($restrictionData) {
        $this->db->insert("member_has_thread_access",$restrictionData);
        return $this->db->insert_id();
    }


    function giveNewMemberThreadAccess($group_id,$powon_id){
        //find all threads in group
        $sql = "SELECT thread_id FROM thread WHERE group_id = '$group_id'";
        $query = $this->db->query($sql);

        if($query->num_rows > 0) {
            $result = $query->result();
            $restrictionData = array();
            $index = 0;

            //creating thread access data for each thread
            foreach($result as $row) {
                $restrictionData[$index] =
                    array(
                        'powon_id' => $powon_id,
                        'thread_id' => $row->thread_id,
                        'restriction' => 'unrestricted_comment'
                    );
                $index++;
            }
            $this->db->insert_batch('member_has_thread_access', $restrictionData);
        }
    }



    function checkThreadAccess($powon_id, $thread_id, $restriction){
        $sql = "SELECT * FROM member_has_thread_access WHERE powon_id = '$powon_id' AND thread_id = '$thread_id'";
        $query = $this->db->query($sql);
        if($query->num_rows() > 0){
            $this->updateThreadAccess($powon_id, $thread_id, $restriction);
        }else{

            $this->insertNewThreadAccess($restriction);
        }
    }

    function updateThreadAccess($powon_id, $thread_id, $restrictionData){
        $this->db->where('powon_id', $powon_id);
        $this->db->where('thread_id', $thread_id);
        $this->db->update('member_has_thread_access', $restrictionData);
    }

    function updateMember($updateInfo) {
        $this->db->update("member",$updateInfo,"powon_id = 5");
    }

    //check if thread author or admin
    function getThreadAccessUser($thread_id) {
        $sql = "SELECT member.powon_id FROM member
        INNER JOIN thread
        ON thread.thread_id = '$thread_id'
        AND (thread.author_id = member.powon_id OR member.privilege = 'admin')
        ";
        $query = $this->db->query($sql);
        return $query->result();
    }

    //function
    function checkCanComment($thread_id, $powon_id) {
        $sql = "SELECT * from member_has_thread_access
                WHERE thread_id = $thread_id
                AND powon_id = $powon_id
                AND restriction = 'unrestricted_comment'";

        $query =$this->db->query($sql);

        if($query->num_rows() > 0) {
            return true;
        } else {
            return false;
        }

    }
}