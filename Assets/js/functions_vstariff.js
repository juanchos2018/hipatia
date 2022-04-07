var TablaVstariff;

$(document).ready(function() {
	TablaVstariff = $('#TableVstariff').DataTable({
    	"language":{
			"url": "//cdn.datatables.net/plug-ins/1.10.22/i18n/Spanish.json"	
		},
    	"ajax": {
    		"url": base_url+"Vstariff/getVstariffs",
    		"dataSrc":""
    	},
        "columns":[
            {"data": "options"},
            {"data": "PERIOS"},
            {"data": "LAS_NM"},
            {"data": "SUB_NM"},
            {"data": "ART_NM"},
            {"data": "DOCVAL"},
            {"data": "FACVAL"},
            {"data": "ABOVAL"},
            {"data": "REMARK"}
        ],
        searchPanes:{
            cascadePanes: true,
            dtOpts: {
                dom:'tp',
                searching:false
            }
        },
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
        dom: 'BlfrtipP',
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
                "className": "btn btn-danger"
            }
        ],
		responsive:true,
    	destroy:true,
    	"displayLength":10,
		"order":[[0,"asc"]]
    });


    // AGREGAR CONVENIO
    let formVstariff = document.querySelector("#formVstariff");
    let formVsgencxc = document.querySelector("#formVsgencxc");
    let formVsstdcxc = document.querySelector("#formVsstdcxc");
  
    formVstariff.onsubmit = function(e)
    {
   		e.preventDefault(); //previene que se recargue el formulario o pagina...

		var request  = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');	
   		var ajaxUrl  = base_url+"Vstariff/setVstariff";
   		var formData = new FormData(formVstariff);

   		request.open("POST",ajaxUrl,true);
		request.send(formData);	

		request.onreadystatechange = function()
   		{
   			if(request.readyState == 4 && request.status == 200)
   			{
   				let objData = JSON.parse(request.responseText);	
   				if(objData.status)
   				{
   					$('#modalformVstariff').modal('hide');
   					swal('Convenio',objData.msg,'success');
                    TablaVstariff.ajax.reload(null,false);
   				}else{
  					swal('ERROR: ',objData.msg,'error');
   				}
   			} 
   		}
    }


    formVsgencxc.onsubmit = function(e)
    {
        e.preventDefault();

        let request  = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');     
        let ajaxUrl  = base_url+"Vstariff/prnGenCxc";
        let formData = new FormData(formVsgencxc);

        request.open("POST",ajaxUrl,true);
        request.send(formData); 
        
        request.onreadystatechange = function()
        {
			let objData = JSON.parse(request.responseText);			
			if(objData.status)
			{
				$('#modalformVsgencxc').modal('hide');
    			swal('Cuenta x Cobrar',objData.msg,'success');
				TablaVstariff.ajax.reload(null,false);
            }else{
        		swal('ERROR: ',objData.msg,'error');
            }
        }
    }


    formVsstdcxc.onsubmit = function(e)
    {
        e.preventDefault();

        let request  = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');     
        let ajaxUrl  = base_url+"Vstariff/prnStdCxc";
        let formData = new FormData(formVsstdcxc);

        request.open("POST",ajaxUrl,true);
        request.send(formData); 
        
        request.onreadystatechange = function()
        {
            if(request.readyState == 4 && request.status == 200)
            {
                $('#modalformVsstdcxc').modal('hide');
                $('.modal-body').html(request.responseText);
                $('#modvsCxcPrn').modal('show');
            }
        }
    }
});


// CONVENIO
function openModalTar()
{
    document.querySelector('#idSec_id').value = 0;
    document.querySelector('#listStd_no').value = "";
    $('#listStd_no').selectpicker('render');
    document.querySelector('#listSec_no').value = "";
    $('#listSec_no').selectpicker('render');
    document.querySelector('#listPer_no').value = "";
    $('#listPer_no').selectpicker('render');
    document.querySelector('#listArt_no').value = "";
    $('#listArt_no').selectpicker('render');

    document.querySelector('#titleModal').innerHTML = 'Nuevo Convenio';
    document.querySelector('.modal-header').classList.replace('headerUpdate','headerRegister');
    document.querySelector('#btnActionForm').classList.replace('btn-info','btn-primary');
    document.querySelector('#btnText').innerHTML = 'Guardar';

    document.querySelector("#formVstariff").reset();
    fntGetPerios();
    $("#modalformVstariff").modal('show');
}


// GENERAR CXC
function openModalGcc()
{
    document.querySelector("#formVsgencxc").reset();
    fntGetPerios();
    $("#modalformVsgencxc").modal('show');
}


// INFORME CXC
function openModalCxc()
{
    document.querySelector("#formVsstdcxc").reset();
    fntGetPerios();
    $("#modalformVsstdcxc").modal('show');
}


// EDITAR CONVENIO
function fntEditVstariff(idSEC)
{
    document.querySelector('#titleModal').innerHTML = 'Editar Convenio';
    document.querySelector('.modal-header').classList.replace('headerRegister','headerUpdate');
    document.querySelector('#btnActionForm').classList.replace('btn-primary','btn-info');
    document.querySelector('#btnText').innerHTML = 'Actualizar';

    var secID   = idSEC;
    var request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
    var ajaxUrl = base_url+"Vstariff/getVstariff/"+secID;

    request.open("GET",ajaxUrl,true);
    request.send();

    request.onreadystatechange = function()
    {
        if(request.readyState == 4 && request.status == 200)
        {
            var objData = JSON.parse(request.responseText);
            if(objData.status)
            {            
                // ID Registro
                document.querySelector('#idSec_id').value = objData.data.SEC_ID;

                // Año
                document.querySelector('#listPerios').value = objData.data.PERIOS;

                // COMBO: Estudiante
                document.querySelector('#listStd_no').value = objData.data.STD_NO;
                $('#listStd_no').selectpicker('render');

                // COMBO: Sección
                document.querySelector('#listSec_no').value = objData.data.SEC_NO;
                $('#listSec_no').selectpicker('render');

                // COMBO: Artículo
                document.querySelector('#listArt_no').value = objData.data.ART_NO;
                $('#listArt_no').selectpicker('render');

                // COMBO: Periodo
                document.querySelector('#listPer_no').value = objData.data.PER_NO;
                $('#listPer_no').selectpicker('render');

                // Valores
                document.querySelector('#txtDocval').value = objData.data.DOCVAL;
                document.querySelector('#txtFacval').value = objData.data.FACVAL;
                document.querySelector('#txtAboval').value = objData.data.ABOVAL;

                // Observación
                document.querySelector('#txtRemark').value = objData.data.REMARK;

                $('#modalformVstariff').modal('show');
            }else{
                swal("Error",objData.msg,"error");
            }
        }
    }
}
