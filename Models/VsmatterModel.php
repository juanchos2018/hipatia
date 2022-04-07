 <?php

	class VsmatterModel extends Mysql
	{
		public $intMat_no;
		public $strMat_nm;
		public $intRegime;
		public $intCalifi;
		public $intPromed;
		public $strEbooks;
		public $intCuan01;
		public $intCuan02;
		public $intCuan03;
		public $intCuan04;
		public $intCuan05;
		public $intCuan06;
		public $intCuan07;
		public $intCuan08;
		public $intCuan09;
		public $intCuan10;
		public $strCual01;
		public $strCual02;
		public $strCual03;
		public $strCual04;
		public $strCual05;
		public $strCual06;
		public $strCual07;
		public $strCual08;
		public $strCual09;
		public $strCual10;
		public $intGru_no;


		public function __construct()
		{
			//echo "Mensaje desde el Modelo Home";
			parent::__construct();
		}


		public function selectVsmatter()
		{
			$usu = $_SESSION['userData']['USU_NO'];
			$rol = $_SESSION['userData']['rol_id'];
			switch($rol)
			{
				case 5:  // Docente
						$sql = "SELECT 	a.MAT_NO,
										m.MAT_NM,
										m.REGIME,
										m.CALIFI,
										s.SEC_NM,
										s.PARALE,
										s.NIV_NO
						FROM vssecmat a
						INNER JOIN vsmatter m ON m.MAT_NO = a.MAT_NO 
						INNER JOIN vsemplox e ON e.EMP_NO = a.EMP_NO
						INNER JOIN vsection s ON s.SEC_NO = a.SEC_NO
						WHERE a.EMP_NO = $usu
						ORDER BY s.NIV_NO,s.PARALE,m.MAT_NM,m.REGIME";
						break;
				default:
						$sql  = "SELECT * FROM vsmatter ORDER BY MAT_NM,REGIME";
						break;
			}
			$request = $this->select_all($sql);
			return $request;
		}


		public function oneVsmatter(int $idMAT)
		{
			$this->intMat_no = $idMAT;
			$sql 		= "SELECT * FROM vsmatter WHERE MAT_NO = {$this->intMat_no}";
			$request 	= $this->select($sql);
			return $request;
		}


		// ELIMINA UNA ASIGNATURA
		public function deleteVsmatter(int $idSec)
		{
			$this->intMat_no = $idSec;
			$sql 				= "SELECT MAT_NO FROM vsmatter WHERE MAT_NO = {$this->intMat_no}";
			$request_vsmatter	= $this->select($sql);
			if(empty($request_vsmatter))
			{
				$request = 'error';
			}else{
				$sql 				= "SELECT MAT_NO FROM vsmatstd WHERE MAT_NO = {$this->intMat_no}";
				$request			= $this->select($sql);
				if(empty($request))
				{
					$sql 		= "DELETE FROM vsmatter WHERE MAT_NO = {$this->intMat_no}";
					$request 	= $this->delete($sql);
					$request 	= 'ok';
				}else{
					$request = 'error';
				}
			}
			return $request;
		}


		public function insertVsmatter(string $mat_nm, int $regime, int $califi, int $promed, string $ebooks, int $cuan01, int $cuan02, int $cuan03, int $cuan04, int $cuan05, int $cuan06, int $cuan07, int $cuan08, int $cuan09, int $cuan10, string $cual01, string $cual02, string $cual03, string $cual04, string $cual05, string $cual06, string $cual07, string $cual08, string $cual09, string $cual10, int $gru_no)
		{
   			$return = "";
			$this->strMat_nm = $mat_nm;
			$this->intRegime = $regime;
			$this->intCalifi = $califi;
			$this->intPromed = $promed;
			$this->strEbooks = $ebooks;
			$this->intCuan01 = $cuan01;
			$this->intCuan02 = $cuan02;
			$this->intCuan03 = $cuan03;
			$this->intCuan04 = $cuan04;
			$this->intCuan05 = $cuan05;
			$this->intCuan06 = $cuan06;
			$this->intCuan07 = $cuan07;
			$this->intCuan08 = $cuan08;
			$this->intCuan09 = $cuan09;
			$this->intCuan10 = $cuan10;
			$this->strCual01 = $cual01;
			$this->strCual02 = $cual02;
			$this->strCual03 = $cual03;
			$this->strCual04 = $cual04;
			$this->strCual05 = $cual05;
			$this->strCual06 = $cual06;
			$this->strCual07 = $cual07;
			$this->strCual08 = $cual08;
			$this->strCual09 = $cual09;
			$this->strCual10 = $cual10;
			$this->intGru_no = $gru_no;

			$sql 		= "SELECT * FROM vsmatter WHERE MAT_NM = '{$this->strMat_nm}' AND REGIME = '{$this->intRegime}'";
			$request 	= $this->select_all($sql);
			if(empty($request))
			{
				$insert         = "INSERT INTO vsmatter(mat_nm,regime,califi,promed,ebooks,cuan01,cuan02,cuan03,cuan04,cuan05,cuan06,cuan07,cuan08,cuan09,cuan10,cual01,cual02,cual03,cual04,cual05,cual06,cual07,cual08,cual09,cual10,gru_no) VALUES(?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)";
				$arrData        = array($this->strMat_nm,$this->intRegime,$this->intCalifi,$this->intPromed,$this->strEbooks,$this->intCuan01,$this->intCuan02,$this->intCuan03,$this->intCuan04,$this->intCuan05,$this->intCuan06,$this->intCuan07,$this->intCuan08,$this->intCuan09,$this->intCuan10,$this->strCual01,$this->strCual02,$this->strCual03,$this->strCual04,$this->strCual05,$this->strCual06,$this->strCual07,$this->strCual08,$this->strCual09,$this->strCual10,$this->intGru_no);
				$request_insert = $this->insert($insert,$arrData);
				$return         = $request_insert;
			}else{
				// EXISTE
				$return = -1;
			}
			return $return;
		}

		
		public function updateVsmatter(int $mat_no, string $mat_nm, int $regime, int $califi, int $promed, string $ebooks, int $cuan01, int $cuan02, int $cuan03, int $cuan04, int $cuan05, int $cuan06, int $cuan07, int $cuan08, int $cuan09, int $cuan10, string $cual01, string $cual02, string $cual03, string $cual04, string $cual05, string $cual06, string $cual07, string $cual08, string $cual09, string $cual10, int $gru_no)
		{
   			$return = "";
			$this->intMat_no = $mat_no;
			$this->strMat_nm = $mat_nm;
			$this->intRegime = $regime;
			$this->intCalifi = $califi;
			$this->intPromed = $promed;
			$this->strEbooks = $ebooks;
			$this->intCuan01 = $cuan01;
			$this->intCuan02 = $cuan02;
			$this->intCuan03 = $cuan03;
			$this->intCuan04 = $cuan04;
			$this->intCuan05 = $cuan05;
			$this->intCuan06 = $cuan06;
			$this->intCuan07 = $cuan07;
			$this->intCuan08 = $cuan08;
			$this->intCuan09 = $cuan09;
			$this->intCuan10 = $cuan10;
			$this->strCual01 = $cual01;
			$this->strCual02 = $cual02;
			$this->strCual03 = $cual03;
			$this->strCual04 = $cual04;
			$this->strCual05 = $cual05;
			$this->strCual06 = $cual06;
			$this->strCual07 = $cual07;
			$this->strCual08 = $cual08;
			$this->strCual09 = $cual09;
			$this->strCual10 = $cual10;
			$this->intGru_no = $gru_no;
 
			$sql 		= "SELECT * FROM vsmatter WHERE MAT_NM = '{$this->strMat_nm}' AND REGIME = '{$this->intRegime}' AND MAT_NO != {$this->intMat_no}";
			$request 	= $this->select_all($sql);
			if(empty($request))
			{
				$insert         = "UPDATE vsmatter SET mat_nm = ?, regime = ?, califi = ?, promed = ?, ebooks = ?, cuan01 = ?, cuan02 = ?, cuan03 = ?, cuan04 = ?, cuan05 = ?, cuan06 = ?, cuan07 = ?, cuan08 = ?, cuan09 = ?, cuan10 = ?, cual01 = ?, cual02 = ?, cual03 = ?, cual04 = ?, cual05 = ?, cual06 = ?, cual07 = ?, cual08 = ?, cual09 = ?, cual10 = ?, gru_no = ? WHERE MAT_NO = {$this->intMat_no}";
				$arrData        = array($this->strMat_nm,$this->intRegime,$this->intCalifi,$this->intPromed,$this->strEbooks,$this->intCuan01,$this->intCuan02,$this->intCuan03,$this->intCuan04,$this->intCuan05,$this->intCuan06,$this->intCuan07,$this->intCuan08,$this->intCuan09,$this->intCuan10,$this->strCual01,$this->strCual02,$this->strCual03,$this->strCual04,$this->strCual05,$this->strCual06,$this->strCual07,$this->strCual08,$this->strCual09,$this->strCual10,$this->intGru_no);
				$request_insert = $this->update($insert,$arrData);
				$return         = $request_insert;
			}else{
				// EXISTE
				$return = -1;
			}
			return $return;
		}
	}
