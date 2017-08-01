<?php
class stock_material
{
	private $id_stock;
	private $id_alm;
	private $id_mat;
	private $stock;
	private $stock_min;
	private $stock_material;

	function __construct($dat)
	{
		$this->id_stock = $dat['id_stock'];
		$this->id_alm = $dat['id_alm'];
		$this->id_mat = $dat['id_mat'];
		$this->stock = $dat['stock'];
		$this->stock_min = $dat['stock_min'];
		$this->stock_material = $dat['stock_material'];
	}
	public function verid_stock(){
		return $this->id_stock;
	}
	public function verstock_min(){
		return $this->stock_min;
	}
	public function verstock(){
		return $this->stock;
	}
	public function verid_mat(){
		return $this->id_mat;
	}
	public function verid_alm(){
		return $this->id_alm;
	}

	public function validaExistencia($acceso)
	{
		$acceso->objeto->ejecutarSql("select * from stock_material where id_stock='$this->id_stock' and id_estatus_reg = 1");
		if($acceso->objeto->registros>0)
			return true;
		else
			return false;
	}
	public function ajustarStock($acceso)
	{
		for ($i=0; $i < count($this->stock_material); $i++){
			$StockMat = new stock_material($this->stock_material[$i]);
			$StockMat->modificar($acceso);
		}
	}
	public function incluir($acceso)
	{
		return $acceso->objeto->ejecutarSql("insert into stock_material(id_stock,id_alm,id_mat,stock,stock_min) values ('$this->id_stock','$this->id_alm','$this->id_mat','$this->stock','$this->stock_min')");			
	}
	public function modificar($acceso)
	{
		return $acceso->objeto->ejecutarSql("update stock_material set stock='$this->stock' where id_stock='$this->id_stock'");	
	}
	public function eliminar($acceso)
	{
		return $acceso->objeto->ejecutarSql("update stock_material set id_estatus_reg = 2 where id_stock='$this->id_stock'");
	}
	
}
?>