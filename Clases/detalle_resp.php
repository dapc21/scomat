<?php
class detalle_resp
{
	private $id_drl;
	private $id_trl;
	private $nombre_drl;
	private $status_drl;
	private $dato;

	function __construct($dat)
	{
		$this->id_drl =$dat['id_drl'];
		$this->id_trl =$dat['id_trl'];
		$this->nombre_drl =$dat['nombre_drl'];
		$this->status_drl =$dat['status_drl'];
		$this->dato =$dat['dato'];
	}
	public function verid_drl(){
		return $this->id_drl;
	}
	public function verdato(){
		return $this->dato;
	}
	public function verstatus_drl(){
		return $this->status_drl;
	}
	public function vernombre_drl(){
		return $this->nombre_drl;
	}
	public function verid_trl(){
		return $this->id_trl;
	}

	public function validaExistencia($acceso)
	{
		$acceso->objeto->ejecutarSql("select * from detalle_resp where id_drl='$this->id_drl'");
		if($acceso->objeto->registros>0)
			return true;
		else
			return false;
	}
	public function incluir($acceso)
	{
		return $acceso->objeto->ejecutarSql("insert into detalle_resp(id_drl,id_trl,nombre_drl,status_drl,dato) values ('$this->id_drl','$this->id_trl','$this->nombre_drl','$this->status_drl','$this->dato')");			
	}
	public function modificar($acceso)
	{
		return $acceso->objeto->ejecutarSql("Update detalle_resp Set id_trl='$this->id_trl', nombre_drl='$this->nombre_drl', status_drl='$this->status_drl', dato='$this->dato' Where id_drl='$this->id_drl'");	
	}
	public function eliminar($acceso)
	{
		return $acceso->objeto->ejecutarSql("delete from detalle_resp where id_drl='$this->id_drl'");
	}
}
?>