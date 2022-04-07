$(document).ready(function() 
{
    fntGetAcount();
    fntGetBank();
    fntGetBanTab();
    fntGetCard();
    fntGetCat();
    fntGetEmplox();
    fntGetMatter();
    fntGetMatte2();
    fntGetMonth();
    fntGetParcial();
    fntGetParcia3();
    fntGetParcia4();
    fntGetProduc();
    fntGetPrv();
    fntGetRolrub();
    fntGetRolcre();
    fntGetRetenf();
    fntGetRetiva();
    fntGetSection();
    fntGetSectio2();
    fntGetStudent();
    fntGetTabhea();
    fntGetTable();
    fntRptStdAsp();
    fntRptStdAct();
    fntRptStdSex();
    fntRptEmp();
});


// REDONDEAR UN NUMERO A DOS DECIMALES
function roundToTwo(num) 
{
    return +(Math.round(num + "e+2")  + "e-2");
}


// GENERAR UN REPORTE A EXCEL
function exportTableToExcel(tableID, filename = '')
{
    var downloadLink;
    var dataType = 'application/vnd.ms-excel';
    var tableSelect = document.getElementById(tableID);
    var tableHTML = tableSelect.outerHTML.replace(/ /g, '%20');
    
    // Specify file name
    filename = filename?filename+'.xls':'Exceldata.xls';
    
    // Create download link element
    downloadLink = document.createElement("a");
    
    document.body.appendChild(downloadLink);
    
    if(navigator.msSaveOrOpenBlob)
    {
        var blob = new Blob(['ufeff', tableHTML], {
            type: dataType
        });
        navigator.msSaveOrOpenBlob( blob, filename);
    }else{
        // Create a link to the file
        downloadLink.href = 'data:' + dataType + ', ' + tableHTML;
    
        // Setting the file name
        downloadLink.download = filename;
        
        //triggering the function
        downloadLink.click();
    }
}


// IMPRIMIR UN REPORTE
function printDiv(divName) 
{
    let printContents       = document.getElementById(divName).innerHTML;
    let originalContents    = document.body.innerHTML;
    document.body.innerHTML = printContents;
    window.print();
    document.body.innerHTML = originalContents;
}


// GUARDA DATA DE UN REGISTRO DE CALIFICACIONES GENERALES
function fntSavOne(califi)
{
	let codSec_id = califi.substring(0,califi.search('-'));
    let codParcia = califi.substring(califi.search('-')+1,califi.lastIndexOf('-'));
    let codCalifi = califi.substring(califi.lastIndexOf('-')+1,califi.length);

    let strData = "codSec_id="+codSec_id+"&codParcia="+codParcia+"&codCalifi="+codCalifi;
    let request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
    let ajaxUrl = base_url+'Vsactsav/getSavOne'; 
    
    request.open("POST",ajaxUrl,true);
    request.setRequestHeader("Content-type","application/x-www-form-urlencoded");
    request.send(strData);

    request.onreadystatechange = function()
    {
        if(request.readyState == 4 && request.status == 200)
        {
        	let objData = JSON.parse(request.responseText);
        	if(objData.status)
            {
	        }else{
                swal("Error",objData.msg,"error");
            }
        }
    }
}


// GUARDA DATA DE UN REGISTRO DE CALIFICACIONES ACTIVIDADES
function fntSavAct(califi)
{
	let codSec_id = califi.substring(0,califi.search('-'));
    let codParcia = califi.substring(califi.search('-')+1,califi.lastIndexOf('-'));
    let codCalifi = califi.substring(califi.lastIndexOf('-')+1,califi.length);

    let strData = "codSec_id="+codSec_id+"&codParcia="+codParcia+"&codCalifi="+codCalifi;
    let request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
    let ajaxUrl = base_url+'Vsactsav/getSavAct'; 
    
    request.open("POST",ajaxUrl,true);
    request.setRequestHeader("Content-type","application/x-www-form-urlencoded");
    request.send(strData);

    request.onreadystatechange = function()
    {
        if(request.readyState == 4 && request.status == 200)
        {
        	let objData = JSON.parse(request.responseText);
        	if(objData.status)
            {
	        }else{
                swal("Error",objData.msg,"error");
            }
        }
    }
}


// OBTIENE Periodo de la tabla VSDEFAUL
function fntGetPerios()
{
    var ajaxUrl = base_url+'Vsdefaul/getPerios';
    var request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
    request.open("GET",ajaxUrl,true);
    request.send(); 
    
    request.onreadystatechange = function()
    {
        if(request.readyState == 4 && request.status == 200)
        {           
            let objData = JSON.parse(request.responseText);
            if(objData.status)
            {
                document.querySelector('#listPerios').value = objData.data.PERIOS;
                document.querySelector('#listPerio2').value = objData.data.PERIOS;
                document.querySelector('#listPerio3').value = objData.data.PERIOS;
            }else{
                swal("Error",objData.msg,"error");
            }
        }
    }    
}


// LLENA COMBO TIPOS DE TABLAS
function fntGetTabhea()
{
    var ajaxUrl = base_url+'Vstables/getTabhea';
    var request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
    request.open("GET",ajaxUrl,true);
    request.send(); 

    request.onreadystatechange = function()
    {
        if(request.readyState == 4 && request.status == 200)
        {
            document.querySelector('#listTab_no').innerHTML = request.responseText;
            document.querySelector('#listTab_no').value = "";
            $('#listTab_no').selectpicker('render');

            document.querySelector('#listTab_n2').innerHTML = request.responseText;
            document.querySelector('#listTab_n2').value = "";
            $('#listTab_n2').selectpicker('render');

            document.querySelector('#listTab_n3').innerHTML = request.responseText;
            document.querySelector('#listTab_n3').value = "";
            $('#listTab_n3').selectpicker('render');

            document.querySelector('#listTab_n4').innerHTML = request.responseText;
            document.querySelector('#listTab_n4').value = "";
            $('#listTab_n4').selectpicker('render');

            document.querySelector('#listDocapl').innerHTML = request.responseText;
            document.querySelector('#listDocapl').value = "";
            $('#listDocapl').selectpicker('render');
        }
    } 
}


// LLENA COMBO INSUMOS
function fntGetTable()
{
    let tab_no = 'INS';
    let ajaxUrl = base_url+'Vstables/getTable';
    let request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
    let strData = "tab_no="+tab_no;

    request.open("POST",ajaxUrl,true);
    request.setRequestHeader("Content-type","application/x-www-form-urlencoded");
    request.send(strData);
    
    request.onreadystatechange = function()
    {
        if(request.readyState == 4 && request.status == 200)
        {
            document.querySelector('#listInsumo').innerHTML = request.responseText;
            document.querySelector('#listInsumo').value = "";
            $('#listInsumo').selectpicker('render');
        }
    } 
}


