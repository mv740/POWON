
<?php echo form_open('controller_group/createGroup'); ?>
    <fieldset>
        <legend>Group Details</legend>
        <label>Group Name</label>
        <input type = "text" name = "name"/><br>
        <label>Group Description</label>
        <textarea name = "description" rows = "5" cols = "50"></textarea>
    </fieldset><br>
    <input type = "submit" value = "Submit"/>
</form>
