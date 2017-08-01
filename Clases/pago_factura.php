<?php
require_once "procesos.php"; $ini_u = $_SESSION["ini_u"];
class pago_factura
{
	private $id_pago;
	private $id_cont_serv;
	private $costo_cobro_serv;
	private $id_cont_serv_d;
	private $apagar;

	function __construct($dat)
	{
		$this->id_pago = $dat['id_pago'];
		$this->id_cont_serv = $dat['id_cont_serv'];
		$this->costo_cobro_serv = $dat['costo_cobro_serv'];
		$this->id_cont_serv_d = $dat['id_cont_serv_d'];
		$this->apagar = $dat['apagar'];
	}
	public function verid_pago(){
		return $this->id_pago;
	}
	public function verdato(){
		return $this->dato;
	}
	public function verid_cont_serv(){
		return $this->id_cont_serv;
	}
	public function validaExistencia($acceso){
		return false;
		$acceso->objeto->ejecutarSql("select * from pago_factura where id_pago='$this->id_pago' and id_cont_serv='$this->id_cont_serv'");
		if($acceso->objeto->registros>0){
			return true;
		}
		else{
			return false;
		}
	}
	public function incluir($acceso)
	{
		$acceso->objeto->ejecutarSql("select apagar from contrato_servicio_deuda where id_cont_serv='$this->id_cont_serv'");
		if($row=$acceso->objeto->devolverRegistro()){
			$apagar = trim($row['apagar'])+0;
			if($apagar>0){
				$acceso->objeto->ejecutarSql("insert into pago_factura(id_pago,id_cont_serv,costo_cobro_serv) values ('$this->id_pago','$this->id_cont_serv','$apagar')");
				$acceso->objeto->ejecutarSql("update contrato_servicio_deuda set pagado=pagado+$apagar , apagar=0 where id_cont_serv='$this->id_cont_serv'");
				$acceso->objeto->ejecutarSql("update contrato_servicio_deuda set status_con_ser='PAGADO'  where id_cont_serv='$this->id_cont_serv' and ((cant_serv * costo_cobro)-descu)=pagado");
			}
		}
		return true;
	}
	public function incluir_nc_sol($acceso)
	{
		$acceso->objeto->ejecutarSql("insert into pago_factura(id_pago,id_cont_serv,costo_cobro_serv) values ('$this->id_pago','$this->id_cont_serv','$this->apagar')");
	//	$acceso->objeto->ejecutarSql("update contrato_servicio_deuda set pagado=pagado+$this->apagar , apagar=0 where id_cont_serv='$this->id_cont_serv'");
	//	$acceso->objeto->ejecutarSql("update contrato_servicio_deuda set status_con_ser='PAGADO'  where id_cont_serv='$this->id_cont_serv' and ((cant_serv * costo_cobro)-descu)=pagado");
		
	}
	public function incluir_nc($acceso)
	{
		$acceso->objeto->ejecutarSql("insert into pago_factura(id_pago,id_cont_serv,costo_cobro_serv) values ('$this->id_pago','$this->id_cont_serv','$this->apagar')");
		$acceso->objeto->ejecutarSql("update contrato_servicio_deuda set pagado=pagado+$this->apagar , apagar=0 where id_cont_serv='$this->id_cont_serv'");
		$acceso->objeto->ejecutarSql("update contrato_servicio_deuda set status_con_ser='PAGADO'  where id_cont_serv='$this->id_cont_serv' and ((cant_serv * costo_cobro)-descu)=pagado");
		
	}
	public function incluir_nd($acceso)
	{
		$acceso->objeto->ejecutarSql("select * from contrato_servicio_deuda where id_cont_serv='$this->id_cont_serv'");
		if($row=$acceso->objeto->devolverRegistro()){		
			$id_serv = trim($row['id_serv']);
			$id_contrato = trim($row['id_contrato']);
			$fecha_inst = trim($row['fecha_inst']);
			$cant_serv = 1;
			$status_con_ser = 'DEUDA';
			$costo_cobro = $this->apagar;
			$descu = trim($row['descu']);
			$modo_des = trim($row['modo_des']);
		}
		$acceso->objeto->ejecutarSql("insert into contrato_servicio_deuda(id_cont_serv,id_serv,fecha_inst,cant_serv,status_con_ser,costo_cobro,descu,id_pago,pagado,apagar) values ('$this->id_cont_serv_d','$id_serv','$fecha_inst','$cant_serv','$status_con_ser','$costo_cobro','0','$this->id_pago',0,0)");

		return true;
	}
	public function modificar($acceso)
	{
		return $acceso->objeto->ejecutarSql("Update pago_factura Set id_cont_serv='$this->id_cont_serv' Where id_pago='$this->id_pago' and id_cont_serv='$this->id_cont_serv'");	
	}
	public function eliminar($acceso)
	{
		return $acceso->objeto->ejecutarSql("delete from pago_factura where id_pago='$this->id_pago' and id_cont_serv='$this->id_cont_serv'");
	}
	
}
?>