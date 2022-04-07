<?php

	// Heredamos la clase: Controllers
	class Vsdefaul extends Controllers{

		public function __construct()
		{
			parent::__construct();
			session_start();
			if(empty($_SESSION['login']))
			{
				header('Location: '.base_url().'Login');
			}
			getPermisos(17);
		}


		public function Vsdefaul()
		{
			$data['page_id'] 	= 17;
			$data['page_tag'] 	= 'Parámetros';
			$data['page_name'] 	= 'parametros';
			$data['page_title'] = 'Parámetros';
			$this->views->getView($this,"vsdefaul",$data);
		}


		public function getVsdefauls()
		{
			$arrData = $this->model->selectVsdefaul();
			for ($i = 0; $i < count($arrData); $i++) 
			{
				$arrData[$i]['options'] = '<div class="text-center">
				<button class="btn btn-info btn-sm btnEditVsdefaul" onClick="fntEditVsdefaul('.$arrData[$i]['SEC_ID'].')" title="Editar"><i class="fas fa-pencil-alt"></i></button>
				</div>';  
			}
			echo json_encode($arrData,JSON_UNESCAPED_UNICODE);
			die();
		}


		// Obtiene el Periodo
		public function getPerios()
		{
			$arrData = $this->model->onePerios();
			if(empty($arrData))
			{
				$arrResponse = array('status' => false, 'msg' => 'Periodo no encontrado.');
			}else{
				$arrResponse = array('status' => true, 'data' => $arrData);
			}
			echo json_encode($arrResponse,JSON_UNESCAPED_UNICODE);
			die();
		}


		// Obtiene un solo registro
		public function getVsdefaul(int $idSec)
		{
			$intSEC = intval(strClean($idSec));
			if($intSEC > 0)
			{
				$arrData = $this->model->oneVsdefaul($intSEC);
				if(empty($arrData))
				{
					$arrResponse = array('status' => false, 'msg' => 'Registro no encontrado.');
				}else{
					$arrResponse = array('status' => true, 'data' => $arrData);
				}
				echo json_encode($arrResponse,JSON_UNESCAPED_UNICODE);
			}
			die();
		}


		public function setVsdefaul()
		{
			$intSec_id        = intval($_POST['idSec_id']);
			$strAmi_id        = strClean($_POST['txtAmi_id']);
			$intPerios        = intval($_POST['listPerios']);
			$strRazons        = strClean($_POST['txtRazons']);
			$strAddres        = strClean($_POST['txtAddres']);
			$strTphone        = strClean($_POST['txtTphone']);
			$strRuc_no        = strClean($_POST['txtRuc_no']);
			$strEmails        = $_POST['txtEmails'];
			$strParroq        = strClean($_POST['txtParroq']);
			$strCiudad        = strClean($_POST['txtCiudad']);
			$strCanton        = strClean($_POST['txtCanton']);
			$strProvin        = strClean($_POST['txtProvin']);
			$intRegime        = intval($_POST['listRegime']);
			$intSosten        = intval($_POST['listSosten']);
			$strQ1p1hd        = strClean($_POST['txtQ1p1hd']);
			$datQ1p1pr        = strClean($_POST['datQ1p1pr']);
			$strQ1p2hd        = strClean($_POST['txtQ1p2hd']);
			$datQ1p2pr        = strClean($_POST['datQ1p2pr']);
			$strQ1p3hd        = strClean($_POST['txtQ1p3hd']);
			$datQ1p3pr        = strClean($_POST['datQ1p3pr']);
			$strQ1p4hd        = strClean($_POST['txtQ1p4hd']);
			$datQ1p4pr        = strClean($_POST['datQ1p4pr']);
			$strQ2p1hd        = strClean($_POST['txtQ2p1hd']);
			$datQ2p1pr        = strClean($_POST['datQ2p1pr']);
			$strQ2p2hd        = strClean($_POST['txtQ2p2hd']);
			$datQ2p2pr        = strClean($_POST['datQ2p2pr']);
			$strQ2p3hd        = strClean($_POST['txtQ2p3hd']);
			$datQ2p3pr        = strClean($_POST['datQ2p3pr']);
			$strQ2p4hd        = strClean($_POST['txtQ2p4hd']);
			$datQ2p4pr        = strClean($_POST['datQ2p4pr']);
			$intBascal        = intval($_POST['listBascal']);
			$intMinsup        = intval($_POST['listMinsup']);
			$intParpro        = intval($_POST['listParpro']);
			$intInsnum        = intval($_POST['listInsnum']);
			$intParpor        = intval($_POST['listParpor']);
			$intExapor        = intval($_POST['listExapor']);
			$intDecnum        = intval($_POST['listDecnum']);
			$strRector        = strClean($_POST['txtRector']);
			$strSecret        = strClean($_POST['txtSecret']);
			$intMatnum        = intval($_POST['listMatnum']);
			$intFolnum        = intval($_POST['listFolnum']);
			$strDistri        = strClean($_POST['txtDistri']);

			if($intSec_id == 0)
			{
				// Crea un Parámetro
				$request_Vsdefaul = $this->model->insertVsdefaul($strAmi_id, $intPerios, $strRazons, $strAddres, $strTphone, $strRuc_no, $strEmails, $strParroq, $strCiudad, $strCanton, $strProvin, $intRegime, $intSosten, $strQ1p1hd, $datQ1p1pr, $strQ1p2hd, $datQ1p2pr, $strQ1p3hd, $datQ1p3pr, $strQ1p4hd, $datQ1p4pr, $strQ2p1hd, $datQ2p1pr, $strQ2p2hd, $datQ2p2pr, $strQ2p3hd, $datQ2p3pr, $strQ2p4hd, $datQ2p4pr, $intBascal, $intMinsup, $intParpro, $intInsnum, $intParpor, $intExapor, $intDecnum, $strRector ,$strSecret, $intMatnum, $intFolnum, $strDistri);
				$opcion = 1;
			}else{
				$request_Vsdefaul = $this->model->updateVsdefaul($intSec_id, $strAmi_id, $intPerios, $strRazons, $strAddres, $strTphone, $strRuc_no, $strEmails, $strParroq, $strCiudad, $strCanton, $strProvin, $intRegime, $intSosten, $strQ1p1hd, $datQ1p1pr, $strQ1p2hd, $datQ1p2pr, $strQ1p3hd, $datQ1p3pr, $strQ1p4hd, $datQ1p4pr, $strQ2p1hd, $datQ2p1pr, $strQ2p2hd, $datQ2p2pr, $strQ2p3hd, $datQ2p3pr, $strQ2p4hd, $datQ2p4pr, $intBascal, $intMinsup, $intParpro, $intInsnum, $intParpor, $intExapor, $intDecnum, $strRector ,$strSecret, $intMatnum, $intFolnum, $strDistri);
				$opcion = 2;
			}

			if($request_Vsdefaul > 0)
			{
				switch($opcion)
				{
					case 1:
						$arrResponse = array('status' => true, 'msg' => 'Parámetro guardado con éxito.');
						break;
					case 2:
						$arrResponse = array('status' => true, 'msg' => 'Parámetro actualizado con éxito.');
						break;
				}
			}else if($request_Vsdefaul == -1){
				$arrResponse = array('status' => false, 'msg' => '!!! ATENCIÓN. Parámetro ya existe.');
			}else{
				$arrResponse = array('status' => false, 'msg' => 'No es posible almacenar la información.');
			}
			echo json_encode($arrResponse,JSON_UNESCAPED_UNICODE);
			die(); 
		}
	}
