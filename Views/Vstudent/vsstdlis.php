
<main>
  <div class="app-title">
      <div>
        <h1><i class="fas fa-user-edit"></i>  <?= $data['page_title'] ?></h1>
      </div>
      <ul class="app-breadcrumb breadcrumb">
        <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
        <li class="breadcrumb-item"><a href="<?= base_url(); ?>Vstudent">Retornar</a></li>
      </ul>
  </div> 

  <?php 
        		if(empty($data['maestro_detalle']))
       			{
 	?>
        				<p class="text-primary">Reporte sin Información.</p>
 	<?php
            }else{
                $stdxmat  = $data['maestro_detalle'];
                $empresa  = $data['empresa'];
                $periodo  = $data['perios'];
                $tiporep  = $data['reptyp'];
                $seccion  = $stdxmat[0]['SEC_NM'];
                $paralelo = $stdxmat[0]['PARALE'];
 	?>

                <div id="vsstdlis" class="invoice">
  <?php
                  $fila     = 1;              
                  $num_reg  = count($stdxmat) - 1;

                  for($f = 0; $f < count($stdxmat); $f++)
                  {
  ?>
                    <div class="row mb-0 text-center">
                      <div class="col-6">
                        <h2 class="page-header"><img src="<?= media(); ?>images/escudo.png" style="width: 70%"></h2>
                      </div>
                      <div class="col-6 mt-3">
                        <h2 class="page-header"><img src="<?= media(); ?><?= $empresa['LOGOIN'] ?>" style="width: 30%"></h2>
                      </div>
                    </div>

                    <div class="row text-center">
                      <div class="col-md-12"><h6>DISTRITO EDUCATIVO: <?= $empresa['DISTRI']?></h6></div><br> 
                      <div class="col-md-12"><h4><strong><?= $empresa['RAZONS']?></strong></h4></div>
                      <div class="col-md-12"><h6>AÑO LECTIVO: <?= $periodo ?> - <?= $periodo + 1?></h6></div><br> 
                      <div class="col-md-12"><h5><strong>Estudiantes Matriculados por Grado/Curso</strong></h5></div>
                    </div>

                    <div class="row">
                      <div class="col-md-12">
                        <table id="Tblstdrep" style="border: 1px black solid;" class="table table-striped table-bordered" cellspacing="0" width="80%">
                            <col style="width: 4%;"  />
                            <col style="width: 35%;" />
                            <col style="width: 8%;" />
                            <col style="width: 8%;" />
                            <col style="width: 12%;" />

                            <!-- Cabecera de la Tabla ..... -->
                            <thead >
                              <tr><th colspan="26"><?= $seccion ?> - <?= $paralelo ?></th></tr>
  <?php
                              if($tiporep == 1)
                              {
  ?>
                                <tr>
                                  <th class="text-center">No.</th>
                                  <th class="text-center">Apellidos y Nombres</th>
                                  <th class="text-center">Matricula</th>
                                  <th class="text-center">Folio</th>
                                  <th class="text-center">Fecha</th>
                                  <th class="text-center">OBSERVACION</th>
                                </tr>          
  <?php
                              }else{
  ?>
                                <tr>
                                  <th class="text-center">No.</th>
                                  <th class="text-center">Estudiante</th>
                                  <th class="text-center">No. IDE</th>
                                  <th class="text-center">Domicilio</th>
                                  <th class="text-center">Telefonos</th>
                                  <th class="text-center">Correo</th>
                                  <th class="text-center">Fecha Nacimiento</th>
                                  <th class="text-center">Plantel Procedencia</th>
                                  <th class="text-center">Padre</th>
                                  <th class="text-center">No. IDE</th>
                                  <th class="text-center">Domicilio</th>
                                  <th class="text-center">Telefonos</th>
                                  <th class="text-center">Correo</th>
                                  <th class="text-center">Ocupacion</th>
                                  <th class="text-center">Madre</th>
                                  <th class="text-center">No. IDE</th>
                                  <th class="text-center">Domicilio</th>
                                  <th class="text-center">Telefonos</th>
                                  <th class="text-center">Correo</th>
                                  <th class="text-center">Ocupacion</th>
                                  <th class="text-center">Representante</th>
                                  <th class="text-center">No. IDE</th>
                                  <th class="text-center">Domicilio</th>
                                  <th class="text-center">Telefonos</th>
                                  <th class="text-center">Correo</th>
                                  <th class="text-center">Ocupacion</th>
                                </tr>
  <?php
                              }
  ?>
                            </thead>
                            <tbody>
  <?php
                            while (true) 
                            {
                              if($tiporep == 1)
                              {
  ?>
                                <tr>
                                  <td><?= $fila; ?></td>
                                  <td><?= $stdxmat[$f]['LAS_NM'].' '.$stdxmat[$f]['FIR_NM']; ?></td>
                                  <td class="text-center"><?= $stdxmat[$f]['MATNUM']; ?></td>
                                  <td class="text-center"><?= $stdxmat[$f]['FOLNUM']; ?></td>
                                  <td class="text-center"><?= $stdxmat[$f]['FECMAT']; ?></td>
                                </tr>
  <?php
                              }else{
  ?>
                                <tr>
                                  <td><?= $fila; ?></td>
                                  <td><?= $stdxmat[$f]['LAS_NM'].' '.$stdxmat[$f]['FIR_NM']; ?></td>
                                  <td><?= $stdxmat[$f]['IDE_NO']; ?></td>
                                  <td><?= $stdxmat[$f]['ADDRES']; ?></td>
                                  <td><?= $stdxmat[$f]['TPHONE']; ?></td>
                                  <td><?= $stdxmat[$f]['STDMAI']; ?></td>
                                  <td><?= $stdxmat[$f]['FECBIR']; ?></td>
                                  <td><?= $stdxmat[$f]['LASSCH']; ?></td>
                                  <td><?= $stdxmat[$f]['FATLAS'].' '.$stdxmat[$f]['FATNAM']; ?></td>
                                  <td><?= $stdxmat[$f]['FATCED']; ?></td>
                                  <td><?= $stdxmat[$f]['FATADR']; ?></td>
                                  <td><?= $stdxmat[$f]['FATFON']; ?></td>
                                  <td><?= $stdxmat[$f]['FATMAI']; ?></td>
                                  <td><?= $stdxmat[$f]['FATJOB']; ?></td>
                                  <td><?= $stdxmat[$f]['MOTLAS'].' '.$stdxmat[$f]['MOTNAM']; ?></td>
                                  <td><?= $stdxmat[$f]['MOTCED']; ?></td>
                                  <td><?= $stdxmat[$f]['MOTADR']; ?></td>
                                  <td><?= $stdxmat[$f]['MOTFON']; ?></td>
                                  <td><?= $stdxmat[$f]['MOTMAI']; ?></td>
                                  <td><?= $stdxmat[$f]['MOTJOB']; ?></td>
                                  <td><?= $stdxmat[$f]['REPLAS'].' '.$stdxmat[$f]['REPNAM']; ?></td>
                                  <td><?= $stdxmat[$f]['REPCED']; ?></td>
                                  <td><?= $stdxmat[$f]['REPADR']; ?></td>
                                  <td><?= $stdxmat[$f]['REPFON']; ?></td>
                                  <td><?= $stdxmat[$f]['REPMAI']; ?></td>
                                  <td><?= $stdxmat[$f]['REPJOB']; ?></td>
                                </tr>
  <?php
                              }

                              if($f < $num_reg)
                              {
                                if($seccion == $stdxmat[$f+1]['SEC_NM'] AND $paralelo == $stdxmat[$f+1]['PARALE'])
                                { 
                                  $fila++;
                                  $f = $f + 1;
                                }else{
                                  $fila     = 1;                  
                                  $seccion  = $stdxmat[$f+1]['SEC_NM'];
                                  $paralelo = $stdxmat[$f+1]['PARALE'];
                                  break;
                                }
                              }else{
                                break;
                              }
                            }
  ?>
                          </tbody>
                        </table>
                      </div>
                    </div>
                    <br><br><br><br>

                    <div class="row text-center mt-4 pt-4">
                      <div class="col-6">
                        <p class="mb-0"><?= $empresa['RECTOR']?></p>
                        <strong>Rector/a</strong>
                      </div>
                      <div class="col-6">
                        <p class="mb-0"><?= $empresa['SECRES']?></p>
                        <strong>Secretaria General</strong>
                      </div>
                    </div>

                    <div class="row mt-4 pt-4">
                      <div class="col-6 text-center">
                        <img src="<?= media(); ?>images/gobierno.png" style="width: 70%">
                      </div>
                    </div>
                    <p style="page-break-after: always;"></p>
  <?php
                  }  
  ?>                     
            <div class="row d-print-none mt-2">
                <div class="col-12 text-right">
                  <a class="btn btn-primary" onclick="printDiv('vsstdlis')"><i class="fa fa-print"></i> Imprimir</a>
                  <a class="btn btn-warning" onclick="exportTableToExcel('Tblstdrep')"><i class="far fa-file-excel"></i> Exportar EXCEL</a>
                </div>
            </div>
          </div>
  <?php  } ?>
</main>
