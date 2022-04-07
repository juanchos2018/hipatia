
<?php 
  headerAdmin($data); 
  getModal('modalVsrolpay',$data);
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
          <h1><i class="fas fa-money-check-alt"></i> <?= $data['page_title'] ?>
          <?php if($_SESSION['permisosMod']['w']){ ?>
              <button class="btn btn-primary btnNewVsrolpay" type="button" onclick="openModalRol();"><i class="fas fa-plus-circle"></i> Agregar Rol de Pago</button>
          <?php } ?>
          <button class="btn btn-warning btnNewVsrolpay" type="button" onclick="openModalRpi();"><i class="fas fa-plus-circle"></i> Informe Rol de Pago</button>
          <button class="btn btn-danger btnNewVsrolpay" type="button" onclick="openModalRoc();"><i class="fas fa-plus-circle"></i> Cierre Rol de Pago</button>
          </h1>
        </div>
      </div>

      <div class="row">
        <div class="col-lg-12">
          <div class="tile">
            <div class="tile-body">
              <div class="table-responsive">
               <table class="table table-striped table-bordered display nowrap" id="TableVsrolpay" cellspacing="0" width= 100%>
                  <thead>
                    <tr>
                      <th class="text-center">Acciones: </th>
                      <th>Periodo: </th>
                      <th>Personal: </th>
                      <th>Rubro: </th>
                      <th>Ingreso: </th>
                      <th>Descuento: </th>
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