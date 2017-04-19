<?php if (!defined("UBER")) exit;
$myPic = clean($myrow["foto"]);
$myName = clean($myrow["nombre"]);
$myUsername = clean($myrow["usuario"]);
$myDescription = clean($myrow["aboutme"]);
$myFollowers = clean($myrow["seguidores"]);
$myFollowing = clean($myrow["seguidos"]);
?>
<nav id="main-navbar" class="navbar"><a href="/"><img src="resources/images/icon.png" class="logo"/></a><a href="/" class="logo-title">Ilumíname</a>
  <form class="navbar-finder">
    <input type="text" placeholder="¿Buscas una materia?" class="navbar-input"/><a href="#" class="ilm-search"></a>
  </form>
  <div id="toggle-notification" counter="0" target="#notification" class="navbar-notificator ilm-notification"></div>
  <div id="toggle-chat" counter="0" target="#chat" class="navbar-notificator ilm-chat"></div>
  <div id="toggle-my-tutories" counter="0" target="#my-tutories" class="navbar-notificator ilm-my-tutories"></div>
  <div id="toggle-tutories" counter="0" target="#tutories" class="navbar-notificator ilm-tutories"></div>
  <img src="<?php echo $myPic; ?>" id="toggle-user-profile-widget" target="#user-profile-widget" class="navbar-profile picture"/>
  <aside id="user-profile-widget" class="profile-widget">
    <section class="profile-widget-mainSection">
      <section class="profile-widget-user"><img src="<?php echo $myPic; ?>" class="profile-widget-userPicture"/>
        <section class="profile-widget-userinfo"><a href="profile.php" class="title"><?php echo $myName; ?></a><a href="profile.php" class="user-id"><?php echo $myUsername; ?></a>
          <p counter="<?php echo $myFollowers; ?>" class="profile-widget-followers"></p>
        </section><a href="#" class="profile-widget-configIcon ilm-configuration"></a>
      </section>
      <section class="user-description"><?php echo $myDescription; ?></section>
    </section>
    <section class="profile-widget-notifications"><a href="notifications.html" counter="2" class="profile-widget-section ilm-notification active">Notificaciones</a><a href="#" counter="4" class="profile-widget-section ilm-chat active">Mensajes</a><a href="my-tutories.html" counter="4" class="profile-widget-section ilm-my-tutories active">Mis monitorias</a><a href="users.html" counter="<?php echo $myFollowing; ?>" class="profile-widget-section ilm-users">Usuarios que sigo</a><a href="subjects.html" counter="3" class="profile-widget-section ilm-subject">Materias</a><a href="tutories.html" counter="3" class="profile-widget-section ilm-tutories active">Monitorias pendientes</a><a href="logout.php" class="profile-widget-logout ilm-logout">Cerrar sesión</a></section>
  </aside>
  <section id="my-tutories" class="navbar-boxNotification">
    <label class="title">Monitorias pendientes</label>
    <section class="navbar-notifications"></section><a href="my-tutories.html" class="navbar-more">Ver todo</a>
  </section>
  <section id="tutories" class="navbar-boxNotification">
    <label class="title">Monitorias por dictar</label>
    <section class="navbar-notifications"></section><a href="tutories.html" class="navbar-more">Ver todo</a>
  </section>
  <section id="chat" class="navbar-boxNotification">
    <label class="title">Mensajes</label>
    <section class="navbar-notifications"></section><a href="#" class="navbar-more">Ver todo</a>
  </section>
  <section id="notification" class="navbar-boxNotification">
    <label class="title">Notificaciones</label>
    <section class="navbar-notifications"></section><a href="notifications.html" class="navbar-more">Ver todo</a>
  </section>
</nav>