// LLENA COMBO GRUPO NOMINA
function fntGetCat()
{
    let tab_no = 'CAT';
    let ajaxUrl = base_url+'Vstables/getTable';
    let request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
    let strData = "tab_no="+tab_no;

    request.open("POST",ajaxUrl,true);
    request.setRequestHeader("Content-type","application/x-www-form-urlencoded");
    request.send(strData);
    
    request.onreadystatechange = function()
    {
        if(request.readyState == 4 && request.status == 200)
        {
            document.querySelector('#listCat_no').innerHTML = request.responseText;
            document.querySelector('#listCat_no').value = "";
            $('#listCat_no').selectpicker('render');
        }
    } 
}


// LLENA COMBO ESTUDIANTES
function fntGetStudent()
{
    var ajaxUrl = base_url+'Vstudent/getComboStudent';
    var request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
    request.open("GET",ajaxUrl,true);
    request.send(); 
    
    request.onreadystatechange = function()
    {
        if(request.readyState == 4 && request.status == 200)
        {
            document.querySelector('#listStd_no').innerHTML = request.responseText;
            document.querySelector('#listStd_no').value = "";
            $('#listStd_no').selectpicker('render');

            document.querySelector('#listStd_n3').innerHTML = request.responseText;
            document.querySelector('#listStd_n3').value = "";
            $('#listStd_n3').selectpicker('render');

            document.querySelector('#listStd_n4').innerHTML = request.responseText;
            document.querySelector('#listStd_n4').value = "";
            $('#listStd_n4').selectpicker('render');
        }
    }    
}


// LLENA COMBO SECCIONES
function fntGetSection()
{
    var ajaxUrl = base_url+'Vsection/getSelectSection';
    var request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
    request.open("GET",ajaxUrl,true);
    request.send(); 

    request.onreadystatechange = function()
    {
        if(request.readyState == 4 && request.status == 200)
        {
            document.querySelector('#listSec_no').innerHTML = request.responseText;
            document.querySelector('#listSec_no').value = "";
            $('#listSec_no').selectpicker('render');
        }
    } 
}


// LLENA COMBO SECCIONES INMEDIATO SUPERIOR
function fntGetSectio2()
{
    var ajaxUrl = base_url+'Vsection/getSelectSectio2';
    var request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
    request.open("GET",ajaxUrl,true);
    request.send(); 

    request.onreadystatechange = function()
    {
        if(request.readyState == 4 && request.status == 200)
        {
            document.querySelector('#listSec_n2').innerHTML = request.responseText;
            document.querySelector('#listSec_n2').value = "";
            $('#listSec_n2').selectpicker('render');
        }
    } 
}


// LLENA COMBO ASIGNATURAS
function fntGetMatter()
{
    var ajaxUrl = base_url+'Vsmatter/getSelectMatter';
    var request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
    request.open("GET",ajaxUrl,true);
    request.send(); 

    request.onreadystatechange = function()
    {
        if(request.readyState == 4 && request.status == 200)
        {
            document.querySelector('#listMat_no').innerHTML = request.responseText;
            document.querySelector('#listMat_no').value = "";
            $('#listMat_no').selectpicker('render');

            document.querySelector('#listMat_n3').innerHTML = request.responseText;
            document.querySelector('#listMat_n3').value = "";
            $('#listMat_n3').selectpicker('render');
        }
    } 
}


// LLENA COMBO ASIGNATURAS GRUPO
function fntGetMatte2()
{
    var ajaxUrl = base_url+'Vsmatter/getSelectMatte2';
    var request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
    request.open("GET",ajaxUrl,true);
    request.send(); 

    request.onreadystatechange = function()
    {
        if(request.readyState == 4 && request.status == 200)
        {
            document.querySelector('#listMat_n2').innerHTML = request.responseText;
            document.querySelector('#listMat_n2').value = "";
            $('#listMat_n2').selectpicker('render');
        }
    } 
}


// LLENA COMBO PERSONAL
function fntGetEmplox()
{
    var ajaxUrl = base_url+'Vsemplox/getSelectEmplox';
    var request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
    request.open("GET",ajaxUrl,true);
    request.send(); 

    request.onreadystatechange = function()
    {
        if(request.readyState == 4 && request.status == 200)
        {
            document.querySelector('#listEmp_no').innerHTML = request.responseText;
            document.querySelector('#listEmp_no').value = "";
            $('#listEmp_no').selectpicker('render');

            document.querySelector('#listEmp_n2').innerHTML = request.responseText;
            document.querySelector('#listEmp_n2').value = "";
            $('#listEmp_n2').selectpicker('render');
        }
    } 
}


// LLENA COMBO ARTICULOS
function fntGetProduc()
{
    var ajaxUrl = base_url+'Vsproduc/getSelectProduc';
    var request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
    request.open("GET",ajaxUrl,true);
    request.send(); 

    request.onreadystatechange = function()
    {
        if(request.readyState == 4 && request.status == 200)
        {
            document.querySelector('#listArt_no').innerHTML = request.responseText;
            document.querySelector('#listArt_no').value = "";
            $('#listArt_no').selectpicker('render');
        }
    } 
}


// LLENA COMBO MESES DE FACTURACION
function fntGetMonth()
{
    let tab_no = 'MON';
    let ajaxUrl = base_url+'Vstables/getTable';
    let request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
    let strData = "tab_no="+tab_no;

    request.open("POST",ajaxUrl,true);
    request.setRequestHeader("Content-type","application/x-www-form-urlencoded");
    request.send(strData);
    
    request.onreadystatechange = function()
    {
        if(request.readyState == 4 && request.status == 200)
        {
            document.querySelector('#listPer_no').innerHTML = request.responseText;
            document.querySelector('#listPer_no').value = "";
            $('#listPer_no').selectpicker('render');

            document.querySelector('#listMon_no').innerHTML = request.responseText;
            document.querySelector('#listMon_no').value = "";
            $('#listMon_no').selectpicker('render');
		}
    } 
}


// LLENA COMBO TABLA ENTIDADES BANCARIAS
function fntGetBanTab()
{
    let tab_no = 'BAN';
    let ajaxUrl = base_url+'Vstables/getTable';
    let request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
    let strData = "tab_no="+tab_no;

    request.open("POST",ajaxUrl,true);
    request.setRequestHeader("Content-type","application/x-www-form-urlencoded");
    request.send(strData);
    
    request.onreadystatechange = function()
    {
        if(request.readyState == 4 && request.status == 200)
        {
            document.querySelector('#listBan_no').innerHTML = request.responseText;
            document.querySelector('#listBan_no').value = "";
            $('#listBan_no').selectpicker('render');
        }
    }    
}


// LLENA COMBO ENTIDADES BANCARIAS INTERNAS
function fntGetBank()
{
    var ajaxUrl = base_url+'Vstables/getBank';
    var request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
    request.open("GET",ajaxUrl,true);
    request.send(); 
    
    request.onreadystatechange = function()
    {
        if(request.readyState == 4 && request.status == 200)
        {
            document.querySelector('#listBan_n2').innerHTML = request.responseText;
            document.querySelector('#listBan_n2').value = "";
            $('#listBan_n2').selectpicker('render');

            document.querySelector('#listBan_n3').innerHTML = request.responseText;
            document.querySelector('#listBan_n3').value = "";
            $('#listBan_n3').selectpicker('render');

            document.querySelector('#listBan_n4').innerHTML = request.responseText;
            document.querySelector('#listBan_n4').value = "";
            $('#listBan_n4').selectpicker('render');

            document.querySelector('#listBan_n5').innerHTML = request.responseText;
            document.querySelector('#listBan_n5').value = "";
            $('#listBan_n5').selectpicker('render');
        }
    }    
}


