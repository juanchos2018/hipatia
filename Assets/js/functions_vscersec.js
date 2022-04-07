$(document).ready(function() {
    $('#TableVscersec').DataTable({
    	"language":{
			"url": "//cdn.datatables.net/plug-ins/1.10.22/i18n/Spanish.json"	
		},
    	"ajax": {
    		"url": ""+base_url+"Vscersec/getVscersecs",
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


    // EVENTO CLIC DEL BOTON IMPRIMIR CERTIFICADO
    $('#btnPrnCerSec').on('click',function()
    {
        let request  = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');     
        let ajaxUrl  = base_url+"Vscersec/prnCerSec";
        let formData = new FormData(formVscersec); 
            
        request.open("POST",ajaxUrl,true);
        request.send(formData); 

        request.onreadystatechange = function()
        {
            if(request.readyState == 4 && request.status == 200)
            {
                $('#modalformVscersec').modal('hide');
                $('.modal-body').html(request.responseText);
                $('#modSecCer').modal('show');
            }
        }
    });
});


// EDITAR CERTIFICADO POR SECCION
function fntEditVscersec(idSEC)
{
    var secID   = idSEC;
    var request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
    var ajaxUrl = base_url+"Vscersec/getVscersec/"+secID;

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

                var fecha   = new Date(); //Fecha actual
                var dia     = fecha.getDate(); //obteniendo dia
                var mes     = fecha.getMonth()+1; //obteniendo mes
                var ano     = fecha.getFullYear(); //obteniendo año
            
                if(dia<10)
                  dia='0'+dia; //agrega cero si el menor de 10
                if(mes<10)
                  mes='0'+mes //agrega cero si el menor de 10
                document.getElementById('datFecreg').value = ano + "-" + mes + "-" + dia;

                $('#modalformVscersec').modal('show');
            }else{
                swal("Error",objData.msg,"error");
            }
        }
    }
}
