<?php
class visitas
{
	private $id_visita;
	private $id_orden;
	private $fecha_visita;
	private $comenta_visita;
	private $hora;
	
	function __construct($id_visita,$id_orden,$fecha_visita,$comenta_visita,$hora)
	{
		$this->id_visita = $id_visita;
		$this->id_orden = $id_orden;
		$this->fecha_visita = $fecha_visita;
		$this->comenta_visita = $comenta_visita;
		$this->hora = $hora;
	}
	public function verid_visita(){
		return $this->id_visita;
	}
	public function verdato(){
		return $this->dato;
	}
	public function vercomenta_visita(){
		return $this->comenta_visita;
	}
	public function verfecha_visita(){
		return $this->fecha_visita;
	}
	public function verid_orden(){
		return $this->id_orden;
	}

	public function validaExistencia($acceso)
	{
		$acceso->objeto->ejecutarSql("select * from visitas where id_visita='$this->id_visita'");
		if($acceso->objeto->registros>0)
			return true;
		else
			return false;
	}
	public function incluirvisitas($acceso)
	{
		
		 $acceso->objeto->ejecutarSql("insert into visitas(id_visita,id_orden,fecha_visita,comenta_visita,hora) values ('$this->id_visita','$this->id_orden','$this->fecha_visita','$this->comenta_visita','$this->hora')");			
		
	}
	public function modificarvisitas($acceso)
	{
		
		 $acceso->objeto->ejecutarSql("Update visitas Set id_orden='$this->id_orden', fecha_visita='$this->fecha_visita', comenta_visita='$this->comenta_visita', hora='$this->hora' Where id_visita='$this->id_visita'");	
		
	}
	public function eliminarvisitas($acceso)
	{
		
		$acceso->objeto->ejecutarSql("delete from visitas where id_visita='$this->id_visita'");
		
	}
}
?>