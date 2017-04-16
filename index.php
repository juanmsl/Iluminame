
<?php
define('PAGE_ID', "index");
require_once "global.php";
if (LOGGED_IN)
{
	header("Location: " . WWW . "/home.php");
	exit;
}
$login_result = "";
$login_username = "";
if (isset($_POST['login_username']) && isset($_POST['login_password']))
{
	$login_username = $_POST['login_username'];
	$credUser = filter($_POST['login_username']);
	$credPass = filter($_POST['login_password']);
	if ($credUser != $login_username)
	{
		$credUser = "";
	}
	if (strlen($credUser) < 1)
	{
		$login_result = "Por favor, ingresa tu usuario";
	}
	elseif (strlen($credPass) < 1)
	{
		$login_result = "Por favor, ingresa tu contraseña";
	}
	else
	{
		if ($users->ValidateUser($credUser, $core->UberHash($credPass)))
		{
			$_SESSION['UBER_USER_E'] = $credUser;
			$_SESSION['UBER_USER_H'] = $core->UberHash($credPass);
			header("Location: " . WWW . "/security_check.php");
			exit;
		}
		else
		{
			$login_result = "La contraseña no es correcta";
		}
	}
}
?><!DOCTYPE html5>
<html lang="es">
  <head>
    <title>Ilumíname</title>
    <meta charset="utf-8"/>
    <link rel="icon" type="image/png" href="resources/images/icon.png"/>
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1, maximum-scale=1, minimum-scale=1"/>
    <link href="https://file.myfontastic.com/dgDbkkB8Fa2a8wimvMu34f/icons.css" rel="stylesheet"/>
    <link href="css/normalize.css" rel="stylesheet"/>
    <link href="css/styles.css" rel="stylesheet"/>
  </head>
  <body class="indexBody">
    <div class="main-box">
      <div id="initial-form" class="fm-container">
        <div class="fm-container_header"><img src="resources/images/icon.png" class="fm-container_logo"/>
          <h1 class="fm-container_title">Ilumíname</h1>
          <h5 class="fm-container_subtitle">Portal web de monitorias dedicado a estudiantes</h5>
        </div>
        <div class="fm-container_body">
          <form id="login-form" action="index.php" method="post" class="fm-form actual_form">
            <div class="fm-form_group">
              <label class="fm-form_introMessage">¡Hola! Bienvenido</label>
              <label class="fm-form_warning"></label>
              <input type="text" name="login_username" placeholder="Usuario" required="required" class="fm-form_control"/>
              <input type="password" name="login_password" placeholder="Contraseña" required="required" class="fm-form_control"/>
              <input type="submit" value="Ingresar" class="fm-form_button"/>
            </div>
            <div class="fm-form_group">
              <p class="fm-form_message">¿No tienes una cuenta aun? <a target="#register-form" class="fm-form_link">Registrate</a></p>
              <p class="fm-form_message">¿Olvidaste tu contraseña? <a target="#forgot-form" class="fm-form_link">Recuperala</a></p>
            </div>
          </form>
          <form id="register-form" action="register.php" method="post" class="fm-form">
            <div class="fm-form_group">
              <label class="fm-form_introMessage">Registrate y encuentra las monitorias que necesitas de forma facil y rapida<br/>¡Es gratis!</label>
              <label class="fm-form_warning"></label>
              <input type="text" name="register_username" placeholder="Usuario" required="required" class="fm-form_control"/>
              <input type="email" name="register_email" placeholder="Correo" required="required" class="fm-form_control"/>
              <input type="password" name="register_password" placeholder="Contraseña" required="required" class="fm-form_control"/>
              <input type="password" name="register_password_conf" placeholder="Contraseña" required="required" class="fm-form_control"/>
              <input type="submit" value="Registrarme" class="fm-form_button"/>
            </div>
            <div class="fm-form_group">
              <p class="fm-form_message">¿Ya tienes una cuenta? <a target="#login-form" class="fm-form_link">Ingresa</a></p>
              <p class="fm-form_message">¿Olvidaste tu contraseña? <a target="#forgot-form" class="fm-form_link">Recuperala</a></p>
            </div>
          </form>
          <form id="forgot-form" action="forgot.php" method="post" class="fm-form">
            <div class="fm-form_group">
              <label class="fm-form_introMessage">Brindanos tu correo para enviarte los pasos para cambiar tu contraseña</label>
              <label class="fm-form_warning"></label>
              <input type="email" name="forgot_email" placeholder="Correo" required="required" class="fm-form_control"/>
              <input type="submit" value="Recuperar" class="fm-form_button"/>
            </div>
            <div class="fm-form_group">
              <p class="fm-form_message">¿Ya tienes una cuenta? <a target="#login-form" class="fm-form_link">Ingresa</a></p>
              <p class="fm-form_message">¿No tienes una cuenta aun? <a target="#register-form" class="fm-form_link">Registrate</a></p>
            </div>
          </form>
        </div>
      </div>
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