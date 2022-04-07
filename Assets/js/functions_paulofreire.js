$('.login-content [data-toggle="flip"]').click(function() {
      	$('.login-box').toggleClass('flipped');
      	return false;
});

var divLoading = document.querySelector('#divLoading');
document.addEventListener('DOMContentLoaded', function(){

	if(document.querySelector("#formLogin"))
	{
		let formLogin = document.querySelector("#formLogin");
		formLogin.onsubmit = function(e) {
			e.preventDefault(); //previene que se recargue la pagina...

			let strUsuario = document.querySelector('#txtUsuario').value;
			let strClave = document.querySelector('#txtClave').value;

			if(strUsuario == "" || strClave == "")
			{
				swal("Por favor", "Escribe usuario y/o clave", "error");
				return false;
			}else{
				divLoading.style.display = "flex";
		        let request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
	    		let ajaxUrl = base_url+'Login/loginUser';
	    		let formData = new FormData(formLogin);
	    		request.open("POST",ajaxUrl,true);
	    		request.send(formData);

	    		request.onreadystatechange = function()
   				{
		    		if(request.readyState != 4) return;
		    		if(request.status == 200)
		    		{
		    			let objData = JSON.parse(request.responseText);
		    			if(objData.status)
		    			{
		    				window.location = base_url+'Dashboard';
		    			}else{
		    				swal("Atencion !", objData.msg, "error");
		    				document.querySelector('#txtClave').value = "";
		    			}
		    		}else{
		    			swal("Atencion !", "Error en el proceso", "error");
		    		}
		    		divLoading.style.display = "none";
		    		return false;
	    		}
			}

		}
	}

	if(document.querySelector("#formRecetPass"))
	{
		let formRecetPass = document.querySelector("#formRecetPass");
		formRecetPass.onsubmit = function(e) {
			e.preventDefault();
			let strEmail = document.querySelector("#txtEmailReset").value;
			if(strEmail == "")
			{
				swal("Por favor", "Escribe tu correo electronico", "error");
				return false;
			} else{
				let request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
	    		let ajaxUrl = base_url+'Login/resetPass';
	    		let formData = new FormData(formRecetPass);
	    		request.open("POST",ajaxUrl,true);
	    		request.send(formData);

	    		request.onreadystatechange = function()
   				{
   					if(request.readyState != 4) return;
		    		if(request.status == 200)
		    		{
		    			let objData = JSON.parse(request.responseText);
		    			if(objData.status)
		    			{
		    				swal({
		    					title: "",
		    					text: objData.msg,
		    					type: "success",
		    					confirmButtonText: "Aceptar",
		    					closeOnConfirm: false,
		    				}, function(isConfirm) {
		    					if(isConfirm) {
		    						window.location = base_url;
		    					}
		    				});
		    			} else{
		    				swal("Atención", objData.msg, "error");
		    			}
		    		} else{
		    			swal("Atención", "Error en el proceso", "error");
		    		}
		    		return false;
   				}
			}
		}
	}

	if(document.querySelector("#formCambiarPass"))
	{
		let formCambiarPass = document.querySelector("#formCambiarPass");
		formCambiarPass.onsubmit = function(e) {
			e.preventDefault();

			let strPassword = document.querySelector('#txtPassword').value;
			let strPasswordConfirm = document.querySelector('#txtPasswordConfirm').value;
			let idUsuario = document.querySelector('#idUsuario').value;

			if(strPassword == "" || strPasswordConfirm == "")
			{
				swal("Por favor","Escribe la nueva contraseña","error");
				return false;
			} else {
				if(strPassword.length < 8)
				{
					swal("Atención","La contraseña debe tener un mínimo de 8 caracteres","info");
					return false;
				}

				if(strPassword != strPasswordConfirm)
				{
					swal("Atención","Las contraseñas no son iguales","error");
					return false;	
				}

				let request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
	    		let ajaxUrl = base_url+'Login/setPassword';
	    		let formData = new FormData(formCambiarPass);
	    		request.open("POST",ajaxUrl,true);
	    		request.send(formData);

	    		request.onreadystatechange = function()
   				{
   					if(request.readyState != 4) return;
		    		if(request.status == 200)
		    		{
		    			let objData = JSON.parse(request.responseText);
		    			if(objData.status)
		    			{
		    				swal({
		    					title: "",
		    					text: objData.msg,
		    					type: "success",
		    					confirmButtonText: "Iniciar Sesión",
		    					closeOnConfirm: false,
		    				}, function(isConfirm) {
		    					if(isConfirm)
		    					{
		    						window.location = base_url+'/Login';
		    					}
		    				});
		    			} else{
		    				swal('Atención', objData.msg, 'error');
		    			}
		    		} else{
		    			swal('Atención', 'Error en el proceso', 'error');
		    		}
   				}


			}



		}
	}

}, false);
