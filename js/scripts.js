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
	var state = (n.is_public) ? n.inscriptions + ' / ' + n.maximun + ' inscritos' : 'Privada';
	var button_class = (n.is_signed == 1 && n.is_public) ? 'leave' : (n.inscriptions == n.maximun || !n.is_public) ? 'full' : 'join';
	var button_function = (n.is_signed == 1 && n.is_public) ? 'leave' : (n.inscriptions == n.maximun && n.is_public) ? '' : ((!n.is_public) ? 'cancel' : 'join');
	var button_text = (n.is_signed == 1 && n.is_public) ? 'Abandonar monitoria' : (n.inscriptions == n.maximun && n.is_public) ? 'Monitoria llena' : ((!n.is_public) ? 'Cancelar monitoria' : 'Deseo unirme');
	var button_enable = (n.is_signed == 1 || n.inscriptions < n.maximun);

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
	if(n.is_public || (!n.is_public && (n.is_signed || n.isMe)) || n.ignoreConditions) {
		var element = createMonitorie(n);
		$(container).append(element);
		if(n.isMe || n.disabled) {
			var button = document.getElementById('button_monitorie_' + n.id);
			button.parentElement.removeChild(button);
		}
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
	parent.setAttribute('data-value', value + ' / 5');
});


let template_rating = "" +
"<div class='rating'>" +
"	<div data-value='[rating_value] / 5' class='rating-stars'>" +
"		<input type='radio' name='rating-[rating_id]' id='rt-five-full' value='5' [rating_checked] disabled>" +
"		<label for='rt-five-full' title='5.0'></label>" +
"		<input type='radio' name='rating-[rating_id]' id='rt-four-half' value='4.5' [rating_checked] disabled>" +
"		<label for='rt-four-half' title='4.5'></label>" +
"		<input type='radio' name='rating-[rating_id]' id='rt-four-full' value='4' [rating_checked] disabled>" +
"		<label for='rt-four-full' title='4.0'></label>" +
"		<input type='radio' name='rating-[rating_id]' id='rt-tree-half' value='3.5' [rating_checked] disabled>" +
"		<label for='rt-tree-half' title='3.5'></label>" +
"		<input type='radio' name='rating-[rating_id]' id='rt-tree-full' value='3'  [rating_checked] disabled>" +
"		<label for='rt-tree-full' title='3.0'></label>" +
"		<input type='radio' name='rating-[rating_id]' id='rt-two-half' value='2.5' [rating_checked] disabled>" +
"		<label for='rt-two-half' title='2.5'></label>" +
"		<input type='radio' name='rating-[rating_id]' id='rt-two-full' value='2' [rating_checked] disabled>" +
"		<label for='rt-two-full' title='2.0'></label>" +
"		<input type='radio' name='rating-[rating_id]' id='rt-one-half' value='1.5' [rating_checked] disabled>" +
"		<label for='rt-one-half' title='1.5'></label>" +
"		<input type='radio' name='rating-[rating_id]' id='rt-one-full' value='1' [rating_checked] disabled>" +
"		<label for='rt-one-full' title='1.0'></label>" +
"		<input type='radio' name='rating-[rating_id]' id='rt-half' value='0.5' [rating_checked] disabled>" +
"		<label for='rt-half' title='0.5'></label>" +
"	</div>" +
"</div>";

function createRating(id, value) {
	value = parseFloat(value).toFixed(1);
	var rating = template_rating.replace('[rating_value]', value);

	for(var i = 9; i >= 0; i--) {
		rating = rating.replace('[rating_id]', id);
		if(parseFloat(i/2) < value && value <= parseFloat((i + 1)/2)) {
			rating = rating.replace('[rating_checked]', 'checked');
		} else {
			rating = rating.replace('[rating_checked]', '');
		}
	}
	return rating;
}

function addRatingTo(id, value, container) {
	var rating = createRating(id, value);
	$(container).append(rating);
}

let subject_template = "" +
"<section class='box [card] box-margin'>" +
"	<section href='#' class='box-h-section box-header'>" +
"		<a href='[user_link]' title='[user_name]'><img src='[user_picture]' class='big-picture'></a>" +
"		<div class='box-v-section box-justify-center gutter-0'>" +
"			<h6 class='sub-title'><a href='[subject_link]'>[subject_name]</a></h6>" +
"			[RATING]" +
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
"		<button class='join-button' onclick=\"createSolicitud([SOLICITUD])\">Solicitar una monitoria</button>" +
"	</section>" +
"</section>";

