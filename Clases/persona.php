<?php
class Persona
{
	private $id_persona;
	private $cedula;
	private $nombre;
	private $apellido;
	private $telefono;

	function __construct($dat)
	{
		$this->id_persona = $dat['id_persona'];
		$this->cedula =$dat['cedula'];
		$this->nombre = $dat['nombre'];
		$this->apellido = $dat['apellido'];
		$this->telefono = $dat['telefono'];
	}
	public function verid_persona(){
		return $this->id_persona;
	}
	public function vertelefono(){
		return $this->telefono;
	}
	public function verapellido(){
		return $this->apellido;
	}
	public function vernombre(){
		return $this->nombre;
	}
	public function vercedula(){
		return $this->cedula;
	}

	public function validaExistencia($acceso)
	{
		$acceso->objeto->ejecutarSql("select * from Persona where id_persona='$this->id_persona'");
		if($acceso->objeto->registros>0)
			return true;
		else
			return false;
	}
	public function incluir($acceso)
	{
		$acceso->objeto->ejecutarSql("select * from Persona where id_persona='$this->id_persona'");
		if($acceso->objeto->registros>0){
			return $acceso->objeto->ejecutarSql("Update Persona Set cedula='$this->cedula', nombre='$this->nombre', apellido='$this->apellido', telefono='$this->telefono' Where id_persona='$this->id_persona'");	
		}else{
			return $acceso->objeto->ejecutarSql("insert into Persona(id_persona,cedula,nombre,apellido,telefono) values ('$this->id_persona','$this->cedula','$this->nombre','$this->apellido','$this->telefono')");			
		}
		
	}
	public function modificar($acceso)
	{
		$acceso->objeto->ejecutarSql("select * from Persona where id_persona='$this->id_persona'");
		if($acceso->objeto->registros>0){
			return $acceso->objeto->ejecutarSql("Update Persona Set cedula='$this->cedula', nombre='$this->nombre', apellido='$this->apellido', telefono='$this->telefono' Where id_persona='$this->id_persona'");	
		}else{
			return $acceso->objeto->ejecutarSql("insert into Persona(id_persona,cedula,nombre,apellido,telefono) values ('$this->id_persona','$this->cedula','$this->nombre','$this->apellido','$this->telefono')");			
		}
	}
	public function eliminar($acceso)
	{
		return $acceso->objeto->ejecutarSql("delete from persona where id_persona='$this->id_persona'");
	}
}
?>