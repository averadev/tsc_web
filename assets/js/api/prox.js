$(document).ready(function(){

	$("#contacto").on('click', function(event) {
		if (validate()){
			$(this).attr('disabled', true);
			$('#mask').fadeIn();

			$.ajax({
				url: URL_BASE + 'prox/sendMail',
				type: 'POST',
				dataType: 'text',
				data: {
					email: $('#email').val(),
				},
				complete: function(xhr, textStatus) {
				},
				success: function(data, textStatus, xhr) {
					$('#mask').fadeOut('slow');
					$('#email').val('');
				}
			});
			event.preventDefault();
		}
	});
});

function validate(){
	if ($("#email").val() == ''){
		$("#email").addClass("redCls");
		return false;
	}else{
		$("#email").removeClass("redCls");
	}
	return true;
}