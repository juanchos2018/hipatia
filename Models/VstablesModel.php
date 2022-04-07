 <?php

	class VstablesModel extends Mysql
	{
		public $strTab_no;
		public $strSub_no;
		public $strSub_nm;
		public $intValors;
		public $intValor2;
		public $intEstatu;
		public $intProces;


		public function __construct()
		{
			//echo "Mensaje desde el Modelo Home";
			parent::__construct();
		}


		// OBTIENE LAS TABLAS EN GENERAL
		public function selectVstables()
		{
			$sql  = "SELECT s.SEC_ID,
							t.TAB_NM,
							s.SUB_NO,
							s.SUB_NM,
							s.ESTATU,
							s.VALORS,
							s.VALOR2
					FROM vstables s
					INNER JOIN vstabhea t ON t.TAB_NO = s.TAB_NO
					ORDER BY t.TAB_NM,s.SUB_NO";
			$request = $this->select_all($sql);
			return $request;
		}


		// OBTIENE UNA TABLA ESPECIFICA
		public function selectTable(string $tabla)
		{
			if($tabla == 'ACT')
			{
				$this->$strTab_no = 'CAL';
				$sql     = "SELECT * FROM vstables WHERE TAB_NO = '{$this->$strTab_no}' ORDER BY SEC_ID";
			}else{
				$this->$strTab_no = $tabla;
				$sql     = "SELECT * FROM vstables WHERE TAB_NO = '{$this->$strTab_no}' AND ESTATU = 1 ORDER BY SEC_ID";
			}
			$request = $this->select_all($sql);
			return $request;
		}


		// OBTIENE UNA TABLA
		public function oneVstable(int $idSec)
		{
			$this->intSec_no = $idSec;
			$sql 		= "SELECT * FROM vstables WHERE SEC_ID = {$this->intSec_no}";
			$request 	= $this->select($sql);
			return $request;
		}


		// ELIMINA UNA TABLA
		public function deleteVstables(int $idSec)
		{
			$this->intSec_id = $idSec;
			$sql 		= "DELETE FROM vstables WHERE SEC_ID = {$this->intSec_id}";
			$request 	= $this->delete($sql);
			if($request)
			{
				$request = 'ok';
			}else{
				$request = 'error';
			}
			return $request;
		}


		// OBTIENE ENTIDADES FINANCIERAS INTERNAS
		public function selectBank()
		{
			$sql     = "SELECT * FROM vsbanker ORDER BY BAN_NM";
			$request = $this->select_all($sql);
			return $request;
		}


		// EXTRAE CABECERA DE TABLAS
		public function selectTabhea()
		{
			$sql     = "SELECT * FROM vstabhea ORDER BY TAB_NM";
			$request = $this->select_all($sql);
			return $request;
		}


		// INSERTA UNA TABLA
		public function insertVstables(string $tab_no, string $sub_no, string $sub_nm, float $valors, float $valor2, int $proces, int $estatu)
		{
   			$return = "";
            $this->strTab_no = $tab_no;
            $this->strSub_no = $sub_no;
            $this->strSub_nm = $sub_nm;
			$this->intValors = $valors;
			$this->intValor2 = $valor2;
			$this->intEstatu = $estatu;
			$this->intProces = $proces;

			$sql     = "SELECT * FROM vstables WHERE TAB_NO = '{$this->strTab_no}' AND (SUB_NO = '{$this->strSub_no}' OR SUB_NM = '{$this->strSub_nm}')";
			$request = $this->select_all($sql);
			if(empty($request))
			{
				$insert  		= "INSERT INTO vstables(tab_no,sub_no,sub_nm,valors,valor2,proces,estatu) VALUES(?,?,?,?,?,?,?)";
				$arrData 		= array($this->strTab_no,$this->strSub_no,$this->strSub_nm,$this->intValors,$this->intValor2,$this->intProces,$this->intEstatu);
				$request_insert = $this->insert($insert,$arrData);
				$return         = $request_insert;
			}else{
				// EXISTE
				$return = -1;
			}
			return $return;
		}


		// ACTUALIZA UNA TABLA
		public function updateVstables(int $sec_id, string $tab_no, string $sub_no, string $sub_nm, float $valors, float $valor2, int $proces, int $estatu)
		{
   			$return = "";
			$this->intSec_id = $sec_id;
			$this->strTab_no = $tab_no;
	        $this->strSub_no = $sub_no;
			$this->strSub_nm = $sub_nm;
			$this->intValors = $valors;
			$this->intValor2 = $valor2;
			$this->intEstatu = $estatu;
			$this->intProces = $proces;

			$sql     = "SELECT * FROM vstables WHERE TAB_NO = '{$this->strTab_no}' AND (SUB_NO = '{$this->strSub_no}' OR SUB_NM = '{$this->strSub_nm}') AND SEC_ID != {$this->intSec_id}";
			$request = $this->select_all($sql);
			if(empty($request))
			{
				$insert  		= "UPDATE vstables SET tab_no = ?, sub_no = ?, sub_nm = ?, valors = ?, valor2 = ?, proces = ?, estatu = ? WHERE SEC_ID = {$this->intSec_id}";
				$arrData 		= array($this->strTab_no,$this->strSub_no,$this->strSub_nm,$this->intValors,$this->intValor2,$this->intProces,$this->intEstatu);
				$request_insert = $this->update($insert,$arrData);
				$return         = $request_insert;
			}else{
				// EXISTE
				$return = -1;
			}
			return $return; 
		}
	}
