<?php
class tipo_resp
{
	private $id_trl;
	private $nombre_trl;
	private $status_trl;
	private $dato;

	function __construct($dat)
	{
		$this->id_trl = $dat['id_trl'];
		$this->nombre_trl = $dat['nombre_trl'];
		$this->status_trl = $dat['status_trl'];
		$this->dato = $dat['dato'];
	}
	public function verid_trl(){
		return $this->id_trl;
	}
	public function verdato(){
		return $this->dato;
	}
	public function verstatus_trl(){
		return $this->status_trl;
	}
	public function vernombre_trl(){
		return $this->nombre_trl;
	}

	public function validaExistencia($acceso)
	{
		$acceso->objeto->ejecutarSql("select * from tipo_resp where id_trl='$this->id_trl'");
		if($acceso->objeto->registros>0)
			return true;
		else
			return false;
	}
	public function incluir($acceso)
	{
		return $acceso->objeto->ejecutarSql("insert into tipo_resp(id_trl,nombre_trl,status_trl,dato) values ('$this->id_trl','$this->nombre_trl','$this->status_trl','$this->dato')");			
	}
	public function modificar($acceso)
	{
		return $acceso->objeto->ejecutarSql("Update tipo_resp Set nombre_trl='$this->nombre_trl', status_trl='$this->status_trl', dato='$this->dato' Where id_trl='$this->id_trl'");	
	}
	public function eliminar($acceso)
	{
		return $acceso->objeto->ejecutarSql("delete from tipo_resp where id_trl='$this->id_trl'");
	}
}
?>