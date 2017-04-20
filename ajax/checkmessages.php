<?php
require_once "../global.php";

if (!isset($_POST["user"]) || !isset($_POST["last_id"]) ){
  exit;
}

$receiver = intval(filter($_POST["user"]));
$last_id = intval(filter($_POST["last_id"]));

$messages = array();

$chat_query = dbquery("SELECT id, mensaje, fecha FROM mensajes WHERE estudiante_id_envia = '" . $receiver ."' AND estudiante_id_recibe = '" . $myrow["id"] ."' AND id > '" . $last_id . "'");
for ($i = 0; $i < $chat_query->num_rows; $i++)
{
  $chat_item = $chat_query->fetch_assoc();

  @$myObj->id = intval($chat_item["id"]);
  $myObj->text = clean($chat_item["mensaje"]);
  $myObj->date = "hace " . timeAgo($chat_item["fecha"]);
  $messages[] = $myObj;
}

$myJSON = json_encode($messages);
echo $myJSON;
?>
