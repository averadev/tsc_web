<!doctype html>
<html class="no-js" lang="en">
    <head>
        <meta charset="utf-8"/>
        <title>The saving coupon</title>
        <link rel="stylesheet" href="<?php echo base_url() . CSS; ?>foundation.css" />
        <link rel="stylesheet" href="<?php echo base_url() . CSS; ?>jquery.share.css" />
        <link rel="stylesheet" href="<?php echo base_url() . CSS; ?>comercio.css" />
        <script src="<?php echo base_url() . JS; ?>vendor/modernizr.js"></script>
        <script src="https://maps.googleapis.com/maps/api/js"></script>
        <style>
    </style>

    <script>
      function initialize() {
        var mapCanvas = document.getElementById('map_canvas');
       
        var myLatlng = new google.maps.LatLng(<?= $latitud; ?>,<?= $longitud; ?>);
        var mapOptions = {
          center: myLatlng,
          zoom: 14,
          mapTypeId: google.maps.MapTypeId.ROADMAP
        }
        var map = new google.maps.Map(mapCanvas, mapOptions)
        var marker = new google.maps.Marker({
          position: myLatlng,
          map: map
        });
      }
      google.maps.event.addDomListener(window, 'load', initialize);
    </script>

    </head>
    <body>
        <!-- ................. CONTAINER ................. --> 
        <div id="container">
            <div id="topLine"></div>
            
            <div class="row">
                <div id="head-2"> <a href="<?php echo base_url(); ?>"><img src="<?php echo base_url().IMG ?>app/logo-Xmin.png"/></a> </div>
            </div>
            
            <div class="row" data-equalizer>
                <div class="large-7 columns info" data-equalizer-watch>
                    <h3><?= $nombre ;?></h3>
                    <p><?= $servicios; ?></p>

                    <div class="section-container tabs" data-section>
                        <section class="section">
                            <div class="content" data-slug="panel1">
                                <div id="slider">
                                    <img src="<?php echo base_url().IMG ?>coupon/<?= $banner; ?>"/>
                                </div>
                            </div>
                        </section>
                        <section class="section">
                            <h5 class="title">Cupones:</h5>
                            <div class="content" data-slug="panel2">
                                <ul class="large-block-grid-2">
                                    <?php foreach ($cupones as $item):?>
                                        <li><img style="border: solid 1px;" src="<?php echo base_url().IMG ?>coupon/<?= $item->url; ?>"></li>
                                    <?php endforeach;?>
                                </ul>
                            </div>
                        </section>
                    </div>
                </div>
                
                <div class="large-5 columns" data-equalizer-watch>
                    <div id="secRight">
                        <h5>Comparte en: </h5>
                        <div id="tmpSocial"></div>
                        
                        <h5>Contáctanos:</h5>
                        <p class="contactInfo"><b>Mail:</b>  <?= $correo; ?></p>
                        <p class="contactInfo"><b>Tel:</b>  <?= $telefono; ?></p>
                        <p class="contactInfo"><b>Dirección:</b> <?= $direccion; ?></p>
                        
                        <div id="map_canvas"></div>
                        
                    </div>
                </div>
            </div>
        </div>


        <!-- ................. FOOTER ................. --> 
        <div id="footer">
            <div id="foot-border"></div>
        </div>

        <script src="<?php echo base_url() . JS; ?>vendor/jquery.js"></script>
        <script src="<?php echo base_url() . JS; ?>foundation.min.js"></script>
        <script src="<?php echo base_url() . JS; ?>jquery.share.js"></script>
        <script src="<?php echo base_url() . JS; ?>api/comercio.js"></script>
        <script>
            $(document).foundation();
            var mapCanvas = document.getElementById('map_canvas');
            var map = new google.maps.Map(mapCanvas);
        </script>
    </body>
</html>
