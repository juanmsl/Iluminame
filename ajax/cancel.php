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


$id_monitor = dbqueryEvaluate("SELECT estudiante_id FROM monitorias WHERE id = " . $id . ";");
$monitor = dbqueryEvaluate("SELECT nombre FROM estudiantes WHERE id = " . $id_monitor . ";");
$materia = dbqueryEvaluate("SELECT nombre FROM materias JOIN monitorias ON (materias.id = monitorias.materia_id) WHERE monitorias.id = " . $id . ";");
$inscritos = dbquery("SELECT estudiante_id FROM estudiantes_monitorias_inscripciones WHERE monitoria_id = " . $id . ";");

$msg = base64_encode("<b>" . clean($myrow["nombre"]) . "</b> ha cancelado la monitoria de <b>" . clean($materia) . "</b>");
$link = base64_encode("profile.php?user=" . clean($myrow["usuario"]) . "");

while($ins = $inscritos->fetch_assoc()) {
	if($ins['estudiante_id'] != USER_ID) {
		dbquery("INSERT
			INTO notificaciones (descripcion, fecha, vista, estudiante_id_recibe, estudiante_id_envia, link_event)
			VALUES ('" . $msg . "', " . time() . ", '0', " . clean($ins['estudiante_id']) . " , " . USER_ID . ", '" . $link . "')");
	}
}
if($id_monitor != USER_ID) {
	dbquery("INSERT
		INTO notificaciones (descripcion, fecha, vista, estudiante_id_recibe, estudiante_id_envia, link_event)
		VALUES ('" . $msg . "', " . time() . ", '0', " . $id_monitor . " , " . USER_ID . ", '" . $link . "')");
}

dbquery("DELETE FROM monitorias WHERE id = '" . $id . "';");

@$myObj->result = "Has cancelado la monitoria";
$myObj->monitor = clean($monitor);
$myObj->materia = clean($materia);
$myJSON = json_encode($myObj);

echo $myJSON;
?>
