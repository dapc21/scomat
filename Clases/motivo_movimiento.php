<?php
class motivo_movimiento
{
	private $id_mot_mov;
	private $nombre_mot_mov;
	private $status_mot_mov;
	private $id_tipo_mov;

	function __construct($dat)
	{
		$this->id_mot_mov = $dat['id_mot_mov'];
		$this->nombre_mot_mov = $dat['nombre_mot_mov'];
		$this->status_mot_mov = $dat['status_mot_mov'];
		$this->id_tipo_mov = $dat['id_tipo_mov'];
	}
	public function verid_mot_mov(){
		return $this->id_mot_mov;
	}
	public function verstatus_mot_mov(){
		return $this->status_mot_mov;
	}
	public function vernombre_mot_mov(){
		return $this->nombre_mot_mov;
	}
	public function verid_tipo_mov(){
		return $this->id_tipo_mov;
	}

	public function validaExistencia($acceso)
	{
		$acceso->objeto->ejecutarSql("select * from motivo_movimiento where id_mot_mov='$this->id_mot_mov' and id_estatus_reg = 1");
		if($acceso->objeto->registros>0)
			return true;
		else
			return false;
	}
	public function incluir($acceso)
	{
		return $acceso->objeto->ejecutarSql("insert into motivo_movimiento(id_mot_mov,nombre_mot_mov,status_mot_mov,id_tipo_mov) values ('$this->id_mot_mov','$this->nombre_mot_mov','$this->status_mot_mov','$this->id_tipo_mov')");			
	}
	public function modificar($acceso)
	{
		return $acceso->objeto->ejecutarSql("update motivo_movimiento set nombre_mot_mov='$this->nombre_mot_mov', status_mot_mov='$this->status_mot_mov', id_tipo_mov='$this->id_tipo_mov' where id_mot_mov='$this->id_mot_mov'");	
	}
	public function eliminar($acceso)
	{
		return $acceso->objeto->ejecutarSql("update motivo_movimiento set id_estatus_reg = 2 where id_mot_mov='$this->id_mot_mov'");
	}
}
?>