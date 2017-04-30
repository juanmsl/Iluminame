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
});

let addAndUpdateNotificators = function(boxElement, element) {
	let target = boxElement.attr('target');
	let counter = boxElement.attr('counter');
	if(counter == 0) {
		boxElement.addClass('activate');
	}
	boxElement.attr('counter', parseInt(counter) + 1);
	$(navbar + ' ' + target + ' .navbar-notifications').append(element);
}

let addTutorie = function(notification) {
	var element = tutorie_notification_template
		.replace('[monitorie_link]', notification.monitorie_link)
		.replace('[user_picture]', notification.user_picture)
		.replace('[subject_name]', notification.subject_name)
		.replace('[user_name]', notification.user_name)
		.replace('[monitorie_type]', notification.monitorie_type)
		.replace('[monitorie_place]', notification.monitorie_place)
		.replace('[monitorie_date]', notification.monitorie_date)
		.replace('[monitorie_time]', notification.monitorie_time);
	addAndUpdateNotificators($(navbar + ' #toggle-my-tutories'), element);
}

let addMyTutorie = function(notification) {
	var element = my_tutorie_notification_template
		.replace('[monitorie_link]', notification.monitorie_link)
		.replace('[user_picture]', notification.user_picture)
		.replace('[subject_name]', notification.subject_name)
		.replace('[monitorie_type]', notification.monitorie_type)
		.replace('[monitorie_place]', notification.monitorie_place)
		.replace('[monitorie_date]', notification.monitorie_date)
		.replace('[monitorie_time]', notification.monitorie_time);
	addAndUpdateNotificators($(navbar + ' #toggle-tutories'), element);
}

let addNotification = function(notification) {
	var element = notification_template
		.replace('[notification_link]', notification.notification_link)
		.replace('[notification_date]', notification.notification_date)
		.replace('[user_picture]', notification.user_picture)
		.replace('[notification_description]', notification.notification_description);
	addAndUpdateNotificators($(navbar + ' #toggle-notification'), element);
}

let addChatNotification = function(notification) {
	var element = chat_notification_template
		.replace('[notification_link]', notification.notification_link)
		.replace('[notification_date]', notification.notification_date)
		.replace('[user_picture]', notification.user_picture)
		.replace('[user_name]', notification.user_name)
		.replace('[notification_description]', notification.notification_description);
	addAndUpdateNotificators($(navbar + ' #toggle-chat'), element);
}
