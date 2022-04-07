var TablaVsrolpay;

$(document).ready(function() {
        TablaVsrolpay = $('#TableVsrolpay').DataTable({
    	"language":{
			"url": "//cdn.datatables.net/plug-ins/1.10.22/i18n/Spanish.json"	
		},
    	"ajax": {
    		"url": base_url+"Vsrolpay/getVsrolpays",
    		"dataSrc":""
    	},
        "columns":[
            {"data": "options"},
			{"data": "PERIOS"},
            {"data": "LAS_NM"},
            {"data": "RUB_NM"},
            {"data": "INCOME"},
            {"data": "EGRESS"}
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
            { 'className': "anchocelda", "targets": [ 5 ]}
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


    // AGREGAR ROL DE PAGOS
    var formVsrolpay = document.querySelector("#formVsrolpay");
    var formVsrolrep = document.querySelector("#formVsrolrep");
    var formVsrolclo = document.querySelector("#formVsrolclo");

    formVsrolpay.onsubmit = function(e)
   	{
   		e.preventDefault(); //previene que se recargue el formulario o pagina...

		var request  = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');		
   		var ajaxUrl  = base_url+"Vsrolpay/setVsrolpay";
		var formData = new FormData(formVsrolpay);
			
   		request.open("POST",ajaxUrl,true);
		request.send(formData);	
		request.onreadystatechange = function()
   		{
   			if(request.readyState == 4 && request.status == 200)
   			{
   				var objData = JSON.parse(request.responseText);	
   				if(objData.status)
   				{
                    $('#modalformVsrolpay').modal('hide');
   					swal('Rol',objData.msg,'success');
   					TablaVsrolpay.ajax.reload(null,false);
   				}else{
   					swal('ERROR: ',objData.msg,'error');
        		}
   			}    			
   		}
   	}

    formVsrolrep.onsubmit = function(e)
    {
        e.preventDefault();
         
        let request  = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');     
        let ajaxUrl  = base_url+"Vsrolpay/prnRolPay";
        let formData = new FormData(formVsrolrep);

        request.open("POST",ajaxUrl,true);
        request.send(formData); 
        request.onreadystatechange = function()
        {
            if(request.readyState == 4 && request.status == 200)
            {
                $('#modalformVsrolrep').modal('hide');
                $('.modal-body').html(request.responseText);
                $('#modvsRolPrn').modal('show');
            }
        }
    }

    formVsrolclo.onsubmit = function(e)
    {
        e.preventDefault();
         
        let request  = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');     
        let ajaxUrl  = base_url+"Vsrolpay/prnRolPay";
        let formData = new FormData(formVsrolclo);

        request.open("POST",ajaxUrl,true);
        request.send(formData); 
        request.onreadystatechange = function()
        {
            if(request.readyState == 4 && request.status == 200)
            {
                $('#modalformVsrolclo').modal('hide');
                $('.modal-body').html(request.responseText);
                $('#modvsRolPrn').modal('show');
            }
        }
    }
});


// ROL DE PAGO
function openModalRol()
{
    document.querySelector('#idSec_id').value = 0;
    document.querySelector('#listEmp_no').value = "";
    $('#listEmp_no').selectpicker('render');
    document.querySelector('#listRub_no').value = "";
    $('#listRub_no').selectpicker('render');
    document.querySelector('#listMondes').value = "";
    $('#listMondes').selectpicker('refresh');

    document.querySelector('#titleModal').innerHTML = 'Nuevo Rol de Pago';
    document.querySelector('.modal-header').classList.replace('headerUpdate','headerRegister');
    document.querySelector('#btnActionForm').classList.replace('btn-info','btn-primary');
    document.querySelector('#btnText').innerHTML = 'Guardar';

    document.querySelector("#formVsrolpay").reset();
    fntGetPerios();
    $("#modalformVsrolpay").modal('show');
}


// INFORME ROL DE PAGO
function openModalRpi()
{
    document.querySelector("#formVsrolrep").reset();
    fntGetPerios();
    $("#modalformVsrolrep").modal('show');
}


// CIERRE ROL DE PAGO
function openModalRoc()
{
    document.querySelector("#formVsrolclo").reset();
    fntGetPerios();
    $("#modalformVsrolclo").modal('show');
}


// EDITAR ROL DE PAGO
function fntEditVsrolpay(idSEC)
{
    document.querySelector('#titleModal').innerHTML = 'Editar Rol de Pago';
    document.querySelector('.modal-header').classList.replace('headerRegister','headerUpdate');
    document.querySelector('#btnActionForm').classList.replace('btn-primary','btn-info');
    document.querySelector('#btnText').innerHTML = 'Actualizar';

    var secID   = idSEC;
    var request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
    var ajaxUrl = base_url+"Vsrolpay/getVsrolpay/"+secID;

    request.open("GET",ajaxUrl,true);
    request.send();

    request.onreadystatechange = function()
    {
        if(request.readyState == 4 && request.status == 200)
        {
            var objData = JSON.parse(request.responseText);
            if(objData.status)
            {  
                // ID Crédito
                document.querySelector('#idSec_id').value = objData.data.SEC_ID;

                // COMBO: Personal
                document.querySelector('#listEmp_no').value = objData.data.EMP_NO;
                $('#listEmp_no').selectpicker('render');

                // COMBO: Rubro
                document.querySelector('#listRub_no').value = objData.data.RUB_NO;
                $('#listRub_no').selectpicker('render');

                // COMBO: Mes descuenta
                $opcion = objData.data.PERIOS;
                $opcion2 = $opcion.substring(4,6);
                document.querySelector('#listMondes').value = $opcion2;
                $('#listMondes').selectpicker('refresh');

                // Año descuenta
                $opcion = objData.data.PERIOS;
                $opcion2 = $opcion.substring(0,4);
                document.querySelector('#listPerios').value = $opcion2;

                // Valores
                document.querySelector('#txtIncome').value = objData.data.INCOME;
                document.querySelector('#txtEgress').value = objData.data.EGRESS;

                $('#modalformVsrolpay').modal('show');
            }else{
                swal("Error",objData.msg,"error");
            }
        }
    }
}
