<?php
class grupo_trabajo
{
	private $id_gt;
	private $nombre_grupo;
	private $id_zona;
	private $fecha_creacion;
	private $hora_creacion;
	private $status_grupo;
	private $id_franq;

	function __construct($id_gt,$nombre_grupo,$id_zona,$fecha_creacion,$hora_creacion,$status_grupo,$id_franq)
	{
		$this->id_gt = $id_gt;
		$this->nombre_grupo = $nombre_grupo;
		$this->id_zona = $id_zona;
		$this->fecha_creacion = $fecha_creacion;
		$this->hora_creacion = $hora_creacion;
		$this->status_grupo = $status_grupo;
		$this->id_franq = $id_franq;
	}
	public function verid_gt(){
		return $this->id_gt;
	}
	public function verstatus_grupo(){
		return $this->status_grupo;
	}
	public function verhora_creacion(){
		return $this->hora_creacion;
	}
	public function verfecha_creacion(){
		return $this->fecha_creacion;
	}
	public function verid_zona(){
		return $this->id_zona;
	}
	public function vernombre_grupo(){
		return $this->nombre_grupo;
	}

	public function validaExistencia($acceso)
	{
		$acceso->objeto->ejecutarSql("select * from grupo_trabajo where id_gt='$this->id_gt'");
		if($acceso->objeto->registros>0)
			return true;
		else
			return false;
	}
	public function incluirgrupo_trabajo($acceso)
	{
		$acceso->objeto->ejecutarSql("insert into grupo_trabajo(id_gt,nombre_grupo,id_zona,fecha_creacion,hora_creacion,status_grupo,id_franq) values ('$this->id_gt','$this->nombre_grupo','$this->id_zona','$this->fecha_creacion','$this->hora_creacion','$this->status_grupo','$this->id_franq')");	
				 
	}
	public function modificargrupo_trabajo($acceso)
	{
		$acceso->objeto->ejecutarSql("Update grupo_trabajo Set nombre_grupo='$this->nombre_grupo', id_franq='$this->id_franq', id_zona='$this->id_zona', fecha_creacion='$this->fecha_creacion', hora_creacion='$this->hora_creacion' , status_grupo='$this->status_grupo' Where id_gt='$this->id_gt'");	
				
	}
	public function desabilitargrupo_trabajo($acceso)
	{
		$acceso->objeto->ejecutarSql("Update grupo_trabajo Set status_grupo='INACTIVO' Where id_gt='$this->id_gt'");	
				
	}
	public function eliminargrupo_trabajo($acceso)
	{
		$acceso->objeto->ejecutarSql("delete from grupo_trabajo where id_gt='$this->id_gt'");
		
	}
}
?>