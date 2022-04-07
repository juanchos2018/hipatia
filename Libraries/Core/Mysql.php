<?php

	class Mysql extends Conexion
	{

		private $conexion;
		private $strquery;
		private $arrvalues;

		function __construct()
		{

			$this->conexion = new Conexion();
			$this->conexion = $this->conexion->conecta();
		}

		// Método para insertar un registro ....
		public function insert(string $query, array $arrValues)
		{
			$this->strquery = $query;
			$this->arrValues = $arrValues;
			$insert = $this->conexion->prepare($this->strquery);

			$resinsert = $insert->execute($this->arrValues);
			if($resinsert)
			{
				$lastinsert = $this->conexion->lastInsertId();
			}else{
				$lastinsert = 0;
			}
			return $lastinsert;

		}

		// Método para buscar un registro
		public function select(string $query)
		{
			$this->strquery = $query;
			$result = $this->conexion->prepare($this->strquery);
			$result->execute();
			$data = $result->fetch(PDO::FETCH_ASSOC);
			return $data;
		}

		// Metodo que devuelve todos los registros
		public function select_all(string $query)
		{
			$this->strquery = $query;
			$result = $this->conexion->prepare($this->strquery);
			$result->execute();
			$data = $result->fetchAll(PDO::FETCH_ASSOC);
			return $data;
		}

		// Método para actualizar .....
		public function update(string $query, array $arrValues)
		{
			$this->strquery = $query;
			$this->arrValues = $arrValues;
			$update = $this->conexion->prepare($this->strquery);
			$resExecute = $update->execute($this->arrValues);
			return $resExecute;
		}

		// Metodo delete ...
		public function delete(string $query)
		{
			$this->strquery = $query;
			$result = $this->conexion->prepare($this->strquery);
			$del = $result->execute();
			return $del;
		}

	}