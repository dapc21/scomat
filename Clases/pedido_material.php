<?php
class pedido_material
{
	private $id_ped_mat;
	private $id_stock;
	private $id_ped;
	private $cant_ped_mat;
	private $cant_comp_mat;
	private $id_alm;
	private $almacen;
	private $unidad;
	private $material;
	private $id_unico;
	private $stock_material;

	function __construct($dat)
	{
		$this->id_ped_mat = $dat['id_ped_mat'];
		$this->id_stock = $dat['id_stock'];
		$this->id_ped = $dat['id_ped'];
		$this->cant_ped_mat = $dat['cant_ped_mat'];
		$this->cant_comp_mat = $dat['cant_comp_mat'];
		$this->id_alm = $dat['id_alm'];
		$this->almacen = $dat['almacen'];
		$this->unidad = $dat['unidad'];
		$this->material = $dat['material'];
		$this->id_unico = id_unico();
		$this->stock_material = $dat['stock_material'];
	}
	public function verid_ped_mat(){
		return $this->id_ped_mat;
	}
	public function vercant_ped_mat(){
		return $this->cant_ped_mat;
	}
	public function vercant_comp_mat(){
		return $this->cant_comp_mat;
	}
	public function verid_alm(){
		return $this->id_alm;
	}
	public function veralmacen(){
		return $this->almacen;
	}
	public function verunidad(){
		return $this->unidad;
	}
	public function vermaterial(){
		return $this->material;
	}
	public function verid_ped(){
		return $this->id_ped;
	}
	public function verid_stock(){
		return $this->id_stock;
	}

	public function verificarStock($acceso)
	{
		require_once "stock_material.php";
		$StockMat = new stock_material($this->stock_material[$i]);
		$acceso->objeto->ejecutarSql("select * from stock_material where id_stock='$this->id_stock'");
		while($row=row($acceso)){
			$this->stock = trim($row['stock']);
			$stockNuevo = $this->cant_comp_mat + $this->stock;
		}
		return $acceso->objeto->ejecutarSql("update stock_material set stock='$stockNuevo' where id_stock='$this->id_stock'");
	}
	
	public function incluirMovimiento($acceso,$id_unico2)
	{
		$ini_u = $_SESSION["ini_u"]; 
		return $acceso->objeto->ejecutarSql("insert into movimiento(id_mov,id_res,id_tipo_mov,id_alm,ref_mov,mot_mov) values ('$id_unico2','AB000001','558CDD7BF22DF0917878','$this->id_alm','MOV".$ini_u.substr($id_unico2, 13,20)."','COMPRA DE MATERIALES')");
	}
	
	public function incluirMovimientoMaterial($acceso,$id_unico1,$id_unico2)
	{
		return $acceso->objeto->ejecutarSql("insert into movimiento_material(id_mov_mat,id_stock,id_mov,cant_mov_mat,desc_mov_mat) values ('$id_unico1','$this->id_stock','$id_unico2','$this->cant_comp_mat','ENTRÓ A $this->almacen LA CANTIDAD DE $this->cant_comp_mat $this->unidad DEL MATERIAL $this->material')");
	}
	
	public function validaExistencia($acceso)
	{
		$acceso->objeto->ejecutarSql("select * from pedido_material where id_ped_mat='$this->id_ped_mat' and id_estatus_reg = 1");
		if($acceso->objeto->registros>0)
			return true;
		else
			return false;
	}
	public function incluir($acceso)
	{
		return $acceso->objeto->ejecutarSql("insert into pedido_material(id_ped_mat,id_stock,id_ped,cant_ped_mat) values ('$this->id_unico','$this->id_stock','$this->id_ped','$this->cant_ped_mat')");
	}
	public function modificar($acceso)
	{
		return $acceso->objeto->ejecutarSql("update pedido_material set cant_comp_mat='$this->cant_comp_mat' where id_ped='$this->id_ped' and id_stock='$this->id_stock'");	
	}
	public function eliminar($acceso)
	{
		return $acceso->objeto->ejecutarSql("update pedido_material set id_estatus_reg = 2 where id_ped_mat='$this->id_ped_mat'");
	}
}
?>