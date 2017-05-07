<!DOCTYPE html5>
<html lang="es">
  <head>
    <title>Ilumíname - Monitoria</title>
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
      <section class="monitoria">
        <section class="header"><a href='profile.php?user=<?php echo $usuario; ?>'><img src='<?php echo $foto; ?>' class='photo'></a>
          <section class="header-group">
            <p class="main-title"><?php echo $materia; ?></p>
            <p><?php echo $monitor; ?></p>
            <section class="header-sub-group"><br/>
              <p class="ilm-date"><?php echo $fecha; ?></p>
              <p class="ilm-time"><?php echo $duracion; ?></p><br/><p class='ilm-user<?php echo ($es_publica ? 's' : ''); ?>'>Monitoria <?php echo (($es_publica) ? 'publica' : 'privada'); ?></p>
              <p class="ilm-place"><?php echo $lugar; ?></p>
              <p class="ilm-money"><?php echo $costo; ?></p>
              <p title="En espera / Aceptada / En progreso / Finalizada / Cancelada" class="ilm-state">Aceptada</p>
            </section><?php if(!$is_my_monitorie) { ?>
            	<div class='monitoria-actions'>
            		<button class='<?php echo $button_class; ?>-button' <?php echo $button_function; ?> <?php echo $button_enable; ?>><?php echo $button_text; ?></button>
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
            <div class="box-group">
              <div class="box box-margin">
                <div class="box-h-section"><img src="http://placehold.it/200/200" class="big-picture"/>
                  <div class="box-v-section gutter-0">
                    <div class="sub-title">Juan Manuel Sánchez</div>
                    <div class="rating">
                      <div data-value="3 / 5" id="rating1" class="rating-stars active">
                        <input type="radio" name="rating" id="rt-five-full" value="5 / 5"/>
                        <label for="rt-five-full" title="5.0"></label>
                        <input type="radio" name="rating" id="rt-four-half" value="4.5 / 5"/>
                        <label for="rt-four-half" title="4.5"></label>
                        <input type="radio" name="rating" id="rt-four-full" value="4 / 5"/>
                        <label for="rt-four-full" title="4.0"></label>
                        <input type="radio" name="rating" id="rt-tree-half" value="3.5 / 5"/>
                        <label for="rt-tree-half" title="3.5"></label>
                        <input type="radio" name="rating" id="rt-tree-full" value="3 / 5" checked="checked"/>
                        <label for="rt-tree-full" title="3.0"></label>
                        <input type="radio" name="rating" id="rt-two-half" value="2.5 / 5"/>
                        <label for="rt-two-half" title="2.5"></label>
                        <input type="radio" name="rating" id="rt-two-full" value="2 / 5"/>
                        <label for="rt-two-full" title="2.0"></label>
                        <input type="radio" name="rating" id="rt-one-half" value="1.5 / 5"/>
                        <label for="rt-one-half" title="1.5"></label>
                        <input type="radio" name="rating" id="rt-one-full" value="1 / 5"/>
                        <label for="rt-one-full" title="1.0"></label>
                        <input type="radio" name="rating" id="rt-half" value="0.5 / 5"/>
                        <label for="rt-half" title="0.5"></label>
                      </div>
                    </div>
                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Quam aut sapiente ducimus non placeat illum eum repellat, culpa obcaecati cupiditate.</p>
                  </div>
                </div>
              </div>
              <div class="box box-margin">
                <div class="box-h-section"><img src="http://placehold.it/200/200" class="big-picture"/>
                  <div class="box-v-section gutter-0">
                    <div class="sub-title">Juan Manuel Sánchez</div>
                    <div class="rating">
                      <div data-value="3 / 5" id="rating1" class="rating-stars active">
                        <input type="radio" name="rating" id="rt-five-full" value="5 / 5"/>
                        <label for="rt-five-full" title="5.0"></label>
                        <input type="radio" name="rating" id="rt-four-half" value="4.5 / 5"/>
                        <label for="rt-four-half" title="4.5"></label>
                        <input type="radio" name="rating" id="rt-four-full" value="4 / 5"/>
                        <label for="rt-four-full" title="4.0"></label>
                        <input type="radio" name="rating" id="rt-tree-half" value="3.5 / 5"/>
                        <label for="rt-tree-half" title="3.5"></label>
                        <input type="radio" name="rating" id="rt-tree-full" value="3 / 5" checked="checked"/>
                        <label for="rt-tree-full" title="3.0"></label>
                        <input type="radio" name="rating" id="rt-two-half" value="2.5 / 5"/>
                        <label for="rt-two-half" title="2.5"></label>
                        <input type="radio" name="rating" id="rt-two-full" value="2 / 5"/>
                        <label for="rt-two-full" title="2.0"></label>
                        <input type="radio" name="rating" id="rt-one-half" value="1.5 / 5"/>
                        <label for="rt-one-half" title="1.5"></label>
                        <input type="radio" name="rating" id="rt-one-full" value="1 / 5"/>
                        <label for="rt-one-full" title="1.0"></label>
                        <input type="radio" name="rating" id="rt-half" value="0.5 / 5"/>
                        <label for="rt-half" title="0.5"></label>
                      </div>
                    </div>
                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Quam aut sapiente ducimus non placeat illum eum repellat, culpa obcaecati cupiditate.</p>
                  </div>
                </div>
              </div>
            </div>
          </section>
        </section>
      </section>
    </div>
    <footer class="footer">
      <?php
      $executionTime = microtime(true) - $core->execStart;
      $numQueries = $db->numQueries;
      echo "<!-- Generated in: $executionTime, with $numQueries queries -->";
      ?>
      <div class="copyright">Copyright &copy; 2017 - Iluminame.co - Todos los derechos reservados a sus respectivos dueños | <?php echo "Generated in: $executionTime, with $numQueries queries";?></div>
      <div class="github-link"><a href="https://github.com/juanmsl/Iluminame" class="ilm-github">View Source</a></div>
    </footer>
  </body>
  <script src="js/jquery.js"></script>
  <script src="js/push.min.js"></script><script src="js/scripts.js?<?php echo time(); ?>"></script>
  <script src="js/navbar.js"></script><?php echo $notifications; ?>
</html>