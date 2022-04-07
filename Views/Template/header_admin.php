<!DOCTYPE html>
<html lang="en">
  <head>
        <meta charset="utf-8">
        <meta name="description" content="Appi">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta name="author" content="">
        <meta name="theme-color" content="#009688">
        <link rel="shortcut icon" href="<?= media(); ?>images/vs5.ico">
        <title><?= $data['page_tag'] ?></title>
        
        <!-- Main CSS-->
        <link rel="stylesheet" type="text/css" href="<?= media(); ?>css/main.css">
        <link rel="stylesheet" type="text/css" href="<?= media(); ?>css/bootstrap-select.min.css">

        <link rel="stylesheet" type="text/css" href="<?= media(); ?>css/style.css">
        <link rel="stylesheet" type="text/css" href="<?= media(); ?>css/factura.css">
        
        <!-- CSS requeridos paara Filtros: SEARCH PANES -->
        <link rel="stylesheet" type="text/css" href="<?= media(); ?>css/jquery.dataTables.min.css">
        <link rel="stylesheet" type="text/css" href="<?= media(); ?>css/searchPanes.dataTables.min.css">
        <link rel="stylesheet" type="text/css" href="<?= media(); ?>css/select.dataTables.min.css">

        <link rel="stylesheet" type="text/css" href="<?= media(); ?>css/buttons.dataTables.min.css">

        <link rel="stylesheet" type="text/css" href="<?= media(); ?>css/responsive.dataTables.min.css">
  </head>
  
  <body class="app sidebar-mini">
    <!-- Navbar-->
    <header class="app-header"><a class="app-header__logo" href="<?= base_url(); ?>dashboard">&#9400 Appi</a>
      <!-- Sidebar toggle button--><a class="app-sidebar__toggle" href="#" data-toggle="sidebar" aria-label="Hide Sidebar"></a>
      <h6 class="pt-3" style="color:#fff"><small></small></h6>
      <!-- Navbar Right Menu-->
      <ul class="app-nav">
        
        <!-- User Menu-->
        <li class="dropdown"><a class="app-nav__item" href="#" data-toggle="dropdown" aria-label="Open Profile Menu"><i class="fa fa-user fa-lg"></i></a>
          <ul class="dropdown-menu settings-menu dropdown-menu-right">
            <?php if(!empty($_SESSION['permisos'][17]['r'])){ ?>
                <li><a class="dropdown-item" href="<?= base_url(); ?>Vsdefaul"><i class="fa fa-cog fa-lg"></i> Parámetro Académico</a></li>
                <li><a class="dropdown-item" href="<?= base_url(); ?>Vssecuen"><i class="fa fa-cog fa-lg"></i> Parámetro Financiero</a></li>
<!--            <li><a class="dropdown-item" href="<?= base_url(); ?>Vsstdhis"><i class="fa fa-user fa-lg"></i> Registros</a></li>-->
            <?php } ?>

            <?php if(!empty($_SESSION['permisos'][18]['r'])){ ?>
                <li><a class="dropdown-item" href="<?= base_url(); ?>Vstables"><i class="fa fa-cog fa-lg"></i> Tablas</a></li>
            <?php } ?>

            <?php if(!empty($_SESSION['permisos'][19]['r'])){ ?>
                <li><a class="dropdown-item" href="<?= base_url(); ?>Usuarios"><i class="fa fa-user fa-lg"></i> Usuarios</a></li>
                <li><a class="dropdown-item" href="<?= base_url(); ?>Roles"><i class="fas fa-user-tag fa-lg"></i> Roles</a></li>
            <?php } ?> 

            <li><a class="dropdown-item" href="<?= base_url(); ?>Logout"><i class="fa fa-sign-out fa-lg"></i> Salir</a></li>
          </ul>
        </li>
      </ul>
    </header>

    <!-- Menu SideBar -->
    <?php require_once("nav_admin.php"); ?>
