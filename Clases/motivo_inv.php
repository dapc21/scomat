<?php
class motivo_inv
{
	private $id_motivo;
	private $nombre_motivo;
	private $status_motivo;
	private $dato;

	function __construct($dat)
	{
		$this->id_motivo = $dat['id_motivo'];
		$this->nombre_motivo = $dat['nombre_motivo'];
		$this->status_motivo = $dat['status_motivo'];
		$this->dato = $dat['dato'];
	}
	public function verid_motivo(){
		return $this->id_motivo;
	}
	public function verdato(){
		return $this->dato;
	}
	public function verstatus_motivo(){
		return $this->status_motivo;
	}
	public function vernombre_motivo(){
		return $this->nombre_motivo;
	}

	public function validaExistencia($acceso)
	{
		$acceso->objeto->ejecutarSql("select * from motivo_inv where id_motivo='$this->id_motivo'");
		if($acceso->objeto->registros>0)
			return true;
		else
			return false;
	}
	public function incluir($acceso)
	{
		return $acceso->objeto->ejecutarSql("insert into motivo_inv(id_motivo,nombre_motivo,status_motivo) values ('$this->id_motivo','$this->nombre_motivo','$this->status_motivo')");			
	}
	public function modificar($acceso)
	{
		return $acceso->objeto->ejecutarSql("Update motivo_inv Set nombre_motivo='$this->nombre_motivo', status_motivo='$this->status_motivo' Where id_motivo='$this->id_motivo'");	
	}
	public function eliminar($acceso)
	{
		return $acceso->objeto->ejecutarSql("delete from motivo_inv where id_motivo='$this->id_motivo'");
	}
}

?>