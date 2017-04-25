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

@$myObj->result = "ok";
$myObj->count = $count;
$myJSON = json_encode($myObj);

echo $myJSON;
?>
