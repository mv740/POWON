<?php echo form_open('controller_email/sendCreatedEmail'); ?>
<fieldset>
    <legend>Email Details</legend>
    <label>Sent: </label>

    <select name="member">
        <option value="">--- Select ---</option>
        <?php
        foreach($result as $row) {
            echo "<option value='$row->powon_id'>$row->username - $row->powon_id</option>";
        }
        ?>
        </select>
    <label>Message</label>
    <textarea name = "content" rows = "5" cols = "50"></textarea>
    <br>
    <input type = "submit" value = "Send"/>
</fieldset>
<br>


</form>
<?php echo validation_errors(); ?>