<?php
session_start();
require_once "procesos.php";

class facturacion
{
	private $id_contrato;
	private $fecha;
	private $id_pago;
	
	function __construct($dat){
		$this->id_contrato = $dat['id_contrato'];
		$this->fecha = $dat['fecha'];
		$this->id_pago = $dat['id_pago'];
	}
	public function registrar_prorrateo_corte($acceso,$dias_prorrateo){
		$monto_suscrito = $this->ver_monto_suscrito($acceso);
		$costo_por_dia = $this->costo_por_dia($acceso);
		$monto_ajuste_credito = $monto_suscrito - ($dias_prorrateo*$costo_por_dia);
		echo "<br>monto_suscrito:$monto_suscrito";
		echo "<br>costo_por_dia:$costo_por_dia";
		echo "<br>monto_ajuste_credito:$monto_ajuste_credito";

		if($this->verifica_exite_mes($acceso)){
			echo "cargada";
			$this->registrar_ajuste_credito($acceso,$monto_ajuste_credito);
		}
		else{
			echo "no cargada";
			$this->id_pago=agregar_aviso_cliente_solo($acceso,$this->id_contrato,$this->fecha);
			$this->registrar_ajuste_credito($acceso,$monto_ajuste_credito);
		}
		$this->auditoria_aviso_factura($acceso);
	}
	public function registrar_prorrateo_reconexion($acceso,$dias_prorrateo){
		$monto_suscrito = $this->ver_monto_suscrito($acceso);
		$costo_por_dia = $this->costo_por_dia($acceso);
		$monto_ajuste_debito = ($dias_prorrateo*$costo_por_dia);
		$monto_ajuste_credito = $monto_suscrito - ($dias_prorrateo*$costo_por_dia);

		echo "<br>monto_suscrito:$monto_suscrito";
		echo "<br>costo_por_dia:$costo_por_dia";
		echo "<br>monto_ajuste_debito:$monto_ajuste_debito";

		if($this->verifica_exite_mes($acceso)){
			echo "<br>cargada";
			if($this->verifica_exite_mes_prorrateado($acceso)){
				echo "<br>cargada prorrateado";
				$this->registrar_ajuste_debito($acceso,$monto_ajuste_debito);
			}
			else{
				echo "<br>no prorrateado";
				$this->registrar_ajuste_credito($acceso,$monto_ajuste_credito);
			}
		}
		else{
			echo "<br>no cargada";
			$this->id_pago=agregar_aviso_cliente_solo($acceso,$this->id_contrato,$this->fecha);
			$this->registrar_ajuste_credito($acceso,$monto_ajuste_credito);
		}
		$this->auditoria_aviso_factura($acceso);
	}
	//VERIFICAR SI EL CLIENTE YA TIENE UNA MENSUALIUDAD CARGADA/
	public function verifica_exite_mes($acceso){
		list($ano,$mes,$dia)=explode("-",$this->fecha);
		$mes_inst=date ("Y-m",mktime(0,0,0, $mes,$dia,$ano));

		$acceso->objeto->ejecutarSql("select id_pago from pagos where id_contrato='$this->id_contrato' and TO_CHAR(fecha_factura,'YYYY-MM') ='$mes_inst' and  monto_pago>0 and (tipo_doc='AVISO' or tipo_doc='FACTURA') and (select count(*) from contrato_servicio_deuda,servicios where contrato_servicio_deuda.id_serv=servicios.id_serv and contrato_servicio_deuda.id_pago=pagos.id_pago and servicios.tipo_costo='COSTO MENSUAL' and servicios.tipo_paq='PAQUETE BASICO')>0 "); 
		if($row=row($acceso)){
			return true;
		}
		else{
			return false;
		}
	}
	public function verifica_exite_mes_prorrateado($acceso){

		if($this->verifica_exite_mes($acceso)){
			$monto_suscrito = $this->ver_monto_suscrito($acceso);
			$monto_doc = $this->ver_monto_documento($acceso);
			if($monto_suscrito>$monto_doc){
				return true;
			}
			else{
				return false;
			}
		}
		else{
			return false;
		}
	}
	//CALCULO PARA REGISTRAR AJUSTE DE CREDITO 
	public function registrar_ajuste_debito($acceso,$monto_ajuste_debito){
		$monto_suscrito = $this->ver_monto_suscrito($acceso);
		$porc_ajuste = ($monto_ajuste_debito*100) / $monto_suscrito;
		
		echo "<br>monto_suscrito:$monto_suscrito";
		echo "<br>monto_ajuste_debito:$monto_ajuste_debito";
		echo "<br>porc_ajuste:$porc_ajuste";
		$this->registrar_nota_debito($acceso,$monto_ajuste_debito);
		$this->aplicar_debito_aviso($acceso,$monto_ajuste_debito,$porc_ajuste);
	}
	//VERIFICAR SI EL CLIENTE YA TIENE UNA MENSUALIUDAD CARGADA/
	public function registrar_ajuste_credito($acceso,$monto_ajuste_credito){
		$monto_suscrito = $this->ver_monto_suscrito($acceso);
		$porc_ajuste = ($monto_ajuste_credito*100) / $monto_suscrito;
		
		echo "<br>monto_suscrito:$monto_suscrito";
		echo "<br>monto_ajuste_credito:$monto_ajuste_credito";
		echo "<br>porc_ajuste:$porc_ajuste";
		$this->registrar_nota_credito($acceso,$monto_ajuste_credito);
		$this->aplicar_credito_aviso($acceso,$monto_ajuste_credito,$porc_ajuste);
	}
	//DEVOLVER EL MONTO SUSCRITO DEL CLIENTE
	public function ver_monto_suscrito($acceso){
		$monto_suscrito=0;
		$acceso->objeto->ejecutarSql("select suscripcion('$this->id_contrato') as monto_suscrito");
		if($row=row($acceso)){
			$monto_suscrito=trim($row['monto_suscrito']);
		}
		return $monto_suscrito;	
	}
	//ver la cantidad de dias que trae el mes
	function ultimo_dia_mes(){
		list($anio,$mes,$dia)=explode("-",$this->fecha);
		$ult_dia_mes_act=date("t",mktime( 0, 0, 0, $mes, 1, $anio ));
		return $ult_dia_mes_act;
	}
	//calcula el costo por dia.
	function costo_por_dia($acceso){
		return $this->ver_monto_suscrito($acceso) / $this->ultimo_dia_mes(); 
	}
	//REGISTRAR EL AJUSTE DEBITO
	public function registrar_nota_debito($acceso,$monto_ajuste_debito){
		
		session_start();
		if($ini_u==''){ $ini_u = "ZZ"; }
		$login_sol = strtoupper(trim($_SESSION["login"]));
		$fecha_sol = date("Y-m-d");
		$hora_sol = date("H:i:s");
		$dir_ip_sol = $_SERVER['REMOTE_ADDR'];
		$tipo='AJUSTE DEBITO';
		$status="AUTORIZADO";
		$generado_por="SISTEMA";
		$idmotivonota="AM00003";
		$comentario_sol="CARGO POR PRORRATEO";
		$monto_cd=$monto_ajuste_debito;

		$acceso->objeto->ejecutarSql("select  id_nota from notas_cd  where (id_nota ILIKE '$ini_u%')   ORDER BY id_nota desc LIMIT 1 offset 0 ");
		$id_nota=$ini_u.verCodLong($acceso,"id_nota");

		$acceso->objeto->ejecutarSql("insert into notas_cd(id_nota,id_pago,tipo,idmotivonota,login_sol,dir_ip_sol,fecha_sol,hora_sol,comentario_sol,status,generado_por,login_aut,dir_ip_aut,fecha_aut,hora_aut,monto_cd) values ('$id_nota','$this->id_pago','$tipo','$idmotivonota','$login_sol','$dir_ip_sol','$fecha_sol','$hora_sol','$comentario_sol','$status','$generado_por','$login_sol','$dir_ip_sol','$fecha_sol','$hora_sol','$monto_cd')");
	}
	//REGISTRAR EL AJUSTE CREDITO
	public function registrar_nota_credito($acceso,$monto_ajuste_credito){
		
		session_start();
		if($ini_u==''){ $ini_u = "ZZ"; }
		$login_sol = strtoupper(trim($_SESSION["login"]));
		$fecha_sol = date("Y-m-d");
		$hora_sol = date("H:i:s");
		$dir_ip_sol = $_SERVER['REMOTE_ADDR'];
		$tipo='AJUSTE CREDITO';
		$status="AUTORIZADO";
		$generado_por="SISTEMA";
		$idmotivonota="AM00003";
		$comentario_sol="DESCUENTO POR PRORRATEO";
		$monto_cd=$monto_ajuste_credito;

		$acceso->objeto->ejecutarSql("select  id_nota from notas_cd  where (id_nota ILIKE '$ini_u%')   ORDER BY id_nota desc LIMIT 1 offset 0 ");
		$id_nota=$ini_u.verCodLong($acceso,"id_nota");

		$acceso->objeto->ejecutarSql("insert into notas_cd(id_nota,id_pago,tipo,idmotivonota,login_sol,dir_ip_sol,fecha_sol,hora_sol,comentario_sol,status,generado_por,login_aut,dir_ip_aut,fecha_aut,hora_aut,monto_cd) values ('$id_nota','$this->id_pago','$tipo','$idmotivonota','$login_sol','$dir_ip_sol','$fecha_sol','$hora_sol','$comentario_sol','$status','$generado_por','$login_sol','$dir_ip_sol','$fecha_sol','$hora_sol','$monto_cd')");
	}
	//APLICAR DEBITO AL AVISO Y A SUS CARGOS
	public function aplicar_debito_aviso($acceso,$monto_ajuste_debito,$porc_ajuste){
		//APLICAR CREDITO SOLO A LOS CARGOS MENSUALES
		//echo "<br>select id_serv from contrato_servicio where id_contrato='$this->id_contrato' and (status_con_ser='CONTRATO' OR status_con_ser='SUSPENDIDO')";
		$dato=lectura($acceso,"select servicios.id_serv,costo_cobro from contrato_servicio,servicios where contrato_servicio.id_serv=servicios.id_serv and id_contrato='$this->id_contrato' and (status_con_ser='CONTRATO' OR status_con_ser='SUSPENDIDO') and servicios.tipo_costo='COSTO MENSUAL' ");
		
		for($i=0;$i<count($dato);$i++){
			$id_serv=trim($dato[$i]['id_serv']);
			$costo_cobro=trim($dato[$i]['costo_cobro'])+0;
			$monto=(($costo_cobro*$porc_ajuste)/100);
			//echo "<br>update contrato_servicio_deuda set costo_cobro=(costo_cobro+$monto) where id_pago='$this->id_pago' and id_serv='$id_serv' ";
			$acceso->objeto->ejecutarSql("update contrato_servicio_deuda set costo_cobro=(costo_cobro+$monto) where id_pago='$this->id_pago' and id_serv='$id_serv' ");
		}
		$this->actualizar_monto_factura($acceso);
		
	}
	//APLICAR CREDITO AL AVISO Y A SUS CARGOS
	public function aplicar_credito_aviso($acceso,$monto_ajuste_credito,$porc_ajuste){
		//APLICAR CREDITO SOLO A LOS CARGOS MENSUALES
		//echo "select id_serv from contrato_servicio where id_contrato='$this->id_contrato' and (status_con_ser='CONTRATO' OR status_con_ser='SUSPENDIDO')";
		$dato=lectura($acceso,"select servicios.id_serv from contrato_servicio,servicios where contrato_servicio.id_serv=servicios.id_serv and id_contrato='$this->id_contrato' and (status_con_ser='CONTRATO' OR status_con_ser='SUSPENDIDO') and servicios.tipo_costo='COSTO MENSUAL'  ");
		
		for($i=0;$i<count($dato);$i++){
			$id_serv=trim($dato[$i]['id_serv']);
			
			$acceso->objeto->ejecutarSql("update contrato_servicio_deuda set costo_cobro=(costo_cobro-((costo_cobro*$porc_ajuste)/100)) where id_pago='$this->id_pago' and id_serv='$id_serv' ");
		}
		$this->actualizar_monto_factura($acceso);
		
	}
	//PARA ACTUALIZAR EL MONTO DE AVISO UNA VEZ MODIFICADO LOS CARGOS
	function actualizar_monto_factura($acceso){
		$acceso->objeto->ejecutarSql("select sum((cant_serv*costo_cobro)-descu) as monto_pago, sum(descu) as  desc_pago from contrato_servicio_deuda where id_pago='$this->id_pago'");
		$row=row($acceso);
		$monto_pago=trim($row['monto_pago'])+0;
		echo "<br>monto_pago:$monto_pago";
		$desc_pago=trim($row['desc_pago'])+0;
		$acceso->objeto->ejecutarSql("update pagos set monto_pago='$monto_pago' , desc_pago='$desc_pago' where id_pago='$this->id_pago'");
		return  $monto_pago;
	}
	//VERIFICAR AUDITORIA FACTURACION POR MES
	function auditoria_aviso_factura($acceso){
		$monto_suscrito = $this->ver_monto_suscrito($acceso)+0;
		$monto_doc_cm = $this->ver_monto_documento_costo_mensual($acceso)+0;
		$monto_doc = $this->ver_monto_documento($acceso)+0;
		$monto_ad = $this->ver_monto_ajuste_debito($acceso)+0;
		$monto_ac = $this->ver_monto_ajuste_credito($acceso)+0;

		$monto_factura = $monto_doc+$monto_ac-$monto_ad;

		$monto_factura = number_format($monto_factura+0, 2, '.', '')+0;
		$monto_suscrito = number_format($monto_suscrito+0, 2, '.', '')+0;
		$monto_doc = number_format($monto_doc+0, 2, '.', '')+0;
		$monto_ad = number_format($monto_ad+0, 2, '.', '')+0;
		$monto_ac = number_format($monto_ac+0, 2, '.', '')+0;

		echo "<br>monto_suscrito:$monto_suscrito";
		echo "<br>monto_doc:$monto_doc";
		echo "<br>monto_doc_cm:$monto_doc_cm";
		echo "<br>monto_ad:$monto_ad";
		echo "<br>monto_ac:$monto_ac";
		echo "<br>monto_factura:$monto_factura";
		echo "<br>:$monto_suscrito:$monto_factura:";


		if($monto_suscrito < $monto_doc_cm){
			$acceso->objeto->sql_error=$acceso->objeto->sql_error."<br>La suma de los cargos mensuales es mayor al monto suscrito
				<br>suma cargo mensual:$monto_doc_cm
				<br>Monto suscrito:$monto_suscrito";
				return false;
		}else{
			if($monto_suscrito == $monto_factura){
				return true;
			}else{
				echo "<br>:$monto_suscrito:$monto_factura:";
				$acceso->objeto->sql_error=$acceso->objeto->sql_error."<br>La Factura/Aviso no coincide con el monto suscrito
				<br>Factura/Aviso:$monto_factura
				<br>Monto suscrito:$monto_suscrito
				<br>Monto documento:$monto_doc
				<br>Monto_ajuste credito:$monto_ac
				<br>Monto_ajuste debito:$monto_ad";
				return false;
			}
		}
	}
	//PARA VER EL MONTO DE UN DOCUMENTO
	function ver_monto_documento($acceso){
		$acceso->objeto->ejecutarSql("select monto_pago from pagos where id_pago='$this->id_pago'");
		$row=row($acceso);
		$monto_pago=trim($row['monto_pago'])+0;
		return  $monto_pago;
	}
	//PARA VER EL MONTO DE CARGO MENSUAL DE UN DOCUMENTO
	function ver_monto_documento_costo_mensual($acceso){
		$acceso->objeto->ejecutarSql("select sum(cant_serv*costo_cobro) as monto from contrato_servicio_deuda,servicios where contrato_servicio_deuda.id_serv=servicios.id_serv  and servicios.tipo_costo='COSTO MENSUAL' and id_pago='$this->id_pago'");
		$row=row($acceso);
		$monto=trim($row['monto'])+0;
		return  $monto;
	}
	//PARA VER MONTO DE AJUSTES DE CREDITO
	function ver_monto_ajuste_credito($acceso){
		$acceso->objeto->ejecutarSql("select sum(monto_cd) as monto from notas_cd where id_pago='$this->id_pago' and tipo='AJUSTE CREDITO' ");
		$row=row($acceso);
		$monto=trim($row['monto'])+0;
		return  $monto;
	}
	//PARA VER MONTO DE AJUSTES DE DEBITO
	function ver_monto_ajuste_debito($acceso){
		$acceso->objeto->ejecutarSql("select sum(monto_cd) as monto from notas_cd where id_pago='$this->id_pago' and tipo='AJUSTE DEBITO' ");
		$row=row($acceso);
		$monto=trim($row['monto'])+0;
		return  $monto;
	}
}
?>