<?php include('php/php_navbar.php') ?>
<nav id="main-navbar" class="navbar"><a href="/"><img src="resources/images/icon.png" class="logo"/></a><a href="/" class="logo-title">Ilumíname</a>
  <form action="home.php" method="get" class="navbar-finder">
    <section class="main-bar">
      <div id="toggleOptions" target="#radio-options" class="toggle"><i class="icon-caret-down"></i></div><input type='search' name='search' placeholder='¿Buscas una materia, usuario o monitoria?' value='<?php if(isset($search)) echo clean($search); ?>' maxlength=20 class='search-bar'>
      <section id="radio-options" class="radio-group">
        <article class="radio-option"><input type='radio' name='type' id='Monitoria' value='Monitoria' <?php if((isset($_GET['search']) && $_GET['type'] == 'Monitoria') || !isset($_GET['search'])) echo 'checked'; ?>>
          <label for="Monitoria">Monitoria</label>
        </article>
        <article class="radio-option"><input type='radio' name='type' id='Materia' value='Materia' <?php if(isset($_GET['search']) && $_GET['type'] == 'Materia') echo 'checked'; ?>>
          <label for="Materia">Materia</label>
        </article>
        <article class="radio-option"><input type='radio' name='type' id='Usuario' value='Usuario' <?php if(isset($_GET['search']) && $_GET['type'] == 'Usuario') echo 'checked'; ?>>
          <label for="Usuario">Usuario</label>
        </article>
      </section>
    </section>
    <button onclick="search.submit()" title="Buscar" class="submit"><i class="icon-search"></i></button>
  </form>
  <div id="toggle-notification" counter="0" target="#notification" title="Notificaciones" class="navbar-notificator ilm-notification"></div>
  <div id="toggle-chat" counter="0" target="#chat" title="Mensajes" class="navbar-notificator ilm-chat"></div>
  <div id="toggle-my-tutories" counter="0" target="#my-tutories" title="Monitorias pendientes" class="navbar-notificator ilm-my-tutories"></div>
  <div id="toggle-tutories" counter="0" target="#tutories" title="Monitorias por dictar" class="navbar-notificator ilm-tutories"></div><img src='<?php echo $myPic; ?>' class='navbar-profile picture' id='toggle-user-profile-widget' target='#user-profile-widget'>
  <aside id="user-profile-widget" class="profile-widget">
    <section class="profile-widget-mainSection">
      <section class="profile-widget-user"><a href='profile.php'><img src='<?php echo $myPic; ?>' class='profile-widget-userPicture'></a>
        <section class="profile-widget-userinfo">
          <h5 class="title"><a href="profile.php"><?php echo $myName; ?></a></h5><a href="profile.php" class="user-id"><?php echo $myUsername; ?></a>
        </section><a href="configuration.php" class="profile-widget-configIcon ilm-configuration"></a>
      </section>
      <section class="user-description"><?php echo $myDescription; ?></section>
    </section>
    <section class="profile-widget-notifications">
      <a href='notifications.php' class='profile-widget-section ilm-notification' counter='<?php echo $count_notificaciones; ?>'>Notificaciones</a>
      <a href='messages.php' class='profile-widget-section ilm-chat' counter='<?php echo $count_chats; ?>'>Mensajes</a>
      <a href='my-tutories.php' class='profile-widget-section ilm-my-tutories' counter='<?php echo $count_my_tutories; ?>'>Mis monitorias</a>
      <a href='users.php' class='profile-widget-section ilm-users'>Seguidores / Seguidos</a>
      <a href='subjects.php' class='profile-widget-section ilm-subject' counter='<?php echo clean($navbar_query["count_subjects"]); ?>'>Materias</a>
      <a href='tutories.php' class='profile-widget-section ilm-tutories' counter='<?php echo $count_tutories; ?>'>Monitorias pendientes</a><a href="logout.php" class="profile-widget-logout ilm-logout">Cerrar sesión</a>
    </section>
  </aside>
  <section id="my-tutories" class="navbar-boxNotification">
    <h5 class="navbar-title">Monitorias pendientes</h5>
    <section class="navbar-notifications"></section><a href="my-tutories.php" class="navbar-more">Ver todo</a>
  </section>
  <section id="tutories" class="navbar-boxNotification">
    <h5 class="navbar-title">Monitorias por dictar</h5>
    <section class="navbar-notifications"></section><a href="tutories.php" class="navbar-more">Ver todo</a>
  </section>
  <section id="chat" class="navbar-boxNotification">
    <h5 class="navbar-title">Mensajes</h5>
    <section class="navbar-notifications"></section>
  </section>
  <section id="notification" class="navbar-boxNotification">
    <h5 class="navbar-title">Notificaciones</h5>
    <section class="navbar-notifications"></section><a href="notifications.php" class="navbar-more">Ver todo</a>
  </section><?php if($comentaries) {?>
  <section id="modal-coments" class="modal-c">
    <section id="body" class="modal-c-body">
      <section class="modal-c-content"><?php echo $comentaries_content; ?></section>
      <section class="modal-c-buttons">
        <button id="prev-button" class="prev">◄</button>
        <section id="dots" class="modal-c-dots"></section>
        <button id="next-button" class="next">►</button>
      </section>
    </section>
  </section><?php } ?>
</nav>