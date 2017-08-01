<?php
class tipo_orden
{
	private $id_tipo_orden;
	private $nombre_tipo_orden;
	private $status_tipord;

	function __construct($dat)
	{
		$this->id_tipo_orden = $dat['id_tipo_orden'];
		$this->nombre_tipo_orden = $dat['nombre_tipo_orden'];
		$this->status_tipord = $dat['status_tipord'];
	}
	public function verid_tipo_orden(){
		return $this->id_tipo_orden;
	}
	public function verstatus_tipord(){
		return $this->status_tipord;
	}
	public function vernombre_tipo_orden(){
		return $this->nombre_tipo_orden;
	}

	public function validaExistencia($acceso)
	{
		$acceso->objeto->ejecutarSql("select * from tipo_orden where id_tipo_orden='$this->id_tipo_orden'");
		if($acceso->objeto->registros>0)
			return true;
		else
			return false;
	}
	public function incluir($acceso)
	{
		
		 $acceso->objeto->ejecutarSql("insert into tipo_orden(id_tipo_orden,nombre_tipo_orden,status_tipord) values ('$this->id_tipo_orden','$this->nombre_tipo_orden','$this->status_tipord')");			
		
	}
	public function modificar($acceso)
	{
		 $acceso->objeto->ejecutarSql("Update tipo_orden Set nombre_tipo_orden='$this->nombre_tipo_orden', status_tipord='$this->status_tipord'  Where id_tipo_orden='$this->id_tipo_orden'");	
	}
	public function eliminar($acceso)
	{
		 $acceso->objeto->ejecutarSql("delete from tipo_orden where id_tipo_orden='$this->id_tipo_orden'");
	}
}
?>