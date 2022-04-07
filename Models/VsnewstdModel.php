<?php

	class VsnewstdModel extends Mysql
	{
		public $intStd_no;
		public $strLas_nm;
		public $strFir_nm;
		public $strAddres;
		public $strTphone;
		public $strIdtype;
		public $strIde_no;
		public $intStdgen;
		public $datFecbir;
		public $strStdmai;
		public $intTt_who;
		public $strFatlas;
		public $strFatnam;
		public $strFatadr;
		public $strFatfon;
		public $strFatype;
		public $strFatced;
		public $strFatjob;
		public $datFatbir;
		public $strFatmai;
		public $strMotlas;
		public $strMotnam;
		public $strMotadr;
		public $strMotfon;
		public $strMotype;
		public $strMotced;
		public $strMotjob;
		public $datMotbir;
		public $strMotmai;
		public $strReplas;
		public $strRepnam;
		public $strRepadr;
		public $strRepfon;
		public $strRetype;
		public $strRepced;
		public $strRepjob;
		public $datRepbir;
		public $strRepmai;
		public $strLassch;
		public $intSec_no;
		public $intPerios;
		public $intReceiv;


		public function __construct()
		{
			//echo "Mensaje desde el Modelo Home";
			parent::__construct();
		}


		public function GetVsection()
		{
			$sql 		= "SELECT SEC_NO,SEC_NM,NIV_NO,PARALE FROM vsection ORDER BY NIV_NO,PARALE";
			$request 	= $this->select_all($sql);
			return $request;
		}


		public function selectVsnewstd()
		{
			$sql = "SELECT  a.STD_NO,
							a.LAS_NM,
							a.FIR_NM,
							a.PERIOS,
							s.SEC_NM,
							s.PARALE
					FROM vsnewstd a
					INNER JOIN vsection s ON a.SEC_NO = s.SEC_NO
					ORDER BY a.LAS_NM,a.FIR_NM";
			$request = $this->select_all($sql);
			return $request;
		}


		public function oneVsnewstd(int $idSTD)
		{
			$this->intStd_no = $idSTD;
			$sql 		= "SELECT * FROM vsnewstd WHERE STD_NO = {$this->intStd_no}";
			$request 	= $this->select($sql);
			return $request;
		}


		public function insertVsnewstd(string $las_nm, string $fir_nm, string $addres, string $tphone, string $idtype, string $ide_no, int $stdgen, string $fecbir, string $stdmai, int $tt_who, string $fatlas, string $fatnam, string $fatadr, string $fatfon, string $fatype, string $fatced, string $fatjob, string $fatbir, string $fatmai, string $motlas, string $motnam, string $motadr, string $motfon, string $motype, string $motced, string $motjob, string $motbir, string $motmai, string $replas, string $repnam, string $repadr, string $repfon, string $retype, string $repced, string $repjob, string $repbir, string $repmai, string $lassch, int $sec_no, int $perios, int $receiv)
		{
   			$return = "";
			$this->strLas_nm = $las_nm;
			$this->strFir_nm = $fir_nm;
			$this->strAddres = $addres;
			$this->strTphone = $tphone;
			$this->strIdtype = $idtype;
			$this->strIde_no = $ide_no;
			$this->intStdgen = $stdgen;
			$this->datFecbir = $fecbir;
			$this->strStdmai = $stdmai;
			$this->intTt_who = $tt_who;
			$this->strFatlas = $fatlas;
			$this->strFatnam = $fatnam;
			$this->strFatadr = $fatadr;
			$this->strFatfon = $fatfon;
			$this->strFatype = $fatype; 
			$this->strFatced = $fatced;
			$this->strFatjob = $fatjob;
			$this->datFatbir = $fatbir;
			$this->strFatmai = $fatmai;
			$this->strMotlas = $motlas;
			$this->strMotnam = $motnam;
			$this->strMotadr = $motadr;
			$this->strMotfon = $motfon;
			$this->strMotype = $motype; 
			$this->strMotced = $motced;
			$this->strMotjob = $motjob;
			$this->datMotbir = $motbir;
			$this->strMotmai = $motmai;
			$this->strReplas = $replas;
			$this->strRepnam = $repnam;
			$this->strRepadr = $repadr;
			$this->strRepfon = $repfon;
			$this->strRetype = $retype; 
			$this->strRepced = $repced;
			$this->strRepjob = $repjob;
			$this->datRepbir = $repbir;
			$this->strRepmai = $repmai;
			$this->strLassch = $lassch;
			$this->intSec_no = $sec_no;
			$this->intPerios = $perios;
			$this->intReceiv = $receiv;

			$sql     = "SELECT * FROM vsnewstd WHERE LAS_NM = '{$this->strLas_nm}' AND FIR_NM = '{$this->strFir_nm}'";
			$request = $this->select_all($sql);
			if(empty($request))
			{
				$insert  = "INSERT INTO vsnewstd(las_nm,fir_nm,addres,tphone,idtype,ide_no,stdgen,fecbir,stdmai,tt_who,fatlas,fatnam,fatadr,fatfon,fatype,fatced,fatjob,fatbir,fatmai,motlas,motnam,motadr,motfon,motype,motced,motjob,motbir,motmai,replas,repnam,repadr,repfon,retype,repced,repjob,repbir,repmai,lassch,sec_no,perios,receiv) VALUES(?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)";
				$arrData = array($this->strLas_nm,$this->strFir_nm,$this->strAddres,$this->strTphone,$this->strIdtype,$this->strIde_no,$this->intStdgen,$this->datFecbir,$this->strStdmai,$this->intTt_who,$this->strFatlas,$this->strFatnam,$this->strFatadr,$this->strFatfon,$this->strFatype,$this->strFatced,$this->strFatjob,$this->datFatbir,$this->strFatmai,$this->strMotlas,$this->strMotnam,$this->strMotadr,$this->strMotfon,$this->strMotype,$this->strMotced,$this->strMotjob,$this->datMotbir,$this->strMotmai,$this->strReplas,$this->strRepnam,$this->strRepadr,$this->strRepfon,$this->strRetype,$this->strRepced,$this->strRepjob,$this->datRepbir,$this->strRepmai,$this->strLassch,$this->intSec_no,$this->intPerios,$this->intReceiv);
				$request_insert = $this->insert($insert,$arrData);
				$return         = $request_insert;
			}else{
				// EXISTE
				$return = -1;
			}
			return $return;		
		}


		public function updateVsnewstd(int $std_no, string $las_nm, string $fir_nm, string $addres, string $tphone, string $idtype, string $ide_no, int $stdgen, string $fecbir, string $stdmai, int $tt_who, string $fatlas, string $fatnam, string $fatadr, string $fatfon, string $fatype, string $fatced, string $fatjob, string $fatbir, string $fatmai, string $motlas, string $motnam, string $motadr, string $motfon, string $motype, string $motced, string $motjob, string $motbir, string $motmai, string $replas, string $repnam, string $repadr, string $repfon, string $retype, string $repced, string $repjob, string $repbir, string $repmai, string $lassch, int $sec_no, int $perios, int $receiv)
		{
   			$return = "";
			$this->intStd_no = $std_no;
	        $this->strLas_nm = $las_nm;
			$this->strFir_nm = $fir_nm;
			$this->strAddres = $addres;
			$this->strTphone = $tphone;
			$this->strIdtype = $idtype;
			$this->strIde_no = $ide_no;
			$this->intStdgen = $stdgen;
			$this->datFecbir = $fecbir;
			$this->strStdmai = $stdmai;
			$this->intTt_who = $tt_who;
			$this->strFatlas = $fatlas;
			$this->strFatnam = $fatnam;
			$this->strFatadr = $fatadr;
			$this->strFatfon = $fatfon;
			$this->strFatype = $fatype; 
			$this->strFatced = $fatced;
			$this->strFatjob = $fatjob;
			$this->datFatbir = $fatbir;
			$this->strFatmai = $fatmai;
			$this->strMotlas = $motlas;
			$this->strMotnam = $motnam;
			$this->strMotadr = $motadr;
			$this->strMotfon = $motfon;
			$this->strMotype = $motype; 
			$this->strMotced = $motced;
			$this->strMotjob = $motjob;
			$this->datMotbir = $motbir;
			$this->strMotmai = $motmai;
			$this->strReplas = $replas;
			$this->strRepnam = $repnam;
			$this->strRepadr = $repadr;
			$this->strRepfon = $repfon;
			$this->strRetype = $retype; 
			$this->strRepced = $repced;
			$this->strRepjob = $repjob;
			$this->datRepbir = $repbir;
			$this->strRepmai = $repmai;
			$this->strPerson = '';
			$this->strPeradr = '';
			$this->strPerfon = ''; 
			$this->intFacwho = 0;
			$this->strRazons = '';
			$this->strDirecc = '';
			$this->strTlf_no = '';
			$this->intCltype = '05'; 
			$this->strRuc_no = '';
			$this->strEmails = '';
			$this->intEstatu = 1;
			$this->strLassch = $lassch;
			$this->strRemark = '';
			$this->intSec_no = $sec_no;
			$this->intPerios = $perios;
			$this->intReceiv = $receiv;

			$sql     = "SELECT * FROM vsnewstd WHERE LAS_NM = '{$this->strLas_nm}' AND FIR_NM = '{$this->strFir_nm}' AND STD_NO != {$this->intStd_no}";
			$request = $this->select_all($sql);
			if(empty($request))
			{
				$insert  		= "UPDATE vsnewstd SET las_nm = ?, fir_nm = ?, addres = ?, tphone = ?, idtype = ?, ide_no = ?, stdgen = ?, fecbir = ?, stdmai = ?, tt_who = ?, fatlas = ?, fatnam = ?, fatadr = ?, fatfon = ?, fatype = ?, fatced = ?, fatjob = ?, fatbir = ?, fatmai = ?, motlas = ?, motnam = ?, motadr = ?, motfon = ?, motype = ?, motced = ?, motjob = ?, motbir = ?, motmai = ?, replas = ?, repnam = ?, repadr = ?, repfon = ?, retype = ?, repced = ?, repjob = ?, repbir = ?, repmai = ?, lassch = ?, sec_no = ?, perios = ?, receiv = ? WHERE STD_NO = {$this->intStd_no}";
				$arrData 		= array($this->strLas_nm,$this->strFir_nm,$this->strAddres,$this->strTphone,$this->strIdtype,$this->strIde_no,$this->intStdgen,$this->datFecbir,$this->strStdmai,$this->intTt_who,$this->strFatlas,$this->strFatnam,$this->strFatadr,$this->strFatfon,$this->strFatype,$this->strFatced,$this->strFatjob,$this->datFatbir,$this->strFatmai,$this->strMotlas,$this->strMotnam,$this->strMotadr,$this->strMotfon,$this->strMotype,$this->strMotced,$this->strMotjob,$this->datMotbir,$this->strMotmai,$this->strReplas,$this->strRepnam,$this->strRepadr,$this->strRepfon,$this->strRetype,$this->strRepced,$this->strRepjob,$this->datRepbir,$this->strRepmai,$this->strLassch,$this->intSec_no,$this->intPerios,$this->intReceiv);
				$request_insert = $this->update($insert,$arrData);
				$return         = $request_insert;

				// Inserta Estudiante Nuevo en VSTUDENT si es ADMITIDO
				$sql     = "SELECT * FROM vstudent WHERE LAS_NM = '{$this->strLas_nm}' AND FIR_NM = '{$this->strFir_nm}'";
				$request = $this->select_all($sql);
				if(empty($request) AND $this->intReceiv == 1)
				{
					$insert  		= "INSERT INTO vstudent(las_nm,fir_nm,addres,tphone,idtype,ide_no,stdgen,fecbir,stdmai,tt_who,fatlas,fatnam,fatadr,fatfon,fatype,fatced,fatjob,fatbir,fatmai,motlas,motnam,motadr,motfon,motype,motced,motjob,motbir,motmai,replas,repnam,repadr,repfon,retype,repced,repjob,repbir,repmai,person,peradr,perfon,facwho,razons,direcc,tlf_no,cltype,ruc_no,emails,estatu,lassch,remark,perios,sec_no) VALUES(?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)";
					$arrData 		= array($this->strLas_nm,$this->strFir_nm,$this->strAddres,$this->strTphone,$this->strIdtype,$this->strIde_no,$this->intStdgen,$this->datFecbir,$this->strStdmai,$this->intTt_who,$this->strFatlas,$this->strFatnam,$this->strFatadr,$this->strFatfon,$this->strFatype,$this->strFatced,$this->strFatjob,$this->datFatbir,$this->strFatmai,$this->strMotlas,$this->strMotnam,$this->strMotadr,$this->strMotfon,$this->strMotype,$this->strMotced,$this->strMotjob,$this->datMotbir,$this->strMotmai,$this->strReplas,$this->strRepnam,$this->strRepadr,$this->strRepfon,$this->strRetype,$this->strRepced,$this->strRepjob,$this->datRepbir,$this->strRepmai,$this->strPerson,$this->strPeradr,$this->strPerfon,$this->intFacwho,$this->strRazons,$this->strDirecc,$this->strTlf_no,$this->intCltype,$this->strRuc_no,$this->strEmails,$this->intEstatu,$this->strLassch,$this->strRemark,$this->intPerios,$this->intSec_no);
					$request_insert = $this->insert($insert,$arrData);
					$return         = $request_insert;
				}
			}else{
				// EXISTE
				$return = -1;
			}
			return $return;
		}
	}
