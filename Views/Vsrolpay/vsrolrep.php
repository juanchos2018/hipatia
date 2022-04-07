
<main>
    <div class="app-title">
        <div>
            <h1><i class="fas fa-user-edit"></i>  <?= $data['page_title'] ?></h1>
        </div>
        <ul class="app-breadcrumb breadcrumb">
            <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
            <li class="breadcrumb-item"><a href="<?= base_url(); ?>Vsrolpay">Retornar</a></li>
        </ul>
    </div>

    <div class="row">
        <div class="col-md-12">
        	<?php 
        	if(empty($data['maestroDetalle']['detalle']))
        	{
        	?>
        		<p class="text-primary">Datos no Encontrados! ...</p>
        	<?php 	
            }else{ 
		        // Variables .....
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
                        <div id="vsrolrep" class="invoice">

            <?php 	
                        $c = 0;
                        for($i = 0; $i < count($product_detail); $i++)
                        {
            ?>
                            <!-- CABECERA DEL REPORTE -->
                            <div class="row text-center">
                                <div class="col-md-12">
                                    <h4 class="mb-0"><strong><?= $empresa['RAZONS'] ?></strong></h4>
                                    <h5 class="mb-0">R.U.C. <?= $empresa['RUC_NO'] ?></h5>
                                    <p><?= $empresa['ADDRES'] ?></p>
                                    <h5 class="mb-0">Rol de Pago</h5>
                                    <p><strong>PERIODO: <?= substr($product_detail[0]['PERIOS'],0,4).'-'.substr($product_detail[0]['PERIOS'],4,2)?></strong></p>
                                </div>
                            </div>

                            <!-- Fecha, Hora -->
                            <div class="row">
                                <div class="col-md-6 text-left">
                                    <p class="text-primary mb-0"><?= date("d-m-Y");  ?></p>
                                    <p><?= date("H:i:s")?></p>
                                </div>
                                <div class="col-md-6 text-right">
                                    <p class="text-primary mb-0">Usuario: <?= $_SESSION['userData']['USU_NM']; ?></p>
                                    <p>Pág: 1</p>
                                </div>
                            </div>
            
                            <!-- Tabla -->
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="row invoice-info">
                                        <div class="col-2 text-right">  
                                            <strong>Grupo: </strong>
                                        </div>
                                        <div class="col-9">
                                            <?= $product_detail[$i]['SUB_NM']; ?>
                                        </div>
                                    </div>

                                    <table id="Tblstdcxc" style="border: 1px black solid;" class="table table-striped table-bordered" cellspacing="0" width="80%">
                                    <thead >
                                    <tr>
                                    <th colspan="2" class="text-center">NÓMINA</th>
            <?php 
                                    for($rh = 0; $rh < $numproduc; $rh++)
                                    {
                                        echo '<th class="text-center">'.$product_head[$rh]['RUB_NM'].'</th>';
                                    }
            ?>
                                    <th class="text-center">NETO</th>
                                    </tr>
                                    </thead>
                                    <tbody>
            <?php

                                    $grupo      = $product_detail[$i]['CAT_NO'];
                                    for($j = $i; $j < count($product_detail); $j++)
                                    {
                                        if($grupo == $product_detail[$j]['CAT_NO'])
                                        {
                                        }else{
                                            break;
                                        }

                                        $total      = 0;
                                        $c          = $c + 1;
                                        $personal   = $product_detail[$j]['EMP_NO'];
                                        echo '<tr>';
                                        echo '<td>'.$c.'</td>';
                                        echo '<td>'.$product_detail[$j]['LAS_NM'].' '.$product_detail[$j]['FIR_NM'].'</td>';

                                        for($k = $j; $k < count($product_detail); $k++)
                                        {
                                            if($personal == $product_detail[$k]['EMP_NO'])
                                            {
                                            }else{
                                                break;
                                            }

                                            if($product_detail[$k]['RUBTIP'] == 1)
                                            {
                                                echo '<td class="text-right">'.$product_detail[$k]['INCOME'].'</td>';
                                            }else{
                                                echo '<td class="text-right">'.$product_detail[$k]['EGRESS'].'</td>';
                                            }
                                            $total = $total + $product_detail[$k]['INCOME'] - $product_detail[$k]['EGRESS'];
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
                                    <a class="btn btn-primary" onclick="printDiv('vsrolrep')"><i class="fa fa-print"></i> Imprimir</a>
                                </div>
                            </div>
                        </div>
                        <!-----------  FIN Diseño de Impresion  ---------->
            <?php 
                        break;

                    case 2:
            ?>
                        <div id="vsrolrep" class="invoice">
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
                                        <h5 class="mb-0">Rol de Pago</h5>
                                        <p><strong>PERIODO: <?= substr($product_detail[0]['PERIOS'],0,4).'-'.substr($product_detail[0]['PERIOS'],4,2)?></strong></p>
                                    </div>
                                </div>
                      
                                <div class="col-md-12">
                                    <div class="row invoice-info">
                                        <div class="col-2 text-right">  
                                            <strong>Grupo: </strong>
                                        </div>
                                        <div class="col-9">
                                            <?= $product_detail[$i]['SUB_NM']; ?>
                                        </div>
              
                                        <div class="col-2 text-right">
                                            <strong>Cédula No.: </strong>
                                        </div>
                                        <div class="col-9">
                                            <?= $product_detail[$i]['IDE_NO']; ?>
                                        </div>

                                        <div class="col-2 text-right">  
                                            <strong>Apellidos: </strong>
                                        </div>
                                        <div class="col-9">
                                            <?= $product_detail[$i]['LAS_NM']; ?>
                                        </div>

                                        <div class="col-2 text-right">  
                                            <strong>Nombres: </strong>
                                        </div>
                                        <div class="col-9">
                                            <?= $product_detail[$i]['FIR_NM']; ?>
                                        </div>
                                    </div>
                                    <br>
                                    <table id="factura_detalle" class="table-bordered">
                                        <thead>
                                        <tr>
                                        <th class="text-center" width="70px">RUBRO</th>
                                        <th class="text-center" width="70px">INGRESO</th>
                                        <th class="text-center" width="30px">DESCUENTO</th>
                                        </tr>
                                        </thead>

                                        <tbody id="detalle_productos">
            <?php
                                        echo "</tr>";
                                        $total      = 0;
                                        $personal   = $product_detail[$i]['EMP_NO'];

                                        for($j = $i; $j < count($product_detail); $j++)
                                        {
                                            if($personal == $product_detail[$j]['EMP_NO'])
                                            {
                                            }else{
                                                break;
                                            }

                                            echo '<tr>';
                                            echo '<td>'.$product_detail[$j]['RUB_NM'].'</td>';
                                            echo '<td class="text-right">'.$product_detail[$j]['INCOME'].'</td>';
                                            echo '<td class="text-right">'.$product_detail[$j]['EGRESS'].'</td>';
                                            echo '</tr>';
                                            $total = $total + $product_detail[$j]['INCOME'] - $product_detail[$j]['EGRESS'];
                                        }
                                        echo '<td class="text-center">NETO:</td>';
                                        echo '<td class="text-right">'.sprintf("%.2f",$total).'</td>';
                                        echo '<td class="text-right"></td>';
                                        $i = $j - 1;
            ?>
                                        </tbody>
                                    </table>
                                    <br><br>
                                    <strong>f. COLECTURIA</strong><br><br>
                                </div>
            <?php
                            }
            ?>
                            <div class="row d-print-none mt-2">
                                <div class="col-12 text-right">
                                    <a class="btn btn-primary" onclick="printDiv('vsrolrep')"><i class="fa fa-print"></i> Imprimir</a>
                                </div>
                            </div>
                        </div>
            <?php 
                        break;

                    case 3:
                        $archivo  = fopen("acreditacionbancaria.txt","w") or die("Error de creación de archivo. Vuelva a Intentar.");

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

                            // COLUMNAS DEL ARCHIVO ESTIPULADAS POR INSTITUCION BANCARIA
                            $field01  = "PA";
                            $field02  = $product_detail[$i]['IDE_NO'];
                            $field03  = "USD";
                            $field04  = $product_detail[$i]['VALOR'] * 100;
                            $field05  = "REC";
                            $field06  = "ACREDITACION ";
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

                        $fileName = basename('acreditacionbancaria.txt');
                        $filePath = $fileName;
                        if(!empty($fileName))
                        {
                            // Define headers
                            header("Cache-Control: public");
                            header("Content-Description: File Transfer");
                            header("Content-Disposition: attachment; filename=$fileName");
                            header("Content-Type: application/zip");
                            header("Content-Transfer-Encoding: binary");
                            
                            // Read the file
                            readfile($filePath);
                            exit;
                        }else{
                            echo 'El archivo no existe.';
                        }
                        break;

                    case 4:
            ?>
                        <div id="vsrolrep" class="invoice">
                            <!-- CABECERA DEL REPORTE -->
                            <div class="row text-center">
                                <div class="col-md-12">
                                    <h4 class="mb-0"><strong><?= $empresa['RAZONS'] ?></strong></h4>
                                    <h5 class="mb-0">R.U.C. <?= $empresa['RUC_NO'] ?></h5>
                                    <p><?= $empresa['ADDRES'] ?></p>
                                    <h5 class="mb-0">Listado de Créditos Personales</h5>
                                    <p><strong>PERIODO: <?= substr($product_detail[0]['PERDES'],0,4).'-'.substr($product_detail[0]['PERDES'],4,2)?></strong></p>
                                </div>
                            </div>

                            <div class="col-md-12">
                                <table id="factura_detalle" class="table-bordered">
                                    <thead>
                                    <tr>
                                    <th class="text-center" width="70px">PERSONAL</th>
                                    <th class="text-center" width="70px">RUBRO</th>
                                    <th class="text-center" width="30px">CONCEPTO</th>
                                    <th class="text-center" width="30px">MONTO</th>
                                    <th class="text-center" width="30px">PLAZO</th>
                                    <th class="text-center" width="30px">CUOTA</th>
                                    </tr>
                                    </thead>
        
            <?php
                                    for($i = 0; $i < count($product_detail); $i++)
                                    {
            ?>  
                                        <tbody id="detalle_productos">
            <?php
                                        $total      = 0;
                                        $personal   = $product_detail[$i]['EMP_NO'];
                                        for($j = $i; $j < count($product_detail); $j++)
                                        {
                                            if($personal == $product_detail[$j]['EMP_NO'])
                                            {
                                            }else{
                                                break;
                                            }
                                            echo '<tr>';
                                            echo '<td>'.$product_detail[$j]['LAS_NM'].' '.$product_detail[$j]['FIR_NM'].'</td>';
                                            echo '<td>'.$product_detail[$j]['RUB_NM'].'</td>';
                                            echo '<td>'.$product_detail[$j]['REMARK'].'</td>';
                                            echo '<td class="text-right">'.$product_detail[$j]['VALORS'].'</td>';
                                            echo '<td class="text-right">'.$product_detail[$j]['PLAZOS'].'</td>';
                                            echo '<td class="text-right">'.$product_detail[$j]['CUOTAS'].'</td>';
                                            echo '</tr>';

                                            $total = $total + $product_detail[$j]['CUOTAS'];
                                        }
                                        $i = $j - 1;
                                        echo '<td class="text-center">SUBTOTAL</td>';
                                        echo '<td>'.' '.'</td>';
                                        echo '<td>'.' '.'</td>';
                                        echo '<td>'.' '.'</td>';
                                        echo '<td>'.' '.'</td>';
                                        echo '<td class="text-right">'.sprintf("%.2f",$total).'</td>';
            ?>
                                        </tbody>
            <?php
                                    }
            ?>  
                                </table>
                            </div>
                            <div class="row d-print-none mt-2">
                                <div class="col-12 text-right">
                                    <a class="btn btn-primary" onclick="printDiv('vsrolrep')"><i class="fa fa-print"></i> Imprimir</a>
                                </div>
                            </div>
                        </div>
            <?php 
                        break;

                    case 5:
            ?>
                        <div id="vsrolrep" class="invoice">
                            <!-- CABECERA DEL REPORTE -->
                            <div class="row text-center">
                                <div class="col-md-12">
                                <h4 class="mb-0"><strong><?= $empresa['RAZONS'] ?></strong></h4>
                                <h5 class="mb-0">R.U.C. <?= $empresa['RUC_NO'] ?></h5>
                                <p><?= $empresa['ADDRES'] ?></p>
                                <h5 class="mb-0">Estad de Cuenta Personal</h5>
                                <p><strong>PERIODO Corte: <?= substr($product_detail[0]['PERDES'],0,4).'-'.substr($product_detail[0]['PERDES'],4,2)?></strong></p>
                            </div>
                        </div>
                
                        <div class="col-md-12">
                            <table id="factura_detalle" class="table-bordered">
                            <thead>
                            <tr>
                            <th class="text-center" width="70px">PERSONAL</th>
                            <th class="text-center" width="70px">RUBRO</th>
                            <th class="text-center" width="70px">PERIODO</th>
                            <th class="text-center" width="30px">CONCEPTO</th>
                            <th class="text-center" width="30px">MONTO</th>
                            <th class="text-center" width="30px">PLAZO</th>
                            <th class="text-center" width="30px">CUOTA</th>
                            <th class="text-center" width="30px">PAGADO</th>
                            </tr>
                            </thead>

            <?php
                            for($i = 0; $i < count($product_detail); $i++)
                            {
            ?>  
                                <tbody id="detalle_productos">
            <?php
                                $total      = 0;
                                $personal   = $product_detail[$i]['EMP_NO'];
                                for($j = $i; $j < count($product_detail); $j++)
                                {
                                    if($personal == $product_detail[$j]['EMP_NO'])
                                    {
                                    }else{
                                        break;
                                    }
                                    echo '<tr>';
                                    echo '<td>'.$product_detail[$j]['LAS_NM'].' '.$product_detail[$j]['FIR_NM'].'</td>';
                                    echo '<td>'.$product_detail[$j]['RUB_NM'].'</td>';
                                    echo '<td class="text-center">'.substr($product_detail[$j]['PERDES'],0,4).'-'.substr($product_detail[$j]['PERDES'],4,2).'</td>';
                                    echo '<td>'.$product_detail[$j]['REMARK'].'</td>';
                                    echo '<td class="text-right">'.$product_detail[$j]['VALORS'].'</td>';
                                    echo '<td class="text-right">'.$product_detail[$j]['PLAZOS'].'</td>';
                                    echo '<td class="text-right">'.$product_detail[$j]['CUOTAS'].'</td>';

                                    if($product_detail[$j]['DESCON'] == 1)
                                    {
                                        echo '<td class="text-center">Si</td>';
                                    }else{
                                        echo '<td class="text-center">No</td>';
                                        $total = $total + $product_detail[$j]['CUOTAS'];
                                    }
                                    echo '</tr>';
                
                                }
                                $i = $j - 1;
                                echo '<td class="text-center">SUBTOTAL</td>';
                                echo '<td>'.' '.'</td>';
                                echo '<td>'.' '.'</td>';
                                echo '<td>'.' '.'</td>';
                                echo '<td>'.' '.'</td>';
                                echo '<td>'.' '.'</td>';
                                echo '<td class="text-right">'.sprintf("%.2f",$total).'</td>';
                                echo '<td>'.' '.'</td>';
            ?>
                                </tbody>
            <?php
                            }
            ?>  
                            </table>
                        </div>
                        <div class="row d-print-none mt-2">
                            <div class="col-12 text-right">
                                <a class="btn btn-primary" onclick="printDiv('vsrolrep')"><i class="fa fa-print"></i> Imprimir</a>
                            </div>
                        </div>
            <?php 
                        break;
                } // final del switch($reporte_tipo) ...
        
            } // final del IF(Datos no encontrados) ...
            ?> 
        
        </div>
    </div>
</main>
