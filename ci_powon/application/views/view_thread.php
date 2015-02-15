<div class="container">


    <?php foreach($threadInfo as $row) { 

        $group_id = $row->group_id;
        $group_name = $row->group_name;
        $thread_name = $row->name;
        $author_id = $row->author_id;
         }
        
    $session_id = $this->session->userdata('powon_id');
    ?>

    <ol class="breadcrumb">
        <li><?php echo anchor("controller_member", 'Home');?></li>
        <li><?php echo anchor("controller_group/groupPage/$group_id", "$group_name");?></li>
        <li class="active"><?php echo $thread_name;?></li>
    </ol>



    <section>
        <?php
        $valid = false;
        foreach($AuthorOrAdmin as $row) {
            if ($session_id == $row->powon_id) {
                $valid = true;
            }
        }

        if ($valid) {
            echo "<h2>Thread Author Options</h2>";
            echo "<ul>";
            echo "<li>" . anchor("controller_thread/threadAccessPage/$group_id/$author_id/$thread_id/$session_id", 'Manage Thread Access') . "</li>";
            echo "<ul>";
        }
        ?>

    </section>
    <section>
        <h2>Posts</h2>

        <div class="col-sm-3"></div>
        <div class="col-sm-6">
            <?php

            //loop through to show posts
            // put a foreach that goes through list of threads related to this group

            foreach($postInfo as $row) {
                $username = $row->username;
                $date = $row->date;
                $postMessage = $row->content;
                $id = $row->post_id;
                $postAuthor_id = $row->author_id;
                $attributes = array( 'name' =>$row->post_id);

                echo  '<div class="panel panel-primary">'
                            .'<div class="panel-heading">';
                         echo    '<label class="control-label">Posted by : </label>' .$username .'</br>'
                                .'<label class="control-label">Date : </label>' . $date
                            .'</div>'
                            .'<div class="form-group">';

                echo $postMessage ;

                echo '</br>';
                //echo '<img src="' .base_url() .'uploads/' .$row->upload .'" alt="image">';
                if($row->upload_type == '.jpg' || $row->upload_type == '.gif' || $row->upload_type == '.png'  )
                {
                    echo '<img width="320" height="240"  src="' .'https://clipper.encs.concordia.ca/~lfc353_2/ci_powon/uploads/' .$row->upload .'" alt="image">';
                }
                if($row->upload_type == '.mp4')
                {
                    echo '<video width="320" height="240" controls>'
                        .'<source src="'.'https://clipper.encs.concordia.ca/~lfc353_2/ci_powon/uploads/' .$row->upload .'">' .'</video>';
                }

                echo "</td></table></li><br>";
                if($isAdmin == true || $session_id == $postAuthor_id)
                {
                    echo  "<div class='text-right'>"
                        // .$row->public_post_id

                        //This is the added EDIT BUTTON
                        .form_open('controller_thread/editPostPage/'.$id.'/'.$thread_id.'/'.$group_id, $attributes)
                        .form_hidden('editPostData', $row->post_id)
                        .'<button type="submit" class="btn btn-danger"' .'name="' .$row->post_id.'">
                            <i class="glyphicon glyphicon-edit"></i>
                        </button>'
                        .'</form>'
                        //THIS IS THE END OF THE ADDED EDIT BUTTON

                        //This is the added DELETE BUTTON
                        .form_open('controller_thread/deletePost/'.$id.'/'.$thread_id.'/'.$group_id, $attributes)
                        .form_hidden('postData', $row->post_id)
                        .'<button type="submit" class="btn btn-danger"' .'name="' .$row->post_id.'">
                            <i class="glyphicon glyphicon-remove"></i>
                        </button>'
                        .'</form>'
                        //THIS IS THE END OF THE ADDED DELETE BUTTON
                        .'</div>';
                }
                echo '</div>';
                echo '</div>';

            }
            ?>


            <?php
            //anchor add post


            if ($postCapability )
            {

                echo form_open_multipart("controller_post/createPost/$group_id/$thread_id");

                echo
                "<fieldset>
                <div class='form-group'>
                <legend>Add Post</legend>
                <label class='col-sm-3 control-label'>Post </label>
                <div class='col-sm-9'>
                    <textarea name = 'post' rows = '5' cols = '50' class='form-control'></textarea>
                    <br/>
                </div>
                </div>
            </fieldset><br>
                <div class='form-group'>
                <label class='col-sm-3 control-label'>Upload </label>
                    <div class=' col-sm-6'>
                        <input type='file' name='userfile' title='Browse'  /> </br>
                        <input type = 'submit' value = 'Submit' class='btn btn-default'/>
                    </div>
                </div>
            </form>";
            }
            ?>
        </div>
        <div class="col-sm-3"></div>

    </section>
</div>




