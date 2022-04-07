var TablaVsactmat;

$(document).ready(function() {
    TablaVsactmat = $('#TableVsactmat').DataTable({
    	"language":{
			"url": "//cdn.datatables.net/plug-ins/1.10.22/i18n/Spanish.json"	
		},
    	"ajax": {
    		"url": base_url+"Vsactmat/getVsactmats",
    		"dataSrc":""
    	},
        "columns":[
            {"data": "options"},
            {"data": "PERIOS"},
            {"data": "SEC_NM"},
            {"data": "MAT_NM"},
            {"data": "REGIME"},
            {"data": "LAS_NM"}
        ],
        "columnDefs": [
			{ 'className': "anchocelda", "targets": [ 0 ]},
			{ 'className': "anchocelda", "targets": [ 1 ]},
			{ 'className': "anchocelda", "targets": [ 2 ]},
			{ 'className': "anchocelda", "targets": [ 3 ]},
			{ 'className': "anchocelda", "targets": [ 4 ]},
			{ 'className': "anchocelda", "targets": [ 5 ]}
	    ],
		responsive:true,
    	destroy:true,
    	"displayLength":10,
		"order":[[0,"asc"]]
    });


    // EVENTO CLIC DEL BOTON IMPRIMIR ACTA
    $('#btnPrnActMat').on('click',function()
    {
        let request  = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');     
        let ajaxUrl  = base_url+"Vsactmat/prnActMat";
        let formData = new FormData(formVsactmat);

        request.open("POST",ajaxUrl,true);
        request.send(formData); 

        request.onreadystatechange = function()
        {
            if(request.readyState == 4 && request.status == 200)
            {   
                $('#modalformVsactmat').modal('hide');
                $('.modal-body').html(request.responseText);
                $('#modvsActPrn').modal('show');
            }
        }
    });
});


// EDITAR ACTA DE CALIFICACIONES
function fntEditVsactmat(idSTD)
{
    let stdID   = idSTD;
    let request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
    let ajaxUrl = base_url+"Vsactmat/getVsactmat/"+stdID;

    request.open("GET",ajaxUrl,true);
    request.send();
    request.onreadystatechange = function()
    {
        if(request.readyState == 4 && request.status == 200)
        {
            var objData = JSON.parse(request.responseText);
            if(objData.status)
            {  
                // COMBO: Sección
			    document.querySelector('#listSec_no').value = objData.data.SEC_NO;
			    $('#listSec_no').selectpicker('render');

			    // COMBO: Asignatura
			    document.querySelector('#listMat_no').value = objData.data.MAT_NO;
			    $('#listMat_no').selectpicker('render');
		  
			    // COMBO: Periodo
			    document.querySelector('#listParci4').value = "";
			    $('#listParci4').selectpicker('render');

			    // COMBO: Año
			    document.querySelector('#listPerios').value = objData.data.PERIOS;
			    $('#listPerios').selectpicker('render');
                
                $('#modalformVsactmat').modal('show');
            }else{
                swal("Error",objData.msg,"error");
            }
        }
    }
}
