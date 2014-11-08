<html>
    <head>
        <title><?php echo $title ?> </title>
        <style>
            body {
                background-color: gainsboro;
            }
            header {
                 text-align:center;

            }
            nav {

                width:350px;
                float:left;
            }
            section {
                position:relative;
                width:350px;
                float:left;

            }
            footer {
                clear:both;
                text-align:center;
            }
            label {
                display: inline-block;
                float: left;
                clear: left;
                width: 200px;
            }
            input{
                display:inline-block;
            }
            fieldset {
                width: 400px;
            }
            hr {
                border: none;
                height: 2px;
                background-color: black;
            }
        </style>
    </head>
    <body>
        <header>
            <img src="<?php echo base_url('images/powon_banner.png'); ?>" />
        </header>

            <?php
                if($this->session->userdata('logged_in')) {
                    echo anchor('controller_main/homePage', 'Home');
                    echo "<br>";
                    echo anchor('controller_member/logout', 'Logout');
                } else {
                    echo anchor('controller_main', 'Public');
                    echo "<br>";
                    echo anchor('controller_member/loginPage', 'Login');
                    echo "<br>";
                    echo anchor('controller_member/registerPage', 'Register');
                }
            ?>

            <!-- PRINTING SESSION INFO TEST PURPOSES -->
            <?php
                echo "<pre>";
                print_r ($this->session->all_userdata());
                 echo "</pre>";
            ?>

        <h1><?php echo $title ?></h1>
        <hr>