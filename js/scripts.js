let controlPane = '#user-main-control';
let menutoggle = $(controlPane + ' #toggle-user-main-control');
let notificationsToggle = $(controlPane + ' #toggle-notifications');

menutoggle.on('click', function(){
	let target = $(this).attr('data-target');
	$(target).toggleClass('menu__visible');
});

notificationsToggle.on('click', function(){
	let target = $(this).attr('data-target');
	$(target).slideToggle();
});
