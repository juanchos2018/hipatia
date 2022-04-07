<!-- Modal -->
<div class="modal fade" id="modalformVssecmat" name="modalFormVssecmat" tabindex="-1" role="dialog" data-keyboard="false" data-backdrop="static" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered" role="document">
        <div id="divLoading">
            <div>
                <img src="<?= media(); ?>images/ajax-loader.gif" alt="Loading">
            </div>
        </div>
        <div class="modal-content">
            <div class="modal-header headerRegister">
                <h5 class="modal-title" id="titleModal">Nuevo Reparto de Trabajo</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div> 


            <div class="modal-body">
                <form id="formVssecmat" name="formVssecmat">
                <!-- boton oculto -->
                <input type="hidden" id="idSec_id" name="idSec_id" value="">
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

                <!-- Docente -->
                <div class="row">
                    <div class="form-group col-md-12">
                        <label for="listEmp_no">Docente *</label>
                        <select class="form-control" data-live-search="true" data-size="5" id="listEmp_no" name="listEmp_no" required="">
                        </select>
                    </div>
                </div>

                <!-- Orden -->
                <div class="row">
                    <div class="form-group col-md-6">
                        <label for="txtOrders">Orden *</label>
                        <input class="form-control" id="txtOrders" name="txtOrders" type="number" min="0" max="50" value="0" required="">
                    </div>
                    <div class="form-group col-md-6">
                        <label for="listPerios">Año Lectivo *</label>
                        <input class="form-control" id="listPerios" name="listPerios" type="number" min="0" max="9999" required="">
                    </div>
                </div>

                <!-- Link Aula de Clase -->
                <div class="row">
                    <div class="form-group col-md-12">
                        <label for="txtClinks">Link Aula de Clase</label>
                        <input class="form-control" id="txtClinks" name="txtClinks" type="text" maxlength="100">
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
