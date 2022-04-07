 <?php

	class VssecuenModel extends Mysql
	{
		public $strTab_no;
		public $strPto_no;
        public $intMov_no;
        public $intPar_no;


		public function __construct()
		{
			//echo "Mensaje desde el Modelo Home";
			parent::__construct();
		}


		// OBTIENE LOS SECUENCIALES
		public function selectVssecuen()
		{
			$sql     = "SELECT 	s.SEC_ID,
								t.TAB_NM,
                                s.PTO_NO,
                                s.MOV_NO,
								s.PAR_NO
						FROM vssecuen s
						INNER JOIN vstabhea t ON t.TAB_NO = s.MOVTIP
						ORDER BY t.TAB_NM";
			$request = $this->select_all($sql);
			return $request;
		}


		// OBTIENE UN SECUENCIAL
		public function oneVssecuen(int $idSec)
		{
			$this->intSec_no = $idSec;
			$sql 		= "SELECT * FROM vssecuen WHERE SEC_ID = {$this->intSec_no}";
			$request 	= $this->select($sql);
			return $request;
		}


		// INSERTA UNA SECUENCIA
		public function insertVssecuen(string $movtip, string $pto_no, int $mov_no, float $par_no)
		{
   			$return = "";
            $this->strMovtip = $movtip;
            $this->strPto_no = $pto_no;
            $this->intMov_no = $mov_no;
            $this->intPar_no = $par_no;

			$sql     			= "SELECT * FROM vssecuen WHERE MOVTIP = '{$this->strMovtip}' AND PTO_NO = '{$this->strPto_no}' AND MOV_NO = {$this->intMov_no}";
			$request_vssecuen 	= $this->select($sql);
			if(empty($request_vssecuen))
			{
				$insert  		= "INSERT INTO vssecuen(movtip,pto_no,mov_no,par_no) VALUES(?,?,?,?)";
				$arrData 		= array($this->strMovtip,$this->strPto_no,$this->intMov_no,$this->intPar_no);
				$request_insert = $this->insert($insert,$arrData);
				$return         = $request_insert;
			}else{
				// EXISTE
				$return = -1;
			}
			return $return;
		}


		// ACTUALIZA UNA SECUENCIA
		public function updateVssecuen(int $sec_id, string $movtip, string $pto_no, int $mov_no, float $par_no)
        {
            $return = "";
            $this->intSec_id = $sec_id;
            $this->strMovtip = $movtip;
            $this->strPto_no = $pto_no;
            $this->intMov_no = $mov_no;
            $this->intPar_no = $par_no;

			$sql     			= "SELECT * FROM vssecuen WHERE MOVTIP = '{$this->strMovtip}' AND PTO_NO = '{$this->strPto_no}' AND MOV_NO = {$this->intMov_no} AND SEC_ID != {$this->intSec_id}";
			$request_vssecuen 	= $this->select($sql);
			if(empty($request_vssecuen))
			{
				$insert  		= "UPDATE vssecuen SET PTO_NO = ?, MOV_NO = ?, PAR_NO = ? WHERE SEC_ID = {$this->intSec_id}";
				$arrData 		= array($this->strPto_no,$this->intMov_no,$this->intPar_no);
				$request_insert = $this->update($insert,$arrData);
				$return         = $request_insert;
			}else{
				// EXISTE
				$return = -1;
			}
			return $return; 
		}
	}
