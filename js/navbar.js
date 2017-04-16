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

let addTutorie = function(myTutorie, userPicture, subjectName, userName, place, date, duration) {
	let notification = document.createElement('a');
	notification.setAttribute('class', 'box notification');
	notification.setAttribute('href', '#');

	let flexContent = document.createElement('section');
	flexContent.setAttribute('class', 'box-h-section');
	notification.appendChild(flexContent);

	let image = document.createElement('img');
	image.setAttribute('src', userPicture);
	image.setAttribute('class', 'picture');
	flexContent.appendChild(image);

	let group = document.createElement('div');
	group.setAttribute('class', 'box-v-section box-justify-center gutter-0');
	flexContent.appendChild(group);

	let topic = document.createElement('p');
	topic.setAttribute('class', 'sub-title');
	topic.innerHTML = subjectName;
	group.appendChild(topic);

	let user = document.createElement('p');
	user.setAttribute('class', 'box-data');
	if(myTutorie) {
		user.setAttribute('name', 'Monitor: ');
	} else {
		user.setAttribute('name', 'Estudiante: ');
	}
	user.innerHTML = userName;
	group.appendChild(user);

	let monitoriePlace = document.createElement('p');
	monitoriePlace.setAttribute('class', 'box-data');
	monitoriePlace.setAttribute('name', 'Lugar: ');
	monitoriePlace.innerHTML = place;
	group.appendChild(monitoriePlace);

	let monitorieDate = document.createElement('p');
	monitorieDate.setAttribute('class', 'box-data');
	monitorieDate.setAttribute('name', 'Lugar: ');
	monitorieDate.innerHTML = date;
	group.appendChild(monitorieDate);

	let monitorieDuration = document.createElement('p');
	monitorieDuration.setAttribute('class', 'box-data');
	monitorieDuration.setAttribute('name', 'Duración: ');
	monitorieDuration.innerHTML = duration;
	group.appendChild(monitorieDuration);

	if(myTutorie){
		addAndUpdateNotificators($(navbar + ' #toggle-my-tutories'), notification);
	} else {
		addAndUpdateNotificators($(navbar + ' #toggle-tutories'), notification);
	}
}

let addNotification = function(chat, userPicture, userName, description, date) {
	let notification = document.createElement('a');
	notification.setAttribute('class', 'box notification data-fixed');
	notification.setAttribute('href', '#');
	notification.setAttribute('data-fixed', date);

	let flexContent = document.createElement('section');
	flexContent.setAttribute('class', 'box-h-section');
	notification.appendChild(flexContent);

	let image = document.createElement('img');
	image.setAttribute('src', userPicture);
	image.setAttribute('class', 'picture');
	flexContent.appendChild(image);

	let group = document.createElement('div');
	group.setAttribute('class', 'box-v-section box-justify-center gutter-0');
	flexContent.appendChild(group);

	let user = document.createElement('p');
	user.setAttribute('class', 'sub-title');
	user.innerHTML = userName;
	group.appendChild(user);

	let descriptionNtf = document.createElement('p');
	descriptionNtf.setAttribute('class', 'box-data');
	descriptionNtf.innerHTML = description;
	group.appendChild(descriptionNtf);

	if(chat){
		addAndUpdateNotificators($(navbar + ' #toggle-chat'), notification);
	} else {
		addAndUpdateNotificators($(navbar + ' #toggle-notification'), notification);
	}
}

addTutorie(true, 'https://instagram.feoh1-1.fna.fbcdn.net/t51.2885-19/s150x150/12825742_1692854517660573_747437461_a.jpg', 'Lenguajes de programación', 'Maria Paula Moreno', 'Edificio Baron - Salón 402', '22/04/2017', '9:00pm - 10:00pm');
addTutorie(true, 'https://instagram.feoh1-1.fna.fbcdn.net/t51.2885-19/11809532_1484827938495184_412409702_a.jpg', 'Lenguajes de programación', 'José Rafael Domínguez', 'Edificio Baron - Salón 402', '22/04/2017', '9:00pm - 10:00pm');
addTutorie(true, 'https://instagram.feoh1-1.fna.fbcdn.net/t51.2885-19/11410339_857773544301773_1638908020_a.jpg', 'Lenguajes de programación', 'Carlos Quimbay Cunalata', 'Edificio Baron - Salón 402', '22/04/2017', '9:00pm - 10:00pm');
addTutorie(true, 'https://instagram.feoh1-1.fna.fbcdn.net/t51.2885-19/s150x150/11887148_1617879835152288_232994344_a.jpg', 'Lenguajes de programación', 'Stephanie Domínguez', 'Edificio Baron - Salón 402', '22/04/2017', '9:00pm - 10:00pm');

addTutorie(false, 'https://instagram.feoh1-1.fna.fbcdn.net/t51.2885-19/11410339_857773544301773_1638908020_a.jpg', 'Lenguajes de programación', 'Carlos Quimbay Cunalata', 'Edificio Baron - Salón 402', '22/04/2017', '9:00pm - 10:00pm');
addTutorie(false, 'https://instagram.feoh1-1.fna.fbcdn.net/t51.2885-19/s150x150/12825742_1692854517660573_747437461_a.jpg', 'Lenguajes de programación', 'Maria Paula Moreno', 'Edificio Baron - Salón 402', '22/04/2017', '9:00pm - 10:00pm');
addTutorie(false, 'https://instagram.feoh1-1.fna.fbcdn.net/t51.2885-19/s150x150/11887148_1617879835152288_232994344_a.jpg', 'Lenguajes de programación', 'Stephanie Domínguez', 'Edificio Baron - Salón 402', '22/04/2017', '9:00pm - 10:00pm');

addNotification(true, 'https://instagram.feoh1-1.fna.fbcdn.net/t51.2885-19/s150x150/11887148_1617879835152288_232994344_a.jpg', 'Stephanie Domínguez', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Nihil, temporibus.', '22/04/2017 - 3:52pm');
addNotification(true, 'https://instagram.feoh1-1.fna.fbcdn.net/t51.2885-19/s150x150/15803548_1860855724157140_2949620093912350720_a.jpg', 'Luis David Zarate', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Nihil, temporibus.', '22/04/2017 - 3:52pm');
addNotification(true, 'https://instagram.feoh1-1.fna.fbcdn.net/t51.2885-19/s150x150/15625369_1740657899586089_5204408783928819712_a.jpg', 'Carlos Eduardo Camacho', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Nihil, temporibus.', '22/04/2017 - 3:52pm');
addNotification(true, 'https://instagram.feoh1-1.fna.fbcdn.net/t51.2885-19/11410339_857773544301773_1638908020_a.jpg', 'Carlos Quimbay Cunalata', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Nihil, temporibus.', '22/04/2017 - 3:52pm');

addNotification(false, 'https://instagram.feoh1-1.fna.fbcdn.net/t51.2885-19/s150x150/15803548_1860855724157140_2949620093912350720_a.jpg', 'Luis David Zarate', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Nihil, temporibus.', '22/04/2017 - 3:52pm');
addNotification(false, 'https://instagram.feoh1-1.fna.fbcdn.net/t51.2885-19/s150x150/15625369_1740657899586089_5204408783928819712_a.jpg', 'Carlos Eduardo Camacho', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Nihil, temporibus.', '22/04/2017 - 3:52pm');
