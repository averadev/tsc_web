<!doctype html>
<html class="no-js" lang="en">
    <head>
        <meta charset="utf-8"/>
        <title>The saving coupon</title>
        <link rel="stylesheet" href="<?php echo base_url() . CSS; ?>foundation.css" />
        <link rel="stylesheet" href="<?php echo base_url() . CSS; ?>jquery.share.css" />
        <link href='http://fonts.googleapis.com/css?family=Roboto' rel='stylesheet' type='text/css'>
        <link rel="stylesheet" href="<?php echo base_url() . CSS; ?>cliente.css" />
        <script src="<?php echo base_url() . JS; ?>vendor/modernizr.js"></script>
        <script type="text/javascript">
            var baseURL = "<?= base_url(); ?>";
        </script>
    </head>
    <body>
        <!-- ................. HEADER ................. --> 
        <div id="container">
            <div id="topLine"></div>
            
            <div class="row">
                <div class="large-6 large-centered columns" >

                    <div class="clearfix"> 
                        <a href="<?php echo base_url(); ?>"><img class="right" src="<?php echo base_url() . IMG; ?>app/logo-min.png"></a>
                    </div>
                </div>
                <br>
                <h2 class="">El equipo de The Saving Coupon agradece su compra.</h2><br/><br/><br/><br/>
                <h3 class="">En breve recibira en su correo electronico su usuario y password 
                    para que pueda disfrutar de todos sus descuentos en la comodidad de sus dispositivos moviles.</h3>
            
            </div>
            
            
            

        </div>


        <input type="hidden" id="baseUrl" value="<?php echo base_url(); ?>" />

        <!-- ................. FOOTER ................. --> 
        <div id="footer">
            <div id="foot-border"></div>
        </div>

        <script src="<?php echo base_url() . JS; ?>vendor/jquery.js"></script>
        <script src="<?php echo base_url() . JS; ?>foundation.min.js"></script>
        <script src="<?php echo base_url() . JS; ?>jquery.share.js"></script>
        <script src="<?php echo base_url().JS; ?>api/cliente.js"></script>
        <script>
            $(document).foundation();
        </script>
    </body>
</html>
