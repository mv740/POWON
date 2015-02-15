<div class="container">
    <section>
        <div class="col-sm-4"></div>
        <div class="col-sm-4">
            <?php
            foreach($result as $row)
            {
                echo "<div class='panel panel-default'>";
                echo '<div class="panel-body">';
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
                echo "</div>";
                echo "</div>";
            }
            ?>
        </div>
        <div class="col-sm-4"></div>

    </section>
    </div>
