if(document.querySelector("#formRegStd")) 
{

    let formRegStd = document.querySelector("#formRegStd");
        
    formRegStd.onsubmit = function(e)
    {
    		e.preventDefault(); //previene que se recargue el formulario o pagina...
            
    		let strApellidos = document.querySelector("#txtLas_nm").value;
    		let strNombres   = document.querySelector("#txtFir_nm").value;

			if(strApellidos == '' || strNombres == '')
    		{
				swal('Atención !','Todos los campos son obligatorios','error');
    			return false;
    		}

			let request  = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');	
    		let ajaxUrl  = base_url+'Login/Newstd';
    		let formData = new FormData(formRegStd);

    		request.open("POST",ajaxUrl,true);
			request.send(formData);	

			request.onreadystatechange = function()
    		{    
    			if(request. readyState == 4 && request.status == 200)
    			{					 
    				let objData = JSON.parse(request.responseText);			

    				if(objData.status)
    				{
    					swal('Aspirante',objData.msg,'success');
    				}else {
    					swal('Aspirante',objData.msg,'error');
    				}
                    formRegStd.reset();
                    document.querySelector('#idStd_no').value = 0;
                        document.querySelector('#listSec_no').value = "";
                        $('#listSec_no').selectpicker('render');
                        document.querySelector('#listStdgen').value = "";
                        $('#listStdgen').selectpicker('render');
                        document.querySelector('#listTt_who').value = "";
                        $('#listTt_who').selectpicker('render');
    			}    			
    		}
    }
}

