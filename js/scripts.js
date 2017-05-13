Push.Permission.GRANTED;

// Navbar notifications

let tutorie_notification_template = "" +
"<a class='box notification' href='[monitorie_link]'>" +
"	<section class='box-h-section'>" +
"		<img src='[user_picture]' class='picture'>" +
"		<div class='box-v-section box-justify-center gutter-0'>" +
"			<h6 class='sub-title'>[subject_name]</h6>" +
"			<p class='box-data' name='Monitor: '>[user_name]</p>" +
"			<p class='box-data' name='Tipo: '>[monitorie_type]</p>" +
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
"			<h6 class='sub-title'>[subject_name]</h6>" +
"			<p class='box-data' name='Tipo: '>[monitorie_type]</p>" +
"			<p class='box-data' name='Lugar: '>[monitorie_place]</p>" +
"			<p class='box-data' name='Fecha: '>[monitorie_date]</p>" +
"			<p class='box-data' name='Duración: '>[monitorie_time]</p>" +
"		</div>" +
"	</section>" +
"</a>";

let notification_template = "" +
"<a class='box notification data-fixed [active]' href='[notification_link]' data-fixed='[notification_date]'>" +
"	<section class='box-h-section'>" +
"		<img src='[user_picture]' class='picture'>" +
"		<div class='box-v-section box-justify-center gutter-0'>" +
"			<p class='box-data'>[notification_description]</p>" +
"		</div>" +
"	</section" +
"</a>";

let chat_notification_template = "" +
"<a class='box notification data-fixed' href='[notification_link]' data-fixed='[notification_date]'>" +
"	<section class='box-h-section'>" +
"		<img src='[user_picture]' class='picture'>" +
"		<div class='box-v-section box-justify-center gutter-0'>" +
"			<h6 class='sub-title'>[user_name]</h6>" +
"			<p class='box-data'>[notification_description]</p>" +
"		</div>" +
"	</section" +
"</a>";

// Monitories

let monitorie_template = "" +
"<section class='box [card] box-margin [disabled]'>" +
"	<a href='[link]' class='box-h-section box-header'>" +
"		<img src='[user_picture]' class='picture'>" +
"		<div class='box-v-section box-justify-center gutter-0'>" +
"			<h6 class='sub-title'>[subject_name]</h6>" +
"			<p>[user_name]</p>" +
"		</div>" +
"	</a>" +
"	<section class='box-v-section'>" +
"		<p class='ilm-place data' title='Lugar de la monitoria'>[place]</p>" +
"		<p class='ilm-date data' title='Fecha de la monitoria'>[date]</p>" +
"		<p class='ilm-time data' title='Duración de la monitoria'>[time]</p>" +
"		<p class='ilm-money data' title='Precio por estudiante'>[price] / estudiante</p>" +
"	</section>" +
"	<section class='box-v-section box-footer box-align-center box-justify-center'>" +
"		<p class='box-data' id='state_monitorie_[id]'>[type]</p>" +
"		<button class='[button_class]-button' id='button_monitorie_[id]' [button_function] [button_enable]>[button_text]</button>" +
"	</section>" +
"</section>";

let createMonitorie = function(n) {
	var state = (n.type) ? n.inscriptions + ' / ' + n.maximun + ' inscritos' : 'Privada';
	var button_class = (n.is_signed == 1) ? 'leave' : (n.inscriptions == n.maximun) ? 'full' : 'join';
	var button_function = (n.is_signed == 1) ? 'leave' : (n.inscriptions == n.maximun) ? '' : 'join';
	var button_text = (n.is_signed == 1) ? 'Abandonar monitoria' : (n.inscriptions == n.maximun) ? 'Monitoria llena' : 'Deseo unirme';
	var button_enable = (n.is_signed == 1 || n.inscriptions < n.maximun || !n.disabled);

	var element = monitorie_template
		.replace('[id]', n.id)
		.replace('[id]', n.id)
		.replace('[card]', n.card)
		.replace('[link]', n.link)
		.replace('[user_picture]', n.user_picture)
		.replace('[subject_name]', n.subject_name)
		.replace('[user_name]', n.user_name)
		.replace('[place]', n.place)
		.replace('[date]', n.date)
		.replace('[time]', n.time)
		.replace('[price]', n.price)
		.replace('[disabled]', (n.disabled ? 'box-disabled' : ''))
		.replace('[type]', state)
		.replace('[button_class]', button_class)
		.replace('[button_function]', button_function == '' ? '' : 'onclick=\'' + button_function + '_monitorie(' + n.id + ', this, true)\'')
		.replace('[button_text]', button_text)
		.replace('[button_enable]', button_enable ? '' : 'disabled');
	return element;
}

let addMonitorieTo = function(n, container) {
	var element = createMonitorie(n);
	$(container).append(element);
	if(n.isMe == 1 || n.disabled) {
		var button = document.getElementById('button_monitorie_' + n.id);
		button.parentElement.removeChild(button);
	}
}

