
var PUBLISH_MAX = 0;
var PUBLISH_CURRENT = 1;
var PAGE_MAX = 0;
var PAGE_CURRENT = 0;
var TIPO_CUPON = 1;
var TIPO_INDUSTRIA = 0;
var STR_CUPON = '';


$(function() {
	// Obtiene el menu de Industria
	getAllIndustria();
    
	// Obtiene los precios de las cuponeras
	getTipoCupon();
    
    // Logo
    $("#headLogo").click(function() {window.location.href = "./"});
    
	// Cargar Publicidad y botones de navegacion
	loadPublish();
	$("#btnUp").click(function() {
		if(! $(this).hasClass("disabled")){
			// Animate
			$($("#publish-carrusel div")[PUBLISH_CURRENT - 1]).hide("slow");
			$($("#publish-carrusel div")[PUBLISH_CURRENT]).show("slow");
			// Set position
			PUBLISH_CURRENT += 1;
			updateBtnPublish();
		} 
	  
	});
	$("#btnDown").click(function() {
		if(! $(this).hasClass("disabled")){
			// Animate
			$($("#publish-carrusel div")[PUBLISH_CURRENT - 1]).hide("slow");
			$($("#publish-carrusel div")[PUBLISH_CURRENT - 2]).show("slow");
			// Set position
			PUBLISH_CURRENT -= 1;
			updateBtnPublish();
		}
	});
    
    // Seleciona cuponera
    $(".selCuponera").click(function() {
        // Select option
        $(".selCuponera").css('background' ,'none');
        $(this).css('background' ,'#c5c5c5');
        // Hide menu
        $("#drop").removeClass('open');
        $("#drop").css('left' ,'-99999px');
        // Actualizar info
        $(".dropdown").html($(this).html());
        $(".dropdown").css('width', '170px');
        $("#fieldTotal").html("$ "+$(this).attr('costo'));
        $("#buyCoupons").removeClass('disabled');
        $("#buyCoupons").attr('onclick', 
                              "window.location.href = 'cuponera/t/" + 
                              $(this).attr('attr-id') + 
                              "/"+ $(this).html() + "';");
	});

	// Cambiar cupones segun el tipo
	$("#btnStandar,#btnVip,#btnPremium").click(function() {
		TIPO_CUPON = parseInt($(this).attr('tipoCupon'));
		loadCoupons();
  		smoothScrolling($('#containerMenu'));
	});
	loadCoupons();

	// Buscar cupones por texto
	$("#fieldSearch div").click(function() {
		smoothScrolling($('#containerMenu'));
		STR_CUPON = $("#fieldSearch input").val();
		loadCoupons();
		STR_CUPON = '';
	});
	$("#fieldSearch input").keypress(function(e) {
	    if(e.which == 13) {
		smoothScrolling($('#containerMenu'));
		STR_CUPON = $("#fieldSearch input").val();
		loadCoupons();
		STR_CUPON = '';
	    }
	});

});

/**
 * Realiza smooth scrolling
 */
function smoothScrolling(target){
	target = target.length ? target : $('[name=' + this.hash.slice(1) +']');
	if (target.length) {
		$('html,body').animate({
			scrollTop: target.offset().top
		}, 1000);
		return false;
	}
}

/**
 * Actualiza el estilo de los botones en los limites
 */
function updateBtnPublish(){
	if (PUBLISH_CURRENT == 1)
		$("#btnDown").addClass("disabled");
	else
		$("#btnDown").removeClass("disabled");

	if (PUBLISH_CURRENT >= PUBLISH_MAX)
		$("#btnUp").addClass("disabled");
	else
		$("#btnUp").removeClass("disabled");
}

/**
 * Obtiene las industrias para listarlas en el menu
 */
