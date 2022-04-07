<!-- Modal para Permisos de cada Rol ..... -->
<!-- ------------------------------------- -->
<div class="modal fade modalPermisos" tabindex="-1" role="dialog" data-keyboard="false" data-backdrop="static" aria-labelledby="myExtraLargeModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title h4">Permisos Roles de Usuario:</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">x</span>
          </button>
      </div>

      <div class="modal-body">
      
      <!-- Validaacion de Carga de Modulos
      <?php dep($data); ?>
      -->
      
        <div class="col-md-12">
          <div class="tile">
            <form action="" id="formPermisos" name="formPermisos">
                <input type="hidden" id="idRol" name="idRol" value="<?= $data['idrol'] ?>" required="">
                <div class="table-responsive">
                      <table class="table" cellspacing="0" width="100%">
                        <thead>
                          <tr>
                            <th>#</th>
                            <th>Menú</th>
                            <th>Visualizar</th>
                            <th>Agregar</th>
                            <th>Editar</th>
                            <th>Eliminar</th>
                          </tr>
                        </thead>
                        <tbody>

                          <?php
                            $no = 1;
                            $modulos = $data['modulos'];
                            for ($i=0; $i < count($modulos); $i++)
                            {
                                $permisos = $modulos[$i]['permisos'];
                                $rCheck = $permisos['r'] == 1 ? " checked " : "";
                                $wCheck = $permisos['w'] == 1 ? " checked " : "";
                                $uCheck = $permisos['u'] == 1 ? " checked " : "";
                                $dCheck = $permisos['d'] == 1 ? " checked " : "";

                                $idmod = $modulos[$i]['idmodulo']
                          ?>

                          <tr>
                            <td>
                              <?= $no; ?>
                              <input type="hidden" name="modulos[<?= $i; ?>][idmodulo]" value="<?= $idmod ?>" required>
                            </td>
                            <td> <?= $modulos[$i]['nombre']; ?> </td>
                            <td><div class="toggle-flip">
                                  <label>
                                    <input type="checkbox" name="modulos[<?= $i; ?>][r]" <?= $rCheck ?> ><span class="flip-indecator" data-toggle-on="ON" data-toggle-off="OFF"></span>
                                  </label>
                                </div>
                            </td>
                            <td><div class="toggle-flip">
                                  <label>
                                    <input type="checkbox" name="modulos[<?= $i; ?>][w]" <?= $wCheck ?> ><span class="flip-indecator" data-toggle-on="ON" data-toggle-off="OFF"></span>
                                  </label>
                                </div>
                            </td>
                            <td><div class="toggle-flip">
                                  <label>
                                    <input type="checkbox" name="modulos[<?= $i; ?>][u]" <?= $uCheck ?> ><span class="flip-indecator" data-toggle-on="ON" data-toggle-off="OFF"></span>
                                  </label>
                                </div>
                            </td>
                            <td><div class="toggle-flip">
                                  <label>
                                    <input type="checkbox" name="modulos[<?= $i; ?>][d]" <?= $dCheck ?> ><span class="flip-indecator" data-toggle-on="ON" data-toggle-off="OFF"></span>
                                  </label>
                                </div>
                            </td>
                          </tr>
                          <?php
                            $no++;
                            }
                          ?>
                        </tbody>
                        <tfoot>
                          <tr>
                            <th>#</th>
                            <th>Menú</th>
                            <th>Visualizar</th>
                            <th>Agregar</th>
                            <th>Editar</th>
                            <th>Eliminar</th>
                          </tr>
                        </tfoot>
                      </table>
                </div>

                <div class="modal-footer">
                  <button class="btn btn-success" type="submit"><i class="fa fa-fw fa-lg fa-check-circle" aria-hidden="true"></i>Guardar</button>
                  <button class="btn btn-danger" type="button" data-dismiss="modal"><i class="app-menu__icon fa fa-fw fa-lg fa-times-circle" aria-hidden="true"></i>Cancelar</button>
                </div>              

            </form> 
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
