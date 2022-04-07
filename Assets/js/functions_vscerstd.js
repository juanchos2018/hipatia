$(document).ready(function() {
    $('#TableVscerstd').DataTable({
    	"language":{
			"url": "//cdn.datatables.net/plug-ins/1.10.22/i18n/Spanish.json"	
		},
    	"ajax": {
    		"url": ""+base_url+"Vscerstd/getVscerstds",
    		"dataSrc":""
    	},
        "columns":[
            {"data": "options"},
            {"data": "LAS_NM"},
            {"data": "FIR_NM"},
            {"data": "ESTATU"},
            {"data": "SEC_NM"},
            {"data": "PARALE"}
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


    // EVENTO CLIC DEL BOTON IMPRIMIR CERTIFICADO
    let formVscerstd = document.querySelector("#formVscerstd");
    $('#btnPrnCerStd').on('click',function()
    {
        let request  = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');     
        let ajaxUrl  = base_url+"Vscerstd/prnCerStd";
        let formData = new FormData(formVscerstd); 
            
        request.open("POST",ajaxUrl,true);
        request.send(formData); 

        request.onreadystatechange = function()
        {
            if(request.readyState == 4 && request.status == 200)
            {
                $('#modalformVscerstd').modal('hide');
                $('.modal-body').html(request.responseText);
                $('#modStdCer').modal('show');
            }
        }
    });
});


function fntEditVscerstd(idSTD)
{
    var stdID   = idSTD;
    var request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
    var ajaxUrl = base_url+"Vstudent/getVstudent/"+stdID;  

    request.open("GET",ajaxUrl,true);
    request.send();

    request.onreadystatechange = function()
    {
        if(request.readyState == 4 && request.status == 200)
        {
            var objData = JSON.parse(request.responseText);
            if(objData.status)
            {  
                // Año Lectivo
                document.querySelector('#listPerios').value = objData.data.PERIOS;

			    // COMBO: Estudiante
			    $opcion = objData.data.STD_NO;
			    document.querySelector('#listStd_no').value = $opcion;
			    $('#listStd_no').selectpicker('render');
			  
                var fecha   = new Date(); //Fecha actual
                var dia     = fecha.getDate(); //obteniendo dia
                var mes     = fecha.getMonth()+1; //obteniendo mes
                var ano     = fecha.getFullYear(); //obteniendo año
            
                if(dia<10)
                  dia='0'+dia; //agrega cero si el menor de 10
                if(mes<10)
                  mes='0'+mes //agrega cero si el menor de 10
                document.getElementById('datFecreg').value = ano + "-" + mes + "-" + dia;

                $('#modalformVscerstd').modal('show');
            }else{
                swal("Error",objData.msg,"error");
            }
        }
    }
}
