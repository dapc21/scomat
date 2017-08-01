<?php
class movimiento_material
{
	private $id_mov_mat;
	private $id_stock;
	private $id_mov;
	private $cant_mov_mat;

	function __construct($dat)
	{
		$this->id_mov_mat = $dat['id_mov_mat'];
		$this->id_stock = $dat['id_stock'];
		$this->id_mov = $dat['id_mov'];
		$this->cant_mov_mat = $dat['cant_mov_mat'];
	}
	public function verid_mov_mat(){
		return $this->id_mov_mat;
	}
	public function vercant_mov_mat(){
		return $this->cant_mov_mat;
	}
	public function verid_mov(){
		return $this->id_mov;
	}
	public function verid_stock(){
		return $this->id_stock;
	}

	public function validaExistencia($acceso)
	{
		$acceso->objeto->ejecutarSql("select * from movimiento_material where id_mov_mat='$this->id_mov_mat'");
		if($acceso->objeto->registros>0)
			return true;
		else
			return false;
	}
	public function incluir($acceso)
	{
		return $acceso->objeto->ejecutarSql("insert into movimiento_material(id_mov_mat,id_stock,id_mov,cant_mov_mat) values ('$this->id_mov_mat','$this->id_stock','$this->id_mov','$this->cant_mov_mat')");			
	}
	public function modificar($acceso)
	{
		return $acceso->objeto->ejecutarSql("update movimiento_material set id_stock='$this->id_stock', id_mov='$this->id_mov', cant_mov_mat='$this->cant_mov_mat' where id_mov_mat='$this->id_mov_mat'");	
	}
	public function eliminar($acceso)
	{
		return $acceso->objeto->ejecutarSql("update movimiento_material set id_estatus_reg = 2 where id_mov_mat='$this->id_mov_mat'");
	}
}
?>