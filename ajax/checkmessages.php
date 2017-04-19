<?php
require_once "../global.php";

if (!isset($_POST["user"])){
  exit;
}

$receiver = intval(filter($_POST["user"]));

$messages = array();

if (isset($_SESSION["last_chat_time_" . $receiver]))
{
  $chat_query = dbquery("SELECT mensaje, fecha FROM mensajes WHERE estudiante_id_envia = '" . $receiver ."' AND estudiante_id_recibe = '" . $myrow["id"] ."' AND fecha > '" . $_SESSION["last_chat_time_" . $receiver] . "'");
  for ($i = 0; $i < $chat_query->num_rows; $i++)
  {
    $chat_item = $chat_query->fetch_assoc();

    @$myObj->text = clean($chat_item["mensaje"]);
    $myObj->date = "hace " . timeAgo($chat_item["fecha"]);
    $messages[] = $myObj;
  }
}
$_SESSION["last_chat_time_" . $receiver] = time();

$myJSON = json_encode($messages);
echo $myJSON;
?>
