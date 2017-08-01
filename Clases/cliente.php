<?php
require_once "Clases/persona.php";
class cliente extends Persona
{
	private $id_persona;
	private $telf_casa;
	private $email;
	private $telf_adic;
	private $numero_casa;
	private $tipo_cliente;
	private $inicial_doc;
	private $fecha_nac;
	private $dato;

	function __construct($dat)
	{
		parent::__construct($dat);
		$this->id_persona = $dat['id_persona'];
		$this->telf_casa = $dat['telf_casa'];
		$this->email = $dat['email'];
		$this->telf_adic = $dat['telf_adic'];
		$this->numero_casa = $dat['numero_casa'];
		$this->tipo_cliente = $dat['tipo_cliente'];
		$this->inicial_doc = $dat['inicial_doc'];
		$this->fecha_nac = $dat['fecha_nac'];
		$this->dato = $dat['dato'];
	}
	public function verid_persona(){
		return $this->id_persona;
	}
	public function verdato(){
		return $this->dato;
	}
	public function vernumero_casa(){
		return $this->numero_casa;
	}
	public function vertelf_adic(){
		return $this->telf_adic;
	}
	public function veremail(){
		return $this->email;
	}
	public function vertelf_casa(){
		return $this->telf_casa;
	}

	public function validaExistencia($acceso)
	{
		$acceso->objeto->ejecutarSql("select * from cliente where id_persona='$this->id_persona'");
		if($acceso->objeto->registros>0)
			return true;
		else
			return false;
	}
	public function incluir($acceso)
	{
		
		if($resp=parent::incluir($acceso)){
			$acceso->objeto->ejecutarSql("select * from cliente where id_persona='$this->id_persona'");
			if($acceso->objeto->registros>0){
				$resp =  $acceso->objeto->ejecutarSql("Update cliente Set telf_casa='$this->telf_casa', email='$this->email', telf_adic='$this->telf_adic', tipo_cliente='$this->tipo_cliente' , inicial_doc='$this->inicial_doc' , fecha_nac='$this->fecha_nac' Where id_persona='$this->id_persona'");
			}else{
				$resp = $acceso->objeto->ejecutarSql("insert into cliente(id_persona,telf_casa,email,telf_adic,tipo_cliente,inicial_doc,fecha_nac) values ('$this->id_persona','$this->telf_casa','$this->email','$this->telf_adic','$this->tipo_cliente','$this->inicial_doc','$this->fecha_nac')");	
			}
		}
		return $resp;		
	}
	public function modificar($acceso)
	{
		
		parent::modificar($acceso);
		 $acceso->objeto->ejecutarSql("select * from cliente where id_persona='$this->id_persona'");
			if($acceso->objeto->registros>0){
				$resp =  $acceso->objeto->ejecutarSql("Update cliente Set telf_casa='$this->telf_casa', email='$this->email', telf_adic='$this->telf_adic', tipo_cliente='$this->tipo_cliente' , inicial_doc='$this->inicial_doc' , fecha_nac='$this->fecha_nac' Where id_persona='$this->id_persona'");
			}else{
				$resp = $acceso->objeto->ejecutarSql("insert into cliente(id_persona,telf_casa,email,telf_adic,tipo_cliente,inicial_doc,fecha_nac) values ('$this->id_persona','$this->telf_casa','$this->email','$this->telf_adic','$this->tipo_cliente','$this->inicial_doc','$this->fecha_nac')");	
			}
		 	
		return $resp;
	}
	public function actualizar($acceso)
	{
		
		parent::modificar($acceso);
		$resp =  $acceso->objeto->ejecutarSql("Update cliente Set telf_casa='$this->telf_casa', email='$this->email', telf_adic='$this->telf_adic', tipo_cliente='$this->tipo_cliente' , inicial_doc='$this->inicial_doc' , fecha_nac='$this->fecha_nac' Where id_persona='$this->id_persona'");
			
		return $resp;		
	}
	public function eliminar($acceso)
	{
		
		$acceso->objeto->ejecutarSql("delete from cliente where id_persona='$this->id_persona'");
		$resp =  parent::eliminar($acceso);
		
		return $resp;		
	}
}
?>