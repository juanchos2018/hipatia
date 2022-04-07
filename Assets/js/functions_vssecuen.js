var TablaVssecuen;

$(document).ready(function() {
        TablaVssecuen = $('#TableVssecuen').DataTable({
    	"language":{
			"url": "//cdn.datatables.net/plug-ins/1.10.22/i18n/Spanish.json"	
		},
    	"ajax": {
    		"url": base_url+"Vssecuen/getVssecuens",
    		"dataSrc":""
    	},
        "columns":[
            {"data": "options"},
            {"data": "TAB_NM"},
            {"data": "PTO_NO"},
            {"data": "MOV_NO"},
            {"data": "PAR_NO"},
        ],
        dom: 'BlfrtipP',
        buttons: [
            {
                "extend": "excelHtml5",
                "text": "<i class='fas fa-file-excel'></i> Excel",
                "titleAttr": "Exportar a Excel",
                "className": "btn btn-success"
            },{
                "extend": "pdfHtml5",
                "text": "<i class='fas fa-file-pdf'></i> PDF",
                "titleAttr": "Exportar a PDF",
                "className": "btn btn-danger"
            }
        ],
        responsive:true,
    	destroy:true,
    	"displayLength":10,
		"order":[[0,"asc"]]
    });


    // AGREGAR SECUENCIAL
    var formVssecuen = document.querySelector("#formVssecuen");    
   	formVssecuen.onsubmit = function(e)
   	{
   		e.preventDefault(); //previene que se recargue el formulario o pagina...
            
		var request  = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');	
   		var ajaxUrl  = base_url+"Vssecuen/setVssecuen";
   		var formData = new FormData(formVssecuen);

        request.open("POST",ajaxUrl,true);
    	request.send(formData);	

		request.onreadystatechange = function()
   		{
   			if(request.readyState == 4 && request.status == 200)
   			{
   				let objData = JSON.parse(request.responseText);	
   				if(objData.status)
   				{
                    $('#modalformVssecuen').modal('hide');
                    swal('Parámetro',objData.msg,'success');
  					TablaVssecuen.ajax.reload(null,false);
   				}else{
  					swal('ERROR: ',objData.msg,'error');
  				}
   			}    			
   		}
   	}
});


// SECUENCIAL
function openModalScc()
{
    document.querySelector('#idSec_id').value = 0;
    document.querySelector('#listTab_no').value = "";
    $('#listTab_no').selectpicker('render');                  

    document.querySelector('#titleModal').innerHTML = 'Nuevo Parámetro';
    document.querySelector('.modal-header').classList.replace('headerUpdate','headerRegister');
    document.querySelector('#btnActionForm').classList.replace('btn-info','btn-primary');
    document.querySelector('#btnText').innerHTML = 'Guardar';

    document.querySelector("#formVssecuen").reset();
    $("#modalformVssecuen").modal('show');
}


// EDITAR SECUENCIAL
function fntEditVssecuen(idTAB)
{
    document.querySelector('#titleModal').innerHTML = 'Editar Parámetro';
    document.querySelector('.modal-header').classList.replace('headerRegister','headerUpdate');
    document.querySelector('#btnActionForm').classList.replace('btn-primary','btn-info');
    document.querySelector('#btnText').innerHTML = 'Actualizar';

    var tabID   = idTAB;
    var request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
    var ajaxUrl = base_url+"Vssecuen/getVssecuen/"+tabID;

    request.open("GET",ajaxUrl,true);
    request.send();

    request.onreadystatechange = function()
    {
        if(request.readyState == 4 && request.status == 200)
        {
            var objData = JSON.parse(request.responseText);
            if(objData.status)
            {  
                // ID Tabla
                document.querySelector('#idSec_id').value = objData.data.SEC_ID;

                // COMBO: Tabla
                document.querySelector('#listTab_no').value = objData.data.MOVTIP;
                $('#listTab_no').selectpicker('render');

                document.querySelector('#txtPto_no').value = objData.data.PTO_NO;
                document.querySelector('#txtMov_no').value = objData.data.MOV_NO;
                document.querySelector('#txtPar_no').value = objData.data.PAR_NO;

                $('#modalformVssecuen').modal('show');
            }else{
                swal("Error",objData.msg,"error");
            }
        }
    }
}