function join_monitorie(id, element, update) {
	element.disabled = true;
	element.classList.remove('join-button');
	element.classList.add('disabled-button');
	element.innerHTML = "Procesando";
	$.ajax({
	type: "POST",
	url: "/ajax/join.php",
	data: { id : id },
		success: function (msg) {
			var response = JSON.parse(msg);
			console.log(response.result + ' de ' + response.materia);
			Push.create(response.materia, {
				body: response.result + ' de ' + response.materia + ' de ' + response.monitor,
				icon: 'resources/emojis/happy-2.png',
				timeout: 5000
			});
			if(update) {
				var state = document.getElementById('state_monitorie_' + id);
				state.innerHTML = response.inscritos + ' / ' + response.maximun + ' inscritos';
			}
			var action = element.getAttribute('onclick');
			element.setAttribute('onclick', action.replace('join_','leave_'));
			element.classList.remove('disabled-button');
			element.classList.add('leave-button');
			element.innerHTML = 'Abandonar monitoria';
			element.disabled = false;
		}
	});
}

function leave_monitorie(id, element, update) {
	element.disabled = true;
	element.classList.remove('leave-button');
	element.classList.add('disabled-button');
	element.innerHTML = "Procesando";
	$.ajax({
	type: "POST",
	url: "/ajax/leave.php",
	data: { id : id },
		success: function (msg) {
			var response = JSON.parse(msg);
			console.log(response.result + ' de ' + response.materia);
			Push.create(response.materia, {
				body: response.result + ' de ' + response.materia + ' de ' + response.monitor,
				icon: 'resources/emojis/sad-2.png',
				timeout: 5000
			});
			if(update) {
				var state = document.getElementById('state_monitorie_' + id);
				state.innerHTML = response.inscritos + ' / ' + response.maximun + ' inscritos';
			}
			var action = element.getAttribute('onclick');
			element.setAttribute('onclick', action.replace('leave_','join_'));
			element.classList.remove('disabled-button');
			element.classList.add('join-button');
			element.innerHTML = 'Deseo unirme';
			element.disabled = false;
		}
	});
}

function follow(id, element, update) {
	$.ajax({
	type: "POST",
	url: "/ajax/follow.php",
	data: { id : id },
		success: function (msg) {
			var response = JSON.parse(msg);
			console.log(response.result);
			if(update) {
				var followers = document.getElementById('profile-followers');
				followers.setAttribute('data', response.count);
				element.setAttribute('class','unfollow-button');
				element.innerHTML = 'Dejar de seguir';
			} else {
				element.setAttribute('class','ilm-unfollow user-follow default-button');
			}
			var action = element.getAttribute('onclick');
			element.setAttribute('title','Dejar de seguir');
			element.setAttribute('onclick', action.replace('follow(','unfollow('));
		}
	});
}

function unfollow(id, element, update) {
	$.ajax({
	type: "POST",
	url: "/ajax/unfollow.php",
	data: { id : id },
		success: function (msg) {
			var response = JSON.parse(msg);
			console.log(response.result);
			if(update) {
				var followers = document.getElementById('profile-followers');
				followers.setAttribute('data', response.count);
				element.setAttribute('class','follow-button');
				element.innerHTML = 'Seguir';
			} else {
				element.setAttribute('class','ilm-follow user-follow default-button');
			}
			var action = element.getAttribute('onclick');
			element.setAttribute('title','Seguir');
			element.setAttribute('onclick', action.replace('unfollow(','follow('));
		}
	});
}

let user_box = "" +
"<section class='user-box'>" +
"	<a href='[link]'><img src='[picture]' class='big-picture'></a>" +
"	<div class='user-data'>" +
"		<h6 class='sub-title'><a href='[link]'>[name]</a></h6>" +
"		<div class='user-sub-group'>" +
"			<a href='[link]' class='user-id'>[user]</a>" +
"			<p class='follow-you'>[isFollowMe]</p>" +
"		</div>" +
"	</div>" +
"	<button class='user-follow default-button ilm-[button_class] [hidden]' onclick='[button_action]([user_id], this, false)' title='[button_text]'></button>" +
"</section>";

let addUserTo = function(n, container) {
	var follow_button_action = (n.isFollow == '1') ? 'unfollow' : 'follow';
	var follow_button_text = (n.isFollow == '1') ? 'Dejar de seguir' : 'Seguir';
	var is_follow_me = (n.isFollowMe == '1') ? '<b class="dot"></b>Te sigue' : '';

	var user = user_box
		.replace('[isFollowMe]', is_follow_me)
		.replace('[picture]', n.picture)
		.replace('[link]', n.link)
		.replace('[link]', n.link)
		.replace('[link]', n.link)
		.replace('[name]', n.name)
		.replace('[user]', n.user)
		.replace('[button_class]', follow_button_action)
		.replace('[button_action]', follow_button_action)
		.replace('[user_id]', n.user_id)
		.replace('[button_text]', follow_button_text)
		.replace('[hidden]', n.isMe ? 'hidden' : '');
	$(container).append(user);
}

