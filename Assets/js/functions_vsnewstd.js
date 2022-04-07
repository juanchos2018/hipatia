var TablaVsnewstd;
$(document).ready(function() {
        TablaVsnewstd = $('#TableVsnewstd').DataTable({
        "language":{
            "url": "//cdn.datatables.net/plug-ins/1.10.22/i18n/Spanish.json"    
        },
        "ajax": {
            "url": base_url+"Vsnewstd/getVsnewstds",
            "dataSrc":""
        },
        "columns":[
            {"data": "options"},
            {"data": "LAS_NM"},
            {"data": "FIR_NM"},
            {"data": "SEC_NM"},
            {"data": "PARALE"}
        ],
        "columnDefs": [
            { 'className': "anchocelda", "targets": [ 0 ]},
            { 'className': "anchocelda", "targets": [ 1 ]},
            { 'className': "anchocelda", "targets": [ 2 ]},
            { 'className': "anchocelda", "targets": [ 3 ]},
            { 'className': "anchocelda", "targets": [ 4 ]}
          ],
        responsive:true,
        destroy:true,
        "displayLength":10,
        "order":[[0,"asc"]]
    });


    // AGREGAR ASPIRANTE
    var formVsnewstd = document.querySelector("#formVsnewstd");

    formVsnewstd.onsubmit = function(e)
    {
        e.preventDefault(); //previene que se recargue el formulario o pagina...
            
        var request  = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP'); 
        var ajaxUrl  = base_url+"Vsnewstd/setVsnewstd";
        var formData = new FormData(formVsnewstd);

        request.open("POST",ajaxUrl,true);
        request.send(formData); 

        request.onreadystatechange = function()
        {    
            if(request. readyState == 4 && request.status == 200)
            {                    
                let objData = JSON.parse(request.responseText);
                if(objData.status)
                {
                    $('#modalformVsnewstd').modal('hide');
                    swal('Aspirante',objData.msg,'success');
                    TablaVsnewstd.ajax.reload(null,false);
                }else{
                    swal('Aspirante',objData.msg,'error');
                }
            }               
        }
    }
});


// ASPIRANTE
function openModalIns()
{
    document.querySelector('#idStd_no').value = 0;
    document.querySelector('#listReceiv').value = 0;
    $('#listReceiv').selectpicker('render');
    document.querySelector('#listSec_no').value = "";
    $('#listSec_no').selectpicker('render');
    document.querySelector('#listStdgen').value = "";
    $('#listStdgen').selectpicker('render');
    document.querySelector('#listTt_who').value = "";
    $('#listTt_who').selectpicker('render');

    document.querySelector('#titleModal').innerHTML = 'Nuevo Aspirante';
    document.querySelector('.modal-header').classList.replace('headerUpdate','headerRegister');
    document.querySelector('#btnActionForm').classList.replace('btn-info','btn-primary');
    document.querySelector('#btnText').innerHTML = 'Guardar';

    document.querySelector("#formVsnewstd").reset();
    fntGetPerios();
    $("#modalformVsnewstd").modal('show');
}


