r<?php
$attributes = array('role' => 'form', 'class'=> 'form-horizontal');
?>
<div class="container">
    <div class="row">
        <div class="col-md-3"></div>
        <div class="col-md-6">
            <?php echo form_open('controller_account/authenticateLogin', $attributes); ?>
            <fieldset>
                <legend>Login Details</legend>
                <div class="form-group">
                    <label class="col-sm-3 control-label">Username</label>

                    <div class="col-sm-9">
                        <input type = "text" name = "username" class="form-control"/>
                        <br/>
                        <?php if(form_error('username') == true)
                        {
                            echo '<div class="form-control alert-danger text-center">' .form_error('username') .'</div>';
                        } ?>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-3 control-label">Password</label>

                    <div class="col-sm-9">
                        <input type = "password" name = "password" class="form-control"/>
                        <br/>
                        <?php if(form_error('password') == true)
                        {
                            echo '<div class="form-control alert-danger text-center" >' .form_error('password') .'</div>';
                        } ?>
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-sm-offset-3 col-sm-9">
                        <input type = "submit" value = "Sign In" class="btn btn-primary"/>
                    </div>
                </div>
            </fieldset>

            </form>
            <legend>New User</legend>
            <div class="form-group">
                <div class="col-sm-offset-3 col-sm-9">
                    <?php

                    echo '<h4>' .anchor('controller_account/registerPage', 'register', 'title="register link"') .'</h4>' ?>

                </div>
            </div>

        </div>
        <div class="col-md-3"></div>
    </div>
</div>