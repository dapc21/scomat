<?php
class tipo_llamada
{
	private $id_tll;
	private $nombre_tll;
	private $status_tll;
	private $dato;

	function __construct($dat)
	{
		$this->id_tll =$dat['id_tll'];
		$this->nombre_tll =$dat['nombre_tll'];
		$this->status_tll =$dat['status_tll'];
		$this->dato =$dat['dato'];
	}
	public function verid_tll(){
		return $this->id_tll;
	}
	public function verdato(){
		return $this->dato;
	}
	public function verstatus_tll(){
		return $this->status_tll;
	}
	public function vernombre_tll(){
		return $this->nombre_tll;
	}

	public function validaExistencia($acceso)
	{
		$acceso->objeto->ejecutarSql("select * from tipo_llamada where id_tll='$this->id_tll'");
		if($acceso->objeto->registros>0)
			return true;
		else
			return false;
	}
	public function incluir($acceso)
	{
		return $acceso->objeto->ejecutarSql("insert into tipo_llamada(id_tll,nombre_tll,status_tll,dato) values ('$this->id_tll','$this->nombre_tll','$this->status_tll','$this->dato')");			
	}
	public function modificar($acceso)
	{
		return $acceso->objeto->ejecutarSql("Update tipo_llamada Set nombre_tll='$this->nombre_tll', status_tll='$this->status_tll', dato='$this->dato' Where id_tll='$this->id_tll'");	
	}
	public function eliminar($acceso)
	{
		return $acceso->objeto->ejecutarSql("delete from tipo_llamada where id_tll='$this->id_tll'");
	}
}
?>