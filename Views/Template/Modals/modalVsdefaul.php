<!-- Modal -->
<div class="modal fade" id="modalformVsdefaul" name="modalFormVsdefaul" tabindex="-1" role="dialog" data-keyboard="false" data-backdrop="static" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header headerRegister">
                <h5 class="modal-title" id="titleModal">Parámetros del Sistema</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            
            <div class="modal-body">
                <form id="formVsdefaul" name="formVsdefaul">
                <p class="text-primary">Campos con asterisco * son obligatorios</p>
                <input type="hidden" id="idSec_id" name="idSec_id" value="">

                <p class="text-info mb-0">PARÁMETROS INSTITUCIÓN</p>
                <hr class="mt-0">

                <!-- Códigos Institución -->
                <div class="row">
                    <div class="form-group col-md-6">
                        <label for="txtAmi_id">Código AMIE de Institución *</label>
                        <input class="form-control" id="txtAmi_id" name="txtAmi_id" type="text" maxlength="10" required="">
                    </div>
                    <div class="form-group col-md-6">
                        <label for="txtDistri">Código de Distrito *</label>
                        <input class="form-control" id="txtDistri" name="txtDistri" type="text" maxlength="10" required="">
                    </div>
                </div>

                <!-- Razón Social -->
                <div class="row">
                    <div class="form-group col-md-12">
                        <label for="txtRazons">Razón Social *</label>
                        <input class="form-control" id="txtRazons" name="txtRazons" type="text" placeholder="*" maxlength="100" required="">
                    </div>
                </div>
                        
                <!-- Rector y Secretaria -->
                <div class="row">
                    <div class="form-group col-md-6">
                        <label for="txtRector">Nombre Rector/a *</label>
                        <input class="form-control" id="txtRector" name="txtRector" type="text" required="">
                    </div>
                    <div class="form-group col-md-6">
                        <label for="txtSecret">Nombre Secretario/a *</label>
                        <input class="form-control" id="txtSecret" name="txtSecret" type="text" required="">
                    </div>
                </div>

                <!-- Dirección y Teléfonos -->
                <div class="row">
                    <div class="form-group col-md-6">
                        <label for="txtAddres">Dirección</label>
                        <textarea class="form-control" id="txtAddres" name="txtAddres" rows="2" type="text" maxlength="100"></textarea>
                    </div>
                    <div class="form-group col-md-6">
                        <label for="txtTphone">Teléfonos</label>
                        <textarea class="form-control" id="txtTphone" name="txtTphone" rows="2" type="text" maxlength="50"></textarea>
                    </div>
                </div>
                                    
                <!-- RUC y Correo Electrónico -->
                <div class="row">
                    <div class="form-group col-md-6">
                        <label for="txtRuc_no">Número R.U.C. *</label>
                        <input class="form-control" id="txtRuc_no" name="txtRuc_no" type="text" pattern="[a-zA-Z0-9-]{9,13}" required="">
                    </div>
                    <div class="form-group col-md-6">
                        <label for="txtEmails">Correo Electrónico Institución</label>
                        <input class="form-control" id="txtEmails" name="txtEmails" type="email" maxlength="100">
                    </div>
                </div>
                <hr>

                <!-- Parroquia y Ciudad -->
                <div class="row">
                    <div class="form-group col-md-6">
                        <label for="txtParroq">Parroquia</label>
                        <input class="form-control" id="txtParroq" name="txtParroq" type="text" maxlength="50">
                    </div>
                    <div class="form-group col-md-6">
                        <label for="txtCiudad">Ciudad</label>
                        <input class="form-control" id="txtCiudad" name="txtCiudad" type="text" maxlength="50">
                    </div>
                </div>

                <!-- Cantón y Provincia -->
                <div class="row">
                    <div class="form-group col-md-6">
                        <label for="txtCanton">Cantón</label>
                        <input class="form-control" id="txtCanton" name="txtCanton" type="text" maxlength="50">
                    </div>
                    <div class="form-group col-md-6">
                        <label for="txtProvin">Provincia</label>
                        <input class="form-control" id="txtProvin" name="txtProvin" type="text" maxlength="50">
                    </div>
                </div>

                <!-- Régimen y Sostenimiento -->
                <div class="row">
                    <div class="form-group col-md-6">
                        <label for="listRegime">Régimen *</label>
                        <select class="form-control selectpicker" id="listRegime" name="listRegime" required="">
                                <option value=""selected>Seleccione</option>
                                <option value="1">Sierra</option>
                                <option value="2">Costa</option>
                        </select>
                    </div>
                    <div class="form-group col-md-6">
                        <label for="listSosten">Sostenimiento *</label>
                        <select class="form-control selectpicker" id="listSosten" name="listSosten" required="">
                                <option value=""selected>Seleccione</option>
                                <option value="1">Fiscal</option>
                                <option value="2">Fiscomisional</option>
                                <option value="3">Municipal</option>
                                <option value="4">Particular Religioso</option>
                                <option value="5">Particular Laico</option>
                                <option value="6">Comunidad</option>
                        </select>
                    </div>
                </div>
                <hr>

                <p class="text-info mb-0">PARÁMETROS ACADÉMICOS</p>
                <hr class="mt-0">

                <!-- Número de Parciales por cada Quimestre -->
                <div class="row">
                    <div class="form-group col-md-6">
                        <label for="control-label">1º QUIMESTRE</label>
                    </div>
                </div>

                <div class="row">
                    <div class="form-group col-md-6">
                        <label for="txtQ1p1hd">Leyenda 1º Parcial</label>
                        <input class="form-control" id="txtQ1p1hd" name="txtQ1p1hd" type="text" maxlength="20">
                    </div>
                    <div class="form-group col-md-6">
                        <label for="datQ1p1pr">Fecha Inicia 1º Parcial</label>
                        <input class="form-control" id="datQ1p1pr" name="datQ1p1pr" type="date">
                    </div>
                </div>

                <div class="row">
                    <div class="form-group col-md-6">
                        <label for="txtQ1p2hd">Leyenda 2º Parcial</label>
                        <input class="form-control" id="txtQ1p2hd" name="txtQ1p2hd" type="text" maxlength="20">
                    </div>
                    <div class="form-group col-md-6">
                        <label for="datQ1p2pr">Fecha Inicia 2º Parcial</label>
                        <input class="form-control" id="datQ1p2pr" name="datQ1p2pr" type="date">
                    </div>
                </div>

                <div class="row">
                    <div class="form-group col-md-6">
                        <label for="txtQ1p3hd">Leyenda 3º Parcial</label>
                        <input class="form-control" id="txtQ1p3hd" name="txtQ1p3hd" type="text" maxlength="20">
                    </div>
                    <div class="form-group col-md-6">
                        <label for="datQ1p3pr">Fecha Inicia 3º Parcial</label>
                        <input class="form-control" id="datQ1p3pr" name="datQ1p3pr" type="date">
                    </div>
                </div>
                <div class="row">
                    <div class="form-group col-md-6">
                        <label for="txtQ1p4hd">Leyenda Examen</label>
                        <input class="form-control" id="txtQ1p4hd" name="txtQ1p4hd" type="text" maxlength="20">
                    </div>
                    <div class="form-group col-md-6">
                        <label for="datQ1p4pr">Fecha Inicia Exámen</label>
                        <input class="form-control" id="datQ1p4pr" name="datQ1p4pr" type="date">
                    </div>
                </div>

                <div class="row">
                    <div class="form-group col-md-6">
                        <label for="control-label">2º QUIMESTRE</label>
                    </div>
                </div>

                <div class="row">
                    <div class="form-group col-md-6">
                        <label for="txtQ2p1hd">Leyenda 1º Parcial</label>
                        <input class="form-control" id="txtQ2p1hd" name="txtQ2p1hd" type="text" maxlength="20">
                    </div>
                    <div class="form-group col-md-6">
                        <label for="datQ2p1pr">Fecha Inicia 1º Parcial</label>
                        <input class="form-control" id="datQ2p1pr" name="datQ2p1pr" type="date">
                    </div>
                </div>

                <div class="row">
                    <div class="form-group col-md-6">
                        <label for="txtQ2p2hd">Leyenda 2º Parcial</label>
                        <input class="form-control" id="txtQ2p2hd" name="txtQ2p2hd" type="text" maxlength="20">
                    </div>
                    <div class="form-group col-md-6">
                        <label for="datQ2p2pr">Fecha Inicia 2º Parcial</label>
                        <input class="form-control" id="datQ2p2pr" name="datQ2p2pr" type="date">
                    </div>
                </div>

                <div class="row">
                    <div class="form-group col-md-6">
                        <label for="txtQ2p3hd">Leyenda 3º Parcial</label>
                        <input class="form-control" id="txtQ2p3hd" name="txtQ2p3hd" type="text" maxlength="20">
                    </div>
                    <div class="form-group col-md-6">
                        <label for="datQ2p3pr">Fecha Inicia 3º Parcial</label>
                        <input class="form-control" id="datQ2p3pr" name="datQ2p3pr" type="date">
                    </div>
                </div>

                <div class="row">
                    <div class="form-group col-md-6">
                        <label for="txtQ2p4hd">Leyenda Examen</label>
                        <input class="form-control" id="txtQ2p4hd" name="txtQ2p4hd" type="text" maxlength="20">
                    </div>
                    <div class="form-group col-md-6">
                        <label for="datQ2p4pr">Fecha Inicia Exámen</label>
                        <input class="form-control" id="datQ2p4pr" name="datQ2p4pr" type="date">
                    </div>
                </div>

                <hr>
                <!-- Base de Calificación y Mínimo Supletorio -->
                <div class="row">
                    <div class="form-group col-md-6">
                        <label for="listBascal">Base de Calificación *</label>
                        <input class="form-control" id="listBascal" name="listBascal" type="number" value="10" min="0" max="10" required="">
                    </div>
                    <div class="form-group col-md-6">
                        <label for="listMinsup">Mímima Calificación Supletorio *</label>
                        <input class="form-control" id="listMinsup" name="listMinsup" type="number" value="0" min="0" max="10" required="">
                    </div>
                </div>

                <!-- Promediar Parciales y Numero de Trabajos -->
                <div class="row">
                    <div class="form-group col-md-6">
                        <label for="listDecnum">Número Decimales en Promedios *</label>
                        <input class="form-control" id="listDecnum" name="listDecnum" type="number" value="2" min="0" max="2" required="">
                    </div>
                    <div class="form-group col-md-6">
                        <label for="listInsnum">Número Insumos Necesarios*</label>
                        <input class="form-control" id="listInsnum" name="listInsnum" type="number" value="0" min="0" max="5" required="">
                    </div>
                </div>

                <!-- Porcentajes por Parcial y Examen -->
                <div class="row">
                    <div class="form-group col-md-6">
                        <label for="listParpor">% Ponderación Parcial *</label>
                        <input class="form-control" id="listParpor" name="listParpor" type="number" value="0" min="0" max="100" required="">
                    </div>
                    <div class="form-group col-md-6">
                        <label for="listExapor">% Ponderación Examen *</label>
                        <input class="form-control" id="listExapor" name="listExapor" type="number" value="0" min="0" max="100" required="">
                    </div>
                </div>

                <!-- Número de Matrícula Folio y Fecha Matrícula -->
                <div class="row">
                    <div class="form-group col-md-6">
                        <label for="listMatnum">Ultimo No. Matrícula</label>
                        <input class="form-control" id="listMatnum" name="listMatnum" type="number">
                    </div>
                    <div class="form-group col-md-6">
                        <label for="listFolnum">Ultimo No. Folio</label>
                        <input class="form-control" id="listFolnum" name="listFolnum" type="number">
                    </div>
                </div>

                <!-- Número de decimales -->
                <div class="row">
                    <div class="form-group col-md-6">
                        <label for="listParpro">Promediar Parciales separado</label>
                        <select class="form-control selectpicker" id="listParpro" name="listParpro" required="">
                                <option value="1">Si</option>
                                <option value="2">No</option>
                        </select>
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
