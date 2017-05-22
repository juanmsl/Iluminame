<?php
require_once "../global.php";
if (!LOGGED_IN)
{
	header("Location: " . WWW . "/");
	exit;
}

if (!isset($_POST["id"]) || !isset($_POST["value"]) || !isset($_POST["description"])){
	exit;
}

$id = intval(filter($_POST["id"]));
$value = filter($_POST["value"]);
$description = filter($_POST["description"]);

dbquery("INSERT INTO comentarios (calificacion, descripcion, fecha, monitoria_id, estudiante_id) VALUES (" . $value . ", '" . $description . "', " . time() . ", " . $id . ", " . USER_ID . ");");
$monitoria = dbquery("SELECT estudiantes.id as monitor_id, materias.nombre as materia
	FROM monitorias JOIN estudiantes_materias ON (estudiantes_materias.materia_id = monitorias.materia_id AND estudiantes_materias.estudiante_id = monitorias.estudiante_id)
	JOIN estudiantes ON (estudiantes_materias.estudiante_id = estudiantes.id) JOIN materias ON (materias.id = monitorias.materia_id)
	WHERE monitorias.id = " . $id . ";")->fetch_assoc();

$msg = base64_encode("<b>" . clean($myrow["nombre"]) . "</b> ha calificado tu monitoria de <b>" . clean($monitoria["materia"]) . "</b>");
$link = base64_encode("tutories.php?id=" . $id . "");

dbquery("INSERT
	INTO notificaciones (descripcion, fecha, vista, estudiante_id_recibe, estudiante_id_envia, link_event)
	VALUES ('" . $msg . "', " . time() . ", '0', " . clean($monitoria["monitor_id"]) . " , " . USER_ID . ", '" . $link . "');");

@$myObj->result = "Comentado";
$myJSON = json_encode($myObj);

echo $myJSON;
?>
