<!-- Modal -->
<div class="modal fade" id="modalformVsbillin" name="modalformVsbillin" tabindex="-1" role="dialog" data-keyboard="false" data-backdrop="static" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header headerRegister">
                <h5 class="modal-title" id="titleModal">Registrar Facturación</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            
            <div class="modal-body">
                <form id="formVsbillin" name="formVsbillin">

                <p class="text-info mb-0">Campos con asterisco * son obligatorios</p>
                <hr class="mt-0">

                <!-- Estudiante -->
                <div class="row">
                    <div class="form-group col-md-12">
                        <label for="listStd_no">Estudiante *</label>
                        <select class="form-control" onchange="fntDatStd();" data-live-search="true" data-size="5" id="listStd_no" name="listStd_no" required>
                        </select>
                    </div>
                </div>
                <div class="row">
                    <div class="form-group col-md-12">
                        <label for="listSec_no">Sección</label>
                        <select class="form-control" data-live-search="true" data-size="5" id="listSec_no" name="listSec_no">
                        </select>
                    </div>
                </div>

                <p class="text-info mb-0">INFORMACIÓN DE CLIENTE</p>
                <hr class="mt-0">

                <!-- Cliente -->
                <div class="row">
                    <div class="form-group col-md-6">
                        <label for="listFacwho">Facturación Asumida por *</label>
                        <select class="form-control selectpicker" onchange="fntDatFac();" id="listFacwho" name="listFacwho" required="">
                                <option value="" selected>Seleccione</option>
                                <option value="1">Padre</option>
                                <option value="2">Madre</option>
                                <option value="3">Representante</option>
                                <option value="4">Otro</option>
                        </select>
                    </div>
                    <div class="form-group col-md-6">
                        <label for="txtRazons">Razón Social *</label>
                        <textarea class="form-control" id="txtRazons" name="txtRazons" rows="1" type="text" maxlength="100" required=""></textarea>
                    </div>
                </div>

                <div class="row">
                    <div class="form-group col-md-6">
                        <label for="txtDirecc">Dirección *</label>
                        <textarea class="form-control" id="txtDirecc" name="txtDirecc" rows="1" type="text" maxlength="100" required=""></textarea>
                    </div>
                    <div class="form-group col-md-6">
                        <label for="txtTlf_no">Teléfonos</label>
                        <textarea class="form-control" id="txtTlf_no" name="txtTlf_no" rows="1" type="text" maxlength="50"></textarea>
                    </div>
                </div>

                <!-- Credencial Cliente -->
                <div class="row">
                    <div class="form-group col-md-6">
                        <label for="txtEmails">Correo Electrónico</label>
                        <input class="form-control" id="txtEmails" name="txtEmails" type="email" maxlength="100">
                    </div>
                    <div class="form-group col-md-3">
                        <label for="listCltype">Tipo Identificación *</label>
                        <select class="form-control selectpicker" id="listCltype" name="listCltype" required="">
                                <option value="" selected>Seleccione</option>
                                <option value="05">Cédula</option>
                                <option value="04">RUC</option>
                                <option value="06">Pasaporte</option>
                        </select>
                    </div>
                    <div class="form-group col-md-3">
                        <label for="txtRuc_no">No. Identificación *</label>
                        <input class="form-control" id="txtRuc_no" name="txtRuc_no" type="text" maxlength="13" pattern="[a-zA-Z0-9-]{9,13}" required="">
                    </div>
                </div>

                <!-- Periodo -->
                <div class="row">
                    <div class="form-group col-md-3">
                        <label for="listPerios">Año Lectivo *</label>
                        <input class="form-control" id="listPerios" name="listPerios" type="number" min="0" max="9999" required="">
                    </div>
                    <div class="form-group col-md-3">
                        <label for="listPer_no">Periodo *</label>
                        <select class="form-control" onchange="fntGetFacVal();" data-live-search="true" data-size="5" id="listPer_no" name="listPer_no" required="">
                        </select>
                    </div>
                    <div class="form-group col-md-3">
                        <label for="txtDocval">Saldo al Periodo *</label>
                        <input class="form-control" id="txtDocval" name="txtDocval" type="number" step="0.01" min="0" value="0" onkeydown="return false">
                    </div>
                    <div class="form-group col-md-3">
                        <label for="txtDocabo">Abono *</label>
                        <input class="form-control" id="txtDocabo" name="txtDocabo" type="number" step="0.01" min="0" required="">
                    </div>
                </div>

                <div class="row">
                    <div class="form-group col-md-6">
                        <label for="listDoctip">Tipo Documento *</label>
                        <select class="form-control selectpicker" id="listDoctip" name="listDoctip" required="">
                                <option value="" selected>Seleccione</option>
                                <option value="FA">Factura</option>
                                <option value="RC">Recibo</option>
                        </select>
                    </div>
                    <div class="form-group col-md-6">
                        <label for="txtDocnum">No. Documento (En blanco toma automático)</label>
                        <input class="form-control" id="txtDocnum" name="txtDocnum" type="number" min="0" value="0">
                    </div>
                </div>

                <p class="text-info mb-0">LLENAR CASILLEROS DE ACUERDO A FORMA DE PAGO</p>
                <hr class="mt-0">

                <div class="row">
                    <div class="form-group col-md-6">
                        <label for="listPayfor">Forma de Pago *</label>
                        <select class="form-control selectpicker" id="listPayfor" name="listPayfor" required="">
                                <option value="" selected>Seleccione</option>
                                <option value="EFE">Efectivo</option>
                                <option value="CHE">Cheque al Día</option>
                                <option value="POS">Cheque PostFechado</option>
                                <option value="DEP">Depósito</option>
                                <option value="TRA">Transferencia</option>
                                <option value="TAR">Tarjeta</option>
                                <option value="CAS">Cash Recaudación</option>
                        </select>
                    </div>
                    <div class="form-group col-md-6">
                        <label for="datFecemi">Fecha *</label>
                        <?php
                            $rol = $_SESSION['userData']['rol_id'];
                            if($rol == 1)
                            {
                        ?>
                                <input class="form-control" id="datFecemi" name="datFecemi" type="date" required="">
                        <?php
                            }else{
                        ?>
                                <input class="form-control" id="datFecemi" name="datFecemi" type="text" onkeydown="return false" required="">
                        <?php
                            } 
                        ?>
                    </div>
                </div>

                <!-- Banco -->
                <div class="row">
                    <div class="form-group col-md-4">
                        <label for="listBan_no">Entidad Financiera</label>
                        <select class="form-control" data-live-search="true" data-size="5" id="listBan_no" name="listBan_no">
                        </select>
                    </div>
                    <div class="form-group col-md-4">
                        <label for="txtChenum">No. Cheque</label>
                        <input class="form-control" id="txtChenum" name="txtChenum" type="text">
                    </div>
                    <div class="form-group col-md-4">
                        <label for="txtDepnum">No. Referencia</label>
                        <input class="form-control" id="txtDepnum" name="txtDepnum" type="text">
                    </div>
                </div>

                <!-- Tarjeta -->
                <div class="row">
                    <div class="form-group col-md-4">
                        <label for="listTar_no">Tarjeta</label>
                        <select class="form-control" data-live-search="true" data-size="5" id="listTar_no" name="listTar_no">
                        </select>
                    </div>
                    <div class="form-group col-md-4">
                        <label for="txtTarnum">No. Tarjeta</label>
                        <input class="form-control" id="txtTarnum" name="txtTarnum" type="text">
                    </div>
                    <div class="form-group col-md-4">
                        <label for="txtVounum">No. Voucher</label>
                        <input class="form-control" id="txtVounum" name="txtVounum" type="text">
                    </div>
                </div>

                <div class="modal-footer">
                    <button id="btnActionForm" class="btn btn-primary" type="submit"><i class="fa fa-fw fa-lg fa-check-circle"></i><span id="btnText">Guardar</span></button>&nbsp;&nbsp;&nbsp;                 
                    <button class="btn btn-danger" type="button" data-dismiss="modal"><i class="fa fa-fw fa-lg fa-times-circle"></i>Cancelar</button>
                </div> 

                </form>
            </div>
        </div>
    </div>
