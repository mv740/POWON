
<section>
    <?php


    foreach($result as $row) {
        echo "Username: " . $row->username;
        echo "<br>";
        echo "First Name: " . $row->first_name;
        echo "<br>";
        echo "Last name: " . $row->last_name;
        echo "<br>";
        echo "Address: " . $row->address;
        echo "<br>";
        echo "Date of Birth: " . $row->dob;
        echo "<br>";
        echo "Description: " . $row->description;
        echo "<br><br>";
    }

    ?>
</section>