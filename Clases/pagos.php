<?php
require_once "procesos.php"; $ini_u = $_SESSION["ini_u"]; 
class pagos
{
	private $id_pago;
	private $id_caja_cob;
	private $fecha_pago;
	private $monto_pago;
	private $obser_pago;
	private $status_pago;
	private $nro_factura;
	private $id_contrato;
	private $nro_control;
	private $desc_pago;
	private $por_iva;
	private $n_credito;
	private $fecha_factura;
	private $impresion;
	private $detalletipo_pago;
	private $pago_factura;
	private $id_pago_fac;
	private $motivo;
	private $saldo_act;


	
	function __construct($dat)
	{
		$this->id_pago = $dat['id_pago'];
		$this->id_caja_cob = $dat['id_caja_cob'];
		$this->fecha_pago = $dat['fecha_pago'];
		$this->monto_pago = $dat['monto_pago'];
		$this->obser_pago = $dat['obser_pago'];
		$this->status_pago = $dat['status_pago'];
		$this->nro_factura = $dat['nro_factura'];
		$this->id_contrato = $dat['id_contrato'];
		$this->nro_control = $dat['nro_control'];
		$this->desc_pago = $dat['desc_pago'];
		$this->por_iva = $dat['por_iva'];
		$this->n_credito = $dat['n_credito'];
		$this->fecha_factura = $dat['fecha_factura'];
		$this->impresion = $dat['impresion'];
		$this->detalle_tipopago = $dat['detalle_tipopago'];
		$this->pago_factura = $dat['pago_factura'];
		$this->id_pago_fac = $dat['id_pago_fac'];
		$this->motivo = $dat['motivo'];
		
	}
	public function validaExistencia($acceso)
	{
		$acceso->objeto->ejecutarSql("select * from pagos where id_pago='$this->id_pago'");
		if($acceso->objeto->registros>0)
			return true;
		else
			return false;
	}
	public function incluir($acceso)
	{
		session_start();
		$ini_u = $_SESSION["ini_u"];
		
		$this->tipo_doc="PAGO";
		$this->status_pago="PAGADO";
		$this->impresion="NO";
		$this->por_iva="12";
		$this->desc_pago="0";

		//echo "insert into pagos(id_pago,id_caja_cob,fecha_pago,monto_pago,obser_pago,status_pago,nro_factura,id_contrato,nro_control,desc_pago,por_iva,fecha_factura,impresion,tipo_doc) values ('$this->id_pago','$this->id_caja_cob','now()','$this->monto_pago','$this->obser_pago','$this->status_pago','$this->nro_factura','$this->id_contrato','$this->nro_control','$this->desc_pago','$this->por_iva','now()','$this->impresion','$this->tipo_doc')";
		$acceso->objeto->ejecutarSql("insert into pagos(id_pago,id_caja_cob,fecha_pago,monto_pago,obser_pago,status_pago,nro_factura,id_contrato,nro_control,desc_pago,por_iva,fecha_factura,impresion,tipo_doc) values ('$this->id_pago','$this->id_caja_cob','now()','$this->monto_pago','$this->obser_pago','$this->status_pago','$this->nro_factura','$this->id_contrato','$this->nro_control','$this->desc_pago','$this->por_iva','now()','$this->impresion','$this->tipo_doc')");

		if($this->nro_control!=''){
			$acceso->objeto->ejecutarSql("Update recibos Set status_pago='FACTURADO' Where nro_recibo='$this->nro_control' and tipo='FACTURA' ");	
		}

		require_once "detalle_tipopago.php";
		$acceso->objeto->ejecutarSql("select id_tp from detalle_tipopago  where (id_tp ILIKE '$ini_u%')  ORDER BY id_tp desc LIMIT 1 offset 0 "); 
		$id_tp= $ini_u.verCoo($acceso,"id_tp");

		for ($i=0; $i < count($this->detalle_tipopago); $i++){
			$this->detalle_tipopago[$i]["id_tp"]=$id_tp;
			$obj_tp=new detalle_tipopago($this->detalle_tipopago[$i]);
			$obj_tp->incluir($acceso);
			$id_tp=$ini_u.verCoo_inc($acceso,$id_tp);
		}

		require_once "pago_factura.php";
		for ($i=0; $i < count($this->pago_factura); $i++){
			$obj_tp=new pago_factura($this->pago_factura[$i]);
			$obj_tp->incluir($acceso);
		}
		if($obj_trans->valida_transaccion_pago($acceso,$this->id_pago)){
			//$this->generaOrden($acceso,$this->id_pago);
			//$this->verifica_deuda($acceso,$this->id_pago);
			$acceso->objeto->ejecutarSql("select update_saldo('$this->id_contrato');");
			$this->generaOrdenReconexion($acceso,$id_pago);
		}
	}
	public function nota_credito_factura($acceso)
	{
		session_start();
		$ini_u = $_SESSION["ini_u"];
		$acceso->objeto->ejecutarSql("select fecha_factura from PAGOS where id_pago='$this->id_pago_fac'");
		if($row=row($acceso)){
			$this->fecha_factura=trim($row['fecha_factura']);
		}

		$acceso->objeto->ejecutarSql("select nombremotivonota from motivonotas where idmotivonota='$this->motivo'");
		if($row=row($acceso)){
			$nombremotivonota=trim($row['nombremotivonota']);
		}
		$this->tipo_doc="NOTA CREDITO";
		$this->id_caja_cob='EA00000001';
		$this->status_pago="SOLICITADA";
		$this->impresion="SI";
		$this->por_iva="12";
		$this->desc_pago="0";
		$acceso->objeto->ejecutarSql("insert into pagos(id_pago,id_caja_cob,fecha_pago,monto_pago,obser_pago,status_pago,nro_factura,id_contrato,nro_control,desc_pago,por_iva,fecha_factura,impresion,tipo_doc,n_credito) values ('$this->id_pago','$this->id_caja_cob','now()','$this->monto_pago','$nombremotivonota','$this->status_pago','$this->nro_factura','$this->id_contrato','$this->nro_control','$this->desc_pago','$this->por_iva','$this->fecha_factura','$this->impresion','$this->tipo_doc','$this->id_pago_fac')");
		$acceso->objeto->ejecutarSql("update pagos set n_credito='$this->id_pago' where id_pago='$this->id_pago_fac'");

		session_start();
		$login_sol = strtoupper(trim($_SESSION["login"]));
		$fecha_sol = date("Y-m-d");
		$hora_sol = date("H:i:s");
		$dir_ip_sol = $_SERVER['REMOTE_ADDR'];
		$tipo='NOTA CREDITO';
		$status="SOLICITADA";
		$generado_por="USUARIO";
		$acceso->objeto->ejecutarSql("select  id_nota from notas_cd  where (id_nota ILIKE '$ini_u%')   ORDER BY id_nota desc LIMIT 1 offset 0 ");
		$id_nota=$ini_u.verCodLong($acceso,"id_nota");

		$acceso->objeto->ejecutarSql("insert into notas_cd(id_nota,id_pago,tipo,idmotivonota,login_sol,dir_ip_sol,fecha_sol,hora_sol,comentario_sol,status,generado_por,monto_cd) values ('$id_nota','$this->id_pago','$tipo','$this->motivo','$login_sol','$dir_ip_sol','$fecha_sol','$hora_sol','$this->obser_pago','$status','$generado_por','$this->monto_pago')");

		require_once "pago_factura.php";
		for ($i=0; $i < count($this->pago_factura); $i++){
			$obj_tp=new pago_factura($this->pago_factura[$i]);
			$obj_tp->incluir_nc_sol($acceso);
		}
		if($obj_trans->valida_transaccion_pago_nc($acceso,$this->id_pago)){
			$acceso->objeto->ejecutarSql("select update_saldo('$this->id_contrato');");
			
		}

	}
	public function nota_debito_factura($acceso)
	{
		session_start();
		$ini_u = $_SESSION["ini_u"];
		$acceso->objeto->ejecutarSql("select fecha_factura from PAGOS where id_pago='$this->id_pago_fac'");
		if($row=row($acceso)){
			$this->fecha_factura=trim($row['fecha_factura']);
		}
		$acceso->objeto->ejecutarSql("select nombremotivonota from motivonotas where idmotivonota='$this->motivo'");
		if($row=row($acceso)){
			$nombremotivonota=trim($row['nombremotivonota']);
		}

		$this->tipo_doc="NOTA DEBITO";
		$this->id_caja_cob='EA00000001';
		$this->status_pago="GENERADA";
		$this->impresion="SI";
		$this->por_iva="12";
		$this->desc_pago="0";
		$acceso->objeto->ejecutarSql("insert into pagos(id_pago,id_caja_cob,fecha_pago,monto_pago,obser_pago,status_pago,nro_factura,id_contrato,nro_control,desc_pago,por_iva,fecha_factura,impresion,tipo_doc,n_debito) values ('$this->id_pago','$this->id_caja_cob','now()','$this->monto_pago','$nombremotivonota','$this->status_pago','$this->nro_factura','$this->id_contrato','$this->nro_control','$this->desc_pago','$this->por_iva','$this->fecha_factura','$this->impresion','$this->tipo_doc','$this->id_pago_fac')");
		$acceso->objeto->ejecutarSql("update pagos set n_debito='$this->id_pago' where id_pago='$this->id_pago_fac'");

		$acceso->objeto->ejecutarSql("select id_cont_serv from contrato_servicio_deuda  where (id_cont_serv ILIKE '$ini_u%')  ORDER BY id_cont_serv desc  LIMIT 1 offset 0 "); 
		$id_cont_serv_d=verCodLongD($acceso,"id_cont_serv",$ini_u);

		session_start();
		$login_sol = strtoupper(trim($_SESSION["login"]));
		$fecha_sol = date("Y-m-d");
		$hora_sol = date("H:i:s");
		$dir_ip_sol = $_SERVER['REMOTE_ADDR'];
		$tipo='NOTA DEBITO';
		$status="AUTORIZADO";
		$generado_por="USUARIO";
		$acceso->objeto->ejecutarSql("select  id_nota from notas_cd  where (id_nota ILIKE '$ini_u%')   ORDER BY id_nota desc LIMIT 1 offset 0 ");
		$id_nota=$ini_u.verCodLong($acceso,"id_nota");

		$acceso->objeto->ejecutarSql("insert into notas_cd(id_nota,id_pago,tipo,idmotivonota,login_sol,dir_ip_sol,fecha_sol,hora_sol,comentario_sol,status,generado_por,login_aut,dir_ip_aut,fecha_aut,hora_aut,monto_cd) values ('$id_nota','$this->id_pago','$tipo','$this->motivo','$login_sol','$dir_ip_sol','$fecha_sol','$hora_sol','$this->obser_pago','$status','$generado_por','$login_sol','$dir_ip_sol','$fecha_sol','$hora_sol','$this->monto_pago')");


		require_once "pago_factura.php";
		for ($i=0; $i < count($this->pago_factura); $i++){
			$this->pago_factura[$i]["id_cont_serv_d"]=$id_cont_serv_d;
			$obj_tp=new pago_factura($this->pago_factura[$i]);
			$obj_tp->incluir_nd($acceso);
			$id_cont_serv_d=$ini_u.verCodLongInc($acceso,$id_cont_serv_d);
		}

		
		if($obj_trans->valida_transaccion_pago_nd($acceso,$this->id_pago)){
			$acceso->objeto->ejecutarSql("select update_saldo('$this->id_contrato');");
			
		}
	}
	public function anularfacturapagos($acceso)
	{
		$ip_est = $_SERVER['REMOTE_ADDR'];
		$acceso->objeto->ejecutarSql("select * from estacion_trabajo where ip_est='$ip_est' and status_est='IMPRESORAFISCAL'");
		if($row=row($acceso)){
			$id_est=trim($row['id_est']);
		}
	
	//	$acceso->objeto->ejecutarSql("insert into pagos(id_pago,id_caja_cob,fecha_pago,hora_pago,monto_pago,obser_pago,status_pago,nro_factura,id_contrato,nro_control,desc_pago,por_iva,monto_iva,por_reten,monto_reten,base_imp,islr,fecha_factura) values ('$this->id_pago','$this->id_caja_cob','$this->fecha_pago','$this->hora_pago','0','$this->obser_pago','ANULADO','$this->nro_factura','$this->id_contrato','$this->nro_control','0','0','0','0','0','0','0','$this->fecha_factura')");
	}
	public function modificarpagos($acceso)
	{
	//	$acceso->objeto->ejecutarSql("Update pagos Set id_caja_cob='$this->id_caja_cob', fecha_pago='$this->fecha_pago', hora_pago='$this->hora_pago', monto_pago='$this->monto_pago', obser_pago='$this->obser_pago', status_pago='$this->status_pago', nro_factura='$this->nro_factura', id_contrato='$this->id_contrato' Where id_pago='$this->id_pago'");	
	}
	
