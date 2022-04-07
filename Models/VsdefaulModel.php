 <?php

	class VsdefaulModel extends Mysql
	{
		public $intSec_id;
		public $strAmi_id;
		public $intPerios;
		public $strRazons;
		public $strAddres;
		public $strTphone;
		public $strRuc_no;
		public $strEmails;
		public $strParroq;
		public $strCiudad;
		public $strCanton;
		public $strProvin;
		public $intRegime;
		public $intSosten;
		public $strQ1p1hd;
		public $datQ1p1pr;
		public $strQ1p2hd;
		public $datQ1p2pr;
		public $strQ1p3hd;
		public $datQ1p3pr;
		public $strQ1p4hd;
		public $datQ1p4pr;
		public $strQ2p1hd;
		public $datQ2p1pr;
		public $strQ2p2hd;
		public $datQ2p2pr;
		public $strQ2p3hd;
		public $datQ2p3pr;
		public $strQ2p4hd;
		public $datQ2p4pr;
		public $intBascal;
		public $intMinsup;
		public $intParpro;
		public $intInsnum;
		public $intParpor;
		public $intExapor;
		public $intDecnum;
		public $strRector;
		public $strSecret;
		public $intMatnum;
		public $intFolnum;


		public function __construct()
		{
			//echo "Mensaje desde el Modelo Home";
			parent::__construct();	
		}


		// EXTRAE PARAMETROS
		public function selectVsdefaul()
		{
			$sql     = "SELECT * FROM vsdefaul";
			$request = $this->select_all($sql);
			return $request;
		}


		// EXTRAE UN PARAMETRO
		public function onePerios()
		{
			$sql 		= "SELECT PERIOS FROM vsdefaul";
			$request 	= $this->select($sql);
			return $request;
		}


		// EXTRAE UN PARAMETRO
		public function oneVsdefaul(int $idSEC)
		{
			$this->intSec_id = $idSEC;
			$sql 		= "SELECT * FROM vsdefaul WHERE SEC_ID = {$this->intSec_id}";
			$request 	= $this->select($sql);
			return $request;
		}


		// INSERTA UN PARAMETRO
		public function insertVsdefaul(string $ami_id, int $perios, string $razons, string $addres, string $tphone, string $ruc_no, string $emails, string $parroq, string $ciudad, string $canton, string $provin, int $regime, int $sosten, string $q1p1hd, string $q1p1pr, string $q1p2hd, string $q1p2pr, string $q1p3hd, string $q1p3pr, string $q1p4hd, string $q1p4pr, string $q2p1hd, string $q2p1pr, string $q2p2hd, string $q2p2pr, string $q2p3hd, string $q2p3pr, string $q2p4hd, string $q2p4pr, int $bascal, int $minsup, int $parpro, int $insnum, int $parpor, int $exapor, int $decnum, string $rector, string $secret, int $matnum, int $folnum, string $distri)
		{
   			$return = "";
			$this->strAmi_id = $ami_id;
			$this->intPerios = $perios;
			$this->strRazons = $razons;
			$this->strAddres = $addres;
			$this->strTphone = $tphone;
			$this->strRuc_no = $ruc_no;
			$this->strEmails = $emails;
			$this->strParroq = $parroq;
			$this->strCiudad = $ciudad;
			$this->strCanton = $canton;
			$this->strProvin = $provin;
			$this->intRegime = $regime;
			$this->intSosten = $sosten;
			$this->strQ1p1hd = $q1p1hd;
			$this->datQ1p1pr = $q1p1pr;
			$this->strQ1p2hd = $q1p2hd;
			$this->datQ1p2pr = $q1p2pr;
			$this->strQ1p3hd = $q1p3hd;
			$this->datQ1p3pr = $q1p3pr;
			$this->strQ1p4hd = $q1p4hd;
			$this->datQ1p4pr = $q1p4pr;
			$this->strQ2p1hd = $q2p1hd;
			$this->datQ2p1pr = $q2p1pr;
			$this->strQ2p2hd = $q2p2hd;
			$this->datQ2p2pr = $q2p2pr;
			$this->strQ2p3hd = $q2p3hd;
			$this->datQ2p3pr = $q2p3pr;
			$this->strQ2p4hd = $q2p4hd;
			$this->datQ2p4pr = $q2p4pr;
			$this->intBascal = $bascal;
			$this->intMinsup = $minsup;
			$this->intParpro = $parpro;
			$this->intInsnum = $insnum;
			$this->intParpor = $parpor;
			$this->intExapor = $exapor;
			$this->intDecnum = $decnum;
			$this->strRector = $rector;
			$this->strSecret = $secret;
			$this->intMatnum = $matnum;
			$this->intFolnum = $folnum;
			$this->strDistri = $distri;
	
			$sql     			= "SELECT * FROM vsdefaul WHERE RAZONS = '{$this->strRazons}'";
			$request_vsdefaul 	= $this->select_all($sql);
			if(empty($request_vsdefaul))
			{
				$insert         = "INSERT INTO vsdefaul(ami_id,perios,razons,addres,tphone,ruc_no,emails,parroq,ciudad,canton,provin,regime,sosten,q1p1hd,q1p1pr,q1p2hd,q1p2pr,q1p3hd,q1p3pr,q1p4hd,q1p4pr,q2p1hd,q2p1pr,q2p2hd,q2p2pr,q2p3hd,q2p3pr,q2p4hd,q2p4pr,bascal,minsup,parpro,insnum,parpor,exapor,decnum,rector,secres,matnum,folnum,distri) VALUES(?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)";
				$arrData        = array($this->strAmi_id,$this->intPerios,$this->strRazons,$this->strAddres,$this->strTphone,$this->strRuc_no,$this->strEmails,$this->strParroq,$this->strCiudad,$this->strCanton,$this->strProvin,$this->intRegime,$this->intSosten,$this->strQ1p1hd,$this->datQ1p1pr,$this->strQ1p2hd,$this->datQ1p2pr,$this->strQ1p3hd,$this->datQ1p3pr,$this->strQ1p4hd,$this->datQ1p4pr,$this->strQ2p1hd,$this->datQ2p1pr,$this->strQ2p2hd,$this->datQ2p2pr,$this->strQ2p3hd,$this->datQ2p3pr,$this->strQ2p4hd,$this->datQ2p4pr,$this->intBascal,$this->intMinsup,$this->intParpro,$this->intInsnum,$this->intParpor,$this->intExapor,$this->intDecnum,$this->strRector,$this->strSecret,$this->intMatnum,$this->intFolnum,$this->strDistri);
				$request_insert = $this->insert($insert,$arrData);
				$return         = $request_insert;
			}else{
				// EXISTE
				$return = -1;
			}
			return $return;
		}


		public function updateVsdefaul(int $sec_id, string $ami_id, int $perios, string $razons, string $addres, string $tphone, string $ruc_no, string $emails, string $parroq, string $ciudad, string $canton, string $provin, int $regime, int $sosten, string $q1p1hd, string $q1p1pr, string $q1p2hd, string $q1p2pr, string $q1p3hd, string $q1p3pr, string $q1p4hd, string $q1p4pr, string $q2p1hd, string $q2p1pr, string $q2p2hd, string $q2p2pr, string $q2p3hd, string $q2p3pr, string $q2p4hd, string $q2p4pr, int $bascal, int $minsup, int $parpro, int $insnum, int $parpor, int $exapor, int $decnum, string $rector, string $secret, int $matnum, int $folnum, string $distri)
		{
   			$return = "";
			$this->intSec_id = $sec_id;
			$this->strAmi_id = $ami_id;
			$this->intPerios = $perios;
			$this->strRazons = $razons;
			$this->strAddres = $addres;
			$this->strTphone = $tphone;
			$this->strRuc_no = $ruc_no;
			$this->strEmails = $emails;
			$this->strParroq = $parroq;
			$this->strCiudad = $ciudad;
			$this->strCanton = $canton;
			$this->strProvin = $provin;
			$this->intRegime = $regime;
			$this->intSosten = $sosten;
			$this->strQ1p1hd = $q1p1hd;
			$this->datQ1p1pr = $q1p1pr;
			$this->strQ1p2hd = $q1p2hd;
			$this->datQ1p2pr = $q1p2pr;
			$this->strQ1p3hd = $q1p3hd;
			$this->datQ1p3pr = $q1p3pr;
			$this->strQ1p4hd = $q1p4hd;
			$this->datQ1p4pr = $q1p4pr;
			$this->strQ2p1hd = $q2p1hd;
			$this->datQ2p1pr = $q2p1pr;
			$this->strQ2p2hd = $q2p2hd;
			$this->datQ2p2pr = $q2p2pr;
			$this->strQ2p3hd = $q2p3hd;
			$this->datQ2p3pr = $q2p3pr;
			$this->strQ2p4hd = $q2p4hd;
			$this->datQ2p4pr = $q2p4pr;
			$this->intBascal = $bascal;
			$this->intMinsup = $minsup;
			$this->intParpro = $parpro;
			$this->intInsnum = $insnum;
			$this->intParpor = $parpor;
			$this->intExapor = $exapor;
			$this->intDecnum = $decnum;
			$this->strRector = $rector;
			$this->strSecret = $secret;
			$this->intMatnum = $matnum;
			$this->intFolnum = $folnum;
			$this->strDistri = $distri;
 
			$sql     			= "SELECT * FROM vsdefaul WHERE RAZONS = '{$this->strRazons}' AND SEC_ID != {$this->intSec_id}";
			$request_vsdefaul 	= $this->select_all($sql);
			if(empty($request_vsdefaul))
			{
				$insert         = "UPDATE vsdefaul SET ami_id = ?, perios = ?, razons = ?, addres = ?, tphone = ?, ruc_no = ?, emails = ?, parroq = ?, ciudad = ?, canton = ?, provin = ?, regime = ?, sosten = ?, q1p1hd = ?, q1p1pr = ?, q1p2hd = ?, q1p2pr = ?, q1p3hd = ?, q1p3pr = ?, q1p4hd = ?, q1p4pr = ?, q2p1hd = ?, q2p1pr = ?, q2p2hd = ?, q2p2pr = ?, q2p3hd = ?, q2p3pr = ?, q2p4hd = ?, q2p4pr = ?, bascal = ?, minsup = ?, parpro = ?, insnum = ?, parpor = ?, exapor = ?, decnum = ?, rector = ?, secres = ?, matnum = ?, folnum = ?, distri = ? WHERE SEC_ID = {$this->intSec_id}";
				$arrData        = array($this->strAmi_id,$this->intPerios,$this->strRazons,$this->strAddres,$this->strTphone,$this->strRuc_no,$this->strEmails,$this->strParroq,$this->strCiudad,$this->strCanton,$this->strProvin,$this->intRegime,$this->intSosten,$this->strQ1p1hd,$this->datQ1p1pr,$this->strQ1p2hd,$this->datQ1p2pr,$this->strQ1p3hd,$this->datQ1p3pr,$this->strQ1p4hd,$this->datQ1p4pr,$this->strQ2p1hd,$this->datQ2p1pr,$this->strQ2p2hd,$this->datQ2p2pr,$this->strQ2p3hd,$this->datQ2p3pr,$this->strQ2p4hd,$this->datQ2p4pr,$this->intBascal,$this->intMinsup,$this->intParpro,$this->intInsnum,$this->intParpor,$this->intExapor,$this->intDecnum,$this->strRector,$this->strSecret,$this->intMatnum,$this->intFolnum,$this->strDistri);
				$request_insert = $this->update($insert,$arrData);
				$return         = $request_insert;
			}else{
				// EXISTE
				$return = -1;
			}
			return $return;
		}
	}
