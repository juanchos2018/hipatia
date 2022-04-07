<!-- Modal -->
<div class="modal fade" id="modalformVsproduc" name="modalFormVsproduc" tabindex="-1" role="dialog" data-keyboard="false" data-backdrop="static" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header headerRegister">
                <h5 class="modal-title" id="titleModal">Nuevo Artículo</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            
            <div class="modal-body">
                <form id="formVsproduc" name="formVsproduc">
                <!-- boton oculto -->
                <input type="hidden" id="idArt_no" name="idArt_no" value="">
                <p class="text-primary">Campos con asterisco * son obligatorios</p>

                <!-- Condición y Tipo de Artículo -->
                <div class="row">
                    <div class="form-group col-md-6">
                        <label for="listEstado">Estado *</label>
                        <select class="form-control selectpicker" id="listEstado" name="listEstado" required="">
                                <option value="" selected>Seleccione</option>
                                <option value="1">Activo</option>
                                <option value="0">Inactivo</option>
                            </select>
                    </div>
                    <div class="form-group col-md-6">
                        <label for="listTip_no">Tipo de Artículo *</label>
                        <select class="form-control selectpicker" id="listTip_no" name="listTip_no" required="">
                                <option value="" selected>Seleccione</option>
                                <option value="1">Producto</option>
                                <option value="2">Servicio</option>
                        </select>
                    </div>
                </div>

                <!-- Nombre de Artículo -->
                <div class="form-group">
                    <label for="txtSec_nm">Nombre Artículo *</label>
                    <input class="form-control" id="txtArt_nm" name="txtArt_nm" type="text" placeholder="*" maxlength="100" required="">
                </div>

                <!-- Desglosa IVA -->
                <!-- Afectado por Pronto Pago-->
                <div class="row">
                    <div class="form-group col-md-6">
                        <label for="listDesiva">Desglosa IVA *</label>
                        <select class="form-control selectpicker" id="listDesiva" name="listDesiva" required="">
                                <option value="" selected>Seleccione</option>
                                <option value="1">Si</option>
                                <option value="2">No</option>
                        </select>
                    </div>
                    <div class="form-group col-md-6">
                        <label for="listPropay">Afectado por Pronto Pago *</label>
                        <select class="form-control selectpicker" id="listPropay" name="listPropay" required="">
                                <option value="" selected>Seleccione</option>
                                <option value="1">Si</option>
                                <option value="2">No</option>
                        </select>
                    </div>
                </div>
 
                <!-- Periodos -->
                <div class="row">
                    <div class="form-group col-md-4">
                        <label>Periodos de Facturación *</label>
                        <br>
                        <input id="listMon000" name="listPer000" type="hidden"   value="off">
                        <input id="listPer000" name="listPer000" type="checkbox" value="on"> Aspirante<br>
                        <input id="listMon001" name="listPer001" type="hidden"   value="off">
                        <input id="listPer001" name="listPer001" type="checkbox" value="on"> Matrícula<br>
                        <input id="listMon002" name="listPer002" type="hidden"   value="off">
                        <input id="listPer002" name="listPer002" type="checkbox" value="on"> Abr<br>
                        <input id="listMon003" name="listPer003" type="hidden"   value="off">
                        <input id="listPer003" name="listPer003" type="checkbox" value="on"> May<br>
                        <input id="listMon004" name="listPer004" type="hidden"   value="off">
                        <input id="listPer004" name="listPer004" type="checkbox" value="on"> Jun<br>
                    </div> 
                    <div class="form-group col-md-4">
                        <br>
                        <input id="listMon005" name="listPer005" type="hidden"   value="off">
                        <input id="listPer005" name="listPer005" type="checkbox" value="on"> Jul<br>
                        <input id="listMon006" name="listPer006" type="hidden"   value="off">
                        <input id="listPer006" name="listPer006" type="checkbox" value="on"> Ago<br>
                        <input id="listMon007" name="listPer007" type="hidden"   value="off">
                        <input id="listPer007" name="listPer007" type="checkbox" value="on"> Sep<br>
                        <input id="listMon008" name="listPer008" type="hidden"   value="off">
                        <input id="listPer008" name="listPer008" type="checkbox" value="on"> Oct<br>
                        <input id="listMon009" name="listPer009" type="hidden"   value="off">
                        <input id="listPer009" name="listPer009" type="checkbox" value="on"> Nov<br>
                    </div>
                    <div class="form-group col-md-4">
                        <br>
                        <input id="listMon010" name="listPer010" type="hidden"   value="off">
                        <input id="listPer010" name="listPer010" type="checkbox" value="on"> Dic<br>
                        <input id="listMon011" name="listPer011" type="hidden"   value="off">
                        <input id="listPer011" name="listPer011" type="checkbox" value="on"> Ene<br>
                        <input id="listMon012" name="listPer012" type="hidden"   value="off">
                        <input id="listPer012" name="listPer012" type="checkbox" value="on"> Feb<br>
                        <input id="listMon013" name="listPer013" type="hidden"   value="off">
                        <input id="listPer013" name="listPer013" type="checkbox" value="on"> Mar<br>
                    </div>
                </div>

                <!-- Cuenta Contable -->
                <div class="row">
                    <div class="form-group col-md-12">
                        <label for="listCta_no">Cuenta Contable Ingreso *</label>
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
