$(document).ready(function() {
    $('#TableVslibsec').DataTable({
    	"language":{
			"url": "//cdn.datatables.net/plug-ins/1.10.22/i18n/Spanish.json"	
		},
    	"ajax": {
    		"url": ""+base_url+"Vslibsec/getVslibsecs",
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


    // EVENTO CLIC BOTON IMPRIMIR BOLETIN
    $('#btnPrnLibSec').on('click',function()
    {
        let request  = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');     
        let ajaxUrl  = base_url+"Vslibsec/prnLibSec";
        let formData = new FormData(formVslibsec);
            
        request.open("POST",ajaxUrl,true);
        request.send(formData); 

        request.onreadystatechange = function()
        {
            if(request.readyState == 4 && request.status == 200)
            {
                $('#modalformVslibsec').modal('hide');
                $('.modal-body').html(request.responseText);
                $('#modSecBoletin').modal('show');                
            }
        }
    });
});


// EDITAR BOLETIN POR SECCION
function fntEditVslibsec(idSEC)
{
    var secID   = idSEC;
    var request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
    var ajaxUrl = base_url+"Vslibsec/getVslibsec/"+secID;

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
                $('#modalformVslibsec').modal('show');
            }else{
                swal("Error",objData.msg,"error");
            }
        }
    }
}
