<?php
class movimiento
{
	private $id_mov;
	private $id_tipo_mov;
	private $id_alm;
	private $id_res;
	private $ref_mov;
	private $mot_mov;

	function __construct($dat)
	{
		$this->id_mov = $dat['id_mov'];
		$this->id_tipo_mov = $dat['id_tipo_mov'];
		$this->id_alm = $dat['id_alm'];
		$this->id_res = $dat['id_res'];
		$this->ref_mov = $dat['ref_mov'];
		$this->mot_mov = $dat['mot_mov'];
	}
	public function verid_mov(){
		return $this->id_mov;
	}
	public function vermot_mov(){
		return $this->mot_mov;
	}
	public function verref_mov(){
		return $this->ref_mov;
	}
	public function verid_alm(){
		return $this->id_alm;
	}
	public function verid_res(){
		return $this->id_res;
	}
	public function verid_tipo_mov(){
		return $this->id_tipo_mov;
	}

	public function validaExistencia($acceso)
	{
		$acceso->objeto->ejecutarSql("select * from movimiento where id_mov='$this->id_mov'");
		if($acceso->objeto->registros>0)
			return true;
		else
			return false;
	}
	public function incluir($acceso)
	{
		return $acceso->objeto->ejecutarSql("insert into movimiento(id_mov,id_tipo_mov,id_alm,id_res,ref_mov,mot_mov) values ('$this->id_mov','$this->id_tipo_mov','$this->id_alm','$this->id_res','$this->ref_mov','$this->mot_mov')");			
	}
	public function modificar($acceso)
	{
		return $acceso->objeto->ejecutarSql("Update movimiento Set id_tipo_mov='$this->id_tipo_mov', id_alm='$this->id_alm', id_res='$this->id_res', ref_mov='$this->ref_mov', mot_mov='$this->mot_mov' Where id_mov='$this->id_mov'");	
	}
	public function eliminar($acceso)
	{
		return $acceso->objeto->ejecutarSql("update movimiento set id_estatus_reg = 2 where id_mov='$this->id_mov'");
	}
}
?>