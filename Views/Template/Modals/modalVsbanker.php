<!-- Modal -->
<div class="modal fade" id="modalformVsbanker" name="modalFormVsbanker" tabindex="-1" role="dialog" data-keyboard="false" data-backdrop="static" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header headerRegister">
                <h5 class="modal-title" id="titleModal">Nuevo Banco</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            
            <div class="modal-body">
                <form id="formVsbanker" name="formVsbanker">
                <!-- boton oculto -->
                <input type="hidden" id="idBan_no" name="idBan_no" value="">
                <p class="text-primary">Campos con asterisco * son obligatorios</p>

                <!-- Nombre -->
                <div class="row">
                    <div class="form-group col-md-12">
                        <label for="txtBan_nm">Nombre Entidad *</label>
                        <input class="form-control" id="txtBan_nm" name="txtBan_nm" type="text" placeholder="*" maxlength="100" required="">
                    </div>
                </div>

                <!-- Número de Cuenta y Ultimo Cheque  -->
                <div class="row">
                    <div class="form-group col-md-6">
                        <label for="txtCtanum">Número de Cuenta Bancaria *</label>
                        <input class="form-control" id="txtCtanum" name="txtCtanum" type="number" maxlength="50" required="">
                    </div>
                    <div class="form-group col-md-6">
                        <label for="txtChe_no">Número de Ultimo Cheque</label>
                        <input class="form-control" id="txtChe_no" name="txtChe_no" type="number" min="0" value="0" maxlength="10">
                    </div>         
                </div>

                <!-- Ultima Conciliación -->
                <div class="row">
                    <div class="form-group col-md-6">
                        <label for="txtUltccl">Ultima Conciliación (AAAAMM)</label>
                        <input class="form-control" id="txtUltccl" name="txtUltccl" type="number" maxlength="6">
                    </div>
                </div>

                <!-- Cuenta Contable -->
                <div class="row">
                    <div class="form-group col-md-12">
                        <label for="listCta_no">Cuenta Contable *</label>
                        <select class="form-control" data-live-search="true" data-size="5" id="listCta_no" name="listCta_no" required="">
                        </select>
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
