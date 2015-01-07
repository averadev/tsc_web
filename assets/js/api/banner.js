


var SLIDER = null;
var COMERCIOS = null;

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
    
    $(".optTipo").click(function() {
		 $('#selPosition').html($(this).html() + ' <span class="caret"></span>');
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
	getComercios();
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
        "<td>CLIENTE</td>"+
        "<td>TIPO</td>"+
        "<td width='80'>"+
          "<a href='#' attr-id='ID' attr-name='NOMBRE' title='Eliminar' class='btn btn-danger btn-xs btnDelete' style='margin-left: 20px;'"+
          " data-toggle='modal' data-target='.modal-delete'><i class='fam-delete'></i></a>"+
        "</td></tr>";

	// Recorrer elementos
	for(i = 0; i < data.length; i++){
		templateR = template;
		templateR = templateR.replaceAll("ID", data[i].id);
		templateR = templateR.replaceAll("NOMBRE", data[i].descripcion);
		templateR = templateR.replace("CLIENTE", data[i].comercio);
		templateR = templateR.replace("TIPO", data[i].tipo);
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
	$("#hideID").val('0');
	$("#hideURL").val('');
	$("#hideIDComercio").val('');
	$("#txtComercio").val('');
	$("#txtDescripcion").val('');
	$("#txtURL").val('');
	$('.droparea').css('background', "");
	$("#txtComercio").removeClass("typeahead-check");
    $('#selPosition').html('Seleccione la posición <span class="caret"></span>');
	$('.droparea').html("<center><span class='redPoint'>*</span>Seleccione el banner<br/><h6>(900 x 120)</h6></center>");
	$(".bg-danger").hide();
}


/**
 * Limpiar el formulario del catalogo
 */
function validateForm(){
	if ($("#hideURL").val() =='' ||
		(!$("#txtComercio").hasClass("typeahead-check")) ||
		$("#txtDescripcion").val() =='' ||
		$('#selPosition').html().lastIndexOf("Seleccione") >= 0){
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
		url: "banner/get",
		dataType:'json',
		data: { 
			id: idRow
		},
		success: function(data){
			$("#hideID").val(data[0].id)
			$("#hideURL").val(data[0].url);
			$("#hideIDComercio").val(data[0].idComercio);
			$("#txtDescripcion").val(data[0].descripcion);
			$("#txtURL").val(data[0].paginaAsociada);
			$('.droparea').html('');
			$("#txtComercio").addClass("typeahead-check");
			$('.droparea').css('background',  "url('../assets/img/coupon/"+data[0].url+"')  no-repeat");
            $('#selPosition').html((data[0].idTipo == "1")?'Superior <span class="caret"></span>':'Media Pagina <span class="caret"></span>');
			// Get comercio
			for(var y = 0; y < COMERCIOS.length; y++){
				if (COMERCIOS[y].id == data[0].idComercio){
					$("#txtComercio").val(COMERCIOS[y].nombre);
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
		url: "banner/delete",
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
			url: "banner/save",
			dataType:'json',
			data: { 
				id: $("#hideID").val(),
				url: $("#hideURL").val(),
				idComercio: $("#hideIDComercio").val(),
				descripcion: $("#txtDescripcion").val(),
				paginaAsociada: $("#txtURL").val(),
                idTipo: ($('#selPosition').html().lastIndexOf("Superior") > -1)?1:2,
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
		url: "banner/getSearch",
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
 * Obtiene los clientes activos
 */
function getComercios(){
	$.ajax({
		type: "POST",
		url: "comercios/getAllCatalogo",
		dataType:'json',
		success: function(data){
			// instantiate the bloodhound suggestion engine
			COMERCIOS = data;
			var nombres = new Bloodhound({
			  datumTokenizer: function(d) { return Bloodhound.tokenizers.whitespace(d.nombre); },
			  queryTokenizer: Bloodhound.tokenizers.whitespace,
			  local: data
			});
			 
			// initialize the bloodhound suggestion engine
			nombres.initialize();
			 
			// instantiate the typeahead UI
			$('#txtComercio').typeahead(null, {
			  displayKey: 'nombre',
			  source: nombres.ttAdapter()
			}).on('typeahead:selected', function (obj, datum) {
				// Check class
				$("#hideIDComercio").val(datum.id);
				if (!$(this).hasClass("typeahead-check")){
			    	$(this).addClass("typeahead-check");
			    }
			});
			
		}
	});
}





