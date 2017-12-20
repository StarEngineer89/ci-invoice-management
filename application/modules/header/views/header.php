<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title><?php echo $page_title;?></title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Invoice Management System (IMS)">
    <!-- <meta name="author" content="Muhammad Usman"> -->

    <!-- The styles -->
<!--    <link id="bs-css" href="--><?php //echo base_url('css/bootstrap-cerulean.min.css')?><!--" rel="stylesheet">-->
    <link href="<?php echo base_url('css/bootstrap-cerulean.min.css')?>" rel="stylesheet">
    <link href="<?php echo base_url('css/charisma-app.css')?>" rel="stylesheet">
  <!--   <link href='<?php echo base_url()?>bower_components/fullcalendar/dist/fullcalendar.css' rel='stylesheet'>
    <link href='<?php echo base_url()?>bower_components/fullcalendar/dist/fullcalendar.print.css' rel='stylesheet' media='print'> -->
    <link href='<?php echo base_url('bower_components/chosen/chosen.min.css')?>' rel='stylesheet'>
    <link href='<?php echo base_url('bower_components/colorbox/example3/colorbox.css')?>' rel='stylesheet'>
    <link href='<?php echo base_url('bower_components/responsive-tables/responsive-tables.css')?>' rel='stylesheet'>
    <!-- <link href='<?php //echo base_url('bower_components/bootstrap-tour/build/css/bootstrap-tour.min.css')?>' rel='stylesheet'> -->
    <!-- <link href='<?php //echo base_url('css/jquery.noty.css')?>' rel='stylesheet'> -->
    <link href='<?php echo base_url('css/noty_theme_default.css')?>' rel='stylesheet'>
    <!-- <link href='<?php //echo base_url('css/elfinder.min.css')?>' rel='stylesheet'> -->
    <!-- <link href='<?php //echo base_url('css/elfinder.theme.css')?>' rel='stylesheet'> -->
    <link href='<?php echo base_url('css/jquery.iphone.toggle.css')?>' rel='stylesheet'>
    <!-- <link href='<?php //echo base_url('css/uploadify.css')?>' rel='stylesheet'> -->
    <!-- <link href='<?php //echo base_url('css/animate.min.css')?>' rel='stylesheet'> -->

    <!-- jQuery -->
    <script src="<?php echo base_url('bower_components/jquery/jquery.min.js')?>"></script>

    <link rel="shortcut icon" href="<?php echo base_url()?>img/favicon.ico">

</head>

<body>
    <!-- topbar starts -->
    <div class="navbar navbar-default" role="navigation">

        <div class="navbar-inner">
            <button type="button" class="navbar-toggle pull-left animated flip">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="<?php echo base_url()?>"> <img alt="Charisma Logo" src="<?php echo base_url()?>img/logo20.png" class="hidden-xs"/>
                <span>IMS</span></a>

            <!-- user dropdown starts -->
            <div class="btn-group pull-right">
                <button class="btn btn-default dropdown-toggle" data-toggle="dropdown">
                    <i class="glyphicon glyphicon-user"></i><span class="hidden-sm hidden-xs"> <?php echo $this->session->userdata('sess_user_name')?></span>
                    <span class="caret"></span>
                </button>
                <ul class="dropdown-menu">
                    <li><a href="#">Profile</a></li>
                    <li class="divider"></li>
                    <li><a href="<?php echo base_url('login/logout')?>">Logout</a></li>
                </ul>
            </div>
            <!-- user dropdown ends -->

            <!-- theme selector starts -->
            <div class="btn-group pull-right theme-container animated tada">
                <button class="btn btn-default dropdown-toggle" data-toggle="dropdown">
                    <i class="glyphicon glyphicon-tint"></i><span
                        class="hidden-sm hidden-xs"> Change Theme / Skin</span>
                    <span class="caret"></span>
                </button>
                <ul class="dropdown-menu" id="themes">
                    <li><a data-value="classic" href="#"><i class="whitespace"></i> Classic</a></li>
                    <li><a data-value="cerulean" href="#"><i class="whitespace"></i> Cerulean</a></li>
                    <li><a data-value="cyborg" href="#"><i class="whitespace"></i> Cyborg</a></li>
                    <li><a data-value="simplex" href="#"><i class="whitespace"></i> Simplex</a></li>
                    <li><a data-value="darkly" href="#"><i class="whitespace"></i> Darkly</a></li>
                    <li><a data-value="lumen" href="#"><i class="whitespace"></i> Lumen</a></li>
                    <li><a data-value="slate" href="#"><i class="whitespace"></i> Slate</a></li>
                    <li><a data-value="spacelab" href="#"><i class="whitespace"></i> Spacelab</a></li>
                    <li><a data-value="united" href="#"><i class="whitespace"></i> United</a></li>
                </ul>
            </div>
            <!-- theme selector ends -->

            <ul class="collapse navbar-collapse nav navbar-nav top-menu">
            </ul>

        </div>
    </div>
    <!-- topbar ends -->