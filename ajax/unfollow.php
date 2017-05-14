<?php
require_once "../global.php";
if (!LOGGED_IN)
{
	header("Location: " . WWW . "/");
	exit;
}

if (!isset($_POST["id"])){
	exit;
}

$id = intval(filter($_POST["id"]));

dbquery("DELETE FROM estudiantes_seguidores WHERE estudiante_id_seguidor = '" . USER_ID . "' AND estudiante_id_seguido = '" . $id . "';");
$count = dbqueryEvaluate("SELECT count(*) FROM estudiantes_seguidores WHERE estudiante_id_seguido = '" . $id . "';");
$msg = base64_encode("<b>" . filter($myrow["nombre"]) . "</b> ha dejado de seguirte");
$link = base64_encode("profile.php?user=" . filter($myrow["usuario"]) . "");

dbquery("INSERT
	INTO notificaciones (descripcion, fecha, vista, estudiante_id_recibe, estudiante_id_envia, link_event)
	VALUES ('" . $msg . "', " . time() . ", '0', " . $id . " , " . USER_ID . ", '" . $link . "')");

@$myObj->result = "ok";
$myObj->count = $count;
$myJSON = json_encode($myObj);

echo $myJSON;
?>
