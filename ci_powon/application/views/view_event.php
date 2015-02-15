<div class="container">
    
    <section>
        <h2>Event Info</h2>
            <?php
            foreach($eventsInfo as $row) {
            $group_id = $row->group_id;
            $name = $row->name;
            $description = $row->description;
            
            
            echo "Event Name: " . $name;
            echo "<br>";
            echo "Event Description: " . $description;
            echo "<br>";
            echo "Group Id: " . $group_id;
            echo "<br>";
             }
            ?>
            
        <div class="col-sm-6">
    
        
          <?php if ($pollOpen) : ?>
          <h2> Poll for Event Date/Time and Place.</h2>
          <?php
            echo "<table><tr><th>Place</th><th>Time</th><th>Vote Count</th><th>Vote</th></tr>";

            $event_id = $eventsInfo[0] -> event_id;
            
            foreach($suggData as $row) {
            
            echo "<tr><td>".$row->place."</td><td>".$row->date."</td><td>".$row->votecount."</td><td>";
            echo form_open("controller_event/addVote/".$event_id); 
            echo "<fieldset>"
            ."<input type='hidden' value='" .$row->suggestion_id ."'"  . "name='suggestion_id'></input>" 
            ."<input type='hidden' value='" .$row->poll_poll_id."'"  . "name='poll_id'></input>"
            ."</fieldset><br>";
            if(!$hasVoted)
             { echo '<input type = "submit" value = "Vote"/>';}
            echo "</form>";        
            echo "</td></tr>";
            
            
        };
        ?>
        <?php endif; ?>
        <?php
        if($hasVoted)
        {
            echo "<h3>You have already voted!!!</h3>";

            
        }

             

             

            echo "</table>";
            ?> <br>
            <div class="container">
            <?php 
            foreach($eventsInfo as $row) {
            $event = $row->event_id;   
            //echo $event;
            
        }      

        
       if($pollOpen)
       {

            echo form_open("controller_event/addSuggestion/$event");
            echo '<fieldset>';
            echo "<legend>Add new Suggestion</legend>";
            echo '<br/>';
            echo "<input type='hidden' value='" .$event ."'"  . "name='event_id'></input>";
            echo '<label>Place</label>';
            echo '<input type = "text" name = "place"/>';
            echo '<label>Date/Time</label>';
            echo '<input id="datetimepicker1" type="text" name="date"></input>';
            echo '</fieldset';
            echo '<br/>';
            echo '<br/>';
            echo '<br/>';
            echo '<input type = "submit" value = "Add"/>';
            echo '</form>';

       }else{
        // winner
            echo "winner";
            echo "<br/>";
            echo "date :" .$winner[0]->date; 
            echo "<br/>";
            echo "place :" .$winner[0]->place;
            echo "<br/>";
            echo "<br/>";
            echo "<br/>";
            echo "<br/>";
       }

            ?>
        
          
         
        <?php echo validation_errors(); ?>
        <?php 
        $session_id = $this->session->userdata('powon_id');
        if ($groupInfo[0]->owner_id = $session_id && $pollOpen) : ?>
        <?php echo form_open("controller_event/closePoll/$event"); ?>
        <fieldset>
        <?php echo "<input type='hidden' value='" .$poll_id ."'"  . "name='poll_id'></input>" ?>
        </fieldset><br>
        <input type = "submit" value = "Close Poll"/>
        </form>
        <?php endif; ?>



</div>

        </div>
        <div class="col-sm-3"></div>

    </section>
</div>


        <script type="text/javascript">
            $(function ()
             {
                $('#datetimepicker1').datetimepicker();
            });
        </script>
