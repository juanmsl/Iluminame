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
$msgs_query = dbquery("SELECT DISTINCT mensajes.estudiante_id_envia as est_envia, mensajes.estudiante_id_recibe as est_recibe, nombre_envia.nombre as envia, nombre_envia.usuario as usuario_envia, nombre_envia.foto as foto_envia, nombre_recibe.nombre as recibe, nombre_recibe.usuario as usuario_recibe, nombre_recibe.foto as foto_recibe,
	(SELECT mensaje FROM mensajes WHERE estudiante_id_envia = est_envia AND estudiante_id_recibe = est_recibe ORDER BY fecha DESC LIMIT 1) as mensaje,
	(SELECT fecha FROM mensajes WHERE estudiante_id_envia = est_envia AND estudiante_id_recibe = est_recibe ORDER BY fecha DESC LIMIT 1) as fecha
	FROM mensajes JOIN estudiantes nombre_envia ON (estudiante_id_envia= nombre_envia.id) JOIN estudiantes nombre_recibe ON (estudiante_id_recibe = nombre_recibe.id)
	WHERE mensajes.estudiante_id_envia = " . USER_ID . " OR mensajes.estudiante_id_recibe = " . USER_ID . " ORDER BY fecha DESC;");
$msgs_available = $msgs_query->num_rows;
$notifications = "";
$showed = array();
if ($msgs_available > 0)
{
	while ($msg = $msgs_query->fetch_assoc())
	{
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
		}
	}
}
$msgs_query = dbquery("SELECT notificaciones.descripcion, notificaciones.fecha, notificaciones.vista,
	estudiantes.foto, estudiantes.usuario
	FROM notificaciones JOIN estudiantes ON (notificaciones.estudiante_id_envia = estudiantes.id)
	WHERE notificaciones.estudiante_id_recibe = " . USER_ID . "
	ORDER BY vista ASC, fecha DESC;");
$msgs_available = $msgs_query->num_rows;
$count_ntf = 0;
if ($msgs_available > 0)
{
	while ($msg = $msgs_query->fetch_assoc())
	{
		if($count_ntf < 15 || ($count_ntf >= 15 && $msg["vista"] == '0')) {
			$notifications .= "<script>
			addNotification({
				notification_link: 'profile.php?user=" . clean($msg["usuario"]) . "',
				notification_date: '" . strftime("%d de %B del %Y, %I:%M %p", $msg["fecha"]) . "',
				user_picture: '" . clean($msg["foto"]) . "',
				viewed: " . ($msg["vista"] == '1' ? 'true' : 'false') . ",
				notification_description: '" . $msg["descripcion"] . "'
			});
			</script>";
			$count_ntf++;
		}
	}
}
$msgs_query = dbquery("SELECT materias.nombre as materia, foto, usuario, monitorias.id as monitoria_id, monitorias.es_publica, monitorias.lugar, monitorias.fecha_inicio, monitorias.fecha_fin
	FROM estudiantes JOIN monitorias ON (estudiantes.id = monitorias.estudiante_id) JOIN materias ON (materias.id = monitorias.materia_id)
	WHERE estudiantes.id = " . USER_ID . ";");
$msgs_available = $msgs_query->num_rows;
if ($msgs_available > 0)
{
	while ($msg = $msgs_query->fetch_assoc())
	{
		if($msg["fecha_inicio"] > time()) {
			$notifications .= "<script>
			addMyTutorie({
				monitorie_link: 'tutorie.php?id=" . clean($msg["monitoria_id"]) . "',
				user_picture: '" . clean($msg["foto"]) . "',
				subject_name: '" . clean($msg["materia"]) . "',
				monitorie_type: '" . ($msg["es_publica"] == '1' ? 'Publica' : 'Privada') . "',
				monitorie_place: '" . clean($msg["lugar"]) . "',
				monitorie_date: '" . strftime("%d de %B del %Y", $msg["fecha_inicio"]) . "',
				monitorie_time: '" . strftime("%I:%M %p", $msg["fecha_inicio"]) . " - " . strftime("%I:%M %p", $msg["fecha_fin"]) . "'
			});
			</script>";
		}
	}
}
$msgs_query = dbquery("SELECT materias.nombre as materia, estudiantes.nombre, foto, usuario, monitorias.id as monitoria_id, monitorias.es_publica, monitorias.lugar, monitorias.fecha_inicio, monitorias.fecha_fin
FROM estudiantes_monitorias_inscripciones JOIN monitorias ON (estudiantes_monitorias_inscripciones.monitoria_id = monitorias.id) JOIN estudiantes ON (estudiantes.id = monitorias.estudiante_id) JOIN materias on (materias.id = monitorias.materia_id)
WHERE estudiantes_monitorias_inscripciones.estudiante_id = " . USER_ID . ";");
$msgs_available = $msgs_query->num_rows;
if ($msgs_available > 0)
{
	while ($msg = $msgs_query->fetch_assoc())
	{
		if($msg["fecha_inicio"] > time()) {
			$notifications .= "<script>
				addTutorie({
					monitorie_link: 'tutorie.php?id=" . clean($msg["monitoria_id"]) . "',
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
	}
}
?>
