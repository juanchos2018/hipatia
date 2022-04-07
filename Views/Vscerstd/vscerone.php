<main>
  <div class="app-title">
      <div>
        <h1><i class="fas fa-user-edit"></i>  <?= $data['page_title'] ?></h1>
      </div>
      <ul class="app-breadcrumb breadcrumb">
        <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
        <li class="breadcrumb-item"><a href="<?= base_url(); ?>Vscerstd">Retornar</a></li>
      </ul>
  </div>

    <div class="row">
        <div class="col-md-12">
        
  <?php 
        if(empty($data['maestro_detalle']['estudiante']))
        {
   ?>
            <p class="text-primary">Reporte sin Información.</p>
  <?php 
        }else{
            $certip = $data['maestro_detalle']['certip'];
  ?>
            <section id="vscerone" class="invoice">
              <!-- SWICTH que identifica el Tipo de Reporte -->
  <?php
              switch ($certip) 
              {
                case 1:
                      # Certificado de Maticula
                      $empresa    = $data['maestro_detalle']['empresa'];
                      $estudiante = $data['maestro_detalle']['estudiante'];
                      $matricula  = $data['maestro_detalle']['matricula'];
                      $fecha_cert = $data['maestro_detalle']['fecha'];
                      $jornada    = $estudiante[0]['JOR_NO'];
                      $regimen    = $data['maestro_detalle']['empresa']['REGIME'];
                  
                      switch($jornada)
                      {
                          case 1:
                              $jornada = 'MATUTINA';
                              break;
                          case 2:
                              $jornada = 'VESPERTINA';
                              break;
                          case 3:
                              $jornada = 'NOCTURNA';
                              break;
                      }

                      switch($regimen)
                      {
                          case 1:
                              $regimen = 'Sierra';
                              break;
                          case 2:
                              $regimen = 'Costa';
                              break;
                      }
  ?>
                  <div class="row mt-1 text-center">
                    <div class="col-4">
                        <h2 class="page-header"><img src="<?= media(); ?>images/escudo.png" style="width: 70%"></h2>
                    </div>

                    <div class="col-4 mt-3">
                        <h3><?= $empresa['RAZONS']?></h3>
                    </div>

                    <div class="col-4">
                        <h2 class="page-header"><img src="<?= media(); ?><?= $empresa['LOGOIN'] ?>" style="width: 30%"></h2>
                    </div>
                  </div>

                  <br><br>
                  <div class="row mt-4 text-center">
                    <div class="col-12"><h4><strong>CERTIFICADO DE MATRICULA No. <?= $matricula['MATNUM'] ?> </strong></h4></div>
                    <div class="col-12"><h4><strong>Año Lectivo: </strong><?= $estudiante[0]['PERIOS'] ?> - <?= $estudiante[0]['PERIOS'] + 1?></h4></div>
                  </div>
                  <br><br><br>
                  <div class="row mt-4" style="font-size: 16px;">                      
                      <div class="col-10 offset-1">Certifico que el/la estudiante:</div>
                      <div class="col-12 text-center"><h6><?= $estudiante[0]['LAS_NM'].' '.$estudiante[0]['FIR_NM']; ?></h6></div>
                      <br>
                      <div class="col-10 offset-1">
                        <p class="text-justify">
                          Previo el cumplimiento de los requisitos legales y reglamentarios se matriculó en el <?= $estudiante[0]['SEC_NM']; ?> paralelo <?= $estudiante[0]['PARALE']; ?>,  para realizar sus estudios en esta Institución Educativa.
                        </p>
                      </div>
                      <br>
                      <div class="col-10 offset-1">
                        <p class="text-justify">
                          Así consta en el libro de matrículas de la secretaria del plantel, según el Folio Nro. <?= $matricula['FOLNUM'] ?>. 
                        </p>
                      </div>
                      <br><br><br><br>
                      <div class="col-10 offset-1">
                        <p class="text-right">
                          <?= $empresa['CIUDAD'] ?> , <?= date("M j Y"); ?>  
                        </p>
                      </div>
                  </div>
                  <br><br>

  <?php
                    break;

                  case 2:
                    $empresa    = $data['maestro_detalle']['empresa'];
                    $estudiante = $data['maestro_detalle']['estudiante'];
                    $proStd     = $data['maestro_detalle']['proStd'];
                    $proDis     = $data['maestro_detalle']['proDis'];
                    $proTab     = $data['maestro_detalle']['proTab'];
                    $proSup     = $data['maestro_detalle']['proSup'];
                    $certip     = $data['maestro_detalle']['certip'];              
                    $fecha_cert = $data['maestro_detalle']['fecha'];
                    $jornada    = $estudiante[0]['JOR_NO'];
                    $regimen    = $data['maestro_detalle']['empresa']['REGIME'];
                  
                    switch($jornada)
                    {
                        case 1:
                            $jornada = 'MATUTINA';
                            break;
                        case 2:
                            $jornada = 'VESPERTINA';
                            break;
                        case 3:
                            $jornada = 'NOCTURNA';
                            break;
                    }

                    switch($regimen)
                    {
                        case 1:
                            $regimen = 'Sierra';
                            break;
                        case 2:
                            $regimen = 'Costa';
                            break;
                    }

                    $jj = 0;
                    $califi = $proDis['CALIFI'];
                    if($califi == 2)
                    { 
                      $cuan01 = $proDis['CUAN01'];
                      $cuan02 = $proDis['CUAN02'];
                      $cuan03 = $proDis['CUAN03'];
                      $cuan04 = $proDis['CUAN04'];
                      $cuan05 = $proDis['CUAN05'];
                      $cuan06 = $proDis['CUAN06'];
                      $cuan07 = $proDis['CUAN07'];
                      $cuan08 = $proDis['CUAN08'];
                      $cuan09 = $proDis['CUAN09'];
                      $cuan10 = $proDis['CUAN10'];
          
                      $cual01 = $proDis['CUAL01'];
                      $cual02 = $proDis['CUAL02'];
                      $cual03 = $proDis['CUAL03'];
                      $cual04 = $proDis['CUAL04'];
                      $cual05 = $proDis['CUAL05'];
                      $cual06 = $proDis['CUAL06'];
                      $cual07 = $proDis['CUAL07'];
                      $cual08 = $proDis['CUAL08'];
                      $cual09 = $proDis['CUAL09'];
                      $cual10 = $proDis['CUAL10'];
          
                      if($proDis['PROFIN'] > $cuan09 and $proDis['PROFIN'] <= $cuan10)
                      {
                        $proDis['PROFIN'] = $cual10;
                                
                      }else if($proDis['PROFIN'] > $cuan08 and $proDis['PROFIN'] <= $cuan09) {
                          $proDis['PROFIN'] = $cual09;
                                
                      }else if($proDis['PROFIN'] > $cuan07 and $proDis['PROFIN'] <= $cuan08) {
                          $proDis['PROFIN'] = $cual08;
                                
                      }else if($proDis['PROFIN'] > $cuan06 and $proDis['PROFIN'] <= $cuan07) {
                          $proDis['PROFIN'] = $cual07;
                                
                      }else if($proDis['PROFIN'] > $cuan05 and $proDis['PROFIN'] <= $cuan06) {
                          $proDis['PROFIN'] = $cual06;
                                
                      }else if($proDis['PROFIN'] > $cuan04 and $proDis['PROFIN'] <= $cuan05) {
                          $proDis['PROFIN'] = $cual05;
                                
                      }else if($proDis['PROFIN'] > $cuan03 and $proDis['PROFIN'] <= $cuan04) {
                          $proDis['PROFIN'] = $cual04;
                                
                      }else if($proDis['PROFIN'] > $cuan02 and $proDis['PROFIN'] <= $cuan03) {
                          $proDis['PROFIN'] = $cual03;
                                
                      }else if($proDis['PROFIN'] >= $cuan01 and $proDis['PROFIN'] <= $cuan02) {
                          $proDis['PROFIN'] = $cual02;
                                
                      }else{
                          $proDis['PROFIN'] = ' ';
                      }
                    }
                              # Certificado de Promocion ......
  ?>
                <div class="row mt-1 text-center">
                    <div class="col-4">
                        <h2 class="page-header"><img src="<?= media(); ?>images/escudo.png" style="width: 70%"></h2>
                    </div>

                    <div class="col-4 mt-3 pt-3">
                        <h3>Ministerio de Educación</h3>
                    </div>

                    <div class="col-4 mt-3">
                        <h2 class="page-header"><img src="<?= media(); ?><?= $empresa['LOGOIN'] ?>" style="width: 30%"></h2>
                    </div>
                </div>

                <div class="row mb-0 text-center">
                    <div class="col-4"><strong>CODIGO AMIE: <?= $empresa['AMI_ID']?></strong></div>
                    <div class="col-4"><strong>Año Lectivo: </strong><?= $estudiante[0]['PERIOS'] ?> - <?= $estudiante[0]['PERIOS'] + 1?></div>
                    <div class="col-4"><strong>Régimen: <?= $regimen ?></strong></div>
                </div>

                <div class="row text-center mt-2">
                    <div class="col-12"><h6>DISTRITO EDUCATIVO: <?= $empresa['DISTRI']?></h6></div>
                </div>

                <div class="row text-center">
  <?php
                      $strSection = 'UNDECIMO';
                      $pos = strpos($estudiante[0]['SEC_NM'], $strSection);
                      if ($pos === false) 
                      {
  ?>
                        <div class="col-12"><h6>CERTIFICADO DE PROMOCIÓN</h6></div>
  <?php
                      }else{
  ?>
                        <div class="col-12"><h6>CERTIFICADO DE APTITUD</h6></div>
  <?php
                      }
  ?>
                </div>

                <div class="row">
                    <div class="col-12"><p>El Rector(a)/Director(a) de la Institución Educativa:</p></div>
                </div>

                <div class="row text-center">
                    <div class="col-12"><h6><?= $empresa['RAZONS']?></h6></div>
                </div>

                 <div class="row text-justify align-content-center">
                    <div class="col-12"><p>De conformidad con lo prescrito en al Art. 197 del Reglamento a la Ley Orgánica de Educación Intercultural y demás normativas vigentes, certifica que él/la estudiante:</p></div>
                </div>

                <div class="row text-center">
                    <div class="col-12"><h6><?= $estudiante[0]['LAS_NM'].' '.$estudiante[0]['FIR_NM']; ?></h6></div>
                </div>

                <div class="row">
                    <div class="col-12 text-justify align-content-center"><p>del <?= $estudiante[0]['SEC_NM']; ?> <?= $estudiante[0]['PARALE']; ?>, obtuvo las siguientes calificaciones durante el presente año lectivo</p></div>
                </div>
                
                <br>

                <div class="row">
                    <div class="col-12 table-responsive">
                        <table border="2" class="table table-striped table-bordered" cellspacing="0" width= 80%>
                            <col style="width: 42%;" />
                            <col style="width: 20%;" />
                            <col style="width: 38%;" />
                            <thead>
                            <tr>
                                <th class="align-middle text-center" rowspan="2">ASIGNATURAS</th>
                                <th class="align-middle text-center" colspan="2">PROMEDIO ANUAL</th>
                            </tr>
                            <tr>
                                <th class="align-middle text-center"><small>CALIFICACION CUANTITATIVA</small></th>
                                <th class="align-middle text-center"><small>CALIFICACION CUALITATIVA</small></th>
                            </tr>
                            </thead>
                            <tbody>
  <?php 
                                if(count($estudiante) > 0)
                                {
                                  foreach($estudiante as $alumno)
                                  {
  ?>
                                      <tr>
                                          <td><?= $alumno['MAT_NM'] ?></td>
                                          <td class="text-center"><?= $alumno['PROFIN'] ?></td>
                                          <td class="text-left"><?= $alumno['PROFINLETTER']['SUB_NM'] ?></td>
                                      </tr>
  <?php 
                                  }
                                }
  ?>
                              <tr> 
                              <td>PROMEDIO GENERAL</td>
                              <td class="text-center"><?= $proStd[0]['proStd'] ?></td>
                              <td class="text-left"><?= $proStd[0]['proStdLetter']['SUB_NM'] ?></td>
                              </th>
                              <tr>
                              <td>EVALUACIÓN DEL COMPORTAMIENTO</td>
                              <td class="text-center"><?= $proDis['PROFIN'] ?></td>
                              <td class="text-left"><?= $proTab ?></td>
                              </tr>
                            </tbody>
                        </table>
                    </div>
                </div>

              <?php if($proSup != '') { ?>
              <div class="row mt-1">
                <div class="col-12"><p class="align-content-center">Por lo tanto es promovido/a al <strong><?= $proSup?> </strong><strong><?= $estudiante[0]['PARALE']; ?></strong></p></div>
              </div>
              <?php } ?>

              <div class="row mt-1">
                    <div class="col-12"><p class="align-content-center">Para certificar suscriben en unidad de acto el/la Rector(a) / Director(a) con el/la Secretario(a)</p></div>
              </div><br><br>

              <?php
                    break;
                }
  ?>

              <!-- --------------- Pie de Firmas ----------------- -->
              <br><br>
              <div class="row text-center mt-4 pt-4" style="font-size: 16px;"> 
                <?php
                  if($certip == 2)
                  {
  ?>
                    <div class="col-6">
                      <p class="mb-0"><?= $empresa['RECTOR']?></p>
                      <p><strong>Rector/a</strong></p>
                    </div>
                    <div class="col-6">
                      <p class="mb-0"><?= $empresa['SECRES']?></p>
                      <p><strong>Secretario/a General</strong></p>
                    </div>
  <?php
                  }elseif($certip == 1){
  ?>
                    <div class="col-12">
                      <p class="mb-0"><?= $empresa['SECRES']?></p>
                      <p><strong>Secretario/a General</strong></p>
                    </div>
  <?php
                  }
  ?>
              </div>

              <div class="row pt-3">
                  <div class="col-6 text-center">
                    <img src="<?= media(); ?>images/gobierno.png" style="width: 70%">
                  </div>
              </div>
          
              <div class="row d-print-none mt-2">
                  <div class="col-12 text-right">
                    <a class="btn btn-primary" onclick="printDiv('vscerone')"><i class="fa fa-print"></i> Imprimir</a>
                  </div>
              </div>
                
            </section>
         <?php  } ?>
      </div>
  </div>
</main>
