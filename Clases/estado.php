<?php
class estado
{
	private $id_esta;
	private $nombre_esta;
	private $status_esta;
	private $dato;

	function __construct($dat)
	{
		$this->id_esta = $dat['id_esta'];
		$this->nombre_esta= $dat['nombre_esta'];
		$this->status_esta = $dat['status_esta'];
		$this->dato = $dat['dato'];
	}
	public function verid_esta(){
		return $this->id_esta;
	}
	public function verdato(){
		return $this->dato;
	}
	public function verstatus_esta(){
		return $this->status_esta;
	}
	public function vernombre_esta(){
		return $this->nombre_esta;
	}
	public function validaExistencia($acceso)
	{
		$acceso->objeto->ejecutarSql("select * from estado where id_esta='$this->id_esta'");
		if($acceso->objeto->registros>0)
			return true;
		else
			return false;
	}
	public function incluir($acceso)
	{
		$acceso->objeto->ejecutarSql("insert into estado(id_esta,nombre_esta,status_esta) values ('$this->id_esta','$this->nombre_esta','$this->status_esta')");			
			
	}
	public function modificar($acceso)
	{
		$acceso->objeto->ejecutarSql("Update estado Set nombre_esta='$this->nombre_esta', status_esta='$this->status_esta' Where id_esta='$this->id_esta'");	
			
	}
	public function eliminar($acceso)
	{
		$acceso->objeto->ejecutarSql("delete from estado where id_esta='$this->id_esta'");
		
	}
}
?>