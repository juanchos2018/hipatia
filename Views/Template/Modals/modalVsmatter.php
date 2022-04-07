<!-- Modal -->
<div class="modal fade" id="modalformVsmatter" name="modalFormVsmatter" tabindex="-1" role="dialog" data-keyboard="false" data-backdrop="static" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header headerRegister">
                <h5 class="modal-title" id="titleModal">Nueva Asignatura</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            
            <div class="modal-body">
                <form id="formVsmatter" name="formVsmatter">
                <!-- boton oculto -->
                <input type="hidden" id="idMat_no" name="idMat_no" value="">
                <p class="text-primary">Campos con asterisco * son obligatorios</p>

                <!-- Nombre de Asignatura -->
                <div class="row">
                    <div class="form-group col-md-12">
                        <label for="txtMat_nm">Nombre Asignatura *</label>
                        <input class="form-control" id="txtMat_nm" name="txtMat_nm" type="text" placeholder="*" maxlength="100" required="">
                    </div>
                </div>

                <!-- Régimen y Tipo Calificación -->
                <div class="row">
                    <div class="form-group col-md-6">
                        <label for="listRegime">Régimen *</label>
                        <select class="form-control selectpicker" id="listRegime" name="listRegime" required="">
                                <option value="" selected>Seleccione</option>
                                <option value="1">Malla</option>
                                <option value="2">Interno</option>
                        </select>
                    </div>
                    <div class="form-group col-md-6">
                        <label for="listCalifi">Tipo de Calificación *</label>
                        <select class="form-control selectpicker" id="listCalifi" name="listCalifi" required="">
                                <option value="" selected>Seleccione</option>
                                <option value="1">Cuantitativa</option>
                                <option value="2">Cualitativa</option>
                        </select>
                    </div>
                </div>

                <!-- Tipo de Calculo y Codigo EBOOK-->
                <div class="row">
                    <div class="form-group col-md-6">
                        <label for="listPromed">Tipo de Cálculo Insumos *</label>
                        <select class="form-control selectpicker" id="listPromed" name="listPromed" required="">
                                <option value="" selected>Seleccione</option>
                                <option value="1">Sumativa</option>
                                <option value="2">Promedial</option>
                        </select>
                    </div>
                    <div class="form-group col-md-6">
                        <label for="txtEbooks">Código EBOOK</label>
                        <input class="form-control" id="txtEbooks" name="txtEbooks" type="text" placeholder="" maxlength="3">
                    </div>
                </div>

                <!-- Asignatura Grupo -->
                <div class="row">
                    <div class="form-group col-md-12">
                        <label for="listMat_n2">Asignatura Grupo</label>
                        <select class="form-control" data-live-search="true" data-size="5" id="listMat_n2" name="listMat_n2">
                        </select>
                    </div>
                </div>

                <!-- Escalas de Calificaciones -->
                <div class="row">
                    <div class="form-group col-md-6">
                        <label for="IntCuan10">Escalas Cuantitativas</label>
                        <input class="form-control" id="intCuan10" name="intCuan10" type="text" value="10" placeholder="" maxlength="2" >
                    </div>
                    <div class="form-group col-md-6">
                        <label for="txtCual10">Equivalencias Cualitativas</label>
                        <input class="form-control" id="txtCual10" name="txtCual10" type="text" value="EX" placeholder="" maxlength="2" >
                    </div>
                </div>

                <div class="row">
                    <div class="form-group col-md-6">
                        <input class="form-control" id="intCuan09" name="intCuan09" type="text" value="9" placeholder="" maxlength="2">
                    </div>
                    <div class="form-group col-md-6">
                        <input class="form-control" id="txtCual09" name="txtCual09" type="text" value="EX" placeholder="" maxlength="2">
                    </div>
                </div>

                <div class="row">
                    <div class="form-group col-md-6">
                        <input class="form-control" id="intCuan08" name="intCuan08" type="text" value="8" placeholder="" maxlength="2" >
                    </div>
                    <div class="form-group col-md-6">
                        <input class="form-control" id="txtCual08" name="txtCual08" type="text" value="MB" placeholder="" maxlength="2" >
                    </div>
                </div>

                <div class="row">
                    <div class="form-group col-md-6">
                        <input class="form-control" id="intCuan07" name="intCuan07" type="text" value="7" placeholder="" maxlength="2" >
                    </div>
                    <div class="form-group col-md-6">
                        <input class="form-control" id="txtCual07" name="txtCual07" type="text" value="MB" placeholder="" maxlength="2" >
                    </div>
                </div>

                <div class="row">
                    <div class="form-group col-md-6">
                        <input class="form-control" id="intCuan06" name="intCuan06" type="text" value="6" placeholder="" maxlength="2" >
                    </div>
                    <div class="form-group col-md-6">
                        <input class="form-control" id="txtCual06" name="txtCual06" type="text" value="B" placeholder="" maxlength="2" >
                    </div>
                </div>

                <div class="row">
                    <div class="form-group col-md-6">
                        <input class="form-control" id="intCuan05" name="intCuan05" type="text" value="5" placeholder="" maxlength="2" >
                    </div>
                    <div class="form-group col-md-6">
                        <input class="form-control" id="txtCual05" name="txtCual05" type="text" value="B" placeholder="" maxlength="2" >
                    </div>
                </div>

                <div class="row">
                    <div class="form-group col-md-6">
                        <input class="form-control" id="intCuan04" name="intCuan04" type="text" value="4" placeholder="" maxlength="2" >
                    </div>
                    <div class="form-group col-md-6">
                        <input class="form-control" id="txtCual04" name="txtCual04" type="text" value="R" placeholder="" maxlength="2" >
                    </div>
                </div>

                <div class="row">
                    <div class="form-group col-md-6">
                        <input class="form-control" id="intCuan03" name="intCuan03" type="text" value="3" placeholder="" maxlength="2" >
                    </div>
                    <div class="form-group col-md-6">
                        <input class="form-control" id="txtCual03" name="txtCual03" type="text" value="R" placeholder="" maxlength="2" >
                    </div>
                </div>

                <div class="row">
                    <div class="form-group col-md-6">
                        <input class="form-control" id="intCuan02" name="intCuan02" type="text" value="2" placeholder="" maxlength="2" >
                    </div>
                    <div class="form-group col-md-6">
                        <input class="form-control" id="txtCual02" name="txtCual02" type="text" value="R" placeholder="" maxlength="2" >
                    </div>
                </div>

                <div class="row">
                    <div class="form-group col-md-6">
                        <input class="form-control" id="intCuan01" name="intCuan01" type="text" value="1" placeholder="" maxlength="2" >
                    </div>
                    <div class="form-group col-md-6">
                        <input class="form-control" id="txtCual01" name="txtCual01" type="text" value="R" placeholder="" maxlength="2" >
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
