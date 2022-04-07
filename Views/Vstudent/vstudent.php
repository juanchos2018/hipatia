
<?php 
  headerAdmin($data); 
  getModal('modalVstudent',$data);
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
          <h1><i class="fas fa-user-graduate"></i> <?= $data['page_title'] ?>
          <?php if($_SESSION['permisosMod']['w']){ ?>
              <button class="btn btn-primary btnNewVstudent" type="button" onclick="openModalStd();"><i class="fas fa-plus-circle"></i> Agregar Estudiante</button>
          <?php } ?>
          <?php $rol = $_SESSION['userData']['rol_id']; ?>
          <?php if($rol == 1){ ?>
              <button class="btn btn-danger btnNewVstudent" type="button" onclick="openModalGen();"><i class="fas fa-plus-circle"></i> Generar Matriz Calificación</button>
          <?php } ?>
          <button class="btn btn-warning btnNewVstudent" type="button" onclick="openModalLst();"><i class="fas fa-plus-circle"></i> Informe de Estudiantes</button>
          </h1>
        </div>
      </div>

      <div class="row">
        <div class="col-lg-12">
          <div class="tile">
            <div class="tile-body">
              <div class="table-responsive">
               <table class="table table-striped table-bordered display nowrap" id="TableVstudent" cellspacing="0" width= 100%>
                  <thead>
                    <tr>
                      <th class="text-center">Acciones: </th>
                      <th>Año: </th> 
                      <th>Estudiante: </th>
                      <th>Tipo ID: </th>
                      <th>No. ID: </th>
                      <th>Estatus: </th> 
                      <th>Secci&oacuten: </th>
                    </tr>
                  </thead>
                  <tbody>
                  </tbody>
                  <tfoot>
                    <tr>
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
      </div>
</main>

<?php footerAdmin($data); ?>