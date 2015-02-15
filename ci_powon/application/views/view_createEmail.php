

<div class="container">
    <div class="row">
        <div class=""></div>
    </div>

    <ul class="nav nav-pills">
        <li role="presentation" ><?php echo anchor('controller_email/viewReceivedEmail', "Inbox "
                .'<span class="badge"> ' . $numberReceived[0]->numberOfmessage .'</span>'); ?>
        </li>
        <li role="presentation"><?php echo anchor('controller_email/viewSentEmail', "Sent Box "
                .'<span class="badge"> ' .$numberSent[0]->numberOfmessage .'</span>'); ?>
        </li>
        <li  role="presentation" class="active"><?php echo anchor('controller_email/createEmail',
                'Create </spam><span style="font-size: 1.3em" class="glyphicon glyphicon-envelope " aria-hidden="true">'); ?>
        </li>
        <li  style="margin-left :100px;" role="presentation" ><?php echo anchor('controller_email/InviteToPowon',
                '<spam >Invite </spam><span style="font-size: 1.3em" class="glyphicon glyphicon-send" aria-hidden="true"></span>'); ?>
        </li>
        <li style="margin-left :100px;" role="presentation" class=""><?php echo anchor('controller_gift/viewReceivedGift', '<span class="glyphicon glyphicon-gift " aria-hidden="true"></span> Received'
                .'<span class="badge"> ' . $GiftnumberReceived[0]->numberOfmessage .'</span>'); ?>
        </li>
        <li role="presentation" class=""><?php echo anchor('controller_gift/viewSentGift', '<span class="glyphicon glyphicon-gift " aria-hidden="true"></span> Send'
                .'<span class="badge"> ' . $GiftnumberSent[0]->numberOfmessage .'</span>'); ?>
        </li>
        <li  role="presentation"><?php echo anchor('controller_gift/createGifts',
                '<spam class="text-success">Create </spam><span style="font-size: 1.3em" class="glyphicon glyphicon-gift text-info" aria-hidden="true"></span>'); ?>
        </li>
        <li style="margin-left :150px; font-size: 1.75em" role="presentation"><?php echo anchor('controller_email/createEmail', '<span class="glyphicon glyphicon-refresh text-success" aria-hidden="true"></span>'); ?>
        </li>

    </ul>
</div>
<!-- show link to each inbox + number of emails-->





<?php echo validation_errors(); ?>


<div class="container" style="width: 800px">
    <?php
    $attributes = array('role' => 'form', 'class'=> 'form-horizontal');
    ?>

    <?php echo form_open('controller_email/sendCreatedEmail', $attributes); ?>
    <fieldset>
        <legend>New Email</legend>
        <div class="form-group">
            <label class="col-sm-3 control-label">Send To</label>
            <div class="col-sm-9">
                <select name="member" class="form-control">
                    <option value="NotSelected" class="text-center">--- Select ---</option>
                    <!--THIS STUB BELOW WAS CHANGED UNTILL I SAY STOP-->
                    <?php
                    if ($this->session->userdata('privilege') == "admin"){
                       foreach($adminSend as $row) {
                        echo "<option class='text-center' value='$row->powon_id'>$row->first_name $row->last_name</option>";
                    } 
                    }else{
                        foreach($peopleYouCanSendTo as $row) {
                        echo "<option class='text-center' value='$row->powon_id'>$row->first_name $row->last_name</option>";
                        }
                    }
                    ?>
                    <!-- OK OK STOP STIOOP STOP-->
                </select>
                <br/>
                <?php if( $UserSelected == false )
                {
                    echo '<div class="form-control alert-danger text-center">' .'Please Choose a User' .'</div>';
                } ?>
            </div>

        </div>
        <div class="form-group">
            <label class="col-sm-3 control-label">Message</label>
            <div class="col-sm-9">
                <textarea name = "content" rows = "5" cols = "50" class="form-control"></textarea>
                <br/>

            </div>
    </fieldset>
    <br/>
    <fieldset>
        <div class="form-group">
            <div class="col-sm-offset-3 col-sm-9">
                <input type = "submit" value = "send" class="btn btn-primary"/>
                <input type = "reset" value = "reset" class="btn btn-default"/>
            </div>
        </div>
    </fieldset>

    </form>
</div>
