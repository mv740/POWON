<?php
$attributes = array('role' => 'form', 'class'=> 'form-horizontal');
?>

<div class="container" style="width: 600px" xmlns="http://www.w3.org/1999/html">




    <?php echo form_open('controller_account/authenticateRegistration', $attributes); ?>
    <fieldset>
        <legend>Existing Member Details</legend>
        <div class="form-group">
            <label class="col-sm-3 control-label">First Name</label>
            <div class="col-sm-9">
                <input type = "text" name = "existing_member_first_name" class="form-control"/>
                <br/>
                <?php if(form_error('existing_member_first_name') == true)
                {
                    echo '<div class="form-control alert-danger text-center">' .form_error('existing_member_first_name') .'</div>';
                } ?>
            </div>

        </div>
        <div class="form-group">
            <label class="col-sm-3 control-label">Email</label>
            <div class="col-sm-9">
                <input type = "text" name = "existing_member_email" class="form-control"/>
                <br/>
                <?php if(form_error('existing_member_email') == true)
                {
                    echo '<div class="form-control alert-danger text-center">' .form_error('existing_member_email') .'</div>';
                } ?>
            </div>

        </div>
        <div class="form-group">
            <label class="col-sm-3 control-label">Date of Birth <br/>(yyyy-mm-dd)</label>
            <div class="col-sm-9">
                <input type = "text" name = "existing_member_dob" class="form-control"/>
                <br/>
                <?php if(form_error('existing_member_dob') == true)
                {
                    echo '<div class="form-control alert-danger text-center">' .form_error('existing_member_dob') .'</div>';
                } ?>
            </div>
        </div>
    </fieldset>
    <br/>
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
                    echo '<div class="form-control alert-danger text-center">' .form_error('password') .'</div>';
                } ?>
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-3 control-label">Retype Password</label>
            <div class="col-sm-9">
                <input type = "password" name = "retyped_password" class="form-control"/>
                <br/>
                <?php if(form_error('retyped_password') == true)
                {
                    echo '<div class="form-control alert-danger text-center">' .form_error('retyped_password') .'</div>';
                } ?>
            </div>
        </div>

    </fieldset>
    <br/>
    <fieldset>
        <legend>User Data</legend>
        <div class="form-group">
            <label class="col-sm-3 control-label">First Name</label>
            <div class="col-sm-9">
                <input type = "text" name = "first_name" class="form-control"/>
                <br/>
                <?php if(form_error('first_name') == true)
                {
                    echo '<div class="form-control alert-danger text-center">' .form_error('first_name') .'</div>';
                } ?>
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-3 control-label">Last Name</label>
            <div class="col-sm-9">
                <input type = "text" name = "last_name" class="form-control"/>
                <br/>
                <?php if(form_error('last_name') == true)
                {
                    echo '<div class="form-control alert-danger text-center">' .form_error('last_name') .'</div>';
                } ?>
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-3 control-label">Address</label>
            <div class="col-sm-9">
                <input type = "text" name = "address" class="form-control"/>
                <br/>
                <?php if(form_error('address') == true)
                {
                    echo '<div class="form-control alert-danger text-center">' .form_error('address') .'</div>';
                } ?>
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-3 control-label">Email</label>
            <div class="col-sm-9">
                <input type = "text" name = "email" class="form-control"/>
                <br/>
                <?php if(form_error('email') == true)
                {
                    echo '<div class="form-control alert-danger text-center">' .form_error('email') .'</div>';
                } ?>
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-3 control-label">Date of Birth (yyyy-mm-dd)</label>
            <div class="col-sm-9">
                <input type = "text" name = "dob" class="form-control"/>
                <br/>
                <?php if(form_error('dob') == true)
                {
                    echo '<div class="form-control alert-danger text-center">' .form_error('dob') .'</div>';
                } ?>
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-3 control-label">Description</label>
            <div class="col-sm-9">
                <textarea name = "description" class="form-control" rows = "5" cols = "50"></textarea>
                <br/>
                <?php if(form_error('description') == true)
                {
                    echo '<div class="form-control alert-danger text-center">' .form_error('description') .'</div>';
                } ?>
            </div>
        </div>
    </fieldset>
    <br>
    <fieldset>
        <div class="form-group">
            <div class="col-sm-offset-3 col-sm-9">
                <input type = "submit" value = "register" class="btn btn-primary"/>
                <input type = "reset" value = "reset" class="btn btn-default"/>
            </div>
        </div>
    </fieldset>

    </form>


</div>

