<?php
class calle
{
	private $id_calle;
	private $nro_calle;
	private $id_sector;
	private $nombre_calle;
	private $dato;

	function __construct($dat)
	{
		$this->id_calle = $dat['id_calle'];
		$this->nro_calle = $dat['nro_calle'];
		$this->id_sector = $dat['id_sector'];
		$this->nombre_calle = $dat['nombre_calle'];
		$this->dato = $dat['dato'];
	}
	public function verid_calle(){
		return $this->id_calle;
	}
	public function verdato(){
		return $this->dato;
	}
	public function vernombre_calle(){
		return $this->nombre_calle;
	}
	public function verid_sector(){
		return $this->id_sector;
	}
	public function vernro_calle(){
		return $this->nro_calle;
	}

	public function validaExistencia($acceso)
	{
		$acceso->objeto->ejecutarSql("select * from calle where id_calle='$this->id_calle'");
		if($acceso->objeto->registros>0)
			return true;
		else
			return false;
	}
	public function incluir($acceso)
	{
		$acceso->objeto->ejecutarSql("insert into calle(id_calle,nro_calle,id_sector,nombre_calle) values ('$this->id_calle','$this->nro_calle','$this->id_sector','$this->nombre_calle')");			
		
	}
	public function modificar($acceso)
	{
		$acceso->objeto->ejecutarSql("Update calle Set nro_calle='$this->nro_calle', id_sector='$this->id_sector', nombre_calle='$this->nombre_calle' Where id_calle='$this->id_calle'");	
			
	}
	public function eliminar($acceso)
	{
		$acceso->objeto->ejecutarSql("delete from calle where id_calle='$this->id_calle'");	
	}
}
?>