function getAllIndustria(){
	$.ajax({
		type: "POST",
		url: "home/getAllIndustria",
		dataType:'json',
		success: function(data){
			// Recorrer elementos
			var menuOpts = "";
			for(i = 0; i < data.length; i++){
                if (data[i].sub.length == 0)
                    menuOpts += "<span class='subcategory' attr-id='"+data[i].id+"'>"+data[i].nombre+"</span>";
                else{
                    var subM = "";
                    for(j = 0; j < data[i].sub.length; j++){
                        subM += "<span class='subcategory' attr-id='"+data[i].id+"'>"+data[i].sub[j].nombre+"</span>";
                    }
                    menuOpts += "<span class='submenu' attr-id='"+data[i].id+"'>"+data[i].nombre+"&#x25bc;"+
                        "<div class='subM'>"+subM+"</div></span>";
                }
			}
			// Set Menu
			$("#head-2").html(menuOpts);
            // Submenu
            $(".submenu").mouseenter(function() {
                $(this).children().show();
            }).mouseleave(function() {
                $(this).children().hide();
            });
			// Trigger menu
			$(".subcategory").click(function() {
				smoothScrolling($('#containerMenu'));
				getCuponesPorIndustria(parseInt($(this).attr('attr-id')));
			});
		}
	});
}


/**
 * Obtiene los precios de las cuponeras
 */
function getTipoCupon(){
	$.ajax({
		type: "POST",
		url: "home/getTipoCupon",
		dataType:'json',
		success: function(data){
            for(var y = 0; y < data.length; y++){
                $(".cuponera"+data[y].id).attr('costo', data[y].costo);
            }
		}
	});
}

/**
 * Obtiene los cupones por industria
 */
function getCuponesPorIndustria(idIndustria){
	// Asignamos valores de la consulta
	TIPO_INDUSTRIA = idIndustria;
	TIPO_CUPON = 0;
	// Obtenemos los cupones
	loadCoupons();
	TIPO_INDUSTRIA = 0;
}

/**
 * Obtiene la publicidad y arma el componente
 */
function loadPublish(){
	$.ajax({
		type: "POST",
		url: "home/getPublicidad",
		dataType:'json',
		success: function(data){

			// Inicializar 
			var divEl = "";
			var htmlPublish = "";

			// Recorrer elementos
			for(i = 0; i < data.length; i++){
				if (i%4 == 0){
					if (i != 0){
						PUBLISH_MAX += 1;
						htmlPublish += divEl + "</div>";
					}
					divEl = "<div style='display:none'>";
				}
                
                
                if (data[i].paginaAsociada != ''){
                    divEl += "<a href='"+data[i].paginaAsociada+"' title='"+data[i].comercio+"' target='_blank'>" + 
                        "<img id='publishCoupon' " +
                        "style='background:url(\"assets/img/coupon/" + data[i].url + "\") " +
                        "no-repeat;' /></a>"
                }else{
                    divEl += "<img id='publishCoupon' " +
                    "style='background:url(\"assets/img/coupon/" + data[i].url + "\") " +
                    "no-repeat;' />";
                }
                
			}
			if (divEl != "<div>"){
				PUBLISH_MAX += 1;
				htmlPublish += divEl + "</div>";
			}

			// Iniciar botones de navegacion e ingresar patrocinados
			updateBtnPublish();
			$("#publish-carrusel").html(htmlPublish);
			$($("#publish-carrusel div")[0]).show();
		}
	});
}


/**
 * Actualiza el estilo de los botones en los limites
 */
