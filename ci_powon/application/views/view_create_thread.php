


<div class="container">
    <?php
    $attributes = array('role' => 'form', 'class'=> 'form-horizontal');
    ?>
    <?php echo form_open("controller_thread/createThread/$group_id", $attributes); ?>
    <fieldset>
        <div class="form-group">
            <label class="col-sm-3 control-label">Thread Name  </label>
            <div class="col-sm-6">
                <input type = "text" name = "name" class="form-control"/>
                <br/>
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-3 control-label">Post </label>
            <div class="col-sm-6">
                <textarea name = "content" rows = "5" cols = "50" class="form-control"></textarea>
                <br/>
            </div>
        </div>
        <div class="form-group text-center">
            Restriction:
            (Selecting "Custom" will send you to the thread access page)
            <select name = "restriction">
                <option value="0">Public</option>
                <option value="1">Custom</option>

            </select>
        </div>

    </fieldset>
    <fieldset>
        <div class="form-group">
            <div class="col-sm-offset-3 col-sm-6">
                <input type = "submit" value = "Submit" class="btn btn-default"/>
            </div>
        </div>
    </fieldset>
    </form>
</div>
