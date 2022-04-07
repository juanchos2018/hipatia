<?php
    require_once ("Models/VsnewstdModel.php");
    $objSection = new VsnewstdModel();
    $arrData = $objSection->GetVsection();
?>

<style>
  .special {
  font-size: 8px;
  }
</style>

<!DOCTYPE html>
<html lang="es">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="author" content="Patricio Moncayo">
    <meta name="theme-color" content="#009670">
    <link rel="shortcut icon" href="<?= media(); ?>images/vs4.ico">

    <!-- Main CSS-->
    <link rel="stylesheet" type="text/css" href="<?= media(); ?>css/style.css">
    <link rel="stylesheet" type="text/css" href="<?= media(); ?>css/main.css">
    <link rel="stylesheet" type="text/css" href="<?= media(); ?>css/bootstrap-select.min.css">
    
    
    <title><?= $data['page_tag']; ?></title>
  </head>
  <body>
    <section class="material-half-bg">
      <div class="cover"></div>
    </section>
    <section class="login-content">
      <div class="logo">
        <h1><?= $data['page_title']; ?></h1>
      </div>
      <div class="login-register flipped">
        <form class="register-form" id="formRegStd" name="formRegStd" action="" autocomplete="off">
          <input type="hidden" id="idStd_no" name="idStd_no" value=0>
          <h3 class="login-head"><i class="fas fa-user-cog"></i> Nuevo Aspirante</h3>
          
        <div class="row">   
            <div class="form-group col-md-12">
                <label for="listSec_no">Sección *</label>
                <select class="form-control selectpicker" data-witdh="auto" data-size="4" data-live-search="true" id="listSec_no" name="listSec_no" title="Escoja una de las siguientes" required>
                  <?php 
                    for($i = 0; $i < count($arrData); $i++)
                    {
                  ?>
                    <option class="special" value="<?= $arrData[$i]['SEC_NO'] ?>"><?= trim($arrData[$i]['SEC_NM']).' - '.trim($arrData[$i]['PARALE']) ?></option>';

                  <?php    
                    }
                  ?>
                </select>
            </div>

            <div class="form-group col-sm-4 col-md-6">
              <label class="control-label">Apellidos *</label>
              <input id="txtLas_nm" name="txtLas_nm" class="form-control" type="text" required>
            </div>

            <div class="form-group col-md-6">
              <label class="control-label">Nombres *</label>
              <input id="txtFir_nm" name="txtFir_nm" class="form-control" type="text" required>
            </div>

            <div class="form-group col-md-6">            
                <label for="listIdtype">Tipo Identificación *</label>
                <select class="form-control selectpicker" id="listIdtype" name="listIdtype" required>
                        <option value="1">Cédula</option>
                        <option value="2">Ruc</option>
                        <option value="3">Pasaporte</option>
                </select>
            </div>

            <div class="form-group col-md-6">
              <label class="control-label">No. Identificación *</label>
              <input id="txtIde_no" name="txtIde_no" class="form-control" type="text" required>
            </div>

            <div class="form-group col-md-6">
              <label class="control-label">Dirección *</label>
              <textarea id="txtAddres" name="txtAddres" class="form-control" type="text" rows="2" maxlength="100" required></textarea>
            </div>

            <div class="form-group col-md-6">
              <label class="control-label">Teléfono(s) *</label>
              <textarea id="txtTphone" name="txtTphone" class="form-control" type="text" rows="2" maxlength="50" required></textarea>
            </div>

            <div class="form-group col-md-6">
              <label class="control-label">Género *</label>
              <select class="form-control selectpicker" id="listStdgen" name="listStdgen" required>
                    <option value="" selected=""> ------------- </option>
                    <option value="1">Masculino</option>
                    <option value="2">Femenino</option>
              </select>
            </div>

            <div class="form-group col-md-6">
              <label class="control-label">Fecha de Nacimiento *</label>
              <input class="form-control" id="datFecbir" name="datFecbir" type="date" required>
            </div>

            <div class="form-group col-md-12">
              <label class="control-label">Correo Electrónico *</label>
              <input id="txtStdmai" name="txtStdmai" class="form-control" type="text" required>
            </div>
        </div>

        <!--------------------- Información del Padre ------------->
        <p class="text-primary mb-0">INFORMACIÓN DEL PADRE</p>
        <hr class="mt-0">

        <div class="row">
            <div class="form-group col-md-6">            
              <label class="control-label">Apellidos *</label>
              <input class="form-control" id="txtFatlas" name="txtFatlas" type="text" maxlength="50" required>
            </div>

            <div class="form-group col-md-6">
              <label class="control-label">Nombres *</label>
              <input class="form-control" id="txtFatnam" name="txtFatnam" type="text" maxlength="50" required>
            </div>

            <!-- Dirección y Teléfonos Padre --> 
            <div class="form-group col-md-6">
              <label class="control-label">Dirección *</label>
              <textarea class="form-control" id="txtFatadr" name="txtFatadr" rows="2" type="text" maxlength="100" required></textarea>
            </div>

            <div class="form-group col-md-6">
              <label class="control-label">Teléfonos *</label>
              <textarea class="form-control" id="txtFatfon" name="txtFatfon" rows="2" type="text" maxlength="50" required></textarea>
            </div>
                
            <!-- Credencial Padre -->   
            <div class="form-group col-md-6">
              <label class="control-label">Tipo Identificación *</label>
              <select class="form-control selectpicker" id="listFatype" name="listFatype" required>
                      <option value="1">Cédula</option>
                      <option value="2">Ruc</option>
                      <option value="3">Pasaporte</option>
              </select>
            </div>

            <div class="form-group col-md-6">
              <label class="control-label">Número Identificación *</label>
              <input class="form-control" id="txtFatced" name="txtFatced" type="text" pattern="[a-zA-Z0-9-]{9,13}" title="Máximo 13 digitos" required>
            </div>
                
            <!-- Lugar de Trabajo y Fecha Nacimiento Padre -->
            <div class="form-group col-md-6">
                    <label class="control-label">Lugar Trabajo y Ocupación *</label>
                    <input class="form-control" id="txtFatjob" name="txtFatjob" type="text" maxlength="100" required>    
            </div>

            <div class="form-group col-md-6">
                    <label class="control-label">Fecha Nacimiento</label>
                    <input class="form-control" id="datFatbir" name="datFatbir" type="date">
            </div>
            
            <!-- Correo Padre -->
            <div class="form-group col-md-12">
                <label class="control-label">Correo Electrónico</label>
                <input class="form-control" id="txtFatmai" name="txtFatmai" type="email" maxlength="100">
            </div>
        </div>

        <!--------------------- Información de la Madre ---------------->
        <p class="text-primary mb-0">INFORMACIÓN DE LA MADRE</p>
        <hr class="mt-0">

        <div class="row">
          <div class="form-group col-md-6">
              <label class="control-label">Apellidos *</label>
              <input class="form-control" id="txtMotlas" name="txtMotlas" type="text" maxlength="50" required>
          </div>

          <div class="form-group col-md-6">
              <label class="control-label">Nombres *</label>
              <input class="form-control" id="txtMotnam" name="txtMotnam" type="text" maxlength="50" required>
          </div>

          <!-- Dirección y Teléfonos Madre -->
          <div class="form-group col-md-6">
              <label class="control-label">Dirección *</label>
              <textarea class="form-control" id="txtMotadr" name="txtMotadr" rows="2" type="text" maxlength="100" required></textarea>
          </div>

          <div class="form-group col-md-6">
              <label class="control-label">Teléfonos *</label>
              <textarea class="form-control" id="txtMotfon" name="txtMotfon" rows="2" type="text" maxlength="50" required></textarea>
          </div>

          <!-- Credencial Madre -->
          <div class="form-group col-md-6">
              <label class="control-label">Tipo Identificación *</label>
              <select class="form-control selectpicker" id="listMotype" name="listMotype" required>
                      <option value="1">Cédula</option>
                      <option value="2">Ruc</option>
                      <option value="3">Pasaporte</option>
              </select>
              
          </div>
          <div class="form-group col-md-6">
              <label class="control-label">Número Identificación *</label>
              <input class="form-control" id="txtMotced" name="txtMotced" type="text" pattern="[a-zA-Z0-9-]{9,13}" title="Máximo 13 digitos" required>
          </div>
          

          <!-- Lugar de Trabajo y Fecha Nacimiento Madre -->
          <div class="form-group col-md-6">
                  <label class="control-label">Lugar Trabajo y Ocupación</label>
                  <input class="form-control" id="txtMotjob" name="txtMotjob" type="text" maxlength="100">
          </div>

          <div class="form-group col-md-6">
                  <label class="control-label">Fecha Nacimiento</label>
                  <input class="form-control" id="datMotbir" name="datMotbir" type="date">
          </div>
          

          <!-- Correo Madre -->
          <div class="form-group col-md-12">
              <label class="control-label">Correo Electrónico</label>
              <input class="form-control" id="txtMotmai" name="txtMotmai" type="email" maxlength="100">
          </div>
        </div>

        <!--------------------- Información deL Representante ---------------->
        <p class="text-primary mb-0">INFORMACIÓN DEl REPRESENTANTE</p>
        <hr class="mt-0">

        <div class="row">
                    <div class="form-group col-md-12">
                        <label for="listTt_who">Estudiante es Representado por *</label>
                        <select class="form-control selectpicker" id="listTt_who" name="listTt_who" required="">
                                <option value=""></option>
                                <option value="1">Padre</option>
                                <option value="2">Madre</option>
                                <option value="3">Otro</option>
                        </select>
                    </div>
        </div>
            
                <!-- Apellidos y Nombres Rpte -->
        <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="txtReplas">Apellidos *</label>
                            <input class="form-control" id="txtReplas" name="txtReplas" type="text" placeholder="*" maxlength="50" required="">
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="txtRepnam">Nombres *</label>
                            <input class="form-control" id="txtRepnam" name="txtRepnam" type="text" placeholder="*" maxlength="50" required="">
                        </div>
                    </div>
        </div>

                <!-- Dirección y Teléfonos Rpte -->
        <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="txtRepadr">Dirección *</label>
                            <textarea class="form-control" id="txtRepadr" name="txtRepadr" rows="3" type="text" placeholder="*" maxlength="100" required=""></textarea>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="txtRepfon">Teléfonos *</label>
                            <textarea class="form-control" id="txtRepfon" name="txtRepfon" rows="3" type="text" placeholder="*" maxlength="50" required=""></textarea>
                        </div>
                    </div>
        </div>

                <!-- Credencial Rpte -->
        <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="listRetype">Tipo Identificación *</label>
                            <select class="form-control selectpicker" id="listRetype" name="listRetype" required="">
                                    <option value="1">Cédula</option>
                                    <option value="2">Ruc</option>
                                    <option value="3">Pasaporte</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="txtRepced">Número Identificación *</label>
                            <input class="form-control" id="txtRepced" name="txtRepced" type="text" placeholder="*" pattern="[a-zA-Z0-9-]{9,13}" title="Máximo 13 digitos" required="">
                        </div>
                    </div>
        </div>

                <!-- Lugar de Trabajo y Fecha Nacimiento Rpte -->
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="txtRepjob">Lugar Trabajo y Ocupación *</label>
                            <input class="form-control" id="txtRepjob" name="txtRepjob" type="text" placeholder="*" maxlength="100" required="">
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="datRepbir">Fecha Nacimiento *</label>
                            <input class="form-control" id="datRepbir" name="datRepbir" type="date" placeholder="" required="">
                        </div>
                    </div>
                </div>

                <!-- Correo Rpte -->
                <div class="row">
                    <div class="form-group col-md-12">
                        <label for="txtRepmai">Correo Electrónico *</label>
                        <input class="form-control" id="txtRepmai" name="txtRepmai" type="email" placeholder="*" maxlength="100" required="">
                    </div>
                </div>
    
                <!-- Institución de Procedencia -->
                <div class="form-group">
                    <label class="txtLassch">Institución de Procedencia *</label>
                    <input class="form-control" id="txtLassch" name="txtLassch" type="text" placeholder="*" maxlength="100" required="">
                </div>


        <div class="form-group btn-container">
            <button type="submit" class="btn btn-primary btn-block"><i class="fas fa-file-export fa-lg fa-fw"></i>  Guardar</button>
        </div>
        <div class="form-group mt-2">
            <p class="semibold-text mb-2"><a href="<?= base_url(); ?>" data-toggle="flip"><i class="fa fa-angle-left fa-fw"></i> Retornar a Login</a></p><br>
        </div>
          
        </form>
      </div>
    </section>

    <script>
      const base_url = "<?= base_url(); ?>";
    </script>
    <!-- Essential javascripts for application to work-->
    <script src="<?= media(); ?>js/jquery-3.5.1.min.js"></script>
    <script src="<?= media(); ?>js/popper.min.js"></script>
    <script src="<?= media(); ?>js/bootstrap.min.js"></script>
    <script src="<?= media(); ?>js/fontawesome.js"></script>
    <script src="<?= media(); ?>js/main.js"></script>
    <!-- The javascript plugin to display page loading on top-->
    <script src="<?= media(); ?>js/plugins/pace.min.js"></script>
    <script type="text/javascript" src="<?= media(); ?>js/plugins/sweetalert.min.js"></script>
    <script type="text/javascript" src="<?= media(); ?>js/plugins/bootstrap-select.min.js"></script>

    <script src="<?= media(); ?>js/<?= $data['page_functions_js']; ?>"></script>

  </body>
</html>