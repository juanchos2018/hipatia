<!-- Modal -->
<div class="modal fade" id="modalformVsnewstd" name="modalFormVsnewstd" tabindex="-1" role="dialog" data-keyboard="false" data-backdrop="static" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable" role="document">
        <div class="modal-content">
            <div class="modal-header headerRegister">
                <h5 class="modal-title" id="titleModal">Registro de Aspitantes en Línea</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            
            <div class="modal-body">
                <form id="formVsnewstd" name="formVsnewstd">
                <!-- boton oculto -->
                <input type="hidden" id="idStd_no" name="idStd_no" value="">
                <p class="text-primary">Campos con asterisco * son obligatorios</p>

                <!-- Estudiante es Admitido -->
                <div class="row">
                    <div class="form-group col-md-6">
                        <label for="listReceiv">Estudiante Admitido</label>
                        <select class="form-control selectpicker" id="listReceiv" name="listReceiv">
                                <option value="0" selected>Seleccione</option>
                                <option value="1">Si</option>
                                <option value="2">No</option>
                        </select>
                    </div>
                    <div class="form-group col-md-6">
                        <label for="listPerios">Año Lectivo *</label>
                        <input class="form-control" id="listPerios" name="listPerios" type="number" min="0" max="9999" required="">
                    </div>
                </div>

                <!-- Sección -->
                <div class="row">
                    <div class="form-group col-md-12">
                        <label for="listSec_no">Sección *</label>
                        <select class="form-control" data-live-search="true" data-size="5" id="listSec_no" name="listSec_no" required="">
                        </select>
                    </div>
                </div>

                <!-- Apellidos y Nombres Estudiante -->
                <div class="row">
                    <div class="form-group col-md-6">
                        <label for="txtLas_nm">Apellidos Estudiante *</label>
                        <input class="form-control" id="txtLas_nm" name="txtLas_nm" type="text" placeholder="*" maxlength="50" required="">
                    </div>                        
                    <div class="form-group col-md-6">
                        <label for="txtFir_nm">Nombres Estudiante *</label>
                        <input class="form-control" id="txtFir_nm" name="txtFir_nm" type="text" placeholder="*" maxlength="50" required="">
                    </div>
                </div>

                <!-- Dirección y Teléfonos Estudiante -->
                <div class="row">
                    <div class="form-group col-md-6">
                        <label for="txtAddres">Dirección Estudiante *</label>
                        <textarea class="form-control" id="txtAddres" name="txtAddres" rows="3" type="text" placeholder="*" maxlength="100" required=""></textarea>
                    </div>
                    <div class="form-group col-md-6">
                        <label for="txtTphone">Teléfonos Estudiante *</label>
                        <textarea class="form-control" id="txtTphone" name="txtTphone" rows="3" type="text" placeholder="*" maxlength="50" required=""></textarea>
                    </div>
                </div>
                                    
                <!-- Credencial Estudiante -->
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
                        <input class="form-control" id="txtIde_no" name="txtIde_no" type="text" placeholder="*" pattern="[a-zA-Z0-9-]{1,13}" maxlength="13" title="Máximo 13 digitos" required="">
                    </div>
                </div>

                <!-- Género y Fecha Nacimiento Estudiante -->
                <div class="row">
                    <div class="form-group col-md-6">
                        <label for="listStdgen">Género *</label>
                        <select class="form-control selectpicker" id="listStdgen" name="listStdgen" required="">
                                <option value="" selected>Seleccione</option>
                                <option value="1">Masculino</option>
                                <option value="2">Femenino</option>
                        </select>
                    </div>
                    <div class="form-group col-md-6">
                        <label for="datFecbir">Fecha Nacimiento *</label>
                        <input class="form-control" id="datFecbir" name="datFecbir" type="date" required="">
                    </div>
                </div>

                <!-- Correo Estudiante -->
                <div class="row">
                    <div class="form-group col-md-12">
                        <label for="txtStdmai">Correo Electrónico Estudiante</label>
                        <input class="form-control" id="txtStdmai" name="txtStdmai" type="email" maxlength="100">
                    </div>
                </div>

                <!-- Institución de Procedencia -->
                <div class="row">
                    <div class="form-group col-md-12">
                        <label for="txtLassch">Institución de Procedencia *</label>
                        <input class="form-control" id="txtLassch" name="txtLassch" type="text" placeholder="*" maxlength="100" required="">
                    </div>
                </div>

                
                <!-- Información del Padre: -->
                <p class="text-info mb-0">INFORMACIÓN DEL PADRE</p>
                <hr class="mt-0">

                <div class="row">
                    <div class="form-group col-md-6">
                        <label for="txtFatlas">Apellidos *</label>
                        <input class="form-control" id="txtFatlas" name="txtFatlas" type="text" placeholder="*" maxlength="50" required="">
                    </div>
                    <div class="form-group col-md-6">
                        <label for="txtFatnam">Nombres *</label>
                        <input class="form-control" id="txtFatnam" name="txtFatnam" type="text" placeholder="*" maxlength="50" required="">
                    </div>
                </div>

                <!-- Dirección y Teléfonos Padre -->
                <div class="row">
                    <div class="form-group col-md-6">
                        <label for="txtFatadr">Dirección</label>
                        <textarea class="form-control" id="txtFatadr" name="txtFatadr" rows="3" type="text" maxlength="100"></textarea>
                    </div>
                    <div class="form-group col-md-6">
                        <label for="txtFatfon">Teléfonos</label>
                        <textarea class="form-control" id="txtFatfon" name="txtFatfon" rows="3" type="text" maxlength="50"></textarea>
                    </div>
                </div>

                <!-- Credencial Padre -->
                <div class="row">
                    <div class="form-group col-md-6">
                        <label for="listFatype">Tipo Identificación</label>
                        <select class="form-control selectpicker" id="listFatype" name="listFatype">
                                <option value="05">Cédula</option>
                                <option value="04">RUC</option>
                                <option value="06">Pasaporte</option>
                        </select>
                    </div>
                    <div class="form-group col-md-6">
                        <label for="txtFatced">Número Identificación</label>
                        <input class="form-control" id="txtFatced" name="txtFatced" type="text" pattern="[a-zA-Z0-9-]{1,13}" maxlength="13" title="Máximo 13 digitos">
                    </div>
                </div>

                <!-- Lugar de Trabajo y Fecha Nacimiento Padre -->
                <div class="row">
                    <div class="form-group col-md-6">
                        <label for="txtFatjob">Lugar Trabajo y Ocupación</label>
                        <input class="form-control" id="txtFatjob" name="txtFatjob" type="text" maxlength="100">
                    </div>
                    <div class="form-group col-md-6">
                        <label for="datFatbir">Fecha Nacimiento</label>
                        <input class="form-control" id="datFatbir" name="datFatbir" type="date" placeholder="">
                    </div>
                </div>

                <!-- Correo Padre -->
                <div class="row">
                    <div class="form-group col-md-12">
                        <label for="txtFatmai">Correo Electrónico</label>
                        <input class="form-control" id="txtFatmai" name="txtFatmai" type="email" maxlength="100">
                    </div>
                </div>


                <!-- Información de la Madre -->
                <p class="text-info mb-0">INFORMACIÓN DE LA MADRE</p>
                <hr class="mt-0">

                <div class="row">
                    <div class="form-group col-md-6">
                        <label for="txtMotlas">Apellidos *</label>
                        <input class="form-control" id="txtMotlas" name="txtMotlas" type="text" placeholder="*" maxlength="50" required="">
                   </div>
                   <div class="form-group col-md-6">
                        <label for="txtMotnam">Nombres *</label>
                        <input class="form-control" id="txtMotnam" name="txtMotnam" type="text" placeholder="*" maxlength="50" required="">
                   </div>
                </div>

                <!-- Dirección y Teléfonos Madre -->
                <div class="row">
                    <div class="form-group col-md-6">
                        <label for="txtMotadr">Dirección</label>
                        <textarea class="form-control" id="txtMotadr" name="txtMotadr" rows="3" type="text" maxlength="100"></textarea>
                    </div>
                    <div class="form-group col-md-6">
                        <label for="txtMotfon">Teléfonos</label>
                        <textarea class="form-control" id="txtMotfon" name="txtMotfon" rows="3" type="text" maxlength="50"></textarea>
                    </div>
                </div>

                <!-- Credencial Madre -->
                <div class="row">
                    <div class="form-group col-md-6">
                        <label for="listMotype">Tipo Identificación</label>
                        <select class="form-control selectpicker" id="listMotype" name="listMotype">
                                <option value="05">Cédula</option>
                                <option value="04">RUC</option>
                                <option value="06">Pasaporte</option>
                        </select>
                    </div>
                    <div class="form-group col-md-6">
                        <label for="txtMotced">Número Identificación</label>
                        <input class="form-control" id="txtMotced" name="txtMotced" type="text" pattern="[a-zA-Z0-9-]{1,13}" maxlength="13" title="Máximo 13 digitos">
                    </div>
                </div>

                <!-- Lugar de Trabajo y Fecha Nacimiento Madre -->
                <div class="row">
                    <div class="form-group col-md-6">
                        <label for="txtMotjob">Lugar Trabajo y Ocupación</label>
                        <input class="form-control" id="txtMotjob" name="txtMotjob" type="text" maxlength="100">
                    </div>
                    <div class="form-group col-md-6">
                        <label for="datMotbir">Fecha Nacimiento</label>
                        <input class="form-control" id="datMotbir" name="datMotbir" type="date">
                    </div>
                </div>

                <!-- Correo Madre -->
                <div class="row">
                    <div class="form-group col-md-12">
                        <label for="txtMotmai">Correo Electrónico</label>
                        <input class="form-control" id="txtMotmai" name="txtMotmai" type="email" maxlength="100">
                    </div>
                </div>


                <!-- Estudiante Representado por -->
                <p class="text-info mb-0">INFORMACIÓN DEL REPRESENTANTE</p>
                <hr class="mt-0">

                <div class="row">
                    <div class="form-group col-md-12">
                        <label for="listTt_who">Estudiante es Representado por *</label>
                        <select class="form-control selectpicker" id="listTt_who" name="listTt_who" onchange="getRep();" required="">
                                <option value="" selected>Seleccione</option>
                                <option value="1">Padre</option>
                                <option value="2">Madre</option>
                                <option value="3">Otro</option>
                        </select>
                    </div>
                </div>
            
                <!-- Apellidos y Nombres Rpte -->
                <div class="row">
                    <div class="form-group col-md-6">
                        <label for="txtReplas">Apellidos *</label>
                        <input class="form-control" id="txtReplas" name="txtReplas" type="text" placeholder="*" maxlength="50" required="">
                    </div>
                    <div class="form-group col-md-6">
                        <label for="txtRepnam">Nombres *</label>
                        <input class="form-control" id="txtRepnam" name="txtRepnam" type="text" placeholder="*" maxlength="50" required="">
                    </div>
                </div>

                <!-- Dirección y Teléfonos Rpte -->
                <div class="row">
                    <div class="form-group col-md-6">
                        <label for="txtRepadr">Dirección</label>
                        <textarea class="form-control" id="txtRepadr" name="txtRepadr" rows="3" type="text" placeholder="*" maxlength="100"></textarea>
                    </div>
                    <div class="form-group col-md-6">
                        <label for="txtRepfon">Teléfonos</label>
                        <textarea class="form-control" id="txtRepfon" name="txtRepfon" rows="3" type="text" placeholder="*" maxlength="50"></textarea>
                    </div>
                </div>

                <!-- Credencial Rpte -->
                <div class="row">
                    <div class="form-group col-md-6">
                        <label for="listRetype">Tipo Identificación *</label>
                        <select class="form-control selectpicker" id="listRetype" name="listRetype" required="">
                                <option value="" selected>Seleccione</option>
                                <option value="05">Cédula</option>
                                <option value="04">RUC</option>
                                <option value="06">Pasaporte</option>
                        </select>
                    </div>
                    <div class="form-group col-md-6">
                        <label for="txtRepced">Número Identificación *</label>
                        <input class="form-control" id="txtRepced" name="txtRepced" type="text" placeholder="*" pattern="[a-zA-Z0-9-]{1,13}" maxlength="13" title="Máximo 13 digitos" required="">
                    </div>
                </div>

                <!-- Lugar de Trabajo y Fecha Nacimiento Rpte -->
                <div class="row">
                    <div class="form-group col-md-6">
                        <label for="txtRepjob">Lugar Trabajo y Ocupación</label>
                        <input class="form-control" id="txtRepjob" name="txtRepjob" type="text" maxlength="100">
                    </div>
                    <div class="form-group col-md-6">
                        <label for="datRepbir">Fecha Nacimiento</label>
                        <input class="form-control" id="datRepbir" name="datRepbir" type="date">
                    </div>
                </div>

                <!-- Correo Rpte -->
                <div class="row">
                    <div class="form-group col-md-12">
                        <label for="txtRepmai">Correo Electrónico *</label>
                        <input class="form-control" id="txtRepmai" name="txtRepmai" type="email" placeholder="*" maxlength="100" required="">
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
