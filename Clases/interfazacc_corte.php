<?php
session_start();
class interfazacc
{
	private $id_accquery;
	private $serial_deco;
	private $comando_acc;
	private $status_accquery;
	private $fecha_accquery;
	private $dato;

	function __construct($id_accquery,$serial_deco,$comando_acc,$status_accquery='FALSE',$fecha_accquery='',$dato='')
	{
		$this->id_accquery = $id_accquery;
		$this->serial_deco = $serial_deco;
		$this->comando_acc = $comando_acc;
		$this->status_accquery = $status_accquery;
		$this->fecha_accquery = date("Y-m-d");
		$this->dato = $dato;
	}
	public function verid_accquery(){
		return $this->id_accquery;
	}
	public function verdato(){
		return $this->dato;
	}
	public function verfecha_accquery(){
		return $this->fecha_accquery;
	}
	public function verstatus_accquery(){
		return $this->status_accquery;
	}
	public function vercomando_acc(){
		return $this->comando_acc;
	}
	public function verserial_deco(){
		return $this->serial_deco;
	}

	public function validaExistencia($acceso)
	{
		$acceso->objeto->ejecutarSql("select * from interfazacc where id_accquery='$this->id_accquery'");
		if($acceso->objeto->registros>0)
			return true;
		else
			return false;
	}
	public function incluirinterfazacc($acceso)
	{	
		//require_once "procesos.php"; 
		$ini_u = $_SESSION["ini_u"];  
		$acceso->objeto->ejecutarSql("select *from interfazacc  where (id_accquery ILIKE '$ini_u%') ORDER BY id_accquery desc"); 
		$this->id_accquery = $ini_u.verCo($acceso,"id_accquery");
		
		$fecha = date("Y-m-d");
		$login= $_SESSION["login"];
		$hora=date("H:i:s");
		//echo "insert into interfazacc(id_accquery,serial_deco,comando_acc,status_accquery,fecha_accquery,login,fecha,hora) values ('$this->id_accquery','$this->serial_deco','$this->comando_acc','$this->status_accquery','$this->fecha_accquery','$login','$fecha','$hora')";
		return $acceso->objeto->ejecutarSql("insert into interfazacc(id_accquery,serial_deco,comando_acc,status_accquery,fecha_accquery,login,fecha,hora) values ('$this->id_accquery','$this->serial_deco','$this->comando_acc','$this->status_accquery','$this->fecha_accquery','$login','$fecha','now()')");			
	}
	public function modificarinterfazacc($acceso)
	{
		return $acceso->objeto->ejecutarSql("Update interfazacc Set serial_deco='$this->serial_deco', comando_acc='$this->comando_acc', status_accquery='$this->status_accquery', fecha_accquery='$this->fecha_accquery' Where id_accquery='$this->id_accquery'");	
	}
	public function eliminarinterfazacc($acceso)
	{
		return $acceso->objeto->ejecutarSql("delete from interfazacc where id_accquery='$this->id_accquery'");
	}
}
?>