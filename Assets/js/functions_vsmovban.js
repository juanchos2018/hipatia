var TablaVsmovban;

$(document).ready(function() {
        TablaVsmovban = $('#TableVsmovban').DataTable({
    	"language":{
			"url": "//cdn.datatables.net/plug-ins/1.10.22/i18n/Spanish.json"	
		},
    	"ajax": {
    		"url": base_url+"Vsmovban/getVsmovbans",
    		"dataSrc":""
    	},
        "columns":[
            {"data": "options"},
			{"data": "FECREG"},
			{"data": "TAB_NM"},
			{"data": "MOV_NO"},
            {"data": "BAN_NM"},
			{"data": "CTANUM"},
			{"data": "VALORS"},
			{"data": "REMARK"},
			{"data": "REVERS"}
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


    // AGREGAR TARNSACCION BANCRIA
    var formVsmovban = document.querySelector("#formVsmovban");
    var formVsmovtrf = document.querySelector("#formVsmovtrf");
    
   	formVsmovban.onsubmit = function(e)
   	{
   		e.preventDefault(); //previene que se recargue el formulario o pagina...

		var request  = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');		
   		var ajaxUrl  = base_url+"Vsmovban/setVsmovban";
		var formData = new FormData(formVsmovban);
			
   		request.open("POST",ajaxUrl,true);
		request.send(formData);	
		request.onreadystatechange = function()
   		{
   			if(request.readyState == 4 && request.status == 200)
   			{
   				var objData = JSON.parse(request.responseText);
   				if(objData.status)
   				{
                    $('#modalformVsmovban').modal('hide');
   					swal('Diario',objData.msg,'success');
   					TablaVsmovban.ajax.reload(null,false);
  				}else{
   					swal('ERROR: ',objData.msg,'error');
   				}
   			}    			
   		}
   	}

   	formVsmovtrf.onsubmit = function(e)
   	{
   		e.preventDefault(); //previene que se recargue el formulario o pagina...

		var request  = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');		
   		var ajaxUrl  = base_url+"Vsmovban/setVsmovtrf";
		var formData = new FormData(formVsmovtrf);
			
   		request.open("POST",ajaxUrl,true);
		request.send(formData);	
		request.onreadystatechange = function()
   		{
   			if(request.readyState == 4 && request.status == 200)
   			{
   				var objData = JSON.parse(request.responseText);				
   				if(objData.status)
   				{
                    $('#modalformVsmovtrf').modal('hide');
  					formVsmovtrf.reset();
   					swal('Diario',objData.msg,'success');

                    document.querySelector('#idSec_i2').value = 0;
                    document.querySelector('#listMovtip').value = "";
                    $('#listMovtip').selectpicker('render');
                    document.querySelector('#listBan_n3').value = "";
                    $('#listBan_n3').selectpicker('render');
                    document.querySelector('#listBan_n4').value = "";
                    $('#listBan_n4').selectpicker('render');
       
   					TablaVsmovban.ajax.reload(null,false);
  				}else{
   					swal('ERROR: ',objData.msg,'error');
   				}
   			}    			
   		}
   	}

    formVsrepban.onsubmit = function(e)
    {
        e.preventDefault();
      
        let request  = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');     
        let ajaxUrl  = base_url+"Vsmovban/prnRepBan";
        let formData = new FormData(formVsrepban);
      
        request.open("POST",ajaxUrl,true);
        request.send(formData); 
              
        request.onreadystatechange = function()
        {
            if(request.readyState == 4 && request.status == 200)
            {
                $('#modalformVsrepban').modal('hide');
                $('.modal-body').html(request.responseText);
                $('#modvsBanPrn').modal('show');
            }
        }
    }
});


// TRANSACCION BANCARIA
function openModalMvb()
{
    document.querySelector('#idSec_id').value = 0;
    document.querySelector('#listMovtip').value = "";
    $('#listMovtip').selectpicker('render');
    document.querySelector('#listBan_n2').value = "";
    $('#listBan_n2').selectpicker('render');
    document.querySelector('#listCta_no').value = "";
    $('#listCta_no').selectpicker('render');

    document.querySelector('#titleModal').innerHTML = 'Nueva Transacción Bancaria';
    document.querySelector('.modal-header').classList.replace('headerUpdate','headerRegister');
    document.querySelector('#btnActionForm').classList.replace('btn-info','btn-primary');
    document.querySelector('#btnText').innerHTML = 'Guardar';

    document.querySelector("#formVsmovban").reset();

    var fecha   = new Date(); //Fecha actual
    var dia     = fecha.getDate(); //obteniendo dia
    var mes     = fecha.getMonth()+1; //obteniendo mes
    var ano     = fecha.getFullYear(); //obteniendo año

    if(dia<10)
      dia='0'+dia; //agrega cero si el menor de 10
    if(mes<10)
      mes='0'+mes //agrega cero si el menor de 10
    document.getElementById('datFecreg').value = ano + "-" + mes + "-" + dia;

    $("#modalformVsmovban").modal('show');
}


// TRANSFERENCIA BANCARIA
function openModalTrf()
{
    document.querySelector('#idSec_i2').value = 0;
    document.querySelector('#listMovtip').value = "";
    $('#listMovtip').selectpicker('render');
    document.querySelector('#listBan_n3').value = "";
    $('#listBan_n3').selectpicker('render');
    document.querySelector('#listBan_n4').value = "";
    $('#listBan_n4').selectpicker('render');

    document.querySelector('#titleModal').innerHTML = 'Nueva Transferencia Bancaria';
    document.querySelector('.modal-header').classList.replace('headerUpdate','headerRegister');
    document.querySelector('#btnActionForm').classList.replace('btn-info','btn-primary');
    document.querySelector('#btnText').innerHTML = 'Guardar';

    document.querySelector("#formVsmovtrf").reset();

    var fecha   = new Date(); //Fecha actual
    var dia     = fecha.getDate(); //obteniendo dia
    var mes     = fecha.getMonth()+1; //obteniendo mes
    var ano     = fecha.getFullYear(); //obteniendo año

    if(dia<10)
      dia='0'+dia; //agrega cero si el menor de 10
    if(mes<10)
      mes='0'+mes //agrega cero si el menor de 10
    document.getElementById('datFecre2').value = ano + "-" + mes + "-" + dia;

    $("#modalformVsmovtrf").modal('show');
}


// INFORME BANCARIO
function openModalRpb()
{
    document.querySelector("#formVsrepban").reset();
    $("#modalformVsrepban").modal('show');
}


// EDITAR TRANSACCION BANCARIA
function fntEditVsmovban(idSEC)
{
    document.querySelector('#titleModal').innerHTML = 'Editar Transacción Bancaria';
    document.querySelector('.modal-header').classList.replace('headerRegister','headerUpdate');
    document.querySelector('#btnActionForm').classList.replace('btn-primary','btn-info');
    document.querySelector('#btnText').innerHTML = 'Actualizar';

    var secID   = idSEC;
    var request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
    var ajaxUrl = base_url+"Vsmovban/getVsmovban/"+secID;

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
                document.querySelector('#listMovtip').value = objData.data.MOVTIP;
                $('#listMovtip').selectpicker('render');
                document.querySelector('#txtMov_no').value  = objData.data.MOV_NO;

                // Entidad
                document.querySelector('#listBan_n2').value = objData.data.BAN_NO;
                $('#listBan_n2').selectpicker('render');

                // Cuenta Doble Partida
                document.querySelector('#listCta_no').value = objData.data.CTA_NO;
                $('#listCta_no').selectpicker('render');

                // Referencia Bancaria
                document.querySelector('#txtDep_no').value = objData.data.DEP_NO;
                document.querySelector('#txtChe_no').value = objData.data.CHE_NO;

                // Concepto
                document.querySelector('#txtRemark').value = objData.data.REMARK;

                // Fecha
                document.querySelector('#datFecreg').value = objData.data.FECREG;

                // Valor
                document.querySelector('#txtValors').value = objData.data.VALORS;

                $('#modalformVsmovban').modal('show');
            }else{
                swal("Error",objData.msg,"error");
            }
        }
    }
}


