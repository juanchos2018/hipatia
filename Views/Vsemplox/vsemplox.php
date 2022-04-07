
<?php 
  headerAdmin($data); 
  getModal('modalVsemplox',$data);
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
          <h1><i class="fas fa-user-friends"></i> <?= $data['page_title'] ?>
          <?php if($_SESSION['permisosMod']['w']){ ?>
            <button class="btn btn-primary btnNewVsemplox" type="button" onclick="openModalEmp();"><i class="fas fa-plus-circle"></i> Agregar Personal</button>
          <?php } ?>
          </h1>
        </div>
      </div>

      <div class="row">
        <div class="col-lg-12">
          <div class="tile">
            <div class="tile-body">
              <div class="table-responsive">
               <table class="table table-striped table-bordered display nowrap" id="TableVsemplox" cellspacing="0" width= 100%>
                  <thead>
                    <tr>
                      <th class="text-center">Acciones:</th>
                      <th>Apellidos: </th>
                      <th>Nombres: </th>
                      <th>Tipo Identificación: </th>
                      <th>No. Identificación: </th>
                      <th>Estado: </th>
                      <th>Direcci&oacuten: </th>
                      <th>Tel&eacutefono: </th>
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