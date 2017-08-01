<?php
class mat_ped
{
	private $id_mat;
	private $id_ped;
	private $cant_ped;
	private $cant_ent;
	private $precio;
	private $dato;

	function __construct($id_mat,$id_ped,$cant_ped,$cant_ent,$precio,$dato)
	{
		$this->id_mat = $id_mat;
		$this->id_ped = $id_ped;
		$this->cant_ped = $cant_ped;
		$this->cant_ent = $cant_ent;
		$this->precio = $precio;
		$this->dato = $dato;
	}
	public function verid_mat(){
		return $this->id_mat;
	}
	public function verdato(){
		return $this->dato;
	}
	public function verprecio(){
		return $this->precio;
	}
	public function vercant_ent(){
		return $this->cant_ent;
	}
	public function vercant_ped(){
		return $this->cant_ped;
	}
	public function verid_ped(){
		return $this->id_ped;
	}

	public function validaExistencia($acceso)
	{
		$acceso->objeto->ejecutarSql("select * from mat_ped where id_mat='$this->id_mat and id_ped='$this->id_ped''");
		if($acceso->objeto->registros>0)
			return true;
		else
			return false;
	}
	public function incluirmat_ped($acceso)
	{
		//ECHO "insert into mat_ped(id_mat,id_ped,cant_ped,cant_ent,precio) values ('$this->id_mat','$this->id_ped','$this->cant_ped','$this->cant_ent','$this->precio')";
		return $acceso->objeto->ejecutarSql("insert into mat_ped(id_mat,id_ped,cant_ped,cant_ent,precio) values ('$this->id_mat','$this->id_ped','$this->cant_ped','$this->cant_ent','$this->precio')");			
	}
	public function modificarmat_ped($acceso)
	{
		return $acceso->objeto->ejecutarSql("Update mat_ped Set id_ped='$this->id_ped', cant_ped='$this->cant_ped', cant_ent='$this->cant_ent', precio='$this->precio' Where id_mat='$this->id_mat'");	
	}
	public function eliminarmat_ped($acceso)
	{
		return $acceso->objeto->ejecutarSql("delete from mat_ped where id_mat='$this->id_mat'");
	}
	
}
?>