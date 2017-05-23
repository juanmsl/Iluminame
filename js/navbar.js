let navbar = '#main-navbar';
let toggles = $(navbar + ' [id^=\'toggle-\']');
let notificators = $(navbar + ' .navbar-notificator');
let activeElement = null;

let toggleTarget = function(element) {
	let activeTarget = null;
	if(activeElement != null) {
		activeTarget = activeElement.attr('target');
		activeElement.removeClass('is-hover');
		$(activeTarget).fadeOut('fast');
	}
	let elementTarget = element.attr('target');
	if(activeTarget === elementTarget) {
		activeElement = null;
		return;
	}
	activeElement = element;
	activeElement.addClass('is-hover');
	$(elementTarget).fadeIn('fast');
}

toggles.on('click', function(){
	toggleTarget($(this));
	var object = $(this);
	if($(this).attr('id') == 'toggle-notification') {
		if($(this).hasClass('is-hover') && object.attr('counter') != 0 && $(this).hasClass('activate')) {
			console.log('1');
			object.removeClass('activate');
			$.ajax({
				type: "POST",
				url: "/ajax/readNotifications.php",
				success: function (msg) {
					var response = JSON.parse(msg);
					console.log(response.result);
				}
			});
		} else if(!$(this).hasClass('is-hover') && object.attr('counter') != 0 && !$(this).hasClass('activate')) {
			console.log('2');
			let target = object.attr('target');
			object.attr('counter', '0');
			$(target + ' a.box.notification').each(function(index) {
				$(this).removeClass('active');
			});
		}
	}
});

$('#toggleOptions').on('click', function(){
	var target = $(this).attr('target');
	$(target).fadeToggle('fast');
});

let addAndUpdateNotificators = function(boxElement, element, update) {
	let target = boxElement.attr('target');
	if(update) {
		let counter = boxElement.attr('counter');
		if(counter == 0) {
			boxElement.addClass('activate');
		}
		boxElement.attr('counter', parseInt(counter) + 1);
	}
	$(navbar + ' ' + target + ' .navbar-notifications').append(element);
}

let addMyTutorie = function(notification) {
	var element = tutorie_notification_template
		.replace('[monitorie_link]', notification.monitorie_link)
		.replace('[user_picture]', notification.user_picture)
		.replace('[subject_name]', notification.subject_name)
		.replace('[user_name]', notification.user_name)
		.replace('[monitorie_type]', notification.monitorie_type)
		.replace('[monitorie_place]', notification.monitorie_place)
		.replace('[monitorie_date]', notification.monitorie_date)
		.replace('[monitorie_time]', notification.monitorie_time);
	addAndUpdateNotificators($(navbar + ' #toggle-my-tutories'), element, true);
}

let addTutorie = function(notification) {
	var element = my_tutorie_notification_template
		.replace('[monitorie_link]', notification.monitorie_link)
		.replace('[user_picture]', notification.user_picture)
		.replace('[subject_name]', notification.subject_name)
		.replace('[monitorie_type]', notification.monitorie_type)
		.replace('[monitorie_place]', notification.monitorie_place)
		.replace('[monitorie_date]', notification.monitorie_date)
		.replace('[monitorie_time]', notification.monitorie_time);
	addAndUpdateNotificators($(navbar + ' #toggle-tutories'), element, true);
}

let addNotification = function(notification) {
	var element = notification_template
		.replace('[notification_link]', notification.notification_link)
		.replace('[notification_date]', notification.notification_date)
		.replace('[user_picture]', notification.user_picture)
		.replace('[active]', notification.viewed ? '' : 'active')
		.replace('[notification_description]', notification.notification_description);
	addAndUpdateNotificators($(navbar + ' #toggle-notification'), element, !notification.viewed);
}

let addChatNotification = function(notification) {
	var element = chat_notification_template
		.replace('[notification_link]', notification.notification_link)
		.replace('[notification_date]', notification.notification_date)
		.replace('[user_picture]', notification.user_picture)
		.replace('[user_name]', notification.user_name)
		.replace('[notification_description]', notification.notification_description);
	addAndUpdateNotificators($(navbar + ' #toggle-chat'), element, true);
}

function initModal(id) {
	var modal = $('#modal-coments');
	var coments = modal.find('.comentary');
	var dotsContainer = modal.find('#dots');
	var size = coments.length;
	dotsContainer.html('');
	for(var i = 0; i < size; i++) {
		var dot = "<div class='m-dot' target='" + i + "'>•</div>";
		dotsContainer.append(dot);
	}
	var dots = dotsContainer.find('.m-dot');
	var i = 0;
	if(size > 0) {
		coments.get(i).classList.add('active');
		dots.get(i).classList.add('active');
	} else {
		modal.fadeOut();
		setTimeout(function(){
			modal.remove();
		}, 1000);
	}
	var prev = modal.find('#prev-button');
	var next = modal.find('#next-button');
	var expand = modal.find('#expand');
	var close = modal.find('#close');

	function assign(prev, actual) {
		coments.get(prev).classList.remove('active');
		coments.get(actual).classList.add('active');
		dots.get(prev).classList.remove('active');
		dots.get(actual).classList.add('active');
	}

	prev.on('click', function(){
		if(i > 0) {
			assign(i--, i);
		} else {
			assign(i, i = size - 1);
		}
	});

	next.on('click', function(){
		if(i < size - 1) {
			assign(i++, i);
		} else {
			assign(i, i = 0);
		}
	});

	dots.on('click', function(){
		var target = parseInt($(this).attr('target'));
		assign(i, i = target);
	});
}

initModal('#modal-coments');

function comment(id, comment) {
	var comment = $(comment);
	var value = comment.find('[type=\'radio\']:checked').val();
	var description = comment.find('textarea').val();
	console.log(value + " - " + description);
	$.ajax({
	type: "POST",
	url: "/ajax/comment.php",
	data: { id : id, value : value, description : description },
		success: function (msg) {
			var response = JSON.parse(msg);
			console.log(response.result);
			comment.remove();

			initModal('#modal-coments');
		}
	});
}

$(document).ready(function() {
	setInterval(function(){
		$.ajax({
			type: "POST",
			url: "/ajax/updateNotifications.php",
			data: { last_id : last_ntf },
				success: function (msg) {
					var response = JSON.parse(msg);
					console.log(response.result);
					for(var i = 0; i < response.ntfs.length; i++) {
						addNotification(response.ntfs[i]);
					}
					last_ntf = response.last_id;
				}
		});
	}, 1000);
});
