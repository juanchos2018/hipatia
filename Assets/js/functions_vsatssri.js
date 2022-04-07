var TablaVsatssri;

$(document).ready(function() 
{
        TablaVsatssri = $('#TableVsatssri').DataTable({
    	"language":{
			"url": "//cdn.datatables.net/plug-ins/1.10.22/i18n/Spanish.json"	
		},
    	"ajax": {
    		"url": base_url+"Vsatssri/getVsatssris",
    		"dataSrc":""
    	},
        "columns":[
            {"data": "options"},
			{"data": "PERIOS"},
			{"data": "FECDES"},
			{"data": "FECHAS"}
        ],
        responsive:true,
    	destroy:true,
    	"displayLength":10,
		"order":[[0,"asc"]]
    });

    
    // AGREGAR ATS
    var formVsatssri = document.querySelector("#formVsatssri");
    
   	formVsatssri.onsubmit = function(e)
   	{
   		e.preventDefault(); //previene que se recargue el formulario o pagina...

		var request  = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');		
        var formData = new FormData(formVsatssri);
        var ajaxUrl  = base_url+"Vsatssri/setVsatssri";	

        request.open("POST",ajaxUrl,true);
		request.send(formData);	
		request.onreadystatechange = function()
   		{
   			if(request.readyState == 4 && request.status == 200)
   			{
   				var objData = JSON.parse(request.responseText);							
   				if(objData.status)
   				{
                    $('#modalformVsatssri').modal('hide');
   					formVsatssri.reset();
   					swal('ATS',objData.msg,'success');
  					TablaVsatssri.ajax.reload(null,false);
   				}else{
                    swal('ERROR: ',objData.msg,'error');
                }
   			}    			
   		}
   	}
});


// ATS
function openModalAts()
{
    document.querySelector("#formVsatssri").reset();
    fntGetPerios();
    $("#modalformVsatssri").modal('show');
}


// ELIMINAR ATS
function fntDelVsatssri(secID)
{
    let idSec = secID;
          
    swal({
        title: "Eliminar ATS",
        text: "¿Realmente quiere eliminar el Registro ?",
        type: "warning",
        showCancelButton: true,
        confirmButtonText: "Sì, Eliminar!",
        cancelButtonText: "No, Cancelar",
        closeOnConfirm: false,
        closeOnCancel: true
        },  function(isConfirm) 
            {
                if(isConfirm)
                {
                    let request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
                    let ajaxUrl = base_url+'Vsatssri/delVsatssri/';
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
                                TablaVsatssri.ajax.reload(null,false);
                            }else{
                                swal("Atenciòn!",objData.msg,"error");
                            }
                        }
                    }
                }
            });
}
