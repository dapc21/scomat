<?php
class edificio
{
	private $id_sector;
	private $edificio;
	private $id_edif;

	function __construct($dat)
	{
		$this->id_sector = $dat['id_sector'];
		$this->edificio = $dat['edificio'];
		$this->id_edif = $dat['id_edif'];
	}
	public function verid_sector(){
		return $this->id_sector;
	}
	public function verdato(){
		return $this->dato;
	}
	public function veredificio(){
		return $this->edificio;
	}
	public function validaExistencia($acceso)
	{
		$acceso->objeto->ejecutarSql("select * from edificio where id_edif='$this->id_edif'");
		if($acceso->objeto->registros>0)
			return true;
		else
			return false;
	}
	public function incluir($acceso)
	{
		
		$acceso->objeto->ejecutarSql("insert into edificio(id_edif,id_sector,edificio) values ('$this->id_edif','$this->id_sector','$this->edificio')");			
		
	}
	public function modificar($acceso)
	{
		
		$acceso->objeto->ejecutarSql("select * from edificio where id_edif='$this->id_edif'");
		if($row=$acceso->objeto->devolverRegistro()){
			$edificio_viejo=trim($row["edificio"]);
		}
		$acceso->objeto->ejecutarSql("Update contrato Set edificio='$this->edificio' Where edificio='$edificio_viejo'");
		$acceso->objeto->ejecutarSql("Update edificio Set id_sector='$this->id_sector',edificio='$this->edificio' Where id_edif='$this->id_edif'");	
		
	}
	public function eliminar($acceso)
	{
		$acceso->objeto->ejecutarSql("delete from edificio where id_edif='$this->id_edif'");
		
	}
}
?>