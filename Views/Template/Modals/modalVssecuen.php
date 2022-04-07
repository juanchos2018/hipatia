<!-- Modal -->
<div class="modal fade" id="modalformVssecuen" name="modalFormVssecuen" tabindex="-1" role="dialog" data-keyboard="false" data-backdrop="static" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header headerRegister">
                <h5 class="modal-title" id="titleModal">Nuevo Parámetro</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            
            <div class="modal-body">
                <form id="formVssecuen" name="formVssecuen">
                <p class="text-primary">Campos con asterisco * son obligatorios</p>
                <!-- boton oculto -->
                <input type="hidden" id="idSec_id" name="idSec_id" value="">

                <!-- Cabecera de Tabla -->
                <div class="row">
                    <div class="form-group col-md-12">
                        <label for="listTab_no">Tipo Parámetro *</label>
                        <select class="form-control" data-live-search="true" data-size="5" id="listTab_no" name="listTab_no" required="">
                        </select>
                    </div>
                </div>

                <!-- Punto Emisión y Secuencial -->
                <div class="row">
                    <div class="form-group col-md-4">
                        <label for="txtPto_no">Punto Emisión</label>
                        <input class="form-control" id="txtPto_no" name="txtPto_no" type="text" maxlength="6">
                    </div>
                    <div class="form-group col-md-4">
                        <label for="txtMov_no">Ultimo Secuencial</label>
                        <input class="form-control" id="txtMov_no" name="txtMov_no" type="number" min="0" value="0">
                    </div>
                    <div class="form-group col-md-4">
                        <label for="txtPar_no">No. Parámetro</label>
                        <input class="form-control" id="txtPar_no" name="txtPar_no" type="number" step="0.01" min="0" value="0">
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
