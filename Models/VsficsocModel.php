 <?php

	class VsficsocModel extends Mysql
	{
		public $intSec_id;
		public $intStd_no;
		public $intCivils;
		public $intEtnico;
		public $strStdjob;
		public $strStdwrk;
		public $intHoucon;
		public $intHoutyp;
		public $intEnergy;
		public $intWaters;
		public $intToilet;
		public $intSeptic;
		public $intTeleph;
		public $intSmarph;
		public $intIntern;
		public $intTvcabl;
		public $intMedatt;
		public $intMedfre;
		public $strAlermd;
		public $strAlerfo;
		public $strAlercl;
		public $strAlerot;
		public $strBloodt;
		public $strDiseas;
		public $strMedici;
		public $strDiscap;
		public $strConadi;
		public $intObesid;
		public $intDiabet;
		public $intHipert;
		public $intCardio;
		public $intBrains;
		public $intOthers;


		public function __construct()
		{
			//echo "Mensaje desde el Modelo Home";
			parent::__construct();
		}


		public function selectVsficsoc()
		{
			$sql = "SELECT  f.STD_NO,
							v.LAS_NM,
							v.FIR_NM,
							v.ESTATU
					FROM vsficsoc f
					INNER JOIN vstudent v ON v.STD_NO = f.STD_NO
					ORDER BY v.LAS_NM,v.FIR_NM";
			$request = $this->select_all($sql);
			return $request;
		}


		// Obtiene Datos para la Impresion de Acta de Matricula
		public function getStdSoc(int $secID)
		{
			$request = array();

			// Aqui se extrae el estudiante
			$sql = "SELECT s.LAS_NM,s.FIR_NM,s.FECBIR,s.ADDRES,s.TPHONE,s.IDE_NO,s.STDGEN,s.STDMAI,s.REMARK,
			               v.CIVILS,v.ETNICO,v.HOUCON,v.HOUTYP,v.ENERGY,v.WATERS,v.TOILET,v.SEPTIC,v.TELEPH,
			               v.SMARPH,v.INTERN,v.TVCABL,v.MEDATT,v.MEDFRE,v.ALERMD,v.ALERFO,v.ALERCL,v.ALEROT
					FROM vsficsoc v 
					INNER JOIN vstudent s ON v.STD_NO = s.STD_NO 
					WHERE v.STD_NO = $secID";
            $request_alumnos = $this->select($sql);

            $request = array('alumnos' => $request_alumnos);
			return $request; 
		}


		public function oneVsficsoc(int $idSTD)
		{
			$this->intStd_no = $idSTD;
			$sql = "SELECT * FROM vsficsoc WHERE STD_NO = {$this->intStd_no}";
			$request = $this->select($sql);
			return $request;
		}


		public function insertVsficsoc(int $std_no, int $civils, int $etnico, string $stdjob, string $stdwrk, int $houcon, int $houtyp, int $energy, int $waters, int $toilet, int $septic, int $teleph, int $smarph, int $intern, int $tvcabl, int $medatt, int $medfre, string $alermd, string $alerfo, string $alercl, string $alerot, string $bloodt, string $diseas, string $medici, string $discap, string $conadi, int $obesid, int $diabet, int $hipert, int $cardio, int $brains, int $others)
		{
   			$return = "";
		   	$this->intStd_no  = $std_no;
		   	$this->intCivils  = $civils;
			$this->intEtnico  = $etnico;
			$this->strStdjob  = $stdjob;
			$this->strStdwrk  = $stdwrk;
			$this->intHoucon  = $houcon;
			$this->intHoutyp  = $houtyp;
			$this->intEnergy  = $energy;
			$this->intWaters  = $waters;
			$this->intToilet  = $toilet;
			$this->intSeptic  = $septic;
			$this->intTeleph  = $teleph;
			$this->intSmarph  = $smarph;
			$this->intIntern  = $intern;
			$this->intTvcabl  = $tvcabl;
			$this->intMedatt  = $medatt;
			$this->intMedfre  = $medfre;
			$this->strAlermd  = $alermd;
			$this->strAlerfo  = $alerfo;
			$this->strAlercl  = $alercl;
			$this->strAlerot  = $alerot;
			$this->strBloodt  = $bloodt;
			$this->strDiseas  = $diseas;
			$this->strMedici  = $medici;
			$this->strDiscap  = $discap;
			$this->strConadi  = $conadi;
			$this->intObesid  = $obesid;
			$this->intDiabet  = $diabet;
			$this->intHipert  = $hipert;
			$this->intCardio  = $cardio;
			$this->intBrains  = $brains;
			$this->intOthers  = $others;

			$sql     = "SELECT * FROM vsficsoc WHERE STD_NO = {$this->intStd_no}";
			$request = $this->select_all($sql);
			if(empty($request))
			{
				$insert  = "INSERT INTO vsficsoc(std_no,civils,etnico,stdjob,stdwrk,houcon,houtyp,energy,waters,toilet,septic,teleph,smarph,intern,tvcabl,medatt,medfre,alermd,alerfo,alercl,alerot,bloodt,diseas,medici,discap,conadi,obesid,diabet,hipert,cardio,brains,others) VALUES(?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)";
				$arrData = array($this->intStd_no,$this->intCivils,$this->intEtnico,$this->strStdjob,$this->strStdwrk,$this->intHoucon,$this->intHoutyp,$this->intEnergy,$this->intWaters,$this->intToilet,$this->intSeptic,$this->intTeleph,$this->intSmarph,$this->intIntern,$this->intTvcabl,$this->intMedatt,$this->intMedfre,$this->strAlermd,$this->strAlerfo,$this->strAlercl,$this->strAlerot,$this->strBloodt,$this->strDiseas,$this->strMedici,$this->strDiscap,$this->strConadi,$this->intObesid,$this->intDiabet,$this->intHipert,$this->intCardio,$this->intBrains,$this->intOthers);
				$request_insert = $this->insert($insert,$arrData);
				$return         = $request_insert;
			}else{
				// EXISTE
				$return = -1;
			}
			return $return;			
		}


		public function updateVsficsoc(int $sec_id, int $std_no, int $civils, int $etnico, string $stdjob, string $stdwrk, int $houcon, int $houtyp, int $energy, int $waters, int $toilet, int $septic, int $teleph, int $smarph, int $intern, int $tvcabl, int $medatt, int $medfre, string $alermd, string $alerfo, string $alercl, string $alerot, string $bloodt, string $diseas, string $medici, string $discap, string $conadi, int $obesid, int $diabet, int $hipert, int $cardio, int $brains, int $others)
		{
   			$return = "";
		   	$this->intSec_id  = $sec_id;
		   	$this->intStd_no  = $std_no;
		   	$this->intCivils  = $civils;
			$this->intEtnico  = $etnico;
			$this->strStdjob  = $stdjob;
			$this->strStdwrk  = $stdwrk;
			$this->intHoucon  = $houcon;
			$this->intHoutyp  = $houtyp;
			$this->intEnergy  = $energy;
			$this->intWaters  = $waters;
			$this->intToilet  = $toilet;
			$this->intSeptic  = $septic;
			$this->intTeleph  = $teleph;
			$this->intSmarph  = $smarph;
			$this->intIntern  = $intern;
			$this->intTvcabl  = $tvcabl;
			$this->intMedatt  = $medatt;
			$this->intMedfre  = $medfre;
			$this->strAlermd  = $alermd;
			$this->strAlerfo  = $alerfo;
			$this->strAlercl  = $alercl;
			$this->strAlerot  = $alerot;
			$this->strBloodt  = $bloodt;
			$this->strDiseas  = $diseas;
			$this->strMedici  = $medici;
			$this->strDiscap  = $discap;
			$this->strConadi  = $conadi;
			$this->intObesid  = $obesid;
			$this->intDiabet  = $diabet;
			$this->intHipert  = $hipert;
			$this->intCardio  = $cardio;
			$this->intBrains  = $brains;
			$this->intOthers  = $others;

			$sql     = "SELECT * FROM vsficsoc WHERE STD_NO = {$this->intStd_no} AND SEC_ID != {$this->intSec_id}";
			$request = $this->select_all($sql); 
			if(empty($request))
			{
				$insert  = "UPDATE vsficsoc SET std_no = ?, civils = ?, etnico = ?, stdjob = ?, stdwrk = ?, houcon = ?, houtyp = ?, energy = ?, waters = ?, toilet = ?, septic = ?, teleph = ?, smarph = ?, intern = ?, tvcabl = ?, medatt = ?, medfre = ?, alermd = ?, alerfo = ?, alercl = ?, alerot = ?, bloodt = ?, diseas = ?, medici = ?, discap = ?, conadi = ?, obesid = ?, diabet = ?, hipert = ?, cardio = ?, brains = ?, others = ? WHERE STD_NO = {$this->intStd_no}";
				$arrData = array($this->intStd_no,$this->intCivils,$this->intEtnico,$this->strStdjob,$this->strStdwrk,$this->intHoucon,$this->intHoutyp,$this->intEnergy,$this->intWaters,$this->intToilet,$this->intSeptic,$this->intTeleph,$this->intSmarph,$this->intIntern,$this->intTvcabl,$this->intMedatt,$this->intMedfre,$this->strAlermd,$this->strAlerfo,$this->strAlercl,$this->strAlerot,$this->strBloodt,$this->strDiseas,$this->strMedici,$this->strDiscap,$this->strConadi,$this->intObesid,$this->intDiabet,$this->intHipert,$this->intCardio,$this->intBrains,$this->intOthers);
				$request_insert = $this->update($insert,$arrData);
				$return         = $request_insert;
			}else{
				// EXISTE
				$return = -1;
			}
			return $return; 
		}
	}
