let controlPane = '#user-main-control';
let menutoggle = $(controlPane + ' #toggle-user-main-control');
let notificationsToggle = $(controlPane + ' #toggle-notifications');
let informationToggle = $(controlPane + ' #toggle-information');

menutoggle.on('click', function(){
	let target = $(this).attr('data-target');
	$(target).toggleClass('menu__visible');
});

notificationsToggle.on('click', function(){
	let target = $(this).attr('data-target');
	$(target).slideToggle();
});

informationToggle.on('click', function(){
	$(this).toggleClass('ilm-pull-down');
	$(this).toggleClass('ilm-pull-up');
	let target = $(this).attr('data-target');
	$(target).slideToggle();
});
