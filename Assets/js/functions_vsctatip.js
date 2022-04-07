var TablaVsctatip;

$(document).ready(function() 
{
        TablaVsctatip = $('#TableVsctatip').DataTable({
    	"language":{
			"url": "//cdn.datatables.net/plug-ins/1.10.22/i18n/Spanish.json"	
		},
    	"ajax": {
    		"url": base_url+"Vsctatip/getVsctatips",
    		"dataSrc":""
    	},
        "columns":[
            {"data": "options"},
			{"data": "TAB_NM"},
			{"data": "CTAMOV"},
			{"data": "ENTITY"},
			{"data": "VALORS"},
			{"data": "FACTOR"},
			{"data": "CTADEB"},
            {"data": "CTACRE"}
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

    
    // AGREGAR PARAMETRO CONTABLE
    var formVsctatip = document.querySelector("#formVsctatip");
    
   	formVsctatip.onsubmit = function(e)
   	{
   		e.preventDefault(); //previene que se recargue el formulario o pagina...

		var request  = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');		
   		var ajaxUrl  = base_url+"Vsctatip/setVsctatip";
		var formData = new FormData(formVsctatip);
			
   		request.open("POST",ajaxUrl,true);
		request.send(formData);	
		request.onreadystatechange = function()
   		{
   			if(request.readyState == 4 && request.status == 200)
   			{
   				var objData = JSON.parse(request.responseText);
   				if(objData.status)
   				{
                    $('#modalformVsctatip').modal('hide');
   					swal('Parámetro',objData.msg,'success');
  					TablaVsctatip.ajax.reload(null,false);
   				}else{
                    swal('ERROR: ',objData.msg,'error');
                }
   			}    			
   		}
   	}
});


// PARAMETRO CONTABLE
function openModalTip()
{
    document.querySelector('#idSec_id').value = 0;
    document.querySelector('#listTab_no').value = "";
    $('#listTab_no').selectpicker('render');
    document.querySelector('#listCta_no').value = "";
    $('#listCta_no').selectpicker('render');
    document.querySelector('#listAnt_no').value = "";
    $('#listAnt_no').selectpicker('render');
    document.querySelector('#listEntity').value = "";
    $('#listEntity').selectpicker('render');
    document.querySelector('#listValors').value = "";
    $('#listValors').selectpicker('render');
    document.querySelector('#listCtafil').value = "";
    $('#listCtafil').selectpicker('render');
    document.querySelector('#listCtamov').value = "";
    $('#listCtamov').selectpicker('render');

    document.querySelector('#titleModal').innerHTML = 'Nuevo Parámetro Contable';
    document.querySelector('.modal-header').classList.replace('headerUpdate','headerRegister');
    document.querySelector('#btnActionForm').classList.replace('btn-info','btn-primary');
    document.querySelector('#btnText').innerHTML = 'Guardar';

    document.querySelector("#formVsctatip").reset();
    $("#modalformVsctatip").modal('show');
}


// EDITAR PARAMETRO CONTABLE
function fntEditVsctatip(idSEC)
{
    document.querySelector('#titleModal').innerHTML = 'Editar Parámetro Contable';
    document.querySelector('.modal-header').classList.replace('headerRegister','headerUpdate');
    document.querySelector('#btnActionForm').classList.replace('btn-primary','btn-info');
    document.querySelector('#btnText').innerHTML = 'Actualizar';

    var secID   = idSEC;
    var request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
    var ajaxUrl = base_url+"Vsctatip/getVsctatip/"+secID;

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
                document.querySelector('#idSec_id').value = objData.data.SEC_ID;

                // COMBO: Tabla
                document.querySelector('#listTab_no').value = objData.data.TAB_NO;
                $('#listTab_no').selectpicker('render');

                // COMBO: Cuenta Deudora
                document.querySelector('#listAnt_no').value = objData.data.CTADEB;
                $('#listAnt_no').selectpicker('render');

                // COMBO: Cuenta Acreedora
                document.querySelector('#listCta_no').value = objData.data.CTACRE;
                $('#listCta_no').selectpicker('render');

                // COMBO: Valor
                document.querySelector('#listValors').value = objData.data.VALORS;
                $('#listValors').selectpicker('render');

                // COMBO: Entidad
                document.querySelector('#listEntity').value = objData.data.ENTITY;
                $('#listEntity').selectpicker('render');

                // COMBO: Cuenta de Archivo
                document.querySelector('#listCtafil').value = objData.data.CTAFIL;
                $('#listCtafil').selectpicker('render');

                // Factor
				document.querySelector('#txtFactor').value = objData.data.FACTOR;

                // COMBO: Signo del Movimiento
                document.querySelector('#listCtamov').value = objData.data.CTAMOV;
                $('#listCtamov').selectpicker('render');

                $('#modalformVsctatip').modal('show');
            }else{
                swal("Error",objData.msg,"error");
            }
        }
    }
}


// ELIMINAR PARAMETRO CONTABLE
function fntDelVsctatip(secID)
{
    let idSec = secID;
          
    swal({
        title: "Eliminar Registro",
        text: "¿Realmente quiere eliminar el Registro ?",
        type: "warning",
        showCancelButton: true,
        confirmButtonText: "Sì, Eliminar!",
        cancelButtonText: "No, Cancelar",
        closeOnConfirm: false,
        closeOnCancel: true
        }, function(isConfirm) {
            if(isConfirm){
                let request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
                let ajaxUrl = base_url+'Vsctatip/delVsctatip/';
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
                            TablaVsctatip.ajax.reload(null,false);
                        }else{
                            swal("Atenciòn!",objData.msg,"error");
                        }
                    }
                }
            }
    });
}
