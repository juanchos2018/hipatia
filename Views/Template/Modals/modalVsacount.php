<!-- Modal -->
<div class="modal fade" id="modalformVsacount" name="modalFormVsacount" tabindex="-1" role="dialog" data-keyboard="false" data-backdrop="static" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header headerRegister">
                <h5 class="modal-title" id="titleModal">Nueva Cuenta</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            
            <div class="modal-body">
                <form id="formVsacount" name="formVsacount">
                <!-- boton oculto -->
                <input type="hidden" id="idSec_id" name="idSec_id" value="">
                <p class="text-primary">Campos con asterisco * son obligatorios</p>


                <!-- Código -->
                <div class="row">
                    <div class="form-group col-md-12">
                        <label for="txtCta_no">Código Cuenta *</label>
                        <input class="form-control" id="txtCta_no" name="txtCta_no" type="text" maxlength="25" pattern="[0123456789-.]" required="">
                    </div>
                </div>

                <!-- Nombre -->
                <div class="row">
                    <div class="form-group col-md-12">
                        <label for="txtCta_nm">Nombre Cuenta *</label>
                        <input class="form-control" id="txtCta_nm" name="txtCta_nm" type="text" placeholder="*" maxlength="100" required="">
                    </div>
                </div>

                <!-- Tipo de Cuenta y Signo -->
                <div class="row">
                    <div class="form-group col-md-6">
                        <label for="listCtatip">Tipo *</label>
                        <select class="form-control selectpicker" id="listCtatip" name="listCtatip" required="*">
                                <option value="" selected>Seleccione</option>
                                <option value="1">Mayor</option>
                                <option value="2">Auxiliar</option>
                        </select>
                    </div>
                    <div class="form-group col-md-6">
                        <label for="listSignos">Naturaleza *</label>
                        <select class="form-control selectpicker" id="listSignos" name="listSignos" required="*">
                                <option value="" selected>Seleccione</option>
                                <option value="1">Deudora</option>
                                <option value="-1">Acreedora</option>
                        </select>
                    </div>
                </div>

                <!-- Cuenta Contable Superior -->
                <div class="row">
                    <div class="form-group col-md-12">
                        <label for="listCta_no">Cuenta Contable Superior</label>
                        <select class="form-control" data-live-search="true" data-size="5" id="listCta_no" name="listCta_no">
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
