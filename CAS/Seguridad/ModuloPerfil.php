<?php
/*clase para manejar los datos de los ModuloPerfils*/
class ModuloPerfil				
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
		$acceso->objeto->ejecutarSql("select * from ModuloPerfil where codigoPerfil='$this->codigoPerfil' and codigoModulo='$this->codigoModulo'");		
		if($acceso->objeto->registros>0)
			return true;				
		else
			return false;	
	}
	public function incluirModuloPerfil($acceso)
	{								
		$acceso->objeto->ejecutarSql("insert into ModuloPerfil (codigoPerfil,codigoModulo,incluir,modificar,eliminar) values ('$this->codigoPerfil','$this->codigoModulo','$this->incluir','$this->modificar','$this->eliminar')");			
		return true;				
	}	
	public function modificarModuloPerfil($acceso)
	{				
		$this->incluirModuloPerfil($acceso);
	}	
	public function eliminarModuloPerfil($acceso)
	{				
		$acceso->objeto->ejecutarSql("delete from ModuloPerfil where codigoPerfil='$this->codigoPerfil' and codigoModulo='$this->codigoModulo'");					
		return true;					
	}	
	public function eliminarModuloModuloPerfil($acceso)
	{						
			$acceso->objeto->ejecutarSql("delete from ModuloPerfil where codigoModulo='$this->codigoModulo'");					
			return true;					
	}
	public function eliminarPerfilModuloPerfil($acceso)
	{						
		$acceso->objeto->ejecutarSql("delete from ModuloPerfil where codigoPerfil='$this->codigoPerfil'");					
		return true;					
	}	
}//fin de la class Usuario 
?>