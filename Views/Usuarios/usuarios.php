
<?php 
  headerAdmin($data); 
  getModal('modalUsuarios',$data);
?>

  <style>
  .table thead, .table tfoot {
    background-color: #455a64;
    color:azure;
  }
  </style>

  <main class="app-content">
    <?php
    ?>
      <div class="app-title">
        <div>
          <h1><i class="fas fa-user"></i> <?= $data['page_title'] ?>
              <?php if($_SESSION['permisosMod']['w']){ ?>
                  <button id="btnNuevoUsuario" class="btn btn-primary" type="button"><i class="fas fa-plus-circle"></i> Agregar Usuario</button>
                  <button id="btnProcessUsers" class="btn btn-warning" type="button" onClick="ProcessUsers();"><i class="fas fa-plus-circle"></i> Generar Usuarios</button>
              <?php } ?>
          </h1>
        </div>
      </div>
      
      <div class="row">
        <div class="col-md-12">
          <div class="tile">
            <div class="tile-body">
              <div class="table-responsive">
                <table class="table table-hover table-bordered" id="TableUsuarios" width= 100%>
                  <thead>
                    <tr>
                      <th class="text-center">Acciones</th>
                      <!-- <th>ID:</th> -->
                      <th>Usuario:</th>
                      <th>Nombre:</th>
                      <th>Rol:</th>
                      <th>Estado</th>
                    </tr>
                  </thead>
                  <tbody>                
                  </tbody>
                  <tfoot>
                    <tr>
                      <!-- <th></th> -->
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