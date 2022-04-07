<main>
    <div class="app-title">
        <div>
            <h1><i class="fas fa-user-edit"></i>  <?= $data['page_title'] ?></h1>
        </div>
        <ul class="app-breadcrumb breadcrumb">
            <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
            <li class="breadcrumb-item"><a href="<?= base_url(); ?>Vsactmat">Retornar</a></li>
        </ul>
    </div>

    <div class="row">
      <div class="col-md-12">
 	<?php 
       		if(empty($data['maestro_detalle']))
     			{
 	?>
       				<p class="text-primary">Reporte sin Información.</p>
 	<?php 	
          }else{ 
     				    $empresa  = $data['maestro_detalle']['empresa'];
     				    $acta     = $data['maestro_detalle']['acta'];
                $insumos  = $data['maestro_detalle']['insumos'];
                $parcial  = $data['maestro_detalle']['parcial'];
                $Pun001   = '';
                $Pun002   = '';
                $Pun003   = '';
                $Pun004   = '';
                $Pun005   = '';
                $Pun006   = '';
                $Pun007   = '';
                $Pun008   = '';

                $jornada = $acta[0]['JOR_NO'];
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

                $mparci  = '';
                switch($parcial)
                {
                    case 'Q1P1PR':
                        $parcial = '1º Quimestre - 1º Parcial';
                        $Pun001  = 'Q1P1I1';
                        $Pun002  = 'Q1P1I2';
                        $Pun003  = 'Q1P1I3';
                        $Pun004  = 'Q1P1I4';
                        $Pun005  = 'Q1P1I5';
                        $Pun006  = 'Q1P1DI';
                        $Pun007  = 'Q1P1MD';
                        $Pun008  = 'Q1P1PR';
                        $mparci  = 'parcial';
                        break;
                    case 'Q1P2PR':
                        $parcial = '1º Quimestre - 2º Parcial';
                        $Pun001  = 'Q1P2I1';
                        $Pun002  = 'Q1P2I2';
                        $Pun003  = 'Q1P2I3';
                        $Pun004  = 'Q1P2I4';
                        $Pun005  = 'Q1P2I5';
                        $Pun006  = 'Q1P2DI';
                        $Pun007  = 'Q1P2MD';
                        $Pun008  = 'Q1P2PR';
                        $mparci  = 'parcial';
                        break;
                    case 'Q1P3PR':
                        $parcial = '1º Quimestre - 3º Parcial';
                        $Pun001  = 'Q1P3I1';
                        $Pun002  = 'Q1P3I2';
                        $Pun003  = 'Q1P3I3';
                        $Pun004  = 'Q1P3I4';
                        $Pun005  = 'Q1P3I5';
                        $Pun006  = 'Q1P3DI';
                        $Pun007  = 'Q1P3MD';
                        $Pun008  = 'Q1P3PR';
                        $mparci  = 'parcial';
                        break;
                    case 'Q1P1PY':
                        $parcial = '1º Quimestre - 1º Parcial Proyecto';
                        $Pun001  = 'Q1P1DI';
                        $Pun002  = 'Q1P1MD';
                        $mparci  = 'proyecto';
                        break;
                    case 'Q1P2PY':
                        $parcial = '1º Quimestre - 2º Parcial Proyecto';
                        $Pun001  = 'Q1P2DI';
                        $Pun002  = 'Q1P2MD';
                        $mparci  = 'proyecto';
                        break;
                    case 'Q1_PRO':
                        $parcial = '1º Quimestre';
                        $Pun001  = 'Q1P1PR';
                        $Pun002  = 'Q1P2PR';
                        $Pun003  = 'Q1P3PR';
                        $Pun004  = 'Q1P4PR';
                        $Pun005  = 'Q1_PRO';
                        $mparci  = 'quimestre';
                        break;
                    case 'Q2P1PR':
                        $parcial = '2º Quimestre - 1º Parcial';
                        $Pun001  = 'Q2P1I1';
                        $Pun002  = 'Q2P1I2';
                        $Pun003  = 'Q2P1I3';
                        $Pun004  = 'Q2P1I4';
                        $Pun005  = 'Q2P1I5';
                        $Pun006  = 'Q2P1DI';
                        $Pun007  = 'Q2P1MD';
                        $Pun008  = 'Q2P1PR';
                        $mparci  = 'parcial';
                        break;
                    case 'Q2P2PR':
                        $parcial = '2º Quimestre - 2º Parcial';
                        $Pun001  = 'Q2P2I1';
                        $Pun002  = 'Q2P2I2';
                        $Pun003  = 'Q2P2I3';
                        $Pun004  = 'Q2P2I4';
                        $Pun005  = 'Q2P2I5';
                        $Pun006  = 'Q2P2DI';
                        $Pun007  = 'Q2P2MD';
                        $Pun008  = 'Q2P2PR';
                        $mparci  = 'parcial';
                        break;
                    case 'Q2P3PR':
                        $parcial = '2º Quimestre - 3º Parcial';
                        $Pun001  = 'Q2P3I1';
                        $Pun002  = 'Q2P3I2';
                        $Pun003  = 'Q2P3I3';
                        $Pun004  = 'Q2P3I4';
                        $Pun005  = 'Q2P3I5';
                        $Pun006  = 'Q2P3DI';
                        $Pun007  = 'Q2P3MD';
                        $Pun008  = 'Q2P3PR';
                        $mparci  = 'parcial';
                        break;
                    case 'Q2P1PY':
                        $parcial = '2º Quimestre - 1º Parcial Proyecto';
                        $Pun001  = 'Q2P1DI';
                        $Pun002  = 'Q2P1MD';
                        $mparci  = 'proyecto';
                        break;
                    case 'Q2P2PY':
                        $parcial = '2º Quimestre - 2º Parcial Proyecto';
                        $Pun001  = 'Q2P2DI';
                        $Pun002  = 'Q2P2MD';
                        $mparci  = 'proyecto';
                        break;
                    case 'Q2_PRO':
                        $parcial = '2º Quimestre';
                        $Pun001  = 'Q2P1PR';
                        $Pun002  = 'Q2P2PR';
                        $Pun003  = 'Q2P3PR';
                        $Pun004  = 'Q2P4PR';
                        $Pun005  = 'Q2_PRO';
                        $mparci  = 'quimestre';
                        break;
                    case 'SUPLET':
                        $parcial = 'Supletorio';
                        $Pun001  = 'Q1_PRO';
                        $Pun002  = 'Q2_PRO';
                        $Pun003  = 'SUPLET';
                        $Pun008  = 'PROFIN';
                        $mparci  = 'final';
                        break;
                    case 'REMEDI':
                        $parcial = 'Remedial';
                        $Pun001  = 'Q1_PRO';
                        $Pun002  = 'Q2_PRO';
                        $Pun003  = 'REMEDI';
                        $Pun008  = 'PROFIN';
                        $mparci  = 'final';
                        break;
                    case 'GRACIA':
                        $parcial = 'Gracia';
                        $Pun001  = 'Q1_PRO';
                        $Pun002  = 'Q2_PRO';
                        $Pun003  = 'GRACIA';
                        $Pun008  = 'PROFIN';
                        $mparci  = 'final';
                        break;
                }
              
                $arrPuntajes = array("1" => $Pun001,
                                     "2" => $Pun002,
                                     "3" => $Pun003,
                                     "4" => $Pun004,
                                     "5" => $Pun005,
                                     "6" => $Pun006,
                                     "7" => $Pun007,
                                     "8" => $Pun008
                                    );

                $jj = 0;
                foreach($acta as $alumno)
                {
                  $califi = $alumno['CALIFI'];

                  if($califi == 2)
                  {
                    $cuan01 = $alumno['CUAN01'];
                    $cuan02 = $alumno['CUAN02'];
                    $cuan03 = $alumno['CUAN03'];
                    $cuan04 = $alumno['CUAN04'];
                    $cuan05 = $alumno['CUAN05'];
                    $cuan06 = $alumno['CUAN06'];
                    $cuan07 = $alumno['CUAN07'];
                    $cuan08 = $alumno['CUAN08'];
                    $cuan09 = $alumno['CUAN09'];
                    $cuan10 = $alumno['CUAN10'];

                    $cual01 = $alumno['CUAL01'];
                    $cual02 = $alumno['CUAL02'];
                    $cual03 = $alumno['CUAL03'];
                    $cual04 = $alumno['CUAL04'];
                    $cual05 = $alumno['CUAL05'];
                    $cual06 = $alumno['CUAL06'];
                    $cual07 = $alumno['CUAL07'];
                    $cual08 = $alumno['CUAL08'];
                    $cual09 = $alumno['CUAL09'];
                    $cual10 = $alumno['CUAL10'];

                    for($i = 1; $i <= 6; $i++)
                    {
                      $var = $arrPuntajes[$i];
                      
                      if($alumno[$var] > $cuan09 and $alumno[$var] <= $cuan10)
                      {
                        $acta[$jj][$var] = $cual10;
                      }else if($alumno[$var] > $cuan08 and $alumno[$var] <= $cuan09) {
                        $acta[$jj][$var] = $cual09;
                      }else if($alumno[$var] > $cuan07 and $alumno[$var] <= $cuan08) {
                        $acta[$jj][$var] = $cual08;
                      }else if($alumno[$var] > $cuan06 and $alumno[$var] <= $cuan07) {
                        $acta[$jj][$var] = $cual07;
                      }else if($alumno[$var] > $cuan05 and $alumno[$var] <= $cuan06) {
                        $acta[$jj][$var] = $cual06;
                      }else if($alumno[$var] > $cuan04 and $alumno[$var] <= $cuan05) {
                        $acta[$jj][$var] = $cual05;
                      }else if($alumno[$var] > $cuan03 and $alumno[$var] <= $cuan04) {
                        $acta[$jj][$var] = $cual04;
                      }else if($alumno[$var] > $cuan02 and $alumno[$var] <= $cuan03) {
                        $acta[$jj][$var] = $cual03;
                      }else if($alumno[$var] >= $cuan01 and $alumno[$var] <= $cuan02) {
                        $acta[$jj][$var] = $cual02;
                      }else{
                        $acta[$jj][$var] = ' ';
                      }
                    } 
                  }
                  $jj++;
                }
  ?>
          <section id="vsactone" class="invoice">
              <div class="row mb-4">
                  <div class="col-4 mt-3 text-center">
                      <h2 class="page-header"><img src="<?= media(); ?><?= $empresa['LOGOIN'] ?>" style="width: 30%"></h2>
                  </div>
              </div>

              <div class="row">
                  <div class="col-12 table-responsive">
                      <table id="tblData" class="table table-striped table-bordered" cellspacing="0" width= 100%>
                      <thead>
  <?php 
                      switch($mparci)
                      {  
                        case 'parcial':
  ?>
                          <th class="text-center">Fecha: <?= date("d") . "-" . date("M") . "-" . date("Y"); ?></th>
                          <th class="text-center">Sección: <?= $acta[0]['SEC_NM'].' - '.$acta[0]['PARALE']; ?></th>
                          <th class="text-center">Jornada: <?= $jornada; ?></th>
                          <th class="text-center">Asignatura: <?= $acta[0]['MAT_NM']; ?></th>
                          <th class="text-center">Periodo: <?= $parcial; ?></th>
                          <th class="text-center">Año: <?= $acta[0]['PERIOS']; ?></th>
                          <th class="text-center"></th>
                          <th class="text-center"></th>
                          <th class="text-center"></th>
                          <tr><br>
                          <th class="text-center">Estudiante</th>
                          <th class="text-center"><?= $insumos['0']['SUB_NM'] ?></th>
                          <th class="text-center"><?= $insumos['1']['SUB_NM'] ?></th>
                          <th class="text-center"><?= $insumos['2']['SUB_NM'] ?></th>
                          <th class="text-center"><?= $insumos['3']['SUB_NM'] ?></th>
                          <th class="text-center"><?= $insumos['4']['SUB_NM'] ?></th>
                          <th class="text-center">Proyecto DI</th>
                          <th class="text-center">Proyecto ID</th>
                          <th class="text-center">Parcial</th>
  <?php
                          break;
                        case 'proyecto':
  ?>
                          <th class="text-center">Fecha: <?= date("d") . "-" . date("M") . "-" . date("Y"); ?></th>
                          <th class="text-center">Sección: <?= $acta[0]['SEC_NM'].' - '.$acta[0]['PARALE']; ?></th>
                          <th class="text-center">Jornada: <?= $jornada; ?></th>
                          <th class="text-center">Asignatura: <?= $acta[0]['MAT_NM']; ?></th>
                          <th class="text-center">Periodo: <?= $parcial; ?></th>
                          <th class="text-center">Año: <?= $acta[0]['PERIOS']; ?></th>
                          <tr><br>
                          <th class="text-center">Estudiante</th>
                          <th class="text-center">Proyecto DI</th>
                          <th class="text-center">Proyecto MD</th>
                          <th></th>
                          <th></th>
                          <th></th>
  <?php
                          break;
                        case 'quimestre';
  ?>
                          <th class="text-center">Fecha: <?= date("d") . "-" . date("M") . "-" . date("Y"); ?></th>
                          <th class="text-center">Sección: <?= $acta[0]['SEC_NM'].' - '.$acta[0]['PARALE']; ?></th>
                          <th class="text-center">Jornada: <?= $jornada; ?></th>
                          <th class="text-center">Asignatura: <?= $acta[0]['MAT_NM']; ?></th>
                          <th class="text-center">Periodo: <?= $parcial; ?></th>
                          <th class="text-center">Año: <?= $acta[0]['PERIOS']; ?></th>
                          <tr><br>
                          <th class="text-center">Estudiante</th>
                          <th class="text-center">P1</th>
                          <th class="text-center">P2</th>
                          <th class="text-center">P3</th>
                          <th class="text-center">EX</th>
                          <th class="text-center">Prom Quimestre</th>
  <?php
                          break;
                        case 'final';
  ?>
                          <th class="text-center">Fecha: <?= date("d") . "-" . date("M") . "-" . date("Y"); ?></th>
                          <th class="text-center">Sección: <?= $acta[0]['SEC_NM'].' - '.$acta[0]['PARALE']; ?></th>
                          <th class="text-center">Jornada: <?= $jornada; ?></th>
                          <th class="text-center">Asignatura: <?= $acta[0]['MAT_NM']; ?></th>
                          <th class="text-center">Periodo: <?= $parcial; ?></th>
                          <th class="text-center">Año: <?= $acta[0]['PERIOS']; ?></th>
                          <th class="text-center"></th>
                          <tr><br>
                          <th class="text-center">Estudiante</th>
                          <th class="text-center">Q1</th>
                          <th class="text-center">Q2</th>
                          <th class="text-center">SUPLET</th>
                          <th class="text-center">REMEDIAL</th>
                          <th class="text-center">GRACIA</th>
                          <th class="text-center">FINAL</th>
  <?php 
                          break;
                      }
  ?>
                      </tr>
                      </thead>
                    <tbody>
  <?php 
                        $NAAR = 0;
                        $PAAR = 0;
                        $AAR  = 0;
                        $DAR  = 0;
                   			foreach($acta as $alumno)
                 			  {
                          switch($mparci)
                          {  
                            case 'parcial';
  ?>
                              <tr>
                              <td><?= $alumno['LAS_NM'].' '.$alumno['FIR_NM'] ?></td>
                              <td class="text-center"><?= $alumno[$Pun001] ?></td>
                              <td class="text-center"><?= $alumno[$Pun002] ?></td>
                              <td class="text-center"><?= $alumno[$Pun003] ?></td>
                              <td class="text-center"><?= $alumno[$Pun004] ?></td>
                              <td class="text-center"><?= $alumno[$Pun005] ?></td>
                              <td class="text-center"><?= $alumno[$Pun006] ?></td>
                              <td class="text-center"><?= $alumno[$Pun007] ?></td>
                              <td class="text-center"><?= $alumno[$Pun008] ?></td>
  <?php 
                              if($alumno[$Pun008] >= 0.00 && $alumno[$Pun008] < 4.01)
                              {
                                $NAAR = $NAAR + 1;
                              }elseif($alumno[$Pun008] >= 4.01 && $alumno[$Pun008] < 7.00) {
                                $PAAR = $PAAR + 1;
                              }elseif($alumno[$Pun008] >= 7.00 && $alumno[$Pun008] < 9.00) {
                                $AAR = $AAR + 1;
                              }else{
                                $DAR = $DAR + 1;
                              }
                              break;
                            case 'proyecto';
  ?>
                              <tr>
                              <td><?= $alumno['LAS_NM'].' '.$alumno['FIR_NM'] ?></td>
                              <td class="text-center"><?= $alumno[$Pun001] ?></td>
                              <td class="text-center"><?= $alumno[$Pun002] ?></td>
                              <td class="text-center"></td>
                              <td class="text-center"></td>
                              <td class="text-center"></td>
  <?php 
                              break;
                            case 'quimestre';
  ?>
                              <tr>
                              <td><?= $alumno['LAS_NM'].' '.$alumno['FIR_NM'] ?></td>
                              <td class="text-center"><?= $alumno[$Pun001] ?></td>
                              <td class="text-center"><?= $alumno[$Pun002] ?></td>
                              <td class="text-center"><?= $alumno[$Pun003] ?></td>
                              <td class="text-center"><?= $alumno[$Pun004] ?></td>
                              <td class="text-center"><?= $alumno[$Pun005] ?></td>
  <?php 
                              if($alumno[$Pun005] >= 0.00 && $alumno[$Pun005] < 4.01)
                              {
                                $NAAR = $NAAR + 1;
                              }elseif($alumno[$Pun005] >= 4.01 && $alumno[$Pun005] < 7.00) {
                                $PAAR = $PAAR + 1;
                              }elseif($alumno[$Pun005] >= 7.00 && $alumno[$Pun005] < 9.00) {
                                $AAR = $AAR + 1;
                              }else{
                                $DAR = $DAR + 1;
                              }
                              break;
                            case 'final';
  ?>
                              <tr>
                              <td><?= $alumno['LAS_NM'].' '.$alumno['FIR_NM'] ?></td>
                              <td class="text-center"><?= $alumno[$Pun001] ?></td>
                              <td class="text-center"><?= $alumno[$Pun002] ?></td>
                              <td class="text-center"><?= $alumno[$Pun003] ?></td>
                              <td class="text-center"><?= $alumno[$Pun004] ?></td>
                              <td class="text-center"><?= $alumno[$Pun005] ?></td>
                              <td class="text-center"><?= $alumno[$Pun006] ?></td>
  <?php
                              if($alumno[$Pun006] >= 0.00 && $alumno[$Pun006] < 4.01)
                              {
                                $NAAR = $NAAR + 1;
                              }elseif($alumno[$Pun006] >= 4.01 && $alumno[$Pun006] < 7.00) {
                                $PAAR = $PAAR + 1;
                              }elseif($alumno[$Pun006] >= 7.00 && $alumno[$Pun006] < 9.00) {
                                $AAR = $AAR + 1;
                              }else{
                                $DAR = $DAR + 1;
                              }
                              break;
                          }
                     		}
  ?>
                    </tbody>
                  </table>
                </div>
            </div>

            <div class="row"> 
                <div class="col-md-6">  
                    <strong>DAR</strong>  - <small>Domina Aprendizaje Requerido</small> : <?= $DAR ?> <br>
                    <strong>AAR</strong>  - <small>Alcanza Aprendizaje Requerido</small> : <?= $AAR ?> <br>
                    <strong>PAAR</strong> - <small>Próx. Alcanzar Aprendizaje Requerido</small> : <?= $PAAR ?> <br>
                    <strong>NAAR</strong> - <small>No Alcanza Aprendizaje Requerido</small> : <?= $NAAR ?> <br>
                </div>  
            </div>

            <div class="row">
              <div class="col-12 text-center pt-4">
                  <address>
                        <strong>Secretaria General</strong><br>
                  </address>
              </div>  
            </div> 

            <div class="row d-print-none mt-2">
                <div class="col-12 text-right">
                    <a class="btn btn-primary" onclick="printDiv('vsactone')"><i class="fa fa-print"></i> Imprimir</a>
                    <a class="btn btn-warning" onclick="exportTableToExcel('tblData')"><i class="far fa-file-excel"></i> Exportar EXCEL</a>
                </div>
            </div>
          </section>
  <?php  
          }
  ?>      
      </div>
  </div>
</main>
