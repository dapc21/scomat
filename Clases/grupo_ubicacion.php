<?php
class grupo_ubicacion
{
	private $id_gt;
	private $id_sector;
	private $dato;

	function __construct($id_gt,$id_sector,$dato)
	{
		$this->id_gt = $id_gt;
		$this->id_sector = $id_sector;
		$this->dato = $dato;
	}
	public function verid_gt(){
		return $this->id_gt;
	}
	public function verdato(){
		return $this->dato;
	}
	public function verid_sector(){
		return $this->id_sector;
	}
	public function validaExistencia($acceso)
	{
		$acceso->objeto->ejecutarSql("select * from grupo_ubicacion where id_gt='$this->id_gt' and id_sector='$this->id_sector'");
		if($acceso->objeto->registros>0)
			return true;
		else
			return false;
	}
	public function incluirgrupo_ubicacion($acceso)
	{
		
		
		if($this->dato=="ZONAS"){
			require_once("DataBase/Acceso.php");
			$acceso1=conexion();
			$acceso->objeto->ejecutarSql("select id_sector from sector where id_zona='$this->id_sector'");
			while($row=$acceso->objeto->devolverRegistro()){
				$id_sector=trim($row['id_sector']);
				$acceso1->objeto->ejecutarSql("insert into grupo_ubicacion(id_gt,id_sector) values ('$this->id_gt','$id_sector')");	
				$acceso->objeto->siguienteRegistro();
			}
		}
		else{
			$acceso->objeto->ejecutarSql("insert into grupo_ubicacion(id_gt,id_sector) values ('$this->id_gt','$this->id_sector')");			
		}
			
	}
	public function modificargrupo_ubicacion($acceso)
	{
		$acceso->objeto->ejecutarSql("Update grupo_ubicacion Set id_sector='$this->id_sector' Where id_gt='$this->id_gt' and id_sector='$this->id_sector'");	
			
	}
	public function eliminargrupo_ubicacion($acceso)
	{
		$acceso->objeto->ejecutarSql("delete from grupo_ubicacion where id_gt='$this->id_gt'");
			
	}
}
?>