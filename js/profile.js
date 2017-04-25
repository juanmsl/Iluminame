$('#cards').owlCarousel({
	autoplay: true,
	loop: true,
	rewind: true,
	responsive:{
		0:{
			items:1,
			loop:true
		},
		400:{
			items:2
		},
		800:{
			items:3
		},
		1200:{
			items:4
		}
	}
});

$('#profile-subjects, #profile-active-monitories').owlCarousel({
	loop: true,
	responsive:{
		0:{
			items:1
		},
		600:{
			items:2
		},
		1200:{
			items:3
		}
	}
});
