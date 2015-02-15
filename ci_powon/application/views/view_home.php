<div class="container">
    <div class="row">
        <div class="col-sm-4">
            <nav>
                <h2>Member Options</h2>
                <ul class="nav nav-stacked">
                    <li role="presentation" class="">
                        <?php echo  anchor('controller_member/viewProfilePage', 'View Profile'); ?>
                    </li>
                    <li role="presentation">
                        <?php echo  anchor('controller_group/createGroupPage', 'Create Group'); ?>
                    </li>
                    <li role="presentation">
                        <?php echo anchor('controller_group/searchGroupsPage','Search Groups'); ?>
                    </li>

                    <li role="presentation" class="">
                        <?php echo anchor('controller_member/searchMembersPage', 'Search Members'); ?>
                    </li>
                </ul>
            </nav>
            <?php if ($this->session->userdata('privilege') == "admin"): ?>
                <nav>
                    <h2>Admin Options</h2>
                    <ul class="nav nav-stacked">
                        <li role="presentation" class="">
                            <?php echo  anchor('controller_admin/createPublicPostPage', 'Create Public Post'); ?>
                        </li>
                        <li role="presentation">
                            <?php echo  anchor('controller_admin/editDeleteMembersPage', 'Edit/Delete Member'); ?>
                        </li>
                        <li role="presentation">
                            <?php echo anchor('controller_admin/reportsPage', 'Reports Page'); ?>
                        </li>

                        <li role="presentation" class="">
                            <?php echo anchor('home', 'Edit/Delete Group'); ?>
                        </li>
                    </ul>
                </nav>
            <?php endif; ?>
            <nav>
                <h2>Groups</h2>
                <ul class="nav nav-stacked">
                    <?php foreach ($memberOfGroup as $row) : ?>
                        <li role="presentation" class="">
                            <?php
                            $group_id = $row->group_id;
                            $name = $row->name;
                            echo  anchor("controller_group/groupPage/$group_id", "$name");
                            ?>
                        </li>
                    <?php endforeach; ?>
                </ul>
            </nav>
        </div>
        <div class="col-sm-6">
            <?php
            echo "<h2>Public Posts</h2>";
            foreach($publicPosts as $row)
            {
                $attributes = array( 'name' =>$row->public_post_id);
                $id = $row->public_post_id;
                echo '<div class="panel panel-danger" >'
                    .'<div class="panel-heading">'
                    .'<h4 class="panel-title">'
                    ."<div class='row'>"
                    .'<div class="text-center">'
                    ." Admin Username: " .$username = $row -> username
                        . "</br>"
                        .' Time : ' .$currentDateTime = $row->date;;
                echo '</div>'

                    .'</div>'
                    .'</h4>'
                    .'</div>'
                    ."<div class='panel-body'>"

                    .$content = $row->content
                        .'</br>'
                        .'</br>';

                        if($isAdmin == true)
                        {
                          echo  "<div class='text-right'>"
                             // .$row->public_post_id

                          //This is the added EDIT BUTTON
                        .form_open('controller_admin/editPublicPostPage/'.$id, $attributes)
                        .form_hidden('postData', $row->public_post_id)
                        .'<button type="submit" class="btn btn-danger"' .'name="' .$row->public_post_id.'">
                            <i class="glyphicon glyphicon-edit"></i>
                        </button>'
                        .'</form>'
                        //THIS IS THE END OF THE ADDED EDIT BUTTON
                        
                        .form_open('controller_admin/deletePublicPost/'.$id, $attributes)
                        .form_hidden('postData', $row->public_post_id)
                        .'<button type="submit" class="btn btn-danger"' .'name="' .$row->public_post_id.'">
                            <i class="glyphicon glyphicon-remove"></i>
                        </button>'
                        .'</form>'
                        .'</div>';
                        }



                        echo "</div>"
                        .'</div>';


            }
            ?>
            <?php
            echo "<h2>Threads</h2>";
            foreach($membersGroupThreads as $row)
            {
                $threadName = $row->name;
                $thread_id = $row->thread_id;
                $group_id = $row->group_id;

                echo '<div class="panel panel-primary" >'
                    .'<div class="panel-heading">'
                    .'<h4 class="panel-title">'
                    ."<div class='row'>"
                    .'<div class="text-center">'
                    ."  Group: " .$group_id;
                echo '</div>'

                    .'</div>'
                    .'</h4>'
                    .'</div>'
                    ."<div class='panel-body text-center'>"

                    .$content = "Thread Name :".anchor("controller_thread/threadPage/$thread_id/$group_id", "$threadName")
                        ."</div>"
                        .'</div>';
            }
            ?>
        </div>
    </div>
</div>






