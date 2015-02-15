<?php
class Model_post extends CI_Model{

    //returns all posts
    function getAllPosts() {
        $sql = "SELECT * FROM `post`";
        $query = $this->db->query($sql);
        return $query->result();
    }

    //Returns all posts related to the specified thread.
    //Also Inner join with member to get username.
    function getAllThreadPosts($thread_id) {
        $sql = "SELECT *
                FROM `post`  INNER JOIN `member`  WHERE post.thread_id = '$thread_id'
                AND post.author_id = member.powon_id ORDER BY post.post_id";
        $query = $this->db->query($sql);
        return $query->result();
    }

    //Returns all information from a post
    function getPostInfo($post_id) {
        $sql = "SELECT *
                FROM `post`  INNER JOIN `member`  ON post_id = '$post_id'
                AND post.author_id = member.powon_id ";
        $query = $this->db->query($sql);
        return $query->result();
    }

    //Inserts a new post
    function insertNewPost($postData) {
        $this->db->insert("post",$postData);
        return $this->db->insert_id();
    }

    //Deletes Post
    function deletePost($postData) {
        $this->db->delete("post",$postData);
    }

    //NEW AFTER DEMO THIS STUFF IS NEW
    function getPostContent($post_id){
        $sql = "SELECT content FROM post WHERE post_id = $post_id";
        $query = $this->db->query($sql);
        return $query->result();
    }

    function updatePostContents($updateInfo, $post_id){
        $this->db->update("post",$updateInfo, "post_id = $post_id");
    }
    //NEW STUFF FROM AFTER DEMO ENDED BEFORE THIS
}