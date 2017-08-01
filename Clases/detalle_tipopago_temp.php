<?php
class detalle_tipopago_temp
{
	private $id_tp;
	private $id_tipo_pago;
	private $id_pago;
	private $id_banco;
	private $refer_tp;
	private $monto_tp;
	private $lote_tp;

	function __construct($dat)
	{
		$this->id_tp = $dat['id_tp'];
		$this->id_tipo_pago = $dat['id_tipo_pago'];
		$this->id_pago = $dat['id_pago'];
		$this->id_banco = $dat['id_banco'];
		$this->refer_tp = $dat['refer_tp'];
		$this->monto_tp = $dat['monto_tp'];
		$this->lote_tp = $dat['lote_tp'];
	}
	public function validaExistencia($acceso)
	{
		$acceso->objeto->ejecutarSql("select * from detalle_tipopago_temp where id_pago='$this->id_pago' and  id_tipo_pago='$this->id_tipo_pago' and id_banco='$this->id_banco' and refer_tp='$this->refer_tp'");
		if($acceso->objeto->registros>0)
			return true;
		else
			return false;
	}
	public function incluir($acceso)
	{
		$acceso->objeto->ejecutarSql("select * from detalle_tipopago_temp where id_pago='$this->id_pago' and  id_tipo_pago='$this->id_tipo_pago' and id_banco='$this->id_banco' and refer_tp='$this->refer_tp'");
		if($acceso->objeto->registros>0)
			$this->modificar($acceso);
		else{
			$acceso->objeto->ejecutarSql("insert into detalle_tipopago_temp(id_tp,id_tipo_pago,id_pago,id_banco,refer_tp,monto_tp,lote_tp) values ('$this->id_tp','$this->id_tipo_pago','$this->id_pago','$this->id_banco','$this->refer_tp','$this->monto_tp','$this->lote_tp')");
		}
	}
	public function modificar($acceso)
	{
		return $acceso->objeto->ejecutarSql("Update detalle_tipopago_temp Set id_tipo_pago='$this->id_tipo_pago', id_banco='$this->id_banco', refer_tp='$this->refer_tp', monto_tp='$this->monto_tp' , lote_tp='$this->lote_tp' Where id_tp='$this->id_tp' ");	
	}
	public function eliminar($acceso)
	{
		return $acceso->objeto->ejecutarSql("delete from detalle_tipopago_temp where id_tp='$this->id_tp'");
	}
}
?>