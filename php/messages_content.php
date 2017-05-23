<!DOCTYPE html5>
<html lang="es">
  <head>
    <title>Ilumíname - Mensajes</title>
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
    <div class="mainContent"><?php if($personal_chat) { ?>
      <section class="box chat">
        <section class="box-h-section box-header box-align-center"><a href='profile.php?user=<?php echo $user_name; ?>'><img src='<?php echo clean($search_result["foto"]); ?>' class='picture'></a>
          <section class="box-v-section gutter-0"><a href='profile.php?user=<?php echo $user_name; ?>'><h5 class='title'><?php echo clean($search_result["nombre"]); ?></h5></a></section>
        </section>
        <section id="message-container" class="box-v-section chat-history"></section> 
        <form class='box-h-section box-footer chat-footer' id='message-chat' action="javascript:sendMessage('<?php echo clean($search_result["id"]); ?>')">
        <textarea placeholder="Escribe tu mensaje aqui" rows="1" id="message-input" class="chat-typetext"></textarea>
        <input type="submit" value="Enviar" class="send-button"/></form>
      </section><?php } else {?>
      <div class='box-group box-grow' id='list-chats'>
      <?php if ($chat_results == 0) { ?>
      <div class="not-found-box box">
        <div class="planet"><i class="ilm-sad"></i><h2 class='glitch' data-text='¡ Whooops !'>¡ Whooops !</h2>
          <h5 class='glitch' data-text='No tienes chats aún'>No tienes chats aún</h5>
        </div>
      </div><?php } ?>
      </div>
      <?php }?>
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