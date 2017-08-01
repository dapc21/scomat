<?php
class familia
{
	private $id_fam;
	private $nombre_fam;
	private $status_fam;
	private $dato;

	function __construct($id_fam,$nombre_fam,$status_fam,$dato)
	{
		$this->id_fam = $id_fam;
		$this->nombre_fam = $nombre_fam;
		$this->status_fam = $status_fam;
		$this->dato = $dato;
	}
	public function verid_fam(){
		return $this->id_fam;
	}
	public function verdato(){
		return $this->dato;
	}
	public function verstatus_fam(){
		return $this->status_fam;
	}
	public function vernombre_fam(){
		return $this->nombre_fam;
	}

	public function validaExistencia($acceso)
	{
		$acceso->objeto->ejecutarSql("select * from familia where id_fam='$this->id_fam'");
		if($acceso->objeto->registros>0)
			return true;
		else
			return false;
	}
	public function incluirfamilia($acceso)
	{
		return $acceso->objeto->ejecutarSql("insert into familia(id_fam,nombre_fam,status_fam) values ('$this->id_fam','$this->nombre_fam','$this->status_fam')");			
	}
	public function modificarfamilia($acceso)
	{
		return $acceso->objeto->ejecutarSql("Update familia Set nombre_fam='$this->nombre_fam', status_fam='$this->status_fam' Where id_fam='$this->id_fam'");	
	}
	public function eliminarfamilia($acceso)
	{
		return $acceso->objeto->ejecutarSql("delete from familia where id_fam='$this->id_fam'");
	}
}
?>