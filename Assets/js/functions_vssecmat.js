var TablaVssecmat;

$(document).ready(function() {
        TablaVssecmat = $('#TableVssecmat').DataTable({
    	"language":{
			"url": "//cdn.datatables.net/plug-ins/1.10.22/i18n/Spanish.json"	
		},
    	"ajax": {
    		"url": base_url+"Vssecmat/getVssecmats",
    		"dataSrc":""
    	},
        "columns":[
            {"data": "options"},
            {"data": "PERIOS"},
            {"data": "SEC_NM"},
            {"data": "MAT_NM"},
            {"data": "REGIME"},
            {"data": "LAS_NM"},
            {"data": "CLINKS"},
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
    
            { 'className': "anchocelda", "targets": [ 0 ]},
            { 'className': "anchocelda", "targets": [ 1 ]},
            { 'className': "anchocelda", "targets": [ 2 ]},
            { 'className': "anchocelda", "targets": [ 3 ]},
            { 'className': "anchocelda", "targets": [ 4 ]},
            { 'className': "anchocelda", "targets": [ 5 ]},
            { 'className': "anchocelda", "targets": [ 6 ]}
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


    // AGREGAR REPARTO
    var formVssecmat = document.querySelector("#formVssecmat");
    var divLoading = document.querySelector('#divLoading');
    
   	formVssecmat.onsubmit = function(e)
   	{
   		e.preventDefault(); //previene que se recargue el formulario o pagina...

		var request  = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');		
   		var ajaxUrl  = base_url+"Vssecmat/setVssecmat";
		var formData = new FormData(formVssecmat);
			
   		request.open("POST",ajaxUrl,true);
		request.send(formData);
        divLoading.style.display = "flex"; 

		request.onreadystatechange = function()
   		{
            if(request.readyState == 4 && request.status == 200)
   			{	
   				var objData = JSON.parse(request.responseText);	
                if(objData.status)
  				{
                    $("#modalformVssecmat").modal('hide');
                    swal('Reparto',objData.msg,'success');
  					TablaVssecmat.ajax.reload(null,false);
   				}else{
  					swal('ERROR: ',objData.msg,'error');
   				}
                divLoading.style.display = "none";
  			}    			
   		}
   	}
});


// REPARTO
function openModalRep()
{   
    document.querySelector('#idSec_id').value = 0;
    document.querySelector('#listSec_no').value = "";
    $('#listSec_no').selectpicker('render');
    document.querySelector('#listMat_no').value = "";
    $('#listMat_no').selectpicker('render');
    document.querySelector('#listEmp_no').value = "";
    $('#listEmp_no').selectpicker('render');

    document.querySelector('#titleModal').innerHTML = 'Nuevo Reparto';
    document.querySelector('.modal-header').classList.replace('headerUpdate','headerRegister');
    document.querySelector('#btnActionForm').classList.replace('btn-info','btn-primary');
    document.querySelector('#btnText').innerHTML = 'Guardar';

    document.querySelector("#formVssecmat").reset();
    fntGetPerios();
    $("#modalformVssecmat").modal('show');
}


// EDITAR REPARTO
function fntEditVssecmat(idSEC)
{
    document.querySelector('#titleModal').innerHTML = 'Editar Reparto';
    document.querySelector('.modal-header').classList.replace('headerRegister','headerUpdate');
    document.querySelector('#btnActionForm').classList.replace('btn-primary','btn-info');
    document.querySelector('#btnText').innerHTML = 'Actualizar';

    var secID   = idSEC;
    var request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
    var ajaxUrl = base_url+"Vssecmat/getVssecmat/"+secID;

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

                // COMBO: Sección
                document.querySelector('#listSec_no').value = objData.data.SEC_NO;
                $('#listSec_no').selectpicker('render');

                // COMBO: Asignatura
                document.querySelector('#listMat_no').value = objData.data.MAT_NO;
                $('#listMat_no').selectpicker('render');

                // COMBO: Docente
                document.querySelector('#listEmp_no').value = objData.data.EMP_NO;
                $('#listEmp_no').selectpicker('render');

                // Año Lectivo
                document.querySelector('#listPerios').value = objData.data.PERIOS;

                // Link Aula de Clase
				document.querySelector('#txtClinks').value = objData.data.CLINKS;

                // Orden
                document.querySelector('#txtOrders').value = objData.data.ORDERS;

                $('#modalformVssecmat').modal('show');
            }else{
                swal("Error",objData.msg,"error");
            }
        }
    }
}


// ELIMINAR REPARTO
function fntDelVssecmat(secID)
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
        }, function(isConfirm) 
        {
            if(isConfirm)
            {
                let request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
                let ajaxUrl = base_url+'Vssecmat/delVssecmat/';
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
                            TablaVssecmat.ajax.reload(null,false);
                        }else{
                            swal("Atenciòn!",objData.msg,"error");
                        }
                    }
                }
            }
        });
}
