var TablaVsstdhis;

$(document).ready(function() {
        TablaVsstdhis = $('#TableVsstdhis').DataTable({
        
    	"language":{
			"url": "//cdn.datatables.net/plug-ins/1.10.22/i18n/Spanish.json"	
		},
    	"ajax": {
    		"url": base_url+"Vsstdhis/getVsstdhiss",
    		"dataSrc":""
    	},
        "columns":[
            {"data": "options"},
			{"data": "PERIOS"},
			{"data": "FECREG"},
            {"data": "LAS_NM"},
            {"data": "FIR_NM"},
            {"data": "RETAIN"}
        ],
        responsive:true,
    	destroy:true,
    	"displayLength":10,
		"order":[[0,"asc"]]
    });


    // AGREGAR REGISTRO
    var formVsstdhis = document.querySelector("#formVsstdhis");
    
   	formVsstdhis.onsubmit = function(e)
   	{
		e.preventDefault(); //previene que se recargue el formulario o pagina...
			
    	var request  = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');		
    	var ajaxUrl  = base_url+"Vsstdhis/setVsstdhis";
		var formData = new FormData(formVsstdhis);
			
    	request.open("POST",ajaxUrl,true);
		request.send(formData);	
		request.onreadystatechange = function()
    	{
    		if(request.readyState == 4 && request.status == 200)
    		{
    			var objData = JSON.parse(request.responseText);	
   				if(objData.status)
   				{                        
                    $("#modalformVsstdhis").modal('hide');
                    swal('Registro',objData.msg,'success');
   					TablaVsstdhis.ajax.reload(null,false);
   				}else{
  					swal('ERROR: ',objData.msg,'error');
  				}
   			}    			
   		}
   	}
});


// REGISTRO
function openModalReg()
{
    document.querySelector('#idSec_id').value = 0;
    document.querySelector('#listStd_no').value = "";
    $('#listStd_no').selectpicker('render');

    document.querySelector('#titleModal').innerHTML = 'Nuevo Registro';
    document.querySelector('.modal-header').classList.replace('headerUpdate','headerRegister');
    document.querySelector('#btnActionForm').classList.replace('btn-info','btn-primary');
    document.querySelector('#btnText').innerHTML = 'Guardar';

    document.querySelector("#formVsstdhis").reset();
    fntGetPerios();
    $("#modalformVsstdhis").modal('show');
}


// EDITAR REGISTRO
function fntEditVsstdhis(idSEC)
{
    document.querySelector('#titleModal').innerHTML = 'Editar Registro';
    document.querySelector('.modal-header').classList.replace('headerRegister','headerUpdate');
    document.querySelector('#btnActionForm').classList.replace('btn-primary','btn-info');
    document.querySelector('#btnText').innerHTML = 'Actualizar';

    var secID   = idSEC;
    var request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
    var ajaxUrl = base_url+"Vsstdhis/getVsstdhis/"+secID;

    request.open("GET",ajaxUrl,true);
    request.send();

    request.onreadystatechange = function()
    {
        if(request.readyState == 4 && request.status == 200)
        {
            var objData = JSON.parse(request.responseText);
            if(objData.status)
            {            
                // ID Registro
                document.querySelector('#idSec_id').value = objData.data.SEC_ID;

                // Año
                document.querySelector('#listPerios').value = objData.data.PERIOS;

                // Fecha de Registro
                document.querySelector('#datFecreg').value = objData.data.FECREG;

                // COMBO: Estudiante
                $opcion = objData.data.STD_NO;
                document.querySelector('#listStd_no').value = $opcion;
                $('#listStd_no').selectpicker('render');

				// Retain
                document.querySelector('#txtRetain').value = objData.data.RETAIN;

                $('#modalformVsstdhis').modal('show');
            }else{
                swal("Error",objData.msg,"error");
            }
        }
    }
}
