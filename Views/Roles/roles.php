
<?php 
  headerAdmin($data); 
  getModal('modalRoles',$data);
?>


<style>
  .table thead, .table tfoot {
    background-color: #455a64;
    color:azure;
  }
</style>

<div id="contentAjax"></div>
<main class="app-content">
      <div class="app-title">
        <div>
          <h1><i class="fas fa-user-tag"></i> <?= $data['page_title'] ?>
              <?php if($_SESSION['permisosMod']['w']){ ?>
              <button class="btn btn-primary btnNewRol" type="button" onclick="openModal();"><i class="fas fa-plus-circle"></i> Agregar Rol</button>
              <?php } ?>
          </h1>
        </div>

        <ul class="app-breadcrumb breadcrumb">
          <li class="breadcrumb-item"><i class="fas fa-user-tag"></i></li>
          <li class="breadcrumb-item"><a href="<?= base_url(); ?>roles"><?= $data['page_title'] ?></a></li>
        </ul>

      </div>


      
      <div class="row">
        <div class="col-lg-12">
          <div class="tile">
            <div class="tile-body">
              <div class="table-responsive">
                <table class="table table-striped table-bordered display nowrap" id="TableRoles" cellspacing="0" width= 100%>
                  <thead>
                    <tr>
                      <th class="text-center">Acciones</th>
                      <th>ID</th>
                      <th>Nombre</th>
                      <th>Descripción</th>
                      <th>Estado</th>
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