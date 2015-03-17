<!doctype html>
<html class="no-js" lang="en">
  <head>
    <title>The saving coupon</title>
    <link rel="stylesheet" href="<?php echo base_url().CSS; ?>foundation.css" />
    <link rel="stylesheet" href="<?php echo base_url().CSS; ?>jquery.share.css" />
    <link rel="stylesheet" href="<?php echo base_url().CSS; ?>about.css" />
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
              <span id="menu1">WHAT IS TSC</span>
              <span id="menu2">GET YOUR COUPON BOOK</span>
              <span id="menu3">AD WITH US</span>
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

    </div>
    <!-- ................. CONTAINER ................. --> 
	<div id="whatis">
		<div class="row title">
			<center>WHAT IS TSC</center>
		</div>
		<div class="row subtitle">
			<center>The Saving Coupon is a coupon book that makes you save big money. You have three coupon book options:</center>
		</div>
		<div class="row descbook">
			<div class="medium-4 columns">
				<center>
					<img src="<?php echo base_url().IMG; ?>app/iconImgStandar.png" />
					<p class="type">Standar</p>
					<p class="info">All the participating shops with any discount or free gift</p>
				</center>
			</div>
			<div class="medium-4 columns">
				<center>
					<img src="<?php echo base_url().IMG; ?>app/iconImgPremium.png" />
					<p class="type">Premium</p>
					<p class="info">A selected group of the standar but with better discounts and/or better free gifts</p>
				</center>
			</div>
			<div class="medium-4 columns">
				<center>
					<img src="<?php echo base_url().IMG; ?>app/iconImgVip.png" />
					<p class="type">The VIP</p>
					<p class="info">The best places and brands with the best discounts and gifts for you. 
						You can select just the ones you want to use and they will be placed at the beginning of you coupon book.
						Top brands with special discounts!!!
					</p>
				</center>
			</div>
		</div>
	</div>
	  
	<div id="orangeBand">
		<div class="row">
			<center>When you get the Premium, it includes the Standar coupons. When getting the VIP, you get the Standar and Premium coupons too!</center>
		</div>
	</div>
	  
	<div id="howork">
		<div class="row title">
			<center>How does it work?</center>
		</div>
		<div class="row descwork">
			<div class="medium-1 columns">&nbsp;</div>
			<div class="medium-3 columns">
				<p class="step">STEP 1</p>
				<p class="step selected">STEP 2</p>
				<p class="step">STEP 3</p>
				<p class="step">STEP 4</p>
			</div>
			<div class="medium-4 columns">
				<p class="info">You will find a PDF to see you coupons in your smartphone or even you can print them!</p>
			</div>
			<div class="medium-3 columns">
				<img src="<?php echo base_url().IMG; ?>app/imgStep2.png" />
			</div>
			<div class="medium-1 columns">&nbsp;</div>
		</div>
		
		<div id="howIget" class="row howget">
			<center>How do I get my discounts??</center>
		</div>
	</div>
	  
	<div id="orangeBand">
		<div class="row">
			<p class="howDesc">When you get in to a participate shop, tell to the attendant about the coupon, 
				they will check the coupon code number on their system and then you get your discount!!</p>
			<p class="howTitle">Start saving with a simple click!!!</p>
		</div>
	</div>
	  
	<div class="row howget">
		<center>How do I get my discounts??</center>
	</div>
	
	<div class="orangeBand2">
		<div class="row howTop">
			<div class="medium-4 columns">
				<h2>1</h2>
				<center><img src="<?php echo base_url().IMG; ?>app/getIcon1.png" /></center>
			</div>
			<div class="medium-4 columns middle">
				<h2>2</h2>
				<center><img src="<?php echo base_url().IMG; ?>app/getIcon2.png" /></center>
			</div>
			<div class="medium-4 columns">
				<h2>3</h2>
				<center><img src="<?php echo base_url().IMG; ?>app/getIcon3.png" /></center>
			</div>
		</div>
	</div>
	<div class="orangeBand">
		<div class="row howbottom">
			<div class="medium-4 columns">Take a look on the three different coupon book</div>
			<div class="medium-4 columns middle">Choose the one that fits you the best for your trip</div>
			<div class="medium-4 columns">Make your payment and we will send your confirmation an your PDF coupon book by e-mail. 
				You can print it out or keep it in your e-mail box with the PDF file or you can download our free App.</div>
		</div>
	</div>
	  
	<div class="grayBand">
		<div class="row">
			Once you get in Cozumel, open The Saving Coupons App and will see all your coupons plus the most
			important info in the Island! (Maps, weather, local time, etc...)
		</div>
	</div>
	  
	<div id="addwith" class="row howget">
		<center>Add with us</center>
	</div>
	<div class="row addInfo">
		Would you like to Add with us?<br/>
		Send us an e-mail with all your info and we will contact you as soon as possible.<br/>
		tscadd@thesavingcoupon.com		
	</div>
	  
	<form>
		<div class="row">
			<div class="small-1 large-2 columns">&nbsp;</div>
			<div class="small-5 large-4 columns">
				<input type="text" class="radius" placeholder="Whats your name?" />
				<input type="text" class="radius" placeholder="And your email?" />
				<input type="text" class="radius" placeholder="Where are you from?" />
			</div>
			<div class="small-5 large-4 columns">
				<textarea class="radius" placeholder="Comments, thoughts or questions?"></textarea>
			</div>
			<div class="small-1 large-2 columns">&nbsp;</div>
		</div>
		<div class="row">
			<div class="small-1 large-2 columns">&nbsp;</div>
			<div class="small-10 large-8 columns orangeBtn">
				PRESS HERE AND SEND US A MESSAGE
			</div>
			<div class="small-1 large-2 columns">&nbsp;</div>
		</div>
	</form>
	  
	<div class="orangeBand">
		<div class="row infoContact">
			<div class="medium-1 columns">&nbsp;</div>
			<div class="medium-1 columns"><img src="<?php echo base_url().IMG; ?>app/contactPhone.png" /></div>
			<div class="medium-4 columns">
				THE SAVING COUPON TRADE MARK<br/>	
				Whatsapp: +52 1 222 359 72 76
			</div>
			<div class="medium-1 columns">&nbsp;</div>
			<div class="medium-1 columns"><img src="<?php echo base_url().IMG; ?>app/contactLocalizacion.png" /></div>
			<div class="medium-4 columns">
				Office: Av. Rafael E. Melgar #125 2nd Floor,<br/>	
				Col. Centro CP.	77600, Cozumel, Mexico.<br/>	
				tscadd@thesavingcoupon.com
			</div>
		</div>
	</div>
	
	  
	  
	  
    <!-- ................. FOOTER ................. --> 
	<div id="foot-info">
		<div class="row">
			<div class="medium-5 columns"><center><a><img src="<?php echo base_url().IMG; ?>app/socialFB.png" /></a></center></div>
			<div class="medium-2 columns"><center><a><img src="<?php echo base_url().IMG; ?>app/socialTW.png" /></a></center></div>
			<div class="medium-5 columns"><center><a><img src="<?php echo base_url().IMG; ?>app/logoFoot.png" /></a></center></div>
		</div>
	</div>
    <div id="footer">
      	@ Copyrigth 2014
    </div>
    
    <script src="<?php echo base_url().JS; ?>vendor/jquery.js"></script>
    <script src="<?php echo base_url().JS; ?>foundation.min.js"></script>
    <script src="<?php echo base_url().JS; ?>foundation/foundation.orbit.js"></script>
    <script src="<?php echo base_url().JS; ?>jquery.share.js"></script>
    <script src="<?php echo base_url().JS; ?>api/about.js"></script>
    <script>
      $(document).foundation({orbit: {timer: true, bullets: false, timer_speed: 5000}});
    </script>
  </body>
</html>
