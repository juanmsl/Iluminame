<?php
require_once "../global.php";
if (!LOGGED_IN)
{
	header("Location: " . WWW . "/");
	exit;
}

if (!isset($_POST["last_id"])){
	exit;
}

$last_ntf = intval(filter($_POST["last_id"]));

$notifications_query = dbquery("SELECT
	notificaciones.id, notificaciones.descripcion, notificaciones.fecha, notificaciones.vista, notificaciones.link_event,
	estudiantes.foto, estudiantes.usuario
	FROM notificaciones JOIN estudiantes
	ON (notificaciones.estudiante_id_envia = estudiantes.id)
	WHERE notificaciones.estudiante_id_recibe = " . USER_ID . " AND notificaciones.id > " . $last_ntf . "
	ORDER BY vista ASC, fecha DESC;");
$notifications = array();

while ($msg = $notifications_query->fetch_assoc()) {
	@$ntf->notification_link = base64_decode(clean($msg["link_event"]));
	$ntf->notification_date = strftime("%d de %B del %Y, %I:%M %p", $msg["fecha"]);
	$ntf->user_picture = clean($msg["foto"]);
	$ntf->viewed = ($msg["vista"] == '1');
	$ntf->notification_description = base64_decode(clean($msg["descripcion"]));
	$notifications[] = $ntf;

	$last_ntf = clean($msg["id"]) > $last_ntf ? clean($msg["id"]) : $last_ntf;
}

@$Obj->result = "ok";
$Obj->last_id = $last_ntf;
$Obj->ntfs = $notifications;
$myJSON = json_encode($Obj);

echo $myJSON;
?>
