<?php
class tipo_alarma
{
	private $id_tipo_alarma;
	private $nombre_alarma;
	private $status_alarma;
	private $dato;

	function __construct($id_tipo_alarma,$nombre_alarma,$status_alarma,$dato)
	{
		$this->id_tipo_alarma = $id_tipo_alarma;
		$this->nombre_alarma = $nombre_alarma;
		$this->status_alarma = $status_alarma;
		$this->dato = $dato;
	}
	public function verid_tipo_alarma(){
		return $this->id_tipo_alarma;
	}
	public function verdato(){
		return $this->dato;
	}
	public function verstatus_alarma(){
		return $this->status_alarma;
	}
	public function vernombre_alarma(){
		return $this->nombre_alarma;
	}

	public function validaExistencia($acceso)
	{
		$acceso->objeto->ejecutarSql("select * from tipo_alarma where id_tipo_alarma='$this->id_tipo_alarma'");
		if($acceso->objeto->registros>0)
			return true;
		else
			return false;
	}
	public function incluirtipo_alarma($acceso)
	{
		return $acceso->objeto->ejecutarSql("insert into tipo_alarma(id_tipo_alarma,nombre_alarma,status_alarma) values ('$this->id_tipo_alarma','$this->nombre_alarma','$this->status_alarma')");			
	}
	public function modificartipo_alarma($acceso)
	{
		return $acceso->objeto->ejecutarSql("Update tipo_alarma Set nombre_alarma='$this->nombre_alarma', status_alarma='$this->status_alarma' Where id_tipo_alarma='$this->id_tipo_alarma'");	
	}
	public function eliminartipo_alarma($acceso)
	{
		return $acceso->objeto->ejecutarSql("delete from tipo_alarma where id_tipo_alarma='$this->id_tipo_alarma'");
	}
}
?>