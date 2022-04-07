<!-- Modal -->
<div class="modal fade" id="modalformVsatssri" name="modalFormVsatssri" tabindex="-1" role="dialog" data-keyboard="false" data-backdrop="static" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header headerRegister">
                <h5 class="modal-title" id="titleModal">Nuevo Anexo Transaccional</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            
            <div class="modal-body">
                <form id="formVsatssri" name="formVsatssri">
                <!-- boton oculto -->
                <input type="hidden" id="idSec_id" name="idSec_id" value="">
                 
                <p class="text-primary">Campos con asterisco * son obligatorios</p>

                <!-- Fechas -->
                <div class="row">
                    <div class="form-group col-md-6">
                        <label for="datFecdes">Fecha Inicial *</label>
                        <input class="form-control" id="datFecdes" name="datFecdes" type="date" required="">
                    </div>
                    <div class="form-group col-md-6">
                        <label for="datFechas">Fecha Final *</label>
                        <input class="form-control" id="datFechas" name="datFechas" type="date" required="">
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
