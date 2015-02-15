<div class="container">
    <ul class="nav nav-pills">
        <li role="presentation" class=""><?php echo anchor('controller_email/viewReceivedEmail', "Inbox "
                .'<span class="badge"> ' . $numberReceived[0]->numberOfmessage .'</span>'); ?>
        </li>
        <li role="presentation" class="active"><?php echo anchor('controller_email/viewSentEmail', "Sent Box "
                .'<span class="badge"> ' .$numberSent[0]->numberOfmessage .'</span>'); ?>
        </li>
        <li  role="presentation"><?php echo anchor('controller_email/createEmail',
                '<spam class="text-success">Create </spam><span style="font-size: 1.3em" class="glyphicon glyphicon-envelope text-info" aria-hidden="true"></span>'); ?>
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
        <li role="presentation"><?php echo anchor('controller_gift/createGifts',
                '<spam class="text-success">Create </spam><span style="font-size: 1.3em" class="glyphicon glyphicon-gift text-info" aria-hidden="true"></span>'); ?>
        </li>
        <li style="margin-left :150px; font-size: 1.75em" role="presentation"><?php echo anchor('controller_email/viewSentEmail', '<span class="glyphicon glyphicon-refresh text-success" aria-hidden="true"></span>'); ?>
        </li>
    </ul>


    <br/>
    <br/>

    <div class="container" style="width: 800px">
        <?php

        foreach($result as $row)
        {
            $attributes = array( 'name' =>$row->message_id);

            echo '<div class="panel panel-primary">
    <div class="panel-heading">
        <h3 class="panel-title">'

                .'<div class="row">
                <div class="col-md-11">'
                .'<span class="glyphicon glyphicon-envelope" aria-hidden="true"></span> Sent :' . $row->reciever_powon_id
                .'</div>
                <div class="col-md-1">'

                .form_open('controller_email/deleteSentEmail', $attributes)
                .form_hidden('data', $row->message_id)
                .'<button type="submit" class="btn btn-danger"' .'name="' .$row->message_id .'">
                        <i class="glyphicon glyphicon-remove"></i>
                    </button>'
                .'</form>'
                .'</div>
            </div>'
                .'</h3>';
            echo '</div>
    <div class="panel-body">';
            echo    '<div class="panel panel-info">
                    <div class="panel-heading">
                        <h3 class="panel-title"> date:' . $row->date .'</h3>
                    </div>
                    <div class="panel-body">'
                .$row->content
                .'</div>
                </div>';
            echo '</div>'
                .'</div>';
        }

        ?>

    </div>

</div>