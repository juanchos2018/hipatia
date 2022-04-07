var TablaVschedul;

$(document).ready(function() {

        TablaVschedul = $('#TableVschedul').DataTable({

    	"ajax": {
    		"url": base_url+"Vschedul/getVscheduls",
    		"dataSrc":""
    	},
        "columns":[
            {"data": "options"},
            {"data": "FECREG"},
            {"data": "SEC_NM"},
            {"data": "MAT_NM"},
            {"data": "LAS_NM"},
            {"data": "PUNTAJ"},
            {"data": "SCHEDU"},
            {"data": "PARCIA"},
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

                { 'className': "anchocelda", "targets": [ 0 ]},
                { 'className': "anchocelda", "targets": [ 1 ]},
                { 'className': "anchocelda", "targets": [ 2 ]},
                { 'className': "anchocelda", "targets": [ 3 ]},
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
    

    //Se selecciona Archivo para la Actividad del Profesor y se lo previsualiza .....
    if(document.querySelector("#flActividad"))
    {
            var flActividad = document.querySelector("#flActividad");
            flActividad.onchange = function(e) {
            var uploadFile = document.querySelector("#flActividad").value;
            var archive = document.querySelector("#flActividad").files;

            var extPermitidas = /(.pdf|.mp4|.rar|.webm|.docx|.doc|.xlsx)$/i;
            if(uploadFile !='')
            {
                let type = archive[0].type;
                var name = archive[0].name;
                let archiveURL = URL.createObjectURL(flActividad.files[0]);

                if(!extPermitidas.exec(uploadFile))
                {
                    swal("ERROR","Formato de archivo no permitido","error");
                    document.querySelector(".prevFile").classList.add("notBlock");
                    document.querySelector(".delFile").classList.add("notBlock");
                    flActividad.value="";
                    document.querySelector('#visorArchivo').innerHTML = "";
                    return false;
                }else{  
                        switch(type)
                        {
                            case "application/pdf": document.querySelector(".prevFile").classList.remove("notBlock");
                                                    document.querySelector(".delFile").classList.remove("notBlock");
                                                    document.querySelector('#visorArchivo').innerHTML = '<iframe height="250" width="350" src="'+archiveURL+'"></iframe>';
                                                    break;
                            case "video/webm":
                            case "video/mp4": document.querySelector(".prevFile").classList.remove("notBlock");
                                              document.querySelector(".delFile").classList.remove("notBlock");
                                              document.querySelector('#visorArchivo').innerHTML = '<video width="350" height="250" controls="controls"><source src="'+archiveURL+'" type="'+type+'"> <p>Tu browser no soporta video</p> </video>';
                                              break;
                            default: document.querySelector('#visorArchivo').innerHTML = "";
                                     break;
                        }
                    }
            }else{
                document.querySelector('#visorArchivo').innerHTML = "";
            }
        }
    }

    // Se selecciona Archivo subido por el estudiante ..
    if(document.querySelector("#flTaskStd"))
    { 
        let flTaskStd = document.querySelector("#flTaskStd");

        flTaskStd.onchange = function(e) 
        {
            let upFlStd = document.querySelector("#flTaskStd").value;
            let archive = document.querySelector("#flTaskStd").files;

            let extPermitidas = /(.pdf|.mp4|.rar|.webm|.docx|.doc|.xlsx)$/i;
            
            if(upFlStd !='')
            {
                let type = archive[0].type;
                let name = archive[0].name;
                let archiveURL = URL.createObjectURL(flTaskStd.files[0]);

                if(!extPermitidas.exec(upFlStd))
                {
                    swal("ERROR","Formato de archivo no permitido","error");
                    document.querySelector(".prevFlTask").classList.add("notBlock");
                    document.querySelector(".delFlTask").classList.add("notBlock");
                    flTaskStd.value="";
                    document.querySelector('#visorFlTask').innerHTML = "";
                    return false;
                }else{ 
                    switch(type)
                    {
                            case "application/pdf": 
                                            document.querySelector(".prevFlTask").classList.remove("notBlock");
                                            document.querySelector(".delFlTask").classList.remove("notBlock");
                                            document.querySelector('#visorFlTask').innerHTML = '<iframe height="250" width="350" src="'+archiveURL+'"></iframe>';
                                            break;
                            case "video/webm":
                            case "video/mp4": 
                                            document.querySelector(".prevFlTask").classList.remove("notBlock");
                                            document.querySelector(".delFlTask").classList.remove("notBlock");
                                            document.querySelector('#visorFlTask').innerHTML = '<video width="350" height="250" controls="controls"><source src="'+archiveURL+'" type="'+type+'"> <p>Tu browser no soporta video</p> </video>';
                                            break;
                                default: 
                                            document.querySelector('#visorFlTask').innerHTML = "";
                                            break;
                    }
                }
            }else{
                document.querySelector('#visorFlTask').innerHTML = "";
            }
        }
    }


    if(document.querySelector('.delFile'))
    {
        let delFile = document.querySelector('.delFile');
        delFile.onclick = function(e) 
        {
            let opcion = 1;
            removeFile(opcion);
        }
    }

    if(document.querySelector('.delFlTask'))
    {
        let delFlTask = document.querySelector('.delFlTask');
        delFlTask.onclick = function(e) 
        {
            let opcion = 2;
            removeFile(opcion);
        }
    }
    

    // AGREGAR ACTIVIDAD
    var formVschedul = document.querySelector("#formVschedul"); 
    let divLoading = document.querySelector('#divLoading');
    formVschedul.onsubmit = function(e)
   	{
   		e.preventDefault(); //previene que se recargue el formulario o pagina ....

        let request  = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');		
  		let ajaxUrl  = base_url+"Vschedul/setVschedul";
		let formData = new FormData(formVschedul);

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
                    $('#modalformVschedul').modal('hide');
                    formVschedul.reset();
                    swal('Actividad',objData.msg,'success');
                    TablaVschedul.ajax.reload(null,false);
   				}else{
   					swal('ERROR: ',objData.msg,'error');
   				}
                divLoading.style.display = "none";
                }
       		}
        }
});


