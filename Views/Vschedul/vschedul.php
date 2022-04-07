
<?php 
  headerAdmin($data); 
  getModal('modalVschedul',$data);
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
          <h1><i class="fas fa-chalkboard-teacher"></i> <?= $data['page_title'] ?>
          <!-- Se restringe acceso al boton: Agregar Actividad -->
          <?php if($_SESSION['permisosMod']['w']){ ?>
              <button class="btn btn-primary btnNewVsemplox" type="button" onclick="openModalSch();"><i class="fas fa-plus-circle"></i> Agregar Actividad</button>
          <?php } ?>
          </h1>
        </div>
      </div>

      
      <div class="row">
        <div class="col-lg-12">
          <div class="tile">
            <div class="tile-body">
              
               <table class="table table-striped table-bordered nowrap" id="TableVschedul" cellspacing="0" style="width: 100%">
                  <thead>
                    <tr>
                      <th class="text-center">Acciones: </th>
                      <th>Fecha: </th>
                      <th>Secci&oacuten: </th>
                      <th>Asignatura: </th>
                      <th>Estudiante: </th>
                      <th>Puntaje: </th>
                      <th>Actividad: </th>
                      <th>Parcial: </th>
                      <th>Docente: </th>
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
      
</main>

<?php footerAdmin($data); ?>