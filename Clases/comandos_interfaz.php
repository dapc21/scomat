<?php
class comandos_interfaz
{
	private $id_com_int;
	private $id_tse;
	private $nombre_com_int;
	private $tipo_com;
	private $status_com_int;
	private $dato;

	function __construct($dat)
	{
		$this->id_com_int = $dat['id_com_int'];
		$this->id_tse = $dat['id_tse'];
		$this->nombre_com_int = $dat['nombre_com_int'];
		$this->tipo_com = $dat['tipo_com'];
		$this->status_com_int = $dat['status_com_int'];
		$this->dato = $dat['dato'];
	}
	public function verid_com_int(){
		return $this->id_com_int;
	}
	public function verdato(){
		return $this->dato;
	}
	public function verstatus_com_int(){
		return $this->status_com_int;
	}
	public function vertipo_com(){
		return $this->tipo_com;
	}
	public function vernombre_com_int(){
		return $this->nombre_com_int;
	}
	public function verid_tse(){
		return $this->id_tse;
	}

	public function validaExistencia($acceso)
	{
		$acceso->objeto->ejecutarSql("select * from comandos_interfaz where id_com_int='$this->id_com_int'");
		if($acceso->objeto->registros>0)
			return true;
		else
			return false;
	}
	public function incluir($acceso)
	{
		return $acceso->objeto->ejecutarSql("insert into comandos_interfaz(id_com_int,id_tse,nombre_com_int,tipo_com,status_com_int) values ('$this->id_com_int','$this->id_tse','$this->nombre_com_int','$this->tipo_com','$this->status_com_int')");			
	}
	public function modificar($acceso)
	{
		return $acceso->objeto->ejecutarSql("Update comandos_interfaz Set id_tse='$this->id_tse', nombre_com_int='$this->nombre_com_int', tipo_com='$this->tipo_com', status_com_int='$this->status_com_int' Where id_com_int='$this->id_com_int'");	
	}
	public function eliminar($acceso)
	{
		return $acceso->objeto->ejecutarSql("delete from comandos_interfaz where id_com_int='$this->id_com_int'");
	}
}
?>