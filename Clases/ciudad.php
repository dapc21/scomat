<?php
class ciudad
{
	private $id_ciudad;
	private $id_mun;
	private $nombre_ciudad;
	private $status_ciudad;
	private $dato;

	function __construct($dat)
	{
		$this->id_ciudad = $dat['id_ciudad'];
		$this->id_mun = $dat['id_mun'];
		$this->nombre_ciudad = $dat['nombre_ciudad'];
		$this->status_ciudad = $dat['status_ciudad'];
		$this->dato = $dat['dato'];
	}
	public function verid_ciudad(){
		return $this->id_ciudad;
	}
	public function verdato(){
		return $this->dato;
	}
	public function verstatus_ciudad(){
		return $this->status_ciudad;
	}
	public function vernombre_ciudad(){
		return $this->nombre_ciudad;
	}
	public function verid_mun(){
		return $this->id_mun;
	}

	public function validaExistencia($acceso)
	{
		$acceso->objeto->ejecutarSql("select * from ciudad where id_ciudad='$this->id_ciudad'");
		if($acceso->objeto->registros>0)
			return true;
		else
			return false;
	}
	public function incluir($acceso)
	{
		$acceso->objeto->ejecutarSql("insert into ciudad(id_ciudad,id_mun,nombre_ciudad,status_ciudad) values ('$this->id_ciudad','$this->id_mun','$this->nombre_ciudad','$this->status_ciudad')");			
	}
	public function modificar($acceso)
	{
		$acceso->objeto->ejecutarSql("Update ciudad Set id_mun='$this->id_mun', nombre_ciudad='$this->nombre_ciudad', status_ciudad='$this->status_ciudad' Where id_ciudad='$this->id_ciudad'");	
	}
	public function eliminar($acceso)
	{
		$acceso->objeto->ejecutarSql("delete from ciudad where id_ciudad='$this->id_ciudad'");
		
	}
}
?>