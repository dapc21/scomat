<?php
class interfaz_equipos
{
	private $id_inte;
	private $id_com_int;
	private $id_es;
	private $status;
	private $fecha;
	private $login;
	private $errmsg;
	private $cad_env;
	private $cad_rec;
	private $dato;

	function __construct($dat)
	{
		$this->id_inte = $dat['id_inte'];
		$this->id_com_int = $dat['id_com_int'];
		$this->id_es = $dat['id_es'];
		$this->status = "FALSE";
		$this->fecha = date("Y-m-d");
		session_start();
		$this->login = strtoupper(trim($_SESSION["login"]));
		$this->errmsg = '';
		$this->cad_env = '';
		$this->cad_rec = '';
		$this->dato = $dat['dato'];
	}
	public function verid_inte(){
		return $this->id_inte;
	}
	public function verdato(){
		return $this->dato;
	}
	public function vercad_rec(){
		return $this->cad_rec;
	}
	public function vercad_env(){
		return $this->cad_env;
	}
	public function vererrmsg(){
		return $this->errmsg;
	}
	public function verlogin(){
		return $this->login;
	}
	public function verfecha(){
		return $this->fecha;
	}
	public function verstatus(){
		return $this->status;
	}
	public function verid_es(){
		return $this->id_es;
	}
	public function verid_com_int(){
		return $this->id_com_int;
	}
	public function validaExistencia($acceso)
	{
		$acceso->objeto->ejecutarSql("select * from interfaz_equipos where id_inte='$this->id_inte'");
		if($acceso->objeto->registros>0)
			return true;
		else
			return false;
	}
	public function incluir($acceso)
	{
		 $acceso->objeto->ejecutarSql("insert into interfaz_equipos(id_inte,id_com_int,id_es,status,fecha,login) values ('$this->id_inte','$this->id_com_int','$this->id_es','$this->status','now()','$this->login')");
		/*
		 echo "select *from comandos_interfaz WHERE status_com_int='ACTIVO' and id_tse='$id_tse' and tipo_com='REFRESCAR' ";
		$acceso->objeto->ejecutarSql("select *from comandos_interfaz WHERE status_com_int='ACTIVO' and id_tse='$id_tse' and tipo_com='REFRESCAR' ");
		if ($row=row($acceso))
		{
			$id_com_int=trim($row["id_com_int"]);
			$acceso->objeto->ejecutarSql("insert into interfaz_equipos(id_inte,id_com_int,id_es,status,fecha,login) values ('$id_inte','$id_com_int','$id_es','$status','now()','$login')");
			$id_inte=$ini_u.verCoo_inc($acceso,$id_inte);
		}
		*/
	}
	public function modificar($acceso)
	{
		return $acceso->objeto->ejecutarSql("Update interfaz_equipos Set id_com_int='$this->id_com_int', id_es='$this->id_es', status='$this->status', fecha='$this->fecha', login='$this->login'");
	}
	public function eliminar($acceso)
	{
		return $acceso->objeto->ejecutarSql("delete from interfaz_equipos where id_inte='$this->id_inte'");
	}
}
?>