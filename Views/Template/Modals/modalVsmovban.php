<!-- Modal -->
<div class="modal fade" id="modalformVsmovban" name="modalformVsmovban" tabindex="-1" role="dialog" data-keyboard="false" data-backdrop="static" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header headerRegister">
                <h5 class="modal-title" id="titleModal">Nueva Transacción</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            
            <div class="modal-body">
                <form id="formVsmovban" name="formVsmovban">
                <!-- boton oculto -->
                <input type="hidden" id="idSec_id" name="idSec_id" value=""> 
                <p class="text-primary">Campos con asterisco * son obligatorios</p>

                <!-- Tipo y Número de Diario -->
                <div class="row">
                    <div class="form-group col-md-6">
                        <label for="listMovtip">Tipo Comprobante *</label>
                        <select class="form-control selectpicker" id="listMovtip" name="listMovtip" required="">
                                <option value="" selected>Seleccione</option>
                                <option value="DE">Depósito Bancario</option>
                                <option value="CB">Nota de Crédito Bancario</option>
                                <option value="DB">Nota de Débito Bancario</option>
                                <option value="PC">Pago en Cheque</option>
                        </select>
                    </div>
                    <div class="form-group col-md-6">
                        <label for="txtMov_no">No. Comprobante</label>
                        <input class="form-control" id="txtMov_no" name="txtMov_no" type="number" onkeydown="return false">
                    </div>
                </div>

                <!-- Banco -->
                <div class="row">
                    <div class="form-group col-md-6">
                        <label for="listBan_n2">Entidad Financiera *</label>
                        <select class="form-control" onchange="fntDatBan();" data-live-search="true" data-size="5" id="listBan_n2" name="listBan_n2" required="">
                        </select>
                    </div>
                    <div class="form-group col-md-6">
                        <label for="listCta_no">Cuenta Contable Doble Partida *</label>
                        <select class="form-control" data-live-search="true" data-size="5" id="listCta_no" name="listCta_no" required="">
                        </select>
                    </div>
                </div>

                <div class="row">
                    <div class="form-group col-md-6">
                        <label for="txtDep_no">No. Referencia Bancaria</label>
                        <input class="form-control" id="txtDep_no" name="txtDep_no" type="number" maxlength="9">
                    </div>
                    <div class="form-group col-md-6">
                        <label for="txtChe_no">No. Cheque</label>
                        <input class="form-control" id="txtChe_no" name="txtChe_no" type="number" maxlength="9">
                    </div>
                </div>

                <!-- Fecha -->
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


