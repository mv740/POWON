<div class="container">
    <?php

    foreach($groupJoinRequests as $row) {
        $powon_id = $row->powon_id;
        $username = $row->username;

        echo form_open("controller_group/acceptJoinRequest/$group_id/$powon_id");
        echo " Request To Join From: ";
        echo "<br>";
        echo "Username: ".anchor("controller_member/viewMemberProfilePage/$powon_id", "$username");
        echo "<br>";
        echo "<br>";
        echo form_submit('submit','Accept ');
        echo form_close();
        echo form_open("controller_group/declineJoinRequest/$group_id/$powon_id");
        echo form_submit('submit','Decline ');
        echo form_close();
        echo "<br><br>";
    }
    ?>
</div>
