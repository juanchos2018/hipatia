<!-- Modal -->
<div class="modal fade" id="modalformVsabsent" name="modalFormVsabsent" tabindex="-1" role="dialog" data-keyboard="false" data-backdrop="static" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered modal-lg" role="document">
        <div id="divLoading">
            <div>
                <img src="<?= media(); ?>images/ajax-loader.gif" alt="Loading">
            </div>
        </div>
        <div class="modal-content">
            <div class="modal-header headerRegister">
                <h5 class="modal-title" id="titleModal">Registrar Asistencia</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            
            <div class="modal-body">
                <form id="formVsabsent" name="formVsabsent">
                <!-- boton oculto -->
                <input type="hidden" id="idSec_id" name="idSec_id" value="">
                <input type="hidden" id="listEmp_no" name="listEmp_no" value="">

                <p class="text-primary">Campos con asterisco * son obligatorios</p>

                <!-- Año y Fecha -->
                <div class="row">
                    <div class="form-group col-md-6">
                        <label for="listPerios">Año Lectivo *</label>
                        <input class="form-control" id="listPerios" name="listPerios" type="number" min="0" max="9999" required="">
                    </div>
                    <div class="form-group col-md-6">
                        <label for="datFecreg">Fecha Asistencia *</label>
                        <input class="form-control" id="datFecreg" name="datFecreg" type="date" placeholder="" required="">
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
                        <select class="form-control" onchange="fntStdList2();" data-live-search="true" data-size="5" id="listMat_no" name="listMat_no" required="">
                        </select>
                    </div>
                </div>

                <!-- Estudiantes a Seleccionar  -->
                 <div class="row">
                     <div class="form-group col-md-12">
                        <label for="listStd_n2">Estudiantes * (Marcar solo Estudiantes faltantes)</label>
                        <select class="form-control" title="Escoger Estudiantes" multiple="" data-size="5" data-selected-text-format="count > 2" data-live-search="true" id="listStd_n2" name="listStd_n2[]" required="">
                        </select>
                    </div>
                </div>  

                <!-- Periodo y Tipo de Falta -->
                <div class="row">
                    <div class="form-group col-md-6">
                        <label for="listParcia">Periodo *</label>
                        <select class="form-control" id="listParcia" name="listParcia" required="">
                        </select>
                    </div>
                    <div class="form-group col-md-6">
                        <label for="listAbstip">Tipo de Falta *</label>
                        <select class="form-control selectpicker" id="listAbstip" name="listAbstip" required="">
                            <option value="" selected>Seleccione</option>
                            <option value="1">Falta InJustificada</option>
                            <?php
                                $rol = $_SESSION['userData']['rol_id'];
                                if($rol != 5)
                                {
                            ?>
                            <option value="2">Falta Justificada</option>
                            <?php } ?>
                            <option value="3">Atraso</option>
                        </select>
                    </div>
                </div>

                <!-- Justificación -->
                <div class="row">
                    <div class="form-group col-md-12">
                        <label for="txtSchedu">Justificación de Inasistencia</label>
                        <textarea class="form-control" id="txtSchedu" name="txtSchedu" rows="2" type="text" maxlength="250"></textarea>
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
