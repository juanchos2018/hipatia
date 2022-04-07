<main>
    <div class="app-title">
        <div>
            <h1><i class="fas fa-user-edit"></i>  <?= $data['page_title'] ?></h1>
        </div>
        <ul class="app-breadcrumb breadcrumb">
            <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
            <li class="breadcrumb-item"><a href="<?= base_url(); ?>Vsactsav">Retornar</a></li>
        </ul>
    </div>

    <div class="row">
        <div class="col-md-12">
    <?php 
			$empresa  = $data['maestro_detalle']['empresa'];
			$acta     = $data['maestro_detalle']['acta'];
            $insumos  = $data['maestro_detalle']['insumos'];
            $parcial  = $data['maestro_detalle']['parcial'];
            $caltyp   = $data['maestro_detalle']['caltyp'];
            $Pun001   = '';
            $Pun002   = '';
            $Pun003   = '';
            $Pun004   = '';
            $Pun005   = '';
            $Pun006   = '';
            $Pun007   = '';
            $Pun008   = '';

       		if(empty($acta))
   			{
    ?>
    			<p class="text-primary">Reporte sin Información.</p>
    <?php
            }else{
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
                
                $mparci  = '';
                if($caltyp == 1)
                {
                    switch(substr($parcial,0,4))
                    {
                        case 'Q1P1':
                            $parcial = '1º Quimestre - 1º Parcial';
                            $Pun001  = 'PUNTAJ';
                            break;
                        case 'Q1P2':
                            $parcial = '1º Quimestre - 2º Parcial';
                            $Pun001  = 'PUNTAJ';
                            break;
                        case 'Q1P3':
                            $parcial = '1º Quimestre - 3º Parcial';
                            $Pun001  = 'PUNTAJ';
                        case 'Q2P1':
                            $parcial = '2º Quimestre - 1º Parcial';
                            $Pun001  = 'PUNTAJ';
                            break;
                        case 'Q2P2':
                            $parcial = '2º Quimestre - 2º Parcial';
                            $Pun001  = 'PUNTAJ';
                            break;
                        case 'Q2P3':
                            $parcial = '2º Quimestre - 3º Parcial';
                            $Pun001  = 'PUNTAJ';
                            break;
                    }
                    $mparci = 'actividad';
                }else{
                    switch($parcial)
                    {
                        case 'Q1P1PR':
                            $parcial = '1º Quimestre - 1º Parcial';
                            $Pun001  = 'Q1P1I1';
                            $Pun002  = 'Q1P1I2';
                            $Pun003  = 'Q1P1I3';
                            $Pun004  = 'Q1P1I4';
                            $Pun005  = 'Q1P1I5';
                            $Pun008  = 'Q1P1PR';
                            $mparci  = 'parcial';
                            break;
                        case 'Q1P2PR':
                            $parcial = '1º Quimestre - 2º Parcial';
                            $Pun001  = 'Q1P2I1';
                            $Pun002  = 'Q1P2I2';
                            $Pun003  = 'Q1P2I3';
                            $Pun004  = 'Q1P2I4';
                            $Pun005  = 'Q1P2I5';
                            $Pun008  = 'Q1P2PR';
                            $mparci  = 'parcial';
                            break;
                        case 'Q1P3PR':
                            $parcial = '1º Quimestre - 3º Parcial';
                            $Pun001  = 'Q1P3I1';
                            $Pun002  = 'Q1P3I2';
                            $Pun003  = 'Q1P3I3';
                            $Pun004  = 'Q1P3I4';
                            $Pun005  = 'Q1P3I5';
                            $Pun008  = 'Q1P3PR';
                            $mparci  = 'parcial';
                            break;
                        case 'Q1P1PY':
                            $parcial = '1º Quimestre - 1º Parcial Proyecto';
                            $Pun001  = 'Q1P1DI';
                            $Pun002  = 'Q1P1MD';
                            $mparci  = 'proyecto';
                            break;
                        case 'Q1P2PY':
                            $parcial = '1º Quimestre - 2º Parcial Proyecto';
                            $Pun001  = 'Q1P2DI';
                            $Pun002  = 'Q1P2MD';
                            $mparci  = 'proyecto';
                            break;
                        case 'Q1_PRO':
                            $parcial = '1º Quimestre';
                            $Pun001  = 'Q1P1PR';
                            $Pun002  = 'Q1P2PR';
                            $Pun003  = 'Q1P4PR';
                            $Pun004  = 'Q1_PRO';
                            $mparci  = 'quimestre';
                            break;
                        case 'Q2P1PR':
                            $parcial = '2º Quimestre - 1º Parcial';
                            $Pun001  = 'Q2P1I1';
                            $Pun002  = 'Q2P1I2';
                            $Pun003  = 'Q2P1I3';
                            $Pun004  = 'Q2P1I4';
                            $Pun005  = 'Q2P1I5';
                            $Pun008  = 'Q2P1PR';
                            $mparci  = 'parcial';
                            break;
                        case 'Q2P2PR':
                            $parcial = '2º Quimestre - 2º Parcial';
                            $Pun001  = 'Q2P2I1';
                            $Pun002  = 'Q2P2I2';
                            $Pun003  = 'Q2P2I3';
                            $Pun004  = 'Q2P2I4';
                            $Pun005  = 'Q2P2I5';
                            $Pun008  = 'Q2P2PR';
                            $mparci  = 'parcial';
                            break;
                        case 'Q2P3PR':
                            $parcial = '2º Quimestre - 3º Parcial';
                            $Pun001  = 'Q2P3I1';
                            $Pun002  = 'Q2P3I2';
                            $Pun003  = 'Q2P3I3';
                            $Pun004  = 'Q2P3I4';
                            $Pun005  = 'Q2P3I5';
                            $Pun008  = 'Q2P3PR';
                            $mparci  = 'parcial';
                            break;
                        case 'Q2P1PY':
                            $parcial = '2º Quimestre - 1º Parcial Proyecto';
                            $Pun001  = 'Q2P1DI';
                            $Pun002  = 'Q2P1MD';
                            $mparci  = 'proyecto';
                            break;
                        case 'Q2P2PY':
                            $parcial = '2º Quimestre - 2º Parcial Proyecto';
                            $Pun001  = 'Q2P2DI';
                            $Pun002  = 'Q2P2MD';
                            $mparci  = 'proyecto';
                            break;
                        case 'Q2_PRO':
                            $parcial = '2º Quimestre';
                            $Pun001  = 'Q2P1PR';
                            $Pun002  = 'Q2P2PR';
                            $Pun003  = 'Q2P4PR';
                            $Pun004  = 'Q2_PRO';
                            $mparci  = 'quimestre';
                            break;
                        case 'SUPLET':
                            $parcial = 'Supletorio';
                            $Pun001  = 'Q1_PRO';
                            $Pun002  = 'Q2_PRO';
                            $Pun003  = 'SUPLET';
                            $Pun008  = 'PROFIN';
                            $mparci  = 'final';
                            break;
                        case 'REMEDI':
                            $parcial = 'Remedial';
                            $Pun001  = 'Q1_PRO';
                            $Pun002  = 'Q2_PRO';
                            $Pun003  = 'REMEDI';
                            $Pun008  = 'PROFIN';
                            $mparci  = 'final';
                            break;
                        case 'GRACIA':
                            $parcial = 'Gracia';
                            $Pun001  = 'Q1_PRO';
                            $Pun002  = 'Q2_PRO';
                            $Pun003  = 'GRACIA';
                            $Pun008  = 'PROFIN';
                            $mparci  = 'final';
                            break;
                    }
                }
              
                $arrPuntajes = array("1" => $Pun001,
                                     "2" => $Pun002,
                                     "3" => $Pun003,
                                     "4" => $Pun004,
                                     "5" => $Pun005,
                                     "6" => $Pun006,
                                     "7" => $Pun007,
                                     "8" => $Pun008
                                    );
   	?>
            <section id="vssavone" class="invoice">
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
                        <strong>Periodo: </strong>
                    </div>
                    <div class="col-9">
                        <?= $parcial; ?>
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
    <?php 
                        switch($mparci)
                        {
                            case 'actividad':
    ?>
                                <th class="text-center">Fecha</th>
                                <th class="text-center">Estudiante</th>
                                <th class="text-center">Actividad</th>
                                <th class="text-center">Insumo</th>
                                <th class="text-center">Puntaje</th>
    <?php
                                break;
                            case 'parcial':
    ?>
                                <th class="text-center">Estudiante</th>
                                <th class="text-center"><?= $insumos['0']['SUB_NM'] ?></th>
                                <th class="text-center"><?= $insumos['1']['SUB_NM'] ?></th>
                                <th class="text-center"><?= $insumos['2']['SUB_NM'] ?></th>
                                <th class="text-center"><?= $insumos['3']['SUB_NM'] ?></th>
                                <th class="text-center"><?= $insumos['4']['SUB_NM'] ?></th>
                                <th class="text-center">Parcial</th>
    <?php
                                break;
                            case 'proyecto':
    ?>
                                <th class="text-center">Estudiante</th>
                                <th class="text-center">Proyecto DI</th>
                                <th class="text-center">Proyecto MD</th>
    <?php
                                break;
                            case 'quimestre':
    ?>
                                <th class="text-center">Estudiante</th>
                                <th class="text-center">1er Parcial</th>
                                <th class="text-center">2do Parcial</th>
                                <th class="text-center">Examen</th>
                                <th class="text-center">Promedio Quimestre</th>
    <?php
                                break;
                            case 'final':
    ?>
                                <th class="text-center">Estudiante</th>
                                <th class="text-center">Q1</th>
                                <th class="text-center">Q2</th>
                                <th class="text-center">CALIFICACION</th>
                                <th class="text-center">FINAL</th>
    <?php
                                break;
                        }
    ?>
                            </tr>
                    </thead>
                    <tbody>
    <?php 
               			foreach($acta as $alumno)
           			    {
                            switch($mparci)
                            {  
                                case 'actividad':
    ?>
                                    <tr>
                                    <td class="text-center"><?= $alumno['FECREG'] ?></td>
                                    <td><?= $alumno['LAS_NM'].' '.$alumno['FIR_NM'] ?></td>
                                    <td><?= $alumno['SCHEDU'] ?></td>
                                    <td class="text-center"><?= $alumno['SUB_NM'] ?></td>
                                    <td><input id="<?= $alumno['SEC_ID'] ?>" name="<?= $alumno['PARCIA'] ?>" class="text-center" onchange="fntSavAct(this.id+'-'+this.name+'-'+this.value);" type="number" min="0" step="0.01" value="<?= $alumno[$Pun001] ?>"></td>
                                    </tr>
    <?php 
                                    break;
                                case 'parcial':
    ?>
                                    <tr>
                                    <td><?= $alumno['LAS_NM'].' '.$alumno['FIR_NM'] ?></td>
                                    <td><input id="<?= $alumno['SEC_ID'] ?>" name="<?= $arrPuntajes['1'] ?>" class="text-center" onchange="fntSavOne(this.id+'-'+this.name+'-'+this.value);" type="number" min="0" step="0.01" value="<?= $alumno[$Pun001] ?>"></td>
                                    <td><input id="<?= $alumno['SEC_ID'] ?>" name="<?= $arrPuntajes['2'] ?>" class="text-center" onchange="fntSavOne(this.id+'-'+this.name+'-'+this.value);" type="number" min="0" step="0.01" value="<?= $alumno[$Pun002] ?>"></td>
                                    <td><input id="<?= $alumno['SEC_ID'] ?>" name="<?= $arrPuntajes['3'] ?>" class="text-center" onchange="fntSavOne(this.id+'-'+this.name+'-'+this.value);" type="number" min="0" step="0.01" value="<?= $alumno[$Pun003] ?>"></td>
                                    <td><input id="<?= $alumno['SEC_ID'] ?>" name="<?= $arrPuntajes['4'] ?>" class="text-center" onchange="fntSavOne(this.id+'-'+this.name+'-'+this.value);" type="number" min="0" step="0.01" value="<?= $alumno[$Pun004] ?>"></td>
                                    <td><input id="<?= $alumno['SEC_ID'] ?>" name="<?= $arrPuntajes['5'] ?>" class="text-center" onchange="fntSavOne(this.id+'-'+this.name+'-'+this.value);" type="number" min="0" step="0.01" value="<?= $alumno[$Pun005] ?>"></td>
                                    <td class="text-center"><?= $alumno[$Pun008] ?></td>
                                    </tr>
    <?php 
                                    break;
                                case 'proyecto':
    ?>
                                    <tr>
                                    <td><?= $alumno['LAS_NM'].' '.$alumno['FIR_NM'] ?></td>
                                    <td><input id="<?= $alumno['SEC_ID'] ?>" name="<?= $arrPuntajes['1'] ?>" class="text-center" onchange="fntSavOne(this.id+'-'+this.name+'-'+this.value);" type="number" min="0" step="0.01" value="<?= $alumno[$Pun001] ?>"></td>
                                    <td><input id="<?= $alumno['SEC_ID'] ?>" name="<?= $arrPuntajes['2'] ?>" class="text-center" onchange="fntSavOne(this.id+'-'+this.name+'-'+this.value);" type="number" min="0" step="0.01" value="<?= $alumno[$Pun002] ?>"></td>
                                    </tr>
    <?php 
                                    break;
                                case 'quimestre':
    ?>
                                    <tr>
                                    <td><?= $alumno['LAS_NM'].' '.$alumno['FIR_NM'] ?></td>
                                    <td><input id="<?= $alumno['SEC_ID'] ?>" name="<?= $arrPuntajes['1'] ?>" class="text-center" onchange="fntSavOne(this.id+'-'+this.name+'-'+this.value);" type="number" min="0" step="0.01" value="<?= $alumno[$Pun001] ?>"></td>
                                    <td><input id="<?= $alumno['SEC_ID'] ?>" name="<?= $arrPuntajes['2'] ?>" class="text-center" onchange="fntSavOne(this.id+'-'+this.name+'-'+this.value);" type="number" min="0" step="0.01" value="<?= $alumno[$Pun002] ?>"></td>
                                    <td><input id="<?= $alumno['SEC_ID'] ?>" name="<?= $arrPuntajes['3'] ?>" class="text-center" onchange="fntSavOne(this.id+'-'+this.name+'-'+this.value);" type="number" min="0" step="0.01" value="<?= $alumno[$Pun003] ?>"></td>
                                    <td class="text-center"><?= $alumno[$Pun004] ?></td>
                                    </tr>
    <?php 
                                    break;
                                case 'final':
    ?>
                                    <tr>
                                    <td><?= $alumno['LAS_NM'].' '.$alumno['FIR_NM'] ?></td>
                                    <td class="text-center"><?= $alumno[$Pun001] ?></td>
                                    <td class="text-center"><?= $alumno[$Pun002] ?></td>
                                    <td><input id="<?= $alumno['SEC_ID'] ?>" name="<?= $arrPuntajes['3'] ?>" class="text-center" onchange="fntSavOne(this.id+'-'+this.name+'-'+this.value);" type="number" min="0" step="0.01" value="<?= $alumno[$Pun003] ?>"></td>
                                    <td class="text-center"><?= $alumno[$Pun008] ?></td>
                                    </tr>
    <?php 
                                    break;
                            }
                   		}
    ?>
                    </tbody>
                    </table>
                </div>
            </div> 
        </section>
    <?php  
            } 
    ?>
        </div>
    </div>
</main>
