<?php

	class WidgetsModel extends Mysql
	{

		public function __construct(){

			//echo "Mensaje desde el Modelo Home";
			parent::__construct();
		}


		// Extrae numero de Aspirantes por periodo tabla: vsnewstd
		public function countStdAsp()
		{
			$sql = "SELECT COUNT(STD_NO) as STD, PERIOS FROM vsnewstd GROUP BY PERIOS ORDER BY PERIOS";
			$res = $this->select_all($sql);
	        return $res;
		}


		public function countStdAct()
		{
			$sql 				= "SELECT PERIOS FROM vsdefaul";
			$request_vsdefaul 	= $this->select($sql);
			$this->intPerios	= $request_vsdefaul['PERIOS']; 

			$where = "WHERE v.ESTATU != 11 AND v.PERIOS = {$this->intPerios} GROUP BY v.SEC_NO ORDER BY s.NIV_NO,s.PARALE";

			$sql = "SELECT COUNT(v.STD_NO) as STD,
						v.PERIOS,
						v.SEC_NO,
						s.NIV_NO,
						s.SEC_NM,
						s.PARALE
					FROM vstudent v
					INNER JOIN vsection s ON s.SEC_NO = v.SEC_NO ".$where;
			$res = $this->select_all($sql);
	        return $res;
		}


		public function countStdGen()
		{
			$sql 				= "SELECT PERIOS FROM vsdefaul";
			$request_vsdefaul 	= $this->select($sql);
			$this->intPerios	= $request_vsdefaul['PERIOS']; 

			$sql = "SELECT COUNT(STD_NO) as STD, STDGEN FROM vstudent WHERE ESTATU = 2 AND PERIOS = {$this->intPerios} GROUP BY STDGEN";
			$res = $this->select_all($sql);
	        return $res;
		}


		public function countEmpProfile()
		{
			$sql = "SELECT COUNT(EMP_NO) as EMP, PROFIL FROM vsemplox WHERE ESTATU = 1 GROUP BY PROFIL ORDER BY PROFIL";
			$res = $this->select_all($sql);
	        return $res;	
		}


		public function countRegAulaVirtual(string $fecha)
		{
			$sql = "SELECT COUNT(SEC_ID) as REG,PERIOS,FECREG 
			        FROM vschedul WHERE FECREG = '$fecha' 
			        GROUP BY PERIOS 
			        ORDER BY PERIOS";
			$res = $this->select_all($sql);
	        return $res;
		}


		public function countRegNotificacion()
		{

		}

		public function countRegFchSocial()
		{

		}

		public function countRegFchMedica()
		{

		}


		public function num_vschedul_today()
	    {
	        $sql = "SELECT COUNT(*) FROM vschedul WHERE FECREG = date('Y-m-d')";
	        $res = $this->select($sql);
	        return $res;
	    }


		public function num_vschedul_yesterday()
	    {
	        $sql = "SELECT COUNT(*) FROM vschedul WHERE FECREG = date('Y-m-d') - 1";
	        $res = $this->select($sql);
	        return $res;
	    }


	    public function num_hsocial_today()
	    {
	        $sql = "SELECT COUNT(*) FROM vsclinic WHERE HISCOD = 'SOC' AND FECREG = date('Y-m-d')";
	        $res = $this->select($sql);
	        return $res;
	    }


	    public function num_hsocial_yesterday()
	    {
	        $sql = "SELECT COUNT(*) FROM vsclinic WHERE HISCOD = 'SOC' AND FECREG = date('Y-m-d') - 1";
	        $res = $this->select($sql);
	        return $res;
	    }


        public function num_hclinica_today()
	    {
	        $sql = "SELECT COUNT(*) FROM vsclinic WHERE HISCOD = 'MED' AND FECREG = date('Y-m-d')";
	        $res = $this->select($sql);
	        return $res;
	    }


        public function num_hclinica_yesterday()
	    {
	        $sql = "SELECT COUNT(*) FROM vsclinic WHERE HISCOD = 'MED' AND FECREG = date('Y-m-d') - 1";
	        $res = $this->select($sql);
	        return $res;
	    }
	}
