
<?php 
  headerAdmin($data); 
  getModal('modalVssecuen',$data);
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
          <h1><i class="fas fa-cog"></i> <?= $data['page_title'] ?>
          <?php if($_SESSION['permisosMod']['w']){ ?>
              <button class="btn btn-primary btnNewVstables" type="button" onclick="openModalScc();"><i class="fas fa-plus-circle"></i> Agregar Parámetro</button>
          <?php } ?>
          </h1>
        </div>
      </div>

      <div class="row">
        <div class="col-lg-12">
          <div class="tile">
            <div class="tile-body">
              <div class="table-responsive">
               <table class="table table-striped table-bordered display nowrap" id="TableVssecuen" cellspacing="0" width= 100%>
                  <thead>
                    <tr>
                      <th class="text-center" style="width:3px">Acciones:</th>
                      <th>Nombre Parámetro:</th>
                      <th>Punto Emisión:</th>
                      <th>No. Secuencial:</th>
                      <th>No. Parámetro:</th>
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