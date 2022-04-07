 <?php

	class VsrolrubModel extends Mysql
	{
		public $intRub_no;
		public $strRub_nm;
		public $intRubtip;
		public $intEncera;
		public $intHidens;
		public $intRubcre;
		public $intAporte;
		public $strFormul;
		public $intEstatu;


		public function __construct()
		{
			//echo "Mensaje desde el Modelo Home";
			parent::__construct();
		}


		// EXTRAE RUBROS NOMINA
		public function selectVsrolrub()
		{
			$sql     = "SELECT * FROM vsrolrub ORDER BY RUBTIP,RUB_NO";
			$request = $this->select_all($sql);
			return $request;
		}


		// EXTRAE RUBROS CREDITOS PERSONALES
		public function selectVsrolcre()
		{
			$sql     = "SELECT * FROM vsrolrub WHERE RUBCRE = 1 ORDER BY RUBTIP,RUB_NO";
			$request = $this->select_all($sql);
			return $request;
		}


		// EXTRAE UN RUBRO NOMINA
		public function oneVsrolrub(int $idRub)
		{
			$this->intRub_no = $idRub;
			$sql 		= "SELECT * FROM vsrolrub WHERE RUB_NO = {$this->intRub_no}";
			$request 	= $this->select($sql);
			return $request;
		}


		// INSERTA UN RUBRO NOMINA
		public function insertVsrolrub(string $rub_nm, int $rubtip, int $encera, int $hidens, int $rubcre, int $aporte, string $formul, int $estatu)
		{
   			$return = "";
			$this->strRub_nm = $rub_nm;
			$this->intRubtip = $rubtip;
			$this->intEncera = $encera;
			$this->intHidens = $hidens;
			$this->intRubcre = $rubcre;
			$this->intAporte = $aporte;
			$this->strFormul = $formul;
			$this->intEstatu = $estatu;

			$sql = "SELECT * FROM vsrolrub WHERE RUB_NM = '{$this->strRub_nm}'";
			$request = $this->select_all($sql);
			if(empty($request))
			{
				$insert         = "INSERT INTO vsrolrub(rub_nm,rubtip,encera,hidens,rubcre,aporte,formul,estatu) VALUES(?,?,?,?,?,?,?,?)";
				$arrData        = array($this->strRub_nm,$this->intRubtip,$this->intEncera,$this->intHidens,$this->intRubcre,$this->intAporte,$this->strFormul,$this->intEstatu);
				$request_insert = $this->insert($insert,$arrData);
				$return         = $request_insert;
			}else{
				// EXISTE
				$return = -1;
			}
			return $return;
		}


		// ACTUALIZA UN RUBRO NOMINA
		public function updateVsrolrub(int $rub_no, string $rub_nm, int $rubtip, int $encera, int $hidens, int $rubcre, int $aporte, string $formul, int $estatu)
		{
   			$return = "";
            $this->intRub_no = $rub_no;
            $this->strRub_nm = $rub_nm;
			$this->intRubtip = $rubtip;
			$this->intEncera = $encera;
			$this->intHidens = $hidens;
			$this->intRubcre = $rubcre;
			$this->intAporte = $aporte;
			$this->strFormul = $formul;
			$this->intEstatu = $estatu;

			$sql = "SELECT * FROM vsrolrub WHERE RUB_NM = '{$this->strRub_nm}' AND RUB_NO != {$this->intRub_no}";
			$request = $this->select_all($sql);
			if(empty($request))
			{
				$insert         = "UPDATE vsrolrub SET RUB_NM = ?, RUBTIP = ?, ENCERA = ?, HIDENS = ?, RUBCRE = ?, APORTE = ?, FORMUL = ?, ESTATU = ? WHERE RUB_NO = {$this->intRub_no}";
				$arrData        = array($this->strRub_nm,$this->intRubtip,$this->intEncera,$this->intHidens,$this->intRubcre,$this->intAporte,$this->strFormul,$this->intEstatu);
				$request_insert = $this->update($insert,$arrData);
				$return         = $request_insert;
			}else{
				// EXISTE
				$return = -1;
			}
			return $return;
		}
	}
