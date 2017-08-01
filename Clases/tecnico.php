<?php
require_once "Clases/persona.php";
class tecnico extends Persona
{
	private $id_persona;
	private $num_tecnico;
	private $direccion_tec;
	private $correo_tec;
	private $status_tec;
	private $id_franq;
	private $dat;

	function __construct($dat)
	{
		parent::__construct($dat);
		$this->id_persona = $dat['id_persona'];
		$this->num_tecnico = $dat['num_tecnico'];
		$this->direccion_tec = $dat['direccion_tec'];
		$this->correo_tec = $dat['correo_tec'];
		$this->status_tec = $dat['status_tec'];
		$this->id_franq = $dat['id_franq'];

	}
	public function verid_persona(){
		return $this->id_persona;
	}
	public function vercorreo_tec(){
		return $this->correo_tec;
	}
	public function verdireccion_tec(){
		return $this->direccion_tec;
	}
	public function vernum_tecnico(){
		return $this->num_tecnico;
	}

	public function validaExistencia($acceso)
	{
		$acceso->objeto->ejecutarSql("select * from tecnico where id_persona='$this->id_persona'");
		if($acceso->objeto->registros>0)
			return true;
		else
			return false;
	}
	public function incluir($acceso)
	{
		parent::incluir($acceso);
		 $acceso->objeto->ejecutarSql("insert into tecnico(id_persona,num_tecnico,direccion_tec,correo_tec,status_tec,id_franq) values ('$this->id_persona','$this->num_tecnico','$this->direccion_tec','$this->correo_tec','$this->status_tec','$this->id_franq')");			
			
	}
	public function modificar($acceso)
	{
		parent::modificar($acceso);
		$acceso->objeto->ejecutarSql("Update tecnico Set num_tecnico='$this->num_tecnico', direccion_tec='$this->direccion_tec', id_franq='$this->id_franq', correo_tec='$this->correo_tec', status_tec='$this->status_tec' Where id_persona='$this->id_persona'");	
			
	}
	public function eliminar($acceso)
	{
		$acceso->objeto->ejecutarSql("delete from tecnico where id_persona='$this->id_persona'");
		//$resp=parent::eliminar($acceso);
		
	}
}
?>