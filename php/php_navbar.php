<?php if (!defined("UBER")) exit;
$myPic = clean($myrow["foto"]);
$myName = clean($myrow["nombre"]);
$myUsername = clean($myrow["usuario"]);
$myDescription = clean($myrow["aboutme"]);
$myFollowers = clean($myrow["seguidores"]);
$myFollowing = clean($myrow["seguidos"]);

if (isset($_GET["search"])) {
	$search = filter($_GET["search"]);
}
$navbar_query = dbquery("SELECT
	(SELECT COUNT(*) FROM notificaciones WHERE notificaciones.estudiante_id_recibe = estudiantes.id AND notificaciones.vista = '0') as count_notifications,
	(SELECT COUNT(*) FROM estudiantes_monitorias_inscripciones WHERE estudiantes_monitorias_inscripciones.estudiante_id = estudiantes.id) as count_my_monitories,
	(SELECT COUNT(*) FROM estudiantes_seguidores WHERE estudiantes_seguidores.estudiante_id_seguidor = estudiantes.id) as count_users,
	(SELECT count(*) FROM estudiantes_materias WHERE estudiantes_materias.estudiante_id = estudiantes.id) as count_subjects,
	(SELECT COUNT(*) FROM monitorias WHERE monitorias.estudiante_id = estudiantes.id) as count_monitories
	FROM estudiantes
	WHERE estudiantes.id = " . USER_ID . "")->fetch_assoc();

$cm_query = dbquery("SELECT
	monitorias.lugar,
	monitorias.fecha_inicio,
	monitorias.fecha_fin,
	monitorias.es_publica,
	monitorias.id,
	materias.nombre,
	estudiantes.nombre as monitor,
	estudiantes.foto,
	estudiantes_monitorias_inscripciones.estudiante_id,
	estudiantes_monitorias_inscripciones.monitoria_id
	FROM estudiantes_monitorias_inscripciones JOIN monitorias
		ON (monitorias.id = estudiantes_monitorias_inscripciones.monitoria_id) JOIN materias
		ON (monitorias.materia_id = materias.id) JOIN estudiantes
		ON (monitorias.estudiante_id = estudiantes.id)
	WHERE estudiantes_monitorias_inscripciones.estudiante_id = " . USER_ID . "
	AND (SELECT count(*) FROM comentarios WHERE monitoria_id = monitorias.id AND comentarios.estudiante_id = estudiantes_monitorias_inscripciones.estudiante_id) = 0
	AND monitorias.fecha_fin < " . time() . ";");
$comentaries = $cm_query->num_rows > 0;
$comentaries_content = "";
$cm_count = 0;

while($cm = $cm_query->fetch_assoc()) {
	$comentaries_content .= "
		<section class='comentary' id='cm-" . $cm_count . "'>
			<section class='comentary-content'>
				<section style='display: flex;'>
					<img src='" . clean($cm['foto']) . "' class='big-picture'>
					<section style='margin-left: 10px;'>
						<h2 class='main-title'>" . clean($cm['nombre']) . "</h2>
						<p>" . clean($cm['monitor']) . "</p>
					</section>
				</section>
			</section>
			<section class='comentary-content'>
				<p class='ilm-date'>" . strftime("%d de %B del %Y", $cm["fecha_inicio"]) . "</p>
				<p class='ilm-time'>" . strftime("%I:%M %p", $cm["fecha_inicio"]) . " - " . strftime("%I:%M %p", $cm["fecha_fin"]) . "</p>
				<br>
				<p class='ilm-user" . (($cm['es_publica'] == '1') ? 's' : '') . "'>Monitoria " . (($cm['es_publica'] == '1') ? 'publica' : 'privada') . "</p>
				<p class='ilm-place'>" . clean($cm['lugar']) . "</p>
			</section>
			<form class='comentary-content' action=\"javascript:comment(" . clean($cm["id"]) . ", '#cm-" . $cm_count . "')\">
				<div class='rating'>
					<div data-value='0 / 5' class='rating-stars active'>
						<input type='radio' name='rating-" . $cm_count . "' id='rt-five-full" . $cm_count . "' value='5' required>
						<label for='rt-five-full" . $cm_count . "' title='5.0'></label>
						<input type='radio' name='rating-" . $cm_count . "' id='rt-four-half" . $cm_count . "' value='4.5'>
						<label for='rt-four-half" . $cm_count . "' title='4.5'></label>
						<input type='radio' name='rating-" . $cm_count . "' id='rt-four-full" . $cm_count . "' value='4'>
						<label for='rt-four-full" . $cm_count . "' title='4.0'></label>
						<input type='radio' name='rating-" . $cm_count . "' id='rt-tree-half" . $cm_count . "' value='3.5'>
						<label for='rt-tree-half" . $cm_count . "' title='3.5'></label>
						<input type='radio' name='rating-" . $cm_count . "' id='rt-tree-full" . $cm_count . "' value='3' >
						<label for='rt-tree-full" . $cm_count . "' title='3.0'></label>
						<input type='radio' name='rating-" . $cm_count . "' id='rt-two-half" . $cm_count . "' value='2.5'>
						<label for='rt-two-half" . $cm_count . "' title='2.5'></label>
						<input type='radio' name='rating-" . $cm_count . "' id='rt-two-full" . $cm_count . "' value='2'>
						<label for='rt-two-full" . $cm_count . "' title='2.0'></label>
						<input type='radio' name='rating-" . $cm_count . "' id='rt-one-half" . $cm_count . "' value='1.5'>
						<label for='rt-one-half" . $cm_count . "' title='1.5'></label>
						<input type='radio' name='rating-" . $cm_count . "' id='rt-one-full" . $cm_count . "' value='1'>
						<label for='rt-one-full" . $cm_count . "' title='1.0'></label>
						<input type='radio' name='rating-" . $cm_count . "' id='rt-half" . $cm_count . "' value='0.5'>
						<label for='rt-half" . $cm_count . "' title='0.5'></label>
					</div>
				</div>
				<textarea placeholder='Cuentanos como te parecio esta monitoria, ¿hubo algun problema?' class='comentary-comentary' rows='3'></textarea>
				<section style='text-align: center;'>
					<input type='submit' class='join-button' value='Enviar comentario'>
				</section>
			</form>
		</section>";
	echo "<script>console.log('Tienes que comentar " . clean($cm['nombre']) . " de " . clean($cm['monitor']) . "');</script>";
	$cm_count++;
}

$notifications = "";

$notifications_query = dbquery("SELECT
	notificaciones.id, notificaciones.descripcion, notificaciones.fecha, notificaciones.vista, notificaciones.link_event,
	estudiantes.foto, estudiantes.usuario
	FROM notificaciones JOIN estudiantes
	ON (notificaciones.estudiante_id_envia = estudiantes.id)
	WHERE notificaciones.estudiante_id_recibe = " . USER_ID . "
	ORDER BY vista ASC, fecha DESC;");

$chats_query = dbquery("SELECT DISTINCT mensajes.estudiante_id_envia as est_envia, mensajes.estudiante_id_recibe as est_recibe, nombre_envia.nombre as envia, nombre_envia.usuario as usuario_envia, nombre_envia.foto as foto_envia, nombre_recibe.nombre as recibe, nombre_recibe.usuario as usuario_recibe, nombre_recibe.foto as foto_recibe,
	(SELECT mensaje FROM mensajes WHERE estudiante_id_envia = est_envia AND estudiante_id_recibe = est_recibe ORDER BY fecha DESC LIMIT 1) as mensaje,
	(SELECT fecha FROM mensajes WHERE estudiante_id_envia = est_envia AND estudiante_id_recibe = est_recibe ORDER BY fecha DESC LIMIT 1) as fecha
	FROM mensajes JOIN estudiantes nombre_envia ON (estudiante_id_envia= nombre_envia.id) JOIN estudiantes nombre_recibe ON (estudiante_id_recibe = nombre_recibe.id)
	WHERE mensajes.estudiante_id_envia = " . USER_ID . " OR mensajes.estudiante_id_recibe = " . USER_ID . " ORDER BY fecha DESC;");

$tutories_query = dbquery("SELECT
	materias.nombre as materia,
	estudiantes.foto, estudiantes.usuario,
	monitorias.id as monitoria_id, monitorias.es_publica, monitorias.lugar, monitorias.fecha_inicio, monitorias.fecha_fin
	FROM estudiantes JOIN monitorias
	ON (estudiantes.id = monitorias.estudiante_id) JOIN materias
	ON (materias.id = monitorias.materia_id)
	WHERE estudiantes.id = " . USER_ID . " AND fecha_inicio > " . time() . "
	ORDER BY fecha_inicio;");
	$count_tutories = $tutories_query->num_rows;

$my_tutories_query = dbquery("SELECT
	materias.nombre as materia,
	estudiantes.nombre, estudiantes.foto, estudiantes.usuario,
	monitorias.id as monitoria_id, monitorias.es_publica, monitorias.lugar, monitorias.fecha_inicio, monitorias.fecha_fin
	FROM estudiantes_monitorias_inscripciones JOIN monitorias
	ON (estudiantes_monitorias_inscripciones.monitoria_id = monitorias.id) JOIN estudiantes
	ON (estudiantes.id = monitorias.estudiante_id) JOIN materias on (materias.id = monitorias.materia_id)
	WHERE estudiantes_monitorias_inscripciones.estudiante_id = " . USER_ID . " AND fecha_inicio > " . time() . "
	ORDER BY fecha_inicio;");
	$count_my_tutories = $my_tutories_query->num_rows;

$count_ntf = 0;
$count_notificaciones = 0;
$last_ntf = -1;
while ($msg = $notifications_query->fetch_assoc()) {
	if($count_ntf < 15 || ($count_ntf >= 15 && $msg["vista"] == '0')) {
		$notifications .= "<script>
		addNotification({
			notification_link: '" . base64_decode(clean($msg["link_event"])) . "',
			notification_date: '" . strftime("%d de %B del %Y, %I:%M %p", $msg["fecha"]) . "',
			user_picture: '" . clean($msg["foto"]) . "',
			viewed: " . ($msg["vista"] == '1' ? 'true' : 'false') . ",
			notification_description: '" . base64_decode(clean($msg["descripcion"])) . "'
		});
		</script>";
		if($msg["vista"] == '0') $count_notificaciones++;
		$count_ntf++;
		$last_ntf = clean($msg["id"]) > $last_ntf ? clean($msg["id"]) : $last_ntf;
	}
}
 echo "<script>var last_ntf = " . $last_ntf . ";</script>";

$showed = array();
$count_chats = 0;
while ($msg = $chats_query->fetch_assoc()) {
	$user_id = ($msg["est_envia"] != USER_ID) ? clean($msg["est_envia"]) : clean($msg["est_recibe"]);
	$user_msg = ($msg["est_envia"] != USER_ID) ? clean($msg["usuario_envia"]) : clean($msg["usuario_recibe"]);
	$user_foto = ($msg["est_envia"] != USER_ID) ? clean($msg["foto_envia"]) : clean($msg["foto_recibe"]);
	$user_user = ($msg["est_envia"] != USER_ID) ? clean($msg["envia"]) : clean($msg["recibe"]);
	if (!in_array($user_id, $showed)) {
		$showed[] = $user_id;
		$notifications .= "<script>
			addChatNotification({
				notification_link: 'messages.php?user=" . $user_msg . "',
				notification_date: '" . strftime("%d de %B del %Y, %I:%M %p", $msg["fecha"]) . "',
				user_picture: '" . $user_foto . "',
				user_name: '" . $user_user . "',
				notification_description: '" . clean(base64_decode($msg["mensaje"])) . "'
			});
		</script>";
		$count_chats++;
	}
}

while ($msg = $tutories_query->fetch_assoc()) {
	$notifications .= "<script>
	addTutorie({
		monitorie_link: 'tutories.php?id=" . clean($msg["monitoria_id"]) . "',
		user_picture: '" . clean($msg["foto"]) . "',
		subject_name: '" . clean($msg["materia"]) . "',
		monitorie_type: '" . ($msg["es_publica"] == '1' ? 'Publica' : 'Privada') . "',
		monitorie_place: '" . clean($msg["lugar"]) . "',
		monitorie_date: '" . strftime("%d de %B del %Y", $msg["fecha_inicio"]) . "',
		monitorie_time: '" . strftime("%I:%M %p", $msg["fecha_inicio"]) . " - " . strftime("%I:%M %p", $msg["fecha_fin"]) . "'
	});
	</script>";
}

while ($msg = $my_tutories_query->fetch_assoc()) {
	$notifications .= "<script>
		addMyTutorie({
			monitorie_link: 'tutories.php?id=" . clean($msg["monitoria_id"]) . "',
			user_picture: '" . clean($msg["foto"]) . "',
			subject_name: '" . clean($msg["materia"]) . "',
			user_name: '" . clean($msg["nombre"]) . "',
			monitorie_type: '" . ($msg["es_publica"] == '1' ? 'Publica' : 'Privada') . "',
			monitorie_place: '" . clean($msg["lugar"]) . "',
			monitorie_date: '" . strftime("%d de %B del %Y", $msg["fecha_inicio"]) . "',
			monitorie_time: '" . strftime("%I:%M %p", $msg["fecha_inicio"]) . " - " . strftime("%I:%M %p", $msg["fecha_fin"]) . "'
		});
	</script>";
}
?>
