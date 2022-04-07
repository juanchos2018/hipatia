<!-- Modal -->
<div class="modal fade" id="modalformVsempcre" name="modalFormVsempcre" tabindex="-1" role="dialog" data-keyboard="false" data-backdrop="static" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header headerRegister">
                <h5 class="modal-title" id="titleModal">Nuevo Crédito Personal</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            
            <div class="modal-body">
                <form id="formVsempcre" name="formVsempcre">
                <!-- boton oculto -->
                <input type="hidden" id="idSec_id" name="idSec_id" value="">
                <input type="hidden" id="txtHorreg" name="txtHorreg" value="">                 
                <p class="text-primary">Campos con asterisco * son obligatorios</p>

                <!-- Tipo y Número de Diario -->
                <div class="row">
                    <div class="form-group col-md-6">
                        <label for="listMovtip">Tipo Comprobante *</label>
                        <select class="form-control selectpicker" id="listMovtip" name="listMovtip" required="">
                                <option value="CE">Crédito Personal</option>
                        </select>
                    </div>
                    <div class="form-group col-md-6">
                        <label for="txtMov_no">No. Comprobante</label>
                        <input class="form-control" id="txtMov_no" name="txtMov_no" type="number" onkeydown="return false">
                    </div>
                </div>

                <!-- Personal -->
                <div class="row">
                    <div class="form-group col-md-6">
                        <label for="listEmp_no">Personal *</label>
                        <select class="form-control" data-live-search="true" data-size="5" id="listEmp_no" name="listEmp_no" required="">
                        </select> 
                    </div>
                    <div class="form-group col-md-6">
                        <label for="listRubcre">Rubro *</label>
                        <select class="form-control" data-live-search="true" data-size="5" id="listRubcre" name="listRubcre" required="">
                        </select>
                    </div>
                </div>

                <!-- Monto y Plazo -->
                <div class="row">
                    <div class="form-group col-md-4">
                        <label for="txtValors">Monto del Crédito *</label>
                        <input class="form-control" id="txtValors" name="txtValors" type="number" step="0.01" min="0.01" value="0" required="">
                    </div>
                    <div class="form-group col-md-4">
                        <label for="txtPlazos">Plazo (Meses) *</label>
                        <input class="form-control" id="txtPlazos" name="txtPlazos" type="number" min="0" value="0" required="">
                    </div>
                    <div class="form-group col-md-4">
                        <label for="txtCuotas">Cuota</label>
                        <input class="form-control" id="txtCuotas" name="txtCuotas" type="number" min="0" value="0">
                    </div>
                </div>

                <!-- Periodo descuenta -->
                <div class="row">
                    <div class="form-group col-md-4">
                        <label for="listMondes">Mes de Descuento *</label>
                        <select class="form-control selectpicker" data-size="5" id="listMondes" name="listMondes" required="">
                                <option value="" selected>Seleccione</option>
	         					<option value="01">Enero</option>
		       					<option value="02">Febrero</option>
		       					<option value="03">Marzo</option>
		       					<option value="04">Abril</option>
		       					<option value="05">Mayo</option>
		       					<option value="06">Junio</option>
		       					<option value="07">Julio</option>
		       					<option value="08">Agosto</option>
		       					<option value="09">Septiembre</option>
		       					<option value="10">Octubre</option>
		       					<option value="11">Noviembre</option>
		       					<option value="12">Diciembre</option>
        				</select>
            		</div>
                    <div class="form-group col-md-4">
                        <label for="listPerios">Año de Descuento *</label>
                        <input class="form-control" id="listPerios" name="listPerios" type="number" min="0" max="9999" required="">
                    </div>
                    <div class="form-group col-md-4">
                        <label for="datFecreg">Fecha Contable *</label>
                        <input class="form-control" id="datFecreg" name="datFecreg" type="date" required="">
                    </div>
                </div>

                <!-- Forma de Pago -->
                <div class="row">
                    <div class="form-group col-md-4">
                        <label for="listForpag">Forma de Pago *</label>
                        <select class="form-control selectpicker" id="listForpag" name="listForpag" required="">
                                <option value="" selected>Seleccione</option>
                                <option value="0">Ninguna</option>
	           					<option value="1">Efectivo</option>
			        			<option value="2">Cheque</option>
					        	<option value="3">Débito Bancario</option>
        				</select>
            		</div>
                    <div class="form-group col-md-4">
                        <label for="listBan_n2">Entidad Financiera</label>
                        <select class="form-control" onchange="fntDatBan();" data-live-search="true" data-size="5" id="listBan_n2" name="listBan_n2">
                        </select>
                    </div>
                    <div class="form-group col-md-4">
                        <label for="txtChe_no">No. Cheque</label>
                        <input class="form-control" id="txtChe_no" name="txtChe_no" type="number" maxlength="9">
                    </div>
                </div>

                <!-- Concepto -->
                <div class="row">
                    <div class="form-group col-md-12">
                        <label for="txtRemark">Concepto del Crédito *</label>
                        <textarea class="form-control" id="txtRemark" name="txtRemark" rows="1" type="text" maxlength="100" required=""></textarea>
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
