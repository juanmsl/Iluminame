<?php
define('PAGE_ID', "me");
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
  $user_query = dbquery("SELECT nombre, usuario, foto FROM estudiantes WHERE id = '" . $user_id . "'");
  if ($user_query->num_rows != 1)
  {

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
        <section class="profile-card"><img src="https://instagram.feoh3-1.fna.fbcdn.net/t51.2885-15/e35/12407299_1707501209487342_1845282389_n.jpg" class="profile-card-photo"/>
          <section class="profile-card-info">
            <p class="main-title">Juan Manuel Sánchez</p>
            <p class="user-id">juanmsl_pk</p>
            <section class="profile-card-follows"><a counter="23" class="profile-data item">Seguidores</a><a counter="6" class="profile-data item">Seguidos</a></section>
            <p class="user-description">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Provident in, ipsam ipsa suscipit laborum eveniet?</p>
            <section class="button-group">
              <button class="follow-button">Seguir</button>
              <button class="chat-button">Chat</button>
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
