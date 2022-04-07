<!-- Modal -->
<div class="modal fade" id="modalformVsstdhis" name="modalFormVsstdhis" tabindex="-1" role="dialog" data-keyboard="false" data-backdrop="static" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header headerRegister">
                <h5 class="modal-title" id="titleModal">Nuevo Registro</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            
            <div class="modal-body">
                <form id="formVsstdhis" name="formVsstdhis">
                <!-- boton oculto -->
                <input type="hidden" id="idSec_id" name="idSec_id" value="">

                <p class="text-primary">Campos con asterisco * son obligatorios</p>

                <!-- Año y Fecha -->
                <div class="row">
                    <div class="form-group col-md-6">
                        <label for="listPerios">Año Lectivo *</label>
                        <input class="form-control" id="listPerios" name="listPerios" type="number" min="0" max="9999" required="">
            		</div>
                    <div class="form-group col-md-6">
                        <label for="datFecreg">Fecha *</label>
                        <input class="form-control" id="datFecreg" name="datFecreg" type="date" required="">
                    </div>
           		</div>

                <!-- Estudiante -->
                <div class="row">
                    <div class="form-group col-md-12">
                        <label for="listStd_no">Estudiante *</label>
                        <select class="form-control" data-live-search="true" id="listStd_no" name="listStd_no" required="">
                        </select>
                    </div>
                </div>

                <!-- Valor -->
                <div class="row">
                    <div class="form-group col-md-12">
                        <label for="txtRetain">Valor</label>
                        <input class="form-control" id="txtRetain" name="txtRetain" type="number" min="0" step="0.01" value="0">
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
