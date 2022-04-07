var Roles;

$(document).ready(function() {
        Roles = $('#TableRoles').DataTable({
    	"language":{
			"url": "//cdn.datatables.net/plug-ins/1.10.22/i18n/Spanish.json"	
		},
    	"ajax": {
    		"url": ""+base_url+"Roles/getRoles",
    		"dataSrc":""
    	},
        "columns":[
            {"data": "options"},
            {"data": "rol_id"},
            {"data": "rol_name"},
            {"data": "rol_description"},
            {"data": "rol_status"}
        ],
    	responsive:true,
    	destroy:true,
    	"displayLength":10,
		"order":[[0,"asc"]]
    });

    // NUevo Rol .....
    var formRol = document.querySelector("#formRol");
    
    formRol.onsubmit = function(e)
    {
    		e.preventDefault(); //previene que se recargue el formulario o pagina...

            var intIdRol = document.querySelector("#idRol").value;
    		var strNombre = document.querySelector("#txtNombre").value;
    		var strDescripcion = document.querySelector("#txtDescripcion").value;
    		var intStatus = document.querySelector("#listStatus").value;
    		if(strNombre == '' || strDescripcion == '' || intStatus == '')
    		{
    			swal('Atención !','Todos los campos son obligatorios','error');
    			return false;
    		}

    		var request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
    		var ajaxUrl = base_url+'Roles/setRol';
    		var formData = new FormData(formRol);
    		request.open("POST",ajaxUrl,true);
    		request.send(formData);
    		request.onreadystatechange = function()
    		{

    			if(request.readyState == 4 && request.status == 200)
    			{
    				var objData = JSON.parse(request.responseText);			
    				if(objData.status)
    				{

                        $("#modalformRol").modal('hide');
    					formRol.reset();
    					swal('Rol de Usuario',objData.msg,'success');
    					//Roles.ajax.reload(null,false);
                        Roles.ajax.reload(function(){
                            //fntEditRol();
                            //fntDelRol();
                        });
    				}else {
    					swal('ERROR: ',objData.msg,'error');
    				}
    			}
    			
    		}
    }
});

function openModal()
{
	document.querySelector('#idRol').value ="";
	document.querySelector('#titleModal').innerHTML = 'Nuevo Rol';
	document.querySelector('.modal-header').classList.replace('headerUpdate','headerRegister');
	document.querySelector('#btnActionForm').classList.replace('btn-info','btn-primary');
	document.querySelector('#btnText').innerHTML = 'Guardar';
	document.querySelector('#formRol').reset();
	$("#modalformRol").modal('show');
};

//document.addEventListener("DOMContentLoaded", function() {}, false);

// Funcion para el botòn Editar .....
function fntEditRol(rolID)
{  
            document.querySelector('#titleModal').innerHTML = 'Actualizar Rol';
            document.querySelector('.modal-header').classList.replace('headerRegister','headerUpdate');
            document.querySelector('#btnActionForm').classList.replace('btn-primary','btn-info');
            document.querySelector('#btnText').innerHTML = 'Actualizar';

            var idRol = rolID;
            var request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
            var ajaxUrl = base_url+'Roles/getRol/'+idRol;

            request.open("GET",ajaxUrl,true);
            request.send();

            request.onreadystatechange = function()
            {

                if(request.readyState == 4 && request.status == 200)
                {
                    var objData = JSON.parse(request.responseText);
                    if(objData.status)
                    {  
                        document.querySelector('#idRol').value = objData.data.rol_id;
                        document.querySelector('#txtNombre').value = objData.data.rol_name;
                        document.querySelector('#txtDescripcion').value = objData.data.rol_description;
                       
                        $opcion = objData.data.rol_status;
                        switch($opcion){
                            case '1':
                                document.querySelector('#listStatus').value = "1";
                                break;
                            case '2':
                                document.querySelector('#listStatus').value = "2";
                                break;
                        }
                        
                        $('#listStatus').selectpicker('render');
                        $("#modalformRol").modal('show');
                    }else {
                        swal("Error",objData.msg,"error");
                    }
                }
            }  
}

// Funcion para el botòn Eliminar (es eliminacion logica)....
function fntDelRol(rolID)
{
    var idRol = rolID;
          
    swal({
        title: "Eliminar Rol",
        text: "¿Realmente quiere eliminar el Rol ?",
        type: "warning",
        showCancelButton: true,
        confirmButtonText: "Sì, Eliminar!",
        cancelButtonText: "No, Cancelar",
        closeOnConfirm: false,
        closeOnCancel: true
        }, function(isConfirm) {
            if(isConfirm)
            {
                var request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
                var ajaxUrl = base_url+'Roles/delRol/';
                var strData = "idrol="+idRol;
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
                            Roles.ajax.reload(function(){
                            });
                        }else{
                            swal("Atenciòn!",objData.msg,"error");
                        }
                    }
                }
            }
    });
}

// FUNCION para el boton Permisos ......
function fntPermisosRol(rolID)
{
    var idRol = rolID;
    var request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
    var ajaxUrl = base_url+'Permisos/getPermisosRol/'+idRol;

    request.open("GET",ajaxUrl,true);
    request.send();
    request.onreadystatechange = function()
    {
        if(request.readyState == 4 && request.status == 200)
        {
            document.querySelector('#contentAjax').innerHTML = request.responseText;
            $('.modalPermisos').modal('show');
            document.querySelector('#formPermisos').addEventListener('submit',fntGrabarPermisos,false);
        }
    }
}

function fntGrabarPermisos(event)
{
    event.preventDefault();
    var request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
    var ajaxUrl = base_url+'Permisos/setPermisos';
    var formElement = document.querySelector('#formPermisos');
    var formData = new FormData(formElement);
    request.open("POST",ajaxUrl,true);
    request.send(formData);
    request.onreadystatechange = function()
    {
        if(request.readyState == 4 && request.status == 200)
        {
            var objData = JSON.parse(request.responseText);
            if(objData.status)
            {
                $(".modalPermisos").modal('hide');
                swal("Permisos de Usuario", objData.msg, "success" );
            }else{
                swal("Error !", objData.msg, "error" );
            }
        }
    }
}