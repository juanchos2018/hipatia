 <?php

	class VssocialModel extends Mysql
	{
		public $intSec_id;
		public $intStd_no;
		public $intCas_no;
		public $strHiscod;
		public $strFecreg;
		public $strFecnex;
		public $intWeighs;
		public $intHeighs;
		public $intPresur;
		public $intTemper;
		public $strProble;
		public $strExplor;
		public $strTratam;
		public $strRemark;

      
		public function __construct()
		{
			//echo "Mensaje desde el Modelo Home";
			parent::__construct();
		}


		public function selectVssocial()
		{
			// Extrae Historias Sociales
			$sql = "SELECT	a.SEC_ID,
				           	a.FECREG,
				           	a.CAS_NO,
			               	v.LAS_NM,
			               	v.FIR_NM
	    		    FROM vsclinic a
	        		INNER JOIN vstudent v 
	        		ON v.STD_NO = a.STD_NO
	        		WHERE a.HISCOD = 'SOC'
					ORDER BY a.FECREG DESC";

			$request = $this->select_all($sql);
			return $request;

		}


		public function oneVssocial(int $idSec)
		{
			$this->intSec_id = $idSec;
			$sql = "SELECT * FROM vsclinic WHERE SEC_ID = $this->intSec_id";
			$request = $this->select($sql);
			return $request;
		}


		public function insertVssocial(int $std_no, int $cas_no, string $fecreg, string $fecnex, string $weighs, string $heighs, string $presur, string $temper, string $proble, string $explor, string $tratam, string $remark, string $hiscod)
		{
   			$return = "";
			$this->intStd_no = $std_no;
			$this->intCas_no = $cas_no;
			$this->strFecreg = $fecreg;
			$this->strFecnex = $fecnex;
			$this->strWeighs = $weighs;
			$this->strHeighs = $heighs;
			$this->strPresur = $presur;
			$this->strTemper = $temper;
			$this->strProble = $proble;
			$this->strExplor = $explor;
			$this->strTratam = $tratam;
			$this->strRemark = $remark;
			$this->strHiscod = $hiscod;

			$insert          = "INSERT INTO vsclinic(std_no,cas_no,fecreg,fecnex,weighs,heighs,presur,temper,proble,explor,tratam,remark,hiscod) VALUES(?,?,?,?,?,?,?,?,?,?,?,?,?)";
			$arrData         = array($this->intStd_no,$this->intCas_no,$this->strFecreg,$this->strFecnex,$this->strWeighs,$this->strHeighs,$this->strPresur,$this->strTemper,$this->strProble,$this->strExplor,$this->strTratam,$this->strRemark,$this->strHiscod);
			$request_insert  = $this->insert($insert,$arrData);
			$return          = $request_insert;
			return $return;
		}


		public function updateVssocial(int $sec_id, int $std_no, int $cas_no, string $fecreg, string $fecnex, string $weighs, string $heighs, string $presur, string $temper, string $proble, string $explor, string $tratam, string $remark, string $hiscod)
		{
   			$return = "";
            $this->intSec_id = $sec_id;
            $this->intStd_no = $std_no;
			$this->intCas_no = $cas_no;
			$this->strFecreg = $fecreg;
			$this->strFecnex = $fecnex;
			$this->strWeighs = $weighs;
			$this->strHeighs = $heighs;
			$this->strPresur = $presur;
			$this->strTemper = $temper;
			$this->strProble = $proble;
			$this->strExplor = $explor;
			$this->strTratam = $tratam;
			$this->strRemark = $remark;
			$this->strHiscod = $hiscod;

			$insert         = "UPDATE vsclinic SET std_no = ?, cas_no = ?, fecreg = ?, fecnex = ?, weighs = ?, heighs = ?, presur = ?, temper = ?, proble = ?, explor = ?, tratam = ?, remark = ?, hiscod = ? WHERE SEC_ID = {$this->intSec_id}";
            $arrData        = array($this->intStd_no,$this->intCas_no,$this->strFecreg,$this->strFecnex,$this->intWeighs,$this->intHeighs,$this->intPresur,$this->intTemper,$this->strProble,$this->strExplor,$this->strTratam,$this->strRemark,$this->strHiscod);
			$request_insert = $this->update($insert,$arrData);
			$return         = $request_insert;
			return $return; 
		}
	}