	public function modificar_num_facpagos($acceso){
		$acceso->objeto->ejecutarSql("Update pagos Set nro_factura='$this->nro_factura' Where id_pago='$this->id_pago'");	
				
	}
	public function modificar_num_controlpagos($acceso){
		$acceso->objeto->ejecutarSql("Update pagos Set nro_control='$this->nro_control' Where id_pago='$this->id_pago'");	
				
	}
	
	public function modificar_forma_pagopagos($acceso){
		
		$acceso->objeto->ejecutarSql("delete from detalle_tipopago where id_pago='$this->id_pago'");	
		$valor=explode("-Cla-",$this->nro_factura);
		for($i=0;$i<count($valor);$i++){
			$ca=explode("=-=",$valor[$i]);
			
			$id_tipo_pago=$ca[0];
			$banco=$ca[1];
			$numero=$ca[2];
			$monto_tp=$ca[3];
			$acceso->objeto->ejecutarSql("insert into detalle_tipopago(id_tipo_pago,id_pago,banco,numero,monto_tp) values ('$id_tipo_pago','$this->id_pago','$banco','$numero','$monto_tp')");
		}
				require_once "trans_pago.php";
				$obj=new trans_pago($this->id_pago);
				if($obj->valida_transaccion_pago($acceso,$this->id_pago)){
					
				}
				else{
					$acceso->objeto->sql_error=$acceso->objeto->sql_error."<br>La factura original no conserva la integridad de los datos <br>";
				}
	}
	
