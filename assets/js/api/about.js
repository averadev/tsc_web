
var PUBLISH_MAX = 0;
var PUBLISH_CURRENT = 1;
var PAGE_MAX = 0;
var PAGE_CURRENT = 0;
var TIPO_CUPON = 1;
var TIPO_INDUSTRIA = 0;
var STR_CUPON = '';
var toUp = true;
var doMove = false;

$(function() {
	// Obtiene el menu de Industria
	getAllIndustria();
    
	// Obtiene los precios de las cuponeras
	getTipoCupon();
    
    // Logo
    $("#headLogo").click(function() { window.location.href = "./"; });
	
	// Menu
	$("#menu1").click(function() { smoothScrolling($('#whatis')); });
	$("#menu2").click(function() { smoothScrolling($('#howIget')); });
	$("#menu3").click(function() { smoothScrolling($('#addwith')); });
    
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
	
	if(window.location.href.lastIndexOf("m=1") > 0){
		smoothScrolling($('#whatis'));
	}else if(window.location.href.lastIndexOf("m=2") > 0){
		smoothScrolling($('#howIget'));
	}else if(window.location.href.lastIndexOf("m=3") > 0){
		smoothScrolling($('#addwith'));
	}

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
	
}


