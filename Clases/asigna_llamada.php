<?php
class asigna_llamada
{
	private $id_all;
	private $ubica_all;
	private $fecha_all;
	private $login_enc;
	private $login_resp;
	private $obser_all;
	private $status_all;
	private $dato;

	function __construct($id_all,$ubica_all,$fecha_all,$login_enc,$login_resp,$obser_all,$status_all,$dato)
	{
		$this->id_all = $id_all;
		$this->ubica_all = $ubica_all;
		$this->fecha_all = $fecha_all;
		$this->login_enc = $login_enc;
		$this->login_resp = $login_resp;
		$this->obser_all = $obser_all;
		$this->status_all = $status_all;
		$this->dato = $dato;
	}
	public function verid_all(){
		return $this->id_all;
	}
	public function verdato(){
		return $this->dato;
	}
	public function verstatus_all(){
		return $this->status_all;
	}
	public function verobser_all(){
		return $this->obser_all;
	}
	public function verlogin_resp(){
		return $this->login_resp;
	}
	public function verlogin_enc(){
		return $this->login_enc;
	}
	public function verfecha_all(){
		return $this->fecha_all;
	}
	public function verubica_all(){
		return $this->ubica_all;
	}

	public function validaExistencia($acceso)
	{
		$acceso->objeto->ejecutarSql("select * from asigna_llamada where id_all='$this->id_all'");
		if($acceso->objeto->registros>0)
			return true;
		else
			return false;
	}
	public function incluirasigna_llamada($acceso)
	{
		return $acceso->objeto->ejecutarSql("insert into asigna_llamada(id_all,ubica_all,fecha_all,login_enc,login_resp,obser_all,status_all,dato) values ('$this->id_all','$this->ubica_all','$this->fecha_all','$this->login_enc','$this->login_resp','$this->obser_all','$this->status_all','$this->dato')");			
	}
	public function modificarasigna_llamada($acceso)
	{
		return $acceso->objeto->ejecutarSql("Update asigna_llamada Set ubica_all='$this->ubica_all', fecha_all='$this->fecha_all', login_enc='$this->login_enc', login_resp='$this->login_resp', obser_all='$this->obser_all', status_all='$this->status_all', dato='$this->dato' Where id_all='$this->id_all'");	
	}
	public function eliminarasigna_llamada($acceso)
	{
		return $acceso->objeto->ejecutarSql("delete from asigna_llamada where id_all='$this->id_all'");
	}
}
?>