// Navbar notifications

let tutorie_notification_template = "" +
"<a class='box notification' href='[monitorie_link]'>" +
"	<section class='box-h-section'>" +
"		<img src='[user_picture]' class='picture'>" +
"		<div class='box-v-section box-justify-center gutter-0'>" +
"			<p class='sub-title'>[subject_name]</p>" +
"			<p class='box-data' name='Monitor: '>[user_name]</p>" +
"			<p class='box-data' name='Lugar: '>[monitorie_place]</p>" +
"			<p class='box-data' name='Fecha: '>[monitorie_date]</p>" +
"			<p class='box-data' name='Duración: '>[monitorie_time]</p>" +
"		</div>" +
"	</section>" +
"</a>";

let my_tutorie_notification_template = "" +
"<a class='box notification' href='[monitorie_link]'>" +
"	<section class='box-h-section'>" +
"		<img src='[user_picture]' class='picture'>" +
"		<div class='box-v-section box-justify-center gutter-0'>" +
"			<p class='sub-title'>[subject_name]</p>" +
"			<p class='box-data' name='Tipo: '>[monitorie_type]</p>" +
"			<p class='box-data' name='Lugar: '>[monitorie_place]</p>" +
"			<p class='box-data' name='Fecha: '>[monitorie_date]</p>" +
"			<p class='box-data' name='Duración: '>[monitorie_time]</p>" +
"		</div>" +
"	</section>" +
"</a>";

let notification_template = "" +
"<a class='box notification data-fixed' href='[notification_link]' data-fixed='[notification_date]'>" +
"	<section class='box-h-section'>" +
"		<img src='[user_picture]' class='picture'>" +
"		<div class='box-v-section box-justify-center gutter-0'>" +
"			<p class='box-data'>[notification_description]</p>" +
"		</div>" +
"	</section" +
"</a>";

let chat_notification_template = "" +
"<a class='box notification data-fixed' href='[notification_link]' data-fixed='[notification-date]'>" +
"	<section class='box-h-section'>" +
"		<img src='[user_picture]' class='picture'>" +
"		<div class='box-v-section box-justify-center gutter-0'>" +
"			<p class='sub-title'>[user_name]</p>" +
"			<p class='box-data'>[notification_description]</p>" +
"		</div>" +
"	</section" +
"</a>";

// Monitories

let monitorie_template = "" +
"<section class='box card box-margin'>" +
"	<a href='[user_link]' class='box-h-section box-header'>" +
"	<img src='[user_picture]' class='picture'>" +
"		<div class='box-v-section box-justify-center gutter-0'>" +
"			<p class='sub-title'>[subject_name]</p>" +
"			<p>[user_name]</p>" +
"		</div></a>" +
"	<section class='box-v-section'>" +
"		<p name='Lugar: ' class='box-data'>[monitorie_place]</p>" +
"		<p name='Fecha: ' class='box-data'>[monitorie_date]</p>" +
"		<p name='Duración: ' class='box-data'>[monitorie_time]</p>" +
"		<p name='Precio por estudiante: ' class='box-data'>[monitorie_price]</p>" +
"	</section>" +
"	<section class='box-v-section box-footer box-align-center'>" +
"		<p class='box-data' id='state_monitorie_[monitorie_id]'>[monitorie_type]</p>" +
"		<button class='[button_class]-button' onclick='[button_function]_monitorie([monitorie_id], this)'>[button_text]</button>" +
"	</section>" +
"</section>";

$('#cards').owlCarousel({
	autoplay: true,
	margin: 10,
	responsive:{
		0:{
			items:1,
			loop:true,
			center:true
		},
		400:{
			items:2,
			loop:false,
			center:false
		},
		800:{
			items:3,
			loop:false,
			center:false
		},
		1200:{
			items:4,
			loop:false,
			center:false
		}
	}
});

$('#profile-subjects, #profile-active-monitories').owlCarousel({
	margin: 10,
	responsive:{
		0:{
			items:1,
			loop:true,
			center:true
		},
		600:{
			items:2,
			loop:false,
			center:false
		},
		1200:{
			items:3,
			loop:false,
			center:false
		}
	}
});


function join_monitorie(id, element) {
	$.ajax({
	type: "POST",
	url: "/ajax/join.php",
	data: { id : id },
		success: function (msg) {
			console.log("Ok!");
			var response = JSON.parse(msg);
			console.log(response.count + ' / ' + response.max);
			updateLeaveButton(id, element, response);
		}
	});
}

function updateLeaveButton(id, element, res) {
	var state = document.getElementById('state_monitorie_' + id);
	state.innerHTML = res.count + ' / ' + res.max + ' inscritos';
	element.setAttribute('onclick','leave_monitorie(' + id + ', this)');
	element.setAttribute('class','leave-button');
	element.innerHTML = 'Abandonar monitoria';
}

function leave_monitorie(id, element) {
	$.ajax({
	type: "POST",
	url: "/ajax/leave.php",
	data: { id : id },
		success: function (msg) {
			console.log("Ok!");
			var response = JSON.parse(msg);
			console.log(response.count + ' / ' + response.max);
			updateJoinButton(id, element, response);
		}
	});
}

function updateJoinButton(id, element, res) {
	var state = document.getElementById('state_monitorie_' + id);
	state.innerHTML = res.count + ' / ' + res.max + ' inscritos';
	element.setAttribute('onclick','join_monitorie(' + id + ', this)');
	element.setAttribute('class','join-button');
	element.innerHTML = 'Deseo unirme';
}

function follow(id) {
	$.ajax({
	type: "POST",
	url: "/ajax/follow.php",
	data: { id : id },
		success: function (msg) {
			console.log("Ok!");
			var response = JSON.parse(msg);
			console.log(response.count + " total");
		}
	});
}
