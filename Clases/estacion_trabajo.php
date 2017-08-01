<?php
class estacion_trabajo
{
	private $id_est;
	private $login;
	private $nombre_est;
	private $ip_est;
	private $mac_est;
	private $nom_comp;
	private $status_est;
	private $dato;

	function __construct($dat)
	{
		$this->id_est = $dat['id_est'];
		$this->login = $dat['login'];
		$this->nombre_est = $dat['nombre_est'];
		$this->ip_est = $dat['ip_est'];
		$this->mac_est = $dat['mac_est'];
		$this->nom_comp = $dat['nom_comp'];
		$this->status_est = $dat['status_est'];
		$this->dato = $dat['dato'];
	}
	public function verid_est(){
		return $this->id_est;
	}
	public function verdato(){
		return $this->dato;
	}
	public function verstatus_est(){
		return $this->status_est;
	}
	public function vernom_comp(){
		return $this->nom_comp;
	}
	public function vermac_est(){
		return $this->mac_est;
	}
	public function verip_est(){
		return $this->ip_est;
	}
	public function vernombre_est(){
		return $this->nombre_est;
	}
	public function verlogin(){
		return $this->login;
	}

	public function validaExistencia($acceso)
	{
		$acceso->objeto->ejecutarSql("select * from estacion_trabajo where id_est='$this->id_est'");
		if($acceso->objeto->registros>0)
			return true;
		else
			return false;
	}
	public function incluir($acceso)
	{
		return $acceso->objeto->ejecutarSql("insert into estacion_trabajo(id_est,login,nombre_est,ip_est,mac_est,nom_comp,status_est) values ('$this->id_est','$this->login','$this->nombre_est','$this->ip_est','$this->mac_est','$this->nom_comp','$this->status_est')");			
	}
	public function modificar($acceso)
	{
		return $acceso->objeto->ejecutarSql("Update estacion_trabajo Set login='$this->login', nombre_est='$this->nombre_est', ip_est='$this->ip_est', mac_est='$this->mac_est', nom_comp='$this->nom_comp', status_est='$this->status_est' Where id_est='$this->id_est'");	
	}
	public function eliminar($acceso)
	{
		return $acceso->objeto->ejecutarSql("delete from estacion_trabajo where id_est='$this->id_est'");
	}
}
?>