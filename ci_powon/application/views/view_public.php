<div class="container">
    <div class="row">
        <div class="row">
            <div class="col-sm-3"></div>
            <div class="col-sm-6">
                <?php
                foreach($publicPosts as $row)
                {
                    echo '<div class="panel panel-danger" >'
                        .'<div class="panel-heading">'
                        .'<h4 class="panel-title">'
                        ."<div class='row'>"
                        .'<div class="text-center">'
                        ." Admin Username: " .$username = $row -> username
                            . "</br>"
                            .' Time : ' .$currentDateTime = $row->date;;
                    echo '</div>'

                        .'</div>'
                        .'</h4>'
                        .'</div>'
                        ."<div class='panel-body'>"

                        .$content = $row->content
                            ."</div>"
                            .'</div>';
                }
                ?>
                <div class="col-sm-3"></div>
            </div>
        </div>
</div>
