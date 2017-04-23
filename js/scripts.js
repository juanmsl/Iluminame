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
"<section class='box card'>" +
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
"		<p class='box-data'>[monitorie_type]</p>" +
"		<button class='[button_class]-button'>[button_text]</button>" +
"	</section>" +
"</section>";
