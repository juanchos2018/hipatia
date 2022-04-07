<!-- Modal -->
<div class="modal fade" id="modalformVstariff" name="modalformVstariff" tabindex="-1" role="dialog" data-keyboard="false" data-backdrop="static" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header headerRegister">
                <h5 class="modal-title" id="titleModal">Convenios</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            
            <div class="modal-body">
                <form id="formVstariff" name="formVstariff">
                <p class="text-primary">Campos con asterisco * son obligatorios</p>
                <!-- boton oculto -->
                <input type="hidden" id="idSec_id" name="idSec_id" value="">

                <!-- Estudiante -->
                <div class="row">
                    <div class="form-group col-md-12">
                        <label for="listStd_no">Estudiante *</label>
                        <select class="form-control" onchange="fntGetSecPerios();" data-live-search="true" data-size="5" id="listStd_no" name="listStd_no" required="">
                        </select>
                    </div>
                </div>

                <!-- Sección -->
                <div class="row">
                    <div class="form-group col-md-12">
                        <label for="listSec_no">Sección</label>
                        <select class="form-control" data-size="5" data-live-search="true" id="listSec_no" name="listSec_no">
                        </select>
                    </div>
                </div>

                <!-- Año y Periodo -->
                <div class="row">
                    <div class="form-group col-md-6">
                        <label for="listPerios">Año Lectivo *</label>
                        <input class="form-control" id="listPerios" name="listPerios" type="number" min="0" max="9999" required="">
                    </div>
                    <div class="form-group col-md-6">
                        <label for="listPer_no">Periodo *</label>
                        <select class="form-control" data-live-search="true" data-size="5" id="listPer_no" name="listPer_no" required="">
                        </select>
                    </div>
                </div>

                <!-- Precio Lista y Precio Tarifado -->
                <div class="row">
                    <div class="form-group col-md-6">
                        <label for="listArt_no">Artículo *</label>
                        <select class="form-control" onchange="fntGetPrice();" data-live-search="true" data-size="5" id="listArt_no" name="listArt_no" required="">
                        </select>
                    </div>
                    <div class="form-group col-md-6">
                        <label for="txtDocval">Precio Lista</label>
                        <input class="form-control" id="txtDocval" name="txtDocval" type="number" step="0.01" min="0" value="0" onkeydown="return false">
                    </div>
                </div>
                <div class="row">
                    <div class="form-group col-md-6">
                        <label for="txtFacval">Precio Tarifado *</label>
                        <input class="form-control" id="txtFacval" name="txtFacval" type="number" step="0.01" min="0" value="0" required="">
                    </div>
                    <div class="form-group col-md-6">
                        <label for="txtAboval">Valor Abonado</label>
                        <input class="form-control" id="txtAboval" name="txtAboval" type="number" step="0.01" min="0" value="0" onkeydown="return false">
                    </div>
                </div>

                <!-- Observaciones -->
                <div class="row">
                    <div class="form-group col-md-12">
                        <label for="txtRemark">Observaciones (Motivo de Tarifado) *</label>
                        <textarea class="form-control" id="txtRemark" name="txtRemark" rows="1" type="text" maxlength="100" required=""></textarea>
                    </div>  
                </div>  

                <div class="row">
                    <div class="form-group col-md-6">
                        <input id="listRepcon" name="listReplic" type="hidden"   value="off">
                        <input id="listReplic" name="listReplic" type="checkbox" value="on"> Replicar condición en todos los Periodos
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


