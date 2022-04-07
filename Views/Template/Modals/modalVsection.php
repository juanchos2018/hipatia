<!-- Modal -->
<div class="modal fade" id="modalformVsection" name="modalFormVsection" tabindex="-1" role="dialog" data-keyboard="false" data-backdrop="static" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header headerRegister">
                <h5 class="modal-title" id="titleModal">Nueva Sección</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            
            <div class="modal-body">
                <form id="formVsection" name="formVsection">
                <input type="hidden" id="idSec_no" name="idSec_no" value="">
                <p class="text-primary">Campos con asterisco * son obligatorios</p>

                <!-- Area de Estudio y NIvel -->
                <div class="row">
                    <div class="form-group col-md-6">
                        <label for="listPabell">Pabellon *</label>
                        <select class="form-control selectpicker" id="listPabell" name="listPabell" required="">
                                <option value="" selected>Seleccione</option>
                                <option value="0">Inicial</option>
                                <option value="1">Básica Elemental</option>
                                <option value="2">Básica Media</option>
                                <option value="3">Básica Superior</option>
                                <option value="4">Bachillerato</option>
                        </select>
                    </div>
                    <div class="form-group col-md-6">
                        <label for="listNiv_no">Nivel *</label>
                        <select class="form-control selectpicker" data-size="5" id="listNiv_no" name="listNiv_no" required="">
                                <option value="" selected>Seleccione</option>
                                <option value="1">Inicial-1</option>
                                <option value="2">Inicial-2</option>
                                <option value="10">Primero de Básica</option>
                                <option value="20">Segundo de Básica</option>
                                <option value="30">Tercero de Básica</option>
                                <option value="40">Cuarto de Básica</option>
                                <option value="50">Quinto de Básica</option>
                                <option value="60">Sexto de Básica</option>
                                <option value="70">Séptimo de Básica</option>
                                <option value="80">Octavo de Básica</option>
                                <option value="90">Noveno de Básica</option>
                                <option value="91">Décimo de Básica</option>
                                <option value="92">UnDécimo de Básica</option>
                                <option value="93">Primero de Bachillerato</option>
                                <option value="94">Segundo de Bachillerato</option>
                                <option value="95">Tercero de Bachillerato</option>
                        </select>
                    </div>
                </div>

                <!-- Nombre de Sección -->
                <div class="row">
                    <div class="form-group col-md-12">
                        <label for="txtSec_nm">Nombre Sección * </label>
                        <input class="form-control" id="txtSec_nm" name="txtSec_nm" type="text" placeholder="*" maxlength="100" required="">
                    </div>
                </div>

                <!-- Paralelo y Modalidad -->
                <div class="row">
                    <div class="form-group col-md-6">
                        <label for="txtParale">Paralelo * </label>
                        <input class="form-control" id="txtParale" name="txtParale" type="text" placeholder="*" maxlength="10" required="">
                    </div>
                    <div class="form-group col-md-6">
                        <label for="listModoes">Modalidad *</label>
                        <select class="form-control selectpicker" id="listModoes" name="listModoes" required="">
                                <option value="" selected>Seleccione</option>
                                <option value="1">Quimestral</option>
                                <option value="2">Trimestral</option>
                                <option value="3">Semestral</option>
                        </select>
                    </div>
                </div>

                <!-- Régimen y Jornada -->
                <div class="row">
                    <div class="form-group col-md-6">
                        <label for="listRegime">Régimen *</label>
                        <select class="form-control selectpicker" id="listRegime" name="listRegime" required="">
                                <option value="" selected>Seleccione</option>
                                <option value="1">Sierra</option>
                                <option value="2">Costa</option>
                        </select>
                    </div>
                    <div class="form-group col-md-6">
                        <label for="listJor_no">Jornada *</label>
                        <select class="form-control selectpicker" id="listJor_no" name="listJor_no" required="">
                                <option value="" selected>Seleccione</option>
                                <option value="1">Matutina</option>
                                <option value="2">Vespertina</option>
                                <option value="3">Nocturna</option>
                        </select>
                    </div>
                </div>

                <!-- Sección inmediato superior -->
                <div class="row">
                    <div class="form-group col-md-12">
                        <label for="listSec_n2">Sección Inmediato Superior</label>
                        <select class="form-control" data-live-search="true" data-size="5" id="listSec_n2" name="listSec_n2">
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
s