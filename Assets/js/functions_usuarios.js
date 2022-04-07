
var TablaUsuarios;
(function()
{  //funcion autoejecutable de javascript

	$(function(){ //$(function ... de JQuery, indica que ya se cargaron todos los elementos DOM de la pagina
		
		TablaUsuarios = $('#TableUsuarios').DataTable({
    	"language":{
			"url": "//cdn.datatables.net/plug-ins/1.10.22/i18n/Spanish.json"	
		},
    	"ajax": {
    		"url": base_url+"Usuarios/getUsuarios",
    		"dataSrc":""
    	},
        "columns":[
            {"data": "options"},
            {"data": "USU_ID"},
            {"data": "USU_NM"},
            {"data": "rol_name"},
            {"data": "ESTADO"}
        ],
    	responsive:true,
    	destroy:true,
    	"displayLength":10,
		"order":[[0,"asc"]]
    	});

		//LLamada a la funcion:
		fntRolesUsuario();

		// .......... Creacion de un Nuevo Usuario ......................
    	var formUsuario = document.querySelector("#formUsuario");    
    	formUsuario.onsubmit = function(e)
    	{
    		e.preventDefault(); //previene que se recargue el formulario o pagina...

    		var strUsuario = document.querySelector("#txtUsuario").value; 
    		var strNombre = document.querySelector("#txtNombre").value;
    		var intTipousuario = document.querySelector("#listRol").value;
    		var intEmp = document.querySelector("#txtEmp").value;  
    		var intStatus = document.querySelector("#listEstado").value;
    		var strClave = document.querySelector("#txtClave").value;
    		var strAlias = document.querySelector("#txtAlias").value;
    		
    		if(strUsuario == '' || strNombre == '' || strClave == '')
    		{
    			swal('Atención !','Todos los campos son obligatorios','error');
    			return false;
    		}

    		var request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
    		var ajaxUrl = base_url+'Usuarios/setUsuario';
			var formData = new FormData(formUsuario);
			request.open("POST",ajaxUrl,true);
			request.send(formData);	

			request.onreadystatechange = function()
			{
				if(request.readyState == 4 && request.status == 200)
				{
					var objData = JSON.parse(request.responseText);
					if(objData.status)
					{
						$('#modalformUsuario').modal('hide');
						swal('Usuario',objData.msg,'success');						
						TablaUsuarios.ajax.reload(null,false);
					}else{
						swal('Error !',objData.msg,'error');
					}
				}
			}
    	}
		// ........... Fin Creacion Nuevo Usuario .......................

		// sobre el evento click del boton NuevoUsuario: se muestra una ventana modal
		$('#btnNuevoUsuario').on('click',function(){
			
			document.querySelector('#listRol').value = "";
			$('#listRol').selectpicker('render');

			document.querySelector('#titleModal').innerHTML = 'Nuevo Usuario';
			document.querySelector('.modal-header').classList.replace('headerUpdate','headerRegister');
			document.querySelector('#btnActionForm').classList.replace('btn-info','btn-primary');
			document.querySelector('#btnText').innerHTML = 'Guardar';
			document.querySelector('#formUsuario').reset();

			$('#modalformUsuario').modal('show');   // muestra la ventana modal
			$('#modalformUsuario').on('shown.bs.modal', function () {
  					$('#txtUsuario').trigger('focus')
			});
		});
	});
})();


// Funcion: fntRolesUsuario, para llenar el combo ....
function fntRolesUsuario()
{
	var ajaxUrl = base_url+'Roles/getSelectRoles';
	var request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
	request.open("GET",ajaxUrl,true);
	request.send();	

	request.onreadystatechange = function()
	{
		if(request.readyState == 4 && request.status == 200)
		{
			document.querySelector('#listRol').innerHTML = request.responseText;
			document.querySelector('#listRol').value = "";
			$('#listRol').selectpicker('render');
		}
	}    
}


