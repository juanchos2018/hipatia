var TablaVsactsec;

$(document).ready(function()
{

    TablaVsactsec = $('#TableVsactsec').DataTable({
    	"language":{
			"url": "//cdn.datatables.net/plug-ins/1.10.22/i18n/Spanish.json"	
		},
    	"ajax": {
    		"url": base_url+"Vsactsec/getVsactsecs",
    		"dataSrc":""
    	},
        "columns":[
            {"data": "options"},
            {"data": "SEC_NM"},
            {"data": "PARALE"},
            {"data": "JOR_NO"}
		],
    	responsive:true,
    	destroy:true,
    	"displayLength":10,
		"order":[[0,"asc"]]
    });


    formVsactsec.onsubmit = function(e)
    {
        e.preventDefault();

        let request  = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');     
        let ajaxUrl  = base_url+"Vsactsec/prnActSec";
        let formData = new FormData(formVsactsec);

        request.open("POST",ajaxUrl,true);
        request.send(formData); 

        request.onreadystatechange = function()
        {
            if(request.readyState == 4 && request.status == 200)
            {   
                $('#modalformVsactsec').modal('hide');
                $('.modal-body').html(request.responseText);
                $('#modvsSecPrn').modal('show');
            }
        }
    }
});


function fntEditVsactsec(idSTD)
{
    var stdID   = idSTD;
    var request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
    var ajaxUrl = base_url+"Vsactsec/getVsactsec/"+stdID;

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
             
                fntGetPerios();
                $('#modalformVsactsec').modal('show');
            }else{
                swal("Error",objData.msg,"error");
            }
        }
    }
}
