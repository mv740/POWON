
<div class="container">
    <?php
    $attributes = array('role' => 'form', 'class'=> 'form-horizontal');
    ?>
    <?php echo form_open('controller_admin/updatePublicPost', $attributes); ?>
    <fieldset>
        <div class="form-group">
            <label class="col-sm-3 control-label">Content </label>
            <div class="col-sm-6">
                <input type="hidden" name="public_post_id" value=$public_post_id />
                <?php foreach($publicPostText as $row){ ?>
                <textarea name = "content" rows = "5" cols = "50" class="form-control" <?php echo "value=<br>".$row->content;?> </textarea>
                <?php }?>
                <br/>
            </div>
        </div>
    </fieldset>
    <fieldset>
        <div class="form-group">
            <div class="col-sm-offset-3 col-sm-6">
                <input type = "submit" value = "Save Changes" class="btn btn-primary"/>
            </div>
        </div>
    </fieldset>
    </form>
</div>
