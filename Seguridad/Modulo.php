<?php
/*clase para manejar los datos de los Modulos*/

class Modulo				
{
	private $codigoModulo;
	private $nombreModulo;
	private $descripcionModulo;
	private $statusModulo;	
	private $nameModulo;	
	function __construct($codigoModulo,$nombreModulo,$descripcionModulo,$statusModulo,$nameModulo)
	{
		$this->codigoModulo = $codigoModulo;
		$this->nombreModulo = $nombreModulo;
		$this->descripcionModulo = $descripcionModulo;
		$this->statusModulo = $statusModulo;			
		$this->nameModulo = $nameModulo;
	}
	public function vercodigoModulo(){
		return $this->codigoModulo;
	}
	public function vernombreModulo(){
		return $this->nombreModulo;
	}
	public function verdescripcionModulo(){
		return $this->descripcionModulo;
	}
	public function verstatusModulo(){
		return $this->statusModulo;
	}	
	public function vernameModulo(){
		return $this->nameModulo;
	}	
	public function validaExistencia($acceso)
	{		
		$acceso->objeto->ejecutarSql("select * from Modulo where codigoModulo='$this->codigoModulo'");		
		if($acceso->objeto->registros>0)
			return true;				
		else
			return false;
	}
	public function incluirModulo($acceso)
	{
		$acceso->objeto->ejecutarSql("insert into Modulo (codigoModulo,nombreModulo,descripcionModulo,statusModulo,nameModulo) values ('$this->codigoModulo','$this->nombreModulo','$this->descripcionModulo','$this->statusModulo','$this->nameModulo')");			
		return true;			
	}
	public function modificarModulo($acceso)
	{				
		$acceso->objeto->ejecutarSql("Update Modulo Set nombreModulo='$this->nombreModulo', descripcionModulo='$this->descripcionModulo' ,statusModulo='$this->statusModulo' Where codigoModulo='$this->codigoModulo'");		
		return true;			
	}	
	public function eliminarModulo($acceso)
	{
		$acceso->objeto->ejecutarSql("delete from Modulo where codigoModulo='$this->codigoModulo'");					
		return true;					
	}	
}//fin de la class Usuario 
?>