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
        <li class="breadcrumb-item"><a href="<?= base_url(); ?>Vsficsoc">Retornar</a></li>
    </ul>
</div>

<div class="row">
    <div class="col-md-12">
        <div class="tile">
        <?php 
            if(empty($data['alumno_detalle']))
            {
        ?>
            <p class="text-primary">Datos no Encontrados! ...</p>
        <?php
            }else{ 
                $empresa            = $data['empresa'];
                $alumnos            = $data['alumno_detalle']['alumnos'];
                $fecha_nacimiento   = new DateTime($alumnos['FECBIR']);
                $fecha_hoy          = new DateTime();
                $age                = date_diff($fecha_nacimiento,$fecha_hoy);
                $age_years          = $age->format("%R%y");
                $age_months         = $age->format("%R%m");

                switch($alumnos['CIVILS']) 
                {
                    case 1:$estado_civil = 'Soltero';
                            break;
                    case 2:$estado_civil = 'Casado';
                            break;
                    case 3:$estado_civil = 'Divorciado';
                            break;
                    case 4:$estado_civil = 'Viudo';
                            break;
                    case 5:$estado_civil = 'Unión Libre';
                            break;
                };

                switch($alumnos['ETNICO']) 
                {
                    case 1:$etnico = 'Mestizo';
                            break;
                    case 2:$etnico = 'Indigena';
                            break;
                    case 3:$etnico = 'AfroEcuatoriano';
                            break;
                    case 4:$etnico = 'Otro';
                            break;
                };

        ?>

        <section id="prnficsoc" class="invoice">
            <div class="row pt-2">
                <div class="col-12">
                    <h2 class="page-header text-center"><img src="<?= media(); ?><?= $empresa['LOGOIN'] ?>" style="width: 30%"></h2>
                </div>
            </div>
            <div class="row pt-0">   
                <div class="col-12 text-center">
                    <address>
                        <small><strong>Dirección: </strong><?= $empresa['ADDRES'] ?></small><br>
                        <small><strong>Email: </strong><?= $empresa['EMAILS'] ?></small><br>
                        <small><strong>Teléfono(s): </strong><?= $empresa['TPHONE'] ?></small><br>
                    </address>
                </div>
            </div>
            <div class="row text-center">   
                <div class="col-12">    
                    <h6 class="mb-1">UNIDAD DE BIENESTAR ESTUDIANTIL</h6>
                    <h6>REGISTRO ACUMULATIVO DEL ESTUDIANTE</h6>
                </div>          
            </div>
            <div class="row text-center mt-0">   
                <div class="col-12">    
                    
                </div>          
            </div>

            <!-- DATOS DE IDENTIFICACIÓN / INFORMACIÓN -->
            <div class="row">
                <div class="col-12 text-left">    
                    <p class="text-primary">1.- DATOS DE IDENTIFICACIÓN / INFORMACIÓN </p>
                </div>     
            </div>
                
            <div class="row">
                <div class="col-3 ml-2 text-right">
                    <strong>Nombre del Estudiante: </strong>
                </div>
                <div class="col-8">
                    <?= $alumnos['LAS_NM'].' '.$alumnos['FIR_NM']; ?>
                </div>
                
                <div class="col-3 ml-2 text-right">
                    <strong>Dirección Domicilio: </strong>
                </div>
                <div class="col-8">
                    <?= $alumnos['ADDRES']; ?>
                </div>

                <div class="col-3 ml-2 text-right">
                    <strong>Teléfono: </strong>
                </div>
                <div class="col-8">
                    <?= $alumnos['TPHONE']; ?>
                </div>

                <div class="col-3 ml-2 text-right">
                    <strong>Fecha de Nacimiento: </strong>
                </div>
                <div class="col-6">
                    <?= $alumnos['FECBIR']; ?><br>
                </div>

                <div class="col-3 ml-2 text-right">
                    <strong>Cédula de Ciudadanía: </strong>
                </div>
                <div class="col-6">
                    <?= $alumnos['IDE_NO']; ?><br>
                </div>

                <div class="col-3 ml-2 text-right">
                    <strong>Estado Civil: </strong>
                </div>
                <div class="col-6">
                    <?= $estado_civil; ?><br>
                </div>

                <div class="col-3 ml-2 text-right">
                    <strong>Edad Cronológica: </strong>
                </div>
                <div class="col-6">
                    <?= intval($age_years); ?> años <?= intval($age_months); ?> mes(es) <br>
                </div> 
                
                <div class="col-3 ml-2 text-right">
                    <strong>Correo Electrónico: </strong>
                </div>
                <div class="col-6">
                    <?= $alumnos['STDMAI']; ?> <br>
                </div>

                <div class="col-3 ml-2 text-right">
                    <strong>Cómo se identifica: </strong>
                </div>
                <div class="col-6">
                    <?= $etnico ?>
                </div>

                <div class="col-3 ml-2 text-right">
                    <strong>Ocupación: </strong>
                </div>
                <div class="col-6">
                    <?= $alumnos['STDJOB']; ?>
                </div>

                <div class="col-3 ml-2 text-right">
                    <strong>Lugar de Trabajo: </strong>
                </div>
                <div class="col-6">
                    <?= $alumnos['STDWRK']; ?> <br><br>
                </div>                
            </div>

            <!-- DATOS DE IDENTIFICACIÓN / INFORMACIÓN -->
            <div class="row">
                <div class="col-12 text-left">    
                   <p class="text-primary">2.- DATOS FAMILIARES (Detalle de todos los miembrso del grupo familiar) </p>
                </div> 
                <div class="col-12">
                    <table border="1" class="table table-striped table-bordered" cellspacing="0" width="100%">
                        <thead>
                            <tr>
                                <th class="text-center">Nombre y Apellido</th>
                                <th class="text-center">Parentesco</th>
                                <th class="text-center">Estado Civil</th>
                                <th class="text-center">Edad</th>
                                <th class="text-center">Instrucción</th>
                                <th class="text-center">Profesión</th>
                                <th class="text-center">Empresa</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>

            <div class="row">
                <div class="col-12 text-left">    
                   <p class="text-primary">3.- SITUACIÓN SOCIOECONÓMICA </p>
                </div>
                <div class="col-12">
                    <table border="1" class="table table-bordered table-striped" cellspacing="0" width="100%">
                        <thead>
                            <tr>
                                <th class="text-center" colspan="5"><STRONG>INGRESOS/EGRESOS DE LOS MIEMBROS DE LA FAMILIA</STRONG></th>
                            </tr>
                            <tr>
                                <th class="text-center">Referencia</th>
                                <th class="text-center" colspan="2">Ingresos (CONCEPTO/VALOR)</th>
                                <th class="text-center" colspan="2">Egresos (CONCEPTO/VALOR)</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td rowspan="2">PADRE</td>
                                <td>Sueldo:</td>
                                <td>$...</td>
                                <td>Pensiones Educativas</td>
                                <td>$...</td>
                            </tr>
                            <tr>
                                <td></td>
                                <td></td>
                                <td>Alimentos</td>
                                <td>$...</td>
                            </tr>
                            <tr>
                                <td rowspan="2">MADRE</td>
                                <td></td>
                                <td></td>
                                <td>Servicios Básicos</td>
                                <td>$...</td>
                            </tr>
                            <tr>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                            </tr>
                            <tr>
                                <td rowspan="2">OTROS</td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                            </tr>
                            <tr>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                            </tr>
                            <tr>
                                <td>TOTAL</td>
                                <td colspan="2">$ xxxx</td>
                                <td colspan="2">$ yyyy</td>
                            </tr>
                        </tbody>
                    </table>
                </div>

            </div>

            <div class="row">
                <div class="col-12 text-left">    
                   <p class="text-primary">3.1 - Condiciones de Vivienda </p>
                </div>
            </div>

            <div class="row">
                <div class="col-12 text-left">    
                   <p class="text-primary">3.2 - Condiciones de Salud del Estudiante </p>
                </div>
            </div>

            <br>
            <div class="row">
                <div class="col-3 text-right">
                    <strong>Fecha de Matriculación: </strong>
                </div>
                <div class="col-8">
                    <?= date("Y-m-d"); ?>
                </div>

                <div class="col-3 text-right">
                    <strong>Observaciones: </strong>
                </div>
                <div class="col-8">
                    <?= $alumnos['REMARK']; ?>
                </div>
            </div>


            <!-- Espacio para Firma -->
            <br>
            <div class="row">
                <div class="col-3">
                    <h6>FIRMA DE RESPONSABILIDAD</h6>
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <p class="text-justify">
                        Certifico que la información aquí ingresada es real, y autorizo al personal del departamento de Bienestar Estudiantil de la Unidad Educativa Nueva Semilla, verificar esto en el caso de ser requerido. 
                    </p>
                </div>
            </div>
    
            <div class="row mt-4 pt-4" style="font-size: 0.68rem">
                <div class="col-4 text-center">
                    <address>
                        <hr style="border:0.4px solid #dedede" class="mb-1">
                        <strong>Firma del responsable</strong>
                    </address>
                </div>  
            </div>
            
            <div class="row d-print-none mt-2">
                <div class="col-12 text-right"><a class="btn btn-primary" href="javascript:window.print('#vsactstd');"><i class="fa fa-print"></i>  Imprimir</a>
                </div>
            </div>
        </section>

        <?php   } ?>
    </div>
    </div>
    </div>
</main>

<?php footerAdmin($data); ?>