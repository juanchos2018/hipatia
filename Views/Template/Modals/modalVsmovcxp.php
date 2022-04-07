<!-- Modal -->
<div class="modal fade" id="modalformVsmovcxp" name="modalformVsmovcxp" tabindex="-1" role="dialog" data-keyboard="false" data-backdrop="static" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered modal-lg" role="document">
        <div id="divLoading">
            <div>
                <img src="<?= media(); ?>images/ajax-loader.gif" alt="Loading">
            </div>
        </div>
        <div class="modal-content">
            <div class="modal-header headerRegister">
                <h5 class="modal-title" id="titleModal">Nueva Provisión Cuenta por Pagar</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            
            <div class="modal-body">
                <form id="formVsmovcxp" name="formVsmovcxp">
                <!-- boton oculto -->
                <input type="hidden" id="idSec_id"   name="idSec_id" value="">                 
                <p class="text-primary">Campos con asterisco * son obligatorios</p>

                <p class="text-info mb-0">DOCUMENTO</p>
                <hr class="mt-0">

                <!-- Documento -->
                <div class="row">
                    <div class="form-group col-md-6">
                        <label for="listMovtip">Tipo Comprobante *</label>
                        <select class="form-control" data-size="5" id="listMovtip" name="listMovtip" required="">
                                <option value="PF">Provisión Factura Proveedor</option>
                        </select>
                    </div>
                    <div class="form-group col-md-6">
                        <label for="txtMov_no">No. Comprobante</label>
                        <input class="form-control" id="txtMov_no" name="txtMov_no" type="number" onkeydown="return false">
                    </div>
                </div>

                <!-- Fecha -->
                <div class="row">
                    <div class="form-group col-md-6">
                        <label for="txtSustri">Sustento Tributario *</label>
                        <input class="form-control selectpicker" id="txtSustri" name="txtSustri" type="text" value="01" maxlength="2" required="">
                    </div>
                    <div class="form-group col-md-6">
                        <label for="datFecreg">Fecha Contable *</label>
                        <input class="form-control" id="datFecreg" name="datFecreg" type="date" required="">
                    </div>
                </div>

                <p class="text-info mb-0">DATOS PROVEEDOR</p>
                <hr class="mt-0">

                <!-- Proveedor -->
                <div class="row">
                    <div class="form-group col-md-12">
                        <label for="listPrv_no">Razón Social - Ruc Proveedor *</label>
                        <select class="form-control" onchange="fntDatPrv();" data-live-search="true" data-size="5" id="listPrv_no" name="listPrv_no" required="">
                        </select>
                    </div>
                </div>

                <!-- Cuenta Contable -->
                <div class="row">
                    <div class="form-group col-md-6">
                        <label for="listCta_no">Cuenta Contable por Pagar *</label>
                        <select class="form-control" data-live-search="true" data-size="5" id="listCta_no" name="listCta_no" required="">
                        </select>
                    </div>
                    <div class="form-group col-md-6">
                        <label for="listAnt_no">Cuenta Contable Gasto *</label>
                        <select class="form-control" data-live-search="true" data-size="5" id="listAnt_no" name="listAnt_no" required="">
                        </select>
                    </div>
                </div>

                <br>
                <p class="text-info mb-0">DOCUMENTO APLICADO</p>
                <hr class="mt-0">

                <!-- Documento Aplicado -->
                <div class="row">
                    <div class="form-group col-md-4">
                        <label for="listDocapl">Tipo Documento Aplicado *</label>
                        <select class="form-control" data-size="5" id="listDocapl" name="listDocapl" required="">
                                <option value="" selected>Seleccione</option>
                                <option value="01">Factura</option>
                                <option value="02">Nota de Venta</option>
                                <option value="03">Liquidación de Compra</option>
                                <option value="08">Boletas de Espectáculos</option>
                                <option value="09">Tickets máquinas registradoras</option>
                                <option value="10">Comprobante Venta autorizado en Art. 13</option>
                                <option value="11">Pasajes emitidos por Empresas Aviación</option>                               
                                <option value="12">Documentos emitidos por instituciones Financieras</option>
                                <option value="13">Documdentos emitidos por Compañias de Seguros</option>
                        </select>
                    </div>
                    <div class="form-group col-md-4">
                        <label for="txtDocpto">Punto Emisión Documento Aplicado</label>
                        <input class="form-control" id="txtDocpto" name="txtDocpto" type="text" maxlength="6">
                    </div>
                    <div class="form-group col-md-4">
                        <label for="txtDocnum">No. Documento Aplicado</label>
                        <input class="form-control" id="txtDocnum" name="txtDocnum" type="text" maxlength="9">
                    </div>
                </div>

                <!-- Fechas -->
                <div class="row">
                    <div class="form-group col-md-4">
                        <label for="datFecemi">Fecha Emisión Documento Aplicado *</label>
                        <input class="form-control" id="datFecemi" name="datFecemi" type="date" required="">
                    </div>
                    <div class="form-group col-md-8">
                        <label for="txtDocaut">No. Autotización Documento Aplicado</label>
                        <input class="form-control" id="txtDocaut" name="txtDocaut" type="text" maxlength="50">
                    </div>
                </div>

                <!-- Concepto -->
                <div class="row">
                    <div class="form-group col-md-12">
                        <label for="txtRemark">Concepto de Compra *</label>
                        <textarea class="form-control" id="txtRemark" name="txtRemark" rows="2" type="text" maxlength="250" required=""></textarea>
                    </div>
                </div>

                <br>
                <p class="text-info mb-0">BASES IMPONIBLES</p>
                <hr class="mt-0">

                <!-- Bases Imponibles -->
                <div class="row">
                    <div class="form-group col-md-6">
                        <label for="txtBasiva">Base Imponible Grava I.V.A.</label>
                        <input class="form-control" onchange="fntDatRet();" id="txtBasiva" name="txtBasiva" type="number" step="0.01" min="0" value="0">
                    </div>
                    <div class="form-group col-md-6">
                        <label for="txtMoniva">I.V.A.</label>
                        <input class="form-control" id="txtMoniva" name="txtMoniva" type="number" step="0.01" min="0" value="0" onkeydown="return false">
                    </div>
                </div>
                <div class="row">
                    <div class="form-group col-md-6">
                        <label for="txtBasiv0">Base Imponible 0%</label>
                        <input class="form-control" onchange="fntDatRet();" id="txtBasiv0" name="txtBasiv0" type="number" step="0.01" min="0" value="0">
                    </div>
                    <div class="form-group col-md-6">
                        <label for="txtBasniv">Base no Grava I.V.A.</label>
                        <input class="form-control" onchange="fntDatRet();" id="txtBasniv" name="txtBasniv" type="number" step="0.01" min="0" value="0">
                    </div>
                </div>

                <br>
                <p class="text-info mb-0">RETENCIONES</p>
                <hr class="mt-0">

                <!-- Retenciones Fuente -->
                <div class="row">
                    <div class="form-group col-md-8">
                        <label for="listReb_no">Retención Fuente Bienes</label>
                        <select class="form-control" onchange="fntDatRet();" data-live-search="true" data-size="5" id="listReb_no" name="listReb_no">
                        </select>
                    </div>
                    <div class="form-group col-md-4">
                        <label for="txtMonrf1">Valor Retención Fuente Bienes</label>
                        <input class="form-control" id="txtMonrf1" name="txtMonrf1" type="number" step="0.01" min="0" value="0" onkeydown="return false">
                    </div>
                </div>
                <div class="row">
                    <div class="form-group col-md-8">
                        <label for="listRes_no">Retención Fuente Servicios</label>
                        <select class="form-control" onchange="fntDatRet();" data-live-search="true" data-size="5" id="listRes_no" name="listRes_no">
                        </select>
                    </div>
                    <div class="form-group col-md-4">
                        <label for="txtMonrf2">Valor Retención Fuente Servicios</label>
                        <input class="form-control" id="txtMonrf2" name="txtMonrf2" type="number" step="0.01" min="0" value="0" onkeydown="return false">
                    </div>
                </div>

                <!-- Retenciones IVA -->
                <div class="row">
                    <div class="form-group col-md-8">
                        <label for="listRib_no">Retención I.V.A. Bienes</label>
                        <select class="form-control" onchange="fntDatRet();" data-live-search="true" data-size="5" id="listRib_no" name="listRib_no">
                        </select>
                    </div>
                    <div class="form-group col-md-4">
                        <label for="txtMonri1">Valor Retención I.V.A. Bienes</label>
                        <input class="form-control" id="txtMonri1" name="txtMonri1" type="number" step="0.01" min="0" value="0" onkeydown="return false">
                    </div>
                </div>
                <div class="row">
                    <div class="form-group col-md-8">
                        <label for="listRis_no">Retención I.V.A. Servicios</label>
                        <select class="form-control" onchange="fntDatRet();" data-live-search="true" data-size="5" id="listRis_no" name="listRis_no">
                        </select>
                    </div>
                    <div class="form-group col-md-4">
                        <label for="txtMonri2">Valor Retención I.V.A. Servicios</label>
                        <input class="form-control" id="txtMonri2" name="txtMonri2" type="number" step="0.01" min="0" value="0" onkeydown="return false">
                    </div>
                </div>

                <div class="row">
                    <div class="form-group col-md-4">
                        <label for="txtRetpto">Punto Emisión Retención</label>
                        <input class="form-control" id="txtRetpto" name="txtRetpto" type="text" maxlength="6" onkeydown="return false">
                    </div>
                    <div class="form-group col-md-4">
                        <label for="txtRetnum">No. Retención</label>
                        <input class="form-control" id="txtRetnum" name="txtRetnum" type="number" value="0" onkeydown="return false">
                    </div>
                    <div class="form-group col-md-4">
                        <label for="txtRetaut">No. Autotización Retención</label>
                        <input class="form-control" id="txtRetaut" name="txtRetaut" type="text" maxlength="50">
                    </div>
                </div>
                <div class="row">
                    <div class="form-group col-md-6">
                        <label for="txtValdes">Valor Retención Asumida</label>
                        <input class="form-control" id="txtValdes" name="txtValdes" type="number" step="0.01" min="0" value="0">
                    </div>
                    <div class="form-group col-md-6">
                        <label for="txtValors">Valor Giro *</label>
                        <input class="form-control" id="txtValors" name="txtValors" type="number" step="0.01" min="0" value="0" onkeydown="return false">
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