let addSubjectTo = function(s, container) {
	var solicitud = "{" +
	"	modal_id: 'solicitud_" + s.subject_id + "_" + s.user_id + "'," +
	"	user_link: 'profile.php?user=" + s.user_user + "'," +
	"	user_name: '" + s.user_name + "'," +
	"	user_picture: '" + s.user_picture + "'," +
	"	subject_link: 'subjects.php?id=" + s.subject_id + "&user=" + s.user_id + "'," +
	"	subject_name: '" + s.subject_name + "'," +
	"	rating_value: " + s.rating_value + "," +
	"	description: '" + s.description + "'," +
	"	cost_pr: '" + s.cost_pr + "'," +
	"	cost_pb: '" + s.cost_pb + "'," +
	"	user_id: '" + s.user_id + "'," +
	"	subject_id: '" + s.subject_id + "'," +
	"	max: " + s.max + "" +
	"}";
	var subject = subject_template
		.replace('[subject_name]',s.subject_name)
		.replace('[user_picture]',s.user_picture)
		.replace('[user_link]',s.user_link)
		.replace('[subject_link]',s.subject_link)
		.replace('[user_name]',s.user_name)
		.replace('[card]', s.card)
		.replace('[description]',s.description)
		.replace('[cost_pr]',s.cost_pr)
		.replace('[cost_pb]',s.cost_pb)
		.replace('[max]',s.max)
		.replace('[max]',s.max)
		.replace('[SOLICITUD]', solicitud)
		.replace('[RATING]', createRating(s.subject_id + s.user_id, s.rating_value));
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

let template_notification_box = "" +
"<a href='[link]' data-fixed='[hour]' class='box card box-margin data-fixed [active]'>" +
"	<section class='box-h-section'><img src='[picture]' class='big-picture'>" +
"		<div class='box-v-section box-justify-center gutter-0'>" +
"			<p class='box-data'>[description]</p>" +
"		</div>" +
"	</section>" +
"</a>";

function createGroupNotifications(container, g) {
	var group = "<div class='box-group' id='" + g.id + "'></div>";
	$(container).append("<div name='" + g.date + "' class='separator'></div>");
	$(container).append(group);
}

function addNotificationToGroup(n, group) {
	var notification = template_notification_box
		.replace('[link]', n.link)
		.replace('[hour]', n.hour)
		.replace('[picture]', n.picture)
		.replace('[active]', n.viewed ? '' : 'active')
		.replace('[description]', n.description);
	$(group).append(notification);
}

let template_comentary = "" +
"<div class='box box-margin' style='width: 100%;'>" +
"	<div class='box-h-section'>" +
"		<img src='[picture]' class='big-picture' data-pin-nopin='true'>" +
"		<div class='box-v-section gutter-0 box-justify-center'>" +
"			<div class='box-v-section gutter-0 box-justify-center'>" +
"				<div class='sub-title'>[name]</div>" +
"				[RATING]" +
"			</div>" +
"			<div class='box-h-section'>" +
"				<p>[description]</p>" +
"			</div>" +
"		</div>" +
"	</div>" +
"</div>";

function addComentaryTo(c, container) {
	var subject = template_comentary
		.replace('[picture]',c.picture)
		.replace('[name]',c.name)
		.replace('[description]',c.description)
		.replace('[RATING]', createRating(c.comentary_id, c.rating_value));
	$(container).append(subject);
}

let template_solicitar_monitoria = "" +
"<section class='modal' id='[modal_id]'>" +
"	<section class='modal-content box'>" +
"		<section href='#' class='box-h-section box-header'>" +
"			<a href='[user_link]' title='[user_name]'><img src='[user_picture]' class='big-picture'></a>" +
"			<div class='box-v-section box-justify-center gutter-0'>" +
"				<h6 class='sub-title'><a href='[subject_link]'>[subject_name]</a></h6>" +
"				[RATING]" +
"			</div>" +
"		</section>" +
"		<section class='box-v-section'>" +
"			<p class='box-data'>[description]</p>" +
"		</section>" +
"		<section class='box-v-section box-align-center' style='text-align: center;'>" +
"			<p name='$[cost_pr] / hora privada' data-tooltip-long='Solo tu y el monitor' data-tooltip-short='(x1)' class='box-data'></p>" +
"			<p name='$[cost_pb] / hora publica' data-tooltip-long='Maximo [max] personas' data-tooltip-short='(x[max])' class='box-data'></p>" +
"		</section>" +
"		<form class='box-v-section modal-form' id='form_[modal_id]' method='post' action='javascript:ask_for([monitor_id],[materia_id],[modal_id])'>" +
"			<input type='hidden' id='monitor_id' value='[monitor_id]'>" +
"			<input type='hidden' id='materia_id' value='[materia_id]'>" +
"			<label for='lugar' class='form-label'>Lugar de la monitoria</label>" +
"			<input type='text' name='lugar' id='lugar' class='form-item' maxlength='50' required>" +
"			<label for='fecha' class='form-label'>Fecha  y hora para la monitoria</label>" +
"			<input type='datetime-local' value='2017-06-01T14:00' name='fecha' id='fecha' class='form-item' required>" +
"			<label for='duracion' class='form-label'>Duración de la monitoria (Horas)</label>" +
"			<input type='number' name='duracion' id='duracion' min='1' max='8' value='1' class='form-item' onchange='changeValue(this, \"#type_privada_label\", \"#type_publica_label\")' required>" +
"			<section class='form-subgroup' id='type-value-monitorie'>" +
"				<input type='radio' name='type' id='type_publica' value='true' checked>" +
"				<label for='type_publica' price='[cost_pr]' id='type_publica_label' price-value='[cost_pr]' class='form-radio-label'>Monitoria publica</label>" +
"			</section>" +
"			<section class='form-subgroup' id='type-value-monitorie'>" +
"				<input type='radio' name='type' id='type_privada' value='false'>" +
"				<label for='type_privada' price='[cost_pb]' id='type_privada_label' price-value='[cost_pb]' class='form-radio-label'>Monitoria privada</label>" +
"			</section>" +
"		</form>" +
"		<section class='box-h-section box-footer box-justify-center'>" +
"			<button class='join-button' form='form_[modal_id]'>Solicitar esta monitoria</button>" +
"		</section>" +
"	</section>" +
"	<div class='modal-close'></div>" +
"</section>" +
"<script>" +
"	$('.modal-close').on('click', function(){" +
"		$(this).parent().fadeOut();" +
"		setTimeout(function(elem){" +
"			$(elem).parent().remove();" +
"		}, 1000, this);" +
"	});"+
"</script>";

function changeValue(element, pr, pb) {
	var value = parseInt(element.value);
	var value_pr = parseInt($(pr).attr('price'));
	var value_pb = parseInt($(pb).attr('price'));
	$(pr).attr('price-value', (value_pr * value));
	$(pb).attr('price-value', (value_pb * value));
}

function createSolicitud(m) {
	var modal = template_solicitar_monitoria
		.replace('[modal_id]', m.modal_id).replace('[modal_id]', m.modal_id).replace('[modal_id]', m.modal_id).replace('[modal_id]', m.modal_id)
		.replace('[user_link]', m.user_link)
		.replace('[user_name]', m.user_name)
		.replace('[user_picture]', m.user_picture)
		.replace('[subject_link]', m.subject_link)
		.replace('[subject_name]', m.subject_name)
		.replace('[description]', m.description)
		.replace('[monitor_id]', m.user_id).replace('[monitor_id]', m.user_id)
		.replace('[materia_id]', m.subject_id).replace('[materia_id]', m.subject_id)
		.replace('[description]', m.description)
		.replace('[cost_pr]', m.cost_pr).replace('[cost_pr]', m.cost_pr).replace('[cost_pr]', m.cost_pr)
		.replace('[cost_pb]', m.cost_pb).replace('[cost_pb]', m.cost_pb).replace('[cost_pb]', m.cost_pb)
		.replace('[max]', m.max).replace('[max]', m.max)
		.replace('[RATING]', createRating(m.modal_id, m.rating_value));
	$('body').append(modal);
	$('#' + m.modal_id).hide().fadeIn();
}

function getSolicitudData(user_id, subject_id) {
	var form = $('#form_solicitud_' + subject_id + "_" + user_id);
	var data = {
		lugar: form.find('#lugar').val(),
		fecha: form.find('#fecha').val(),
		duracion: form.find('#duracion').val(),
		publica: (form.find('#type_publica').prop('checked') ? 1 : 0),
		monitor_id: form.find('#monitor_id').val(),
		materia_id: form.find('#materia_id').val(),
	};
	return data;
}

function ask_for(user_id, subject_id, modal) {
	var s_data = getSolicitudData(user_id, subject_id);
	console.log(s_data);
	$.ajax({
		type: "POST",
		url: "/ajax/askForMonitorie.php",
		data: s_data,
		success: function (msg) {
			var response = JSON.parse(msg);
			console.log(response.result);
			Push.create(response.result, {
				body: response.result,
				icon: 'resources/emojis/happy-2.png',
				timeout: 5000
			});
			$(modal).fadeOut();
			setTimeout(function(elem){
				$(modal).remove();
			}, 1000, this);
		}
	});
}

function delete_account() {
	$.ajax({
		type: "POST",
		url: "/ajax/delete.php",
		success: function (msg) {
			var response = JSON.parse(msg);
			console.log(response.result);
			window.location('/logout.php');
		}
	});
}