// LLENA COMBO PROVEEDORES
function fntGetPrv()
{
    var ajaxUrl = base_url+'Vsprovid/getSelectProvid';
    var request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
    request.open("GET",ajaxUrl,true);
    request.send(); 

    request.onreadystatechange = function()
    {
        if(request.readyState == 4 && request.status == 200)
        {
            document.querySelector('#listPrv_no').innerHTML = request.responseText;
            document.querySelector('#listPrv_no').value = "";
            $('#listPrv_no').selectpicker('render');

            document.querySelector('#listPrv_n2').innerHTML = request.responseText;
            document.querySelector('#listPrv_n2').value = "";
            $('#listPrv_n2').selectpicker('render');

            document.querySelector('#listPrv_n3').innerHTML = request.responseText;
            document.querySelector('#listPrv_n3').value = "";
            $('#listPrv_n3').selectpicker('render');

            document.querySelector('#listPrv_n4').innerHTML = request.responseText;
            document.querySelector('#listPrv_n4').value = "";
            $('#listPrv_n4').selectpicker('render');
        }
    } 
}


// LLENA COMBO RETENCIONES FUENTE
function fntGetRetenf()
{
    let tab_no = 'RF';
    let ajaxUrl = base_url+'Vstables/getTable';
    let request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
    let strData = "tab_no="+tab_no;

    request.open("POST",ajaxUrl,true);
    request.setRequestHeader("Content-type","application/x-www-form-urlencoded");
    request.send(strData);
    
    request.onreadystatechange = function()
    {
        if(request.readyState == 4 && request.status == 200)
        {
            document.querySelector('#listReb_no').innerHTML = request.responseText;
            document.querySelector('#listReb_no').value = "";
            $('#listReb_no').selectpicker('render');

            document.querySelector('#listRes_no').innerHTML = request.responseText;
            document.querySelector('#listRes_no').value = "";
            $('#listRes_no').selectpicker('render');
		}
    } 
}


// LLENA COMBO RETENCIONES IVA
function fntGetRetiva()
{
    let tab_no = 'RI';
    let ajaxUrl = base_url+'Vstables/getTable';
    let request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
    let strData = "tab_no="+tab_no;

    request.open("POST",ajaxUrl,true);
    request.setRequestHeader("Content-type","application/x-www-form-urlencoded");
    request.send(strData);
    
    request.onreadystatechange = function()
    {
        if(request.readyState == 4 && request.status == 200)
        {
            document.querySelector('#listRib_no').innerHTML = request.responseText;
            document.querySelector('#listRib_no').value = "";
            $('#listRib_no').selectpicker('render');

            document.querySelector('#listRis_no').innerHTML = request.responseText;
            document.querySelector('#listRis_no').value = "";
            $('#listRis_no').selectpicker('render');
		}
    } 
}


// LLENA COMBO RUBROS NOMINA
function fntGetRolrub()
{
    var ajaxUrl = base_url+'Vsrolrub/getSelectRolrub';
    var request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
    request.open("GET",ajaxUrl,true);
    request.send(); 

    request.onreadystatechange = function()
    {
        if(request.readyState == 4 && request.status == 200)
        {
            document.querySelector('#listRub_no').innerHTML = request.responseText;
            document.querySelector('#listRub_no').value = "";
            $('#listRub_no').selectpicker('render');

            document.querySelector('#listRub_n2').innerHTML = request.responseText;
            document.querySelector('#listRub_n2').value = "";
            $('#listRub_n2').selectpicker('render');
        }
    } 
}


// LLENA COMBO RUBROS NOMINA PARA CREDITO PERSONAL
function fntGetRolcre()
{
    var ajaxUrl = base_url+'Vsrolrub/getSelectRolcre';
    var request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
    request.open("GET",ajaxUrl,true);
    request.send(); 

    request.onreadystatechange = function()
    {
        if(request.readyState == 4 && request.status == 200)
        {
            document.querySelector('#listRubcre').innerHTML = request.responseText;
            document.querySelector('#listRubcre').value = "";
            $('#listRubcre').selectpicker('render');
        }
    } 
}


// LLENA COMBO CUENTAS CONTABLES
function fntGetAcount()
{
    var ajaxUrl = base_url+'Vsacount/getSelectAcount';
    var request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
    request.open("GET",ajaxUrl,true);
    request.send(); 

    request.onreadystatechange = function()
    {
        if(request.readyState == 4 && request.status == 200)
        {
            document.querySelector('#listCta_no').innerHTML = request.responseText;
            document.querySelector('#listCta_no').value = "";
            $('#listCta_no').selectpicker('render');

            document.querySelector('#listAnt_no').innerHTML = request.responseText;
            document.querySelector('#listAnt_no').value = "";
            $('#listAnt_no').selectpicker('render');

            document.querySelector('#listGas_no').innerHTML = request.responseText;
            document.querySelector('#listGas_no').value = "";
            $('#listGas_no').selectpicker('render');

            document.querySelector('#listCdp_no').innerHTML = request.responseText;
            document.querySelector('#listCdp_no').value = "";
            $('#listCdp_no').selectpicker('render');
        }
    } 
}


// LLENA COMBO TARJETAS DE CREDITO
function fntGetCard()
{
    let tab_no = 'TAR';
    let ajaxUrl = base_url+'Vstables/getTable';
    let request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
    let strData = "tab_no="+tab_no;

    request.open("POST",ajaxUrl,true);
    request.setRequestHeader("Content-type","application/x-www-form-urlencoded");
    request.send(strData);
    
    request.onreadystatechange = function()
    {
        if(request.readyState == 4 && request.status == 200)
        {
            document.querySelector('#listTar_no').innerHTML = request.responseText;
            document.querySelector('#listTar_no').value = "";
            $('#listTar_no').selectpicker('render');
        }
    }    
}


// LLENA COMBO PARCIALES AULA VIRTUAL
function fntGetParcial()
{
    let tab_no = 'PAR';
    let ajaxUrl = base_url+'Vstables/getTable';
    let request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
    let strData = "tab_no="+tab_no;

    request.open("POST",ajaxUrl,true);
    request.setRequestHeader("Content-type","application/x-www-form-urlencoded");
    request.send(strData); 
    
    request.onreadystatechange = function()
    {
        if(request.readyState == 4 && request.status == 200)
        {
            document.querySelector('#listParcia').innerHTML = request.responseText;
            document.querySelector('#listParcia').value = "";
            $('#listParcia').selectpicker('render');
        }
    } 
}


