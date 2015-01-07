<!doctype html>
<html class="no-js" lang="en">
  <head>
    <title>The saving coupon</title>
    <link rel="stylesheet" href="<?php echo base_url().CSS; ?>foundation.css" />
    <link rel="stylesheet" href="<?php echo base_url().CSS; ?>jquery.share.css" />
    <link rel="stylesheet" href="<?php echo base_url().CSS; ?>main.css" />
    <script src="<?php echo base_url().JS; ?>vendor/modernizr.js"></script>
  </head>
  <body>

    <!-- ................. HEADER ................. --> 
    <div id="head-content">
      <div id="topLine"></div>
      <div id="topBanner">
        <div class="banner">  
            <ul class="example-orbit" data-orbit>
                <?php foreach ($banner1 as $item):?>
                    <li><a target="_blank" href="<?php echo $item->paginaAsociada;?>"><img src="<?php echo base_url(); ?>assets/img/coupon/<?php echo $item->url;?>" title="<?php echo $item->comercio;?>" /></a></li>
                <?php endforeach;?>
            </ul>
        </div>
      </div>
        
      <div id="head-1">
        <div id="top">
          <div id="headLogo"></div>
          <div id="headRight">
            <div id="subMenu">
              <span>WHAT IS TSC</span>
              <span>GET YOUR COUPON BOOK</span>
              <span>AD WITH US</span>
            </div>

            <div>
              <div id="fieldSearch">
                <input type="text" placeholder="Search by Category">
                <div></div>
              </div>
              <div id="cartDesc">
                <div>
                  <a href="#" data-dropdown="drop" class="small secondary radius button dropdown">Choose you coupon book</a><br>
                  <ul id="drop" data-dropdown-content class="f-dropdown">
                    <li><a class="selCuponera cuponera1" attr-id="1">Standar</a></li>
                    <li><a class="selCuponera cuponera2" attr-id="2">PREMIUM</a></li>
                    <li><a class="selCuponera cuponera3" attr-id="3">V.I.P.</a></li>
                  </ul>
                  <a id="buyCoupons" href="#" class="small button alert disabled">Buy and save!</a>
                </div>
                <div id="descTotal">
                  <span id="lblTotal">TOTAL</span><br/>
                  <span id="fieldTotal">$ 00.00</span>
                </div>
              </div>
              <div id="iconsPayment"></div>
            </div>

          </div>
        </div>
      </div>

      <div id="head-2">
          <div class="row"></div>
      </div>

      <div id="head-3">
        <div id="publish">
            
          <div id="head-float1">
                <?php  
                $count = 0;
                foreach ($display as $item):?>
                    <div class="publishDisplay pd<?php echo ++$count?>"><a target="_blank" href="<?php echo $item->paginaAsociada;?>"><img src="<?php echo base_url(); ?>assets/img/coupon/<?php echo $item->url;?>" title="<?php echo $item->comercio;?>" /></a></div>
                <?php endforeach;?>
          </div>
            
          <div id="head-float2">
            <div id="publish-carrusel">
            </div>

            <div id="btnUp" class="button alert">
              <img src="<?php echo base_url().IMG; ?>app/arrowUp.png">
            </div>
            <div id="btnDown" class="button alert">
              <img src="<?php echo base_url().IMG; ?>app/arrowDown.png">
            </div>
          </div>
        </div>
      </div>
    </div>
      
    <div id="middleBanner">
        <div class="banner">  
            <ul class="example-orbit" data-orbit>
                <?php foreach ($banner2 as $item):?>
                    <li><a target="_blank" href="<?php echo $item->paginaAsociada;?>"><img src="<?php echo base_url(); ?>assets/img/coupon/<?php echo $item->url;?>" title="<?php echo $item->comercio;?>" /></a></li>
                <?php endforeach;?>
            </ul>
        </div>
    </div>

    <!-- ................. CONTAINER ................. --> 
    <div id="container">
      <div id="containerMenu">
        <a id="btnStandar" tipoCupon=1 class="large button">Standar</a>
        <a id="btnPremium" tipoCupon=2 class="large button">PREMIUM</a>
        <a id="btnVip" tipoCupon=3 class="large button">V.I.P.</a>
        
        <div id="backContainer"></div>
      </div>

      <div id="scrollCoupon"> 
      </div>
      
    </div>

    <!-- ................. TEMPLATE COUPON ................. --> 
    <div id="template" style="display: none;">
      <div class="templateCoupon">
        <div class="tmpHead">
          <div class="tmpDesc">
            <div class="tmpDescTop"><span class="red">*</span> DESC_TOP</div>
            <div class="tmpDescMiddle">DESC_MIDDLE</div>
            <div class="tmpDescBottom">DESC_BOTTOM</div>
          </div>
          <div class="tmpButtons">
            <a class="button btnLCoupon btnLCouponL BTN_RGB2" onclick="setLike(this, ID_COUPON, OLD_LIKES);">NO_LIKES LIKES</a>
            VER_MAS
            <div class="tmpSocial"></div>
          </div>
        </div>
        <div class="tmpCupon" style="background: url('assets/img/coupon/IMAGEN_URL') no-repeat;"></div>
      </div>
    </div>
    <!-- ................. TEMPLATE NAVIGATION ................. --> 
    <div id="templateNav" style="display: none;">
      <div class="navigator">
      </div>
    </div>
      
      <!-- ................. TEMPLATE NAVIGATION ................. --> 
      <div id="publishFoot">
        <?php  
            $count = 0;
            foreach ($footer as $item):?>
                <div class="publishFoot pf<?php echo ++$count?>"><a target="_blank" href="<?php echo $item->paginaAsociada;?>"><img src="<?php echo base_url(); ?>assets/img/coupon/<?php echo $item->url;?>" title="<?php echo $item->comercio;?>" /></a></div>
        <?php endforeach;?>
      </div>

    <input type="hidden" id="baseUrl" value="<?php echo base_url(); ?>" />

    <!-- ................. FOOTER ................. --> 
    <div id="footer">
      <div id="foot-border"></div>
    </div>
    
    <script src="<?php echo base_url().JS; ?>vendor/jquery.js"></script>
    <script src="<?php echo base_url().JS; ?>foundation.min.js"></script>
    <script src="<?php echo base_url().JS; ?>foundation/foundation.orbit.js"></script>
    <script src="<?php echo base_url().JS; ?>jquery.share.js"></script>
    <script src="<?php echo base_url().JS; ?>api/main.js"></script>
    <script>
      $(document).foundation({orbit: {timer: true, bullets: false, timer_speed: 5000}});
    </script>
  </body>
</html>
