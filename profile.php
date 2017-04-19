<?php
require_once "global.php";

if (!LOGGED_IN)
{
	header("Location: " . WWW . "/");
	exit;
}

$search_result = $myrow;
if (isset($_GET["id"]))
{
  $user_id = filter($_GET["id"]);
  if ($user_id != $_GET["id"])
	{
		header("Location: " . WWW . "/logout.php");
		exit;
	}
  $user_id = intval($user_id);
  $user_query = dbquery("SELECT nombre, usuario, foto, aboutme, (SELECT count(*) FROM estudiantes_seguidores WHERE estudiante_id_seguidor = '" . $user_id . "') as seguidos, (SELECT count(*) FROM estudiantes_seguidores WHERE estudiante_id_seguido = '" . $user_id . "') as seguidores FROM estudiantes WHERE id = '" . $user_id . "'");
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
  $user_query = dbquery("SELECT nombre, usuario, foto, aboutme, (SELECT count(*) FROM estudiantes_seguidores WHERE estudiante_id_seguidor = COALESCE((SELECT id FROM estudiantes WHERE usuario LIKE '" . $user_name . "'), 0)) as seguidos, (SELECT count(*) FROM estudiantes_seguidores WHERE estudiante_id_seguido = COALESCE((SELECT id FROM estudiantes WHERE usuario LIKE '" . $user_name . "'), 0)) as seguidores FROM estudiantes WHERE usuario LIKE '" . $user_name . "'");
  if ($user_query->num_rows == 1)
  {
		$search_result = $user_query->fetch_assoc();
  }
}
?><!DOCTYPE html5>
<html lang="es">
  <head>
    <title>Ilumíname - Perfil</title>
    <meta charset="utf-8"/>
    <link rel="icon" type="image/png" href="resources/images/icon.png"/>
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1, maximum-scale=1, minimum-scale=1"/>
    <link href="https://file.myfontastic.com/dgDbkkB8Fa2a8wimvMu34f/icons.css" rel="stylesheet"/>
    <link href="css/normalize.css" rel="stylesheet"/>
    <link href="css/styles.css" rel="stylesheet"/>
  </head>
  <body>
    <?php	include('inc/templates/navbar.php'); ?>
    <div class="mainContent profile">
      <section class="profile-header">
        <section class="profile-card"><img src="<?php echo clean($search_result["foto"]); ?>" class="profile-card-photo"/>
          <section class="profile-card-info">
            <p class="main-title"><?php echo clean($search_result["nombre"]); ?></p>
            <p class="user-id"><?php echo clean($search_result["usuario"]); ?></p>
            <section class="profile-card-follows"><a counter="<?php echo clean($search_result["seguidores"]); ?>" class="profile-data item">Seguidores</a><a counter="<?php echo clean($search_result["seguidos"]); ?>" class="profile-data item">Seguidos</a></section>
            <p class="user-description"><?php echo clean($search_result["aboutme"]); ?></p>
            <section class="button-group">
              <button class="follow-button">Seguir</button>
              <a href="messages.php?user=<?php echo clean($search_result["usuario"]); ?>"><button class="chat-button">Chat</button></a>
            </section>
          </section><a href="#" class="profile-edit ilm-configuration"></a>
        </section>
      </section>
      <section class="profile-body">
        <div class="box-group">
          <div class="box">
            <div class="box-h-section box-align-center box-justify-center">
              <h1 class="ilm-subject"></h1>
            </div>
            <div class="box-h-section box-justify-center">
              <h3 name="3 " class="sub-title box-data">materias</h3>
            </div>
          </div>
          <div class="box">
            <div class="box-h-section box-align-center box-justify-center">
              <h1 class="ilm-tutories"></h1>
            </div>
            <div class="box-h-section box-justify-center">
              <h3 name="32 " class="sub-title box-data">monitorias dictadas</h3>
            </div>
          </div>
          <div class="box">
            <div class="box-h-section box-align-center box-justify-center">
              <h1 class="ilm-users"></h1>
            </div>
            <div class="box-h-section box-justify-center">
              <h3 name="54 " class="sub-title box-data">estudiantes monitoreados</h3>
            </div>
          </div>
        </div>
      </section>
    </div>
    <footer class="footer">
      <div class="copyright">Copyright &copy; 2017 - Iluminame.co - Todos los derechos reservados a sus respectivos dueños</div>
      <div class="github-link"><a href="https://github.com/juanmsl/Iluminame" class="ilm-github">View Source</a></div>
    </footer>
  </body>
  <script src="js/jquery.js"></script>
  <script src="js/viewport-size.js"></script>
  <script src="js/form.js"></script>
  <script src="js/navbar.js"></script>
  <script src="js/scripts.js"></script>
</html>
