<!-- Modal -->
<div class="modal fade" id="modalformVstables" name="modalFormVstables" tabindex="-1" role="dialog" data-keyboard="false" data-backdrop="static" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header headerRegister">
                <h5 class="modal-title" id="titleModal">Nuevo Tabla</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            
            <div class="modal-body">
                
                <form id="formVstables" name="formVstables">
                <p class="text-primary">Campos con asterisco * son obligatorios</p>
                <!-- boton oculto -->
                <input type="hidden" id="idSec_id" name="idSec_id" value="">

                <!-- Estatus -->
                <div class="row">
                    <div class="form-group col-md-12">
                        <label for="listStatus">Estado *</label>
                        <select class="form-control selectpicker" id="listStatus" name="listStatus" required="">
                                <option value="1">Activo</option>
                                <option value="0">Inactivo</option>
                        </select>
                    </div>
                </div>

                <!-- Cabecera de Tabla -->
                <div class="row">
                    <div class="form-group col-md-12">
                        <label for="listTab_no">Tabla *</label>
                        <select class="form-control" data-live-search="true" data-size="5" id="listTab_no" name="listTab_no" required="">
                        </select>
                    </div>
                </div>

                <!-- Código y Valor de Tabla -->
                <div class="row">
                    <div class="form-group col-md-6">
                        <label for="txtSub_no">Código *</label>
                        <input class="form-control" id="txtSub_no" name="txtSub_no" type="text" maxlength="6" required="">
                    </div>
                    <div class="form-group col-md-6">
                        <label for="listProces">Tipo de Proceso</label>
                        <select class="form-control selectpicker" id="listProces" name="listProces">
                            <option value="0"selected>Seleccione</option>
                            <option value="1">Sumativo</option>
                            <option value="2">Promedial</option>
                        </select>
                    </div>
                </div>

                <!-- Parametros -->
                <div class="row">
                    <div class="form-group col-md-6">
                        <label for="listValors">Parámetro Mínimo</label>
                        <input class="form-control" id="listValors" name="listValors" type="number" step="0.01" value="0" min="0" required="">
                    </div>
                    <div class="form-group col-md-6">
                        <label for="listValor2">Parámetro Máximo</label>
                        <input class="form-control" id="listValor2" name="listValor2" type="number" step="0.01" value="0" min="0" required="">
                    </div>
                </div>

                <div class="row">
                    <div class="form-group col-md-12">
                        <label for="txtSub_nm">Nombre *</label>
                        <input class="form-control" id="txtSub_nm" name="txtSub_nm" type="text" maxlength="110" required="">
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