// ---- Se valida CLICK del Botón Subir Tarea del Estudiante ----
function fntSubirTarea()
{
    let upFlStd = document.querySelector("#flTaskStd").value;
    let archive = document.querySelector("#flTaskStd").files;

    if(upFlStd != "")
    {
        // Se valida que el tamaño del archivo no exceda los 40 MB.
        if(archive[0].size > 41943040)
        {
            swal("Error !","No se permite subir archivos mayores a 40 MB.","error");
            return false;
        }else{
            let request  = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');     
            let ajaxUrl  = base_url+"Vschedul/setTaskStd";
            let formData = new FormData(formViewStd); 

            request.open("POST",ajaxUrl,true);
            request.send(formData);

            request.onreadystatechange = function()
            {
                if(request.readyState == 4 && request.status == 200)
                { 
                    let objData = JSON.parse(request.responseText);
                    if(objData.status)
                    {
                        swal('OK',objData.msg,'success');                        
                        TablaVschedul.ajax.reload(null,false);
                    }else{
                        swal('Error',objData.msg,'error');
                    }
                }
            }
        }
    }else{
        swal("Precaución !","No se ha seleccionado ningun archivo.","warning");
        return false;
    }    
}


function removeFile(opcion)
{
    if(opcion == 1)
    {
        document.querySelector('#flActividad').value ="";
        document.querySelector(".prevFile").classList.add("notBlock");
        document.querySelector('.delFile').classList.add("notBlock");     
    }else{
        document.querySelector('#flTaskStd').value ="";
        document.querySelector(".prevFlTask").classList.add("notBlock");
        document.querySelector('.delFlTask').classList.add("notBlock"); 
    }
}


// ACTIVIDAD
function openModalSch()
{
    document.querySelector(".prevFile").classList.add("notBlock");
    document.querySelector('.lblTask').classList.add("notBlock");
    document.querySelector('.lblNameTask').classList.add("notBlock");
    document.querySelector('.lblTaskStd').classList.add("notBlock");
    document.querySelector('.lblNameTaskStd').classList.add("notBlock");
    document.querySelector('#txtNameTask').value = "";
    
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
    document.querySelector('#listInsumo').value = "";
    $('#listInsumo').selectpicker('render');

    document.querySelector('#titleModal').innerHTML = 'Nueva Actividad';
    document.querySelector('.modal-header').classList.replace('headerUpdate','headerRegister');
    document.querySelector('#btnActionForm').classList.replace('btn-info','btn-primary');
    document.querySelector('#btnText').innerHTML = 'Guardar';

    document.querySelector("#formVschedul").reset();
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

    $("#modalformVschedul").modal('show');
}


