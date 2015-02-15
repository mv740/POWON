<div class="container">
    <ul class="nav nav-pills">
        <li role="presentation" class=""><?php echo anchor('controller_email/viewReceivedEmail', "Inbox "
                .'<span class="badge"> ' . $numberReceived[0]->numberOfmessage .'</span>'); ?>
        </li>
        <li role="presentation"><?php echo anchor('controller_email/viewSentEmail', "Sent Box "
                .'<span class="badge"> ' .$numberSent[0]->numberOfmessage .'</span>'); ?>
        </li>
        <li  role="presentation"><?php echo anchor('controller_email/createEmail',
                '<spam class="text-success">Create </spam><span style="font-size: 1.3em" class="glyphicon glyphicon-envelope text-info" aria-hidden="true"></span>'); ?>
        </li>
        <li  style="margin-left :100px;" role="presentation" class="active"><?php echo anchor('controller_email/InviteToPowon',
                '<spam >Invite </spam><span style="font-size: 1.3em" class="glyphicon glyphicon-send" aria-hidden="true"></span>'); ?>
        </li>
        <li style="margin-left :100px;" role="presentation" class=""><?php echo anchor('controller_gift/viewReceivedGift', '<span class="glyphicon glyphicon-gift " aria-hidden="true"></span> Received'
                .'<span class="badge"> ' . $GiftnumberReceived[0]->numberOfmessage .'</span>'); ?>
        </li>
        <li role="presentation" class=""><?php echo anchor('controller_gift/viewSentGift', '<span class="glyphicon glyphicon-gift " aria-hidden="true"></span> Send'
                .'<span class="badge"> ' . $GiftnumberSent[0]->numberOfmessage .'</span>'); ?>
        </li>
        <li role="presentation"><?php echo anchor('controller_gift/createGifts',
                '<spam class="text-success">Create </spam><span style="font-size: 1.3em" class="glyphicon glyphicon-gift text-info" aria-hidden="true"></span>'); ?>
        </li>
        <li style="margin-left :150px; font-size: 1.75em" role="presentation"><?php echo anchor('controller_email/InviteToPowon', '<span class="glyphicon glyphicon-refresh text-success" aria-hidden="true"></span>'); ?>
        </li>
    </ul>



    r<?php
    $attributes = array('role' => 'form', 'class'=> 'form-horizontal');
    ?>
    <div class="row">
        <div class="col-md-3"></div>
        <div class="col-md-6">
            <?php echo form_open('controller_email/InviteAuthentication', $attributes); ?>
            <fieldset>
                <legend>Invite User to Powon</legend>
                <div class="form-group">
                    <label class="col-sm-6 control-label">Email</label>

                    <div class="col-sm-6">
                        <input type = "email" name = "email1" class="form-control"/>
                        <br/>
                        <?php if(form_error('email1') == true)
                        {
                            echo '<div class="form-control alert-danger text-center">' .form_error('email1') .'</div>';
                        } ?>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-6 control-label">Email Confirmation</label>

                    <div class="col-sm-6">
                        <input type = "email" name = "email2" class="form-control"/>
                        <br/>
                        <?php if(form_error('email2') == true)
                        {
                            echo '<div class="form-control alert-danger text-center" >' .form_error('email2') .'</div>';
                        } ?>
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-sm-offset-6 col-sm-9">
                        <input type = "submit" value = "Send Invite" class="btn btn-primary"/>
                    </div>
                </div>
            </fieldset>

            </form>

        </div>
        <div class="col-md-3"></div>
    </div>
</div>
