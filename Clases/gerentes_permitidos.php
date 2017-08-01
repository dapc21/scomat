<?php
require_once "Clases/persona.php";
class gerentes_permitidos extends Persona
{
	private $id_persona;
	private $nro_gerente;
	private $tipo_gerente;
	private $cargo_gerente;
	private $descrip_gerente;
	private $sattus_gerente;
	private $correo_gerente;
	private $id_franq;

	function __construct($dat)
	{
		parent::__construct($dat);
		$this->id_persona = $dat['id_persona'];
		$this->nro_gerente = $dat['nro_gerente'];
		$this->tipo_gerente = $dat['tipo_gerente'];
		$this->cargo_gerente = $dat['cargo_gerente'];
		$this->descrip_gerente = $dat['descrip_gerente'];
		$this->sattus_gerente = $dat['sattus_gerente'];
		$this->correo_gerente = $dat['correo_gerente'];
		$this->id_franq = $dat['id_franq'];
	}
	public function verid_persona(){
		return $this->id_persona;
	}
	public function vercorreo_gerente(){
		return $this->correo_gerente;
	}
	public function versattus_gerente(){
		return $this->sattus_gerente;
	}
	public function verdescrip_gerente(){
		return $this->descrip_gerente;
	}
	public function vercargo_gerente(){
		return $this->cargo_gerente;
	}
	public function vertipo_gerente(){
		return $this->tipo_gerente;
	}
	public function vernro_gerente(){
		return $this->nro_gerente;
	}

	public function validaExistencia($acceso)
	{
		$acceso->objeto->ejecutarSql("select * from gerentes_permitidos where id_persona='$this->id_persona'");
		if($acceso->objeto->registros>0)
			return true;
		else
			return false;
	}
	public function incluir($acceso)
	{
		parent::incluir($acceso);
		$acceso->objeto->ejecutarSql("insert into gerentes_permitidos(id_persona,nro_gerente,tipo_gerente,cargo_gerente,descrip_gerente,sattus_gerente,correo_gerente,id_franq) values ('$this->id_persona','$this->nro_gerente','$this->tipo_gerente','$this->cargo_gerente','$this->descrip_gerente','$this->sattus_gerente','$this->correo_gerente','$this->id_franq')");			
			
	}
	public function modificar($acceso)
	{
		parent::modificar($acceso);
		$acceso->objeto->ejecutarSql("Update gerentes_permitidos Set nro_gerente='$this->nro_gerente', tipo_gerente='$this->tipo_gerente', cargo_gerente='$this->cargo_gerente', descrip_gerente='$this->descrip_gerente', sattus_gerente='$this->sattus_gerente', correo_gerente='$this->correo_gerente' , id_franq='$this->id_franq' Where id_persona='$this->id_persona'");	
		
	}
	public function eliminar($acceso)
	{
		parent::modificar($acceso);
		$acceso->objeto->ejecutarSql("delete from gerentes_permitidos where id_persona='$this->id_persona'");
		
	}
}
?>