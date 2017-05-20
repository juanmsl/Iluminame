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

@$myObj->result = "Comentado";
$myJSON = json_encode($myObj);

echo $myJSON;
?>
