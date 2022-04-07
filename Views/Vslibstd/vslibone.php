
<main>
  <div class="app-title">
      <div>
        <h1><i class="fas fa-user-edit"></i>  <?= $data['page_title'] ?></h1>
      </div>
      <ul class="app-breadcrumb breadcrumb">
        <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
        <li class="breadcrumb-item"><a href="<?= base_url(); ?>Vslibstd">Retornar</a></li>
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
       				$empresa    = $data['maestro_detalle']['empresa'];
       				$estudiante = $data['maestro_detalle']['estudiante'];
              $insumos    = $data['maestro_detalle']['insumos'];
              $parcial    = $data['maestro_detalle']['parcial'];
              $debstd     = $data['maestro_detalle']['debstd'];
              $Pun001     = '';
              $Pun002     = '';
              $Pun003     = '';
              $Pun004     = '';
              $Pun005     = '';
              $Pun006     = '';
              $Pun007     = '';
              $Pun008     = '';
  
              switch($estudiante[0]['JOR_NO'])
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

              $mparci       = true;
              $mfinal       = false;
              switch(substr($parcial,0,4))
              {
                case 'Q1P1':
                    $parcial = '1º Quimestre - 1º Parcial';
                    $Pun001 = 'Q1P1I1';
                    $Pun002 = 'Q1P1I2';
                    $Pun003 = 'Q1P1I3';
                    $Pun004 = 'Q1P1I4';
                    $Pun005 = 'Q1P1I5';
                    $Pun006 = 'Q1P1DI';
                    $Pun007 = 'Q1P1MD';
                    $Pun008 = 'Q1P1PR';
                    break;
                case 'Q1P2':
                    $parcial = '1º Quimestre - 2º Parcial';
                    $Pun001 = 'Q1P2I1';
                    $Pun002 = 'Q1P2I2';
                    $Pun003 = 'Q1P2I3';
                    $Pun004 = 'Q1P2I4';
                    $Pun005 = 'Q1P2I5';
                    $Pun006 = 'Q1P2DI';
                    $Pun007 = 'Q1P2MD';
                    $Pun008 = 'Q1P2PR';
                    break;
                case 'Q1P3':
                    $parcial = '1º Quimestre - 3º Parcial';
                    $Pun001 = 'Q1P3I1';
                    $Pun002 = 'Q1P3I2';
                    $Pun003 = 'Q1P3I3';
                    $Pun004 = 'Q1P3I4';
                    $Pun005 = 'Q1P3I5';
                    $Pun006 = 'Q1P3DI';
                    $Pun007 = 'Q1P3MD';
                    $Pun008 = 'Q1P3PR';
                    break;
                case 'Q1_P':
                    $parcial = '1º Quimestre';
                    $Pun001 = 'Q1P1PR';
                    $Pun002 = 'Q1P2PR';
                    $Pun003 = 'Q1P3PR';
                    $Pun004 = 'Q1P4PR';
                    $Pun005 = 'Q1_PRO';
                    $mparci = false;
                    break;
                case 'Q2P1':
                    $parcial = '2º Quimestre - 1º Parcial';
                    $Pun001 = 'Q2P1I1';
                    $Pun002 = 'Q2P1I2';
                    $Pun003 = 'Q2P1I3';
                    $Pun004 = 'Q2P1I4';
                    $Pun005 = 'Q2P1I5';
                    $Pun006 = 'Q2P1DI';
                    $Pun007 = 'Q2P1MD';
                    $Pun008 = 'Q2P1PR';
                    break;
                case 'Q2P2':
                    $parcial = '2º Quimestre - 2º Parcial';
                    $Pun001 = 'Q2P2I1';
                    $Pun002 = 'Q2P2I2';
                    $Pun003 = 'Q2P2I3';
                    $Pun004 = 'Q2P2I4';
                    $Pun005 = 'Q2P2I5';
                    $Pun006 = 'Q2P2DI';
                    $Pun007 = 'Q2P2MD';
                    $Pun008 = 'Q2P2PR';
                    break;
                case 'Q2P3':
                    $parcial = '2º Quimestre - 3º Parcial';
                    $Pun001 = 'Q2P3I1';
                    $Pun002 = 'Q2P3I2';
                    $Pun003 = 'Q2P3I3';
                    $Pun004 = 'Q2P3I4';
                    $Pun005 = 'Q2P3I5';
                    $Pun006 = 'Q2P3DI';
                    $Pun007 = 'Q2P3MD';
                    $Pun008 = 'Q2P3PR';
                    break;
                case 'Q2_P':
                    $parcial = '2º Quimestre';
                    $Pun001 = 'Q2P1PR';
                    $Pun002 = 'Q2P2PR';
                    $Pun003 = 'Q2P3PR';
                    $Pun004 = 'Q2P4PR';
                    $Pun005 = 'Q2_PRO';
                    $mparci = false;
                    break;
                case 'PROF':
                    $parcial = 'Promedio Final';
                    $Pun001 = 'Q1_PRO';
                    $Pun002 = 'Q2_PRO';
                    $Pun003 = 'SUPLET';
                    $Pun004 = 'REMEDI';
                    $Pun005 = 'GRACIA';
                    $Pun006 = 'PROFIN';
                    $mparci = false;
                    $mfinal = true;
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
              foreach($estudiante as $alumno)
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

                    for($i = 1; $i <= 5; $i++)
                    {
                      $var = $arrPuntajes[$i];
                      
                      if($alumno[$var] > $cuan09 and $alumno[$var] <= $cuan10)
                      {
                        $estudiante[$jj][$var] = $cual10;
                      
                      }else if($alumno[$var] > $cuan08 and $alumno[$var] <= $cuan09) {
                        $estudiante[$jj][$var] = $cual09;
                      
                      }else if($alumno[$var] > $cuan07 and $alumno[$var] <= $cuan08) {
                        $estudiante[$jj][$var] = $cual08;
                      
                      }else if($alumno[$var] > $cuan06 and $alumno[$var] <= $cuan07) {
                        $estudiante[$jj][$var] = $cual07;
                      
                      }else if($alumno[$var] > $cuan05 and $alumno[$var] <= $cuan06) {
                        $estudiante[$jj][$var] = $cual06;
                      
                      }else if($alumno[$var] > $cuan04 and $alumno[$var] <= $cuan05) {
                        $estudiante[$jj][$var] = $cual05;
                      
                      }else if($alumno[$var] > $cuan03 and $alumno[$var] <= $cuan04) {
                        $estudiante[$jj][$var] = $cual04;
                      
                      }else if($alumno[$var] > $cuan02 and $alumno[$var] <= $cuan03) {
                        $estudiante[$jj][$var] = $cual03;
                      
                      }else if($alumno[$var] >= $cuan01 and $alumno[$var] <= $cuan02) {
                        $estudiante[$jj][$var] = $cual02;
                      
                      }else{
                        $estudiante[$jj][$var] = ' ';
                      }
                    }                                        
                  }
                  $jj++;
              }
  ?>
              <section id="vslibone" class="invoice">
              <div class="row mb-4">
                  <div class="col-4 mt-3 text-center">
                      <h2 class="page-header"><img src="<?= media(); ?><?= $empresa['LOGOIN'] ?>" style="width: 30%"></h2>
                  </div>
              </div>

              <div class="row invoice-info">
                  <div class="col-2 text-right">  
                      <strong>Fecha: </strong>
                  </div>
                  <div class="col-9">
                      <?= date("d") . "-" . date("M") . "-" . date("Y"); ?>
                  </div>
                  
                  <div class="col-2 text-right">  
                      <strong>Sección: </strong>
                  </div>
                  <div class="col-9">
                      <?= $estudiante[0]['SEC_NM']; ?>
                  </div>
              
                  <div class="col-2 text-right">  
                      <strong>Paralelo: </strong>
                  </div>
                  <div class="col-9">
                      <?= $estudiante[0]['PARALE']; ?>
                  </div>

                  <div class="col-2 text-right">
                      <strong>Jornada: </strong>
                  </div>
                  <div class="col-9">
                      <?= $jornada; ?>
                  </div>

                  <div class="col-2 text-right">
                      <strong>Estudiante: </strong>
                  </div>
                  <div class="col-9">
                      <?= $estudiante[0]['LAS_NM'].' '.$estudiante[0]['FIR_NM']; ?>
                  </div>
                    
                  <div class="col-2 text-right">
                      <strong>Periodo: </strong>
                  </div>
                  <div class="col-9">
                      <?= $parcial; ?>
                  </div>
              </div>

              <div class="row">
                  <div class="col-12 table-responsive">
                      <table class="table table-striped table-bordered" cellspacing="0" width= 100%>
                      <thead>
                      <tr><br>
  <?php
                      if($mparci)
                      {  
  ?>
                          <th class="text-center">Asignatura</th>
                          <th class="text-center"><?= $insumos['0']['SUB_NM'] ?></th>
                          <th class="text-center"><?= $insumos['1']['SUB_NM'] ?></th>
                          <th class="text-center"><?= $insumos['2']['SUB_NM'] ?></th>
                          <th class="text-center"><?= $insumos['3']['SUB_NM'] ?></th>
                          <th class="text-center"><?= $insumos['4']['SUB_NM'] ?></th>
                          <th class="text-center">Parcial</th>
  <?php
                      }else if($mfinal){
  ?>
                          <th class="text-center">Asignatura</th>
                          <th class="text-center">Q1</th>
                          <th class="text-center">Q2</th>
                          <th class="text-center">SUPLET</th>
                          <th class="text-center">REMEDIAL</th>
                          <th class="text-center">GRACIA</th>
                          <th class="text-center">FINAL</th>
  <?php
                      }else{
  ?>
                          <th class="text-center">Asignatura</th>
                          <th class="text-center">P1</th>
                          <th class="text-center">P2</th>
                          <th class="text-center">P3</th>
                          <th class="text-center">EX</th>
                          <th class="text-center">Promedio Quimestre</th>
  <?php
                      }
  ?>
                          </tr>
                    </thead>
                    <tbody>
  <?php 
                  		if(count($estudiante) > 0)
                   		{
                    		foreach($estudiante as $student)
                   			{
  ?>
                          <tr>
                          <td class="text-left"><?= $student['MAT_NM'] ?></td>  
  <?php 
                          if(empty($debstd))
                          {
                            if($mparci)
                            {  
  ?>
                              <td class="text-center"><?= $student[$Pun001] ?></td>
                              <td class="text-center"><?= $student[$Pun002] ?></td>
                              <td class="text-center"><?= $student[$Pun003] ?></td>
                              <td class="text-center"><?= $student[$Pun004] ?></td>
                              <td class="text-center"><?= $student[$Pun005] ?></td>
                              <td class="text-center"><?= $student[$Pun008] ?></td>
  <?php 
                            }else if($mfinal){
  ?>
                              <td class="text-center"><?= $student[$Pun001] ?></td>
                              <td class="text-center"><?= $student[$Pun002] ?></td>
                              <td class="text-center"><?= $student[$Pun003] ?></td>
                              <td class="text-center"><?= $student[$Pun004] ?></td>
                              <td class="text-center"><?= $student[$Pun005] ?></td>
                              <td class="text-center"><?= $student[$Pun006] ?></td>
  <?php
                            }else{
  ?>
                              <td class="text-center"><?= $student[$Pun001] ?></td>
                              <td class="text-center"><?= $student[$Pun002] ?></td>
                              <td class="text-center"><?= $student[$Pun003] ?></td>
                              <td class="text-center"><?= $student[$Pun004] ?></td>
                              <td class="text-center"><?= $student[$Pun005] ?></td>
  <?php 
                       		  }
                       	  }
                        }
                      }
  ?>
                    </tbody>
                  </table>
                </div>
            </div>

            <div class="row">
              <div class="col-12 text-center pt-4">
                  <address>
                        <strong>Secretaria General</strong><br>
                  </address>
              </div>
            </div>
                
            <div class="row pt-3">
              <div class="col-12 text-center">
                  <address>
                        <small><strong>Dirección: </strong><?= $empresa['ADDRES'] ?></small>
                        <small><strong> - Email: </strong><?= $empresa['EMAILS'] ?></small>
                        <small><strong> - Teléfono(s): </strong><?= $empresa['TPHONE'] ?></small>
                  </address>  
              </div>
            </div>
          
            <div class="row d-print-none mt-2">
                <div class="col-12 text-right">
                    <a class="btn btn-primary" onclick="printDiv('vslibone')"><i class="fa fa-print"></i> Imprimir</a>                  
                </div>
            </div>
          </section>
  <?php
        }
  ?>      
      </div>
  </div>
</main>

