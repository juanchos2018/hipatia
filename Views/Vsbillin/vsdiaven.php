
<main>
  <div class="app-title">
      <div>
          <h1><i class="fas fa-user-edit"></i>  <?= $data['page_title'] ?></h1>
      </div>
      <ul class="app-breadcrumb breadcrumb">
          <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
          <li class="breadcrumb-item"><a href="<?= base_url(); ?>Vsbillin">Retornar</a></li>
      </ul>
  </div>

  <div class="row">
      <div class="col-md-12">
        	<?php 
        		if(empty($data['maestro_detalle']))
       			{
        	?>
        				<p class="text-primary">Datos no Encontrados! ..</p>
        	<?php
            }else{
//                dep($data['maestro_detalle']);
                $empresa = $data['datosEmpresa'];
                $stdxmat = $data['maestro_detalle'];
                $periodo = $data['perios'];
                $reptyp  = $data['reptyp'];
                if($reptyp == 1)
                {
                  $seccion = $stdxmat[0]['SEC_NM'];
                  $paralelo = $stdxmat[0]['PARALE']; 
                }
                $fechaemi = $stdxmat[0]['FECEMI']; 
                $payfor   = "EFE,CHE,POS,TAR,DEP,TRA";
                $arrpayfor = explode(",",$payfor);
                
        	?>

          <!-----------  Inicio Diseño de Diario de Ventas  ---------->
          <div id="vssecone" class="invoice">
            
            <?php 
              for($i = 0; $i < count($stdxmat); $i++)
              {
                $sumEFE = 0;
                $sumCHE = 0;
                $sumPOS = 0;
                $sumTAR = 0;
                $sumDEP = 0;
                $sumTRA = 0;
                $sumDOC = 0;
                $sumFecha = 0;
            ?>
            <br>
            <div class="row text-center">
              <div class="col-md-12"><h4 class="mb-0"><strong><?= $empresa['RAZONS'] ?></strong></h4></div>
              <div class="col-md-12"><p>RUC # <?= $empresa['RUC_NO'] ?></p></div>
              <div class="col-md-12"><h6>AÑO LECTIVO: <?= $periodo ?> - <?= $periodo + 1?></h6></div>
              <div class="col-md-12"><h5><strong>Informe Diario de Ventas</strong></h5></div>
            </div>

            <div class="row">
              <div class="col-md-2 text-left">
                <p class="text-primary mb-0"><?= date("d") . "-" . date("M") . "-" . date("Y");  ?></p>
                <p class="text-primary"><?= date("H:i:s"); ?></p>
              </div>
            </div>

            <div class="row">
              <div class="col-md-12">
                  <table id="factura_detalle" class="table-bordered" cellspacing="0" width="100%">
                    <!-- Cabecera de la Tabla ..... -->
                    <thead >
                      <tr>
                        <?php
                            if($reptyp == 1)
                            {
                        ?>
                          <th class="text-center">Fecha: <?= $fechaemi; ?></th>
                          <th colspan="3"></th>
                          <th colspan="6" class="text-center">Forma de Pago</th>
                        <?php
                            }else{
                        ?>
                          <th class="text-center"><?= ''; ?></th>
                          <th colspan="3"></th>
                          <th colspan="6" class="text-center">Forma de Pago</th>
                        <?php
                            }
                        ?>
                      </tr>
                      <tr>
                        <?php
                            if($reptyp == 1)
                            {
                        ?>
                              <th class="text-center" width="240px">Sección</th>
                              <th class="text-center" width="180px">Estudiante</th>
                              <th class="text-center" width="60px">Documento</th>
                        <?php
                            }else{
                        ?>
                              <th class="text-center" width="240px"></th>
                              <th class="text-center" width="180px"></th>
                              <th class="text-center" width="60px"></th>
                        <?php
                            }
                        ?>
                        <th class="text-center" width="140px">Período</th>
                        <th class="text-center" width="40px">EFE</th>
                        <th class="text-center" width="40px">CHE</th>
                        <th class="text-center" width="40px">POS</th>
                        <th class="text-center" width="40px">TAR</th>
                        <th class="text-center" width="40px">DEP</th>
                        <th class="text-center" width="40px">TRA</th>
                      </tr>          
                    </thead>

                    <!-- Detalle del Diario de Ventas -->
                    <tbody id="detalle_productos">
                      <?php
                      while (true) 
                      {
                      ?>
                          <tr>
                          <?php
                              if($reptyp == 1)
                              {
                          ?>
                                <td><?= $stdxmat[$i]['SEC_NM'].'-'.$stdxmat[$i]['PARALE']; ?></td>
                                <td><?= $stdxmat[$i]['LAS_NM'].' '.$stdxmat[$i]['FIR_NM']; ?></td>
                                <td><?= $stdxmat[$i]['DOCTIP'].' '.$stdxmat[$i]['DOCPTO'].'-'.str_pad($stdxmat[$i]['DOCNUM'], 9, "0", STR_PAD_LEFT); ?></td>
                                <td><?= $stdxmat[$i]['PERIOS'].'-'.$stdxmat[$i]['SUB_NM']; ?></td>
                          <?php
                              }else{
                          ?>
                                <td><?= ''; ?></td>
                                <td><?= ''; ?></td>
                                <td><?= ''; ?></td>
                                <td><?= $stdxmat[$i]['PERIOS'].'-'.$stdxmat[$i]['SUB_NM']; ?></td>
                          <?php
                              }
                          ?>

                              <?php 
                              for($j = 0;$j < count($arrpayfor);$j++)
                              {
                                if($arrpayfor[$j] == $stdxmat[$i]['PAYFOR'])
                                {
                                  echo "<td class='text-right'>".$stdxmat[$i]['ABOVAL']."</td>";     
                                } else {
                                  echo "<td></td>";
                                }  
                              }
                              $sumDOC = $sumDOC + 1;
                              switch ($stdxmat[$i]['PAYFOR']) 
                              {
                                  case 'EFE':
                                    $sumEFE = $sumEFE + $stdxmat[$i]['ABOVAL'] * $stdxmat[$i]['DOCSIG'];
                                    break;
                                  case 'CHE':
                                    $sumCHE = $sumCHE + $stdxmat[$i]['ABOVAL'] * $stdxmat[$i]['DOCSIG'];
                                    break;
                                  case 'POS':
                                    $sumPOS = $sumPOS + $stdxmat[$i]['ABOVAL'] * $stdxmat[$i]['DOCSIG'];
                                    break;
                                  case 'TAR':
                                    $sumTAR = $sumTAR + $stdxmat[$i]['ABOVAL'] * $stdxmat[$i]['DOCSIG'];
                                    break;
                                  case 'DEP':
                                    $sumDEP = $sumDEP + $stdxmat[$i]['ABOVAL'] * $stdxmat[$i]['DOCSIG'];
                                    break;
                                  case 'TRA':
                                    $sumTRA = $sumTRA + $stdxmat[$i]['ABOVAL'] * $stdxmat[$i]['DOCSIG'];
                                    break;
                              }
                              ?>
                          </tr>
                      <?php
                        if($i < count($stdxmat) - 1)
                        {
                          if($fechaemi == $stdxmat[$i+1]['FECEMI'])
                          {
                            $i = $i + 1;
                          } else {
                            $fechaemi = $stdxmat[$i+1]['FECEMI'];
                            break;
                          }
                        } else{
                          break;
                        }
                      }
                      ?>
                    </tbody>
                    <tfoot>
                      <tr>
                        <td colspan="2" class="text-right">SUBTOTAL DOCUMENTO</td>
                        <td><?= $sumDOC; ?></td>
                        <td>$ <?= sprintf("%.2f",$sumEFE+$sumCHE+$sumPOS+$sumTAR+$sumDEP+$sumTRA); ?></td>
                        <td class="text-right"><?= sprintf("%.2f",$sumEFE); ?></td>
                        <td class="text-right"><?= sprintf("%.2f",$sumCHE); ?></td>
                        <td class="text-right"><?= sprintf("%.2f",$sumPOS); ?></td>
                        <td class="text-right"><?= sprintf("%.2f",$sumTAR); ?></td>
                        <td class="text-right"><?= sprintf("%.2f",$sumDEP); ?></td>
                        <td class="text-right"><?= sprintf("%.2f",$sumTRA); ?></td>
                      </tr>
                    </tfoot>
                  </table>    
              </div>
            </div>
            
            <?php
                // Break de página -->
                echo '<p style="page-break-after: always;"></p>';
              }
            ?>             

            <div class="row d-print-none mt-2">
                <div class="col-12 text-right">
                  <a class="btn btn-primary" onclick="printDiv('vssecone')"><i class="fa fa-print"></i> Imprimir</a>
                </div>
            </div>
          </div>
      	 <?php  } ?>
        
      </div>
  </div>
</main>
