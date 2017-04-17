<!DOCTYPE html5>
<html lang="es">
  <head>
    <title>Ilumíname - Notificaciones</title>
    <meta charset="utf-8"/>
    <link rel="icon" type="image/png" href="resources/images/icon.png"/>
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1, maximum-scale=1, minimum-scale=1"/>
    <link href="https://file.myfontastic.com/dgDbkkB8Fa2a8wimvMu34f/icons.css" rel="stylesheet"/>
    <link href="css/normalize.css" rel="stylesheet"/>
    <link href="css/styles.css" rel="stylesheet"/>
  </head>
  <body>
    <nav id="main-navbar" class="navbar"><a href="home.php"><img src="resources/images/icon.png" class="logo"/></a><a href="home.php" class="logo-title">Ilumíname</a>
      <form class="navbar-finder">
        <input type="text" placeholder="¿Buscas una materia?" class="navbar-input"/><a href="#" class="ilm-search"></a>
      </form>
      <div id="toggle-notification" counter="0" target="#notification" class="navbar-notificator ilm-notification"></div>
      <div id="toggle-chat" counter="0" target="#chat" class="navbar-notificator ilm-chat"></div>
      <div id="toggle-my-tutories" counter="0" target="#my-tutories" class="navbar-notificator ilm-my-tutories"></div>
      <div id="toggle-tutories" counter="0" target="#tutories" class="navbar-notificator ilm-tutories"></div><img src="https://instagram.feoh3-1.fna.fbcdn.net/t51.2885-15/e35/12407299_1707501209487342_1845282389_n.jpg" id="toggle-user-profile-widget" target="#user-profile-widget" class="navbar-profile picture"/>
      <aside id="user-profile-widget" class="profile-widget">
        <section class="profile-widget-mainSection">
          <section class="profile-widget-user"><img src="https://instagram.feoh3-1.fna.fbcdn.net/t51.2885-15/e35/12407299_1707501209487342_1845282389_n.jpg" class="profile-widget-userPicture"/>
            <section class="profile-widget-userinfo"><a href="profile.php" class="title">Juan Manuel Sánchez</a><a href="profile.php" class="user-id">juanmsl_pk</a>
              <p counter="23" class="profile-widget-followers"></p>
            </section><a href="#" class="profile-widget-configIcon ilm-configuration"></a>
          </section>
          <section class="user-description">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Neque dolor reiciendis enim id consequatur sapiente.</section>
        </section>
        <section class="profile-widget-notifications"><a href="notifications.php" counter="2" class="profile-widget-section ilm-notification active">Notificaciones</a><a href="messages.php" counter="4" class="profile-widget-section ilm-chat active">Mensajes</a><a href="my-tutories.php" counter="4" class="profile-widget-section ilm-my-tutories active">Mis monitorias</a><a href="users.php" counter="53" class="profile-widget-section ilm-users">Usuarios que sigo</a><a href="subjects.php" counter="3" class="profile-widget-section ilm-subject">Materias</a><a href="tutories.php" counter="3" class="profile-widget-section ilm-tutories active">Monitorias pendientes</a><a href="logout.php" class="profile-widget-logout ilm-logout">Cerrar sesión</a></section>
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
    <div class="mainContent">
      <div name="22/04/2017" class="separator"></div>
      <div class="box-group"><a href="#" data-fixed="3:52pm" class="box card data-fixed">
          <section class="box-h-section"><img src="https://instagram.feoh1-1.fna.fbcdn.net/t51.2885-19/s150x150/12825742_1692854517660573_747437461_a.jpg" class="big-picture"/>
            <div class="box-v-section box-justify-center gutter-0">
              <p class="sub-title">Maria Paula Moreno</p>
              <p class="box-data">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Veniam, aliquid.</p>
            </div>
          </section></a><a href="#" data-fixed="3:52pm" class="box card data-fixed">
          <section class="box-h-section"><img src="https://instagram.feoh1-1.fna.fbcdn.net/t51.2885-19/s150x150/15625369_1740657899586089_5204408783928819712_a.jpg" class="big-picture"/>
            <div class="box-v-section box-justify-center gutter-0">
              <p class="sub-title">Carlos Eduardo Camacho</p>
              <p class="box-data">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Nihil, temporibus.</p>
            </div>
          </section></a><a href="#" data-fixed="3:52pm" class="box card data-fixed">
          <section class="box-h-section"><img src="https://instagram.feoh1-1.fna.fbcdn.net/t51.2885-19/11410339_857773544301773_1638908020_a.jpg" class="big-picture"/>
            <div class="box-v-section box-justify-center gutter-0">
              <p class="sub-title">Carlos Quimbay Cunalata</p>
              <p class="box-data">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Nihil, temporibus.</p>
            </div>
          </section></a><a href="#" data-fixed="3:52pm" class="box card data-fixed">
          <section class="box-h-section"><img src="https://instagram.feoh1-1.fna.fbcdn.net/t51.2885-19/s150x150/11887148_1617879835152288_232994344_a.jpg" class="big-picture"/>
            <div class="box-v-section box-justify-center gutter-0">
              <p class="sub-title">Stephanie Domínguez</p>
              <p class="box-data">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Nihil, temporibus.</p>
            </div>
          </section></a>
      </div>
      <div name="21/04/2017" class="separator"></div>
      <div class="box-group"><a href="#" data-fixed="3:52pm" class="box card data-fixed">
          <section class="box-h-section"><img src="https://instagram.feoh1-1.fna.fbcdn.net/t51.2885-19/s150x150/15803548_1860855724157140_2949620093912350720_a.jpg" class="big-picture"/>
            <div class="box-v-section box-justify-center gutter-0">
              <p class="sub-title">Luis David Zarate</p>
              <p class="box-data">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Nihil, temporibus.</p>
            </div>
          </section></a><a href="#" data-fixed="3:52pm" class="box card data-fixed">
          <section class="box-h-section"><img src="https://instagram.feoh1-1.fna.fbcdn.net/t51.2885-19/s150x150/15625369_1740657899586089_5204408783928819712_a.jpg" class="big-picture"/>
            <div class="box-v-section box-justify-center gutter-0">
              <p class="sub-title">Carlos Eduardo Camacho</p>
              <p class="box-data">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Nihil, temporibus.</p>
            </div>
          </section></a><a href="#" data-fixed="3:52pm" class="box card data-fixed">
          <section class="box-h-section"><img src="https://instagram.feoh1-1.fna.fbcdn.net/t51.2885-19/11410339_857773544301773_1638908020_a.jpg" class="big-picture"/>
            <div class="box-v-section box-justify-center gutter-0">
              <p class="sub-title">Carlos Quimbay Cunalata</p>
              <p class="box-data">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Officia repellat doloremque incidunt qui. Incidunt, dicta.</p>
            </div>
          </section></a><a href="#" data-fixed="3:52pm" class="box card data-fixed">
          <section class="box-h-section"><img src="https://instagram.feoh1-1.fna.fbcdn.net/t51.2885-19/s150x150/15803548_1860855724157140_2949620093912350720_a.jpg" class="big-picture"/>
            <div class="box-v-section box-justify-center gutter-0">
              <p class="sub-title">Luis David Zarate</p>
              <p class="box-data">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Nihil, temporibus.</p>
            </div>
          </section></a><a href="#" data-fixed="3:52pm" class="box card data-fixed">
          <section class="box-h-section"><img src="https://instagram.feoh1-1.fna.fbcdn.net/t51.2885-19/s150x150/15625369_1740657899586089_5204408783928819712_a.jpg" class="big-picture"/>
            <div class="box-v-section box-justify-center gutter-0">
              <p class="sub-title">Carlos Eduardo Camacho</p>
              <p class="box-data">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Nihil, temporibus.</p>
            </div>
          </section></a>
      </div>
      <div name="20/04/2017" class="separator"></div>
      <div class="box-group"><a href="#" data-fixed="3:52pm" class="box card data-fixed">
          <section class="box-h-section"><img src="https://instagram.feoh1-1.fna.fbcdn.net/t51.2885-19/s150x150/12825742_1692854517660573_747437461_a.jpg" class="big-picture"/>
            <div class="box-v-section box-justify-center gutter-0">
              <p class="sub-title">Maria Paula Moreno</p>
              <p class="box-data">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Veniam, aliquid.</p>
            </div>
          </section></a><a href="#" data-fixed="3:52pm" class="box card data-fixed">
          <section class="box-h-section"><img src="https://instagram.feoh1-1.fna.fbcdn.net/t51.2885-19/s150x150/15625369_1740657899586089_5204408783928819712_a.jpg" class="big-picture"/>
            <div class="box-v-section box-justify-center gutter-0">
              <p class="sub-title">Carlos Eduardo Camacho</p>
              <p class="box-data">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Nihil, temporibus.</p>
            </div>
          </section></a><a href="#" data-fixed="3:52pm" class="box card data-fixed">
          <section class="box-h-section"><img src="https://instagram.feoh1-1.fna.fbcdn.net/t51.2885-19/11410339_857773544301773_1638908020_a.jpg" class="big-picture"/>
            <div class="box-v-section box-justify-center gutter-0">
              <p class="sub-title">Carlos Quimbay Cunalata</p>
              <p class="box-data">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Nihil, temporibus.</p>
            </div>
          </section></a><a href="#" data-fixed="3:52pm" class="box card data-fixed">
          <section class="box-h-section"><img src="https://instagram.feoh1-1.fna.fbcdn.net/t51.2885-19/11410339_857773544301773_1638908020_a.jpg" class="big-picture"/>
            <div class="box-v-section box-justify-center gutter-0">
              <p class="sub-title">Carlos Quimbay Cunalata</p>
              <p class="box-data">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Nihil, temporibus.</p>
            </div>
          </section></a><a href="#" data-fixed="3:52pm" class="box card data-fixed">
          <section class="box-h-section"><img src="https://instagram.feoh1-1.fna.fbcdn.net/t51.2885-19/s150x150/15803548_1860855724157140_2949620093912350720_a.jpg" class="big-picture"/>
            <div class="box-v-section box-justify-center gutter-0">
              <p class="sub-title">Luis David Zarate</p>
              <p class="box-data">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Nihil, temporibus.</p>
            </div>
          </section></a><a href="#" data-fixed="3:52pm" class="box card data-fixed">
          <section class="box-h-section"><img src="https://instagram.feoh1-1.fna.fbcdn.net/t51.2885-19/11410339_857773544301773_1638908020_a.jpg" class="big-picture"/>
            <div class="box-v-section box-justify-center gutter-0">
              <p class="sub-title">Carlos Quimbay Cunalata</p>
              <p class="box-data">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Nihil, temporibus.</p>
            </div>
          </section></a><a href="#" data-fixed="3:52pm" class="box card data-fixed">
          <section class="box-h-section"><img src="https://instagram.feoh1-1.fna.fbcdn.net/t51.2885-19/s150x150/15803548_1860855724157140_2949620093912350720_a.jpg" class="big-picture"/>
            <div class="box-v-section box-justify-center gutter-0">
              <p class="sub-title">Luis David Zarate</p>
              <p class="box-data">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Nihil, temporibus.</p>
            </div>
          </section></a>
      </div>
    </div>
    <footer class="footer">
      <div class="copyright">Copyright &copy; 2017 - Iluminame.co - Todos los derechos reservados a sus respectivos dueños</div>
      <div class="github-link"><a href="https://github.com/juanmsl/Iluminame" class="ilm-github">View Source</a></div>
    </footer>
  </body>
  <script src="js/jquery.js"></script>
  <!--script(src="js/viewport-size.js")-->
  <script src="js/form.js"></script>
  <script src="js/navbar.js"></script>
  <script src="js/scripts.js"></script>
</html>