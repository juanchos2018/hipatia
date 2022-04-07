var TablaVsmatter;

$(document).ready(function() {
        TablaVsmatter = $('#TableVsmatter').DataTable({
    	"language":{
			"url": "//cdn.datatables.net/plug-ins/1.10.22/i18n/Spanish.json"	
		},
    	"ajax": {
    		"url": base_url+"Vsmatter/getVsmatters",
    		"dataSrc":""
    	},
        "columns":[
            {"data": "options"},
            {"data": "MAT_NM"},
            {"data": "REGIME"},
            {"data": "CALIFI"}
        ],
    	responsive:true,
    	destroy:true,
    	"displayLength":10,
		"order":[[0,"asc"]]
    });


    // AGREGAR ASIGNATURA
    var formVsmatter = document.querySelector("#formVsmatter");
    formVsmatter.onsubmit = function(e)
    {
    	e.preventDefault(); //previene que se recargue el formulario o pagina...

		var request  = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');		
    	var ajaxUrl  = base_url+"Vsmatter/setVsmatter";
		var formData = new FormData(formVsmatter);
			
    	request.open("POST",ajaxUrl,true);
		request.send(formData);	
		request.onreadystatechange = function()
    	{
    		if(request.readyState == 4 && request.status == 200)
    		{
    			var objData = JSON.parse(request.responseText);	
    			if(objData.status)
    			{
                    $('#modalformVsmatter').modal('hide');
                    swal('Asignatura',objData.msg,'success');
                    TablaVsmatter.ajax.reload(null,false);
        		}else{
    	    		swal('ERROR: ',objData.msg,'error');
    			}
    		}    			
   		}
   	}
});


// ASIGNATURA
function openModalMat()
{
    document.querySelector("#idMat_no").value = 0;
    document.querySelector('#titleModal').innerHTML = 'Nueva Asignatura';
    document.querySelector('.modal-header').classList.replace('headerUpdate','headerRegister');
    document.querySelector('#btnActionForm').classList.replace('btn-info','btn-primary');
    document.querySelector('#btnText').innerHTML = 'Guardar';

    document.querySelector('#listRegime').value = "";
    $('#listRegime').selectpicker('render');
    document.querySelector('#listCalifi').value = "";
    $('#listCalifi').selectpicker('render');
    document.querySelector('#listPromed').value = "";
    $('#listPromed').selectpicker('render');
    document.querySelector('#listMat_n2').value = 0;
    $('#listMat_n2').selectpicker('render');

    document.querySelector("#formVsmatter").reset();
	$("#modalformVsmatter").modal('show');
}


// EDITAR ASIGNATURA
function fntEditVsmatter(idMAT)
{
    document.querySelector('#titleModal').innerHTML = 'Editar Asignatura';
    document.querySelector('.modal-header').classList.replace('headerRegister','headerUpdate');
    document.querySelector('#btnActionForm').classList.replace('btn-primary','btn-info');
    document.querySelector('#btnText').innerHTML = 'Actualizar';

    var matID   = idMAT;
    var request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
    var ajaxUrl = base_url+"Vsmatter/getVsmatter/"+matID;

    request.open("GET",ajaxUrl,true);
    request.send();

    request.onreadystatechange = function()
    {
        if(request.readyState == 4 && request.status == 200)
        {
            var objData = JSON.parse(request.responseText);
            if(objData.status)
            {  
                // ID Asignatura
                document.querySelector('#idMat_no').value = objData.data.MAT_NO;

                // Nombre
                document.querySelector('#txtMat_nm').value = objData.data.MAT_NM;

                // COMBO: Régimen
                document.querySelector('#listRegime').value = objData.data.REGIME;
                $('#listRegime').selectpicker('render');

				// COMBO: Tipo Calificación
                document.querySelector('#listCalifi').value = objData.data.CALIFI;
                $('#listCalifi').selectpicker('render');

                // COMBO: Tipo Calculo
                document.querySelector('#listPromed').value = objData.data.PROMED;
                $('#listPromed').selectpicker('render');
                
                // Ebook
                document.querySelector('#txtEbooks').value = objData.data.EBOOKS;

                // COMBO: Grupo
                document.querySelector('#listMat_n2').value = objData.data.GRU_NO;
                $('#listMat_n2').selectpicker('render');

                // Escalas CUantitativas
                document.querySelector('#intCuan10').value = objData.data.CUAN10;
                document.querySelector('#intCuan09').value = objData.data.CUAN09;
                document.querySelector('#intCuan08').value = objData.data.CUAN08;
                document.querySelector('#intCuan07').value = objData.data.CUAN07;
                document.querySelector('#intCuan06').value = objData.data.CUAN06;
                document.querySelector('#intCuan05').value = objData.data.CUAN05;
                document.querySelector('#intCuan04').value = objData.data.CUAN04;
                document.querySelector('#intCuan03').value = objData.data.CUAN03;
                document.querySelector('#intCuan02').value = objData.data.CUAN02;
                document.querySelector('#intCuan01').value = objData.data.CUAN01;

                // Escalas CUalitativas
                document.querySelector('#txtCual10').value = objData.data.CUAL10;
                document.querySelector('#txtCual09').value = objData.data.CUAL09;
                document.querySelector('#txtCual08').value = objData.data.CUAL08;
                document.querySelector('#txtCual07').value = objData.data.CUAL07;
                document.querySelector('#txtCual06').value = objData.data.CUAL06;
                document.querySelector('#txtCual05').value = objData.data.CUAL05;
                document.querySelector('#txtCual04').value = objData.data.CUAL04;
                document.querySelector('#txtCual03').value = objData.data.CUAL03;
                document.querySelector('#txtCual02').value = objData.data.CUAL02;
                document.querySelector('#txtCual01').value = objData.data.CUAL01;

                $('#modalformVsmatter').modal('show');
            }else{
                swal("Error",objData.msg,"error");
            }
        }
    }
}


// ELIMINAR ASIGNATURA
function fntDelVsmatter(secID)
{
    let idSec = secID;
          
    swal({
        title: "Eliminar Asignatura",
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
                let ajaxUrl = base_url+'Vsmatter/delVsmatter/';
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
                            TablaVsmatter.ajax.reload(null,false);
                        }else{
                            swal("Atenciòn!",objData.msg,"error");
                        }
                    }
                }
            }
    });
}
