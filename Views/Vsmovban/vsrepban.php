<main>

  <div class="app-title">
    <div>
      <h1><i class="fas fa-file-invoice"></i>  <?= $data['page_title'] ?></h1>
    </div>
    <ul class="app-breadcrumb breadcrumb">
      <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
      <li class="breadcrumb-item"><a href="<?= base_url(); ?>Vsmovban">Retornar</a></li>
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

        // tipoRegistro: 1-Saldo Bancos al Corte, 2-Estado de Cuenta Banco
        $tipoRegistro = $data['maestroDetalle']['reptyp'];
        $fechaDesde = $data['fechaDesde'];
        $fechaHasta = $data['fechaHasta'];
//        dep($estadoCta);
        switch ($tipoRegistro) 
        {
          case 1:
            # Saldo Bancos al corte .....
            echo '<div id="vsrepsxb" class="invoice">';
            echo '<div class="row">';
            echo '<div class="col-md-12 text-center">';
            echo '<h3 class="mb-0">'.$empresa['RAZONS'].'</h3>';
            echo '<h5 class="mb-0">Saldo de Bancos al corte - desde: '.$fechaDesde.' hasta: '.$fechaHasta.'</h5>';
            echo '</div>';
            echo '<div class="col-md-12">';
            echo '<p class="mt-3 mb-0">'.date("l\, j \of F Y").'</p>';
            echo '<p>'.date("H:i:s").'</p>';
            echo '</div>';
            echo '</div>';
    ?>
            <table id="factura_detalle" class="table-bordered">
              <thead>
                  <tr>
                    <th class="text-center" width="75px">BANCO</th>
                    <th class="text-center" width="70px">CUENTA</th>
                    <th class="text-center" width="30px">SALDO</th>
                  </tr>
              </thead>
              <tbody id="detalle_productos">
    <?php
                for($i=0; $i < count($estadoCta); $i++)
                {
                  echo '<tr>';
                  echo '<td>'.$estadoCta[$i]['BAN_NM'].'</td>';
                  echo '<td>'.$estadoCta[$i]['CTANUM'].'</td>';
                  echo '<td class="text-center">'.sprintf("%.2f",round($estadoCta[$i]['SALDO'],2)).'</td>';
                  echo '</tr>';
                }
    ?>
              </tbody>
            </table>
            <div class="row d-print-none mt-2">
                <div class="col-12 text-right">
                  <a class="btn btn-primary" onclick="printDiv('vsrepsxb')"><i class="fa fa-print"></i> Imprimir</a>
                </div>
            </div>
    <?php
            echo '</div>';
            break;
          case 2:
            # Estado de Cuenta Bancos .....

    ?>
        <!-----------  Inicio Diseño de Estado Ctas Bancos ---------->
        <div id="vsrepcxb" class="invoice">
          <?php
          $numreg = count($estadoCta);
          $codeprv = $estadoCta[0]['BAN_NO'];
          for($i=0; $i < count($estadoCta); $i++)
          {
            $saldo = 0;
            $sum_debe = 0;
            $sum_haber = 0;
          ?>
            <div class="row">
              <div class="col-md-12 text-center">
                  <h3 class="mb-0"><?= $empresa['RAZONS']; ?></h3>
                  <h5 class="mb-0">Transacciones Bancarias - de: <?= $fechaDesde; ?> a: <?= $fechaHasta; ?></h5>
              </div>
              <div class="col-md-12"> 
                  <p class="mt-3 mb-0"><?= date("l\, j \of F Y");?></p>
                  <p><?= date("H:i:s");?></p>
              </div>
            </div>

            <table id="factura_detalle" class="table-bordered">
                <thead>
                  <tr>
                    <th colspan="4" class="text-center"><?= $estadoCta[$i]['BAN_NM']?> - <?= $estadoCta[$i]['CTANUM'] ?></th>
                    <th colspan="3"></th>
                  </tr>
                  <tr>
                    <th class="text-center" width="35px">DOCUMENTO</th>
                    <th class="text-center" width="40px">FECHA</th>
                    <th class="text-center" width="35px">CONCEPTO</th>
                    <th class="text-center" width="150x">No. CHEQUE / REFERENCIA</th>
                    <th class="text-center" width="35px">DEBE</th>
                    <th class="text-center" width="35px">HABER</th>
                    <th class="text-center" width="40px">SALDO</th>
                  </tr>
                </thead>
                <tbody id="detalle_productos">
              <?php               
                while (true) 
                {
                  echo '<tr>';
                  echo '<td class="text-center">'.$estadoCta[$i]['MOVTIP'].'-'.str_pad($estadoCta[$i]['MOV_NO'], 9, "0", STR_PAD_LEFT).'</td>';
                  echo '<td class="text-center">'.$estadoCta[$i]['FECREG'].'</td>';
                  echo '<td>'.$estadoCta[$i]['REMARK'].'</td>';
                  if($estadoCta[$i]['MOVTIP'] == 'DE')
                  {
                    echo '<td>'.$estadoCta[$i]['DEP_NO'].'</td>';
                  }else{
                    echo '<td>'.$estadoCta[$i]['CHE_NO'].'</td>';
                  }
                  
                  if($estadoCta[$i]['MOVSIG'] == 1)
                  {
                      // DEBE
                      echo '<td class="text-right">'.$estadoCta[$i]['VALORS'].'</td>';
                      echo '<td></td>';
                      $sum_debe = $sum_debe + $estadoCta[$i]['VALORS'];
                  }else{
                      // HABER
                      echo '<td></td>';
                      echo '<td class="text-right">'.$estadoCta[$i]['VALORS'].'</td>';
                      $sum_haber = $sum_haber + $estadoCta[$i]['VALORS'];
                  }
                  $saldo    = $saldo + $estadoCta[$i]['VALORS'] * $estadoCta[$i]['MOVSIG'];
                  
                  // SALDO
                  if($saldo < 0)
                  {
                      $color_saldo = '<td class="text-right" style="color: red">';
                  }else{
                      $color_saldo = '<td class="text-right">';
                  }
                  echo $color_saldo.sprintf("%.2f",round($saldo,2)).'</td>';  
                  
                  if($i < $numreg - 1)
                  {
                    if($codeprv == $estadoCta[$i+1]['BAN_NO'])
                    {
                      $i = $i + 1;
                    }else{
                       $codeprv = $estadoCta[$i+1]['BAN_NO'];
                       break;
                    }   
                  }else{
                      break;
                  }
                }
                echo '<tr>'; 
              ?>
                </tbody>
                <tfoot>
                  <tr>
                    <td class="text-center" colspan="4"><strong>S U B T O T A L</strong></td>
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
                  <a class="btn btn-primary" onclick="printDiv('vsrepcxb')"><i class="fa fa-print"></i> Imprimir</a>
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
