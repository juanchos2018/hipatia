
<main>
  <div class="app-title">
      <div>
        <h1><i class="fas fa-user-edit"></i>  <?= $data['page_title'] ?></h1>
      </div>
      <ul class="app-breadcrumb breadcrumb">
        <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
        <li class="breadcrumb-item"><a href="<?= base_url(); ?>Vstariff">Retornar</a></li>
      </ul>
  </div>

  <div class="row">
      <div class="col-md-12">
        	<?php 
        		if(empty($data['maestroDetalle']['detalle']))
        			{
        	?>
        				<p class="text-primary">Reporte sin Información.</p>
        	<?php 	
              }else{ 
                $empresa        = $data['datosEmpresa'];
                $product_head   = $data['maestroDetalle']['producto'];
                $product_detail = $data['maestroDetalle']['detalle'];
                $reporte_tipo   = $data['maestroDetalle']['reptyp'];
                $periodo        = $data['perios'];
                $numpagina      = 0;
                $numproduc      = count($product_head);

                switch($reporte_tipo)
                {
                  case 1:
          ?>
                      <!-----------  Inicio Diseño de Impresion  ---------->
                      <div id="vsstdcxc" class="invoice">
          <?php
                        $c = 0;
                        for($i = 0; $i < count($product_detail); $i++)
                        {
                          $sec_nm     = $product_detail[$i]['SEC_NM'];
                          $paralelo   = $product_detail[$i]['PARALE'];
          ?>
                          <!-- CABECERA DEL REPORTE -->
                          <div class="row text-center">
                              <div class="col-md-12">
                                  <h4 class="mb-0"><strong><?= $empresa['RAZONS'] ?></strong></h4>
                                  <h5 class="mb-0">R.U.C. <?= $empresa['RUC_NO'] ?></h5>
                                  <p><?= $empresa['ADDRES'] ?></p>
                                  <h5 class="mb-0">Informe Cuenta por Cobrar a: <?= date("d-m-Y"); ?></h5>
                                  <p><strong>AÑO LECTIVO: <?= $empresa['PERIOS']?> - <?= $empresa['PERIOS'] + 1?> </strong></p>
                              </div>
                          </div>

                          <!-- Fecha, Hora -->
                          <div class="row">
                              <div class="col-md-6 text-left">
                                  <p class="text-primary mb-0"><?= date("d-m-Y");  ?></p>
                                  <p><?= date("H:i:s")?></p>
                              </div>
                          </div>
            
                          <!-- Tabla cxc -->
                          <div class="row">
                              <div class="col-md-12">
                                  <table id="Tblstdcxc" style="border: 1px black solid;" class="table table-striped table-bordered" cellspacing="0" width="80%">

                                  <!-- Cabecera de la Tabla -->
                                  <thead >
                                    <tr><th colspan="<?= 7 + $numproduc; ?>"><?= $sec_nm ?> - <?= $paralelo ?></th></tr>
                                    <tr>
                                    <th class="text-center">No.</th>
                                    <th class="text-center">Estudiante</th>
                                    <th class="text-center">Representante</th>
                                    <th class="text-center">No. Telefono</th>
          <?php 
                                    for($rh = 0; $rh < $numproduc; $rh++)
                                    {
                                      echo "<th>".$product_head[$rh]['SUB_NM']."</th>";
                                    }
          ?>
                                    <th class="text-center">TOTAL</th>
                                    </tr>          
                                  </thead>

                                  <!-- .... Table Body ..... -->
                                  <tbody>
          <?php
                                    $sec_no = $product_detail[$i]['SEC_NO'];
                                    for($j = $i; $j < count($product_detail); $j++)
                                    {
                                        if($sec_no == $product_detail[$j]['SEC_NO'])
                                        {
                                        }else{
                                            break;
                                        }

                                        $total      = 0;
                                        $c          = $c + 1;
                                        $std_no     = $product_detail[$j]['STD_NO'];
                                        echo '<tr>';
                                        echo '<td>'.$c.'</td>';
                                        echo '<td>'.$product_detail[$j]['LAS_NM'].' '.$product_detail[$j]['FIR_NM'].'</td>';
                                        echo '<td>'.$product_detail[$j]['REPNAM'].' '.$product_detail[$j]['REPLAS'].'</td>';
                                        echo '<td>'.$product_detail[$j]['REPFON'].'</td>';

                                        for($k = $j; $k < count($product_detail); $k++)
                                        {
                                            if($std_no == $product_detail[$k]['STD_NO'])
                                            {
                                            }else{
                                                break;
                                            }

                                            echo '<td>'.sprintf("%.2f",$product_detail[$k]['FACVAL'] - $product_detail[$k]['ABOVAL']).'</td>';
                                            $total = $total + $product_detail[$k]['FACVAL'] - $product_detail[$k]['ABOVAL'];
                                        }
                                        $j = $k - 1;
                                        echo '<td>'.sprintf("%.2f",$total).'</td>';
                                        echo '</tr>';
                                    }
                                    $i = $j - 1;
          ?>
                                  </tbody>
                                </table>
                            </div>
                          </div>
          <?php
                        }
          ?>
                          <div class="row d-print-none mt-2">
                              <div class="col-12 text-right">
                                <a class="btn btn-primary" onclick="printDiv('vsstdcxc')"><i class="fa fa-print"></i> Imprimir</a>
                                <a class="btn btn-warning" onclick="exportTableToExcel('Tblstdcxc')"><i class="far fa-file-excel"></i> Exportar EXCEL</a>
                              </div>
                          </div>
                        </div>
                        <!-----------  FIN Diseño de Impresion  ---------->
          <?php 
                        break;

                  case 2:
          ?>
                      <div id="vsstdcxc" class="invoice">
          <?php
                          for($i = 0; $i < count($product_detail); $i++)
                          {
          ?>
                              <!-- CABECERA DEL REPORTE -->
                              <div class="row text-center">
                                  <div class="col-md-12">
                                      <h4 class="mb-0"><strong><?= $empresa['RAZONS'] ?></strong></h4>
                                      <h5 class="mb-0">R.U.C. <?= $empresa['RUC_NO'] ?></h5>
                                      <p><?= $empresa['ADDRES'] ?></p>
                                      <h5 class="mb-0">Recordatorio de Pago a: <?= date("d-m-Y"); ?></h5>
                                      <p><strong>AÑO LECTIVO: <?= $empresa['PERIOS']?> - <?= $empresa['PERIOS'] + 1?> </strong></p>
                                  </div>
                              </div>
                      
                              <div class="col-md-12">
                                  <strong>Sr/a: </strong><?= $product_detail[$i]['REPLAS'].' '.$product_detail[$i]['REPNAM']; ?><br>
                                  <strong>Representante de: </strong><?= $product_detail[$i]['LAS_NM'].' '.$product_detail[$i]['FIR_NM']; ?><br>
                                  <strong>De mis consideraciones. </strong><br><br>
                                  <strong>En el área de Colecturía usted registra por concepto de NO PAGO DE MENSUALIDADES por los siguientes meses y valores.</strong><br><br>

                                  <table id="factura_detalle" class="table-bordered">
                                        <thead>
                                        <tr>
                                        <th class="text-center" width="70px">RUBRO</th>
                                        <th class="text-center" width="70px">PERIODO</th>
                                        <th class="text-center" width="30px">VALOR</th>
                                        </tr>
                                        </thead>

                                        <tbody id="detalle_productos">
          <?php
                                        echo "</tr>";
                                        $total    = 0;
                                        $std_no   = $product_detail[$i]['STD_NO'];

                                        for($j = $i; $j < count($product_detail); $j++)
                                        {
                                          if($std_no == $product_detail[$j]['STD_NO'])
                                          {
                                          }else{
                                            break;
                                          }
                                          echo '<tr>';
                                          echo '<td>'.$product_detail[$j]['ART_NM'].'</td>';
                                          echo '<td>'.$product_detail[$j]['SUB_NM'].'</td>';
                                          echo '<td class="text-right">'.$product_detail[$j]['SALDO'].'</td>';
                                          echo '</tr>';
                                          $total = $total + $product_detail[$j]['SALDO'];
                                        }
                                        $i = $j - 1;
                                        echo '<td>'.' '.'</td>';
                                        echo '<td class="text-center">TOTAL:</td>';
                                        echo '<td class="text-right">'.sprintf("%.2f",$total).'</td>';
          ?>
                                        </tbody>
                                  </table>
                                  <strong>Agradeceré a usted cumpla con ésta obligación de manera urgente para que a su vez la institución pueda resolver</strong><br>
                                  <strong>problemas que se deriven del mismo.</strong><br><br><br><br>
                                  <strong>f. RECTORADO</strong><br><br>
                            </div>
          <?php
                          }
          ?>
                            <div class="row d-print-none mt-2">
                                <div class="col-12 text-right">
                                  <a class="btn btn-primary" onclick="printDiv('vsstdcxc')"><i class="fa fa-print"></i> Imprimir</a>
                                </div>
                            </div>
                      </div>
          <?php 
                      break;

                  case 3:
                        $archivo  = fopen("recaudacionbancaria.txt","w") or die("Error de creación de archivo. Vuelva a Intentar.");

                        for($i = 0; $i < count($product_detail); $i++)
                        {
                          switch($product_detail[$i]['IDTYPE'])
                          {
                            // CEDULA
                            case '05':
                                $product_detail[$i]['IDTYPE'] = 'C';
                                break;
                            // RUC
                            case '04':
                                $product_detail[$i]['IDTYPE'] = 'R';
                                break;
                            // PASAPORTE
                            case '06':
                                $product_detail[$i]['IDTYPE'] = 'P';
                                break;
                          }

                          // COLUMNAS DEL ARCHIVO DADAS POR ENTIDAD BANCARIA
                          $field01  = "CO";
                          $field02  = $product_detail[$i]['IDE_NO'];
                          $field03  = "USD";
                          $field04  = $product_detail[$i]['SALDO'] * 100;
                          $field05  = "REC";
                          $field06  = $product_head['SUB_NM'];
                          $field07  = $product_detail[$i]['IDTYPE'];
                          $field08  = $product_detail[$i]['IDE_NO'];
                          $field09  = $product_detail[$i]['LAS_NM']." ".$product_detail[$i]['FIR_NM'];

                          fwrite($archivo,$field01);
                          fwrite($archivo,"\t");
                          fwrite($archivo,$field02);
                          fwrite($archivo,"\t");
                          fwrite($archivo,$field03);
                          fwrite($archivo,"\t");
                          fwrite($archivo,$field04);
                          fwrite($archivo,"\t");
                          fwrite($archivo,$field05);
                          fwrite($archivo,"\t");
                          fwrite($archivo,$field06);
                          fwrite($archivo,"\t");
                          fwrite($archivo,$field07);
                          fwrite($archivo,"\t");
                          fwrite($archivo,$field08);
                          fwrite($archivo,"\t");
                          fwrite($archivo,$field09);
                          fwrite($archivo,"\n");
                        }
                        fclose($archivo);

                        $filename = basename('recaudacionbancaria.txt');
                        $filePath = $filename;
                        if(empty($filename))
                        {
                            echo 'El archivo no existe.';
                        }else{
                            // Define headers
                            header("Cache-Control: public");
                            header("Content-Description: File Transfer");
                            header("Content-Disposition: attachment; filename=$filename");
                            header ('Content-Type: application/octet-stream');
                            header("Content-Type: application/zip");
                            
                            echo "<form method=\"get\" action=\"recaudacionbancaria.txt\">";
                            echo "<div>";
                            echo "</div>";
                            echo "<input class=\"submit-button\" type=\"submit\" value=\"Archivo generado con exito.  Descargar...\">";
                            echo "</form>";                            
                            exit;
                        }
                    break;
               } // final del switch($reporte_tipo) ...
          ?> 
          <?php  
           } // final del IF(Datos no encontrados) ...
          ?> 
        
      </div>
  </div>
</main>
