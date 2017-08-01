<?php
class tipo_movimiento
{
	private $id_tipo_mov;
	private $nombre_tipo_mov;
	private $descrip_tipo_mov;
	private $status_tipo_mov;

	function __construct($dat)
	{
		$this->id_tipo_mov = $dat['id_tipo_mov'];
		$this->nombre_tipo_mov = $dat['nombre_tipo_mov'];
		$this->descrip_tipo_mov = $dat['descrip_tipo_mov'];
		$this->status_tipo_mov = $dat['status_tipo_mov'];
	}
	public function verid_tipo_mov(){
		return $this->id_tipo_mov;
	}
	public function verstatus_tipo_mov(){
		return $this->status_tipo_mov;
	}
	public function verdescrip_tipo_mov(){
		return $this->descrip_tipo_mov;
	}
	public function vernombre_tipo_mov(){
		return $this->nombre_tipo_mov;
	}

	public function validaExistencia($acceso)
	{
		$acceso->objeto->ejecutarSql("select * from tipo_movimiento where id_tipo_mov='$this->id_tipo_mov' and id_estatus_reg = 1");
		if($acceso->objeto->registros>0)
			return true;
		else
			return false;
	}
	public function incluir($acceso)
	{
		return $acceso->objeto->ejecutarSql("insert into tipo_movimiento(id_tipo_mov,nombre_tipo_mov,descrip_tipo_mov,status_tipo_mov) values ('$this->id_tipo_mov','$this->nombre_tipo_mov','$this->descrip_tipo_mov','$this->status_tipo_mov')");			
	}
	public function modificar($acceso)
	{
		return $acceso->objeto->ejecutarSql("update tipo_movimiento set nombre_tipo_mov='$this->nombre_tipo_mov', descrip_tipo_mov='$this->descrip_tipo_mov', status_tipo_mov='$this->status_tipo_mov' where id_tipo_mov='$this->id_tipo_mov'");	
	}
	public function eliminar($acceso)
	{
		return $acceso->objeto->ejecutarSql("update tipo_movimiento set id_estatus_reg = 2 where id_tipo_mov='$this->id_tipo_mov'");
	}
}
?>