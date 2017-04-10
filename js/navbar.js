let navbar = '#main-navbar';
let toggles = $(navbar + ' [id^=\'toggle-\']');
let notificators = $(navbar + ' .main-navbar-notificator');
let activeElement = null;

let toggleTarget = function(element) {
	let activeTarget = null;
	if(activeElement != null) {
		activeTarget = activeElement.attr('data-target');
		activeElement.removeClass('is-hover');
		$(activeTarget).hide();
	}
	let elementTarget = element.attr('data-target');
	if(activeTarget === elementTarget) {
		activeElement = null;
		return;
	}
	activeElement = element;
	activeElement.addClass('is-hover');
	$(elementTarget).show();
}

notificators.each(function(){
	let target = $(this).attr('data-target');
	let counterNTF = $(target + ' .main-navbar-notifications').children('.ntf').size();
	if(counterNTF == 0) {
		$(this).removeClass('activate');
	} else {
		$(this).addClass('activate');
	}
	$(this).attr('data-counter', counterNTF);
});

toggles.on('click', function(){
	toggleTarget($(this));
});

let addAndUpdateNotificators = function(boxElement, element) {
	let target = boxElement.attr('data-target');
	let counter = boxElement.attr('data-counter');
	if(counter == 0) {
		boxElement.addClass('activate');
	}
	boxElement.attr('data-counter', parseInt(counter) + 1);
	$(navbar + ' ' + target + ' .main-navbar-notifications').append(element);
}

let addTutorie = function(myTutorie, userPicture, subjectName, userName, place, date, duration) {
	let notification = document.createElement('section');
	notification.setAttribute('class', 'ntf');
	let image = document.createElement('img');
	image.setAttribute('src', userPicture);
	image.setAttribute('class', 'ntf-picture');
	let group = document.createElement('div');
	group.setAttribute('class', 'ntf-group');

	let topic = document.createElement('h6');
	topic.setAttribute('class', 'ntf-subject');
	topic.innerHTML = subjectName;

	let user = document.createElement('p');
	if(myTutorie) {
		user.setAttribute('class', 'ntf-monitor');
	} else {
		user.setAttribute('class', 'ntf-student');
	}
	user.innerHTML = userName;

	let monitoriePlace = document.createElement('p');
	monitoriePlace.setAttribute('class', 'ntf-place');
	monitoriePlace.innerHTML = place;

	let monitorieDate = document.createElement('p');
	monitorieDate.setAttribute('class', 'ntf-date');
	monitorieDate.innerHTML = date;

	let monitorieDuration = document.createElement('p');
	monitorieDuration.setAttribute('class', 'ntf-time');
	monitorieDuration.innerHTML = duration;

	group.appendChild(topic);
	group.appendChild(user);
	group.appendChild(monitoriePlace);
	group.appendChild(monitorieDate);
	group.appendChild(monitorieDuration);

	notification.appendChild(image);
	notification.appendChild(group);

	if(myTutorie){
		addAndUpdateNotificators($(navbar + ' #toggle-my-tutories'), notification);
	} else {
		addAndUpdateNotificators($(navbar + ' #toggle-tutories'), notification);
	}
}

let addNotification = function(chat, userPicture, userName, description, date) {
	let notification = document.createElement('section');
	notification.setAttribute('class', 'ntf');
	let image = document.createElement('img');
	image.setAttribute('src', userPicture);
	image.setAttribute('class', 'ntf-picture');
	let group = document.createElement('div');
	group.setAttribute('class', 'ntf-group');

	let user = document.createElement('h6');
	user.setAttribute('class', 'ntf-user');
	user.innerHTML = userName;

	let descriptionNtf = document.createElement('p');
	descriptionNtf.setAttribute('class', 'ntf-description');
	descriptionNtf.innerHTML = description;

	let ntfDate = document.createElement('p');
	ntfDate.setAttribute('class', 'ntf-dateFixed');
	ntfDate.innerHTML = date;

	group.appendChild(user);
	group.appendChild(descriptionNtf);
	group.appendChild(ntfDate);

	notification.appendChild(image);
	notification.appendChild(group);

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