<!-- Modal Nota de Credito / Nota de Débito Proveedor -->
<div class="modal fade" id="modalformVsmovcrp" name="modalformVsmovcrp" tabindex="-1" role="dialog" data-keyboard="false" data-backdrop="static" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered modal-lg" role="document">
        <div id="divLoading">
            <div>
                <img src="<?= media(); ?>images/ajax-loader.gif" alt="Loading">
            </div>
        </div>
        <div class="modal-content">
            <div class="modal-header headerRegister">
                <h5 class="modal-title" id="titleModal2">Nueva Nota de Crédito / Débito Proveedor</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            
            <div class="modal-body">
                <form id="formVsmovcrp" name="formVsmovcrp">
                <!-- boton oculto -->
                <input type="hidden" id="idSec_i2" name="idSec_i2" value="">                 
                <p class="text-primary">Campos con asterisco * son obligatorios</p>

                <!-- Documento -->
                <div class="row">
                    <div class="form-group col-md-6">
                        <label for="listMovti2">Tipo Comprobante *</label>
                        <select class="form-control" onchange="fntDatMov();" data-size="5" id="listMovti2" name="listMovti2" required="">
                                <option value="" selected>Seleccione</option>
                                <option value="CP">Nota de Crédito Proveedor</option>
                                <option value="DP">Nota de Débito Proveedor</option>
                        </select>
                    </div>
                    <div class="form-group col-md-6">
                        <label for="txtMov_n2">No. Comprobante</label>
                        <input class="form-control" id="txtMov_n2" name="txtMov_n2" type="number" onkeydown="return false">
                    </div>
                </div>

                <!-- Provisión aplicada -->
                <div class="row">
                    <div class="form-group col-md-6">
                        <label for="listMovapl">Tipo Documento Aplicado *</label>
                        <select class="form-control" data-size="5" id="listMovapl" name="listMovapl" required="">
                                <option value="" selected>Seleccione</option>
                                <option value="DP">Nota de Débito Proveedor</option>
                                <option value="PF">Provisión Factura Proveedor</option>
                        </select>
                    </div>
                    <div class="form-group col-md-6">
                        <label for="txtFap_no">No. Documento Aplicado</label><br>
                        <input class="form-control" onchange="fntDatCrp();" id="txtFap_no" name="txtFap_no" type="number">
                    </div>
                </div>

                <!-- Proveedor -->
                <div class="row">
                    <div class="form-group col-md-6">
                        <label for="listPrv_n2">Razón Social - Ruc Proveedor *</label>
                        <select class="form-control" data-live-search="true" data-size="5" id="listPrv_n2" name="listPrv_n2" required="">
                        </select>
                    </div>
                    <div class="form-group col-md-6">
                        <label for="listCdp_no">Cuenta Contable Doble Partida *</label>
                        <select class="form-control" data-live-search="true" data-size="5" id="listCdp_no" name="listCdp_no" required="">
                        </select>
                    </div>
                </div>

                <!-- Valor -->
                <div class="row">
                    <div class="form-group col-md-6">
                        <label for="txtDocva2">Valor *</label>
                        <input class="form-control" id="txtDocva2" name="txtDocva2" type="number" step="0.01" min="0.01" value="0" required="">
                    </div>
                    <div class="form-group col-md-6">
                        <label for="datFecre2">Fecha Contable *</label>
                        <input class="form-control" onload="getDate()" id="datFecre2" name="datFecre2" type="date" required="">
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


