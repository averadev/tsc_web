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

	$(".btnType").click(function() {
		$(".btnType").removeClass("btn-info");
		$(this).addClass("btn-info");
	});


	// Vigencia
	var startDate = new Date(2012,1,20);
	var endDate = new Date(2012,1,25);
	$('#dp4').datepicker()
		.on('changeDate', function(ev){
			if (ev.date.valueOf() > endDate.valueOf()){
				$('#alert').show("slow").find('strong').text('The start date can not be greater then the end date');
				setTimeout(function() { $('#alert').hide("slow"); }, 3000);
			} else {
				startDate = new Date(ev.date);
				$('#startDate').text($('#dp4').data('date'));
			}
			$('#dp4').datepicker('hide');
		});
	$('#dp5').datepicker()
		.on('changeDate', function(ev){
			if (ev.date.valueOf() < startDate.valueOf()){
				$('#alert').show("slow").find('strong').text('The end date can not be less then the start date');
				setTimeout(function() { $('#alert').hide("slow"); }, 3000);
			} else {
				endDate = new Date(ev.date);
				$('#endDate').text($('#dp5').data('date'));
			}
			$('#dp5').datepicker('hide');
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
        "<td>TIPO</td>"+
        "<td>CLIENTE</td>"+
        "<td>FECHA_INI</td>"+
        "<td>FECHA_FIN</td>"+
        "<td width='80'>"+
          "<a href='#' attr-id='ID' attr-name='NOMBRE' title='Eliminar' class='btn btn-danger btn-xs btnDelete' style='margin-left: 20px;'"+
          " data-toggle='modal' data-target='.modal-delete'><i class='fam-delete'></i></a>"+
        "</td></tr>";

	// Recorrer elementos
	for(i = 0; i < data.length; i++){
		templateR = template;
		templateR = templateR.replaceAll("ID", data[i].id);
		templateR = templateR.replaceAll("NOMBRE", data[i].descripcion);
		templateR = templateR.replace("TIPO", (data[i].tipos == null)?'-':data[i].tipos);
		templateR = templateR.replace("CLIENTE", data[i].comercio);
		templateR = templateR.replace("FECHA_INI", data[i].fechaInicio);
		templateR = templateR.replace("FECHA_FIN", data[i].fechaFin);
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
        $("#txtTerminos").val('');
	$("#txtURL").val('');
	$("#startDate").html('');
	$("#endDate").html('');
	$('.droparea').css('background', "");
	$("#txtComercio").removeClass("typeahead-check");
	$(".btnType").removeClass("btn-info");
	$('.droparea').html("<center><span class='redPoint'>*</span>Seleccione el cupon<br/><h6>(300 x 200)</h6></center>");
	$(".bg-danger").hide();
}

/**
 * Limpiar el formulario del catalogo
 */
function validateForm(){
	if ($("#hideURL").val() =='' ||
		(!$("#txtComercio").hasClass("typeahead-check")) ||
		$("#txtDescripcion").val() =='' ||
                $("#txtTerminos").val() =='' ||
		$("#startDate").html() =='' ||
		$("#endDate").html() ==''){
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
		url: "cupones/get",
		dataType:'json',
		data: { 
			id: idRow
		},
		success: function(data){
			$("#hideID").val(data[0].id)
			$("#hideURL").val(data[0].url);
			$("#hideIDComercio").val(data[0].idComercio);
			$("#txtDescripcion").val(data[0].descripcion);
                        $("#txtTerminos").val(data[0].terminosCondiciones);
			$("#txtURL").val(data[0].paginaAsociada);
			$("#startDate").html(data[0].fechaInicio);
			$("#endDate").html(data[0].fechaFin);
			$('.droparea').html('');
			$("#txtComercio").addClass("typeahead-check");
			$('.droparea').css('background',  "url('../assets/img/coupon/"+data[0].url+"')  no-repeat");
			// Get comercio
			for(var y = 0; y < COMERCIOS.length; y++){
				if (COMERCIOS[y].id == data[0].idComercio){
					$("#txtComercio").val(COMERCIOS[y].nombre);
				}
			}
			// Get Tipos
			if (data[0].tipos != null){
				if (data[0].tipos.lastIndexOf('1') > -1){
					$("#typeStandar").addClass("btn-info");
				}if (data[0].tipos.lastIndexOf('2') > -1){
					$("#typeVIP").addClass("btn-info");
				}
                                if (data[0].tipos.lastIndexOf('3') > -1){
					$("#typePremium").addClass("btn-info");
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
		url: "cupones/delete",
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
			url: "cupones/save",
			dataType:'json',
			data: { 
				id: $("#hideID").val(),
				url: $("#hideURL").val(),
				idComercio: $("#hideIDComercio").val(),
				descripcion: $("#txtDescripcion").val(),
				fechaInicio: $("#startDate").html(),
				fechaFin: $("#endDate").html(),
				paginaAsociada: $("#txtURL").val(),
				tipo: ($("#typeStandar").hasClass("btn-info")?'1':'')+($("#typeVIP").hasClass("btn-info")?'2':'')+($("#typePremium").hasClass("btn-info")?'3':''),
				status: 1,
                                terminosCondiciones : $("#txtTerminos").val()
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
		url: "cupones/getSearch",
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