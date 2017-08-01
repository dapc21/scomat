<?php
class trans_pago
{
	private $id_pago;
	private $id_contrato;
	
	function __construct($id_pago='',$id_contrato="")
	{
		$this->id_pago = $id_pago;
		$this->id_contrato = $id_contrato;
	}
	
	public function begin($acceso){
		return $acceso->objeto->ejecutarSql("BEGIN;");
	}
	public function commit($acceso){
		return $acceso->objeto->ejecutarSql("COMMIT;");
	}
	public function rollback($acceso){
		return $acceso->objeto->ejecutarSql("ROLLBACK;");
	}
	

	public function valida_transaccion_pago($acceso,$id_pago)
	{
		$monto_pago=0;
		$monto_tp=0;
		$costo_cobro=0;
		
		$acceso->objeto->ejecutarSql("select monto_pago from pagos where id_pago='$id_pago' and tipo_doc='PAGO'");
		if($row=row($acceso)){
			$monto_pago=trim($row['monto_pago'])+0;
			
			$acceso->objeto->ejecutarSql("select sum(monto_tp) as monto_tp from detalle_tipopago where id_pago='$id_pago'");
			if($row=row($acceso)){
				$monto_tp=trim($row['monto_tp'])+0;
			}
			$acceso->objeto->ejecutarSql("select sum(costo_cobro_serv) as costo_cobro from pago_factura where id_pago='$id_pago'");
			if($row=row($acceso)){
				$costo_cobro=trim($row['costo_cobro'])+0;
			}
		}
		
		$monto_pago=number_format($monto_pago, 2, '.', '');
		$monto_tp=number_format($monto_tp, 2, '.', '');
		$costo_cobro=number_format($costo_cobro, 2, '.', '');
		
		if($monto_pago==$monto_tp && $monto_pago==$costo_cobro){
			return true;
		}
		else{
			$acceso->objeto->sql_error=$acceso->objeto->sql_error."<br>DIFERENCIA EN MONTO: <br>Pago: $monto_pago <br>Detalle Pago: $costo_cobro <br>Forma Pago: $monto_tp ";
			return false;
		}
		
	}
	public function valida_transaccion_pago_nc($acceso,$id_pago)
	{
		$monto_pago=0;
		$monto_tp=0;
		$costo_cobro=0;
		
		$acceso->objeto->ejecutarSql("select monto_pago from pagos where id_pago='$id_pago' and tipo_doc='NOTA CREDITO'");
		if($row=row($acceso)){
			$monto_pago=trim($row['monto_pago'])+0;
			
			$acceso->objeto->ejecutarSql("select sum(costo_cobro_serv) as costo_cobro from pago_factura where id_pago='$id_pago'");
			if($row=row($acceso)){
				$costo_cobro=trim($row['costo_cobro'])+0;
			}
		}
		
		$monto_pago=number_format($monto_pago, 2, '.', '');
		$costo_cobro=number_format($costo_cobro, 2, '.', '');
		if($monto_pago==$costo_cobro){
			return true;
		}
		else{
			$acceso->objeto->sql_error=$acceso->objeto->sql_error."<br>DIFERENCIA EN MONTO: <br>Nota Credito: $monto_pago <br>Detalle Nota Credito: $costo_cobro ";
			return false;
		}
		
	}

	public function valida_transaccion_pago_nd($acceso,$id_pago)
	{
		$monto_pago=0;
		$monto_tp=0;
		$costo_cobro=0;
		
		$acceso->objeto->ejecutarSql("select monto_pago from pagos where id_pago='$id_pago' and tipo_doc='NOTA DEBITO'");
		if($row=row($acceso)){
			$monto_pago=trim($row['monto_pago'])+0;
			
			$acceso->objeto->ejecutarSql("select sum(cant_serv*costo_cobro) as costo_cobro from contrato_servicio_deuda where id_pago='$id_pago'");
			if($row=row($acceso)){
				$costo_cobro=trim($row['costo_cobro'])+0;
			}
		}
		
		$monto_pago=number_format($monto_pago, 2, '.', '');
		$costo_cobro=number_format($costo_cobro, 2, '.', '');
		if($monto_pago==$costo_cobro){
			return true;
		}
		else{
			$acceso->objeto->sql_error=$acceso->objeto->sql_error."<br>DIFERENCIA EN MONTO: <br>Nota Credito: $monto_pago <br>Detalle Nota Credito: $costo_cobro ";
			return false;
		}
		
	}








