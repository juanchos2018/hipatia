var TablaVsclinic;

$(document).ready(function() {
        TablaVsclinic = $('#TableVsclinic').DataTable({
    	"language":{
			"url": "//cdn.datatables.net/plug-ins/1.10.22/i18n/Spanish.json"	
		},
    	"ajax": {
    		"url": base_url+"Vsclinic/getVsclinics",
    		"dataSrc":""
    	},
        "columns":[
            {"data": "options"},
			{"data": "SEC_ID"},
			{"data": "FECREG"},
            {"data": "LAS_NM"},
            {"data": "FIR_NM"}
        ],
    	responsive:true,
    	destroy:true,
    	"displayLength":10,
		"order":[[0,"asc"]]
    });


    // AGREGAR HISTORIA CLINICA
    var formVsclinic = document.querySelector("#formVsclinic");
   	formVsclinic.onsubmit = function(e)
   	{
   		e.preventDefault(); //previene que se recargue el formulario o pagina...

		var request  = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');		
   		var ajaxUrl  = base_url+"Vsclinic/setVsclinic";
		var formData = new FormData(formVsclinic);
			
   		request.open("POST",ajaxUrl,true);
		request.send(formData);	
		request.onreadystatechange = function()
   		{
   			if(request.readyState == 4 && request.status == 200)
   			{
   				var objData = JSON.parse(request.responseText);
   				if(objData.status)
   				{
                    $('#modalformVsclinic').modal('hide');
                    formVsclinic.reset();
   					swal('Historia',objData.msg,'success');
                    TablaVsclinic.ajax.reload(null,false);
   				}else{
  					swal('ERROR: ',objData.msg,'error');
   				}
   			}    			
   		}
   	}
});


// HISTORIA CLINICA
function openModalCli()
{
    document.querySelector('#idSec_id').value = 0;
    document.querySelector('#listStd_no').value = "";
    $('#listStd_no').selectpicker('render');
    
    document.querySelector('#titleModal').innerHTML = 'Nueva Historia Clínica';
    document.querySelector('.modal-header').classList.replace('headerUpdate','headerRegister');
    document.querySelector('#btnActionForm').classList.replace('btn-info','btn-primary');
    document.querySelector('#btnText').innerHTML = 'Guardar';

    document.querySelector("#formVsclinic").reset();

    var fecha   = new Date(); //Fecha actual
    var dia     = fecha.getDate(); //obteniendo dia
    var mes     = fecha.getMonth()+1; //obteniendo mes
    var ano     = fecha.getFullYear(); //obteniendo año

    if(dia<10)
      dia='0'+dia; //agrega cero si el menor de 10
    if(mes<10)
      mes='0'+mes //agrega cero si el menor de 10
    document.getElementById('datFecreg').value = ano + "-" + mes + "-" + dia;

    $("#modalformVsclinic").modal('show');
}


// EDITAR HISTORIA CLINICA
function fntEditVsclinic(idSEC)
{
    document.querySelector('#titleModal').innerHTML = 'Editar Historia Clínica';
    document.querySelector('.modal-header').classList.replace('headerRegister','headerUpdate');
    document.querySelector('#btnActionForm').classList.replace('btn-primary','btn-info');
    document.querySelector('#btnText').innerHTML = 'Actualizar';

    var secID   = idSEC;
    var request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
    var ajaxUrl = base_url+"Vsclinic/getVsclinic/"+secID;

    request.open("GET",ajaxUrl,true);
    request.send();

    request.onreadystatechange = function()
    {
        if(request.readyState == 4 && request.status == 200)
        {
            var objData = JSON.parse(request.responseText);
            if(objData.status)
            { 
                // ID Historia
                document.querySelector('#idSec_id').value = objData.data.SEC_ID;

                // Tipo de Caso
                document.querySelector('#listCas_no').value = objData.data.CAS_NO;

                // Tipo de Historia
                document.querySelector('#txtHiscod').value = objData.data.HISCOD;

                // COMBO: Estudiante
                document.querySelector('#listStd_no').value = objData.data.STD_NO;
                $('#listStd_no').selectpicker('render');

                // Fecha de Registro
                document.querySelector('#datFecreg').value = objData.data.FECREG;

                // Fecha de Proxima atencion
                document.querySelector('#datFecnex').value = objData.data.FECNEX;

                // Peso
                document.querySelector('#txtWeighs').value = objData.data.WEIGHS;

                // Estatura
                document.querySelector('#txtHeighs').value = objData.data.HEIGHS;

                // Presion
                document.querySelector('#txtPresur').value = objData.data.PRESUR;

                // Temperatura
                document.querySelector('#txtTemper').value = objData.data.TEMPER;

                // Problema
                document.querySelector('#txtProble').value = objData.data.PROBLE;

                // Diagnostico 
                document.querySelector('#txtExplor').value = objData.data.EXPLOR;

                // Tratamiento
                document.querySelector('#txtTratam').value = objData.data.TRATAM;

                // Recomendaciones
                document.querySelector('#txtRemark').value = objData.data.REMARK;

                $('#modalformVsclinic').modal('show');
            }else{
                swal("Error",objData.msg,"error");
            }
        }
    }
}
