<?php
require_once "../global.php";
if (!LOGGED_IN) {
	header("Location: " . WWW . "/");
	exit;
}

dbquery("DELETE FROM estudiantes WHERE estudiantes.id = " . USER_ID . ";");

@$myObj->result = "Eliminado";
$myJSON = json_encode($myObj);

echo $myJSON;
?>
