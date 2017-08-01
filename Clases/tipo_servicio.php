<?php
class tipo_servicio
{
	private $id_tipo_servicio;
	private $tipo_servicio;
	private $status_servicio;
	private $dato;

	function __construct($dat)
	{
		$this->id_tipo_servicio = $dat['id_tipo_servicio'];
		$this->tipo_servicio = $dat['tipo_servicio'];
		$this->status_servicio = $dat['status_servicio'];
		$this->dato = $dat['dato'];
	}
	public function verid_tipo_servicio(){
		return $this->id_tipo_servicio;
	}
	public function verdato(){
		return $this->dato;
	}
	public function verstatus_servicio(){
		return $this->status_servicio;
	}
	public function vertipo_servicio(){
		return $this->tipo_servicio;
	}

	public function validaExistencia($acceso)
	{
		$acceso->objeto->ejecutarSql("select * from tipo_servicio where id_tipo_servicio='$this->id_tipo_servicio'");
		if($acceso->objeto->registros>0)
			return true;
		else
			return false;
	}
	public function incluir($acceso)
	{
		return $acceso->objeto->ejecutarSql("insert into tipo_servicio(id_tipo_servicio,tipo_servicio,status_servicio) values ('$this->id_tipo_servicio','$this->tipo_servicio','$this->status_servicio')");			
	}
	public function modificar($acceso)
	{
		return $acceso->objeto->ejecutarSql("Update tipo_servicio Set tipo_servicio='$this->tipo_servicio', status_servicio='$this->status_servicio' Where id_tipo_servicio='$this->id_tipo_servicio'");	
	}
	public function eliminar($acceso)
	{
		return $acceso->objeto->ejecutarSql("delete from tipo_servicio where id_tipo_servicio='$this->id_tipo_servicio'");
	}
}
?>