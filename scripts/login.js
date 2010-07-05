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
	$('div#userInformation').html('<p>' + loginData + '</p>' + logoutCode);
}

function logout() {
	$.ajax({
		url: 'System/LoginManager.php?operation=logout',
		success: function() {
			handleLogoutData();
		},
		error: function(request, status, error) {
			alert();
		}
	});
	
	return 0;
}

function handleLogoutData() {
	$('div#userInformation').html('<p>' + loggedOutMessage + '</p>');
}

const logoutCode = '<form onsubmit=\'javascript: return 0;\' name=\'logoutForm\'><input type=\'button\' onclick=\'javascript: logout();\' value=\'Logout\' /></form>';

const loggedOutMessage = 'You are not logged in';