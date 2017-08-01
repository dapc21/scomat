<?php
class almacen
{
	private $id_alm;
	private $id_gt;
	private $id_enc;
	private $nombre_alm;
	private $direccion_alm;
	private $descrip_alm;
	private $codigo_alm;
	private $status_alm;

	function __construct($dat)
	{
		$this->id_alm = $dat['id_alm'];
		$this->id_gt = $dat['id_gt'];
		$this->id_enc = $dat['id_enc'];
		$this->nombre_alm = $dat['nombre_alm'];
		$this->direccion_alm = $dat['direccion_alm'];
		$this->descrip_alm = $dat['descrip_alm'];
		$this->codigo_alm = $dat['codigo_alm'];
		$this->status_alm = $dat['status_alm'];
	}
	public function verid_alm(){
		return $this->id_alm;
	}
	public function verstatus_alm(){
		return $this->status_alm;
	}
	public function verdescrip_alm(){
		return $this->descrip_alm;
	}
	public function vercodigo_alm(){
		return $this->codigo_alm;
	}
	public function verdireccion_alm(){
		return $this->direccion_alm;
	}
	public function vernombre_alm(){
		return $this->nombre_alm;
	}
	public function verid_enc(){
		return $this->id_enc;
	}
	public function verid_gt(){
		return $this->id_gt;
	}

	public function validaExistencia($acceso)
	{
		$acceso->objeto->ejecutarSql("select * from almacen where id_alm='$this->id_alm' and id_estatus_reg = 1");
		if($acceso->objeto->registros>0)
			return true;
		else
			return false;
	}
	public function incluir($acceso)
	{
		return $acceso->objeto->ejecutarSql("insert into almacen(id_alm,id_gt,id_enc,nombre_alm,direccion_alm,descrip_alm,codigo_alm,status_alm) values ('$this->id_alm','$this->id_gt','$this->id_enc','$this->nombre_alm','$this->direccion_alm','$this->descrip_alm','$this->codigo_alm','$this->status_alm')");			
	}
	public function modificar($acceso)
	{
		return $acceso->objeto->ejecutarSql("update almacen set id_gt='$this->id_gt', id_enc='$this->id_enc', nombre_alm='$this->nombre_alm', direccion_alm='$this->direccion_alm', descrip_alm='$this->descrip_alm', codigo_alm='$this->codigo_alm', status_alm='$this->status_alm' where id_alm='$this->id_alm'");	
	}
	public function eliminar($acceso)
	{
		return $acceso->objeto->ejecutarSql("update almacen set id_estatus_reg = 2 where id_alm='$this->id_alm'");
	}
}
?>