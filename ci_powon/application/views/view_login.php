
<?php echo form_open('controller_member/authenticateLogin'); ?>
    <fieldset>
        <legend>Login Details</legend>
        <label>Username</label>
        <input type = "text" name = "username"/><br>
        <label>Password</label>
        <input type = "password" name = "password"/><br>
    </fieldset><br>
    <input type = "submit" value = "Submit"/>
</form>
<?php echo validation_errors(); ?>