<!-- Modal Pago a Proveedor -->
<div class="modal fade" id="modalformVsmovpay" name="modalformVsmovpay" tabindex="-1" role="dialog" data-keyboard="false" data-backdrop="static" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered modal-lg" role="document">
        <div id="divLoading">
            <div>
                <img src="<?= media(); ?>images/ajax-loader.gif" alt="Loading">
            </div>
        </div>
        <div class="modal-content">
            <div class="modal-header headerRegister">
                <h5 class="modal-title" id="titleModal3">Nuevo Pago a Proveedor</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            
            <div class="modal-body">
                <form id="formVsmovpay" name="formVsmovpay">
                <!-- boton oculto -->
                <input type="hidden" id="idSec_i3" name="idSec_i3" value="">                 
                <p class="text-primary">Campos con asterisco * son obligatorios</p>

                <!-- Documento -->
                <div class="row">
                    <div class="form-group col-md-4">
                        <label for="listMovti3">Tipo Comprobante *</label>
                        <select class="form-control" data-size="5" id="listMovti3" name="listMovti3" required="">
                                <option value="" selected>Seleccione</option>
                                <option value="PC">Pago en Cheque</option>
                                <option value="PD">Pago en Débito Bancario</option>
                                <option value="PE">Pago en Efectivo</option>
                        </select>
                    </div>
                    <div class="form-group col-md-4">
                        <label for="listAdvanc">Anticipo Sin Factura *</label>
                        <select class="form-control" data-live-search="true" data-size="5" id="listAdvanc" name="listAdvanc" required="">
                                <option value="" selected>Seleccione</option>
                                <option value="1">Si</option>
                                <option value="2">No</option>
                        </select>
                    </div>
                    <div class="form-group col-md-4">
                        <label for="txtMov_n3">No. Comprobante</label>
                        <input class="form-control" id="txtMov_n3" name="txtMov_n3" type="number" onkeydown="return false">
                    </div>
                </div>

                <!-- Proveedor -->
                <div class="row">
                    <div class="form-group col-md-12">
                        <label for="listPrv_n3">Razón Social - Ruc Proveedor *</label>
                        <select class="form-control" onchange="fntDatPen();" data-live-search="true" data-size="5" id="listPrv_n3" name="listPrv_n3" required="">
                        </select>
                    </div>
                </div>
                <div class="row">
                    <div class="form-group col-md-6">
                        <label for="listGas_no">Cuenta Contable Doble Partida *</label>
                        <select class="form-control" data-live-search="true" data-size="5" id="listGas_no" name="listGas_no" required="">
                        </select>
                    </div>
                    <div class="form-group col-md-6">
                        <label for="txtBenefi">Beneficiario *</label>
                        <input class="form-control" id="txtBenefi" name="txtBenefi" type="text" maxlength="100" required="">
                    </div>
                </div>

                <!-- Banco -->
                <div class="row">
                    <div class="form-group col-md-6">
                        <label for="listBan_n2">Entidad Financiera *</label>
                        <select class="form-control" onchange="fntDatBa2();" data-live-search="true" data-size="5" id="listBan_n2" name="listBan_n2" required="">
                        </select>
                    </div>
                    <div class="form-group col-md-6">
                        <label for="txtChe_no">No. Cheque *</label>
                        <input class="form-control" id="txtChe_no" name="txtChe_no" type="number" required="">
                    </div>
                </div>

                <!-- Provisión aplicada -->
                <div class="row">
                    <div class="form-group col-md-10">
                        <label for="listFap_no">No. Facturas Aplicadas *</label>
                        <input id="listFapnum" name="listFap_no[]" type="hidden" value="0">
                        <select class="form-control" onchange="fntDatVal();" data-live-search="true" data-size="5" id="listFap_no" name="listFap_no[]" title="Escoger Facturas Pendientes" multiple="">
                        </select>
                    </div>
                    <div class="form-group col-md-2">
                        <label for="txtFap_no">Saldar Factura No.</label>
                        <input class="form-control" id="txtFap_no" name="txtFap_no" type="number" min="0" max="999999999" value="0">
                    </div>
                </div>
 
                <!-- Fecha -->
                <div class="row">
                    <div class="form-group col-md-6">
                        <label for="txtDocva3">Valor *</label>
                        <input class="form-control" id="txtDocva3" name="txtDocva3" type="number" step="0.01" min="0.01" value="0" required="">
                    </div>
                    <div class="form-group col-md-6">
                        <label for="datFecre3">Fecha Contable *</label>
                        <input class="form-control" id="datFecre3" name="datFecre3" type="date" required="">
                    </div>
                </div>

                <div class="row">
                    <div class="form-group col-md-12">
                        <label for="txtRemar3">Concepto *</label>
                        <textarea class="form-control" id="txtRemar3" name="txtRemar3" rows="2" type="text" maxlength="250" required=""></textarea>
                    </div>
                </div>

                <div class="modal-footer">
                    <button id="btnActionForm3" class="btn btn-success" type="submit"><i class="fa fa-fw fa-lg fa-check-circle"></i><span id="btnText3">Guardar</span></button>&nbsp;&nbsp;&nbsp;
                    <button class="btn btn-danger" type="button" data-dismiss="modal"><i class="fa fa-fw fa-lg fa-times-circle"></i>Cancelar</button>
                </div> 

                </form>
            </div>
        </div>
    </div>
