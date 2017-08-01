<?php
class tipo_pago_df
{
	private $id_tipo_pago;
	private $tipo_pago;
	private $tipo_tp;
	private $status_pago;
	

	function __construct($id_tipo_pago,$tipo_pago,$tipo_tp,$status_pago)
	{
		$this->id_tipo_pago = $id_tipo_pago;
		$this->tipo_pago = $tipo_pago;
		$this->tipo_tp = $tipo_tp;
		$this->status_pago = $status_pago;
		
	}
	public function verid_tipo_pago(){
		return $this->id_tipo_pago;
	}
	public function verdato(){
		return $this->dato;
	}
	public function verstatus_pago(){
		return $this->status_pago;
	}
	public function vertipo_tp(){
		return $this->tipo_tp;
	}
	public function vertipo_pago(){
		return $this->tipo_pago;
	}

	public function validaExistencia($acceso)
	{
		$acceso->objeto->ejecutarSql("select * from tipo_pago_df where id_tipo_pago='$this->id_tipo_pago'");
		if($acceso->objeto->registros>0)
			return true;
		else
			return false;
	}
	public function incluirtipo_pago_df($acceso)
	{
		return $acceso->objeto->ejecutarSql("insert into tipo_pago_df(id_tipo_pago,tipo_pago,tipo_tp,status_pago) values ('$this->id_tipo_pago','$this->tipo_pago','$this->tipo_tp','$this->status_pago')");			
	}
	public function modificartipo_pago_df($acceso)
	{
		return $acceso->objeto->ejecutarSql("Update tipo_pago_df Set tipo_pago='$this->tipo_pago', tipo_tp='$this->tipo_tp', status_pago='$this->status_pago' Where id_tipo_pago='$this->id_tipo_pago'");	
	}
	public function eliminartipo_pago_df($acceso)
	{
		return $acceso->objeto->ejecutarSql("delete from tipo_pago_df where id_tipo_pago='$this->id_tipo_pago'");
	}
}
?>