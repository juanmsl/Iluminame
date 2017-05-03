Push.Permission.GRANTED;

// Navbar notifications

let tutorie_notification_template = "" +
"<a class='box notification' href='[monitorie_link]'>" +
"	<section class='box-h-section'>" +
"		<img src='[user_picture]' class='picture'>" +
"		<div class='box-v-section box-justify-center gutter-0'>" +
"			<p class='sub-title'>[subject_name]</p>" +
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
"<a class='box notification data-fixed' href='[notification_link]' data-fixed='[notification_date]'>" +
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
"		<p name='Lugar: ' class='box-data'>[place]</p>" +
"		<p name='Fecha: ' class='box-data'>[date]</p>" +
"		<p name='Duración: ' class='box-data'>[time]</p>" +
"		<p name='Precio por estudiante: ' class='box-data'>[price]</p>" +
"	</section>" +
"	<section class='box-v-section box-footer box-align-center'>" +
"		<p class='box-data' id='state_monitorie_[id]'>[type]</p>" +
"		<button class='[button_class]-button' [button_function] [button_enable]>[button_text]</button>" +
"	</section>" +
"</section>";

let addHomeMonitorie = function(n) {
	var state = (n.type) ? n.inscriptions + ' / ' + n.maximun + ' inscritos' : 'Privada';
	var button_class = (n.is_signed == 1) ? 'leave' : (n.inscriptions == n.maximun) ? 'full' : 'join';
	var button_function = (n.is_signed == 1) ? 'leave' : (n.inscriptions == n.maximun) ? '' : 'join';
	var button_text = (n.is_signed == 1) ? 'Abandonar monitoria' : (n.inscriptions == n.maximun) ? 'Monitoria llena' : 'Deseo unirme';
	var button_enable = (n.is_signed == 1 || n.inscriptions < n.maximun);

	var element = monitorie_template
		.replace('[id]', n.id)
		.replace('[user_link]', n.user_link)
		.replace('[user_picture]', n.user_picture)
		.replace('[subject_name]', n.subject_name)
		.replace('[user_name]', n.user_name)
		.replace('[place]', n.place)
		.replace('[date]', n.date)
		.replace('[time]', n.time)
		.replace('[price]', '$' + n.price)
		.replace('[type]', state)
		.replace('[button_class]', button_class)
		.replace('[button_function]', button_function == '' ? '' : 'onclick=\'' + button_function + '_monitorie(' + n.id + ', this)\'')
		.replace('[button_text]', button_text)
		.replace('[button_enable]', button_enable ? '' : 'disabled');
	$('#home-monitories').append(element);
}

function join_monitorie(id, element) {
	element.disabled = true;
	element.setAttribute('class','disabled-button');
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
				timeout: 10000
			});
			var state = document.getElementById('state_monitorie_' + id);
			state.innerHTML = response.inscritos + ' / ' + response.maximun + ' inscritos';
			element.setAttribute('onclick','leave_monitorie(' + id + ', this)');
			element.setAttribute('class','leave-button');
			element.innerHTML = 'Abandonar monitoria';
			element.disabled = false;
		}
	});
}

function leave_monitorie(id, element) {
	element.disabled = true;
	element.setAttribute('class','disabled-button');
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
				timeout: 10000
			});
			var state = document.getElementById('state_monitorie_' + id);
			state.innerHTML = response.inscritos + ' / ' + response.maximun + ' inscritos';
			element.setAttribute('onclick','join_monitorie(' + id + ', this)');
			element.setAttribute('class','join-button');
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
"		<a href='[link]' class='sub-title'>[name]</a>" +
"		<div class='user-sub-group'>" +
"			<a href='[link]' class='user-id'>[user]</a>" +
"			<p class='follow-you'>[isFollowMe]</p>" +
"		</div>" +
"	</div>" +
"	<button class='user-follow default-button ilm-[button_class] [hidden]' onclick='[button_action]([user_id], this, false)' title='[button_text]'></button>" +
"</section>";

let createUser = function(n) {
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
	return user;
}

let addUserUI = function(user) {
	var user = createUser(user);
	$('#users-group').append(user);
}

let addUserSearch = function(user) {
	var user = createUser(user);
	$('#users-search').append(user);
}
