<!DOCTYPE html5>
<html lang="es">
  <head>
    <title>Ilumíname - Home</title>
    <meta charset="utf-8"/>
    <link rel="icon" type="image/png" href="resources/images/icon.png"/>
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1, maximum-scale=1, minimum-scale=1"/>
    <link href="https://file.myfontastic.com/dgDbkkB8Fa2a8wimvMu34f/icons.css" rel="stylesheet"/>
    <link href="css/normalize.css" rel="stylesheet"/>
    <link href="css/styles.css" rel="stylesheet"/>
  </head>
  <body><?php include('inc/templates/navbar.php') ?>
    <div class="mainContent">
      <?php if (isset($search)) { ?>
      <div class='separator' name="Monitorias de materias relacionadas a '<?php echo clean($search) ?>'"></div>
      <?php } ?>
      <div id="home-monitories" class="box-group"></div><?php if (isset($search)) { ?>
      <div class='separator' name="Usuarios relacionados a '<?php echo clean($search) ?>'"></div>
      <div class='users'><div class='box-group' id='users-search'></div></div>
      <?php } ?>
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