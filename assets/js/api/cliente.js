$(function() {
    clearAll();
    $("#btnGuardar").click(function() {
        save();
    });
    
    $("#btnGuardar2").click(function() {
        save2();
    });
});

function save2() {
    if (validateForm2()) {
        $.ajax({
            type: "POST",
            url: baseURL + "cuponera/save2",
            dataType: 'json',
            data: {
                correo: $("#correo2").val(),
                password: $("#password2").val(),
                status: 0,
                idTipoCupon : tipo_cupon
            },
            success: function(data) {
                if (data.error == 1 || data.error == '1'){
                    $("#error2").hide();
                    $("#error2").text(data.mensaje);
                    $("#error2").show("slow");
                }else{
                    document.getElementsByName("notify_url")[0].value = document.getElementsByName("notify_url")[0].value + "/" + data.key;
                    clearAll();
                    $("#tabCmp").hide();
                    $("#formulario_paypal").show('slow');
                }
            }
        });
    }
}
function save() {
    if (validateForm()) {
        $.ajax({
            type: "POST",
            url: baseURL + "cuponera/save",
            dataType: 'json',
            data: {
                correo: $("#correo").val(),
                password: $("#password").val(),
                status: 0,
                idTipoCupon : tipo_cupon
            },
            success: function(data) {
                if (data.error == 1 || data.error == '1'){
                    $("#error").hide();
                    $("#error").text(data.mensaje);
                    $("#error").show("slow");
                }else{
                    document.getElementsByName("notify_url")[0].value = document.getElementsByName("notify_url")[0].value + "/" + data.key;
                    clearAll();
                    $("#tabCmp").hide();
                    $("#formulario_paypal").show('slow');
                }
            }
        });
    }
}
function validateForm2() {
    if ($("#correo2").val() === '' || $("#password2").val() === '') {
        $("#error2").hide();
        $("#error2").text('Todos los campos son requeridos');
        $("#error2").show("slow");
        return false;
    }
    if (!validateEmail($("#correo2").val())) {
        $("#error2").hide();
        $("#error2").text("Correo no valido");
        $("#error2").show("slow");
        return false;
    }
    return true;
}
function validateForm() {
    if ($("#correo").val() === '' || $("#password").val() === '') {
        $("#error").hide();
        $("#error").text('Todos los campos son requeridos');
        $("#error").show("slow");
        return false;
    }
    if (!validateEmail($("#correo").val())) {
        $("#error").hide();
        $("#error").text("Correo no valido");
        $("#error").show("slow");
        return false;
    }
    if ($("#correo").val() !== $("#correoConf").val()) {
        $("#error").hide();
        $("#error").text("Los correos no coinciden");
        $("#error").show("slow");
        return false;
    }
    if ($("#password").val() !== $("#passwordConf").val()) {
        $("#error").hide();
        $("#error").text("Las contraseñas no coinciden");
        $("#error").show("slow");
        return false;
    }
    return true;
}
function clearAll() {
    $("#formulario_paypal").hide();
    $("#error").hide();
    $("#error2").hide();
    $("#correo").val("");
    $("#password").val("");
    $("#correoConf").val("");
    $("#passwordConf").val("");
}
function validateEmail(email) {
    var re = /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
    return re.test(email);
}
