<?php
class sector
{
	private $id_sector;
	private $nro_sector;
	private $id_zona;
	private $nombre_sector;
	private $n_sector;
	private $afiliacion;

	function __construct($dat)
	{
		$this->id_sector = $dat['id_sector'];
		$this->nro_sector = $dat['nro_sector'];
		$this->id_zona = $dat['id_zona'];
		$this->nombre_sector = $dat['nombre_sector'];
		$this->id_franq = $dat['id_franq'];
		
	}
	public function verid_sector(){
		return $this->id_sector;
	}
	public function vern_sector(){
		return $this->n_sector;
	}
	public function vernombre_sector(){
		return $this->nombre_sector;
	}
	public function verid_zona(){
		return $this->id_zona;
	}
	public function vernro_sector(){
		return $this->nro_sector;
	}

	public function validaExistencia($acceso)
	{
		$acceso->objeto->ejecutarSql("select * from sector where id_sector='$this->id_sector'");
		if($acceso->objeto->registros>0)
			return true;
		else
			return false;
	}
	public function incluir($acceso)
	{
		$acceso->objeto->ejecutarSql("insert into sector(id_sector,nro_sector,id_zona,nombre_sector,n_sector,afiliacion,id_franq) values ('$this->id_sector','$this->nro_sector','$this->id_zona','$this->nombre_sector','$this->n_sector','$this->afiliacion','$this->id_franq')");			
				
	}
	public function modificar($acceso)
	{
		$acceso->objeto->ejecutarSql("Update sector Set nro_sector='$this->nro_sector', id_zona='$this->id_zona', nombre_sector='$this->nombre_sector', id_franq='$this->id_franq' Where id_sector='$this->id_sector'");	
					
	}
	public function eliminar($acceso)
	{
		$acceso->objeto->ejecutarSql("delete from sector where id_sector='$this->id_sector'");
					
	}
}
?>