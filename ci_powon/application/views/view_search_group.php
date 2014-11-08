
<section>
  <?php

        //request not yet implemented
        //bug displays "send join group request" button for groups already a member of and groups already requested to join
        foreach($allGroups as $row) {
            $reciever_id = $row->powon_id;
            $group_id = $row->group_id;
            $type = "group_join";
            echo form_open("controller_request/createRequest/$type/$reciever_id/$group_id");
            echo "Name: " . $row->name;
            echo "<br>";
            echo "Description: " . $row->description;
            echo "<br>";
            echo "Owner id: " . $reciever_id;
            echo "<br>";
            echo "Group id: " . $group_id;
            echo "<br>";
            echo form_submit('submit','Send Join Group Request');
            echo "<br><br>";
            echo form_close();
        }
  ?>
</section>