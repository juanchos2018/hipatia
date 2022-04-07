    <!-- Sidebar menu-->
    <div class="app-sidebar__overlay" data-toggle="collapse"></div>
    <aside class="app-sidebar">
      <div class="app-sidebar__user"><img class="app-sidebar__user-avatar" src="<?= media(); ?>images/avatar.png" alt="User Image">
        <div>
          <p class="app-sidebar__user-name" style="font-size: 0.778rem; line-height: 1.2;"><?= $_SESSION['userData']['USU_NM']; ?></p>
          <p class="app-sidebar__user-designation"><small><?= $_SESSION['userData']['rol_name']; ?></small></p>
        </div>
      </div>

      <?php
      $rol = $_SESSION['userData']['rol_id'];
      ?>

      <ul class="app-menu">
        <li>
          <a class="app-menu__item" href="<?= base_url(); ?>Dashboard">
            <i class="app-menu__icon fa fa-graduation-cap"></i>
            <span class="app-menu__label">Académico</span>
          </a>
        </li>

        <?php if(!empty($_SESSION['permisos'][20]['r'])){ ?>
        <li>
          <a class="app-menu__item" href="<?= base_url(); ?>Widgets">
            <i class="app-menu__icon fas fa-chart-bar"></i>
            <span class="app-menu__label">Widgets</span>
          </a>
        </li>
        <?php } ?>

        <?php if($_SESSION['Sosten'] == 4 OR $_SESSION['Sosten'] == 5){ ?>
        <li>
          <a class="app-menu__item" href="<?= base_url(); ?>Dashacoun">
            <i class="app-menu__icon fas fa-coins"></i>
            <span class="app-menu__label">Financiero</span>
          </a>
        </li>
        <?php } ?>

        <li>
          <a class="app-menu__item" href="<?= base_url(); ?>logout">
            <i class="app-menu__icon fa fa-sign-out"></i>
            <span class="app-menu__label">Salir</span>
          </a>
        </li>
        
      </ul>
    </aside>