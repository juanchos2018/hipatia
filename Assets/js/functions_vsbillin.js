var TablaVsbillin;

$(document).ready(function() {
	TablaVsbillin = $('#TableVsbillin').DataTable({
    	"language":{
			"url": "//cdn.datatables.net/plug-ins/1.10.22/i18n/Spanish.json"	
		},
    	"ajax": {
    		"url": base_url+"Vsbillin/getVsbillin",
    		"dataSrc":""
    	},
        "columns":[
            {"data": "options"},
            {"data": "FECEMI"},
            {"data": "DOCTIP"},
            {"data": "DOCPTO"},
            {"data": "DOCNUM"},
            {"data": "RUC_NO"},
            {"data": "RAZONS"},
            {"data": "DOCVAL"},
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

	
	// AGREGAR FACTURA
    let formVsbillin = document.querySelector("#formVsbillin");
    let formVsnotcre = document.querySelector("#formVsnotcre");
    let formVsdiaven = document.querySelector("#formVsdiaven");
   	formVsbillin.onsubmit = function(e)
   	{
   		e.preventDefault(); //previene que se recargue el formulario o pagina...

		var request  = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');	
   		var ajaxUrl  = base_url+"Vsbillin/setVsbillin";
   		var formData = new FormData(formVsbillin);

   		request.open("POST",ajaxUrl,true);
		request.send(formData);	

		request.onreadystatechange = function()
   		{
   			if(request.readyState == 4 && request.status == 200)
   			{					 
   				let objData = JSON.parse(request.responseText);	
   				if(objData.status)
   				{
   					$('#modalformVsbillin').modal('hide');
   					swal('Documento',objData.msg,'success');
					TablaVsbillin.ajax.reload(null,false);
   				}else{
					swal('ERROR: ',objData.msg,'error');
				}
   			}    			
   		}
   	}


    // Boton Aceptar en VSNOTCRE
	formVsnotcre.onsubmit = function(e)
   	{
   		e.preventDefault(); //previene que se recargue el formulario o pagina...
		var request  = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');	
   		var ajaxUrl  = base_url+"Vsbillin/setVsnotcre";
   		var formData = new FormData(formVsnotcre);

   		request.open("POST",ajaxUrl,true);
		request.send(formData);	

		request.onreadystatechange = function()
   		{
   			if(request.readyState == 4 && request.status == 200)
   			{					 
   				let objData = JSON.parse(request.responseText);	
   				if(objData.status)
   				{
   					$('#modalformVsnotcre').modal('hide');
   					swal('Documento',objData.msg,'success');
					TablaVsbillin.ajax.reload(null,false);
   				}else{
					swal('ERROR: ',objData.msg,'error');
				}
   			}    			
   		}
   	}


    // BOTON ACEPTAR EN INFORME DIARIO VENTAS
   	formVsdiaven.onsubmit = function(e)
	{
	   	e.preventDefault();
   
		let request  = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');     
		let ajaxUrl  = base_url+"Vsbillin/prnDiaVen";
		let formData = new FormData(formVsdiaven);
	   
		request.open("POST",ajaxUrl,true);
		request.send(formData); 
	   
		request.onreadystatechange = function()
		{
		  	if(request.readyState == 4 && request.status == 200)
			{
				$('#modalformVsdiaven').modal('hide');
				$('.modal-body').html(request.responseText);
				$('#modvsDiaPrn').modal('show');
		   	}
		}
	}
});


// FACTURA
function openModalFac()
{
    document.querySelector('#listStd_no').value = "";
    $('#listStd_no').selectpicker('render');
    document.querySelector('#listSec_no').value = "";
    $('#listSec_no').selectpicker('render');
    document.querySelector('#listFacwho').value = "";
    $('#listFacwho').selectpicker('render');
    document.querySelector('#listCltype').value = "";
    $('#listCltype').selectpicker('render');
    document.querySelector('#listPer_no').value = "";
    $('#listPer_no').selectpicker('render');

    document.querySelector('#listDoctip').value = "";
    $('#listDoctip').selectpicker('render');
    document.querySelector('#listPayfor').value = "";
    $('#listPayfor').selectpicker('render');
    document.querySelector('#listBan_no').value = "";
    $('#listBan_no').selectpicker('render');
    document.querySelector('#listTar_no').value = "";
    $('#listTar_no').selectpicker('render');

	document.querySelector("#formVsbillin").reset();
	fntGetPerios();

    var fecha   = new Date(); //Fecha actual
    var dia     = fecha.getDate(); //obteniendo dia
    var mes     = fecha.getMonth()+1; //obteniendo mes
    var ano     = fecha.getFullYear(); //obteniendo año

    if(dia<10)
      dia='0'+dia; //agrega cero si el menor de 10
    if(mes<10)
      mes='0'+mes //agrega cero si el menor de 10
    document.getElementById('datFecemi').value = ano + "-" + mes + "-" + dia;

	$("#modalformVsbillin").modal('show');
}


// NOTA DE CREDITO
function openModalNcr()
{
    document.querySelector("#formVsnotcre").reset();

	var fecha   = new Date(); //Fecha actual
    var dia     = fecha.getDate(); //obteniendo dia
    var mes     = fecha.getMonth()+1; //obteniendo mes
    var ano     = fecha.getFullYear(); //obteniendo año

    if(dia<10)
      dia='0'+dia; //agrega cero si el menor de 10
    if(mes<10)
      mes='0'+mes //agrega cero si el menor de 10
    document.getElementById('datFecreg').value = ano + "-" + mes + "-" + dia;

	$("#modalformVsnotcre").modal('show');
}


// INFORME DIARIO DE VENTAS
function openModalVen()
{
    document.querySelector("#formVsdiaven").reset();
    fntGetPerios();

    var fecha   = new Date(); //Fecha actual
    var dia     = fecha.getDate(); //obteniendo dia
    var mes     = fecha.getMonth()+1; //obteniendo mes
    var ano     = fecha.getFullYear(); //obteniendo año

    if(dia<10)
      dia='0'+dia; //agrega cero si el menor de 10
    if(mes<10)
      mes='0'+mes //agrega cero si el menor de 10
    document.getElementById('datFecdes').value = ano + "-" + mes + "-" + dia;
    document.getElementById('datFechas').value = ano + "-" + mes + "-" + dia;

    $("#modalformVsdiaven").modal('show');
}