// VISUALIZAR ACTIVIDAD
function fntViewSchedul(idSec)
{
    let request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
    let ajaxUrl = base_url+'Vschedul/getActivity/'+idSec;

    request.open("GET",ajaxUrl,true);
    request.send();

    request.onreadystatechange = function()
    {
        if(request.readyState == 4 && request.status == 200)
        {
            let objData = JSON.parse(request.responseText);
            if(objData.status)
            {
                let $secTaskStd     = objData.data.secId; 
                let $actividad      = objData.data.actividad;
                let $insumo         = objData.data.insumo;
                let $inst_codAMIE   = objData.data.empresa['AMI_ID'];
                let $inst_periodo   = objData.data.actividad['PERIOS'];
                let $descarga = '<a title="Descargar Archivo" href="Activity/'+$inst_codAMIE+'/'+$inst_periodo+'/dwload/'+$actividad['FLNAME']+'" download="'+$actividad['FLNAME']+'" style="color: blue; font-size:14px;"> <i class="fas fa-download"></i> </a>';

                document.querySelector('#cellSeccion').innerHTML        = $actividad['SEC_NM'];
                document.querySelector('#cellParalelo').innerHTML       = $actividad['PARALE'];
                document.querySelector('#cellAsignatura').innerHTML     = $actividad['MAT_NM'];
                document.querySelector('#cellEstudiante').innerHTML     = $actividad['LAS_NM'] + ' ' + $actividad['FIR_NM'] ;
                document.querySelector('#cellFechaInicio').innerHTML    = $actividad['FECREG'];
                document.querySelector('#cellFechaMaxima').innerHTML    = $actividad['FECMAX'];
                document.querySelector('#cellInsumo').innerHTML         = $insumo['insumo'];
                document.querySelector('#cellCalificacion').innerHTML   = $actividad['PUNTAJ'];
                document.querySelector('#cellPeriodo').innerHTML        = $actividad['PARCIAL'];
                document.querySelector('#cellDescripcion').innerHTML    = $actividad['SCHEDU'];
                document.querySelector('#cellLinkVideo').innerHTML      = $actividad['VDLINK'];
                document.querySelector('#cellAnioLectivo').innerHTML    = $actividad['PERIOS'];
                document.querySelector('#cellActividad').innerHTML      = 'No hay actividad del profesor';
                document.querySelector('#cellTareaStd').innerHTML       = 'No hay tarea subida por el estudiante';
                

                if($actividad['FLNAME'] != "")
                {
                    document.querySelector('#cellActividad').innerHTML = $actividad['FLNAME']+' '+$descarga;
                }

                if($actividad['FLTASK'] != "")
                {
                    document.querySelector('#cellTareaStd').innerHTML = $actividad['FLTASK'];
                }

                document.querySelector("#secTaskStd").value = $secTaskStd;
                document.querySelector(".prevFlTask").classList.add("notBlock");
                document.querySelector('#flTaskStd').value ="";
                $('#modalViewSchedul').modal('show');
            }else{
                swal("Error !", objData.msg, "error");
            }           
        }
    }
}


