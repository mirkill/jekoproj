/* Register */

var registerDialog = {
	initInputs : function() {
		// $('#register_account_email').live("keyup", this.validateEmail);
	// $('#register_account_password').live("keyup", this.validatePassword);
	// $('#register_account_confirm_password').live("keyup",
	// this.validatePassword);
	// $('#register_user').live("click", this.testCaptcha);
},

validateEmail : function() {
	// registerDialog.showEmailExistError(false);
	var email = $('.email').val();
	if (!isEmail(email)) {
		// $('#register_email_container').addClass("invalid");
		$('.error').text('Not valid e-mail!');
	} else {
		// $('#register_email_container').removeClass("invalid");
		$('.error').text('');
	}
},

collectValues : function() {
	var values = $("form#register_form").serialize();
	return values;
},

validatePassword : function() {
	var pass_field = $('#register_account_password');
	var pass_field_confirm = $('#register_account_confirm_password');

	if (pass_field.val() != pass_field_confirm.val()) {
		$('#register_password_container').addClass("invalid");
	} else {
		$('#register_password_container').removeClass("invalid");
	}
},

collectValues : function() {
	var values = $("form#register_form").serialize();
	return values;
},

showAccountExistError : function(response) {
	if (response.result) {
		$("#register_account_name_container").addClass("invalid");
	} else {
		$("#register_account_name_container").removeClass("invalid");
	}
},
showEmailExistError : function(response) {
	if (response) {
		$("#register_email_exist_container span").css('display', 'block');
	} else {
		$("#register_email_exist_container span").css('display', 'none');
	}
},

sendValidateAccountRequest : function() {
	$.post("/client/register/check/", {
		values : registerDialog.collectValues()
	}, registerDialog.showAccountExistError, "json");
},

sendRegisterRequest : function() {
	$.post("/usercontrol/register/register/", {
		values : registerDialog.collectValues()
	}, function(response) {
		if (response.result) {
			document.location.href = '/profile/';
		} else {
			$('.error').text('Email or Login already exist');
		}
	}, "json");
}
};
// =================================== LIVE & CHECK
// ===================================
$('.register_user').live("click", function() {
	var email = $('.email').val();
	var pwd = $('.pwd').val();
	var login = $('.login').val();

	if (isEmail(email) && pwd.length > 5 && login.length > 2) {
		$('.error').text('');
		registerDialog.sendRegisterRequest();
	} else {
		$('.error').text('Please check your data');
	}

});
$('#register_form .login').live("change", function() {
	var login = $('.login').val();

	$.post("/usercontrol/account_exists/login", {
		values : registerDialog.collectValues()
	}, function(response) {
		if (response.result) {
			$('.error').text('Login already exist');
		} else if (login.length < 3) {
			$('.error').text('Login must be more than 2 symbol');
		} else {
			$('.error').text('');
		}
	}, "json");

});
$('.email').live("change", function() {
	var email = $('.email').val();

	$.post("/usercontrol/account_exists/email", {
		values : registerDialog.collectValues()
	}, function(response) {
		if (response.result) {
			$('.error').text('Email already exist');
		} else if (!isEmail(email)) {
			$('.error').text('Email is not correct');
		} else {
			$('.error').text('');
		}
	}, "json");

});
$('#register_form .pwd').live("keyup", function() {
	var pwd = $('.pwd').val();

	if (pwd.length > 5) {
		$('.error').text('');
	} else {
		$('.error').text('Login must be more than 5 symbol');
	}

});
$('#register_form .pwd2').live("keyup", function() {
	var pwd = $('.pwd').val();
	var pwd2 = $('.pwd2').val();

	if (pwd == pwd2) {
		$('.error').text('');
	} else {
		$('.error').text('Password does not match');
	}

});
// =================================== LOGIN ===================================
var loginDialog = {

	initInputs : function() {
		// $('#login_account_type').live("change", this.checkAccountType);
		$('.login_btn').live("click", this.sendLoginRequest);
		$('.forgot_btn').live("click", this.sendForgotRequest);
		$('.forgot_password').live("click", this.forgot_show);
		// $('#login_email').live("keyup", this.checkLogin);
		// $('#login_account_password').live("keyup", this.checkLogin);
	},
	// --------------------- FORGOT PASSWORD ----------------------------
	forgot_show : function() {
		$('.login').css("display", "none");
		$('.forgot').css("display", "block");
	},
	sendForgotRequest : function() {
		var email = $('.f_email').val();
		if (!isEmail(email)) {
			$('.error').text('Email is not correct');
		} else {
			$('.error').text('');
			$
					.post(
							'/usercontrol/reset_pwd/',
							{
								email : email
							},
							function(response) {
								if (response.result == 'true') {
									$('.forgot')
											.text(
													'We will send you email. This can take 10 min. Check your email please');
								} else {
									$('.error').text('Invalid email address');
								}
							}, 'json');
		}
	},

	// ----------------------------------
	sendLoginRequest : function() {
		$('.error').text('');
		var login = $('#login_form .login').val();
		var password = $('.pwd').val();

		if (login == '') {
			$('.error').text('login is empty');
		} else if (password == '') {
			$('.error').text('Password is empty');
		} else {
			// me.formLoading(true);
			$.post('/usercontrol/login/', {
				login : login,
				password : password
			}, function(response) {
				if (response.result == 'true') {
					if (/\/(login|signup)/.test(document.location.href)) {
						document.location.href = document.location.href;
					} else {
						document.location.href = '/profile/';
					}
				} else {
					// me.formLoading(false);
					$('.error').text('Invalid login or password');
				}
			}, 'json');
		}

		return false;
	}
};
loginDialog.initInputs();
// ==================================== UPDATE PROFILE ================
var ProfileDialog = {

	initInputs : function() {
		$('.profile_btn').live("click", this.updateProfile);
		$('.change_pwd').live("click", this.updatePassword);
		// $('#login_email').live("keyup", this.checkLogin);
	// $('#login_account_password').live("keyup", this.checkLogin);
},

updatePassword : function() {
	var pwd1 = $('.pwd').val();
	var pwd2 = $('.re_pwd').val();
	$.post('/usercontrol/change_pwd/', {
		pw1 : pwd1,
		pw2 : pwd2
	}, function(response) {
		if (response.result == 'true') {
			$('.pwd_update .error').text('Update success');
		} else {
			// me.formLoading(false);
			$('.pwd_update .error').text('Passwords does not match');
		}
	}, 'json');
},

updateProfile : function() {
	$('.error').text('');
	var first = $('.first').val();
	var last = $('.last').val();
	if (first == '' || last == '') {
		$('.error').text('Please fill First and Last name');
	} else {
		// me.formLoading(true);
	$.post('/usercontrol/update/', {
		first : first,
		last : last
	}, function(response) {
		if (response.result == 'true') {
			$('#profile_form .error').text('Update success');
		} else {
			// me.formLoading(false);
			$('.error').text('Invalid login or password');
		}
	}, 'json');
}

return false;
}
};
ProfileDialog.initInputs();
// ==================================== RESET PASSWORD ================
