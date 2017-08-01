<?php
class precintos
{
	private $id_prec;
	private $login;
	private $nombre_prec;
	private $fecha_ing_prec;
	private $fecha_mod_prec;
	private $status_prec;
	private $dato;

	function __construct($id_prec,$login,$nombre_prec,$fecha_ing_prec,$fecha_mod_prec,$status_prec,$dato)
	{
		$this->id_prec = $id_prec;
		$this->login = $login;
		$this->nombre_prec = $nombre_prec;
		$this->fecha_ing_prec = $fecha_ing_prec;
		$this->fecha_mod_prec = $fecha_mod_prec;
		$this->status_prec = $status_prec;
		$this->dato = $dato;
	}
	public function verid_prec(){
		return $this->id_prec;
	}
	public function verdato(){
		return $this->dato;
	}
	public function verstatus_prec(){
		return $this->status_prec;
	}
	public function verfecha_mod_prec(){
		return $this->fecha_mod_prec;
	}
	public function verfecha_ing_prec(){
		return $this->fecha_ing_prec;
	}
	public function vernombre_prec(){
		return $this->nombre_prec;
	}
	public function verlogin(){
		return $this->login;
	}

	public function validaExistencia($acceso)
	{
		$acceso->objeto->ejecutarSql("select * from precintos where id_prec='$this->id_prec'");
		if($acceso->objeto->registros>0)
			return true;
		else
			return false;
	}
	public function incluirprecintos($acceso)
	{
		return $acceso->objeto->ejecutarSql("insert into precintos(id_prec,login,nombre_prec,fecha_ing_prec,fecha_mod_prec,status_prec) values ('$this->id_prec','$this->login','$this->nombre_prec','$this->fecha_ing_prec','$this->fecha_mod_prec','$this->status_prec')");			
	}
	public function modificarprecintos($acceso)
	{
		return $acceso->objeto->ejecutarSql("Update precintos Set login='$this->login', nombre_prec='$this->nombre_prec', fecha_ing_prec='$this->fecha_ing_prec', fecha_mod_prec='$this->fecha_mod_prec', status_prec='$this->status_prec' Where id_prec='$this->id_prec'");	
	}
	public function eliminarprecintos($acceso)
	{
		return $acceso->objeto->ejecutarSql("delete from precintos where id_prec='$this->id_prec'");
	}
}
?>