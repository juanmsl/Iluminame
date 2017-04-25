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

if($id == USER_ID) {
	exit;
}

dbquery("REPLACE INTO estudiantes_seguidores (estudiante_id_seguidor, estudiante_id_seguido) VALUES ('" . USER_ID . "', '" . $id . "');");
$count = dbqueryEvaluate("SELECT count(*) FROM estudiantes_seguidores WHERE estudiante_id_seguido = '" . $id . "';");

@$myObj->result = "ok";
$myObj->count = $count;
$myJSON = json_encode($myObj);

echo $myJSON;
?>
