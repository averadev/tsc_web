<?php
$this->load->view('admin/vwHeaderComer');
?>
<!--  
Load Page Specific CSS and JS here
Author : Abhishek R. Kaushik 
Downloaded from http://devzone.co.in
-->
<style>
   .panel-green {
		border-color: #5cb85c;
	}
	.panel-green .panel-heading {
			border-color: #5cb85c;
			color: white;
			background-color: #5cb85c;
	}
	.panel-green a {
		color: #5cb85c;
	}
	.panel-green a:hover {
		color: darken(@brand-success, 15%);
	}
	
	.panel-red {
		border-color: #d9534f;
	}
	.panel-red .panel-heading {
			border-color: #d9534f;
			color: white;
			background-color: #d9534f;
	}
	.panel-red a {
		color: #d9534f;
	}
	.panel-red a:hover {
		color: darken(@brand-success, 15%);
	}
	
	.panel-other {
		border-color: #ad97e2;
	}
	.panel-other .panel-heading {
			border-color: #ad97e2;
			color: white;
			background-color: #ad97e2;
	}
	.panel-other a {
		color: #ad97e2;
	}
	.panel-other a:hover {
		color: darken(@brand-success, 15%);
	}
</style>


	<br/><br/>
	<div class="container">
		<div class="row">
			<h1><small>Dashboard</small></h1>
			<hr>
		</div>
		
		<br/>
		<div class="row">
			<div class="col-lg-6 col-md-8">
				<div class="panel panel-default panel1">
					<!-- Default panel contents -->
					<div class="panel-heading">Redimir Cupón</div>
					<div class="panel-body">
						<p class="bg-danger"></p>
						<p class="bg-info"></p>
						<div class="form-group">
							<label for="txtNombre">CODIGÓ</label>
							<div class="input-group" style="width:300px">
								<input id="txtCodigo" type="text" class="form-control" style="text-transform: uppercase;" >
								<span class="input-group-addon btnSearch"> Canjear</span>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<br/>
		
		<div class="row">
			<div class="col-lg-3 col-md-6">
				<div class="panel panel-primary">
					<div class="panel-heading">
						<div class="row">
							<div class="col-xs-3">
								<img src="<?php echo base_url().IMG; ?>app/iconCoupon.png" />
							</div>
							<div class="col-xs-9 text-right">
								<h1><?php echo $totales->activos;?></h1>
								<div>Cupones Activos</div>
							</div>
						</div>
					</div>
					<a href="#">
						<div class="panel-footer">
							<span class="pull-right" onclick="$('#myCoupons').toggle('slow');">Ver detalle</span>
							<div class="clearfix"></div>
						</div>
					</a>
				</div>
			</div>
			<div class="col-lg-3 col-md-6">
				<div class="panel panel-green">
					<div class="panel-heading">
						<div class="row">
							<div class="col-xs-3">
								<img src="<?php echo base_url().IMG; ?>app/iconCoupon.png" />
							</div>
							<div class="col-xs-9 text-right">
								<h1><?php echo $totales->circulacion;?></h1>
								<div>Total en Circulacion</div>
							</div>
						</div>
					</div>
					<a href="#">
						<div class="panel-footer">&nbsp;</div>
					</a>
				</div>
			</div>
			<div class="col-lg-3 col-md-6">
				<div class="panel panel-red">
					<div class="panel-heading">
						<div class="row">
							<div class="col-xs-3">
								<img src="<?php echo base_url().IMG; ?>app/iconCoupon.png" />
							</div>
							<div class="col-xs-9 text-right">
								<h1><?php echo $totales->redimidos;?></h1>
								<div>Total Redimidos</div>
							</div>
						</div>
					</div>
					<a href="#">
						<div class="panel-footer">&nbsp;</div>
					</a>
				</div>
			</div>
			<div class="col-lg-3 col-md-6">
				<div class="panel panel-other">
					<div class="panel-heading">
						<div class="row">
							<div class="col-xs-3">
								<img src="<?php echo base_url().IMG; ?>app/iconLikes.png" />
							</div>
							<div class="col-xs-9 text-right">
								<h1><?php echo $totales->likes;?></h1>
								<div>Likes</div>
							</div>
						</div>
					</div>
					<a href="#">
						<div class="panel-footer">&nbsp;</div>
					</a>
				</div>
			</div>
			
		</div>
		
		<div id = "myCoupons" class="row" style="display:none;">
			<hr>
			<?php foreach ($cupones as $item):?>
                <div class="col-lg-3 col-md-4" style="margin-right:25px"><img src="<?php echo base_url().IMG; ?>coupon/<?php echo $item->url;?>" /></div>
            <?php endforeach;?>
		</div>
		
    </div>


<br/><br/>
<hr>
<?php
$this->load->view('admin/vwFooter');
?>

<script src="<?php echo base_url().JS; ?>api/dash.js"></script>