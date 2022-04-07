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
        <li class="breadcrumb-item"><a href="<?= base_url(); ?>Vstudent">Retornar</a></li>
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
     		    $empresa            = $data['maestro_detalle']['empresa'];
     			$alumnos            = $data['maestro_detalle']['alumnos'];
                $fecha_nacimiento   = new DateTime($alumnos['FECBIR']);
                $fecha_hoy          = new DateTime();
                $age                = date_diff($fecha_nacimiento,$fecha_hoy);
                $age_years          = $age->format("%R%y");
                $age_months         = $age->format("%R%m");
                $ceros              = '00000';
                $numMat             = $alumnos['MATNUM'];
                $numFol             = $alumnos['FOLNUM'];
                $numMat             = substr($ceros,0,5 - strlen($numMat)).$numMat;
                $numFol             = substr($ceros,0,5 - strlen($numFol)).$numFol;
      	?>

        <section id="vsactcon" class="invoice">
            <div class="row pt-2">
                <div class="col-4 text-left">
                    <h2 class="page-header"><img src="<?= media(); ?><?= $empresa['LOGOIN'] ?>" style="width: 30%"></h2>
                </div>
                <div class="col-8 text-left pt-3">
                    <h5 class="mb-0"><?= $empresa['RAZONS'] ?></h5>
                </div>
            </div>
            <div class="row mt-0">
                <div class="col-12 text-center">
                    <p class="ml-5"> Año Lectivo: <?= $alumnos['PERIOS']; ?> - <?= $alumnos['PERIOS'] + 1; ?> </p>   
                </div>
                 
            </div>
            
            <div class="row">
                <div class="col-4">
                     <p class="text-primary mb-0" style="font-size: 16px">Datos del Estudiante</p>     
                </div>
               
               <div class="col-4">
                    <p class="text-primary mb-0" style="font-size: 16px">No. Matricula: <?= $numMat; ?></p>   
               </div>
               <div class="col-4">
                    <p class="text-primary mb-0" style="font-size: 16px">No. Folio: <?= $numFol; ?></p>   
               </div>
                
            </div>
            <div class="row invoice-info" style="border: 1px solid">
                    <div class="col-3 ml-2">
                        <strong>Apellidos y Nombres: </strong>
                    </div>
                    <div class="col-5">
                        <?= $alumnos['LAS_NM'].' '.$alumnos['FIR_NM']; ?>
                    </div>
                    <div class="col-3 ml-5">
                        <div id="cuadro_foto"></div>
                    </div>

                    <div class="col-3 ml-2">
                        <strong>Grado/Curso: </strong>
                    </div>
                    <div class="col-7">
                        <?= $alumnos['SEC_NM']; ?> - <?= $alumnos['PARALE']; ?><br>
                    </div>

                    <div class="col-3 ml-2">
                        <strong>Fecha de Nacimiento: </strong>
                    </div>
                    <div class="col-7">
                        <?= $alumnos['FECBIR']; ?><br>
                    </div>
                    <div class="col-3 ml-2">
                        <strong>Cédula de Ciudadanía: </strong>
                    </div>
                    <div class="col-7">
                        <?= $alumnos['IDE_NO']; ?><br>
                    </div>
                    <div class="col-3 ml-2">
                        <strong>Dirección: </strong>
                    </div>
                    <div class="col-7">
                        <?= $alumnos['ADDRES']; ?><br>
                    </div>
                    <div class="col-3 ml-2">
                        <strong>Teléfono: </strong>
                    </div>
                    <div class="col-7">
                        <?= $alumnos['TPHONE']; ?><br>
                    </div>
                    <div class="col-3 ml-2">
                        <strong>Edad Cronológica: </strong>
                    </div>
                    <div class="col-7">
                        <?= intval($age_years); ?> años <?= intval($age_months); ?> mes(es) <br>
                    </div> 
                    <div class="col-3 ml-2">
                        <strong>Correo Electrónico: </strong>
                    </div>
                    <div class="col-7">
                        <?= $alumnos['STDMAI']; ?> <br>
                    </div>
                    <div class="col-3 ml-2">
                        <strong>Fecha Matricula: </strong>
                    </div>
                    <div class="col-7">
                        <?= $alumnos['FECMAT']; ?> <br>
                    </div>
                    
                    <div class="col-3 ml-2">
                        <strong>Institución: </strong>
                    </div>
                    <div class="col-7">
                        <?= $alumnos['LASSCH']; ?><br>
                    </div>
                    <div class="col-3 ml-2">
                        <strong>Observacion: </strong>
                    </div>
                    <div class="col-7">
                        <?= $alumnos['REMARK']; ?>
                    </div>
            </div>

            <p class="text-primary mt-3 mb-0" style="font-size: 16px">Datos del Representante</p>
            <div class="row invoice-info" style="border: 1px solid">
                    <div class="col-3 ml-2">
                        <strong>Apellidos y Nombres: </strong>
                    </div>
                    <div class="col-7">
                        <?= $alumnos['REPLAS'].' '.$alumnos['REPNAM']; ?>
                    </div>
                    
                    <div class="col-3 ml-2">
                        <strong>Cédula de Ciudadanía: </strong>
                    </div>
                    <div class="col-7">
                        <?= $alumnos['REPCED']; ?><br>
                    </div>
                    <div class="col-3 ml-2">
                        <strong>Dirección: </strong>
                    </div> 
                    <div class="col-7">
                        <?= $alumnos['REPADR']; ?><br>
                    </div>
                    <div class="col-3 ml-2">
                        <strong>Profesión: </strong>
                    </div> 
                    <div class="col-7">
                        <?= $alumnos['REPJOB']; ?><br>
                    </div>
                    <div class="col-3 ml-2">
                        <strong>Teléfono: </strong>
                    </div> 
                    <div class="col-7">
                        <?= $alumnos['REPFON']; ?>
                    </div>
            </div>

            <p class="text-primary mt-3 mb-0" style="font-size: 16px">Datos del Padre</p>
            <div class="row invoice-info" style="border: 1px solid">
                    <div class="col-3 ml-2">
                        <strong>Apellidos y Nombres: </strong>
                    </div>
                    <div class="col-7">
                        <?= $alumnos['FATLAS'].' '.$alumnos['FATNAM']; ?>
                    </div>
                    <div class="col-3 ml-2">
                        <strong>Cédula de Ciudadanía: </strong>
                    </div>
                    <div class="col-7">
                        <?= $alumnos['FATCED']; ?><br>
                    </div>
                    <div class="col-3 ml-2">
                        <strong>Dirección: </strong>
                    </div> 
                    <div class="col-7">
                        <?= $alumnos['FATADR']; ?><br>
                    </div>
                    <div class="col-3 ml-2">
                        <strong>Profesión: </strong>
                    </div> 
                    <div class="col-7">
                        <?= $alumnos['FATJOB']; ?><br>
                    </div>
                    <div class="col-3 ml-2">
                        <strong>Teléfono: </strong>
                    </div> 
                    <div class="col-7">
                        <?= $alumnos['FATFON']; ?>
                    </div>
            </div>

            <p class="text-primary mt-3 mb-0" style="font-size: 16px">Datos de la Madre</p>
            <div class="row invoice-info" style="border: 1px solid">
                    <div class="col-3 ml-2">
                        <strong>Apellidos y Nombres: </strong>
                    </div>
                    <div class="col-7">
                        <?= $alumnos['MOTLAS'].' '.$alumnos['MOTNAM']; ?>
                    </div>
                    <div class="col-3 ml-2">
                        <strong>Cédula de Ciudadanía: </strong>
                    </div>
                    <div class="col-7">
                        <?= $alumnos['MOTCED']; ?><br>
                    </div>
                    <div class="col-3 ml-2">
                        <strong>Dirección: </strong>
                    </div> 
                    <div class="col-7">
                        <?= $alumnos['MOTADR']; ?><br>
                    </div>
                    <div class="col-3 ml-2">
                        <strong>Profesión: </strong>
                    </div> 
                    <div class="col-7">
                        <?= $alumnos['MOTJOB']; ?><br>
                    </div>
                    <div class="col-3 ml-2">
                        <strong>Teléfono: </strong>
                    </div> 
                    <div class="col-7">
                        <?= $alumnos['MOTFON']; ?>
                    </div>
            </div>
            <!-- Fecha del Sistema ... -->
            <div class="row">
                <div class="col-12 text-right">
                    <p class="text-primary"><?= date("D, M j Y - G:i:s "); ?></p>
                </div>
            </div>


            <!-- Espacio para Firmas: Rector y Secretaria General -->
            <br><br><br><br>
            <div class="row mt-4 pt-4">
                <div class="col-6 text-center">
                    <address>
                        <hr style="border:0.4px solid #dedede;width: 50%" class="mb-1">
                        <p class="mb-0" style="font-size: 14px"><strong><?= $empresa['RECTOR'] ?></strong></p>
                        Rector(a)
                    </address>
                </div>

                <div class="col-6 text-center">
                    <address>
                        <hr style="border:0.4px solid #dedede;width: 50%" class="mb-1">
                        <p class="mb-0" style="font-size: 14px"><strong><?= $empresa['SECRES'] ?></strong></p>
                        Depto. Secretaría
                    </address>
                </div><br><br><br>

                <div class="col-12 text-center">
                    <address>
                        <hr style="border:0.4px solid #dedede;width: 30%" class="mb-1">
                        <p class="mb-0" style="font-size: 14px"><strong><?= $alumnos['REPLAS'].' '.$alumnos['REPNAM']; ?></strong></p>
                        Representante
                    </address>
                </div>  
            </div>
            
            <div class="row d-print-none mt-2">
                <div class="col-12 text-right"><a class="btn btn-primary" href="javascript:window.print('#vsactcon');"><i class="fa fa-print"></i> Imprimir</a>
                </div>
            </div>
        </section>
    	<?php   } ?>
    </div>
    </div>
    </div>
</main>

<?php footerAdmin($data); ?>