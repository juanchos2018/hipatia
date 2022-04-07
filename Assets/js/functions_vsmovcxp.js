var TablaVsmovcxp;

$(document).ready(function() {
        TablaVsmovcxp = $('#TableVsmovcxp').DataTable({
    	"language":{
			"url": "//cdn.datatables.net/plug-ins/1.10.22/i18n/Spanish.json"	
		},
    	"ajax": {
    		"url": base_url+"Vsmovcxp/getVsmovcxps",
    		"dataSrc":""
    	},
        "columns":[
            {"data": "options"},
			{"data": "FECREG"},
			{"data": "TAB_NM"},
			{"data": "MOV_NO"},
            {"data": "VALORS"},
			{"data": "RETNUM"},
            {"data": "LAS_NM"},
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


    // AGREGAR PROVISION
    var formVsmovcxp = document.querySelector("#formVsmovcxp");
    var formVsmovcrp = document.querySelector("#formVsmovcrp");
    var formVsmovpay = document.querySelector("#formVsmovpay");
    var divLoading   = document.querySelector('#divLoading');
    
   	formVsmovcxp.onsubmit = function(e)
   	{
   		e.preventDefault(); //previene que se recargue el formulario o pagina...

		var request  = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');		
   		var ajaxUrl  = base_url+"Vsmovcxp/setVsmovcxp";
		var formData = new FormData(formVsmovcxp);
			
   		request.open("POST",ajaxUrl,true);
		request.send(formData);	
		request.onreadystatechange = function()
   		{
  			if(request.readyState == 4 && request.status == 200)
   			{
   				var objData = JSON.parse(request.responseText);								
   				if(objData.status)
   				{
                    $('#modalformVsmovcxp').modal('hide');
   					swal('Diario',objData.msg,'success');
   					TablaVsmovcxp.ajax.reload(null,false);
   				}else{
   					swal('ERROR: ',objData.msg,'error');
   				}
                divLoading.style.display = "none";
            }    			
   		}
   	}


	formVsmovcrp.onsubmit = function(e)
   	{
   		e.preventDefault(); //previene que se recargue el formulario o pagina...
		var request  = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');	
   		var ajaxUrl  = base_url+"Vsmovcxp/setVsmovcrp";
   		var formData = new FormData(formVsmovcrp);

   		request.open("POST",ajaxUrl,true);
		request.send(formData);	

		request.onreadystatechange = function()
   		{
   			if(request.readyState == 4 && request.status == 200)
   			{					 
   				let objData = JSON.parse(request.responseText);	
   				if(objData.status)
   				{
   					$('#modalformVsmovcrp').modal('hide');
   					formVsmovcrp.reset();
   					swal('Documento',objData.msg,'success');

                    document.querySelector('#idSec_i2').value = 0;
                    document.querySelector('#listMovti2').value = "";
                    $('#listMovti2').selectpicker('render');
                    document.querySelector('#listPrv_n2').value = "";
                    $('#listPrv_n2').selectpicker('render');
                    document.querySelector('#listMovapl').value = "";
                    $('#listMovapl').selectpicker('render');
                    document.querySelector('#listCdp_no').value = "";
                    $('#listCdp_no').selectpicker('render');

                    TablaVsmovcxp.ajax.reload(null,false);
   				}else{
					swal('ERROR: ',objData.msg,'error');
				}
                divLoading.style.display = "none";
   			}    			
   		}
   	}


	formVsmovpay.onsubmit = function(e)
   	{
   		e.preventDefault(); //previene que se recargue el formulario o pagina...
		var request  = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');	
   		var ajaxUrl  = base_url+"Vsmovcxp/setVsmovpay";
   		var formData = new FormData(formVsmovpay);

   		request.open("POST",ajaxUrl,true);
		request.send(formData);	

		request.onreadystatechange = function()
   		{
   			if(request.readyState == 4 && request.status == 200)
   			{					 
   				let objData = JSON.parse(request.responseText);	
   				if(objData.status)
   				{
   					$('#modalformVsmovpay').modal('hide');
   					formVsmovpay.reset();
   					swal('Documento',objData.msg,'success');
			
                    document.querySelector('#idSec_i3').value = 0;
                    document.querySelector('#listMovti3').value = "";
                    $('#listMovti3').selectpicker('render');
                    document.querySelector('#listAdvanc').value = "";
                    $('#listAdvanc').selectpicker('render');
                    document.querySelector('#listPrv_n3').value = "";
                    $('#listPrv_n3').selectpicker('render');
                    document.querySelector('#listBan_n2').value = "";
                    $('#listBan_n2').selectpicker('render');
                    document.querySelector('#listGas_no').value = "";
                    $('#listGas_no').selectpicker('render');
                       
                    TablaVsmovcxp.ajax.reload(null,false);
   				}else{
					swal('ERROR: ',objData.msg,'error');
				}
                divLoading.style.display = "none";
   			}  
   		}
   	}


    formVsrepcxp.onsubmit = function(e)
    {
        e.preventDefault();
         
        let request  = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');     
        let ajaxUrl  = base_url+"Vsmovcxp/prnRepCxp";
        let formData = new FormData(formVsrepcxp);
         
        request.open("POST",ajaxUrl,true);
        request.send(formData); 
                 
        request.onreadystatechange = function()
        {
            if(request.readyState == 4 && request.status == 200)
            {
                $('#modalformVsrepcxp').modal('hide');
                $('.modal-body').html(request.responseText);
                $('#modvsCxpPrn').modal('show');
            }
        }
    } 
});


// COMPRAS
function openModalCxp()
{
    document.querySelector('#idSec_id').value = 0;
    document.querySelector('#listPrv_no').value = "";
    $('#listPrv_no').selectpicker('render');
    document.querySelector('#listBan_n2').value = "";
    $('#listBan_n2').selectpicker('render');
    document.querySelector('#listCta_no').value = "";
    $('#listCta_no').selectpicker('render');
    document.querySelector('#listAnt_no').value = "";
    $('#listAnt_no').selectpicker('render');

    document.querySelector('#listReb_no').value = "";
    $('#listReb_no').selectpicker('render');
    document.querySelector('#listRes_no').value = "";
    $('#listRes_no').selectpicker('render');
    document.querySelector('#listRib_no').value = "";
    $('#listRib_no').selectpicker('render');
    document.querySelector('#listRis_no').value = "";
    $('#listRis_no').selectpicker('render');

    document.querySelector('#titleModal').innerHTML = 'Nueva Provisión Factura';
    document.querySelector('.modal-header').classList.replace('headerUpdate','headerRegister');
    document.querySelector('#btnActionForm').classList.replace('btn-info','btn-primary');
    document.querySelector('#btnText').innerHTML = 'Guardar';

    document.querySelector("#formVsmovcxp").reset();

    var fecha   = new Date(); //Fecha actual
    var dia     = fecha.getDate(); //obteniendo dia
    var mes     = fecha.getMonth()+1; //obteniendo mes
    var ano     = fecha.getFullYear(); //obteniendo año

    if(dia<10)
      dia='0'+dia; //agrega cero si el menor de 10
    if(mes<10)
      mes='0'+mes //agrega cero si el menor de 10
    document.getElementById('datFecreg').value = ano + "-" + mes + "-" + dia;

    $("#modalformVsmovcxp").modal('show');
}


// NOTA DE CREDITO / DEBITO PROVEEDOR
function openModalNcp()
{
    document.querySelector('#idSec_i2').value = 0;
    document.querySelector('#listMovti2').value = "";
    $('#listMovti2').selectpicker('render');
    document.querySelector('#listMovapl').value = "";
    $('#listMovapl').selectpicker('render');
    document.querySelector('#listPrv_n2').value = "";
    $('#listPrv_n2').selectpicker('render');
    document.querySelector('#listCdp_no').value = "";
    $('#listCdp_no').selectpicker('render');

    document.querySelector('#titleModal2').innerHTML = 'Nueva Nota de Crédito / Débito Proveedor';
    document.querySelector('.modal-header').classList.replace('headerUpdate','headerRegister');
    document.querySelector('#btnActionForm2').classList.replace('btn-info','btn-primary');
    document.querySelector('#btnText2').innerHTML = 'Guardar';

    document.querySelector("#formVsmovcrp").reset();

    var fecha   = new Date(); //Fecha actual
    var dia     = fecha.getDate(); //obteniendo dia
    var mes     = fecha.getMonth()+1; //obteniendo mes
    var ano     = fecha.getFullYear(); //obteniendo año

    if(dia<10)
      dia='0'+dia; //agrega cero si el menor de 10
    if(mes<10)
      mes='0'+mes //agrega cero si el menor de 10
    document.getElementById('datFecre2').value = ano + "-" + mes + "-" + dia;

    $("#modalformVsmovcrp").modal('show');
}


// PAGO PROVEEDOR
function openModalPay()
{
    document.querySelector('#idSec_i3').value = 0;
    document.querySelector('#listMovti3').value = "";
    $('#listMovti3').selectpicker('render');
    document.querySelector('#listAdvanc').value = "";
    $('#listAdvanc').selectpicker('render');
    document.querySelector('#listPrv_n3').value = "";
    $('#listPrv_n3').selectpicker('render');
    document.querySelector('#listBan_n2').value = "";
    $('#listBan_n2').selectpicker('render');
    document.querySelector('#listGas_no').value = "";
    $('#listGas_no').selectpicker('render');

    $('#listFap_no').selectpicker('destroy');
    document.querySelector('#listFap_no').title = "Escoger Facturas Pendientes";
    document.querySelector('#listFap_no').value = "";
    $('#listFap_no').selectpicker('render');
    $('#listFap_no').selectpicker('refresh');
    document.querySelector('#txtFap_no').onkeydown="return false";

    $('#listFap_no').selectpicker('destroy');
    document.querySelector('#listFap_no').title = "Escoger Facturas Pendientes";
    document.querySelector('#listFap_no').value = "";
    $('#listFap_no').selectpicker('render');
    $('#listFap_no').selectpicker('refresh');

    document.querySelector('#titleModal3').innerHTML = 'Nuevo Pago a Proveedor';
    document.querySelector('.modal-header').classList.replace('headerUpdate','headerRegister');
    document.querySelector('#btnActionForm3').classList.replace('btn-info','btn-primary');
    document.querySelector('#btnText3').innerHTML = 'Guardar';

    document.querySelector("#formVsmovpay").reset();

    var fecha   = new Date(); //Fecha actual
    var dia     = fecha.getDate(); //obteniendo dia
    var mes     = fecha.getMonth()+1; //obteniendo mes
    var ano     = fecha.getFullYear(); //obteniendo año

    if(dia<10)
      dia='0'+dia; //agrega cero si el menor de 10
    if(mes<10)
      mes='0'+mes //agrega cero si el menor de 10
    document.getElementById('datFecre3').value = ano + "-" + mes + "-" + dia;

    $("#modalformVsmovpay").modal('show');
}


// INFORME COMPRAS
function openModalRpc()
{
    document.querySelector("#formVsrepcxp").reset();
    $("#modalformVsrepcxp").modal('show');
}


// EDITAR COMPRAS
function fntEditVsmovcxp(idSEC)
{
    document.querySelector('#titleModal').innerHTML = 'Editar Provisión Factura';
    document.querySelector('.modal-header').classList.replace('headerRegister','headerUpdate');
    document.querySelector('#btnActionForm').classList.replace('btn-primary','btn-info');
    document.querySelector('#btnText').innerHTML = 'Actualizar';

    var secID   = idSEC;
    var request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
    var ajaxUrl = base_url+"Vsmovcxp/getVsmovcxp/"+secID;

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

                // Sustento Tributario
                document.querySelector('#txtSustri').value = objData.data.SUSTRI;

                // Proveedor
                document.querySelector('#listPrv_no').value = objData.data.PRV_NO;
                $('#listPrv_no').selectpicker('render');

                // COMBO: Cuenta por Pagar
                document.querySelector('#listCta_no').value = objData.data.CTA_NO;
                $('#listCta_no').selectpicker('render');

                // COMBO: Cuenta de Gasto
                document.querySelector('#listAnt_no').value = objData.data.GAS_NO;
                $('#listAnt_no').selectpicker('render');

                // Concepto
                document.querySelector('#txtRemark').value = objData.data.REMARK;

                // Fechas
                document.querySelector('#datFecreg').value = objData.data.FECREG;
                document.querySelector('#datFecemi').value = objData.data.FECEMI;

                // Documento Aplicado
                document.querySelector('#listDocapl').value = objData.data.DOCAPL;
                document.querySelector('#txtDocpto').value = objData.data.DOCPTO;
                document.querySelector('#txtDocnum').value = objData.data.DOCNUM;
                document.querySelector('#txtDocaut').value = objData.data.DOCAUT;

                // Valores
                document.querySelector('#txtBasiva').value = objData.data.BASIVA;
                document.querySelector('#txtMoniva').value = objData.data.MONIVA;
                document.querySelector('#txtBasiv0').value = objData.data.BASIV0;
                document.querySelector('#txtBasniv').value = objData.data.BASNIV;

                document.querySelector('#txtMonrf1').value = objData.data.MONRF1;
                document.querySelector('#txtMonrf2').value = objData.data.MONRF2;
                document.querySelector('#txtMonri1').value = objData.data.MONRI1;
                document.querySelector('#txtMonri2').value = objData.data.MONRI2;

                // COMBO: Retenciones
                document.querySelector('#listReb_no').value = objData.data.CODRF1;
                $('#listReb_no').selectpicker('render');
                document.querySelector('#listRes_no').value = objData.data.CODRF2;
                $('#listRes_no').selectpicker('render');
                document.querySelector('#listRib_no').value = objData.data.CODRI1;
                $('#listRib_no').selectpicker('render');
                document.querySelector('#listRis_no').value = objData.data.CODRI2;
                $('#listRis_no').selectpicker('render');

                document.querySelector('#txtRetpto').value = objData.data.RETPTO;
                document.querySelector('#txtRetnum').value = objData.data.RETNUM;
                document.querySelector('#txtRetaut').value = objData.data.RETAUT;

                // Giro
                document.querySelector('#txtValdes').value = objData.data.VALDES;
                document.querySelector('#txtValors').value = objData.data.VALORS;

                $('#modalformVsmovcxp').modal('show');
            }else{
                swal("Error",objData.msg,"error");
            }
        }
    }
}


