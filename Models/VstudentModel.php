 <?php

	class VstudentModel extends Mysql
	{
		public $intStd_no;
		public $strPer_no;
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
		public $strPerson;
		public $strPeradr;
		public $strPerfon;
		public $intFacwho;
		public $strRazons;
		public $strDirecc;
		public $strTlf_no;
		public $strCltype;
		public $strRuc_no;
		public $strEmails;
		public $intEstatu;
		public $strLassch;
		public $strRemark;
		public $intPerios;
		public $intSec_no;


		public function __construct()
		{
			//echo "Mensaje desde el Modelo Home";
			parent::__construct();
		}


		// OBTIENE TODOS LOS ESTUDIANTES
		public function selectVstudent()
		{
			$usu = $_SESSION['userData']['USU_NO'];
			$rol = $_SESSION['userData']['rol_id'];
			$ide = $_SESSION['idUser'];
			switch($rol)
			{
				case 5:  // Docente
					$sql = "SELECT a.STD_NO,
								   a.SEC_NO,
								   a.PERIOS,
								   a.LAS_NM,
								   a.FIR_NM,
								   a.IDTYPE,
								   a.IDE_NO,
								   a.ESTATU,
								   s.SEC_NM,
								   s.PARALE
					FROM vstudent a
					INNER JOIN vsection s ON s.SEC_NO = a.SEC_NO
					INNER JOIN vssecmat t ON t.SEC_NO = a.SEC_NO AND t.EMP_NO = $usu
					ORDER BY a.LAS_NM,a.FIR_NM";
					break;
				case 7:  // Estudiante
						$sql = "SELECT a.STD_NO,
						               a.PERIOS,
				    			       a.LAS_NM,
			    				       a.FIR_NM,
									   a.IDTYPE,
									   a.IDE_NO,
						               a.ESTATU,
		            				   s.SEC_NM,
									   s.PARALE
				        FROM vstudent a
			    	    INNER JOIN vsection s ON s.SEC_NO = a.SEC_NO
			        	WHERE a.STD_NO = $usu
						ORDER BY a.LAS_NM,a.FIR_NM";
						break;
				case 8:  // Representante
						$sql = "SELECT a.STD_NO,
									   a.PERIOS,
									   a.LAS_NM,
									   a.FIR_NM,
									   a.IDTYPE,
									   a.IDE_NO,
									   a.ESTATU,
									   s.SEC_NM,
									   s.PARALE
						FROM vstudent a
						INNER JOIN vsection s ON s.SEC_NO = a.SEC_NO
						WHERE a.REPCED = $ide
						ORDER BY a.LAS_NM,a.FIR_NM";
						break;
				default:
						$sql = "SELECT  a.STD_NO,
										a.PERIOS,
										a.LAS_NM,
										a.FIR_NM,
										a.IDTYPE,
									    a.IDE_NO,
										a.ESTATU,
										s.SEC_NM,
										s.PARALE
						FROM vstudent a
						INNER JOIN vsection s ON s.SEC_NO = a.SEC_NO
						ORDER BY a.LAS_NM,a.FIR_NM";
						break;
			}
			$request = $this->select_all($sql);
			return $request;
		}


		// OBTIENE DATA PARA PROMOVER UN ESTUDIANTE AL SIGUIENTE CURSO LECTIVO
		public function getStdPromot(int $perios, int $std_no, int $sec_no)
		{
			$this->intPerios = $perios;
			$this->intStd_no = $std_no;
			$this->intSec_no = $sec_no;

			// OBTIENE PERIODO LECTIVO ACTUAL
			$sql 				= "SELECT PERIOS FROM vsdefaul";
			$request_vsdefaul 	= $this->select($sql);
			if(empty($request_vsdefaul) or $request_vsdefaul['PERIOS'] <= $this->intPerios)
			{
				return -1;
			}else{
				$this->intNewper = $request_vsdefaul['PERIOS'];
			}

			// OBTIENE CURSO SUPERIOR
			$sql 				= "SELECT SEC_N2 FROM vsection WHERE SEC_NO = {$this->intSec_no}";
			$request_vsection 	= $this->select($sql);
			if(empty($request_vsection))
			{
				$this->intSec_n2 = 0;
			}else{
				$this->intSec_n2 = $request_vsection['SEC_N2'];
			}

			// DETERMINA SI ESTUDIANTE SE QUEDA A REMEDIAL
			$sql = "SELECT a.PROFIN
			        FROM vsmatstd a
       			    INNER JOIN vsmatter m ON m.MAT_NO = a.MAT_NO
		            WHERE a.STD_NO = {$this->intStd_no}
					AND a.PERIOS = {$this->intPerios}
                    AND m.REGIME = 1
   			        AND m.CALIFI = 1
					AND a.PROFIN > 0
					AND a.PROFIN < 7";

			$request = $this->select_all($sql);
			if(empty($request))
			{
				// ESTUDIANTE APRUEBA CURSO LECTIVO
				$sql = "SELECT STD_NO as codeStd,truncate(avg(a.PROFIN),2) as promedio
	        			FROM vsmatstd a
	   	                INNER JOIN vsmatter m ON m.MAT_NO = a.MAT_NO
    		            WHERE a.STD_NO = {$this->intStd_no}
						AND a.PERIOS = {$this->intPerios}
	           	        AND m.REGIME = 1
    		    	    AND m.CALIFI = 1
						AND a.PROFIN >= 7";

				$arrPuntajes 	 = $this->select($sql);
				$this->intProptj = 0;
					
				if($arrPuntajes['promedio'] != "")
				{
					$this->intProptj = $arrPuntajes['promedio'];			
				} 	

				// ACTUALIZA PERIODO Y SECCION DE ESTUDIANTE SI APRUEBA CURSO LECTIVO
				if($this->intProptj > 0)
				{
					$update  		= "UPDATE vstudent SET perios = ?, sec_no = ? WHERE STD_NO = {$this->intStd_no}";
					$arrData 		= array($this->intNewper,$this->intSec_n2);
					$request_update = $this->update($update,$arrData);
					$return 		= $request_update;

					$sql     			= "SELECT * FROM vsstdhis WHERE PERIOS = {$this->intNewper} AND STD_NO = {$this->intStd_no}";
					$request_vsstdhis 	= $this->select($sql);
					if(empty($request_vsstdhis))
					{
						// Inserta Historico
						$insert  		= "INSERT INTO vsstdhis(perios,std_no,sec_no) VALUES(?,?,?)";
						$arrData 		= array($this->intNewper,$this->intStd_no,$this->intSec_n2);
						$request_insert = $this->insert($insert,$arrData);
					}else{
						// Actualiza Historico
						$update  		= "UPDATE vsstdhis SET sec_no = ? WHERE PERIOS = {$this->intNewper} AND STD_NO = {$this->intStd_no}";
						$arrData 		= array($this->intSec_n2);
						$request_update = $this->update($update,$arrData);
					}
					return $return;
				}else{
					return -2;
				}
			}else{
				return -2;
			}
		}


		// INFORME ESTUDIANTES
		public function getVsstdPrn(int $perios, int $sec_no, int $reptyp, int $orders)
		{
			$this->intPerios = $perios;
			$this->intSec_no = $sec_no;
			$this->intReptyp = $reptyp;
			$this->intOrders = $orders;

			if($this->intOrders == 1)
			{
				$repord = "ORDER BY s.NIV_NO,s.PARALE,e.LAS_NM,e.FIR_NM";
			}else{
				$repord = "ORDER BY s.NIV_NO,s.PARALE,e.FECBIR";
			}

			if(empty($this->intSec_no))
			{
				$where = "WHERE v.PERIOS = {$this->intPerios} ".$repord;
			}else{
				$where = "WHERE v.PERIOS = {$this->intPerios} AND v.SEC_NO = {$this->intSec_no} ".$repord;
			}
			$sql = "SELECT v.STD_NO,
			               v.PERIOS,
			               v.SEC_NO,
						   v.MATNUM,
						   v.FOLNUM,
						   v.FECMAT,
			    		   e.LAS_NM,
			    		   e.FIR_NM,
						   e.IDE_NO,
						   e.ADDRES,
						   e.TPHONE,
						   e.STDMAI,
						   e.STDGEN,
						   e.FECBIR,
						   e.LASSCH,
						   e.FATLAS,
						   e.FATNAM,
						   e.FATCED,
						   e.FATADR,
						   e.FATFON,
						   e.FATMAI,
						   e.FATJOB,
						   e.MOTLAS,
						   e.MOTNAM,
						   e.MOTCED,
						   e.MOTADR,
						   e.MOTFON,
						   e.MOTMAI,
						   e.MOTJOB,
						   e.REPLAS,
						   e.REPNAM,
						   e.REPCED,
						   e.REPADR,
						   e.REPFON,
						   e.REPMAI,
						   e.REPJOB,
			    		   s.SEC_NM,
			    		   s.PARALE
			        FROM vsstdhis v
			        INNER JOIN vstudent e ON e.STD_NO = v.STD_NO
			        INNER JOIN vsection s ON s.SEC_NO = v.SEC_NO ".$where;
			$request = $this->select_all($sql);
			return $request;
		}

		
		// GENERA MATRIZ DE CALIFICACIONES
		public function getStdCal(int $perios)
		{
			$return = "";
			$this->intPerios  	= $perios;
			$sql     			= "SELECT STD_NO,SEC_NO,ESTATU FROM vstudent WHERE PERIOS = {$this->intPerios} ORDER BY SEC_NO";
			$request_vstudent 	= $this->select_all($sql);

			for ($j = 0; $j < count($request_vstudent); $j++) 
			{
				if($request_vstudent[$j]['ESTATU'] == 2)
				{
					$this->intStd_no 	= $request_vstudent[$j]['STD_NO'];
					$this->intSec_no 	= $request_vstudent[$j]['SEC_NO'];

					$sql 				= "SELECT * FROM vssecmat WHERE PERIOS = {$this->intPerios} AND SEC_NO = {$this->intSec_no} ORDER BY SEC_NO,MAT_NO";
					$request_vssecmat 	= $this->select_all($sql);

					for ($i = 0; $i < count($request_vssecmat); $i++) 
					{
						$this->intMat_no = $request_vssecmat[$i]['MAT_NO'];
						$this->intEmp_no = $request_vssecmat[$i]['EMP_NO'];

						$sql				= "SELECT * FROM vsmatstd WHERE PERIOS = {$this->intPerios} AND STD_NO = {$this->intStd_no} AND MAT_NO = {$this->intMat_no}";
						$request_vsmatstd 	= $this->select($sql);
						if(empty($request_vsmatstd))
						{
							$insert         = "INSERT INTO vsmatstd(perios,std_no,mat_no,sec_no,emp_no,q1p1pr,q1p2pr,q1p3pr,q1p4pr,q2p1pr,q2p2pr,q2p3pr,q2p4pr,q1_pro,q2_pro,profin) VALUES(?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)";
							$arrData        = array($this->intPerios,$this->intStd_no,$this->intMat_no,$this->intSec_no,$this->intEmp_no,0,0,0,0,0,0,0,0,0,0,0);
							$request_insert = $this->insert($insert,$arrData);
							$return         = $request_insert;
						}
					}
				}
			}
			return $return;
		}

		
		// OBTIENE DATA PARA LA IMPRESION DE ACTA DE MATRICULA
		public function getStdAct(int $std_no)
		{
			$request = array();
			$this->intStd_no 	= $std_no;
			$sql 				= "SELECT * FROM vsdefaul";
			$request_empresa 	= $this->select($sql);

			$sql = "SELECT v.LAS_NM,v.FIR_NM,v.ADDRES,v.TPHONE,v.FECBIR,v.IDE_NO,v.STDMAI,
						   v.FATLAS,v.FATNAM,v.FATCED,v.FATADR,v.FATJOB,v.FATFON,v.FATMAI,
						   v.MOTLAS,v.MOTNAM,v.MOTCED,v.MOTADR,v.MOTJOB,v.MOTFON,v.MOTMAI,
						   v.REPLAS,v.REPNAM,v.REPCED,v.REPADR,v.REPJOB,v.REPFON,v.REPMAI,
						   v.LASSCH,v.REMARK,v.PERIOS,v.MATNUM,v.FOLNUM,v.FECMAT,s.SEC_NM,s.PARALE
					FROM vstudent v 
					INNER JOIN vsection s ON s.SEC_NO = v.SEC_NO 
					WHERE v.STD_NO = {$this->intStd_no}";
            $request_alumnos = $this->select($sql);

            $request = array('empresa' => $request_empresa,'alumnos' => $request_alumnos);
			return $request; 
		}


		// OBTIENE DATA PARA LA IMPRESION DE CONVENIO DE SERVICIOS EDUCATIVOS
		public function getStdCon(int $std_no)
		{
			$request = array();
			$this->intStd_no 	= $std_no;
			$sql 				= "SELECT * FROM vsdefaul";
			$request_empresa 	= $this->select($sql);

			$sql = "SELECT v.LAS_NM,v.FIR_NM,v.ADDRES,v.TPHONE,v.FECBIR,v.IDE_NO,v.STDMAI,v.FATLAS,v.FATNAM,v.FATCED,v.FATADR,
						   v.FATJOB,v.FATFON,v.MOTLAS,v.MOTNAM,v.MOTCED,v.MOTADR,v.MOTJOB,v.MOTFON,v.REPLAS,v.REPNAM,v.REPCED,
						   v.REPADR,v.REPJOB,v.REPFON,v.LASSCH,v.REMARK,v.PERIOS,v.MATNUM,v.FOLNUM,v.FECMAT,s.SEC_NM,s.PARALE
					FROM vstudent v 
					INNER JOIN vsection s ON s.SEC_NO = v.SEC_NO 
					WHERE v.STD_NO = {$this->intStd_no}";
            $request_alumnos = $this->select($sql);

            $request = array('empresa' => $request_empresa,'alumnos' => $request_alumnos);
			return $request; 
		}


		// OBTIENE UN ESTUDIANTE
		public function oneVstudent(int $idSTD)
		{
			$this->intStd_no = $idSTD;
			$sql 		= "SELECT * FROM vstudent WHERE STD_NO = {$this->intStd_no}";
			$request 	= $this->select($sql);
			return $request;
		}


		// ELIMINA UN ESTUDIANTE
		public function deleteVstudent(int $idSec)
		{
			$this->intStd_no 	= $idSec;
			$sql 				= "SELECT STD_NO FROM vstudent WHERE STD_NO = {$this->intStd_no}";
			$request_vstudent	= $this->select($sql);
			if(empty($request_vstudent))
			{
				$request = 'error';
			}else{
				$sql 				= "SELECT STD_NO FROM vsmatstd WHERE STD_NO = {$this->intStd_no}";
				$request			= $this->select($sql);
				if(empty($request))
				{
					$sql 		= "DELETE FROM vstudent WHERE STD_NO = {$this->intStd_no}";
					$request 	= $this->delete($sql);
					$request 	= 'ok';
				}else{
					$request = 'error';
				}
			}
			return $request;
		}


		// INSERTA UN ESTUDIANTE
		public function insertVstudent(string $las_nm, string $fir_nm, string $addres, string $tphone, string $idtype, string $ide_no, int $stdgen, string $fecbir, string $stdmai, int $tt_who, string $fatlas, string $fatnam, string $fatadr, string $fatfon, string $fatype, string $fatced, string $fatjob, string $fatbir, string $fatmai, string $motlas, string $motnam, string $motadr, string $motfon, string $motype, string $motced, string $motjob, string $motbir, string $motmai, string $replas, string $repnam, string $repadr, string $repfon, string $retype, string $repced, string $repjob, string $repbir, string $repmai, string $person, string $peradr, string $perfon, int $facwho, string $razons, string $direcc, string $tlf_no, string $cltype, string $ruc_no, string $emails, int $estatu, string $lassch, string $remark, int $perios, int $sec_no, int $matnum, int $folnum, string $fecmat)
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
			$this->strPerson = $person;
			$this->strPeradr = $peradr;
			$this->strPerfon = $perfon; 
			$this->intFacwho = $facwho;
			$this->strRazons = $razons;
			$this->strDirecc = $direcc;
			$this->strTlf_no = $tlf_no;
			$this->strCltype = $cltype; 
			$this->strRuc_no = $ruc_no;
			$this->strEmails = $emails;
			$this->intEstatu = $estatu;
			$this->strLassch = $lassch;
			$this->strRemark = $remark;
			$this->intPerios = $perios;
			$this->intSec_no = $sec_no;
			$this->intMatnum = $matnum;
			$this->intFolnum = $folnum;
			$this->datFecmat = $fecmat;

			$sql     			= "SELECT * FROM vstudent WHERE LAS_NM = '{$this->strLas_nm}' AND FIR_NM = '{$this->strFir_nm}'";
			$request_vstudent 	= $this->select_all($sql);
			if(empty($request_vstudent))
			{
				$insert  		= "INSERT INTO vstudent(las_nm,fir_nm,addres,tphone,idtype,ide_no,stdgen,fecbir,stdmai,tt_who,fatlas,fatnam,fatadr,fatfon,fatype,fatced,fatjob,fatbir,fatmai,motlas,motnam,motadr,motfon,motype,motced,motjob,motbir,motmai,replas,repnam,repadr,repfon,retype,repced,repjob,repbir,repmai,person,peradr,perfon,facwho,razons,direcc,tlf_no,cltype,ruc_no,emails,estatu,lassch,remark,perios,sec_no,matnum,folnum,fecmat) VALUES(?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)";
				$arrData 		= array($this->strLas_nm,$this->strFir_nm,$this->strAddres,$this->strTphone,$this->strIdtype,$this->strIde_no,$this->intStdgen,$this->datFecbir,$this->strStdmai,$this->intTt_who,$this->strFatlas,$this->strFatnam,$this->strFatadr,$this->strFatfon,$this->strFatype,$this->strFatced,$this->strFatjob,$this->datFatbir,$this->strFatmai,$this->strMotlas,$this->strMotnam,$this->strMotadr,$this->strMotfon,$this->strMotype,$this->strMotced,$this->strMotjob,$this->datMotbir,$this->strMotmai,$this->strReplas,$this->strRepnam,$this->strRepadr,$this->strRepfon,$this->strRetype,$this->strRepced,$this->strRepjob,$this->datRepbir,$this->strRepmai,$this->strPerson,$this->strPeradr,$this->strPerfon,$this->intFacwho,$this->strRazons,$this->strDirecc,$this->strTlf_no,$this->strCltype,$this->strRuc_no,$this->strEmails,$this->intEstatu,$this->strLassch,$this->strRemark,$this->intPerios,$this->intSec_no,$this->intMatnum,$this->intFolnum,$this->datFecmat);
				$request_insert = $this->insert($insert,$arrData);
				$return         = $request_insert;

				// Genera Malla Curricular del Estudiante en año lectivo
				if($this->intEstatu == 2)
				{
					$sql     			= "SELECT * FROM vssecmat WHERE PERIOS = {$this->intPerios} AND SEC_NO = {$this->intSec_no}";
					$request_vssecmat 	= $this->select_all($sql);

					for ($i = 0; $i < count($request_vssecmat); $i++) 
					{
						$this->intMat_no = $request_vssecmat[$i]['MAT_NO'];
						$this->intEmp_no = $request_vssecmat[$i]['EMP_NO'];

						$sql 				= "SELECT * FROM vsmatstd WHERE PERIOS = {$this->intPerios} AND STD_NO = {$this->intStd_no} AND MAT_NO = {$this->intMat_no}";
						$request_vsmatstd 	= $this->select($sql);
						if(empty($request_vsmatstd))
						{
							$insert         = "INSERT INTO vsmatstd(perios,std_no,mat_no,sec_no,emp_no,profin) VALUES(?,?,?,?,?,?)";
							$arrData        = array($this->intPerios,$this->intStd_no,$this->intMat_no,$this->intSec_no,$this->intEmp_no,0);
							$request_insert = $this->insert($insert,$arrData);
						}
					}
				}
			}else{
				// EXISTE
				$return = -1;
			}
			return $return;			
		}


		// ACTUALIZA UN ESTUDIANTE
		public function updateVstudent(int $std_no, string $las_nm, string $fir_nm, string $addres, string $tphone, string $idtype, string $ide_no, int $stdgen, string $fecbir, string $stdmai, int $tt_who, string $fatlas, string $fatnam, string $fatadr, string $fatfon, string $fatype, string $fatced, string $fatjob, string $fatbir, string $fatmai, string $motlas, string $motnam, string $motadr, string $motfon, string $motype, string $motced, string $motjob, string $motbir, string $motmai, string $replas, string $repnam, string $repadr, string $repfon, string $retype, string $repced, string $repjob, string $repbir, string $repmai, string $person, string $peradr, string $perfon, int $facwho, string $razons, string $direcc, string $tlf_no, string $cltype, string $ruc_no, string $emails, int $estatu, string $lassch, string $remark, int $perios, int $sec_no, int $matnum, int $folnum, string $fecmat)
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
			$this->strPerson = $person;
			$this->strPeradr = $peradr;
			$this->strPerfon = $perfon; 
			$this->intFacwho = $facwho;
			$this->strRazons = $razons;
			$this->strDirecc = $direcc;
			$this->strTlf_no = $tlf_no;
			$this->strCltype = $cltype; 
			$this->strRuc_no = $ruc_no;
			$this->strEmails = $emails;
			$this->intEstatu = $estatu;
			$this->strLassch = $lassch;
			$this->strRemark = $remark;
			$this->intPerios = $perios;
			$this->intSec_no = $sec_no;
			$this->intMatnum = $matnum;
			$this->intFolnum = $folnum;
			$this->datFecmat = $fecmat;

			// Obtiene Numeros de Matricula y Folio siempre y cuando ESTUDIANTE tenga estatus MATRICULADO
			$sql     			= "SELECT PERIOS FROM vsdefaul";
			$request 			= $this->select($sql);
			$this->intPeriox 	= $request['PERIOS'];

			if($this->intPeriox == $this->intPerios AND $this->intEstatu == 2 AND $this->intMatnum == 0)
			{
				$sql     			= "SELECT MATNUM,FOLNUM FROM vsdefaul";
				$request 			= $this->select($sql);
				$this->intMatnum 	= $request['MATNUM'] + 1;
				$this->intFolnum 	= $request['FOLNUM'] + 1;

				$insert  		= "UPDATE vsdefaul SET matnum = ?, folnum = ?";
				$arrData 		= array($this->intMatnum,$this->intFolnum);
				$request_insert = $this->update($insert,$arrData);
			}

			$sql     = "SELECT * FROM vsstdhis WHERE PERIOS = {$this->intPerios} AND STD_NO = {$this->intStd_no}";
			$request = $this->select($sql);
			if(empty($request))
			{
				// Inserta Historico de Matricula y Folio
				$insert  		= "INSERT INTO vsstdhis(perios,std_no,matnum,folnum,fecmat,sec_no,estatu) VALUES(?,?,?,?,?,?,?)";
				$arrData 		= array($this->intPerios,$this->intStd_no,$this->intMatnum,$this->intFolnum,$this->datFecmat,$this->intSec_no,$this->intEstatu);
				$request_insert = $this->insert($insert,$arrData);
			}else{
				// Actualiza Historico de Matricula y Folio
				$insert  		= "UPDATE vsstdhis SET perios = ?, std_no = ?, matnum = ?, folnum = ?, fecmat = ?, sec_no = ?, estatu = ? WHERE PERIOS = {$this->intPerios} AND STD_NO = {$this->intStd_no}";
				$arrData 		= array($this->intPerios,$this->intStd_no,$this->intMatnum,$this->intFolnum,$this->datFecmat,$this->intSec_no,$this->intEstatu);
				$request_insert = $this->update($insert,$arrData);
			}

			
			// Actualiza VSTUDENT
			$sql     			= "SELECT * FROM vstudent WHERE LAS_NM = '{$this->strLas_nm}' AND FIR_NM = '{$this->strFir_nm}' AND STD_NO != {$this->intStd_no}";
			$request_vstudent 	= $this->select_all($sql);
			if(empty($request_vstudent))
			{
				$insert  		= "UPDATE vstudent SET las_nm = ?, fir_nm = ?, addres = ?, tphone = ?, idtype = ?, ide_no = ?, stdgen = ?, fecbir = ?, stdmai = ?, tt_who = ?, fatlas = ?, fatnam = ?, fatadr = ?, fatfon = ?, fatype = ?, fatced = ?, fatjob = ?, fatbir = ?, fatmai = ?, motlas = ?, motnam = ?, motadr = ?, motfon = ?, motype = ?, motced = ?, motjob = ?, motbir = ?, motmai = ?, replas = ?, repnam = ?, repadr = ?, repfon = ?, retype = ?, repced = ?, repjob = ?, repbir = ?, repmai = ?, person = ?, peradr = ?, perfon = ?, facwho = ?, razons = ?, direcc = ?, tlf_no = ?, cltype = ?, ruc_no = ?, emails = ?, estatu = ?, lassch = ?, remark = ?, perios = ?, sec_no = ?, matnum = ?, folnum = ?, fecmat = ? WHERE STD_NO = {$this->intStd_no}";
				$arrData 		= array($this->strLas_nm,$this->strFir_nm,$this->strAddres,$this->strTphone,$this->strIdtype,$this->strIde_no,$this->intStdgen,$this->datFecbir,$this->strStdmai,$this->intTt_who,$this->strFatlas,$this->strFatnam,$this->strFatadr,$this->strFatfon,$this->strFatype,$this->strFatced,$this->strFatjob,$this->datFatbir,$this->strFatmai,$this->strMotlas,$this->strMotnam,$this->strMotadr,$this->strMotfon,$this->strMotype,$this->strMotced,$this->strMotjob,$this->datMotbir,$this->strMotmai,$this->strReplas,$this->strRepnam,$this->strRepadr,$this->strRepfon,$this->strRetype,$this->strRepced,$this->strRepjob,$this->datRepbir,$this->strRepmai,$this->strPerson,$this->strPeradr,$this->strPerfon,$this->intFacwho,$this->strRazons,$this->strDirecc,$this->strTlf_no,$this->strCltype,$this->strRuc_no,$this->strEmails,$this->intEstatu,$this->strLassch,$this->strRemark,$this->intPerios,$this->intSec_no,$this->intMatnum,$this->intFolnum,$this->datFecmat);
				$request_insert = $this->update($insert,$arrData);
				$return         = $request_insert;

				// Genera Malla Curricular del Estudiante en año lectivo
				if($this->intPeriox == $this->intPerios AND $this->intEstatu == 2)
				{
					$sql     			= "SELECT * FROM vssecmat WHERE PERIOS = {$this->intPerios} AND SEC_NO = {$this->intSec_no} ORDER BY SEC_NO,MAT_NO";
					$request_vssecmat 	= $this->select_all($sql);

					for ($i = 0; $i < count($request_vssecmat); $i++) 
					{
						$this->intMat_no = $request_vssecmat[$i]['MAT_NO'];
						$this->intEmp_no = $request_vssecmat[$i]['EMP_NO'];

						$sql 				= "SELECT * FROM vsmatstd WHERE PERIOS = {$this->intPerios} AND STD_NO = {$this->intStd_no} AND MAT_NO = {$this->intMat_no}";
						$request_vsmatstd 	= $this->select($sql);
						if(empty($request_vsmatstd))
						{
							$insert         = "INSERT INTO vsmatstd(perios,std_no,mat_no,sec_no,emp_no,profin) VALUES(?,?,?,?,?,?)";
							$arrData        = array($this->intPerios,$this->intStd_no,$this->intMat_no,$this->intSec_no,$this->intEmp_no,0);
							$request_insert = $this->insert($insert,$arrData);
						}
					}
				}

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
								$jj = str_pad($j, 3, "0", STR_PAD_LEFT);
								$codPer_no = 'PER'.$jj;
								
								$this->strPer_no = $request_vsproduc[$codPer_no];
								if($this->strPer_no == "on")
								{
									$this->strPer_no 	= $jj;
									$sql 				= "SELECT * FROM vstariff WHERE PERIOS = {$this->intPerios} AND STD_NO = {$this->intStd_no} AND PER_NO = '{$this->strPer_no}' AND ART_NO = {$this->intArt_no}";
									$request_vstariff 	=	$this->select($sql);
									if(empty($request_vstariff))
									{
										$insert         = "INSERT INTO vstariff(perios,std_no,per_no,art_no,remark,docval,facval,aboval,docsig,doctip,docpto,docnum) VALUES(?,?,?,?,?,?,?,?,?,?,?,?)";
										$arrData        = array($this->intPerios,$this->intStd_no,$this->strPer_no,$this->intArt_no,$this->strRemark,$this->intDocval,$this->intFacval,$this->intAboval,1,'','',0);
										$request_insert = $this->insert($insert,$arrData);
									}
								}
							}
						}
					}
				}
			}else{
				// EXISTE
				$return = -1;
			}
			return $return; 
		}
	}
