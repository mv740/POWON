
<nav>
    <h2>Member Options</h2>
    <ul>
        <!-- addd control for status and privilege-->
        <li><?php echo anchor('controller_member/viewProfile', 'View Profile'); ?></li>
        <li><?php echo anchor('controller_group/createGroupPage', 'Create Group'); ?></li>
        <li><?php echo anchor('controller_group/searchGroups','Search Groups'); ?></li>
        <li><?php echo anchor('controller_member/searchMembers', 'Search Members'); ?></li>
        <li><?php echo anchor('home', 'View Requests'); ?></li>
        <li><?php echo anchor('home', 'View Emails'); ?></li>
        <li><?php echo anchor('home', 'Send Email'); ?></li>
        <li><?php echo anchor('home', 'Privacy Settings'); ?></li>
    </ul>
    <?php
        if($this->session->userdata('privilege') == "admin") {
            echo "<h2>Admin Options</h2>";
            echo "<ul>";
                echo "<li>" . anchor('home', 'Public Post') . "</li>";
                echo "<li>" . anchor('home', 'Delete Member') . "</li>";
                echo "<li>" . anchor('home', 'Change Member Status') . "</li>";
                echo "<li>" . anchor('home', 'Change Member Privilege') . "</li>";
                echo "<li>" . anchor('home', 'Delete Group') . "</li>";
            echo "<ul>";
        }
    ?>
</nav>

<section>
    <h2>Posts</h2>
</section>

<section>
    <h2>Relationships</h2>
    <h3>Friends</h3>
    <h3>Family</h3>
    <h3>Colleagues</h3>
</section>

<section>
    <h2>Groups</h2>
    <ul>
        <?php
        foreach($memberOfGroup as $row) {
            $group_id = $row->group_id;
            $name = $row->name;
            echo "<li>" . anchor("controller_group/loadGroupPage/$group_id", "$name") . "</li>";;

        }
        ?>




    </ul>


</section>