// EDITAR NOTA DE CREDITO / DEBITO PROVEEDOR
function fntEditVsmovcrp(idSEC)
{
    document.querySelector('#titleModal2').innerHTML = 'Editar Nota de Crédito / Débito Proveedor';
    document.querySelector('.modal-header').classList.replace('headerRegister','headerUpdate');
    document.querySelector('#btnActionForm2').classList.replace('btn-primary','btn-info');
    document.querySelector('#btnText2').innerHTML = 'Actualizar';

    var secID   = idSEC;
    var request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
    var ajaxUrl = base_url+"Vsmovcxp/getVsmovcxp/"+secID;

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
                document.querySelector('#listMovti2').value = objData.data.MOVTIP;
                $('#listMovti2').selectpicker('render');
                document.querySelector('#txtMov_n2').value  = objData.data.MOV_NO;

                // Documento Aplicado
                document.querySelector('#listMovapl').value = objData.data.MOVAPL;
                $('#listMovapl').selectpicker('render');
                document.querySelector('#txtFap_no').value = objData.data.MOVNUM;

                // Proveedor
                document.querySelector('#listPrv_n2').value = objData.data.PRV_NO;
                $('#listPrv_n2').selectpicker('render');

                // Cuenta Gasto
                document.querySelector('#listCdp_no').value = objData.data.GAS_NO;
                $('#listCdp_no').selectpicker('render');

                // Concepto
                document.querySelector('#txtRemar2').value = objData.data.REMARK;

                // Fechas
                document.querySelector('#datFecre2').value = objData.data.FECREG;

                // Valores
                document.querySelector('#txtDocva2').value = objData.data.VALORS;

                $('#modalformVsmovcrp').modal('show');
            }else{
                swal("Error",objData.msg,"error");
            }
        }
    }
}