</div>


<!-- Modal Nota de Credito Cliente -->
<div class="modal fade" id="modalformVsnotcre" name="modalformVsnotcre" tabindex="-1" role="dialog" data-keyboard="false" data-backdrop="static" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header headerRegister">
                <h5 class="modal-title" id="titleModal">Registrar Nota de Crédito</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            
            <div class="modal-body">
                <form id="formVsnotcre" name="formVsnotcre">                
                <p class="text-primary">Campos con asterisco * son obligatorios</p>
                <br>

                <!-- Factura aplicada  -->
                <div class="row">
                    <div class="form-group col-md-6">
                        <label for="txtPto_no">No. Punto Emisión Factura Aplicada *</label>
                        <input class="form-control" id="txtPto_no" name="txtPto_no" type="text" required="">
                    </div>
                    <div class="form-group col-md-6">
                        <label for="txtFacnum">No. Factura Aplicada *</label>
                        <input class="form-control" id="txtFacnum" name="txtFacnum" type="number" required="">
                    </div>
                </div>

                <div class="row">
                    <div class="form-group col-md-12">
                        <label for="listCre_no">Motivo Nota de Crédito *</label>
                        <select class="form-control" data-live-search="true" data-size="5" id="listCre_no" name="listCre_no">
                        </select>
                    </div>
                </div>

                <div class="row">
                    <div class="form-group col-md-6">
                        <label for="txtDocval">Valor *</label>
                        <input class="form-control" id="txtDocval" name="txtDocval" type="number" step="0.01" min="0" required="">
                    </div>
                    <div class="form-group col-md-6">
                        <label for="datFecreg">Fecha Contable *</label>
                        <?php
                            $rol = $_SESSION['userData']['rol_id'];
                            if($rol == 1)
                            {
                        ?>
                                <input class="form-control" id="datFecreg" name="datFecreg" type="date" required="">
                        <?php
                            }else{
                        ?>
                                <input class="form-control" id="datFecreg" name="datFecreg" type="text" onkeydown="return false" required="">
                        <?php
                            } 
                        ?>
                    </div>
                </div>

                <div class="modal-footer">
                    <button id="btnPrnStdLis" class="btn btn-success" type="submit"><i class="fa fa-fw fa-lg fa-check-circle"></i>Guardar</button>&nbsp;&nbsp;&nbsp;
                    <button class="btn btn-danger" type="button" data-dismiss="modal"><i class="fa fa-fw fa-lg fa-times-circle"></i>Cancelar</button>
                </div> 

                </form>
            </div>
        </div>
    </div>
