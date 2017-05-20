<!DOCTYPE html5>
<html lang="es">
  <head>
    <title>Ilumíname - Editar cuenta</title>
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
  <body><?php include('inc/templates/navbar.php') ?>
    <div class="mainContent">
      <div class="user_information">
        <section class="user-picture-edit">
          <img src='<?php echo clean($myrow["foto"]);?>' id='edit-image' class='edit-foto'>
          <div class='upload-item leave-button'>
          	<label for='edit-image-control' >Cambiar imagen</label>
          	<input type='file' name='photo' form='form-personal' id='edit-image-control' value='Cambiar foto'>
          </div>	
        </section>
        <div class="forms-section">
          <div class='separator' name='Datos personales'></div>
          <form action='edit_account.php' method='post' class='edit-form' id='form-personal' enctype='multipart/form-data'>
          	<input type='text' name='name' value='<?php echo clean($myrow["nombre"]); ?>' class='edit-item' placeholder='Y cuentanos, ¿Como te llamas?' required>
          	<input type='text' name='username' value='<?php echo clean($myrow["usuario"]); ?>' placeholder='Se creativo, ¿con que usuario quieres identificarte?' class='edit-item' required>
          	<input type='email' name='email' value='<?php echo clean($myrow["correo"]); ?>' placeholder='¿A qué correo te podran escribir?' class='edit-item' required>
          	<input type='tel' name='phone_number' value='<?php echo clean($myrow["telefono"]); ?>' placeholder='¿Con que número te podran contactar?' class='edit-item'>
          	<textarea name='aboutme' placeholder='Cuentanos un poco sobre ti, ¿que te gusta hacer?' class='edit-item' rows='5'><?php echo clean($myrow["aboutme"]); ?></textarea>
          	<input type='submit' value='Guardar cambios' class='join-button'>
          </form>
          <div class='separator' name='Cambio de contraseña'></div>
          <form action='change_password.php' method='post' class='edit-form'>
          	<input type='password' name='old_password' placeholder='Contraseña actual' class='edit-item'>
          	<input type='password' name='new_password' placeholder='Contraseña nueva' class='edit-item'>
          	<input type='password' name='conf_new_password' placeholder='Contraseña nueva' class='edit-item'>
          	<input type='submit' value='Cambiar contraseña' class='join-button'>
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
  <script src="js/push.min.js"></script><script src="js/scripts.js?<?php echo time(); ?>"></script>
  <script src="js/navbar.js?<?php echo time(); ?>"></script>
  <?php echo $notifications; ?>
</html>