// EDITAR PAGO PROVEEDOR
function fntEditVsmovpay(idSEC)
{
    document.querySelector('#titleModal3').innerHTML = 'Editar Pago a Proveedor';
    document.querySelector('.modal-header').classList.replace('headerRegister','headerUpdate');
    document.querySelector('#btnActionForm3').classList.replace('btn-primary','btn-info');
    document.querySelector('#btnText3').innerHTML = 'Actualizar';

    var secID   = idSEC;
    var request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
    var ajaxUrl = base_url+"Vsmovcxp/getVsmovcxp/"+secID;

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
                document.querySelector('#idSec_i3').value = objData.data.SEC_ID;

                // Tipo y Número de Diario
                document.querySelector('#listMovti3').value = objData.data.MOVTIP;
                $('#listMovti3').selectpicker('render');
                document.querySelector('#txtMov_n3').value  = objData.data.MOV_NO;

                // Anticipo
                document.querySelector('#listAdvanc').value = objData.data.ADVANC;
                $('#listAdvanc').selectpicker('render');

                // Proveedor
                document.querySelector('#listPrv_n3').value = objData.data.PRV_NO;
                $('#listPrv_n3').selectpicker('render');
                document.querySelector('#txtBenefi').value = objData.data.BENEFI;

                // Banco  
                document.querySelector('#listBan_n2').value = objData.data.BAN_NO;
                $('#listBan_n2').selectpicker('render');
                document.querySelector('#txtChe_no').value = objData.data.CHE_NO;

                // Cuenta Doble Partida
                document.querySelector('#listGas_no').value = objData.data.CTA_NO;
                $('#listGas_no').selectpicker('render');

                // COMBO: Provisión Aplicada
                if(objData.data.MOVNUM == 0)
                {
                    $('#listFap_no').selectpicker('destroy');
                    document.querySelector('#listFap_no').title = "Escoger Facturas Pendientes";
                    document.querySelector('#listFap_no').innerHTML = objData.data['saldo'];
                    $('#listFap_no').selectpicker('refresh');
                }else{
                    $('#listFap_no').selectpicker('destroy');
                    document.querySelector('#listFap_no').innerHTML = objData.data.HTMLOptions;
                    $('#listFap_no').selectpicker('refresh');
                    document.querySelector('#txtFap_no').value = objData.data.MOVNUM;
                }

                // Valores
                document.querySelector('#txtDocva3').value = objData.data.VALORS;
                // Fechas
                document.querySelector('#datFecre3').value = objData.data.FECREG;
                // Concepto
                document.querySelector('#txtRemar3').value = objData.data.REMARK;

                $('#modalformVsmovpay').modal('show');
            }else{
                swal("Error",objData.msg,"error");
            }
        }
    }
}


// ANULAR REGISTRO
function fntDelVsmovcxp(secID)
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
                let ajaxUrl = base_url+'Vsmovcxp/delVsmovcxp/';
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
                            TablaVsmovcxp.ajax.reload(null,false);
                        }else{
                            swal("Atenciòn!",objData.msg,"error");
                        }
                    }
                }
            }
    });
}
