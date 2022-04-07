 <?php

	class VsacountModel extends Mysql
	{
		public $intSec_id;
		public $strCta_no;
		public $strCta_nm;
		public $intCtatip;
		public $intSignos;


		public function __construct()
		{
			//echo "Mensaje desde el Modelo Home";
			parent::__construct();
		}

		
		// EXTRAE CUENTAS
		public function selectVsacount()
		{
			$sql     = "SELECT * FROM vsacount ORDER BY CTA_NO";
			$request = $this->select_all($sql);
			return $request;
		}


		// EXTRAE UNA CUENTA
		public function oneVsacount(int $idCta)
		{
			$this->intSec_id = $idCta;
			$sql 		= "SELECT * FROM vsacount WHERE SEC_ID = {$this->intSec_id}";
			$request 	= $this->select($sql);
			return $request;
		}


		// ELIMINA UNA CUENTA CONTABLE
		public function deleteVsacount(int $idSec)
		{
			$this->intSec_id = $idSec;
			$sql 				= "SELECT CTA_NO FROM vsacount WHERE SEC_ID = {$this->intSec_id}";
			$request_vsacount	= $this->select($sql);
			if(empty($request_vsacount))
			{
				$request = 'error';
			}else{
				$this->strCta_no	= $request_vsacount['CTA_NO'];
				$sql 				= "SELECT CTA_NO FROM vsmovacc WHERE CTA_NO = {$this->strCta_no}";
				$request			= $this->select($sql);
				if(empty($request))
				{
					$sql 		= "DELETE FROM vsacount WHERE SEC_ID = {$this->intSec_id}";
					$request 	= $this->delete($sql);
					$request 	= 'ok';
				}else{
					$request = 'error';
				}
			}
			return $request;
		}


		// INSERTA UNA CUENTA
		public function insertVsacount(string $cta_no, string $cta_nm, int $ctatip, int $signos, string $ctasup)
		{
   			$return = "";
			$this->strCta_no = $cta_no;
			$this->intCtatip = $ctatip;
			$this->intSignos = $signos;
			$this->strCtasup = $ctasup;

			if($this->intCtatip == 1)
			{
				$this->strCta_nm = strtoupper($cta_nm);
			}else{
				$this->strCta_nm = ucwords(strtolower($cta_nm));
			}

			$sql 		= "SELECT * FROM vsacount WHERE CTA_NO = '{$this->strCta_no}'";
			$request 	= $this->select($sql);
			if(empty($request))
			{
				$insert         = "INSERT INTO vsacount(cta_no,cta_nm,ctatip,signos,ctasup) VALUES(?,?,?,?,?)";
				$arrData        = array($this->strCta_no,$this->strCta_nm,$this->intCtatip,$this->intSignos,$this->strCtasup);
				$request_insert = $this->insert($insert,$arrData);
				$return         = $request_insert;
			}else{
				// EXISTE
				$return = -1;
			}
			return $return;
		}


		// ACTUALIZA UNA CUENTA
		public function updateVsacount(int $sec_id, string $cta_no, string $cta_nm, int $ctatip, int $signos, string $ctasup)
		{
   			$return = "";
            $this->intSec_id = $sec_id;
            $this->strCta_no = $cta_no;
			$this->intCtatip = $ctatip;
			$this->intSignos = $signos;
			$this->strCtasup = $ctasup;

			if($this->intCtatip == 1)
			{
				$this->strCta_nm = strtoupper($cta_nm);
			}else{
				$this->strCta_nm = ucwords(strtolower($cta_nm));
			}

			$sql 		= "SELECT * FROM vsacount WHERE CTA_NO = '{$this->strCta_no}' AND SEC_ID != {$this->intSec_id}";
			$request 	= $this->select_all($sql);
			if(empty($request))
			{
				$insert         = "UPDATE vsacount SET CTA_NM = ?, CTASUP = ? WHERE SEC_ID = {$this->intSec_id}";
				$arrData        = array($this->strCta_nm,$this->strCtasup);
				$request_insert = $this->update($insert,$arrData);
				$return         = $request_insert;
			}else{
				// EXISTE
				$return = -1;
			}
			return $return;
		}
	}