function loadCoupons(){
	// Inicializar
	var plantilla = "";
	var tmpTemplate = "";
	var htmlTemplate = $("#template").html();
	PAGE_MAX = -1;

	// Se realiza la pettcion de cupones por tipo
	$.ajax({
		type: "POST",
		url: "home/getCuponesPorTipo",
		dataType:'json',
		data: { 
			tipo: TIPO_CUPON,
			industria: TIPO_INDUSTRIA,
			texto: STR_CUPON
		},
		success: function(data){

			// Recorrer elementos
			for(i = 0; i < data.length; i++){
				if (i % 12 == 0){
					if (i != 0){
						PAGE_MAX++;
						plantilla += "</div>";
					}
					plantilla += "<div class='pageCoupon'>";
				}
				tmpTemplate = htmlTemplate;
                // Micrositio
                if (data[i].site == 1 || data[i].site == '1'){
                    tmpTemplate = tmpTemplate.replace('VER_MAS', '<a class="button btnLCoupon btnLCouponD BTN_RGB1" href="'+
                                                      $("#baseUrl").val()+'comercio?i='+data[i].id+'">VER MAS</a>');
                }else{
                    tmpTemplate = tmpTemplate.replace('VER_MAS', '<a class="button btnLCouponNo BTN_RGB1"></a>');
                }
				tmpTemplate = tmpTemplate.replace('ID_COUPON', data[i].id);
				tmpTemplate = tmpTemplate.replace('NO_LIKES', data[i].likes);
                tmpTemplate = tmpTemplate.replace('OLD_LIKES', data[i].likes);
				tmpTemplate = tmpTemplate.replace('BTN_RGB1', 'btnRGB3');
				tmpTemplate = tmpTemplate.replace('BTN_RGB2', 'btnRGB3');
				tmpTemplate = tmpTemplate.replace('DESC_TOP', data[i].nombre);
				tmpTemplate = tmpTemplate.replace('DESC_MIDDLE', data[i].direccion);
				tmpTemplate = tmpTemplate.replace('DESC_BOTTOM', data[i].servicios);
				tmpTemplate = tmpTemplate.replace('IMAGEN_URL', data[i].url);
                

				plantilla += tmpTemplate;
			}

			// Cerramos cupones
			if (data.length > 0){
				PAGE_MAX++;
				plantilla += "</div>";
			}
			if (data.length > 12){
				plantilla += $("#templateNav").html();
			}

			// Ingresamos cupones
			$("#scrollCoupon").html(plantilla);
			// Creamos botones sociales
			$('.tmpSocial').share({
		        networks: ['facebook','twitter','pinterest','email'],
        		urlToShare: $("#baseUrl").val(),
		        theme: 'square'
		    });
		    $( ".tmpSocial a" ).remove( ".currentPop" );
		    $( ".tmpSocial a").addClass('currentPop');

		    // De ser necesario crea el paginador
		    PAGE_CURRENT = 0;
			if (data.length > 12){
				doPaginator();
			}

			// Se muestra la primera pagina
			$($("#scrollCoupon").children()[PAGE_CURRENT]).fadeIn();
		}
	});

}

/**
 * Incrementa los likes
 */
function setLike(objLike, idCoupon, likes){
    objLike.innerHTML = (likes+1) + " LIKES";
    objLike.style.background = "url('assets/img/app/btnLike2.png') no-repeat 5px";
    $.ajax({
		type: "POST",
		url: "home/setLikeCoupon",
		dataType:'json',
		data: { 
			id: idCoupon
		},
		success: function(data){
        }
	});
}

/**
 * Crea el paginador
 */
function doPaginator(){
	var paginator = '<div class="navLeft"></div><div attr-posc=0 class="nav navSel"></div>';
	for(e=0;e<PAGE_MAX;e++){
		paginator += '<div attr-posc='+(e+1)+' class="nav"></div>';
	}
	paginator += '<div class="navRight"></div>';
	$('.navigator').html(paginator);

	$(".navLeft").click(function() {
		// clear button nav
		$(".nav").removeClass('navSel');
		$($("#scrollCoupon").children()[PAGE_CURRENT]).fadeOut(500, function() {
			// change current
    		if (PAGE_CURRENT == 0){
				PAGE_CURRENT = PAGE_MAX;
			} else {
				PAGE_CURRENT--;
			} 
			$($(".nav")[PAGE_CURRENT]).addClass('navSel');
			$($("#scrollCoupon").children()[PAGE_CURRENT]).fadeIn("slow");
		});
  		smoothScrolling($('#containerMenu'));
	});

	$(".navRight").click(function() {
		// clear button nav
		$(".nav").removeClass('navSel');
		$($("#scrollCoupon").children()[PAGE_CURRENT]).fadeOut(500, function() {
			// change current
    		if (PAGE_CURRENT == PAGE_MAX){
				PAGE_CURRENT = 0;
			} else {
				PAGE_CURRENT++;
			} 
			$($(".nav")[PAGE_CURRENT]).addClass('navSel');
			$($("#scrollCoupon").children()[PAGE_CURRENT]).fadeIn("slow");
  		});
  		smoothScrolling($('#containerMenu'));
	});

	$(".nav").click(function() {
		$(".nav").removeClass('navSel');
		$(this).addClass('navSel');
		var oldPage = PAGE_CURRENT;
		PAGE_CURRENT = $(this).attr('attr-posc');
		$($("#scrollCoupon").children()[oldPage]).fadeOut(500, function() {
			$($("#scrollCoupon").children()[PAGE_CURRENT]).fadeIn("slow");
  		});
  		smoothScrolling($('#containerMenu'));
	});
}
