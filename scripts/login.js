function login() {
	$.ajax({
		url: 'System/LoginManager.php?operation=login&username=username&password=password',
		success: function(ajaxReturnedData) {
			handleLoginData(ajaxReturnedData);
		},
		error: function(request, status, error) {
			alert();
		}
	});
	
	return 0;
}

function handleLoginData(loginData) {
	$('div#userInformation').html('<p>' + loginData + '</p>');
}