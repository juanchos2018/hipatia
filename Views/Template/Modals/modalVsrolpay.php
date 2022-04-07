<!-- Modal -->
<div class="modal fade" id="modalformVsrolpay" name="modalformVsrolpay" tabindex="-1" role="dialog" data-keyboard="false" data-backdrop="static" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header headerRegister">
                <h5 class="modal-title" id="titleModal">Nuevo Rol de Pago</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            
            <div class="modal-body">
                <form id="formVsrolpay" name="formVsrolpay">
                <!-- boton oculto -->
                <input type="hidden" id="idSec_id" name="idSec_id" value=""> 
                <p class="text-primary">Campos con asterisco * son obligatorios</p>

                <!-- Personal y Rubro -->
                <div class="row">
                    <div class="form-group col-md-12">
                        <label for="listEmp_no">Personal (En blanco todos)</label>
                        <select class="form-control" data-live-search="true" data-size="5" id="listEmp_no" name="listEmp_no">
                        </select> 
                    </div>
                </div>
                <div class="row">
                    <div class="form-group col-md-12">
                        <label for="listRub_no">Rubro (En blanco todos)</label>
                        <select class="form-control" data-live-search="true" data-size="5" id="listRub_no" name="listRub_no">
                        </select>
                    </div>
                </div>

                <!-- Periodo -->
                <div class="row">
                    <div class="form-group col-md-6">
                        <label for="listMondes">Mes Corte *</label>
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
                    <div class="form-group col-md-6">
                        <label for="listPerios">Año Corte *</label>
                        <input class="form-control" id="listPerios" name="listPerios" type="number" min="0" max="9999" required="">
                    </div>
                </div>

                <!-- Valores -->
                <div class="row">
                    <div class="form-group col-md-6">
                        <label for="txtIncome">Ingreso</label>
                        <input class="form-control" id="txtIncome" name="txtIncome" type="number" value="0" min="0" step="0.01">
                    </div>
                    <div class="form-group col-md-6">
                        <label for="txtEgress">Egreso</label>
                        <input class="form-control" id="txtEgress" name="txtEgress" type="number" value="0" min="0" step="0.01">
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


<!-- Modal Informe Rol de Pagos -->
<div class="modal fade" id="modalformVsrolrep" name="modalformVsrolrep" tabindex="-1" role="dialog" data-keyboard="false" data-backdrop="static" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header headerRegister">
                <h5 class="modal-title" id="titleModal">Informe Rol de Pago</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            
            <div class="modal-body">
                <form id="formVsrolrep" name="formVsrolrep">
                <p class="text-primary">Campos con asterisco * son obligatorios</p>
                
                <!-- Personal -->
                <div class="row">
                    <div class="form-group col-md-12">
                        <label for="listEmp_n2">Personal (En blanco todos)</label>
                        <select class="form-control" data-live-search="true" data-size="5" id="listEmp_n2" name="listEmp_n2">
                        </select> 
                    </div>
                </div>

                <!-- Tipo informe -->
                <div class="row">
                    <div class="form-group col-md-12">
                        <label for="listReptyp">Tipo de Informe *</label>
                        <select class="form-control selectpicker" data-size="5" id="listReptyp" name="listReptyp" required="">
                                <option value="" selected>Seleccione</option>
                                <option value="1">Nómina de Rol</option>
                                <option value="2">Rol Individual</option>
                                <option value="3">Archivo Acreditación Bancaria</option>
                                <option value="4">Listado de Créditos Personales</option>
                                <option value="5">Estado de Cuenta Personal</option>
                                <option value="6">Provisión Beneficios Sociales</option>
                                <option value="7">Liquidación 13º</option>
                                <option value="8">Liquidación 14º</option>
                        </select>
                    </div>
                </div>

                <!-- Periodo -->
                <div class="row">
                    <div class="form-group col-md-6">
                        <label for="listMondes">Mes Corte *</label>
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
                    <div class="form-group col-md-6">
                        <label for="listPerio2">Año Corte *</label>
                        <input class="form-control" id="listPerio2" name="listPerio2" type="number" min="0" max="9999" required="">
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


<!-- Modal para Informe Nómina -->
<div class="modal fade" id="modvsRolPrn" name="modvsRolPrn" tabindex="-1" role="dialog" data-keyboard="false" data-backdrop="static" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header headerRegister">
                <h5 class="modal-title" id="titleModal">Informe Rol de Pago</h5>
            </div>
            
            <div class="modal-body">
            </div>

        </div>
    </div>
</div>


<!-- Modal Cierre Rol de Pagos -->
<div class="modal fade" id="modalformVsrolclo" name="modalformVsrolclo" tabindex="-1" role="dialog" data-keyboard="false" data-backdrop="static" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header headerRegister">
                <h5 class="modal-title" id="titleModal">Cierre Rol de Pago</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            
            <div class="modal-body">
                <form id="formVsrolclo" name="formVsrolclo">
                <p class="text-primary">Campos con asterisco * son obligatorios</p>
                
                <!-- Periodo -->
                <div class="row">
                    <div class="form-group col-md-6">
                        <label for="listMondes">Mes *</label>
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
                    <div class="form-group col-md-6">
                        <label for="listPerio3">Año *</label>
                        <input class="form-control" id="listPerio3" name="listPerio3" type="number" min="0" max="9999" required="">
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
