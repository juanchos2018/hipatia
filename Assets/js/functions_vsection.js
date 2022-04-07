var TablaVsection;

$(document).ready(function()
{
        TablaVsection = $('#TableVsection').DataTable({
        "language":{
            "url": "//cdn.datatables.net/plug-ins/1.10.22/i18n/Spanish.json"    
        },
        "ajax": {
            "url": base_url+"Vsection/getVsections",
            "dataSrc":""
        },
        "columns":[
            {"data": "options"},
            {"data": "SEC_NM"},
            {"data": "PARALE"},
            {"data": "REGIME"},
            {"data": "JOR_NO"}
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


    // AGREGAR SECCION
    var formVsection = document.querySelector("#formVsection");
    formVsection.onsubmit = function(e)
    {
        e.preventDefault(); //previene que se recargue el formulario o pagina...

        var request  = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');     
        var ajaxUrl  = base_url+"Vsection/setVsection";
        var formData = new FormData(formVsection);
            
        request.open("POST",ajaxUrl,true);
        request.send(formData); 
            
        request.onreadystatechange = function()
        {
            if(request.readyState == 4 && request.status == 200)
            { 
                var objData = JSON.parse(request.responseText); 
                if(objData.status)
                {
                    $('#modalformVsection').modal('hide');
                    swal('Sección',objData.msg,'success');
                    TablaVsection.ajax.reload(null,false);
                }else{
                    swal('ERROR: ',objData.msg,'error');                        
                }
            }               
        }
    }    
});


// SECCION
function openModalSec()
{
    document.querySelector('#idSec_no').value = 0;

    document.querySelector('#listPabell').value = "";
    $('#listPabell').selectpicker('render');
    document.querySelector('#listNiv_no').value = "";
    $('#listNiv_no').selectpicker('render');
    document.querySelector('#listRegime').value = "";
    $('#listRegime').selectpicker('render');
    document.querySelector('#listJor_no').value = "";
    $('#listJor_no').selectpicker('render');
    document.querySelector('#listModoes').value = "";
    $('#listModoes').selectpicker('render');
    document.querySelector('#listSec_n2').value = 0;
    $('#listSec_n2').selectpicker('render');

    document.querySelector('#titleModal').innerHTML = 'Nueva Sección';
    document.querySelector('.modal-header').classList.replace('headerUpdate','headerRegister');
    document.querySelector('#btnActionForm').classList.replace('btn-info','btn-primary');
    document.querySelector('#btnText').innerHTML = 'Guardar';
    document.querySelector("#formVsection").reset();
    $("#modalformVsection").modal('show');
}


// EDITAR SECCION
function fntEditVsection(idSEC)
{
    document.querySelector('#titleModal').innerHTML = 'Editar Sección';
    document.querySelector('.modal-header').classList.replace('headerRegister','headerUpdate');
    document.querySelector('#btnActionForm').classList.replace('btn-primary','btn-info');
    document.querySelector('#btnText').innerHTML = 'Actualizar';

    var secID   = idSEC;
    var request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
    var ajaxUrl = base_url+"Vsection/getVsection/"+secID;

    request.open("GET",ajaxUrl,true);
    request.send();

    request.onreadystatechange = function()
    {
        if(request.readyState == 4 && request.status == 200)
        {
            var objData = JSON.parse(request.responseText);
            if(objData.status)
            {  
                // ID Sección
                document.querySelector('#idSec_no').value = objData.data.SEC_NO;

                // COMBO: Area de Estudio
                document.querySelector('#listPabell').value = objData.data.PABELL;
                $('#listPabell').selectpicker('render');

                // COMBO: Nivel
                document.querySelector('#listNiv_no').value = objData.data.NIV_NO;
                $('#listNiv_no').selectpicker('render');

                // Nombre
                document.querySelector('#txtSec_nm').value = objData.data.SEC_NM;

                // Paralelo
                document.querySelector('#txtParale').value = objData.data.PARALE;

                // COMBO: Modalidad
                document.querySelector('#listModoes').value = objData.data.MODOES;
                $('#listModoes').selectpicker('render');

                // COMBO: Régimen
                document.querySelector('#listRegime').value = objData.data.REGIME;
                $('#listRegime').selectpicker('render');

                // COMBO: Jornada
                document.querySelector('#listJor_no').value = objData.data.JOR_NO;
                $('#listJor_no').selectpicker('render');

                // COMBO: Sección Superior
                document.querySelector('#listSec_n2').value = objData.data.SEC_N2;
                $('#listSec_n2').selectpicker('render');

                $('#modalformVsection').modal('show');
            }else{
                swal("Error",objData.msg,"error");
            }
        }
    }
}
