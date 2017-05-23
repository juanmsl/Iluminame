$('#cards').owlCarousel({
	autoplay: true,
	autoplayTimeout: 2500,
	loop: true,
	rewind: true,
	responsive:{
		0:{
			items:1,
			loop:true
		},
		500:{
			items:2
		},
		800:{
			items:3
		},
		1100:{
			items:4
		}
	}
});