	public function validaExistencia($acceso){
		return true;
	}
	public function valida_pagotrans_pago($acceso)
	{
		if($this->valida_transaccion_pago($acceso,$this->id_pago)){
			
			
			$dato=lectura($acceso,"select contrato_servicio_pagado.id_cont_serv from contrato_servicio_pagado,pago_servicio where contrato_servicio_pagado.id_cont_serv=pago_servicio.id_cont_serv and id_pago='$this->id_pago'");
			for($i=0;$i<count($dato);$i++){
				$id_cont_serv=trim($dato[$i]['id_cont_serv']);
				$this->generaOrden($acceso,$id_cont_serv);
			}
			//$this->verifica_deuda_internet($acceso);
			$this->verifica_deuda($acceso,$this->id_pago);
		}
	}
	public function valida_pago_ndtrans_pago($acceso)
	{
		$monto_pago=0;
		$costo_cobro=0;
		$base_iva=0;
		//echo "select monto_pago,id_contrato,(base_imp+monto_iva) as base_iva from pagos where id_pago='$this->id_pago'";
		$acceso->objeto->ejecutarSql("select monto_pago,id_contrato,(base_imp+monto_iva) as base_iva from pagos where id_pago='$this->id_pago'");
		if($row=row($acceso)){
			$monto_pago=trim($row['monto_pago'])+0;
			$base_iva=trim($row['base_iva'])+0;
			$this->id_contrato=trim($row['id_contrato']);
			$acceso->objeto->ejecutarSql("select sum(costo_cobro) as costo_cobro from contrato_servicio_deuda where id_pago='$this->id_pago'");
			if($row=row($acceso)){
				$costo_cobro=trim($row['costo_cobro'])+0;
			}
		}
		$monto_pago=number_format($monto_pago+0, 1, '.', '');
		
		$costo_cobro=number_format($costo_cobro+0, 1, '.', '');
		$base_iva=number_format($base_iva+0, 1, '.', '');

		
		if($monto_pago==$costo_cobro && $monto_pago==$base_iva){
			
		}
		else{
			$acceso->objeto->sql_error=$acceso->objeto->sql_error."<br>DIFERENCIA EN MONTO: <br>Factura: $monto_pago <br>Servicio: $costo_cobro <br>Base + IVA: $base_iva ";

		}
		
			
	}
	
	public function valida_pago_nctrans_pago($acceso)
	{
		
		$dato=lectura($acceso,"select  id_cont_serv from pago_factura where id_pago='$this->id_pago'");
		for($i=0;$i<count($dato);$i++){
			$id_cont_serv=trim($dato[$i]['id_cont_serv']);
			

			$dato1=lectura($acceso,"select  id_cont_serv,id_contrato,costo_cobro,id_pago from vista_pago_ser where id_cont_serv='$id_cont_serv' and id_pago<>'$this->id_pago'");
			for($j=0;$j<count($dato1);$j++){
				$id_pago_ant=trim($dato1[$j]['id_pago']);
				$id_contrato=trim($dato1[$j]['id_contrato']);
				$costo_cobro_serv=trim($dato1[$j]['costo_cobro'])+0;

				$acceso->objeto->ejecutarSql("update contrato_servicio_deuda set pagado=pagado-$costo_cobro_serv , apagar=0 where id_cont_serv='$id_cont_serv' ");
				$acceso->objeto->ejecutarSql("update contrato_servicio_deuda set status_con_ser='DEUDA'  where id_cont_serv='$id_cont_serv' and (pagado < (cant_serv * costo_cobro)-descu)");
				//echo ":$id_contrato,$costo_cobro_serv:";
				$id_cont_serv_ant=agregar_abono($acceso,$id_contrato,$costo_cobro_serv);

				
				$acceso->objeto->ejecutarSql("update pago_factura set id_cont_serv='$id_cont_serv_ant' where id_cont_serv='$id_cont_serv' and id_pago='$id_pago_ant' ");
				
				if(!$this->valida_transaccion_pago($acceso,$id_pago_ant)){

				}
			}
		}	
		
		$monto_pago=0;
		$costo_cobro=0;
		$base_iva=0;
		//echo "select monto_pago,id_contrato,(base_imp+monto_iva) as base_iva from pagos where id_pago='$this->id_pago'";
		$acceso->objeto->ejecutarSql("select monto_pago,id_contrato,(base_imp+monto_iva) as base_iva from pagos where id_pago='$this->id_pago'");
		if($row=row($acceso)){
			$monto_pago=trim($row['monto_pago'])+0;
			$base_iva=trim($row['base_iva'])+0;
			$this->id_contrato=trim($row['id_contrato']);
			
			$acceso->objeto->ejecutarSql("select sum(costo_cobro_serv) as costo_cobro from pago_factura where id_pago='$this->id_pago'");
			if($row=row($acceso)){
				$costo_cobro=trim($row['costo_cobro'])+0;
			}
		}
		$monto_pago=number_format($monto_pago+0, 1, '.', '');
		
		$costo_cobro=number_format($costo_cobro+0, 1, '.', '');
		$base_iva=number_format($base_iva+0, 1, '.', '');

		
		if($monto_pago==$costo_cobro && $monto_pago==$base_iva){
		}
		else{
			echo "<br>DIFERENCIA EN MONTO: <br>Factura: $monto_pago <br>Servicio: $costo_cobro <br>Base + IVA: $base_iva ";
			
		}
		
			
	}
	
