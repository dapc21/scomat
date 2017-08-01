<?php
class inventario_material
{
	private $id_inv_mat;
	private $id_stock;
	private $id_inv;
	private $cant_sist;
	private $cant_real;
	private $id_unico;

	function __construct($dat)
	{
		$this->id_inv_mat = $dat['id_inv_mat'];
		$this->id_stock = $dat['id_stock'];
		$this->id_inv = $dat['id_inv'];
		$this->cant_sist = $dat['cant_sist'];
		$this->cant_real = $dat['cant_real'];
		$this->id_unico = id_unico();
	}
	public function verid_inv_mat(){
		return $this->id_inv_mat;
	}
	public function vercant_real(){
		return $this->cant_real;
	}
	public function vercant_sist(){
		return $this->cant_sist;
	}
	public function verid_inv(){
		return $this->id_inv;
	}
	public function verid_stock(){
		return $this->id_stock;
	}

	public function validaExistencia($acceso)
	{
		$acceso->objeto->ejecutarSql("select * from inventario_material where id_inv_mat='$this->id_inv_mat' and id_estatus_reg = 1");
		if($acceso->objeto->registros>0)
			return true;
		else
			return false;
	}
	public function incluir($acceso)
	{
		$acceso->objeto->ejecutarSql("insert into inventario_material(id_inv_mat,id_stock,id_inv,cant_sist,cant_real) values ('$this->id_unico','$this->id_stock','$this->id_inv','$this->cant_sist','$this->cant_real')");			
	}
	public function modificar($acceso)
	{
		return $acceso->objeto->ejecutarSql("Update inventario_material Set id_stock='$this->id_stock', id_inv='$this->id_inv', cant_sist='$this->cant_sist', cant_real='$this->cant_real' Where id_inv_mat='$this->id_inv_mat'");	
	}
	public function eliminar($acceso)
	{
		return $acceso->objeto->ejecutarSql("update inventario_material set id_estatus_reg = 2 where id_inv_mat='$this->id_inv_mat'");
	}
}
?>