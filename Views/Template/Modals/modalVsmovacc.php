<!-- Modal -->
<div class="modal fade" id="modalformVsmovacc" name="modalformVsmovacc" tabindex="-1" role="dialog" data-keyboard="false" data-backdrop="static" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header headerRegister">
                <h5 class="modal-title" id="titleModal">Nuevo Diario Contable</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            
            <div class="modal-body">
                <form id="formVsmovacc" name="formVsmovacc">
                <!-- boton oculto -->
                <input type="hidden" id="idSec_id" name="idSec_id" value="">                 
                <p class="text-primary">Campos con asterisco * son obligatorios</p>

                <!-- Diario -->
                <div class="row">
                    <div class="form-group col-md-6">
                        <label for="listTab_no">Tipo Diario *</label>
                        <select class="form-control" data-live-search="true" data-size="5" id="listTab_no" name="listTab_no" required="">
                        </select>
                    </div>
                    <div class="form-group col-md-6">
                        <label for="txtMovpto">Punto Emisión Diario</label>
                        <input class="form-control" id="txtMovpto" name="txtMovpto" type="text" maxlength="6" onkeydown="return false">
                    </div>
                </div>

                <div class="row">
                    <div class="form-group col-md-6">
                        <label for="txtMov_no">No. Diario</label>
                        <input class="form-control" id="txtMov_no" name="txtMov_no" type="number" onkeydown="return false">
                    </div>
                    <div class="form-group col-md-6">
                        <label for="listCta_no">Cuenta Contable *</label>
                        <select class="form-control" data-live-search="true" data-size="5" id="listCta_no" name="listCta_no" required="">
                        </select>
                    </div>
                </div>

                <!-- Valor -->
                <div class="row">
                    <div class="form-group col-md-6">
                        <label for="txtValors">Valor *</label>
                        <input class="form-control" id="txtValors" name="txtValors" type="number" step="0.01" min="0.01" value="0" required="">
                    </div>
                    <div class="form-group col-md-6">
                        <label for="datFecreg">Fecha Contable *</label>
                        <input class="form-control" id="datFecreg" name="datFecreg" type="date" required="">
                    </div>
                </div>

                <!-- Concepto -->
                <div class="row">
                    <div class="form-group col-md-12">
                        <label for="txtRemark">Concepto *</label>
                        <textarea class="form-control" id="txtRemark" name="txtRemark" rows="2" type="text" maxlength="250" required=""></textarea>
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


<!-- Modal Informes Contables -->
<div class="modal fade" id="modalformVsrepacc" name="modalformVsrepacc" tabindex="-1" role="dialog" data-keyboard="false" data-backdrop="static" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header headerRegister">
                <h5 class="modal-title" id="titleModal">Informes Contables</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            
            <div class="modal-body">
                <form id="formVsrepacc" name="formVsrepacc">  
                <p class="text-primary">Campos con asterisco * son obligatorios</p>
                
                <!-- Cuenta -->
                <div class="row">
                    <div class="form-group col-md-12">
                        <label for="listAnt_no">Cuenta Contable</label>
                        <select class="form-control" data-live-search="true" data-size="5" id="listAnt_no" name="listAnt_no">
                        </select>
                    </div>
                </div>

                <!-- Tipo informe -->
                <div class="row">
                    <div class="form-group col-md-6">
                        <label for="listReptyp">Tipo Informe *</label>
                        <select class="form-control selectpicker" data-size="5" id="listReptyp" name="listReptyp" required="">
                                <option value="" selected>Seleccione</option>
                                <option value="1">Diario General</option>
                                <option value="2">Mayor</option>
                                <option value="3">Balance Comprobación</option>
                                <option value="4">Estado de Situación Financiera</option>
                                <option value="5">Estado de Resultado</option>
                        </select>
                    </div>
                    <div class="form-group col-md-6">
                        <label for="listAbotyp">Tipo de Corte *</label>
                        <select class="form-control selectpicker" id="listAbotyp" name="listAbotyp" required="">
                                <option value="1">Acumulado</option>
                                <option value="2">Corriente</option>
                        </select>
                    </div>
                </div>

                <!-- Fechas -->
                 <div class="row">
                    <div class="form-group col-md-6">
                        <label for="datFecdes">Fecha Desde *</label>
                        <input class="form-control" id="datFecdes" name="datFecdes" type="date" required="">
                    </div>
                    <div class="form-group col-md-6">
                        <label for="datFechas">Fecha Hasta *</label>
                        <input class="form-control" id="datFechas" name="datFechas" type="date" required="">
                    </div>
                </div>

                <div class="modal-footer">
                    <button id="btnPrnStdCxc" class="btn btn-success" type="submit"><i class="fa fa-fw fa-lg fa-check-circle"></i>Aceptar</button>&nbsp;&nbsp;&nbsp;
                    <button class="btn btn-danger" type="button" data-dismiss="modal"><i class="fa fa-fw fa-lg fa-times-circle"></i>Cancelar</button>
                </div> 

                </form>
            </div>
        </div>
    </div>
</div>


<!-- Modal para Balances -->
<div class="modal fade" id="modvsAccPrn" name="modvsAccPrn" tabindex="-1" role="dialog" data-keyboard="false" data-backdrop="static" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header headerRegister">
                <h5 class="modal-title" id="titleModal">Informes Contabilidad</h5>
            </div>
            
            <div class="modal-body">
            </div>

        </div>
    </div>
</div>