// EDITAR TRANSFERENCIA BANCARIA
function fntEditVsmovtrf(idSEC)
{
    document.querySelector('#titleModal2').innerHTML = 'Editar Transferencia Bancaria';
    document.querySelector('.modal-header').classList.replace('headerRegister','headerUpdate');
    document.querySelector('#btnActionForm2').classList.replace('btn-primary','btn-info');
    document.querySelector('#btnText2').innerHTML = 'Actualizar';

    var secID   = idSEC;
    var request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
    var ajaxUrl = base_url+"Vsmovban/getVsmovban/"+secID;

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
                document.querySelector('#idSec_i2').value = objData.data.SEC_ID;

                // Tipo y Número de Diario
                $opcion = objData.data.MOVTIP;
                document.querySelector('#listMovtip').value = $opcion;
                $('#listMovtip').selectpicker('render');
                document.querySelector('#txtMov_n2').value  = objData.data.MOV_NO;

                // Entidad Financiera
                if(objData.data.MOVSIG == 1)
                {
                    $opcion = objData.data.BAN_NO;
                    document.querySelector('#listBan_n3').value = "";
                    $('#listBan_n3').selectpicker('render');
                    document.querySelector('#listBan_n4').value = $opcion;
                    $('#listBan_n4').selectpicker('render');    
                }else{
                    $opcion = objData.data.BAN_NO;
                    document.querySelector('#listBan_n3').value = $opcion;
                    $('#listBan_n3').selectpicker('render');
                    document.querySelector('#listBan_n4').value = "";
                    $('#listBan_n4').selectpicker('render');    
                }


                // Concepto
                document.querySelector('#txtRemar2').value = objData.data.REMARK;

                // Fecha
                document.querySelector('#datFecre2').value = objData.data.FECREG;

                // Valor
                document.querySelector('#txtDocval').value = objData.data.VALORS;

                $('#modalformVsmovtrf').modal('show');
            }else{
                swal("Error",objData.msg,"error");
            }
        }
    }
}


// ANULAR TRANSACCION BANCARIA
function fntDelVsmovban(secID)
{
    let idSec = secID;
          
    swal({
        title: "Anular Registro",
        text: "¿Realmente quiere anular el Registro ?",
        type: "warning",
        showCancelButton: true,
        confirmButtonText: "Sì, Anular!",
        cancelButtonText: "No, Cancelar",
        closeOnConfirm: false,
        closeOnCancel: true
        }, function(isConfirm) {
            if(isConfirm)
            {
                let request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
                let ajaxUrl = base_url+'Vsmovban/delVsmovban/';
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
                            swal("Anular",objData.msg,"success");
                            TablaVsmovban.ajax.reload(null,false);
                        }else{
                            swal("Atenciòn!",objData.msg,"error");
                        }
                    }
                }
            }
    });
}
