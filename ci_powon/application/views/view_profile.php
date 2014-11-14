
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

<section>
    <?php if ($self) : ?>
    <h2>Relationships</h2>
    <?php echo form_open('controller_member/checkRelation'); ?>
    <fieldset>
        <legend>Update Relation</legend>
        <select name="member">
        <option value="">--- Select ---</option>
        <?php
        foreach($membersList as $row) {
            echo "<option value='$row->powon_id'>$row->username - $row->powon_id</option>";
        }
        ?>
        </select><br>
        Friend:
        <select name = "friend">
            <option value="0">No</option>
            <option value="1">Yes</option>
            
        </select>
        Family:
        <select name = "family">
            <option value="0">No</option>
            <option value="1">Yes</option>
            
        </select>
        Colleague:
        <select name = "colleague">
            <option value="0">No</option>
            <option value="1">Yes</option>
            
        </select>
         <input type = "submit" value = "Update"/>
    </fieldset>
    <?php endif; ?>

    <h3>Friends</h3>
    <ul>
        <?php
            foreach($friends as $row){
                echo "<li>" . anchor("controller_member/viewMemberProfilePage/$row->powon_id", "$row->first_name $row->last_name") . "</li>";
               // echo $row->first_name;
               // echo " ";
               // echo $row->last_name;
               // echo "<br>";
            }
        ?>
    </ul>
    <h3>Family</h3>
    <ul>
        <?php
            foreach($family as $row){
                echo "<li>" . anchor("controller_member/viewMemberProfilePage/$row->powon_id", "$row->first_name $row->last_name") . "</li>";
                //echo $row->first_name;
               // echo " ";
               // echo $row->last_name;
               // echo "<br>";
            }
        ?>
    </ul>
    <h3>Colleagues</h3>
    <ul>
        <?php
            foreach($colleagues as $row){
                echo "<li>" . anchor("controller_member/viewMemberProfilePage/$row->powon_id", "$row->first_name $row->last_name") . "</li>";
                //echo $row->first_name;
               // echo " ";
              //  echo $row->last_name;
               // echo "<br>";
            }
        ?>
    </ul>
</section>