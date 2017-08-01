<?php
class pedido
{
	private $id_ped;
	private $ref_ped;
	private $id_est_ped;
	private $obser_ped;
	private $pedido_material;
	private $id_unico2;

	function __construct($dat)
	{
		$this->id_ped = $dat['id_ped'];
		$this->ref_ped = $dat['ref_ped'];
		$this->id_est_ped = $dat['id_est_ped'];
		$this->obser_ped = $dat['obser_ped'];
		$this->pedido_material = $dat['pedido_material'];
		$this->id_unico2 = id_unico();
	}
	public function verid_ped(){
		return $this->id_ped;
	}
	public function verobser_ped(){
		return $this->obser_ped;
	}
	public function verid_est_ped(){
		return $this->id_est_ped;
	}
	public function verref_ped(){
		return $this->ref_ped;
	}

	public function validaExistencia($acceso)
	{
		$acceso->objeto->ejecutarSql("select * from pedido where id_ped='$this->id_ped' and id_estatus_reg = 1");
		if($acceso->objeto->registros>0)
			return true;
		else
			return false;
	}
	public function incluir($acceso)
	{
		$acceso->objeto->ejecutarSql("insert into pedido(id_ped,ref_ped,id_est_ped,obser_ped) values ('$this->id_ped','$this->ref_ped','$this->id_est_ped','$this->obser_ped')");
		require_once "pedido_material.php";
		for ($i=0; $i < count($this->pedido_material); $i++){
			$PedMat = new pedido_material($this->pedido_material[$i]);
			$PedMat->incluir($acceso);
		}
		return true;
	}
	public function modificar($acceso)
	{
		$acceso->objeto->ejecutarSql("select * from estatus_pedido where codigo_est_ped = 'COM'");
		while($row=row($acceso)){
			$idEstPed = trim($row['id_est_ped']);
		}
		$acceso->objeto->ejecutarSql("update pedido set id_est_ped='$idEstPed' where id_ped='$this->id_ped'");
		require_once "pedido_material.php";
		for ($i=0; $i < count($this->pedido_material); $i++){
			$PedMat = new pedido_material($this->pedido_material[$i]);
			$verificaStock = $PedMat->verificarStock($acceso);
			if( $verificaStock ){
				$PedMat->modificar($acceso);
			}
		}
		$incluirMovimiento = $PedMat->incluirMovimiento($acceso,$this->id_unico2);
		for ($j=0; $j < count($this->pedido_material); $j++){
			$id_unico1 = id_unico();
			if( $incluirMovimiento ){
				$PedMat1 = new pedido_material($this->pedido_material[$j]);
				$PedMat1->incluirMovimientoMaterial($acceso,$id_unico1,$this->id_unico2);
			}
		}
		return true;
	}
	public function eliminar($acceso)
	{
		return $acceso->objeto->ejecutarSql("update pedido set id_estatus_reg = 2 where id_ped='$this->id_ped'");
	}
}
?>