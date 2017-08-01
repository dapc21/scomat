<?php
class deposito
{
	private $id_dep;
	private $nombre_dep;
	private $descrip_dep;
	private $status_dep;
	private $dato;
	private $id_gt;
	private $id_persona_enc;
	private $id_franq;
	function __construct($id_dep,$nombre_dep,$descrip_dep,$status_dep,$id_gt,$id_persona_enc,$dato,$id_franq)
	{
		$this->id_dep = $id_dep;
		$this->nombre_dep = $nombre_dep;
		$this->descrip_dep = $descrip_dep;
		$this->status_dep = $status_dep;
		$this->dato = $dato;
		$this->id_gt = $id_gt;
		$this->id_persona_enc = $id_persona_enc;
		$this->id_franq = $id_franq;
	}
	public function verid_dep(){
		return $this->id_dep;
	}
	public function verdato(){
		return $this->dato;
	}
	public function verstatus_dep(){
		return $this->status_dep;
	}
	public function verdescrip_dep(){
		return $this->descrip_dep;
	}
	public function verid_gt(){
		return $this->id_gt;
	}
	public function verid_persona_enc(){
		return $this->id_persona_enc;
	}
	public function vernombre_dep(){
		return $this->nombre_dep;
	}
	public function validaExistencia($acceso)
	{
		$acceso->objeto->ejecutarSql("select * from deposito where id_dep='$this->id_dep'");
		if($acceso->objeto->registros>0)
			return true;
		else
			return false;
	}
	public function incluirdeposito($acceso)
	{
		return $acceso->objeto->ejecutarSql("insert into deposito(id_dep,nombre_dep,descrip_dep,status_dep,id_gt,id_persona_enc,id_franq) values ('$this->id_dep','$this->nombre_dep','$this->descrip_dep','$this->status_dep','$this->id_gt','$this->id_persona_enc','$this->id_franq')");			
	}
	public function modificardeposito($acceso)
	{
		return $acceso->objeto->ejecutarSql("Update deposito Set nombre_dep='$this->nombre_dep', id_franq='$this->id_franq', descrip_dep='$this->descrip_dep', status_dep='$this->status_dep', id_gt='$this->id_gt', id_persona_enc='$this->id_persona_enc' Where id_dep='$this->id_dep'");	
	}
	public function eliminardeposito($acceso)
	{
		return $acceso->objeto->ejecutarSql("delete from deposito where id_dep='$this->id_dep'");
	}
}
?>