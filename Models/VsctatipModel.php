 <?php

	class VsctatipModel extends Mysql
	{
        public $intSec_id;
		public $strTab_no;
		public $strCtadeb;
		public $strCtacre;
		public $strValors;
		public $strEntity;
		public $intCtafil;
		public $intCtamov;
		public $intFactor;


		public function __construct()
		{
			//echo "Mensaje desde el Modelo Home";
			parent::__construct();
		}


		// EXTRAE PARAMETRO CONTABLE
		public function selectVsctatip(string $cta_no)
		{
			$this->strCta_no = $cta_no;
			if(empty($this->strCta_no))
			{
				$request = '';
			}else{
				$sql 		= "SELECT CTA_NO,CTA_NM FROM vsacount WHERE CTA_NO = '{$this->strCta_no}'";
				$request 	= $this->select($sql);
				$request 	= $request['CTA_NO'].' - '.$request['CTA_NM'];
			}
            return $request;
        }


		// EXTRAE PARAMETROS CONTABLES
		public function selectVsctatips()
		{
            $sql = "SELECT	a.SEC_ID,
                            s.TAB_NM,
                            a.SUB_NO,
                            a.SUB_NM,
                            a.CTADEB,
                            a.CTACRE,
                            a.VALORS,
							a.CTAMOV,
							a.FACTOR,
                            a.ENTITY
                    FROM vsctatip a
                    INNER JOIN vstabhea s ON s.TAB_NO = a.TAB_NO
                    ORDER BY s.TAB_NM, a.SUB_NO, a.CTAMOV DESC";
            $request = $this->select_all($sql);
            return $request;
        }


		// EXTRAE UN PARAMETRO CONTABLE
		public function oneVsctatip(int $idSec)
		{
			$this->intSec_id = $idSec;
			$sql 		= "SELECT * FROM vsctatip WHERE SEC_ID = {$this->intSec_id}";
			$request 	= $this->select($sql);
			return $request;
		}


		// ELIMINA UN PARAMETRO CONTABLE
		public function deleteVsctatip(int $idSec)
		{
			$this->intSec_id = $idSec;
			$sql 		= "DELETE FROM vsctatip WHERE SEC_ID = {$this->intSec_id}";
			$request 	= $this->delete($sql);
			if($request)
			{
				$request = 'ok';
			}else{
				$request = 'error';
			}
			return $request;
		}


		// INSERTA UN PARAMETRO CONTABLE
		public function insertVsctatip(string $tab_no, string $ctadeb, string $ctacre, string $valors, string $entity, int $ctafil, int $ctamov, float $factor)
		{
            $return = "";
			$this->strTab_no = $tab_no;
			$this->strCtadeb = $ctadeb;
			$this->strCtacre = $ctacre;
			$this->strValors = $valors;
			$this->strEntity = $entity;
			$this->intCtafil = $ctafil;
			$this->intCtamov = $ctamov;
			$this->intFactor = $factor;

			// REVISA SI CUENTA ES AUXILIAR
			if(!empty($this->strCtadeb))
			{
				$sql 				= "SELECT CTATIP FROM vsacount WHERE CTA_NO = '{$this->strCtadeb}'";
				$request_vsacount 	= $this->select($sql);
				if($request_vsacount['CTATIP'] == 1)
				{
					// CUENTA INVALIDA
					$return = -2;
					return $return;
				}	
			}

			// REVISA SI CUENTA ES AUXILIAR
			if(!empty($this->strCtacre))
			{
				$sql 				= "SELECT CTATIP FROM vsacount WHERE CTA_NO = '{$this->strCtacre}'";
				$request_vsacount 	= $this->select($sql);
				if($request_vsacount['CTATIP'] == 1)
				{
					// CUENTA INVALIDA
					$return = -2;
					return $return;
				}	
			}

			$insert         = "INSERT INTO vsctatip(tab_no,ctadeb,ctacre,valors,entity,ctafil,ctamov,factor) VALUES(?,?,?,?,?,?,?,?)";
	    	$arrData        = array($this->strTab_no,$this->strCtadeb,$this->strCtacre,$this->strValors,$this->strEntity,$this->intCtafil,$this->intCtamov,$this->intFactor);
		    $request_insert = $this->insert($insert,$arrData);
		    $return         = $request_insert;
		    return $return;
        }


		// ACTUALIZA UN PARAMETRO CONTABLE
		public function updateVsctatip(int $sec_id, string $tab_no, string $ctadeb, string $ctacre, string $valors, string $entity, int $ctafil, int $ctamov, float $factor)
		{
            $return = "";
			$this->intSec_id = $sec_id;
			$this->strTab_no = $tab_no;
			$this->strCtadeb = $ctadeb;
			$this->strCtacre = $ctacre;
			$this->strValors = $valors;
			$this->strEntity = $entity;
			$this->intCtafil = $ctafil;
			$this->intCtamov = $ctamov;
			$this->intFactor = $factor;

			// REVISA SI CUENTA ES AUXILIAR
			if(!empty($this->strCtadeb))
			{
				$sql 				= "SELECT CTATIP FROM vsacount WHERE CTA_NO = '{$this->strCtadeb}'";
				$request_vsacount 	= $this->select($sql);
				if($request_vsacount['CTATIP'] == 1)
				{
					// CUENTA INVALIDA
					$return = -2;
					return $return;
				}	
			}

			// REVISA SI CUENTA ES AUXILIAR
			if(!empty($this->strCtacre))
			{
				$sql 				= "SELECT CTATIP FROM vsacount WHERE CTA_NO = '{$this->strCtacre}'";
				$request_vsacount 	= $this->select($sql);
				if($request_vsacount['CTATIP'] == 1)
				{
					// CUENTA INVALIDA
					$return = -2;
					return $return;
				}	
			}

			$insert         = "UPDATE vsctatip SET tab_no = ?, ctadeb = ?, ctacre = ?, valors = ?, entity = ?, ctafil = ?, ctamov = ?, factor = ? WHERE SEC_ID = {$this->intSec_id}";
	    	$arrData        = array($this->strTab_no,$this->strCtadeb,$this->strCtacre,$this->strValors,$this->strEntity,$this->intCtafil,$this->intCtamov,$this->intFactor);
			$request_insert = $this->update($insert,$arrData);
			$return         = $request_insert;
			return $return; 
		}
	}
