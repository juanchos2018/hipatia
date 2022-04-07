var TablaVshorary;

$(document).ready(function() {
        TablaVshorary = $('#TableVshorary').DataTable({
    	"language":{
			"url": "//cdn.datatables.net/plug-ins/1.10.22/i18n/Spanish.json"	
		},
    	"ajax": {
    		"url": base_url+"Vshorary/getVshorarys",
    		"dataSrc":""
    	},
        "columns":[
            {"data": "options"},
            {"data": "PERIOS"},
            {"data": "SEC_NM"},
            {"data": "MAT_NM"},
            {"data": "LAS_NM"},
            {"data": "DAYNUM"},
            {"data": "HORNUM"}
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


    // AGREGAR HORARIO
    var formVshorary = document.querySelector("#formVshorary");
    var divLoading = document.querySelector('#divLoading');
    
   	formVshorary.onsubmit = function(e)
   	{
   		e.preventDefault(); //previene que se recargue el formulario o pagina...

		var request  = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');		
   		var ajaxUrl  = base_url+"Vshorary/setVshorary";
		var formData = new FormData(formVshorary);
			
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
                    $("#modalformVshorary").modal('hide');
                    formVshorary.reset();
                    swal('Horario',objData.msg,'success');
  					TablaVshorary.ajax.reload(null,false);
   				}else{
  					swal('ERROR: ',objData.msg,'error');
   				}
                divLoading.style.display = "none";
  			} 
   		}
   	}
});



// HORARIO
function openModalHor()
{   
    document.querySelector('#idSec_id').value = 0;
    document.querySelector('#listSec_no').value = "";
    $('#listSec_no').selectpicker('render');
    document.querySelector('#listMat_no').value = "";
    $('#listMat_no').selectpicker('render');
    document.querySelector('#listEmp_no').value = "";
    $('#listEmp_no').selectpicker('render');
    document.querySelector('#listDaynum').value = "";
    $('#listDaynum').selectpicker('render');
    document.querySelector('#listHornum').value = "";
    $('#listHornum').selectpicker('render');

    document.querySelector("#formVshorary").reset();
    fntGetPerios();
    $("#modalformVshorary").modal('show');
}



// EDITAR HORARIO
function fntEditVshorary(idSEC)
{
    document.querySelector('#titleModal').innerHTML = 'Editar Horario';
    document.querySelector('.modal-header').classList.replace('headerRegister','headerUpdate');
    document.querySelector('#btnActionForm').classList.replace('btn-primary','btn-info');
    document.querySelector('#btnText').innerHTML = 'Actualizar';

    var secID   = idSEC;
    var request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
    var ajaxUrl = base_url+"Vshorary/getVshorary/"+secID;

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

                // COMBO: Horario
                document.querySelector('#listDaynum').value = objData.data.DAYNUM;
                $('#listDaynum').selectpicker('render');
                document.querySelector('#listHornum').value = objData.data.HORNUM;
                $('#listHornum').selectpicker('render');

                // Año Lectivo
                document.querySelector('#listPerios').value = objData.data.PERIOS;

                $('#modalformVshorary').modal('show');
            }else{
                swal("Error",objData.msg,"error");
            }
        }
    }
}


// ELIMINAR HORARIO
function fntDelVshorary(secID)
{
    let idSec = secID;
          
    swal({
        title: "Eliminar Horario",
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
                let ajaxUrl = base_url+'Vshorary/delVshorary/';
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
                            TablaVshorary.ajax.reload(null,false);
                        }else{
                            swal("Atenciòn!",objData.msg,"error");
                        }
                    }
                }
            }
        });
}
