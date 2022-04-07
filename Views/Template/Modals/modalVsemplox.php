<!-- Modal -->
<div class="modal fade" id="modalformVsemplox" name="modalFormVsemplox" tabindex="-1" role="dialog" data-keyboard="false" data-backdrop="static" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered modal-lg" role="document">
        <div id="divLoading">
            <div>
                <img src="<?= media(); ?>images/ajax-loader.gif" alt="Loading">
            </div>
        </div>
        <div class="modal-content">
            <div class="modal-header headerRegister">
                <h5 class="modal-title" id="titleModal">Nuevo Personal</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            
            <div class="modal-body">

                <form id="formVsemplox" name="formVsemplox">
                <!-- boton oculto -->
                <input type="hidden" id="idEmp_no" name="idEmp_no" value="">
                <p class="text-primary">Campos con asterisco * son obligatorios</p>

                <!-- Condición y Perfil de Personal -->
                <div class="row">
                    <div class="form-group col-md-6">
                        <label for="listStatus">Condición *</label>
                        <select class="form-control selectpicker" id="listStatus" name="listStatus" required="">
                                <option value="" selected>Seleccione</option>
                                <option value="1">Activo</option>
                                <option value="0">Inactivo</option>
                        </select>
                    </div>
                    <div class="form-group col-md-6">
                        <label for="listProfil">Perfil en el Sistema *</label>
                        <select class="form-control selectpicker" id="listProfil" name="listProfil" required="">
                                <option value="" selected>Seleccione</option>
                                <option value="1">System Manager</option>
                                <option value="2">Autoridad</option>
                                <option value="3">Coordinación</option>
                                <option value="4">Secretariado</option>
                                <option value="5">Docencia</option>
                                <option value="6">Inspección</option>
                                <option value="9">Cajero Facturación</option>
                        </select>
                    </div>
                </div>

                <!-- Apellidos y Nombres Personal -->
                <div class="row">
                    <div class="form-group col-md-6">
                        <label for="txtLas_nm">Apellidos *</label>
                        <input class="form-control" id="txtLas_nm" name="txtLas_nm" type="text" placeholder="*" maxlength="30" required="">
                    </div>
                    <div class="form-group col-md-6">
                        <label for="txtFir_nm">Nombres *</label>
                        <input class="form-control" id="txtFir_nm" name="txtFir_nm" type="text" placeholder="*" maxlength="30" required="">
                    </div>         
                </div>

                <!-- Dirección y Teléfonos Personal -->
                <div class="row">
                    <div class="form-group col-md-6">
                        <label for="txtAddres">Dirección Residencia *</label>
                        <textarea class="form-control" id="txtAddres" name="txtAddres" rows="3" type="text" placeholder="*" maxlength="100" required=""></textarea>
                    </div>
                    <div class="form-group col-md-6">
                        <label for="txtTphone">Teléfonos *</label>
                        <textarea class="form-control" id="txtTphone" name="txtTphone" rows="3" type="text" placeholder="*" maxlength="50" required=""></textarea>
                    </div>
                </div>

                <!-- Parroquia y Ciudad -->
                <div class="row">
                    <div class="form-group col-md-6">
                        <label for="txtParroq">Parroquia Reside</label>
                        <input class="form-control" id="txtParroq" name="txtParroq" type="text" maxlength="50">
                    </div>
                    <div class="form-group col-md-6">
                        <label for="txtCiudad">Ciudad Reside</label>
                        <input class="form-control" id="txtCiudad" name="txtCiudad" type="text" maxlength="50">
                    </div>
                </div>

                <!-- Provincia y País -->
                <div class="row">
                    <div class="form-group col-md-6">
                        <label for="txtProvin">Provincia Reside</label>
                        <input class="form-control" id="txtProvin" name="txtProvin" type="text" maxlength="50">
                    </div>
                    <div class="form-group col-md-6">
                        <label for="txtPaises">País Reside</label>
                        <input class="form-control" id="txtPaises" name="txtPaises" type="text" maxlength="50">
                    </div>
                </div>

                <!-- Credencial Personal -->
                <div class="row">
                    <div class="form-group col-md-6">
                        <label for="listIdtype">Tipo Identificación *</label>
                        <select class="form-control selectpicker" id="listIdtype" name="listIdtype" required="">
                                <option value="" selected>Seleccione</option>
                                <option value="05">Cédula</option>
                                <option value="04">RUC</option>
                                <option value="06">Pasaporte</option>
                        </select>
                    </div>
                    <div class="form-group col-md-6">
                        <label for="txtIde_no">Número Identificación *</label>
                        <input class="form-control" id="txtIde_no" name="txtIde_no" type="text" pattern="[a-zA-Z0-9-]{9,13}" title="Maximo 13 digitos" required="">
                    </div>
                </div>

                <!-- Género y Estado Civil -->
                <div class="row">
                    <div class="form-group col-md-6">
                        <label for="listEmpgen">Género *</label>
                        <select class="form-control selectpicker" id="listEmpgen" name="listEmpgen" required="">
                                <option value="" selected>Seleccione</option>
                                <option value="1">Masculino</option>
                                <option value="2">Femenino</option>
                        </select>
                    </div>
                    <div class="form-group col-md-6">
                        <label for="listEstado">Estado Civil *</label>
                        <select class="form-control selectpicker" id="listEstado" name="listEstado" required="">
                                <option value="" selected>Seleccione</option>
                                <option value="1">Soltero</option>
                                <option value="2">Casado</option>
                                <option value="3">Divorciado</option>
                                <option value="4">Viudo</option>
                                <option value="5">Unión Libre</option>
                        </select>
                    </div>
                </div>

                <!-- Fecha Nacimiento y Fecha Ingreso -->
                <div class="row">
                    <div class="form-group col-md-6">
                        <label for="datFecbir">Fecha Nacimiento</label>
                        <input class="form-control" id="datFecbir" name="datFecbir" type="date">
                    </div>
                    <div class="form-group col-md-6">
                        <label for="datFecing">Fecha Ingreso *</label>
                        <input class="form-control" id="datFecing" name="datFecing" type="date" required="">
                    </div>
                </div>

                <!-- Correo Personal -->
                <div class="row">
                    <div class="form-group col-md-12">
                        <label for="txtEmpmai">Correo Electrónico *</label>
                        <input class="form-control" id="txtEmpmai" name="txtEmpmai" type="email" maxlength="50" required="">
                    </div>    
                </div>          

                <!-- Tiempo de Servicio y Magisterio -->
                <div class="row">
                    <div class="form-group col-md-6">
                        <label for="txtServic">Años de Servicio</label>
                        <input class="form-control" id="txtServic" name="txtServic" type="number" maxlength="2">
                    </div>
                    <div class="form-group col-md-6">
                        <label for="txtMagist">Años en Magisterio</label>
                        <input class="form-control" id="txtMagist" name="txtMagist" type="number" maxlength="2">
                    </div>
                </div>

                <!-- Código Sectorial y Postal -->
                <div class="row">
                    <div class="form-group col-md-6">
                        <label for="txtSeccod">Código Sectorial</label>
                        <input class="form-control" id="txtSeccod" name="txtSeccod" type="text" maxlength="15">
                    </div>
                    <div class="form-group col-md-6">
                        <label for="txtPoscod">Código Postal</label>
                        <input class="form-control" id="txtPoscod" name="txtPoscod" type="text" maxlength="15">
                    </div>
                </div>

                <!-- Religión y Número de Cargas -->
                <div class="row">
                    <div class="form-group col-md-6">
                        <label for="listEmprlg">Religión *</label>
                        <select class="form-control selectpicker" id="listEmprlg" name="listEmprlg" required="">
                                <option value="1">Católica</option>
                                <option value="2">Evangélica</option>
                                <option value="3">Testigo de Jehová</option>
                                <option value="4">Cristiana Ecuménica</option>
                                <option value="5">Mormón</option>
                                <option value="6">Judía</option>
                                <option value="7">Musulmán</option>
                        </select>
                    </div>
                    <div class="form-group col-md-6">
                        <label for="txtCargas">No. Cargas Familiares</label>
                        <input class="form-control" id="txtCargas" name="txtCargas" type="number" maxlength="2">
                    </div>
                </div>

                <!-- Titulos Obtenidos y Observaciones -->
                <div class="row">
                    <div class="form-group col-md-6">
                        <label for="txtTitulo">Títulos Obtenidos</label>
                        <textarea class="form-control" id="txtTitulo" name="txtTitulo" rows="4" maxlength="100"></textarea>
                    </div>
                    <div class="form-group col-md-6">
                        <label for="txtRemark">Observaciones</label>
                        <textarea class="form-control" id="txtRemark" name="txtRemark" rows="4" maxlength="100"></textarea>
                    </div>
                </div> 
                <p class="text-info mb-0">INFORMACIÓN FINANCIERA</p>
                <hr class="mt-0">

                <!-- Sueldo -->
                <div class="row">
                    <div class="form-group col-md-6">
                        <label for="listCat_no">Grupo Nómina *</label>
                        <select class="form-control" data-live-search="true" data-size="5" id="listCat_no" name="listCat_no" required="">
                        </select>
                    </div>
                    <div class="form-group col-md-6">
                        <label for="txtSalary">Sueldo</label>
                        <input class="form-control" id="txtSalary" name="txtSalary" type="number" step="0.01" min="0" value="0">
                    </div>
                </div>

                <!-- Cuenta Bancaria -->
                <div class="row">
                    <div class="form-group col-md-6">
                        <label for="listCtatyp">Tipo Cuenta Bancaria</label>
                        <select class="form-control selectpicker" id="listCtatyp" name="listCtatyp">
                                <option value="1">Ahorro</option>
                                <option value="2">Corriente</option>
                                <option value="3">Virtual</option>
                        </select>
                    </div>
                    <div class="form-group col-md-6">
                        <label for="txtCtaban">No. Cuenta Bancaria</label>
                        <input class="form-control" id="txtCtaban" name="txtCtaban" type="number" maxlength="15">
                    </div>
                </div>

                <div class="modal-footer">
                    <button id="btnActionForm" class="btn btn-success" type="submit"><i class="fa fa-fw fa-lg fa-check-circle"></i><span id="btnText">Guardar</span></button>&nbsp;&nbsp;&nbsp;                 
                    <button class="btn btn-danger" type="button" data-dismiss="modal"><i class="fa fa-fw fa-lg fa-times-circle"></i>Cancelar</button>
                </div> 

                </form>
            </div>
        </div>
    </div>
</div>
