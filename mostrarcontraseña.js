$(document).ready(function () {
    $('#VerPassword').click(function () {
      	if ($('#VerPassword').is(':checked')) {
        	$('#password').attr('type', 'text');
      	} else {
        	$('#password').attr('type', 'password');
      	}
    });
});