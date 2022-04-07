var TablaVssecval;

$(document).ready(function() {
    TablaVssecval = $('#TableVssecval').DataTable({
    	"language":{
			"url": "//cdn.datatables.net/plug-ins/1.10.22/i18n/Spanish.json"	
		},
    	"ajax": {
    		"url": ""+base_url+"Vssecval/getVssecvals",
    		"dataSrc":""
    	},
        "columns":[
            {"data": "options"},
            {"data": "PERIOS"},
            {"data": "SEC_NM"},
            {"data": "ART_NM"},
            {"data": "VALORS"}
		],
        searchPanes:{
            cascadePanes: true,
            dtOpts: {
                dom:'tp',
                searching:false
            }
        },
        columnDefs: [
            {
                searchPanes: {
                show: false
                },
            }, 
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


    // AGREGAR VALOR
    let formVssecval = document.querySelector("#formVssecval");    
   	formVssecval.onsubmit = function(e)
   	{
   		e.preventDefault(); //previene que se recargue el formulario o pagina...

		let request  = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');		
   		let ajaxUrl  = base_url+"Vssecval/setVssecval";
		let formData = new FormData(formVssecval);
			
   		request.open("POST",ajaxUrl,true);
		request.send(formData);	
		request.onreadystatechange = function()
   		{
   			if(request.readyState == 4 && request.status == 200)
   			{	
   				let objData = JSON.parse(request.responseText);	
   				if(objData.status)
   				{
   					$('#modalformVssecval').modal('hide');
   					swal('Valor',objData.msg,'success');
   					TablaVssecval.ajax.reload(null,false);
   				}else{
  					swal('ERROR: ',objData.msg,'error');
   				}
   			}    			
   		}
   	}
});


// VALOR
function openModalVal()
{
    document.querySelector('#idSec_id').value = 0;
    document.querySelector('#listSec_no').value = "";
    $('#listSec_no').selectpicker('render');
    document.querySelector('#listArt_no').value = "";
    $('#listArt_no').selectpicker('render');
    document.querySelector("#formVssecval").reset();

    document.querySelector('#titleModal').innerHTML = 'Nuevo Valor por Servicio';
    document.querySelector('.modal-header').classList.replace('headerUpdate','headerRegister');
    document.querySelector('#btnActionForm').classList.replace('btn-info','btn-primary');
    document.querySelector('#btnText').innerHTML = 'Guardar';

    fntGetPerios();
	$("#modalformVssecval").modal('show');
}


// EDITAR VALOR
function fntEditVssecval(idSEC)
{
    document.querySelector('#titleModal').innerHTML = 'Editar Valor por Servicio';
    document.querySelector('.modal-header').classList.replace('headerRegister','headerUpdate');
    document.querySelector('#btnActionForm').classList.replace('btn-primary','btn-info');
    document.querySelector('#btnText').innerHTML = 'Actualizar';

    let secID   = idSEC;
    let request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
    let ajaxUrl = base_url+"Vssecval/getVssecval/"+secID;

    request.open("GET",ajaxUrl,true);
    request.send();

    request.onreadystatechange = function()
    {
        if(request.readyState == 4 && request.status == 200)
        {
            let objData = JSON.parse(request.responseText);
            if(objData.status)
            {  
                // ID
                document.querySelector('#idSec_id').value = objData.data.SEC_ID;

                // Año Lectivo
                document.querySelector('#listPerios').value = objData.data.PERIOS;

				// COMBO: Sección
                document.querySelector('#listSec_no').value = objData.data.SEC_NO;
                $('#listSec_no').selectpicker('render');

                // COMBO: Artíçulo
                document.querySelector('#listArt_no').value = objData.data.ART_NO;
                $('#listArt_no').selectpicker('render');

                // Valor
				document.querySelector('#txtValors').value = objData.data.VALORS;

                // % Pronto Pago
//				document.querySelector('#txtPordes').value = objData.data.PORDES;

				$('#modalformVssecval').modal('show');
            }else{
                swal("Error",objData.msg,"error");
            }
        }
    }
}
