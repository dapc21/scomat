<?php
class tipo_sist_equipo
{
	private $id_tse;
	private $sistema;
	private $ubicacion;
	private $abrev_nombre_tse;
	private $status_tse;
	private $dato;

	function __construct($dat)
	{
		$this->id_tse = $dat['id_tse'];
		$this->sistema = $dat['sistema'];
		$this->ubicacion = $dat['ubicacion'];
		$this->abrev_nombre_tse = $dat['abrev_nombre_tse'];
		$this->status_tse = $dat['status_tse'];
		$this->dato = $dat['dato'];
	}
	public function verid_tse(){
		return $this->id_tse;
	}
	public function verdato(){
		return $this->dato;
	}
	public function verstatus_tse(){
		return $this->status_tse;
	}
	public function verabrev_nombre_tse(){
		return $this->abrev_nombre_tse;
	}
	public function verubicacion(){
		return $this->ubicacion;
	}
	public function versistema(){
		return $this->sistema;
	}

	public function validaExistencia($acceso)
	{
		$acceso->objeto->ejecutarSql("select * from tipo_sist_equipo where id_tse='$this->id_tse'");
		if($acceso->objeto->registros>0)
			return true;
		else
			return false;
	}
	public function incluir($acceso)
	{
		return $acceso->objeto->ejecutarSql("insert into tipo_sist_equipo(id_tse,sistema,ubicacion,abrev_nombre_tse,status_tse) values ('$this->id_tse','$this->sistema','$this->ubicacion','$this->abrev_nombre_tse','$this->status_tse')");			
	}
	public function modificar($acceso)
	{
		return $acceso->objeto->ejecutarSql("Update tipo_sist_equipo Set sistema='$this->sistema', ubicacion='$this->ubicacion', abrev_nombre_tse='$this->abrev_nombre_tse', status_tse='$this->status_tse' Where id_tse='$this->id_tse'");	
	}
	public function eliminar($acceso)
	{
		return $acceso->objeto->ejecutarSql("delete from tipo_sist_equipo where id_tse='$this->id_tse'");
	}
}
?>