<?php
class unidad_medida
{
	private $id_uni;
	private $nombre_uni;
	private $abrev_uni;
	private $status_uni;

	function __construct($dat)
	{
		$this->id_uni = $dat['id_uni'];
		$this->nombre_uni = $dat['nombre_uni'];
		$this->abrev_uni = $dat['abrev_uni'];
		$this->status_uni = $dat['status_uni'];
	}
	public function verid_uni(){
		return $this->id_uni;
	}
	public function verstatus_uni(){
		return $this->status_uni;
	}
	public function verabrev_uni(){
		return $this->abrev_uni;
	}
	public function vernombre_uni(){
		return $this->nombre_uni;
	}

	public function validaExistencia($acceso)
	{
		$acceso->objeto->ejecutarSql("select * from unidad_medida where id_uni='$this->id_uni' and id_estatus_reg = 1");
		if($acceso->objeto->registros>0)
			return true;
		else
			return false;
	}
	public function incluir($acceso)
	{
		return $acceso->objeto->ejecutarSql("insert into unidad_medida(id_uni,nombre_uni,abrev_uni,status_uni) values ('$this->id_uni','$this->nombre_uni','$this->abrev_uni','$this->status_uni')");			
	}
	public function modificar($acceso)
	{
		return $acceso->objeto->ejecutarSql("update unidad_medida set nombre_uni='$this->nombre_uni', abrev_uni='$this->abrev_uni', status_uni='$this->status_uni' where id_uni='$this->id_uni'");	
	}
	public function eliminar($acceso)
	{
		return $acceso->objeto->ejecutarSql("update unidad_medida set id_estatus_reg = 2 where id_uni='$this->id_uni'");
	}
}
?>