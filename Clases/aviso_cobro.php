<?php
session_start();
require_once "procesos.php"; $ini_u = $_SESSION["ini_u"]; 
class aviso_cobro
{
	private $id_cont_serv;
	private $id_serv;
	private $status_contrato;
	private $fecha_inst;
	private $cant_serv;
	private $id_persona;

	function __construct($id_cont_serv,$id_serv,$status_contrato,$fecha_inst,$cant_serv,$id_persona)
	{
		$this->id_cont_serv = $id_cont_serv;
		$this->id_serv = $id_serv;
		$this->status_contrato = $status_contrato;
		$this->fecha_inst = $fecha_inst;
		$this->cant_serv = $cant_serv;
		$this->id_persona = $id_persona;
	}
	public function verid_cont_serv(){
		return $this->id_cont_serv;
	}
	public function verid_persona(){
		return $this->id_persona;
	}
	public function vercant_serv(){
		return $this->cant_serv;
	}
	public function verfecha_inst(){
		return $this->fecha_inst;
	}
	public function verstatus_contrato(){
		return $this->status_contrato;
	}
	public function verid_serv(){
		return $this->id_serv;
	}

	public function validaExistencia($acceso)
	{
		$acceso->objeto->ejecutarSql("select * from contrato_servicio where id_cont_serv='$this->id_cont_serv'");
		if($acceso->objeto->registros>0)
			return true;
		else
			return false;
	}
	public function incluiraviso_cobro($acceso)
	{
		$ini_u = $_SESSION["ini_u"]; 
		if($this->status_contrato=="Todos"){
			$status="status_contrato='Activo' or status_contrato='Cortado'";
		}
		else{
			$status="status_contrato='$this->status_contrato'";
		}
		$dato=lectura($acceso,"select *from contrato where $status");
		//echo "\nselect *from contrato where $status";
		for($i=0;$i<count($dato);$i++){
			
			$id_contrato=trim($dato[$i]['id_contrato']);
			$acceso->objeto->ejecutarSql("select id_cont_serv from contrato_servicio_deuda  where (id_cont_serv ILIKE '$ini_u%')  ORDER BY id_cont_serv desc LIMIT 1 offset 0 "); 
			//$id_cont_serv=$ini_u.verCodLong($acceso,"id_cont_serv");
			$id_cont_serv=verCodLongD($acceso,"id_cont_serv",$ini_u);
			$fecha=date("Y-m-d");
			
			$tarifa_ser=verTarifa($acceso,$fecha,$id_serv);
			/*
			$acceso->objeto->ejecutarSql("select *from vista_tarifa where id_serv='$this->id_serv' and status_tarifa_ser='ACTIVO'"); 
			if($row=row($acceso))
			{
				$tarifa_ser=trim($row['tarifa_ser']);
				
			}
			*/
			
			//echo "select *from contrato_servicio where id_contrato='$id_contrato' and id_serv='$this->id_serv' and status_con_ser='CONTRATO'";
			$acceso->objeto->ejecutarSql("select *from contrato_servicio where id_contrato='$id_contrato' and id_serv='$this->id_serv' and status_con_ser='CONTRATO'"); 
			if($row=row($acceso))
			{
				$cant_serv=trim($row['cant_serv']);
				//echo "insert into contrato_servicio(id_cont_serv,id_serv,id_contrato,fecha_inst,cant_serv,status_con_ser) values ('$id_cont_serv','$this->id_serv','$id_contrato','$fecha','$cant_serv','Deuda')";
	//			$acceso->objeto->ejecutarSql("insert into contrato_servicio_deuda(id_cont_serv,id_serv,id_contrato,fecha_inst,cant_serv,status_con_ser,costo_cobro,descu,modo_des) values ('$id_cont_serv','$this->id_serv','$id_contrato','$fecha','$cant_serv','Deuda','$tarifa_ser','0','AUTOMATICO')");
	//			actualizarDeuda($acceso,$id_contrato);
			}
		}
		
		//$acceso->objeto->ejecutarSql("Update contrato Set status_contrato='Activo' Where status_contrato='POR INSTALAR'");
		//$acceso->objeto->ejecutarSql("Update contrato_servicio Set status_con_ser='Deuda' Where status_con_ser='Pendiente'");
		return true;
	}
	
	public function modificaraviso_cobro($acceso)
	{
		return $acceso->objeto->ejecutarSql("Update contrato_servicio Set id_serv='$this->id_serv', id_contrato='$this->id_contrato', fecha_inst='$this->fecha_inst', cant_serv='$this->cant_serv' Where id_cont_serv='$this->id_cont_serv'");	
	}
	public function eliminaraviso_cobro($acceso)
	{
		return $acceso->objeto->ejecutarSql("delete from contrato_servicio where id_cont_serv='$this->id_cont_serv'");
	}
}
?>