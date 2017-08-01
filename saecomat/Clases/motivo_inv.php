<?php
class motivo_inv
{
	private $id_motivo;
	private $nombre_motivo;
	private $status_motivo;
	private $dato;

	function __construct($id_motivo,$nombre_motivo,$status_motivo,$dato)
	{
		$this->id_motivo = $id_motivo;
		$this->nombre_motivo = $nombre_motivo;
		$this->status_motivo = $status_motivo;
		$this->dato = $dato;
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
	public function incluirmotivo_inv($acceso)
	{
		//echo "insert into motivo_inv(id_motivo,nombre_motivo,status_motivo) values ('$this->id_motivo','$this->nombre_motivo','$this->status_motivo')";
		return $acceso->objeto->ejecutarSql("insert into motivo_inv(id_motivo,nombre_motivo,status_motivo) values ('$this->id_motivo','$this->nombre_motivo','$this->status_motivo')");			
	}
	public function modificarmotivo_inv($acceso)
	{
		return $acceso->objeto->ejecutarSql("Update motivo_inv Set nombre_motivo='$this->nombre_motivo', status_motivo='$this->status_motivo' Where id_motivo='$this->id_motivo'");	
	}
	public function eliminarmotivo_inv($acceso)
	{
		return $acceso->objeto->ejecutarSql("delete from motivo_inv where id_motivo='$this->id_motivo'");
	}
}
/*
class motivo_inv
{
	private $campoClave;
	private $dato;

	function __construct($campoClave,$dato)
	{
		$this->campoClave = $campoClave;
		$this->dato = $dato;
	}
	public function vercampoClave(){
		return $this->campoClave;
	}
	public function verdato(){
		return $this->dato;
	}

	public function validaExistencia($acceso)
	{
		$acceso->objeto->ejecutarSql("select * from motivo_inv where campoClave='$this->campoClave'");
		if($acceso->objeto->registros>0)
			return true;
		else
			return false;
	}
	public function incluirmotivo_inv($acceso)
	{
		return $acceso->objeto->ejecutarSql("insert into motivo_inv(campoClave) values ('$this->campoClave')");			
	}
	public function modificarmotivo_inv($acceso)
	{
		return $acceso->objeto->ejecutarSql("Update motivo_inv Set dato='$this->dato' Where campoClave='$this->campoClave'");	
	}
	public function eliminarmotivo_inv($acceso)
	{
		return $acceso->objeto->ejecutarSql("delete from motivo_inv where campoClave='$this->campoClave'");
	}
}*/
?>