<?php
class servicios_sistema
{
	private $id_serv_sist;
	private $id_tse;
	private $nombre_serv_sist;
	private $codigo_serv_sist;
	private $abrev_serv_sist;
	private $status_serv_sist;
	private $dato;

	function __construct($dat)
	{
		$this->id_serv_sist = $dat['id_serv_sist'];
		$this->id_tse = $dat['id_tse'];
		$this->nombre_serv_sist = $dat['nombre_serv_sist'];
		$this->codigo_serv_sist = $dat['codigo_serv_sist'];
		$this->abrev_serv_sist = $dat['abrev_serv_sist'];
		$this->status_serv_sist = $dat['status_serv_sist'];
		$this->dato = $dat['dato'];
	}
	public function verid_serv_sist(){
		return $this->id_serv_sist;
	}
	public function verdato(){
		return $this->dato;
	}
	public function verstatus_serv_sist(){
		return $this->status_serv_sist;
	}
	public function verabrev_serv_sist(){
		return $this->abrev_serv_sist;
	}
	public function vercodigo_serv_sist(){
		return $this->codigo_serv_sist;
	}
	public function vernombre_serv_sist(){
		return $this->nombre_serv_sist;
	}
	public function verid_tse(){
		return $this->id_tse;
	}

	public function validaExistencia($acceso)
	{
		$acceso->objeto->ejecutarSql("select * from servicios_sistema where id_serv_sist='$this->id_serv_sist'");
		if($acceso->objeto->registros>0)
			return true;
		else
			return false;
	}
	public function incluir($acceso)
	{
		return $acceso->objeto->ejecutarSql("insert into servicios_sistema(id_serv_sist,id_tse,nombre_serv_sist,codigo_serv_sist,abrev_serv_sist,status_serv_sist) values ('$this->id_serv_sist','$this->id_tse','$this->nombre_serv_sist','$this->codigo_serv_sist','$this->abrev_serv_sist','$this->status_serv_sist')");			
	}
	public function modificar($acceso)
	{
		return $acceso->objeto->ejecutarSql("Update servicios_sistema Set id_tse='$this->id_tse', nombre_serv_sist='$this->nombre_serv_sist', codigo_serv_sist='$this->codigo_serv_sist', abrev_serv_sist='$this->abrev_serv_sist', status_serv_sist='$this->status_serv_sist' Where id_serv_sist='$this->id_serv_sist'");	
	}
	public function eliminar($acceso)
	{
		return $acceso->objeto->ejecutarSql("delete from servicios_sistema where id_serv_sist='$this->id_serv_sist'");
	}
}
?>