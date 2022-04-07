 <?php

	class VsproducModel extends Mysql
	{
		public $intArt_no;
		public $strArt_nm;
		public $intEstado;
		public $intTip_no;
		public $intDesiva;
		public $intPropay;
		public $intPer000;
		public $intPer001;
		public $intPer002;
		public $intPer003;
		public $intPer004;
		public $intPer005;
		public $intPer006;
		public $intPer007;
		public $intPer008;
		public $intPer009;
		public $intPer010;
		public $intPer011;
		public $intPer012;
		public $intPer013;
		public $strCta_no;


		public function __construct()
		{
			//echo "Mensaje desde el Modelo Home";
			parent::__construct();
		}


		// EXTRAE ARTICULOS
		public function selectVsproduc()
		{
			$sql     = "SELECT * FROM vsproduc WHERE ESTADO = 1 ORDER BY ART_NM";
			$request = $this->select_all($sql);
			return $request;
		}


		// EXTRAE UN ARTICULO
		public function oneVsproduc(int $idSec)
		{
			$this->intArt_no = $idSec;
			$sql = "SELECT * FROM vsproduc WHERE ART_NO = {$this->intArt_no}";
			$request = $this->select($sql);
			return $request;
		}


		// INSERTA ARTICULO
		public function insertVsproduc(string $art_nm, int $estado, int $tip_no, int $desiva, int $propay, string $per000, string $per001, string $per002, string $per003, string $per004, string $per005, string $per006, string $per007, string $per008, string $per009, string $per010, string $per011, string $per012, string $per013, string $cta_no)
		{
			$return = "";
			$this->strArt_nm = $art_nm;
			$this->intEstado = $estado;
			$this->intTip_no = $tip_no;
			$this->intDesiva = $desiva;
			$this->intPropay = $propay;
			$this->intPer000 = $per000;
			$this->intPer001 = $per001;
			$this->intPer002 = $per002;
			$this->intPer003 = $per003;
			$this->intPer004 = $per004;
			$this->intPer005 = $per005;
			$this->intPer006 = $per006;
			$this->intPer007 = $per007;
			$this->intPer008 = $per008;
			$this->intPer009 = $per009;
			$this->intPer010 = $per010;
			$this->intPer011 = $per011;
			$this->intPer012 = $per012;
			$this->intPer013 = $per013;
			$this->strCta_no = $cta_no;

			$sql 				= "SELECT CTATIP FROM vsacount WHERE CTA_NO = '{$this->strCta_no}'";
			$request_vsacount 	= $this->select($sql);
			if($request_vsacount['CTATIP'] == 1)
			{
				// CUENTA INVALIDA
				$return = -2;
				return $return;
			}	

			$sql = "SELECT * FROM vsproduc WHERE ART_NM = '{$this->strArt_nm}'";
			$request = $this->select_all($sql);
			if(empty($request))
			{
				$insert         = "INSERT INTO vsproduc(art_nm,estado,tip_no,desiva,propay,per000,per001,per002,per003,per004,per005,per006,per007,per008,per009,per010,per011,per012,per013,cta_no) VALUES(?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)";
				$arrData        = array($this->strArt_nm,$this->intEstado,$this->intTip_no,$this->intDesiva,$this->intPropay,$this->intPer000,$this->intPer001,$this->intPer002,$this->intPer003,$this->intPer004,$this->intPer005,$this->intPer006,$this->intPer007,$this->intPer008,$this->intPer009,$this->intPer010,$this->intPer011,$this->intPer012,$this->intPer013,$this->strCta_no);
				$request_insert = $this->insert($insert,$arrData);
				$return         = $request_insert;
			}else{
				// EXISTE
				$return = -1;
			}
			return $return;
		}

		
		// ACTUALIZA ARTICULO
		public function updateVsproduc(int $art_no, string $art_nm, int $estado, int $tip_no, int $desiva, int $propay, string $per000, string $per001, string $per002, string $per003, string $per004, string $per005, string $per006, string $per007, string $per008, string $per009, string $per010, string $per011, string $per012, string $per013, $cta_no)
		{
			$return = "";
			$this->intArt_no = $art_no;
			$this->strArt_nm = $art_nm;
			$this->intEstado = $estado;
			$this->intTip_no = $tip_no;
			$this->intDesiva = $desiva;
			$this->intPropay = $propay;
			$this->intPer000 = $per000;
			$this->intPer001 = $per001;
			$this->intPer002 = $per002;
			$this->intPer003 = $per003;
			$this->intPer004 = $per004;
			$this->intPer005 = $per005;
			$this->intPer006 = $per006;
			$this->intPer007 = $per007;
			$this->intPer008 = $per008;
			$this->intPer009 = $per009;
			$this->intPer010 = $per010;
			$this->intPer011 = $per011;
			$this->intPer012 = $per012;
			$this->intPer013 = $per013;
			$this->strCta_no = $cta_no;

			$sql 				= "SELECT CTATIP FROM vsacount WHERE CTA_NO = '{$this->strCta_no}'";
			$request_vsacount 	= $this->select($sql);
			if($request_vsacount['CTATIP'] == 1)
			{
				// CUENTA INVALIDA
				$return = -2;
				return $return;
			}	

			$sql = "SELECT * FROM vsproduc WHERE ART_NM = '{$this->strArt_nm}' AND ART_NO != {$this->intArt_no}";
			$request = $this->select_all($sql);
			if(empty($request))
			{
				$insert         = "UPDATE vsproduc SET ART_NM = ?, ESTADO = ?, TIP_NO = ?, DESIVA = ?, PROPAY = ?, PER000 = ?, PER001 = ?, PER002 = ?, PER003 = ?, PER004 = ?, PER005 = ?, PER006 = ?, PER007 = ?, PER008 = ?, PER009 = ?, PER010 = ?, PER011 = ?, PER012 = ?, PER013 = ?, CTA_NO = ? WHERE ART_NO = {$this->intArt_no}";
				$arrData        = array($this->strArt_nm,$this->intEstado,$this->intTip_no,$this->intDesiva,$this->intPropay,$this->intPer000,$this->intPer001,$this->intPer002,$this->intPer003,$this->intPer004,$this->intPer005,$this->intPer006,$this->intPer007,$this->intPer008,$this->intPer009,$this->intPer010,$this->intPer011,$this->intPer012,$this->intPer013,$this->strCta_no);
				$request_insert = $this->update($insert,$arrData);
				$return         = $request_insert;
			}else{
				// EXISTE
				$return = -1;
			}
			return $return;
		}
	}
