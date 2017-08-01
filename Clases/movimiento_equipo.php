<?php
class movimiento_equipo
{
	private $id_mov_e;
	private $id_es;
	private $ubic_ant;
	private $ubic_post;
	private $login;
	private $fecha;
	private $motivo;
	private $dato;

	function __construct($dat)
	{
		$this->id_mov_e = $dat['id_mov_e'];
		$this->id_es = $dat['id_es'];
		$this->ubic_ant = $dat['ubic_ant'];
		$this->ubic_post = $dat['ubic_post'];
		session_start();
		$this->login = strtoupper(trim($_SESSION["login"]));
		$this->fecha = date("Y-m-d");
		$this->motivo = $dat['motivo'];
		$this->dato = $dat['dato'];
	}
	public function verid_mov_e(){
		return $this->id_mov_e;
	}
	public function verdato(){
		return $this->dato;
	}
	public function vermotivo(){
		return $this->motivo;
	}
	public function verfecha(){
		return $this->fecha;
	}
	public function verlogin(){
		return $this->login;
	}
	public function verubic_post(){
		return $this->ubic_post;
	}
	public function verubic_ant(){
		return $this->ubic_ant;
	}
	public function verid_es(){
		return $this->id_es;
	}

	public function validaExistencia($acceso)
	{
		$acceso->objeto->ejecutarSql("select * from movimiento_equipo where id_mov_e='$this->id_mov_e'");
		if($acceso->objeto->registros>0)
			return true;
		else
			return false;
	}
	public function incluir($acceso)
	{
		return $acceso->objeto->ejecutarSql("insert into movimiento_equipo(id_mov_e,id_es,ubic_ant,ubic_post,login,fecha,motivo) values ('$this->id_mov_e','$this->id_es','$this->ubic_ant','$this->ubic_post','$this->login','now()','$this->motivo')");			
	}
	public function modificar($acceso)
	{
		return $acceso->objeto->ejecutarSql("Update movimiento_equipo Set id_es='$this->id_es', ubic_ant='$this->ubic_ant', ubic_post='$this->ubic_post', login='$this->login', fecha='$this->fecha', motivo='$this->motivo' Where id_mov_e='$this->id_mov_e'");	
	}
	public function eliminar($acceso)
	{
		return $acceso->objeto->ejecutarSql("delete from movimiento_equipo where id_mov_e='$this->id_mov_e'");
	}
}
?>