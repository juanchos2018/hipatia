<!DOCTYPE html>
<html lang="es">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="author" content="Patricio Moncayo">
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
      <div class="login-box flipped">
        <form id="formCambiarPass" name="formCambiarPass" class="forget-form" action="">
          <input type="hidden" id="idUsuario" name="idUsuario" value="<?= $data['idpersona'] ?>">
          <input type="hidden" id="perfil" name="perfil" value="<?= $data['perfil'] ?>">
          <input type="hidden" id="email" name="email" value="<?= $data['email'] ?>">
          <input type="hidden" id="token" name="token" value="<?= $data['token'] ?>">
          <h3 class="login-head"><i class="fas fa-key"></i>  Cambiar Contraseña</h3>
          <div class="form-group">
            <label>Nueva Contraseña</label>
            <input id="txtPassword" name="txtPassword" class="form-control" type="password" placeholder="*" required>
          </div>

          <div class="form-group">
            <label>Confirmar Contraseña</label>
            <input id="txtPasswordConfirm" name="txtPasswordConfirm" class="form-control" type="password" placeholder="*" required>
          </div>

          <div class="form-group btn-container">
            <button type="submit" class="btn btn-primary btn-block"><i class="fas fa-key fa-lg fa-fw"></i> Cambiar clave</button>
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