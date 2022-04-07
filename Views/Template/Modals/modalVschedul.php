<!-- Modal -->
<div class="modal fade" id="modalformVschedul" name="modalformVschedul" tabindex="-1" role="dialog" data-keyboard="false" data-backdrop="static" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered modal-lg" role="document">
        <div id="divLoading">
            <div>
                <img src="<?= media(); ?>images/ajax-loader.gif" alt="Loading">
            </div>
        </div>
        <div class="modal-content">
            <div class="modal-header headerRegister">
                <h5 class="modal-title" id="titleModal">Registrar Actividad</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            
            <div class="modal-body">
                <form id="formVschedul" name="formVschedul" autocomplete="off">
                <!-- boton oculto -->
                <input type="hidden" id="idSec_id" name="idSec_id" value="">
                <input type="hidden" id="txtHorreg" name="txtHorreg" value="">
                <input type="hidden" id="listEmp_no" name="listEmp_no" value="">
                <input type="hidden" id="txtNameTask" name="txtNameTask" value="">
                 
                <p class="text-primary">Campos con asterisco * son obligatorios. ----- Campos en celeste son editables.</p>

                <div class="row">
                    <div class="form-group col-md-4">
                        <label class="listPerios">Año Lectivo *</label>
                        <input class="form-control" id="listPerios" name="listPerios" type="number" min="0" max="9999" required="">
                    </div>
                    <div class="form-group col-md-4">
                        <label class="datFecreg">Fecha Envío Actividad *</label>
                        <input class="form-control" id="datFecreg" name="datFecreg" type="date" required="">
                    </div>
                    <div class="form-group col-md-4">
                        <label class="datFecmax">Fecha Cumplimiento Actividad *</label>
                        <input class="form-control" id="datFecmax" name="datFecmax" type="date" required="">
                    </div>
                </div>

                <!-- Agenda -->
                <div class="row">
                    <div class="form-group col-md-12">
                        <label for="txtSchedu">Descripción de la Actividad *</label>
                        <textarea class="form-control" id="txtSchedu" name="txtSchedu" rows="3" type="text" maxlength="250" required=""></textarea>
                    </div>
                </div>

                <!-- Sección -->
                <div class="row">
                    <div class="form-group col-md-12">
                        <label for="listSec_no">Sección *</label>
                        <select class="form-control" data-size="5" multiple="" data-live-search="true" id="listSec_no" name="listSec_no[]" required="">
                        </select> 
                    </div>
                </div>

                <!-- Asignatura -->
                <div class="row">
                    <div class="form-group col-md-12">
                        <label for="listMat_no">Asignatura *</label>
                        <select class="form-control" onchange="fntStdList();" data-size="5" data-live-search="true" id="listMat_no" name="listMat_no" required="">
                        </select>
                    </div>
                </div>

                <!-- Estudiante -->
                <div class="row">
                    <div class="form-group col-md-12">
                        <label for="listStd_no">Estudiante * (En blanco todos)</label>
                        <select class="form-control" data-size="5" data-live-search="true" id="listStd_no" name="listStd_no">
                        </select>
                    </div>
                </div>

                <!-- Calificación y Periodo -->
                <div class="row">
                    <div class="form-group col-md-6">
                        <label for="listParcia">Periodo *</label>
                        <select class="form-control" data-size="5" id="listParcia" name="listParcia" required="">
                        </select>
                    </div>
                    <div class="form-group col-md-6">
                        <label for="txtPuntaj">Calificación *</label>                  
                        <input class="form-control" id="txtPuntaj" name="txtPuntaj" type="number" value="0" min="0" step="0.01" required="">
                    </div>
                </div>

                <!-- Insumo y Vínculo Video -->
                <div class="row">
                    <div class="form-group col-md-6">
                        <label for="listInsumo">Insumo *</label>
                        <select class="form-control" data-size="5" id="listInsumo" name="listInsumo" required="">
                        </select>
                    </div>
                    <div class="form-group col-md-6">
                        <label for="txtVdlink">Vínculo Video</label>
                        <input class="form-control" id="txtVdlink" name="txtVdlink" type="text" placeholder="" maxlength="100">
                    </div>
                </div>

                <div class="row">
                    <!-- Seccion para Previsualizacion -->
                    <div class="form-group col-md-6"> 
                        <label for="flActividad" class="text-primary">SubirActividad</label>
                        <input class="form-control-file" id="flActividad" name="flActividad" type="file" accept=".doc,.docx,application/msword,.pdf,application/vnd.openxmlformats-officedocument.spreadsheetml.sheet,.mp4,.webm">
                        
                        <!-- Area para Previsualizar el Archivo -->
                        <div class="prevFile">
                            <span class="delFile notBlock"><i class="fas fa-trash-alt"></i></span>
                            <div id="visorArchivo"></div>    
                        </div>  
                    </div>

                    <!-- Seccion para Notificar Actividad Actual -->
                    <div class="form-group col-md-6">
                        <div class="prevTask">
                            <label class="lblTask notBlock text-primary mb-0">Actividad Actual</label><br>
                            <label class="lblNameTask notBlock" style="background-color: #E9E4F0"></label><br><br>
                            <label class="lblTaskStd notBlock text-danger mb-0">Tarea Estudiante</label><br>
                            <label class="lblNameTaskStd notBlock"></label>
                        </div>
                    </div>
                </div>

                <!-- Mensaje DOCENTE -> ESTUDIANTE relacionado con la ACTIVIDAD EDITADA -->
                <div class="row">
                    <div class="form-group col-md-12">
                        <label for="txtMessag">Mensaje para Estudiante</label>
                        <textarea class="form-control" id="txtMessag" name="txtMessag" rows="2" type="text" maxlength="250"></textarea>
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


