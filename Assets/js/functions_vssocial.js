var TablaVssocial;

$(document).ready(function() {
        TablaVssocial = $('#TableVssocial').DataTable({
    	"language":{
			"url": "//cdn.datatables.net/plug-ins/1.10.22/i18n/Spanish.json"	
		},
    	"ajax": {
    		"url": base_url+"Vssocial/getVssocials",
    		"dataSrc":""
    	},
        "columns":[
            {"data": "options"},
			{"data": "SEC_ID"},
			{"data": "FECREG"},
            {"data": "CAS_NO"},
            {"data": "LAS_NM"},
            {"data": "FIR_NM"}
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


    // AGREGAR HISTORIA SOCIAL
    var formVssocial = document.querySelector("#formVssocial");
   	formVssocial.onsubmit = function(e)
   	{
   		e.preventDefault(); //previene que se recargue el formulario o pagina...

		var request  = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');		
   		var ajaxUrl  = base_url+"Vssocial/setVssocial";
		var formData = new FormData(formVssocial);
			
   		request.open("POST",ajaxUrl,true);
		request.send(formData);	
		request.onreadystatechange = function()
   		{
   			if(request.readyState == 4 && request.status == 200)
   			{	
   				var objData = JSON.parse(request.responseText);	
   				if(objData.status)
   				{
                    $('#modalformVssocial').modal('hide');
   					swal('Historia',objData.msg,'success');
   					TablaVssocial.ajax.reload(null,false);
   				}else{
   					swal('ERROR: ',objData.msg,'error');
  				}
   			}    			
   		}
   	}
});


// HISTORIA SOCIAL
function openModalSoc()
{
    document.querySelector('#idSec_id').value = 0;
    document.querySelector('#listStd_no').value = "";
    $('#listStd_no').selectpicker('render');
    
    document.querySelector('#titleModal').innerHTML = 'Nueva Historia Social';
    document.querySelector('.modal-header').classList.replace('headerUpdate','headerRegister');
    document.querySelector('#btnActionForm').classList.replace('btn-info','btn-primary');
    document.querySelector('#btnText').innerHTML = 'Guardar';

    document.querySelector("#formVssocial").reset();

    var fecha   = new Date(); //Fecha actual
    var dia     = fecha.getDate(); //obteniendo dia
    var mes     = fecha.getMonth()+1; //obteniendo mes
    var ano     = fecha.getFullYear(); //obteniendo año

    if(dia<10)
      dia='0'+dia; //agrega cero si el menor de 10
    if(mes<10)
      mes='0'+mes //agrega cero si el menor de 10
    document.getElementById('datFecreg').value = ano + "-" + mes + "-" + dia;

    $("#modalformVssocial").modal('show');
}


// EDITAR HISTORIA SOCIAL
function fntEditVssocial(idSEC)
{
    document.querySelector('#titleModal').innerHTML = 'Editar Historia Social';
    document.querySelector('.modal-header').classList.replace('headerRegister','headerUpdate');
    document.querySelector('#btnActionForm').classList.replace('btn-primary','btn-info');
    document.querySelector('#btnText').innerHTML = 'Actualizar';

    var secID   = idSEC;
    var request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
    var ajaxUrl = base_url+"Vssocial/getVssocial/"+secID;

    request.open("GET",ajaxUrl,true);
    request.send();

    request.onreadystatechange = function()
    {
        if(request.readyState == 4 && request.status == 200)
        {
            var objData = JSON.parse(request.responseText);
            if(objData.status)
            {               
                // ID Historia
                document.querySelector('#idSec_id').value = objData.data.SEC_ID;

                // Tipo de Historia
                document.querySelector('#txtHiscod').value = objData.data.HISCOD;

                // COMBO: Estudiante
                document.querySelector('#listStd_no').value = objData.data.STD_NO;
                $('#listStd_no').selectpicker('render');

                // COMBO: Tipo de Caso
                document.querySelector('#listCas_no').value = objData.data.CAS_NO;
                $('#listCas_no').selectpicker('render');

                // Fecha de Registro
                document.querySelector('#datFecreg').value = objData.data.FECREG;

                // Fecha de Proxima atencion
                document.querySelector('#datFecnex').value = objData.data.FECNEX;

                // Problema
                document.querySelector('#txtProble').value = objData.data.PROBLE;

                // Diagnostico 
                document.querySelector('#txtExplor').value = objData.data.EXPLOR;

                // Tratamiento
                document.querySelector('#txtTratam').value = objData.data.TRATAM;

                // Recomendaciones
                document.querySelector('#txtRemark').value = objData.data.REMARK;

                $('#modalformVssocial').modal('show');
            }else{
                swal("Error",objData.msg,"error");
            }
        }
    }
}
