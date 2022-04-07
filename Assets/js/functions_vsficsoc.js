var TablaVsficsoc;

$(document).ready(function() {
        TablaVsficsoc = $('#TableVsficsoc').DataTable({
    	"language":{
			"url": "//cdn.datatables.net/plug-ins/1.10.22/i18n/Spanish.json"	
		},
    	"ajax": {
    		"url": base_url+"Vsficsoc/getVsficsocs",
    		"dataSrc":""
    	},
        "columns":[
            {"data": "options"},
            {"data": "LAS_NM"},
            {"data": "FIR_NM"},
            {"data": "ESTATU"}
        ],
        'dom': 'Blfrtip',
        'buttons': [
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


    // AGREGAR FICHA SOCIAL
    var formVsficsoc = document.querySelector("#formVsficsoc");
    
   	formVsficsoc.onsubmit = function(e)
    {
   		e.preventDefault(); //previene que se recargue el formulario o pagina...
      
		var request  = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');	
   		var ajaxUrl  = base_url+"Vsficsoc/setVsficsoc";
   		var formData = new FormData(formVsficsoc);

   		request.open("POST",ajaxUrl,true);
		request.send(formData);
			
        request.onreadystatechange = function()
        {
    		if(request.readyState == 4 && request.status == 200)
   	    	{					 
   				let objData = JSON.parse(request.responseText);			

   				if(objData.status)
   				{
   					$('#modalformVsficsoc').modal('hide');
   					formVsficsoc.reset();
   					swal('Ficha',objData.msg,'success');
            
                    document.querySelector('#idSec_id').value = 0;

                    document.querySelector('#listStd_no').value = "";
                    $('#listStd_no').selectpicker('render');
                    document.querySelector('#listCivils').value = "";
                    $('#listCivils').selectpicker('render');
                    document.querySelector('#listEtnico').value = "";
                    $('#listEtnico').selectpicker('render');
                    document.querySelector('#listHoucon').value = "";
                    $('#listHoucon').selectpicker('render');
                    document.querySelector('#listHoutyp').value = "";
                    $('#listHoutyp').selectpicker('render');
                    document.querySelector('#listEnergy').value = "";
                    $('#listEnergy').selectpicker('render');
                    document.querySelector('#listWaters').value = "";
                    $('#listWaters').selectpicker('render');
                    document.querySelector('#listToilet').value = "";
                    $('#listToilet').selectpicker('render');
                    document.querySelector('#listSeptic').value = "";
                    $('#listSeptic').selectpicker('render');
                    document.querySelector('#listTeleph').value = "";
                    $('#listTeleph').selectpicker('render');
                    document.querySelector('#listSmarph').value = "";
                    $('#listSmarph').selectpicker('render');
                    document.querySelector('#listIntern').value = "";
                    $('#listIntern').selectpicker('render');
                    document.querySelector('#listTvcabl').value = "";
                    $('#listTvcabl').selectpicker('render');
                    document.querySelector('#listMedatt').value = "";
                    $('#listMedatt').selectpicker('render');
                    document.querySelector('#listMedfre').value = "";
                    $('#listMedfre').selectpicker('render');
                    document.querySelector('#listObesid').value = "";
                    $('#listObesid').selectpicker('render');
                    document.querySelector('#listDiabet').value = "";
                    $('#listDiabet').selectpicker('render');
                    document.querySelector('#listHipert').value = "";
                    $('#listHipert').selectpicker('render');
                    document.querySelector('#listCardio').value = "";
                    $('#listCardio').selectpicker('render');
                    document.querySelector('#listBrains').value = "";
                    $('#listBrains').selectpicker('render');
                    document.querySelector('#listOthers').value = "";
                    $('#listOthers').selectpicker('render');
              
                    TablaVsficsoc.ajax.reload(null,false);
   				}else{
                    $('#modalformVsficsoc').modal('hide');
                    formVsficsoc.reset();
  					swal('ERROR: ',objData.msg,'error');
                }
   			}    			
   		}
   	}
});


// FICHA SOCIAL
function openModalFic()
{
    document.querySelector('#idSec_id').value = 0;

    document.querySelector('#listStd_no').value = "";
    $('#listStd_no').selectpicker('render');
    document.querySelector('#listCivils').value = "";
    $('#listCivils').selectpicker('render');
    document.querySelector('#listEtnico').value = "";
    $('#listEtnico').selectpicker('render');
    document.querySelector('#listHoucon').value = "";
    $('#listHoucon').selectpicker('render');
    document.querySelector('#listHoutyp').value = "";
    $('#listHoutyp').selectpicker('render');
    document.querySelector('#listEnergy').value = "";
    $('#listEnergy').selectpicker('render');
    document.querySelector('#listWaters').value = "";
    $('#listWaters').selectpicker('render');
    document.querySelector('#listToilet').value = "";
    $('#listToilet').selectpicker('render');
    document.querySelector('#listSeptic').value = "";
    $('#listSeptic').selectpicker('render');
    document.querySelector('#listTeleph').value = "";
    $('#listTeleph').selectpicker('render');
    document.querySelector('#listSmarph').value = "";
    $('#listSmarph').selectpicker('render');
    document.querySelector('#listIntern').value = "";
    $('#listIntern').selectpicker('render');
    document.querySelector('#listTvcabl').value = "";
    $('#listTvcabl').selectpicker('render');
    document.querySelector('#listMedatt').value = "";
    $('#listMedatt').selectpicker('render');
    document.querySelector('#listMedfre').value = "";
    $('#listMedfre').selectpicker('render');
    document.querySelector('#listObesid').value = "";
    $('#listObesid').selectpicker('render');
    document.querySelector('#listDiabet').value = "";
    $('#listDiabet').selectpicker('render');
    document.querySelector('#listHipert').value = "";
    $('#listHipert').selectpicker('render');
    document.querySelector('#listCardio').value = "";
    $('#listCardio').selectpicker('render');
    document.querySelector('#listBrains').value = "";
    $('#listBrains').selectpicker('render');
    document.querySelector('#listOthers').value = "";
    $('#listOthers').selectpicker('render');

    document.querySelector('#titleModal').innerHTML = 'Nueva Ficha Social';
    document.querySelector('.modal-header').classList.replace('headerUpdate','headerRegister');
    document.querySelector('#btnActionForm').classList.replace('btn-info','btn-primary');
    document.querySelector('#btnText').innerHTML = 'Guardar';

    document.querySelector("#formVsficsoc").reset();
	$("#modalformVsficsoc").modal('show');
}


// EDITAR FICHA SOCIAL
function fntEditVsficsoc(idSTD)
{
    document.querySelector('#titleModal').innerHTML = 'Editar Ficha Social';
    document.querySelector('.modal-header').classList.replace('headerRegister','headerUpdate');
    document.querySelector('#btnActionForm').classList.replace('btn-primary','btn-info');
    document.querySelector('#btnText').innerHTML = 'Actualizar';

    var stdID = idSTD;
    var request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
    var ajaxUrl = base_url+"Vsficsoc/getVsficsoc/"+stdID;

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

                // COMBO: Estudiante
                $opcion = objData.data.STD_NO;
                document.querySelector('#listStd_no').value = $opcion;
                $('#listStd_no').selectpicker('render');

                // COMBO: Estado Civil
                $opcion = objData.data.CIVILS;
                document.querySelector('#listCivils').value = $opcion;
                $('#listCivils').selectpicker('render');

                // COMBO: Etnico
                $opcion = objData.data.ETNICO;
                document.querySelector('#listEtnico').value = $opcion;
                $('#listEtnico').selectpicker('render');

                // Ocupación y Lugar de Trabajo
                document.querySelector('#txtStdjob').value = objData.data.STDJOB;
                document.querySelector('#txtStdwrk').value = objData.data.STDWRK;
                
                // COMBO: Condicion de Vivienda
                $opcion = objData.data.HOUCON;
                document.querySelector('#listHoucon').value = $opcion;
                $('#listHoucon').selectpicker('render');

                // COMBO: Tipo de Vivienda
                $opcion = objData.data.HOUTYP;
                document.querySelector('#listHoutyp').value = $opcion;
                $('#listHoutyp').selectpicker('render');

                // COMBO: Energia Electrica
                $opcion = objData.data.ENERGY;
                document.querySelector('#listEnergy').value = $opcion;
                $('#listEnergy').selectpicker('render');

                // COMBO: Agua Potable
                $opcion = objData.data.WATERS;
                document.querySelector('#listWaters').value = $opcion;
                $('#listWaters').selectpicker('render');

                // COMBO: SSHH
                $opcion = objData.data.TOILET;
                document.querySelector('#listToilet').value = $opcion;
                $('#listToilet').selectpicker('render');

                // COMBO: Pozo Septico
                $opcion = objData.data.SEPTIC;
                document.querySelector('#listSeptic').value = $opcion;
                $('#listSeptic').selectpicker('render');

                // COMBO: Telefono
                $opcion = objData.data.TELEPH;
                document.querySelector('#listTeleph').value = $opcion;
                $('#listTeleph').selectpicker('render');

                // COMBO: Smartphone
                $opcion = objData.data.SMARPH;
                document.querySelector('#listSmarph').value = $opcion;
                $('#listSmarph').selectpicker('render');

                // COMBO: Internet
                $opcion = objData.data.INTERN;
                document.querySelector('#listIntern').value = $opcion;
                $('#listIntern').selectpicker('render');

                // COMBO: TV Cable
                $opcion = objData.data.TVCABL;
                document.querySelector('#listTvcabl').value = $opcion;
                $('#listTvcabl').selectpicker('render');

                // COMBO: Lugar Atención Médica
                $opcion = objData.data.MEDATT;
                document.querySelector('#listMedatt').value = $opcion;
                $('#listMedatt').selectpicker('render');

                // COMBO: Frecuencia Atención Médica
                $opcion = objData.data.MEDFRE;
                document.querySelector('#listMedfre').value = $opcion;
                $('#listMedfre').selectpicker('render');

                // Alergias
                document.querySelector('#txtAlermd').value = objData.data.ALERMD;
                document.querySelector('#txtAlerfo').value = objData.data.ALERFO;
                document.querySelector('#txtAlercl').value = objData.data.ALERCL;
                document.querySelector('#txtAlerot').value = objData.data.ALEROT;

                // Tipo de Sangre y Enfermedades
                document.querySelector('#txtBloodt').value = objData.data.BLOODT;
                document.querySelector('#txtDiseas').value = objData.data.DISEAS;

                // Discapacidad
                document.querySelector('#txtDiscap').value = objData.data.DISCAP;
                document.querySelector('#txtConadi').value = objData.data.CONADI;

                // COMBO: Obbesidad
                $opcion = objData.data.OBESID;
                document.querySelector('#listObesid').value = $opcion;
                $('#listObesid').selectpicker('render');

                // COMBO: Diabetes
                $opcion = objData.data.DIABET;
                document.querySelector('#listDiabet').value = $opcion;
                $('#listDiabet').selectpicker('render');

                // COMBO: Hipertensión
                $opcion = objData.data.HIPERT;
                document.querySelector('#listHipert').value = $opcion;
                $('#listHipert').selectpicker('render');

                // COMBO: Cardiopatia
                $opcion = objData.data.CARDIO;
                document.querySelector('#listCardio').value = $opcion;
                $('#listCardio').selectpicker('render');

                // COMBO: Mentales
                $opcion = objData.data.BRAINS;
                document.querySelector('#listBrains').value = $opcion;
                $('#listBrains').selectpicker('render');

                // COMBO: Otros
                $opcion = objData.data.OTHERS;
                document.querySelector('#listOthers').value = $opcion;
                $('#listOthers').selectpicker('render');

                // Medicamentos
                document.querySelector('#txtMedici').value = objData.data.MEDICI;
                $('#modalformVsficsoc').modal('show');
            }else{
                swal("Error",objData.msg,"error");
            }
        }
    }
}
