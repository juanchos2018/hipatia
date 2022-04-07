<!DOCTYPE html>
<html lang="es">
  <head>
      <meta charset="utf-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
      <meta name="author" content="">
      <meta name="theme-color" content="#009670">
      <link rel="shortcut icon" href="<?= media(); ?>images/vs4.ico">

      <!-- Main CSS-->
      <link rel="stylesheet" type="text/css" href="<?= media(); ?>css/style.css">
      <link rel="stylesheet" type="text/css" href="<?= media(); ?>css/main.css">
    
      <title><?= $data['page_tag']; ?></title>
  </head>
  <body>
      <section class="material-half-bg">
          <div class="cover"></div>
      </section>
      <section class="login-content">
          <div class="logo">
              <h1><?= $data['page_title']; ?></h1>
          </div>
          <div class="login-box">
              <div id="divLoading">
              <div>
                  <img src="<?= media(); ?>images/ajax-loader.gif" alt="Loading">
              </div>
          </div>

          <form class="login-form" id="formLogin" name="formLogin" action="">
              <h3 class="login-head"><i class="fa fa-lg fa-fw fa-user"></i>Inicio de Sesión</h3>
              <div class="form-group">
                  <label class="control-label"></label>
                  <input id="txtUsuario" name="txtUsuario" class="form-control" type="text" placeholder="Usuario" autofocus>
              </div>
              <div class="form-group">
                  <label class="control-label"></label>
                  <input id="txtClave" name="txtClave" class="form-control" type="password" placeholder="Contraseña">
              </div>

              <div class="form-group">
                  <div class="utility">
                      <p class="semibold-text mb-2"><a href="#" data-toggle="flip">Olvidó su contraseña ?</a></p>
<!--                  <p class="semibold-text mb-2"><a href="<?= base_url(); ?>Login/regstd" >Registrar Aspirante</a>-->
                  </div>
              </div>

              <!-- Alerta AJAX-->
              <div id="alertLogin" class="text-center"></div>
                  <div class="form-group btn-container">
                      <button type="submit" class="btn btn-primary btn-block"><i class="fa fa-sign-in fa-lg fa-fw"></i>Ingresar</button>
                  </div>
                  </form>
                      <form id="formRecetPass" name="formRecetPass" class="forget-form" action="">
                      <h3 class="login-head"><i class="fa fa-lg fa-fw fa-lock"></i>Cambio de Contraseña</h3>
                      <div class="form-group">
                          <label class="control-label"></label>
                          <input id="txtEmailReset" name="txtEmailReset" class="form-control" type="email" placeholder="Escriba su correo electrónico">
                      </div>

                      <div class="form-group btn-container">
                          <button type="submit" class="btn btn-primary btn-block"><i class="fa fa-unlock fa-lg fa-fw"></i>Enviar Correo</button>
                      </div>
                      <div class="form-group mt-3">
                          <p class="semibold-text mb-0"><a href="#" data-toggle="flip"><i class="fa fa-angle-left fa-fw"></i> Retornar a Inicio</a></p>
                      </div>
                  </form>
              </div>
      </section>

    <script>
        const base_url = "<?= base_url(); ?>";
    </script>

    <!-- Essential javascripts for application to work-->
    <script src="<?= media(); ?>js/jquery-3.5.1.min.js"></script>
    <script src="<?= media(); ?>js/popper.min.js"></script>
    <script src="<?= media(); ?>js/bootstrap.min.js"></script>
    <script src="<?= media(); ?>js/fontawesome.js"></script>
    <script src="<?= media(); ?>js/main.js"></script>

    <!-- The javascript plugin to display page loading on top-->
    <script src="<?= media(); ?>js/plugins/pace.min.js"></script>
    <script type="text/javascript" src="<?= media(); ?>js/plugins/sweetalert.min.js"></script>

    <script src="<?= media(); ?>js/<?= $data['page_functions_js']; ?>"></script>
  </body>
</html>