<?php
class status_contrato
{
	private $status_contrato;
	private $id_contrato;
	private $nombre_status;
	private $fecha_status;
	private $hora_status;
	private $status_con;
	private $dato;

	function __construct($status_contrato,$id_contrato,$nombre_status,$fecha_status,$hora_status,$status_con,$dato)
	{
		$this->status_contrato = $status_contrato;
		$this->id_contrato = $id_contrato;
		$this->nombre_status = $nombre_status;
		$this->fecha_status = $fecha_status;
		$this->hora_status = $hora_status;
		$this->status_con = $status_con;
		$this->dato = $dato;
	}
	public function verstatus_contrato(){
		return $this->status_contrato;
	}
	public function verdato(){
		return $this->dato;
	}
	public function verstatus_con(){
		return $this->status_con;
	}
	public function verhora_status(){
		return $this->hora_status;
	}
	public function verfecha_status(){
		return $this->fecha_status;
	}
	public function vernombre_status(){
		return $this->nombre_status;
	}
	public function verid_contrato(){
		return $this->id_contrato;
	}

	public function validaExistencia($acceso)
	{
			return false;
	}
	public function incluirstatus_contrato($acceso)
	{
		return $acceso->objeto->ejecutarSql("insert into status_contrato(status_contrato,id_contrato,nombre_status,fecha_status,hora_status,status_con,dato) values ('$this->status_contrato','$this->id_contrato','$this->nombre_status','$this->fecha_status','$this->hora_status','$this->status_con','$this->dato')");			
	}

}
?>