// LLENA COMBO PARCIALES REGISTRO CALIFICACIOES
function fntGetParcia3()
{
    let tab_no = 'CAL';
    let ajaxUrl = base_url+'Vstables/getTable';
    let request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
    let strData = "tab_no="+tab_no;

    request.open("POST",ajaxUrl,true);
    request.setRequestHeader("Content-type","application/x-www-form-urlencoded");
    request.send(strData); 
    
    request.onreadystatechange = function()
    {
        if(request.readyState == 4 && request.status == 200)
        {
            document.querySelector('#listParci3').innerHTML = request.responseText;
            document.querySelector('#listParci3').value = "";
            $('#listParci3').selectpicker('render');
        }
    } 
}


// LLENA COMBO PERIODO EN REGISTRO CALIFICACIONES
function fntGetParci0()
{
    let caltyp = document.querySelector('#listCaltyp').value;
    if(caltyp == 1)
    {
        tab_no  = 'PAR';
    }else{
        tab_no  = 'CAL';
    }
//    alert(tab_no);
    let ajaxUrl = base_url+'Vstables/getTable';
    let request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
    let strData = "tab_no="+tab_no;

    request.open("POST",ajaxUrl,true);
    request.setRequestHeader("Content-type","application/x-www-form-urlencoded");
    request.send(strData);
    
    request.onreadystatechange = function()
    {
        if(request.readyState == 4 && request.status == 200)
        {
            $('#listParci0').selectpicker('destroy');
            document.querySelector('#listParci0').innerHTML = request.responseText;
            document.querySelector('#listParci0').value = "";
            $('#listParci0').selectpicker('render');
        }
    } 
}


// LLENA COMBO PERIODO EN ACTA CALIFICACIONES
function fntGetParcia4()
{
    let tab_no = 'ACT';
    let ajaxUrl = base_url+'Vstables/getTable';
    let request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
    let strData = "tab_no="+tab_no;

    request.open("POST",ajaxUrl,true);
    request.setRequestHeader("Content-type","application/x-www-form-urlencoded");
    request.send(strData); 
    
    request.onreadystatechange = function()
    {
        if(request.readyState == 4 && request.status == 200)
        {
            document.querySelector('#listParci4').innerHTML = request.responseText;
            document.querySelector('#listParci4').value = "";
            $('#listParci4').selectpicker('render');
        }
    } 
}


// LLENA COMBO REPRESENTANTE EN ESTUDIANTE
function getRep()
{
    let codecmbRep = document.getElementById('listTt_who').value;
    
    switch(codecmbRep)
    {
        case '1':
            document.getElementById('txtReplas').value = document.getElementById('txtFatlas').value;
            document.getElementById('txtRepnam').value = document.getElementById('txtFatnam').value;
            document.getElementById('txtRepadr').value = document.getElementById('txtFatadr').value;
            document.getElementById('txtRepfon').value = document.getElementById('txtFatfon').value;
            document.getElementById('listRetype').value = document.getElementById('listFatype').value;
            $('#listRetype').selectpicker('render');
            document.getElementById('txtRepced').value = document.getElementById('txtFatced').value;
            document.getElementById('txtRepjob').value = document.getElementById('txtFatjob').value;
            document.getElementById('datRepbir').value = document.getElementById('datFatbir').value;
            document.getElementById('txtRepmai').value = document.getElementById('txtFatmai').value;
            break;
        case '2':
            document.getElementById('txtReplas').value = document.getElementById('txtMotlas').value;
            document.getElementById('txtRepnam').value = document.getElementById('txtMotnam').value;
            document.getElementById('txtRepadr').value = document.getElementById('txtMotadr').value;
            document.getElementById('txtRepfon').value = document.getElementById('txtMotfon').value;
            document.getElementById('listRetype').value = document.getElementById('listMotype').value;
            $('#listRetype').selectpicker('render');
            document.getElementById('txtRepced').value = document.getElementById('txtMotced').value;
            document.getElementById('txtRepjob').value = document.getElementById('txtMotjob').value;
            document.getElementById('datRepbir').value = document.getElementById('datMotbir').value;
            document.getElementById('txtRepmai').value = document.getElementById('txtMotmai').value;
            break;
        case '3':
            document.getElementById('txtReplas').value = "";
            document.getElementById('txtRepnam').value = "";
            document.getElementById('txtRepadr').value = "";
            document.getElementById('txtRepfon').value = "";
            document.getElementById('listRetype').value = "";
            $('#listRetype').selectpicker('render');
            document.getElementById('txtRepced').value = "";
            document.getElementById('txtRepjob').value = "";
            document.getElementById('datRepbir').value = "";
            document.getElementById('txtRepmai').value = "";
            break;
    }
}


// ESTADISTICA de Estudiantes
function fntRptStdAsp()
{
    let ajaxUrl = base_url+'Widgets/barRptStdAsp';
    let request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
    request.open("GET",ajaxUrl,true);
    request.send(); 
    
    request.onreadystatechange = function()
    {
        if(request.readyState == 4 && request.status == 200)
        {
            let objData = JSON.parse(request.responseText);
		    let numStd = [];
		    let periodo = [];

			for (x of objData) 
            {
  				 numStd.push(x.STD);
                 periodo.push(x.PERIOS);
			}
		            let ctx = document.getElementById("barStdAspirantes");
		            let myLineChart = new Chart(ctx, {
		                type: 'bar',
		                data: {
		                    labels: periodo,
		                    datasets: [{
		                        label: "Aspirantes",
		                        data: numStd,
		                        backgroundColor: [
		                            //'Red', 'Blue', 'Yellow', 'Green', 'Purple', 'Orange', 'crimson', 'teal', 'fuchsia', 'lime', 'cyan'
		                 			'rgba(255, 99, 132, 0.4)',
                					'rgba(54, 162, 235, 0.4)',
                					'rgba(255, 206, 86, 0.4)',
                					'rgba(75, 192, 192, 0.4)',
                					'rgba(153, 102, 255, 0.4)',
                					'rgba(255, 159, 64, 0.4)',
                					'rgba(171, 30, 77, 0.4)',
                					'rgba(19, 29, 179, 0.4)',
                					'rgba(247, 250, 47, 0.4)',      
                					'rgba(35, 185, 51, 0.4)',
                					'rgba(192, 57, 43, 0.4)'
		                        ],
		                        borderColor: [
                					'rgba(255, 99, 132, 1)',
                					'rgba(54, 162, 235, 1)',
                					'rgba(255, 206, 86, 1)',
					                'rgba(75, 192, 192, 1)',
					                'rgba(153, 102, 255, 1)',
					                'rgba(255, 159, 64, 1)',
					                'rgba(171, 30, 77, 1)',
					                'rgba(19, 29, 179, 1)',
					                'rgba(247, 250, 47, 1)',
					                'rgba(35, 185, 51, 1)',
					                'rgba(192, 57, 43, 1)'
					            ],
					            borderWidth: 1.5
		                    }]
		                },
		                options: {
		                    scales: {
		                        xAxes: [{
		                            time: {
		                                unit: 'month'
		                            },
		                            gridLines: {
		                                display: false
		                            },
		                            ticks: {
		                            }
		                        }],
		                        yAxes: [{
		                            ticks: {
		                                min: 0,
		                                max: 1800,
		                                maxTicksLimit: 20
		                            },
		                            gridLines: {
		                                display: true
		                            }
		                        }],
		                    },
		                    responsive: true,
						    plugins: {
						      legend: {
						      	display: false,
						        position: 'right',
						      },
						      title: {
						        display: true,
						        text: 'Aspirantes por periodo'
						      }
						    }
		                }
		            });
        }
    }    
}


