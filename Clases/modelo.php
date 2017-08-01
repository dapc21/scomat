<?php
class modelo
{
	private $id_modelo;
	private $id_marca;
	private $nombre_modelo;
	private $id_tse;
	private $status_modelo;
	private $dato;

	function __construct($dat)
	{
		$this->id_modelo = $dat['id_modelo'];
		$this->id_marca = $dat['id_marca'];
		$this->nombre_modelo = $dat['nombre_modelo'];
		$this->id_tse = $dat['id_tse'];
		$this->status_modelo = $dat['status_modelo'];
		$this->dato = $dat['dato'];
	}
	public function verid_modelo(){
		return $this->id_modelo;
	}
	public function verdato(){
		return $this->dato;
	}
	public function verstatus_modelo(){
		return $this->status_modelo;
	}
	public function verid_tse(){
		return $this->id_tse;
	}
	public function vernombre_modelo(){
		return $this->nombre_modelo;
	}
	public function verid_marca(){
		return $this->id_marca;
	}

	public function validaExistencia($acceso)
	{
		$acceso->objeto->ejecutarSql("select * from modelo where id_modelo='$this->id_modelo'");
		if($acceso->objeto->registros>0)
			return true;
		else
			return false;
	}
	public function incluir($acceso)
	{
		return $acceso->objeto->ejecutarSql("insert into modelo(id_modelo,id_marca,nombre_modelo,id_tse,status_modelo,dato) values ('$this->id_modelo','$this->id_marca','$this->nombre_modelo','$this->id_tse','$this->status_modelo','$this->dato')");			
	}
	public function modificar($acceso)
	{
		return $acceso->objeto->ejecutarSql("Update modelo Set id_marca='$this->id_marca', nombre_modelo='$this->nombre_modelo', id_tse='$this->id_tse', status_modelo='$this->status_modelo', dato='$this->dato' Where id_modelo='$this->id_modelo'");	
	}
	public function eliminar($acceso)
	{
		return $acceso->objeto->ejecutarSql("delete from modelo where id_modelo='$this->id_modelo'");
	}
}
?>