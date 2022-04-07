<!-- Modal -->
<div class="modal fade" id="modalformVsprovid" name="modalformVsprovid" tabindex="-1" role="dialog" data-keyboard="false" data-backdrop="static" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered" role="document">
        <div id="divLoading">
            <div>
                <img src="<?= media(); ?>images/ajax-loader.gif" alt="Loading">
            </div>
        </div>
        <div class="modal-content">
            <div class="modal-header headerRegister">
                <h5 class="modal-title" id="titleModal">Nuevo Personal</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            
            <div class="modal-body">

                <form id="formVsprovid" name="formVsprovid">
                <!-- boton oculto -->
                <input type="hidden" id="idPrv_no" name="idPrv_no" value="">
                <p class="text-primary">Campos con asterisco * son obligatorios</p>

                <!-- Condición -->
                <div class="row">
                    <div class="form-group col-md-12">
                        <label for="listStatus">Estado *</label>
                        <select class="form-control" id="listStatus" name="listStatus" required="">
                                <option value="" selected>Seleccione</option>
                                <option value="1">Activo</option>
                                <option value="2">Inactivo</option>
                        </select>
                    </div>
                </div>

                <!-- Apellidos y Nombres -->
                <div class="row">
                    <div class="form-group col-md-6">
                        <label for="txtLas_nm">Apellidos *</label>
                        <input class="form-control" id="txtLas_nm" name="txtLas_nm" type="text" placeholder="*" maxlength="30" required="">
                    </div>
                    <div class="form-group col-md-6">
                        <label for="txtFir_nm">Nombres *</label>
                        <input class="form-control" id="txtFir_nm" name="txtFir_nm" type="text" placeholder="*" maxlength="30" required="">
                    </div>         
                </div>

                <!-- Credencial Proveedor -->
                <div class="row">
                    <div class="form-group col-md-6">
                        <label for="listIdtype">Tipo Identificación *</label>
                        <select class="form-control selectpicker" id="listIdtype" name="listIdtype" required="">
                                <option value="" selected>Seleccione</option>
                                <option value="02">Cédula</option>
                                <option value="01">RUC</option>
                                <option value="03">Pasaporte</option>
                        </select>
                    </div>
                    <div class="form-group col-md-6">
                        <label for="txtIde_no">Número Identificación *</label>
                        <input class="form-control" id="txtIde_no" name="txtIde_no" type="text" pattern="[a-zA-Z0-9-]{9,13}" title="Maximo 13 digitos" required="">
                    </div>
                </div>

                <!-- Dirección y Teléfonos -->
                <div class="row">
                    <div class="form-group col-md-6">
                        <label for="txtAddres">Dirección *</label>
                        <textarea class="form-control" id="txtAddres" name="txtAddres" rows="3" type="text" placeholder="*" maxlength="60" required=""></textarea>
                    </div>
                    <div class="form-group col-md-6">
                        <label for="txtTphone">Teléfonos *</label>
                        <textarea class="form-control" id="txtTphone" name="txtTphone" rows="3" type="text" placeholder="*" maxlength="50" required=""></textarea>
                    </div>
                </div>


                <!-- Correo -->
                <div class="row">
                    <div class="form-group col-md-12">
                        <label for="txtEmails">Correo Electrónico *</label>
                        <input class="form-control" id="txtEmails" name="txtEmails" type="email" placeholder="*" maxlength="50" required="">
                    </div>    
                </div>
                
                <!-- Beneficiario -->
                <div class="row">
                    <div class="form-group col-md-12">
                        <label for="txtBenefi">Beneficiario *</label>
                        <input class="form-control" id="txtBenefi" name="txtBenefi" type="text" placeholder="*" maxlength="100" required="">
                    </div>    
                </div>

                <!-- Numero Autorización -->
                <div class="row">
                    <div class="form-group col-md-6">
                        <label for="txtAut_no">Número Autorización S.R.I.</label>
                        <input class="form-control" id="txtAut_no" name="txtAut_no" type="text" placeholder="" maxlength="50">
                    </div>
                    <div class="form-group col-md-6">
                        <label for="datFecaut">Fecha Autorización S.R.I.</label>
                        <input class="form-control" id="datFecaut" name="datFecaut" type="date" placeholder="">
                    </div>
                </div>

                <!-- Cuenta Contable Anticipo -->
                <div class="row">
                    <div class="form-group col-md-12">
                        <label for="listAnt_no">Cuenta Contable Anticipo</label>
                        <select class="form-control" data-live-search="true" data-size="5" id="listAnt_no" name="listAnt_no">
                        </select>
                    </div>
                </div>

                <!-- Cuenta Contable por Pagar -->
                <div class="row">
                    <div class="form-group col-md-12">
                        <label for="listCta_no">Cuenta Contable por Pagar *</label>
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
