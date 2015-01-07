<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">
  <!--   Code By Abhishek R. Kaushik  -->
    <title>The saving coupon</title>
    <!-- Bootstrap core CSS -->
    <link href="<?php echo HTTP_CSS_PATH; ?>bootstrap.css" rel="stylesheet">
    <!-- Custom styles for this template -->
    <link href="<?php echo HTTP_CSS_PATH; ?>signin.css" rel="stylesheet">
    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="<?php echo HTTP_JS_PATH; ?>html5shiv.js"></script>
      <script src="<?php echo HTTP_JS_PATH; ?>respond.min.js"></script>
    <![endif]-->
    <link href="<?php echo HTTP_CSS_PATH; ?>common.css" rel="stylesheet">
    <style>
      body {
        background: #0D3B5F;
        margin: 0;
        padding: 0;
        font: normal 13px 'ProximaNova-Regular',helvetica,arial,sans-serif;
        height: 100%;
        padding: 5% 0;
      }
      .container{
        padding: 10% 0;
      }
      .container form{

        box-shadow: 0 5px 400px rgba(255, 255, 255, 0.32);
        border-radius: 10px;
      }
    </style>
  </head>

  <body>

    <div class="container">
        <form class="form-signin panel" method="post" action="<?php echo base_url(); ?>admin/home/do_login">
        <center><div class="logoLogin"></div></center>
        <?php  if(isset($error)){ echo "<p class='bg-danger' style='display:block;'>".$error."</p>"; } ?>
        <input type="text" class="form-control" placeholder="Usuario" name="username" autofocus>
        <input type="password" class="form-control" placeholder="Password" name="password">
        <label class="checkbox">
          <input type="checkbox" value="remember-me">Recordarme
        </label>
        <button class="btn btn-lg btn-primary btn-block" type="submit">Ingresar</button>
      </form>
    </div> <!-- /container -->
    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
  </body>
</html>