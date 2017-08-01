<?php
/*clase para manejar los datos de los Perfiles*/

class Perfil
{   
	private $codigoPerfil;
	private $nombrePerfil;
	private $descripcionPerfil;
	private $statusPerfil;

	function __construct($codigoPerfil,$nombrePerfil,$descripcionPerfil,$statusPerfil)
	{
		$this->codigoPerfil = $codigoPerfil;
		$this->nombrePerfil = $nombrePerfil;
		$this->descripcionPerfil = $descripcionPerfil;
		$this->statusPerfil = $statusPerfil;
	}
	public function verCodigoPerfil(){
		return $this->codigoPerfil;
	}
	public function verNombrePerfil(){
		return $this->nombrePerfil;
	}
	public function verDescripcionPerfil(){
		return $this->descripcionPerfil;
	}
	public function verstatusPerfil(){
		return $this->statusPerfil;
	}
	public function validaExistencia($acceso)
	{
		$acceso->objeto->ejecutarSql("select * from perfil where codigoperfil='$this->codigoPerfil'");
		if($acceso->objeto->registros>0)
			return true;
		else
			return false;
	}
	public function incluirPerfil($acceso)
	{
		$acceso->objeto->ejecutarSql("insert into perfil(codigoperfil,nombreperfil,descripcionPerfil,statusPerfil) values ('$this->codigoPerfil','$this->nombrePerfil','$this->descripcionPerfil','$this->statusPerfil')");			
		return true;
	}
	public function modificarPerfil($acceso)
	{
		$acceso->objeto->ejecutarSql("Update perfil Set nombrePerfil='$this->nombrePerfil', descripcionperfil='$this->descripcionPerfil',statusPerfil='$this->statusPerfil' Where codigoperfil='$this->codigoPerfil'");		
		return true;
	}	
	public function eliminarPerfil($acceso)
	{
		$acceso->objeto->ejecutarSql("delete from perfil where codigoperfil='$this->codigoPerfil'");
		return true;
	}

}//fin de la class Perfil 
?>