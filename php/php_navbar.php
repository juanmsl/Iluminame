<?php if (!defined("UBER")) exit;
$myPic = clean($myrow["foto"]);
$myName = clean($myrow["nombre"]);
$myUsername = clean($myrow["usuario"]);
$myDescription = clean($myrow["aboutme"]);
$myFollowers = clean($myrow["seguidores"]);
$myFollowing = clean($myrow["seguidos"]);

$navbar_query = dbquery("SELECT
	(SELECT COUNT(*) FROM notificaciones WHERE notificaciones.estudiante_id_recibe = estudiantes.id) as count_notifications,
	(SELECT COUNT(*) FROM mensajes WHERE mensajes.estudiante_id_envia = estudiantes.id) as count_msgs,
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
	$chatNotifications = "";
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
				$chatNotifications .= "<script>
					addChatNotification({
						notification_link: 'messages.php?user=" . $user_msg . "',
						notification_date: '" . strftime("%d de %B del %Y, %I:%M %p", $msg["fecha"]) . "',
						user_picture: '" . $user_foto . "',
						user_name: '" . $user_user . "',
						notification_description: '" . clean(base64_decode($msg["mensaje"])) . "',
					});
				</script>";
			}
		}
	}

?>
