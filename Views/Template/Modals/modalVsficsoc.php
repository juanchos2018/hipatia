<!-- Modal -->
<div class="modal fade" id="modalformVsficsoc" name="modalFormVsficsoc" tabindex="-1" role="dialog" data-keyboard="false" data-backdrop="static" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable" role="document">
        <div class="modal-content">
            <div class="modal-header headerRegister">
                <h5 class="modal-title" id="titleModal">Nueva Ficha Social</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            
            <div class="modal-body">
                <form id="formVsficsoc" name="formVsficsoc">
                <!-- boton oculto -->
                <input type="hidden" id="idSec_id" name="idSec_id" value="">
                <p class="text-primary">Campos con asterisco * son obligatorios</p>

                <!-- Estudiante -->
                <div class="row">
                    <div class="form-group col-md-12">
                        <label for="listStd_no">Estudiante *</label>
                        <select class="form-control" data-live-search="true" data-size="5" id="listStd_no" name="listStd_no" required="">
                        </select>
                    </div>
                </div>

                <p class="text-info mb-0">INFORMACIÓN SOCIAL DEL ESTUDIANTE</p>
                <hr class="mt-0">

                <!-- Estado Civil y Grupo Etnico -->
                <div class="row">
                    <div class="form-group col-md-6">
                        <label for="listCivils">Estado Civil *</label>
                        <select class="form-control selectpicker" id="listCivils" name="listCivils" required>
                                <option value="" selected>Seleccione</option>
                                <option value="1">Soltero</option>
                                <option value="2">Casado</option>
                                <option value="3">Divorciado</option>
                                <option value="4">Viudo</option>
                                <option value="5">Unión Libre</option>
                        </select>
                    </div>
                    <div class="form-group col-md-6">
                        <label for="listEtnico">Grupo Etnico *</label>
                        <select class="form-control selectpicker" id="listEtnico" name="listEtnico" required>
                                <option value="" selected>Seleccione</option>
                                <option value="1">Mestizo</option>
                                <option value="2">Indigena</option>
                                <option value="3">AfroEcuatoriano</option>
                                <option value="4">Otro</option>
                        </select>
                    </div>
                </div>

                <!-- Ocupación y Lugar de Trabajo -->
                <div class="row">
                    <div class="form-group col-md-6">
                        <label for="txtStdjob">Ocupación</label>
                        <textarea class="form-control" id="txtStdjob" name="txtStdjob" rows="2" type="text" placeholder="" maxlength="50"></textarea>
                    </div>  
                    <div class="form-group col-md-6">
                        <label for="txtStdwrk">Lugar de Trabajo</label>
                        <textarea class="form-control" id="txtStdwrk" name="txtStdwrk" rows="2" type="text" placeholder="" maxlength="50"></textarea>
                    </div> 
                </div> 

                <!-- Condición y Tipo de Vivienda -->
                <div class="row">
                    <div class="form-group col-md-6">
                        <label for="listHoucon">Condición de Vivienda *</label>
                        <select class="form-control selectpicker" id="listHoucon" name="listHoucon" required>
                                <option value="" selected>Seleccione</option>
                                <option value="1">Propia</option>
                                <option value="2">Arrendada</option>
                                <option value="3">Prestada</option>
                                <option value="4">Anticresis</option>
                                <option value="5">Compartida</option>
                        </select>
                    </div>
                    <div class="form-group col-md-6">
                        <label for="listHoutyp">Tipo de Vivienda *</label>
                        <select class="form-control selectpicker" id="listHoutyp" name="listHoutyp" required>
                                <option value="" selected>Seleccione</option>
                                <option value="1">Casa</option>
                                <option value="2">Departamento</option>
                                <option value="3">Cuarto</option>
                        </select>
                    </div>
                </div>

                <!-- Energia Electrica y Agua -->
                <div class="row">
                    <div class="form-group col-md-6">
                        <label for="listEnergy">Posee Luz Eléctrica *</label>
                        <select class="form-control selectpicker" id="listEnergy" name="listEnergy" required>
                                <option value="" selected>Seleccione</option>
                                <option value="1">Si</option>
                                <option value="2">No</option>
                        </select>
                    </div>
                    <div class="form-group col-md-6">
                        <label for="listWaters">Posee Agua Potable *</label>
                        <select class="form-control selectpicker" id="listWaters" name="listWaters" required>
                                <option value="" selected>Seleccione</option>
                                <option value="1">Si</option>
                                <option value="2">No</option>
                        </select>
                    </div>
                </div>

                <!-- Posee SS.HH o Pozo Septico -->
                <div class="row">
                    <div class="form-group col-md-6">
                        <label for="listToilet">Posee SS.HH. *</label>
                        <select class="form-control selectpicker" id="listToilet" name="listToilet" required>
                                <option value="" selected>Seleccione</option>
                                <option value="1">Si</option>
                                <option value="2">No</option>
                        </select>
                    </div>
                    <div class="form-group col-md-6">
                        <label for="listSeptic">Posee Pozo Séptico *</label>
                        <select class="form-control selectpicker" id="listSeptic" name="listSeptic" required>
                                <option value="" selected>Seleccione</option>
                                <option value="1">Si</option>
                                <option value="2">No</option>
                        </select>
                    </div>
                </div>

                <!-- Telefono y Smartphone -->
                <div class="row">
                    <div class="form-group col-md-6">
                        <label for="listTeleph">Posee Teléfono Convencional *</label>
                        <select class="form-control selectpicker" id="listTeleph" name="listTeleph" required>
                                <option value="" selected>Seleccione</option>
                                <option value="1">Si</option>
                                <option value="2">No</option>
                        </select>
                    </div>
                    <div class="form-group col-md-6">
                        <label for="listSmarph">Posee Teléfono Celular *</label>
                        <select class="form-control selectpicker" id="listSmarph" name="listSmarph" required>
                                <option value="" selected>Seleccione</option>
                                <option value="1">Si</option>
                                <option value="2">No</option>
                        </select>
                    </div>
                </div>

                <!-- Internet y TV por Cable -->
                <div class="row">
                    <div class="form-group col-md-6">
                        <label for="listIntern">Posee Internet *</label>
                        <select class="form-control selectpicker" id="listIntern" name="listIntern" required>
                                <option value="" selected>Seleccione</option>
                                <option value="1">Si</option>
                                <option value="2">No</option>
                        </select>
                    </div>
                    <div class="form-group col-md-6">
                        <label for="listTvcabl">Posee TV por Cable *</label>
                        <select class="form-control selectpicker" id="listTvcabl" name="listTvcabl" required>
                                <option value="" selected>Seleccione</option>
                                <option value="1">Si</option>
                                <option value="2">No</option>
                        </select>
                    </div>
                </div>

                <p class="text-info mb-0">INFORMACIÓN MÉDICA DEL ESTUDIANTE</p>
                <hr class="mt-0">

                <!-- Atención Médica -->
                <div class="row">
                    <div class="form-group col-md-6">
                        <label for="listMedatt">Lugar Atención Médica *</label>
                        <select class="form-control selectpicker" id="listMedatt" name="listMedatt" required>
                                <option value="" selected>Seleccione</option>
                                <option value="1">Hospital Privado</option>
                                <option value="2">Hospital Público</option>
                                <option value="3">Centro de Salud</option>
                                <option value="4">SubCentro de Salud</option>
                        </select>
                    </div>
                    <div class="form-group col-md-6">
                        <label for="listMedfre">Frecuencia Atención Médica *</label>
                        <select class="form-control selectpicker" id="listMedfre" name="listMedfre" required>
                                <option value="" selected>Seleccione</option>
                                <option value="1">Anual</option>
                                <option value="2">Trimestral</option>
                                <option value="3">Cuando Enferma</option>
                        </select>
                    </div>
                </div>

                <!-- Alergias -->
                <div class="row">
                    <div class="form-group col-md-6">
                        <label for="txtAlermd">Alergias Medicamentos</label>
                        <textarea class="form-control" id="txtAlermd" name="txtAlermd" rows="2" type="text" placeholder="" maxlength="100"></textarea>
                    </div>  
                    <div class="form-group col-md-6">
                        <label for="txtAlerfo">Alergias Alimentos</label>
                        <textarea class="form-control" id="txtAlerfo" name="txtAlerfo" rows="2" type="text" placeholder="" maxlength="100"></textarea>
                    </div>  
                </div>  
                <div class="row">
                    <div class="form-group col-md-6">
                        <label for="txtAlercl">Alergias Climáticas</label>
                        <textarea class="form-control" id="txtAlercl" name="txtAlercl" rows="2" type="text" placeholder="" maxlength="100"></textarea>
                    </div>  
                    <div class="form-group col-md-6">
                        <label for="txtAlerot">Alergias Otros</label>
                        <textarea class="form-control" id="txtAlerot" name="txtAlerot" rows="2" type="text" placeholder="" maxlength="100"></textarea>
                    </div>  
                </div>  

                <!-- Tipo de Sangre y Enfermedades -->
                <div class="row">
                    <div class="form-group col-md-6">
                        <label for="txtBloodt">Tipo de Sangre *</label>
                        <textarea class="form-control" id="txtBloodt" name="txtBloodt" rows="2" type="text" placeholder="*" maxlength="100"></textarea required>
                    </div>  
                    <div class="form-group col-md-6">
                        <label for="txtDiseas">Enfermedades Graves</label>
                        <textarea class="form-control" id="txtDiseas" name="txtDiseas" rows="2" type="text" placeholder="" maxlength="100"></textarea>
                    </div>  
                </div>  

                <!-- Discapacidad -->
                <div class="row">
                    <div class="form-group col-md-6">
                        <label for="txtDiscap">Tipos de Discapacidad</label>
                        <textarea class="form-control" id="txtDiscap" name="txtDiscap" rows="2" type="text" placeholder="" maxlength="100"></textarea>
                    </div>  
                    <div class="form-group col-md-6">
                        <label for="txtConadi">Número Carnet CONADIS</label>
                        <textarea class="form-control" id="txtConadi" name="txtConadi" rows="2" type="text" placeholder="" maxlength="100"></textarea>
                    </div>  
                </div>  

                <!-- Obsesidad y Diabetes -->
                <div class="row">
                    <div class="form-group col-md-6">
                        <label for="listObesid">Obesidad Familiar *</label>
                        <select class="form-control selectpicker" id="listObesid" name="listObesid" required>
                                <option value="" selected>Seleccione</option>
                                <option value="1">Si</option>
                                <option value="2">No</option>
                        </select>
                    </div>
                    <div class="form-group col-md-6">
                        <label for="listDiabet">Diabetes Familiar *</label>
                        <select class="form-control selectpicker" id="listDiabet" name="listDiabet" required>
                                <option value="" selected>Seleccione</option>
                                <option value="1">Si</option>
                                <option value="2">No</option>
                        </select>
                    </div>
                </div>

                <!-- Hipertensión y Cardiopatia -->
                <div class="row">
                    <div class="form-group col-md-6">
                        <label for="listHipert">Hipertensión Familiar *</label>
                        <select class="form-control selectpicker" id="listHipert" name="listHipert" required>
                                <option value="" selected>Seleccione</option>
                                <option value="1">Si</option>
                                <option value="2">No</option>
                        </select>
                    </div>
                    <div class="form-group col-md-6">
                        <label for="listCardio">Cardiopatía Familiar *</label>
                        <select class="form-control selectpicker" id="listCardio" name="listCardio" required>
                                <option value="" selected>Seleccione</option>
                                <option value="1">Si</option>
                                <option value="2">No</option>
                        </select>
                    </div>
                </div>

                <!-- Mentales y Otros -->
                <div class="row">
                    <div class="form-group col-md-6">
                        <label for="listBrains">Problemas Mentales Familiares *</label>
                        <select class="form-control selectpicker" id="listBrains" name="listBrains">
                                <option value="" selected>Seleccione</option>
                                <option value="1">Si</option>
                                <option value="2">No</option>
                        </select>
                    </div>
                    <div class="form-group col-md-6">
                        <label for="listOthers">Otras Enfermedades *</label>
                        <select class="form-control selectpicker" id="listOthers" name="listOthers">
                                <option value="" selected>Seleccione</option>
                                <option value="1">Si</option>
                                <option value="2">No</option>
                        </select>
                    </div>
                </div>

                <!-- Medicamentos Utilizados -->
                <div class="row">
                    <div class="form-group col-md-12">
                        <label for="txtMedici">Medicamentos Utilizados</label>
                        <textarea class="form-control" id="txtMedici" name="txtMedici" rows="2" type="text" placeholder="" maxlength="100"></textarea>
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
