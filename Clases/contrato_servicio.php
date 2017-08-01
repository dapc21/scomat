<?php
class contrato_servicio
{
	private $id_cont_serv;
	private $id_serv;
	private $id_contrato;
	private $fecha_inst;
	private $cant_serv;
	private $costo_cobro;

	function __construct($dat)
	{
		$this->id_cont_serv = $dat['id_cont_serv'];
		$this->id_serv = $dat['id_serv'];
		$this->id_contrato = $dat['id_contrato'];
		$this->fecha_inst = $dat['fecha_inst'];
		$this->cant_serv = $dat['cant_serv'];
		$this->costo_cobro = $dat['costo_cobro'];
	}
	
	public function validaExistencia($acceso)
	{
		$acceso->objeto->ejecutarSql("select * from contrato_servicio where id_cont_serv='$this->id_cont_serv'");
		if($acceso->objeto->registros>0)
			return true;
		else
			return false;
	}
	public function incluir($acceso)
	{
			session_start();
			
			$ini_u = $_SESSION["ini_u"];
			if($ini_u==''){
				$ini_u = $_SESSION["ini_u"];  
			}

			$acceso->objeto->ejecutarSql("select tipo_paq,tipo_costo,id_tipo_servicio from servicios where id_serv='$this->id_serv'");
			if($row=row($acceso)){
				$tipo_paq= trim($row["tipo_paq"]);
				$tipo_costo= trim($row["tipo_costo"]);
				$id_tipo_servicio= trim($row["id_tipo_servicio"]);
			 if($tipo_costo=='COSTO MENSUAL' && $tipo_paq=="PAQUETE BASICO" ){
				$acceso1=conexion();
				$acceso->objeto->ejecutarSql("select id_cont_serv from contrato_servicio, servicios where contrato_servicio.id_contrato='$this->id_contrato' and  servicios.id_serv=contrato_servicio.id_serv and tipo_costo='COSTO MENSUAL' and tipo_paq='PAQUETE BASICO' and id_tipo_servicio='$id_tipo_servicio'");
				while($row=row($acceso)){
					$id_cont_serv_del= trim($row["id_cont_serv"]);
					$acceso1->objeto->ejecutarSql("delete from contrato_servicio where id_cont_serv='$id_cont_serv_del'");
				}
			 }
			}
			$acceso->objeto->ejecutarSql("select id_contrato from contrato_servicio where id_contrato='$this->id_contrato' and id_serv='$this->id_serv' ");
			if(!$row=row($acceso)){
				$resp=$acceso->objeto->ejecutarSql("insert into contrato_servicio(id_cont_serv,id_serv,id_contrato,fecha_inst,cant_serv,status_con_ser,costo_cobro) values ('$this->id_cont_serv','$this->id_serv','$this->id_contrato','$this->fecha_inst','$this->cant_serv','CONTRATO','$this->costo_cobro')");
			}
			else{
				$acceso->objeto->sql_error=$acceso->objeto->sql_error." El PAQUETE YA ESTA AGREGADO. ";
			}
	}
	public function modificarcontrato_servicio($acceso)
	{
		
		$acceso->objeto->ejecutarSql("Update contrato_servicio Set id_serv='$this->id_serv', id_contrato='$this->id_contrato', fecha_inst='$this->fecha_inst', cant_serv='$this->cant_serv' costo_cobro='$this->costo_cobro' Where id_cont_serv='$this->id_cont_serv'");
	}
	public function modcontrato_servicio($acceso)
	{
		$acceso->objeto->ejecutarSql("Update contrato_servicio Set cant_serv='$this->cant_serv',costo_cobro='$this->costo_cobro' Where id_cont_serv='$this->id_cont_serv'");	
				 
	}
	public function eliminar($acceso)
	{
		$acceso->objeto->ejecutarSql("select id_tipo_servicio from contrato_servicio, servicios where contrato_servicio.id_cont_serv='$this->id_cont_serv' and  servicios.id_serv=contrato_servicio.id_serv and tipo_costo='COSTO MENSUAL' and tipo_paq='PAQUETE BASICO'");
		if($row=row($acceso)){
			$id_tipo_servicio= trim($row["id_tipo_servicio"]);
			$acceso->objeto->ejecutarSql("delete from contrato_servicio where id_contrato='$this->id_contrato' and  (select count(*) from servicios where servicios.id_serv=contrato_servicio.id_serv and id_tipo_servicio='$id_tipo_servicio')>0");
		}else{

			$acceso->objeto->ejecutarSql("delete from contrato_servicio where id_cont_serv='$this->id_cont_serv'");
		}
		
	}
}
?>