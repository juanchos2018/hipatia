<!-- Modal -->
<div class="modal fade" id="modalformVshorary" name="modalFormVshorary" tabindex="-1" role="dialog" data-keyboard="false" data-backdrop="static" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered" role="document">
        <div id="divLoading">
            <div>
                <img src="<?= media(); ?>images/ajax-loader.gif" alt="Loading">
            </div>
        </div>
        <div class="modal-content">
            <div class="modal-header headerRegister">
                <h5 class="modal-title" id="titleModal">Nuevo Horario</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div> 


            <div class="modal-body">
                <form id="formVshorary" name="formVshorary">
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

                <!-- Dia de la Semana -->
                <div class="row">
                    <div class="form-group col-md-6">
                        <label for="listDaynum">Dia *</label>
                        <select class="form-control selectpicker" id="listDaynum" name="listDaynum" required="">
                                <option value="" selected>Seleccione</option>
                                <option value="1">Lunes</option>
                                <option value="2">Martes</option>
                                <option value="3">Miercoles</option>
                                <option value="4">Jueves</option>
                                <option value="5">Viernes</option>
                        </select>
                    </div>
                    <div class="form-group col-md-6">
                        <label for="listHornum">Hora *</label>
                        <select class="form-control selectpicker" id="listHornum" name="listHornum" required="">
                                <option value="" selected>Seleccione</option>
                                <option value="1">1º Hora</option>
                                <option value="2">2º Hora</option>
                                <option value="3">3º Hora</option>
                                <option value="4">4º Hora</option>
                                <option value="5">5º Hora</option>
                                <option value="6">6º Hora</option>
                                <option value="7">7º Hora</option>
                                <option value="8">8º Hora</option>
                                <option value="9">9º Hora</option>
                        </select>
                    </div>
                </div>

                <!-- Año -->
                <div class="row">
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
