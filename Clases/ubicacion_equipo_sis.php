<?php
class ubicacion_equipo_sis
{
	private $id_ues;
	private $nombre_ues;
	private $direccion_ues;
	private $status_ues;
	private $dato;

	function __construct($dat)
	{
		$this->id_ues = $dat['id_ues'];
		$this->nombre_ues = $dat['nombre_ues'];
		$this->direccion_ues = $dat['direccion_ues'];
		$this->status_ues = $dat['status_ues'];
		$this->dato = $dat['dato'];
	}
	public function verid_ues(){
		return $this->id_ues;
	}
	public function verdato(){
		return $this->dato;
	}
	public function verstatus_ues(){
		return $this->status_ues;
	}
	public function verdireccion_ues(){
		return $this->direccion_ues;
	}
	public function vernombre_ues(){
		return $this->nombre_ues;
	}

	public function validaExistencia($acceso)
	{
		$acceso->objeto->ejecutarSql("select * from ubicacion_equipo_sis where id_ues='$this->id_ues'");
		if($acceso->objeto->registros>0)
			return true;
		else
			return false;
	}
	public function incluir($acceso)
	{
		return $acceso->objeto->ejecutarSql("insert into ubicacion_equipo_sis(id_ues,nombre_ues,direccion_ues,status_ues) values ('$this->id_ues','$this->nombre_ues','$this->direccion_ues','$this->status_ues')");			
	}
	public function modificar($acceso)
	{
		return $acceso->objeto->ejecutarSql("Update ubicacion_equipo_sis Set nombre_ues='$this->nombre_ues', direccion_ues='$this->direccion_ues', status_ues='$this->status_ues' Where id_ues='$this->id_ues'");	
	}
	public function eliminar($acceso)
	{
		return $acceso->objeto->ejecutarSql("delete from ubicacion_equipo_sis where id_ues='$this->id_ues'");
	}
}
?>