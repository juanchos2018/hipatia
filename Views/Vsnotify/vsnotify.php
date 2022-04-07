
<?php 
  headerAdmin($data); 
  getModal('modalVsnotify',$data);
?>


<style>
  .table thead, .table tfoot {
    background-color: #455a64;
    color:azure;
  }
</style>

<main class="app-content">
      <div class="app-title">
        <div>
          <h1><i class="fas fa-exclamation-triangle"></i> <?= $data['page_title'] ?>
          <?php if($_SESSION['permisosMod']['w']){ ?>
              <button class="btn btn-primary btnNewVsnotify" type="button" onclick="openModalNot();"><i class="fas fa-plus-circle"></i> Agregar Notificación</button>
          <?php } ?>
          <?php 
              $rol = $_SESSION['userData']['rol_id'];
              if($rol == 1 or $rol == 7)
              { 
          ?>
              <button class="btn btn-warning btnNewVsnotstd" type="button" onclick="openModalNov();"><i class="fas fa-plus-circle"></i> Agregar Reclamo</button>
          <?php
              } 
          ?>
          </h1>
        </div>
      </div>

      <div class="row">
        <div class="col-lg-12">
          <div class="tile">
            <div class="tile-body">
              <div class="table-responsive">
               <table class="table table-striped table-bordered display nowrap" id="TableVsnotify" cellspacing="0" width= 100%>
                  <thead>
                    <tr>
                      <th class="text-center">Acciones: </th>
                      <th>Fecha: </th>
                      <th>Tipo: </th>
                      <th>Secci&oacuten: </th>
                      <th>Asignatura: </th>
                      <th>Estudiante: </th>
                    </tr>
                  </thead>
                  <tfoot>
                    <tr>
                      <th></th>
                      <th></th>
                      <th></th>
                      <th></th>
                      <th></th>
                      <th></th>
                    </tr>
                  </tfoot>
                </table>
              </div>
            </div>
          </div>
        </div>
      </div>
</main>

<?php footerAdmin($data); ?>