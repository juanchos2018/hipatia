<!-- Modal -->
<div class="modal fade" id="modalformUsuario" tabindex="-1" role="dialog" data-keyboard="false" data-backdrop="static" -hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable" role="document">
    <div class="modal-content">
        <div class="modal-header headerRegister">
            <h5 class="modal-title" id="titleModal">Nuevo Usuario</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
        </div>

     
        <div class="modal-body">
              <form id="formUsuario" name="formUsuario">
              <!-- boton oculto -->
              <input type="hidden" id="idSec" name="idSec" value="">
              <p class="text-primary">Campos con asterisco (*) son obligatorios</p>

              <!-- Estado y Perfil -->
              <div class="row">
                  <div class="form-group col-md-6">
                      <label for="listEstado">Estado *</label>
                      <select class="form-control selectpicker" id="listEstado" name="listEstado" required="">
                          <option value="1">Activo</option>
                          <option value="2">Inactivo</option>
                      </select>
                  </div>
                  <div class="form-group col-md-6">
                        <label for="listRol">Perfil de Usuario *</label>
                        <select class="form-control" name="listRol" id="listRol" required="">
                        </select>
                  </div>                
              </div>

              <!--  Usuario -->
              <div class="row">
                  <div class="form-group col-md-6">
                      <label for="txtUsuario">Usuario *</label>
                      <input type="text" class="form-control" id="txtUsuario" name="txtUsuario" required="">
                  </div>
                  <div class="form-group col-md-6">
                      <label for="txtAlias">Alias</label>
                      <input type="text" class="form-control" id="txtAlias" name="txtAlias">
                  </div>
              </div>

              <!-- Nombre y Contrasena -->
              <div class="row">
                  <div class="form-group col-md-6">
                      <label for="txtNombre">Nombre *</label>
                      <input type="text" class="form-control" id="txtNombre" name="txtNombre" required="">
                  </div>
                  <div class="form-group col-md-6">
                      <label for="txtClave">Contraseña *</label>
                      <input type="password" class="form-control" id="txtClave" name="txtClave" required="">
                  </div>
              </div>
                
              <!--  Numero Enlace y Punto Emision -->
              <div class="row">
                  <div class="form-group col-md-6">
                      <label for="txtEmp">Enlace No.</label>
                      <input type="text" class="form-control" id="txtEmp" name="txtEmp">
                  </div>

                  <div class="form-group col-md-6">
                      <label for="txtPto_no">Punto de Emisión</label>
                      <input type="text" class="form-control" id="txtPto_no" name="txtPto_no" maxlength="6">
                  </div>
              </div>

              <div class="modal-footer">
                  <button id="btnActionForm" class="btn btn-primary" type="submit"><i class="fa fa-fw fa-lg fa-check-circle"></i><span id="btnText">Guardar</span></button>&nbsp;&nbsp;&nbsp;
                  <button class="btn btn-danger" type="button" data-dismiss="modal"><i class="fa fa-fw fa-lg fa-times-circle"></i>Cancelar</button>
              </div>

              </form>
          </div>
    </div>
  </div>
</div>

<!-- ---------------------------------- -->
<!-- ++++++++ Modal: ViewUser +++++++++ -->
<!-- ---------------------------------- -->

<div class="modal fade" id="modalViewUser" tabindex="-1" role="dialog" data-keyboard="false" data-backdrop="static" -hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header header-primary">
        <h5 class="modal-title" id="titleModal">Datos del Usuario</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>

      <div class="modal-body">
          <table class="table table-bordered table-striped">
              <tbody>
                <tr>
                  <td class="text-right">Usuario:</td>
                  <td id="cellUsuario"></td>
                  
                </tr>

                <tr>
                  <td class="text-right">Alias:</td>
                  <td id="cellAlias"></td>
                  
                </tr>

                <tr>
                  <td class="text-right">Nombre:</td>
                  <td id="cellNombre"></td>
                  
                </tr>

                <tr>
                  <td class="text-right">Clave:</td>
                  <td id="cellClave"></td>
                  
                </tr>

                <tr>
                  <td class="text-right">Rol:</td>
                  <td id="cellRol"></td>
                  
                </tr>

                <tr>
                  <td class="text-right">Codigo:</td>
                  <td id="cellCodigo"></td>
                  
                </tr>

                <tr>
                  <td class="text-right">Estado:</td>
                  <td id="cellEstado"></td>
                  
                </tr>

                <tr>
                  <td class="text-right">Token:</td>
                  <td id="cellToken"></td>
                  
                </tr>

                <tr>
                  <td class="text-right">Fecha Registro:</td>
                  <td id="cellFechareg"></td>
                  
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