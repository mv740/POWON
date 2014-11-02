
<section>
  <?php


        foreach($allGroups as $row) {
            echo "Name: " . $row->name;
            echo "<br>";
            echo "Description: " . $row->description;
            echo "<br><br>";
        }

  ?>
</section>