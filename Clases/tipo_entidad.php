<?php
class tipo_entidad
{
	private $id_te;
	private $nombre_te;
	private $status_te;
	private $dato;

	function __construct($dat)
	{
		$this->id_te = $dat['id_te'];
		$this->nombre_te = $dat['nombre_te'];
		$this->status_te = $dat['status_te'];
		$this->dato = $dat['dato'];
	}
	public function verid_te(){
		return $this->id_te;
	}
	public function verdato(){
		return $this->dato;
	}
	public function verstatus_te(){
		return $this->status_te;
	}
	public function vernombre_te(){
		return $this->nombre_te;
	}

	public function validaExistencia($acceso)
	{
		$acceso->objeto->ejecutarSql("select * from tipo_entidad where id_te='$this->id_te'");
		if($acceso->objeto->registros>0)
			return true;
		else
			return false;
	}
	public function incluir($acceso)
	{
		return $acceso->objeto->ejecutarSql("insert into tipo_entidad(id_te,nombre_te,status_te) values ('$this->id_te','$this->nombre_te','$this->status_te')");			
	}
	public function modificar($acceso)
	{
		return $acceso->objeto->ejecutarSql("Update tipo_entidad Set nombre_te='$this->nombre_te', status_te='$this->status_te' Where id_te='$this->id_te'");	
	}
	public function eliminar($acceso)
	{
		return $acceso->objeto->ejecutarSql("delete from tipo_entidad where id_te='$this->id_te'");
	}
}
?>

