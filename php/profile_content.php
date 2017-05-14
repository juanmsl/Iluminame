<!DOCTYPE html5>
<html lang="es">
  <title>Ilumíname - Perfil</title>
  <meta charset="utf-8"/>
  <link rel="icon" type="image/png" href="resources/images/icon.png"/>
  <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1, maximum-scale=1, minimum-scale=1"/>
  <link href="css/normalize.css" rel="stylesheet"/>
  <link href="https://file.myfontastic.com/dgDbkkB8Fa2a8wimvMu34f/icons.css" rel="stylesheet"/>
  <link href="css/owl.carousel.min.css" rel="stylesheet"/>
  <link href="css/owl.theme.default.min.css" rel="stylesheet"/>
  <link href="css/styles.css" rel="stylesheet"/>
  <body><?php include('inc/templates/navbar.php') ?>
    <div class="mainContent profile">
      <section class="profile-header">
        <section class="profile-card"><img src='<?php echo clean($search_result["foto"]); ?>' class='profile-photo'>
          <div class="info">
            <h3><?php echo clean($search_result["nombre"]); ?></h3>
            <p class="user-id"><?php echo clean($search_result["usuario"]); ?></p>
            <article class="follows"><a class='data' href='users.php<?php echo $extra; ?>' data='<?php echo clean($search_result["seguidores"]); ?>' id='profile-followers'>seguidores</a>
              <div class="follows-separator"></div><a class='data' href='users.php<?php echo $extra; ?>' data='<?php echo clean($search_result["seguidos"]); ?>'>seguidos</a>
            </article><?php if(!$isMyProfile && $isFollowMe) { ?>
            <p class='follow-you'>Te sigue</p>
            <?php	} ?>
            <p class="user-description"><?php echo clean($search_result["aboutme"]); ?></p><?php if(!$isMyProfile) { ?>
            <article class='buttons-group'>
            	<button class='<?php echo clean($follow_button_class) ?>-button' onclick="<?php echo clean($follow_button_class) ?>('<?php echo clean($search_result["id"]) ?>', this, true)"><?php echo clean($follow_button_text) ?></button>
            	<a href="messages.php?user=<?php echo clean($search_result["usuario"]); ?>">
            		<button class='chat-button'>Chat</button>
            	</a>
            </article>
            <?php	} else { ?>
            <a href='configuration.php' class='profile-edit ilm-configuration'></a>
            <?php	} ?>
          </div>
        </section>
      </section>
      <section class="profile-body">
        <div id="cards" class="owl-carousel owl-theme">
          <div class="box profile-mini-card">
            <div class="box-h-section box-align-center box-justify-center">
              <h1 class="ilm-subject"></h1>
            </div>
            <div class="box-h-section box-justify-center"><h3 class='sub-title box-data' name='<?php echo $count_materias ?> '>materias</h3></div>
          </div>
          <div class="box profile-mini-card">
            <div class="box-h-section box-align-center box-justify-center">
              <h1 class="ilm-tutories"></h1>
            </div>
            <div class="box-h-section box-justify-center"><h3 class='sub-title box-data' name='<?php echo $count_monitorias_dictadas ?> '>monitorias dictadas</h3></div>
          </div>
          <div class="box profile-mini-card">
            <div class="box-h-section box-align-center box-justify-center">
              <h1 class="ilm-users"></h1>
            </div>
            <div class="box-h-section box-justify-center"><h3 class='sub-title box-data' name='<?php echo $count_estudiantes ?> '>estudiantes monitoreados</h3></div>
          </div>
          <div class="box profile-mini-card">
            <div class="box-h-section box-align-center box-justify-center">
              <h1 class="ilm-my-tutories"></h1>
            </div>
            <div class="box-h-section box-justify-center"><h3 class='sub-title box-data' name='<?php echo $count_monitorias_asistidas ?> '>monitorias asistidas</h3></div>
          </div>
        </div>
      </section><?php if($have_subjects) {?>
      <section class="profile-body">
        <div name="Materias en las que brindo monitorias" class="separator"></div>
        <div id="profile-subjects" class="owl-carousel owl-theme"></div>
      </section><?php } ?>
      <?php if($have_public_monitories) {?>
      <section class="profile-body">
        <div name="Monitorias publicas activas" class="separator"></div>
        <div id="profile-active-monitories" class="box-group owl-carousel owl-theme"></div>
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
  <script src="js/owl.carousel.min.js"></script>
  <script src="js/profile.js"></script>
</html>