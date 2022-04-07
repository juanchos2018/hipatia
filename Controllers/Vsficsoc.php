<?php

	// Heredamos la clase: Controllers
	class Vsficsoc extends Controllers{

		public function __construct()
		{
			parent::__construct();
			session_start();
			if(empty($_SESSION['login']))
			{
				header('Location: '.base_url().'Login');
			}
			getPermisos(15);
		}


		public function Vsficsoc()
		{
			$data['page_id'] 	= 15;
			$data['page_tag'] 	= 'Ficha Social';
			$data['page_name'] 	= 'ficha_social';
			$data['page_title'] = 'Ficha Social';
			$this->views->getView($this,"vsficsoc",$data);
		}


		public function getVsficsocs()
		{
			$arrData = $this->model->selectVsficsoc();
			// Se barre todo el array $arrData ..
			for ($i=0; $i < count($arrData); $i++) 
			{
				$opcion = $arrData[$i]['ESTATU'];
				switch($opcion)
				{
				case 0:  // Aspirante
					$arrData[$i]['ESTATU'] = '<span class="badge badge-danger">Aspirante</span>';
					break;
				case 1:  // Admitido
					$arrData[$i]['ESTATU'] = '<span class="badge badge-success">Admitido</span>';
					break;
				case 2:
					$arrData[$i]['ESTATU'] = '<span class="badge badge-success">Matriculado</span>';
					break;
				case 3:
					$arrData[$i]['ESTATU'] = '<span class="badge badge-danger">Retirado</span>';
					break;
				case 4:
					$arrData[$i]['ESTATU'] = '<span class="badge badge-success">Viene con Pase</span>';
					break;
				case 5:
					$arrData[$i]['ESTATU'] = '<span class="badge badge-success">Egresado</span>';
					break;
				case 6:
					$arrData[$i]['ESTATU'] = '<span class="badge badge-danger">Desertor</span>';
					break;
				case 7:
					$arrData[$i]['ESTATU'] = '<span class="badge badge-danger">NEE Fiscapacitado</span>';
					break;
				case 8:
					$arrData[$i]['ESTATU'] = '<span class="badge badge-danger">NEE No discapactitado</span>';
					break;
				case 9:
					$arrData[$i]['ESTATU'] = '<span class="badge badge-danger">Sin documentos</span>';
					break;
				case 10:
					$arrData[$i]['ESTATU'] = '<span class="badge badge-danger">No matriculado</span>';
					break;
				}

				$btnPrnVsficsoc  = "";
				$btnVieVsficsoc  = "";
				$btnEdiVsficsoc  = "";
				$color_boton     = 'class="btn btn-success btn-sm"';
					
				if($_SESSION['permisosMod']['r'])
				{
					$btnPrnVsficsoc = '<a '.$color_boton.' title= "Registro Acumulativo" href="'.base_url().'Vsficsoc/getActSoc/'.$arrData[$i]['STD_NO'].'"><i class="fas fa-print"></i></a>';

					$btnVieVsficsoc = '<button class="btn btn-warning btn-sm btnQueryVsficsoc" onClick="fntQueryVsficsoc('.$arrData[$i]['STD_NO'].')" title="Consultar"><i class="fas fa-eye"></i></button>';
				}

				if($_SESSION['permisosMod']['u'])
				{
					$btnEdiVsficsoc = '<button class="btn btn-info btn-sm btnEditVsficsoc" onClick="fntEditVsficsoc('.$arrData[$i]['STD_NO'].')" title="Editar"><i class="fas fa-pencil-alt"></i></button>';
				}

				$arrData[$i]['options'] = '<div class="text-center"> '.$btnPrnVsficsoc.' '.$btnVieVsficsoc.' '.$btnEdiVsficsoc.'</div>';
			}
			echo json_encode($arrData,JSON_UNESCAPED_UNICODE);
			die();
		}

		
		// Funcion para ACTA DE MATRICULA
		public function getActSoc(int $secID)
		{
			// Metodo para Obtener Datos de la Institucion ......
			$empresa = datos_empresa();
			$detalleAlumno = $this->model->getStdSoc($secID);

			$data['page_tag'] 	= 'Registro Acumulativo';
			$data['page_title'] = 'Registro Acumulativo';
			$data['page_name'] 	= 'Registro';
			$data['empresa'] 	= $empresa;
			$data['alumno_detalle'] = $detalleAlumno;
			
			$this->views->getView($this,"vsficprn",$data);
		}


		// Obtiene un estudiante especifico 
		public function getVsficsoc(int $idSTD)
		{
			$intSTD = intval(strClean($idSTD));
			if($intSTD > 0)
			{
				$arrData = $this->model->oneVsficsoc($intSTD);
				if(empty($arrData))
				{
					$arrResponse = array('status' => false, 'msg' => 'Ficha Social no encontrada.');
				}else{
					$arrResponse = array('status' => true, 'data' => $arrData);
				}
				echo json_encode($arrResponse,JSON_UNESCAPED_UNICODE);
			}
			die();
		}


		public function setVsficsoc()
		{ 
			$intSec_id        = intval($_POST['idSec_id']);
			$intStd_no 		  = intval($_POST['listStd_no']);
			$intCivils 		  = intval($_POST['listCivils']);
			$intEtnico 		  = intval($_POST['listEtnico']);
			$strStdjob        = strClean($_POST['txtStdjob']);
			$strStdwrk        = strClean($_POST['txtStdwrk']);
			$intHoucon 		  = intval($_POST['listHoucon']);
			$intHoutyp 		  = intval($_POST['listHoutyp']);
			$intEnergy 		  = intval($_POST['listEnergy']);
			$intWaters 		  = intval($_POST['listWaters']);
			$intToilet 		  = intval($_POST['listToilet']);
			$intSeptic 		  = intval($_POST['listSeptic']);
			$intTeleph 		  = intval($_POST['listTeleph']);
			$intSmarph 		  = intval($_POST['listSmarph']);
			$intIntern 		  = intval($_POST['listIntern']);
			$intTvcabl 		  = intval($_POST['listTvcabl']);
			$intMedatt 		  = intval($_POST['listMedatt']);
			$intMedfre 		  = intval($_POST['listMedfre']);
			$strAlermd        = strClean($_POST['txtAlermd']);
			$strAlerfo        = strClean($_POST['txtAlerfo']);
			$strAlercl        = strClean($_POST['txtAlercl']);
			$strAlerot        = strClean($_POST['txtAlerot']);
			$strBloodt        = strClean($_POST['txtBloodt']);
			$strDiseas        = strClean($_POST['txtDiseas']);
			$strMedici        = strClean($_POST['txtMedici']);
			$strDiscap        = strClean($_POST['txtDiscap']);
			$strConadi        = strClean($_POST['txtConadi']);
			$intObesid 		  = intval($_POST['listObesid']);
			$intDiabet 		  = intval($_POST['listDiabet']);
			$intHipert 		  = intval($_POST['listHipert']);
			$intCardio 		  = intval($_POST['listCardio']);
			$intBrains 		  = intval($_POST['listBrains']);
			$intOthers 		  = intval($_POST['listOthers']);

			if($intSec_id == 0)
			{
				// Crea una Ficha
				$opcion = 1;
				$request_Vsficsoc = $this->model->insertVsficsoc($intStd_no, $intCivils, $intEtnico, $strStdjob, $strStdwrk, $intHoucon, $intHoutyp, $intEnergy, $intWaters, $intToilet, $intSeptic, $intTeleph, $intSmarph, $intIntern, $intTvcabl, $intMedatt, $intMedfre, $strAlermd, $strAlerfo, $strAlercl, $strAlerot, $strBloodt, $strDiseas, $strMedici, $strDiscap, $strConadi, $intObesid, $intDiabet, $intHipert, $intCardio, $intBrains, $intOthers);
			}else{
				// Actualiza la Ficha
				$opcion = 2;
				$request_Vsficsoc = $this->model->updateVsficsoc($intSec_id, $intStd_no, $intCivils, $intEtnico, $strStdjob, $strStdwrk, $intHoucon, $intHoutyp, $intEnergy, $intWaters, $intToilet, $intSeptic, $intTeleph, $intSmarph, $intIntern, $intTvcabl, $intMedatt, $intMedfre, $strAlermd, $strAlerfo, $strAlercl, $strAlerot, $strBloodt, $strDiseas, $strMedici, $strDiscap, $strConadi, $intObesid, $intDiabet, $intHipert, $intCardio, $intBrains, $intOthers);
			}
	
			if($request_Vsficsoc > 0)
			{
				switch($opcion)
				{
					case 1:
						$arrResponse = array('status' => true, 'msg' => 'Ficha Social guardado con éxito.');
						break;
					case 2:
						$arrResponse = array('status' => true, 'msg' => 'Ficha Social actualizado con éxito !');
						break;
				}
			}else if($request_Vsficsoc == -1){
				$arrResponse = array('status' => false, 'msg' => '!!! ATENCIÓN. Ficha Social ya existe.');
			}else{
				$arrResponse = array('status' => false, 'msg' => 'No es posible almacenar la información.');
			}
			echo json_encode($arrResponse,JSON_UNESCAPED_UNICODE);
			die(); 
		}
	}
