 <?php

	class VsectionModel extends Mysql
	{
		public $intSec_no;
		public $intNiv_no;
		public $strParale;
		public $strSec_nm;
		public $intPabell;
		public $intModoes;
		public $intRegime;
		public $intJor_no;
		public $intSec_n2;


		public function __construct()
		{
			//echo "Mensaje desde el Modelo Home";
			parent::__construct();
		}


		// EXTRAE SECCIONES
		public function selectVsection()
		{
			$usu = $_SESSION['userData']['USU_NO'];
			$rol = $_SESSION['userData']['rol_id'];
			switch($rol)
			{
				case 5:  // Docente
					$sql = "SELECT 	a.SEC_NO,
									s.SEC_NM,
									s.NIV_NO,
									s.PARALE,
									s.JOR_NO
					FROM vssecmat a
					INNER JOIN vsection s ON a.SEC_NO = s.SEC_NO
					INNER JOIN vsemplox e ON a.EMP_NO = e.EMP_NO
					WHERE a.EMP_NO = $usu
					GROUP BY a.SEC_NO
					ORDER BY s.NIV_NO,s.PARALE";
					break;
				default: 
					$sql  = 'SELECT * FROM vsection ORDER BY NIV_NO,PARALE';
					break;
			}
			$request = $this->select_all($sql);
			return $request;
		}


		// OBTIENE UNA SECCION
		public function oneVsection(int $idSec)
		{
			$this->intSec_no = $idSec;
			$sql 		= "SELECT * FROM vsection WHERE SEC_NO = {$this->intSec_no}";
			$request 	= $this->select($sql);
			return $request;
		}


		// INSERTA UNA SECCION
		public function insertVsection(int $niv_no, string $parale, string $sec_nm, int $pabell, int $modoes, int $regime, int $jor_no, int $sec_n2)
		{
   			$return = "";
			$this->intNiv_no = $niv_no;
			$this->strParale = $parale;
			$this->strSec_nm = $sec_nm;
			$this->intPabell = $pabell;
			$this->intModoes = $modoes;
			$this->intRegime = $regime;
			$this->intJor_no = $jor_no;
			$this->intSec_n2 = $sec_n2;

			$sql 		= "SELECT * FROM vsection WHERE SEC_NM = '{$this->strSec_nm}' AND PARALE = '{$this->strParale}'";
			$request 	= $this->select($sql);
			if(empty($request))
			{
				$insert         = "INSERT INTO vsection(niv_no,parale,sec_nm,pabell,modoes,regime,jor_no,sec_n2) VALUES(?,?,?,?,?,?,?,?)";
				$arrData        = array($this->intNiv_no,$this->strParale,$this->strSec_nm,$this->intPabell,$this->intModoes,$this->intRegime,$this->intJor_no,$this->intSec_n2);
				$request_insert = $this->insert($insert,$arrData);
				$return         = $request_insert;
			}else{
				// EXISTE
				$return = -1;
			}
			return $return;
		}


		// ACTUALIZA UNA SECCION
		public function updateVsection(int $sec_no, int $niv_no, string $parale, string $sec_nm, int $pabell, int $modoes, int $regime, int $jor_no, int $sec_n2)
		{
   			$return = "";
			$this->intSec_no = $sec_no;
 			$this->intNiv_no = $niv_no;
			$this->strParale = $parale;
			$this->strSec_nm = $sec_nm;
			$this->intPabell = $pabell;
			$this->intModoes = $modoes;
			$this->intRegime = $regime;
			$this->intJor_no = $jor_no;
			$this->intSec_n2 = $sec_n2;

			$sql 		= "SELECT * FROM vsection WHERE SEC_NM = '{$this->strSec_nm}' AND PARALE = '{$this->strParale}' AND SEC_NO != {$this->intSec_no}";
			$request 	= $this->select($sql);
			if(empty($request))
			{
				$insert         = "UPDATE vsection SET NIV_NO = ?, PARALE = ?, SEC_NM = ?, PABELL = ?, MODOES = ?, REGIME = ?, JOR_NO = ?, SEC_N2 = ? WHERE SEC_NO = {$this->intSec_no}";
				$arrData        = array($this->intNiv_no,$this->strParale,$this->strSec_nm,$this->intPabell,$this->intModoes,$this->intRegime,$this->intJor_no,$this->intSec_n2);
				$request_insert = $this->update($insert,$arrData);
				$return         = $request_insert;
			}else{
				// EXISTE
				$return = -1;
			}
			return $return;
		}
	}
