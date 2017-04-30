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

dbquery("DELETE FROM estudiantes_monitorias_inscripciones WHERE estudiante_id = '" . USER_ID . "' AND monitoria_id = '" . $id . "';");

$monitoria = dbquery("SELECT estudiantes.id as id_monitor, estudiantes.nombre as monitor, estudiantes_materias.max_estud as maximun, materias.nombre as materia,
	(SELECT count(*) FROM estudiantes_monitorias_inscripciones WHERE estudiantes_monitorias_inscripciones.monitoria_id = monitorias.id) as inscritos
	FROM monitorias JOIN estudiantes_materias ON (estudiantes_materias.materia_id = monitorias.materia_id AND estudiantes_materias.estudiante_id = monitorias.estudiante_id)
	JOIN estudiantes ON (estudiantes_materias.estudiante_id = estudiantes.id) JOIN materias ON (materias.id = monitorias.materia_id)
	WHERE monitorias.id = " . $id . ";");

$monitoria = $monitoria->fetch_assoc();

dbquery("INSERT INTO notificaciones (descripcion, fecha, vista, estudiante_id_recibe, estudiante_id_envia) VALUES ('<b>" . filter($myrow["nombre"]) . "</b> ha abandonado tu monitoria de <b>" . filter($monitoria["materia"]) . "</b>', " . time() . ", '0', " . $monitoria["id_monitor"] . " , " . USER_ID . ")");

@$myObj->result = "Has abandonado la monitoria";
$myObj->monitor = clean($monitoria["monitor"]);
$myObj->inscritos = clean($monitoria["inscritos"]);
$myObj->maximun = clean($monitoria["maximun"]);
$myObj->materia = clean($monitoria["materia"]);
$myJSON = json_encode($myObj);

echo $myJSON;
?>
