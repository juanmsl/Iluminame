<?php
require_once "../global.php";
if (!LOGGED_IN)
{
	header("Location: " . WWW . "/");
	exit;
}

dbquery("UPDATE notificaciones SET vista = '1' WHERE notificaciones.estudiante_id_recibe = " . USER_ID . ";");

@$myObj->result = "Vistos";
$myJSON = json_encode($myObj);

echo $myJSON;
?>
