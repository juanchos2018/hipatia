var TablaVsprovid;

$(document).ready(function()
{
		TablaVsprovid = $('#TableVsprovid').DataTable({
    	"language":{
			"url": "//cdn.datatables.net/plug-ins/1.10.22/i18n/Spanish.json"	
		},
    	"ajax": {
    		"url": ""+base_url+"Vsprovid/getVsprovids",
    		"dataSrc":""
    	},
        "columns":[
            {"data": "options"},
            {"data": "LAS_NM"},
            {"data": "FIR_NM"},
            {"data": "IDTYPE"},
            {"data": "IDE_NO"},
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


    // AGREGAR PROVEEDOR
    var formVsprovid = document.querySelector("#formVsprovid");
    
   	formVsprovid.onsubmit = function(e)
   	{
   		e.preventDefault(); //previene que se recargue el formulario o pagina...

		var request  = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');		
   		var ajaxUrl  = base_url+"Vsprovid/setVsprovid";
		var formData = new FormData(formVsprovid);
			
   		request.open("POST",ajaxUrl,true);
		request.send(formData);				
		request.onreadystatechange = function()
   		{
   			if(request.readyState == 4 && request.status == 200)
   			{					 
   				let objData = JSON.parse(request.responseText);	
   				if(objData.status)
   				{
   					$('#modalformVsprovid').modal('hide');
   					swal('Proveedor',objData.msg,'success');
                    TablaVsprovid.ajax.reload(null,false);
  				}else{
   					swal('ERROR: ',objData.msg,'error');
  				}
   			}
   		}
   	}
});


// PROVEEDOR
function openModalPrv()
{
    document.querySelector('#idPrv_no').value = 0;
    document.querySelector('#listStatus').value = "";
    $('#listStatus').selectpicker('render');
    document.querySelector('#listIdtype').value = "";
    $('#listIdtype').selectpicker('render');
    document.querySelector('#listCta_no').value = "";
    $('#listCta_no').selectpicker('render');
    document.querySelector('#listAnt_no').value = "";
    $('#listAnt_no').selectpicker('render');

    document.querySelector('#titleModal').innerHTML = 'Nuevo Proveedor';
    document.querySelector('.modal-header').classList.replace('headerUpdate','headerRegister');
    document.querySelector('#btnActionForm').classList.replace('btn-info','btn-primary');
    document.querySelector('#btnText').innerHTML = 'Guardar';
    document.querySelector("#formVsprovid").reset();
	$("#modalformVsprovid").modal('show');
}


// EDITAR PROVEEDOR
function fntEditVsprovid(idPRV)
{
    document.querySelector('#titleModal').innerHTML = 'Editar Proveedor';
    document.querySelector('.modal-header').classList.replace('headerRegister','headerUpdate');
    document.querySelector('#btnActionForm').classList.replace('btn-primary','btn-info');
    document.querySelector('#btnText').innerHTML = 'Actualizar';

    var prvID   = idPRV;
    var request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
    var ajaxUrl = base_url+"Vsprovid/getVsprovid/"+prvID;

    request.open("GET",ajaxUrl,true);
    request.send();

    request.onreadystatechange = function()
    {
        if(request.readyState == 4 && request.status == 200)
        {
            var objData = JSON.parse(request.responseText);
            if(objData.status)
            {  
                // ID Proveedor
                document.querySelector('#idPrv_no').value = objData.data.PRV_NO;

                // COMBO: Condicion
                document.querySelector('#listStatus').value = objData.data.ESTATU;
                $('#listStatus').selectpicker('render');

                // Nombre
                document.querySelector('#txtLas_nm').value = objData.data.LAS_NM;
                document.querySelector('#txtFir_nm').value = objData.data.FIR_NM;
               
                // Dirección y Teléfonos
                document.querySelector('#txtAddres').value = objData.data.ADDRES;
                document.querySelector('#txtTphone').value = objData.data.TPHONE;

                // Numero de Identificación
                document.querySelector('#listIdtype').value = objData.data.IDTYPE;
                $('#listIdtype').selectpicker('render');
                document.querySelector('#txtIde_no').value = objData.data.IDE_NO;

                // Email
                document.querySelector('#txtEmails').value = objData.data.EMAILS;

                // Beneficiario
                document.querySelector('#txtBenefi').value = objData.data.BENEFI;

                // Numero de Autorización
                document.querySelector('#txtAut_no').value = objData.data.AUT_NO;

                // Fecha de Autorización
                document.querySelector('#datFecaut').value = objData.data.FECAUT;

                // COMBO: Cuenta de Anticipo
                document.querySelector('#listAnt_no').value = objData.data.ANT_NO;
                $('#listAnt_no').selectpicker('render');

                // COMBO: Cuenta por Pagar
                document.querySelector('#listCta_no').value = objData.data.CTA_NO;
                $('#listCta_no').selectpicker('render');

                $('#modalformVsprovid').modal('show');
            }else{
                swal("Error",objData.msg,"error");
            }
        }
    }
}


// ELIMINAR PROVEEDOR
function fntDelVsprovid(secID)
{
    let idSec = secID;
          
    swal({
        title: "Eliminar Proveedor",
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
                let ajaxUrl = base_url+'Vsprovid/delVsprovid/';
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
                            TablaVsprovid.ajax.reload(null,false);
                        }else{
                            swal("Atenciòn!",objData.msg,"error");
                        }
                    }
                }
            }
    });
}
