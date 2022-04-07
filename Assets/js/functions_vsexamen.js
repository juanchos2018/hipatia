var TablaVsexamen;

$(document).ready(function() {

        TablaVsexamen = $('#TableVsexamen').DataTable({

    	"ajax": {
    		"url": base_url+"Vsexamen/getVsexamens",
    		"dataSrc":""
    	},
        "columns":[
            {"data": "options"},
            {"data": "FECREG"},
            {"data": "PARCIA"},
            {"data": "SEC_NM"},
            {"data": "PARALE"},
            {"data": "MAT_NM"},
            {"data": "SCHEDU"},
            {"data": "LAS_NM"},
            {"data": "ELAS_NM"}
        ],
        searchPanes:{
            cascadePanes: true,
            dtOpts: {
                dom:'tp',
                searching:false
            }
        },
        dom: 'BlfrtipP',
        columnDefs: [
            {
                searchPanes: {
                show: false
                },
            },

            { 'className': "anchofecha", "targets": [ 0 ]},
            { 'className': "anchofecha", "targets": [ 1 ]},
            { 'className': "anchocelda", "targets": [ 2 ]},
            { 'className': "anchofecha", "targets": [ 3 ]},
            { 'className': "anchocelda", "targets": [ 4 ]},
            { 'className': "anchocelda", "targets": [ 5 ]},
            { 'className': "anchocelda", "targets": [ 6 ]},
            { 'className': "anchocelda", "targets": [ 7 ]},
            { 'className': "anchocelda", "targets": [ 8 ]}
        ],
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
                "className": "btn btn-danger",
                "orientation": 'landscape',
                "pageSize": 'A4'
            }
        ],
    	responsive:true,
    	destroy:true,
    	"displayLength":10,
		"order":[[0,"asc"]]
    });
    

    // AGREGAR EXAMEN
    var formVsexamen = document.querySelector("#formVsexamen");
   	formVsexamen.onsubmit = function(e)
   	{
   		e.preventDefault(); //previene que se recargue el formulario o pagina ....

        let request  = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');		
  		let ajaxUrl  = base_url+"Vsexamen/setVsexamen";
		let formData = new FormData(formVsexamen);
			
   		request.open("POST",ajaxUrl,true);
		request.send(formData);	
		request.onreadystatechange = function()
   		{
   			if(request.readyState == 4 && request.status == 200)
   			{					 
   				var objData = JSON.parse(request.responseText);
   				if(objData.status)
   				{
                    $('#modalformVsexamen').modal('hide');
                    formVsexamen.reset();
                    swal('Examen',objData.msg,'success');
                    TablaVsexamen.ajax.reload(null,false);
   				}else{
   					swal('ERROR: ',objData.msg,'error');
   				}
   			}    			
   		}
   	}
});


// EXAMEN
function openModalExa()
{  
    $nulo = "";
    document.querySelector('#idSec_id').value = 0;

    $('#listSec_no').selectpicker('val',$nulo);
    $('#listSec_no').attr('disabled',false);

    $('#listMat_no').selectpicker('val',$nulo);
    $('#listMat_no').attr('disabled',false);

    $('#listStd_no').selectpicker('val',$nulo);
    $('#listStd_no').attr('disabled',false);

    document.querySelector('#listParcia').value = "";
    $('#listParcia').selectpicker('render');

    document.querySelector('#titleModal').innerHTML = 'Nuevo Examen';
    document.querySelector('.modal-header').classList.replace('headerUpdate','headerRegister');
    document.querySelector('#btnActionForm').classList.replace('btn-info','btn-primary');
    document.querySelector('#btnText').innerHTML = 'Guardar';

    document.querySelector("#formVsexamen").reset();
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

    $("#modalformVsexamen").modal('show');
}


// VISUALIZAR EXAMEN
function fntVieVsexamen(idSec)
{
    let request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
    let ajaxUrl = base_url+'Vsexamen/getActivity/'+idSec;

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
                document.querySelector('#cellFechaMaxima').innerHTML    = $actividad['FECINI'];
                document.querySelector('#cellPeriodo').innerHTML        = $actividad['PARCIA'];
                document.querySelector('#cellAnioLectivo').innerHTML    = $actividad['PERIOS'];
                document.querySelector('#cellDescripcion').innerHTML    = $actividad['SCHEDU'];

                $('#modalViewVsexamen').modal('show');
            }else{
                swal("Error !", objData.msg, "error");
            }           
        }
    }
}


// EDITAR EXAMEN
function fntEdiVsexamen(idSEC)
{
    document.querySelector('#titleModal').innerHTML = 'Editar Examen';
    document.querySelector('.modal-header').classList.replace('headerRegister','headerUpdate');
    document.querySelector('#btnActionForm').classList.replace('btn-primary','btn-info');
    document.querySelector('#btnText').innerHTML = 'Actualizar';

    var secID   = idSEC;
    var request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
    var ajaxUrl = base_url+"Vsexamen/getVsexamen/"+secID;

    request.open("GET",ajaxUrl,true);
    request.send();
    
    request.onreadystatechange = function()
    {
        if(request.readyState == 4 && request.status == 200)
        {
            var objData = JSON.parse(request.responseText);
            if(objData.status)
            {   
                // ID Actividad
                document.querySelector('#idSec_id').value = objData.data.SEC_ID;

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

                // Año Lectivo
                document.querySelector('#listPerios').value = objData.data.PERIOS;

                // Fecha de Registro
                document.querySelector('#datFecreg').value = objData.data.FECREG;

                // Fecha de Cumplimiento
                document.querySelector('#datFecini').value = objData.data.FECINI;

                // COMBO: Parcial
                $opcion = objData.data.PARCIA;
                $opcion2 = $opcion.substring(0,4);
                document.querySelector('#listParcia').value = $opcion2;
                $('#listParcia').selectpicker('render');

                // Agenda
                document.querySelector('#txtSchedu').value = objData.data.SCHEDU;

                $("#modalformVsexamen").modal('show');
            }else{
                swal("Error",objData.msg,"error");
            }
        }
    }
}


// ELIMINAR ACTIVIDAD
function fntDelVsexamen(secID)
{
    let idSec = secID;
          
    swal({
        title: "Eliminar Registro",
        text: "¿Realmente quiere eliminar el Registro ?",
        type: "warning",
        showCancelButton: true,
        confirmButtonText: "Sì, Eliminar!",
        cancelButtonText: "No, Cancelar",
        closeOnConfirm: false,
        closeOnCancel: true
        }, function(isConfirm) {
        if(isConfirm)
        {
            let request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
            let ajaxUrl = base_url+'Vsexamen/delVsexamen/';
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
                        TablaVsexamen.ajax.reload(null,false);
                    }else{
                        swal("Atenciòn!",objData.msg,"error");
                    }
                }
            }
        }
   });
}
