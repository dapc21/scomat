<?php
require_once "procesos.php"; $ini_u = $_SESSION["ini_u"];
class pago_servicio
{
	private $id_pago;
	private $id_cont_serv;
	private $costo_cobro_serv;

	function __construct($id_pago,$id_cont_serv,$costo_cobro_serv='')
	{
		$this->id_pago = $id_pago;
		$this->id_cont_serv = $id_cont_serv;
		$this->costo_cobro_serv = $costo_cobro_serv;
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
	public function incluirpago_servicio($acceso)
	{
		$ini_u = $_SESSION["ini_u"]; 
		if($ini_u==''){
			session_start();
			$ini_u = $_SESSION["ini_u"];  
		}
		$acceso->objeto->ejecutarSql("select apagar,tipo_doc,status_pago,id_pago from vista_contratodeu where id_cont_serv='$this->id_cont_serv'");
		if($row=$acceso->objeto->devolverRegistro()){
			$apagar = trim($row['apagar']);
			$tipo_doc = trim($row['tipo_doc']);
			$status_pago = trim($row['status_pago']);
			$id_pago = trim($row['id_pago']);
			if($this->costo_cobro_serv!=''){
				$apagar = $this->costo_cobro_serv;
			}
		}
		$acceso->objeto->ejecutarSql("insert into pago_factura(id_pago,id_cont_serv,costo_cobro_serv) values ('$this->id_pago','$this->id_cont_serv','$apagar')");
		$acceso->objeto->ejecutarSql("update contrato_servicio_deuda set pagado=pagado+$apagar , apagar=0 where id_cont_serv='$this->id_cont_serv'");
		$acceso->objeto->ejecutarSql("update contrato_servicio_deuda set status_con_ser='PAGADO'  where id_cont_serv='$this->id_cont_serv' and ((cant_serv * costo_cobro)-descu)=pagado");
		$acceso->objeto->ejecutarSql("update pagos set status_pago='PAGADO' where id_pago='$id_pago'");
		
		return true;
	}
	public function modificarpago_servicio($acceso)
	{
		return $acceso->objeto->ejecutarSql("Update pago_servicio Set id_cont_serv='$this->id_cont_serv' Where id_pago='$this->id_pago' and id_cont_serv='$this->id_cont_serv'");	
	}
	public function eliminarpago_servicio($acceso)
	{
		return $acceso->objeto->ejecutarSql("delete from pago_servicio where id_pago='$this->id_pago' and id_cont_serv='$this->id_cont_serv'");
	}
	
}
?>