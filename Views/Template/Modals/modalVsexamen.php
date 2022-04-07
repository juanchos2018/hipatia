<!-- Modal -->
<div class="modal fade" id="modalformVsexamen" name="modalformVsexamen" tabindex="-1" role="dialog" data-keyboard="false" data-backdrop="static" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header headerRegister">
                <h5 class="modal-title" id="titleModal">Registrar Examen</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            
            <div class="modal-body">
                <form id="formVsexamen" name="formVsexamen" autocomplete="off">
                <!-- boton oculto -->
                <input type="hidden" id="idSec_id" name="idSec_id" value="">
                <input type="hidden" id="txtHorini" name="txtHorini" value="">
                <input type="hidden" id="listEmp_no" name="listEmp_no" value="">
                <p class="text-primary">Campos con asterisco * son obligatorios</p>

                <!-- Sección -->
                <div class="row">
                    <div class="form-group col-md-12">
                        <label for="listSec_no">Sección *</label>
                        <select class="form-control fs_seccion" data-live-search="true" data-size="5" id="listSec_no" name="listSec_no" required="">
                        </select> 
                    </div>
                </div>

                <!-- Asignatura -->
                <div class="row">
                    <div class="form-group col-md-12">
                        <label for="listMat_no">Asignatura *</label>
                        <select class="form-control" onchange="fntStdList();" data-live-search="true" data-size="5" id="listMat_no" name="listMat_no" required="">
                        </select>
                    </div>
                </div>

                <!-- Estudiante -->
                <div class="row">
                    <div class="form-group col-md-12">
                        <label for="listStd_no">Estudiante * (En blanco todos)</label>
                        <select class="form-control" data-size="6" data-live-search="true" data-size="5" id="listStd_no" name="listStd_no">
                        </select>
                    </div>
                </div>

                <!-- Fechas -->
                <div class="row">
                    <div class="form-group col-md-6">
                        <label for="datFecreg">Fecha Registro *</label>
                        <input class="form-control" id="datFecreg" name="datFecreg" type="date" required="">
                    </div>
                    <div class="form-group col-md-6">
                        <label for="datFecini">Fecha Exámen *</label>
                        <input class="form-control" id="datFecini" name="datFecini" type="date" required="">
                    </div>
                </div>

                <!-- Calificación y Periodo -->
                <div class="row">
                    <div class="form-group col-md-6">
                        <label for="listParcia">Periodo *</label>
                        <select class="form-control" id="listParcia" name="listParcia" required="">
                        </select>
                    </div>
                    <div class="form-group col-md-6">
                        <label for="listPerios">Año Lectivo *</label>
                        <input class="form-control" id="listPerios" name="listPerios" type="number" min="0" max="9999" required="">
                    </div>
                </div>

                <!-- Preguntas y Respuestas -->
                <div class="row">
                    <div class="form-group col-md-12">
                        <label for="txtSchedu">Descripción de la Pregunta *</label>
                        <textarea class="form-control" id="txtSchedu" name="txtSchedu" rows="2" type="text" placeholder="*" maxlength="250" required=""></textarea>
                    </div>
                    <div class="form-group col-md-12">
                        <label for="txtAnswe1">Respuesta 1</label>
                        <textarea class="form-control" id="txtAnswe1" name="txtAnswe1" rows="2" type="text" maxlength="250"></textarea>
                    </div>
                    <div class="form-group col-md-12">
                        <label for="txtAnswe2">Respuesta 2</label>
                        <textarea class="form-control" id="txtAnswe2" name="txtAnswe2" rows="2" type="text" maxlength="250"></textarea>
                    </div>
                    <div class="form-group col-md-12">
                        <label for="txtAnswe3">Respuesta 3</label>
                        <textarea class="form-control" id="txtAnswe3" name="txtAnswe3" rows="2" type="text" maxlength="250"></textarea>
                    </div>
                    <div class="form-group col-md-12">
                        <label for="txtAnswe4">Respuesta 4</label>
                        <textarea class="form-control" id="txtAnswe4" name="txtAnswe4" rows="2" type="text" maxlength="250"></textarea>
                    </div>
                    <div class="form-group col-md-12">
                        <label for="txtAnswe5">Respuesta 5</label>
                        <textarea class="form-control" id="txtAnswe5" name="txtAnswe5" rows="2" type="text" maxlength="250"></textarea>
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


<!-- -------------------------------------- -->
<!-- ++++++++ Modal: ViewVsexamen +++++++++ -->
<!-- -------------------------------------- -->

<div class="modal fade" id="modalViewVsexamen" tabindex="-1" role="dialog" data-keyboard="false" data-backdrop="static" -hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-md" role="document">
    <div class="modal-content">
      <div class="modal-header header-primary">
        <h5 class="modal-title" id="titleModal">Exámen Virtual</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>

      <div class="modal-body">
          <table class="table table-bordered table-striped">
            <tbody>
                <tr>
                  <td class="text-right">Sección:</td>
                  <td id="cellSeccion"></td>
                </tr>

                <tr>
                  <td class="text-right">Paralelo:</td>
                  <td id="cellParalelo"></td>
                </tr>

                <tr>
                  <td class="text-right">Asignatura:</td>
                  <td id="cellAsignatura"></td>
                </tr>

                <tr>
                  <td class="text-right">Estudiante:</td>
                  <td id="cellEstudiante"></td>
                </tr>

                <tr>
                  <td class="text-right" style="color:blue">Fecha Exámen:</td>
                  <td id="cellFechaMaxima"></td>
                </tr>

                <tr>
                  <td class="text-right">Periodo:</td>
                  <td id="cellPeriodo"></td>
                </tr>

                <tr>
                  <td class="text-right">Año Lectivo:</td>
                  <td id="cellAnioLectivo"></td>
                </tr>

                <tr>
                  <td class="text-right">Descripción Pregunta:</td>
                  <td id="cellDescripcion"></td>
                </tr>

            </tbody>
          </table>
      </div>
      <div class="modal-footer">
          <button class="btn btn-danger" type="button" data-dismiss="modal"><i class="fa fa-fw fa-lg fa-times-circle"></i>Cancelar</button>
      </div>
    </div>
  </div>
</div>

