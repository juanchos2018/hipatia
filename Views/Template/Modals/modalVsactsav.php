<!-- Modal -->
<div class="modal fade" id="modalformVsactsav" name="modalformVsactsav" tabindex="-1" role="dialog" data-keyboard="false" data-backdrop="static" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header headerRegister">
                <h5 class="modal-title" id="titleModal">Registrar Calificaciones</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            
            <div class="modal-body">
                <form id="formVsactsav" name="formVsactsav">
                <p class="text-primary">Campos con asterisco * son obligatorios</p>

                <!-- Sección -->
                <div class="row">
                    <div class="form-group col-md-12">
                        <label for="listSec_no">Sección *</label>
                        <select class="form-control" data-live-search="true" data-size="5" id="listSec_no" name="listSec_no" required="">
                        </select> 
                    </div>
                </div>

                <!-- Asignatura -->
                <div class="row">
                    <div class="form-group col-md-12">
                        <label for="listMat_no">Asignatura *</label>
                        <select class="form-control" data-live-search="true" data-size="5" id="listMat_no" name="listMat_no" required="">
                        </select>
                    </div>
                </div>

                <!-- Año Lectivo y Periodo -->
                <div class="row">
                    <div class="form-group col-md-4">
                        <label for="listCaltyp">Tipo Calificación *</label>
                        <select class="form-control selectpicker" onchange="fntGetParci0();" id="listCaltyp" name="listCaltyp" required="">
                                <option value="" selected>Seleccione</option>
                                <option value="1">Actividades</option>
                                <option value="2">Parciales</option>
                        </select>
                    </div>
                    <div class="form-group col-md-4">
                        <label for="listPerios">Año Lectivo *</label>
                        <input class="form-control" id="listPerios" name="listPerios" type="number" min="0" max="9999" required="">
          		    </div>
                    <div class="form-group col-md-4">
                        <label for="listParci0">Periodo *</label>
                        <select class="form-control " data-live-search="true" data-size="5" id="listParci0" name="listParci0" required="">
  			    		</select>
        		    </div>
       		    </div>

                <div class="modal-footer">
                    <button id="btnPrnActSav" class="btn btn-success" type="button"><i class="fa fa-fw fa-lg fa-check-circle"></i>Aceptar</button>&nbsp;&nbsp;&nbsp;
                    <button class="btn btn-danger" type="button" data-dismiss="modal"><i class="fa fa-fw fa-lg fa-times-circle"></i>Cancelar</button>
                </div> 

                </form>
            </div>
        </div>
    </div>
</div>


<!-- Modal para Acta Calificaciones -->
<div class="modal fade" id="modvsActSav" name="modvsActSav" tabindex="-1" role="dialog" data-keyboard="false" data-backdrop="static" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-scrollable" role="document">
        <div class="modal-content">
            <div class="modal-header headerRegister">
                <h5 class="modal-title" id="titleModal">Registro Acta Calificaciones</h5>
            </div>
            
            <div class="modal-body">
            </div>

        </div>
    </div>
</div>