</div>


<!-- Modal Informes Compras -->
<div class="modal fade" id="modalformVsrepcxp" name="modalformVsrepcxp" tabindex="-1" role="dialog" data-keyboard="false" data-backdrop="static" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header headerRegister">
                <h5 class="modal-title" id="titleModal">Informe Cuenta por Pagar</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            
            <div class="modal-body">
                <form id="formVsrepcxp" name="formVsrepcxp">  
                <p class="text-primary">Campos con asterisco * son obligatorios</p>
                
                <!-- Proveedor -->
                <div class="row">
                    <div class="form-group col-md-12">
                        <label for="listPrv_n4">Proveedor</label>
                        <select class="form-control" data-live-search="true" data-size="5" id="listPrv_n4" name="listPrv_n4">
                        </select>
                    </div>
                </div>

                <!-- Tipo informe -->
                <div class="row">
                    <div class="form-group col-md-6">
                        <label for="listReptyp">Tipo Informe *</label>
                        <select class="form-control selectpicker" data-size="5" id="listReptyp" name="listReptyp" required="">
                                <option value="" selected>Seleccione</option>
                                <option value="1">Saldo Proveedores al Corte</option>
                                <option value="2">Estado de Cuenta Proveedor</option>
                                <option value="3">Retenciones a la Fuente</option>
                                <option value="4">Retenciones al I.V.A.</option>
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
                    <button id="btnPrnStdCxc" class="btn btn-success" type="submit"><i class="fa fa-fw fa-lg fa-check-circle"></i>Aceptar</button>&nbsp;&nbsp;&nbsp;
                    <button class="btn btn-danger" type="button" data-dismiss="modal"><i class="fa fa-fw fa-lg fa-times-circle"></i>Cancelar</button>
                </div> 

                </form>
            </div>
        </div>
    </div>
</div>


<!-- Modal para Informes -->
<div class="modal fade" id="modvsCxpPrn" name="modvsCxpPrn" tabindex="-1" role="dialog" data-keyboard="false" data-backdrop="static" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header headerRegister">
                <h5 class="modal-title" id="titleModal">Informes Compras</h5>
            </div>
            
            <div class="modal-body">
            </div>

        </div>
    </div>
</div>
