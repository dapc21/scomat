<?php
require_once "Clases/persona.php";
class cobrador extends Persona
{
	private $id_persona;
	private $nro_cobrador;
	private $direccion_cob;
	private $codcob;
	private $id_franq;

	function __construct($dat)
	{
		parent::__construct($dat);
		$this->id_persona =  $dat['id_persona'];
		$this->nro_cobrador =  $dat['nro_cobrador'];
		$this->direccion_cob =  $dat['direccion_cob'];
		$this->codcob =  $dat['dato'];
		$this->id_franq =  $dat['id_franq'];
	}
	public function verid_persona(){
		return $this->id_persona;
	}
	public function vercodcob(){
		return $this->codcob;
	}
	public function verdireccion_cob(){
		return $this->direccion_cob;
	}
	public function vernro_cobrador(){
		return $this->nro_cobrador;
	}

	public function validaExistencia($acceso)
	{
		$acceso->objeto->ejecutarSql("select * from cobrador where id_persona='$this->id_persona'");
		if($acceso->objeto->registros>0)
			return true;
		else
			return false;
	}
	public function incluir($acceso)
	{
		parent::incluir($acceso);
		$acceso->objeto->ejecutarSql("insert into cobrador(id_persona,nro_cobrador,direccion_cob,codcob,id_franq) values ('$this->id_persona','$this->nro_cobrador','$this->direccion_cob','$this->codcob','$this->id_franq')");
	}
	public function modificar($acceso)
	{
		parent::modificar($acceso);
		$acceso->objeto->ejecutarSql("Update cobrador Set nro_cobrador='$this->nro_cobrador', direccion_cob='$this->direccion_cob', codcob='$this->codcob', id_franq='$this->id_franq' Where id_persona='$this->id_persona'");	
		
	}
	public function eliminar($acceso)
	{
		
		
		$acceso->objeto->ejecutarSql("select * from caja_cobrador where id_persona='$this->id_persona'");
		if($acceso->objeto->registros>0)
			$acceso->objeto->sql_error=$acceso->objeto->sql_error."Registro no puede ser eliminado, existen cajas asociadas a este cobrador.";
		else{
			$acceso->objeto->ejecutarSql("delete from cobrador where id_persona='$this->id_persona'");
		}
		return $resp;
	}
}
?>