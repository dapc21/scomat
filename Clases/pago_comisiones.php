<?php
class pago_comisiones
{
	private $id_comi;
	private $id_persona;
	private $comi_para;
	private $fecha_comi;
	private $fecha_desde;
	private $fecha_hasta;
	private $porcent_aplic;
	private $monto_comi;
	private $status_comi;
	private $dato;

	function __construct($id_comi,$id_persona,$comi_para,$fecha_comi,$fecha_desde,$fecha_hasta,$porcent_aplic,$monto_comi,$status_comi,$dato)
	{
		$this->id_comi = $id_comi;
		$this->id_persona = $id_persona;
		$this->comi_para = $comi_para;
		$this->fecha_comi = $fecha_comi;
		$this->fecha_desde = $fecha_desde;
		$this->fecha_hasta = $fecha_hasta;
		$this->porcent_aplic = $porcent_aplic;
		$this->monto_comi = $monto_comi;
		$this->status_comi = $status_comi;
		$this->dato = $dato;
	}
	public function verid_comi(){
		return $this->id_comi;
	}
	public function verdato(){
		return $this->dato;
	}
	public function verstatus_comi(){
		return $this->status_comi;
	}
	public function vermonto_comi(){
		return $this->monto_comi;
	}
	public function verporcent_aplic(){
		return $this->porcent_aplic;
	}
	public function verfecha_hasta(){
		return $this->fecha_hasta;
	}
	public function verfecha_desde(){
		return $this->fecha_desde;
	}
	public function verfecha_comi(){
		return $this->fecha_comi;
	}
	public function vercomi_para(){
		return $this->comi_para;
	}
	public function verid_persona(){
		return $this->id_persona;
	}

	public function validaExistencia($acceso)
	{
		$acceso->objeto->ejecutarSql("select * from pago_comisiones where id_comi='$this->id_comi'");
		if($acceso->objeto->registros>0)
			return true;
		else
			return false;
	}
	public function incluirpago_comisiones($acceso)
	{
		
		return $acceso->objeto->ejecutarSql("insert into pago_comisiones(id_comi,id_persona,comi_para,fecha_comi,fecha_desde,fecha_hasta,porcent_aplic,monto_comi,status_comi) values ('$this->id_comi','$this->id_persona','$this->comi_para','$this->fecha_comi','$this->fecha_desde','$this->fecha_hasta','$this->porcent_aplic','$this->monto_comi','$this->status_comi')");			
	}
	public function modificarpago_comisiones($acceso)
	{
		return $acceso->objeto->ejecutarSql("Update pago_comisiones Set id_persona='$this->id_persona', comi_para='$this->comi_para', fecha_comi='$this->fecha_comi', fecha_desde='$this->fecha_desde', fecha_hasta='$this->fecha_hasta', porcent_aplic='$this->porcent_aplic', monto_comi='$this->monto_comi', status_comi='$this->status_comi' Where id_comi='$this->id_comi'");	
	}
	public function eliminarpago_comisiones($acceso)
	{
		return $acceso->objeto->ejecutarSql("delete from pago_comisiones where id_comi='$this->id_comi'");
	}
}
?>