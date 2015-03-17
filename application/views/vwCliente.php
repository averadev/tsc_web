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
            var tipo_cupon = <?= $id; ?>;
            var costo = <?= $costo; ?>;
            var nombre = "<?= $nombre; ?>";
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
                        <br><h2 class="left">Create a Account</h2> 
                        <a href="<?php echo base_url(); ?>"><img class="right" src="<?php echo base_url() . IMG; ?>app/logo-min.png"></a>
                    </div>
                </div>
                
                <div id="tabCmp" class="large-6 large-centered columns">
                    <dl class="tabs" data-tab>
                      <dd class="active"><a href="#panel1">New Account</a></dd>
                      <dd><a href="#panel2">Sign up</a></dd>
                    </dl>
                    <div class="tabs-content">
                    <div class="content active" style="float: none;" id="panel1">
                          <div  id="formulario_usuario">
                            <div class="alert-box alert round" id="error"></div>
                            <form class="panel panel-primary radius"> 
                                <div class="email-field"> 
                                    <label>Email <small>required</small> 
                                        <input type="email" id="correo"> </label> 
                                </div>
                                <div class="email-confirmation-field">
                                    <label>Confirm Email <small>required</small>
                                        <input type="email" id="correoConf">
                                    </label>
                                </div>
                                <div class="password-field">
                                    <label>Password <small>required</small>
                                        <input type="password" id="password">
                                    </label>
                                </div>
                                <div class="password-confirmation-field">
                                    <label>Confirm Password <small>required</small>
                                        <input type="password" id="passwordConf">
                                    </label>
                                </div>
								
								<div class="field">
                                    <label>Name 
                                        <input type="text" id="txtname">
                                    </label>
                                </div>
								<div class="field">
                                    <label>Country 
                                        <input type="text" id="txtcountry">
                                    </label>
                                </div>
								<div class="field">
                                    <label>Stay Dates
                                        <input type="text" id="txtstay" placeholder="(ejem: Febrary/10 - Febrary/20  )">
                                    </label>
                                </div>
								
								<div class="field terms">
                                    <input id="chkTerms" type="checkbox">
									<label for="chkTerms">I have read and agree to the <a href="#" data-reveal-id="myModal">Terms &amp; Conditions</a>.</label>
                                </div>
								
                                <div style="text-align:center;"></div>
                                <input type="button" class="large-12 button radius" value="Join Now" id="btnGuardar"> 
                            </form>
                        </div>
                          
                      </div>
                        
                      <div class="content" style="float: none;" id="panel2">
                          <div  id="formulario_usuario">
                            <div class="alert-box alert round" id="error2"></div>
                            <form class="panel panel-primary radius"> 
                                <div class="email-field"> 
                                    <label>Email <small>required</small> 
                                        <input type="email" id="correo2"> </label> 
                                </div>
                                <div class="password-field">
                                    <label>Password <small>required</small>
                                        <input type="password" id="password2">
                                    </label>
                                </div>
								<div class="field terms">
                                    <input id="chkTerms2" type="checkbox">
									<label for="chkTerms2">I have read and agree to the <a href="#" data-reveal-id="myModal">Terms &amp; Conditions</a>.</label>
                                </div>
								
                                <div style="text-align:center;"></div>
                                <input type="button" class="large-12 button radius" value="Sign up" id="btnGuardar2"> 
                            </form>
                        </div>
                          
                      </div>
                    </div>    
                </div>
            
            <div id="formulario_paypal">
                <div class="large-6 large-centered columns">
                    <ul class="pricing-table"> 
                        <li class="title"><?= $nombre; ?></li> 
                        <li class="price">$<?= $costo; ?> MXN</li> 
                        <li class="description">Coupon Book <?= $nombre; ?></li> 
                        <li class="cta-button"><form action="https://www.paypal.com/cgi-bin/webscr" method="post">
                        <input type="hidden" name="cmd" value="_xclick">
                        <input type="hidden" name="business" value="ventas@geekbucket.com.mx">
                        <input type="hidden" name="item_name" value="Cuponera <?= $nombre; ?>">
                        <input type="hidden" name="return" value="<?= base_url(); ?>cuponera/success" />
                        <input type="hidden" name="cancel_return" value="<?= base_url(); ?>" />
                        <input type="hidden" name="notify_url" value="<?= base_url(); ?>cuponera/pay" />    
                        <input type="hidden" name="item_number" value="1">
                        <input type="hidden" name="amount" value="<?= $costo; ?>">
                        <input type="hidden" name="no_shipping" value="0">
                        <input type="hidden" name="no_note" value="1">
                        <input type="hidden" name="currency_code" value="MXN">
                        <input type="hidden" name="bn" value="PP-BuyNowBF">
                        <input type="image" src="https://www.paypal.com/es_XC/i/btn/btn_xpressCheckout.gif" border="0" name="submit" alt="PayPal - The safer, easier way to pay online.">
                    </form></li> 
                    </ul>
                    
                </div>
            </div>
                </div>

        </div>
		
		
		<div id="myModal" class="reveal-modal" data-reveal>
		  <p style="font-size: xx-large;">Terms &amp; Conditions.</p>
		  <p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor. Aenean massa. 
			  Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Donec quam felis, 
			  ultricies nec, pellentesque eu, pretium quis, sem. Nulla consequat massa quis enim. Donec pede justo, 
			  fringilla vel, aliquet nec, vulputate eget, arcu. In enim justo, rhoncus ut, imperdiet a, venenatis vitae, justo. 
			</p>
			<p>
			  Nullam dictum felis eu pede mollis pretium. Integer tincidunt. Cras dapibus. Vivamus elementum semper nisi. 
				Aenean vulputate eleifend tellus. Aenean leo ligula, porttitor eu, consequat vitae, eleifend ac, enim. 
				Aliquam lorem ante, dapibus in, viverra quis, feugiat a, tellus. Phasellus viverra nulla ut metus varius laoreet. 
				Quisque rutrum. Aenean imperdiet. Etiam ultricies nisi vel augue. Curabitur ullamcorper ultricies nisi. Nam eget dui. 
				Etiam rhoncus. Maecenas tempus, tellus eget condimentum rhoncus, sem quam semper libero, sit amet adipiscing 
				sem neque sed ipsum. Nam quam nunc, blandit vel, luctus pulvinar, hendrerit id, lorem. Maecenas nec odio et 
				ante tincidunt tempus. Donec vitae sapien ut libero venenatis faucibus. Nullam quis ante. Etiam sit amet orci eget eros faucibus tincidunt.</p>
		  <a class="close-reveal-modal">&#215;</a>
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
