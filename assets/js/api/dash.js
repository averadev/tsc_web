
$(function() {
	
	//  Eventos de Botones
	$(".btnSearch").click(function() {
		setCode();
	});
	$("#txtSearch").keypress(function(e) {
	    if(e.which == 13) { setCode(); }
	});
	

});


/**
 * Redime el cupon
 */
function setCode(pagina){
    if ($("#txtCodigo").val() == ''){
            sendMsg("Ingrese el codigo a redimir.", false);
    }else{
        $.ajax({
            type: "POST",
            url: "dash/setCode",
            dataType:'json',
            data: { 
                key: $("#txtCodigo").val(),
                status: 2
            },
            success: function(data){
                sendMsg(data.message, (data.success == 1));
            }
        });
    }
}

function sendMsg(text, isSuccess){
    text += '<button type="button" class="close" aria-label="Close"><span aria-hidden="true">&times;</span></button>';
    $(".bg-danger").hide();
    $(".bg-info").hide();
    if (isSuccess){
        $(".bg-info").html(text);
        $(".bg-info").show("slow");
    }else{
        $(".bg-danger").html(text);
        $(".bg-danger").show("slow");
    }
    
    // On close
    $(".close").click(function() {
		$(this).parent().hide();
	});close
}