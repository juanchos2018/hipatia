
<?php headerAdmin($data); ?>

<main class="app-content">
      <div class="app-title">
        <div>
          <h1><i class="fas fa-chart-bar"></i> <?= $data['page_title'] ?></h1>
        </div>
        <ul class="app-breadcrumb breadcrumb">
          <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
          <li class="breadcrumb-item"><a href="<?= base_url(); ?>dashboard">Academico</a></li>
        </ul>
      </div>
      
      <!-- Permiso para Visualizar todo el DASHBOARD -->
      <div class="row">

        <!-- <div class="col-md-6">
          <div class="widget-small bighead coloured-icon"><i class="icon fas fa-book-open fa-3x"></i>
            <div class="info">
              <h4 class="mb-0"><a href="">Ojo de Aguila</a></h4>
              <p><small><b><?= $data['reg_vschtod'] ?></b> Aula Virtual hoy.</small></p>
              <p><small><b><?= $data['reg_vschyes'] ?></b> Aula Virtual ayer.</small></p>
              <p><small><b><?= $data['reg_vschtod'] ?></b> Notificación hoy.</small></p>
              <p><small><b><?= $data['reg_vschyes'] ?></b> Notificación ayer.</small></p>
              <p><small><b><?= $data['reg_vsoctod'] ?></b> Ficha Social hoy.</small></p>
              <p><small><b><?= $data['reg_vsocyes'] ?></b> Ficha Social ayer.</small></p>
              <p><small><b><?= $data['reg_vhistod'] ?></b> Ficha Médica hoy.</small></p>
              <p><small><b><?= $data['reg_vhisyes'] ?></b> Ficha Médica ayer.</small></p>
            </div>
          </div>
        </div> -->

        <div class="col-md-12">
          <div class="tile">
              <div class="tile-body text-center" style="font-size: 18px">Estadisticas</div>
          </div>
        </div>

          <!-- <h3 class="tile-title">Cantidad de Estudiantes por Pais</h3>
          <div class="col-md-6">
          <div class="tile">
            <div class="embed-responsive embed-responsive-16by9">
              <canvas class="embed-responsive-item" id="barStdAspirantes" width="449" height="252" style="width: 449px; height: 252px;"></canvas>
            </div>
          </div>
        </div> -->

        <div class="col-md-12">
          <div class="tile">
            <!-- <h3 class="tile-title">Cantidad de Estudiantes por Pais</h3> -->
            <div class="embed-responsive embed-responsive-16by9">
              <canvas class="embed-responsive-item" id="barStudents" width="449" height="252" style="width: 449px; height: 252px;"></canvas>
            </div>
          </div>
        </div>

        <div class="col-md-6">
          <div class="tile">
            <!-- <h3 class="tile-title">Cantidad de Estudiantes por Pais</h3> -->
            <div class="embed-responsive embed-responsive-1by1">
              <canvas  class="embed-responsive-item" id="pieStdGenero"></canvas>
            </div>
          </div>
        </div>

        <div class="col-md-6">
          <div class="tile">
            <!-- <h3 class="tile-title">Cantidad de Estudiantes por Pais</h3> -->
            <div class="embed-responsive embed-responsive-1by1">
              <canvas  class="embed-responsive-item" id="polarEmpProfile"></canvas>
            </div>
          </div>
        </div>

        <div class="col-md-12">
          <div class="tile">
              <div class="tile-body text-center" style="font-size: 18px">Ojo de Águila</div>
          </div>
        </div>

        <div class="col-md-6">
          <div class="tile">
            <!-- <h3 class="tile-title">Cantidad de Estudiantes por Pais</h3> -->
            <label>Fecha Actividad</label>
            <input class="form-control" id="FechaAula" name="FechaAula" type="date" onchange="fntRegAulaVirtual(this);">
                        
            <div class="embed-responsive embed-responsive-16by9">
              <canvas class="embed-responsive-item" id="barAulaVirtual" width="449" height="252" style="width: 449px; height: 252px;"></canvas>
            </div>
          </div>
        </div>

        <div class="col-md-6">
          <div class="tile">
            <!-- <h3 class="tile-title">Cantidad de Estudiantes por Pais</h3> -->
            <label>Fecha Notificacion</label>
            <input class="form-control" id="FechaNotify" name="FechaNotify" type="date" onclick="GetRegNotify();">
            <div class="embed-responsive embed-responsive-16by9">
              <canvas class="embed-responsive-item" id="barNotify" width="449" height="252" style="width: 449px; height: 252px;"></canvas>
            </div>
          </div>
        </div>

        <div class="col-md-6">
          <div class="tile">
            <!-- <h3 class="tile-title">Cantidad de Estudiantes por Pais</h3> -->
            <label>Fecha Historia Social</label>
            <input class="form-control" id="FechaFchSocial" name="FechaFchSocial" type="date">
            <div class="embed-responsive embed-responsive-16by9">
              <canvas class="embed-responsive-item" id="barFchSocial" width="449" height="252" style="width: 449px; height: 252px;"></canvas>
            </div>
          </div>
        </div>

        <div class="col-md-6">
          <div class="tile">
            <!-- <h3 class="tile-title">Cantidad de Estudiantes por Pais</h3> -->
            <label>Fecha Historia Clínica</label>
            <input class="form-control" id="FechaFchMedica" name="FechaFchMedica" type="date">
            <div class="embed-responsive embed-responsive-16by9">
              <canvas class="embed-responsive-item" id="barFchMedica" width="449" height="252" style="width: 449px; height: 252px;"></canvas>
            </div>
          </div>
        </div>


      </div>
</main>

<?php footerAdmin($data); ?>