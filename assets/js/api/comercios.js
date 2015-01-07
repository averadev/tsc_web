var SLIDER = null;

$(function() {
	
	//  Eventos de Botones
	$(".btnSearch").click(function() {
		getSearch();
	});
	$("#txtSearch").keypress(function(e) {
	    if(e.which == 13) { getSearch(); }
	});
	$(".btnAdd").click(function() {
		SLIDER.next();
	});
	$("#btnDeleteModal").click(function() {
		deleteRow($(this).attr("attr-id"));
	});
	$("#btnGuardar").click(function() {
		save();
	});
	$("#btnCancelar").click(function() {
		clearData();
		SLIDER.prev();
	});

	// Slider
	$("#slider").owlCarousel({
		navigation : false,
		slideSpeed : 500,
		paginationSpeed : 400,
		singleItem:true,
		mouseDrag: false,
		touchDrag: false
  	});
  	SLIDER = $("#slider").data('owlCarousel');
    
    // Upload
	$(".droparea").click(function() {
		$("#imageInput").click();
	}); 
   	$("#imageInput").change(function (){
		if($(this).val() != ''){
            $('#uploadFile').submit();
   		}
     });
	$('#uploadFile').ajaxForm({
	    beforeSend: function() {
	    },
		complete: function(xhr) {
			$('.droparea').html('');
			$("#hideURL").val(xhr.responseText);
			$('.droparea').css('background', "url('../assets/img/coupon/"+xhr.responseText+"')  no-repeat");
		}
	});  

	// Init data
	getSearch();
	getIndustrias();
});

/**
 * Replace All Function
 */
 String.prototype.replaceAll = function(find, replace){
    return this.replace(new RegExp(find, 'g'), replace);
}

/**
 * Arma la tabla del catalogo
 */
function setRowTable(data){
	// Template Row
	var tmpRows = "";
	var templateR = "";
	var template = "<tr><td class='idRow'>ID</td>"+
        "<td><a class='editRow' attr-id='ID'>NOMBRE<a></td>"+
        "<td>USUARIO</td>"+
        "<td>DIRECCION</td>"+
        "<td>SERVICIOS</td>"+
        "<td width='80'>"+
          "<a href='#' attr-id='ID' attr-name='NOMBRE' title='Eliminar' class='btn btn-danger btn-xs btnDelete' style='margin-left: 20px;'"+
          " data-toggle='modal' data-target='.modal-delete'><i class='fam-delete'></i></a>"+
        "</td></tr>";

	// Recorrer elementos
	for(i = 0; i < data.length; i++){
        var usuario = data[i].usuario;
        if(usuario.indexOf("@") > -1 ){
            usuario = usuario.substring(0, usuario.indexOf('@')+1)+"...";
        }
		templateR = template;
		templateR = templateR.replaceAll("ID", data[i].id);
		templateR = templateR.replaceAll("NOMBRE", data[i].nombre);
        templateR = templateR.replaceAll("USUARIO", usuario);
		templateR = templateR.replace("DIRECCION", data[i].direccion);
		templateR = templateR.replace("SERVICIOS", data[i].servicios);
		tmpRows += templateR;
	}
	$("#bodyTable").html(tmpRows);

	// Eventos de los botones
	$(".editRow").click(function() {
		SLIDER.next();
		consultar($(this).attr("attr-id"));
	});
	$(".btnDelete").click(function() {
		$("#delNombre").html($(this).attr("attr-name"));
		$("#btnDeleteModal").attr("attr-id", $(this).attr("attr-id"));
	});
}

/**
 * Arma el paginador
 */
function setPaginator(pagina, total){
	// set 
	var pag = "";
	total = parseInt(total);
	pagina = parseInt(pagina);
	if (total > 10){
		total = parseInt(total / 10) + 1;
		for(i = 1; i <= total; i++){
			if (i == pagina){
				pag += "<li class='active'><a>"+i+"</a></li>";
			}else{
				pag += "<li class='btnPagina'><a>"+i+"</a></li>";
			}
		}
	}
	$(".pagination").html(pag);
	$(".btnPagina").click(function(){ getSearch($($(this).children()).html()); });
}

/**
 * Limpiar el formulario del catalogo
 */
function clearData(){
	// Clear fields
	$("#hideID").val('0');
	$("#txtNombre").val('');
	$("#txtDireccion").val('');
	$("#txtServicios").val('');
    $("#txtUsuario").val('');
    $("#txtPass").val('');
    $("#txtRePass").val('');
    $("#txtHidePass").val('');
	$("#txtTelefono").val('');
	$("#txtEmail").val('');
	$("#txtLatitud").val('');
	$("#txtLongitud").val('');
	$("#hideURL").val('');
    $("#chkMicrositio").prop("checked", false);
	$('.droparea').css('background', "");
	$('.droparea').html("<center><span class='redPoint'>*</span>Seleccione el encabezado<br/><h6>(600 x 240)</h6></center>");
	// Clear industrias
	var chks = $(".chkIndustria");
	for(i = 0; i < chks.length; i++){
		$(chks[i]).prop("checked", false) ;
	}
	// Clear messages
	$(".bg-danger").hide();
}

/**
 * Limpiar el formulario del catalogo
 */
