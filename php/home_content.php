<!DOCTYPE html5>
<html lang="es">
  <head>
    <title>Ilumíname - Home</title>
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
      <?php if ($welcome || $home_query || $search_monitoria) { ?>
      <div class='box-group box-grow' id='home-monitories'>
      <?php if ($welcome) { ?>
      <section class="welcome">
        <section class="welcome-header"><img src="resources/svgs/laughing.svg" class="welcome-emoji"/>
          <h2>Bienvenido/a <?php echo $myrow['nombre'];?> a Ilumíname, la red de estudiantes y monitores más cool de la Javeriana</h2>
        </section>
        <section class="welcome-information"><a href="configuration.php" class="welcome-help"><img src="resources/svgs/cool.svg" class="welcome-image"/>
            <h6 class="sub-title ilm-configuration">Cambia tu foto de perfil y tus datos personales</h6></a>
          <div class="welcome-help"><img src="resources/svgs/search.svg" class="welcome-image"/>
            <h6 class="sub-title ilm-search">Buscar materias, usuarios y monitorias que desees</h6>
          </div>
          <div class="welcome-help"><img src="resources/svgs/learn.svg" class="welcome-image"/>
            <h6 class="sub-title ilm-users">Sigue a otros usuarios para estar pendiente de las monitorias que ellos brindan</h6>
          </div>
          <div class="welcome-help"><img src="resources/svgs/talk.svg" class="welcome-image"/>
            <h6 class="sub-title ilm-chat">Conversa directamente con un usuario de forma rapida</h6>
          </div>
          <div class="welcome-help"><img src="resources/svgs/mobile.svg" class="welcome-image"/>
            <h6 class="sub-title">Disfruta de nuestro servicio desde cualquier dispositivo movil</h6>
          </div>
        </section>
      </section><?php } elseif($query_results == 0) { ?>
      <div class="not-found-box box">
        <div class="planet"><i class="ilm-sad"></i><h2 class='glitch' data-text='¡ Whooops !'>¡ Whooops !</h2>
          <h5 class='glitch' data-text='No hubieron resultados'>No hubieron resultados</h5>
        </div>
      </div><?php } ?>
      </div>
      <?php } ?>
      <?php if ($search_materia) { ?>
      <div class='box-group box-grow' id='subjects-search'>
      <?php if ($query_results == 0) { ?>
      <div class="not-found-box box">
        <div class="planet"><i class="ilm-sad"></i><h2 class='glitch' data-text='¡ Whooops !'>¡ Whooops !</h2>
          <h5 class='glitch' data-text='No hubieron resultados'>No hubieron resultados</h5>
        </div>
      </div><?php } ?>
      </div>
      <?php } ?>
      <?php if ($search_usuario) { ?>
      <div class='users'><div class='box-group box-grow' id='users-search'>
      <?php if ($query_results == 0) { ?>
      <div class="not-found-box box">
        <div class="planet"><i class="ilm-sad"></i><h2 class='glitch' data-text='¡ Whooops !'>¡ Whooops !</h2>
          <h5 class='glitch' data-text='No hubieron resultados'>No hubieron resultados</h5>
        </div>
      </div><?php } ?>
      </div></div>
      <?php } ?>
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