<?php
class urbanizacion
{
	private $id_urb;
	private $n_urb;
	private $id_sector;
	private $nombre_urb;
	private $dato;

	function __construct($dat)
	{
		$this->id_urb = $dat['id_urb'];
		$this->n_urb = "";
		$this->id_sector = $dat['id_sector'];
		$this->nombre_urb = $dat['nombre_urb'];
		$this->dato = $dat['dato'];
	}
	public function verid_urb(){
		return $this->id_urb;
	}
	public function verdato(){
		return $this->dato;
	}
	public function vernombre_urb(){
		return $this->nombre_urb;
	}
	public function verid_sector(){
		return $this->id_sector;
	}
	public function vern_urb(){
		return $this->n_urb;
	}

	public function validaExistencia($acceso)
	{
		$acceso->objeto->ejecutarSql("select * from urbanizacion where id_urb='$this->id_urb'");
		if($acceso->objeto->registros>0)
			return true;
		else
			return false;
	}
	public function incluir($acceso)
	{
		$acceso->objeto->ejecutarSql("insert into urbanizacion(id_urb,id_sector,nombre_urb) values ('$this->id_urb','$this->id_sector','$this->nombre_urb')");			
		
	}
	public function modificar($acceso)
	{
		
		$acceso->objeto->ejecutarSql("select nombre_urb from urbanizacion where id_urb='$this->id_urb'");
		if($row=$acceso->objeto->devolverRegistro()){
			$urbanizacion_viejo=trim($row["nombre_urb"]);
		}
		//echo "Update contrato Set urbanizacion='$this->nombre_urb' Where urbanizacion='$urbanizacion_viejo'";
		$acceso->objeto->ejecutarSql("Update contrato Set urbanizacion='$this->nombre_urb' Where urbanizacion='$urbanizacion_viejo'");
		
		$acceso->objeto->ejecutarSql("Update urbanizacion Set id_sector='$this->id_sector', nombre_urb='$this->nombre_urb' Where id_urb='$this->id_urb'");	
		
	}
	public function eliminar($acceso)
	{
		$acceso->objeto->ejecutarSql("delete from urbanizacion where id_urb='$this->id_urb'");
		
	}
}
?>