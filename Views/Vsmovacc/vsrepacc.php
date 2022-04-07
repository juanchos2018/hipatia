<main>

  <div class="app-title">
      <div>
          <h1><i class="fas fa-file-invoice"></i>  <?= $data['page_title'] ?></h1>
      </div>
      <ul class="app-breadcrumb breadcrumb">
          <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
          <li class="breadcrumb-item"><a href="<?= base_url(); ?>Vsmovacc">Retornar</a></li>
      </ul>
  </div>

  <div class="tile">
    <?php 
      if(empty($data['maestroDetalle']['detalle']))
      {
        echo '<p class="text-primary">Datos no Encontrados! ..</p>';
      }else{
        // Sección Variables
        $empresa = $data['datosEmpresa'];
        $estadoCta = $data['maestroDetalle']['detalle'];

        // tipoRegistro: 1-Saldo Proveedores al Corte, 2-Estado de Cuenta Proveedor
        $tipoRegistro = $data['maestroDetalle']['reptyp'];
        $fechaDesde = $data['fechaDesde'];
        $fechaHasta = $data['fechaHasta'];

        switch ($tipoRegistro) 
        {
          case 1:
            ?>
            <!-----------  Inicio Diseño del Informe para Libro Mayor  ---------->
            <div id="vsrepLM" class="invoice">
              <div class="row">
                  <div class="col-md-12 text-center">
                      <h3 class="mb-0"><?= $empresa['RAZONS']; ?></h3>
                      <h5 class="mb-0">Diario General - de: <?= $fechaDesde; ?> a: <?= $fechaHasta; ?></h5>
                  </div>
                  <div class="col-md-12"> 
                      <p class="mt-3 mb-0"><?= date("l\, j \of F Y");?></p>
                      <p><?= date("H:i:s");?></p>
                  </div>
              </div>
    <?php

            for($i = 0; $i < count($estadoCta); $i++)
            {
    ?>
            <table id="factura_detalle" class="table-bordered">
                <thead>
                  <tr>
                    <th colspan="3" class="text-center"> Diario: <?= $estadoCta[$i]['TAB_NM']?> - <?= $estadoCta[$i]['MOVPTO'].' '.str_pad($estadoCta[$i]['MOV_NO'], 9, "0", STR_PAD_LEFT)?></th>
                    <th colspan="3" class="text-center"> Fecha: <?= $estadoCta[$i]['FECREG']?></th>
                  </tr>
                  <tr>
                    <th class="text-center">CODIGO CUENTA</th>
                    <th class="text-center">NOMBRE CUENTA</th>
                    <th class="text-center">CONCEPTO</th>
                    <th></th>
                    <th class="text-center">DEBE</th>
                    <th class="text-center">HABER</th>
                  </tr>
                </thead>
                <tbody id="detalle_productos">
    <?php
                $sum_debe   = 0;
                $sum_haber  = 0;
                $diario     = $estadoCta[$i]['MOVTIP'].$estadoCta[$i]['MOVPTO'].$estadoCta[$i]['MOV_NO'];
            
                for($j = $i; $j < count($estadoCta); $j++)
                {
                  if($diario == $estadoCta[$j]['MOVTIP'].$estadoCta[$j]['MOVPTO'].$estadoCta[$j]['MOV_NO'])
                  {
                  }else{
                    break;
                  } 
                  echo '<tr>';
                  echo '<td>'.$estadoCta[$j]['CTA_NO'].'</td>';
                  echo '<td>'.$estadoCta[$j]['CTA_NM'].'</td>';
                  echo '<td>'.$estadoCta[$j]['REMARK'].'</td>';
                  echo '<td></td>';

                  if($estadoCta[$j]['SIGNOS'] == 1)
                  {
                      // DEBE
                      echo '<td class="text-right">'.$estadoCta[$j]['VALORS'].'</td>';
                      echo '<td></td>';
                      $sum_debe = $sum_debe + $estadoCta[$j]['VALORS'];
                  }else{
                      // HABER
                      echo '<td></td>';
                      echo '<td class="text-right">'.$estadoCta[$j]['VALORS'].'</td>';
                      $sum_haber = $sum_haber + $estadoCta[$j]['VALORS'];
                  }
                }
                $i = $j - 1;
                echo '<tr>'; 
    ?>
                </tbody>
                <tfoot>
                  <tr>
                    <td colspan="3" class="text-center"><strong>T O T A L   D I A R I O</strong></td>
                    <td></td>
                    <td class="text-right"><strong><?= sprintf("%.2f",$sum_debe); ?></strong></td>
                    <td class="text-right"><strong><?= sprintf("%.2f",$sum_haber); ?></strong></td>
                  </tr>
                </tfoot>
            </table>
            <!-- Break de página -->
            <p style="page-break-after: always;"></p>
    <?php
          } // FIN del Bucle FOR ....
    ?>

          <div class="row d-print-none mt-2">
              <div class="col-12 text-right">
                  <a class="btn btn-primary" onclick="printDiv('vsrepLM')"><i class="fa fa-print"></i> Imprimir</a>
              </div>
          </div>
        </div>
    <?php
            break;

          case 2:
    ?>
            <!-----------  Inicio Diseño del Informe para Libro Mayor  ---------->
            <div id="vsrepLM" class="invoice">
    <?php

            for($i = 0; $i < count($estadoCta); $i++)
            {
    ?>
            <div class="row">
                <div class="col-md-12 text-center">
                    <h3 class="mb-0"><?= $empresa['RAZONS']; ?></h3>
                    <h5 class="mb-0">Movimiento de Cuentas - de: <?= $fechaDesde; ?> a: <?= $fechaHasta; ?></h5>
                </div>
                <div class="col-md-12"> 
                    <p class="mt-3 mb-0"><?= date("l\, j \of F Y");?></p>
                    <p><?= date("H:i:s");?></p>
                </div>
            </div>

            <table id="factura_detalle" class="table-bordered">
                <thead>
                  <tr>
                    <th colspan="3" class="text-center"> Cuenta Contable: <?= $estadoCta[$i]['CTA_NO']?> - <?= $estadoCta[$i]['CTA_NM']?></th>
                    <th colspan="3"> Saldo Anterior: </th>
                  </tr>
                  <tr>
                    <th class="text-center" width="35px">DOCUMENTO</th>
                    <th class="text-center" width="40px">FECHA</th>
                    <th class="text-center" width="150x">CONCEPTO</th>
                    <th class="text-center" width="35px">DEBE</th>
                    <th class="text-center" width="35px">HABER</th>
                    <th class="text-center" width="40px">SALDO</th>
                  </tr>
                </thead>
                <tbody id="detalle_productos">
    <?php
                $saldo      = 0;
                $sum_debe   = 0;
                $sum_haber  = 0;
                $cta_no     = $estadoCta[$i]['CTA_NO'];
            
                for($j = $i; $j < count($estadoCta); $j++)
                {
                  if($cta_no == $estadoCta[$j]['CTA_NO'])
                  {
                  }else{
                    break;
                  }   
                  echo '<tr>';
                  echo '<td class="text-center">'.$estadoCta[$j]['MOVTIP'].'-'.str_pad($estadoCta[$j]['MOV_NO'], 9, "0", STR_PAD_LEFT).'</td>';
                  echo '<td class="text-center">'.$estadoCta[$j]['FECREG'].'</td>';
                  echo '<td>'.$estadoCta[$j]['REMARK'].'</td>';

                  if($estadoCta[$j]['SIGNOS'] == 1)
                  {
                      // DEBE
                      echo '<td class="text-right">'.$estadoCta[$j]['VALORS'].'</td>';
                      echo '<td></td>';
                      $sum_debe = $sum_debe + $estadoCta[$j]['VALORS'];
                  }else{
                      // HABER
                      echo '<td></td>';
                      echo '<td class="text-right">'.$estadoCta[$j]['VALORS'].'</td>';
                      $sum_haber = $sum_haber + $estadoCta[$j]['VALORS'];
                  }
                  $saldo = $saldo + $estadoCta[$j]['VALORS'] * $estadoCta[$j]['SIGNOS'];
                  
                  // SALDO
                  $color_saldo = '<td class="text-right">';
                  echo $color_saldo.sprintf("%.2f",round($saldo,2)).'</td>';                   
                }
                $i = $j - 1;
                echo '<tr>'; 
    ?>
                </tbody>
                <tfoot>
                  <tr>
                    <td class="text-center" colspan="3"><strong>T O T A L   C U E N T A</strong></td>
                    <td class="text-right"><strong><?= sprintf("%.2f",$sum_debe); ?></strong></td>
                    <td class="text-right"><strong><?= sprintf("%.2f",$sum_haber); ?></strong></td>
                    <td class="text-right"><strong><?= sprintf("%.2f",round($sum_debe - $sum_haber,2)) ?></strong></td>
                  </tr>
                </tfoot>
            </table>
            <!-- Break de página -->
            <p style="page-break-after: always;"></p>
    <?php
          } // FIN del Bucle FOR ....
    ?>

          <div class="row d-print-none mt-2">
              <div class="col-12 text-right">
                  <a class="btn btn-primary" onclick="printDiv('vsrepLM')"><i class="fa fa-print"></i> Imprimir</a>
              </div>
          </div>
        </div>
    <?php
            break;
        }
      }
    ?>
      
  </div>

</main>
