<!DOCTYPE html5>
<html lang="es">
  <head>
    <title>Ilumíname - Monitorias pendientes</title>
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
    <div class="mainContent"><?php if($my_tutories) { ?>
      <div name="Mis monitorias por dictar" class="separator"></div>
      <div id="active-monitories" class="box-group"></div>
      <div name="Historial de monitorias dictadas" class="separator"></div>
      <div id="past-monitories" class="box-group"></div><?php } else { ?>
      <section class="monitoria">
        <section class="header"><a href='profile.php?user=<?php echo $usuario; ?>'><img src='<?php echo $foto; ?>' class='photo'></a>
          <section class="header-group">
            <p class="main-title"><?php echo $materia; ?></p>
            <p><?php echo $monitor; ?></p>
            <section id="tutorie-rating"></section>
            <section class="header-sub-group"><br/>
              <p class="ilm-date"><?php echo $fecha; ?></p>
              <p class="ilm-time"><?php echo $duracion; ?></p><br/><p class='ilm-user<?php echo ($es_publica ? 's' : ''); ?>'>Monitoria <?php echo (($es_publica) ? 'publica' : 'privada'); ?></p>
              <p class="ilm-place"><?php echo $lugar; ?></p>
              <p class="ilm-money"><?php echo $costo; ?></p>
              <p title="En espera / Aceptada / En progreso / Finalizada / Cancelada" class="ilm-state">Aceptada</p>
            </section><?php if(!$is_my_monitorie) { ?>
            	<div class='monitoria-actions'>
            		<?php if(!$is_disabled) { ?>
            			<button class='<?php echo $button_class; ?>-button' <?php echo $button_function; ?> <?php echo $button_enable; ?>><?php echo $button_text; ?></button>
            		<?php } ?>
            		<a href="messages.php?user=<?php echo $usuario; ?>">
            			<button class='chat-button'>Chat</button>
            		</a>
            	</div>
            <?php } ?>
          </section>
        </section>
        <section class="information">
          <section class="information-group">
            <div name="Estudiantes inscritos" class="separator"></div>
            <div id="estudents" class="box-group"></div>
          </section>
          <section class="information-group">
            <div name="Comentarios" class="separator"></div>
            <div id="comments" class="box-group"></div>
          </section>
        </section>
      </section><?php } ?>
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