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
                height:500px;
                width:350px;
                float:left;
            }
            section {
                position:relative;
                width:350px;
                height:500px;
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

            div#header {
                text-align: center;
            }

            fieldset {
                width: 400px;
            }
        </style>
    </head>
    <body>
        <header>
            <img src="<?php echo base_url('images/powon_banner.png'); ?>" />
        </header>

            <?php
                if($this->session->userdata('logged_in')) {
                    echo anchor('controller_main/home', 'Home');
                    echo "<br>";
                    echo anchor('controller_member/logout', 'Logout');
                } else {
                    echo anchor('controller_main', 'Public');
                    echo "<br>";
                    echo anchor('controller_member/login', 'Login');
                    echo "<br>";
                    echo anchor('controller_member/register', 'Register');
                }
            ?>

            <!-- PRINTING SESSION INFO TEST PURPOSES -->
            <?php
                echo "<pre>";
                print_r ($this->session->all_userdata());
                 echo "</pre>";
            ?>

        <h1><?php echo $title ?></h1>