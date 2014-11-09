<?php

    foreach($groupInfo as $row) {
        $group_id = $row->group_id;
        $owner_id = $row->powon_id;
        $group_name = $row->name;
        $group_description = $row->description;
    }

    $session_id = $this->session->userdata('powon_id');

?>

<section>
    <h2>Group Options</h2>
    <ul>
        <li><?php echo anchor('home', 'Create Thread'); ?></li>
            <?php if($owner_id != $session_id)
                { echo "<li>". anchor("controller_group/leaveGroup/$group_id/$session_id", 'Leave Group') . "</li>";}
            ?>
        </ul>
    <?php
        if ($owner_id == $session_id) {
            echo "<h2>Owner Options</h2>";
            echo "<ul>";
                echo "<li>" . anchor("controller_group/groupJoinRequestPage/$group_id", 'View Join Requests') . "</li>";
                echo "<li>" . anchor("controller_group/groupInviteRequestPage/$group_id", 'Invite Member') . "</li>";
                echo "<li>" . anchor("controller_group/deleteGroup/$group_id", 'Delete Group') . "</li>";

                //not yet implemented
                echo "<li>" . anchor('home', 'Manage Thread Access') . "</li>";
            echo "<ul>";
            }
    ?>

</section>

<section>
    <h2>Group Info</h2>
    <?php

        echo "Group Name: " . $group_name;
        echo "<br>";
        echo "Group Description: " . $group_description;
        echo "<br>";
        echo "Group Owner: " . $owner_id;
        echo "<br>";
    ?>
</section>

<section>
    <h2>Group Threads</h2>
</section>



<section>
    <h2>Members In Group</h2>
    <?php

    //implement username as link to view their profile
    foreach($groupMemberInfo as $row) {
        $username = $row->username;
        $powon_id = $row->powon_id;
        if ($owner_id == $session_id && $owner_id != $powon_id) {
            echo form_open("controller_group/removeFromGroup/$group_id/$powon_id");
            echo "<li>" . anchor("controller_member/viewMemberProfilePage/$powon_id", "$username") . "   " .
                 form_submit('submit','Remove Member')."</li>";
            echo form_close();
        } else {
            echo "<li>" . anchor("controller_member/viewMemberProfilePage/$powon_id", "$username") . "</li>";
            echo "<br>";
        }
    }
    ?>
</section>