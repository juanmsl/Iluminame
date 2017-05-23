<?php
require_once "global.php";

if (!LOGGED_IN)
{
	header("Location: " . WWW . "/");
	exit;
}

$personal_chat = true;

if (isset($_GET["user"])) {
	$user_name = filter($_GET["user"]);
	if ($user_name != $_GET["user"]) {
		header("Location: " . WWW . "/logout.php");
		exit;
	}

	$user_query = dbquery("SELECT id, nombre, usuario, foto FROM estudiantes WHERE usuario = '" . $user_name . "'");
	if ($user_query->num_rows == 1) {
		$search_result = $user_query->fetch_assoc();

		include ('php/messages_content.php');
		echo "<script>$('body').addClass('chatBody');</script>";

		$last_id = -1;
		echo "<script src='js/chat.js'></script>";

		$message_query = dbquery("SELECT id, mensaje, fecha, estudiante_id_recibe, estudiante_id_envia
			FROM mensajes
			WHERE (estudiante_id_recibe = '" . $myrow["id"] . "' AND estudiante_id_envia = '" . $search_result["id"] . "')
			OR (estudiante_id_recibe = '" . $search_result["id"] . "' AND estudiante_id_envia = '" . $myrow["id"] . "')
			ORDER BY fecha ASC;");

		while ($message = $message_query->fetch_assoc()) {
			if($myrow["id"] == $message["estudiante_id_recibe"]) {
				echo "<script> addMessageFromPartner('" . timeAgo($message["fecha"]) . "', '" . base64_decode(clean($message["mensaje"])) . "'); </script>";
			} else {
				echo "<script> addMessageFromMe('" . timeAgo($message["fecha"]) . "', '" . base64_decode(clean($message["mensaje"])) . "'); </script>";
			}
			$last_id = $message["id"];
		}
		echo "<script> scrollDown(); </script>";

		echo "<script> var last_message_id = " . $last_id . "; </script>\n";
		echo "<script> setInterval(\"checkMessages('" . $search_result['id'] . "')\", 1000); </script>\n";
	}
} else {
	$personal_chat = false;

	$chats_query_list = dbquery("SELECT DISTINCT mensajes.estudiante_id_envia as est_envia, mensajes.estudiante_id_recibe as est_recibe, nombre_envia.nombre as envia, nombre_envia.usuario as usuario_envia, nombre_envia.foto as foto_envia, nombre_recibe.nombre as recibe, nombre_recibe.usuario as usuario_recibe, nombre_recibe.foto as foto_recibe,
		(SELECT mensaje FROM mensajes WHERE estudiante_id_envia = est_envia AND estudiante_id_recibe = est_recibe ORDER BY fecha DESC LIMIT 1) as mensaje,
		(SELECT fecha FROM mensajes WHERE estudiante_id_envia = est_envia AND estudiante_id_recibe = est_recibe ORDER BY fecha DESC LIMIT 1) as fecha
		FROM mensajes JOIN estudiantes nombre_envia ON (estudiante_id_envia= nombre_envia.id) JOIN estudiantes nombre_recibe ON (estudiante_id_recibe = nombre_recibe.id)
		WHERE mensajes.estudiante_id_envia = " . USER_ID . " OR mensajes.estudiante_id_recibe = " . USER_ID . " ORDER BY fecha DESC;");
	$chat_results = $chats_query_list->num_rows;

	include ('php/messages_content.php');

	$list_showed = array();
	echo "<script>$('#list-chats').removeClass('box-grow');</script>";
	while ($msg = $chats_query_list->fetch_assoc()) {
		$user_id = ($msg["est_envia"] != USER_ID) ? clean($msg["est_envia"]) : clean($msg["est_recibe"]);
		$user_msg = ($msg["est_envia"] != USER_ID) ? clean($msg["usuario_envia"]) : clean($msg["usuario_recibe"]);
		$user_foto = ($msg["est_envia"] != USER_ID) ? clean($msg["foto_envia"]) : clean($msg["foto_recibe"]);
		$user_user = ($msg["est_envia"] != USER_ID) ? clean($msg["envia"]) : clean($msg["recibe"]);
		if (!in_array($user_id, $list_showed)) {
			$list_showed[] = $user_id;
			echo "<script>
				addChatNotificationTo({
					notification_link: 'messages.php?user=" . $user_msg . "',
					notification_date: '" . strftime("%d de %B del %Y, %I:%M %p", $msg["fecha"]) . "',
					user_picture: '" . $user_foto . "',
					user_name: '" . $user_user . "',
					notification_description: '" . clean(base64_decode($msg["mensaje"])) . "'
				}, '#list-chats');
			</script>";
		}
	}
}
?>
