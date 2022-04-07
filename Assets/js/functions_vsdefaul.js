var TablaVsdefaul;

$(document).ready(function() {
    TablaVsdefaul = $('#TableVsdefaul').DataTable({
    	"language":{
			"url": "//cdn.datatables.net/plug-ins/1.10.22/i18n/Spanish.json"	
		},
    	"ajax": {
    		"url": base_url+"Vsdefaul/getVsdefauls",
    		"dataSrc":""
    	},
        "columns":[
            {"data": "options"},
            {"data": "AMI_ID"},
            {"data": "PERIOS"},
            {"data": "RAZONS"},
            {"data": "ADDRES"},
            {"data": "TPHONE"}
			],
			"columnDefs": [
				{ 'className': "anchocelda", "targets": [ 0 ]},
				{ 'className': "anchocelda", "targets": [ 1 ]},
				{ 'className': "anchocelda", "targets": [ 2 ]},
				{ 'className': "anchocelda", "targets": [ 3 ]},
				{ 'className': "anchocelda", "targets": [ 4 ]},
				{ 'className': "anchocelda", "targets": [ 5 ]}
			  ],
		responsive:true,
    	destroy:true,
    	"displayLength":10,
		"order":[[0,"asc"]]
    });


    // AGREGAR PARAMETRO
    var formVsdefaul = document.querySelector("#formVsdefaul");
    
   	formVsdefaul.onsubmit = function(e)
   	{
   		e.preventDefault(); //previene que se recargue el formulario o pagina...

		var request  = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');		
   		var ajaxUrl  = base_url+"Vsdefaul/setVsdefaul";
		var formData = new FormData(formVsdefaul);
			
   		request.open("POST",ajaxUrl,true);
		request.send(formData);	
		request.onreadystatechange = function()
   		{
   			if(request.readyState == 4 && request.status == 200)
   			{	
   				var objData = JSON.parse(request.responseText);	
   				if(objData.status)
   				{
   					$('#modalformVsdefaul').modal('hide');
   					swal('Parámetro',objData.msg,'success');
                    TablaVsdefaul.ajax.reload(function(){});
   				}else{
   					swal('ERROR: ',objData.msg,'error');
   				}
   			}    			
   		}
   	}
});


// PARAMETRO
function openModalDef()
{
    document.querySelector('#idSec_id').value = 0;
    document.querySelector('#titleModal').innerHTML = 'Nuevo Parámetro';
    document.querySelector('.modal-header').classList.replace('headerUpdate','headerRegister');
    document.querySelector('#btnActionForm').classList.replace('btn-info','btn-primary');
    document.querySelector('#btnText').innerHTML = 'Guardar';
    document.querySelector("#formVsdefaul").reset();
	$("#modalformVsdefaul").modal('show');
}


