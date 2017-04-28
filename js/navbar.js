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
		.replace('[notification_description]', atob(notification.notification_description));
	addAndUpdateNotificators($(navbar + ' #toggle-chat'), element);
}

var mapa = {
	monitorie_link: '#',
	user_picture: 'https://instagram.feoh1-1.fna.fbcdn.net/t51.2885-19/s150x150/12825742_1692854517660573_747437461_a.jpg',
	subject_name: 'Lenguajes de programación',
	user_name: 'Maria Paula Moreno',
	monitorie_place: 'Edificio Baron - Salón 402',
	monitorie_date: 'Abril 17 de 2017',
	monitorie_time: '9:00am - 10:00am'
};
addTutorie(mapa);

var carlos = {
	monitorie_link: '#',
	user_picture: 'https://instagram.feoh1-1.fna.fbcdn.net/t51.2885-19/11410339_857773544301773_1638908020_a.jpg',
	subject_name: 'Ingeniería de software',
	monitorie_type: 'Privada',
	monitorie_place: 'Edificio Baron - Salón 402',
	monitorie_date: 'Abril 25 de 2017',
	monitorie_time: '2:00pm - 4:00pm'
};
addMyTutorie(carlos);


var luis = {
	notification_link: '#',
	notification_date: 'Abril 15 de 2017, 3:52pm',
	user_picture: 'https://instagram.feoh1-1.fna.fbcdn.net/t51.2885-19/s150x150/15803548_1860855724157140_2949620093912350720_a.jpg',
	notification_description: 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Nihil, temporibus.',
};
addNotification(luis);
