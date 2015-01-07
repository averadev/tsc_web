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
                        <br><h2 class="left">Crea tu cuenta</h2> 
                        <a href="<?php echo base_url(); ?>"><img class="right" src="<?php echo base_url() . IMG; ?>app/logo-min.png"></a>
                    </div>
                </div>
                
                <div id="tabCmp" class="large-6 large-centered columns">
                    <dl class="tabs" data-tab>
                      <dd class="active"><a href="#panel1">Nuevo usuario</a></dd>
                      <dd><a href="#panel2">Registrado</a></dd>
                    </dl>
                    <div class="tabs-content">
                    <div class="content active" style="float: none;" id="panel1">
                          <div  id="formulario_usuario">
                            <div class="alert-box alert round" id="error"></div>
                            <form class="panel panel-primary radius"> 
                                <div class="email-field"> 
                                    <label>Correo Electronico <small>requerido</small> 
                                        <input type="email" id="correo"> </label> 
                                </div>
                                <div class="email-confirmation-field">
                                    <label>Confirmar correo <small>requerido</small>
                                        <input type="email" id="correoConf">
                                    </label>
                                </div>
                                <div class="password-field">
                                    <label>Contraseña <small>requerido</small>
                                        <input type="password" id="password">
                                    </label>
                                </div>
                                <div class="password-confirmation-field">
                                    <label>Confirmar Contraseña <small>required</small>
                                        <input type="password" id="passwordConf">
                                    </label>
                                </div>
                                <div style="text-align:center;">

                                </div>
                                <input type="button" class="large-12 button radius" value="Registrate" id="btnGuardar"> 
                            </form>
                        </div>
                          
                      </div>
                        
                      <div class="content" style="float: none;" id="panel2">
                          <div  id="formulario_usuario">
                            <div class="alert-box alert round" id="error2"></div>
                            <form class="panel panel-primary radius"> 
                                <div class="email-field"> 
                                    <label>Correo Electronico <small>requerido</small> 
                                        <input type="email" id="correo2"> </label> 
                                </div>
                                <div class="password-field">
                                    <label>Contraseña <small>requerido</small>
                                        <input type="password" id="password2">
                                    </label>
                                </div>
                                <div style="text-align:center;">

                                </div>
                                <input type="button" class="large-12 button radius" value="Ingresa" id="btnGuardar2"> 
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
                        <li class="description">Cuponera <?= $nombre; ?></li> 
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
