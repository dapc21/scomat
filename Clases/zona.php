<?php
class zona
{
	private $id_zona;
	private $nro_zona;
	private $id_ciudad;
	private $nombre_zona;
	private $n_zona;

	function __construct($dat)
	{
		$this->id_zona = $dat['id_zona'];
		$this->nro_zona = $dat['nro_zona'];
		$this->id_ciudad = $dat['id_ciudad'];
		$this->nombre_zona = $dat['nombre_zona'];
		$this->n_zona = $dat['n_zona'];
	}
	public function verid_zona(){
		return $this->id_zona;
	}
	public function verdato(){
		return $this->dato;
	}
	public function vernombre_zona(){
		return $this->nombre_zona;
	}
	public function verid_ciudad(){
		return $this->id_ciudad;
	}
	public function vernro_zona(){
		return $this->nro_zona;
	}

	public function validaExistencia($acceso)
	{
		$acceso->objeto->ejecutarSql("select * from zona where id_zona='$this->id_zona'");
		if($acceso->objeto->registros>0)
			return true;
		else
			return false;
	}
	public function incluir($acceso)
	{
		$acceso->objeto->ejecutarSql("insert into zona(id_zona,nro_zona,id_ciudad,nombre_zona,n_zona) values ('$this->id_zona','$this->nro_zona','$this->id_ciudad','$this->nombre_zona','$this->n_zona')");			
		
	}
	public function modificar($acceso)
	{
		$acceso->objeto->ejecutarSql("Update zona Set nro_zona='$this->nro_zona', id_ciudad='$this->id_ciudad', nombre_zona='$this->nombre_zona' Where id_zona='$this->id_zona'");	
		
	}
	public function eliminar($acceso)
	{
		$acceso->objeto->ejecutarSql("delete from zona where id_zona='$this->id_zona'");
		
	}
}
?>