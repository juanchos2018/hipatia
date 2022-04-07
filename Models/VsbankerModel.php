 <?php

	class VsbankerModel extends Mysql
	{
		public $intBan_no;
		public $strBan_nm;
		public $strCtanum;
		public $intChe_no;
		public $intUltccl;
		public $strCta_no;


		public function __construct()
		{
			//echo "Mensaje desde el Modelo Home";
			parent::__construct();
		}


		// EXTRAE ENTIDADES BANCARIAS
		public function selectVsbanker()
		{
			$sql     = "SELECT * FROM vsbanker ORDER BY BAN_NM";
			$request = $this->select_all($sql);
			return $request;
		}


		// EXTRAE UNA ENTIDAD BANCARIA
		public function oneVsbanker(int $idBan)
		{
			$this->intBan_no = $idBan;
			$sql 		= "SELECT * FROM vsbanker WHERE BAN_NO = {$this->intBan_no}";
			$request 	= $this->select($sql);
			return $request;
		}


		// ELIMINA UNA ENTIDAD BANCARIA
		public function deleteVsbanker(int $idSec)
		{
			$this->intBan_no = $idSec;
			$sql 				= "SELECT BAN_NO FROM vsbanker WHERE BAN_NO = {$this->intBan_no}";
			$request_vsbanker	= $this->select($sql);
			if(empty($request_vsbanker))
			{
				$request = 'error';
			}else{
				$sql 				= "SELECT BAN_NO FROM vsmovban WHERE BAN_NO = {$this->intBan_no}";
				$request			= $this->select($sql);
				if(empty($request))
				{
					$sql 		= "DELETE FROM vsbanker WHERE BAN_NO = {$this->intBan_no}";
					$request 	= $this->delete($sql);
					$request 	= 'ok';
				}else{
					$request = 'error';
				}
			}
			return $request;
		}


		// INSERTA ENTIDAD BANCARIA
		public function insertVsbanker(string $ban_nm, string $ctanum, int $che_no, int $ultccl, string $cta_no)
		{
   			$return = "";
			$this->strBan_nm = $ban_nm;
			$this->strCtanum = $ctanum;
			$this->intChe_no = $che_no;
			$this->intUltccl = $ultccl;
			$this->strCta_no = $cta_no;

			// REVISA SI CUENTA ES AUXILIAR
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

			$sql 		= "SELECT * FROM vsbanker WHERE BAN_NM = '{$this->strBan_nm}' AND CTANUM = '{$this->strCtanum}'";
			$request 	= $this->select_all($sql);
			if(empty($request))
			{
				$insert         = "INSERT INTO vsbanker(ban_nm,ctanum,che_no,ultccl,cta_no) VALUES(?,?,?,?,?)";
				$arrData        = array($this->strBan_nm,$this->strCtanum,$this->intChe_no,$this->intUltccl,$this->strCta_no);
				$request_insert = $this->insert($insert,$arrData);
				$return         = $request_insert;
			}else{
				// EXISTE
				$return = -1;
			}
			return $return;
		}

		
		// ACTUALIZA ENTIDAD BANCARIA
		public function updateVsbanker(int $ban_no, string $ban_nm, string $ctanum, int $che_no, int $ultccl, string $cta_no)
		{
   			$return = "";
            $this->intBan_no = $ban_no;
            $this->strBan_nm = $ban_nm;
			$this->strCtanum = $ctanum;
			$this->intChe_no = $che_no;
			$this->intUltccl = $ultccl;
			$this->strCta_no = $cta_no;

			// REVISA SI CUENTA ES AUXILIAR
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

			$sql 		= "SELECT * FROM vsbanker WHERE BAN_NM = '{$this->strBan_nm}' AND CTANUM = '{$this->strCtanum}' AND BAN_NO != {$this->intBan_no}";
			$request 	= $this->select_all($sql);
			if(empty($request))
			{
				$insert         = "UPDATE vsbanker SET BAN_NM = ?, CTANUM = ?, CHE_NO = ?, ULTCCL = ?, CTA_NO = ? WHERE BAN_NO = {$this->intBan_no}";
				$arrData        = array($this->strBan_nm,$this->strCtanum,$this->intChe_no,$this->intUltccl,$this->strCta_no);
				$request_insert = $this->update($insert,$arrData);
				$return         = $request_insert;
			}else{
				// EXISTE
				$return = -1;
			}
			return $return;
		}
	}
