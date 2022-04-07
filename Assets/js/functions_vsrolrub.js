var TablaVsrolrub;

$(document).ready(function()
{
        TablaVsrolrub = $('#TableVsrolrub').DataTable({
    	"language":{
			"url": "//cdn.datatables.net/plug-ins/1.10.22/i18n/Spanish.json"	
		},
    	"ajax": {
    		"url": base_url+"Vsrolrub/getVsrolrubs",
    		"dataSrc":""
    	},
        "columns":[
            {"data": "options"},
            {"data": "RUB_NM"},
            {"data": "RUBTIP"},
            {"data": "ESTATU"}
		],
        searchPanes:{
            cascadePanes: true,
            dtOpts: {
                dom:'tp',
                searching:false
            }
        },
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


    // AGREGAR RUBRO NOMINA
    var formVsrolrub = document.querySelector("#formVsrolrub");
    
   	formVsrolrub.onsubmit = function(e)
   	{
   		e.preventDefault(); //previene que se recargue el formulario o pagina...

        var request  = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');		
   		var ajaxUrl  = base_url+"Vsrolrub/setVsrolrub";
		var formData = new FormData(formVsrolrub);
			
   		request.open("POST",ajaxUrl,true);
		request.send(formData);	
            
		request.onreadystatechange = function()
   		{
   			if(request.readyState == 4 && request.status == 200)
   			{ 
   				var objData = JSON.parse(request.responseText);
   				if(objData.status)
   				{
                    $('#modalformVsrolrub').modal('hide');
   					swal('Rubro',objData.msg,'success');
   					TablaVsrolrub.ajax.reload(null,false);
   				}else{
                    swal('ERROR: ',objData.msg,'error');
   				}
   			}    			
   		}
   	}
    
});


// RUBRO NOMINA
function openModalRub()
{
    document.querySelector('#idRub_no').value = 0;
    document.querySelector('#listStatus').value = "";
    $('#listStatus').selectpicker('render');
    document.querySelector('#listRubtip').value = "";
    $('#listRubtip').selectpicker('render');
    document.querySelector('#listEncera').value = "";
    $('#listEncera').selectpicker('render');
    document.querySelector('#listHidens').value = "";
    $('#listHidens').selectpicker('render');
    document.querySelector('#listPercre').value = "";
    $('#listPercre').selectpicker('render');
    document.querySelector('#listAporte').value = "";
    $('#listAporte').selectpicker('render');
    
    document.querySelector('#titleModal').innerHTML = 'Nuevo Rubro Rol de Pago';
    document.querySelector('.modal-header').classList.replace('headerUpdate','headerRegister');
    document.querySelector('#btnActionForm').classList.replace('btn-info','btn-primary');
    document.querySelector('#btnText').innerHTML = 'Guardar';
    document.querySelector("#formVsrolrub").reset();
	$("#modalformVsrolrub").modal('show');
}


// EDITAR RUBRO NOMINA
function fntEditVsrolrub(idRUB)
{
    document.querySelector('#titleModal').innerHTML = 'Editar Rubro Rol de Pago';
    document.querySelector('.modal-header').classList.replace('headerRegister','headerUpdate');
    document.querySelector('#btnActionForm').classList.replace('btn-primary','btn-info');
    document.querySelector('#btnText').innerHTML = 'Actualizar';

    var rubID   = idRUB;
    var request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
    var ajaxUrl = base_url+"Vsrolrub/getVsrolrub/"+rubID;

    request.open("GET",ajaxUrl,true);
    request.send();

    request.onreadystatechange = function()
    {
        if(request.readyState == 4 && request.status == 200)
        {
            var objData = JSON.parse(request.responseText);
            if(objData.status)
            {  
                // ID Rubro
                document.querySelector('#idRub_no').value = objData.data.RUB_NO;

                // Nombre
                document.querySelector('#txtRub_nm').value = objData.data.RUB_NM;

                // COMBO: Status
                document.querySelector('#listStatus').value = objData.data.ESTATU;
                $('#listStatus').selectpicker('render');

                // COMBO: Tipo Rubro
                document.querySelector('#listRubtip').value = objData.data.RUBTIP;
                $('#listRubtip').selectpicker('render');

                // COMBO: Encera
                document.querySelector('#listEncera').value = objData.data.ENCERA;
                $('#listEncera').selectpicker('render');

                // COMBO: Oculto
                document.querySelector('#listHidens').value = objData.data.HIDENS;
                $('#listHidens').selectpicker('render');

                // COMBO: Crédito
                document.querySelector('#listPercre').value = objData.data.RUBCRE;
                $('#listPercre').selectpicker('render');

                // COMBO: Aporte
                document.querySelector('#listAporte').value = objData.data.APORTE;
                $('#listAporte').selectpicker('render');

                // Formula
                document.querySelector('#txtFormul').value = objData.data.FORMUL;

                $('#modalformVsrolrub').modal('show');
            }else{
                swal("Error",objData.msg,"error");
            }
        }
    }
}
