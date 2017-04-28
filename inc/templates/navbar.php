<?php include('php/php_navbar.php') ?>
<nav id="main-navbar" class="navbar"><a href="/"><img src="resources/images/icon.png" class="logo"/></a><a href="/" class="logo-title">Ilumíname</a>
  <form class="navbar-finder">
    <input type="text" placeholder="¿Buscas una materia?" class="navbar-input"/><a href="#" class="ilm-search"></a>
  </form>
  <div id="toggle-notification" counter="0" target="#notification" class="navbar-notificator ilm-notification"></div>
  <div id="toggle-chat" counter="0" target="#chat" class="navbar-notificator ilm-chat"></div>
  <div id="toggle-my-tutories" counter="0" target="#my-tutories" class="navbar-notificator ilm-my-tutories"></div>
  <div id="toggle-tutories" counter="0" target="#tutories" class="navbar-notificator ilm-tutories"></div><img src='<?php echo $myPic; ?>' class='navbar-profile picture' id='toggle-user-profile-widget' target='#user-profile-widget'>
  <aside id="user-profile-widget" class="profile-widget">
    <section class="profile-widget-mainSection">
      <section class="profile-widget-user"><img src='<?php echo $myPic; ?>' class='profile-widget-userPicture'>
        <section class="profile-widget-userinfo"><a href="profile.php" class="title"><?php echo $myName; ?></a><a href="profile.php" class="user-id"><?php echo $myUsername; ?></a><p class='profile-widget-followers' counter='<?php echo $myFollowers; ?>'></p></section><a href="#" class="profile-widget-configIcon ilm-configuration"></a>
      </section>
      <section class="user-description"><?php echo $myDescription; ?></section>
    </section>
    <section class="profile-widget-notifications">
      <a href='notifications.php' class='profile-widget-section ilm-notification' counter='<?php echo clean($navbar_query["count_notifications"]); ?>'>Notificaciones</a>
      <a href='messages.php' class='profile-widget-section ilm-chat' counter='<?php echo clean($navbar_query["count_msgs"]); ?>'>Mensajes</a>
      <a href='my-tutories.php' class='profile-widget-section ilm-my-tutories' counter='<?php echo clean($navbar_query["count_my_monitories"]); ?>'>Mis monitorias</a>
      <a href='users.php' class='profile-widget-section ilm-users' counter='<?php echo clean($navbar_query["count_users"]); ?>'>Usuarios que sigo</a>
      <a href='subjects.php' class='profile-widget-section ilm-subject' counter='<?php echo clean($navbar_query["count_subjects"]); ?>'>Materias</a>
      <a href='tutories.php' class='profile-widget-section ilm-tutories' counter='<?php echo clean($navbar_query["count_monitories"]); ?>'>Monitorias pendientes</a><a href="logout.php" class="profile-widget-logout ilm-logout">Cerrar sesión</a>
    </section>
  </aside>
  <section id="my-tutories" class="navbar-boxNotification">
    <label class="title navbar-title">Monitorias pendientes</label>
    <section class="navbar-notifications"></section><a href="my-tutories.php" class="navbar-more">Ver todo</a>
  </section>
  <section id="tutories" class="navbar-boxNotification">
    <label class="title navbar-title">Monitorias por dictar</label>
    <section class="navbar-notifications"></section><a href="tutories.php" class="navbar-more">Ver todo</a>
  </section>
  <section id="chat" class="navbar-boxNotification">
    <label class="title navbar-title">Mensajes</label>
    <section class="navbar-notifications"></section><a href="messages.php" class="navbar-more">Ver todo</a>
  </section>
  <section id="notification" class="navbar-boxNotification">
    <label class="title navbar-title">Notificaciones</label>
    <section class="navbar-notifications"></section><a href="notifications.php" class="navbar-more">Ver todo</a>
  </section>
</nav>