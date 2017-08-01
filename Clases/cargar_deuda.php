<?php
session_start();
require_once "procesos.php";

class cargar_deuda
{
	private $id_cd;
	private $id_contrato;
	private $id_serv;
	private $costo;
	private $tipo_costo;
	private $fecha_inst;
	private $cantidad;
	
	function __construct($dat)
	{
		$this->id_contrato = $dat['id_contrato'];
		$this->id_serv = $dat['id_serv'];
		$this->costo = $dat['costo'];
		$this->tipo_costo = $dat['tipo_costo'];
		$this->fecha_inst = $dat['mes'];
		$this->cantidad = $dat['cantidad'];
		$this->id_cd = $dat['id_cd'];
	}
	public function cargar($acceso)
	{
		$acceso->objeto->ejecutarSql("select *from contrato where id_contrato='$this->id_contrato'"); 
		if($row=row($acceso))
		{
			if($this->tipo_costo=="COSTO MENSUAL"){
				list($ano,$mes,$dia)=explode("-",$this->fecha_inst);
				$mes_inst=date ("Y-m",mktime(0,0,0, $mes,$dia,$ano));
				$acceso->objeto->ejecutarSql("select id_pago from pagos where id_contrato='$this->id_contrato' and TO_CHAR(fecha_factura,'YYYY-MM') ='$mes_inst' and  monto_pago>0 and (tipo_doc='AVISO' or tipo_doc='FACTURA')");
				if(!$row=row($acceso)){
					agregar_factura_cliente_solo($acceso,$this->id_contrato,$this->fecha_inst);
					$acceso->objeto->ejecutarSql("select update_saldo('$this->id_contrato');");
					//agregar_aviso_cliente_solo($acceso,$this->id_contrato,$this->fecha_inst);
				}else{
					return "Aviso tiene una factura cargada para este mes";
				}
			}
			else if($this->tipo_costo=="COSTO UNICO"){
				$fecha=date("Y-m-d");
				//return agregar_aviso_unico_cliente($acceso,$this->id_contrato,$fecha,$this->id_serv,$this->costo);
				//return agregar_aviso_unico_cargar_deuda($acceso,$this->id_contrato);
				return agregar_factura_unico_cargar_deuda($acceso,$this->id_contrato);
			}
		}
		
	}

	public function incluir($acceso)
	{	
		$acceso->objeto->ejecutarSql("select * from cargar_deuda where id_serv='$this->id_serv' and  id_contrato='$this->id_contrato' and id_cd<>'$this->id_cd'");
		if($acceso->objeto->registros>0){
			return "Ya esta registrado este cargo";
		}
		else{

			$acceso->objeto->ejecutarSql("select * from cargar_deuda where id_cd='$this->id_cd'");
			if($acceso->objeto->registros>0){
				return $this->modificar($acceso);
			}
			else{
				return $acceso->objeto->ejecutarSql("insert into cargar_deuda(id_cd,id_serv,id_contrato,cantidad,costo) values ('$this->id_cd','$this->id_serv','$this->id_contrato','$this->cantidad','$this->costo')");
			}			
		}
	}
	public function modificar($acceso)
	{
		return $acceso->objeto->ejecutarSql("Update cargar_deuda Set id_serv='$this->id_serv', id_contrato='$this->id_contrato', cantidad='$this->cantidad', costo='$this->costo' Where id_cd='$this->id_cd'");	
	}
	public function eliminar($acceso)
	{
		return $acceso->objeto->ejecutarSql("delete from cargar_deuda where id_cd='$this->id_cd'");
	}

	public function eliminar_inst($acceso)
	{
		$acceso->objeto->ejecutarSql("delete from cargar_deuda where id_cd='$this->id_cd'");
		$this->eliminar_alquiler($acceso);
	}

	public function incluir_inst($acceso)
	{	
		$acceso->objeto->ejecutarSql("select * from cargar_deuda where id_serv='$this->id_serv' and  id_contrato='$this->id_contrato' and id_cd<>'$this->id_cd'");
		if($acceso->objeto->registros>0){
			return "Ya esta registrado este cargo";
		}

		else{

			$acceso->objeto->ejecutarSql("select * from cargar_deuda where id_cd='$this->id_cd'");
			if($acceso->objeto->registros>0){
				 $this->modificar_inst($acceso);
			}
			else{
				$acceso->objeto->ejecutarSql("insert into cargar_deuda(id_cd,id_serv,id_contrato,cantidad,costo) values ('$this->id_cd','$this->id_serv','$this->id_contrato','$this->cantidad','$this->costo')");
			}
			$this->eliminar_alquiler($acceso);
			$this->agregar_alquiler($acceso);
		}
	}
	public function modificar_inst($acceso)
	{
		return $acceso->objeto->ejecutarSql("Update cargar_deuda Set id_serv='$this->id_serv', id_contrato='$this->id_contrato', cantidad='$this->cantidad', costo='$this->costo' Where id_cd='$this->id_cd'");	
	}
	
	public function agregar_alquiler($acceso)
	{
		$acceso->objeto->ejecutarSql("select tipo_servicio.id_tipo_servicio from servicios,tipo_servicio where servicios.id_tipo_servicio = tipo_servicio.id_tipo_servicio and id_serv='$this->id_serv' and codificado='SI'"); 
				if($row=row($acceso)){
					$id_tipo_servicio = trim($row['id_tipo_servicio']);

					$acceso->objeto->ejecutarSql("select id_serv,tarifa_ser from vista_tarifa where id_tipo_servicio='$id_tipo_servicio' and tipo_serv='ALQUILER' and status_tarifa_ser='ACTIVO' ");
					if($row=row($acceso)){
						$id_serv = trim($row['id_serv']);
						$costo_cobro = trim($row['tarifa_ser']);
						
						include_once "Clases/contrato_servicio_temp.php";
						session_start();
						$ini_u = $_SESSION["ini_u"]; 
						$acceso->objeto->ejecutarSql("select id_cont_serv from contrato_servicio_temp  where (id_cont_serv ILIKE '$ini_u%')  ORDER BY id_cont_serv desc LIMIT 1 offset 0 "); 
						$id_cont_serv= $ini_u.verCodLong($acceso,"id_cont_serv");
						$dat = array();
						$dat['id_cont_serv'] = $id_cont_serv;
						$dat['id_serv'] = $id_serv;
						$dat['id_contrato'] = $this->id_contrato;
						$dat['fecha_inst'] = date("Y-m-d");
						$dat['cant_serv'] = $this->cantidad;
						$dat['costo_cobro'] = $costo_cobro;
						$obj=new contrato_servicio_temp($dat);
						$obj->incluir($acceso);
					}
				}
	}
	public function eliminar_alquiler($acceso)
	{
		$acceso->objeto->ejecutarSql("select tipo_servicio.id_tipo_servicio from servicios,tipo_servicio where servicios.id_tipo_servicio = tipo_servicio.id_tipo_servicio and id_serv='$this->id_serv' and codificado='SI'"); 
		if($row=row($acceso)){
			$id_tipo_servicio = trim($row['id_tipo_servicio']);
			$acceso->objeto->ejecutarSql("delete from contrato_servicio_temp where id_contrato='$this->id_contrato' and (select count(*) from servicios where contrato_servicio_temp.id_serv=servicios.id_serv and id_tipo_servicio='$id_tipo_servicio' and tipo_serv='ALQUILER')>0 ");
		}
	}
	
}
?>