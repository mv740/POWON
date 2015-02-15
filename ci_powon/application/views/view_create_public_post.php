
<div class="container">
    <?php
    $attributes = array('role' => 'form', 'class'=> 'form-horizontal');
    ?>
    <?php echo form_open('controller_admin/createPublicPost', $attributes); ?>
    <fieldset>
        <div class="form-group">
            <label class="col-sm-3 control-label">Content </label>
            <div class="col-sm-6">
                <textarea name = "content" rows = "5" cols = "50" class="form-control"></textarea>
                <br/>
            </div>
        </div>
    </fieldset>
    <fieldset>
        <div class="form-group">
            <div class="col-sm-offset-3 col-sm-6">
                <input type = "submit" value = "Create Public Post" class="btn btn-primary"/>
            </div>
        </div>
    </fieldset>
    </form>
</div>
