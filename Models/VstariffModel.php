 <?php

	class VstariffModel extends Mysql
	{
		public $intSec_id;
		public $intPerios;
		public $intStd_no;
		public $strPer_no;
		public $intArt_no;
		public $strRemark;
		public $intDocval;
		public $intFacval;
		public $intAboval;


		public function __construct()
		{
			//echo "Mensaje desde el Modelo Home";
			parent::__construct();
		}


		// EXTRAE CONVENIOS
        public function selectVstariff()
		{
			$sql = "SELECT  a.SEC_ID,
                            a.PERIOS,
                            a.STD_NO,
							a.PER_NO,
                            v.SUB_NM,
							a.ART_NO,
                            p.ART_NM,
                            t.LAS_NM,
                            t.FIR_NM,
                            a.DOCVAL,
                            a.FACVAL,
                            a.ABOVAL,
                            a.REMARK
                    FROM vstariff a
                    INNER JOIN vstudent t ON a.STD_NO = t.STD_NO
                    INNER JOIN vstables v ON a.PER_NO = v.SUB_NO
                    INNER JOIN vsproduc p ON a.ART_NO = p.ART_NO
                    WHERE v.TAB_NO = 'MON' 
                    ORDER BY a.PERIOS DESC,t.LAS_NM,t.FIR_NM,a.PER_NO,a.ART_NO";
			$request = $this->select_all($sql);
			return $request;
		}


		// QUERY ESTADO DE CUENTA CLIENTE
		public function getVsEstadoCuenta(int $perios, int $std_no)
		{
			$this->intPerios = $perios;
			$this->intStd_no = $std_no;

			$sql = "SELECT v.PERIOS,
			               v.STD_NO,
						   v.PER_NO,
						   v.ART_NO,
						   t.SUB_NM,
						   p.ART_NM,
			    		   e.LAS_NM,
			    		   e.FIR_NM,
			    		   e.ADDRES,
			    		   e.TPHONE,
			    		   e.STDMAI,
			    		   s.SEC_NM,
			    		   s.PARALE,
						   v.DOCTIP,
						   v.DOCSIG,
						   v.FACVAL,
						   v.ABOVAL,
						   v.DOCPTO,
						   v.DOCNUM,
						   v.FECEMI,
						   v.REMARK
			        FROM vstariff v
			        INNER JOIN vstudent e ON v.STD_NO = e.STD_NO
			        INNER JOIN vsection s ON e.SEC_NO = s.SEC_NO
			        INNER JOIN vsproduc p ON p.ART_NO = v.ART_NO
					INNER JOIN vstables t ON t.SUB_NO = v.PER_NO
			        WHERE v.PERIOS = {$this->intPerios} AND v.STD_NO = {$this->intStd_no} AND t.TAB_NO = 'MON' 
			        ORDER BY v.PER_NO";
			$request = $this->select_all($sql);
			return $request;
		}


		// QUERY INFORME CUENTAS POR COBRAR
		public function getVsstdCxc(int $perios, int $std_no, string $per_no, int $abotyp, int $reptyp)
		{
			$request = array();
			$this->intPerios = $perios;
			$this->intStd_no = $std_no;
			$this->strPer_no = $per_no;
			$this->intAbotyp = $abotyp;
			$this->intReptyp = $reptyp;

			switch($this->intReptyp)
			{
				// Cuenta por Cobrar
				case 1:
					// OBTIENE NOMBRES PRODUCTOS
					$sql = "SELECT SUB_NO,SUB_NM
							FROM vstables 
							WHERE TAB_NO = 'MON' AND ESTATU = 1 AND SUB_NO NOT IN ('000') AND SUB_NO <= '{$this->strPer_no}'
							ORDER BY SUB_NO";
					$request_head = $this->select_all($sql);

					// Acumulado
					if($this->intAbotyp == 1)
					{
						if($this->intStd_no == 0)
						{
							$where = "WHERE v.DOCTIP != 'NC' AND v.PERIOS = {$this->intPerios} AND v.PER_NO <= '{$this->strPer_no}' AND t.TAB_NO = 'MON' 
							ORDER BY s.NIV_NO,s.PARALE,e.LAS_NM,e.FIR_NM,v.PER_NO";
						}else{
							$where = "WHERE v.DOCTIP != 'NC' AND v.PERIOS = {$this->intPerios} AND v.PER_NO <= '{$this->strPer_no}' AND v.STD_NO = {$this->intStd_no} AND t.TAB_NO = 'MON' 
							ORDER BY v.PER_NO";
						}
					// Corriente
					}else{
						if($this->intStd_no == 0)
						{
							$where = "WHERE v.DOCTIP != 'NC' AND v.PERIOS = {$this->intPerios} AND v.PER_NO = '{$this->strPer_no}' AND t.TAB_NO = 'MON' 
							ORDER BY s.NIV_NO,s.PARALE,e.LAS_NM,e.FIR_NM";
						}else{
							$where = "WHERE v.DOCTIP != 'NC' AND v.PERIOS = {$this->intPerios} AND v.PER_NO = '{$this->strPer_no}' AND v.STD_NO = {$this->intStd_no} AND t.TAB_NO = 'MON'";
						}
					}
				
					$sql = "SELECT v.PERIOS,
								   v.STD_NO,
								   v.PER_NO,
								   t.SUB_NM,
								   e.LAS_NM,
								   e.FIR_NM,
								   e.REPLAS,
								   e.REPNAM,
								   e.REPFON,
								   s.SEC_NM,
								   s.SEC_NO,
								   s.PARALE,
								   s.NIV_NO,
								   v.FACVAL,
								   v.ABOVAL
							FROM vstariff v
							INNER JOIN vstables t ON t.SUB_NO = v.PER_NO
							INNER JOIN vsstdhis h ON h.STD_NO = v.STD_NO AND h.PERIOS = v.PERIOS
							INNER JOIN vstudent e ON e.STD_NO = v.STD_NO
							INNER JOIN vsection s ON s.SEC_NO = h.SEC_NO ".$where;
					$request_detail = $this->select_all($sql);
					break;

				// Recordatorio de Pago
				case 2:
					// Acumulado
					if($this->intAbotyp == 1)
					{
						if($this->intStd_no == 0)
						{
							$where = "WHERE v.DOCTIP != 'NC' AND v.PERIOS = {$this->intPerios} AND v.PER_NO <= '{$this->strPer_no}' AND (v.FACVAL - v.ABOVAL) > 0 AND t.TAB_NO = 'MON'  
							ORDER BY s.NIV_NO,s.PARALE,e.LAS_NM,e.FIR_NM,v.PER_NO";
						}else{
							$where = "WHERE v.DOCTIP != 'NC' AND v.PERIOS = {$this->intPerios} AND v.PER_NO <= '{$this->strPer_no}' AND v.STD_NO = {$this->intStd_no} AND (v.FACVAL - v.ABOVAL) > 0 AND t.TAB_NO = 'MON' 
							ORDER BY v.PER_NO";
						} 
					// Corriente
					}else{
						if($this->intStd_no == 0)
						{
							$where = "WHERE v.DOCTIP != 'NC' AND v.PERIOS = {$this->intPerios} AND v.PER_NO = '{$this->strPer_no}' AND (v.FACVAL - v.ABOVAL) > 0 AND t.TAB_NO = 'MON' 
							ORDER BY s.NIV_NO,s.PARALE,e.LAS_NM,e.FIR_NM";
						}else{
							$where = "WHERE v.DOCTIP != 'NC' AND v.PERIOS = {$this->intPerios} AND v.PER_NO = '{$this->strPer_no}' AND v.STD_NO = {$this->intStd_no} AND (v.FACVAL - v.ABOVAL) > 0 AND t.TAB_NO = 'MON'";
						}
					}
		
					// Obtiene nombres de productos para cabecera de tabla
					$sql = "SELECT SUB_NO,SUB_NM
							FROM vstables 
							WHERE TAB_NO = 'MON' AND ESTATU = 1 AND SUB_NO NOT IN ('000') AND SUB_NO <= '{$this->strPer_no}'
							ORDER BY SUB_NO";
					$request_head = $this->select_all($sql);
		
					$sql = "SELECT v.PERIOS,
								   v.STD_NO,
								   v.PER_NO,
								   t.SUB_NM,
								   e.LAS_NM,
								   e.FIR_NM,
								   e.REPLAS,
								   e.REPNAM,
								   p.ART_NM,
								   s.SEC_NM,
								   s.PARALE,
								   s.NIV_NO,
								   v.FACVAL - v.ABOVAL AS SALDO
						   	FROM vstariff v
							INNER JOIN vstables t ON t.SUB_NO = v.PER_NO
							INNER JOIN vsstdhis h ON h.STD_NO = v.STD_NO AND h.PERIOS = v.PERIOS
							INNER JOIN vstudent e ON e.STD_NO = v.STD_NO
							INNER JOIN vsproduc p ON p.ART_NO = v.ART_NO
							INNER JOIN vsection s ON s.SEC_NO = h.SEC_NO ".$where;
					$request_detail = $this->select_all($sql);
					break;

				// Recaudación Bancaria
				case 3:
					// Acumulado
					if($this->intAbotyp == 1)
					{
						if($this->intStd_no == 0)
						{
							$where = "WHERE v.DOCTIP != 'NC' AND v.PERIOS = {$this->intPerios} AND v.PER_NO <= '{$this->strPer_no}' GROUP BY v.STD_NO";
						}else{
							$where = "WHERE v.DOCTIP != 'NC' AND v.PERIOS = {$this->intPerios} AND v.PER_NO <= '{$this->strPer_no}' AND v.STD_NO = {$this->intStd_no}";
						}
					// Corriente
					}else{
						if($this->intStd_no == 0)
						{
							$where = "WHERE v.DOCTIP != 'NC' AND v.PERIOS = {$this->intPerios} AND v.PER_NO = '{$this->strPer_no}' GROUP BY v.STD_NO";
						}else{
							$where = "WHERE v.DOCTIP != 'NC' AND v.PERIOS = {$this->intPerios} AND v.PER_NO = '{$this->strPer_no}' AND v.STD_NO = {$this->intStd_no}";
						}
					}
		
					// Obtiene nombre de Periodo
					$sql = "SELECT SUB_NO,SUB_NM
							FROM vstables 
							WHERE TAB_NO = 'MON' AND SUB_NO = '{$this->strPer_no}'";
					$request_head = $this->select($sql);
		
					$sql = "SELECT 	SUM(v.FACVAL - v.ABOVAL) AS SALDO,
					     			v.PERIOS,
								   	v.STD_NO,
									e.IDTYPE,
									e.IDE_NO,
									e.LAS_NM,
									e.FIR_NM
						   	FROM vstariff v
							INNER JOIN vsstdhis h ON h.STD_NO = v.STD_NO AND h.PERIOS = v.PERIOS
							INNER JOIN vstudent e ON e.STD_NO = v.STD_NO ".$where;
					$request_detail = $this->select_all($sql);
					break;
			}

			// Prepara la respuesta para el controlador
			$request = array('producto' => $request_head,'detalle' => $request_detail,'reptyp' => $this->intReptyp);
			return $request;
		}


		// QUERY GENERAR CUENTAS POR COBRAR
		public function getVsgenCxc(int $perios, int $std_no)
		{
			$return			 = "";
			$this->intPerios = $perios;
			$this->intStd_no = $std_no;

			$sql     			= "SELECT PERIOS FROM vsdefaul";
			$request_vsdefaul	= $this->select($sql);
			$this->intPeriox 	= $request_vsdefaul['PERIOS'];

			if($this->intStd_no == 0)
			{
				$sql     			= "SELECT STD_NO,SEC_NO,ESTATU FROM vstudent WHERE PERIOS = {$this->intPerios}";
				$request_vstudent	= $this->select_all($sql);	
			}else{
				$sql     			= "SELECT STD_NO,SEC_NO,ESTATU FROM vstudent WHERE PERIOS = {$this->intPerios} AND STD_NO = {$this->intStd_no}";
				$request_vstudent	= $this->select($sql);	
			}

			for ($k = 0; $k < count($request_vstudent); $k++) 
			{
				$this->intStd_no 	= $request_vstudent[$k]['STD_NO'];
				$this->intSec_no 	= $request_vstudent[$k]['SEC_NO'];
				$this->intEstatu 	= $request_vstudent[$k]['ESTATU'];

				// GENERA CUENTA POR COBRAR ESTUDIANTE estatus MATRICULADO
				if($this->intPeriox == $this->intPerios AND $this->intEstatu == 2)
				{
					$sql     			= "SELECT * FROM vssecval WHERE PERIOS = {$this->intPerios} AND SEC_NO = {$this->intSec_no}";
					$request_vssecval 	= $this->select_all($sql);

					for ($i = 0; $i < count($request_vssecval); $i++) 
					{
						$this->intArt_no = $request_vssecval[$i]['ART_NO'];
						$this->intDocval = $request_vssecval[$i]['VALORS'];
						$this->intFacval = $request_vssecval[$i]['VALORS'];
						$this->intAboval = 0;
						$this->strRemark = '';

						$sql     			= "SELECT * FROM vsproduc WHERE ART_NO = {$this->intArt_no}";
						$request_vsproduc 	= $this->select($sql);
						if(!empty($request_vsproduc))
						{
							for ($j = 0; $j <= 13; $j++) 
							{
								$jj 		= str_pad($j, 3, "0", STR_PAD_LEFT);
								$codPer_no 	= 'PER'.$jj;
								
								$this->strPer_no = $request_vsproduc[$codPer_no];
								if($this->strPer_no == "on")
								{
									$this->strPer_no 	= $jj;
									$sql 				= "SELECT * FROM vstariff WHERE PERIOS = {$this->intPerios} AND STD_NO = {$this->intStd_no} AND PER_NO = '{$this->strPer_no}' AND ART_NO = {$this->intArt_no}";
									$request_vstariff 	= $this->select($sql);
									if(empty($request_vstariff))
									{
										$insert         = "INSERT INTO vstariff(perios,std_no,per_no,art_no,remark,docval,facval,aboval,docsig,doctip,docpto,docnum) VALUES(?,?,?,?,?,?,?,?,?,?,?,?)";
										$arrData        = array($this->intPerios,$this->intStd_no,$this->strPer_no,$this->intArt_no,$this->strRemark,$this->intDocval,$this->intFacval,$this->intAboval,1,'','',0);
										$request_insert = $this->insert($insert,$arrData);
										$return 		= $request_insert;
									}else{
										$update         = "UPDATE vstariff SET docval = ? WHERE PERIOS = {$this->intPerios} AND STD_NO = {$this->intStd_no} AND PER_NO = '{$this->strPer_no}' AND ART_NO = {$this->intArt_no} AND ABOVAL = 0";
										$arrData        = array($this->intDocval);
										$request_update = $this->update($update,$arrData);
										$return         = $request_update;			
									}
								}
							}
						}
					}
				}
			}
			return $return;
		}


		// OBTIENE UN CONVENIO
		public function oneVstariff(int $idSTD)
		{
			$this->intSec_id = $idSTD;
			$where = "WHERE v.SEC_ID = {$this->intSec_id}";
			$sql = "SELECT 	v.SEC_ID,
							v.PERIOS,
			               	v.STD_NO,
						   	v.PER_NO,
							v.ART_NO,
							v.REMARK,
			    		   	e.LAS_NM,
			    		   	e.FIR_NM,
							e.SEC_NO,
			    		   	s.SEC_NM,
			    		   	s.PARALE,
						   	s.NIV_NO,
							v.DOCVAL,
						   	v.FACVAL,
						   	v.ABOVAL
			        FROM vstariff v
			        INNER JOIN vstudent e ON e.STD_NO = v.STD_NO
			        INNER JOIN vsection s ON s.SEC_NO = e.SEC_NO ".$where;
			$request = $this->select($sql);
			return $request;
		}


		// INSERTA UN CONVENIO
		public function insertVstariff(int $perios, int $std_no, string $per_no, int $art_no, string $remark, float $docval, float $facval, float $aboval)
		{
   			$return = "";
		    $this->intPerios = $perios; 
		    $this->intStd_no = $std_no;
			$this->strPer_no = $per_no;
		    $this->intArt_no = $art_no;
			$this->strRemark = $remark;
		    $this->intDocval = $docval;
		    $this->intFacval = $facval;
		    $this->intAboval = $aboval;

			// Valida que la TARIFA no sea MAYOR al PRECIO DE LISTA
			if($this->intFacval > $this->intDocval or $this->intFacval < 0)
			{
				// VALOR INCORRECTO
				$return = -2;
				return $return;
			}

			$sql 				= "SELECT * FROM vstariff WHERE PERIOS = {$this->intPerios} AND STD_NO = {$this->intStd_no} AND PER_NO = '{$this->strPer_no}' AND ART_NO = {$this->intArt_no}";
			$request_vstariff 	= $this->select($sql);
			if(empty($request_vstariff))
			{
				$insert         = "INSERT INTO vstariff(perios,std_no,per_no,art_no,remark,docval,facval,aboval) VALUES(?,?,?,?,?,?,?,?)";
				$arrData        = array($this->intPerios,$this->intStd_no,$this->strPer_no,$this->intArt_no,$this->strRemark,$this->intDocval,$this->intFacval,$this->intAboval);
				$request_insert = $this->insert($insert,$arrData);
				$return         = $request_insert;
			}else{
				// EXISTE
				$return = -1;
			}
			return $return;
		}


		// ACTUALIZA UN CONVENIO
		public function updateVstariff(int $sec_id, int $perios, int $std_no, string $per_no, int $art_no, string $remark, float $docval, float $facval, float $aboval, string $replic)
		{
   			$return = "";
            $this->intSec_id = $sec_id;
            $this->intPerios = $perios; 
		    $this->intStd_no = $std_no;
			$this->strPer_no = $per_no;
		    $this->intArt_no = $art_no;
			$this->strRemark = $remark;
		    $this->intDocval = $docval;
		    $this->intFacval = $facval;
		    $this->intAboval = $aboval;
		    $this->intReplic = $replic;

			// Valida que TARIFA no sea MAYOR a PRECIO DE LISTA
			if($this->intFacval > $this->intDocval or $this->intFacval < $this->intAboval)
			{
				// VALOR INCORRECTO
				$return = -2;
				return $return;
			}

			// Replica condición en todos los Periodos
			if($this->intReplic == 'on')
			{
				$sql     			= "SELECT * FROM vsproduc WHERE ART_NO = {$this->intArt_no}";
				$request_vsproduc 	= $this->select($sql);

				for ($j = 0; $j <= 13; $j++) 
				{
					$jj = str_pad($j, 3, "0", STR_PAD_LEFT);
					$codPer_no = 'PER'.$jj;
						
					$this->strPer_no = $request_vsproduc[$codPer_no];
					if($this->strPer_no == "on")
					{
						$this->strPer_no = $jj;
						$sql 				= "SELECT * FROM vstariff WHERE ABOVAL <= {$this->intFacval} AND PERIOS = {$this->intPerios} AND STD_NO = {$this->intStd_no} AND PER_NO = '{$this->strPer_no}' AND ART_NO = {$this->intArt_no}";
						$request_vstariff 	= $this->select($sql);
						if(!empty($request_vstariff))
						{
							$update         = "UPDATE vstariff SET remark = ?, facval = ? WHERE PERIOS = {$this->intPerios} AND STD_NO = {$this->intStd_no} AND PER_NO = '{$this->strPer_no}' AND ART_NO = {$this->intArt_no}";
							$arrData        = array($this->strRemark,$this->intFacval);
							$request_update = $this->update($update,$arrData);
							$return         = $request_update;
						}
					}
				}
			}else{
				$update         = "UPDATE vstariff SET remark = ?, facval = ? WHERE SEC_ID = {$this->intSec_id}";
				$arrData        = array($this->strRemark,$this->intFacval);
				$request_update = $this->update($update,$arrData);
				$return         = $request_update;
			}
			return $return;
		}
    }
