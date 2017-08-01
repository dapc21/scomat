<?php
class detalle_orden
{
	private $id_det_orden;
	private $id_tipo_orden;
	private $nombre_det_orden;
	private $tipo_detalle;
	private $id_serv;

	function __construct($dat)
	{
		$this->id_det_orden = $dat['id_det_orden'];
		$this->id_tipo_orden = $dat['id_tipo_orden'];
		$this->nombre_det_orden = $dat['nombre_det_orden'];
		$this->tipo_detalle = $dat['tipo_detalle'];
		$this->id_serv = $dat['id_serv'];
	}
	public function verid_det_orden(){
		return $this->id_det_orden;
	}
	public function vertipo_detalle(){
		return $this->tipo_detalle;
	}
	public function verid_serv(){
		return $this->id_serv;
	}
	public function vernombre_det_orden(){
		return $this->nombre_det_orden;
	}
	public function verid_tipo_orden(){
		return $this->id_tipo_orden;
	}

	public function validaExistencia($acceso)
	{
		$acceso->objeto->ejecutarSql("select * from detalle_orden where id_det_orden='$this->id_det_orden'");
		if($acceso->objeto->registros>0)
			return true;
		else
			return false;
	}
	public function incluir($acceso)
	{
		 return $acceso->objeto->ejecutarSql("insert into detalle_orden(id_det_orden,id_tipo_orden,nombre_det_orden,tipo_detalle,id_serv) values ('$this->id_det_orden','$this->id_tipo_orden','$this->nombre_det_orden','$this->tipo_detalle','$this->id_serv')");			
	}
	public function modificar($acceso)
	{
		 return $acceso->objeto->ejecutarSql("Update detalle_orden Set id_tipo_orden='$this->id_tipo_orden', nombre_det_orden='$this->nombre_det_orden', tipo_detalle='$this->tipo_detalle', id_serv='$this->id_serv'  Where id_det_orden='$this->id_det_orden'");	
	}
	public function eliminar($acceso)
	{
		
		return $acceso->objeto->ejecutarSql("delete from detalle_orden where id_det_orden='$this->id_det_orden'");
	}
}
?>