function validateForm(){
	if ($("#txtNombre").val() =='' ||
		$("#txtDireccion").val() == '' ||
		$("#txtServicios").val() == ''){
        $(".bg-danger").html('Los campos marcados (<span class="redPoint">*</span>), son obligatorios...');
		$(".bg-danger").show("slow");
		return false;
	}else if ($("#txtPass").val() != $("#txtRePass").val()){
        $(".bg-danger").html('Los passwords no coinciden...');
		$(".bg-danger").show("slow");
		return false;
	}
	return true;
}

/**
 * Obtiene el registro seleccionado
 */
function consultar(idRow){
	$.ajax({
		type: "POST",
		url: "comercios/get",
		dataType:'json',
		data: { 
			id: idRow
		},
		success: function(data){
			// Set info comercio
			$("#hideID").val(data.comercio[0].id)
			$("#txtNombre").val(data.comercio[0].nombre);
			$("#txtDireccion").val(data.comercio[0].direccion);
			$("#txtServicios").val(data.comercio[0].servicios);
            $("#txtUsuario").val(data.comercio[0].usuario);
            $("#txtTelefono").val(data.comercio[0].telefono);
			$("#txtEmail").val(data.comercio[0].correo);
			$("#txtLatitud").val(data.comercio[0].latitud);
			$("#txtLongitud").val(data.comercio[0].longitud);
            
            // Micrositio
            if (data.comercio[0].site == 0 || data.comercio[0].site == '0'){
               $("#chkMicrositio").prop("checked", false);
            }else{
                $("#chkMicrositio").prop("checked", true);
            }
            
            // Banner
            if (!(data.comercio[0].banner == null || data.comercio[0].banner == 'null' || data.comercio[0].banner == '')){
                $('#hideURL').val(data.comercio[0].banner);
                $('.droparea').html('');
			    $('.droparea').css('background',  "url('../assets/img/coupon/"+data.comercio[0].banner+"')  no-repeat");
            }
            
			// Set industrias
			var inds = data.industrias;
			var chks = $(".chkIndustria");
			for(i = 0; i < inds.length; i++){
				for(y = 0; y < chks.length; y++){
					if (parseInt($(chks[y]).attr("attr-id")) ==parseInt(inds[i].id)){
						$(chks[y]).prop("checked", true) ;
						break;
					}
				}
			}
		}
	});
}

/**
 * Obtiene el registro seleccionado
 */
function deleteRow(idRow){
	$.ajax({
		type: "POST",
		url: "comercios/delete",
		dataType:'json',
		data: { 
			id: idRow
		},
		success: function(data){
			reloadSearch();
		}
	});
}


/**
 * Guarda el registro
 */
function save(){
    if (validateForm()){
		$.ajax({
			type: "POST",
			url: "comercios/save",
			dataType:'json',
			data: { 
				id:  $("#hideID").val(),
				nombre: $("#txtNombre").val(),
				direccion: $("#txtDireccion").val(),
                usuario: $("#txtUsuario").val(),
                password: $("#txtPass").val(),
				servicios: $("#txtServicios").val(),
                site: $("#chkMicrositio").prop("checked")?1:0,
                telefono: $("#txtTelefono").val(),
                correo: $("#txtEmail").val(),
                latitud: $("#txtLatitud").val(),
                longitud: $("#txtLongitud").val(),
                banner: $("#hideURL").val(),
				industrias: getSelInd(),
				status: 1
			},
			success: function(data){
				clearData();
				reloadSearch();
				SLIDER.prev();
				$(".bg-info").show("slow");
				setTimeout(function() { $(".bg-info").hide("slow"); }, 3000);
			}
		});
	}
}

/**
 * Recarga la busqueda y considera paginacion :)
 */
function reloadSearch(){
	if ($(".pagination").find(".active a").length > 0){
		var pagina = parseInt($($(".pagination").find(".active a")[0]).html());
		getSearch(pagina);
	}else{
		getSearch();
	}
}

/**
 * Obtiene la busqueda de los registros activos del catalogo
 */
function getSearch(pagina){
	$.ajax({
		type: "POST",
		url: "comercios/getSearch",
		dataType:'json',
		data: { 
			texto: $("#txtSearch").val(),
			pagina: ((typeof pagina == 'undefined')?1:pagina)
		},
		success: function(data){
			setRowTable(data.data);
			setPaginator(data.pagina, data.total);
		}
	});
}

/**
 * Obtiene las industrias seleccionadas
 */
function getSelInd(){
	var result = "";
	var chks = $(".chkIndustria:checked");
	for(i = 0; i < chks.length; i++){
		if (i > 0) result += ' ';
		result += $(chks[i]).attr("attr-id");
	}
	return result;
}

/**
 * Obtiene los registros de la industria
 */
function getIndustrias(){
	$.ajax({
		type: "POST",
		url: "industrias/getAll",
		dataType:'json',
		success: function(data){
			// Recorrer elementos
			var rows = "<tr></tr>";
			for(i = 0; i < data.length; i++){
				rows += "<tr><td width='200' class='idRow' >"+data[i].nombre+"</td>"+
					"<td width='52'><input attr-id='"+data[i].id+"' class='chkIndustria' type='checkbox' /></td></tr>";
			}
			rows += "</tr>";
			$("#bodyIndustrias").html(rows);
		}
	});
}
