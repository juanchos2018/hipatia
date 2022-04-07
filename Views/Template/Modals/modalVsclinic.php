<!-- Modal -->
<div class="modal fade" id="modalformVsclinic" name="modalFormVsclinic" tabindex="-1" role="dialog" data-keyboard="false" data-backdrop="static" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header headerRegister">
                <h5 class="modal-title" id="titleModal">Registrar Actividad</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            
            <div class="modal-body">
                <form id="formVsclinic" name="formVsclinic">
                <!-- boton oculto -->
                <input type="hidden" id="idSec_id" name="idSec_id" value="">
                <input type="hidden" id="txtHiscod" name="txtHiscod" value="">
                <input type="hidden" id="listCas_no" name="listCas_no" value="">
                 
                <p class="text-primary">Campos con asterisco * son obligatorios</p>

                <!-- Estudiante -->
                <div class="row">
                    <div class="form-group col-md-12">
                        <label for="listStd_no">Estudiante *</label>
                        <select class="form-control" data-live-search="true" data-size="5" id="listStd_no" name="listStd_no" required="">
                        </select>
                    </div>
                </div>

                <!-- Fechas -->
                <div class="row">
                    <div class="form-group col-md-6">
                        <label for="datFecreg">Fecha Registro *</label>
                        <input class="form-control" id="datFecreg" name="datFecreg" type="date" required="">
                    </div>
                    <div class="form-group col-md-6">
                        <label for="datFecnex">Fecha Próxima Atención *</label>
                        <input class="form-control" id="datFecnex" name="datFecnex" type="date" required="">
                    </div>
           		</div>

                <!-- Peso y Estatura -->
                <div class="row">
                    <div class="form-group col-md-6">
                        <label for="txtWeighs">Peso Corporal (lbs.)</label>
                        <input class="form-control" id="txtWeighs" name="txtWeighs" type="text" maxlength="6">
                    </div>
                    <div class="form-group col-md-6">
                        <label for="txtHeighs">Estatura (mts.)</label>
                        <input class="form-control" id="txtHeighs" name="txtHeighs" type="text" maxlength="6">
                    </div>
                </div>

                <!-- Presión Arterial y Temperatura -->
                <div class="row">
                    <div class="form-group col-md-6">
                        <label for="txtPresur">Presión Arterial</label>
                        <input class="form-control" id="txtPresur" name="txtPresur" type="text" maxlength="6">
                    </div>
                    <div class="form-group col-md-6">
                        <label for="txtTemper">Temperatura Corporal (ºC)</label>
                        <input class="form-control" id="txtTemper" name="txtTemper" type="text" maxlength="6">
                    </div>
                </div>

                <!-- Descripción -->
                <div class="row">
                    <div class="form-group col-md-12">
                        <label for="txtProble">Descripción del Problema *</label>
                        <textarea class="form-control" id="txtProble" name="txtProble" rows="5" type="text" maxlength="250" required=""></textarea>
                    </div>
                </div>

                <!-- Diagnóstico Presuntivo -->
                <div class="row">
                    <div class="form-group col-md-12">
                        <label for="txtExplor">Diagnóstico Presuntivo *</label>
                        <textarea class="form-control" id="txtExplor" name="txtExplor" rows="5" type="text" maxlength="250" required=""></textarea>
                    </div>
                </div>

                <!-- Tratamiento -->
                <div class="row">
                    <div class="form-group col-md-12">
                        <label for="txtTratam">Tratamiento *</label>
                        <textarea class="form-control" id="txtTratam" name="txtTratam" rows="5" type="text" maxlength="250" required=""></textarea>
                    </div>
                </div>

                <!-- Recomendaciones -->
                <div class="row">
                    <div class="form-group col-md-12">
                        <label for="txtRemark">Recomendaciones *</label>
                        <textarea class="form-control" id="txtRemark" name="txtRemark" rows="5" type="text" maxlength="250" required=""></textarea>
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
