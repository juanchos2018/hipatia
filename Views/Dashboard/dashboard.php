
<?php headerAdmin($data); ?>

<main class="app-content">
      <div class="app-title">
        <div>
          <h1><i class="fa fa-graduation-cap"></i> <?= $data['page_title'] ?></h1>
        </div>
        <ul class="app-breadcrumb breadcrumb">
          <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
          <li class="breadcrumb-item"><a href="<?= base_url(); ?>dashboard">Appi</a></li>
        </ul>
      </div>
      <div class="row">
        <div class="col-md-12">
          <div class="tile">

            <?php if($_SESSION['permisosMod']['r']){ ?>
              <div class="tile-body text-center">Seleccione un Icono</div>
            <?php }else{ ?>
              <div class="tile-body"><p class="text-primary text-center">Acceso Restringido !</p></div>
            <?php } ?>

            <?php $_SESSION['userData']; ?>
          </div>
        </div>
      </div>
      
      <!-- Permiso para Visualizar todo el DASHBOARD -->
      <?php if(!empty($_SESSION['permisos'][1]['r'])){ ?>
      <div class="row">

        <?php if(!empty($_SESSION['permisos'][3]['r'])){ ?>
        <div class="col-md-6 col-lg-3">
            <div class="widget-small bighead coloured-icon"><i class="icon fas fa-user-friends fa-3x"></i>
                <div class="info">
                    <h4 class="mb-0"><a href="<?= base_url(); ?>Vsection">Sección</a></h4>
                    <p><small><b><?= $data['reg_section'] ?></b> registro(s)</small></p>
                </div>
            </div>
        </div>
        <?php } ?>

        <?php if(!empty($_SESSION['permisos'][4]['r'])){ ?>
        <div class="col-md-6 col-lg-3">
            <div class="widget-small primary coloured-icon"><i class="icon fas fa-book-open fa-3x"></i>
                <div class="info">
                    <h4 class="mb-0"><a href="<?= base_url(); ?>Vsmatter">Asignatura</a></h4>
                    <p><small><b><?= $data['reg_matter'] ?></b> registro(s)</small></p>
                </div>
            </div>
        </div>
        <?php } ?>

        <?php if(!empty($_SESSION['permisos'][5]['r'])){ ?>
        <div class="col-md-6 col-lg-3">
            <div class="widget-small teal coloured-icon"><i class="icon fas fa-user-friends fa-1x"></i>
                <div class="info">
                    <h4 class="mb-0"><a href="<?= base_url(); ?>Vsemplox">Ficha Personal</a></h4>
                    <p><small><b><?= $data['reg_personal'] ?></b> registro(s)</small></p>
                </div>
            </div>
        </div>
        <?php } ?>

        <?php if(!empty($_SESSION['permisos'][6]['r'])){ ?>
        <div class="col-md-6 col-lg-3">
            <div class="widget-small orange coloured-icon"><i class="icon fas fa-book-reader fa-3x"></i>
                <div class="info">
                    <h4 class="mb-0"><a href="<?= base_url(); ?>Vssecmat">Malla Curricular</a></h4>
                    <p><small><b><?= $data['reg_mallac'] ?></b> registro(s)</small></p>
                </div>
            </div>
        </div>
        <?php } ?>

        <?php if(!empty($_SESSION['permisos'][2]['r'])){ ?>
        <?php if($_SESSION['userData']['rol_id'] !=5){ ?>
        <div class="col-md-6 col-lg-3">
            <div class="widget-small indigo coloured-icon"><i class="icon fa fa-graduation-cap fa-3x"></i>
                <div class="info">
                    <h4 class="mb-0"><a href="<?= base_url(); ?>Vsnewstd">Ficha Aspirantes</a></h4>
                    <p><small><b><?= $data['reg_stdasp'] ?></b> registro(s)</small></p>
                </div>
            </div>
        </div>
        <?php } ?>

        <div class="col-md-6 col-lg-3">
            <div class="widget-small blue coloured-icon"><i class="icon fas fa-user-graduate fa-3x"></i>
                <div class="info">
                    <h4 class="mb-0"><a href="<?= base_url(); ?>Vstudent">Ficha Estudiantil</a></h4>
                    <p><small><b><?= $data['reg_student'] ?></b> registro(s)</small></p>
                </div>
            </div>
        </div>
        <?php } ?>

        <?php if(!empty($_SESSION['permisos'][8]['r'])){ ?>
        <div class="col-md-6 col-lg-3">
            <div class="widget-small indigo coloured-icon"><i class="icon fas fa-chalkboard-teacher fa-3x"></i>
                <div class="info">
                    <h4><a href="<?= base_url(); ?>Vschedul">Aula Virtual</a></h4>
                    <p><b></b></p>
                </div>
            </div>
        </div>
        <?php } ?>

        <?php if(!empty($_SESSION['permisos'][7]['r'])){ ?>
        <div class="col-md-6 col-lg-3">
            <div class="widget-small pink coloured-icon"><i class="icon fas fa-user-edit fa-3x"></i>
                <div class="info">
                    <h4><a href="<?= base_url(); ?>Vsabsent">Asistencia</a></h4>
                    <p><b></b></p>
                </div>
            </div>
        </div>

        <div class="col-md-6 col-lg-3">
            <div class="widget-small teal coloured-icon"><i class="icon fas fa-exclamation-triangle fa-3x"></i>
                <div class="info">
                    <h4><a href="<?= base_url(); ?>Vsnotify">Notificaciones</a></h4>
                    <p><b></b></p>
                </div>
            </div>
        </div>
        <?php } ?>

        <?php if(!empty($_SESSION['permisos'][9]['r'])){ ?>
        <div class="col-md-6 col-lg-3">
            <div class="widget-small warning coloured-icon"><i class="icon fas fa-paste fa-3x"></i>
                <div class="info">
                    <h4><a href="<?= base_url(); ?>Vslibstd">Boletines</a></h4>
                </div>
            </div>
        </div>
        <?php } ?>

        <?php if(!empty($_SESSION['permisos'][21]['r'])){ ?>
        <div class="col-md-6 col-lg-3">
            <div class="widget-small warning coloured-icon"><i class="icon fas fa-paste fa-3x"></i>
                <div class="info">
                    <h4><a href="<?= base_url(); ?>Vslibsec">Boletines por Sección</a></h4>
                </div>
            </div>
        </div>
        <?php } ?>

        <?php if(!empty($_SESSION['permisos'][10]['r'])){ ?>
        <div class="col-md-6 col-lg-3">
            <div class="widget-small punyeta coloured-icon"><i class="icon fas fa-scroll fa-1x"></i>
                <div class="info">
                    <h4><a href="<?= base_url(); ?>Vscerstd">Certificados</a></h4>
                </div>
            </div>
        </div>
        <?php } ?>

        <?php if(!empty($_SESSION['permisos'][22]['r'])){ ?>
        <div class="col-md-6 col-lg-3">
            <div class="widget-small punyeta coloured-icon"><i class="icon fas fa-scroll fa-1x"></i>
                <div class="info">
                    <h4><a href="<?= base_url(); ?>Vscersec">Certificados por Sección</a></h4>
                </div>
            </div>
        </div>
        <?php } ?>

        <?php if(!empty($_SESSION['permisos'][11]['r'])){ ?>
        <div class="col-md-6 col-lg-3">
            <div class="widget-small primary coloured-icon"><i class="icon fas fa-file-alt fa-1x"></i>
                <div class="info">
                    <h4><a href="<?= base_url(); ?>Vsactmat">Informe Actas Calificaciones</a></h4>
                </div>
            </div>
        </div>
        <?php } ?>

        <?php if(!empty($_SESSION['permisos'][12]['r'])){ ?>
        <div class="col-md-6 col-lg-3">
            <div class="widget-small olivedrab coloured-icon"><i class="icon far fa-image fa-3x"></i>
                <div class="info">
                    <h4><a href="<?= base_url(); ?>Vsactsec">Informe Cuadros Calificaciones</a></h4>
                    <p><b></b></p>
                </div>
            </div>
        </div>
        <?php } ?>

        <?php if(!empty($_SESSION['permisos'][13]['r'])){ ?>
        <div class="col-md-6 col-lg-3">
            <div class="widget-small darksalmon coloured-icon"><i class="icon fas fa-diagnoses fa-3x"></i>
                <div class="info">
                    <h4><a href="<?= base_url(); ?>Vsexamen">Exámenes</a></h4>
                    <p><b></b></p>
                </div>
            </div>
        </div>
        <?php } ?>

        <?php if(!empty($_SESSION['permisos'][14]['r'])){ ?>
        <div class="col-md-6 col-lg-3">
            <div class="widget-small primary coloured-icon"><i class="icon fas fa-file-alt fa-1x"></i>
                <div class="info">
                    <h4><a href="<?= base_url(); ?>Vsactsav">Registrar Calificaciones</a></h4>
                </div>
            </div>
        </div>
        <?php } ?>

        <?php if(!empty($_SESSION['permisos'][23]['r'])){ ?>
        <div class="col-md-6 col-lg-3">
            <div class="widget-small primary coloured-icon"><i class="icon fas fa-clock fa-1x"></i>
                <div class="info">
                    <h4><a href="<?= base_url(); ?>Vshorary">Horarios</a></h4>
                </div>
            </div>
        </div>
        <?php } ?>

        <?php if(!empty($_SESSION['permisos'][15]['r'])){ ?>
        <div class="col-md-6 col-lg-3">
            <div class="widget-small warning coloured-icon"><i class="icon fas fa-hands fa-3x"></i>
                <div class="info">
                    <h4 class="mb-0"><a href="<?= base_url(); ?>Vsficsoc">Ficha Social</a></h4>  
                    <p><small><b><?= $data['reg_hsocial'] ?></b> registro(s)</small></p>
                </div>
            </div>
        </div>
        <div class="col-md-6 col-lg-3">
            <div class="widget-small khaki coloured-icon"><i class="icon fas fa-grip-vertical fa-3x"></i>
                <div class="info">
                    <h4 class="mb-0"><a href="<?= base_url(); ?>Vssocial">Historia Social</a></h4>  
                    <p><small><b><?= $data['reg_hsocial'] ?></b> registro(s)</small></p>
                </div>
            </div>
        </div>
        <?php } ?>

        <!-- Historia Clinica -->
        <?php if(!empty($_SESSION['permisos'][16]['r'])){ ?>
        <div class="col-md-6 col-lg-3">
            <div class="widget-small danger coloured-icon"><i class="icon fas fa-hand-holding-medical fa-3x"></i>
                <div class="info">
                    <h4 class="mb-0"><a href="<?= base_url(); ?>Vsclinic">Historia Clinica</a></h4>
                    <p><small><b><?= $data['reg_hclinica'] ?></b> registro(s)</small></p>
                </div>
            </div>
        </div>
        <?php } ?>

      </div>
      <?php } ?>

</main>

<?php footerAdmin($data); ?>