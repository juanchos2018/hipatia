<?php

	// Heredamos la clase: Controllers
	class Vsemplox extends Controllers{

		public function __construct()
		{
			parent::__construct();
			session_start();
			if(empty($_SESSION['login']))
			{
				header('Location: '.base_url().'Login');
			}
			getPermisos(5);
		}


		public function Vsemplox()
		{
			$data['page_id'] 	= 5;
			$data['page_tag'] 	= 'Ficha Personal';
			$data['page_name'] 	= 'ficha_personal';
			$data['page_title'] = 'Ficha Personal';
			$this->views->getView($this,"vsemplox",$data);
		}


		public function getSelectEmplox()
		{
			$htmlOptions = "";
			$htmlOptions .= '<option value="" selected>'.'Seleccione Personal'.'</option>';
			
			$arrData = $this->model->selectVsemplox();
			if(count($arrData) > 0)
			{
				for($i = 0; $i < count($arrData); $i++)
				{
					$htmlOptions .= '<option value="'.$arrData[$i]['EMP_NO'].'">'.$arrData[$i]['LAS_NM'].' '.$arrData[$i]['FIR_NM'].'</option>';
				}
			}
			echo $htmlOptions;
			die();
		}


		public function getVsemploxs()
		{
			$arrData = $this->model->selectVsemplox();
			for ($i = 0; $i < count($arrData); $i++) 
			{
				if($arrData[$i]['ESTATU'] == 1) 
				{
					$arrData[$i]['ESTATU'] = '<span class="badge badge-success">Activo</span>';
				}else{
					$arrData[$i]['ESTATU'] = '<span class="badge badge-danger">Inactivo</span>';
				}

				switch($arrData[$i]['IDTYPE'])
				{
					case "04":
						$arrData[$i]['IDTYPE'] = '<span class="badge badge-warning">R.U.C.</span>';
						break;
					case "05":
						$arrData[$i]['IDTYPE'] = '<span class="badge badge-success">Cédula</span>';
						break;
					case "06":
						$arrData[$i]['IDTYPE'] = '<span class="badge badge-danger">Pasaporte</span>';
						break;
				}

				$btnVieVsemplox  = "";
				$btnEdiVsemplox  = "";
			
				if($_SESSION['permisosMod']['r'])
				{
					$btnVieVsemplox = '<button class="btn btn-warning btn-sm btnConsultaVsemplox" onClick="fntConsultaVsemplox('.$arrData[$i]['EMP_NO'].')" title="Consultar"><i class="fas fa-eye"></i></button>';
				}
				if($_SESSION['permisosMod']['u'])
				{
					$btnEdiVsemplox = '<button class="btn btn-info btn-sm btnEditVsemplox" onClick="fntEditVsemplox('.$arrData[$i]['EMP_NO'].')" title="Editar"><i class="fas fa-pencil-alt"></i></button>';
				}

				$arrData[$i]['options'] = '<div class="text-center"> '.$btnVieVsemplox.' '.$btnEdiVsemplox.'</div>';
			}
			echo json_encode($arrData,JSON_UNESCAPED_UNICODE);
			die();
		}


		public function getVsemplox(int $idEmp)
		{
			$idEmp_no = intval(strClean($idEmp));
			if($idEmp_no > 0)
			{
				$arrData = $this->model->oneVsemplox($idEmp_no);
				if(empty($arrData))
				{
					$arrResponse = array('status' => false, 'msg' => 'Personal no encontrado.');
				}else{
					$arrResponse = array('status' => true, 'data' => $arrData);
				}
				echo json_encode($arrResponse,JSON_UNESCAPED_UNICODE);
			}
			die();
		}


		public function setVsemplox()
		{
			$intEmp_no        = intval($_POST['idEmp_no']);
			$strLas_nm        = strClean($_POST['txtLas_nm']);
			$strFir_nm        = strClean($_POST['txtFir_nm']);
			$strAddres        = strClean($_POST['txtAddres']);
			$strTphone        = strClean($_POST['txtTphone']);
			$strParroq        = strClean($_POST['txtParroq']);
			$strCiudad        = strClean($_POST['txtCiudad']);
			$strProvin        = strClean($_POST['txtProvin']);
			$strPaises        = strClean($_POST['txtPaises']);
			$strIdtype        = strClean($_POST['listIdtype']);
			$strIde_no        = strClean($_POST['txtIde_no']);
			$intEmpgen        = intval($_POST['listEmpgen']);
			$intEstado        = intval($_POST['listEstado']);
			$datFecbir        = strClean($_POST['datFecbir']);
			$datFecing        = strClean($_POST['datFecing']);
			$strEmpmai        = $_POST['txtEmpmai'];
			$intCtatyp        = intval($_POST['listCtatyp']);
			$strCtaban        = strClean($_POST['txtCtaban']);
			$intServic        = intval($_POST['txtServic']);
			$intMagist        = intval($_POST['txtMagist']);
			$strSeccod        = strClean($_POST['txtSeccod']);
			$strPoscod        = strClean($_POST['txtPoscod']);
			$intEmprlg        = intval($_POST['listEmprlg']);
			$intCargas        = intval($_POST['txtCargas']);
			$intEstatu        = intval($_POST['listStatus']);
			$intProfil        = intval($_POST['listProfil']);
			$intCat_no        = intval($_POST['listCat_no']);
			$strTitulo        = strClean($_POST['txtTitulo']);
			$strRemark        = strClean($_POST['txtRemark']);
			$intSalary        = $_POST['txtSalary'];

			if($intEmp_no == 0)
			{
				// Crea un Personal
				$request_Vsemplox = $this->model->insertVsemplox($strLas_nm, $strFir_nm, $strAddres, $strTphone, $strParroq, $strCiudad, $strProvin, $strPaises, $strIdtype, $strIde_no, $intEmpgen, $intEstado, $datFecbir, $datFecing, $strEmpmai, $intCtatyp, $strCtaban, $intServic, $intMagist, $strSeccod, $strPoscod, $intEmprlg, $intCargas, $intEstatu, $intProfil, $intCat_no, $strTitulo, $strRemark, $intSalary);
				$opcion = 1;
			}else{
				$request_Vsemplox = $this->model->updateVsemplox($intEmp_no, $strLas_nm, $strFir_nm, $strAddres, $strTphone, $strParroq, $strCiudad, $strProvin, $strPaises, $strIdtype, $strIde_no, $intEmpgen, $intEstado, $datFecbir, $datFecing, $strEmpmai, $intCtatyp, $strCtaban, $intServic, $intMagist, $strSeccod, $strPoscod, $intEmprlg, $intCargas, $intEstatu, $intProfil, $intCat_no, $strTitulo, $strRemark, $intSalary);
				$opcion = 2;
			}

			if($request_Vsemplox > 0)
			{
				switch($opcion)
				{
					case 1:
						$arrResponse = array('status' => true, 'msg' => 'Personal guardado con éxito.');
						break;
					case 2:
						$arrResponse = array('status' => true, 'msg' => 'Personal actualizado con éxito.');
						break;
				}
			}else if($request_Vsemplox == -1){
				$arrResponse = array('status' => false, 'msg' => '!!! ATENCIÓN. Personal ya existe.');
			}else{
				$arrResponse = array('status' => false, 'msg' => 'No es posible almacenar la información.');
			}
			echo json_encode($arrResponse,JSON_UNESCAPED_UNICODE);
			die(); 
		}
	}
