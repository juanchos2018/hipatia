
<?php 
  headerAdmin($data); 
  getModal('modalVsmovban',$data);
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
          <h1><i class="fas fa-book"></i> <?= $data['page_title'] ?>
          <?php if($_SESSION['permisosMod']['w']){ ?>
              <button class="btn btn-primary btnNewVsmovban" type="button" onclick="openModalMvb();"><i class="fas fa-plus-circle"></i> Agregar Transacción</button>
              <button class="btn btn-primary btnNewVsmovban" type="button" onclick="openModalTrf();"><i class="fas fa-plus-circle"></i> Agregar Transferencia</button>
              <button class="btn btn-danger btnNewVsmovban" type="button" onclick="openModalClb();"><i class="fas fa-plus-circle"></i> Agregar Conciliación</button>
          <?php } ?>
          <button class="btn btn-warning btnNewVsmovacc" type="button" onclick="openModalRpb();"><i class="fas fa-plus-circle"></i> Informes Bancarios</button>
          </h1>
        </div>
      </div>

      <div class="row">
        <div class="col-lg-12">
          <div class="tile">
            <div class="tile-body">
              <div class="table-responsive">
               <table class="table table-striped table-bordered display nowrap" id="TableVsmovban" cellspacing="0" width= 100%>
                  <thead>
                    <tr>
                      <th class="text-center">Acciones: </th>
                      <th>Fecha: </th>
                      <th>Diario Tipo: </th>
                      <th>Diario No.: </th>
                      <th>Entidad: </th>
                      <th>No. Cuenta: </th>
                      <th>Valor: </th>
                      <th>Concepto: </th>
                      <th>Condición: </th>
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
      </div>
</main>

<?php footerAdmin($data); ?>