<?php
class asig_lla_cli
{
	private $id_lc;
	private $id_all;
	private $id_contrato;
	private $id_lla;
	private $status_lc;
	private $dato;

	function __construct($id_lc,$id_all,$id_contrato,$id_lla,$status_lc,$dato)
	{
		$this->id_lc = $id_lc;
		$this->id_all = $id_all;
		$this->id_contrato = $id_contrato;
		$this->id_lla = $id_lla;
		$this->status_lc = $status_lc;
		$this->dato = $dato;
	}
	public function verid_lc(){
		return $this->id_lc;
	}
	public function verdato(){
		return $this->dato;
	}
	public function verstatus_lc(){
		return $this->status_lc;
	}
	public function verid_lla(){
		return $this->id_lla;
	}
	public function verid_contrato(){
		return $this->id_contrato;
	}
	public function verid_all(){
		return $this->id_all;
	}

	public function validaExistencia($acceso)
	{
		$acceso->objeto->ejecutarSql("select * from asig_lla_cli where id_lc='$this->id_lc'");
		if($acceso->objeto->registros>0)
			return true;
		else
			return false;
	}
	public function incluirasig_lla_cli($acceso)
	{
		return $acceso->objeto->ejecutarSql("insert into asig_lla_cli(id_lc,id_all,id_contrato,id_lla,status_lc,dato) values ('$this->id_lc','$this->id_all','$this->id_contrato','$this->id_lla','$this->status_lc','$this->dato')");			
	}
	public function modificarasig_lla_cli($acceso)
	{
		return $acceso->objeto->ejecutarSql("Update asig_lla_cli Set id_all='$this->id_all', id_contrato='$this->id_contrato', id_lla='$this->id_lla', status_lc='$this->status_lc', dato='$this->dato' Where id_lc='$this->id_lc'");	
	}
	public function eliminarasig_lla_cli($acceso)
	{
		return $acceso->objeto->ejecutarSql("delete from asig_lla_cli where id_lc='$this->id_lc'");
	}
}
?>