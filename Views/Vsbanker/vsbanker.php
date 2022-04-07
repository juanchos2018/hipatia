
<?php 
  headerAdmin($data); 
  getModal('modalVsbanker',$data);
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
          <h1><i class="fas fa-piggy-bank"></i> <?= $data['page_title'] ?>
          <?php if($_SESSION['permisosMod']['w']){ ?>
              <button class="btn btn-primary btnNewVsbanker" type="button" onclick="openModalBan();"><i class="fas fa-plus-circle"></i> Agregar Entidad</button>
          <?php } ?>
          </h1>
        </div>
      </div>

      <div class="row">
        <div class="col-lg-12">
          <div class="tile">
            <div class="tile-body">
              <div class="table-responsive">
               <table class="table table-striped table-bordered display nowrap" id="TableVsbanker" cellspacing="0" width= 100%>
                  <thead>
                    <tr>
                      <th class="text-center">Acciones:</th>
                      <th>Nombre de Entidad: </th>
                      <th>Número de Cuenta: </th>
                      <th>Ultimo Cheque girado: </th>
                      <th>Ultima Conciliación: </th>
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