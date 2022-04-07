<?php

	// Heredamos la clase: Controllers
	class Vsatssri extends Controllers{

		public function __construct()
		{
			parent::__construct();
			session_start();
			if(empty($_SESSION['login']))
			{
				header('Location: '.base_url().'Login');
			}
			getPermisos(45);
		}


		public function Vsatssri()
		{
			$data['page_id'] 	= 45;
			$data['page_tag'] 	= 'Anexo Transaccional';
			$data['page_name'] 	= 'anexo_transaccional';
			$data['page_title'] = 'Anexo Transaccional';
			$this->views->getView($this,"vsatssri",$data);
		}


		public function getVsatssris()
		{
			$arrData = $this->model->selectVsatssris();
			for ($i = 0; $i < count($arrData); $i++) 
			{
				$btnXmlVsatssri  		= "";
                $btnDelVsatssri  		= "";
				$color_boton_XML 		= 'class="btn btn-outline-success btn-sm"';
	
				$btnXmlVsatssri  		= '<a '.$color_boton_XML.' title="Descargar XML" href="'.$arrData[$i]['LOGFIL'].'" download="ATS-'.$arrData[$i]['PERIOS'].'.xml"><i class="fas fa-code"></i></a>';

				if($_SESSION['permisosMod']['d'])
				{
					$btnDelVsatssri = '<button class="btn btn-danger btn-sm btnDelVsatssri" onClick="fntDelVsatssri('.$arrData[$i]['SEC_ID'].')" title="Eliminar"><i class="fas fa-trash-alt"></i></button>';
				}

				$arrData[$i]['options'] = '<div class="text-center"> '.$btnXmlVsatssri.' '.$btnDelVsatssri.'</div>';
				$arrData[$i]['PERIOS']	= substr($arrData[$i]['PERIOS'],0,2).'-'.substr($arrData[$i]['PERIOS'],2,4);
			}
			echo json_encode($arrData,JSON_UNESCAPED_UNICODE);
			die();
		}


		public function getVsatssri(int $secId)
		{
			$intSTD = intval($secId);
			if($intSTD > 0)
			{
				$arrData = $this->model->oneVsatssri($intSTD);
				if(empty($arrData))
				{
					$arrResponse = array('status' => false, 'msg' => 'ATS no encontrado.');
				}else{
					$arrResponse = array('status' => true, 'data' => $arrData);
				}
				echo json_encode($arrResponse,JSON_UNESCAPED_UNICODE);
			}
			die();
		}


        // ELIMINA UN REGISTRO ATS
		public function delVsatssri()
		{
			$intSec     = intval($_POST['idSec']);
			$request    = $this->model->deleteVsatssri($intSec);
			if($request == 'ok')
			{
				$arrResponse = array('status' => true, 'msg' => 'Se ha eliminado el Registro.');
			}else{
				$arrResponse = array('status' => false, 'msg' => 'Error al eliminar el Registro.');
			}
			echo json_encode($arrResponse,JSON_UNESCAPED_UNICODE);
			die();	
		}
      

        public function setVsatssri()
		{
            $intSec_id   = intval($_POST['idSec_id']);
			$datFecdes   = strClean($_POST['datFecdes']);
			$datFechas   = strClean($_POST['datFechas']);

			if($intSec_id == 0)
			{
				// Crea un ATS
                $request_xml  = $this->model->vsXMLCreate($datFecdes,$datFechas);
                if($request_xml == 'ok')
                {
                    $request_Vsatssri   = $this->model->insertVsatssri($datFecdes,$datFechas);
                }else{
                    $request_Vsatssri   = -2;
                }
			}

			if($request_Vsatssri > 0)
			{
				$arrResponse = array('status' => true, 'msg' => 'ATS guardado con éxito.');
			}else if($request_Vsatssri == -1){
				$arrResponse = array('status' => false, 'msg' => '!!! ATENCIÓN. ATS ya existe.');
			}else{
				$arrResponse = array('status' => false, 'msg' => '!!! ATENCIÓN. No existe información para generar.');
			}
			echo json_encode($arrResponse,JSON_UNESCAPED_UNICODE);
			die(); 
		}
	}
