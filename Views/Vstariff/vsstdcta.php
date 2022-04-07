<?php
	headerAdmin($data);
?>

<main class="app-content">

<div class="app-title">
  <div>
    <h1><i class="fas fa-file-invoice"></i>  <?= $data['page_title'] ?></h1>
  </div>
  <ul class="app-breadcrumb breadcrumb">
    <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
    <li class="breadcrumb-item"><a href="<?= base_url(); ?>Vstariff">Retornar</a></li>
  </ul>
</div>

<div class="tile">
<div id="page_pdf">
  <?php
      $empresa = $data['datosEmpresa'];
      $estadoCta = $data['maestroDetalle'];
  ?>
  
  <div class="row mb-1 text-center">
      
    <div class="col-md-12 info_empresa">
        <h3 class="mb-0"><?= $empresa['RAZONS'] ?></h3>
        <p><i class="fas fa-envelope-open-text"></i> <?= $empresa['EMAILS'] ?></p>
        <h4 class="mb-0">ESTADO DE CUENTA</h4>
        <p><strong>AÑO LECTIVO: <?= $empresa['PERIOS']?> - <?= $empresa['PERIOS'] + 1?> </strong></p>
    </div>
    <div> 
        <p class="text-left mb-0"><?= date("l\, j \of F Y");?></p>
        <p class="text-left"><?= date("H:i:s");?></p>
    </div>

  </div>

  <table id="factura_cliente">
    <tr>
      <td class="info_cliente">
        <div class="round">
          <span class="h3">Datos del Estudiante</span>

            <div class="row" style="font-size: 12px">
                <div class="col-md-4 text-right">Nombre:</div> 
                <div class="col-md-8"><?= $estadoCta[0]['LAS_NM'].' '.$estadoCta[0]['FIR_NM']; ?></div>
                <div class="col-md-4 text-right">Dirección/Teléfono:</div> 
                <div class="col-md-8"><?= $estadoCta[0]['ADDRES'];?> / <?= $estadoCta[0]['TPHONE'];?></div>
                <div class="col-md-4 text-right">Correo:</div> 
                <div class="col-md-8"><?= $estadoCta[0]['STDMAI'];?></div>
                <div class="col-md-4 text-right">Curso:</div> 
                <div class="col-md-8"><?= $estadoCta[0]['SEC_NM'];?> - <?= $estadoCta[0]['PARALE'];?></div>
            </div>

        </div>
      </td>

    </tr>
  </table>

  <table id="factura_detalle" class="table-bordered">
      <thead>
        <tr>
          <th class="text-center" width="165px">PRODUCTO - PERIODO</th>
          <th class="text-center" width="35px">DOCUMENTO</th>
          <th class="text-center" width="45px">FECHA</th>
          <th class="text-center" width="105px">OBSERVACIÓN</th>
          <th class="text-center" width="35px">DEBE</th>
          <th class="text-center" width="35px">HABER</th>
          <th class="text-center" width="35px">SALDO</th>
        </tr>
      </thead>
      <tbody id="detalle_productos">
        <?php
          $saldo = 0;
          $debe = 0;
          $haber = 0;
          for($i=0; $i < count($estadoCta); $i++)
          {
            $saldo  = $saldo + $estadoCta[$i]['FACVAL'] - $estadoCta[$i]['ABOVAL'];
            $debe   = $debe  + $estadoCta[$i]['FACVAL'];
            $haber  = $haber + $estadoCta[$i]['ABOVAL'];
        ?>
        <tr>
            <td><?= $estadoCta[$i]['ART_NM']?> <?= $estadoCta[$i]['SUB_NM']?> <?= $estadoCta[$i]['PERIOS']?>-<?= $estadoCta[$i]['PERIOS'] + 1?></td>
            </td>
            <td class="text-center"><?= $estadoCta[$i]['DOCTIP'].' '.$estadoCta[$i]['DOCPTO'].'-'.str_pad($estadoCta[$i]['DOCNUM'], 9, "0", STR_PAD_LEFT)?></td>
            <td class="text-center"><?= $estadoCta[$i]['FECEMI']?></td>
            <td class="text-center"><?= $estadoCta[$i]['REMARK']?></td>
            <td class="text-right"><?=  $estadoCta[$i]['FACVAL']?></td>
            <td class="text-right"><?=  $estadoCta[$i]['ABOVAL']?></td>
            <td class="text-right"><?= sprintf("%.2f",round($saldo,2)) ?></td>
        </tr>
      <?php 
          } 
      ?>
      </tbody>
      <tfoot>
        <tr>
          <td class="text-center" colspan="4"><strong>T O T A L</strong></td>
          <td class="text-right"><strong><?= sprintf("%.2f",$debe); ?></strong></td>
          <td class="text-right"><strong><?= sprintf("%.2f",$haber); ?></strong></td>
          <td class="text-right"><strong><?= sprintf("%.2f",round($saldo,2)) ?></strong></td>
        </tr>
      </tfoot>
  </table>

</div>
</div>

</main>

<?php footerAdmin($data); ?>