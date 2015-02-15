<?php
class model_Admin extends CI_Model{

    function updateMemberPrivilegeStatus($updateInfo,$powon_id) {
        $this->db->update("member",$updateInfo,"powon_id = $powon_id");
    }

    function deleteMember($memberData) {
        $this->db->delete("member",$memberData);
    }

    function insertNewPublicPost($postData) {
        $this->db->insert("public_post",$postData);
    }

    function getPublicPosts() {
        $sql = "SELECT * FROM public_post INNER JOIN `member`
                ON public_post.admin_id = member.powon_id
                ORDER BY date DESC";
        $query = $this->db->query($sql);
        return $query->result();
    }

    //NEW AFTER DEMO THIS STUFF IS NEW
    function getPublicPostContent($public_post_id){
        $sql = "SELECT content FROM public_post WHERE public_post_id = $public_post_id";
        $query = $this->db->query($sql);
        return $query->result();
    }

    function updatePublicPostContents($updateInfo){
        $this->db->update("public_post",$updateInfo);
    }
    //NEW STUFF FROM AFTER DEMO ENDED BEFORE THIS
    
    //is User a Admin
    function isAdmin($powon_id)
    {
        $sql = "SELECT * FROM member where powon_id = $powon_id AND privilege = 'admin'";
        $query = $this->db->query($sql);
        if($query->num_rows() > 0) {
            //user is admin
            return true;
        } else {
            //user is not admin
            return false;
        }
    }
    //delete a public post // must be a admin
    function deletePublicPost($data)
    {
       // $this->db->where('public_post_id', $data);
        $this->db->delete("public_post", $data);
    }


     //Reports Stuff

     function getReportInterests(){

        $sql = "SELECT `interests`, COUNT(*) `count` FROM `member_interests` GROUP BY `interests`";
        $query = $this->db->query($sql);
        return $query->result();
        
    }
    function getReportProfession(){

        $sql = "SELECT `profession`, COUNT(*) `count` FROM `member` GROUP BY `profession`";
        $query = $this->db->query($sql);
        return $query->result();
        
    }

            //UPDATES CODE AFTER DEMO BEGINS HERE END AT END OF DOCUMENT DDDUUHHHH!!!!

    function getNumberOfGroups(){

        $sql = "SELECT COUNT(*) 'count' FROM final.group";
        $query = $this->db->query($sql);
        return $query->result();
        
    }
    function getNumberOfMembers(){

        $sql = "SELECT COUNT(*) 'count' FROM final.member";
        $query = $this->db->query($sql);
        return $query->result();
        
    }
     function getNumberOfThreads(){

        $sql = "SELECT COUNT(*) 'count' FROM final.thread";
        $query = $this->db->query($sql);
        return $query->result();
        
    }
    function getNumberOfPosts(){

        $sql = "SELECT COUNT(*) 'count' FROM final.post";
        $query = $this->db->query($sql);
        return $query->result();
        
    }
     function getAverageAge(){

        $sql = "SELECT AVG( YEAR(now()) - YEAR(dob)) as avg_age  FROM final.member WHERE dob IS NOT NULL";
        $query = $this->db->query($sql);
        return $query->result();
        
    }

    function getGroupStats(){
        $sql = "SELECT `group`.`name`, `group`.`description`, `member`.`username`, COUNT(*) AS memberCount FROM`member_of_group` INNER JOIN `group` INNER JOIN `member` WHERE `member_of_group`.`group_id` =`group`.`group_id` AND `member`.`powon_id` = `group`.`owner_id` GROUP BY `group`.`group_id` ";
        $query = $this->db->query($sql);
        return $query->result();
        
    }

    function getUsersStats(){
        $sql = "SELECT member.username , igptc.GroupCount, igptc.ThreadCount, igptc.PostCount, igptc.InterestCount,
COUNT(CASE WHEN ffc.friend = true THEN 1 END) AS FriendCount,
COUNT(CASE WHEN ffc.family = true THEN 1 END) AS FamilyCount,
COUNT(CASE WHEN ffc.colleague = true THEN 1 END) AS ColleagueCount
FROM member
LEFT OUTER JOIN final.member_relates_member ffc ON ffc.powon_id = member.powon_id 
    
        LEFT OUTER JOIN(SELECT member.username, gptc.GroupCount, gptc.ThreadCount, gptc.PostCount, member.powon_id,
        COUNT(ic.powon_id) AS InterestCount
        FROM member
        LEFT OUTER JOIN final.member_interests ic ON ic.powon_id = member.powon_id

            LEFT OUTER JOIN (SELECT member.username, ptc.ThreadCount, ptc.PostCount, member.powon_id,
            COUNT(gc.powon_id) AS GroupCount
            FROM member
            LEFT OUTER JOIN final.member_of_group gc ON gc.powon_id = member.powon_id

                LEFT OUTER JOIN(SELECT member.username, tc.ThreadCount, tc.powon_id,
                COUNT(pc.author_id) AS PostCount
                FROM member
                LEFT OUTER JOIN final.post pc ON pc.author_id = member.powon_id

                    LEFT OUTER JOIN(SELECT member.username, member.powon_id, 
                    COUNT(tc.author_id) AS ThreadCount
                    FROM member
                    LEFT OUTER JOIN final.thread tc ON tc.author_id = member.powon_id 

                    GROUP BY member.powon_id 
                    ORDER BY member.powon_id)AS tc ON tc.powon_id = member.powon_id

            GROUP BY member.powon_id 
            ORDER BY member.powon_id) AS ptc ON ptc.powon_id = member.powon_id


        GROUP BY member.powon_id 
        ORDER BY member.powon_id) AS gptc ON gptc.powon_id = member.powon_id

        GROUP BY member.powon_id 
        ORDER BY member.powon_id) AS igptc ON igptc.powon_id = member.powon_id

GROUP BY member.powon_id 
ORDER BY member.powon_id
 ";
        $query = $this->db->query($sql);
        return $query->result();
        
    }
}

