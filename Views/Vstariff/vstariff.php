
<?php 
  headerAdmin($data); 
  getModal('modalVstariff',$data);
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
              <button class="btn btn-primary btnNewVstariff" type="button" onclick="openModalTar();"><i class="fas fa-plus-circle"></i> Agregar Convenio</button>
          <?php } ?>
          <?php $rol = $_SESSION['userData']['rol_id']; ?>
          <?php if($rol == 1){ ?>
              <button class="btn btn-danger btnNewVstariff" type="button" onclick="openModalGcc();"><i class="fas fa-plus-circle"></i> Generar Cuenta x Cobrar</button>
          <?php } ?>
          <button class="btn btn-warning btnNewVstariff" type="button" onclick="openModalCxc();"><i class="fas fa-plus-circle"></i> Informe Cuenta x Cobrar</button>
          </h1>
        </div>
      </div>

      <div class="row">
        <div class="col-lg-12">
          <div class="tile">
            <div class="tile-body">
              <div class="table-responsive">
               <table class="table table-striped table-bordered display nowrap" id="TableVstariff" cellspacing="0" width= 100%>
                  <thead>
                    <tr>
                      <th class="text-center">Acciones:</th>
                      <th>Año: </th>
                      <th>Estudiante: </th>
                      <th>Periodo: </th>
                      <th>Art&iacuteculo: </th>
                      <th>Precio Lista: </th>
                      <th>Precio Tarifado: </th>
                      <th>Valor Abonado: </th>
                      <th>Observaci&oacuten: </th>
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