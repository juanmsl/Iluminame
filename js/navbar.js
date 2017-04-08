let navbar = '#main-navbar';
let toggles = $(navbar + ' [id^=\'toggle-\']');
let notificators = $(navbar + ' .main-navbar-notificator');
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

toggles.on('click', function(){
	toggleTarget($(this));
});
