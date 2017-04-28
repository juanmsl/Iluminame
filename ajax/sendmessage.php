<?php
require_once "../global.php";
if (!LOGGED_IN)
{
	header("Location: " . WWW . "/");
	exit;
}

if (!isset($_POST["user"]) || !isset($_POST["text"])){
	exit;
}

$receiver = intval(filter($_POST["user"]));
$message = $_POST["text"];

dbquery("INSERT INTO mensajes (mensaje, fecha, estudiante_id_envia, estudiante_id_recibe) VALUES ('" . $message . "', '" . time() . "', '" . $myrow["id"] . "', '" . $receiver . "');");

@$myObj->text = $message;
$myObj->date = "hace " . timeAgo(time());

$myJSON = json_encode($myObj);

echo $myJSON;
?>
