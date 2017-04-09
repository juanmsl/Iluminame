let navbar = '#main-navbar';
let toggles = $(navbar + ' [id^=\'toggle-\']');
let notificators = $(navbar + ' .main-navbar-notificator');
let boxNotificators = $(navbar + ' .main-navbar-boxNotification');
let findOptions = $(navbar + ' #toggle-findOptions');
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
	let counterNTF = $(target).children('.ntf').size();
	if(counterNTF == 0) {
		$(this).removeClass('activate');
	} else {
		$(this).addClass('activate');
	}
	$(this).attr('data-counter', counterNTF);
	console.log(counterNTF);
});

toggles.on('click', function(){
	toggleTarget($(this));
});
