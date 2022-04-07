<!-- Modal -->
<div class="modal fade" id="modalformVsctatip" name="modalFormVsctatip" tabindex="-1" role="dialog" data-keyboard="false" data-backdrop="static" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header headerRegister">
                <h5 class="modal-title" id="titleModal">Nuevo Parámetro Contable</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            
            <div class="modal-body">
                <form id="formVsctatip" name="formVsctatip">
                <!-- boton oculto -->
                <input type="hidden" id="idSec_id" name="idSec_id" value="">                 
                <p class="text-primary">Campos con asterisco * son obligatorios</p>

                <!-- Tabla -->
                <div class="row">
                    <div class="form-group col-md-6">
                        <label for="listTab_no">Tipo Comprobante *</label>
                        <select class="form-control" data-live-search="true" data-size="5" id="listTab_no" name="listTab_no" required="">
                        </select>
                    </div>
                    <div class="form-group col-md-6">
                        <label for="listCtamov">Signo del Diario *</label>
                        <select class="form-control selectpicker" id="listCtamov" name="listCtamov" required="">
                                <option value="" selected>Seleccione</option>
                                <option value="1">Deudor</option>
                                <option value="-1">Acreedor</option>
                        </select>
                    </div>
                </div>

                <!-- Entidad -->
                <div class="row">
                    <div class="form-group col-md-6">
                        <label for="listEntity">Código de Parámetro</label>
                        <select class="form-control selectpicker" data-size="6" id="listEntity" name="listEntity">
                                <option value="" selected>Seleccione</option>
                                <option value="ART_NO">Artículo</option>
                                <option value="CLI_NO">Cliente</option>
                                <option value="BAN_NO">Entidad Financiera</option>
                                <option value="FORPAG">Forma de Pago</option>
                                <option value="EMP_NO">Personal</option>
                                <option value="PRV_NO">Proveedor</option>
                                <option value="PORRF1">Retención Fuente Bienes</option>
                                <option value="PORRF2">Retención Fuente Servicios</option>
                                <option value="PORRI1">Retención I.V.A. Bienes</option>
                                <option value="PORRI2">Retención I.V.A. Servicios</option>
                                <option value="RUB_NO">Rubro Nómina</option>
                        </select>
                    </div>
                    <div class="form-group col-md-6">
                        <label for="listCtafil">Cuenta Contable en Ficha *</label>
                        <select class="form-control selectpicker" id="listCtafil" name="listCtafil" required="">
                                <option value="" selected>Seleccione</option>
                                <option value="1">Si</option>
                                <option value="2">No</option>
                        </select>
                    </div>
                </div>

                <!-- Factor -->
                <div class="row">
                    <div class="form-group col-md-6">
                        <label for="listValors">Código de Valor *</label>
                        <select class="form-control selectpicker" data-size="6" id="listValors" name="listValors" required="">
                                <option value="" selected>Seleccione</option>
                                <option value="VALORS">Diario</option>
                                <option value="ABOVAL">Factura / Nota Crédito Cliente</option>
                                <option value="BASIVA">Factura Proveedor</option>
                                <option value="MONIVA">I.V.A. Compras</option>
                                <option value="MONRF1">Retención Fuente Bienes</option>
                                <option value="MONRF2">Retención Fuente Servicios</option>
                                <option value="MONRI1">Retención I.V.A. Bienes</option>
                                <option value="MONRI2">Retención I.V.A. Servicios</option>
                        </select>
                    </div>
                    <div class="form-group col-md-6">
                        <label for="txtFactor">Factor</label>
                        <input class="form-control" id="txtFactor" name="txtFactor" type="number" step="0.01" min="0" value="0">
                    </div>
                </div>

                <!-- Cuenta Contable -->
                <div class="row">
                    <div class="form-group col-md-6">
                        <label for="listAnt_no">Cuenta Contable Deudora</label>
                        <select class="form-control" data-live-search="true" data-size="5" id="listAnt_no" name="listAnt_no">
                        </select>
                    </div>
                    <div class="form-group col-md-6">
                        <label for="listCta_no">Cuenta Contable Acreedora</label>
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
