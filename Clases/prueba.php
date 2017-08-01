<?php
class prueba
{
	private $id_prueba;
	private $nombre;
	private $dato;

	function __construct($dat)
	{
		$this->id_prueba = $dat['id_prueba'];
		$this->nombre = $dat['nombre'];
		$this->dato = $dat['dato'];
	}
	public function verid_prueba(){
		return $this->id_prueba;
	}
	public function verdato(){
		return $this->dato;
	}
	public function vernombre(){
		return $this->nombre;
	}

	public function validaExistencia($acceso)
	{
		$acceso->objeto->ejecutarSql("select * from prueba where id_prueba='$this->id_prueba'");
		if($acceso->objeto->registros>0)
			return true;
		else
			return false;
	}
	public function incluir($acceso)
	{
		return $acceso->objeto->ejecutarSql("insert into prueba(id_prueba,nombre,dato) values ('$this->id_prueba','$this->nombre','$this->dato')");			
	}
	public function modificar($acceso)
	{
		return $acceso->objeto->ejecutarSql("Update prueba Set nombre='$this->nombre', dato='$this->dato' Where id_prueba='$this->id_prueba'");	
	}
	public function eliminar($acceso)
	{
		return $acceso->objeto->ejecutarSql("delete from prueba where id_prueba='$this->id_prueba'");
	}
}
?>