<?php
class caja
{
	private $id_caja;
	private $nombre_caja;
	private $descripcion_caja;
	private $status_caja;
	private $tipo_caja;
	private $id_franq;

	function __construct($dat)
	{
		$this->id_caja = $dat['id_caja'];
		$this->nombre_caja = $dat['nombre_caja'];
		$this->descripcion_caja = $dat['descripcion_caja'];
		$this->status_caja = $dat['status_caja'];
		$this->tipo_caja = $dat['tipo_caja'];
		$this->id_franq = $dat['id_franq'];
	}
	public function verid_caja(){
		return $this->id_caja;
	}
	public function vertipo_caja(){
		return $this->tipo_caja;
	}
	public function verstatus_caja(){
		return $this->status_caja;
	}
	public function verdescripcion_caja(){
		return $this->descripcion_caja;
	}
	public function vernombre_caja(){
		return $this->nombre_caja;
	}
	public function validaExistencia($acceso)
	{
		$acceso->objeto->ejecutarSql("select * from caja where id_caja='$this->id_caja'");
		if($acceso->objeto->registros>0)
			return true;
		else
			return false;
	}
	public function incluir($acceso)
	{
		
		 $acceso->objeto->ejecutarSql("insert into caja(id_caja,nombre_caja,descripcion_caja,status_caja,tipo_caja,caja_externa,inicial,id_franq) values ('$this->id_caja','$this->nombre_caja','$this->descripcion_caja','$this->status_caja','PRINCIPAL','$this->tipo_caja','$inicial','$this->id_franq')");			
			
	}
	public function modificar($acceso)
	{
		
		 $acceso->objeto->ejecutarSql("Update caja Set id_franq='$this->id_franq', nombre_caja='$this->nombre_caja', descripcion_caja='$this->descripcion_caja', status_caja='$this->status_caja', caja_externa='$this->tipo_caja' Where id_caja='$this->id_caja'");	
				
	}
	public function eliminar($acceso)
	{
		
		 $acceso->objeto->ejecutarSql("delete from caja where id_caja='$this->id_caja'");
			
	}
}
?>