// EDITAR PARAMETRO
function fntEditVsdefaul(idSEC)
{
    document.querySelector('#titleModal').innerHTML = 'Editar Paràmetro';
    document.querySelector('.modal-header').classList.replace('headerRegister','headerUpdate');
    document.querySelector('#btnActionForm').classList.replace('btn-primary','btn-info');
    document.querySelector('#btnText').innerHTML = 'Actualizar';

    var secID   = idSEC;
    var request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
    var ajaxUrl = base_url+"Vsdefaul/getVsdefaul/"+secID;

    request.open("GET",ajaxUrl,true);
    request.send();

    request.onreadystatechange = function()
    {
        if(request.readyState == 4 && request.status == 200)
        {
            var objData = JSON.parse(request.responseText);
            if(objData.status)
            {  
                // ID Parámetro
                document.querySelector('#idSec_id').value = objData.data.SEC_ID;

                // AMIE y Distrito
                document.querySelector('#txtAmi_id').value = objData.data.AMI_ID;
                document.querySelector('#txtDistri').value = objData.data.DISTRI;

                // Razón Social
                document.querySelector('#txtRazons').value = objData.data.RAZONS;
               
                // Rector y Secretario
                document.querySelector('#txtRector').value = objData.data.RECTOR;
                document.querySelector('#txtSecret').value = objData.data.SECRES;

                // Dirección y Teléfonos
                document.querySelector('#txtAddres').value = objData.data.ADDRES;
                document.querySelector('#txtTphone').value = objData.data.TPHONE;

                // Numero de R.U.C.
                document.querySelector('#txtRuc_no').value = objData.data.RUC_NO;

                // Email 
                document.querySelector('#txtEmails').value = objData.data.EMAILS;

                // Parroquia - Ciudad - Canton y Provincia
                document.querySelector('#txtParroq').value = objData.data.PARROQ;
                document.querySelector('#txtCiudad').value = objData.data.CIUDAD;
                document.querySelector('#txtCanton').value = objData.data.CANTON;
                document.querySelector('#txtProvin').value = objData.data.PROVIN;
                
                // COMBO: Régimen
                document.querySelector('#listRegime').value = objData.data.REGIME;
                $('#listRegime').selectpicker('render');

                // COMBO: Sostenimiento
                document.querySelector('#listSosten').value = objData.data.SOSTEN;
                $('#listSosten').selectpicker('render');

                // Leyendas 1º Quimestre
                document.querySelector('#txtQ1p1hd').value = objData.data.Q1P1HD;
                document.querySelector('#txtQ1p2hd').value = objData.data.Q1P2HD;
                document.querySelector('#txtQ1p3hd').value = objData.data.Q1P3HD;
                document.querySelector('#txtQ1p4hd').value = objData.data.Q1P4HD;

                // Fechas 1º Quimestre
                document.querySelector('#datQ1p1pr').value = objData.data.Q1P1PR;
                document.querySelector('#datQ1p2pr').value = objData.data.Q1P2PR;
                document.querySelector('#datQ1p3pr').value = objData.data.Q1P3PR;
                document.querySelector('#datQ1p4pr').value = objData.data.Q1P4PR;
            
                // Leyendas 2º Quimestre
                document.querySelector('#txtQ2p1hd').value = objData.data.Q2P1HD;
                document.querySelector('#txtQ2p2hd').value = objData.data.Q2P2HD;
                document.querySelector('#txtQ2p3hd').value = objData.data.Q2P3HD;
                document.querySelector('#txtQ2p4hd').value = objData.data.Q2P4HD;

                // Fechas 2º Quimestre
                document.querySelector('#datQ2p1pr').value = objData.data.Q2P1PR;
                document.querySelector('#datQ2p2pr').value = objData.data.Q2P2PR;
                document.querySelector('#datQ2p3pr').value = objData.data.Q2P3PR;
                document.querySelector('#datQ2p4pr').value = objData.data.Q2P4PR;

                // Base de Calificación y Mínimo Supletorio
                document.querySelector('#listBascal').value = objData.data.BASCAL;
                document.querySelector('#listMinsup').value = objData.data.MINSUP;
                
                // Promediar Parciales y Numero de Trabajos
                document.querySelector('#listParpro').value = objData.data.PARPRO;
                document.querySelector('#listInsnum').value = objData.data.INSNUM;

                // Porcentajes por Parcial y Examen
                document.querySelector('#listParpor').value = objData.data.PARPOR;
                document.querySelector('#listExapor').value = objData.data.EXAPOR;

                // Número de Matricula y Folio
                document.querySelector('#listMatnum').value = objData.data.MATNUM;
                document.querySelector('#listFolnum').value = objData.data.FOLNUM;
                
                // Número de decimales y Periodo
                document.querySelector('#listDecnum').value = objData.data.DECNUM;
                document.querySelector('#listPerios').value = objData.data.PERIOS;
            
                $('#modalformVsdefaul').modal('show');
            }else{
                swal("Error",objData.msg,"error");
            }
        }
    }
}
