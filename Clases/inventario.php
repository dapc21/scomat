<?php
class inventario
{
	private $id_inv;
	private $id_mot_inv;
	private $id_est_inv;
	private $id_alm;
	private $obser_inv;
	private $ref_inv;
	private $inventario_material;

	function __construct($dat)
	{
		$this->id_inv = $dat['id_inv'];
		$this->id_mot_inv = $dat['id_mot_inv'];
		$this->id_est_inv = $dat['id_est_inv'];
		$this->id_alm = $dat['id_alm'];
		$this->obser_inv = $dat['obser_inv'];
		$this->ref_inv = $dat['ref_inv'];
		$this->inventario_material = $dat['inventario_material'];
	}
	public function verid_inv(){
		return $this->id_inv;
	}
	public function vercant_real(){
		return $this->cant_real;
	}
	public function verref_inv(){
		return $this->ref_inv;
	}
	public function verobser_inv(){
		return $this->obser_inv;
	}
	public function verid_alm(){
		return $this->id_alm;
	}
	public function verid_est_inv(){
		return $this->id_est_inv;
	}
	public function verid_mot_inv(){
		return $this->id_mot_inv;
	}

	public function validaExistencia($acceso)
	{
		$acceso->objeto->ejecutarSql("select * from inventario where id_inv='$this->id_inv' and id_estatus_reg = 1");
		if($acceso->objeto->registros>0)
			return true;
		else
			return false;
	}
	public function incluir($acceso)
	{
		$acceso->objeto->ejecutarSql("insert into inventario(id_inv,id_mot_inv,id_est_inv,id_alm,obser_inv,ref_inv) values ('$this->id_inv','$this->id_mot_inv','$this->id_est_inv','$this->id_alm','$this->obser_inv','$this->ref_inv')");			
		require_once "inventario_material.php";
		for ($i=0; $i < count($this->inventario_material); $i++){
			$InvMat = new inventario_material($this->inventario_material[$i]);
			$InvMat->incluir($acceso);
		}
		return true;
	}
	public function modificar($acceso)
	{
		$acceso->objeto->ejecutarSql("select * from estatus_inventario where codigo_est_inv = 'FIN'");
		while($row=row($acceso)){
			$idEstInv = trim($row['id_est_inv']);
		}
		return $acceso->objeto->ejecutarSql("update inventario set id_est_inv='$idEstInv' where id_inv='$this->id_inv'");	
	}
	public function eliminar($acceso)
	{
		return $acceso->objeto->ejecutarSql("update inventario set id_estatus_reg = 2 where id_inv='$this->id_inv'");
	}
}
?>