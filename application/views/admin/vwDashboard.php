<?php
$this->load->view('admin/vwHeader');
?>
<!--  
Load Page Specific CSS and JS here
Author : Abhishek R. Kaushik 
Downloaded from http://devzone.co.in
-->
<link href="<?php echo HTTP_CSS_PATH; ?>starter-template.css" rel="stylesheet">
<style>
    .panel{
        margin-left: 55px;
        float: left;
        width: 500px;
        height: 303px;
    }

</style>

<script type="text/javascript" src="https://www.google.com/jsapi"></script>

<div class="page-header container">
    <h1><small>Dashboard</small></h1>
</div>
<div class="container">

    <div class="panel panel-default">
        <!-- Default panel contents -->
        <div class="panel-heading">Cupones por Comercio</div>
        <div class="panel-body">
            <div id="piechart" style="width: 300px; height: 200px;"></div>

        </div>
    </div>


    <div class="panel panel-warning">
        <!-- Default panel contents -->
        <div class="panel-heading">Cupones por Industria</div>
        <div class="panel-body">
            <div id="piechart12" style="width: 300px; height: 200px;"></div>
        </div>
    </div>

</div><!-- /.container -->
<hr>
<?php
$this->load->view('admin/vwFooter');
?>

<script src="<?php echo base_url().JS; ?>api/dashboard.js"></script>