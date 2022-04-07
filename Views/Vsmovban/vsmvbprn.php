<?php
	headerAdmin($data);
  require_once ("Barcode/src/BarcodeGenerator.php");
  require_once ("Barcode/src/BarcodeGeneratorPNG.php");

  use Picqer\Barcode\BarcodeGeneratorPNG;
  $barcodePNG = new BarcodeGeneratorPNG();
?>

<main class="app-content">

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
<div id="page_pdf">
  <?php
      $empresa = $data['datosEmpresa'];
      $factura_head = $data['maestroDetalle']['headBillin'];
      $factura_detail = $data['maestroDetalle']['detailBill'];
      $termino = substr($factura_head['PTO_NO'],0,3) .'-'.substr($factura_head['PTO_NO'],3,3);
      $llevaConta = 'SI';
  ?>
    <div class="row mb-1">
      
        <div class="col-md-4 logo_factura text-right">
          <img src="<?= media(); ?><?= $empresa['LOGOIN'] ?>" style="width: 80%">
        </div>
      
        <div class="col-md-8 info_empresa text-center">
          <h4><?= $empresa['RAZONS'] ?></h4>
          <p class="mb-0"><i class="fas fa-phone-alt"></i> <?= $empresa['TPHONE'] ?></p>
          <p><i class="fas fa-envelope-open-text"></i> <?= $empresa['EMAILS'] ?></p>
        </div>
      
    </div>    

  <div id="factura_head">
      <div class="info_factura">
          <div class="round">
            <span class="h3">Documento</span>
            <div class="row" style="font-size: 12px">
              <div class="col-md-4">Emisor: <strong><?= $empresa['RUC_NO'] ?></strong></div>
              <div class="col-md-4">Obligado a llevar contabilidad: <strong><?= $llevaConta ?></strong></div>
              <?php
                if($factura_head['DOCTIP'] == 'FA')
                {
              ?>
                  <div class="col-md-4">No. Factura: <strong><?= $termino.'-'.str_pad($factura_head['DOCNUM'], 9, "0", STR_PAD_LEFT) ?></strong></div>
              <?php
                }else{
              ?>
                  <div class="col-md-4">No. Nota de Crédito: <strong><?= $termino.'-'.str_pad($factura_head['DOCNUM'], 9, "0", STR_PAD_LEFT) ?></strong></div>
              <?php
                }
              ?>
              <div class="col-md-12">Razón Social: <strong><?= $empresa['RAZONS'] ?></strong></div>
              <div class="col-md-12">Dirección Matriz: <strong><?= $empresa['ADDRES'] ?></strong></div>
            </div>
          </div>
      </div>
  </div>

  <div id="factura_cliente">
      <div class="info_cliente">
        <div class="round">
          <span class="h3">Cliente</span>
          <div class="row" style="font-size: 12px"> 
              <div class="col-md-4">Cliente: <?= $factura_head['RUC_NO'] ?></div>
              <div class="col-md-4">Fecha: <?= $factura_head['FECEMI'] ?></div>
              <div class="col-md-4">Moneda: DOLLAR USA</div>
              <div class="col-md-4">Razón Social: <?= $factura_head['RAZONS'] ?></div>
              <div class="col-md-4">Dirección: <?= $factura_head['DIRECC'] ?></div>
              <div class="col-md-4">Email: <?= $factura_head['EMAILS'] ?></div>
          </div>
        </div>
      </div>
  </div>      

  <table id="factura_detalle" class="table-bordered">
      <thead>
        <tr>
          <th width="50px">CÓDIGO</th>
          <th class="textleft" width="150px">DETALLE</th>
          <th class="textright" width="50px">CANT.</th>
          <th class="textright" width="50px">P.UNITARIO</th>
          <th class="textright" width="50px">P.TOTAL</th>
          <th class="textright" width="50px">DESCUENTO</th>
        </tr>
      </thead>
      <tbody id="detalle_productos">
        
          <?php
            $sum_total = 0;
            $IVA = 12;
            $calculoIVATotal = 0;
            $subtotalIVAxProducto = 1 + ($IVA / 100);
            $baseCERO = 0;
            $baseIVA = 0;
            for($i=0; $i < count($factura_detail); $i++)
            {
          ?>
          <tr>
            <td class="textcenter"><?= $factura_detail[$i]['ART_NO'] ?></td>
            <td><?= $factura_detail[$i]['ART_NM'] ?> - <?= $factura_detail[$i]['SUB_NM'] ?></td>
            <td class="textright">1</td>
            <td class="textright">
              <?php
                
                if($factura_detail[$i]['DESIVA'] == 1)
                {
                  $subtotalProducto = round($factura_detail[$i]['ABOVAL'] / $subtotalIVAxProducto,2);
                  $baseIVA = $baseIVA + $subtotalProducto;
                } else{
                  $subtotalProducto = $factura_detail[$i]['ABOVAL'];
                  $baseCERO = $baseCERO + $subtotalProducto;
                }
                echo $subtotalProducto;
              ?>
                
            </td>
            <td class="textright"><?= $subtotalProducto ?> </td>
            <td class="textright">0.00 </td>  <!-- Aqui va el descuento -->
          </tr>
          <?php 
              $sum_total = $sum_total + ($factura_detail[$i]['ABOVAL']);

            } 
              $Total = explode(".", sprintf("%.2f",$sum_total));
              $Total_int = numtoletter($Total[0]);
              $Total_dec = $Total[1];
            ?>
        
      </tbody>
      <tfoot id="detalle_totales">
        <tr>
          <td colspan="3" class="textright"><span><strong>TOTALES</strong></span></td>
          <td class="textright"><span><strong>VALOR BRUTO</strong></span></td>
          <td class="textright"><span><strong>DESCUENTO</strong></span></td>
          <td class="textright"><span><strong>VALOR NETO</strong></span></td>
        </tr>
        <tr>
          <td colspan="3" class="textright"><span>BASE 0%</span></td>
          <td class="textright"><span><?= sprintf("%.2f",$baseCERO); ?></span></td>
          <td class="textright"><span>0.00</span></td>
          <td class="textright"><span><?= sprintf("%.2f",$baseCERO); ?></span></td>
        </tr>
        <tr>
          <td colspan="3" class="textright"><span>BASE 12%</span></td>
          <td class="textright"><span><?= sprintf("%.2f",$baseIVA); ?></span></td>
          <td class="textright"><span>0.00</span></td>
          <td class="textright"><span><?= sprintf("%.2f",$baseIVA); ?></span></td>
        </tr>
        <tr>
          <td colspan="3" class="textright"><span>NO OBJT. IVA</span></td>
          <td class="textright"><span>0.00</span></td>
          <td class="textright"><span>0.00</span></td>
          <td class="textright"><span>0.00</span></td>
        </tr>
        <tr>
          <td colspan="3" class="textright"><span>TOTAL s/imp</span></td>
          <td class="textright"><span><?= sprintf("%.2f",$baseCERO + $baseIVA);?></span></td>
          <td class="textright"><span>0.00</span></td>
          <td class="textright"><span><?= sprintf("%.2f",$baseCERO + $baseIVA); ?></span></td>
        </tr>
        <tr>
          <td colspan="3" class="textright"><span>IVA 12%</span></td>
          <td colspan="2"><span></span></td>
          <td class="textright"><span><?= sprintf("%.2f",round($baseIVA * ($IVA / 100),2)); ?></span></td>
        </tr>
        <tr>
          <td colspan="5" class="textright"><span><strong>TOTAL US$</strong></span></td>
          <td class="textright"><span><?= sprintf("%.2f",$sum_total); ?></span></td>
        </tr>
      </tfoot>
  </table>

  <!-- Sección para mostrar Total en letras y CLave de Autorización y Código de Barras -->
  <div class="pt-4">
    <div class="row">
      <div class="col-md-3 text-right">Son:</div>
      <div class="col-md-9"><strong><?= $Total_int; ?></strong> con <strong><?=$Total_dec;?>/100</strong> dólares</div>
      <div class="col-md-3 text-right">Clave de Autorización:</div>
      <div class="col-md-9"><b><?= $factura_head['AUT_NO'] ?></b></div>
      <div class="col-md-3 text-right">Código de barras:</div>
      <div class="col-md-9 mt-1">
        
        <!-- Formate de barcode en HTML no se recomienda para la impresión ------->
        <!-- Formato PNG será usado para la impresión                      ------->
        <img src="data:image/png;base64,<?= base64_encode($barcodePNG->getBarcode($factura_head['AUT_NO'],$barcodePNG::TYPE_CODE_128,2,50)); ?>" alt="Barcode Authorization">
          
      </div>
      
       
    </div>
  </div>

  <div class="row d-print-none mt-2">
      <div class="col-12 text-right">
            <a class="btn btn-primary" onclick="printDiv('page_pdf')"><i class="fa fa-print"></i> Imprimir</a>
      </div>
  </div>

</div>
</div>

</main>

<?php footerAdmin($data); ?>