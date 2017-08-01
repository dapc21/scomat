<?php
require_once "procesos.php";
class mov_mat_orden
{
	private $id_mat;
	private $id_mov;
	private $cant_mov;
	private $dato;

	function __construct($id_mat,$id_mov,$cant_mov,$dato)
	{
		$this->id_mat = $id_mat;
		$this->id_mov = $id_mov;
		$this->cant_mov = $cant_mov;
		$this->dato = $dato;
	}
	public function verid_mat(){
		return $this->id_mat;
	}
	public function verdato(){
		return $this->dato;
	}
	public function vercant_mov(){
		return $this->cant_mov;
	}
	public function verid_mov(){
		return $this->id_mov;
	}

	public function validaExistencia($acceso)
	{
		$acceso->objeto->ejecutarSql("select * from mov_mat_orden where id_mat='$this->id_mat' and id_mov='$this->id_mov'");
		if($acceso->objeto->registros>0)
			return true;
		else
			return false;
	}
	public function incluirmov_mat_orden($acceso)
	{
		return $acceso->objeto->ejecutarSql("insert into mov_mat_orden(id_mat,id_mov,cant_mov) values ('$this->id_mat','$this->id_mov','$this->cant_mov')");	
	}	
	public function modificarmov_mat_orden($acceso)
	{
		return $acceso->objeto->ejecutarSql("Update mov_mat_orden Set id_mov='$this->id_mov', cant_mov='$this->cant_mov' Where id_mat='$this->id_mat'");	
	}
	public function eliminarmov_mat_orden($acceso)
	{
		return $acceso->objeto->ejecutarSql("delete from mov_mat_orden where id_mat='$this->id_mat' and id_mov='$this->id_mov'");
	}
}
?>