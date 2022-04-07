
<?php 
  headerAdmin($data); 
  getModal('modalVsclinic',$data);
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
          <h1><i class="fas fa-hand-holding-medical"></i> <?= $data['page_title'] ?>
          <?php if($_SESSION['permisosMod']['w']){ ?>
              <button class="btn btn-primary btnNewVsclinic" type="button" onclick="openModalCli();"><i class="fas fa-plus-circle"></i> Agregar Historia Clínica</button>
          <?php } ?>
          </h1>
        </div>
      </div>

      <div class="row">
        <div class="col-lg-12">
          <div class="tile">
            <div class="tile-body">
              <div class="table-responsive">
               <table class="table table-striped table-bordered display nowrap" id="TableVsclinic" cellspacing="0" width= 100%>
                  <thead>
                    <tr>
                      <th class="text-center">Acciones: </th>
                      <th>Historia #:</th>
                      <th>Fecha: </th>
                      <th>Apellidos Estudiante: </th>
                      <th>Nombres Estudiante: </th>
                    </tr>
                  </thead>
                  <tfoot>
                    <tr>
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