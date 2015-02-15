<div class="container" >
    <section>
        <div class="col-sm-4"></div>
        <div class="col-sm-4">
            <?php
            foreach($allGroups as $row) {
                $group_id = $row->group_id;
                $attributes = array('role' => 'form', 'class'=> 'form-horizontal');
                echo "<div class='panel panel-default'>";
                echo '<div class="panel-body">';
                echo form_open("controller_group/createJoinRequest/$group_id", $attributes);
                echo "<div class='form-group text-center'>"
                    . '<label class=" control-label text-center ">First Name :</label>'
                     ." ".$row->name
                    ."</div>";
                echo "<div class='form-group text-center'>"
                    . '<label class=" control-label text-center">Description : </label>'
                    ." ".$row->description
                    ."</div>";
                echo "<div class='form-group'>";
                echo "<div class='text-center'>";

                echo form_submit('submit','Send Join Group Request' );
                echo "<br>";
                echo form_close();
                echo "</div>";

                echo"</div>";
                echo "</div>";
                echo '</div>';

            }
            ?>
        </div>
        <div class="col-sm-4"></div>

    </section>
</div>
