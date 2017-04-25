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
$count = dbqueryEvaluate("SELECT count(*) FROM estudiantes_monitorias_inscripciones WHERE monitoria_id = '" . $id . "';");
$max = dbqueryEvaluate("SELECT estudiantes_materias.max_estud FROM monitorias JOIN estudiantes_materias ON (estudiantes_materias.materia_id = monitorias.materia_id AND estudiantes_materias.estudiante_id = monitorias.estudiante_id) WHERE monitorias.id = " . $id . ";");

@$myObj->result = "ok";
$myObj->count = $count;
$myObj->max = $max;
$myJSON = json_encode($myObj);

echo $myJSON;
?>
