<!-- Modal -->
<div class="modal fade" id="modalformVscolect" name="modalformVscolect" tabindex="-1" role="dialog" data-keyboard="false" data-backdrop="static" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header headerRegister">
                <h5 class="modal-title" id="titleModal">Interfas Externa</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            
            <div class="modal-body">
                <form id="formVscolect" name="formVscolect">
                <p class="text-primary">Campos con asterisco * son obligatorios</p>

                <!-- Estudiante -->
                <div class="row">
                    <div class="form-group col-md-6">
                        <label for="listStd_no">Estudiante (En blanco todos)</label>
                        <select class="form-control" data-live-search="true" data-size="5" id="listStd_no" name="listStd_no">
                        </select>
                    </div>
                    <div class="form-group col-md-6">
                        <label for="listPerios">Año Lectivo *</label>
                        <input class="form-control" id="listPerios" name="listPerios" type="number" min="0" max="9999" required="">
                    </div>
                </div>

                <!-- Periodo -->
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="listAbotyp">Tipo de Corte *</label>
                            <select class="form-control selectpicker" id="listAbotyp" name="listAbotyp" required="">
                                    <option value="1">Acumulado</option>
                                    <option value="2">Corriente</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="listPer_no">Periodo *</label>
                            <select class="form-control" data-live-search="true" data-size="5" id="listPer_no" name="listPer_no" required="">
                            </select>
                        </div>
                    </div>
                </div>


                <div class="modal-footer">
                    <button id="btnActionForm" class="btn btn-primary" type="submit"><i class="fa fa-fw fa-lg fa-check-circle"></i><span id="btnText">Enviar</span></button>&nbsp;&nbsp;&nbsp;
                    <button class="btn btn-danger" type="button" data-dismiss="modal"><i class="fa fa-fw fa-lg fa-times-circle"></i>Cancelar</button>
                </div> 

                </form>
            </div>
        </div>
    </div>
</div>
