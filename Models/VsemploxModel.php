 <?php

	class VsemploxModel extends Mysql
	{
		public $intEmp_no;
		public $strLas_nm;
		public $strFir_nm;
		public $strAddres;
		public $strTphone;
		public $strParroq;
		public $strCiudad;
		public $strProvin;
		public $strPaises;
		public $strIdtype;
		public $strIde_no;
		public $intEmpgen;
		public $intEstado;
		public $datFecbir;
		public $datFecing;
		public $strEmpmai;
		public $intBan_no;
		public $intCtatyp;
		public $strCtaban;
		public $intServic;
		public $intMagist;
		public $strSeccod;
		public $strPoscod;
		public $intEmprlg;
		public $intCargas;
		public $intEstatu;
		public $intProfil;
		public $intCat_no;
		public $strTitulo;
		public $strRemark;
		public $intSalary;


		public function __construct()
		{
			//echo "Mensaje desde el Modelo Home";
			parent::__construct();
		}


		// QUERY PERSONAL
		public function selectVsemplox()
		{
			$usu = $_SESSION['userData']['USU_NO'];
			$rol = $_SESSION['userData']['rol_id'];
			switch($rol)
			{
				case 1:  // System Manager
					$sql  = "SELECT * FROM vsemplox ORDER BY LAS_NM,FIR_NM";
					break;
				case 5:  // Docente
					$sql  = "SELECT * FROM vsemplox WHERE EMP_NO = $usu ORDER BY LAS_NM,FIR_NM";
					break;
				default:
					$sql  = "SELECT * FROM vsemplox WHERE ESTATU = 1 ORDER BY LAS_NM,FIR_NM";
					break;
			}
			$request = $this->select_all($sql);
			return $request;
		}


		// EXTRAE UN PERSONAL
		public function oneVsemplox(int $Emp)
		{
			$this->intEmp_no = $Emp;
			$sql 		= "SELECT * FROM vsemplox WHERE EMP_NO = {$this->intEmp_no}";
			$request 	= $this->select($sql);
			return $request;
		}


		// INSERTA UN PERSONAL
		public function insertVsemplox(string $las_nm, string $fir_nm, string $addres, string $tphone, string $parroq, string $ciudad, string $provin, string $paises, string $idtype, string $ide_no, int $empgen, int $estado, string $fecbir, string $fecing, string $empmai, int $ctatyp, string $ctaban, int $servic, int $magist, string $seccod, string $poscod, int $emprlg, int $cargas, int $estatu, int $profil, int $cat_no, string $titulo, string $remark, float $salary)
		{
   			$return = "";
			$this->strLas_nm = $las_nm;
			$this->strFir_nm = $fir_nm;
			$this->strAddres = $addres;
			$this->strTphone = $tphone;
			$this->strParroq = $parroq;
			$this->strCiudad = $ciudad;
			$this->strProvin = $provin;
			$this->strPaises = $paises;
			$this->strIdtype = $idtype;
			$this->strIde_no = $ide_no;
			$this->intEmpgen = $empgen;
			$this->intEstado = $estado;
			$this->datFecbir = $fecbir;
			$this->datFecing = $fecing;
			$this->strEmpmai = $empmai;
			$this->intCtatyp = $ctatyp;
			$this->strCtaban = $ctaban;
			$this->intServic = $servic;
			$this->intMagist = $magist;
			$this->strSeccod = $seccod;
			$this->strPoscod = $poscod;
			$this->intEmprlg = $emprlg;
			$this->intCargas = $cargas;
			$this->intEstatu = $estatu;
			$this->intProfil = $profil;
			$this->intCat_no = $cat_no;
			$this->strTitulo = $titulo;
			$this->strRemark = $remark;
			$this->intSalary = $salary;
   
			$sql 		= "SELECT * FROM vsemplox WHERE LAS_NM = '{$this->strLas_nm}' AND FIR_NM = '{$this->strFir_nm}'";
			$request 	= $this->select_all($sql);
			if(empty($request))
			{
				$insert         = "INSERT INTO vsemplox(las_nm,fir_nm,addres,tphone,parroq,ciudad,provin,paises,idtype,ide_no,empgen,estado,fecbir,fecing,empmai,ctatyp,ctaban,servic,magist,seccod,poscod,emprlg,cargas,estatu,profil,cat_no,titulo,remark,salary) VALUES(?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)";
				$arrData        = array($this->strLas_nm,$this->strFir_nm,$this->strAddres,$this->strTphone,$this->strParroq,$this->strCiudad,$this->strProvin,$this->strPaises,$this->strIdtype,$this->strIde_no,$this->intEmpgen,$this->intEstado,$this->datFecbir,$this->datFecing,$this->strEmpmai,$this->intCtatyp,$this->strCtaban,$this->intServic,$this->intMagist,$this->strSeccod,$this->strPoscod,$this->intEmprlg,$this->intCargas,$this->intEstatu,$this->intProfil,$this->intCat_no,$this->strTitulo,$this->strRemark,$this->intSalary);
				$request_insert = $this->insert($insert,$arrData);
				$return         = $request_insert;
			}else{
				// EXISTE
				$return = -1;
		    }
			return $return;
		}


		// ACTUALIZA UN PERSONAL
		public function updateVsemplox(int $emp_no, string $las_nm, string $fir_nm, string $addres, string $tphone, string $parroq, string $ciudad, string $provin, string $paises, string $idtype, string $ide_no, int $empgen, int $estado, string $fecbir, string $fecing, string $empmai, int $ctatyp, string $ctaban, int $servic, int $magist, string $seccod, string $poscod, int $emprlg, int $cargas, int $estatu, int $profil, int $cat_no, string $titulo, string $remark, float $salary)
		{
   			$return = "";
			$this->intEmp_no = $emp_no;
			$this->strLas_nm = $las_nm;
			$this->strFir_nm = $fir_nm;
			$this->strAddres = $addres;
			$this->strTphone = $tphone;
			$this->strParroq = $parroq;
			$this->strCiudad = $ciudad;
			$this->strProvin = $provin;
			$this->strPaises = $paises;
			$this->strIdtype = $idtype;
			$this->strIde_no = $ide_no;
			$this->intEmpgen = $empgen;
			$this->intEstado = $estado;
			$this->datFecbir = $fecbir;
			$this->datFecing = $fecing;
			$this->strEmpmai = $empmai;
			$this->intCtatyp = $ctatyp;
			$this->strCtaban = $ctaban;
			$this->intServic = $servic;
			$this->intMagist = $magist;
			$this->strSeccod = $seccod;
			$this->strPoscod = $poscod;
			$this->intEmprlg = $emprlg;
			$this->intCargas = $cargas;
			$this->intEstatu = $estatu;
			$this->intProfil = $profil;
			$this->intCat_no = $cat_no;
			$this->strTitulo = $titulo;
			$this->strRemark = $remark;
			$this->intSalary = $salary;
   
			$sql 		= "SELECT * FROM vsemplox WHERE LAS_NM = '{$this->strLas_nm}' AND FIR_NM = '{$this->strFir_nm}' AND EMP_NO != {$this->intEmp_no}";
			$request 	= $this->select_all($sql);
			if(empty($request))
			{
				$insert         = "UPDATE vsemplox SET las_nm = ?, fir_nm = ?, addres = ?, tphone = ?, parroq = ?, ciudad = ?, provin = ?, paises = ?, idtype = ?, ide_no = ?, empgen = ?, estado = ?, fecbir = ?, fecing = ?, empmai = ?, ctatyp = ?, ctaban = ?, servic = ?, magist = ?, seccod = ?, poscod = ?, emprlg = ?, cargas = ?, estatu = ?, profil = ?, cat_no = ?, titulo = ?, remark = ?, salary = ? WHERE EMP_NO = {$this->intEmp_no}";
				$arrData        = array($this->strLas_nm,$this->strFir_nm,$this->strAddres,$this->strTphone,$this->strParroq,$this->strCiudad,$this->strProvin,$this->strPaises,$this->strIdtype,$this->strIde_no,$this->intEmpgen,$this->intEstado,$this->datFecbir,$this->datFecing,$this->strEmpmai,$this->intCtatyp,$this->strCtaban,$this->intServic,$this->intMagist,$this->strSeccod,$this->strPoscod,$this->intEmprlg,$this->intCargas,$this->intEstatu,$this->intProfil,$this->intCat_no,$this->strTitulo,$this->strRemark,$this->intSalary);
				$request_insert = $this->update($insert,$arrData);
				$return         = $request_insert;
			}else{
				// EXISTE
				$return = -1;
		    }
			return $return;
		}
	}
