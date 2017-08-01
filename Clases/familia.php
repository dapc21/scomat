<?php
class familia
{
	private $id_fam;
	private $nombre_fam;
	private $descrip_fam;
	private $status_fam;

	function __construct($dat)
	{
		$this->id_fam = $dat['id_fam'];
		$this->nombre_fam = $dat['nombre_fam'];
		$this->descrip_fam = $dat['descrip_fam'];
		$this->status_fam = $dat['status_fam'];
	}
	public function verid_fam(){
		return $this->id_fam;
	}
	public function verstatus_fam(){
		return $this->status_fam;
	}
	public function verdescrip_fam(){
		return $this->descrip_fam;
	}
	public function vernombre_fam(){
		return $this->nombre_fam;
	}

	public function validaExistencia($acceso)
	{
		$acceso->objeto->ejecutarSql("select * from familia where id_fam='$this->id_fam' and id_estatus_reg = 1");
		if($acceso->objeto->registros>0)
			return true;
		else
			return false;
	}
	public function incluir($acceso)
	{
		return $acceso->objeto->ejecutarSql("insert into familia(id_fam,nombre_fam,descrip_fam,status_fam) values ('$this->id_fam','$this->nombre_fam','$this->descrip_fam','$this->status_fam')");			
	}
	public function modificar($acceso)
	{
		return $acceso->objeto->ejecutarSql("update familia set nombre_fam='$this->nombre_fam', descrip_fam='$this->descrip_fam', status_fam='$this->status_fam' where id_fam='$this->id_fam'");	
	}
	public function eliminar($acceso)
	{
		return $acceso->objeto->ejecutarSql("update familia set id_estatus_reg = 2 where id_fam='$this->id_fam'");
	}
}
?>