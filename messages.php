<?php include('php/php_messages.php') ?><!DOCTYPE html5>
<html lang="es">
  <head>
    <title>Ilumíname - Mensajes</title>
    <meta charset="utf-8"/>
    <link rel="icon" type="image/png" href="resources/images/icon.png"/>
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1, maximum-scale=1, minimum-scale=1"/>
    <link href="https://file.myfontastic.com/dgDbkkB8Fa2a8wimvMu34f/icons.css" rel="stylesheet"/>
    <link href="css/normalize.css" rel="stylesheet"/>
    <link href="css/styles.css" rel="stylesheet"/>
  </head>
  <body class="chatBody"><?php include('inc/templates/navbar.php') ?>
    <div class="mainContent">
      <section class="box chat">
        <section class="box-h-section box-header box-align-center"><a href="#"><img src='<?php echo clean($search_result["foto"]); ?>' class='picture'></a>
          <section class="box-v-section gutter-0"><a href="#" class="title"><?php echo clean($search_result["nombre"]); ?></a></section>
        </section>
        <section id="message-container" class="box-v-section chat-history"><?php echo $message_data; ?></section> 
        <form class='box-h-section box-footer chat-footer' id='message-chat' action="javascript:sendMessage('<?php echo clean($search_result["id"]); ?>')">
        <textarea placeholder="Escribe tu mensaje aqui" rows="1" id="message-input" class="chat-typetext"></textarea>
        <input type="submit" value="Enviar" class="send-button"/></form>
      </section>
    </div>
    <footer class="footer">
      <div class="copyright">Copyright &copy; 2017 - Iluminame.co - Todos los derechos reservados a sus respectivos dueños</div>
      <div class="github-link"><a href="https://github.com/juanmsl/Iluminame" class="ilm-github">View Source</a></div>
    </footer>
  </body>
  <script src="js/jquery.js"></script>
  <script src="js/form.js"></script>
  <script src="js/navbar.js"></script>
  <script src="js/scripts.js"></script><script>$('body').ready(function(){
  	scrollDown();
  	setInterval('checkMessages(<?php echo $search_result['id']; ?>)', 1000);
  });</script>
  <script> var last_message_id = <?php echo $last_id; ?>; </script>
  <script src="js/chat.js"></script>
</html>