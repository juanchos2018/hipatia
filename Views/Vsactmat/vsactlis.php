<?php
    headerAdmin($data);
?>

<main class="app-content">
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
            <div class="tile">
 	<?php 
   		if(empty($data['maestro_detalle']))
		{
 	?>
		    <p class="text-primary">Reporte sin Información.</p>
 	<?php 	
        }else{ 
    	    $empresa  = $data['maestro_detalle']['empresa'];
		    $acta     = $data['maestro_detalle']['acta'];

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

    ?>
            <section id="vsactlis" class="invoice">
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
                        <?= $acta[0]['SEC_NM']; ?>
                    </div>
              
                    <div class="col-2 text-right">  
                        <strong>Paralelo: </strong>
                    </div>
                    <div class="col-9">
                        <?= $acta[0]['PARALE']; ?>
                    </div>

                    <div class="col-2 text-right">
                        <strong>Jornada: </strong>
                    </div>
                    <div class="col-9">
                        <?= $jornada; ?>
                    </div>
                    <div class="col-2 text-right">
                        <strong>Asignatura: </strong>
                    </div>
                    <div class="col-9">
                        <?= $acta[0]['MAT_NM']; ?>
                    </div>
                    
                    <div class="col-2 text-right">
                        <strong>Año Lectivo: </strong>
                    </div>
                    <div class="col-9">
                        <?= $acta[0]['PERIOS']; ?>
                    </div>
                </div>

                <div class="row">
                    <div class="col-12 table-responsive">
                        <table class="table table-striped table-bordered" cellspacing="0" width= 100%>
                        <thead>
                            <tr><br>
                            <th class="text-center">Estudiante</th>
                            <th class="text-center"></th>
                            <th class="text-center"></th>
                            <th class="text-center"></th>
                            <th class="text-center"></th>
                            <th class="text-center"></th>
                            <th class="text-center"></th>
                            <th class="text-center"></th>
                            <th class="text-center"></th>
                            <th class="text-center"></th>
                            <th class="text-center"></th>
                            </tr>
                        </thead>
                        <tbody>
    <?php 	
                        foreach($acta as $alumno)
                        {
    ?>
                            <tr>
                            <td><?= $alumno['LAS_NM'].' '.$alumno['FIR_NM'] ?></td>
                            <td class="text-center"></td>
                            <td class="text-center"></td>
                            <td class="text-center"></td>
                            <td class="text-center"></td>
                            <td class="text-center"></td>
                            <td class="text-center"></td>
                            <td class="text-center"></td>
                            <td class="text-center"></td>
                            <td class="text-center"></td>
                            <td class="text-center"></td>
    <?php 	
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
      
            <div class="row d-print-none mt-2">
                <div class="col-12 text-right">
                    <a class="btn btn-primary" onclick="printDiv('vsactlis')"><i class="fa fa-print"></i> Imprimir</a>
                </div>
            </div>
        </section>
    <?php  
        }
    ?>      </div>
        </div>
    </div>
</main>

<?php footerAdmin($data); ?>
