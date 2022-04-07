
<?php 
  headerAdmin($data); 
  getModal('modalVsmovcxp',$data);
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
          <h1><i class="fas fa-shopping-cart"></i> <?= $data['page_title'] ?>
          <?php if($_SESSION['permisosMod']['w']){ ?>
              <button class="btn btn-primary btnNewVsmovcxp" type="button" onclick="openModalCxp();"><i class="fas fa-plus-circle"></i> Agregar Compra Proveedor</button>
              <button class="btn btn-primary btnNewVsmovcxp" type="button" onclick="openModalNcp();"><i class="fas fa-plus-circle"></i> Agregar Crédito/Débito</button>
              <button class="btn btn-danger btnNewVsmovcxp" type="button" onclick="openModalPay();"><i class="fas fa-plus-circle"></i> Agregar Pago a Proveedor</button>
          <?php } ?>
          <button class="btn btn-warning btnNewVsmovcxp" type="button" onclick="openModalRpc();"><i class="fas fa-plus-circle"></i> Informe Cuenta por Pagar</button>
          </h1>
        </div>
      </div>

      <div class="row">
        <div class="col-lg-12">
          <div class="tile">
            <div class="tile-body">
              <div class="table-responsive">
               <table class="table table-striped table-bordered display nowrap" id="TableVsmovcxp" cellspacing="0" width= 100%>
                  <thead>
                    <tr>
                      <th class="text-center">Acciones: </th>
                      <th>Fecha: </th>
                      <th>Diario Tipo: </th>
                      <th>Diario No.: </th>
                      <th>Valor: </th>
                      <th>Retención No.: </th>
                      <th>Proveedor: </th>
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