	public function anular_pagopagos($acceso)
	{

				
					$dato=lectura($acceso,"select id_cont_serv,costo_cobro_serv from pago_factura where id_pago='$this->id_pago'");
					for($i=0;$i<count($dato);$i++){
						$id_cont_serv=trim($dato[$i]['id_cont_serv']);
						$costo_cobro_serv=trim($dato[$i]['costo_cobro_serv'])+0;
						ECHO "update contrato_servicio_deuda set status_con_ser='DEUDA', pagado=pagado-$costo_cobro_serv where id_cont_serv='$id_cont_serv' ";
						$acceso->objeto->ejecutarSql("update contrato_servicio_deuda set status_con_ser='DEUDA', pagado=pagado-$costo_cobro_serv where id_cont_serv='$id_cont_serv' ");
					}
					$acceso->objeto->ejecutarSql("Update pagos Set status_pago='ANULADO' Where id_pago='$this->id_pago'");
				
	}
	public function anularpagos($acceso)
	{
		
		if($ini_u==''){
			session_start();
			$ini_u = $_SESSION["ini_u"];  
		}
		$ip_est = $_SERVER['REMOTE_ADDR'];
		//echo "select * from estacion_trabajo where ip_est='$ip_est' and status_est='IMPRESORAFISCAL'";
		$acceso->objeto->ejecutarSql("select * from estacion_trabajo where ip_est='$ip_est' and status_est='IMPRESORAFISCAL'");
		if($row=row($acceso)){
			$id_est=trim($row['id_est']);
			$nombre_est=trim($row['nombre_est']);
			$fecha=date("Y-m-d");
		//	echo "select * from vista_caja where fecha_caja='$fecha'  and id_est='$id_est' and status_caja_cob='Abierta'";
			$acceso->objeto->ejecutarSql("select * from vista_caja where fecha_caja='$fecha'  and id_est='$id_est' and status_caja_cob='Abierta'");
			$row=row($acceso);
			$id_caja_cob_caja=trim($row['id_caja_cob']);

		}
		$suma_pago_ser=0;
				
				$acceso->objeto->ejecutarSql("select * from  pagos where id_pago='$this->id_pago'");
				if($row=row($acceso)){
					$id_pago=trim($row['id_pago']);
					$id_caja_cob=$id_caja_cob_caja;
					$fecha_pago=trim($row['fecha_pago']);
					$fecha_pago=date("Y-m-d");
					$hora_pago=trim($row['hora_pago']);
					$monto_pago=trim($row['monto_pago']);
					$obser_pago=trim($row['obser_pago']);
					$status_pago='NOTA CREDITO';
					$nro_factura=trim($row['nro_factura']);
					$id_contrato=trim($row['id_contrato']);
					$nro_control=trim($row['nro_control']);
					$nota_credito=trim($row['nota_credito']);
					$cont=trim($row['cont']);
					$inc=trim($row['inc']);
					$desc_pago=trim($row['desc_pago']);
					$por_iva=trim($row['por_iva']);
					$monto_iva=trim($row['monto_iva']);
					$por_reten=trim($row['por_reten']);
					$monto_reten=trim($row['monto_reten']);
					$base_imp=trim($row['base_imp']);
					$islr=trim($row['islr']);
					$fecha_factura=trim($row['fecha_factura']);
					

					//$acceso->objeto->ejecutarSql("update detalle_tipopago set monto_tp=$monto_pago where id_pago='$this->id_pago' ");
					//$acceso->objeto->ejecutarSql("delete from detalle_tipopago  where id_pago='$this->id_pago' and (id_tipo_pago='TPA00009' or id_tipo_pago='TPA00010') ");
					
					
					$acceso->objeto->ejecutarSql("select id_est from  caja_cobrador where id_caja_cob='$id_caja_cob'");
					if($row=row($acceso)){
						$id_est=trim($row['id_est']);
					}
					$acceso->objeto->ejecutarSql("select pagos.nro_factura from pagos,caja_cobrador where pagos.id_caja_cob=caja_cobrador.id_caja_cob and id_est='$id_est' and status_pago='NOTA CREDITO' ORDER BY inc desc LIMIT 1 offset 0 ");
					$n_credito = verCodFact($acceso,"nro_factura");
					
					$acceso->objeto->ejecutarSql("select id_pago from pagos where (id_pago ILIKE '$ini_u%') ORDER BY id_pago desc LIMIT 1 offset 0 "); 
					$id_pago = $ini_u.verCodLargo($acceso,"id_pago");
					
					$acceso->objeto->ejecutarSql("select nro_control,inc from pagos  ORDER BY inc desc LIMIT 1 offset 0 "); 
					$nro_control = verCodControl($acceso,"nro_control");
	
	
					if(!$acceso->objeto->ejecutarSql("insert into pagos(id_pago,id_caja_cob,fecha_pago,hora_pago,monto_pago,obser_pago,status_pago,nro_factura,id_contrato,nro_control,desc_pago,por_iva,monto_iva,por_reten,monto_reten,base_imp,islr,fecha_factura,n_credito,nota_credito) values ('$id_pago','$id_caja_cob','$fecha_pago','$hora_pago','$monto_pago','$obser_pago','$status_pago','$n_credito','$id_contrato','$nro_control','$desc_pago','$por_iva','$monto_iva','$por_reten','$monto_reten','$base_imp','$islr','$fecha_factura','$nro_factura','$this->id_pago')")){
						echo "<br>insert into pagos(id_pago,id_caja_cob,fecha_pago,hora_pago,monto_pago,obser_pago,status_pago,nro_factura,id_contrato,nro_control,desc_pago,por_iva,monto_iva,por_reten,monto_reten,base_imp,islr,fecha_factura,n_credito,nota_credito) values ('$id_pago','$id_caja_cob','$fecha_pago','$hora_pago','$monto_pago','$obser_pago','$status_pago','$n_credito','$id_contrato','$nro_control','$desc_pago','$por_iva','$monto_iva','$por_reten','$monto_reten','$base_imp','$islr','$fecha_factura','$nro_factura','$this->id_pago')";
						echo '<br>'.$acceso->objeto->error().'<br>';
					}
					
					$dato=lectura($acceso,"select *from pago_servicio where id_pago='$this->id_pago'");
					for($i=0;$i<count($dato);$i++){
						$id_cont_serv=trim($dato[$i]['id_cont_serv']);
						$acceso->objeto->ejecutarSql("select * from contrato_servicio_pagado where id_cont_serv='$id_cont_serv'");
						if($row=$acceso->objeto->devolverRegistro()){
							$id_serv = trim($row['id_serv']);
							$id_contrato = trim($row['id_contrato']);
							$fecha_inst = trim($row['fecha_inst']);
							$cant_serv = trim($row['cant_serv'])+0;
							$status_con_ser = 'DEUDA';
							$costo_cobro = trim($row['costo_cobro'])+0;
							$descu = trim($row['descu'])+0;
							$modo_des = trim($row['modo_des']);
							//echo "($costo_cobro:$cant_serv):$descu:";
							$suma_pago_ser+= ($costo_cobro*$cant_serv)-$descu;
							
							$acceso->objeto->ejecutarSql("select id_cont_serv from contrato_servicio_deuda   where (id_cont_serv ILIKE '$ini_u%')   ORDER BY id_cont_serv desc LIMIT 1 offset 0 "); 
							$id_cont_s=verCodLongD($acceso,"id_cont_serv",$ini_u);
							
							$acceso->objeto->ejecutarSql("insert into contrato_servicio_deuda(id_cont_serv,id_serv,id_contrato,fecha_inst,cant_serv,status_con_ser,costo_cobro,descu,modo_des) values ('$id_cont_s','$id_serv','$id_contrato','$fecha_inst','$cant_serv','$status_con_ser','$costo_cobro','$descu','$modo_des')");
						}
					}
					$acceso->objeto->ejecutarSql("select obser_pago from pagos where id_pago='$id_pago' and status_pago='NOTA CREDITO' ");
					if($row=row($acceso)){
						$obser_pago=trim($row['obser_pago']);
						if($obser_pago=='NOTA CREDITO'){
							
							$acceso->objeto->sql_error=$acceso->objeto->sql_error."<br>Esta Factura ya posee una NOTA DE CREDITO:$obser_pago";
							return ;
						}
						else{
							$acceso->objeto->ejecutarSql("Update pagos Set obser_pago='NOTA CREDITO', n_credito='$n_credito', nota_credito='$id_pago' Where id_pago='$this->id_pago'");
						}
					}
					
				}
				require_once "trans_pago.php";
				$obj=new trans_pago($this->id_pago);
				if($obj->valida_transaccion_pago($acceso,$this->id_pago)){
					$acceso->objeto->ejecutarSql("select sum((costo_cobro*cant_serv)-descu) as costo_cobro from contrato_servicio_pagado,pago_servicio where contrato_servicio_pagado.id_cont_serv=pago_servicio.id_cont_serv and id_pago='$this->id_pago'");
					if($row=row($acceso)){
						$costo_cobro=trim($row['costo_cobro'])+0;
					}
					if($costo_cobro==$suma_pago_ser){
						$acceso->objeto->ejecutarSql("select monto_pago from pagos where id_pago='$id_pago' and status_pago='NOTA CREDITO' ");
						if($row=row($acceso)){
							$monto_pago_nc=trim($row['monto_pago'])+0;
						}
						$acceso->objeto->ejecutarSql("select monto_pago from pagos where id_pago='$this->id_pago' and status_pago='PAGADO' AND obser_pago='NOTA CREDITO' ");
						if($row=row($acceso)){
							$monto_pago=trim($row['monto_pago'])+0;
						}
					//	echo ":$monto_pago_nc==$monto_pago:";
						if($monto_pago_nc==$monto_pago){
							
						}
						else{
							$acceso->objeto->sql_error=$acceso->objeto->sql_error."<br>La factura ogiginal no concuerda con la NOTA DE CREDITO
							<br>Monto Factura: $monto_pago
							<br>Monto Nota Credito: $monto_pago_nc";
						}
					}
					else{
						
						$acceso->objeto->sql_error=$acceso->objeto->sql_error."<br>Los servicios pagados no se restauraron como deuda
							<br>Monto pagado: $costo_cobro
							<br>Monto deuda: $suma_pago_ser";
					}
				}
				else{
					$acceso->objeto->sql_error=$acceso->objeto->sql_error."<br>La factura original no conserva la integridad de los datos <br>";
					
				}
				
	}
	public function eliminarpagos($acceso)
	{
		
		if($ini_u==''){
			session_start();
			$ini_u = $_SESSION["ini_u"];  
		}
		//	$acceso->objeto->ejecutarSql("Update pagos Set status_pago='ANULADO' Where id_pago='$this->id_pago'");	
		
		$dato=lectura($acceso,"select *from pago_servicio where id_pago='$this->id_pago'");
		$acceso->objeto->ejecutarSql("delete from pago_servicio where id_pago='$this->id_pago'");
		$acceso->objeto->ejecutarSql("delete from detalle_tipopago where id_pago='$this->id_pago'");
		$acceso->objeto->ejecutarSql("delete from pagos where id_pago='$this->id_pago'");
		//echo "delete from pagos where id_pago='$this->id_pago'";
		//echo "\nselect *from contrato where $status";
		for($i=0;$i<count($dato);$i++){
			$id_cont_serv=trim($dato[$i]['id_cont_serv']);
			
			
			$acceso->objeto->ejecutarSql("select * from contrato_servicio_pagado where id_cont_serv='$id_cont_serv'");
			if($row=$acceso->objeto->devolverRegistro()){
				$id_serv = trim($row['id_serv']);
				$id_contrato = trim($row['id_contrato']);
				$fecha_inst = trim($row['fecha_inst']);
				$cant_serv = trim($row['cant_serv']);
				$status_con_ser = 'DEUDA';
				$costo_cobro = trim($row['costo_cobro']);
			
				$acceso->objeto->ejecutarSql("select id_cont_serv from contrato_servicio_deuda   where (id_cont_serv ILIKE '$ini_u%')   ORDER BY id_cont_serv desc LIMIT 1 offset 0 "); 
				$id_cont_s=verCodLongD($acceso,"id_cont_serv",$ini_u);
			
				$acceso->objeto->ejecutarSql("insert into contrato_servicio_deuda(id_cont_serv,id_serv,id_contrato,fecha_inst,cant_serv,status_con_ser,costo_cobro,descu,modo_des) values ('$id_cont_s','$id_serv','$id_contrato','$fecha_inst','$cant_serv','$status_con_ser','$costo_cobro','0','AUTOMATICO')");
				actualizarDeuda($acceso,$id_contrato);
				//echo "delete from contrato_servicio_pagado where id_cont_serv='$id_cont_serv'";
				$acceso->objeto->ejecutarSql("delete from contrato_servicio_pagado where id_cont_serv='$id_cont_serv'");
			}
		}
				
	}
	public function nota_de_creditopagos($acceso)
	{
		$acceso->objeto->ejecutarSql("select nota_credito from pagos where nota_credito>0 ORDER BY nota_credito desc LIMIT 1 offset 0 "); 
		$nota_credito = verNumero($acceso,"nota_credito");
		
		//echo "Update pagos Set status_pago='NOTA DE CREDITO', nota_credito='$nota_credito'  Where id_pago='$this->id_pago'";
		//	$acceso->objeto->ejecutarSql("Update pagos Set status_pago='NOTA DE CREDITO', nota_credito='$nota_credito' Where id_pago='$this->id_pago'");	
		return true;
	}
	public function generaOrdenReconexion($acceso,$id_pago)
	{
		session_start();
		$ini_u = $_SESSION["ini_u"]; 

		$acceso->objeto->ejecutarSql("select update_saldo(id_contrato) as saldo from contrato where id_contrato='$this->id_contrato' ");
		if($row=row($acceso)){
			$saldo=trim($row['saldo'])+0;
			$this->saldo_act=$saldo-$this->monto_pago;
		}

		$acceso->objeto->ejecutarSql("select status_contrato,update_saldo(id_contrato) as saldo from contrato where id_contrato='$this->id_contrato' and status_contrato='ACTIVO DESHABILITADO'");
		if($row=row($acceso)){
			$saldo=trim($row['saldo'])+0;
			//echo "saldo:".$saldo;
		  if($saldo<=0){
		  		require_once "ordenes_tecnicos.php";
				$id_det_orden="DEO00003";
				
				$acceso->objeto->ejecutarSql("select id_orden from ordenes_tecnicos  where (id_orden ILIKE '$ini_u%')   ORDER BY id_orden desc LIMIT 1 offset 0 ");
				$id_orden=$ini_u.verCodLong($acceso,"id_orden");
				$dat = array();
				$dat['id_orden']=$id_orden;
				$dat['id_det_orden']=$id_det_orden;
				$dat['id_contrato']=$this->id_contrato;
				$dat['detalle_orden']="GENERADO AUTOMATICAMENTE";
				$dat['comentario_orden']='';
				$dat['prioridad']='NORMAL';
				//echo "entro a reconectar";
				$obj=new ordenes_tecnicos($dat);
				$obj->incluir($acceso);
				return true;
			}
		}
		
	}

	
	public function generaOrden($acceso,$id_pago)
	{

		
		$acceso->objeto->ejecutarSql("select id_contrato from vista_pago_ser where id_pago='$id_pago' and tipo_serv='RECONEXION' and status_con_ser='PAGADO'");
		if($row=row($acceso)){
			$id_contrato=trim($row["id_contrato"]);			

			$fecha=date("Y-m-d");
			$id_det_orden="DEO00003";
			session_start();
			$ini_u = $_SESSION["ini_u"];
			$acceso->objeto->ejecutarSql("select id_orden from ordenes_tecnicos  where (id_orden ILIKE '$ini_u%')   ORDER BY id_orden desc LIMIT 1 offset 0 ");
			$id_orden=$ini_u.verCodLong($acceso,"id_orden");
				require_once "ordenes_tecnicos.php";
				
				$obj=new ordenes_tecnicos($id_orden,$fecha,$id_det_orden,$fecha,$fecha,'RECONEXION AUTOMATICA POR PAGO','','CREADO',$id_contrato,'NORMAL');
				$obj->incluirordenes_tecnicos_clases($acceso);
		}
	}

