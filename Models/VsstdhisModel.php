 <?php

	class VsstdhisModel extends Mysql
	{
		public $intSec_id;
		public $intPerios;
		public $strFecreg;
		public $intStd_no;
		public $intRetain;


		public function __construct()
		{
			//echo "Mensaje desde el Modelo Home";
			parent::__construct();
		}


		public function selectVsstdhis()
		{
			$sql = "SELECT	a.SEC_ID,
			               	a.PERIOS,
				           	a.FECREG,
		            	   	v.LAS_NM,
			               	v.FIR_NM,
                            a.RETAIN
	        		FROM vsstdhis a
	        		INNER JOIN vstudent v ON v.STD_NO = a.STD_NO
					ORDER BY v.PERIOS DESC, v.LAS_NM, v.FIR_NM";
			$request = $this->select_all($sql);
			return $request;
		}


		public function oneVsstdhis(int $idSec)
		{
			$this->intSec_id = $idSec;
			$sql = "SELECT * FROM vsstdhis WHERE SEC_ID = {$this->intSec_id}";
			$request = $this->select($sql);
			return $request;
		}


		public function insertVsstdhis(int $perios, string $fecreg, int $std_no, float $retain)
		{
   			$return = "";
			$this->intPerios = $perios;
			$this->strFecreg = $fecreg;
			$this->intStd_no = $std_no;
			$this->intRetain = $retain;

			$sql = "SELECT * FROM vsstdhis WHERE PERIOS = {$this->intPerios} AND STD_NO = {$this->intStd_no}";
			$request = $this->select_all($sql);
			if(empty($request))
			{
				$insert         = "INSERT INTO vsstdhis(perios,fecreg,std_no,retain) VALUES(?,?,?,?)";
				$arrData        = array($this->intPerios,$this->strFecreg,$this->intStd_no,$this->intRetain);
				$request_insert = $this->insert($insert,$arrData);
				$return         = $request_insert;
			}else{
				// EXISTE
				$return = -1;
			}
			return $return;
		}


		public function updateVsstdhis(int $sec_id, int $perios, string $fecreg, int $std_no, float $retain)
		{
   			$return = "";
  		    $this->intSec_id = $sec_id;
		    $this->intPerios = $perios;
			$this->strFecreg = $fecreg;
			$this->intStd_no = $std_no;
			$this->intRetain = $retain;

			$sql = "SELECT * FROM vsstdhis WHERE PERIOS = {$this->intPerios} AND STD_NO = {$this->intStd_no} AND SEC_ID != {$this->intSec_id}";
			$request = $this->select_all($sql);
			if(empty($request))
			{
				$insert         = "UPDATE vsstdhis SET perios = ?, fecreg = ?, std_no = ?, retain = ? WHERE SEC_ID = {$this->intSec_id}";
				$arrData        = array($this->intPerios,$this->strFecreg,$this->intStd_no,$this->intRetain);
				$request_insert = $this->update($insert,$arrData);
				$return         = $request_insert;
			}else{
				// EXISTE
				$return = -1;
			}
			return $return; 
		}
	}
