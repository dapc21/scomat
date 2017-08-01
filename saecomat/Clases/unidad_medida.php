<?php
class unidad_medida
{
	private $id_unidad;
	private $nombre_unidad;
	private $abreviatura;
	private $status_unidad;
	private $dato;

	function __construct($id_unidad,$nombre_unidad,$abreviatura,$status_unidad,$dato)
	{
		$this->id_unidad = $id_unidad;
		$this->nombre_unidad = $nombre_unidad;
		$this->abreviatura = $abreviatura;
		$this->status_unidad = $status_unidad;
		$this->dato = $dato;
	}
	public function verid_unidad(){
		return $this->id_unidad;
	}
	public function verdato(){
		return $this->dato;
	}
	public function verstatus_unidad(){
		return $this->status_unidad;
	}
	public function verabreviatura(){
		return $this->abreviatura;
	}
	public function vernombre_unidad(){
		return $this->nombre_unidad;
	}

	public function validaExistencia($acceso)
	{
		$acceso->objeto->ejecutarSql("select * from unidad_medida where id_unidad='$this->id_unidad'");
		if($acceso->objeto->registros>0)
			return true;
		else
			return false;
	}
	public function incluirunidad_medida($acceso)
	{
		
		return $acceso->objeto->ejecutarSql("insert into unidad_medida(id_unidad,nombre_unidad,abreviatura,status_unidad) values ('$this->id_unidad','$this->nombre_unidad','$this->abreviatura','$this->status_unidad')");			
	}
	public function modificarunidad_medida($acceso)
	{
		return $acceso->objeto->ejecutarSql("Update unidad_medida Set nombre_unidad='$this->nombre_unidad', abreviatura='$this->abreviatura', status_unidad='$this->status_unidad' Where id_unidad='$this->id_unidad'");	
	}
	public function eliminarunidad_medida($acceso)
	{
		return $acceso->objeto->ejecutarSql("delete from unidad_medida where id_unidad='$this->id_unidad'");
	}
}
?>