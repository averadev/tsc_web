<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="shortcut icon" href="<?php echo HTTP_CSS_PATH; ?>favicon.png">
    <title>The saving coupon</title>
    <!-- Bootstrap core CSS -->
    <link href="<?php echo HTTP_CSS_PATH; ?>bootstrap.css" rel="stylesheet">
    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="<?php echo HTTP_JS_PATH; ?>html5shiv.js"></script>
      <script src="<?php echo HTTP_JS_PATH; ?>respond.min.js"></script>
    <![endif]-->
     <link href="<?php echo HTTP_CSS_PATH; ?>icons.css" rel="stylesheet">
     <link href="<?php echo HTTP_CSS_PATH; ?>jquery.bxslider.css" rel="stylesheet">
     <link href="<?php echo HTTP_CSS_PATH; ?>owl.carousel.css" rel="stylesheet">
     <link href="<?php echo HTTP_CSS_PATH; ?>datepicker.css" rel="stylesheet">
     <link href="<?php echo HTTP_CSS_PATH; ?>typeahead.css" rel="stylesheet">
     <link href="<?php echo HTTP_CSS_PATH; ?>common.css" rel="stylesheet">
  </head>
<body>
    <?php
    $pg = isset($page) && $page != '' ?  $page :'dash'  ;    
    ?>

    <div class="navbar navbar-inverse navbar-fixed-top">
      <div class="container">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="<?php echo base_url(); ?>">The Saving Coupon</a>
        </div>
        <div class="navbar-collapse collapse">
          <ul class="nav navbar-nav logout">
            <li><a href="<?php echo base_url(); ?>admin/home/logout">Salir</a></li>
          </ul>
        </div>
      </div>
    </div>
