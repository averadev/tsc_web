<?php
$this->load->view('admin/vwHeader');
?>

<div class="page-header container">
  <h1><small>Industrias</small></h1>
</div>

<div id="slider" class="owl-carousel">

  <!-- __________ TABLA __________ -->
  <div class="item">
    <div class="container" style="width:600px;">
      <div class="input-group">
        <input id="txtSearch" type="text"placeholder="Busqueda por nombre" class="form-control">
        <span class="input-group-addon btnSearch"><i class="fam-search"></i> Buscar</span>
      </div>
      <br/>
      <p class="bg-info">La información se almaceno satisfactoriamente.</p>
 
      <div class="panel panel-default" >
        <!-- Default panel contents -->
        <div class="panel-heading">Lista de Industrias <span style='float:right; margin-top: -7px;'><a href='#' title='View' class="btn btn-primary btnAdd"><i class="fam-plus"></i> Industria  </a></span></div>

        <!-- Table -->
        <table class="table table-striped table-hover">
          <thead>
            <tr>
              <th>#</th>
              <th>Nombre</th>
            </tr>
          </thead>
          <tbody id="bodyTable">
          </tbody>
        </table>
      </div>
 
      <ul class="pagination">
     </ul>
    </div><!-- /.container -->
  </div>

  <!-- __________ FORMULARIO __________ -->
  <div class="item">
    <div class="container" style="width:600px;">
      <form role="form">
        <p class="bg-danger">Los campos marcados (<span class="redPoint">*</span>), son obligatorios...</p>

        <input id="hideID" type="hidden" value="0">
        <div class="form-group">
            <label for="txtNombre"><span class="redPoint">*</span>Nombre</label>
            <input type="text" class="form-control" id="txtNombre">
        </div>
        <div class="form-group">
            <label for="txtComercio"><span class="redPoint"></span>Categoria Padre</label><br/>
            <input type="text" class="form-control twitter-typeahead" id="txtPadre">
            <input id="hideIdPadre" type="hidden" value="">
        </div>
        <br/><br/>
        <a id="btnGuardar" class="btn btn-primary pull-right">Guardar</a>
        <a id="btnCancelar" class="btn btn-danger pull-right">Cancelar</a>
      </form>
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
<script src="<?php echo base_url().JS; ?>api/industria.js"></script>