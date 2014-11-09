
<section>
  <?php
        foreach($allGroups as $row) {
            $group_id = $row->group_id;
            echo form_open("controller_group/createJoinRequest/$group_id");
            echo "Name: " . $row->name;
            echo "<br>";
            echo "Description: " . $row->description;
            echo "<br>";
            echo form_submit('submit','Send Join Group Request');
            echo "<br><br>";
            echo form_close();
        }
  ?>
</section>