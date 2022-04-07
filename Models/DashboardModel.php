<?php

	class DashboardModel extends Mysql
	{

		public function __construct(){

			//echo "Mensaje desde el Modelo Home";
			parent::__construct();
		}

		public function num_section()
	    {
	        $sql = "SELECT COUNT(*) FROM vsection";
	        $res = $this->select($sql);
	        return $res;
	    }

	    public function num_matter()
	    {
	        $sql = "SELECT COUNT(*) FROM vsmatter";
	        $res = $this->select($sql);
	        return $res;
	    }

	    public function num_stdasp()
	    {
	    	$sql = "SELECT COUNT(*) FROM vsnewstd";
	        $res = $this->select($sql);
	        return $res;	
	    }

		public function num_student()
	    {
	        $sql = "SELECT COUNT(*) FROM vstudent WHERE ESTATU != 11";
	        $res = $this->select($sql);
	        return $res;
	    }

	    public function num_personal()
	    {
	    	$sql = "SELECT COUNT(*) FROM vsemplox";
	        $res = $this->select($sql);
	        return $res;	
	    }

	    public function num_malla()
	    {
	        $sql = "SELECT COUNT(*) FROM vssecmat";
	        $res = $this->select($sql);
	        return $res;
	    }
	    public function num_hsocial()
	    {
	        $sql = "SELECT COUNT(*) FROM vsclinic WHERE HISCOD = 'SOC'";
	        $res = $this->select($sql);
	        return $res;
	    }
	    public function num_hclinica()
	    {
	        $sql = "SELECT COUNT(*) FROM vsclinic WHERE HISCOD = 'MED'";
	        $res = $this->select($sql);
	        return $res;
	    }

	}
	