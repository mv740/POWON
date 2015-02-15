<div class="container">
    <section >
        <div class="col-sm-3"></div>
        <div class="col-sm-6">
            <?php
            foreach($result as $row) {
                echo "<div class='panel panel-default'>";
                echo '<div class="panel-body">';
                echo form_fieldset();
                $powon_id = $row->powon_id;
                //test
                echo "Powon_id: " . $row->powon_id;
                echo "<br>";

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

                echo form_open("controller_admin/updateMemberPrivilegeStatus/$powon_id");
                echo "PRIVILEGE: ";
                echo form_radio('privilege', 'admin', $row->privilege == "admin");
                echo " ADMIN ";
                echo form_radio('privilege', 'member', $row->privilege == "member");
                echo " MEMBER ";
                echo "<br>";
                echo "STATUS: ";
                echo form_radio('status', 'active', $row->status == "active");
                echo " ACTIVE ";
                echo form_radio('status', 'inactive', $row->status == "inactive");
                echo " INACTIVE ";
                echo form_radio('status', 'suspended', $row->status == "suspended");
                echo " SUSPENDED ";

                echo '<div class="row">';
                echo "</br>";
                echo "<div class='col col-sm-4'>";
                    echo form_submit('submit','Update Member');
                    echo form_close();
                echo "</div>";
                echo "<div class='col col-sm-4'>";
                    echo form_open("controller_admin/deleteMember/$powon_id");
                    echo form_submit('submit','Delete Member');
                    echo form_close();
                echo "</div>";
                echo "</div>";

                echo form_fieldset_close();
                echo '</div>';
                echo '</div>';
            }
            ?>
        </div>
        <div class="col-sm-3"></div>

    </section>
</div>