<!-- Modal Transferencias -->
<div class="modal fade" id="modalformVsmovtrf" name="modalformVsmovtrf" tabindex="-1" role="dialog" data-keyboard="false" data-backdrop="static" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header headerRegister">
                <h5 class="modal-title" id="titleModal2">Nueva Transferencia</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            
            <div class="modal-body">
                <form id="formVsmovtrf" name="formVsmovtrf">
                <!-- boton oculto -->
                <input type="hidden" id="idSec_i2" name="idSec_i2" value=""> 
                <p class="text-primary">Campos con asterisco * son obligatorios</p>

                <!-- Tipo y Número de Diario -->
                <div class="row">
                    <div class="form-group col-md-6">
                    <label for="listMovtip">Tipo Comprobante *</label>
                        <select class="form-control selectpicker" id="listMovtip" name="listMovtip" required="">
                                <option value="TR">Transferencia Interbancaria</option>
                        </select>
                    </div>
                    <div class="form-group col-md-6">
                        <label for="txtMov_n2">No. Comprobante</label>
                        <input class="form-control" id="txtMov_n2" name="txtMov_n2" type="number" onkeydown="return false">
                    </div>
                </div>

                <!-- Banco -->
                <div class="row">
                    <div class="form-group col-md-6">
                        <label for="listBan_n3">Entidad Financiera Saliente *</label>
                        <select class="form-control" data-live-search="true" data-size="5" id="listBan_n3" name="listBan_n3" required="">
                        </select>
                    </div>
                    <div class="form-group col-md-6">
                        <label for="listBan_n4">Entidad Financiera Entrante *</label>
                        <select class="form-control" data-live-search="true" data-size="5" id="listBan_n4" name="listBan_n4" required="">
                        </select>
                    </div>
                </div>

                <!-- Fecha -->
                <div class="row">
                    <div class="form-group col-md-6">
                        <label for="txtDocval">Valor *</label>
                        <input class="form-control" id="txtDocval" name="txtDocval" type="number" step="0.01" min="0.01" value="0" required="">
                    </div>
                    <div class="form-group col-md-6">
                        <label for="datFecre2">Fecha Contable *</label>
                        <input class="form-control" id="datFecre2" name="datFecre2" type="date" required="">
                    </div>
                </div>

                <!-- Concepto -->
                <div class="row">
                    <div class="form-group col-md-12">
                        <label for="txtRemar2">Concepto *</label>
                        <textarea class="form-control" id="txtRemar2" name="txtRemar2" rows="2" type="text" maxlength="250" required=""></textarea>
                    </div>
                </div>

                <div class="modal-footer">
                    <button id="btnActionForm2" class="btn btn-success" type="submit"><i class="fa fa-fw fa-lg fa-check-circle"></i><span id="btnText2">Guardar</span></button>&nbsp;&nbsp;&nbsp;
                    <button class="btn btn-danger" type="button" data-dismiss="modal"><i class="fa fa-fw fa-lg fa-times-circle"></i>Cancelar</button>
                </div> 

                </form>
            </div>
        </div>
    </div>
</div>


<!-- Modal Informes Libro Banco -->
<div class="modal fade" id="modalformVsrepban" name="modalformVsrepban" tabindex="-1" role="dialog" data-keyboard="false" data-backdrop="static" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header headerRegister">
                <h5 class="modal-title" id="titleModal">Informes Bancarios</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            
            <div class="modal-body">
                <form id="formVsrepban" name="formVsrepban">  
                <p class="text-primary">Campos con asterisco * son obligatorios</p>
                
                <!-- Banco -->
                <div class="row">
                    <div class="form-group col-md-12">
                        <label for="listBan_n5">Entidad Financiera</label>
                        <select class="form-control" data-live-search="true" data-size="5" id="listBan_n5" name="listBan_n5">
                        </select>
                    </div>
                </div>

                <!-- Tipo informe -->
                <div class="row">
                    <div class="form-group col-md-6">
                        <label for="listReptyp">Tipo Informe *</label>
                        <select class="form-control selectpicker" data-size="5" id="listReptyp" name="listReptyp" required="">
                                <option value="" selected>Seleccione</option>
                                <option value="1">Saldo Bancos al Corte</option>
                                <option value="2">Estado de Cuenta Banco</option>
                        </select>
                    </div>
                    <div class="form-group col-md-6">
                        <label for="listAbotyp">Tipo de Corte *</label>
                        <select class="form-control selectpicker" id="listAbotyp" name="listAbotyp" required="">
                                <option value="1">Acumulado</option>
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
                        <label for="datFechas">Fecha Corte *</label>
                        <input class="form-control" id="datFechas" name="datFechas" type="date" required="">
                    </div>
                </div>

                <div class="modal-footer">
                    <button id="btnActionForm" class="btn btn-success" type="submit"><i class="fa fa-fw fa-lg fa-check-circle"></i>Aceptar</button>&nbsp;&nbsp;&nbsp;
                    <button class="btn btn-danger" type="button" data-dismiss="modal"><i class="fa fa-fw fa-lg fa-times-circle"></i>Cancelar</button>
                </div> 

                </form>
            </div>
        </div>
    </div>
</div>


<!-- Modal para Balances -->
<div class="modal fade" id="modvsBanPrn" name="modvsBanPrn" tabindex="-1" role="dialog" data-keyboard="false" data-backdrop="static" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header headerRegister">
                <h5 class="modal-title" id="titleModal">Informes Bancarios</h5>
            </div>
            
            <div class="modal-body">
            </div>

        </div>
    </div>
</div>
