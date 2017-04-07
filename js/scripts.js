$('#user-main-control #menu-toogle').on('click', function(){
	$('#user-main-control').toggleClass('menu__visible');
});

$('#user-main-control #info-toggle').on('click', function(){
	$(this).toggleClass('ilm-pull-down');
	$(this).toggleClass('ilm-pull-up');
	$(this).next('#info').slideToggle();
});
