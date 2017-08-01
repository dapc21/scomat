<?php
class grupo_afinidad
{
	private $id_g_a;
	private $nombre_g_a;
	private $status_g_a;
	private $dato;

	function __construct($dat)
	{
		$this->id_g_a = $dat['id_g_a'];
		$this->nombre_g_a = $dat['nombre_g_a'];
		$this->status_g_a = $dat['status_g_a'];
		$this->dato = $dat['dato'];
	}
	public function verid_g_a(){
		return $this->id_g_a;
	}
	public function verdato(){
		return $this->dato;
	}
	public function verstatus_g_a(){
		return $this->status_g_a;
	}
	public function vernombre_g_a(){
		return $this->nombre_g_a;
	}

	public function validaExistencia($acceso)
	{
		$acceso->objeto->ejecutarSql("select * from grupo_afinidad where id_g_a='$this->id_g_a'");
		if($acceso->objeto->registros>0)
			return true;
		else
			return false;
	}
	public function incluir($acceso)
	{
		return $acceso->objeto->ejecutarSql("insert into grupo_afinidad(id_g_a,nombre_g_a,status_g_a) values ('$this->id_g_a','$this->nombre_g_a','$this->status_g_a')");			
	}
	public function modificar($acceso)
	{
		return $acceso->objeto->ejecutarSql("Update grupo_afinidad Set nombre_g_a='$this->nombre_g_a', status_g_a='$this->status_g_a' Where id_g_a='$this->id_g_a'");	
	}
	public function eliminar($acceso)
	{
		return $acceso->objeto->ejecutarSql("delete from grupo_afinidad where id_g_a='$this->id_g_a'");
	}
}
?>