</div>


<!-- Modal Informe Diario Ventas -->
<div class="modal fade" id="modalformVsdiaven" name="modalformVsdiaven" tabindex="-1" role="dialog" data-keyboard="false" data-backdrop="static" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header headerRegister">
                <h5 class="modal-title" id="titleModal">Informe Diario Ventas</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            
            <div class="modal-body">
                <form id="formVsdiaven" name="formVsdiaven">                
                <p class="text-primary">Campos con asterisco * son obligatorios</p>
                <br>
                
                <!-- Año Lectivo -->
                <div class="row">
                    <div class="form-group col-md-6">
                        <label for="listReptyp">Tipo de Informe *</label>
                        <select class="form-control selectpicker" id="listReptyp" name="listReptyp" required="">
                                <option value="1">Por Documento</option>
                                <option value="2">Por Producto</option>
                        </select>
                    </div>
                    <div class="form-group col-md-6">
                        <label for="listPerio2">Año Lectivo *</label>
                        <input class="form-control" id="listPerio2" name="listPerio2" type="number" min="0" max="9999" required="">
                    </div>
                </div>
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
                    <button id="btnPrnDiaVen" class="btn btn-success" type="submit"><i class="fa fa-fw fa-lg fa-check-circle"></i>Aceptar</button>&nbsp;&nbsp;&nbsp;
                    <button class="btn btn-danger" type="button" data-dismiss="modal"><i class="fa fa-fw fa-lg fa-times-circle"></i>Cancelar</button>
                </div> 

                </form>
            </div>
        </div>
    </div>
</div>

<!-- Modal para Informe Diario Ventas -->
<div class="modal fade" id="modvsDiaPrn" name="modvsDiaPrn" tabindex="-1" role="dialog" data-keyboard="false" data-backdrop="static" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header headerRegister">
                <h5 class="modal-title" id="titleModal">Informe Diario de Ventas</h5>
            </div>
            
            <div class="modal-body">
            </div>

        </div>
    </div>
</div>
