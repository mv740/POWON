<?php echo anchor('controller_email/emailPage', 'View Emails');
echo "<br>";
echo "<br>";
?>


<section>
    <?php
    foreach($result as $row) {
        echo "<fieldset>";
        echo "<legend>from : " . $row->sender_powon_id;
        echo "</legend>";
        echo "message ID: " . $row->message_id;
        echo "<br>";
        echo "date: " . $row->date;
        echo "<br>";
        echo "<br>";
        echo "content: " . $row->content;
        echo "<br>";
        echo "</fieldset>";
        echo "<br>";
        echo "<br>";
    }
    ?>
</section>

