<div class="container">
<div class="row">

    <div class="col-sm-4">
        <h2>Member Info</h2>
        <?php
        foreach($result as $row) {

            echo "<div class='panel panel-default'>";
            echo '<div class="panel-body">';
            echo "Username: " . $row->username;
            echo "<br>";

            if($self  || $row->first_name_visibility == 'public' || ($row->first_name_visibility == 'group' && $isSameGroup))
            {
                echo "First Name: " . $row->first_name;
                echo "<br>";
            }
            if($self  || $row->last_name_visibility == 'public' || ($row->last_name_visibility == 'group' && $isSameGroup))
            {
                echo "Last Name: " . $row->last_name;
                echo "<br>";
            }  if($self  || $row->email_visibility == 'public' || ($row->email_visibility == 'group' && $isSameGroup))
            {
                echo "Email: " . $row->email;
                echo "<br>";
            }  if($self  || $row->address_visibility == 'public' || ($row->address_visibility == 'group' && $isSameGroup))
            {
                echo "Address: " . $row->address;
                echo "<br>";
            }  if($self  || $row->dob_visibility == 'public' || ($row->dob_visibility == 'group' && $isSameGroup))
            {
                echo "Date of Birth: " . $row->dob;
                echo "<br>";
            }  if($self  || $row->description_visibility == 'public' || ($row->description_visibility == 'group' && $isSameGroup))
            {
                echo "Description: " . $row->description;
                echo "<br>";
            }
            echo"</div>";
            echo"</div>";
        }
        ?>
        <br>

        <?php if ($self) : ?>

            <h2>Privacy Settings</h2>
            <?php echo form_open('controller_member/updatePrivacy'); ?>
            <fieldset>


                <?php foreach($result as $row){ ?>
                    First Name:

                    <input type="radio" name="fnameprivacy" value="public" <?php echo ($row->first_name_visibility=='public')?'checked':'' ?>/>
                    Public
                    <input type="radio" name="fnameprivacy" value="group" <?php echo ($row->first_name_visibility=='group')?'checked':'' ?>/>
                    Group
                    <input type="radio" name="fnameprivacy" value="private" <?php echo ($row->first_name_visibility=='private')?'checked':'' ?>/>
                    Private<br>

                    Last Name:
                    <input type="radio" name="lnameprivacy" value="public" <?php echo ($row->last_name_visibility=='public')?'checked':'' ?>/>
                    Public
                    <input type="radio" name="lnameprivacy" value="group"<?php echo ($row->last_name_visibility=='group')?'checked':'' ?>/>
                    Group
                    <input type="radio" name="lnameprivacy" value="private"<?php echo ($row->last_name_visibility=='private')?'checked':'' ?>/>
                    Private<br>

                    Email:
                    <input type="radio" name="emailprivacy" value="public" <?php echo ($row->email_visibility=='public')?'checked':'' ?>/>
                    Public
                    <input type="radio" name="emailprivacy" value="group"<?php echo ($row->email_visibility=='group')?'checked':'' ?>/>
                    Group
                    <input type="radio" name="emailprivacy" value="private"<?php echo ($row->email_visibility=='private')?'checked':'' ?>/>
                    Private<br>

                    Address
                    <input type="radio" name="addressprivacy" value="public" <?php echo ($row->address_visibility=='public')?'checked':'' ?>/>
                    Public
                    <input type="radio" name="addressprivacy" value="group"<?php echo ($row->address_visibility=='group')?'checked':'' ?>/>
                    Group
                    <input type="radio" name="addressprivacy" value="private"<?php echo ($row->address_visibility=='private')?'checked':'' ?>/>
                    Private<br>

                    Date of Birth:
                    <input type="radio" name="dobprivacy" value="public" <?php echo ($row->dob_visibility=='public')?'checked':'' ?>/>
                    Public
                    <input type="radio" name="dobprivacy" value="group"<?php echo ($row->dob_visibility=='group')?'checked':'' ?>/>
                    Group
                    <input type="radio" name="dobprivacy" value="private"<?php echo ($row->dob_visibility=='private')?'checked':'' ?>/>
                    Private<br>

                    Description:
                    <input type="radio" name="descriptionprivacy" value="public" <?php echo ($row->description_visibility=='public')?'checked':'' ?>/>
                    Public
                    <input type="radio" name="descriptionprivacy" value="group"<?php echo ($row->description_visibility=='group')?'checked':'' ?>/>
                    Group
                    <input type="radio" name="descriptionprivacy" value="private"<?php echo ($row->description_visibility=='private')?'checked':'' ?>/>
                    Private
                <?php }?>
                <br>
                <br>
                <input type = "submit" value = "Update"/>
                <button type="reset" value="Reset">Reset</button>

            </fieldset>
            </form>
        <?php endif; ?>
    </div>
    <div class="col-sm-4"><section>
            <h2>Relationships</h2>

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
        </section></div>
    <div class="col-sm-4">

        <h2>Proffession</h2>
        <ul>
            <?php
            foreach($result as $row){
                echo "<li>"."$row->profession"."</li>";
            }
            ?>
        </ul>


    </div>
    <div class ="col-sm-4">
        <h2>Interests</h2>
        <ul>
            <?php
            foreach($interests as $row){
                echo form_open('controller_member/deleteInterest');
                echo "<li>"."$row->interests"."     "."<input type ='submit' value ='Delete'/>"."</li>";
                echo form_hidden('powon_id', $row->powon_id);
                echo form_hidden('interests', $row->interests);

                echo "</form>";
                echo "<br>";
            }
            ?>
        </ul>
    </div>




</div>
<br>
<div class ="row">

    <div class = "col-sm-5">

        <?php if ($self) : ?>
            <h2>Update Member Info</h2>
            <?php echo form_open('controller_member/checkRelation'); ?>
            <fieldset>

                <legend>Add/Update Relationship</legend>
                <select name="member">
                    <option value="">--- Select ---</option>
                    <?php
                    foreach($membersList as $row) {
                        echo "<option value='$row->powon_id'>$row->username</option>";
                    }
                    ?>
                </select>
                <br>
                <br>
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
                <br>
                <br>
                <input type = "submit" value = "Update"/>
            </fieldset>
            </form>
        <?php endif; ?>
        <br>
        <br>
        <?php if ($self) : ?>

            <?php echo form_open('controller_member/updateProfession'); ?>
            <fieldset>
                <legend>Update Proffession</legend>
                <select name="profession">
                    <option value="n/a">n/a</option>
                    <option value="student">Student</option>
                    <option value="teacher">Teacher</option>
                    <option value="doctor">Doctor</option>
                    <option value="manager">Manager</option>
                    <option value="astronaut">Astronaut</option>
                    <option value="fireman">Fireman</option>
                </select>
                <br>
                <br>
                <input type = "submit" value = "Update"/>
            </fieldset>
            </form>
        <?php endif; ?>
        <br>
        <br>
        <?php if ($self) : ?>

            <?php echo form_open('controller_member/addInterest'); ?>
            <fieldset>
                <legend>Add Interest</legend>
                <input type="textbox" name ="interest" value="Enter New Interest Here"/>
                <br>
                <br>
                <input type = "submit" value = "Add"/>
            </fieldset>
            </form>
        <?php endif; ?>




    </div>


</div>

