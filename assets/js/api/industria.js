var SLIDER = null;
var INDUSTRIAS = null;

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
  	SLIDER = $("#slider").data('owlCarousel')

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
function setRowTable(data, pagina){
	// Template Row
	var tmpRows = "";
	var templateR = "";
	var template = "<tr><td class='idRow'>COUNTER</td>"+
        "<td><a class='editRow' attr-id='ID'>NOMBRE<a></td>"+
        "<td width='80'>"+
          "<a href='#' attr-id='ID' attr-name='NOMBRE' title='Eliminar' class='btn btn-danger btn-xs btnDelete' style='margin-left: 20px;'"+
          " data-toggle='modal' data-target='.modal-delete'><i class='fam-delete'></i></a>"+
        "</td></tr>";

	// Recorrer elementos
    pagina = pagina - 1;
	for(i = 0; i < data.length; i++){
		templateR = template;
		templateR = templateR.replaceAll("COUNTER", i + 1 + (pagina*10));
        templateR = templateR.replaceAll("ID", data[i].id);
		templateR = templateR.replaceAll("NOMBRE", data[i].nombre);
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
	$("#txtNombre").val('');
	$("#hideIdPadre").val('');
	$("#txtPadre").val('');
	$(".bg-danger").hide();
    $("#txtPadre").removeClass("typeahead-check");
}

/**
 * Limpiar el formulario del catalogo
 */
function validateForm(){
	if ($("#txtNombre").val() ==''){
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
		url: "industrias/get",
		dataType:'json',
		data: { 
			id: idRow
		},
		success: function(data){
			$("#hideID").val(data[0].id)
			$("#txtNombre").val(data[0].nombre);
            if (data[0].padre != ''){
                $("#hideIdPadre").val(data[0].idPadre);
                $("#txtPadre").val(data[0].padre);
                $("#txtPadre").addClass("typeahead-check");
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
		url: "industrias/delete",
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
			url: "industrias/save",
			dataType:'json',
			data: { 
				id:  $("#hideID").val(),
				nombre: $("#txtNombre").val(),
                idPadre: $("#hideIdPadre").val(),
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
		url: "industrias/getSearch",
		dataType:'json',
		data: { 
			texto: $("#txtSearch").val(),
			pagina: ((typeof pagina == 'undefined')?1:pagina)
		},
		success: function(data){
			setRowTable(data.data, data.pagina);
			setPaginator(data.pagina, data.total);
		}
	});
}

/**
 * Obtiene los clientes activos
 */
function getIndustrias(){
	$.ajax({
		type: "POST",
		url: "industrias/getAll",
		dataType:'json',
		success: function(data){
			// instantiate the bloodhound suggestion engine
			INDUSTRIAS = data;
			var nombres = new Bloodhound({
			  datumTokenizer: function(d) { return Bloodhound.tokenizers.whitespace(d.nombre); },
			  queryTokenizer: Bloodhound.tokenizers.whitespace,
			  local: data
			});
			 
			// initialize the bloodhound suggestion engine
			nombres.initialize();
            
            $('#txtPadre').on('change', function (e) {
                var isPadre = false;
                for(i = 0; i < INDUSTRIAS.length; i++){
			          if ($(this).val().toUpperCase() == INDUSTRIAS[i].nombre.toUpperCase()){
                          isPadre = true;   
                          $(this).val(INDUSTRIAS[i].nombre)
                          $(this).addClass("typeahead-check");
                          $("#hideIdPadre").val(INDUSTRIAS[i].id);
                      }
                }
                if (!isPadre){
                    $(this).removeClass("typeahead-check");
                    $("#hideIdPadre").val("");
                }
            });
			 
			// instantiate the typeahead UI
			$('#txtPadre').typeahead(null, {
			  displayKey: 'nombre',
			  source: nombres.ttAdapter()
			}).on('typeahead:selected', function (obj, datum) {
				// Check class
				$("#hideIdPadre").val(datum.id);
				if (!$(this).hasClass("typeahead-check")){
			    	$(this).addClass("typeahead-check");
			    }
			});
			
		}
	});
}