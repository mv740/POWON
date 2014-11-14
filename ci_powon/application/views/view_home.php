
<nav>
    <h2>Member Options</h2>
    <ul>
        <li><?php echo anchor('controller_member/viewProfilePage', 'View Profile'); ?></li>
        <li><?php echo anchor('controller_group/createGroupPage', 'Create Group'); ?></li>
        <li><?php echo anchor('controller_group/searchGroupsPage','Search Groups'); ?></li>
        <li><?php echo anchor('controller_member/searchMembersPage', 'Search Members'); ?></li>

        <!-- not yet implemented !-->
        <li><?php echo anchor('controller_email/emailPage', 'View Emails'); ?></li>
        <li><?php echo anchor('home', 'Privacy Settings'); ?></li>

    </ul>
    <?php
        //not implemented yet
        if($this->session->userdata('privilege') == "admin") {
            echo "<h2>Admin Options</h2>";
            echo "<ul>";
                echo "<li>" . anchor('home', 'Public Post') . "</li>";
                echo "<li>" . anchor('home', 'Change Member Status') . "</li>";
                echo "<li>" . anchor('home', 'Change Member Privilege') . "</li>";
                echo "<li>" . anchor('home', 'Delete Member') . "</li>";
                echo "<li>" . anchor('home', 'Delete Group') . "</li>";
            echo "<ul>";
        }
    ?>
</nav>

<section>
    <h2>Public Posts</h2>
    <h2>Threads</h2>
</section>

<section>
    <h2>Groups</h2>
    <ul>
        <?php
        foreach($memberOfGroup as $row) {
            $group_id = $row->group_id;
            $name = $row->name;
            echo "<li>" . anchor("controller_group/groupPage/$group_id", "$name") . "</li>";
            echo "<br>";
        }
        ?>
    </ul>
</section>




