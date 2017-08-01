<?php
class llamadas
{
	private $id_lla;
	private $id_drl;
	private $id_tll;
	private $id_contrato;
	private $fecha_lla;
	private $hora_lla;
	private $login;
	private $obser_lla;
	private $crea_alarma;
	private $dato;
	
	function __construct($dat)
	{
		$this->id_lla = $dat['id_lla'];
		$this->id_drl =$dat['id_drl'];
		$this->id_tll =$dat['id_tll'];
		$this->id_contrato =$dat['id_contrato'];
		$this->fecha_lla =$dat['fecha_lla'];
		$this->hora_lla =$dat['hora_lla'];
		$this->login =$dat['login'];
		$this->obser_lla =$dat['obser_lla'];
		$this->crea_alarma =$dat['crea_alarma'];
		$this->dato = $dat['dato'];		
	}
	public function verid_lla(){
		return $this->id_lla;
	}
	public function verdato(){
		return $this->dato;
	}
	public function vercrea_alarma(){
		return $this->crea_alarma;
	}
	public function verobser_lla(){
		return $this->obser_lla;
	}
	public function verlogin(){
		return $this->login;
	}
	public function verhora_lla(){
		return $this->hora_lla;
	}
	public function verfecha_lla(){
		return $this->fecha_lla;
	}
	public function verid_contrato(){
		return $this->id_contrato;
	}
	public function verid_tll(){
		return $this->id_tll;
	}
	public function verid_drl(){
		return $this->id_drl;
	}

	public function validaExistencia($acceso)
	{
		$acceso->objeto->ejecutarSql("select * from llamadas where id_lla='$this->id_lla'");
		if($acceso->objeto->registros>0)
			return true;
		else
			return false;
	}
	public function incluir($acceso)
	{
		
		$acceso->objeto->ejecutarSql("insert into llamadas(id_lla,id_drl,id_tll,id_contrato,fecha_lla,hora_lla,login,obser_lla,crea_alarma,dato) values ('$this->id_lla','$this->id_drl','$this->id_tll','$this->id_contrato','$this->fecha_lla','$this->hora_lla','$this->login','$this->obser_lla','$this->crea_alarma','$this->dato')");		
		if($this->id_lc!=''){
			$acceso->objeto->ejecutarSql("Update asig_lla_cli Set  id_lla='$this->id_lla', status_lc='LLAMADO' Where id_lc='$this->id_lc'");	
		}
	}
	public function modificar($acceso)
	{
		return $acceso->objeto->ejecutarSql("Update llamadas Set id_drl='$this->id_drl', id_tll='$this->id_tll', id_contrato='$this->id_contrato', fecha_lla='$this->fecha_lla', hora_lla='$this->hora_lla', login='$this->login', obser_lla='$this->obser_lla', crea_alarma='$this->crea_alarma', dato='$this->dato' Where id_lla='$this->id_lla'");	
	}
	public function eliminar($acceso)
	{
		return $acceso->objeto->ejecutarSql("delete from llamadas where id_lla='$this->id_lla'");
	}
}
?>