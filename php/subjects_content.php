<!DOCTYPE html5>
<html lang="es">
  <head>
    <title>Ilumíname - Materias</title>
    <meta charset="utf-8"/>
    <link rel="icon" type="image/png" href="resources/images/icon.png"/>
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1, maximum-scale=1, minimum-scale=1"/>
    <link href="https://file.myfontastic.com/dgDbkkB8Fa2a8wimvMu34f/icons.css" rel="stylesheet"/>
    <link href="css/normalize.css" rel="stylesheet"/>
    <link href="css/styles.css" rel="stylesheet"/>
  </head>
  <body><?php include('inc/templates/navbar.php') ?>
    <div class="mainContent">
      <div name="Materias que dictas monitorias" class="separator"></div>
      <div class="buttons-group">
        <button class="add-button">Añadir materia</button>
      </div>
      <div class="box-group">
        <section class="box card box-margin"><a href="#" class="box-v-section box-header">
            <p class="sub-title">Ingeniería de software</p>
            <div class="ranking">
              <div class="fst">&#x2606&#x2606&#x2606&#x2606&#x2606</div>
              <div style="width: 80%;" class="scd">&#x2605&#x2605&#x2605&#x2605&#x2605</div>
              <div class="value">80 / 100</div>
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
        <section class="box card box-margin"><a href="#" class="box-v-section box-header">
            <p class="sub-title">Pensamiento algoritmico</p>
            <div class="ranking">
              <div class="fst">&#x2606&#x2606&#x2606&#x2606&#x2606</div>
              <div style="width: 70%;" class="scd">&#x2605&#x2605&#x2605&#x2605&#x2605</div>
              <div class="value">70 / 100</div>
              <div class="data">30 monitorias dictadas</div>
            </div></a>
          <section class="box-v-section">
            <p class="box-data">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Blanditiis ut saepe neque, atque corporis magnam perspiciatis expedita, exercitationem adipisci modi?</p>
          </section>
          <section class="box-v-section box-align-center">
            <p name="$15.000 / hora privada" data-tooltip-long="Solo tu y el monitor" data-tooltip-short="(x1)" class="box-data"></p>
            <p name="$10.000 / hora publica" data-tooltip-long="Maximo 4 personas" data-tooltip-short="(x4)" class="box-data"></p>
          </section>
          <section class="box-h-section box-footer box-justify-center">
            <button class="join-button">Pedir una monitoria</button>
          </section>
        </section>
        <section class="box card box-margin"><a href="#" class="box-v-section box-header">
            <p class="sub-title">Estructuras de datos</p>
            <div class="ranking">
              <div class="fst">&#x2606&#x2606&#x2606&#x2606&#x2606</div>
              <div style="width: 90%;" class="scd">&#x2605&#x2605&#x2605&#x2605&#x2605</div>
              <div class="value">90 / 100</div>
              <div class="data">30 monitorias dictadas</div>
            </div></a>
          <section class="box-v-section">
            <p class="box-data">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Blanditiis ut saepe neque, atque corporis magnam perspiciatis expedita, exercitationem adipisci modi?</p>
          </section>
          <section class="box-v-section box-align-center">
            <p name="$25.000 / hora privada" data-tooltip-long="Solo tu y el monitor" data-tooltip-short="(x1)" class="box-data"></p>
            <p name="$20.000 / hora publica" data-tooltip-long="Maximo 8 personas" data-tooltip-short="(x8)" class="box-data"></p>
          </section>
          <section class="box-h-section box-footer box-justify-center">
            <button class="join-button">Pedir una monitoria</button>
          </section>
        </section>
      </div>
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
</html>