function fntRptStdAct()
{
    let ajaxUrl = base_url+'Widgets/barRptStdAct';
    let request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
    request.open("GET",ajaxUrl,true);
    request.send(); 
    
    request.onreadystatechange = function()
    {
        if(request.readyState == 4 && request.status == 200)
        {
            let objData = JSON.parse(request.responseText);
		    let section = [];
		    let numStd  = [];

			for (x of objData) 
            {
                section.push(x.SEC_NM+'-'+x.PARALE+' ('+x.STD+')');
                numStd.push(x.STD);
			}

		    let ctx = document.getElementById("barStudents");
		    let myLineChart = new Chart(ctx, {
		                type: 'bar',
		                data: {
		                    labels: section,
		                    datasets: [{
		                    	label: "Estudiantes",
		                        data: numStd,
		                        backgroundColor: [
		                            'Red', 'Blue', 'Yellow', 'Green', 'Purple', 'Orange', 'crimson', 'teal', 'fuchsia', 'lime'
		                        ],
		                    }],
		                },

		                options: {
						    indexAxis: 'y',
						    elements: {
						      bar: {
						        borderWidth: 2,
						      }
						    },
						    responsive: true,
						    plugins: {
						      legend: {
						      	display: false,
						        position: 'right',
						      },
						      title: {
						        display: true,
						        text: 'Estudiantes por Paralelo'
						      }
						    }
				  		}, 
		            });
        }
    }  
}


function fntRptStdSex()
{
	let ajaxUrl = base_url+'Widgets/pieRptStdGen';
    let request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
    request.open("GET",ajaxUrl,true);
    request.send(); 
    
    request.onreadystatechange = function()
    {
        if(request.readyState == 4 && request.status == 200)
        {
            let objData = JSON.parse(request.responseText);
		    let numStd = [];
		    let genero = [];

			for (x of objData) 
			{
  				 numStd.push(x.STD);
                 genero.push(x.STDGEN);
			}

			let ctx = document.getElementById("pieStdGenero");
		    let myLineChart = new Chart(ctx, {
		                type: 'pie',
		                data: {
		                    labels: genero,
		                    datasets: [{
		                    	label: "Estudiantes",
		                        data: numStd,
		                        backgroundColor: [
		                          'rgb(54, 162, 235)',
							      'rgb(255, 99, 132)',
							      'rgb(255, 205, 86)'
							    ],
							    hoverOffset: 6
		                    }],
		                },
		                options: {	
		                	radius: 150,
		                	cutout: 5,
						    responsive: true,
						    plugins: {
						      legend: {
						      	display: true,
						      },
						      title: {
						        display: true,
						        text: 'Estudiantes por Genero'
						      }
						    }
				  		},
		                
		            });
		}
	}
}


function fntRptEmp()
{
	let ajaxUrl = base_url+'Widgets/barRptEmpProfile';
    let request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
    request.open("GET",ajaxUrl,true);
    request.send(); 
    
    request.onreadystatechange = function()
    {
        if(request.readyState == 4 && request.status == 200)
        {
            let objData = JSON.parse(request.responseText);
		    let numEmp = [];
		    let profile = [];

			for (x of objData) 
            {
  				 numEmp.push(x.EMP);
                 profile.push(x.PROFIL);
			}

			let ctx = document.getElementById("polarEmpProfile");
		    let myLineChart = new Chart(ctx, {
		                type: 'doughnut',
		                data: {
		                    labels: profile,
		                    datasets: [{
		                    	label: "Administrativo",
		                        data: numEmp,
		                        backgroundColor: [
		                            'teal','Green','Purple','Orange','Yellow','lime','fuchsia','crimson','Dark','Blue'
		                        ]
		                    }],
		                },
		                options: {	
		                	radius: 150,
		                	cutout: 120,
						    responsive: true,
						    plugins: {
						      legend: {
						      	position: 'top',
						      },
						      title: {
						        display: true,
						        text: 'Personal Administratvo'
						      }
						    }
				  		},
		                
		            });
		}
	}
}


function fntRegAulaVirtual(object)
{
	var fecha   = object.value;
	let ajaxUrl = base_url+'Widgets/Reportes';
    let request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');

    let catalogo = 'AulaVirtual';
    let strData = "Catalogo="+catalogo+"&Fecha="+fecha;
    	
    request.open("POST",ajaxUrl,true);
    request.setRequestHeader("Content-type","application/x-www-form-urlencoded");
    request.send(strData); 
    
    request.onreadystatechange = function()
    {
        if(request.readyState == 4 && request.status == 200)
        {
            let objData = JSON.parse(request.responseText);
            let datos = objData.data;
            let numReg = [];
		    let perios = [];

		    for (x of datos) 
            {
       			numReg.push(x.REG);
                perios.push(x.PERIOS);
        	}

		    let estatus = objData.Catalogo;
		    let ctx = document.getElementById("barAulaVirtual");
		    
		    let myChart = new Chart(ctx, {
		                type: 'bar',
		                data: {
		                    labels: perios,
		                    datasets: [{
		                    	label: "Actividades",
		                        data: numReg, 
		                        backgroundColor: [
		                            'Red', 'Blue', 'Yellow', 'Green', 'Purple', 'Orange', 'crimson', 'teal', 'fuchsia', 'lime'
		                        ],
		                    }],
		                },

		               options: {
		               		scales: {
		                        xAxes: [{
		                            time: {
		                                unit: 'month'
		                            },
		                            gridLines: {
		                                display: false
		                            },
		                            ticks: {
		                                maxTicksLimit: 4
		                            }
		                        }],
		                        yAxes: [{
		                            ticks: {
		                                min: 0,
		                                max: 20,
		                                maxTicksLimit: 10
		                            },
		                            gridLines: {
		                                display: true
		                            }
		                        }],
		                    },


						    responsive: true,
						    plugins: {
						      legend: {
						      	display: false,
						        position: 'right',
						      },
						      title: {
						        display: true,
						        text: 'Actividades'
						      }
						    }
				  		}, 
		            });
        }
    }
	
}


