
<section>
    <h2>Group Info</h2>
    <?php
    foreach($groupInfo as $row) {
        echo "Group Name: " . $row->name;
        echo "<br>";
        echo "Group Description: " . $row->description;
        echo "<br>";
        echo "Group Owner: " . $row->owner_id;
        echo "<br>";
    }

    ?>
</section>

<section>
    <h2>Threads</h2>
    <?php
        /**
        ADD THREADS
        foreach($groupInfo as $row) {
            echo "Group Name: " . $row->name;
            echo "<br>";
            echo "Group Description: " . $row->description;
            echo "<br>";
            echo "Group Owner: " . $row->owner_id;
            echo "<br>";
    }
        **/
    ?>

</section>

<section>
    <h2>Members In Group</h2>
    <?php
    foreach($groupMemberInfo as $row) {
        echo "Member Name: " . $row->username;
        echo "<br>";
    }
    ?>
</section>