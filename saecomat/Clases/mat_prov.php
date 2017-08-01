<?php
class mat_prov
{
	private $id_mat;
	private $id_prov;
	private $dato;

	function __construct($id_mat,$id_prov,$dato)
	{
		$this->id_mat = $id_mat;
		$this->id_prov = $id_prov;
		$this->dato = $dato;
	}
	public function verid_mat(){
		return $this->id_mat;
	}
	public function verdato(){
		return $this->dato;
	}
	public function verid_prov(){
		return $this->id_prov;
	}

	public function validaExistencia($acceso)
	{
		$acceso->objeto->ejecutarSql("select * from mat_prov where id_mat='$this->id_mat' and id_prov='$this->id_prov'");
		if($acceso->objeto->registros>0)
			return true;
		else
			return false;
	}
	public function incluirmat_prov($acceso)
	{
		return $acceso->objeto->ejecutarSql("insert into mat_prov(id_mat,id_prov) values ('$this->id_mat','$this->id_prov')");			
	}
	public function modificarmat_prov($acceso)
	{
		return $acceso->objeto->ejecutarSql("Update mat_prov Set id_prov='$this->id_prov' Where id_mat='$this->id_mat'");	
	}
	public function eliminarmat_prov($acceso)
	{
		return $acceso->objeto->ejecutarSql("delete from mat_prov where id_mat='$this->id_mat'");
	}
}
?>