<section>
    <h2>Emails</h2>


    <!-- show link to each inbox + number of emails-->
    <li><?php echo anchor('controller_email/viewReceivedEmail', 'Inbox');
        echo "(".($numberReceived[0]->numberOfmessage).")"?>
    </li>
    <li><?php echo anchor('controller_email/viewSentEmail', 'Sent box');
        echo "(".($numberSent[0]->numberOfmessage) .")"?>
    </li>
    <li>
        <?php echo anchor('controller_email/createEmail', 'Create Email');?>
    </li>


</section>