<!-- Modal -->
<div class="modal fade" id="modalformVsrolrub" name="modalformVsrolrub" tabindex="-1" role="dialog" data-keyboard="false" data-backdrop="static" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header headerRegister">
                <h5 class="modal-title" id="titleModal">Nuevo Banco</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            
            <div class="modal-body">
                <form id="formVsrolrub" name="formVsrolrub">
                <!-- boton oculto -->
                <input type="hidden" id="idRub_no" name="idRub_no" value="">
                <p class="text-primary">Campos con asterisco * son obligatorios</p>

                <!-- Estado y Tipo -->
                <div class="row">
                    <div class="form-group col-md-6">
                        <label for="listStatus">Estado *</label>
                        <select class="form-control selectpicker" id="listStatus" name="listStatus" required="">
                                <option value="" selected>Seleccione</option>
                                <option value="1">Activo</option>
                                <option value="2">Inactivo</option>
                        </select>
                    </div>
                    <div class="form-group col-md-6">
                        <label for="listRubtip">Tipo *</label>
                        <select class="form-control selectpicker" id="listRubtip" name="listRubtip" required="">
                                <option value="" selected>Seleccione</option>
                                <option value="1">Ingreso</option>
                                <option value="2">Descuento</option>
                        </select>
                    </div>
                </div>

                <!-- Nombre -->
                <div class="row">
                    <div class="form-group col-md-12">
                        <label for="txtRub_nm">Nombre Rubro *</label>
                        <input class="form-control" id="txtRub_nm" name="txtRub_nm" type="text" placeholder="*" maxlength="100" required="">
                    </div>
                </div>

                <!-- Rubro Encerado y Oculto -->
                <div class="row">
                    <div class="form-group col-md-6">
                        <label for="listEncera">Inicializa Valor cada Mes *</label>
                        <select class="form-control selectpicker" id="listEncera" name="listEncera" required="">
                                <option value="" selected>Seleccione</option>
                                <option value="1">Si</option>
                                <option value="2">No</option>
                        </select>
                    </div>
                    <div class="form-group col-md-6">
                        <label for="listHidens">Oculto *</label>
                        <select class="form-control selectpicker" id="listHidens" name="listHidens" required="">
                                <option value="" selected>Seleccione</option>
                                <option value="1">Si</option>
                                <option value="2">No</option>
                        </select>
                    </div>
                </div>

                <!-- Rubro es Crédito y para calculo de Aporte Individual -->
                <div class="row">
                    <div class="form-group col-md-6">
                        <label for="listPercre">Uso para Crédito Personal *</label>
                        <select class="form-control selectpicker" id="listPercre" name="listPercre" required="">
                                <option value="" selected>Seleccione</option>
                                <option value="1">Si</option>
                                <option value="2">No</option>
                        </select>
                    </div>
                    <div class="form-group col-md-6">
                        <label for="listAporte">Aportable Seguro Social *</label>
                        <select class="form-control selectpicker" id="listAporte" name="listAporte" required="">
                                <option value="" selected>Seleccione</option>
                                <option value="1">Si</option>
                                <option value="2">No</option>
                        </select>
                    </div>
                </div>

                <!-- Fórmula -->
                <div class="row">
                    <div class="form-group col-md-12">
                        <label for="txtFormul">Fórmula de Cálculo</label>
                        <textarea class="form-control" id="txtFormul" name="txtFormul" rows="3" maxlength="100"></textarea>
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
