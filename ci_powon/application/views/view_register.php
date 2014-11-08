<?php echo form_open('controller_member/authenticateRegistration'); ?>
    <fieldset>
        <legend>Existing Member Details</legend>
        <label>First Name</label>
        <input type = "text" name = "existing_member_first_name"/><br>
        <label>Email</label>
        <input type = "text" name = "existing_member_email"/><br>
        <label>Date of Birth (yyyy-mm-dd)</label>
        <input type = "text" name = "existing_member_dob"/>
    </fieldset>
    <fieldset>
        <legend>Login Details</legend>
        <label>Username</label>
        <input type = "text" name = "username"/><br>
        <label>Password</label>
        <input type = "password" name = "password"/><br>
        <label>Retype Password</label>
        <input type = "password" name = "retyped_password"/>
    </fieldset>
    <fieldset>
        <legend>User Data</legend>
        <label>First Name</label>
        <input type = "text" name = "first_name"/><br>
        <label>Last Name</label>
        <input type = "text" name = "last_name"/><br>
        <label>Address</label>
        <input type = "text" name = "address"/><br>
        <label>Email</label>
        <input type = "text" name = "email"/><br>
        <label>Date of Birth (yyyy-mm-dd)</label>
        <input type = "text" name = "dob"/><br>
        <label>Description</label><br>
        <textarea name = "description" rows = "5" cols = "50"></textarea>
    </fieldset><br>
    <input type = "submit" value = "Submit"/>
    <input type = "reset" value = "Reset"/>
<?php echo validation_errors(); ?>
</form>