<?php
class tipo_responsable
{
	private $id_tipo_res;
	private $nombre_tipo_res;
	private $status_tipo_res;

	function __construct($dat)
	{
		$this->id_tipo_res = $dat['id_tipo_res'];
		$this->nombre_tipo_res = $dat['nombre_tipo_res'];
		$this->status_tipo_res = $dat['status_tipo_res'];
	}
	public function verid_tipo_res(){
		return $this->id_tipo_res;
	}
	public function verstatus_tipo_res(){
		return $this->status_tipo_res;
	}
	public function vernombre_tipo_res(){
		return $this->nombre_tipo_res;
	}

	public function validaExistencia($acceso)
	{
		$acceso->objeto->ejecutarSql("select * from tipo_responsable where id_tipo_res='$this->id_tipo_res' and id_estatus_reg = 1");
		if($acceso->objeto->registros>0)
			return true;
		else
			return false;
	}
	public function incluir($acceso)
	{
		return $acceso->objeto->ejecutarSql("insert into tipo_responsable(id_tipo_res,nombre_tipo_res,status_tipo_res) values ('$this->id_tipo_res','$this->nombre_tipo_res','$this->status_tipo_res')");			
	}
	public function modificar($acceso)
	{
		return $acceso->objeto->ejecutarSql("Update tipo_responsable Set nombre_tipo_res='$this->nombre_tipo_res', status_tipo_res='$this->status_tipo_res' Where id_tipo_res='$this->id_tipo_res'");	
	}
	public function eliminar($acceso)
	{
		return $acceso->objeto->ejecutarSql("update tipo_responsable set id_estatus_reg = 2 where id_tipo_res='$this->id_tipo_res'");
	}
}
?>