<?php
require_once "procesos.php"; $ini_u = $_SESSION["ini_u"];
class pago_servicio_nd
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
	public function incluirpago_servicio_nd($acceso)
	{
		$ini_u = $_SESSION["ini_u"]; 
		if($ini_u==''){
			session_start();
			$ini_u = $_SESSION["ini_u"];  
		}
		
  		if($ini_u==''){
			$ini_u = "ZZ";  
		}

				
		$acceso->objeto->ejecutarSql("select id_cont_serv from contrato_servicio_deuda  where (id_cont_serv ILIKE '$ini_u%')  ORDER BY id_cont_serv desc  LIMIT 1 offset 0 "); 
		$id_cont_serv1=verCodLongD($acceso,"id_cont_serv",$ini_u);

		$acceso->objeto->ejecutarSql("select id_serv,id_contrato,fecha_inst,cant_serv,status_con_ser from contrato_servicio_deuda where id_cont_serv='$this->id_cont_serv'");
		if($row=$acceso->objeto->devolverRegistro()){
			$id_serv = trim($row['id_serv']);
			$id_contrato = trim($row['id_contrato']);
			$fecha_inst = trim($row['fecha_inst']);
			$cant_serv = 1;
			$status_con_ser = 'DEUDA';
			$descu = 0;
			
		}
		//echo "insert into contrato_servicio_deuda(id_cont_serv,id_serv,id_contrato,fecha_inst,cant_serv,status_con_ser,costo_cobro,descu,modo_des,id_pago) values ('$id_cont_serv1','$id_serv','$id_contrato','$fecha_inst','$cant_serv','DEUDA','$this->costo_cobro_serv','0','','$this->id_pago')";
		$acceso->objeto->ejecutarSql("insert into contrato_servicio_deuda(id_cont_serv,id_serv,id_contrato,fecha_inst,cant_serv,status_con_ser,costo_cobro,descu,modo_des,id_pago) values ('$id_cont_serv1','$id_serv','$id_contrato','$fecha_inst','$cant_serv','DEUDA','$this->costo_cobro_serv','0','','$this->id_pago')");
		
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