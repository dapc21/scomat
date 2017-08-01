<?php
class grupo_franq
{
	private $id_gf;
	private $nombre_gf;
	private $desc_gf;
	private $status_gf;
	private $dato;

	function __construct($dat)
	{
		$this->id_gf = $dat['id_gf'];
		$this->nombre_gf = $dat['nombre_gf'];
		$this->desc_gf = $dat['desc_gf'];
		$this->status_gf = $dat['status_gf'];
		$this->dato = $dat['dato'];
	}
	public function verid_gf(){
		return $this->id_gf;
	}
	public function verdato(){
		return $this->dato;
	}
	public function verstatus_gf(){
		return $this->status_gf;
	}
	public function verdesc_gf(){
		return $this->desc_gf;
	}
	public function vernombre_gf(){
		return $this->nombre_gf;
	}

	public function validaExistencia($acceso)
	{
		$acceso->objeto->ejecutarSql("select * from grupo_franq where id_gf='$this->id_gf'");
		if($acceso->objeto->registros>0)
			return true;
		else
			return false;
	}
	public function incluir($acceso)
	{
		return $acceso->objeto->ejecutarSql("insert into grupo_franq(id_gf,nombre_gf,desc_gf,status_gf) values ('$this->id_gf','$this->nombre_gf','$this->desc_gf','$this->status_gf')");			
	}
	public function modificar($acceso)
	{
		return $acceso->objeto->ejecutarSql("Update grupo_franq Set nombre_gf='$this->nombre_gf', desc_gf='$this->desc_gf', status_gf='$this->status_gf' Where id_gf='$this->id_gf'");	
	}
	public function eliminar($acceso)
	{
		return $acceso->objeto->ejecutarSql("delete from grupo_franq where id_gf='$this->id_gf'");
	}
}
?>