<?php
class municipio
{
	private $id_mun;
	private $id_esta;
	private $nombre_mun;
	private $status_mun;
	private $dato;

	function __construct($dat)
	{
		$this->id_mun = $dat['id_mun'];
		$this->id_esta = $dat['id_esta'];
		$this->nombre_mun = $dat['nombre_mun'];
		$this->status_mun = $dat['status_mun'];
		$this->dato = $dat['dato'];
	}
	public function verid_mun(){
		return $this->id_mun;
	}
	public function verdato(){
		return $this->dato;
	}
	public function verstatus_mun(){
		return $this->status_mun;
	}
	public function vernombre_mun(){
		return $this->nombre_mun;
	}
	public function verid_esta(){
		return $this->id_esta;
	}

	public function validaExistencia($acceso)
	{
		$acceso->objeto->ejecutarSql("select * from municipio where id_mun='$this->id_mun'");
		if($acceso->objeto->registros>0)
			return true;
		else
			return false;
	}
	public function incluir($acceso)
	{
		$acceso->objeto->ejecutarSql("insert into municipio(id_mun,id_esta,nombre_mun,status_mun) values ('$this->id_mun','$this->id_esta','$this->nombre_mun','$this->status_mun')");			
		
	}
	public function modificar($acceso)
	{
		$acceso->objeto->ejecutarSql("Update municipio Set id_esta='$this->id_esta', nombre_mun='$this->nombre_mun', status_mun='$this->status_mun' Where id_mun='$this->id_mun'");	
		
	}
	public function eliminar($acceso)
	{
		$acceso->objeto->ejecutarSql("delete from municipio where id_mun='$this->id_mun'");
		
	}
}
?>