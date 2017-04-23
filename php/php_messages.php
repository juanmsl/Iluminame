<?php
require_once "global.php";

if (!LOGGED_IN)
{
	header("Location: " . WWW . "/");
	exit;
}

if (isset($_GET["id"]))
{
  $user_id = filter($_GET["id"]);
  if ($user_id != $_GET["id"])
	{
		header("Location: " . WWW . "/logout.php");
		exit;
	}
  $user_id = intval($user_id);
  $user_query = dbquery("SELECT id, nombre, usuario, foto FROM estudiantes WHERE id = '" . $user_id . "'");
  if ($user_query->num_rows == 1)
  {
		$search_result = $user_query->fetch_assoc();
  }
}
if (isset($_GET["user"]))
{
  $user_name = filter($_GET["user"]);
  if ($user_name != $_GET["user"])
	{
		header("Location: " . WWW . "/logout.php");
		exit;
	}
  $user_query = dbquery("SELECT id, nombre, usuario, foto FROM estudiantes WHERE usuario LIKE '" . $user_name . "'");
  if ($user_query->num_rows == 1)
  {
		$search_result = $user_query->fetch_assoc();
  }
}
if (!isset($search_result))
{
  header("Location: " . WWW . "/");
  exit;
}

$last_id = -1;

$message_query = dbquery("SELECT id, mensaje, fecha, estudiante_id_recibe, estudiante_id_envia FROM mensajes WHERE (estudiante_id_recibe = '" . $myrow["id"] . "' AND estudiante_id_envia = '" . $search_result["id"] . "') OR (estudiante_id_recibe = '" . $search_result["id"] . "' AND estudiante_id_envia = '" . $myrow["id"] . "') ORDER BY fecha ASC;");
$messages_available = $message_query->num_rows;

$message_data = "";
if ($messages_available > 0)
{
  while ($message = $message_query->fetch_assoc())
  {
    $message_data .= '<article time="hace ' . timeAgo($message["fecha"]) . '" class="chat-message chat-user-' . ($myrow["id"] == $message["estudiante_id_recibe"] ? '1' : '2') . '">' . clean($message["mensaje"]) . '</article>';
		$last_id = $message["id"];
  }
}

?>
