var TablaVsnotify;

$(document).ready(function() {
        TablaVsnotify = $('#TableVsnotify').DataTable({
    	"language":{
			"url": "//cdn.datatables.net/plug-ins/1.10.22/i18n/Spanish.json"	
		},
    	"ajax": {
    		"url": base_url+"Vsnotify/getVsnotifys",
    		"dataSrc":""
    	},
        "columns":[
            {"data": "options"},
			{"data": "FECREG"},
            {"data": "CLAIMS"},
            {"data": "SEC_NM"},
            {"data": "MAT_NM"},
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


    // AGREGAR NOTIFICACION
    var formVsnotify = document.querySelector("#formVsnotify");
    var formVsnotstd = document.querySelector("#formVsnotstd");
    let divLoading = document.querySelector('#divLoading');
   	formVsnotify.onsubmit = function(e)
   	{
   		e.preventDefault(); //previene que se recargue el formulario o pagina...
 		
		var request  = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');		
   		var ajaxUrl  = base_url+"Vsnotify/setVsnotify";
		var formData = new FormData(formVsnotify);
			
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
   					$('#modalformVsnotify').modal('hide');
                    swal('Notificación',objData.msg,'success');                      
                    TablaVsnotify.ajax.reload(null,false);	
   				}else{
  					swal('ERROR: ',objData.msg,'error');
   				}
                divLoading.style.display = "none";
            }
   		}
   	}

    // AGREGAR RECLAMO
   	formVsnotstd.onsubmit = function(e)
   	{
   		e.preventDefault(); //previene que se recargue el formulario o pagina...
 		
		var request  = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');		
   		var ajaxUrl  = base_url+"Vsnotify/setVsnotstd";
		var formData = new FormData(formVsnotstd);

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
   					$('#modalformVsnotstd').modal('hide');
                    swal('Reclamo',objData.msg,'success');                      
                    TablaVsnotify.ajax.reload(null,false);	
   				}else{
  					swal('ERROR: ',objData.msg,'error');
   				}
                divLoading.style.display = "none";
            } 
   		}
   	}
});


// NOTIFICACION
function openModalNot()
{
    document.querySelector('#idSec_id').value = 0;
    document.querySelector('#listSec_no').value = "";
    $('#listSec_no').selectpicker('render');
    document.querySelector('#listMat_no').value = "";
    $('#listMat_no').selectpicker('render');
    document.querySelector('#listStd_no').value = "";
    $('#listStd_no').selectpicker('render');

    document.querySelector('#titleModal').innerHTML = 'Nueva Notificación';
    document.querySelector('.modal-header').classList.replace('headerUpdate','headerRegister');
    document.querySelector('#btnActionForm').classList.replace('btn-info','btn-primary');
    document.querySelector('#btnText').innerHTML = 'Guardar';

    document.querySelector("#formVsnotify").reset();
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

    $("#modalformVsnotify").modal('show');
}


// RECLAMO
function openModalNov()
{
    document.querySelector('#idSec_id').value = 0;
    document.querySelector('#listMat_n3').value = "";
    $('#listMat_n3').selectpicker('render');

    document.querySelector("#formVsnotstd").reset();
    fntGetPerios();

    var fecha   = new Date(); //Fecha actual
    var dia     = fecha.getDate(); //obteniendo dia
    var mes     = fecha.getMonth()+1; //obteniendo mes
    var ano     = fecha.getFullYear(); //obteniendo año

    if(dia<10)
      dia='0'+dia; //agrega cero si el menor de 10
    if(mes<10)
      mes='0'+mes //agrega cero si el menor de 10
    document.getElementById('datFecre2').value = ano + "-" + mes + "-" + dia;

    $("#modalformVsnotstd").modal('show');
}


