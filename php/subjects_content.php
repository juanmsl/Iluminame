<!DOCTYPE html5>
<html lang="es">
  <head>
    <title>Ilumíname - Materias</title>
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
    <div class="mainContent"><?php if($my_subjects) { ?>
      <div name="Materias que dictas monitorias" class="separator"></div>
      <div class="buttons-group">
        <button onclick="initNormalModal('#new-subject', true, false)" class="add-button">Añadir materia</button>
      </div>
      <div id="subjects-group" class="box-group"></div>
      <section id="new-subject" class="modal hide">
        <section class="modal-content box">
          <div class="modal-close ilm-close"></div>
          <section class="box-h-section box-header">
            <div class="box-v-section box-justify-center gutter-0">
              <h4>¿Deseas ser monitor?</h4>
              <p>Agrega una nueva materia en la que quieras dictar monitorias</p>
            </div>
          </section>
          <form action="javascript:addNewSubject('#new-subject')" id="new-subject-form" class="box-v-section modal-form">
            <label for="materia" class="form-label">Materia a dictar</label>
            <select name="materia" id="materia" required="required" class="form-item"><?php echo $new_subjects; ?></select>
            <textarea rows="5" maxlength="200" placeholder="¿Que temas dictarias de esta materia, o que nos puedes decir sobre la misma?" id="description" required="required" class="form-item"></textarea>
            <label for="value_pr" class="form-label">Valor por hora privada</label>
            <input type="number" id="value_pr" value="15000" step="1000" min="1000" required="required" class="form-item"/>
            <label for="value_pb" class="form-label">Valor por hora publica</label>
            <input type="number" id="value_pb" value="10000" step="1000" min="1000" required="required" class="form-item"/>
            <label for="max_estu" class="form-label">Maximo de estudiantes en la monitoria publica</label>
            <input type="number" id="max_estu" value="2" min="2" max="10" required="required" class="form-item"/>
          </form>
          <section class="box-h-section box-footer box-justify-center">
            <input type="submit" form="new-subject-form" value="Agregar a mis materias" class="join-button"/>
          </section>
        </section>
      </section><?php } else { ?>
      <section class="monitoria">
        <section class="header"><a href='profile.php?user=<?php echo $usuario; ?>'><img src='<?php echo $foto; ?>' class='photo'></a>
          <section class="header-group">
            <p class="main-title"><?php echo $materia; ?></p>
            <p><?php echo $monitor; ?></p>
            <section id="subject-rating"></section>
            <section class="header-sub-group"><br/>
              <p class="ilm-user"><?php echo $costo_pr; ?> / hora privada</p>
              <p class="ilm-users"><?php echo $costo_pb; ?> / hora publica</p><br/>
              <p><?php echo $descripcion; ?></p>
            </section><?php if(!$is_my_subject) { ?>
            	<div class='monitoria-actions'>
            		<button class='join-button' <?php echo $button_function; ?>>Solicitar una monitoria</button>
            		<a href="messages.php?user=<?php echo $usuario; ?>">
            			<button class='chat-button'>Chat</button>
            		</a>
            	</div>
            <?php } ?>
          </section>
        </section>
        <section class="information-full">
          <section class="information-full-group">
            <div name="Monitorias activas" class="separator"></div>
            <div id="active-monitories" class="box-group"></div>
          </section>
          <section class="information-full-group">
            <div name="Monitorias dictadas" class="separator"></div>
            <div id="past-monitories" class="box-group"></div>
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