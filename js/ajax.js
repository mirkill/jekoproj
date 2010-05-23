function clan_create_form(clas) {
	$('#profile_clan').css("display", "none");
	$('.' + clas).css("display", "block");
}

function create_clan() {
	var clan = $('.clan_name').val();
	var lvl = $('.clan_lvl').val();
	var server = $('.server_name').val();
	if (clan.length > 1) {
		$.post('/profile/clan_create/', {
			clan_name : clan,
			clan_lvl : lvl,
			server : server
		}, function(response) {
			if (response.result == 'true') {
				$('.profile_clan .error').text('Update success');
				window.location.reload();
			} else {
				// me.formLoading(false);
				$('.profile_clan .error').text('Invalid clan name');
			}
		}, 'json');
	} else {
		$('.profile_clan .error').text('Invalid clan name');
	}
}

function join_request(id) {
	if (id) {
		$
				.post(
						'/clan/join_request/',
						{
							clan_id : id
						},
						function(response) {
							if (response.result == 'true') {
								$('.join')
										.text(
												'Request success. Wait answer from Clan Leader by e-mail');
								// window.location.reload();
							} else {
								// me.formLoading(false);
								$('.join').text('Sorry, try again later');
							}
						}, 'json');
	}
}

function new_member(id, action) {
	if (id) {
		if (action == 'accept') {
			var join = 'accept';
		} else {
			var join = 'dismiss';
		}
		$.post('/clan/new_member/', {
			user_id : id,
			join : join
		}, function(response) {
			if (response.result == 'dismiss') {
				$('.user_' + id).text('dismised');
			}
			else if (response.result == 'accept') {
				$('.user_' + id).text('accepted');
			} else {
				$('.user_' + id).text('error');
			}
		}, 'json');
	}
}