<?php
class paquete
{
	private $id_paq;
	private $nombre_paq;
	private $status_paq;
	private $dato;

	function __construct($dat)
	{
		$this->id_paq = $dat['id_paq'];
		$this->nombre_paq = $dat['nombre_paq'];
		$this->status_paq = $dat['status_paq'];
		$this->dato = $dat['dato'];
	}
	public function verid_paq(){
		return $this->id_paq;
	}
	public function verdato(){
		return $this->dato;
	}
	public function verstatus_paq(){
		return $this->status_paq;
	}
	public function vernombre_paq(){
		return $this->nombre_paq;
	}
	public function validaExistencia($acceso)
	{
		$acceso->objeto->ejecutarSql("select * from paquete where id_paq='$this->id_paq'");
		if($acceso->objeto->registros>0)
			return true;
		else
			return false;
	}
	public function incluir($acceso)
	{
		return $acceso->objeto->ejecutarSql("insert into paquete(id_paq,nombre_paq,status_paq) values ('$this->id_paq','$this->nombre_paq','$this->status_paq')");			
	}
	public function modificar($acceso)
	{
		return $acceso->objeto->ejecutarSql("Update paquete Set nombre_paq='$this->nombre_paq', status_paq='$this->status_paq' Where id_paq='$this->id_paq'");	
	}
	public function eliminar($acceso)
	{
		return $acceso->objeto->ejecutarSql("delete from paquete where id_paq='$this->id_paq'");
	}
}
?>