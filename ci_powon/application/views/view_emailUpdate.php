<section>
    <br/>
    <div class="container">
        <ul class="nav nav-pills">
            <li style="margin-left :10px;" class="active" role="presentation" ><?php echo anchor('controller_email/viewReceivedEmail', "Inbox "
                    .'<span class="badge"> ' . $numberReceived[0]->numberOfmessage .'</span>'); ?>
            </li>
            <li style="margin-left :10px;" class="active" role="presentation"><?php echo anchor('controller_email/viewSentEmail', "Sent Box "
                    .'<span class="badge"> ' .$numberSent[0]->numberOfmessage .'</span>'); ?>
            </li>
            <li></li>
            <li style="margin-left :10px;" style="" role="presentation"><?php echo anchor('controller_email/createEmail',
                    '<span style="font-size: 1.3em" class="text-success">Create</span>
                    <span style="font-size: 1.3em" class="glyphicon glyphicon-envelope text-info" aria-hidden="true"></span>'); ?>
            </li>
            <li  style="margin-left :50px;" role="presentation" ><?php echo anchor('controller_email/InviteToPowon',
                    '<spam >Invite </spam><span style="font-size: 1.3em" class="glyphicon glyphicon-send" aria-hidden="true"></span>'); ?>
            </li>
            <li style="margin-left :50px;" role="presentation" class=""><?php echo anchor('controller_gift/viewReceivedGift', '<span class="glyphicon glyphicon-gift " aria-hidden="true"></span> Received'
                    .'<span class="badge"> ' . $GiftnumberReceived[0]->numberOfmessage .'</span>'); ?>
            </li>
            <li style="margin-left :10px;" role="presentation" class=""><?php echo anchor('controller_gift/viewSentGift', '<span class="glyphicon glyphicon-gift " aria-hidden="true"></span> Send'
                    .'<span class="badge"> ' . $GiftnumberSent[0]->numberOfmessage .'</span>'); ?>
            </li>
            <li style="margin-left :10px;"  role="presentation"><?php echo anchor('controller_gift/createGifts',
                    '<spam class="text-success">Create </spam><span style="font-size: 1.3em" class="glyphicon glyphicon-gift text-info" aria-hidden="true"></span>'); ?>
            </li>
        </ul>
    </div>
    <!-- show link to each inbox + number of emails-->

    <br/>
</section>

