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
            <article class="follows"><a class='data' href='followers.php<?php echo $extra; ?>' data='<?php echo clean($search_result["seguidores"]); ?>' id='profile-followers'>seguidores</a>
              <div class="follows-separator"></div><a class='data' href='users.php<?php echo $extra; ?>' data='<?php echo clean($search_result["seguidos"]); ?>'>seguidos</a>
            </article><?php if(!$isMyProfile && $isFollowMe) { ?>
            <p>Te sigue</p>
            <?php	} ?>
            <p class="user-description"><?php echo clean($search_result["aboutme"]); ?></p><?php if(!$isMyProfile) { ?>
            <article class='buttons-group'>
            	<button class='<?php echo clean($follow_button_class) ?>-button' onclick="<?php echo clean($follow_button_class) ?>('<?php echo clean($search_result["id"]) ?>', this)"><?php echo clean($follow_button_text) ?></button>
            	<a href="messages.php?user=<?php echo clean($search_result["usuario"]); ?>">
            		<button class='chat-button'>Chat</button>
            	</a>
            </article>
            <?php	} else { ?>
            <a href='#' class='profile-edit ilm-configuration'></a>
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
      </section>
      <section class="profile-body">
        <div name="Materias en las que brindo monitorias" class="separator"></div>
        <div id="profile-subjects" class="owl-carousel owl-theme">
          <section class="box box-margin"><a href="#" class="box-v-section box-header">
              <p class="sub-title">Ingeniería de software</p>
              <div class="ranking">
                <div class="fst">&#x2606&#x2606&#x2606&#x2606&#x2606</div>
                <div style="width: 80%;" class="scd">&#x2605&#x2605&#x2605&#x2605&#x2605</div>
                <div class="value">80 / 100'</div>
                <div class="data">30 monitorias dictadas</div>
              </div></a>
            <section class="box-v-section">
              <p class="box-data">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Blanditiis ut saepe neque, atque corporis magnam perspiciatis expedita, exercitationem adipisci modi?</p>
            </section>
            <section class="box-v-section box-align-center">
              <p name="$20.000 / hora privada" data-tooltip-long="Solo tu y el monitor" data-tooltip-short="(x1)" class="box-data"></p>
              <p name="$15.000 / hora publica" data-tooltip-long="Maximo 5 personas" data-tooltip-short="(x5)" class="box-data"></p>
            </section>
            <section class="box-h-section box-footer box-justify-center">
              <button class="join-button">Pedir una monitoria</button>
            </section>
          </section>
          <section class="box box-margin"><a href="#" class="box-v-section box-header">
              <p class="sub-title">Pensamiento algoritmico</p>
              <div class="ranking">
                <div class="fst">&#x2606&#x2606&#x2606&#x2606&#x2606</div>
                <div style="width: 80%;" class="scd">&#x2605&#x2605&#x2605&#x2605&#x2605</div>
                <div class="value">80 / 100'</div>
                <div class="data">30 monitorias dictadas</div>
              </div></a>
            <section class="box-v-section">
              <p class="box-data">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Blanditiis ut saepe neque, atque corporis magnam perspiciatis expedita, exercitationem adipisci modi?</p>
            </section>
            <section class="box-v-section box-align-center">
              <p name="$20.000 / hora privada" data-tooltip-long="Solo tu y el monitor" data-tooltip-short="(x1)" class="box-data"></p>
              <p name="$15.000 / hora publica" data-tooltip-long="Maximo 5 personas" data-tooltip-short="(x5)" class="box-data"></p>
            </section>
            <section class="box-h-section box-footer box-justify-center">
              <button class="join-button">Pedir una monitoria</button>
            </section>
          </section>
          <section class="box box-margin"><a href="#" class="box-v-section box-header">
              <p class="sub-title">Calculo vectorial</p>
              <div class="ranking">
                <div class="fst">&#x2606&#x2606&#x2606&#x2606&#x2606</div>
                <div style="width: 80%;" class="scd">&#x2605&#x2605&#x2605&#x2605&#x2605</div>
                <div class="value">80 / 100'</div>
                <div class="data">30 monitorias dictadas</div>
              </div></a>
            <section class="box-v-section">
              <p class="box-data">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Blanditiis ut saepe neque, atque corporis magnam perspiciatis expedita, exercitationem adipisci modi?</p>
            </section>
            <section class="box-v-section box-align-center">
              <p name="$20.000 / hora privada" data-tooltip-long="Solo tu y el monitor" data-tooltip-short="(x1)" class="box-data"></p>
              <p name="$15.000 / hora publica" data-tooltip-long="Maximo 5 personas" data-tooltip-short="(x5)" class="box-data"></p>
            </section>
            <section class="box-h-section box-footer box-justify-center">
              <button class="join-button">Pedir una monitoria</button>
            </section>
          </section>
          <section class="box box-margin"><a href="#" class="box-v-section box-header">
              <p class="sub-title">Estructuras de datos</p>
              <div class="ranking">
                <div class="fst">&#x2606&#x2606&#x2606&#x2606&#x2606</div>
                <div style="width: 80%;" class="scd">&#x2605&#x2605&#x2605&#x2605&#x2605</div>
                <div class="value">80 / 100'</div>
                <div class="data">30 monitorias dictadas</div>
              </div></a>
            <section class="box-v-section">
              <p class="box-data">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Blanditiis ut saepe neque, atque corporis magnam perspiciatis expedita, exercitationem adipisci modi?</p>
            </section>
            <section class="box-v-section box-align-center">
              <p name="$20.000 / hora privada" data-tooltip-long="Solo tu y el monitor" data-tooltip-short="(x1)" class="box-data"></p>
              <p name="$15.000 / hora publica" data-tooltip-long="Maximo 5 personas" data-tooltip-short="(x5)" class="box-data"></p>
            </section>
            <section class="box-h-section box-footer box-justify-center">
              <button class="join-button">Pedir una monitoria</button>
            </section>
          </section>
          <section class="box box-margin"><a href="#" class="box-v-section box-header">
              <p class="sub-title">Sistemas operativos</p>
              <div class="ranking">
                <div class="fst">&#x2606&#x2606&#x2606&#x2606&#x2606</div>
                <div style="width: 80%;" class="scd">&#x2605&#x2605&#x2605&#x2605&#x2605</div>
                <div class="value">80 / 100'</div>
                <div class="data">30 monitorias dictadas</div>
              </div></a>
            <section class="box-v-section">
              <p class="box-data">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Blanditiis ut saepe neque, atque corporis magnam perspiciatis expedita, exercitationem adipisci modi?</p>
            </section>
            <section class="box-v-section box-align-center">
              <p name="$20.000 / hora privada" data-tooltip-long="Solo tu y el monitor" data-tooltip-short="(x1)" class="box-data"></p>
              <p name="$15.000 / hora publica" data-tooltip-long="Maximo 5 personas" data-tooltip-short="(x5)" class="box-data"></p>
            </section>
            <section class="box-h-section box-footer box-justify-center">
              <button class="join-button">Pedir una monitoria</button>
            </section>
          </section>
          <section class="box box-margin"><a href="#" class="box-v-section box-header">
              <p class="sub-title">Administración basica de linux</p>
              <div class="ranking">
                <div class="fst">&#x2606&#x2606&#x2606&#x2606&#x2606</div>
                <div style="width: 80%;" class="scd">&#x2605&#x2605&#x2605&#x2605&#x2605</div>
                <div class="value">80 / 100'</div>
                <div class="data">30 monitorias dictadas</div>
              </div></a>
            <section class="box-v-section">
              <p class="box-data">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Blanditiis ut saepe neque, atque corporis magnam perspiciatis expedita, exercitationem adipisci modi?</p>
            </section>
            <section class="box-v-section box-align-center">
              <p name="$20.000 / hora privada" data-tooltip-long="Solo tu y el monitor" data-tooltip-short="(x1)" class="box-data"></p>
              <p name="$15.000 / hora publica" data-tooltip-long="Maximo 5 personas" data-tooltip-short="(x5)" class="box-data"></p>
            </section>
            <section class="box-h-section box-footer box-justify-center">
              <button class="join-button">Pedir una monitoria</button>
            </section>
          </section>
        </div>
      </section>
      <section class="profile-body">
        <div name="Monitorias publicas activas" class="separator"></div>
        <div id="profile-active-monitories" class="box-group owl-carousel owl-theme">
          <section class="box box-margin"><a href="#" class="box-h-section box-header"><img src="https://ig-s-a-a.akamaihd.net/hphotos-ak-xpa1/t51.2885-15/e35/12145363_500768776766300_40156557_n.jpg" class="picture"/>
              <div class="box-v-section box-justify-center gutter-0">
                <p class="sub-title">Ingenieria de software</p>
                <p>José Domínguez</p>
              </div></a>
            <section class="box-v-section">
              <p name="Lugar: " class="box-data">Biblioteca sotano 2 - sala 3</p>
              <p name="Fecha: " class="box-data">Abril 19 de 2017</p>
              <p name="Duración: " class="box-data">2:00pm - 4:00pm</p>
              <p name="Precio por estudiante: " class="box-data">$15.000</p>
            </section>
            <section class="box-v-section box-footer box-align-center">
              <p class="box-data">2 / 3 estudiantes inscritos</p>
              <button class="join-button">Deseo unirme</button>
            </section>
          </section>
          <section class="box box-margin"><a href="#" class="box-h-section box-header"><img src="https://ig-s-a-a.akamaihd.net/hphotos-ak-xpa1/t51.2885-15/e35/12145363_500768776766300_40156557_n.jpg" class="picture"/>
              <div class="box-v-section box-justify-center gutter-0">
                <p class="sub-title">Ingenieria de software</p>
                <p>José Domínguez</p>
              </div></a>
            <section class="box-v-section">
              <p name="Lugar: " class="box-data">Biblioteca sotano 2 - sala 3</p>
              <p name="Fecha: " class="box-data">Abril 19 de 2017</p>
              <p name="Duración: " class="box-data">2:00pm - 4:00pm</p>
              <p name="Precio por estudiante: " class="box-data">$15.000</p>
            </section>
            <section class="box-v-section box-footer box-align-center">
              <p class="box-data">2 / 3 estudiantes inscritos</p>
              <button class="join-button">Deseo unirme</button>
            </section>
          </section>
          <section class="box box-margin"><a href="#" class="box-h-section box-header"><img src="https://ig-s-a-a.akamaihd.net/hphotos-ak-xpa1/t51.2885-15/e35/12145363_500768776766300_40156557_n.jpg" class="picture"/>
              <div class="box-v-section box-justify-center gutter-0">
                <p class="sub-title">Ingenieria de software</p>
                <p>José Domínguez</p>
              </div></a>
            <section class="box-v-section">
              <p name="Lugar: " class="box-data">Biblioteca sotano 2 - sala 3</p>
              <p name="Fecha: " class="box-data">Abril 19 de 2017</p>
              <p name="Duración: " class="box-data">2:00pm - 4:00pm</p>
              <p name="Precio por estudiante: " class="box-data">$15.000</p>
            </section>
            <section class="box-v-section box-footer box-align-center">
              <p class="box-data">2 / 3 estudiantes inscritos</p>
              <button class="join-button">Deseo unirme</button>
            </section>
          </section>
          <section class="box box-margin"><a href="#" class="box-h-section box-header"><img src="https://ig-s-a-a.akamaihd.net/hphotos-ak-xpa1/t51.2885-15/e35/12145363_500768776766300_40156557_n.jpg" class="picture"/>
              <div class="box-v-section box-justify-center gutter-0">
                <p class="sub-title">Ingenieria de software</p>
                <p>José Domínguez</p>
              </div></a>
            <section class="box-v-section">
              <p name="Lugar: " class="box-data">Biblioteca sotano 2 - sala 3</p>
              <p name="Fecha: " class="box-data">Abril 19 de 2017</p>
              <p name="Duración: " class="box-data">2:00pm - 4:00pm</p>
              <p name="Precio por estudiante: " class="box-data">$15.000</p>
            </section>
            <section class="box-v-section box-footer box-align-center">
              <p class="box-data">2 / 3 estudiantes inscritos</p>
              <button class="join-button">Deseo unirme</button>
            </section>
          </section>
        </div>
      </section>
    </div>
    <footer class="footer">
      <div class="copyright">Copyright &copy; 2017 - Iluminame.co - Todos los derechos reservados a sus respectivos dueños</div>
      <div class="github-link"><a href="https://github.com/juanmsl/Iluminame" class="ilm-github">View Source</a></div>
    </footer>
  </body>
  <script src="js/jquery.js"></script>
  <script src="js/push.min.js"></script>
  <script src="js/scripts.js"></script>
  <script src="js/navbar.js"></script><?php echo $notifications; ?>
  <script src="js/owl.carousel.min.js"></script>
  <script src="js/profile.js"></script>
</html>