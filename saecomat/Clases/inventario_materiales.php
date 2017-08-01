<?php
class inventario_materiales
{
	private $id_mat;
	private $id_inv;
	private $cant_sist;
	private $cant_real;
	private $justi_inv;
	private $dato;

	function __construct($id_mat,$id_inv,$cant_sist,$cant_real,$justi_inv,$dato)
	{
		$this->id_mat = $id_mat;
		$this->id_inv = $id_inv;
		$this->cant_sist = $cant_sist;
		$this->cant_real = $cant_real;
		$this->justi_inv = $justi_inv;
		$this->dato = $dato;
	}
	public function verid_mat(){
		return $this->id_mat;
	}
	public function verdato(){
		return $this->dato;
	}
	public function verjusti_inv(){
		return $this->justi_inv;
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
	public function validaExistencia($acceso)
	{
		$acceso->objeto->ejecutarSql("select * from inventario_materiales where id_mat='$this->id_mat' and id_inv='$this->id_inv'");
		if($acceso->objeto->registros>0)
			return true;
		else
			return false;
	}
	public function incluirinventario_materiales($acceso)
	{
		
		return $acceso->objeto->ejecutarSql("insert into inventario_materiales(id_mat,id_inv,cant_sist,cant_real,justi_inv) values ('$this->id_mat','$this->id_inv','$this->cant_sist','$this->cant_real','$this->justi_inv')");			
	}
	public function modificarinventario_materiales($acceso)
	{
	//	ECHO "Update inventario_materiales Set id_inv='$this->id_inv', cant_sist='$this->cant_sist', cant_real='$this->cant_real', justi_inv='$this->justi_inv' Where id_mat='$this->id_mat'";
		return $acceso->objeto->ejecutarSql("Update inventario_materiales Set id_inv='$this->id_inv', cant_sist='$this->cant_sist', cant_real='$this->cant_real', justi_inv='$this->justi_inv' Where id_mat='$this->id_mat' and id_inv='$this->id_inv'");	
	}
	public function eliminarinventario_materiales($acceso)
	{
		return $acceso->objeto->ejecutarSql("delete from inventario_materiales where id_mat='$this->id_mat' and id_inv='$this->id_inv'");
	}
}
?>