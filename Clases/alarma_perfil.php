<?php
class alarma_perfil
{
	private $codigoperfil;
	private $id_tipo_alarma;
	private $dato;

	function __construct($codigoperfil,$id_tipo_alarma,$dato)
	{
		$this->codigoperfil = $codigoperfil;
		$this->id_tipo_alarma = $id_tipo_alarma;
		$this->dato = $dato;
	}
	public function vercodigoperfil(){
		return $this->codigoperfil;
	}
	public function verdato(){
		return $this->dato;
	}
	public function verid_tipo_alarma(){
		return $this->id_tipo_alarma;
	}

	public function validaExistencia($acceso)
	{
		$acceso->objeto->ejecutarSql("select * from alarma_perfil where codigoperfil='$this->codigoperfil' and id_tipo_alarma='$this->id_tipo_alarma'");
		if($acceso->objeto->registros>0)
			return true;
		else
			return false;
	}
	public function incluiralarma_perfil($acceso)
	{
		return $acceso->objeto->ejecutarSql("insert into alarma_perfil(codigoperfil,id_tipo_alarma) values ('$this->codigoperfil','$this->id_tipo_alarma')");			
	}
	public function modificaralarma_perfil($acceso)
	{
		return $acceso->objeto->ejecutarSql("Update alarma_perfil Set id_tipo_alarma='$this->id_tipo_alarma' Where codigoperfil='$this->codigoperfil' and id_tipo_alarma='$this->id_tipo_alarma'");	
	}
	public function eliminaralarma_perfil($acceso)
	{
		return $acceso->objeto->ejecutarSql("delete from alarma_perfil where codigoperfil='$this->codigoperfil' and id_tipo_alarma='$this->id_tipo_alarma'");
	}
}
?>