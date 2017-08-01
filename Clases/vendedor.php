<?php
require_once "Clases/persona.php";
class vendedor extends Persona
{
	private $id_persona;
	private $nro_vendedor;
	private $direccion_ven;
	private $id_franq;

	function __construct($dat)
	{
		parent::__construct($dat);
		$this->id_persona = $dat['id_persona'];
		$this->nro_vendedor = $dat['nro_vendedor'];
		$this->direccion_ven = $dat['direccion_ven'];
		$this->id_franq = $dat['id_franq'];
	}
	public function verid_persona(){
		return $this->id_persona;
	}
	public function verid_franq(){
		return $this->id_franq;
	}
	public function verdireccion_ven(){
		return $this->direccion_ven;
	}
	public function vernro_vendedor(){
		return $this->nro_vendedor;
	}

	public function validaExistencia($acceso)
	{
		$acceso->objeto->ejecutarSql("select * from vendedor where id_persona='$this->id_persona'");
		if($acceso->objeto->registros>0)
			return true;
		else
			return false;
	}
	public function incluir($acceso)
	{
		
		parent::incluir($acceso);
		$acceso->objeto->ejecutarSql("insert into vendedor(id_persona,nro_vendedor,direccion_ven,id_franq) values ('$this->id_persona','$this->nro_vendedor','$this->direccion_ven','$this->id_franq')");	
		}		
	}
	public function modificar($acceso)
	{
		parent::modificar($acceso);
		$acceso->objeto->ejecutarSql("Update vendedor Set nro_vendedor='$this->nro_vendedor', direccion_ven='$this->direccion_ven', id_franq='$this->id_franq' Where id_persona='$this->id_persona'");
	}
	public function eliminar($acceso)
	{
		$acceso->objeto->ejecutarSql("select * from contrato where id_persona='$this->id_persona'");
		if($acceso->objeto->registros>0)
			$acceso->objeto->sql_error=$acceso->objeto->sql_error."<br>Registro no puede ser eliminado, existen contratos asociadas a este vendedor.";
		else{
			$resp=$acceso->objeto->ejecutarSql("delete from vendedor where id_persona='$this->id_persona'");
		}
		
	}
}
?>