// LLENA COMBO FACTURACION ASUMIDA POR en Módulo Facturación
function fntDatStd()
{
	let codPerios = document.getElementById('listPerios').value;
	let codStd_no = document.getElementById('listStd_no').value;
    let codFac_no = 0;

	let strData = "codPerios="+codPerios+"&codStd_no="+codStd_no+"&codFac_no="+codFac_no;
    let request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
    let ajaxUrl = base_url+'Vsbillin/getDatFac';    
    
    request.open("POST",ajaxUrl,true);
    request.setRequestHeader("Content-type","application/x-www-form-urlencoded");
    request.send(strData);

    request.onreadystatechange = function()
    {
        if(request.readyState == 4 && request.status == 200)
        {
        	let objData = JSON.parse(request.responseText);
        	if(objData.status)
            {
	            document.querySelector('#listSec_no').value = objData.data.SEC_NO;
	            $('#listSec_no').selectpicker('refresh');

	            document.querySelector('#listFacwho').value = objData.data.FACWHO;
	            $('#listFacwho').selectpicker('refresh');

	            document.querySelector('#txtRazons').value = objData.data.RAZONS;
	            document.querySelector('#txtDirecc').value = objData.data.DIRECC;
	            document.querySelector('#txtTlf_no').value = objData.data.TLF_NO;

	            document.querySelector('#listCltype').value = objData.data.CLTYPE;
	            $('#listCltype').selectpicker('refresh');

				document.querySelector('#txtRuc_no').value = objData.data.RUC_NO;
				document.querySelector('#txtEmails').value = objData.data.EMAILS;	            	            

				fntGetFacVal2();
	        }else{
                swal("Error",objData.msg,"error");
            }
        }
    }
}


function fntDatFac()
{
	let codPerios = document.getElementById('listPerios').value;
	let codStd_no = document.getElementById('listStd_no').value;
	let codFac_no = document.getElementById('listFacwho').value;

	let strData = "codPerios="+codPerios+"&codStd_no="+codStd_no+"&codFac_no="+codFac_no;
    let request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
    let ajaxUrl = base_url+'Vsbillin/getDatFac';    
    
    request.open("POST",ajaxUrl,true);
    request.setRequestHeader("Content-type","application/x-www-form-urlencoded");
    request.send(strData);

    request.onreadystatechange = function()
    {
        if(request.readyState == 4 && request.status == 200)
        {
        	let objData = JSON.parse(request.responseText);
        	if(objData.status)
            {
	            switch (objData.data.codFac_no)
	            {
	            	case '1':
	            		razons = objData.data.FATLAS + ' ' + objData.data.FATNAM;
	            		direcc = objData.data.FATADR;
	            		tlf_no = objData.data.FATFON;
	            		cltype = objData.data.FATYPE;
	            		ruc_no = objData.data.FATCED;
	            		emails = objData.data.FATMAI;
	            		break;
	            	case '2':
	            		razons = objData.data.MOTLAS + ' ' + objData.data.MOTNAM;
	            		direcc = objData.data.MOTADR;
	            		tlf_no = objData.data.MOTFON;
	            		cltype = objData.data.MOTYPE;
	            		ruc_no = objData.data.MOTCED;
	            		emails = objData.data.MOTMAI;
	            		break;
	            	case '3':
	            		razons = objData.data.REPLAS + ' ' + objData.data.REPNAM;
	            		direcc = objData.data.REPADR;
	            		tlf_no = objData.data.REPFON;
	            		cltype = objData.data.RETYPE;
	            		ruc_no = objData.data.REPCED;
	            		emails = objData.data.REPMAI;
	            		break;
	            	case '4':
	            		razons = objData.data.RAZONS;
	            		direcc = objData.data.DIRECC;
	            		tlf_no = objData.data.TLF_NO;
	            		cltype = objData.data.CLTYPE;
	            		ruc_no = objData.data.RUC_NO;
	            		emails = objData.data.EMAILS;
	            		break;
	            }

	            document.querySelector('#listCltype').value = cltype;
	            $('#listCltype').selectpicker('refresh');
	            document.querySelector('#txtRazons').value = razons;
	            document.querySelector('#txtDirecc').value = direcc;
	            document.querySelector('#txtTlf_no').value = tlf_no;
				document.querySelector('#txtRuc_no').value = ruc_no;
				document.querySelector('#txtEmails').value = emails;
			}else{
                swal("Error",objData.msg,"error");
            }
        }
    }

}


// OBTIENE DATOS DE UN PROVEEDOR ESCOGIDO EN COMBO
function fntDatPrv()
{
	let codPrv_no = document.getElementById('listPrv_no').value;

	let strData = "codPrv_no="+codPrv_no;
    let request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
    let ajaxUrl = base_url+'Vsmovcxp/getDatPrv';    
    
    request.open("POST",ajaxUrl,true);
    request.setRequestHeader("Content-type","application/x-www-form-urlencoded");
    request.send(strData);

    request.onreadystatechange = function()
    {
        if(request.readyState == 4 && request.status == 200)
        {
        	let objData = JSON.parse(request.responseText);
        	if(objData.status)
            {
	            document.querySelector('#listCta_no').value = objData.data.CTA_NO;
	            $('#listCta_no').selectpicker('refresh');

                document.querySelector('#listAnt_no').value = objData.data.GAS_NO;
	            $('#listAnt_no').selectpicker('refresh');
	        }else{
                swal("Error",objData.msg,"error");
            }
        }
    }
}


// OBTIENE DATOS DE UN BANCO ESCOGIDO EN COMBO LIBRO BANCO
function fntDatBan()
{
	$codMovtip      = document.getElementById('listMovtip').value;
	let codBan_no   = document.getElementById('listBan_n2').value;

    let strData = "codBan_no="+codBan_no;
    let request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
    let ajaxUrl = base_url+'Vsmovcxp/getDatBan';
    
    request.open("POST",ajaxUrl,true);
    request.setRequestHeader("Content-type","application/x-www-form-urlencoded");
    request.send(strData);

    request.onreadystatechange = function()
    {
        if(request.readyState == 4 && request.status == 200)
        {
        	let objData = JSON.parse(request.responseText);
        	if(objData.status)
            {
                if($codMovtip == 'DE')
                {
                    document.querySelector('#txtDep_no').required = true;
                }else{
                    document.querySelector('#txtDep_no').required = false;
                }

                if($codMovtip == 'PC')
                {
                    document.querySelector('#txtChe_no').required = true;
                }else{
                    document.querySelector('#txtChe_no').required = false;
                }
	            document.querySelector('#txtChe_no').value = 1 + parseInt(objData.data.CHE_NO);
	        }else{
                swal("Error",objData.msg,"error");
            }
        }
    }
}


// OBTIENE DATOS DE UN BANCO ESCOGIDO EN COMBO PAGO PROVEEDORES
function fntDatBa2()
{
	$codMovtip      = document.getElementById('listMovti3').value;
	let codBan_no   = document.getElementById('listBan_n2').value;

    let strData = "codBan_no="+codBan_no;
    let request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
    let ajaxUrl = base_url+'Vsmovcxp/getDatBan';
    
    request.open("POST",ajaxUrl,true);
    request.setRequestHeader("Content-type","application/x-www-form-urlencoded");
    request.send(strData);

    request.onreadystatechange = function()
    {
        if(request.readyState == 4 && request.status == 200)
        {
        	let objData = JSON.parse(request.responseText);
        	if(objData.status)
            {
	            document.querySelector('#txtChe_no').value = 1 + parseInt(objData.data.CHE_NO);
	        }else{
                swal("Error",objData.msg,"error");
            }
        }
    }
}


