<!-- Modal -->
<div class="modal fade" id="modalformVscersec" name="modalFormVscersec" tabindex="-1" role="dialog" data-keyboard="false" data-backdrop="static" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header headerRegister">
                <h5 class="modal-title" id="titleModal">Certificados por Sección</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            
            <div class="modal-body">
                <form id="formVscersec" name="formVscersec">
                <p class="text-primary">Campos con asterisco * son obligatorios</p>

                <!-- Sección -->
                <div class="row">
                    <div class="form-group col-md-12">
                        <label for="listSec_no">Sección *</label>
                        <select class="form-control" data-live-search="true" data-size="5" id="listSec_no" name="listSec_no" required="">
                        </select>
                    </div>
                </div>

                <!-- Tipo -->
                <div class="row">
                    <div class="form-group col-md-12">
                        <label for="listCertip">Tipo Certificado *</label>
                        <select class="form-control selectpicker" id="listCertip" name="listCertip" required="">
 	    						<option value="1">Matrícula</option>
	    	    				<option value="2">Promoción</option>
   			    		</select>
	        		</div>
           		</div>

                <!-- Año Lectivo y Fecha -->
                <div class="row">
                    <div class="form-group col-md-6">
                        <label for="listPerios">Año Lectivo *</label>
                        <input class="form-control" id="listPerios" name="listPerios" type="number" min="0" max="9999" required="">
                    </div>
                    <div class="form-group col-md-6">
                        <label for="datFecreg">Fecha Certificado *</label>
                        <input class="form-control" id="datFecreg" name="datFecreg" type="date" placeholder="">
                    </div>
                </div>

                <div class="modal-footer">
                    <button id="btnPrnCerSec" class="btn btn-success" type="button"><i class="fa fa-fw fa-lg fa-check-circle"></i>Aceptar</button>&nbsp;&nbsp;&nbsp;
                    <button class="btn btn-danger" type="button" data-dismiss="modal"><i class="fa fa-fw fa-lg fa-times-circle"></i>Cancelar</button>
                </div> 

                </form>
            </div>
        </div>
    </div>
</div>


<!-- Modal para Certificado por Seccion -->
<div class="modal fade" id="modSecCer" name="modSecCer" tabindex="-1" role="dialog" data-keyboard="false" data-backdrop="static" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header headerRegister">
                <h5 class="modal-title" id="titleModal">Impresión Certificado por Sección</h5>
            </div>
            
            <div class="modal-body">
            </div>

        </div>
    </div>
</div>
