function test(){
	$('.test').text('AJAX work!');
}

function isEmail(email) {
	return !(email == "" || !email.match(new RegExp('^\\w+([-+.]\\w+)*@\\w+([-.]\\w+)*\\.\\w+([-.]\\w+)*$')));
}