// EDITAR ACTIVIDAD
function fntEditVschedul(idSEC)
{
    document.querySelector('#titleModal').innerHTML = 'Editar Actividad';
    document.querySelector('.modal-header').classList.replace('headerRegister','headerUpdate');
    document.querySelector('#btnActionForm').classList.replace('btn-primary','btn-info');
    document.querySelector('#btnText').innerHTML = 'Actualizar';

    var secID   = idSEC;
    var request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
    var ajaxUrl = base_url+"Vschedul/getVschedul/"+secID;

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
                document.querySelector('#idSec_id').value = objData.data.actividad['SEC_ID'];

                // Hora
                document.querySelector('#txtHorreg').value = objData.data.actividad['HORREG'];

                // Docente
                document.querySelector('#listEmp_no').value = objData.data.actividad['EMP_NO'];

                // COMBO: Sección
                document.querySelector('#listSec_no').value = objData.data.actividad['SEC_NO'];
                $('#listSec_no').selectpicker('render');

                // COMBO: Asignatura
                document.querySelector('#listMat_no').value = objData.data.actividad['MAT_NO'];
                $('#listMat_no').selectpicker('render');

                // COMBO: Estudiante
                document.querySelector('#listStd_no').value = objData.data.actividad['STD_NO'];
                $('#listStd_no').selectpicker('render');

                // Año Lectivo
                document.querySelector('#listPerios').value = objData.data.actividad['PERIOS'];

                // Puntaje
                document.querySelector('#txtPuntaj').value = objData.data.actividad['PUNTAJ'];

                // Fecha de Registro
                document.querySelector('#datFecreg').value = objData.data.actividad['FECREG'];

                // Fecha de Cumplimiento
                document.querySelector('#datFecmax').value = objData.data.actividad['FECMAX'];

                // COMBO: Parcial
                $opcion = objData.data.actividad['PARCIA'];
                $opcion2 = $opcion.substring(0,4);
                document.querySelector('#listParcia').value = $opcion2;
                $('#listParcia').selectpicker('render');

                // COMBO: Insumo
                document.querySelector('#listInsumo').value = objData.data.actividad['INSUMO'];
                $('#listInsumo').selectpicker('render');

                // Agenda
                document.querySelector('#txtSchedu').value = objData.data.actividad['SCHEDU'];

                // Link Video
                document.querySelector('#txtVdlink').value = objData.data.actividad['VDLINK'];


                document.querySelector('.lblTask').classList.add("notBlock");
                document.querySelector('.lblNameTask').classList.add("notBlock");
                document.querySelector('#txtNameTask').value = "";
                
                // Archivo para Docente
                if(objData.data.actividad['FLNAME'] != "")
                {
                    document.querySelector('.lblTask').classList.remove("notBlock");
                    document.querySelector('.lblNameTask').classList.remove("notBlock");
                    document.querySelector('.lblNameTask').innerHTML = objData.data.actividad['FLNAME'];
                    document.querySelector('#txtNameTask').value = objData.data.actividad['FLNAME'];
                }

                // Link descarga Tarea del Estudiante
                document.querySelector('.lblTaskStd').classList.add("notBlock");
                document.querySelector('.lblNameTaskStd').classList.add("notBlock");
                if(objData.data.actividad['FLTASK'] != "")
                {
                    let $inst_codAMIE = objData.data.empresa['AMI_ID'];
                    let $inst_periodo = objData.data.actividad['PERIOS'];
                    let $descarga = '<a title="Descargar Archivo" href="Activity/'+$inst_codAMIE+'/'+$inst_periodo+'/upload/'+objData.data.actividad['FLTASK']+'" download="'+objData.data.actividad['FLTASK']+'" style="color: blue; font-size:14px;"> <i class="fas fa-download"></i> </a>';

                    document.querySelector('.lblTaskStd').classList.remove("notBlock");
                    document.querySelector('.lblNameTaskStd').classList.remove("notBlock");
                    document.querySelector('.lblNameTaskStd').innerHTML = objData.data.actividad['FLTASK'] + ' ' +$descarga;
                }

                document.querySelector(".prevFile").classList.add("notBlock");
                $("#modalformVschedul").modal('show');
            }else{
                swal("Error",objData.msg,"error");
            }
        }
    }
}


// ELIMINAR ACTIVIDAD
function fntDelVschedul(secID)
{
    let idSec = secID;
          
    swal({
        title: "Eliminar Registro Actividad",
        text: "¿Realmente quiere eliminar el Registro: "+idSec+" ?",
        type: "warning",
        showCancelButton: true,
        confirmButtonText: "Sì, eliminar!",
        cancelButtonText: "No, cancelar",
        closeOnConfirm: false,
        closeOnCancel: true
        }, function(isConfirm) {
        if(isConfirm)
        {
            let request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
            let ajaxUrl = base_url+'Vschedul/delVschedul/';
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
                        TablaVschedul.ajax.reload(null,false);
                    }else{
                        swal("Atenciòn!",objData.msg,"error");
                    }
                }
            }
        }
   });
}