	public function verifica_deuda($acceso,$id_pago)
	{
		$acceso->objeto->ejecutarSql("SELECT id_contrato FROM pagos WHERE id_pago='$this->id_pago'");
			if($row=row($acceso)){
				$this->id_contrato=trim($row['id_contrato']);
			}
		$ini_u = $_SESSION["ini_u"]; 
		//echo ":VERIFICA:";
		//echo "select status_contrato from contrato where id_contrato='$this->id_contrato' and status_contrato='POR CORTAR'";
		$acceso->objeto->ejecutarSql("select status_contrato from contrato where id_contrato='$this->id_contrato' and status_contrato='POR CORTAR'");
		if($row=row($acceso)){
			$fecha_act=date("Y-m-01");
			$acceso->objeto->ejecutarSql("
				SELECT sum(((cant_serv * costo_cobro)-descu)-pagado) as deuda FROM contrato_servicio_deuda,pagos WHERE contrato_servicio_deuda.id_pago = pagos.id_pago and id_contrato='$this->id_contrato' and  fecha_inst < '$fecha_act'
				");
			if($row=row($acceso)){
				
				$deuda=trim($row['deuda']);
				$acceso->objeto->ejecutarSql("select *from parametros where id_param='37'");
				$row=row($acceso);
				$sal_min=trim($row['valor_param'])+0;
				
				$deu=$deuda+0;
				if($deu<=$sal_min){
					$acceso->objeto->ejecutarSql("SELECT  *from ordenes_tecnicos where (status_orden='CREADO' OR  status_orden='IMPRESO') AND id_det_orden='DEO00010' AND id_contrato='$this->id_contrato' ");
					if($row=row($acceso)){
							$id_orden=trim($row['id_orden']);
							$id_det_orden=trim($row['id_det_orden']);
							$fecha_orden=trim($row['fecha_orden']);
							$fecha_imp=trim($row['fecha_imp']);
							
							$login= $_SESSION["login"];
							$hora=date("H:i:s");
							$fecha = date("Y-m-d");
							
							require_once "ordenes_tecnicos.php";
							$obj=new ordenes_tecnicos($id_orden,$fecha_orden,$id_det_orden,$fecha_imp,$fecha,'CANCELADO AUTOMATICO POR PAGO','','CANCELADA',$this->id_contrato,'NORMAL');
							$obj->canceladafinalordenes_tecnicos($acceso);
		
					}
				}
			}
		}
	}
	
}
?>