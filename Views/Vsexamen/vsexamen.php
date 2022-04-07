
<?php 
  headerAdmin($data); 
  getModal('modalVsexamen',$data);
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
          <h1><i class="fas fa-diagnoses"></i> <?= $data['page_title'] ?>
          <?php if($_SESSION['permisosMod']['w']){ ?>
              <button class="btn btn-primary btnNewVsexamen" type="button" onclick="openModalExa();"><i class="fas fa-plus-circle"></i> Agregar Examen</button>
          <?php } ?>
          </h1>
        </div>
      </div>

      
      <div class="row">
        <div class="col-lg-12">
          <div class="tile">
            <div class="tile-body">
              
               <table class="table table-striped table-bordered nowrap" id="TableVsexamen" cellspacing="0" style="width: 100%">
                  <thead>
                    <tr>
                      <th class="text-center">Acciones: </th>
                      <th>Fecha: </th>
                      <th>Parcial: </th>
                      <th>Secci&oacuten: </th>
                      <th>Paralelo: </th>
                      <th>Asignatura: </th>
                      <th>Pregunta: </th>
                      <th>Estudiante: </th>
                      <th>Docente: </th>
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
      
</main>

<?php footerAdmin($data); ?>