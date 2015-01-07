<?php
$this->load->view('admin/vwHeaderComer');
?>
<!--  
Load Page Specific CSS and JS here
Author : Abhishek R. Kaushik 
Downloaded from http://devzone.co.in
-->
<style>
    .panel{
        margin-left: 55px;
        float: left;
        width: 500px;
        height: 303px;
    }
    .panel1{
        height: 203px;
    }
    .panel1 .panel-body{
        padding: 25px 90px;
    }
</style>


<div class="page-header container">
    <h1><small>Dashboard</small></h1>
</div>
<div class="container">

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
    

</div><!-- /.container -->
<hr>
<?php
$this->load->view('admin/vwFooter');
?>

<script src="<?php echo base_url().JS; ?>api/dash.js"></script>