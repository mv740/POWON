
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="../../favicon.ico">

    <title>POWON</title>

    <!-- Bootstrap core CSS -->
    <link href="https://clipper.encs.concordia.ca/~lfc353_2/ci_powon/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="https://clipper.encs.concordia.ca/~lfc353_2/ci_powon/css/starter-template.css">



    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>

<body>

<div class="container">
    <nav class="navbar-fixed-top" role="navigation">
        <div class="text-center" style="background-color: #ffffff">
            <br/>
            <img src="/~lfc353_2/ci_powon/images/powon_banner.png"/>
            <br/>
            <br/>
        </div>
        <div class="container navbar navbar-inverse">

            <div class="navbar-header">
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <?php
                /*if($this->session->userdata('logged_in'))
                {
                    echo anchor('controller_member', 'POWON', array('class' => 'navbar-brand'));
                }
                else
                {
                    echo anchor('controller_main', 'POWON', array('class' => 'navbar-brand'));
                }
                */?>
            </div>
            <div id="navbar" class="collapse navbar-collapse">
                <ul class="nav navbar-nav">

                    <?php
                    if($this->session->userdata('logged_in'))
                    {
                        echo '<li>' .anchor('controller_member', 'Home', 'title="Home link"') .'</li>';
                        echo '<li><a data-toggle="modal" data-refresh="true" href="https://clipper.encs.concordia.ca/cgi-bin/cgiwrap/lfc353_2/ci_powon/index.php/controller_email/EmailUpdate" data-target="#myModal1">Email</a>';
                        //echo '<li>' .anchor('controller_email/viewReceivedEmail', 'Inbox', 'title="Profile link"') .'</li>';
                        echo '<li>' .anchor('controller_member/viewProfilePage', 'Profile', 'title="Profile link"') .'</li>';
                        //echo '<li>' .anchor('controller_member/viewProfilePage', 'Profile', 'title="Profile link"') .'</li>';
                    }
                    else
                    {
                        echo '<li>' .anchor('controller_main', 'Home', 'title="Home link"') .'</li>  ';
                    }
                    ?>

                    <!-- <li><a href="#contact">Contact</a></li>-->
                </ul>
                <ul class="nav navbar-nav navbar-right">
                    <?php
                    //

                    $session_username = $this->session->userdata('username');
                    if($this->session->userdata('logged_in'))
                    {
                        //user is logged in
                        echo    '<li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">' .'<b>' .$session_username .'</b>' .'<span class="caret"></span></a>
                                <ul class="dropdown-menu" role="menu">
                                    <li>' .anchor('controller_account/logout', 'Logout', 'title="Logout link"') .'</li>
                                </ul>
                            </li>';

                    }
                    else
                    {
                        echo '<li>' .anchor('controller_account/loginPage', 'Login', 'title="Login page link"') .'</li>';
                        echo '<li>' .anchor('controller_account/registerPage', 'register', 'title="register link"').'</li>';
                        echo '<li></li>';
                    }

                    ?>
                </ul>
            </div><!--/.nav-collapse -->
        </div>
    </nav>
</div>

<div style="background-color: #ffffff">
    <br/>
    <br/>
    <br/>
    <br/>
    <br/>
    <br/>
</div>


<!-- Bootstrap core JavaScript
================================================== -->
<!-- Placed at the end of the document so the pages load faster -->
<!--<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>-->
<script src="/~lfc353_2/ci_powon/js/jquery.min.js"></script>
<script src="/~lfc353_2/ci_powon/js/bootstrap.min.js"></script>
<script src="/~lfc353_2/ci_powon/js/modalRefresh.js"></script>
<!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
<script src="../../assets/js/ie10-viewport-bug-workaround.js"></script>
</body>
</html>

<br/>


<div class="container">
    <!-- PRINTING SESSION INFO TEST PURPOSES -->
    <?php
    echo "<pre>";
    print_r ($this->session->all_userdata());
    echo "</pre>";


    ?>
    <h1><?php echo $title ?></h1>
    <hr>




    <!-- Modal -->
    <div class="modal fade" id="myModal1" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title">Modal title</h4>

                </div>
                <div class="modal-body"><div class="te"></div></div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary">Save changes</button>
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
    <!-- /.modal -->
</div>