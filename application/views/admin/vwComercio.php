<?php
$this->load->view('admin/vwHeader');
?>

<div class="page-header container">
  <h1><small>Comercios</small></h1>
</div>

<div id="slider" class="owl-carousel">

  <!-- __________ TABLA __________ -->
  <div class="item">
    <div class="container">
      <div class="input-group">
        <input id="txtSearch" type="text"placeholder="Busqueda por nombre o servicio" class="form-control">
        <span class="input-group-addon btnSearch"><i class="fam-search"></i> Buscar</span>
      </div>
      <br/>
      <p class="bg-info">La información se almaceno satisfactoriamente.</p>
 
      <div class="panel panel-default" >
        <!-- Default panel contents -->
        <div class="panel-heading">Lista de Comercios <span style='float:right; margin-top: -7px;'><a href='#' title='View' class="btn btn-primary btnAdd"><i class="fam-plus"></i> Comercio  </a></span></div>

        <!-- Table -->
        <table class="table table-striped table-hover">
          <thead>
            <tr>
              <th>#</th>
              <th>Nombre</th>
              <th>Usuario</th>
              <th>Dirección</th>
              <th>Servicios</th>
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
    <div class="container" style="width:850px;">
      
        
        <p class="bg-danger">Los campos marcados (<span class="redPoint">*</span>), son obligatorios...</p>

        <table>
          <tr>
            <td width="550">
              <input id="hideID" type="hidden" value="0">
              <div class="form-group">
                <label for="txtNombre"><span class="redPoint">*</span>Nombre</label>
                <input type="text" class="form-control" id="txtNombre">
              </div>
              <div class="form-group">
                <label for="txtDireccion"><span class="redPoint">*</span>Dirección</label>
                <textarea class="form-control" id="txtDireccion"></textarea>
              </div>
              <div class="form-group">
                <label for="txtServicios"><span class="redPoint">*</span>Servicios</label>
                <textarea class="form-control" id="txtServicios"></textarea>
              </div>
            </td>

            <td>

              <div class="panel panel-default" style="margin-left:20px; margin-top: 10px; width: 270px;">
                <!-- Default panel contents -->
                <div class="panel-heading"><b>Industria</b></div>
                <!-- Table -->
                <table class="table table-striped table-hover">
                  <tbody id="bodyIndustrias" style="display: block; max-height: 195px; overflow-y: scroll">
                  </tbody>
                </table>
              </div>

            </td>
          </tr>
        </table>
          
        <hr/>
        <table>
          <tr>
            <td width="300">
              <div class="form-group">
                <label for="txtUsuario">Email (usuario)</label>
                <input type="text" class="form-control" id="txtUsuario" style="width: 250px;">
              </div>
            </td>
            <td width="300">
              <div class="form-group">
                <label for="txtPass">Password</label>
                <input type="password" class="form-control" id="txtPass" style="width: 250px;">
              </div>
            </td>
            <td width="300">
              <div class="form-group">
                <label for="txtRePass">Re-Password</label>
                <input type="password" class="form-control" id="txtRePass" style="width: 250px;">
              </div>
            </td>
          </tr>
        </table>
          
        <hr/>
        <table>
          <tr>
            <td width="300">
              <div class="form-group">
                <label for="txtFacebook">Facebook</label>
                <input type="text" class="form-control" id="txtFacebook" style="width: 250px;">
              </div>
            </td>
            <td width="300">
              <div class="form-group">
                <label for="txtTwitter">Twitter</label>
                <input type="text" class="form-control" id="txtTwitter" style="width: 250px;">
              </div>
            </td>
            <td width="300">
              <div class="form-group">
                <label for="txtTripAdvisor">TripAdvisor</label>
                <input type="text" class="form-control" id="txtTripAdvisor" style="width: 250px;">
              </div>
            </td>
          </tr>
        </table>
          
        
        
        <hr/>
        <div class="form-group">
            <input id='chkMicrositio' type='checkbox' />
            <label for="chkMicrositio">Micrositio</label>
        </div>
        <table>
           <tr>
            <td width="250">
                <div class="form-group">
                    <label for="txtTelefono">Telefono</label>
                    <input type="text" class="form-control" id="txtTelefono" style="width: 200px;">
                </div>
                <div class="form-group">
                    <label for="txtEmail">Email</label>
                    <input type="text" class="form-control" id="txtEmail" style="width: 200px;">
                </div>
                <div class="form-group">
                    <label for="txtLatitud">Latitud</label>
                    <input type="text" class="form-control" id="txtLatitud" style="width: 200px;">
                </div>
                <div class="form-group">
                    <label for="txtLongitud">Longitud</label>
                    <input type="text" class="form-control" id="txtLongitud" style="width: 200px;">
                </div>
            </td>
            <td width="600">
              <form id="uploadFile" action="uploadFile" method="post" enctype="multipart/form-data">
                <div class="droparea typeCom">
                  <center>
                    <span class="redPoint">*</span>Seleccione el encabezado
                    <br/><h6>(600 x 240)</h6>
                  </center>
                </div>
                <input name="ImageFile" id="imageInput" type="file" accept="image/*" />
              </form>
              <input id="hideURL" type="hidden" value="">
            </td>
          </tr>
        </table>

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

<script src="<?php echo base_url().JS; ?>api/bootbox.js"></script>
<script src="<?php echo base_url().JS; ?>jquery.form.js"></script>
<script src="<?php echo base_url().JS; ?>typeahead.jquery.js"></script>
<script src="<?php echo base_url().JS; ?>api/comercios.js"></script>