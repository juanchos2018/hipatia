<!-- Modal -->
<div class="modal fade" id="modalformRol" name="modalformRol" tabindex="-1" role="dialog" data-keyboard="false" data-backdrop="static" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header headerRegister">
        <h5 class="modal-title" id="titleModal">Nuevo Rol</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>

      <form id="formRol" name="formRol">
          <div class="modal-body">

                <!-- boton oculto -->
                <input type="hidden" id="idRol" name="idRol" value="">

                <div class="form-group">
                  <label class="control-label">Nombre</label>
                  <input class="form-control" id="txtNombre" name="txtNombre" type="text" placeholder="Nombre del Rol" required="">
                </div>
                
                <div class="form-group">
                  <label class="control-label">Descripción</label>
                  <textarea class="form-control" id="txtDescripcion" name="txtDescripcion" rows="2" placeholder="Descripción del Rol" required=""></textarea>
                </div>
                
                <div class="form-group">
                    <label for="exampleSelect1">Estado</label>
                    <select class="form-control selectpicker" id="listStatus" name="listStatus" required="">
                      <option value="1">Activo</option>
                      <option value="2">Inactivo</option>
                    </select>
                </div>
          </div>
          <div class="modal-footer">
                  <button id="btnActionForm" class="btn btn-success" type="submit"><i class="fa fa-fw fa-lg fa-check-circle"></i><span id="btnText">Guardar</span></button>
                  <button class="btn btn-danger cerrarModalRol" type="button" data-dismiss="modal"><i class="fa fa-fw fa-lg fa-times-circle"></i>Cancelar</button>
          </div>
       </form>
    </div>
  </div>
</div>



