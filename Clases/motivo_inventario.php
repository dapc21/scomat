<?php
class motivo_inventario
{
	private $id_mot_inv;
	private $nombre_mot_inv;
	private $status_mot_inv;

	function __construct($dat)
	{
		$this->id_mot_inv = $dat['id_mot_inv'];
		$this->nombre_mot_inv = $dat['nombre_mot_inv'];
		$this->status_mot_inv = $dat['status_mot_inv'];
	}
	public function verid_mot_inv(){
		return $this->id_mot_inv;
	}
	public function verstatus_mot_inv(){
		return $this->status_mot_inv;
	}
	public function vernombre_mot_inv(){
		return $this->nombre_mot_inv;
	}

	public function validaExistencia($acceso)
	{
		$acceso->objeto->ejecutarSql("select * from motivo_inventario where id_mot_inv='$this->id_mot_inv' and id_estatus_reg = 1");
		if($acceso->objeto->registros>0)
			return true;
		else
			return false;
	}
	public function incluir($acceso)
	{
		return $acceso->objeto->ejecutarSql("insert into motivo_inventario(id_mot_inv,nombre_mot_inv,status_mot_inv) values ('$this->id_mot_inv','$this->nombre_mot_inv','$this->status_mot_inv')");			
	}
	public function modificar($acceso)
	{
		return $acceso->objeto->ejecutarSql("update motivo_inventario set nombre_mot_inv='$this->nombre_mot_inv', status_mot_inv='$this->status_mot_inv' where id_mot_inv='$this->id_mot_inv'");	
	}
	public function eliminar($acceso)
	{
		return $acceso->objeto->ejecutarSql("update motivo_inventario set id_estatus_reg = 2 where id_mot_inv='$this->id_mot_inv'");
	}
}
?>