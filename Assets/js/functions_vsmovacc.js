var TablaVsmovacc;

$(document).ready(function() {
        TablaVsmovacc = $('#TableVsmovacc').DataTable({
    	"language":{
			"url": "//cdn.datatables.net/plug-ins/1.10.22/i18n/Spanish.json"	
		},
    	"ajax": {
    		"url": base_url+"Vsmovacc/getVsmovaccs",
    		"dataSrc":""
    	},
        "columns":[
            {"data": "options"},
			{"data": "FECREG"},
			{"data": "TAB_NM"},
			{"data": "MOV_NO"},
            {"data": "CTA_NO"},
			{"data": "DEB_NO"},
			{"data": "HAB_NO"},
			{"data": "SIGNOS"},
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


    // AGREGAR DIARIO
    var formVsmovacc = document.querySelector("#formVsmovacc");
    let formVsrepacc = document.querySelector("#formVsrepacc");
    
   	formVsmovacc.onsubmit = function(e)
   	{
   		e.preventDefault(); //previene que se recargue el formulario o pagina...

		var request  = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');		
   		var ajaxUrl  = base_url+"Vsmovacc/setVsmovacc";
		var formData = new FormData(formVsmovacc);
			
   		request.open("POST",ajaxUrl,true);
		request.send(formData);	
		request.onreadystatechange = function()
   		{
   			if(request.readyState == 4 && request.status == 200)
   			{
   				var objData = JSON.parse(request.responseText);	
   				if(objData.status)
   				{
                    $('#modalformVsmovacc').modal('hide');
   					swal('Diario',objData.msg,'success');
   					TablaVsmovacc.ajax.reload(null,false);
   				}else{
   					swal('ERROR: ',objData.msg,'error');
                }
   			}    			
   		}
   	}

    formVsrepacc.onsubmit = function(e)
    {
        e.preventDefault();
   
        let request  = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');     
        let ajaxUrl  = base_url+"Vsmovacc/prnRepAcc";
        let formData = new FormData(formVsrepacc);
   
        request.open("POST",ajaxUrl,true);
        request.send(formData); 
           
        request.onreadystatechange = function()
        {
            if(request.readyState == 4 && request.status == 200)
            {
                $('#modalformVsrepacc').modal('hide');
                $('.modal-body').html(request.responseText);
                $('#modvsAccPrn').modal('show');
            }
        }
    }
});


// DIARIO CONTABLE
function openModalAcc()
{
    document.querySelector('#idSec_id').value = 0;
    document.querySelector('#listTab_no').value = "";
    $('#listTab_no').selectpicker('render');
    document.querySelector('#listAnt_no').value = "";
    $('#listAnt_no').selectpicker('render');

    document.querySelector('#titleModal').innerHTML = 'Nuevo Diario Contable';
    document.querySelector('.modal-header').classList.replace('headerUpdate','headerRegister');
    document.querySelector('#btnActionForm').classList.replace('btn-info','btn-primary');
    document.querySelector('#btnText').innerHTML = 'Guardar';

    document.querySelector("#formVsmovacc").reset();

    var fecha   = new Date(); //Fecha actual
    var dia     = fecha.getDate(); //obteniendo dia
    var mes     = fecha.getMonth()+1; //obteniendo mes
    var ano     = fecha.getFullYear(); //obteniendo año

    if(dia<10)
      dia='0'+dia; //agrega cero si el menor de 10
    if(mes<10)
      mes='0'+mes //agrega cero si el menor de 10
    document.getElementById('datFecreg').value = ano + "-" + mes + "-" + dia;

    $("#modalformVsmovacc").modal('show');
}


// INFORMES CONTABLES
function openModalBal()
{
    document.querySelector("#formVsrepacc").reset();
    $("#modalformVsrepacc").modal('show');
}


// EDITAR DIARIO CONTABLE
function fntEditVsmovacc(idSEC)
{
    document.querySelector('#titleModal').innerHTML = 'Editar Diario Contable';
    document.querySelector('.modal-header').classList.replace('headerRegister','headerUpdate');
    document.querySelector('#btnActionForm').classList.replace('btn-primary','btn-info');
    document.querySelector('#btnText').innerHTML = 'Actualizar';

    var secID   = idSEC;
    var request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
    var ajaxUrl = base_url+"Vsmovacc/getVsmovacc/"+secID;

    request.open("GET",ajaxUrl,true);
    request.send();

    request.onreadystatechange = function()
    {
        if(request.readyState == 4 && request.status == 200)
        {
            var objData = JSON.parse(request.responseText);
            if(objData.status)
            {  
                // ID 
                document.querySelector('#idSec_id').value = objData.data.SEC_ID;

                // Tipo y Número de Diario
                document.querySelector('#listTab_no').value = objData.data.MOVTIP;
                $('#listTab_no').selectpicker('render');
                document.querySelector('#txtMovpto').value = objData.data.MOVPTO;
                document.querySelector('#txtMov_no').value = objData.data.MOV_NO;

                // Cuenta Contable
                document.querySelector('#listCta_no').value = objData.data.CTA_NO;
                $('#listCta_no').selectpicker('render');

                // Valor
                document.querySelector('#txtValors').value = objData.data.VALORS;

                // Fecha
                document.querySelector('#datFecreg').value = objData.data.FECREG;

                // Concepto
                document.querySelector('#txtRemark').value = objData.data.REMARK;

                $('#modalformVsmovacc').modal('show');
            }else{
                swal("Error",objData.msg,"error");
            }
        }
    }
}


// ELIMINAR DIARIO CONTABLE
function fntDelVsmovacc(secID)
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
                let ajaxUrl = base_url+'Vsmovacc/delVsmovacc/';
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
                            TablaVsmovacc.ajax.reload(null,false);
                        }else{
                            swal("Atenciòn!",objData.msg,"error");
                        }
                    }
                }
            }
    });
}
