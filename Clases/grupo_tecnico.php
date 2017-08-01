<?php
class grupo_tecnico
{
	private $id_gt;
	private $id_persona;
	private $dato;

	function __construct($id_gt,$id_persona,$dato)
	{
		$this->id_gt = $id_gt;
		$this->id_persona = $id_persona;
		$this->dato = $dato;
	}
	public function verid_gt(){
		return $this->id_gt;
	}
	public function verdato(){
		return $this->dato;
	}
	public function verid_persona(){
		return $this->id_persona;
	}
	public function validaExistencia($acceso)
	{
		$acceso->objeto->ejecutarSql("select * from grupo_tecnico where id_gt='$this->id_gt' and id_persona='$this->id_persona'");
		if($acceso->objeto->registros>0)
			return true;
		else
			return false;
	}
	public function incluirgrupo_tecnico($acceso)
	{
		
		
		 $acceso->objeto->ejecutarSql("insert into grupo_tecnico(id_gt,id_persona) values ('$this->id_gt','$this->id_persona')");			
		
	}
	public function modificargrupo_tecnico($acceso)
	{
		$acceso->objeto->ejecutarSql("Update grupo_tecnico Set id_persona='$this->id_persona' Where id_gt='$this->id_gt'");	
		
	}
	public function eliminargrupo_tecnico($acceso)
	{
		$acceso->objeto->ejecutarSql("delete from grupo_tecnico where id_gt='$this->id_gt'");
			
	}
}
?>