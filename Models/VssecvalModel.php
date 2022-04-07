 <?php

	class VssecvalModel extends Mysql
	{
		public $intSec_id;
		public $intPerios;
		public $intSec_no;
		public $intArt_no;
		public $intValors;
		public $intPordes;
		public $intStd_id;


		public function __construct()
		{
			//echo "Mensaje desde el Modelo Home";
			parent::__construct();
		}


		public function getVssecPrice(int $perios, int $codSec, int $codArt)
		{
		    $where = "WHERE PERIOS = ".$perios." AND SEC_NO = ".$codSec." AND ART_NO = ".$codArt;
		    $sql = "SELECT VALORS FROM vssecval ".$where;
			$request = $this->select($sql);	
			return $request;
		}


		public function getSecPerios(int $codStd)
		{
			$where = "WHERE STD_NO = ".$codStd;
		    $sql = "SELECT STD_NO,PERIOS,SEC_NO FROM vstudent ".$where;
			$request = $this->select($sql);	
			return $request;
		}


		public function selectVssecval()
		{
			$sql = "SELECT 	a.SEC_ID,
							a.PERIOS,
			               	s.SEC_NM,
			               	s.PARALE,
	        		       	m.ART_NM,
		    	           	a.VALORS,
						   	a.PORDES
		    FROM vssecval a
		    INNER JOIN vsection s ON a.SEC_NO = s.SEC_NO
    		INNER JOIN vsproduc m ON a.ART_NO = m.ART_NO 
		    ORDER BY a.PERIOS DESC,s.NIV_NO,s.PARALE,a.ART_NO";
			$request = $this->select_all($sql);
			return $request;
		}


		public function oneVssecval(int $secID)
		{
			$this->intSec_id = $secID;
			$sql = "SELECT * FROM vssecval WHERE SEC_ID = {$this->intSec_id}";
			$request = $this->select($sql);
			return $request;
		}


		public function insertVssecval(int $perios, int $sec_no, int $art_no, float $valors)
		{
   			$return = "";
			$this->intPerios = $perios;
			$this->intSec_no = $sec_no;
			$this->intArt_no = $art_no;
			$this->intValors = $valors;

			$sql = "SELECT * FROM vssecval WHERE PERIOS = {$this->intPerios} AND SEC_NO = {$this->intSec_no} AND ART_NO = {$this->intArt_no}";
			$request = $this->select($sql);
			if(empty($request))
			{
				$insert         = "INSERT INTO vssecval(perios,sec_no,art_no,valors) VALUES(?,?,?,?)";
				$arrData        = array($this->intPerios,$this->intSec_no,$this->intArt_no,$this->intValors);
				$request_insert = $this->insert($insert,$arrData);
				$return         = $request_insert;
			}else{
				// EXISTE
				$return = -1;
			}
			return $return;
		}


		public function updateVssecval(int $sec_id, int $perios, int $sec_no, int $art_no, float $valors)
		{
   			$return = "";
		    $this->intSec_id = $sec_id;
		    $this->intPerios = $perios;
		    $this->intSec_no = $sec_no;
		    $this->intArt_no = $art_no;
		    $this->intValors = $valors;
   
			$sql = "SELECT * FROM vssecval WHERE PERIOS = {$this->intPerios} AND SEC_NO = {$this->intSec_no} AND ART_NO = {$this->intArt_no} AND SEC_ID != {$this->intSec_id}";
			$request = $this->select_all($sql);
			if(empty($request))
			{
				$insert         = "UPDATE vssecval SET perios = ?, sec_no = ?, art_no = ?, valors = ? WHERE SEC_ID = {$this->intSec_id}";
				$arrData        = array($this->intPerios,$this->intSec_no,$this->intArt_no,$this->intValors);
				$request_update = $this->update($insert,$arrData);
				$return         = $request_update;
			}else{
				// EXISTE
				$return = -1;
			}
			return $return;
		}
	}
