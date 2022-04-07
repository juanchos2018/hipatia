 <?php

	class VsprovidModel extends Mysql
	{
		public $intPrv_no;
		public $strLas_nm;
		public $strFir_nm;
		public $strAddres;
		public $strTphone;
		public $strIdtype;
		public $strIde_no;
		public $strEmails;
		public $strBenefi;
		public $intAut_no;
		public $datFecaut;
		public $strAnt_no;
		public $strCta_no;
		public $strGas_no;
		public $intEstatu;


		public function __construct()
		{
			//echo "Mensaje desde el Modelo Home";
			parent::__construct();
		}


		// EXTRAE PROVEEDORES
		public function selectVsprovid()
		{
			$sql     = "SELECT * FROM vsprovid ORDER BY LAS_NM,FIR_NM";
			$request = $this->select_all($sql);
			return $request;
		}


		// EXTRAE UN PROVEEDOR
		public function oneVsprovid(int $Prv)
		{
			$this->intPrv_no = $Prv;
			$sql 		= "SELECT * FROM vsprovid WHERE PRV_NO = {$this->intPrv_no}";
			$request 	= $this->select($sql);
			return $request;
		}


		// ELIMINA UN PROVEEDOR
		public function deleteVsprovid(int $idSec)
		{
			$this->intPrv_no = $idSec;
			$sql 				= "SELECT PRV_NO FROM vsprovid WHERE PRV_NO = {$this->intPrv_no}";
			$request_vsprovid	= $this->select($sql);
			if(empty($request_vsprovid))
			{
				$request = 'error';
			}else{
				$sql 				= "SELECT PRV_NO FROM vsmovcxp WHERE PRV_NO = {$this->intPrv_no}";
				$request			= $this->select($sql);
				if(empty($request))
				{
					$sql 		= "DELETE FROM vsprovid WHERE PRV_NO = {$this->intPrv_no}";
					$request 	= $this->delete($sql);
					$request 	= 'ok';
				}else{
					$request = 'error';
				}
			}
			return $request;
		}


		// INSERTA UN PROVEEDOR
		public function insertVsprovid(string $las_nm, string $fir_nm, string $addres, string $tphone, string $idtype, string $ide_no, string $emails, string $benefi, int $aut_no, string $fecaut, string $ant_no, string $cta_no, string $gas_no, int $estatu)
		{
   			$return = "";
			$this->strLas_nm = $las_nm;
			$this->strFir_nm = $fir_nm;
			$this->strAddres = $addres;
			$this->strTphone = $tphone;
			$this->strIdtype = $idtype;
			$this->strIde_no = $ide_no;
			$this->strEmails = $emails;
			$this->strBenefi = $benefi;
			$this->intAut_no = $aut_no;
			$this->datFecaut = $fecaut;
			$this->strAnt_no = $ant_no;
			$this->strCta_no = $cta_no;
			$this->strGas_no = $gas_no;
			$this->intEstatu = $estatu;
   
			// REVISA SI CUENTA ES AUXILIAR
			if(!empty($this->strAnt_no))
			{
				$sql 				= "SELECT CTATIP FROM vsacount WHERE CTA_NO = '{$this->strAnt_no}'";
				$request_vsacount 	= $this->select($sql);
				if($request_vsacount['CTATIP'] == 1)
				{
					// CUENTA INVALIDA
					$return = -2;
					return $return;
				}	
			}

			if(!empty($this->strCta_no))
			{
				$sql 				= "SELECT CTATIP FROM vsacount WHERE CTA_NO = '{$this->strCta_no}'";
				$request_vsacount 	= $this->select($sql);
				if($request_vsacount['CTATIP'] == 1)
				{
					// CUENTA INVALIDA
					$return = -2;
					return $return;
				}	
			}

			if(!empty($this->strGas_no))
			{
				$sql 				= "SELECT CTATIP FROM vsacount WHERE CTA_NO = '{$this->strGas_no}'";
				$request_vsacount 	= $this->select($sql);
				if($request_vsacount['CTATIP'] == 1)
				{
					// CUENTA INVALIDA
					$return = -2;
					return $return;
				}	
			}

			$sql 		= "SELECT * FROM vsprovid WHERE (LAS_NM = '{$this->strLas_nm}' AND FIR_NM = '{$this->strFir_nm}') OR IDE_NO = '{$this->strRuc_no}'";
			$request 	= $this->select_all($sql);
			if(empty($request))
			{
				$insert         = "INSERT INTO vsprovid(las_nm,fir_nm,addres,tphone,idtype,ide_no,emails,benefi,aut_no,fecaut,ant_no,cta_no,gas_no,estatu) VALUES(?,?,?,?,?,?,?,?,?,?,?,?,?,?)";
				$arrData        = array($this->strLas_nm,$this->strFir_nm,$this->strAddres,$this->strTphone,$this->strIdtype,$this->strIde_no,$this->strEmails,$this->strBenefi,$this->intAut_no,$this->datFecaut,$this->strAnt_no,$this->strCta_no,$this->strGas_no,$this->intEstatu);
				$request_insert = $this->insert($insert,$arrData);
				$return         = $request_insert;
			}else{
				// EXISTE
				$return = -1;
		    }
			return $return;
		}


		// ACTUALIZA UN PROVEEDOR
		public function updateVsprovid(int $prv_no, string $las_nm, string $fir_nm, string $addres, string $tphone, string $idtype, string $ide_no, string $emails, string $benefi, int $aut_no, string $fecaut, string $ant_no, string $cta_no, string $gas_no, int $estatu)
		{
   			$return = "";
			$this->intPrv_no = $prv_no;
			$this->strLas_nm = $las_nm;
			$this->strFir_nm = $fir_nm;
			$this->strAddres = $addres;
			$this->strTphone = $tphone;
			$this->strIdtype = $idtype;
			$this->strIde_no = $ide_no;
			$this->strEmails = $emails;
			$this->strBenefi = $benefi;
			$this->intAut_no = $aut_no;
			$this->datFecaut = $fecaut;
			$this->strAnt_no = $ant_no;
			$this->strCta_no = $cta_no;
			$this->strGas_no = $gas_no;
			$this->intEstatu = $estatu;
   
			// REVISA SI CUENTA ES AUXILIAR
			if(!empty($this->strAnt_no))
			{
				$sql 				= "SELECT CTATIP FROM vsacount WHERE CTA_NO = '{$this->strAnt_no}'";
				$request_vsacount 	= $this->select($sql);
				if($request_vsacount['CTATIP'] == 1)
				{
					// CUENTA INVALIDA
					$return = -2;
					return $return;
				}	
			}

			if(!empty($this->strCta_no))
			{
				$sql 				= "SELECT CTATIP FROM vsacount WHERE CTA_NO = '{$this->strCta_no}'";
				$request_vsacount 	= $this->select($sql);
				if($request_vsacount['CTATIP'] == 1)
				{
					// CUENTA INVALIDA
					$return = -2;
					return $return;
				}	
			}

			if(!empty($this->strGas_no))
			{
				$sql 				= "SELECT CTATIP FROM vsacount WHERE CTA_NO = '{$this->strGas_no}'";
				$request_vsacount 	= $this->select($sql);
				if($request_vsacount['CTATIP'] == 1)
				{
					// CUENTA INVALIDA
					$return = -2;
					return $return;
				}	
			}

			$sql 		= "SELECT * FROM vsprovid WHERE ((LAS_NM = '{$this->strLas_nm}' AND FIR_NM = '{$this->strFir_nm}') OR IDE_NO = '{$this->strIde_no}') AND PRV_NO != {$this->intPrv_no}";
			$request 	= $this->select_all($sql);
			if(empty($request))
			{
				$insert         = "UPDATE vsprovid SET las_nm = ?, fir_nm = ?, addres = ?, tphone = ?, idtype = ?, ide_no = ?, emails = ?, benefi = ?, aut_no = ?, fecaut = ?, ant_no = ?, cta_no = ?, gas_no = ?, estatu = ?  WHERE PRV_NO = {$this->intPrv_no}";
				$arrData        = array($this->strLas_nm,$this->strFir_nm,$this->strAddres,$this->strTphone,$this->strIdtype,$this->strIde_no,$this->strEmails,$this->strBenefi,$this->intAut_no,$this->datFecaut,$this->strAnt_no,$this->strCta_no,$this->strGas_no,$this->intEstatu);
				$request_insert = $this->update($insert,$arrData);
				$return         = $request_insert;
			}else{
				// EXISTE
				$return = -1;
		    }
			return $return;
		}
	}
