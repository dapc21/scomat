<?php
class marca
{
	private $id_marca;
	private $nombre_marca;
	private $status_marca;
	private $dato;

	function __construct($dat)
	{
		$this->id_marca = $dat['id_marca'];
		$this->nombre_marca = $dat['nombre_marca'];
		$this->status_marca = $dat['status_marca'];
		$this->dato = $dat['dato'];
	}
	public function verid_marca(){
		return $this->id_marca;
	}
	public function verdato(){
		return $this->dato;
	}
	public function verstatus_marca(){
		return $this->status_marca;
	}
	public function vernombre_marca(){
		return $this->nombre_marca;
	}
	public function validaExistencia($acceso)
	{
		$acceso->objeto->ejecutarSql("select * from marca where id_marca='$this->id_marca'");
		if($acceso->objeto->registros>0)
			return true;
		else
			return false;
	}
	public function incluir($acceso)
	{
		return  $acceso->objeto->ejecutarSql("insert into marca(id_marca,nombre_marca,status_marca,dato) values ('$this->id_marca','$this->nombre_marca','$this->status_marca','$this->dato')");			
	}
	public function modificar($acceso)
	{
		return $acceso->objeto->ejecutarSql("Update marca Set nombre_marca='$this->nombre_marca', status_marca='$this->status_marca',  dato='$this->dato' Where id_marca='$this->id_marca'");	
	}
	public function eliminar($acceso)
	{
		return $acceso->objeto->ejecutarSql("delete from marca where id_marca='$this->id_marca'");
	}
}
?>