// OBTIENE DATOS DE FACTURAS PENDIENTES DE UN PROVEEDOR ESCOGIDO EN COMBO
function fntDatPen()
{
	let codAdvanc = document.getElementById('listAdvanc').value;
	let codPrv_no = document.getElementById('listPrv_n3').value;

	let strData = "codAdvanc="+codAdvanc+"&codPrv_no="+codPrv_no;
    let request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
    let ajaxUrl = base_url+'Vsmovcxp/getDatPen';
    
    request.open("POST",ajaxUrl,true);
    request.setRequestHeader("Content-type","application/x-www-form-urlencoded");
    request.send(strData);

    request.onreadystatechange = function()
    {
        if(request.readyState == 4 && request.status == 200)
        {
        	let objData = JSON.parse(request.responseText);
            if(objData.status)
            {
                document.querySelector('#txtBenefi').value = objData.data['benefi']['BENEFI'];
                $('#listGas_no').selectpicker('destroy');
                document.querySelector('#listGas_no').innerHTML = objData.data['acount'];
                $('#listGas_no').selectpicker('render');

                $('#listFap_no').selectpicker('destroy');
                document.querySelector('#listFap_no').innerHTML = objData.data['saldo'];
                $('#listFap_no').selectpicker('refresh');

                if(empty(objData.data['saldo']))
                {
                    document.querySelector('#listFap_no').required = false;
                }else{
                    document.querySelector('#listFap_no').required = true;
                }
	        }else{
                swal("Error",objData.msg,"error");
            }
        }
    }
}


// SUMARIZA FACTURAS PENDIENTES ESCOGIDAS EN COMBO
function fntDatVal()
{
	let form = document.getElementById("formVsmovpay"),
    strdata = new FormData(form);

    let request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
    let ajaxUrl = base_url+'Vsmovcxp/getDatVal';
    
    request.open("POST",ajaxUrl,true);
    request.send(strdata);

    request.onreadystatechange = function()
    {
        if(request.readyState == 4 && request.status == 200)
        {
        	let objData = JSON.parse(request.responseText);
        	if(objData.status)
            {
                document.querySelector('#txtDocva3').value = objData.data;
            }
        }else{
            document.querySelector('#txtDocva3').value = 0;
        }
    }
}


// OBTIENE DATOS DE UNA PROVISION ESCOGIDA EN NOTA DE CREDITO / DEBITO
function fntDatMov()
{
	$codMovtip      = document.getElementById('listMovti2').value;
    if($codMovtip == 'CP')
    {
        document.querySelector('#listMovapl').value = 'PF';
        $('#listMovapl').selectpicker('render');
        document.querySelector('#txtFap_no').required = true;
    }else{
        document.querySelector('#listMovapl').value = 'DP';
        $('#listMovapl').selectpicker('render');
        document.querySelector('#txtFap_no').required = false;
    }
}


// OBTIENE DATOS DE UNA PROVISION ESCOGIDA EN NOTA DE CREDITO / DEBITO
function fntDatCrp()
{
	let codDocapl = document.getElementById('listMovapl').value;
	let codDocnum = document.getElementById('txtFap_no').value;

	let strData = "codDocapl="+codDocapl+"&codDocnum="+codDocnum;
    let request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
    let ajaxUrl = base_url+'Vsmovcxp/getDatCrp';    
    
    request.open("POST",ajaxUrl,true);
    request.setRequestHeader("Content-type","application/x-www-form-urlencoded");
    request.send(strData);

    request.onreadystatechange = function()
    {
        if(request.readyState == 4 && request.status == 200)
        {
        	let objData = JSON.parse(request.responseText);
        	if(objData.status)
            {
	            document.querySelector('#listPrv_n2').value = objData.data.PRV_NO;
	            $('#listPrv_n2').selectpicker('refresh');

	            document.querySelector('#listPrv_n3').value = objData.data.PRV_NO;
	            $('#listPrv_n3').selectpicker('refresh');

                document.querySelector('#listCdp_no').value = objData.data.GAS_NO;
	            $('#listCdp_no').selectpicker('refresh');

                document.querySelector('#txtDocva2').value = objData.data.SALDO;
	        }else{
                swal("Error",objData.msg,"error");
            }
        }
    }
}


// CALCULA VALORES DE RETENCION ESCOGIDO EN COMBO
function fntDatRet()
{
	let codBasiva = document.getElementById('txtBasiva').value;
	let codRetf1  = document.getElementById('listReb_no').value;
	let codRetf2  = document.getElementById('listRes_no').value;
	let codReti1  = document.getElementById('listRib_no').value;
	let codReti2  = document.getElementById('listRis_no').value;

	let strData = "codRetf1="+codRetf1+"&codRetf2="+codRetf2+"&codReti1="+codReti1+"&codReti2="+codReti2;
    let request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
    let ajaxUrl = base_url+'Vsmovcxp/getDatRet';
    
    request.open("POST",ajaxUrl,true);
    request.setRequestHeader("Content-type","application/x-www-form-urlencoded");
    request.send(strData);

    request.onreadystatechange = function()
    {
        if(request.readyState == 4 && request.status == 200)
        {
        	let objData = JSON.parse(request.responseText);
        	if(objData.status)
            {
                $ivapor = parseInt(objData.data['porciva']) / 100;
	            document.querySelector('#txtMoniva').value = roundToTwo(codBasiva * $ivapor);
	            document.querySelector('#txtMonrf1').value = roundToTwo(codBasiva * objData.data['monretf1'] / 100);
	            document.querySelector('#txtMonrf2').value = roundToTwo(codBasiva * objData.data['monretf2'] / 100);
	            document.querySelector('#txtMonri1').value = roundToTwo(codBasiva * $ivapor * objData.data['monreti1'] / 100);
	            document.querySelector('#txtMonri2').value = roundToTwo(codBasiva * $ivapor * objData.data['monreti2'] / 100);
	            document.querySelector('#txtValors').value = roundToTwo(codBasiva * (1 + $ivapor)) - roundToTwo(codBasiva * objData.data['monretf1'] / 100) - roundToTwo(codBasiva * objData.data['monretf2'] / 100) - roundToTwo(codBasiva * $ivapor * objData.data['monreti1'] / 100) - roundToTwo(codBasiva * $ivapor * objData.data['monreti2'] / 100);
	        }else{
                swal("Error",objData.msg,"error");
            }
        }
    }
}


// OBTIENE PRECIO LISTA DE UN SERVICIO
function fntGetPrice()
{
	let codPer = document.getElementById('listPerios').value;
	let codSec = document.getElementById('listSec_no').value;
	let codArt = document.getElementById('listArt_no').value;

	let strData = "codPer="+codPer+"&codSec="+codSec+"&codArt="+codArt;
    let request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
    let ajaxUrl = base_url+'Vssecval/getDatPrice';
    
    request.open("POST",ajaxUrl,true);
    request.setRequestHeader("Content-type","application/x-www-form-urlencoded");
    request.send(strData);

    request.onreadystatechange = function()
    {
        if(request.readyState == 4 && request.status == 200)
        {
        	let objData = JSON.parse(request.responseText);
        	if(objData.status)
            {
	            document.querySelector('#txtDocval').value = objData.data.VALORS;
	        }else{
                swal("Error",objData.msg,"error");
            }
        }
    }
}


