var TablaVsproduc;

$(document).ready(function()
{
        TablaVsproduc = $('#TableVsproduc').DataTable({
    	"language":{
			"url": "//cdn.datatables.net/plug-ins/1.10.22/i18n/Spanish.json"	
		},
    	"ajax": {
    		"url": base_url+"Vsproduc/getVsproducs",
    		"dataSrc":""
    	},
        "columns":[
            {"data": "options"},
            {"data": "ART_NM"},
            {"data": "ESTADO"}
		],
        searchPanes:{
            cascadePanes: true,
            dtOpts: {
                dom:'tp',
                searching:false
            }
        },
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


    // AGREGAR ARTICULO
    var formVsproduc = document.querySelector("#formVsproduc");
    
   	formVsproduc.onsubmit = function(e)
   	{
   		e.preventDefault(); //previene que se recargue el formulario o pagina...

		var request  = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');		
   		var ajaxUrl  = base_url+"Vsproduc/setVsproduc";
		var formData = new FormData(formVsproduc);
			
   		request.open("POST",ajaxUrl,true);
		request.send(formData);	
            
		request.onreadystatechange = function()
   		{
   			if(request.readyState == 4 && request.status == 200)
   			{
   				var objData = JSON.parse(request.responseText);	
   				if(objData.status)
   				{
                    $('#modalformVsproduc').modal('hide');
                    swal('Artículo',objData.msg,'success');
 					TablaVsproduc.ajax.reload(null,false);
   				}else{
                    swal('ERROR: ',objData.msg,'error');    					
  				}
   			}    			
   		}
   	}    
});


// ARTICULO
function openModalPro()
{
    document.querySelector('#idArt_no').value = 0;
    document.querySelector('#listEstado').value = "";
    $('#listEstado').selectpicker('render');
    document.querySelector('#listTip_no').value = "";
    $('#listTip_no').selectpicker('render');
    document.querySelector('#listDesiva').value = "";
    $('#listDesiva').selectpicker('render');
    document.querySelector('#listPropay').value = "";
    $('#listPropay').selectpicker('render');

    document.querySelector('#titleModal').innerHTML = 'Nuevo Artículo';
    document.querySelector('.modal-header').classList.replace('headerUpdate','headerRegister');
    document.querySelector('#btnActionForm').classList.replace('btn-info','btn-primary');
    document.querySelector('#btnText').innerHTML = 'Guardar';
    document.querySelector("#formVsproduc").reset();
	$("#modalformVsproduc").modal('show');
}


// EDITAR ARTICULO
function fntEditVsproduc(idSEC)
{
    document.querySelector('#titleModal').innerHTML = 'Editar Artículo';
    document.querySelector('.modal-header').classList.replace('headerRegister','headerUpdate');
    document.querySelector('#btnActionForm').classList.replace('btn-primary','btn-info');
    document.querySelector('#btnText').innerHTML = 'Actualizar';

    var secID   = idSEC;
    var request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
    var ajaxUrl = base_url+"Vsproduc/getVsproduc/"+secID;

    request.open("GET",ajaxUrl,true);
    request.send();

    request.onreadystatechange = function()
    {
        if(request.readyState == 4 && request.status == 200)
        {
            var objData = JSON.parse(request.responseText);
            if(objData.status)
            {  
                // ID Artículo
                document.querySelector('#idArt_no').value = objData.data.ART_NO;

                // Nombre
                document.querySelector('#txtArt_nm').value = objData.data.ART_NM;

                // COMBO: Estado
                document.querySelector('#listEstado').value = objData.data.ESTADO;
                $('#listEstado').selectpicker('render');

                // COMBO: Tipo de Artículo
                document.querySelector('#listTip_no').value = objData.data.TIP_NO;
                $('#listTip_no').selectpicker('render');

				// COMBO: Desglosa IVA
                document.querySelector('#listDesiva').value = objData.data.DESIVA;
                $('#listDesiva').selectpicker('render');

				// COMBO: Afectado por Pronto Pago
                document.querySelector('#listPropay').value = objData.data.PROPAY;
                $('#listPropay').selectpicker('render');

                // Periodos de Facturación
                if(objData.data.PER000 == "on")
                {
                    document.querySelector('#listPer000').checked = 1;
                }else{
                    document.querySelector('#listPer000').checked = 0;
                }
                if(objData.data.PER001 == "on")
                {
                    document.querySelector('#listPer001').checked = 1;
                }else{
                    document.querySelector('#listPer001').checked = 0;
                }
                if(objData.data.PER002 == "on")
                {
                    document.querySelector('#listPer002').checked = 1;
                }else{
                    document.querySelector('#listPer002').checked = 0;
                }
                if(objData.data.PER003 == "on")
                {
                    document.querySelector('#listPer003').checked = 1;
                }else{
                    document.querySelector('#listPer003').checked = 0;
                }
                if(objData.data.PER004 == "on")
                {
                    document.querySelector('#listPer004').checked = 1;
                }else{
                    document.querySelector('#listPer004').checked = 0;
                }
                if(objData.data.PER005 == "on")
                {
                    document.querySelector('#listPer005').checked = 1;
                }else{
                    document.querySelector('#listPer005').checked = 0;
                }
                if(objData.data.PER006 == "on")
                {
                    document.querySelector('#listPer006').checked = 1;
                }else{
                    document.querySelector('#listPer006').checked = 0;
                }
                if(objData.data.PER007 == "on")
                {
                    document.querySelector('#listPer007').checked = 1;
                }else{
                    document.querySelector('#listPer007').checked = 0;
                }
                if(objData.data.PER008 == "on")
                {
                    document.querySelector('#listPer008').checked = 1;
                }else{
                    document.querySelector('#listPer008').checked = 0;
                }
                if(objData.data.PER009 == "on")
                {
                    document.querySelector('#listPer009').checked = 1;
                }else{
                    document.querySelector('#listPer009').checked = 0;
                }
                if(objData.data.PER010 == "on")
                {
                    document.querySelector('#listPer010').checked = 1;
                }else{
                    document.querySelector('#listPer010').checked = 0;
                }
                if(objData.data.PER011 == "on")
                {
                    document.querySelector('#listPer011').checked = 1;
                }else{
                    document.querySelector('#listPer011').checked = 0;
                }
                if(objData.data.PER012 == "on")
                {
                    document.querySelector('#listPer012').checked = 1;
                }else{
                    document.querySelector('#listPer012').checked = 0;
                }
                if(objData.data.PER013 == "on")
                {
                    document.querySelector('#listPer013').checked = 1;
                }else{
                    document.querySelector('#listPer013').checked = 0;
                }
		
                // Cuenta Contable
                document.querySelector('#listCta_no').value = objData.data.CTA_NO;
                $('#listCta_no').selectpicker('render');

                $('#modalformVsproduc').modal('show');
            }else{
                swal("Error",objData.msg,"error");
            }
        }
    }
}
