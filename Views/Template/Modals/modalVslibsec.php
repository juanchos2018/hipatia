<!-- Modal -->
<div class="modal fade" id="modalformVslibsec" name="modalFormVslibsec" tabindex="-1" role="dialog" data-keyboard="false" data-backdrop="static" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header headerRegister">
                <h5 class="modal-title" id="titleModal">Boletin por Sección</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            
            <div class="modal-body">
                <form id="formVslibsec" name="formVslibsec">
                <p class="text-primary">Campos con asterisco * son obligatorios</p>

                <!-- Sección -->
                <div class="row">
                    <div class="form-group col-md-12">
                        <label for="listSec_no">Sección *</label>
                        <select class="form-control" data-live-search="true" data-size="5" id="listSec_no" name="listSec_no" required="">
                        </select>
                    </div>
                </div>

                <!-- Año Lectivo y Periodo -->
                <div class="row">
                    <div class="form-group col-md-6">
                        <label for="listPerios">Año Lectivo *</label>
                        <input class="form-control" id="listPerios" name="listPerios" type="number" min="0" max="9999" required="">
          		    </div>
                    <div class="form-group col-md-6">
                        <label for="listParci2">Periodo *</label>
                        <select class="form-control selectpicker" data-size="5" id="listParci2" name="listParci2" required="">
                                <option value="" selected>Seleccione</option>
        						<option value="Q1P1PR">1º Quimestre - 1º Parcial</option>
    	    					<option value="Q1P2PR">1º Quimestre - 2º Parcial</option>
<!--       	    				<option value="Q1P3PR">1º Quimestre - 3º Parcial</option> -->
		    	    			<option value="Q1_PRO">1º Quimestre</option>
			    	    		<option value="Q2P1PR">2º Quimestre - 1º Parcial</option>
				    	    	<option value="Q2P2PR">2º Quimestre - 2º Parcial</option>
<!--				    	    <option value="Q2P3PR">2º Quimestre - 3º Parcial</option> -->
   							    <option value="Q2_PRO">2º Quimestre</option>
        						<option value="PROFIN">Promedio Final</option>
    		    		</select>
        		    </div>
       		    </div>

                <div class="modal-footer">
                    <button id="btnPrnLibSec" class="btn btn-success" type="button"><i class="fa fa-fw fa-lg fa-check-circle"></i>Aceptar</button>&nbsp;&nbsp;&nbsp;
                    <button class="btn btn-danger" type="button" data-dismiss="modal"><i class="fa fa-fw fa-lg fa-times-circle"></i>Cancelar</button>
                </div> 

                </form>
            </div>
        </div>
    </div>
</div>


<!-- Modal para Boletin por Seccion -->
<div class="modal fade" id="modSecBoletin" name="modSecBoletin" tabindex="-1" role="dialog" data-keyboard="false" data-backdrop="static" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header headerRegister">
                <h5 class="modal-title" id="titleModal">Impresión Boletín por Sección</h5>
            </div>
            
            <div class="modal-body">
            </div>

        </div>
    </div>
</div>