$('input[name = "rating"]').on('click', function(){
	var element = document.querySelector('input[name = "rating"]:checked');
	var parent = element.parentElement;
	var value = element.value;
	console.log(value);
	parent.setAttribute('data-value', value);
});

let subject_template = "" +
"<section class='box [card] box-margin'>" +
"	<section href='#' class='box-h-section box-header'>" +
"		<a href='[user_link]' title='[user_name]'><img src='[user_picture]' class='big-picture'></a>" +
"		<div class='box-v-section box-justify-center gutter-0'>" +
"			<h6 class='sub-title'><a href='[subject_link]'>[subject_name]</a></h6>" +
"			<div class='rating'>" +
"				<div data-value='[rating_value] / 5' class='rating-stars'>" +
"					<input type='radio' name='rating-[rating_id]' id='rt-five-full' value='5 / 5' [rating_checked] disabled>" +
"					<label for='rt-five-full' title='5.0'></label>" +
"					<input type='radio' name='rating-[rating_id]' id='rt-four-half' value='4.5 / 5' [rating_checked] disabled>" +
"					<label for='rt-four-half' title='4.5'></label>" +
"					<input type='radio' name='rating-[rating_id]' id='rt-four-full' value='4 / 5' [rating_checked] disabled>" +
"					<label for='rt-four-full' title='4.0'></label>" +
"					<input type='radio' name='rating-[rating_id]' id='rt-tree-half' value='3.5 / 5' [rating_checked] disabled>" +
"					<label for='rt-tree-half' title='3.5'></label>" +
"					<input type='radio' name='rating-[rating_id]' id='rt-tree-full' value='3 / 5'  [rating_checked] disabled>" +
"					<label for='rt-tree-full' title='3.0'></label>" +
"					<input type='radio' name='rating-[rating_id]' id='rt-two-half' value='2.5 / 5' [rating_checked] disabled>" +
"					<label for='rt-two-half' title='2.5'></label>" +
"					<input type='radio' name='rating-[rating_id]' id='rt-two-full' value='2 / 5' [rating_checked] disabled>" +
"					<label for='rt-two-full' title='2.0'></label>" +
"					<input type='radio' name='rating-[rating_id]' id='rt-one-half' value='1.5 / 5' [rating_checked] disabled>" +
"					<label for='rt-one-half' title='1.5'></label>" +
"					<input type='radio' name='rating-[rating_id]' id='rt-one-full' value='1 / 5' [rating_checked] disabled>" +
"					<label for='rt-one-full' title='1.0'></label>" +
"					<input type='radio' name='rating-[rating_id]' id='rt-half' value='0.5 / 5' [rating_checked] disabled>" +
"					<label for='rt-half' title='0.5'></label>" +
"				</div>" +
"			</div>" +
"		</div>" +
"	</section>" +
"	<section class='box-grow box-v-section'>" +
"		<p class='box-data'>[description]</p>" +
"	</section>" +
"	<section class='box-no-grow box-v-section box-align-center' style='text-align: center;'>" +
"		<p name='$[cost_pr] / hora privada' data-tooltip-long='Solo tu y el monitor' data-tooltip-short='(x1)' class='box-data'></p>" +
"		<p name='$[cost_pb] / hora publica' data-tooltip-long='Maximo [max] personas' data-tooltip-short='(x[max])' class='box-data'></p>" +
"	</section>" +
"	<section class='box-h-section box-footer box-justify-center'>" +
"		<button class='join-button'>Solicitar una monitoria</button>" +
"	</section>" +
"</section>";

let addSubjectTo = function(s, container) {
	var subject = subject_template
		.replace('[subject_name]',s.subject_name)
		.replace('[rating_value]',s.rating_value)
		.replace('[user_picture]',s.user_picture)
		.replace('[user_link]',s.user_link)
		.replace('[subject_link]',s.subject_link)
		.replace('[user_name]',s.user_name)
		.replace('[card]', s.card)

	var value = parseFloat(s.rating_value);

	for(var i = 9; i >= 0; i--) {
		subject = subject.replace('[rating_id]',s.subject_id + s.user_id);
		if(parseFloat(i/2) < value && value <= parseFloat((i + 1)/2)) {
			subject = subject.replace('[rating_checked]', 'checked');
		} else {
			subject = subject.replace('[rating_checked]', '');
		}
	}
	subject = subject
		.replace('[description]',s.description)
		.replace('[cost_pr]',s.cost_pr)
		.replace('[cost_pb]',s.cost_pb)
		.replace('[max]',s.max)
		.replace('[max]',s.max);
	$(container).append(subject);
}

function readURL(input) {
	if (input.files && input.files[0]) {
		var reader = new FileReader();
		reader.onload = function (e) {
			$('#edit-image').attr('src', e.target.result);
		}
		reader.readAsDataURL(input.files[0]);
	}
}

$('#edit-image-control').change(function(){
	readURL(this);
});
