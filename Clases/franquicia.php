<?php
class franquicia
{
	private $id_franq;
	private $nombre_franq;
	private $obser_franq;
	private $id_gf;
	private $id_emp;
	private $direccion_franq;
	private $serie;

	function __construct($dat)
	{
		$this->id_franq = $dat['id_franq'];
		$this->nombre_franq = $dat['nombre_franq'];
		$this->obser_franq = $dat['obser_franq'];
		$this->id_gf = $dat['id_gf'];
		$this->id_emp = $dat['id_emp'];
		$this->direccion_franq = $dat['direccion_franq'];
		$this->serie = $dat['serie'];
	}
	public function verid_franq(){
		return $this->id_franq;
	}
	public function verserie(){
		return $this->serie;
	}
	public function verdireccion_franq(){
		return $this->direccion_franq;
	}
	public function verid_emp(){
		return $this->id_emp;
	}
	public function verid_gf(){
		return $this->id_gf;
	}
	public function verobser_franq(){
		return $this->obser_franq;
	}
	public function vernombre_franq(){
		return $this->nombre_franq;
	}

	public function validaExistencia($acceso)
	{
		$acceso->objeto->ejecutarSql("select * from franquicia where id_franq='$this->id_franq'");
		if($acceso->objeto->registros>0)
			return true;
		else
			return false;
	}
	public function incluir($acceso)
	{
		$acceso->objeto->ejecutarSql("insert into franquicia(id_franq,nombre_franq,obser_franq,id_gf,id_emp,direccion_franq,serie) values ('$this->id_franq','$this->nombre_franq','$this->obser_franq','$this->id_gf','$this->id_emp','$this->direccion_franq','$this->serie')");			
				
	}
	public function modificar($acceso)
	{
		$acceso->objeto->ejecutarSql("Update franquicia Set nombre_franq='$this->nombre_franq', obser_franq='$this->obser_franq', id_gf='$this->id_gf', id_emp='$this->id_emp', direccion_franq='$this->direccion_franq', serie='$this->serie' Where id_franq='$this->id_franq'");	
		
	}
	public function eliminar($acceso)
	{
		$acceso->objeto->ejecutarSql("delete from franquicia where id_franq='$this->id_franq'");
		
	}
}
?>