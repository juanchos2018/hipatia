
<?php 
  headerAdmin($data); 
  getModal('modalVsmovacc',$data);
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
          <h1><i class="fas fa-file-invoice-dollar"></i> <?= $data['page_title'] ?>
          <?php if($_SESSION['permisosMod']['w']){ ?>
              <button class="btn btn-primary btnNewVsmovacc" type="button" onclick="openModalAcc();"><i class="fas fa-plus-circle"></i> Agregar Comprobante Diario</button>
          <?php } ?>
          <button class="btn btn-warning btnNewVsmovacc" type="button" onclick="openModalBal();"><i class="fas fa-plus-circle"></i> Informes y Balances Contables</button>
          </h1>
        </div>
      </div>

      <div class="row">
        <div class="col-lg-12">
          <div class="tile">
            <div class="tile-body">
              <div class="table-responsive">
               <table class="table table-striped table-bordered display nowrap" id="TableVsmovacc" cellspacing="0" width= 100%>
                  <thead>
                    <tr>
                      <th class="text-center">Acciones: </th>
                      <th>Fecha: </th>
                      <th>Diario Tipo: </th>
                      <th>Diario No.: </th>
                      <th>Cuenta Contable: </th>
                      <th>Debe: </th>
                      <th>Haber: </th>
                      <th>Signo: </th>
                      <th>Concepto: </th>
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