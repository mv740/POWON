
<div class="container">
    <section>
        <h2>Thread Restrictions</h2>
        <?php echo form_open("controller_thread/checkThreadAccess/$thread_id/$group_id/$author_id/$session_id"); ?>
        <fieldset>
            <legend>Update Restrictions</legend>
            <select name="member">
                <option value="">--- Select ---</option>
                <?php
                foreach($membersList as $row) {
                    echo "<option value='$row->powon_id'>$row->username - $row->powon_id</option>";
                }
                ?>
            </select><br>
            Restriction:
            <select name = "restriction">
                <option value="0">Unrestricted</option>
                <option value="1">No Comments</option>
                <option value="2">Restricted</option>

            </select>
            <input type = "submit" value = "Update"/>
        </fieldset>
    </section>
</div>
