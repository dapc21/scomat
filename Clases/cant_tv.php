<?php
class cant_tv
{
	private $id_cant;
	private $cantidad;
	private $status_cant;
	private $dato;

	function __construct($dat)
	{
		$this->id_cant = $dat['id_cant'];
		$this->cantidad = $dat['cantidad'];
		$this->status_cant = $dat['status_cant'];
		$this->dato = $dat['dato'];
	}
	public function verid_cant(){
		return $this->id_cant;
	}
	public function verdato(){
		return $this->dato;
	}
	public function verstatus_cant(){
		return $this->status_cant;
	}
	public function vercantidad(){
		return $this->cantidad;
	}

	public function validaExistencia($acceso)
	{
		$acceso->objeto->ejecutarSql("select * from cant_tv where id_cant='$this->id_cant'");
		if($acceso->objeto->registros>0)
			return true;
		else
			return false;
	}
	public function incluir($acceso)
	{
		return $acceso->objeto->ejecutarSql("insert into cant_tv(id_cant,cantidad,status_cant) values ('$this->id_cant','$this->cantidad','$this->status_cant')");			
	}
	public function modificar($acceso)
	{
		return $acceso->objeto->ejecutarSql("Update cant_tv Set cantidad='$this->cantidad', status_cant='$this->status_cant' Where id_cant='$this->id_cant'");	
	}
	public function eliminar($acceso)
	{
		return $acceso->objeto->ejecutarSql("delete from cant_tv where id_cant='$this->id_cant'");
	}
}
?>