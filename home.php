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
  <body>
    <nav id="main-navbar" class="navbar"><a href="home.html"><img src="resources/images/icon.png" class="logo"/></a><a href="home.html" class="logo-title">Ilumíname</a>
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
            <section class="profile-widget-userinfo"><a href="profile.html" class="title">Juan Manuel Sánchez</a><a href="profile.html" class="user-id">juanmsl_pk</a>
              <p counter="23" class="profile-widget-followers"></p>
            </section><a href="#" class="profile-widget-configIcon ilm-configuration"></a>
          </section>
          <section class="user-description">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Neque dolor reiciendis enim id consequatur sapiente.</section>
        </section>
        <section class="profile-widget-notifications"><a href="notifications.html" counter="2" class="profile-widget-section ilm-notification active">Notificaciones</a><a href="messages.html" counter="4" class="profile-widget-section ilm-chat active">Mensajes</a><a href="my-tutories.html" counter="4" class="profile-widget-section ilm-my-tutories active">Mis monitorias</a><a href="users.html" counter="53" class="profile-widget-section ilm-users">Usuarios que sigo</a><a href="subjects.html" counter="3" class="profile-widget-section ilm-subject">Materias</a><a href="tutories.html" counter="3" class="profile-widget-section ilm-tutories active">Monitorias pendientes</a><a href="index.html" class="profile-widget-logout ilm-logout">Cerrar sesión</a></section>
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
        <section class="navbar-notifications"></section><a href="messages.html" class="navbar-more">Ver todo</a>
      </section>
      <section id="notification" class="navbar-boxNotification">
        <label class="title">Notificaciones</label>
        <section class="navbar-notifications"></section><a href="notifications.html" class="navbar-more">Ver todo</a>
      </section>
    </nav>
    <div class="mainContent">
      <div class="box-group">
        <section class="box card"><a href="#" class="box-h-section box-header"><img src="https://instagram.feoh1-1.fna.fbcdn.net/t51.2885-19/s150x150/12825742_1692854517660573_747437461_a.jpg" class="picture"/>
            <div class="box-v-section box-justify-center gutter-0">
              <p class="sub-title">Pensamiento algoritmico</p>
              <p>Maria Paula Moreno</p>
            </div></a>
          <section class="box-v-section">
            <p name="Lugar: " class="box-data">Edificio Baron - Salón 402</p>
            <p name="Fecha: " class="box-data">22/04/2017</p>
            <p name="Duración: " class="box-data">9:00pm - 10:00pm</p>
            <p name="Precio por estudiante: " class="box-data">$40.000</p>
          </section>
          <section class="box-v-section box-footer box-align-center">
            <p class="box-data">2/5 personas</p>
            <button class="join-button">Deseo unirme</button>
          </section>
        </section>
        <section class="box card"><a href="#" class="box-h-section box-header"><img src="https://instagram.feoh1-1.fna.fbcdn.net/t51.2885-19/11410339_857773544301773_1638908020_a.jpg" class="picture"/>
            <div class="box-v-section box-justify-center gutter-0">
              <p class="sub-title">Lenguajes de programación</p>
              <p>Carlos Quimbay Cunalata</p>
            </div></a>
          <section class="box-v-section">
            <p name="Lugar: " class="box-data">Edificio Baron - Salón 402</p>
            <p name="Fecha: " class="box-data">22/04/2017</p>
            <p name="Duración: " class="box-data">9:00pm - 10:00pm</p>
            <p name="Precio por estudiante: " class="box-data">$40.000</p>
          </section>
          <section class="box-v-section box-footer box-align-center">
            <p class="box-data">5/5 personas</p>
            <button class="full-button">Monitoria llena</button>
          </section>
        </section>
        <section class="box card"><a href="#" class="box-h-section box-header"><img src="https://instagram.feoh1-1.fna.fbcdn.net/t51.2885-19/11809532_1484827938495184_412409702_a.jpg" class="picture"/>
            <div class="box-v-section box-justify-center gutter-0">
              <p class="sub-title">Analisis de algoritmos</p>
              <p>José Domínguez</p>
            </div></a>
          <section class="box-v-section">
            <p name="Lugar: " class="box-data">Edificio Baron - Salón 402</p>
            <p name="Fecha: " class="box-data">22/04/2017</p>
            <p name="Duración: " class="box-data">9:00pm - 10:00pm</p>
            <p name="Precio por estudiante: " class="box-data">$40.000</p>
          </section>
          <section class="box-v-section box-footer box-align-center">
            <p class="box-data">1/5 personas</p>
            <button class="leave-button">Abandonar monitoria</button>
          </section>
        </section>
        <section class="box card"><a href="#" class="box-h-section box-header"><img src="https://instagram.feoh1-1.fna.fbcdn.net/t51.2885-19/s150x150/15803548_1860855724157140_2949620093912350720_a.jpg" class="picture"/>
            <div class="box-v-section box-justify-center gutter-0">
              <p class="sub-title">Ingenieria de software</p>
              <p>Luis David Zarate</p>
            </div></a>
          <section class="box-v-section">
            <p name="Lugar: " class="box-data">Edificio Baron - Salón 402</p>
            <p name="Fecha: " class="box-data">22/04/2017</p>
            <p name="Duración: " class="box-data">9:00pm - 10:00pm</p>
            <p name="Precio por estudiante: " class="box-data">$40.000</p>
          </section>
          <section class="box-v-section box-footer box-align-center">
            <p class="box-data">2/5 personas</p>
            <button class="leave-button">Abandonar monitoria</button>
          </section>
        </section>
        <section class="box card"><a href="#" class="box-h-section box-header"><img src="https://instagram.feoh1-1.fna.fbcdn.net/t51.2885-19/s150x150/12825742_1692854517660573_747437461_a.jpg" class="picture"/>
            <div class="box-v-section box-justify-center gutter-0">
              <p class="sub-title">Pensamiento algoritmico</p>
              <p>Maria Paula Moreno</p>
            </div></a>
          <section class="box-v-section">
            <p name="Lugar: " class="box-data">Edificio Baron - Salón 402</p>
            <p name="Fecha: " class="box-data">22/04/2017</p>
            <p name="Duración: " class="box-data">9:00pm - 10:00pm</p>
            <p name="Precio por estudiante: " class="box-data">$40.000</p>
          </section>
          <section class="box-v-section box-footer box-align-center">
            <p class="box-data">3/3 personas</p>
            <button class="leave-button">Abandonar monitoria</button>
          </section>
        </section>
        <section class="box card"><a href="#" class="box-h-section box-header"><img src="https://instagram.feoh1-1.fna.fbcdn.net/t51.2885-19/11410339_857773544301773_1638908020_a.jpg" class="picture"/>
            <div class="box-v-section box-justify-center gutter-0">
              <p class="sub-title">Lenguajes de programación</p>
              <p>Carlos Quimbay Cunalata</p>
            </div></a>
          <section class="box-v-section">
            <p name="Lugar: " class="box-data">Edificio Baron - Salón 402</p>
            <p name="Fecha: " class="box-data">22/04/2017</p>
            <p name="Duración: " class="box-data">9:00pm - 10:00pm</p>
            <p name="Precio por estudiante: " class="box-data">$40.000</p>
          </section>
          <section class="box-v-section box-footer box-align-center">
            <p class="box-data">2/5 personas</p>
            <button class="join-button">Deseo unirme</button>
          </section>
        </section>
        <section class="box card"><a href="#" class="box-h-section box-header"><img src="https://instagram.feoh1-1.fna.fbcdn.net/t51.2885-19/11809532_1484827938495184_412409702_a.jpg" class="picture"/>
            <div class="box-v-section box-justify-center gutter-0">
              <p class="sub-title">Analisis de algoritmos</p>
              <p>José Domínguez</p>
            </div></a>
          <section class="box-v-section">
            <p name="Lugar: " class="box-data">Edificio Baron - Salón 402</p>
            <p name="Fecha: " class="box-data">22/04/2017</p>
            <p name="Duración: " class="box-data">9:00pm - 10:00pm</p>
            <p name="Precio por estudiante: " class="box-data">$40.000</p>
          </section>
          <section class="box-v-section box-footer box-align-center">
            <p class="box-data">2/3 personas</p>
            <button class="join-button">Deseo unirme</button>
          </section>
        </section>
        <section class="box card"><a href="#" class="box-h-section box-header"><img src="https://instagram.feoh1-1.fna.fbcdn.net/t51.2885-19/s150x150/15803548_1860855724157140_2949620093912350720_a.jpg" class="picture"/>
            <div class="box-v-section box-justify-center gutter-0">
              <p class="sub-title">Ingenieria de software</p>
              <p>Luis David Zarate</p>
            </div></a>
          <section class="box-v-section">
            <p name="Lugar: " class="box-data">Edificio Baron - Salón 402</p>
            <p name="Fecha: " class="box-data">22/04/2017</p>
            <p name="Duración: " class="box-data">9:00pm - 10:00pm</p>
            <p name="Precio por estudiante: " class="box-data">$40.000</p>
          </section>
          <section class="box-v-section box-footer box-align-center">
            <p class="box-data">3/3 personas</p>
            <button class="full-button">Monitoria llena</button>
          </section>
        </section>
        <section class="box card"><a href="#" class="box-h-section box-header"><img src="https://instagram.feoh1-1.fna.fbcdn.net/t51.2885-19/11809532_1484827938495184_412409702_a.jpg" class="picture"/>
            <div class="box-v-section box-justify-center gutter-0">
              <p class="sub-title">Analisis de algoritmos</p>
              <p>José Domínguez</p>
            </div></a>
          <section class="box-v-section">
            <p name="Lugar: " class="box-data">Edificio Baron - Salón 402</p>
            <p name="Fecha: " class="box-data">22/04/2017</p>
            <p name="Duración: " class="box-data">9:00pm - 10:00pm</p>
            <p name="Precio por estudiante: " class="box-data">$40.000</p>
          </section>
          <section class="box-v-section box-footer box-align-center">
            <p class="box-data">1/5 personas</p>
            <button class="leave-button">Abandonar monitoria</button>
          </section>
        </section>
        <section class="box card"><a href="#" class="box-h-section box-header"><img src="https://instagram.feoh1-1.fna.fbcdn.net/t51.2885-19/s150x150/15803548_1860855724157140_2949620093912350720_a.jpg" class="picture"/>
            <div class="box-v-section box-justify-center gutter-0">
              <p class="sub-title">Ingenieria de software</p>
              <p>Luis David Zarate</p>
            </div></a>
          <section class="box-v-section">
            <p name="Lugar: " class="box-data">Edificio Baron - Salón 402</p>
            <p name="Fecha: " class="box-data">22/04/2017</p>
            <p name="Duración: " class="box-data">9:00pm - 10:00pm</p>
            <p name="Precio por estudiante: " class="box-data">$40.000</p>
          </section>
          <section class="box-v-section box-footer box-align-center">
            <p class="box-data">2/5 personas</p>
            <button class="leave-button">Abandonar monitoria</button>
          </section>
        </section>
        <section class="box card"><a href="#" class="box-h-section box-header"><img src="https://instagram.feoh1-1.fna.fbcdn.net/t51.2885-19/s150x150/12825742_1692854517660573_747437461_a.jpg" class="picture"/>
            <div class="box-v-section box-justify-center gutter-0">
              <p class="sub-title">Pensamiento algoritmico</p>
              <p>Maria Paula Moreno</p>
            </div></a>
          <section class="box-v-section">
            <p name="Lugar: " class="box-data">Edificio Baron - Salón 402</p>
            <p name="Fecha: " class="box-data">22/04/2017</p>
            <p name="Duración: " class="box-data">9:00pm - 10:00pm</p>
            <p name="Precio por estudiante: " class="box-data">$40.000</p>
          </section>
          <section class="box-v-section box-footer box-align-center">
            <p class="box-data">3/3 personas</p>
            <button class="leave-button">Abandonar monitoria</button>
          </section>
        </section>
        <section class="box card"><a href="#" class="box-h-section box-header"><img src="https://instagram.feoh1-1.fna.fbcdn.net/t51.2885-19/11410339_857773544301773_1638908020_a.jpg" class="picture"/>
            <div class="box-v-section box-justify-center gutter-0">
              <p class="sub-title">Lenguajes de programación</p>
              <p>Carlos Quimbay Cunalata</p>
            </div></a>
          <section class="box-v-section">
            <p name="Lugar: " class="box-data">Edificio Baron - Salón 402</p>
            <p name="Fecha: " class="box-data">22/04/2017</p>
            <p name="Duración: " class="box-data">9:00pm - 10:00pm</p>
            <p name="Precio por estudiante: " class="box-data">$40.000</p>
          </section>
          <section class="box-v-section box-footer box-align-center">
            <p class="box-data">2/5 personas</p>
            <button class="join-button">Deseo unirme</button>
          </section>
        </section>
        <section class="box card"><a href="#" class="box-h-section box-header"><img src="https://instagram.feoh1-1.fna.fbcdn.net/t51.2885-19/11809532_1484827938495184_412409702_a.jpg" class="picture"/>
            <div class="box-v-section box-justify-center gutter-0">
              <p class="sub-title">Analisis de algoritmos</p>
              <p>José Domínguez</p>
            </div></a>
          <section class="box-v-section">
            <p name="Lugar: " class="box-data">Edificio Baron - Salón 402</p>
            <p name="Fecha: " class="box-data">22/04/2017</p>
            <p name="Duración: " class="box-data">9:00pm - 10:00pm</p>
            <p name="Precio por estudiante: " class="box-data">$40.000</p>
          </section>
          <section class="box-v-section box-footer box-align-center">
            <p class="box-data">2/3 personas</p>
            <button class="join-button">Deseo unirme</button>
          </section>
        </section>
        <section class="box card"><a href="#" class="box-h-section box-header"><img src="https://instagram.feoh1-1.fna.fbcdn.net/t51.2885-19/s150x150/15803548_1860855724157140_2949620093912350720_a.jpg" class="picture"/>
            <div class="box-v-section box-justify-center gutter-0">
              <p class="sub-title">Ingenieria de software</p>
              <p>Luis David Zarate</p>
            </div></a>
          <section class="box-v-section">
            <p name="Lugar: " class="box-data">Edificio Baron - Salón 402</p>
            <p name="Fecha: " class="box-data">22/04/2017</p>
            <p name="Duración: " class="box-data">9:00pm - 10:00pm</p>
            <p name="Precio por estudiante: " class="box-data">$40.000</p>
          </section>
          <section class="box-v-section box-footer box-align-center">
            <p class="box-data">3/3 personas</p>
            <button class="full-button">Monitoria llena</button>
          </section>
        </section>
        <section class="box card"><a href="#" class="box-h-section box-header"><img src="https://instagram.feoh1-1.fna.fbcdn.net/t51.2885-19/11809532_1484827938495184_412409702_a.jpg" class="picture"/>
            <div class="box-v-section box-justify-center gutter-0">
              <p class="sub-title">Analisis de algoritmos</p>
              <p>José Domínguez</p>
            </div></a>
          <section class="box-v-section">
            <p name="Lugar: " class="box-data">Edificio Baron - Salón 402</p>
            <p name="Fecha: " class="box-data">22/04/2017</p>
            <p name="Duración: " class="box-data">9:00pm - 10:00pm</p>
            <p name="Precio por estudiante: " class="box-data">$40.000</p>
          </section>
          <section class="box-v-section box-footer box-align-center">
            <p class="box-data">1/5 personas</p>
            <button class="leave-button">Abandonar monitoria</button>
          </section>
        </section>
        <section class="box card"><a href="#" class="box-h-section box-header"><img src="https://instagram.feoh1-1.fna.fbcdn.net/t51.2885-19/s150x150/15803548_1860855724157140_2949620093912350720_a.jpg" class="picture"/>
            <div class="box-v-section box-justify-center gutter-0">
              <p class="sub-title">Ingenieria de software</p>
              <p>Luis David Zarate</p>
            </div></a>
          <section class="box-v-section">
            <p name="Lugar: " class="box-data">Edificio Baron - Salón 402</p>
            <p name="Fecha: " class="box-data">22/04/2017</p>
            <p name="Duración: " class="box-data">9:00pm - 10:00pm</p>
            <p name="Precio por estudiante: " class="box-data">$40.000</p>
          </section>
          <section class="box-v-section box-footer box-align-center">
            <p class="box-data">2/5 personas</p>
            <button class="leave-button">Abandonar monitoria</button>
          </section>
        </section>
        <section class="box card"><a href="#" class="box-h-section box-header"><img src="https://instagram.feoh1-1.fna.fbcdn.net/t51.2885-19/s150x150/12825742_1692854517660573_747437461_a.jpg" class="picture"/>
            <div class="box-v-section box-justify-center gutter-0">
              <p class="sub-title">Pensamiento algoritmico</p>
              <p>Maria Paula Moreno</p>
            </div></a>
          <section class="box-v-section">
            <p name="Lugar: " class="box-data">Edificio Baron - Salón 402</p>
            <p name="Fecha: " class="box-data">22/04/2017</p>
            <p name="Duración: " class="box-data">9:00pm - 10:00pm</p>
            <p name="Precio por estudiante: " class="box-data">$40.000</p>
          </section>
          <section class="box-v-section box-footer box-align-center">
            <p class="box-data">3/3 personas</p>
            <button class="leave-button">Abandonar monitoria</button>
          </section>
        </section>
        <section class="box card"><a href="#" class="box-h-section box-header"><img src="https://instagram.feoh1-1.fna.fbcdn.net/t51.2885-19/11410339_857773544301773_1638908020_a.jpg" class="picture"/>
            <div class="box-v-section box-justify-center gutter-0">
              <p class="sub-title">Lenguajes de programación</p>
              <p>Carlos Quimbay Cunalata</p>
            </div></a>
          <section class="box-v-section">
            <p name="Lugar: " class="box-data">Edificio Baron - Salón 402</p>
            <p name="Fecha: " class="box-data">22/04/2017</p>
            <p name="Duración: " class="box-data">9:00pm - 10:00pm</p>
            <p name="Precio por estudiante: " class="box-data">$40.000</p>
          </section>
          <section class="box-v-section box-footer box-align-center">
            <p class="box-data">2/5 personas</p>
            <button class="join-button">Deseo unirme</button>
          </section>
        </section>
        <section class="box card"><a href="#" class="box-h-section box-header"><img src="https://instagram.feoh1-1.fna.fbcdn.net/t51.2885-19/11809532_1484827938495184_412409702_a.jpg" class="picture"/>
            <div class="box-v-section box-justify-center gutter-0">
              <p class="sub-title">Analisis de algoritmos</p>
              <p>José Domínguez</p>
            </div></a>
          <section class="box-v-section">
            <p name="Lugar: " class="box-data">Edificio Baron - Salón 402</p>
            <p name="Fecha: " class="box-data">22/04/2017</p>
            <p name="Duración: " class="box-data">9:00pm - 10:00pm</p>
            <p name="Precio por estudiante: " class="box-data">$40.000</p>
          </section>
          <section class="box-v-section box-footer box-align-center">
            <p class="box-data">2/3 personas</p>
            <button class="join-button">Deseo unirme</button>
          </section>
        </section>
        <section class="box card"><a href="#" class="box-h-section box-header"><img src="https://instagram.feoh1-1.fna.fbcdn.net/t51.2885-19/s150x150/15803548_1860855724157140_2949620093912350720_a.jpg" class="picture"/>
            <div class="box-v-section box-justify-center gutter-0">
              <p class="sub-title">Ingenieria de software</p>
              <p>Luis David Zarate</p>
            </div></a>
          <section class="box-v-section">
            <p name="Lugar: " class="box-data">Edificio Baron - Salón 402</p>
            <p name="Fecha: " class="box-data">22/04/2017</p>
            <p name="Duración: " class="box-data">9:00pm - 10:00pm</p>
            <p name="Precio por estudiante: " class="box-data">$40.000</p>
          </section>
          <section class="box-v-section box-footer box-align-center">
            <p class="box-data">3/3 personas</p>
            <button class="full-button">Monitoria llena</button>
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
  <script src="js/viewport-size.js"></script>
  <script src="js/form.js"></script>
  <script src="js/navbar.js"></script>
  <script src="js/scripts.js"></script>
</html>