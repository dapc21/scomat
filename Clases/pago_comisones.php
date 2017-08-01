<?php
class pago_comisones
{
	private $id_pago_com;
	private $id_confc;
	private $nro_comprob;
	private $fecha_pc;
	private $p_desde;
	private $p_hasta;
	private $total_cob_sis;
	private $por_comision;
	private $monto_comision;
	private $monto_ret_iva;
	private $monto_ret_islr;
	private $total_reintegro;
	private $monto_desc;
	private $total_deposito;
	private $realizado_por;
	private $registrado_por;
	private $pagado_por;
	private $status_pago_com;
	private $dato;


	function __construct($id_pago_com,$id_confc,$nro_comprob,$fecha_pc,$p_desde,$p_hasta,$total_cob_sis,$por_comision,$monto_comision,$monto_ret_iva,$monto_ret_islr,$total_reintegro,$monto_desc,$total_deposito,$realizado_por,$registrado_por,$pagado_por,$status_pago_com,$dato)
	{
		$this->id_pago_com = $id_pago_com;
		$this->id_confc = $id_confc;
		$this->nro_comprob = $nro_comprob;
		$this->fecha_pc = $fecha_pc;
		$this->p_desde = $p_desde;
		$this->p_hasta = $p_hasta;
		$this->total_cob_sis = $total_cob_sis;
		$this->por_comision = $por_comision;
		$this->monto_comision = $monto_comision;
		$this->monto_ret_iva = $monto_ret_iva;
		$this->monto_ret_islr = $monto_ret_islr;
		$this->total_reintegro = $total_reintegro;
		$this->monto_desc = $monto_desc;
		$this->total_deposito = $total_deposito;
		$this->realizado_por = $realizado_por;
		$this->registrado_por = $registrado_por;
		$this->pagado_por = $pagado_por;
		$this->status_pago_com = $status_pago_com;
		$this->dato = $dato;
	}
	public function verid_pago_com(){
		return $this->id_pago_com;
	}
	public function verdato(){
		return $this->dato;
	}
	public function verstatus_pago_com(){
		return $this->status_pago_com;
	}
	public function verpagado_por(){
		return $this->pagado_por;
	}
	public function verregistrado_por(){
		return $this->registrado_por;
	}
	public function verrealizado_por(){
		return $this->realizado_por;
	}
	public function vertotal_deposito(){
		return $this->total_deposito;
	}
	public function vermonto_desc(){
		return $this->monto_desc;
	}
	public function vertotal_reintegro(){
		return $this->total_reintegro;
	}
	public function vermonto_ret_islr(){
		return $this->monto_ret_islr;
	}
	public function vermonto_ret_iva(){
		return $this->monto_ret_iva;
	}
	public function vermonto_comision(){
		return $this->monto_comision;
	}
	public function verpor_comision(){
		return $this->por_comision;
	}
	public function vertotal_cob_sis(){
		return $this->total_cob_sis;
	}
	public function verp_hasta(){
		return $this->p_hasta;
	}
	public function verp_desde(){
		return $this->p_desde;
	}
	public function verfecha_pc(){
		return $this->fecha_pc;
	}
	public function vernro_comprob(){
		return $this->nro_comprob;
	}
	public function verid_confc(){
		return $this->id_confc;
	}

	public function validaExistencia($acceso)
	{
		$acceso->objeto->ejecutarSql("select * from pago_comisones where id_pago_com='$this->id_pago_com'");
		if($acceso->objeto->registros>0)
			return true;
		else
			return false;
	}
	public function incluirpago_comisones($acceso)
	{
		//echo "insert into pago_comisones(id_pago_com,id_confc,nro_comprob,fecha_pc,p_desde,p_hasta,total_cob_sis,por_comision,monto_comision,monto_ret_iva,monto_ret_islr,total_reintegro,monto_desc,total_deposito,realizado_por,registrado_por,pagado_por,status_pago_com,dato) values ('$this->id_pago_com','$this->id_confc','$this->nro_comprob','$this->fecha_pc','$this->p_desde','$this->p_hasta','$this->total_cob_sis','$this->por_comision','$this->monto_comision','$this->monto_ret_iva','$this->monto_ret_islr','$this->total_reintegro','$this->monto_desc','$this->total_deposito','$this->realizado_por','$this->registrado_por','$this->pagado_por','$this->status_pago_com','$this->dato')";
		return $acceso->objeto->ejecutarSql("insert into pago_comisones(id_pago_com,id_confc,nro_comprob,fecha_pc,p_desde,p_hasta,total_cob_sis,por_comision,monto_comision,monto_ret_iva,monto_ret_islr,total_reintegro,monto_desc,total_deposito,realizado_por,registrado_por,pagado_por,status_pago_com,dato) values ('$this->id_pago_com','$this->id_confc','$this->nro_comprob','$this->fecha_pc','$this->p_desde','$this->p_hasta','$this->total_cob_sis','$this->por_comision','$this->monto_comision','$this->monto_ret_iva','$this->monto_ret_islr','$this->total_reintegro','$this->monto_desc','$this->total_deposito','$this->realizado_por','$this->registrado_por','$this->pagado_por','$this->status_pago_com','$this->dato')");			
	}
	public function modificarpago_comisones($acceso)
	{
		return $acceso->objeto->ejecutarSql("Update pago_comisones Set id_confc='$this->id_confc', nro_comprob='$this->nro_comprob', fecha_pc='$this->fecha_pc', p_desde='$this->p_desde', p_hasta='$this->p_hasta', total_cob_sis='$this->total_cob_sis', por_comision='$this->por_comision', monto_comision='$this->monto_comision', monto_ret_iva='$this->monto_ret_iva', monto_ret_islr='$this->monto_ret_islr', total_reintegro='$this->total_reintegro', monto_desc='$this->monto_desc', total_deposito='$this->total_deposito', realizado_por='$this->realizado_por', registrado_por='$this->registrado_por', pagado_por='$this->pagado_por', status_pago_com='$this->status_pago_com', dato='$this->dato' Where id_pago_com='$this->id_pago_com'");	
	}
	public function eliminarpago_comisones($acceso)
	{
		return $acceso->objeto->ejecutarSql("delete from pago_comisones where id_pago_com='$this->id_pago_com'");
	}
}
?>