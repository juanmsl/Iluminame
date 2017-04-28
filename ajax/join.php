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

dbquery("REPLACE INTO estudiantes_monitorias_inscripciones (estudiante_id, monitoria_id) VALUES ('" . USER_ID . "', '" . $id . "');");

$monitor = dbqueryEvaluate("SELECT estudiantes.nombre FROM estudiantes, monitorias WHERE estudiantes.id = monitorias.estudiante_id AND monitorias.id = " . $id . ";");
$inscritos = dbqueryEvaluate("SELECT count(*) FROM estudiantes_monitorias_inscripciones WHERE estudiantes_monitorias_inscripciones.monitoria_id = " . $id . ";");
$maximun = dbqueryEvaluate("SELECT estudiantes_materias.max_estud FROM monitorias, estudiantes_materias WHERE estudiantes_materias.materia_id = monitorias.materia_id AND estudiantes_materias.estudiante_id = monitorias.estudiante_id AND monitorias.id = " . $id . ";");
$materia = dbqueryEvaluate("SELECT materias.nombre FROM monitorias, materias WHERE materias.id = monitorias.materia_id AND monitorias.id = " . $id . ";");

@$myObj->result = "Te has unido a la monitoria";
$myObj->monitor = $monitor;
$myObj->inscritos = $inscritos;
$myObj->maximun = $maximun;
$myObj->materia = $materia;
$myJSON = json_encode($myObj);

$myJSON = json_encode($myObj);

echo $myJSON;
?>
