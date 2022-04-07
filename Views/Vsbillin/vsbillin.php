
<?php 
  headerAdmin($data); 
  getModal('modalVsbillin',$data);
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
          <h1><i class="fas fa-file-invoice"></i> <?= $data['page_title'] ?>
          <?php if($_SESSION['permisosMod']['w']){ ?>
              <button class="btn btn-primary btnNewVsbillin" type="button" onclick="openModalFac();"><i class="fas fa-plus-circle"></i> Agregar Factura/Recibo</button>
              <button class="btn btn-danger btnNewVsbillin" type="button" onclick="openModalNcr();"><i class="fas fa-plus-circle"></i> Agregar Nota de Crédito</button>
          <?php } ?>
          <button class="btn btn-warning btnNewVsbillin" type="button" onclick="openModalVen();"><i class="fas fa-plus-circle"></i> Informe Diario de Ventas</button>
          </h1>
        </div>
      </div>

      <div class="row">
        <div class="col-lg-12">
          <div class="tile">
            <div class="tile-body">
              <div class="table-responsive">
               <table class="table table-striped table-bordered display nowrap" id="TableVsbillin" cellspacing="0" width= 100%>
                  <thead>
                    <tr>
                      <th class="text-center">Acciones:</th>
                      <th>Fecha Emisi&oacuten:</th>
                      <th>Documento Tipo:</th>
                      <th>Punto Emisión:</th>
                      <th>Documento No.:</th>
                      <th>R.U.C.:</th>
                      <th>Raz&oacuten Social:</th>
                      <th>Total:</th>
                      <th>Observación:</th>
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