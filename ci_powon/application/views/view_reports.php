<div class="container">
    <section >
        <h1>Interests Report</h1>
        <?php
        echo "<table><tr><th>Interests</th><th>Count</th></tr>";
        foreach($interests as $row) {
            
            echo "<tr><td>".$row->interests."</td><td>".$row->count."</td></tr>";
            
            
        };
        echo "</table>";

        ?><br>
        <h1>Proffession Report</h1>
        <?php
         echo "<table><tr><th>Profession</th><th>Count</th></tr>";
        foreach($profession as $row) {
            echo "<tr><td>".$row->profession."</td><td>".$row->count."</td></tr>";
            
        };
        echo "</table>";
        ?><br>

                        <!-- UPDATED CODE AFTER DEMO-->

          <h1>Site Stats</h1>
        <table><tr><th>Stats</th><th>Count</th></tr>
        <?php
         
        foreach($numOfGrps as $row) {
            echo "<tr><td>Groups</td><td>".$row->count."</td></tr>";
        
        };
        ?>

        <?php
        foreach($numOfMembers as $row) {
           echo "<tr><td>Members</td><td>".$row->count."</td></tr>";
            
        };
        ?>

        <?php
        foreach($numOfThreads as $row) {
            echo "<tr><td>Threads</td><td>".$row->count."</td></tr>";
            
        };
        ?>

        <?php
        foreach($numOfPosts as $row) {
           echo "<tr><td>Posts</td><td>".$row->count."</td></tr>";
            
        };
        ?>

         <?php
        foreach($avgAge as $row) {
            echo "<tr><td>Avg Age</td><td>".$row->avg_age."</td></tr>";
            
        };
        
        ?>
        </table>
        <br>
        <?php
        echo "<table><tr><th>Group Name</th><th>Owner name</th><th>Member Count</th></tr>";
        foreach($groupStats as $row) {
            
            echo "<tr><td>".$row->name."</td><td>".$row->username."</td><td>".$row->memberCount."</td></tr>";
            
            
        };
        echo "</table>";
        ?> <br>
       
        <?php
        echo "<table><tr><th>Username</th><th>#GroupsJoined</th><th>ThreadsCreated</th><th>PostsCreated</th><th>#Interests</th><th>#Friends</th><th>#Family</th><th>#Colleagues</th></tr>";
        foreach($usersStats as $row) {
            
            echo "<tr><td>".$row->username."</td><td>".$row->GroupCount."</td><td>".$row->ThreadCount."</td><td>".$row->PostCount."</td><td>".$row->InterestCount."</td><td>".$row->FriendCount."</td><td>".$row->FamilyCount."</td><td>".$row->ColleagueCount."</td></tr>";
            
            
        };
        echo "</table>";
        ?> <br>
       



    </section>
    </div>

