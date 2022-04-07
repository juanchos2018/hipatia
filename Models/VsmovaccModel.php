 <?php

	class VsmovaccModel extends Mysql
	{
        public $intSec_id;
		public $strFecreg;
		public $strMovtip;
		public $strMovpto;
		public $intMov_no;
		public $strDocapl;
		public $strDocpto;
        public $intDocnum;
		public $strRemark;


		public function __construct()
		{
			//echo "Mensaje desde el Modelo Home";
			parent::__construct();
		}


		// EXTRAE DIARIOS
		public function selectVsmovacc()
		{
            $sql = "SELECT	a.SEC_ID,
                            a.FECREG,
                            t.TAB_NM,
							a.MOVTIP,
							a.MOVPTO,
                            a.MOV_NO,
                            a.REMARK,
							a.VALORS,
							a.SIGNOS,
							a.CTA_NO,
                            s.CTA_NM
		            FROM vsmovacc a
                    INNER JOIN vstabhea t ON t.TAB_NO = a.MOVTIP
        		    INNER JOIN vsacount s ON s.CTA_NO = a.CTA_NO
            		ORDER BY a.SEC_ID DESC";
            $request = $this->select_all($sql);
            return $request;
        }


		// EXTRAE UN DIARIO
		public function oneVsmovacc(int $idSec)
		{
			$this->intSec_id = $idSec;
			$sql 		= "SELECT * FROM vsmovacc WHERE SEC_ID = {$this->intSec_id}";
			$request 	= $this->select($sql);
			return $request;
		}


		// QUERY INFORME BALANCES CONTABLES
		public function getVsPrnAcc(string $cta_no, int $reptyp, int $abotyp, string $fecdes, string $fechas)
		{
			$request = array();
			$this->strCta_no = $cta_no;
			$this->intReptyp = $reptyp;
			$this->intAbotyp = $abotyp;
			$this->datFecdes = $fecdes;
			$this->datFechas = $fechas;

			switch($this->intReptyp)
			{
				// DIARIO GENERAL
				case 1:
					if($this->strCta_no == 0)
					{
						$where = "WHERE v.FECREG BETWEEN '{$this->datFecdes}' AND '{$this->datFechas}' ORDER BY v.FECREG,v.MOVTIP,v.MOVPTO,v.MOV_NO,v.SIGNOS DESC";
					}else{
						$where = "WHERE v.CTA_NO = '{$this->strCta_no}' AND v.FECREG BETWEEN '{$this->datFecdes}' AND '{$this->datFechas}' ORDER BY v.FECREG,v.MOVTIP,v.MOVPTO,v.MOV_NO,v.SIGNOS DESC";
					}
		
					$sql = "SELECT 	v.MOVTIP,
									v.MOVPTO,
									v.MOV_NO,
									v.FECREG,
									v.CTA_NO,
								   	v.VALORS,
								   	v.SIGNOS,
									v.REMARK,
									t.TAB_NM,
								   	c.CTA_NM
							FROM vsmovacc v
							INNER JOIN vstabhea t ON t.TAB_NO = v.MOVTIP
							INNER JOIN vsacount c ON c.CTA_NO = v.CTA_NO ".$where;

					$request_detail = $this->select_all($sql);
					break;

				// MAYOR
				case 2:
					if($this->strCta_no == 0)
					{
						$where = "WHERE v.FECREG BETWEEN '{$this->datFecdes}' AND '{$this->datFechas}' ORDER BY v.CTA_NO,v.FECREG";
					}else{
						$where = "WHERE v.CTA_NO = '{$this->strCta_no}' AND v.FECREG BETWEEN '{$this->datFecdes}' AND '{$this->datFechas}' ORDER BY v.FECREG";
					}
		
					$sql = "SELECT 	v.MOVTIP,
									v.MOV_NO,
									v.FECREG,
									v.CTA_NO,
								   	v.DOCAPL,
								   	v.DOCNUM,
								   	v.VALORS,
								   	v.SIGNOS,
									v.REMARK,
								   	c.CTA_NM
							FROM vsmovacc v
							INNER JOIN vsacount c ON c.CTA_NO = v.CTA_NO ".$where;

					$request_detail = $this->select_all($sql);
					break;

				// BALANCE DE COMPROBACION
				case 3:
					break;

				// ESTADO DE SITUACION FINANCIERA
				case 4:
					break;

				// ESTADO DE RESULTADO
				case 5:
					break;
			}

			// Prepara la respuesta para el controlador
			$request = array('detalle' => $request_detail,'reptyp' => $this->intReptyp);
			return $request;
		}


		// ELIMINA UN DIARIO
		public function deleteVsmovacc(int $idSec)
		{
			$this->intSec_id = $idSec;
			$sql 				= "SELECT * FROM vsmovacc WHERE SEC_ID = {$this->intSec_id}";
			$request_vsmovacc 	= $this->select($sql);
		   	if(!empty($request_vsmovacc))
			{
				$this->strMovtip = $request_vsmovacc['MOVTIP'];
				$this->intMov_no = $request_vsmovacc['MOV_NO'];
	
				$sql 				= "DELETE FROM vsmovacc WHERE MOVTIP = '{$this->strMovtip}' AND MOV_NO = {$this->intMov_no}";
				$request_vsmovacc 	= $this->delete($sql);
				$request = 'ok';
			}else{
				$request = 'error';
			}
			return $request;
		}


		// INSERTA UN DIARIO
		public function insertVsmovacc(string $movtip, string $movpto, int $mov_no, string $cta_no, float $docval, string $fecreg, string $remark)
		{
            $return = "";
			$this->strMovtip = $movtip;
			$this->strMovpto = $movpto;
			$this->intMov_no = $mov_no;
			$this->strCta_no = $cta_no;
			$this->strDocval = $docval;
			$this->datFecreg = $fecreg;
			$this->strRemark = $remark;
			$this->intSuc_no = '';

			if($this->strMovtip == 'CD')
    		{
   			}else{
				// DIARIO NO PERMITIDO
    			$return = -2;
				return $return;
	    	}


			/* EXTRAE SECUENCIAL DE DIARIO CONTABLE */
            $sql 		= "SELECT * FROM vssecuen WHERE MOVTIP = '{$this->strMovtip}'";
			$request 	= $this->select($sql);
			if(empty($request))
			{
                $this->intMov_no = 1;
                $insert          = "INSERT INTO vssecuen(movtip,mov_no,suc_no) VALUES(?,?,?)";
				$arrData         = array($this->strMovtip,$this->intMov_no,$this->intSuc_no);
				$request_insert  = $this->insert($insert,$arrData);
            }else{
				$this->intMov_no = $request['MOV_NO'] + 1;
				$insert          = "UPDATE vssecuen SET mov_no = ? WHERE MOVTIP = '{$this->strMovtip}'";
				$arrData         = array($this->intMov_no);
				$request_insert  = $this->insert($insert,$arrData);
            }

	    	$sql 		= "SELECT * FROM vsmovacc WHERE MOVTIP = '{$this->strMovtip}' AND MOV_NO = {$this->intMov_no}";
		    $request 	= $this->select($sql);
   			if(empty($request))
    		{
	    		$insert         = "INSERT INTO vsmovacc(movtip,movpto,mov_no,cta_no,valors,fecreg,remark) VALUES(?,?,?,?,?,?,?)";
		    	$arrData        = array($this->strMovtip,$this->strMovpto,$this->intMov_no,$this->strCta_no,$this->intDocval,$this->strFecreg,$this->strRemark);
			    $request_insert = $this->insert($insert,$arrData);
			    $return         = $request_insert;
   			}else{
				// EXISTE
    			$return = -1;
	    	}
		    return $return;
        }


		// ACTUALIZA UN DIARIO
		public function updateVsmovacc(int $sec_id, string $movtip, string $movpto, int $mov_no, string $cta_no, float $docval, string $fecreg, string $remark)
		{
            $return = "";
			$this->intSec_id = $sec_id;
			$this->strMovtip = $movtip;
			$this->strMovpto = $movpto;
			$this->intMov_no = $mov_no;
			$this->strCta_no = $cta_no;
			$this->strDocval = $docval;
			$this->datFecreg = $fecreg;
			$this->strRemark = $remark;
			$this->intSuc_no = '';

			$insert         = "UPDATE vsmovacc SET docapl = ?, docpto = ?, docnum = ?, remark = ? WHERE SEC_ID = {$this->intSec_id}";
			$arrData        = array($this->strDocapl,$this->strDocpto,$this->intDocnum,$this->strRemark);
			$request_insert = $this->update($insert,$arrData);
			$return         = $request_insert;
			return $return; 
		}
	}
