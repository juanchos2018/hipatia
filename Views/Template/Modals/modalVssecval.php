<!-- Modal -->
<div class="modal fade" id="modalformVssecval" name="modalFormVssecval" tabindex="-1" role="dialog" data-keyboard="false" data-backdrop="static" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered" role="document">
        <div id="divLoading">
            <div>
                <img src="<?= media(); ?>images/ajax-loader.gif" alt="Loading">
            </div>
        </div>
        <div class="modal-content">
            <div class="modal-header headerRegister">
                <h5 class="modal-title" id="titleModal">Nuevo Valor por Servicio</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div> 


            <div class="modal-body">
                <form id="formVssecval" name="formVssecval">
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

                <!-- Artículo -->
                <div class="row">
                    <div class="form-group col-md-12">
                        <label for="listArt_no">Artículo *</label>
                        <select class="form-control" data-live-search="true" data-size="5" id="listArt_no" name="listArt_no" required="">
                        </select>
                    </div>
                </div>

                <!-- Precio -->
                <div class="row">
                    <div class="form-group col-md-6">
                        <label for="txtValors">Precio Lista *</label>
                        <input class="form-control" id="txtValors" name="txtValors" type="number" step="0.01" min="0" value="0" required="">
                    </div>
                    <div class="form-group col-md-6">
                        <label for="listPerios">Año Lectivo *</label>
                        <input class="form-control" id="listPerios" name="listPerios" type="number" min="0" max="9999" required="">
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
