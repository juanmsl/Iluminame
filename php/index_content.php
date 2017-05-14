<!DOCTYPE html5>
<html lang="es">
  <head>
    <title>Ilumíname</title>
    <meta charset="utf-8"/>
    <link rel="icon" type="image/png" href="resources/images/icon.png"/>
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1, maximum-scale=1, minimum-scale=1"/>
    <link href="https://file.myfontastic.com/dgDbkkB8Fa2a8wimvMu34f/icons.css" rel="stylesheet"/>
    <link href="css/normalize.css" rel="stylesheet"/><link href="css/styles.css?<?php echo time(); ?>" rel="stylesheet">
    <script>
    if(window.location.href.match("http:")) {
    	window.location.href = window.location.href.replace('http', 'https');
    }
    </script>
  </head>
  <body class="indexBody">
    <div class="main-box">
      <div id="initial-form" class="fm-container">
        <div class="fm-container_header"><img src="resources/images/icon.png" class="fm-container_logo"/>
          <h1 class="fm-container_title">Ilumíname</h1>
          <h5 class="fm-container_subtitle">Portal web de monitorias dedicado a estudiantes</h5>
        </div>
        <div class="fm-container_body">
          <form id="login-form" action="index.php" method="post" autocomplete="off" class="fm-form actual_form">
            <div class="fm-form_group">
              <label class="fm-form_introMessage">¡Hola! Bienvenido</label>
              <label class="fm-form_warning"><?php echo clean($login_result);?></label><input type='text' class='fm-form_control' name='login_username' placeholder='Usuario' value='<?php echo clean($login_username);?>' required>
              <input type="password" name="login_password" placeholder="Contraseña" required="required" class="fm-form_control"/>
              <div class="fm-form_remember">
                <input type="checkbox" id="remember_me" name="remember_me" value="value" placeholder="asdf"/>
                <label for="remember_me" class="fm-form_message">Mantener la sesión iniciada</label>
              </div>
              <input type="submit" value="Ingresar" class="fm-form_button"/>
            </div>
            <div class="fm-form_group">
              <p class="fm-form_message">¿No tienes una cuenta aun? <a target="#register-form" class="fm-form_link">Registrate</a></p>
              <p class="fm-form_message">¿Olvidaste tu contraseña? <a target="#forgot-form" class="fm-form_link">Recuperala</a></p>
            </div>
          </form>
          <form id="register-form" action="register.php" method="post" autocomplete="off" class="fm-form">
            <div class="fm-form_group">
              <label class="fm-form_introMessage">Registrate y encuentra las monitorias que necesitas de forma facil y rapida<br/>¡Es gratis!</label>
              <label class="fm-form_warning"></label>
              <input type="text" name="register_name" placeholder="Nombre" required="required" class="fm-form_control"/>
              <input type="text" name="register_username" placeholder="Usuario" required="required" class="fm-form_control"/>
              <input type="email" name="register_email" placeholder="Correo" required="required" class="fm-form_control"/>
              <input type="password" name="register_password" placeholder="Contraseña" required="required" class="fm-form_control"/>
              <input type="password" name="register_password_conf" placeholder="Contraseña" required="required" class="fm-form_control"/>
              <div class="fm-form_remember">
                <input type="checkbox" id="remember_me" name="remember_me" value="value" placeholder="asdf"/>
                <label for="remember_me" class="fm-form_message">Mantener la sesión iniciada</label>
              </div>
              <input type="submit" value="Registrarme" class="fm-form_button"/>
            </div>
            <div class="fm-form_group">
              <p class="fm-form_message">¿Ya tienes una cuenta? <a target="#login-form" class="fm-form_link">Ingresa</a></p>
              <p class="fm-form_message">¿Olvidaste tu contraseña? <a target="#forgot-form" class="fm-form_link">Recuperala</a></p>
            </div>
          </form>
          <form id="forgot-form" action="forgot.php" method="post" autocomplete="off" class="fm-form">
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
      <?php
      $executionTime = microtime(true) - $core->execStart;
      $numQueries = $db->numQueries;
      echo "<!-- Generated in: $executionTime, with $numQueries queries -->";
      ?>
      <div class="copyright">Copyright &copy; 2017 - Iluminame.co - Todos los derechos reservados a sus respectivos dueños | <?php echo "Tiempo de carga: " . round($executionTime, 2) . " segundos, con $numQueries consultas";?></div>
      <div class="github-link"><a href="https://github.com/juanmsl/Iluminame" class="ilm-github">View Source</a></div>
    </footer>
  </body>
  <script src="js/jquery.js"></script>
  <script src="js/push.min.js"></script><script src="js/scripts.js?<?php echo time(); ?>"></script><script src="js/form.js?<?php echo time(); ?>"></script>
</html>