<!-- Modal Generar Cuenta por Cobrar  -->
<div class="modal fade" id="modalformVsgencxc" name="modalformVsgencxc" tabindex="-1" role="dialog" data-keyboard="false" data-backdrop="static" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header headerRegister">
                <h5 class="modal-title" id="titleModal">Generar Cuenta por Cobrar</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            
            <div class="modal-body">
                <form id="formVsgencxc" name="formVsgencxc">                
                <p class="text-primary">Campos con asterisco * son obligatorios</p>
                
                <!-- Estudiante -->
                <div class="row">
                    <div class="form-group col-md-12">
                        <label for="listStd_n3">Estudiante (En blanco todos)</label>
                        <select class="form-control" data-size="5" data-live-search="true" id="listStd_n3" name="listStd_n3">
                        </select>
                    </div>
                </div>

                <!-- Periodo -->
                <div class="row">
                    <div class="form-group col-md-6">
                        <label for="listPerio2">Año Lectivo *</label>
                        <input class="form-control" id="listPerio2" name="listPerio2" type="number" min="0" max="9999" required="">
                    </div>
                </div>

                <div class="modal-footer">
                    <button id="btnGenCxc" class="btn btn-primary" type="submit"><i class="fa fa-fw fa-lg fa-check-circle"></i>Aceptar</button>&nbsp;&nbsp;&nbsp;
                    <button class="btn btn-danger" type="button" data-dismiss="modal"><i class="fa fa-fw fa-lg fa-times-circle"></i>Cancelar</button>
                </div> 

                </form>
            </div>
        </div>
    </div>
</div>


<!-- Modal Informe Cuenta por Cobrar  -->
<div class="modal fade" id="modalformVsstdcxc" name="modalformVsstdcxc" tabindex="-1" role="dialog" data-keyboard="false" data-backdrop="static" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header headerRegister">
                <h5 class="modal-title" id="titleModal">Informe Cuenta por Cobrar</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            
            <div class="modal-body">
                <form id="formVsstdcxc" name="formVsstdcxc">                
                <p class="text-primary">Campos con asterisco * son obligatorios</p>
                
                <!-- Estudiante -->
                <div class="row">
                    <div class="form-group col-md-12">
                        <label for="listStd_n4">Estudiante (En blanco todos)</label>
                        <select class="form-control" data-size="5" data-live-search="true" id="listStd_n4" name="listStd_n4">
                        </select>
                    </div>
                </div>

                <!-- Tipo informe y Año -->
                <div class="row">
                    <div class="form-group col-md-6">
                        <label for="listReptyp">Tipo de Informe *</label>
                        <select class="form-control selectpicker" id="listReptyp" name="listReptyp" required="">
                                <option value="" selected>Seleccione</option>
                                <option value="1">Cuenta por Cobrar</option>
                                <option value="2">Recordatorios de Pago</option>
                                <option value="3">Archivo Recaudación Bancaria</option>
                                <option value="4">Listado de Descuentos</option>
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

                <!-- Periodo -->
                <div class="row">
                    <div class="form-group col-md-6">
                        <label for="listMon_no">Periodo *</label>
                        <select class="form-control" data-live-search="true" data-size="5" id="listMon_no" name="listMon_no" required="">
                        </select>
                    </div>
                    <div class="form-group col-md-6">
                        <label for="listPerio3">Año Lectivo *</label>
                        <input class="form-control" id="listPerio3" name="listPerio3" type="number" min="0" max="9999" required="">
                    </div>
                </div>

                <div class="modal-footer">
                    <button id="btnPrnStdCxc" class="btn btn-primary" type="submit"><i class="fa fa-fw fa-lg fa-check-circle"></i>Aceptar</button>&nbsp;&nbsp;&nbsp;
                    <button class="btn btn-danger" type="button" data-dismiss="modal"><i class="fa fa-fw fa-lg fa-times-circle"></i>Cancelar</button>
                </div> 

                </form>
            </div>
        </div>
    </div>
</div>


<!-- Modal para Informe Cxc -->
<div class="modal fade" id="modvsCxcPrn" name="modvsCxcPrn" tabindex="-1" role="dialog" data-keyboard="false" data-backdrop="static" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header headerRegister">
                <h5 class="modal-title" id="titleModal">Informe Cuenta por Cobrar</h5>
            </div>
            
            <div class="modal-body">
            </div>

        </div>
    </div>
</div>
