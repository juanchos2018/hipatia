var TablaVsbanker;

$(document).ready(function()
{
        TablaVsbanker = $('#TableVsbanker').DataTable({
    	"language":{
			"url": "//cdn.datatables.net/plug-ins/1.10.22/i18n/Spanish.json"	
		},
    	"ajax": {
    		"url": base_url+"Vsbanker/getVsbankers",
    		"dataSrc":""
    	},
        "columns":[
            {"data": "options"},
            {"data": "BAN_NM"},
            {"data": "CTANUM"},
            {"data": "CHE_NO"},
            {"data": "ULTCCL"}
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


    // AGREGAR ENTIDAD
    var formVsbanker = document.querySelector("#formVsbanker");
    
   	formVsbanker.onsubmit = function(e)
   	{
   		e.preventDefault(); //previene que se recargue el formulario o pagina...

		var request  = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');		
   		var ajaxUrl  = base_url+"Vsbanker/setVsbanker";
		var formData = new FormData(formVsbanker);
			
   		request.open("POST",ajaxUrl,true);
		request.send(formData);	
		request.onreadystatechange = function()
   		{
   			if(request.readyState == 4 && request.status == 200)
   			{
   				var objData = JSON.parse(request.responseText);								
   				if(objData.status)
   				{
                    $('#modalformVsbanker').modal('hide');
   					swal('Entidad',objData.msg,'success');
   					TablaVsbanker.ajax.reload(null,false);
   				}else{
                    swal('ERROR: ',objData.msg,'error');
   				}
   			}    			
   		}
   	}
});


// ENTIDAD
function openModalBan()
{
    document.querySelector('#idBan_no').value = 0;                        
    document.querySelector('#listCta_no').value = "";
    $('#listCta_no').selectpicker('render');
    
    document.querySelector('#titleModal').innerHTML = 'Nueva Entidad';
    document.querySelector('.modal-header').classList.replace('headerUpdate','headerRegister');
    document.querySelector('#btnActionForm').classList.replace('btn-info','btn-primary');
    document.querySelector('#btnText').innerHTML = 'Guardar';
    document.querySelector("#formVsbanker").reset();
	$("#modalformVsbanker").modal('show');
}


// EDITAR ENTIDAD
function fntEditVsbanker(idBAN)
{
    document.querySelector('#titleModal').innerHTML = 'Editar Entidad';
    document.querySelector('.modal-header').classList.replace('headerRegister','headerUpdate');
    document.querySelector('#btnActionForm').classList.replace('btn-primary','btn-info');
    document.querySelector('#btnText').innerHTML = 'Actualizar';

    var banID   = idBAN;
    var request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
    var ajaxUrl = base_url+"Vsbanker/getVsbanker/"+banID;

    request.open("GET",ajaxUrl,true);
    request.send();

    request.onreadystatechange = function()
    {
        if(request.readyState == 4 && request.status == 200)
        {
            var objData = JSON.parse(request.responseText);
            if(objData.status)
            {  
                // ID Banco
                document.querySelector('#idBan_no').value = objData.data.BAN_NO;

                // Nombre
                document.querySelector('#txtBan_nm').value = objData.data.BAN_NM;

                // Numero de Cuenta Bancaria
                document.querySelector('#txtCtanum').value = objData.data.CTANUM;

                // Ultimo Cheque
                document.querySelector('#txtChe_no').value = objData.data.CHE_NO;

                // Ultima Conciliación
                document.querySelector('#txtUltccl').value = objData.data.ULTCCL;

                // COMBO: Cuenta Contable
                document.querySelector('#listCta_no').value = objData.data.CTA_NO;
                $('#listCta_no').selectpicker('render');

                $('#modalformVsbanker').modal('show');
            }else{
                swal("Error",objData.msg,"error");
            }
        }
    }
}


// ELIMINAR ENTIDAD BANCARIA
function fntDelVsbanker(secID)
{
    let idSec = secID;
          
    swal({
        title: "Eliminar Entidad Financiera",
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
                let ajaxUrl = base_url+'Vsbanker/delVsbanker/';
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
                            TablaVsbanker.ajax.reload(null,false);
                        }else{
                            swal("Atenciòn!",objData.msg,"error");
                        }
                    }
                }
            }
    });
}
