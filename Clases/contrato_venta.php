<?php
class contrato_venta
{
	private $id_g_a;
	private $nombre_g_a;
	private $status_g_a;
	private $dato;

	function __construct($id_g_a,$nombre_g_a,$status_g_a,$dato)
	{
		$this->id_g_a = $id_g_a;
		$this->nombre_g_a = $nombre_g_a;
		$this->status_g_a = $status_g_a;
		$this->dato = $dato;
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
		$acceso->objeto->ejecutarSql("select * from contrato_venta where id_g_a='$this->id_g_a'");
		if($acceso->objeto->registros>0)
			return true;
		else
			return false;
	}
	public function incluircontrato_venta($acceso)
	{
		
		 $acceso->objeto->ejecutarSql("insert into contrato_venta(id_g_a,nombre_g_a,status_g_a) values ('$this->id_g_a','$this->nombre_g_a','$this->status_g_a')");			
			
	}
	public function modificarcontrato_venta($acceso)
	{
		
		 $acceso->objeto->ejecutarSql("Update contrato_venta Set nombre_g_a='$this->nombre_g_a', status_g_a='$this->status_g_a' Where id_g_a='$this->id_g_a'");	
			
	}
	public function eliminarcontrato_venta($acceso)
	{
		
		 $acceso->objeto->ejecutarSql("delete from contrato_venta where id_g_a='$this->id_g_a'");
			
	}
}
?>