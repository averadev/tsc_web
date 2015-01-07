<?php
$this->load->view('admin/vwHeader');
?>

<div class="page-header container">
  <h1><small>Publicidad en Display</small></h1>
</div>

<div id="slider" class="owl-carousel">

  <!-- __________ TABLA __________ -->
  <div class="item">
    <div class="container" style="width:800px;">
      <div class="input-group">
        <input id="txtSearch" type="text"placeholder="Busqueda por descripcion o comercio" class="form-control">
        <span class="input-group-addon btnSearch"><i class="fam-search"></i> Buscar</span>
      </div>
      <br/>
      <p class="bg-info">La información se almaceno satisfactoriamente.</p>
 
      <div class="panel panel-default" >
        <!-- Default panel contents -->
        <div class="panel-heading">Lista de publicidad <span style='float:right; margin-top: -7px;'><a href='#' title='View' class="btn btn-primary btnAdd"><i class="fam-plus"></i> Display </a></span></div>

        <!-- Table -->
        <table class="table table-striped table-hover">
          <thead>
            <tr>
              <th>#</th>
              <th>Descripcion</th>
              <th>Comercio</th>
            </tr>
          </thead>
          <tbody id="bodyTable">
          </tbody>
        </table>
      </div>
    </div><!-- /.container -->
  </div>

  <!-- __________ FORMULARIO __________ -->
  <div class="item">
    <div class="container" style="width:800px;">
        <p class="bg-danger">Los campos marcados (<span class="redPoint">*</span>), son obligatorios...</p>
        <p id="alert" class="bg-danger2">La fecha inicio, no puede ser mayor a la fecha fin.</p>
        <input id="hideID" type="hidden" value="0">
        <input id="hideIDComercio" type="hidden" value="">
        
        
        <table>
          <tr>
            <td width="470">
                <div class="form-group">
                    <label for="txtComercio"><span class="redPoint">*</span>Comercio</label><br/>
                    <input type="text" class="form-control twitter-typeahead" id="txtComercio">
                </div>
                <div class="form-group">
                    <label for="txtDescripcion"><span class="redPoint">*</span>Descripcion</label>
                    <textarea class="form-control" id="txtDescripcion"></textarea>
                </div>
                <div class="form-group">
                    <label for="txtURL">Pagina asociada</label>
                    <input type="text" class="form-control" placeholder="www.paginaweb.com" id="txtURL">
                </div>
            </td>
            <td width="230" valign="top" style="padding-top:25px;">
                <input id="hideURL" type="hidden" value="">
                <form id="uploadFile" action="uploadFile" method="post" enctype="multipart/form-data">
                    <div class="droparea typeC">
                      <center>
                        <span class="redPoint">*</span>Seleccione la publicidad
                      </center>
                    </div>
                    <input name="ImageFile" id="imageInput" type="file" accept="image/*" />
                </form>

            </td>
          </tr>
        </table>
    
    </div>
    <div class="container" style="width:800px;">

        <a id="btnGuardar" class="btn btn-primary pull-right">Guardar</a>
        <a id="btnCancelar" class="btn btn-danger pull-right">Cancelar</a>
    </div>
  </div>
</div>

<!-- __________ HIDE MODAL __________ -->
<div class="modal fade modal-delete" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-sm">
    <div class="modal-content">

      <div class="modal-body">
        <h4 class="modal-title" id="mySmallModalLabel">¿Desea eliminar el registro?</h4>
        <br/><span id="delNombre"></span>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
        <button id="btnDeleteModal" type="button" class="btn btn-primary" data-dismiss="modal">Eliminar</button>
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->



<hr>     
<?php
$this->load->view('admin/vwFooter');
?>
<script src="<?php echo base_url().JS; ?>jquery.form.js"></script>
<script src="<?php echo base_url().JS; ?>typeahead.jquery.js"></script>
<script src="<?php echo base_url().JS; ?>bootstrap-datepicker.js"></script>
<script src="<?php echo base_url().JS; ?>api/display.js"></script>