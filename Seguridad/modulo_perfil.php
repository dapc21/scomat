<?php
/*clase para manejar los datos de los modulo_perfils*/
class modulo_perfil				
{
	private $codigoPerfil;
	private $codigoModulo;	
	private $incluir;	
	private $modificar;	
	private $eliminar;	
	
	
	function __construct($codigoPerfil,$codigoModulo,$incluir,$modificar,$eliminar)
	{
		$this->codigoPerfil = $codigoPerfil;
		$this->codigoModulo = $codigoModulo;		
		$this->incluir = $incluir;		
		$this->modificar = $modificar;		
		$this->eliminar = $eliminar;	
	}
	public function vercodigoPerfil(){
		return $this->codigoPerfil;
	}
	public function vercodigoModulo(){
		return $this->codigoModulo;
	}	
	public function verincluir(){
		return $this->incluir;
	}	
	public function vermodificar(){
		return $this->modificar;
	}	
	public function vereliminar(){
		return $this->eliminar;
	}
	public function validaExistencia($acceso)
	{		
		$acceso->objeto->ejecutarSql("select * from modulo_perfil where codigoPerfil='$this->codigoPerfil' and codigoModulo='$this->codigoModulo'");		
		if($acceso->objeto->registros>0)
			return true;				
		else
			return false;	
	}
	public function incluirmodulo_perfil($acceso)
	{								
		$acceso->objeto->ejecutarSql("insert into modulo_perfil (codigoPerfil,codigoModulo,incluir,modificar,eliminar) values ('$this->codigoPerfil','$this->codigoModulo','$this->incluir','$this->modificar','$this->eliminar')");			
		return true;				
	}	
	public function modificarmodulo_perfil($acceso)
	{				
		$this->incluirmodulo_perfil($acceso);
	}	
	public function eliminarmodulo_perfil($acceso)
	{				
		$acceso->objeto->ejecutarSql("delete from modulo_perfil where codigoPerfil='$this->codigoPerfil' and codigoModulo='$this->codigoModulo'");					
		return true;					
	}	
	public function eliminarModulomodulo_perfil($acceso)
	{						
			$acceso->objeto->ejecutarSql("delete from modulo_perfil where codigoModulo='$this->codigoModulo'");					
			return true;					
	}
	public function eliminarPerfilmodulo_perfil($acceso)
	{						
		$acceso->objeto->ejecutarSql("delete from modulo_perfil where codigoPerfil='$this->codigoPerfil'");					
		return true;					
	}	
}//fin de la class Usuario 
?>