	public function valida_contrato_nuevotrans_pago($acceso)
	{
		$id_contrato=$this->id_contrato;
		$acceso->objeto->ejecutarSql("select id_contrato from vista_contrato_auditoria where id_contrato='$id_contrato'");
		if($row=row($acceso)){
			
		}
		else{
			$acceso->objeto->sql_error=$acceso->objeto->sql_error."<br>ERROR EN REGISTRO DE CONTRATO NUEVO";
		}
	}
	
	

	public function valida_nota_dc($acceso,$tipo,$monto_dc,$monto_anterior,$monto_posterior)
	{
		//echo ":$tipo,$monto_dc,$monto_anterior,$monto_posterior:";
		if($tipo=="NOTA DE CREDITO"){
			$monto_cal=$monto_anterior - $monto_posterior;
		}
		else if($tipo=="NOTA DE DEBITO"){
			$monto_cal=$monto_posterior - $monto_anterior;
		}
		if($monto_dc==$monto_cal){	
			return true;
		}
		else{
			$acceso->objeto->sql_error=$acceso->objeto->sql_error."<br>DIFERENCIA EN MONTO NOTA CREDITO DEBITO: <br>Tipo: $tipo <br>Monto Nota Credito/Debito: $monto_dc <br>Monto Calculado: $monto_cal ";
			return false;
		}
		
	}
	public function verifica_deuda_internet($acceso)
	{
		//echo "entro a verificar_deuda";
		$ini_u = $_SESSION["ini_u"]; 
		//echo ":select * from contrato_servicio,servicios where contrato_servicio.id_serv=servicios.id_serv and id_contrato='$this->id_contrato' and id_tipo_servicio='AP00001' and status_con_ser='SUSPENDIDO'";
		//$acceso->objeto->ejecutarSql("select * from contrato_servicio,servicios where contrato_servicio.id_serv=servicios.id_serv and id_contrato='$this->id_contrato' and id_tipo_servicio='AP00001' and status_con_ser='SUSPENDIDO'");
		$acceso->objeto->ejecutarSql("select * from contrato_servicio,servicios,contrato where contrato.id_contrato=contrato_servicio.id_contrato and  contrato_servicio.id_serv=servicios.id_serv and id_contrato='$this->id_contrato' and id_tipo_servicio='AP00001'  and status_con_ser='SUSPENDIDO' ");
		if($row=row($acceso)){
		
			//echo ":SELECT * FROM contrato_servicio_pagado ,servicios where contrato_servicio_pagado.id_serv=servicios.id_serv and id_tipo_servicio='AP00001' and servicios.id_serv='$this->id_serv' and  id_contrato='$this->id_contrato'";
			$acceso->objeto->ejecutarSql("SELECT * FROM contrato_servicio_pagado ,servicios where contrato_servicio_pagado.id_serv=servicios.id_serv and id_tipo_servicio='AP00001' and servicios.id_serv='$this->id_serv' and  id_contrato='$this->id_contrato'");
			if($row=row($acceso)){
		
				$fecha_act=date("Y-m-01");
				//echo ":SELECT sum(costo_cobro*cant_serv) as deuda FROM contrato_servicio_deuda ,servicios where contrato_servicio_deuda.id_serv=servicios.id_serv and id_tipo_servicio='AP00001' and id_contrato='$this->id_contrato' and fecha_inst<'$fecha_act':";
				$acceso->objeto->ejecutarSql("SELECT sum(costo_cobro*cant_serv) as deuda FROM contrato_servicio_deuda ,servicios where contrato_servicio_deuda.id_serv=servicios.id_serv and id_tipo_servicio='AP00001' and id_contrato='$this->id_contrato' and fecha_inst<'$fecha_act'");
				if($row=row($acceso)){
					$deuda=trim($row['deuda'])+0;
					//echo ":$deuda:";
					if($deuda==0){
						//echo ":SELECT  *from ordenes_tecnicos where (status_orden='CREADO' OR  status_orden='IMPRESO') AND id_contrato='$this->id_contrato' and id_det_orden='EA008003'";
						$acceso->objeto->ejecutarSql("SELECT  *from ordenes_tecnicos where (status_orden='CREADO' OR  status_orden='IMPRESO') AND id_contrato='$this->id_contrato' and id_det_orden='EA008003' ");
						if(!$row=row($acceso)){
						
							$fecha=date("Y-m-d");
							$id_det_orden="EA008003";
							$acceso->objeto->ejecutarSql("select id_orden from ordenes_tecnicos ORDER BY id_orden desc"); 
							$id_orden=verNumero($acceso,"id_orden");
						
							require_once "ordenes_tecnicos.php";
							$obj=new ordenes_tecnicos($id_orden,$fecha,$id_det_orden,$fecha,$fecha,'RECONEXION AUTOMATICA POR PAGO','','CREADO',$this->id_contrato,'NORMAL');
							$obj->incluirordenes_tecnicos_clases($acceso);
						//	$obj->imprimirordenes_tecnicos($acceso);
						}
					}
				}
			}
		}
	}

	
}
?>