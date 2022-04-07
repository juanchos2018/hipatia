
<main>
  <div class="app-title">
      <div>
          <h1><i class="fas fa-user-edit"></i>  <?= $data['page_title'] ?></h1>
      </div>
      <ul class="app-breadcrumb breadcrumb">
          <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
          <li class="breadcrumb-item"><a href="<?= base_url(); ?>Vsactsec">Retornar</a></li>
      </ul>
  </div>
       
  <?php 
   		if(empty($data['maestro_detalle']['materias']))
  		{
  ?>
  			<p class="text-primary">Reporte sin Información.</p>
  <?php
      }else{ 
  				$empresa  = $data['maestro_detalle']['empresa'];
	  			$materias = $data['maestro_detalle']['materias'];
          $matxstd  = $data['maestro_detalle']['matxstd'];
          $pro_01   = $data['maestro_detalle']['pro_01'];
          $pro_02   = $data['maestro_detalle']['pro_02'];
          $proStd   = $data['maestro_detalle']['proStd'];
          $parcial  = $data['maestro_detalle']['parcial'];
          $periodo  = $data['maestro_detalle']['periodo'];
          $seccion  = $materias[0]['SEC_NM'];
          $paralelo = $materias[0]['PARALE'];
          $jornada  = $materias[0]['JOR_NO'];
          $num_mat  = count($materias); 
          $regimen  = $data['maestro_detalle']['empresa']['REGIME'];

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

          $parcial_view = $parcial;
          switch($parcial)
          {
              case 'Q1P1PR':
                  $parcial = '1º Quimestre - 1º Parcial';
                  break;
              case 'Q1P2PR':
                  $parcial = '1º Quimestre - 2º Parcial';
                  break;
              case 'Q1P3PR':
                  $parcial = '1º Quimestre - 3º Parcial';
                  break;
              case 'Q1_PRO':
                  $parcial = '1º Quimestre';
                  break;
              case 'Q2P1PR':
                  $parcial = '2º Quimestre - 1º Parcial';
                  break;
              case 'Q2P2PR':
                  $parcial = '2º Quimestre - 2º Parcial';
                  break;
              case 'Q2P3PR':
                  $parcial = '2º Quimestre - 3º Parcial';
                  break;
              case 'Q2_PRO':
                  $parcial = '2º Quimestre';
                  break;
              case 'PROFIN':
                  $parcial = 'Promedio Final Resumido';
                  break;
              case 'PROMED':
                  $parcial = 'Promedio Final';
                  break;
              case 'SUPLET':
                  $parcial = 'Supletorios';
                  break;
              case 'REMEDI':
                  $parcial = 'Remedial';
                  break;
              case 'GRACIA':
                  $parcial = 'Gracia';
                  break;
          }

          $arrPuntajes = array("1" => "nota",
                               "2" => "PRGN",
                               "3" => "SUPL",
                               "4" => "RMDL",
                               "5" => "GRCI",
                               "6" => "PRFN"
                              );
          $celda = 0;
          foreach($matxstd as $alumno)
          {
            $califi = $alumno['calificacion'];

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

              $ini = 1;
              $end = 1;
              if($parcial == 'Promedio Final')
              {
                $ini = 2;
                $end = 6;
              }
          
              for($i = $ini; $i <= $end; $i++)
              {
                  $var = $arrPuntajes[$i];

                  if($alumno[$var] > $cuan09 and $alumno[$var] <= $cuan10)
                  {
                    $matxstd[$celda][$var] = $cual10;
                  }elseif($alumno[$var] > $cuan08 and $alumno[$var] <= $cuan09) {
                    $matxstd[$celda][$var] = $cual09;
                  }elseif($alumno[$var] > $cuan07 and $alumno[$var] <= $cuan08) {
                    $matxstd[$celda][$var] = $cual08;
                  }elseif($alumno[$var] > $cuan06 and $alumno[$var] <= $cuan07) {
                    $matxstd[$celda][$var] = $cual07;
                  }elseif($alumno[$var] > $cuan05 and $alumno[$var] <= $cuan06) {
                    $matxstd[$celda][$var] = $cual06;
                  }elseif($alumno[$var] > $cuan04 and $alumno[$var] <= $cuan05) {
                    $matxstd[$celda][$var] = $cual05;
                  }elseif($alumno[$var] > $cuan03 and $alumno[$var] <= $cuan04) {
                    $matxstd[$celda][$var] = $cual04;
                  }elseif($alumno[$var] > $cuan02 and $alumno[$var] <= $cuan03) {
                    $matxstd[$celda][$var] = $cual03;
                  }elseif($alumno[$var] >= $cuan01 and $alumno[$var] <= $cuan02) {
                    $matxstd[$celda][$var] = $cual02;
                  }else{
                    $matxstd[$celda][$var] = ' ';
                  }
              }
          }
          $celda++;
        }         
  ?>
          <!-----------  Inicio Diseño de Impresion Cuadros  ---------->
          <div id="vssecone" class="invoice">
  <?php
              $num_reg = count($matxstd) - 1;
              $f = 0;

              for($j = 0; $j < count($matxstd); $j++)
              {
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
                      <div class="col-4"><strong>Año Lectivo: </strong><?= $periodo ?> - <?= $periodo + 1?></div>
                      <div class="col-4"><strong>Régimen: <?= $regimen?></strong></div>
                </div>
                <div class="row mt-4 text-center">
                      <div class="col-12"><h6>DISTRITO EDUCATIVO : <?= $empresa['DISTRI']?></h6></div>
                      <div class="col-12"><h5 class="mb-1"><?= $empresa['RAZONS']?></h5></div>
                      <div class="col-12"><h5>Cuadro de Calificaciones de <?= $parcial ?></h5></div>
                </div>
                <div class="row">
                      <div class="col-2 text-right"><strong>Sección:</strong></div>
                      <div class="col-10"><?= $seccion ?></div>
                      <div class="col-2 text-right"><strong>Paralelo:</strong></div>
                      <div class="col-10"><?= $paralelo ?></div>
                      <div class="col-2 text-right"><strong>Jornada:</strong></div>
                      <div class="col-10"><?= $jornada ?></div>
                </div>

                <!-------- Inicio Impresión de Tabla ------->
                <div class="row mt-1">
                    <div class="col-12">

                    <table id="CuadroFinal" style="border: 1px black solid;" class="table table-striped table-bordered" cellspacing="0" width="70%">
                        <col style="width: 4%;" />
  <?php
                          if($parcial == "Promedio Final") 
                          {
  ?>
                            <col style="width: 20%;" />
  <?php
                            for($i=1; $i<=($num_mat*5); $i++)
                            {
  ?>
                              <col style="width: 3%;" />
  <?php
                            }
                          }
  ?>
                        <thead>
                          <tr>
                              <th class="align-middle text-center" rowspan="2" style="font-size: 0.75rem;">#</th>
                              <th class="align-middle text-center" rowspan="2" style="font-size: 0.75rem;">Estudiante</th>
                                
  <?php
                              foreach($materias as $materia)
                              {
                                  if($parcial_view != "PROMED" AND $parcial_view != "SUPLET" AND $parcial_view != "REMEDI" AND $parcial_view != "GRACIA")
                                  {
  ?>
                                    <th class="vertical_text"><div><?= $materia['MAT_NM'] ?></div></th>
  <?php
                                  }else{
  ?>
                                    <th colspan="5" class="align-middle text-center" style="font-size: 0.65rem"><div><?= $materia['MAT_NM'] ?></div></th>  
  <?php     
                                  }
                              }

                              if($parcial_view == "Q1_PRO" OR $parcial_view == "Q2_PRO" OR $parcial_view == "PROMED" OR $parcial_view == "SUPLET" OR $parcial_view == "REMEDI" OR $parcial_view == "GRACIA") 
                              {
  ?>
                                  <th class="vertical_text" rowspan="2"><div>PROMEDIO</div></th>
                                  <th class="vertical_text" rowspan="2"><div>OBSERVACIÓN</div></th>
  <?php 
                              } 
  ?>
                          </tr>
                          <tr>
  <?php
                          if($parcial_view == "PROMED" OR $parcial_view == "SUPLET" OR $parcial_view == "REMEDI" OR $parcial_view == "GRACIA")
                          {
                            for($i = 1; $i <= $num_mat; $i++)
                            {
  ?>
                              <th class="text-center" style="font-size: 0.65rem">PR</th>
                              <th class="text-center" style="font-size: 0.65rem">SP</th>
                              <th class="text-center" style="font-size: 0.65rem">RM</th>
                              <th class="text-center" style="font-size: 0.65rem">GR</th>
                              <th class="text-center" style="font-size: 0.65rem">PF</th>
  <?php 
                            } 
                          } 
  ?> 
                          </tr>          
                        </thead>

                        <tbody>
  <?php 
                      		if(count($matxstd) > 0)
                      		{
                            $i = 1;
                            
                            while(true)
                     			  {
                              if($i <= $num_mat)
                              {
                                switch($i)
                                {
                                  case 1: $f = $f + 1;
                                          $control_fila_PROMED = 99;
  ?>
                                          <tr>
                                          <td style="font-size: 0.83rem"><?= $f ?></td>
                                          <td style="font-size: 0.83rem"><?= $matxstd[$j]['nombre'] ?></td>
  <?php
                                            if($parcial_view != "PROMED" AND $parcial_view != "SUPLET" AND $parcial_view != "REMEDI" AND $parcial_view != "GRACIA")
                                            {
  ?>
                                                <td class="center" style="font-size: 0.83rem"><?= $matxstd[$j]['nota']; ?></td>
  <?php
                                            }else{
                                                if($matxstd[$j]['SUPL'] == 0 AND $matxstd[$j]['materia'] != 'COMPORTAMIENTO')
                                                {
                                                    $matxstd[$j]['PRGN'] = $matxstd[$j]['PRFN'];   
                                                }

                                                switch($parcial_view)
                                                {
                                                    case 'SUPLET':
                                                          if($matxstd[$j]['PRGN'] > 4 AND $matxstd[$j]['PRGN'] < 7)
                                                          {
  ?>
                                                          <td class="text-center" style="font-size: 0.83rem"><?= $matxstd[$j]['PRGN']; ?></td>
                                                          <td class="text-center" style="font-size: 0.83rem"><?= $matxstd[$j]['SUPL']; ?></td>
                                                          <td class="text-center" style="font-size: 0.83rem"><?= $matxstd[$j]['RMDL']; ?></td>
                                                          <td class="text-center" style="font-size: 0.83rem"><?= $matxstd[$j]['GRCI']; ?></td>
                                                          <td class="text-center" style="font-size: 0.83rem"><?= $matxstd[$j]['PRFN']; ?></td>
  <?php
                                                        }else{
  ?>
                                                          <td class="text-center" style="font-size: 0.83rem"></td>
                                                          <td class="text-center" style="font-size: 0.83rem"></td>
                                                          <td class="text-center" style="font-size: 0.83rem"></td>
                                                          <td class="text-center" style="font-size: 0.83rem"></td>
                                                          <td class="text-center" style="font-size: 0.83rem"></td>
  <?php                                                    
                                                        }
                                                        break;

                                                    case 'REMEDI':
                                                          if($matxstd[$j]['PRGN'] > 4 AND $matxstd[$j]['PRGN'] < 6)
                                                          {
  ?>
                                                            <td class="text-center" style="font-size: 0.83rem"><?= $matxstd[$j]['PRGN']; ?></td>
                                                            <td class="text-center" style="font-size: 0.83rem"><?= $matxstd[$j]['SUPL']; ?></td>
                                                            <td class="text-center" style="font-size: 0.83rem"><?= $matxstd[$j]['RMDL']; ?></td>
                                                            <td class="text-center" style="font-size: 0.83rem"><?= $matxstd[$j]['GRCI']; ?></td>
                                                            <td class="text-center" style="font-size: 0.83rem"><?= $matxstd[$j]['PRFN']; ?></td>
  <?php
                                                          }else{
  ?>
                                                            <td class="text-center" style="font-size: 0.83rem"></td>
                                                            <td class="text-center" style="font-size: 0.83rem"></td>
                                                            <td class="text-center" style="font-size: 0.83rem"></td>
                                                            <td class="text-center" style="font-size: 0.83rem"></td>
                                                            <td class="text-center" style="font-size: 0.83rem"></td>
  <?php                                                    
                                                          }
                                                          break;

                                                    case 'GRACIA':
                                                          if($matxstd[$j]['PRGN'] > 0 AND $matxstd[$j]['PRGN'] < 4)
                                                          {
  ?>
                                                            <td class="text-center" style="font-size: 0.83rem"><?= $matxstd[$j]['PRGN']; ?></td>
                                                            <td class="text-center" style="font-size: 0.83rem"><?= $matxstd[$j]['SUPL']; ?></td>
                                                            <td class="text-center" style="font-size: 0.83rem"><?= $matxstd[$j]['RMDL']; ?></td>
                                                            <td class="text-center" style="font-size: 0.83rem"><?= $matxstd[$j]['GRCI']; ?></td>
                                                            <td class="text-center" style="font-size: 0.83rem"><?= $matxstd[$j]['PRFN']; ?></td>
  <?php
                                                          }else{
  ?>
                                                            <td class="text-center" style="font-size: 0.83rem"></td>
                                                            <td class="text-center" style="font-size: 0.83rem"></td>
                                                            <td class="text-center" style="font-size: 0.83rem"></td>
                                                            <td class="text-center" style="font-size: 0.83rem"></td>
                                                            <td class="text-center" style="font-size: 0.83rem"></td>
  <?php                                                    
                                                          }
                                                          break;
                                                      
                                                    default:
  ?>
                                                        <td class="text-center" style="font-size: 0.83rem"><?= $matxstd[$j]['PRGN']; ?></td>
                                                        <td class="text-center" style="font-size: 0.83rem"><?= $matxstd[$j]['SUPL']; ?></td>
                                                        <td class="text-center" style="font-size: 0.83rem"><?= $matxstd[$j]['RMDL']; ?></td>
                                                        <td class="text-center" style="font-size: 0.83rem"><?= $matxstd[$j]['GRCI']; ?></td>
                                                        <td class="text-center" style="font-size: 0.83rem"><?= $matxstd[$j]['PRFN']; ?></td>
  <?php                                                    
                                                } 
                                              }
                                          break; 
                                  default:
                                          if($parcial_view != "PROMED" AND $parcial_view != "SUPLET" AND $parcial_view != "REMEDI" AND $parcial_view != "GRACIA")
                                          {
  ?>
                                              <td class="text-center" style="font-size: 0.83rem"><?= $matxstd[$j]['nota']; ?></td>
  <?php         
                                          }else{ 
                                              if($matxstd[$j]['SUPL'] == 0 AND $matxstd[$j]['materia'] != 'COMPORTAMIENTO')
                                              {
                                                  $matxstd[$j]['PRGN'] = $matxstd[$j]['PRFN'];   
                                              }
  ?>
                                              <td class="text-center" style="font-size: 0.83rem"><?= $matxstd[$j]['PRGN']; ?></td>
                                              <td class="text-center" style="font-size: 0.83rem"><?= $matxstd[$j]['SUPL']; ?></td>
                                              <td class="text-center" style="font-size: 0.83rem"><?= $matxstd[$j]['RMDL']; ?></td>
                                              <td class="text-center" style="font-size: 0.83rem"><?= $matxstd[$j]['GRCI']; ?></td>
                                              <td class="text-center" style="font-size: 0.83rem"><?= $matxstd[$j]['PRFN']; ?></td>
  <?php
                                            }
                                          break;
                                }  // fin de switch .....
                                
                                // $regStd = $f * $num_mat;  $regStd: indica la cantidad de registros en total colocados en tabla 
                                $i = $i + 1;
                                if($i > $num_mat)
                                {
                                    $i = 1;

                                    if($parcial_view == "Q1_PRO") 
                                    {
  ?>
                                        <td class="text-center" style="font-size: 0.83rem"><?= $pro_01[$f - 1]['pro_01'] ?></td>
  <?php
                                        if($pro_01[$f - 1]['pro_01'] > 0)
                                        {
  ?>
                                          <td class="text-center" style="font-size: 0.83rem">APROBADO</td>
  <?php         
                                        }else{ 
  ?>
                                          <td class="text-center" style="font-size: 0.83rem">SUPLETORIO</td>
  <?php         
                                        }
                                    }

                                    if($parcial_view == "Q2_PRO") 
                                    {
  ?>
                                        <td class="text-center" style="font-size: 0.83rem"><?= $pro_02[$f - 1]['pro_02'] ?></td>
  <?php
                                        if($pro_02[$f - 1]['pro_02'] > 0)
                                        {
  ?>
                                          <td class="text-center" style="font-size: 0.83rem">APROBADO</td>
  <?php         
                                        }else{ 
  ?>
                                          <td class="text-center" style="font-size: 0.83rem">SUPLETORIO</td>
  <?php         
                                        }
                                    }

                                    if($parcial_view == "PROMED" OR $parcial_view == "SUPLET" OR $parcial_view == "REMEDI" OR $parcial_view == "GRACIA") 
                                    {
                                        $control_fila_PROMED = $f % 4;
                                        if($parcial_view == "PROMED" AND $proStd[$f - 1]['proStd'] > 0)
                                        {
  ?>
                                          <td class="text-center" style="font-size: 0.83rem"><?= $proStd[$f - 1]['proStd'] ?></td>
                                          <td class="text-center" style="font-size: 0.83rem">APROBADO</td>
  <?php
                                        }else{
  ?>
                                          <td class="text-center" style="font-size: 0.83rem"></td>
                                          <td class="text-center" style="font-size: 0.83rem">SUPLETORIO</td>
  <?php
                                        }
                                    }
  ?>
                                  </tr>        
  <?php 
                                } 
                              }
                              
                              if($j == $num_reg)
                              {
                                break;
                              }
                                
                              if($control_fila_PROMED == 0)
                              {
                                 break;
                              }

                              $j = $j + 1;

                         		}   // foreach -- While TRUE
                         	}
  ?>
                        </tbody>
                    </table>
                  </div>
                </div>
                <!--------        FIN Tabla          ------->
                <br><br>

              <div class="row text-center mt-4 pt-4" style="font-size: 16px;"> 
                  <div class="col-6">
                      <p class="mb-0"><?= $empresa['RECTOR']?></p>
                      <p><strong>Rector/a</strong></p>
                  </div>
                  <div class="col-6">
                      <p class="mb-0"><?= $empresa['SECRES']?></p>
                      <p><strong>Secretario/a General</strong></p>
                  </div>
              </div>
                
              <div class="row pt-4">
                  <div class="col-6 text-center">
                      <img src="<?= media(); ?>images/gobierno.png" style="width: 70%">
                  </div>
              </div>

  <?php
              if($parcial_view == "PROMED" OR $parcial_view == "SUPLET" OR $parcial_view == "REMEDI" OR $parcial_view == "GRACIA") 
              {
                  if($j != $num_reg)
                  {        
                    echo '<p style="page-break-after: always;"></p>';
                  }
                }
              }
  ?>
              <div class="row d-print-none mt-2">
                  <div class="col-12 text-right">
                      <a class="btn btn-primary" onclick="printDiv('vssecone')"><i class="fa fa-print"></i> Imprimir</a>
                      <a class="btn btn-warning" onclick="exportTableToExcel('CuadroFinal')"><i class="far fa-file-excel"></i> Exportar EXCEL</a>
                  </div>
              </div>
        </div>
  <?php  
     } 
  ?>
        
</main>