// Funcion para visualizar los registros de un usuario ....
function fntViewUser(UsuSec)
{
	var secUSU = UsuSec;
    var request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
    var ajaxUrl = base_url+'Usuarios/getUser/'+secUSU;

    request.open("GET",ajaxUrl,true);
    request.send();

    request.onreadystatechange = function()
    {
        if(request.readyState == 4 && request.status == 200)
        {
        	var objData = JSON.parse(request.responseText);
        	if(objData.status)
        	{
        		var estadoUsuario = objData.data.ESTADO == 1 ?
        		'<span class="badge badge-success">Activo</span>' :
        		'<span class="badge badge-danger">Inactivo</span>';

        		document.querySelector('#cellUsuario').innerHTML = objData.data.USU_ID;
        		document.querySelector('#cellAlias').innerHTML = objData.data.ALI_NO;
        		document.querySelector('#cellNombre').innerHTML = objData.data.USU_NM;
        		document.querySelector('#cellClave').innerHTML = objData.data.USU_PAS;
        		document.querySelector('#cellRol').innerHTML = objData.data.rol_name;
        		document.querySelector('#cellCodigo').innerHTML = objData.data.USU_NO;
        		document.querySelector('#cellEstado').innerHTML = estadoUsuario;
        		document.querySelector('#cellToken').innerHTML = objData.data.TOKEN;
        		document.querySelector('#cellFechareg').innerHTML = objData.data.Fecha_registro;

        		$('#modalViewUser').modal('show');
        	}else{
        		swal("Error !", objData.msg, "error");
        	}        	
        }
    }
}


// Rutina que revisa Tablas: VSEMPLOX y VSTUDENT, para generar usuarios
// en la tabla VSACCESS ............
function ProcessUsers()
{
    var ajaxUrl = base_url+'Usuarios/saveUsers';
	var request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
	request.open("GET",ajaxUrl,true);
	request.send();	

	request.onreadystatechange = function()
	{
		if(request.readyState == 4 && request.status == 200)
		{
			swal('Usuarios Generados','Satisfactoriamente','success');
			TablaUsuarios.ajax.reload(null,false);
		}else{
			swal('Error !','Se produjo un error al grabar informacion!','error');
		}
	} 
}


function fntEditUser(UsuSec)
{
	document.querySelector('#titleModal').innerHTML = 'Editar Usuario';
    document.querySelector('.modal-header').classList.replace('headerRegister','headerUpdate');
    document.querySelector('#btnActionForm').classList.replace('btn-primary','btn-info');
    document.querySelector('#btnText').innerHTML = 'Actualizar';

	var secUSU = UsuSec;
    var request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
    var ajaxUrl = base_url+'Usuarios/getUser/'+secUSU;

    request.open("GET",ajaxUrl,true);
    request.send();

    request.onreadystatechange = function()
    {
        if(request.readyState == 4 && request.status == 200)
        {
            var objData = JSON.parse(request.responseText);
            if(objData.status)
            {  
                // ID
                document.querySelector('#idSec').value = objData.data.USU_SEC;

				// Usuario
                document.querySelector('#txtUsuario').value = objData.data.USU_ID;

                // COMBO: Condicion
                $opcion = objData.data.ESTADO;
                document.querySelector('#listEstado').value = $opcion;
                $('#listEstado').selectpicker('render');

                // COMBO: Rol
                $opcion = objData.data.USU_ROL;
                document.querySelector('#listRol').value = $opcion;
                $('#listRol').selectpicker('render');

				// Nombre y Contrasena
                document.querySelector('#txtNombre').value = objData.data.USU_NM;
                document.querySelector('#txtClave').value = objData.data.USU_PAS;

                // Enlace y Punto Emisión
                document.querySelector('#txtEmp').value = objData.data.USU_NO;
                document.querySelector('#txtPto_no').value = objData.data.PTO_NO;

                $('#modalformUsuario').modal('show');
            }else{
                swal("Error",objData.msg,"error");
            }
        }
    }
}


// ELIMINAR UN USUARIO
function fntDelUser(secID)
{
    let idSec = secID;
          
    swal({
        title: "Eliminar Usuario",
        text: "¿Realmente quiere eliminar el Registro ?",
        type: "warning",
        showCancelButton: true,
        confirmButtonText: "Sì, Eliminar!",
        cancelButtonText: "No, Cancelar",
        closeOnConfirm: false,
        closeOnCancel: true
        }, function(isConfirm) {
            if(isConfirm)
			{
                let request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
				var ajaxUrl = base_url+'Usuarios/delUsuario/';
                let strData = "idSec="+idSec;
                request.open("POST",ajaxUrl,true);
                request.setRequestHeader("Content-type","application/x-www-form-urlencoded");
                request.send(strData);
                request.onreadystatechange = function()
                {
                    if(request.readyState == 4 && request.status == 200)
                    {
                        var objData = JSON.parse(request.responseText);
                        if(objData.status)
                        {
                            swal("Eliminar",objData.msg,"success");
                            TablaUsuarios.ajax.reload(null,false);
                        }else{
                            swal("Atenciòn!",objData.msg,"error");
                        }
                    }
                }
            }
    	});
}
