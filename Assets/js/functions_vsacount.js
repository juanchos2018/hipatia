var TablaVsacount;
$(document).ready(function()
{
        TablaVsacount = $('#TableVsacount').DataTable({
    	"language":{
			"url": "//cdn.datatables.net/plug-ins/1.10.22/i18n/Spanish.json"	
		},
    	"ajax": {
    		"url": base_url+"Vsacount/getVsacounts",
    		"dataSrc":""
    	},
        "columns":[
            {"data": "options"},
            {"data": "CTA_NO"},
            {"data": "CTA_NM"},
            {"data": "CTATIP"},
            {"data": "SIGNOS"}
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


    // AGREGAR PLAN DE CUENTAS
    var formVsacount = document.querySelector("#formVsacount");
    
   	formVsacount.onsubmit = function(e)
   	{
   		e.preventDefault(); //previene que se recargue el formulario o pagina...

		var request  = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');		
   		var ajaxUrl  = base_url+"Vsacount/setVsacount";
		var formData = new FormData(formVsacount);
			
   		request.open("POST",ajaxUrl,true);
		request.send(formData);	
            
		request.onreadystatechange = function()
   		{
   			if(request.readyState == 4 && request.status == 200)
   			{                    
   				var objData = JSON.parse(request.responseText);	
   				if(objData.status)
   				{
                    $('#modalformVsacount').modal('hide');
   					swal('Cuenta',objData.msg,'success');               
   					TablaVsacount.ajax.reload(null,false);
   				}else{
  					swal('ERROR: ',objData.msg,'error');
   				}
   			}    			
   		}
   	} 
});


// PLAN DE CUENTAS
function openModalCta()
{
    document.querySelector('#idSec_id').value = 0;                        
    document.querySelector('#listCtatip').value = "";
    $('#listCtatip').selectpicker('render');
    document.querySelector('#listSignos').value = "";
    $('#listSignos').selectpicker('render');
    document.querySelector('#listCta_no').value = "";
    $('#listCta_no').selectpicker('render');
    
    document.querySelector('#titleModal').innerHTML = 'Nueva Cuenta Contable';
    document.querySelector('.modal-header').classList.replace('headerUpdate','headerRegister');
    document.querySelector('#btnActionForm').classList.replace('btn-info','btn-primary');
    document.querySelector('#btnText').innerHTML = 'Guardar';
    document.querySelector("#formVsacount").reset();
	$("#modalformVsacount").modal('show');
}


// EDITAR PLAN DE CUENTAS
function fntEditVsacount(idCTA)
{
    document.querySelector('#titleModal').innerHTML = 'Editar Cuenta Contable';
    document.querySelector('.modal-header').classList.replace('headerRegister','headerUpdate');
    document.querySelector('#btnActionForm').classList.replace('btn-primary','btn-info');
    document.querySelector('#btnText').innerHTML = 'Actualizar';

    var ctaID   = idCTA;
    var request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
    var ajaxUrl = base_url+"Vsacount/getVsacount/"+ctaID;

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

                // Código Cuenta
                document.querySelector('#txtCta_no').value = objData.data.CTA_NO;

                // Nombre
                document.querySelector('#txtCta_nm').value = objData.data.CTA_NM;

                // COMBO: Tipo Cuenta
                document.querySelector('#listCtatip').value = objData.data.CTATIP;
                $('#listCtatip').selectpicker('render');

                // COMBO: Signo
                document.querySelector('#listSignos').value = objData.data.SIGNOS;
                $('#listSignos').selectpicker('render');

                // COMBO: Cuenta Superior
                document.querySelector('#listCta_no').value = objData.data.CTASUP;
                $('#listCta_no').selectpicker('render');

                $('#modalformVsacount').modal('show');
            }else{
                swal("Error",objData.msg,"error");
            }
        }
    }
}


// ELIMINAR CUENTA CONTABLE
function fntDelVsacount(secID)
{
    let idSec = secID;
          
    swal({
        title: "Eliminar Cuenta Contable",
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
                let ajaxUrl = base_url+'Vsacount/delVsacount/';
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
                            TablaVsacount.ajax.reload(null,false);
                        }else{
                            swal("Atenciòn!",objData.msg,"error");
                        }
                    }
                }
            }
    });
}
