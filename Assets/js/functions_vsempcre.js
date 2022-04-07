var TablaVsempcre;

$(document).ready(function() {
        TablaVsempcre = $('#TableVsempcre').DataTable({
    	"language":{
			"url": "//cdn.datatables.net/plug-ins/1.10.22/i18n/Spanish.json"	
		},
    	"ajax": {
    		"url": base_url+"Vsempcre/getVsempcres",
    		"dataSrc":""
    	},
        "columns":[
            {"data": "options"},
			{"data": "FECREG"},
			{"data": "MOV_NO"},
            {"data": "LAS_NM"},
            {"data": "RUB_NM"},
            {"data": "CUOTAS"},
			{"data": "PERDES"},
			{"data": "REMARK"}
        ],
        "columnDefs": [
            { 'className': "anchocelda", "targets": [ 0 ]},
            { 'className': "anchocelda", "targets": [ 1 ]},
            { 'className': "anchocelda", "targets": [ 2 ]},
            { 'className': "anchocelda", "targets": [ 3 ]},
            { 'className': "anchocelda", "targets": [ 4 ]},
            { 'className': "anchocelda", "targets": [ 5 ]},
            { 'className': "anchocelda", "targets": [ 6 ]},
            { 'className': "anchocelda", "targets": [ 7 ]}
          ],
        responsive:true,
    	destroy:true,
    	"displayLength":10,
		"order":[[0,"asc"]]
    });


    // AGREGAR CREDITO PERSONAL
    var formVsempcre = document.querySelector("#formVsempcre");
    
   	formVsempcre.onsubmit = function(e)
   	{
   		e.preventDefault(); //previene que se recargue el formulario o pagina...

		var request  = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');		
   		var ajaxUrl  = base_url+"Vsempcre/setVsempcre";
		var formData = new FormData(formVsempcre);
			
   		request.open("POST",ajaxUrl,true);
		request.send(formData);	
		request.onreadystatechange = function()
   		{
   			if(request.readyState == 4 && request.status == 200)
   			{	
   				var objData = JSON.parse(request.responseText);	
   				if(objData.status)
   				{
                    $('#modalformVsempcre').modal('hide');
   					swal('Crédito',objData.msg,'success');
   					TablaVsempcre.ajax.reload(null,false);
   				}else{
   					swal('ERROR: ',objData.msg,'error');
   				}
   			}    			
   		}
   	}
});


// CREDITO PERSONAL
function openModalCre()
{
    document.querySelector('#idSec_id').value = 0;
    document.querySelector('#listEmp_no').value = "";
    $('#listEmp_no').selectpicker('render');
    document.querySelector('#listRubcre').value = "";
    $('#listRubcre').selectpicker('render');
    document.querySelector('#listMondes').value = "";
    $('#listMondes').selectpicker('refresh');
    document.querySelector('#listForpag').value = "";
    $('#listForpag').selectpicker('render');
    document.querySelector('#listBan_n2').value = "";
    $('#listBan_n2').selectpicker('render');

    document.querySelector('#titleModal').innerHTML = 'Nuevo Crédito Personal';
    document.querySelector('.modal-header').classList.replace('headerUpdate','headerRegister');
    document.querySelector('#btnActionForm').classList.replace('btn-info','btn-primary');
    document.querySelector('#btnText').innerHTML = 'Guardar';

    document.querySelector("#formVsempcre").reset();
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

    $("#modalformVsempcre").modal('show');
}


// EDITAR CREDITO PERSONAL
function fntEditVsempcre(idSEC)
{
    document.querySelector('#titleModal').innerHTML = 'Editar Crédito Personal';
    document.querySelector('.modal-header').classList.replace('headerRegister','headerUpdate');
    document.querySelector('#btnActionForm').classList.replace('btn-primary','btn-info');
    document.querySelector('#btnText').innerHTML = 'Actualizar';

    var secID   = idSEC;
    var request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
    var ajaxUrl = base_url+"Vsempcre/getVsempcre/"+secID;

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
                document.querySelector('#txtMov_no').value  = objData.data.MOV_NO;

                // Fecha de Registro
                document.querySelector('#datFecreg').value = objData.data.FECREG;

                // Hora
                document.querySelector('#txtHorreg').value = objData.data.HORREG;

                // COMBO: Personal
                document.querySelector('#listEmp_no').value = objData.data.EMP_NO;
                $('#listEmp_no').selectpicker('render');

                // COMBO: Rubro
                document.querySelector('#listRubcre').value = objData.data.RUB_NO;
                $('#listRubcre').selectpicker('render');

                // Concepto del Crédito
                document.querySelector('#txtRemark').value = objData.data.REMARK;

                // Valor y Plazo
                document.querySelector('#txtValors').value = objData.data.VALORS;
                document.querySelector('#txtPlazos').value = objData.data.PLAZOS;
                document.querySelector('#txtCuotas').value = objData.data.CUOTAS;

                // COMBO: Forma de Pago
                document.querySelector('#listForpag').value = objData.data.FORPAG;
                $('#listForpag').selectpicker('render');

                // COMBO: Mes descuenta
                $opcion = objData.data.PERDES;
                $opcion2 = $opcion.substring(4,6);
                document.querySelector('#listMondes').value = $opcion2;
                $('#listMondes').selectpicker('refresh');

                // Año descuenta
                $opcion = objData.data.PERDES;
                $opcion2 = $opcion.substring(0,4);
                document.querySelector('#listPerios').value = $opcion2;

                // Entidad
                document.querySelector('#listBan_n2').value = objData.data.BAN_NO;
                $('#listBan_n2').selectpicker('render');

                // Referencia Bancaria
                document.querySelector('#txtChe_no').value = objData.data.CHE_NO;

                $('#modalformVsempcre').modal('show');
            }else{
                swal("Error",objData.msg,"error");
            }
        }
    }
}
