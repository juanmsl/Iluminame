<?php
require_once "../global.php";
if (!LOGGED_IN)
{
	header("Location: " . WWW . "/");
	exit;
}
if (isset($_GET["id"]))
{
	$_POST["id"] = $_GET["id"];
}
if (!isset($_POST["id"])){
	exit;
}
$id = intval(filter($_POST["id"]));

dbquery("REPLACE INTO estudiantes_monitorias_inscripciones (estudiante_id, monitoria_id) VALUES ('" . USER_ID . "', '" . $id . "');");

$monitoria = dbquery("SELECT estudiantes.id as id_monitor, estudiantes.nombre as monitor, estudiantes.correo as correo_monitor, estudiantes_materias.max_estud as maximun, materias.nombre as materia,
	(SELECT count(*) FROM estudiantes_monitorias_inscripciones WHERE estudiantes_monitorias_inscripciones.monitoria_id = monitorias.id) as inscritos
	FROM monitorias JOIN estudiantes_materias ON (estudiantes_materias.materia_id = monitorias.materia_id AND estudiantes_materias.estudiante_id = monitorias.estudiante_id)
	JOIN estudiantes ON (estudiantes_materias.estudiante_id = estudiantes.id) JOIN materias ON (materias.id = monitorias.materia_id)
	WHERE monitorias.id = " . $id . ";");

$monitoria = $monitoria->fetch_assoc();
$msg = base64_encode("<b>" . clean($myrow["nombre"]) . "</b> se ha unido a tu monitoria de <b>" . clean($monitoria["materia"]) . "</b>");
$link = base64_encode("tutories.php?id=" . $id . "");

dbquery("INSERT
	INTO notificaciones (descripcion, fecha, vista, estudiante_id_recibe, estudiante_id_envia, link_event)
	VALUES ('" . $msg . "', " . time() . ", '0', " . $monitoria["id_monitor"] . " , " . USER_ID . ", '" . $link . "')");

sendJoinEmail(clean($monitoria["monitor"]), $monitoria["correo_monitor"], clean($myrow["nombre"]), clean($monitoria["materia"]));

@$myObj->result = "Te has unido a la monitoria";
$myObj->monitor = clean($monitoria["monitor"]);
$myObj->inscritos = clean($monitoria["inscritos"]);
$myObj->maximun = clean($monitoria["maximun"]);
$myObj->materia = clean($monitoria["materia"]);
$myJSON = json_encode($myObj);

echo $myJSON;
?>