// OBTIENE PERIODO Y SECCION A PARTIR DEL ESTUDIANTE
function fntGetSecPerios()
{
	let codStd = document.getElementById('listStd_no').value;

	let strData = "codStd="+codStd;
    let request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
    let ajaxUrl = base_url+'Vssecval/getSecPerios';
    
    request.open("POST",ajaxUrl,true);
    request.setRequestHeader("Content-type","application/x-www-form-urlencoded");
    request.send(strData);

    request.onreadystatechange = function()
    {
        if(request.readyState == 4 && request.status == 200)
        {
        	let objData = JSON.parse(request.responseText);
        	if(objData.status)
            {
	            document.querySelector('#listPerios').value = objData.data.PERIOS;
	            document.querySelector('#listSec_no').value = objData.data.SEC_NO;
	            $('#listSec_no').selectpicker('refresh');
	        }else{
                swal("Error",objData.msg,"error");
            }
        }
    }
}


// Obtiene Valor a Facturar de un Cliente
function fntGetFacVal()
{
	let codPerios = document.getElementById('listPerios').value;
	let codStd_no = document.getElementById('listStd_no').value;
	let codPer_no = document.getElementById('listPer_no').value;
	let codAbotyp = 1;

	let strData = "codPerios="+codPerios+"&codStd_no="+codStd_no+"&codPer_no="+codPer_no+"&codAbotyp="+codAbotyp;
    let request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
    let ajaxUrl = base_url+'Vsbillin/getDatVal';
    
    request.open("POST",ajaxUrl,true);
    request.setRequestHeader("Content-type","application/x-www-form-urlencoded");
    request.send(strData);

    request.onreadystatechange = function()
    {
        if(request.readyState == 4 && request.status == 200)
        {
        	let objData = JSON.parse(request.responseText);
        	if(objData.status)
            {
	            document.querySelector('#txtDocval').value = objData.data.FACVAL;
	        }else{
                swal("Error",objData.msg,"error");
            }
        }
    }
}


// Obtiene Valor a Facturar de un Cliente
function fntGetFacVal2()
{
	let codPerios = document.getElementById('listPerios').value;
	let codStd_no = document.getElementById('listStd_no').value;
	let codAbotyp = 1;

	let strData = "codPerios="+codPerios+"&codStd_no="+codStd_no+"&codAbotyp="+codAbotyp;
    let request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
    let ajaxUrl = base_url+'Vsbillin/getDatVal2';
    
    request.open("POST",ajaxUrl,true);
    request.setRequestHeader("Content-type","application/x-www-form-urlencoded");
    request.send(strData);

    request.onreadystatechange = function()
    {
        if(request.readyState == 4 && request.status == 200)
        {
        	let objData = JSON.parse(request.responseText);
        	if(objData.status)
            {
                $opcion = objData.data.PER_NO;
                document.querySelector('#listPer_no').value = $opcion;
                $('#listPer_no').selectpicker('render');

	            document.querySelector('#txtDocval').value = objData.data.FACVAL;
	        }else{
                swal("Error",objData.msg,"error");
            }
        }
    }
}


// LLENA COMBO Datos Facturación - VSTUDENT
function getFac()
{
    let codecmbFac = document.getElementById('listFacwho').value;

    switch(codecmbFac)
    {
        case '1':
            document.getElementById('txtRazons').value = document.getElementById('txtFatlas').value + ' ' + document.getElementById('txtFatnam').value;
            document.getElementById('txtDirecc').value = document.getElementById('txtFatadr').value;
            document.getElementById('txtTlf_no').value = document.getElementById('txtFatfon').value;
            document.getElementById('listCltype').value = document.getElementById('listFatype').value;
            $('#listCltype').selectpicker('render');
            document.getElementById('txtRuc_no').value = document.getElementById('txtFatced').value;
            document.getElementById('txtEmails').value = document.getElementById('txtFatmai').value;
            break;
        case '2':
            document.getElementById('txtRazons').value = document.getElementById('txtMotlas').value + ' ' + document.getElementById('txtMotnam').value;
            document.getElementById('txtDirecc').value = document.getElementById('txtMotadr').value;
            document.getElementById('txtTlf_no').value = document.getElementById('txtMotfon').value;
            document.getElementById('listCltype').value = document.getElementById('listMotype').value;
            $('#listCltype').selectpicker('render');
            document.getElementById('txtRuc_no').value = document.getElementById('txtMotced').value;
            document.getElementById('txtEmails').value = document.getElementById('txtMotmai').value;
            break;
        case '3':
            document.getElementById('txtRazons').value = "";
            document.getElementById('txtDirecc').value = "";
            document.getElementById('txtTlf_no').value = "";
            document.getElementById('listCltype').value = "";
            $('#listCltype').selectpicker('render');
            document.getElementById('txtRuc_no').value = "";
            document.getElementById('txtEmails').value = "";
            break;
    }
}


// LLENA COMBO Estudiante en AULA VIRTUAL
function fntStdList()
{
    let codSection = document.getElementById('listSec_no').value;
    let codMatter  = document.getElementById('listMat_no').value;
    let codPerios  = document.getElementById('listPerios').value;

    let ajaxUrl = base_url+'Vsabsent/fntStdList';
    let request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
    let strData = "codSection="+codSection+"&codMatter="+codMatter+"&codPerios="+codPerios;

    request.open("POST",ajaxUrl,true);
    request.setRequestHeader("Content-type","application/x-www-form-urlencoded");
    request.send(strData);

    request.onreadystatechange = function()
    {
        if(request.readyState == 4 && request.status == 200)
        {
            $('#listStd_no').selectpicker('destroy');
            document.querySelector('#listStd_no').innerHTML = request.responseText;
            $('#listStd_no').selectpicker('render');
        }
    }
}


// LLENA COMBO Estudiante en ASISTENCIA
function fntStdList2()
{
    let codSection = document.getElementById('listSec_no').value;
    let codMatter  = document.getElementById('listMat_no').value;
    let codPerios  = document.getElementById('listPerios').value;

    let ajaxUrl = base_url+'Vsabsent/fntStdList2';
    let request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
    let strData = "codSection="+codSection+"&codMatter="+codMatter+"&codPerios="+codPerios;

    request.open("POST",ajaxUrl,true);
    request.setRequestHeader("Content-type","application/x-www-form-urlencoded");
    request.send(strData);

    request.onreadystatechange = function()
    {
        if(request.readyState == 4 && request.status == 200)
        {
            $('#listStd_n2').selectpicker('destroy');
            document.querySelector('#listStd_n2').innerHTML = request.responseText;
            $('#listStd_n2').selectpicker('refresh');
        }
    }
}
