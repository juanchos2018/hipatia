
<?php headerAdmin($data); ?>

<main class="app-content">
      <div class="app-title">
        <div>
          <h1><i class="fas fa-coins"></i> <?= $data['page_title'] ?></h1>
          
        </div>
        <ul class="app-breadcrumb breadcrumb">
          <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
          <li class="breadcrumb-item"><a href="<?= base_url(); ?>dashboard">APPI</a></li>
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
      
      <!-- TESORERIA -->
      <div class="row">
          <?php if(!empty($_SESSION['permisos'][30]['r'])){ ?>
          <div class="col-md-6 col-lg-3">  
              <div onclick="" class="widget-small info coloured-icon"><i class="icon fas fa-briefcase fa-3x"></i>
                   <div class="info">
                      <h4><a href="<?= base_url(); ?>Vsproduc">Portafolio de Servicios</a></h4>
                      <p><b></b></p>
                  </div>
                </div>
          </div>
          <?php } ?>

          <?php if(!empty($_SESSION['permisos'][31]['r'])){ ?>
          <div class="col-md-6 col-lg-3">
              <div class="widget-small bighead coloured-icon"><i class="icon fas fa-hand-holding-usd fa-3x"></i>
                  <div class="info">
                      <h4><a href="<?= base_url(); ?>Vssecval">Valores por Servicios</a></h4>
                      <p><b></b></p>
                  </div>
              </div>
          </div>
          <?php } ?>

          <?php if(!empty($_SESSION['permisos'][32]['r'])){ ?>
          <div class="col-md-6 col-lg-3">
              <div class="widget-small warning coloured-icon"><i class="icon fas fa-user-graduate fa-3x"></i>
                  <div class="info">
                      <h4><a href="<?= base_url(); ?>Vstariff">Convenios y Cuentas por Cobrar</a></h4>
                      <p><b></b></p>
                  </div>
              </div>
          </div>
          <?php } ?>

          <?php if(!empty($_SESSION['permisos'][33]['r'])){ ?>
          <div class="col-md-6 col-lg-3">
              <div class="widget-small danger coloured-icon"><i class="icon fas fa-file-invoice fa-3x"></i>
                  <div class="info">
                      <h4><a href="<?= base_url(); ?>Vsbillin">Facturación</a></h4>
                      <p><b></b></p>
                  </div>
              </div>
          </div>
          <?php } ?>

          <!-- RECURSOS HUMANOS -->
          <?php if(!empty($_SESSION['permisos'][34]['r'])){ ?>
          <div class="col-md-6 col-lg-3">
              <div class="widget-small blue coloured-icon"><i class="icon fas fa-id-card fa-1x"></i>
                  <div class="info">
                      <h4><a href="<?= base_url(); ?>Vsrolrub">Rubros Nómina</a></h4>
                      <p><b></b></p>
                  </div>
              </div>
          </div>
          <?php } ?>

          <?php if(!empty($_SESSION['permisos'][5]['r'])){ ?>
          <div class="col-md-6 col-lg-3">
              <div class="widget-small teal coloured-icon"><i class="icon fas fa-user-friends fa-1x"></i>
                  <div class="info">
                      <h4><a href="<?= base_url(); ?>Vsemplox">Ficha Personal</a></h4>
                      <p><b></b></p>
                  </div>
              </div>
          </div>
          <?php } ?>

          <?php if(!empty($_SESSION['permisos'][36]['r'])){ ?>
          <div class="col-md-6 col-lg-3">
              <div class="widget-small pink coloured-icon"><i class="icon fas fa-donate fa-1x"></i>
                  <div class="info">
                      <h4><a href="<?= base_url(); ?>Vsempcre">Créditos al Personal</a></h4>
                      <p><b></b></p>
                  </div>
              </div>
          </div>
          <?php } ?>

          <?php if(!empty($_SESSION['permisos'][37]['r'])){ ?>
          <div class="col-md-6 col-lg-3">
              <div class="widget-small orange coloured-icon"><i class="icon fas fa-money-check-alt fa-1x"></i>
                  <div class="info">
                      <h4><a href="<?= base_url(); ?>Vsrolpay">Rol de Pago</a></h4>
                      <p><b></b></p>
                  </div>
              </div>
          </div>
          <?php } ?>

          <!-- CUENTAS POR PAGAR -->
          <?php if(!empty($_SESSION['permisos'][38]['r'])){ ?>
          <div class="col-md-6 col-lg-3">
              <div class="widget-small darksalmon coloured-icon"><i class="icon fas fa-piggy-bank"></i>
                  <div class="info">
                      <h4><a href="<?= base_url(); ?>Vsbanker">Ficha Entidades Financieras</a></h4>
                      <p><b></b></p>
                  </div>
              </div>
          </div>
          <?php } ?>

          <?php if(!empty($_SESSION['permisos'][39]['r'])){ ?>
          <div class="col-md-6 col-lg-3">
              <div class="widget-small sienna coloured-icon"><i class="icon fas fa-book fa-1x"></i>
                  <div class="info">
                      <h4><a href="<?= base_url(); ?>Vsmovban">Libro Banco</a></h4>
                      <p><b></b></p>
                  </div>
              </div>
          </div>
          <?php } ?>

          <?php if(!empty($_SESSION['permisos'][40]['r'])){ ?>
          <div class="col-md-6 col-lg-3">
              <div class="widget-small goldenrod coloured-icon"><i class="icon fas fa-scroll fa-1x"></i>
                  <div class="info">
                      <h4><a href="<?= base_url(); ?>Vsprovid">Ficha Proveedores</a></h4>
                      <p><b></b></p>
                  </div>
              </div>
          </div>
          <?php } ?>

          <?php if(!empty($_SESSION['permisos'][41]['r'])){ ?>
          <div class="col-md-6 col-lg-3">
              <div class="widget-small indianred coloured-icon"><i class="icon fas fa-shopping-cart fa-1x"></i>
                  <div class="info">
                      <h4><a href="<?= base_url(); ?>Vsmovcxp">Compras</a></h4>
                      <p><b></b></p>
                  </div>
              </div>
          </div>
          <?php } ?>

          <!-- CONTABILIDAD -->
          <?php if(!empty($_SESSION['permisos'][42]['r'])){ ?>
          <div class="col-md-6 col-lg-3">
              <div class="widget-small khaki coloured-icon"><i class="icon fas fa-hands-helping fa-1x"></i>
                  <div class="info">
                      <h4><a href="<?= base_url(); ?>Vsacount">Plan de Cuentas</a></h4>
                      <p><b></b></p>
                  </div>
              </div>
          </div>
          <?php } ?>

          <?php if(!empty($_SESSION['permisos'][43]['r'])){ ?>
          <div class="col-md-6 col-lg-3">
              <div class="widget-small olivedrab coloured-icon"><i class="icon fas fa-cogs"></i>
                  <div class="info">
                      <h4><a href="<?= base_url(); ?>Vsctatip">Parámetros Contables</a></h4>
                      <p><b></b></p>
                  </div>
              </div>
          </div>
          <?php } ?>

          <?php if(!empty($_SESSION['permisos'][44]['r'])){ ?>
          <div class="col-md-6 col-lg-3">
              <div class="widget-small danger coloured-icon"><i class="icon fas fa-file-invoice-dollar"></i>
                  <div class="info">
                      <h4><a href="<?= base_url(); ?>Vsmovacc">Comprobantes de Diario y Balances</a></h4>
                      <p><b></b></p>
                  </div>
              </div>
          </div>
          <?php } ?>

          <?php if(!empty($_SESSION['permisos'][45]['r'])){ ?>
          <div class="col-md-6 col-lg-3">
              <div class="widget-small darksalmon coloured-icon"><i class="icon fas fa-tenge fa-1x"></i>
                  <div class="info">
                      <h4><a href="<?= base_url(); ?>Vsatssri">Anexo Transaccional</a></h4>
                      <p><b></b></p>
                  </div>
              </div>
          </div>
          <?php } ?>
      </div>

</main>

<?php footerAdmin($data); ?>