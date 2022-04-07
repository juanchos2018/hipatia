<!-- Modal -->
<div class="modal fade" id="modalformVsnotify" name="modalFormVsnotify" tabindex="-1" role="dialog" data-keyboard="false" data-backdrop="static" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered modal-lg" role="document">
        <div id="divLoading">
            <div>
                <img src="<?= media(); ?>images/ajax-loader.gif" alt="Loading">
            </div>
        </div>
        <div class="modal-content">
            <div class="modal-header headerRegister">
                <h5 class="modal-title" id="titleModal">Registrar Notificación</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            
            <div class="modal-body">
                <form id="formVsnotify" name="formVsnotify">
                <!-- boton oculto -->
                <input type="hidden" id="idSec_id" name="idSec_id" value="">
                <input type="hidden" id="txtHorreg" name="txtHorreg" value="">
                <input type="hidden" id="listEmp_no" name="listEmp_no" value="">
                 
                <p class="text-primary">Campos con asterisco * son obligatorios. ----- Campos en celeste son editables.</p>

                <!-- Año y Fecha -->
                <div class="row">
                    <div class="form-group col-md-6">
                        <label for="listPerios">Año Lectivo *</label>
                        <input class="form-control" id="listPerios" name="listPerios" type="number" min="0" max="9999" required="">
                		</div>
                    <div class="form-group col-md-6">
                        <label for="datFecreg">Fecha *</label>
                        <input class="form-control" id="datFecreg" name="datFecreg" type="date" required="">
                    </div>
             		</div>

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

                <!-- Estudiante -->
                <div class="row">
                    <div class="form-group col-md-12">
                        <label for="listStd_no">Estudiante (En blanco todos)</label>
                        <select class="form-control" data-live-search="true" data-size="5" id="listStd_no" name="listStd_no">
                        </select>
                    </div>
                </div>

                <!-- Agenda -->
                <div class="row">
                    <div class="form-group col-md-12">
                        <label for="txtSchedu">Descripción de la Notificación *</label>
                        <textarea class="form-control" id="txtSchedu" name="txtSchedu" rows="3" type="text" maxlength="250" required=""></textarea>
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
<!-- ++++++++ Modal: ViewVsnotify +++++++++ -->
<!-- -------------------------------------- -->
<div class="modal fade" id="modalViewVsnotify" tabindex="-1" role="dialog" data-keyboard="false" data-backdrop="static" -hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-md" role="document">
    <div class="modal-content">
      <div class="modal-header header-primary">
        <h5 class="modal-title" id="titleModal">Detalle de Notificación</h5>
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
                  <td class="text-right">Fecha:</td>
                  <td id="cellFechaInicio"></td>
                </tr>

                <tr>
                  <td class="text-right">Notificación:</td>
                  <td id="cellDescripcion"></td>
                </tr>
                <tr>

                <td class="text-right">Año Lectivo:</td>
                  <td id="cellAnioLectivo"></td>
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


<!-- Modal para Reclamos -->
<div class="modal fade" id="modalformVsnotstd" name="modalFormVsnotstd" tabindex="-1" role="dialog" data-keyboard="false" data-backdrop="static" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered modal-lg" role="document">
        <div id="divLoading">
            <div>
                <img src="<?= media(); ?>images/ajax-loader.gif" alt="Loading">
            </div>
        </div>
        <div class="modal-content">
            <div class="modal-header headerRegister">
                <h5 class="modal-title" id="titleModal">Nuevo Reclamo</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            
            <div class="modal-body">
                <form id="formVsnotstd" name="formVsnotstd">
                <!-- boton oculto -->
                <input type="hidden" id="idSec_id" name="idSec_id" value="">
                <input type="hidden" id="txtHorreg" name="txtHorreg" value="">
                <input type="hidden" id="listEmp_no" name="listEmp_no" value="">
                 
                <p class="text-primary">Campos con asterisco * son obligatorios. ----- Campos en celeste son editables.</p>

                <!-- Año y Fecha -->
                <div class="row">
                    <div class="form-group col-md-6">
                        <label for="listPerio2">Año Lectivo *</label>
                        <input class="form-control" id="listPerio2" name="listPerio2" type="number" min="0" max="9999" required="">
                		</div>
                    <div class="form-group col-md-6">
                        <label for="datFecre2">Fecha *</label>
                        <input class="form-control" id="datFecre2" name="datFecre2" type="date" required="">
                    </div>
           		</div>

                <!-- Estudiante -->
                <div class="row">
                    <div class="form-group col-md-12">
                        <label for="listStd_n3">Estudiante *</label>
                        <select class="form-control" data-live-search="true" data-size="5" id="listStd_n3" name="listStd_n3" required="">
                        </select>
                    </div>
                </div>

                <!-- Asignatura -->
                <div class="row">
                    <div class="form-group col-md-12">
                        <label for="listMat_n3">Asignatura *</label>
                        <select class="form-control" data-live-search="true" data-size="5" id="listMat_n3" name="listMat_n3" required="">
                        </select>
                    </div>
                </div>

                <!-- Agenda -->
                <div class="row">
                    <div class="form-group col-md-12">
                        <label for="txtSchedu">Descripción del Reclamo *</label>
                        <textarea class="form-control" id="txtSchedu" name="txtSchedu" rows="3" type="text" maxlength="250" required=""></textarea>
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