<!-- ------------------------------------- -->
<!-- ++++++++ Modal: ViewSchedul +++++++++ -->
<!-- ------------------------------------- -->
<div class="modal fade" id="modalViewSchedul" tabindex="-1" role="dialog" data-keyboard="false" data-backdrop="static" -hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-md" role="document">
    <div class="modal-content">
      <div class="modal-header header-primary">
        <h5 class="modal-title" id="titleModal">Detalle de la Actividad</h5>
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
                  <td class="text-right">Fecha Inicio:</td>
                  <td id="cellFechaInicio"></td>
                </tr>

                <tr>
                  <td class="text-right" style="color:blue">Fecha Máxima:</td>
                  <td id="cellFechaMaxima"></td>
                </tr>

                <tr>
                  <td class="text-right">Nombre del Insumo:</td>
                  <td id="cellInsumo"></td>
                </tr>

                <tr>
                  <td class="text-right">Calificación:</td>
                  <td id="cellCalificacion"></td>
                </tr>

                <tr>
                  <td class="text-right">Periodo:</td>
                  <td id="cellPeriodo"></td>
                </tr>

                <tr>
                  <td class="text-right">Actividad:</td>
                  <td id="cellDescripcion"></td>
                </tr>

                <tr>
                  <td class="text-right">Link Video:</td>
                  <td id="cellLinkVideo"></td>
                </tr>

                <tr>
                  <td class="text-right">Año Lectivo:</td>
                  <td id="cellAnioLectivo"></td>
                </tr>

                <tr>
                  <td class="text-right text-primary">Archivo subido por Docente:</td>
                  <td id="cellActividad"></td>
                </tr>

                <tr>
                  <td class="text-right text-danger">Archivo subido por Estudiante:</td>
                  <td id="cellTareaStd"></td>
                </tr>

              </tbody>
          </table>

          <!-- Seccion para Previsualizacion -->
            <form id="formViewStd">
                <input type="hidden" id="secTaskStd" name="secTaskStd" value="">
                <div class="row">
                  <div class="form-group col-md-6"> 
                    <label for="flTaskStd" class="text-primary">Tarea del Estudiante</label>
                    <input class="form-control-file" id="flTaskStd" name="flTaskStd" type="file" accept=".doc,.docx,application/msword,.pdf,application/vnd.openxmlformats-officedocument.spreadsheetml.sheet,.mp4,.webm">
                    
                    <!-- Area para Previsualizar el Archivo -->
                    <div class="prevFlTask">
                        <span class="delFlTask notBlock"><i class="fas fa-trash-alt"></i></span>
                        <div id="visorFlTask"></div>    
                    </div>
                    <button class="btn btn-outline-success btn-sm mt-1" id="btnTaskStd" type="button" onclick="fntSubirTarea()"><i class="fas fa-upload"></i></button>
                  </div>
                </div>
            </form>
      </div>
      <div class="modal-footer">
          <button class="btn btn-danger" type="button" data-dismiss="modal"><i class="fa fa-fw fa-lg fa-times-circle"></i>Cancelar</button>
      </div>
    </div>
  </div>
</div>