// EDITAR ASPIRAMTE
async function fntEditVsnewstd(idSTD)
{
    document.querySelector('#titleModal').innerHTML = 'Editar Aspirante';
    document.querySelector('.modal-header').classList.replace('headerRegister','headerUpdate');
    document.querySelector('#btnActionForm').classList.replace('btn-primary','btn-info');
    document.querySelector('#btnText').innerHTML = 'Actualizar';

    var stdID   = idSTD;
    var request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
    var ajaxUrl = base_url+"Vsnewstd/getVsnewstd/"+stdID;

    request.open("GET",ajaxUrl,true);
    request.send();

    request.onreadystatechange = function()
    {
        if(request.readyState == 4 && request.status == 200)
        {
            var objData = JSON.parse(request.responseText);
            if(objData.status)
            {  
                // ID del Aspirante
                document.querySelector('#idStd_no').value = objData.data.STD_NO;

                // COMBO: Estudiante Admitido
                $opcion = objData.data.RECEIV;
                document.querySelector('#listReceiv').value = $opcion;
                $('#listReceiv').selectpicker('render');

                // Año Lectivo .....
                document.querySelector('#listPerios').value = objData.data.PERIOS;

                // COMBO: Sección
                $opcion = objData.data.SEC_NO;
                document.querySelector('#listSec_no').value = $opcion;
                $('#listSec_no').selectpicker('render');

                // Apellidos y Nombres del Estudiante
                document.querySelector('#txtLas_nm').value = objData.data.LAS_NM;
                document.querySelector('#txtFir_nm').value = objData.data.FIR_NM;
               
                // Dirección y Teléfonos del Estudiante
                document.querySelector('#txtAddres').value = objData.data.ADDRES;
                document.querySelector('#txtTphone').value = objData.data.TPHONE;

                // COMBO: Tipo Identificacion
                $opcion = objData.data.IDTYPE;
                document.querySelector('#listIdtype').value = $opcion;
                $('#listIdtype').selectpicker('render');

                // Numero de Identificación
                document.querySelector('#txtIde_no').value = objData.data.IDE_NO;

                // Genero
                $opcion = objData.data.STDGEN;
                document.querySelector('#listStdgen').value = $opcion;
                $('#listStdgen').selectpicker('render');

                // Fecha de Nacimiento
                document.querySelector('#datFecbir').value = objData.data.FECBIR;

                // Email del Estudiante
                document.querySelector('#txtStdmai').value = objData.data.STDMAI;

                // Apellidos y Nombres del Padre
                document.querySelector('#txtFatlas').value = objData.data.FATLAS;
                document.querySelector('#txtFatnam').value = objData.data.FATNAM;

                // Direcccion y Telefonos del Padre
                document.querySelector('#txtFatadr').value = objData.data.FATADR;
                document.querySelector('#txtFatfon').value = objData.data.FATFON;

                // Tipo Identificacion Padre
                $opcion = objData.data.FATYPE;
                document.querySelector('#listFatype').value = $opcion;
                $('#listFatype').selectpicker('render');

                // Numero Idemtificacion Padre
                document.querySelector('#txtFatced').value = objData.data.FATCED;

                // Trabajo-Ocupacion del Padre
                document.querySelector('#txtFatjob').value = objData.data.FATJOB;

                // Fecha Nacimiento del Padre
                document.querySelector('#datFatbir').value = objData.data.FATBIR;

                // Email del Padre
                document.querySelector('#txtFatmai').value = objData.data.FATMAI;

                // Apellidos y Nombres de la Madre
                document.querySelector('#txtMotlas').value = objData.data.MOTLAS;
                document.querySelector('#txtMotnam').value = objData.data.MOTNAM;

                // Direcccion y Telefonos de la Madre
                document.querySelector('#txtMotadr').value = objData.data.MOTADR;
                document.querySelector('#txtMotfon').value = objData.data.MOTFON;

                // Tipo Identificacion Madre
                $opcion = objData.data.MOTYPE;
                document.querySelector('#listMotype').value = $opcion;
                $('#listMotype').selectpicker('render');

                // Numero Idemtificacion Madre
                document.querySelector('#txtMotced').value = objData.data.MOTCED;

                // Trabajo-Ocupacion de la Madre
                document.querySelector('#txtMotjob').value = objData.data.MOTJOB;

                // Fecha Nacimiento de la Madre
                document.querySelector('#datMotbir').value = objData.data.MOTBIR;

                // Email de la Madre
                document.querySelector('#txtMotmai').value = objData.data.MOTMAI;

                // Representado por:
                $opcion = objData.data.TT_WHO;
                document.querySelector('#listTt_who').value = $opcion;
                $('#listTt_who').selectpicker('render');

                // Apellidos y Nombres del Representante
                document.querySelector('#txtReplas').value = objData.data.REPLAS;
                document.querySelector('#txtRepnam').value = objData.data.REPNAM;

                // Direcccion y Telefonos del Representante
                document.querySelector('#txtRepadr').value = objData.data.REPADR;
                document.querySelector('#txtRepfon').value = objData.data.REPFON;

                // Tipo Identificacion Representante
                $opcion = objData.data.RETYPE;
                document.querySelector('#listRetype').value = $opcion;
                $('#listRetype').selectpicker('render');

                // Numero Idemtificacion Representante
                document.querySelector('#txtRepced').value = objData.data.REPCED;

                // Trabajo-Ocupacion del Representante
                document.querySelector('#txtRepjob').value = objData.data.REPJOB;

                // Fecha Nacimiento del Representante
                document.querySelector('#datRepbir').value = objData.data.REPBIR;

                // Email del Representante
                document.querySelector('#txtRepmai').value = objData.data.REPMAI;

                // Institucion de Procedencia
                document.querySelector('#txtLassch').value = objData.data.LASSCH;

                $('#modalformVsnewstd').modal('show');
            }else{
                swal("Error",objData.msg,"error");
            }
        }
    }
}
