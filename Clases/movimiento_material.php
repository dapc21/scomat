<?php
class movimiento_material
{
	private $id_mov_mat;
	private $id_stock;
	private $id_mov;
	private $cant_mov_mat;
	private $cant_stock_disp;
	private $id_stock2;
	private $id_alm2;
	private $id_mat2;
	private $stock_material;
	private $stock_material_destino;
	private $id_mov_mat2;

	function __construct($dat)
	{
		$this->id_mov_mat = id_unico();
		$this->id_stock = $dat['id_stock'];
		$this->id_mov = $dat['id_mov'];
		$this->cant_mov_mat = $dat['cant_mov_mat'];
		$this->cant_stock_disp = $dat['cant_stock_disp'];
		$this->id_stock2 = $dat['id_stock2'];
		$this->id_alm2 = $dat['id_alm2'];
		$this->id_mat2 = $dat['id_mat2'];
		$this->stock_material = $dat['stock_material'];
		$this->stock_material_destino = $dat['stock_material_destino'];
		$this->id_mov_mat2 = id_unico();
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
	
	public function descripcionMovStock($acceso, $idStock)
	{
		$acceso->objeto->ejecutarSql("select * from vista_stock_material where id_stock='$idStock' and id_estatus_reg = 1");
		if($acceso->objeto->registros>0){
			while($row = row($acceso)){
				$material = trim($row['nombre_mat']);
				$unidad = trim($row['abrev_uni_sal']);
				$almacen = trim($row['nombre_alm']);
			}
			$cantidad = (double)$this->cant_mov_mat;
			$descripcion = "$almacen LA CANTIDAD DE $cantidad $unidad DEL MATERIAL $material";
			return $descripcion;
		}
		else{
			return false; //probablemente devolver un mensaje que no existe el movimiento
		}
	}
	
	public function verificarExistenciaStock($acceso, $tipoMov)
	{
		require_once "stock_material.php";
		$stock_material = array();
		$ope = false;
		$stockDisp = (double)$this->cant_stock_disp;
		$cantidad = (double)$this->cant_mov_mat;
		//verificamos que exista el stock
		$acceso->objeto->ejecutarSql("select * from stock_material where id_stock='$this->id_stock' and id_estatus_reg = 1");
		if($acceso->objeto->registros>0){ //existe el stock
				
			if( $tipoMov == 'ENTRADA' ){ //si es entrada puedo añadir
				$stock = $stockDisp + $cantidad;
			}
			else{ //sino va a haber descuentos en stock
				if( $stockDisp >= $cantidad ){ //si el stock es mayor a lo que solicito puedo descontar
					if( $tipoMov == 'SALIDA' ){
						$stock = $stockDisp - $cantidad;
					}
					if( $tipoMov == 'TRANSFERENCIA' ){
						$stock = $stockDisp - $cantidad;						
						$ope = true;
					}
				}
				else return false; //probablemente devolver un mensaje que no cubre el stock
			}
		
			$stock_material['id_stock'] = $this->id_stock;
			$stock_material['stock'] = $stock;
			$StockMat = new stock_material($stock_material);
			$StockMat->modificar($acceso);
			
			if($ope){ //si es transferencia haz el traspaso pero antes comprueba si existe el stock del destino (si existe modifica sino ingresa)
				$acceso->objeto->ejecutarSql("select * from stock_material where id_alm='$this->id_alm2' and id_mat='$this->id_mat2' and id_estatus_reg = 1");
				if($acceso->objeto->registros>0){
					$stockMatDest = array();
					while($row = row($acceso)){
						$id_stock2 = trim($row['id_stock']);
						$stockDispDest = trim($row['stock']);
					}
					$stockA = (double)$stockDispDest + $cantidad;
					
					$stockMatDest['id_stock'] = $id_stock2;
					$stockMatDest['stock'] = $stockA;
					$StockAum = new stock_material($stockMatDest);
					$StockAum->modificar($acceso);
				}
				else{
					$StockMat = new stock_material($this->stock_material_destino);
					$StockMat->incluir($acceso);
				}
			}
						
		}
		else{ //no existe el stock
			$StockMat = new stock_material($this->stock_material);
			$StockMat->incluir($acceso);
		}
		return true;
	}
	
	public function incluir($acceso, $tipoMov)
	{
		$idStock = $this->id_stock;
		$acceso->objeto->ejecutarSql("select * from stock_material where id_alm='$this->id_alm2' and id_mat='$this->id_mat2' and id_estatus_reg = 1");
		if($acceso->objeto->registros>0){
			while($row = row($acceso)){
				$idStock2 = trim($row['id_stock']);
			}
		}else{
			$idStock2 = $this->id_stock2;
		}
		
		if( $tipoMov == 'ENTRADA' ){
			$descMovStock = $this->descripcionMovStock($acceso, $idStock);
			$desc_mov_mat2 = "ENTRÓ A $descMovStock";
			return $acceso->objeto->ejecutarSql("insert into movimiento_material(id_mov_mat,id_stock,id_mov,cant_mov_mat,desc_mov_mat) values ('$this->id_mov_mat','$this->id_stock','$this->id_mov','$this->cant_mov_mat','$desc_mov_mat2')");
		}
		if( $tipoMov == 'SALIDA' ){
			$descMovStock = $this->descripcionMovStock($acceso, $idStock);
			$desc_mov_mat = "SALIÓ DE $descMovStock";
			return $acceso->objeto->ejecutarSql("insert into movimiento_material(id_mov_mat,id_stock,id_mov,cant_mov_mat,desc_mov_mat) values ('$this->id_mov_mat','$this->id_stock','$this->id_mov','$this->cant_mov_mat','$desc_mov_mat')");
		}
		if( $tipoMov == 'TRANSFERENCIA' ){
			$descMovStock = $this->descripcionMovStock($acceso, $idStock);
			$desc_mov_mat = "SALIÓ DE $descMovStock";
			//Descuento de origen
			$acceso->objeto->ejecutarSql("insert into movimiento_material(id_mov_mat,id_stock,id_mov,cant_mov_mat,desc_mov_mat) values ('$this->id_mov_mat','$this->id_stock','$this->id_mov','$this->cant_mov_mat','$desc_mov_mat')");
			
			$descMovStock = $this->descripcionMovStock($acceso, $idStock2);
			$desc_mov_mat2 = "ENTRÓ A $descMovStock";
			//Aumento en destino
			$acceso->objeto->ejecutarSql("insert into movimiento_material(id_mov_mat,id_stock,id_mov,cant_mov_mat,desc_mov_mat) values ('$this->id_mov_mat2','$idStock2','$this->id_mov','$this->cant_mov_mat','$desc_mov_mat2')");
			
			return true;
		}
	}
	
	public function modificar($acceso)
	{
		return $acceso->objeto->ejecutarSql("Update movimiento_material Set id_stock='$this->id_stock', id_mov='$this->id_mov', cant_mov_mat='$this->cant_mov_mat' Where id_mov_mat='$this->id_mov_mat'");	
	}
	
	public function eliminar($acceso)
	{
		return $acceso->objeto->ejecutarSql("delete from movimiento_material where id_mov_mat='$this->id_mov_mat'");
	}
}
?>