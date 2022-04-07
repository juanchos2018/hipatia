$(document).ready(function() {
    $('#TableVslibstd').DataTable({
    	"language":{
			"url": "//cdn.datatables.net/plug-ins/1.10.22/i18n/Spanish.json"	
		},
    	"ajax": {
    		"url": ""+base_url+"Vslibstd/getVslibstd",
    		"dataSrc":""
    	},
        "columns":[
            {"data": "options"},
            {"data": "LAS_NM"},
            {"data": "FIR_NM"},
            {"data": "ESTATU"},
            {"data": "SEC_NM"},
            {"data": "PARALE"}
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


    // EVENTO CLIC BOTON IMPRIMIR BOLETIN
    $('#btnPrnLibStd').on('click',function()
    {
        let request  = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');     
        let ajaxUrl  = base_url+"Vslibstd/prnLibStd";
        let formData = new FormData(formVslibstd);
            
        request.open("POST",ajaxUrl,true);
        request.send(formData); 

        request.onreadystatechange = function()
        {
            if(request.readyState == 4 && request.status == 200)
            {
                $('#modalformVslibstd').modal('hide');
                $('.modal-body').html(request.responseText);
                $('#modStdBoletin').modal('show');                
            }
        }
    });
});


// EDITAR CERTIFICADO POR ESTUDIANTE
function fntEditVslibstd(idSTD)
{
    var stdID   = idSTD;
    var request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
    var ajaxUrl = base_url+"Vstudent/getVstudent/"+stdID;

    request.open("GET",ajaxUrl,true);
    request.send();

    request.onreadystatechange = function()
    {
        if(request.readyState == 4 && request.status == 200)
        {
            var objData = JSON.parse(request.responseText);
            if(objData.status)
            {  
                // Año Lectivo
                document.querySelector('#listPerios').value = objData.data.PERIOS;

			    // COMBO: Estudiante
			    document.querySelector('#listStd_no').value = objData.data.STD_NO;
			    $('#listStd_no').selectpicker('render');
			  
                $('#modalformVslibstd').modal('show');
            }else{
                swal("Error",objData.msg,"error");
            }
        }
    }
}
