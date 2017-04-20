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

?><!DOCTYPE html5>
<html lang="es">
  <head>
    <title>Ilumíname - Mensajes</title>
    <meta charset="utf-8"/>
    <link rel="icon" type="image/png" href="resources/images/icon.png"/>
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1, maximum-scale=1, minimum-scale=1"/>
    <link href="https://file.myfontastic.com/dgDbkkB8Fa2a8wimvMu34f/icons.css" rel="stylesheet"/>
    <link href="css/normalize.css" rel="stylesheet"/>
    <link href="css/styles.css" rel="stylesheet"/>
  </head>
  <body class="chatBody" onload="setInterval('checkMessages(<?php echo $search_result["id"]; ?>)', 1000)">
    <?php	include('inc/templates/navbar.php'); ?>
    <div class="mainContent">
      <section class="box chat">
        <section class="box-h-section box-header box-align-center"><a href="#"><img src="<?php echo clean($search_result["foto"]); ?>" class="picture"/></a>
          <section class="box-v-section gutter-0"><a href="#" class="title"><?php echo clean($search_result["nombre"]); ?></a></section>
        </section>
        <section class="box-v-section chat-history" id="message-container">
          <?php echo $message_data; ?>
        </section>
        <section class="box-h-section box-footer chat-footer">
          <textarea placeholder="Escribe tu mensaje aqui" rows="1" class="chat-typetext" id="message-input"></textarea>
          <input type="submit" value="Enviar" class="send-button" onclick="sendMessage('<?php echo clean($search_result["id"]); ?>')"/>
        </section>
      </section>
    </div>
    <footer class="footer">
      <div class="copyright">Copyright &copy; 2017 - Iluminame.co - Todos los derechos reservados a sus respectivos dueños</div>
      <div class="github-link"><a href="https://github.com/juanmsl/Iluminame" class="ilm-github">View Source</a></div>
    </footer>
  </body>
	<script>var last_message_id = <?php echo $last_id; ?>; </script>
  <script src="js/jquery.js"></script>
  <script src="js/viewport-size.js"></script>
  <script src="js/form.js"></script>
  <script src="js/navbar.js"></script>
  <script src="js/scripts.js"></script>
	<script src="js/chat.js"></script>
</html>
