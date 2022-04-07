var TablaVsemplox;

$(document).ready(function()
{
		TablaVsemplox = $('#TableVsemplox').DataTable({
    	"language":{
			"url": "//cdn.datatables.net/plug-ins/1.10.22/i18n/Spanish.json"	
		},
    	"ajax": {
    		"url": ""+base_url+"Vsemplox/getVsemploxs",
    		"dataSrc":""
    	},
        "columns":[
            {"data": "options"},
            {"data": "LAS_NM"},
            {"data": "FIR_NM"},
            {"data": "IDTYPE"},
            {"data": "IDE_NO"},
			{"data": "ESTATU"},
			{"data": "ADDRES"},
			{"data": "TPHONE"}
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
            { 'className': "anchocelda", "targets": [ 3 ]},
            { 'className': "anchocelda", "targets": [ 4 ]},
            { 'className': "anchocelda", "targets": [ 5 ]},
            { 'className': "anchocelda", "targets": [ 6 ]},
            { 'className': "anchocelda", "targets": [ 7 ]}
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


    // AGREGAR PERSONAL
    var formVsemplox = document.querySelector("#formVsemplox");
    var divLoading  = document.querySelector('#divLoading');
    
   	formVsemplox.onsubmit = function(e)
   	{
   		e.preventDefault(); //previene que se recargue el formulario o pagina...

		var request  = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');		
   		var ajaxUrl  = base_url+"Vsemplox/setVsemplox";
		var formData = new FormData(formVsemplox);
			
   		request.open("POST",ajaxUrl,true);
		request.send(formData);	
        divLoading.style.display = "flex";
			
		request.onreadystatechange = function()
   		{
            if(request.readyState == 4 && request.status == 200)
            {
   				var objData = JSON.parse(request.responseText);	
   				if(objData.status)
   				{
   					$('#modalformVsemplox').modal('hide');
   					swal('Personal',objData.msg,'success');
                    TablaVsemplox.ajax.reload(null,false);
   				}else{
  					swal('ERROR: ',objData.msg,'error');
   				}
                divLoading.style.display = "none";
   			}
   		}
   	}
});


// PERSONAL
function openModalEmp()
{
    document.querySelector('#idEmp_no').value = 0;
    document.querySelector('#listStatus').value = "";
    $('#listStatus').selectpicker('render');
    document.querySelector('#listProfil').value = "";
    $('#listProfil').selectpicker('render');
    document.querySelector('#listEmpgen').value = "";
    $('#listEmpgen').selectpicker('render');
    document.querySelector('#listEstado').value = "";
    $('#listEstado').selectpicker('render');
    document.querySelector('#listIdtype').value = "";
    $('#listIdtype').selectpicker('render');
    document.querySelector('#listCat_no').value = "";
    $('#listCat_no').selectpicker('render');

    document.querySelector('#titleModal').innerHTML = 'Nuevo Personal';
    document.querySelector('.modal-header').classList.replace('headerUpdate','headerRegister');
    document.querySelector('#btnActionForm').classList.replace('btn-info','btn-primary');
    document.querySelector('#btnText').innerHTML = 'Guardar';

    document.querySelector("#formVsemplox").reset();
	$("#modalformVsemplox").modal('show');
}


// EDITAR PERSONAL
function fntEditVsemplox(idSTD)
{
    document.querySelector('#titleModal').innerHTML = 'Editar Personal';
    document.querySelector('.modal-header').classList.replace('headerRegister','headerUpdate');
    document.querySelector('#btnActionForm').classList.replace('btn-primary','btn-info');
    document.querySelector('#btnText').innerHTML = 'Actualizar';

    var stdID = idSTD;
    var request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
    var ajaxUrl = base_url+"Vsemplox/getVsemplox/"+stdID;

    request.open("GET",ajaxUrl,true);
    request.send();

    request.onreadystatechange = function()
    {
        if(request.readyState == 4 && request.status == 200)
        {
            var objData = JSON.parse(request.responseText);
            if(objData.status)
            {  
                // ID del Personal
                document.querySelector('#idEmp_no').value = objData.data.EMP_NO;

                // COMBO: Condicion
                document.querySelector('#listStatus').value = objData.data.ESTATU;
                $('#listStatus').selectpicker('render');

                // COMBO: Profile
                document.querySelector('#listProfil').value = objData.data.PROFIL;
                $('#listProfil').selectpicker('render');

                // Apellidos y Nombres
                document.querySelector('#txtLas_nm').value = objData.data.LAS_NM;
                document.querySelector('#txtFir_nm').value = objData.data.FIR_NM;
               
                // Dirección y Teléfonos
                document.querySelector('#txtAddres').value = objData.data.ADDRES;
                document.querySelector('#txtTphone').value = objData.data.TPHONE;

                // Parroquia y Ciudad
                document.querySelector('#txtParroq').value = objData.data.PARROQ;
                document.querySelector('#txtCiudad').value = objData.data.CIUDAD;

                // Provincia y Pais
                document.querySelector('#txtProvin').value = objData.data.PROVIN;
                document.querySelector('#txtPaises').value = objData.data.PAISES;

				// Identificacion
                document.querySelector('#listIdtype').value = objData.data.IDTYPE;
                $('#listIdtype').selectpicker('render');
                document.querySelector('#txtIde_no').value = objData.data.IDE_NO;

                // Genero y Estado Civil
                document.querySelector('#listEmpgen').value = objData.data.EMPGEN;
                $('#listEmpgen').selectpicker('render');
                document.querySelector('#listEstado').value = objData.data.ESTADO;
                $('#listEstado').selectpicker('render');

				// Fecha de Nacimiento
                document.querySelector('#datFecbir').value = objData.data.FECBIR;

                // Fecha de Ingreso
                document.querySelector('#datFecing').value = objData.data.FECING;

                // Email
                document.querySelector('#txtEmpmai').value = objData.data.EMPMAI;

				// Cuenta Bancaria
                document.querySelector('#listCtatyp').value = objData.data.CTATYP;
                $('#listCtatyp').selectpicker('render');
                document.querySelector('#txtCtaban').value = objData.data.CTABAN;

				// Años de Servicio
                document.querySelector('#txtServic').value = objData.data.SERVIC;

				// Años en Magisterio
                document.querySelector('#txtMagist').value = objData.data.MAGIST;

				// Código Sectorial
                document.querySelector('#txtSeccod').value = objData.data.SECCOD;

				// Código Postal
                document.querySelector('#txtPoscod').value = objData.data.POSCOD;

				// COMBO: Religión
                document.querySelector('#listEmprlg').value = objData.data.EMPRLG;
                $('#listEmprlg').selectpicker('render');

				// Número de Cargas
                document.querySelector('#txtCargas').value = objData.data.CARGAS;

				// Titulos
                document.querySelector('#txtTitulo').value = objData.data.TITULO;

				// Observaciones
                document.querySelector('#txtRemark').value = objData.data.REMARK;

                // Grupo Nómina
                document.querySelector('#listCat_no').value = objData.data.CAT_NO;
                $('#listCat_no').selectpicker('render');

                // Sueldo
                document.querySelector('#txtSalary').value = objData.data.SALARY;

                $('#modalformVsemplox').modal('show');
            }else{
                swal("Error",objData.msg,"error");
            }
        }
    }
}
