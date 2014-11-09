
<?php echo form_open("controller_group/authenticateGroupInvite/$group_id"); ?>
    <fieldset>
        <legend>Existing Member Details</legend>
        <label>Powon ID</label>
        <input type = "text" name = "existing_member_powon_id"/><br>
        <label>Email</label>
        <input type = "text" name = "existing_member_email"/><br>
        <label>Address</label>
        <input type = "text" name = "existing_member_address"/><br>
        <label>First Name</label>
        <input type = "text" name = "existing_member_first_name"/><br>
        <label>Date Of Birth</label>
        <input type = "text" name = "existing_member_dob"/><br>
    </fieldset><br>
    <input type = "submit" value = "Submit"/>
</form>
<?php echo validation_errors(); ?>