// VISUALIZAR NOTIFICACION
function fntViewVsnotify(idSec)
{
    let request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
    let ajaxUrl = base_url+'Vsnotify/getNotify/'+idSec;

    request.open("GET",ajaxUrl,true);
    request.send();

    request.onreadystatechange = function()
    {
        if(request.readyState == 4 && request.status == 200)
        {
            let objData = JSON.parse(request.responseText);
            if(objData.status)
            {
                let $actividad      = objData.data.actividad;

                document.querySelector('#cellSeccion').innerHTML        = $actividad['SEC_NM'];
                document.querySelector('#cellParalelo').innerHTML       = $actividad['PARALE'];
                document.querySelector('#cellAsignatura').innerHTML     = $actividad['MAT_NM'];
                document.querySelector('#cellEstudiante').innerHTML     = $actividad['LAS_NM'] + ' ' + $actividad['FIR_NM'] ;
                document.querySelector('#cellFechaInicio').innerHTML    = $actividad['FECREG'];
                document.querySelector('#cellDescripcion').innerHTML    = $actividad['SCHEDU'];
                document.querySelector('#cellAnioLectivo').innerHTML    = $actividad['PERIOS'];
                
                $('#modalViewVsnotify').modal('show');
            }else{
                swal("Error !", objData.msg, "error");
            }           
        }
    }
}


// EDITAR NOTIFICACION
function fntEditVsnotify(idSEC)
{
    document.querySelector('#titleModal').innerHTML = 'Editar Notificación';
    document.querySelector('.modal-header').classList.replace('headerRegister','headerUpdate');
    document.querySelector('#btnActionForm').classList.replace('btn-primary','btn-info');
    document.querySelector('#btnText').innerHTML = 'Actualizar';

    var secID   = idSEC;
    var request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
    var ajaxUrl = base_url+"Vsnotify/getVsnotify/"+secID;

    request.open("GET",ajaxUrl,true);
    request.send();

    request.onreadystatechange = function()
    {
        if(request.readyState == 4 && request.status == 200)
        {
            var objData = JSON.parse(request.responseText);
            if(objData.status)
            {               
                // ID Notificación
                document.querySelector('#idSec_id').value = objData.data.SEC_ID;

                // Año Lectivo
                document.querySelector('#listPerios').value = objData.data.PERIOS;

                // Hora
                document.querySelector('#txtHorreg').value = objData.data.HORREG;

                // Docente
                document.querySelector('#listEmp_no').value = objData.data.EMP_NO;

                // COMBO: Sección
                document.querySelector('#listSec_no').value = objData.data.SEC_NO;
                $('#listSec_no').selectpicker('render');

                // COMBO: Asignatura
                document.querySelector('#listMat_no').value = objData.data.MAT_NO;
                $('#listMat_no').selectpicker('render');

                // COMBO: Estudiante
                document.querySelector('#listStd_no').value = objData.data.STD_NO;
                $('#listStd_no').selectpicker('render');

                // Fecha de Registro
                document.querySelector('#datFecreg').value = objData.data.FECREG;

                // Notificación
                document.querySelector('#txtSchedu').value = objData.data.SCHEDU;

                $('#modalformVsnotify').modal('show');
            }else{
                swal("Error",objData.msg,"error");
            }
        }
    }
}


// EDITAR RECLAMO
function fntEditVsnotstd(idSEC)
{
    document.querySelector('#titleModal').innerHTML = 'Editar Reclamo';
    document.querySelector('.modal-header').classList.replace('headerRegister','headerUpdate');
    document.querySelector('#btnActionForm').classList.replace('btn-primary','btn-info');
    document.querySelector('#btnText').innerHTML = 'Actualizar';

    var secID   = idSEC;
    var request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
    var ajaxUrl = base_url+"Vsnotify/getVsnotify/"+secID;

    request.open("GET",ajaxUrl,true);
    request.send();

    request.onreadystatechange = function()
    {
        if(request.readyState == 4 && request.status == 200)
        {
            var objData = JSON.parse(request.responseText);
            if(objData.status)
            {               
                // ID Notificación
                document.querySelector('#idSec_id').value = objData.data.SEC_ID;

                // Año Lectivo
                document.querySelector('#listPerio2').value = objData.data.PERIOS;

                // Hora
                document.querySelector('#txtHorreg').value = objData.data.HORREG;

                // COMBO: Estudiante
                document.querySelector('#listStd_n3').value = objData.data.STD_NO;
                $('#listStd_n3').selectpicker('render');

                // COMBO: Asignatura
                document.querySelector('#listMat_n3').value = objData.data.MAT_NO;
                $('#listMat_n3').selectpicker('render');

                // Fecha de Registro
                document.querySelector('#datFecre2').value = objData.data.FECREG;

                // Notificación
                document.querySelector('#txtSchedu').value = objData.data.SCHEDU;

                $('#modalformVsnotstd').modal('show');
            }else{
                swal("Error",objData.msg,"error");
            }
        }
    }
}
