<div class="container">
    <?php
    $attributes = array('role' => 'form', 'class'=> 'form-horizontal');
    ?>
    <?php echo form_open('controller_event/createEvent/'.$group_id, $attributes); ?>
    <legend>Event Details</legend>
    <fieldset>
        <div class="form-group">
            <label class="col-sm-3 control-label">Event Name</label>
            <div class="col-sm-6">
                <input type = "text" name = "name" class="form-control"/>
                <br/>
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-3 control-label">Event Description </label>
            <div class="col-sm-6">
                <textarea name = "description" rows = "5" cols = "50" class="form-control"></textarea>
                <br/>
            </div>
        </div>
    </fieldset>
    <fieldset>
        <div class="form-group">
            <div class="col-sm-offset-3 col-sm-6">
                <input type = "submit" value = "Create" class="btn btn-primary"/>
                <input type = "reset" value = "reset" class="btn btn-default"/>
            </div>
        </div>
    </fieldset>
    </form>
</div>
