<?php
class tipo_pago
{
	private $id_tipo_pago;
	private $tipo_pago;
	private $status_pago;
	private $abrev_tp;

	function __construct($dat)
	{
		$this->id_tipo_pago = $dat['id_tipo_pago'];
		$this->tipo_pago = $dat['tipo_pago'];
		$this->status_pago = $dat['status_pago'];
		$this->abrev_tp = $dat['abrev_tp'];
	}
	
	public function validaExistencia($acceso)
	{
		$acceso->objeto->ejecutarSql("select * from tipo_pago where id_tipo_pago='$this->id_tipo_pago'");
		if($acceso->objeto->registros>0)
			return true;
		else
			return false;
	}
	public function incluir($acceso)
	{
		$acceso->objeto->ejecutarSql("insert into tipo_pago(id_tipo_pago,tipo_pago,status_pago,abrev_tp) values ('$this->id_tipo_pago','$this->tipo_pago','$this->status_pago','$this->abrev_tp')");			
			
	}
	public function modificar($acceso)
	{
		$acceso->objeto->ejecutarSql("Update tipo_pago Set tipo_pago='$this->tipo_pago', status_pago='$this->status_pago', abrev_tp='$this->abrev_tp' Where id_tipo_pago='$this->id_tipo_pago'");	
	}
	public function eliminar($acceso)
	{
		$acceso->objeto->ejecutarSql("delete from tipo_pago where id_tipo_pago='$this->id_tipo_pago'");		
	}
}
?>