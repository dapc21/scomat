<?php
//archivo destinado a procesar y devolver datos o informacion relaciona con la aplicacion
session_start();
//require_once "procesos.php"; $ini_u = $_SESSION["ini_u"]; 
$cadena=$_POST['d'];
$valor=explode("=@",$cadena);
$clase=$valor[0];

//echo ":".$_SESSION["autenticacion"].":".$_SESSION["ini_u"].":";
if($_SESSION["autenticacion"]!="On"){
	
	if($clase=='Manejador')
		echo Manejador();
	else
		echo "SecurityFalse";
}
else{
require_once "procesos.php"; $ini_u = $_SESSION["ini_u"]; 
$cadena=$_POST['d'];
$valor=explode("=@",$cadena);
$clase=$valor[0];
switch($clase)
{
	case TraerModulo:
		echo traerModulo(acceso($acceso,sql(consulta("modulo_perfil","codigoperfil",$valor[1],'ORDER BY codigomodulo'))),"codigomodulo");
		break;
	case TraerModulo1:
		echo traerModulo(acceso($acceso,sql(consulta("modulo_perfil","codigomodulo",$valor[1],'ORDER BY codigoperfil'))),"codigoperfil");
		break;
	case Manejador:
		echo Manejador();
		break;
	case ObjetoFormulario:
		echo ObjetoForm($valor);
		break;
	case CargaObjeto:
		echo CargaObjeto($valor);
		break;
	case CargaRegistro:
		echo CargaRegistro($valor,acceso($acceso,sql($valor[1])));
		break;
	case Limpieza:
		echo Limpieza();
		break;
	case LimpiezaModulo:
		echo  LimpiezaModulo();
		break;
	case camposRep2:
		echo  camposRep2($acceso,$valor);
		break;
	case validarSQL:
		echo  validarSQL($acceso,$valor[1]);
		break;
	case cargarZona:
		echo  cargarZona($acceso,$valor[1]);
		break;
	case cargarZona_franq:
		echo  cargarZona_franq($acceso,$valor[1]);
		break;
	case bcargarZona_franq:
		echo  cargarZona_franq($acceso,$valor[1]);
		break;
	case traerFranq:
		echo  traerFranq($acceso,$valor[1]);
		break;
	case traerFranqSer:
		echo  traerFranqSer($acceso,$valor[1]);
		break;
	case cargarSector:
		echo  cargarSector($acceso,$valor[1]);
		break;
	case bcargarSector:
		echo  cargarSector($acceso,$valor[1]);
		break;
	case cargarSectorEst:
		echo  cargarSectorEst($acceso,$valor[1]);
		break;
	case cargarCalle:
		echo  cargarCalle($acceso,$valor[1]);
		break;
	case bcargarCalle:
		echo  cargarCalle($acceso,$valor[1]);
		break;
	case cargarUrb:
		echo  cargarUrb($acceso,$valor[1]);
		break;
	case cargarEdif:
		echo  cargarEdif($acceso,$valor[1]);
		break;
	case traerZona:
		echo  traerZona($acceso,$valor[1]);
		break;
	case cargarTipoSer:
		echo  cargarTipoSer($acceso,$valor[1]);
		break;
	case traerSector:
		echo  traerSector($acceso,$valor[1]);
		break;
	case traerSectorUrb:
		echo  traerSectorUrb($acceso,$valor[1]);
		break;
	case traerCalle:
		echo  traerCalle($acceso,$valor[1]);
		break;
	case traerTipoSer:
		echo  traerTipoSer($acceso,$valor[1]);
		break;
	case cargarServicio:
		echo  cargarServicio($acceso,$valor[1]);
		break;
	case cargarServicioMensual:
		echo  cargarServicioMensual($acceso,$valor[1]);
		break;
	case cargar_servicio_tv:
		echo  cargar_servicio_tv($acceso,$valor[1]);
		break;
	case tCodContSer:
		$acceso->objeto->ejecutarSql("select id_cont_serv from contrato_servicio  where (id_cont_serv ILIKE '$ini_u%')  ORDER BY id_cont_serv desc LIMIT 1 offset 0 "); 
		echo "=@$ini_u".verCodLong($acceso,"id_cont_serv");
		break;
	case calcularMontoPago:
		echo  calcularMontoPago($acceso,$valor);
		break;
	case montoCierrePunto:
		echo  montoCierrePunto($acceso,$valor[1]);
		break;
	case traerTO:
		echo traerTO($acceso,$valor[1]);
		break;
	case traerTOStatus:
		echo traerTOStatus($acceso,$valor[1]);
		break;
	case cargarDOF:
		echo  cargarDO($acceso,$valor[1]);
		break;
	case cargarDO:
		echo  cargarDO($acceso,$valor[1]);
		break;
	case cargarDO1:
		echo  cargarDO1($acceso,$valor[1]);
		break;
	case cargarDOE:
		echo  cargarDOE($acceso,$valor[1]);
		break;
	case ActualizarCampo:
		echo  ActualizarCampo($acceso,$valor);
		break;
	case negar_nota_cd:
		echo  negar_nota_cd($acceso,$valor[1]);
		break;
	case confirmar_nota_cd:
		echo  confirmar_nota_cd($acceso,$valor[1]);
		break;
	case ActualizarDeudaDC:
		echo  ActualizarDeudaDC($acceso,$valor[1],$valor[2],$valor[3],$valor[4],$valor[5],$valor[6]);
		break;
	case traerMensualidad:
		echo  traerMensualidad($acceso,$valor[1]);
		break;
	case agregar_mes:
		require_once "Clases/trans_pago.php";
		$obj_trans=new trans_pago();
		$obj_trans->begin($acceso);
		echo  agregar_mes($acceso,$valor[1]);
		$obj_trans->commit($acceso);
		break;
	case agregar_cd:
		echo  agregar_cd($acceso,$valor[1]);
		break;
	case agregar_punto:
		echo  agregar_punto($acceso,$valor[1]);
		break;
	case verificaOrden:
		echo  verificaOrden($acceso,$valor[1]);
		break;
	case filtrarcontrato:
		echo  filtrarcontrato($acceso,$valor[1]);
		break;
	case buscar_orden_final:
		echo  buscar_orden_final($acceso,$valor[1]);
		break;
	case trae_tec_gru:
		echo  trae_tec_gru($acceso,$valor[1]);
		break;
	case trae_tec_gru_disable:
		echo  trae_tec_gru_disable($acceso);
		break;
	case trae_tec_gru_disable_existe:
		echo  trae_tec_gru_disable_existe($acceso,$valor[1]);
		break;
	case trae_ubi_gru_disable:
		echo  trae_ubi_gru_disable($acceso,$valor[1]);
		break;
	case trae_ubi_gru_disable_existe:
		echo  trae_ubi_gru_disable_existe($acceso,$valor[1],$valor[2]);
		break;
	case valida_numero_ref:
		echo  valida_numero_ref($acceso,$valor[1],$valor[2],$valor[3]);
		break;
	case trae_ubi_gru:
		echo  trae_ubi_gru($acceso,$valor[1],$valor[2]);
		break;
	case trae_info_grupo:
		echo  trae_info_grupo($acceso,$valor[1]);
		break;
	case asig_falla_rep:
		echo  asig_falla_rep($acceso,$valor[1],$valor[2],$valor[3],$valor[4]);
		break;
	case rec_falla_rep:
		echo  rec_falla_rep($acceso,$valor[1],$valor[2],$valor[3],$valor[4]);
		break;
	case traeinfoFact:
		echo  traeinfoFact($acceso,$valor[1]);
		break;
	case traercs:
		echo  traercs($acceso,$valor[1]);
		break;
	case verificaSMS:
		echo  verificaSMS($acceso);
		break;
	case buscardf:
		echo  buscardf($acceso,$valor[1]);
		break;
	case buscardfID:
		echo  buscardfID($acceso,$valor[1]);
		break;
	case buscar_anular_df:
		echo  buscardf($acceso,$valor[1]);
	case c_id_contrato:
		echo  c_id_contrato($acceso,$valor[1]);
	case c_nro_contrato:
		echo  c_nro_contrato($acceso,$valor[1]);
	case c_cedula:
		echo  c_cedula($acceso,$valor[1]);
	case c_id_pago:
		echo  c_id_pago($acceso,$valor[1]);
	case c_nro_factura:
		echo  c_nro_factura($acceso,$valor[1]);
		break;
	case c_nro_factura_nc:
		echo  c_nro_factura_nc($acceso,$valor[1]); 
		break;
	case c_nro_factura_nd:
		echo  c_nro_factura_nd($acceso,$valor[1]); 
		break;
	case traeinfoFactura_nc:
		echo  traeinfoFactura_nc($acceso,$valor[1]);
		break;
	case c_nro_factura_reimp:
		echo  c_nro_factura_reimp($acceso,$valor[1]);
		break;
	case c_nro_control:
		echo  c_nro_control($acceso,$valor[1]);
		break;
	case anular_control:
		echo  anular_control($acceso,$valor[1]);
		break;
	case cargar_gru_dep:
		echo  cargar_gru_dep($acceso,$valor[1]);
		break;
	case traerContrato_ser:
		$acceso1=conexion();
		traerContrato_ser($acceso,$acceso1);
		break;
	case cambiarIdioma:
		echo  cambiarIdioma($acceso,$valor[1],$valor[2],$valor[3]);
		break;
	case verifica_cedula:
		echo  verifica_cedula($acceso,$valor[1]);
		break;
	case verifica_cedula1:
		echo  verifica_cedula($acceso,$valor[1]);
		break;
	case buscar_contr_act:
		echo  buscar_contr_act($acceso,$valor[1]);
		break;
	case traer_tipo_pago:
		echo  traer_tipo_pago($acceso,$valor[1]);
		break;
	case incluirFrac:
		echo  incluirFrac($acceso,$valor[1],$valor[2],$valor[3]);
		break;
	case incluirDesc:
		echo  incluirDesc($acceso,$valor[1],$valor[2],$valor[3]);
		break;
	
	case cargar_estado:
		echo  cargar_estado($acceso,$valor[1]);
		break;
	
	case cargar_detalle_resp:
		echo  cargar_detalle_resp($acceso,$valor[1]);
		break;
	case cargar_municipio:
		echo  cargar_municipio($acceso,$valor[1]);
		break;
	case cargar_ciudad:
		echo  cargar_ciudad($acceso,$valor[1]);
		break;
	
	case traer_pais:
		echo  traer_pais($acceso,$valor[1]);
		break;
	case traer_estado:
		echo  traer_estado($acceso,$valor[1]);
		break;
	case traer_tipo_resp:
		echo  traer_tipo_resp($acceso,$valor[1]);
		break;
	case traer_municipio:
		echo  traer_municipio($acceso,$valor[1]);
		break;
	case traer_ciudad:
		echo  traer_ciudad($acceso,$valor[1]);
		break;
	case traer_equipo_fiscal:
		echo  traer_equipo_fiscal($acceso,$valor[1]);
		break;
	case traer_costo_servicio:
		echo  traer_costo_servicio($acceso,$valor[1]);
		break;
	case traerIDpago:
		echo  traerIDpago($acceso,$valor[1]);
		break;
	case verifica_multiple_cont:
		echo verifica_multiple_cont($acceso,$valor[1]);
		break;
	case valida_etiqueta:
		echo valida_etiqueta($acceso,$valor[1]);
		break;
	case valida_etiqueta_n:
		echo valida_etiqueta_n($acceso,$valor[1]);
		break;
	case cambiar_grupo_trabajo:
		echo cambiar_grupo_trabajo($acceso,$valor[1],$valor[2]);
		break;
	case asignar_promo_serv:
		echo asignar_promo_serv($acceso,$valor[1]);
		break;
	case calculafechapromo:
		echo calculafechapromo($acceso,$valor[1],$valor[2]);
		break;
	case calculafechapromocion:
		echo calculafechapromocion($acceso,$valor[1],$valor[2]);
		break;
	case anular_factura:
		echo anular_factura($acceso,$valor[1],$valor[2],$valor[3],$valor[4],$valor[5]);
		break;
	case valida_fact:
		//echo "entrdfdo";
		echo valida_fact($acceso,$valor[1],$valor[2],$valor[3],$valor[4]);
		break;
	case valida_nro_control:
		echo valida_nro_control($acceso,$valor[1],$valor[2]);
		break;
	case valida_num_ref:
		echo valida_num_ref($acceso,$valor[1],$valor[2]);
		break;
	case validarcontrato_control:
		echo validarcontrato_control($acceso,$valor[1],$valor[2]);
		break;
	case traer_numero_contrato:
		echo traer_numero_contrato($acceso,$valor[1]);
		break;
	case traer_numero_abonado:
		echo traer_numero_abonado($acceso,$valor[1]);
		break;
	case traer_datos_abonado:
		echo traer_datos_abonado($acceso,$valor[1]);
		break;
	case valida_fact_c:
		echo valida_fact_c($acceso,$valor[1],$valor[2],$valor[3]);
		break;
	case habilitar_cierre_caja:
		//ECHO "update parametros set valor_param='1' where id_param='35'";
			require_once "Clases/trans_pago.php";
		$obj_trans=new trans_pago();
		$obj_trans->begin($acceso);
	
		$acceso->objeto->ejecutarSql("update parametros set valor_param='1' where id_param='35'");
		$obj_trans->commit($acceso);	
		break;
	case desabilitar_cierre_caja:
			require_once "Clases/trans_pago.php";
		$obj_trans=new trans_pago();
		$obj_trans->begin($acceso);
		$acceso->objeto->ejecutarSql("update parametros set valor_param='0' where id_param='35'");
		$obj_trans->commit($acceso);	
		break;
	case eliminar_proceso_corte:
		echo eliminar_proceso_corte($acceso,$valor[1]);
		break;
	case confirmarpagodeposito:
		echo confirmarpagodeposito($acceso,$valor[1]);
		break;
	case confirmarpagodeposito_mod:
		echo confirmarpagodeposito_mod($acceso,$valor[1],$valor[2],$valor[3]);
		break;
	case modificar_poste_cont:
		echo modificar_poste_cont($acceso,$valor[1],$valor[2],$valor[3]);
		break;
	case imprimir_factura_i:
		echo imprimir_factura_i($acceso,$valor[1],$valor[2],$valor[3],$valor[4]);
		break;
	case negarpagodeposito:
		echo negarpagodeposito($acceso,$valor[1]);
		break;
	case traer_infor_orden:
		echo traer_infor_orden($acceso,$valor[1]);
		break;
	case traeinfo_forma_pago:
		echo traeinfo_forma_pago($acceso,$valor[1]);
		break;
	case verServiciosCheck:
		echo verServiciosCheck($acceso,$valor[1]);
		break;
	case cargar_cob_ven:
		echo  cargar_cob_ven($acceso,$valor[1]);
		break;
	case traer_datos_pago:
		echo  traer_datos_pago($acceso,$valor[1]);
		break;
		
	case traer_serv_acc:
		echo  traer_serv_acc($acceso,$valor[1]);
		break;
	case traer_serv_franq:
		echo  traer_serv_franq($acceso,$valor[1]);
		break;
	case traer_serv_acc_susc:
		echo  traer_serv_acc_susc($acceso,$valor[1]);
		break;
		
	case refrescar_deco:
		echo  refrescar_deco($acceso,$valor[1]);
		break;
	case buscar_deco:
		echo buscar_deco($acceso,$valor[1]);
		break;
	case cargar_marca:
		echo cargar_marca($acceso,$valor[1]);
		break;
	case cargar_modelo:
		echo cargar_modelo($acceso,$valor[1]);
		break;
	case cargar_modelo_m:
		echo cargar_modelo_m($acceso,$valor[1]);
		break;
	case traer_sistema_marca:
		echo traer_sistema_marca($acceso,$valor[1]);
		break;
	case identificar_pago_cli:
		echo  identificar_pago_cli($acceso);
		break;
	case conciliar_pago_cli:
		echo  conciliar_pago_cli($acceso);
		echo "CONCILIACION COMPLETADA CON EXITO";
		break;
	case conciliar_pago_franq:
		echo  conciliar_pago_franq($acceso);
		echo "CONCILIACION COMPLETADA CON EXITO";
		break;
	case autorizar_abrir_caja:
		echo  autorizar_abrir_caja($acceso,$valor[1]);
		
	case cargar_todos_pagos_pend:
		echo  cargar_todos_pagos_pend($acceso);
		
		break;
	default:
		echo titulo("El contenido de ".$clase." no está construídodo, Disculpe las molestias");
}
}


function refrescar_deco($acceso,$id_contrato){
	session_start();		
		$ini_u = $_SESSION["ini_u"];
		echo "select id_da,codigo_da,servicio from deco_ana where id_contrato='$id_contrato' and status_da='I'";
				$dato=lectura($acceso,"select id_da,codigo_da,servicio from deco_ana where id_contrato='$id_contrato' and status_da='I'");
				require_once "Clases/interfazacc.php";
				
					for($i=0;$i<count($dato);$i++){
					$id_da=trim($dato[$i]['id_da']);
					$codigo_da=trim($dato[$i]['codigo_da']);
					$acceso->objeto->ejecutarSql("select *from interfazacc  where (id_accquery ILIKE '$ini_u%') ORDER BY id_accquery desc"); 
					$id_accquery = $ini_u.verCo($acceso,"id_accquery");
					
					$obj=new interfazacc($id_accquery,$codigo_da,'ACTIVAR','FALSE','','');
					$obj->incluirinterfazacc($acceso);
					$obj=new interfazacc($id_accquery,$codigo_da,'SERVICIOS','FALSE','','');
					$obj->incluirinterfazacc($acceso);
				}
}

function buscar_deco($acceso,$codigo_da){
//	echo "select id_contrato,status_da from deco_ana where deco_ana='$deco_ana'";
	$acceso->objeto->ejecutarSql("select id_contrato,status_da from deco_ana where codigo_da='$codigo_da'");
	if($row=row($acceso)){
		$id_contrato=trim($row['id_contrato']);
		$status_da=trim($row['status_da']);
		if($status_da!=''){
			echo "EXISTE";
			return;
		}
		if($id_contrato!=''){
			$acceso->objeto->ejecutarSql("select nro_contrato, nombre, apellido from vista_contrato where id_contrato='$id_contrato'");
			if($row=row($acceso)){
				$nro_contrato=trim($row['nro_contrato']);
				$cliente=trim($row['nombre'])." ".trim($row['apellido']);
				echo ": $nro_contrato,  Cliente: $cliente";
			}
			else{
				echo "EXISTE";
			}
		}
		else{
			echo "EXISTE";
		}
	}
}

function traer_serv_acc_susc($acceso,$id_contrato){
	$acceso->objeto->ejecutarSql("select codigo_serv_sist from serv_sist_paq,servicios_sistema, contrato_servicio where serv_sist_paq.id_serv_sist=servicios_sistema.id_serv_sist and serv_sist_paq.id_serv=contrato_servicio.id_serv and id_contrato='$id_contrato' group by codigo_serv_sist");
		while($row=row($acceso)){
			$codigo_serv_sist=trim($row['codigo_serv_sist']);
			echo  "=@$codigo_serv_sist";
		}
}


function imprimir_factura_i($acceso,$id_pago,$id_caja_cob,$nro_factura,$nro_control){
	$fecha_pago=date("Y-m-d");
	/*
	$acceso->objeto->ejecutarSql("select id_pago,inc from pagos,caja_cobrador where  pagos.id_caja_cob=caja_cobrador.id_caja_cob   and impresion='SI' ORDER BY inc desc LIMIT 1 offset 0");
	$row=row($acceso);
	$inc=trim($row['inc'])+0;
	$id_pago_viejo=trim($row['id_pago']);
	
	$acceso->objeto->ejecutarSql("select inc from pagos where  id_pago='$id_pago' ");
	$row=row($acceso);
	$inc_ult=trim($row['inc'])+0;
	echo ":$inc_ult:$inc:";
	if($inc_ult>$inc){
		$acceso->objeto->ejecutarSql("Update pagos Set  inc='$inc_ult' where id_pago='$id_pago_viejo'; ");
		$acceso->objeto->ejecutarSql("Update pagos Set  inc='$inc' where id_pago='$id_pago'; ");
	}
	
	*/
	$acceso->objeto->ejecutarSql("Update pagos Set  impresion='SI', nro_factura='$nro_factura', nro_control='$nro_control' where id_pago='$id_pago' ");
}
function confirmarpagodeposito_mod($acceso,$id_pd,$numero_ref,$monto_dep){
	session_start();
	$login_conf = $_SESSION["login"];
	$fecha_conf=date("Y-m-d");
	$hora_conf=date("H:i:s");
	//echo "Update pagodeposito Set  numero_ref='$numero_ref', monto_dep='$monto_dep', fecha_conf='$fecha_conf', hora_conf='$hora_conf', login_conf='$login_conf', status_pd='CONFIRMADO' Where id_pd='$id_pd'";
	
			require_once "Clases/trans_pago.php";
		$obj_trans=new trans_pago();
		$obj_trans->begin($acceso);
	$acceso->objeto->ejecutarSql("Update pagodeposito Set  numero_ref='$numero_ref', monto_dep='$monto_dep', fecha_conf='$fecha_conf', hora_conf='$hora_conf', login_conf='$login_conf', status_pd='CONFIRMADO' Where id_pd='$id_pd'");
	$obj_trans->commit($acceso);
}
function confirmarpagodeposito($acceso,$id_pd){
	session_start();
	$login_conf = $_SESSION["login"];
	$fecha_conf=date("Y-m-d");
	$hora_conf=date("H:i:s");
		require_once "Clases/trans_pago.php";
		$obj_trans=new trans_pago();
		$obj_trans->begin($acceso);
	$acceso->objeto->ejecutarSql("Update pagodeposito Set  fecha_conf='$fecha_conf', hora_conf='$hora_conf', login_conf='$login_conf', status_pd='CONFIRMADO' Where id_pd='$id_pd'");
	$obj_trans->commit($acceso);
}
function negarpagodeposito($acceso,$id_pd){
	session_start();
	$login_conf = $_SESSION["login"];
	$fecha_conf=date("Y-m-d");
	$hora_conf=date("H:i:s");
	require_once "Clases/trans_pago.php";
		$obj_trans=new trans_pago();
		$obj_trans->begin($acceso);
	$acceso->objeto->ejecutarSql("Update pagodeposito Set  fecha_conf='$fecha_conf', hora_conf='$hora_conf', login_conf='$login_conf', status_pd='NEGADO' Where id_pd='$id_pd'");
	
	$obj_trans->commit($acceso);
	
}
function valida_numero_ref($acceso,$id_tipo_pago,$banco,$numero){
	$acceso1=conexion();
	$cad="";
	$acceso1->objeto->ejecutarSql("select id_pago,monto_tp from detalle_tipopago where id_tipo_pago='$id_tipo_pago' and banco='$banco' and numero='$numero'");
		while($row=row($acceso1)){
			$id_pago=trim($row['id_pago']);
			$monto_tp=trim($row['monto_tp']);
			$acceso->objeto->ejecutarSql("select fecha_pago,nro_factura, monto_pago,nro_contrato,nombrecli,apellidocli from vista_pago_cont where id_pago='$id_pago'");
			if($row=row($acceso)){
				$fecha_pago=formatofecha(trim($row['fecha_pago']));
				$nro_factura=trim($row['nro_factura']);
				$monto_pago=trim($row['monto_pago']);
				$nro_contrato=trim($row['nro_contrato']);
				$cliente=trim($row['nombrecli'])." ".trim($row['apellidocli']);
				$cad=$cad. "AVISO ESTOS DATOS YA ESTAN REGISTRADOS COMO FACTURA\n
Nro Abonado: $nro_contrato
Cliente: $cliente
Nro Factura: $nro_factura
fecha: $fecha_pago
Monto Pago: $monto_pago
Monto Forma Pago: $monto_tp\n
				";
			}
		}
		return $cad;
}
function valida_nro_control($acceso,$nro_recibo,$id_persona){
	//ECHO "select *from recibos where nro_recibo='$nro_recibo' and status_pago='RECIBIDO'";
	
	$acceso->objeto->ejecutarSql("select *from vista_recibos where id_persona='$id_persona' and nro_recibo='$nro_recibo' and status_pago='RECIBIDO' and tipo='FACTURA' ");
		if($row=row($acceso)){
			return "";
		}else{
			return "EXITE";
		}
}
function traeinfo_forma_pago($acceso,$id_pago){
	$acceso->objeto->ejecutarSql("select *from detalle_tipopago where id_pago='$id_pago'  order By id_tipo_pago");
		while($row=row($acceso)){
			$id_tipo_pago=trim($row['id_tipo_pago']);
			$banco=trim($row['banco']);
			$numero=trim($row['numero']);
			$monto_tp=trim($row['monto_tp']);
			echo "-Class-$id_tipo_pago=@$banco=@$numero=@$monto_tp=@";
		}
}
function traer_datos_pago($acceso,$id_pago){
	$id_pago=trim($id_pago);
	$acceso->objeto->ejecutarSql("select *from vista_pago_cont where id_pago='$id_pago'");
		if($row=row($acceso)){
			$nro_contrato=trim($row['nro_contrato']);
			$fecha_pago=trim($row['fecha_pago']);
			$cedulacli=trim($row['cedulacli']);
			$nombrecli=trim($row['nombrecli'])." ".trim($row['apellidocli']);
			$id_caja_cob=trim($row['id_caja_cob']);
			$monto_pago=trim($row['monto_pago']);
			echo "=@$nro_contrato=@$cedulacli=@$nombrecli=@$id_caja_cob=@$monto_pago=@$id_pago=@";
		}
		/*
		$acceso->objeto->ejecutarSql("select count(*) as cant from pagos,vista_caja where pagos.id_caja_cob=vista_caja.id_caja_cob and fecha_pago<'$fecha' and impresion='NO' and status_pago='PAGADO' and tipo_caja='PRINCIPAL'");
		if($row=row($acceso)){
			$cant=trim($row['cant'])+0;
			echo "$cant=@";
		}
		*/ 
		echo "0=@";
}
function valida_num_ref($acceso,$numero,$banco){
	if(strtoupper($numero)=='NO' && $banco=='PROVINCIAL'){
		
	}else{
		$acceso->objeto->ejecutarSql("select id_pago from detalle_tipopago where banco='$banco' and numero='$numero'");
		if($row=row($acceso)){
			$id_pago=trim($row['id_pago']);
			//ECHO "select nro_factura, fecha_pago, nombrecli, apellidocli from vista_pago_cont where banco='$banco' and numero='$numero'";
			$acceso->objeto->ejecutarSql("select nro_factura, fecha_pago, nombrecli, apellidocli from vista_pago_cont where id_pago='$id_pago'");
			if($row=row($acceso)){
				$nro_factura=trim($row['nro_factura']);
				$cliente=trim($row['nombrecli'])." ".trim($row['apellidocli']);
				$fecha_pago=formatofecha(trim($row['fecha_pago']));
				return "DATOS PROCESADOS\nNro Factura: $nro_factura\nFecha: $fecha_pago\nCliente: $cliente";
			}
		}
		$acceso->objeto->ejecutarSql("select status_pd,nombre,apellido,fecha_reg from vista_pagodeposito where banco='$banco' and numero_ref='$numero'");
		if($row=row($acceso)){
				$status_pd=trim($row['status_pd']);
				$cliente=trim($row['nombre'])." ".trim($row['apellido']);
				$fecha_reg=formatofecha(trim($row['fecha_reg']));
				return "DATOS $status_pd \n Fecha: $fecha_reg\nCliente: $cliente";
		}
	}
	return "";
}

function traer_datos_abonado($acceso,$id_contrato){
		
	$acceso->objeto->ejecutarSql("select cedula,nombre,apellido,telefono,inicial_doc,nro_contrato,status_contrato from vista_contrato_auditoria where id_contrato='$id_contrato'");
		if($row=row($acceso)){
			$cedula=trim($row['inicial_doc']).trim($row['cedula']);
			$telefono=trim($row['telefono']);
			$nro_contrato=trim($row['nro_contrato']);
			$cliente=trim($row['nombre'])." ".trim($row['apellido']);
			$status_contrato=trim($row['status_contrato']);
		}
	
}
function traer_infor_orden($acceso,$id_contrato){
		
	$acceso->objeto->ejecutarSql("select postel,pto from contrato where id_contrato='$id_contrato'");
		if($row=row($acceso)){
			$postel=trim($row['postel']);
			$pto=trim($row['pto']);
		}
	return "=@$postel=@$pto=@";
}
function modificar_poste_cont($acceso,$id_contrato,$postel,$pto){
	require_once "Clases/trans_pago.php";
		$obj_trans=new trans_pago();
		$obj_trans->begin($acceso);
	$acceso->objeto->ejecutarSql("update contrato set postel='$postel' , pto='$pto' where id_contrato='$id_contrato'");
	$obj_trans->commit($acceso);
}
function eliminar_proceso_corte($acceso,$id_proc){
	$acceso1=conexion();
	$acceso2=conexion();
	$acceso1->objeto->ejecutarSql("select * from abo_cortados where id_proc='$id_proc'");
	require_once "Clases/trans_pago.php";
		$obj_trans=new trans_pago();
		$obj_trans->begin($acceso);
	while($row=row($acceso1)){
		$id_abo_c=trim($row['id_abo_c']);
		$id_contrato=trim($row['id_contrato']);
		$id_orden=trim($row['id_orden']);
				$acceso->objeto->ejecutarSql("delete from abo_cortados where id_abo_c='$id_abo_c' ");
				$acceso->objeto->ejecutarSql("delete from orden_grupo where id_orden='$id_orden'");
				$acceso->objeto->ejecutarSql("delete from ordenes_tecnicos where id_orden='$id_orden'");
				$acceso->objeto->ejecutarSql("update contrato set status_contrato='ACTIVO' where id_contrato='$id_contrato' ");
	//	}
	}
	$acceso->objeto->ejecutarSql("delete from proceso_corte where id_proc='$id_proc' ");
	$obj_trans->commit($acceso);
}
function valida_fact($acceso,$desde,$hasta,$cantidad,$serie){
	
$acceso->objeto->ejecutarSql("select *from parametros where id_param='54' and id_franq='1'");
$row=row($acceso);
$dig_recibo_G=trim($row['valor_param']);


	$cad='';
	//echo "entro:$desde,$hasta,$cantidad:";
	$nro_factura=$serie.$desde;
	$cantidad=$cantidad+0;
	for($i=0;$i<$cantidad;$i++){
		//echo "select *from recibos where nro_recibo='$nro_factura' and tipo='FACTURA';";
		$acceso->objeto->ejecutarSql("select *from recibos where nro_recibo='$nro_factura' and tipo='FACTURA'");
		if($row=row($acceso)){
			$cad=$cad."$nro_factura; ";
		}
		$nro_factura=$serie.verNumero_recibo_v4($acceso,$nro_factura,$dig_recibo_G);
	}
		return "=@".$cad;
	
}
function cambiar_grupo_trabajo($acceso,$id_orden,$id_gt){
//echo "Update orden_grupo Set id_gt='$id_gt'  Where id_orden='$id_orden'";
require_once "Clases/trans_pago.php";
		$obj_trans=new trans_pago();
		$obj_trans->begin($acceso);
	$acceso->objeto->ejecutarSql("Update orden_grupo Set id_gt='$id_gt'  Where id_orden='$id_orden'");
	$obj_trans->commit($acceso);
	/*
	require_once "Clases/orden_grupo.php";
			$obj=new orden_grupo($id_orden,$id_gt,"f");
			$obj->modif_orden_grupo_aut($acceso);
			*/
}
function calculafechapromocion($acceso,$mes_promo,$inicio_promo){
	$inicio_promo=formatfecha($inicio_promo);
	$meses=array('Jan'=>'01','Feb'=>'02','Mar'=>'03','Apr'=>'04','May'=>'05','Jun'=>'06','Jul'=>'07','Aug'=>'08','Sep'=>'09','Oct'=>'10','Nov'=>'11','Dec'=>'12');

	//list($ano,$mes,$dia)=explode("-",$inicio_promo);
	
	//$inicio_promo="$anio-$mes-$dia";
	$fin_promo=sumames_cant($inicio_promo,$mes_promo);
	return "=@$fin_promo";	
}
function calculafechapromo($acceso,$id_promo,$inicio_promo){
	
$meses=array('Jan'=>'01','Feb'=>'02','Mar'=>'03','Apr'=>'04','May'=>'05','Jun'=>'06','Jul'=>'07','Aug'=>'08','Sep'=>'09','Oct'=>'10','Nov'=>'11','Dec'=>'12');

	$ini=explode(" ",$inicio_promo);
	$mes=$meses[$ini[1]];
	$dia=$ini[2];
	$anio=$ini[3];
	$hora_ini=substr($ini[4],0,5);
	$inicio_promo="$anio-$mes-$dia";
	//echo "select inicio_promo,fin_promo,mes_promo from promocion where id_promo='$id_promo' and  inicio_promo<='$inicio_promo' and fin_promo>='$inicio_promo' ";
	$acceso->objeto->ejecutarSql("select inicio_promo,fin_promo,mes_promo from promocion where id_promo='$id_promo' and  inicio_promo<='$inicio_promo' and fin_promo>='$inicio_promo' ");
	$cad='';
	if($row=row($acceso)){
		$mes_promo = trim($row["mes_promo"]);
		$fin_promo=sumames_cant($inicio_promo,$mes_promo);
		return "=@$fin_promo";
	}
	else{
		return;
	}
	
}
function asignar_promo_serv($acceso,$id_promo){
	
	//echo "select *from ordenes_tecnicos where id_contrato='$id_contrato' and status_orden='CREADO'";
	$acceso->objeto->ejecutarSql("select id_serv from promo_serv where id_promo='$id_promo'");
	$cad='';
	while($row=row($acceso)){
		$cad = $cad."=@".trim($row["id_serv"]);
	}
	return $cad;
}
function valida_etiqueta($acceso,$etiqueta){
	$acceso->objeto->ejecutarSql("select nro_contrato, nombre, apellido from vista_contrato where etiqueta='$etiqueta'");
	if($row=row($acceso)){
		$nro_contrato=trim($row['nro_contrato']);
		$cliente=trim($row['nombre'])." ".trim($row['apellido']);
		echo ": $nro_contrato,  Cliente: $cliente";
	}
}
function valida_etiqueta_n($acceso,$etiqueta_n){
	$acceso->objeto->ejecutarSql("select nro_contrato, nombre, apellido from vista_contrato where etiqueta_n='$etiqueta_n'");
	if($row=row($acceso)){
		$nro_contrato=trim($row['nro_contrato']);
		$cliente=trim($row['nombre'])." ".trim($row['apellido']);
		echo ": $nro_contrato,  Cliente: $cliente";
	}
}
function verifica_multiple_cont($acceso,$cedula){
	$acceso->objeto->ejecutarSql("select *from vista_contrato where cedula='$cedula'");
	if($acceso->objeto->registros>1){
			return "multiple";
	}
}
function traerIDpago($acceso,$id_caja_cob){
	session_start();
	//$ip_est = $_SERVER['REMOTE_ADDR'];
	 $ini_u = $_SESSION["ini_u"]; 
	
	$acceso->objeto->ejecutarSql("select id_est from caja_cobrador where id_caja_cob='$id_caja_cob'");
	if($row=row($acceso)){
		$id_est=trim($row['id_est']);
	}
	//echo "select id_pago from pagos where (id_pago ILIKE '$ini_u%') ORDER BY id_pago desc LIMIT 1 offset 0 ";
	$acceso->objeto->ejecutarSql("select id_pago from pagos where (id_pago ILIKE '$ini_u%') ORDER BY id_pago desc LIMIT 1 offset 0 "); 
	$id_pago = $ini_u.verCodLargo($acceso,"id_pago");
	
	$acceso->objeto->ejecutarSql("select nro_factura,inc from pagos,caja_cobrador where  id_est='$id_est' and pagos.id_caja_cob=caja_cobrador.id_caja_cob ORDER BY inc desc LIMIT 1 offset 0 "); 
	$nro_factura = verCodFact($acceso,"nro_factura");

//	echo "select nro_control from pagos where  id_caja_cob='$id_caja_cob' ORDER BY inc desc LIMIT 1 offset 0 ";
	$acceso->objeto->ejecutarSql("select nro_control,inc from pagos where  id_caja_cob='$id_caja_cob' ORDER BY inc desc LIMIT 1 offset 0 "); 
	$nro_control = verCodControl($acceso,"nro_control");
//	echo ":$nro_control:";
/*
	$acceso->objeto->ejecutarSql("select nro_factura from pagos where nro_factura='$nro_factura'"); 
	if($acceso->objeto->registros>0){
		$nro_factura = '';
	}
*/
	$acceso->objeto->ejecutarSql("select nro_control from pagos where nro_control='$nro_control'"); 
	if($acceso->objeto->registros>0){
		$nro_control = '';
	}
	
	return "=@$id_pago=@$nro_factura=@$nro_control";
}
function incluirFrac($acceso,$id_cont_serv,$m1,$m2){

		require_once "Clases/trans_pago.php";
		$obj_trans=new trans_pago();
		$obj_trans->begin($acceso);
		
	 $ini_u = $_SESSION["ini_u"]; 
//	echo ":$ini_u:";
	$acceso->objeto->ejecutarSql("Update contrato_servicio_deuda Set costo_cobro='$m2' where id_cont_serv='$id_cont_serv'");
	
$acceso->objeto->ejecutarSql("select * from contrato_servicio_deuda where id_cont_serv='$id_cont_serv'");
	

	$cad='';
	if($row=row($acceso)){
		$id_serv = trim($row["id_serv"]);
		$id_contrato = trim($row["id_contrato"]);
		$fecha_inst = trim($row["fecha_inst"]);
		$cant_serv = trim($row["cant_serv"]);
		$status_con_ser = trim($row["status_con_ser"]);
		$costo_cobro = trim($row["costo_cobro"]);
	}
	$acceso->objeto->ejecutarSql("select id_cont_serv from contrato_servicio_deuda  where (id_cont_serv ILIKE '$ini_u%')  ORDER BY id_cont_serv desc LIMIT 1 offset 0 "); 
	$id_cont_serv=verCodLongD($acceso,"id_cont_serv",$ini_u);

	$acceso->objeto->ejecutarSql("insert into contrato_servicio_deuda(id_cont_serv,id_serv,id_contrato,fecha_inst,cant_serv,status_con_ser,costo_cobro,descu,modo_des) values ('$id_cont_serv','$id_serv','$id_contrato','$fecha_inst','$cant_serv','Deuda','$m1','0','AUTOMATICO')");
	
		$obj_trans->commit($acceso);			
}
function incluirDesc($acceso,$id_cont_serv,$m1,$m2){
	require_once "Clases/trans_pago.php";
		$obj_trans=new trans_pago();
		$obj_trans->begin($acceso);
		
	$acceso->objeto->ejecutarSql("Update contrato_servicio_deuda Set descu='$m1',modo_des='MANUAL' where id_cont_serv='$id_cont_serv'");
	$obj_trans->commit($acceso);	
}
function buscar_contr_act($acceso,$nro_contrato){
	$acceso->objeto->ejecutarSql("select id_contrato from contrato where nro_contrato='$nro_contrato'");
	$cad='';
	if($row=row($acceso)){
		return "existe=@".trim($row["id_contrato"]);
	}
	return "";
}
function cambiarIdioma($acceso,$idioma,$pais,$moneda){
	$valor=explode("=",$idioma);
	$carpeta_idioma=$valor[0];
	$nombre_idioma=$valor[1];
	
	copy("idiomas/config.php","copia");
	$fp = fopen("copia","r");
	$id = fopen("idiomas/config.php","w+");
	while ($linea= fgets($fp))
	{
		if(strstr($linea,'$carpeta_idioma=')){
			fwrite($id,'    $carpeta_idioma=\''.$carpeta_idioma.'\';
');
		}
		else if(strstr($linea,'$nombre_idioma=')){
			fwrite($id,'    $nombre_idioma=\''.$nombre_idioma.'\';
');
		}
		else if(strstr($linea,'$moneda=')){
			fwrite($id,'    $moneda=\''.$moneda.'\';
');
		}
		else if(strstr($linea,'$pais=')){
			fwrite($id,'    $pais=\''.$pais.'\';
');
		}
		else
			fwrite($id,$linea);
	}
	fclose ($id);
	fclose ($fp);
	unlink('copia');
	
	
}

function cargar_gru_dep($acceso,$id){
	if($id=='DEPOSITOS'){
		return verDeposito($acceso);
	}
	else{
		return verGrupoTecnico($acceso);
	}
	$acceso->objeto->ejecutarSql("select cedula,id_contrato,nro_contrato from vista_contrato where id_contrato='$id'");
	$cad='';
	if($row=row($acceso)){
		return "=@".trim($row["id_contrato"])."=@".trim($row["nro_contrato"])."=@".trim($row["cedula"]);
	}
}
function c_id_contrato($acceso,$id){
	
	$acceso->objeto->ejecutarSql("select cedula,id_contrato,nro_contrato from vista_contrato where id_contrato='$id'");
	$cad='';
	if($row=row($acceso)){
		return "=@".trim($row["id_contrato"])."=@".trim($row["nro_contrato"])."=@".trim($row["cedula"]);
	}
}
function c_nro_contrato($acceso,$id){
	
	$acceso->objeto->ejecutarSql("select cedula,id_contrato,nro_contrato from vista_contrato where nro_contrato='$id'");
	$cad='';
	if($row=row($acceso)){
		return "=@".trim($row["id_contrato"])."=@".trim($row["nro_contrato"])."=@".trim($row["cedula"]);
	}
}
function c_cedula($acceso,$id){
	
	$acceso->objeto->ejecutarSql("select cedula,id_contrato,nro_contrato from vista_contrato where cedula='$id'");
	$cad='';
	if($row=row($acceso)){
		return "=@".trim($row["id_contrato"])."=@".trim($row["nro_contrato"])."=@".trim($row["cedula"]);
	}
}
function c_id_pago($acceso,$id){
	
	$acceso->objeto->ejecutarSql("select id_pago,nro_factura,id_contrato from pagos where id_pago='$id'");
	$cad='';
	if($row=row($acceso)){
		return "=@".trim($row["id_pago"])."=@".trim($row["nro_factura"])."=@".trim($row["id_contrato"]);
	}
}
function c_nro_factura($acceso,$id){
	
	$acceso->objeto->ejecutarSql("select impresion,id_pago,pagos.nro_factura,pagos.nro_control ,nro_contrato,fecha_pago,nombre,apellido,monto_pago,status_pago from pagos,contrato,persona where pagos.id_contrato=contrato.id_contrato and contrato.cli_id_persona=persona.id_persona and pagos.nro_factura='$id' and tipo_doc='PAGO' and status_pago='PAGADO'");
	$cad='';
	$BR='';

	while($row=row($acceso)){
		$cad=$cad. "<tbody><tr style=\"cursor: pointer;\" onclick=\"colocar_id_pago('".trim($row["id_pago"])."')\" ><td class=\"numeric\">".trim($row["id_pago"])."</td><td class=\"numeric\">".trim($row["nro_factura"])."</td><td class=\"numeric\">".trim($row["nro_control"])."</td><td class=\"numeric\">".trim($row["monto_pago"])."</td><td class=\"numeric\">".formatofecha(trim($row["fecha_pago"]))."</td><td>".trim($row["status_pago"])."</td><td class=\"numeric\">".trim($row["nro_contrato"])."</td><td>".trim($row["nombre"])."  ".trim($row["apellido"])."</td><td>".trim($row["impresion"])."</td></tr></tbody>";

	}
	if($cad!=''){
	
		echo '
		<section class="panel">

		<header class="panel-heading">Datos de la Factura Fiscal</header>
			
			<div class="panel-body">
			<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
			';
				echo '<table class="table table-hovered table-condensed">';
				echo '<thead><tr class="titulo-tabla"><th class="numeric">ID PAGO</th><th class="numeric">FACTURA</th><th class="numeric">CONTROL</th><th class="numeric">MONTO</th><th class="numeric">FECHA PAGO</th><th>ESTATUS PAGO</th> <th class="numeric">Nº ABONADO</th> <th>CLIENTE</th><th>IMPRESION</th></thead>';
				echo $cad;
				echo '</table>';
		echo '
			</div>
			</div>
	
		</section>
		';
	}	
}
function c_nro_factura_reimp($acceso,$id){
	
	$acceso->objeto->ejecutarSql("select id_pago,nro_factura,nro_control ,nro_contrato,fecha_pago,nombrecli,apellidocli,monto_pago,status_pago from vista_pago_cont where nro_factura='$id' AND impresion='SI'  and tipo_caja='PRINCIPAL' ");
	$cad='';
	$BR='';

	while($row=row($acceso)){
		$cad=$cad. "<tbody><tr style=\"cursor: pointer;\" onclick=\"reimprimir_factura('".trim($row["id_pago"])."')\" ><td class=\"numeric\">".trim($row["id_pago"])."</td><td class=\"numeric\">".trim($row["nro_factura"])."</td><td class=\"numeric\">".trim($row["nro_control"])."</td><td class=\"numeric\">".trim($row["monto_pago"])."</td><td class=\"numeric\">".formatofecha(trim($row["fecha_pago"]))."</td><td>".trim($row["status_pago"])."</td><td class=\"numeric\">".trim($row["nro_contrato"])."</td><td>".trim($row["nombrecli"])."  ".trim($row["apellidocli"])."</td></tr></tbody>";

	}
	if($cad!=''){
	
		echo '
		<section class="panel">

		<header class="panel-heading">Datos de la Factura Fiscal</header>
			
			<div class="panel-body">
			<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
			';
				echo '<table class="table table-hovered table-condensed">';
				echo '<thead><tr class="titulo-tabla"><th class="numeric">ID PAGO</th><th class="numeric">FACTURA</th><th class="numeric">CONTROL</th><th class="numeric">MONTO</th><th class="numeric">FECHA PAGO</th><th>ESTATUS FACTURA</th> <th class="numeric">Nº ABONADO</th> <th>CLIENTE</th></thead>';
				echo $cad;
				echo '</table>';
		echo '
			</div>
			</div>
	
		</section>
		';
	}	
}
function c_nro_control($acceso,$id){
	
	$acceso->objeto->ejecutarSql("select id_pago,pagos.nro_factura,pagos.nro_control ,nro_contrato,fecha_pago,nombre,apellido,monto_pago,status_pago from pagos,contrato,persona where pagos.id_contrato=contrato.id_contrato and contrato.cli_id_persona=persona.id_persona and pagos.nro_control='$id'");
	$cad='';
	$BR='';

	while($row=row($acceso)){
		$cad=$cad. "<tbody><tr style=\"cursor: pointer;\"  ><td class=\"numeric\">".trim($row["id_pago"])."</td><td class=\"numeric\">".trim($row["nro_factura"])."</td><td class=\"numeric\">".trim($row["nro_control"])."</td><td class=\"numeric\">".trim($row["monto_pago"])."</td><td class=\"numeric\">".formatofecha(trim($row["fecha_pago"]))."</td><td>".trim($row["status_pago"])."</td><td class=\"numeric\">".trim($row["nro_contrato"])."</td><td>".trim($row["nombre"])."  ".trim($row["apellido"])."</td></tr></tbody>";

	}
	if($cad!=''){
	
		echo '
		<section class="panel">

		<header class="panel-heading">Datos de la Factura Fiscal asociadas al control</header>
			
			<div class="panel-body">
			<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
			';
				echo '<table class="table table-hovered table-condensed">';
				echo '<thead><tr class="titulo-tabla"><th class="numeric">ID PAGO</th><th class="numeric">FACTURA</th><th class="numeric">CONTROL</th><th class="numeric">MONTO</th><th class="numeric">FECHA PAGO</th><th>ESTATUS FACTURA</th> <th class="numeric">Nº ABONADO</th> <th>CLIENTE</th></thead>';
				echo $cad;
				echo '</table>';
		echo '
			</div>
			</div>
	
		</section>
		';	
		
	}	
}
function anular_control($acceso,$nro_control){
	
	$acceso->objeto->ejecutarSql("select *from pagos where status_pago='ANULADO' AND nro_control='$nro_control'");
	if($row=row($acceso)){
		ECHO "El numero de control ya esta ANULADO";
	}
	else{
		if($ini_u==''){
			session_start();
			$ini_u = $_SESSION["ini_u"];  
		}
		$fecha=date("Y-m-d");
		$fecha_pago=date("Y-m-d");
		$fecha_factura=date("Y-m-d");
		$hora_pago=date("H:i:s");
		$ip_est = $_SERVER['REMOTE_ADDR'];
		//echo "select id_contrato,pagos.id_caja_cob from pagos,caja_cobrador,estacion_trabajo where pagos.id_caja_cob=caja_cobrador.id_caja_cob and caja_cobrador.id_est=estacion_trabajo.id_est and ip_est='$ip_est' and  fecha_pago='$fecha' and status_est='IMPRESORAFISCAL'  ORDER BY inc desc LIMIT 1 offset 0 ";
		$acceso->objeto->ejecutarSql("select id_contrato,pagos.id_caja_cob from pagos,caja_cobrador,estacion_trabajo where pagos.id_caja_cob=caja_cobrador.id_caja_cob and caja_cobrador.id_est=estacion_trabajo.id_est and ip_est='$ip_est' and  fecha_pago='$fecha' and status_est='IMPRESORAFISCAL'  ORDER BY inc desc LIMIT 1 offset 0 ");
		if($row=row($acceso)){
			$id_contrato=trim($row['id_contrato']);
			$id_caja_cob=trim($row['id_caja_cob']);
		}
		else{
			//echo "select id_contrato,pagos.id_caja_cob from pagos where status_pago='PAGADO' ORDER BY inc desc LIMIT 1 offset 0 ";
			$acceso->objeto->ejecutarSql("select id_contrato,pagos.id_caja_cob from pagos where status_pago='PAGADO' ORDER BY inc desc LIMIT 1 offset 0 ");
			if($row=row($acceso)){
				$id_contrato=trim($row['id_contrato']);
				$id_caja_cob=trim($row['id_caja_cob']);
			}
		}
		$acceso->objeto->ejecutarSql("select id_pago from pagos where (id_pago ILIKE '$ini_u%') ORDER BY id_pago desc LIMIT 1 offset 0 "); 
		$id_pago = $ini_u.verCodLargo($acceso,"id_pago");
		
		if(!$acceso->objeto->ejecutarSql("insert into pagos(id_pago,id_caja_cob,fecha_pago,hora_pago,monto_pago,obser_pago,status_pago,nro_factura,id_contrato,nro_control,desc_pago,por_iva,monto_iva,por_reten,monto_reten,base_imp,islr,fecha_factura,impresion) values 
		('$id_pago','$id_caja_cob','$fecha_pago','$hora_pago','0','NRO CONTROL ANULADO','ANULADO','','$id_contrato','$nro_control','0','12','0.00','0','0','0','0','$fecha_factura','SI')")){
			echo "<br>insert into pagos(id_pago,id_caja_cob,fecha_pago,hora_pago,monto_pago,obser_pago,status_pago,nro_factura,id_contrato,nro_control,desc_pago,por_iva,monto_iva,por_reten,monto_reten,base_imp,islr,fecha_factura) values ('$id_pago','$id_caja_cob','$fecha_pago','$hora_pago','0','NRO CONTROL ANULADO','ANULADO','','$id_contrato','$nro_control','','12','0.00','0','0','0','0','$fecha_factura')";
			echo '<br>'.$acceso->objeto->error().'<br>';
		}
	}
}

function verificaSMS($acceso){
	
	//echo "select *from ordenes_tecnicos where id_contrato='$id_contrato' and status_orden='CREADO'";
	$acceso->objeto->ejecutarSql("select count(*) as num from sms where status_sms='UNREAD' and tipo_sms='DELIVER' ");
	$row=row($acceso);
		return "=@".trim($row["num"]);
}

function traeinfoFact($acceso,$id_pago){
	
	//echo "select *from ordenes_tecnicos where id_contrato='$id_contrato' and status_orden='CREADO'";
	$acceso->objeto->ejecutarSql("select *from vista_pago_cont where id_pago='$id_pago' LIMIT 1 offset 0 ");
	$cad='';
	if($row=row($acceso)){
		$nro_contrato=trim($row["nro_contrato"]);
		$cedula=trim($row["cedulacli"]);
		$nombre=trim($row["nombrecli"]);
		$apellido=trim($row["apellidocli"]);
		$fecha_pago=trim($row["fecha_pago"]);
		$valor=explode("-",$fecha_pago);
		$fecha_pago=$valor[0]."-".$valor[1];
	}
	//echo ":$fecha_pago:";
	if($fecha_pago==date("Y-m")){
		return "=@$cedula=@$nombre=@$apellido=@$nro_contrato=@";
	}
	else{
		RETURN "NO ANULAR";
	}
	
}

function rec_falla_rep($acceso,$omitir,$id_det_orden,$resp,$cade){
	require_once "Clases/trans_pago.php";
		$obj_trans=new trans_pago();
		$obj_trans->begin($acceso);
	$valor=explode("-Class-",$cade);
	
	if($omitir=="false"){
			require_once "Clases/sms.php";
			$objeto=new sms();
	}
	
	for($i=0;$i<count($valor)-1;$i++){
		$id_sms=$valor[$i];
		$acceso->objeto->ejecutarSql("select *from sms where id_sms='$id_sms'");
		if($row=row($acceso)){
			$id_contrato=trim($row["id_contrato"]);
			$telefono_sms=trim($row["telefono_sms"]);
		}
		$acceso->objeto->ejecutarSql("Update sms Set status_list='RECHAZADO' Where id_sms='$id_sms'");
		
		if($omitir=="false"){
			echo ":$telefono_sms,$resp:";
			$objeto->EnviarSMSUnico($acceso,$telefono_sms,$resp);
		}
	}
	$obj_trans->commit($acceso);
}

function trae_info_grupo($acceso,$id_orden){
	
	//echo "select *from ordenes_tecnicos where id_contrato='$id_contrato' and status_orden='CREADO'";
	$acceso->objeto->ejecutarSql("select *from orden_grupo where id_orden='$id_orden'");
	$cad='';
	if($row=row($acceso)){
		return trim($row["id_gt"]);
	}
	return "";
}
function trae_tec_gru($acceso,$id_gt){
	
	//echo "select *from ordenes_tecnicos where id_contrato='$id_contrato' and status_orden='CREADO'";
	$acceso->objeto->ejecutarSql("select *from grupo_tecnico where id_gt='$id_gt'");
	$cad='';
	while($row=row($acceso)){
		$cad = $cad."=@".trim($row["id_persona"]);
	}
	return $cad;
}
function trae_tec_gru_disable($acceso){
	$acceso->objeto->ejecutarSql("select grupo_tecnico.id_persona from grupo_tecnico,grupo_trabajo where grupo_trabajo.id_gt=grupo_tecnico.id_gt and grupo_trabajo.status_grupo='ACTIVO'");
	$cad='';
	while($row=row($acceso)){
		$cad= $cad."=@".trim($row["id_persona"]);
	}
	return $cad;
}

function trae_tec_gru_disable_existe($acceso,$id_gt){
	
	$acceso->objeto->ejecutarSql("select grupo_trabajo.id_persona from grupo_tecnico,grupo_trabajo where grupo_trabajo.id_gt=grupo_tecnico.id_gt and grupo_trabajo.status_grupo='ACTIVO'  and grupo_tecnico.id_gt<>'$id_gt'");
	$cad='';
	while($row=row($acceso)){
		$cad= $cad."=@".trim($row["id_persona"]);
	}
	return $cad;
}
function trae_ubi_gru_disable($acceso,$id_zona){
	if($id_zona=="ZONAS"){
		$acceso->objeto->ejecutarSql("select distinct sector.id_zona from grupo_ubicacion,sector,grupo_trabajo where grupo_trabajo.id_gt=grupo_ubicacion.id_gt and grupo_ubicacion.id_sector=sector.id_sector and grupo_trabajo.status_grupo='ACTIVO'");
		$cad='';
		while($row=row($acceso)){
			$cad= $cad."=@".trim($row["id_zona"]);
		}
		return $cad;
	}
	else{
		$acceso->objeto->ejecutarSql("select id_sector from grupo_ubicacion,grupo_trabajo where grupo_trabajo.id_gt=grupo_ubicacion.id_gt and grupo_trabajo.status_grupo='ACTIVO'");
		$cad='';
		while($row=row($acceso)){
			$cad= $cad."=@".trim($row["id_sector"]);
		}
		return $cad;
	}
}
function trae_ubi_gru_disable_existe($acceso,$id_gt,$id_zona){
	if($id_zona=="ZONAS"){
		$acceso->objeto->ejecutarSql("select sector.id_zona from grupo_ubicacion,sector,grupo_trabajo where grupo_trabajo.id_gt=grupo_ubicacion.id_gt and grupo_ubicacion.id_sector=sector.id_sector and grupo_trabajo.status_grupo='ACTIVO'  and grupo_ubicacion.id_gt<>'$id_gt'");
		$cad='';
		while($row=row($acceso)){
			$cad= $cad."=@".trim($row["id_zona"]);
		}
		return $cad;
	}
	else{
		$acceso->objeto->ejecutarSql("select id_sector from grupo_ubicacion,grupo_trabajo where grupo_trabajo.id_gt=grupo_ubicacion.id_gt and grupo_trabajo.status_grupo='ACTIVO'  and grupo_ubicacion.id_gt<>'$id_gt'");
		$cad='';
		while($row=row($acceso)){
			$cad= $cad."=@".trim($row["id_sector"]);
		}
		return $cad;
	}
}
function trae_ubi_gru($acceso,$id_gt,$id_zona){
	if($id_zona=="ZONAS"){
		$acceso->objeto->ejecutarSql("select sector.id_zona from grupo_ubicacion,sector where grupo_ubicacion.id_sector=sector.id_sector and id_gt='$id_gt'");
		$cad='';
		while($row=row($acceso)){
			$cad= $cad."=@".trim($row["id_zona"]);
		}
		return $cad;
	}
	ELSE{
		$acceso->objeto->ejecutarSql("select id_sector from grupo_ubicacion where id_gt='$id_gt'");
		$cad='';
		while($row=row($acceso)){
			$cad= $cad."=@".trim($row["id_sector"]);
		}
		return $cad;
	}
}
function filtrarcontrato($acceso,$nro_contrato){
	
	session_start();
	$id_f = $_SESSION["id_franq"]; 
	
	if($id_f!='0'){
		$consult=" AND id_franq='$id_f'";
	}
	
//	echo "select *from vista_orden where status_orden='IMPRESO' and nro_contrato='$nro_contrato'";
	$acceso->objeto->ejecutarSql("select *from vista_orden where status_orden='IMPRESO' and nro_contrato='$nro_contrato' $consult");
	if($row=row($acceso)){
		return "=@".trim($row["id_orden"])."=@".trim($row["tipo_detalle"])."=@".trim($row["id_contrato"])."=@".trim($row["nro_contrato"])."=@".trim($row["apellidocli"])." ".trim($row["nombrecli"])."=@".trim($row["nombre_tipo_orden"])."=@".trim($row["nombre_det_orden"])."=@".trim($row["etiqueta"])."=@".trim($row["comentario_orden"])."=@".trim($row["id_det_orden"])."=@".trim($row["id_tipo_orden"])."=@".trim($row["contrato_fisico"]);
	}
	return "";
}
function buscar_orden_final($acceso,$id_orden){
	
	session_start();
	$id_f = $_SESSION["id_franq"]; 
	
	if($id_f!='0'){
		$consult=" AND id_franq='$id_f'";
	}
	
	$acceso->objeto->ejecutarSql("select *from vista_orden where status_orden='IMPRESO' and id_orden='$id_orden' $consult");
	if($row=row($acceso)){
		return "=@".trim($row["id_orden"])."=@".trim($row["tipo_detalle"])."=@".trim($row["id_contrato"])."=@".trim($row["nro_contrato"])."=@".trim($row["apellidocli"])." ".trim($row["nombrecli"])."=@".trim($row["nombre_tipo_orden"])."=@".trim($row["nombre_det_orden"])."=@".trim($row["etiqueta"])."=@".trim($row["comentario_orden"])."=@".trim($row["id_det_orden"])."=@".trim($row["id_tipo_orden"])."=@".trim($row["contrato_fisico"]);
	}
	return "";
}
function verificaOrden($acceso,$id_contrato){
	
	//echo "select *from ordenes_tecnicos where id_contrato='$id_contrato' and status_orden='CREADO'";
	$acceso->objeto->ejecutarSql("select *from ordenes_tecnicos where id_contrato='$id_contrato' and status_orden='CREADO'");
	if($row=row($acceso)){
			return trim($row["status_orden"]);
	}
	
	$acceso->objeto->ejecutarSql("select *from ordenes_tecnicos where id_contrato='$id_contrato' and status_orden='IMPRESO'");
	if($row=row($acceso)){
			return trim($row["status_orden"]);
	}
	//return "NO";
	
}
function agregar_cd($acceso,$id_contrato){
/*
	$ini_u = $_SESSION["ini_u"];

	$fecha=date("Y-m-01"); 
	
				$id_serv='SER00007';
				$cant_serv=1;
				
				$acceso->objeto->ejecutarSql("select id_cont_serv from contrato_servicio_deuda  where (id_cont_serv ILIKE '$ini_u%')  ORDER BY id_cont_serv desc LIMIT 1 offset 0 "); 
				//$id_cont_serv=$ini_u.verCodLong($acceso,"id_cont_serv");
				$id_cont_serv=verCodLongD($acceso,"id_cont_serv",$ini_u);
				
				echo "select tarifa_ser from vista_tarifa where id_serv='$id_serv' and status_tarifa_ser='ACTIVO'";
				$acceso->objeto->ejecutarSql("select tarifa_ser from vista_tarifa where id_serv='$id_serv' and status_tarifa_ser='ACTIVO'"); 
				if($row=row($acceso)){
					$tarifa_ser=trim($row['tarifa_ser']);
				}
				
				
				$acceso->objeto->ejecutarSql("insert into contrato_servicio_deuda(id_cont_serv,id_serv,id_contrato,fecha_inst,cant_serv,status_con_ser,costo_cobro,descu,modo_des) values ('$id_cont_serv','$id_serv','$id_contrato','$fecha','$cant_serv','Deuda','$tarifa_ser','0','AUTOMATICO')");
				
				actualizarDeuda($acceso,$id_contrato);
				*/
}
function traerMensualidad($acceso,$id_contrato){
	$fechaSig=date("Y-m-01");
	$acceso->objeto->ejecutarSql("select fecha_inst,id_serv from vista_contratoser where id_contrato='$id_contrato' and fecha_inst>='$fechaSig' and status_con_ser<>'CONTRATO' and tipo_costo='COSTO MENSUAL' order by id_cont_serv desc ");
	//$acceso->objeto->ejecutarSql("select fecha_inst,id_serv from vista_contratoser where id_contrato='$id_contrato' and status_con_ser<>'CONTRATO' and tipo_costo='COSTO MENSUAL' order by id_cont_serv desc");
	if($row=row($acceso)){
			$fecha=trim($row["fecha_inst"]);
			//echo ":$fecha:";
			$fec = explode ( "-", $fecha );
			$mes=$fec[1];
			$anio=$fec[0];
			//echo "$anio"."-$mes"."-01:";
			$fechaSig=sumames("$anio"."-$mes"."-01");

			$fec = explode ("-",$fechaSig);
			$mes=$fec[1];
			$anio=$fec[0];
			$f_mes=formato_mes_com($mes);
			return "<option value='$fechaSig'>$f_mes $anio</option>";
		
	}
			//$fechaSig=date("Y-m-01");
			//$fechaSig=sumames(date("Y-m-01"));
			
			$fec = explode ("-",$fechaSig);
			$mes=$fec[1];
			$anio=$fec[0];
			$f_mes=formato_mes_com($mes);
	return "<option value='$fechaSig'>$f_mes $anio</option>";
}
function ActualizarCampo($acceso,$valor){
	require_once "Clases/trans_pago.php";
		$obj_trans=new trans_pago();
		$obj_trans->begin($acceso);
		
	$tabla=trim($valor[1]);
	$campo=trim($valor[2]);
	$value=trim($valor[3]);
	$dato_condicion=trim($valor[4]);
	$valor_condicion=trim($valor[5]);
	$motivo=trim($valor[6]);
	$comentario=trim($valor[7]);
	//echo ":$condicion:";

	
	$acceso->objeto->ejecutarSql("select costo_cobro,id_contrato from $tabla where $dato_condicion='$valor_condicion'");
	if($row=row($acceso)){
		$monto_anterior=trim($row["costo_cobro"]);
		$id_contrato=trim($row["id_contrato"]);
	}
	$monto_posterior=$value;
	$tipo="";
	if($monto_anterior>$monto_posterior){
		$tipo="NOTA DE CREDITO";
	}
	else if($monto_anterior<$monto_posterior){
		$tipo="NOTA DE DEBITO";
	}
	if($tipo!=""){
		require_once "Clases/notas.php";
		$objeto=new notas();
		$id_cont_serv=$valor_condicion;
		$generado_por='USUARIO';
		$objeto->incluirnotas($acceso,$tipo,$id_cont_serv,$monto_anterior,$monto_posterior,$motivo,$comentario,$generado_por,$id_contrato);
		$acceso->objeto->ejecutarSql("Update $tabla Set $campo='$value' where $dato_condicion='$valor_condicion'");
		
		$acceso->objeto->ejecutarSql("select id_nota from notas order by id_nota desc");
		if($row=row($acceso)){
			$id_nota=trim($row["id_nota"]);
			echo "=@$id_nota=@";
		}
	}
	$obj_trans->commit($acceso);
}

function ActualizarDeudaDC($acceso,$id_cont_serv,$monto_dc,$monto_posterior,$motivo,$comentario,$tipo){
	require_once "Clases/trans_pago.php";
	$obj_trans=new trans_pago();
	$obj_trans->begin($acceso);
	$monto_dc=$monto_dc+0;
	$monto_posterior=$monto_posterior+0;

	$acceso->objeto->ejecutarSql("select costo_cobro,id_contrato,nombre_servicio,fecha_inst from contrato_servicio_deuda,servicios where contrato_servicio_deuda.id_serv=servicios.id_serv and id_cont_serv='$id_cont_serv'");
	if($row=row($acceso)){
		$monto_anterior=trim($row["costo_cobro"])+0;
		$id_contrato=trim($row["id_contrato"]);
		$nombre_servicio=trim($row["nombre_servicio"]);
		$fecha_inst=trim($row["fecha_inst"]);
	}
	if($obj_trans->valida_nota_dc($acceso,$tipo,$monto_dc,$monto_anterior,$monto_posterior)){
		require_once "Clases/notas.php";
		$objeto=new notas();
		$generado_por='USUARIO';
		$objeto->solicitar_notas($acceso,$tipo,$id_cont_serv,$monto_anterior,$monto_posterior,$motivo,$comentario,$generado_por,$id_contrato,$monto_dc,$nombre_servicio,$fecha_inst);
		
		$obj_trans->commit($acceso);
		
	}
	else{
		$obj_trans->rollback($acceso);
	}
	
	
}
function confirmar_nota_cd($acceso,$id_nota){
	require_once "Clases/trans_pago.php";
	$obj_trans=new trans_pago();
	$obj_trans->begin($acceso);
	
	session_start();
		$login_aut = strtoupper(trim($_SESSION["login"]));
		$fecha_aut = date("Y-m-d");
		$hora_aut = date("H:i:s");
		
	$acceso->objeto->ejecutarSql("select id_cont_serv,monto_posterior from notas where id_nota='$id_nota'");
	if($row=row($acceso)){
		$monto_posterior=trim($row["monto_posterior"])+0;
		$id_cont_serv=trim($row["id_cont_serv"]);
		$acceso->objeto->ejecutarSql("Update contrato_servicio_deuda Set costo_cobro='$monto_posterior' where id_cont_serv='$id_cont_serv'");
		$acceso->objeto->ejecutarSql("Update notas Set status='AUTORIZADO',login_aut='$login_aut', fecha_aut='$fecha_aut',hora_aut='$hora_aut' where id_nota='$id_nota'");
	}
	
	$obj_trans->commit($acceso);
		
}
function negar_nota_cd($acceso,$id_nota){
	require_once "Clases/trans_pago.php";
	$obj_trans=new trans_pago();
	$obj_trans->begin($acceso);
	$login_aut = strtoupper(trim($_SESSION["login"]));
		$fecha_aut = date("Y-m-d");
		$hora_aut = date("H:i:s");
		
	$acceso->objeto->ejecutarSql("Update notas Set status='RECHAZADO',login_aut='$login_aut', fecha_aut='$fecha_aut',hora_aut='$hora_aut' where id_nota='$id_nota'");
	$obj_trans->commit($acceso);
}
function traerTO($acceso,$id_det_orden){
	$acceso->objeto->ejecutarSql("select *from detalle_orden where id_det_orden='$id_det_orden'");
	if($row=row($acceso)){
		return "=@".trim($row["id_tipo_orden"]);
	}
}
function montoCierrePunto($acceso,$id_caja_cob){
	$suma=0;
		$acceso->objeto->ejecutarSql("select sum(monto_pago) as monto from pagos where id_caja_cob='$id_caja_cob' and status_pago='PAGADO'");
		if($row=row($acceso))
		{
				$suma=trim($row["monto"]);
		}
	
	if($suma==0)
		return "=@0.00";
	return "=@".$suma;
}
function calcularMontoPago($acceso,$valor){
	$suma=0;
	for($i=1;$i<count($valor)-1;$i++){
		$id_cont_serv=$valor[$i];
		$acceso->objeto->ejecutarSql("select cant_serv,costo_cobro from vista_contratodeu where id_cont_serv='$id_cont_serv' and status_con_ser='DEUDA'");
		if($row=row($acceso))
		{
			$cant=trim($row["cant_serv"]);
			$tar=trim($row["costo_cobro"]);
			$suma=$suma+($cant*$tar);
		}
	}
	return "=@".$suma;
}
function traerTipoSer($acceso,$id_serv){
	$acceso->objeto->ejecutarSql("select *from vista_servicios where id_serv='$id_serv'");
	if($row=row($acceso)){
		return "=@".trim($row["id_tipo_servicio"])."=@".trim($row["id_franq"]);
	}
}
function traerFranqSer($acceso,$id_tipo_servicio){
	$acceso->objeto->ejecutarSql("select *from tipo_servicio where id_tipo_servicio='$id_tipo_servicio'");
	if($row=row($acceso)){
		return "=@".trim($row["id_franq"]);
	}
}
function traer_sistema_marca($acceso,$id_modelo){
	$acceso->objeto->ejecutarSql("select *from modelo where id_modelo='$id_modelo'");
	if($row=row($acceso)){
		return "=@".trim($row["id_marca"])."=@".trim($row["id_tse"]);
	}
}
function traerFranq($acceso,$id_zona){
	$acceso->objeto->ejecutarSql("select *from zona where id_zona='$id_zona'");
	if($row=row($acceso)){
		return "=@".trim($row["id_franq"]);
	}
}
function validarSQL($acceso,$sql){
	if($acceso->objeto->validarSql($sql)==true)
		return 'true';
	else{
		return 'false';
	}
}
function camposRep2($acceso,$tabla){
	$manejador=$acceso->objeto->getManejador();
	$cad="";
	$primero=false;
	for($i=1;$i<count($tabla);$i++)
	{
		$table=$tabla[$i];
		$acceso->objeto->ejecutarSql("select * from $table");
		$num=$acceso->objeto->num_fields();
		for($j=0;$j<$num;$j++)
		{
			$meta = $acceso->objeto->fetch_field($j);
			if($manejador=="MySql")
			{
				if($primero==false)
					$cad='<option selected="selected" value="'.$table.'.'.$meta->name.'">'.$table.'.'.$meta->name.'</option>';
				else
					$cad.='<option value="'.$table.'.'.$meta->name.'">'.$table.'.'.$meta->name.'</option>';
			}
			else if($manejador=="Postgres"){
				if($primero==false)
					$cad='<option selected="selected" value="'.$table.'.'.$meta.'">'.$table.'.'.$meta.'</option>';
				else
					$cad.='<option value="'.$table.'.'.$meta.'">'.$table.'.'.$meta.'</option>';
			}
			$primero=true;
		}
	}
	return $cad;
}

//retorna los datos de un perfil para saber a que modulos tiene acceso
function traerModulo($acceso,$dato){
	$cadena="";
	while($row=row($acceso)){				
		$cadena=$cadena.trim($row[$dato]).','.trim($row[2]).','.trim($row[3]).','.trim($row[4]).'=@';
	}
	return $cadena;
}


function buscardfID($acceso,$id_pago){
//ECHO "SELECT id_pago FROM pagos where nro_factura='$nro_factura'";
	$acceso->objeto->ejecutarSql("SELECT nro_factura FROM pagos where id_pago='$id_pago'");
		if($row=row($acceso)){
			$nro_factura=trim($row['nro_factura']);
			buscardf($acceso,$nro_factura);
		}
}
/*
function buscardf($acceso,$id_pago){
//ECHO "SELECT id_pago FROM pagos where nro_factura='$nro_factura'";
	$acceso->objeto->ejecutarSql("SELECT id_pago FROM pagos where id_pago='$id_pago'");
		if($row=row($acceso)){
			$id_pago=trim($row['id_pago']);
		
		
	$cad_fiscal='';
	$caden=array("�","�","�","�","�","�",",");
	$mejor=array("N","A","E","I","O","U"," ");
	$select="SELECT pagos.id_caja_cob,pagos.desc_pago,pagos.id_pago,pagos.fecha_pago, pagos.hora_pago,pagos.monto_pago,pagos.nro_factura, 
  contrato_servicio_pagado.id_contrato, contrato_servicio_pagado.fecha_inst, contrato_servicio_pagado.cant_serv, contrato_servicio_pagado.costo_cobro
  ,contrato.nro_contrato, vista_cliente.cedula AS cedulacli, vista_cliente.nombre AS nombrecli, vista_cliente.apellido AS apellidocli
  , vista_tarifa.nombre_servicio, vista_tarifa.tipo_costo 
  , contrato_servicio_pagado.descu
  , pagos.monto_iva
  ,vista_cliente.tipo_cliente
  ,vista_cliente.inicial_doc
   FROM pago_servicio, pagos, contrato_servicio_pagado, vista_tarifa, contrato, vista_cliente
  WHERE pagos.id_pago = pago_servicio.id_pago AND pago_servicio.id_cont_serv = contrato_servicio_pagado.id_cont_serv and contrato_servicio_pagado.id_serv = vista_tarifa.id_serv AND contrato_servicio_pagado.id_contrato = contrato.id_contrato AND vista_tarifa.status_tarifa_ser = 'ACTIVO'::bpchar and contrato.cli_id_persona = vista_cliente.id_persona and pagos.id_pago='$id_pago'
ORDER BY pagos.fecha_pago, pagos.hora_pago;";
		$pago=lectura($acceso,$select);
		$monto_iva=trim($pago[0]['monto_iva']);
		$id_contrato=trim($pago[0]['id_contrato']);
		$cont=lectura($acceso,"SELECT numero_piso,edificio,direc_adicional,numero_casa,nombre_zona,nombre_sector,nombre_calle,numero_casa,telefono FROM vista_contrato where id_contrato='$id_contrato' LIMIT 1 offset 0");
	
		$t_pago=lectura($acceso,"SELECT tipo_pago.tipo_pago, detalle_tipopago.banco,detalle_tipopago.numero FROM tipo_pago,detalle_tipopago where id_pago='$id_pago' and detalle_tipopago.id_tipo_pago = tipo_pago.id_tipo_pago");
		
		$id_caja_cob=trim($pago[0]['id_caja_cob']);
		$cob_caja=lectura($acceso,"SELECT vista_cobrador.nro_cobrador,caja.nombre_caja,caja.tipo_caja FROM vista_cobrador,caja_cobrador,caja where vista_cobrador.id_persona=caja_cobrador.id_persona and caja_cobrador.id_caja=caja.id_caja and caja_cobrador.id_caja_cob='$id_caja_cob'");
		session_start();
		$login=$_SESSION["login"];
		$nro_cobrador=strtoupper($login);
		$nombre_caja=trim($cob_caja[0]['nombre_caja']);
		$tipo_caja=trim($cob_caja[0]['tipo_caja']);

			$id_franq='1';
			$id_contrato=trim($pago[0]['id_contrato']);
			$fecha=trim($pago[0]['fecha_pago']);
			$hora_pago=trim($pago[0]['hora_pago']);
			$fechaN=explode("-",$fecha);
			$hora_pago=substr($hora_pago, 0,5);
			$anio=substr($fechaN[0], 2,2);
			$fecha_pago= $fechaN[2].'/'.$fechaN[1].'/'.$anio;
			
			$monto_pago=trim($pago[0]['monto_pago']);
			$tipo_cliente=trim($pago[0]['tipo_cliente']);
			$inicial_doc=trim($pago[0]['inicial_doc']);
			$nro_factura=trim($pago[0]['nro_factura']);
			if($tipo_cliente=='JURIDICO'){
				$cedulacli=$inicial_doc."-".trim($pago[0]['cedulacli']);
				$nombrecli=trim($pago[0]['nombrecli']);
			}else{
				$cedulacli=trim($pago[0]['cedulacli']);
				$nombrecli=substr(utf8_decode(trim($pago[0]['apellidocli'])." ".trim($pago[0]['nombrecli'])),0,29);
			}
			$nro_contrato=trim($pago[0]['nro_contrato']);
			$desc_pago=trim($pago[0]['desc_pago']);
		
		
		
//		$acceso->objeto->ejecutarSql("SELECT nombre_zona,nombre_sector,nombre_calle,numero_casa,telefono FROM vista_contrato where id_contrato='$id_contrato' LIMIT 1 offset 0");
		//if($row=row($acceso)){
			$nombre_zona=utf8_decode(trim($cont[0]['nombre_zona']));
			$nombre_sector=utf8_decode(trim($cont[0]['nombre_sector']));
			$nombre_calle=utf8_decode(trim($cont[0]['nombre_calle']));
			$numero_casa=utf8_decode(trim($cont[0]['numero_casa']));
			$telefono=utf8_decode(trim($cont[0]['telefono']));
			
			$numero_piso=utf8_decode(trim($cont[0]['numero_piso']));
			$edificio=utf8_decode(trim($cont[0]['edificio']));
			$direc_adicional=utf8_decode(trim($cont[0]['direc_adicional']));
			$numero_casa=utf8_decode(trim($cont[0]['numero_casa']));
		//}
		
//		echo "<br><br>SELECT tipo_pago.tipo_pago, detalle_tipopago.banco,detalle_tipopago.numero FROM tipo_pago,detalle_tipopago where id_pago='$id_pago' and detalle_tipopago.id_tipo_pago = tipo_pago.id_tipo_pago";
		//$acceso->objeto->ejecutarSql("SELECT tipo_pago.tipo_pago, detalle_tipopago.banco,detalle_tipopago.numero FROM tipo_pago,detalle_tipopago where id_pago='$id_pago' and detalle_tipopago.id_tipo_pago = tipo_pago.id_tipo_pago");
		//if($row=row($acceso)){
			$tipo_pago=utf8_decode(trim($t_pago[0]['tipo_pago']));
			$banco=trim($t_pago[0]['banco']);
			$numero=trim($t_pago[0]['numero']);
			
			
		//}
		$acceso->objeto->ejecutarSql("SELECT *FROM parametros where id_franq='$id_franq' and id_param='2'");
		
		if($row=row($acceso)){
			$por_iva=trim($row['valor_param']);
		}
		$cad="$id_pago=@$nro_factura=@$cedulacli=@$nombrecli=@$nro_contrato=@$nombre_zona=@$nombre_sector=@$nombre_calle=@$numero_casa=@$telefono=@$edificio=@$numero_piso=@$tipo_pago=@$banco=@$numero=@$nro_cobrador=@$nombre_caja=@$por_iva=@$tipo_caja=@$fecha_pago=@$hora_pago=@$desc_pago=@$monto_iva=@-Class-";
		for($j=0;$j<count($caden);$j++){
			$a=$caden[$j];
			$b=$mejor[$j];
			$cad=str_replace($a,$b,$cad);
		}
	//	echo $cad;
		$cad_fiscal=$cad_fiscal.$cad;
		//echo "$id_pago=@$nro_factura=@$cedulacli=@$nombrecli=@$nro_contrato=@$nombre_zona=@$nombre_sector=@$nombre_calle=@$numero_casa=@$telefono=@$edificio=@$numero_piso=@$tipo_pago=@$banco=@$numero=@$nro_cobrador=@$nombre_caja=@$por_iva=@$tipo_caja=@-Class-";
		
		
		for($i=0;$i<count($pago);$i++){
			$nombre_servicio=utf8_decode(trim($pago[$i]['nombre_servicio']));
			$tipo_costo=trim($pago[$i]['tipo_costo']);
			$descu=trim($pago[$i]['descu'])+0;
			$fecha=trim($pago[$i]['fecha_inst']);
			$fechaN=explode("-",$fecha);
			$mes=formato_m($fechaN[1]);
			$anio=$fechaN[0];
			
			if($tipo_costo=='COSTO MENSUAL'){
				$nombre_servicio= $nombre_servicio.' '.$mes." ".$anio;
			}
			
			$cant_serv=trim($pago[$i]['cant_serv']);
			$costo_cobro=trim($pago[$i]['costo_cobro']);
			$total=$cant_serv*$costo_cobro;
			$suma=$suma+$total;
			
			$costo_cobro=number_format($costo_cobro+0, 2, ',', '.');
			//$total=number_format($total+0, 2, ',', '.');
			
			//$alto+=$inter;
			//$this->add("$nombre_servicio",$x1,$alto);
			//$this->add("$cant_serv",304,$alto);
			//$this->add("$costo_cobro",360,$alto);
			//$this->add("$total",430,$alto);
			//echo str_replace(",","","=@$nombre_servicio=@$total-Class-");
			$cad="=@$nombre_servicio=@$total=@1=@$descu-Class-";
			for($j=0;$j<count($caden);$j++){
				$a=$caden[$j];
				$b=$mejor[$j];
				$cad=str_replace($a,$b,$cad);
			}
			//echo $cad;
			$cad_fiscal=$cad_fiscal.$cad;
			//echo "=@$nombre_servicio=@$total-Class-";
		}
		echo $cad_fiscal."-Fiscal-";
		crearticket($cad_fiscal);
	}
}

function crearticket($cad_fiscal){
$ini_u = $_SESSION["ini_u"]; 
$cad = $cad_fiscal;
//echo ":$nombre_empresa:";
$items=explode("-Class-",$cad);

$datos=explode("=@",$items[0]);
$sesion=trim($datos[18]);
if($sesion=='PRINCIPAL'){
  
  $id = fopen("notas/$ini_u"."ArchivoFactura.txt","w+");		
	$cad='i01Cliente:
i02'.substr($datos[3],0,40).'
i03CEDULA/RIF: '.$datos[2].'  Codigo: '.$datos[4].'
i04Dir: '.substr($datos[6].'; '.$datos[7].'; '.$datos[8],0,40).'
i05REF: '.$datos[1].'
i06Forma de Pago: '.$datos[12].'
i07Cob: '.$datos[15].'; '.$datos[16].'';
if(trim($datos[12])!='EFECTIVO'){
	//$cad=$cad.'<TEXTO_CF,BANCO: '.$datos[13].' NRO: '.$datos[14].',0>';
}

$porc_iva=trim($datos[17]);
  $por=$porc_iva/100;
  for($i=1;$i<count($items)-1;$i++){
	$dato=explode("=@",$items[$i]);

	$total_c=$dato[2]*$dato[3];
	$total_c=$total_c/1.12;
	$descuen=$dato[4];
	$descu=$dato[4];
	$descu=number_format($descu,2, '', '');
	
	//$porc= ($descu/$total_c)*100;
	//$porc_des=number_format($porc+0,2, '', '');

	$cant="00001000";

	//$total_c=1;
	//$porc=$por+1;
	$base=$total_c;
	
	$base1=$base+0;
	//echo ";$base;$base1;";
	$base=number_format($base,2, '', '');
	
	//$base1=number_format($base,2, '', '.');
	$cont='';
	//echo ":$base:$base1:";
		if($base1<=9.9999){
			$cont="0".$cont;
		}
		if($base1<=99.9999){
			$cont="0".$cont;
		}
		if($base1<=999.9999){
			$cont="0".$cont;
		}
		if($base1<=9999.9999){
			$cont="0".$cont;
		}
		if($base1<=99999.9999)
			$cont="0".$cont;
		if($base1<=999999.9999)
			$cont="0".$cont;
		if($base1<=9999999.9999)
			$cont="0".$cont;

		//ECHO "<br>:$cont:$base:$cant:";	

$monto_iva = $datos[22]+0;		
if($monto_iva>0){
	$cad=$cad.'
!'.$cont.''.$base.$cant.$dato[1].'';
}else{
		$cad=$cad.'
| |'.$cont.''.$base.$cant.$dato[1].'';
}

$desc_pago = $datos[21]+0;


		$conta='';
		if($descuen<10)
			$conta="0".$conta;
		if($descuen<100)
			$conta="0".$conta;
		if($descuen<1000)
			$conta="0".$conta;
		if($descuen<10000)
			$conta="0".$conta;
		if($descuen<100000)
			$conta="0".$conta;
		if($descuen<1000000)
			$conta="0".$conta;
		
 if($descu>0){
 
		$cad=$cad.'
q-'.$conta.$descu.'';
	}


  }
 
 if($datos[12]=="CHEQUE"){
	$cad=$cad.'
102
	';
 }
 else if($datos[12]=="TARJETA DE DEBITO"){
	$cad=$cad.'
103
	';
 }else if($datos[12]=="TARJETA DE CREDITO"){
	$cad=$cad.'
104
	';
 }
 else if($datos[12]=="DEPOSITO"){
	$cad=$cad.'
105
	';
 }
 else if($datos[12]=="TRANSFERENCIA"){
	$cad=$cad.'
106
	';
 }
 else if($datos[12]=="DOMICILIACIONES"){
	$cad=$cad.'
107
	';
 }
 else{
$cad=$cad.'
101
	';
}
	fwrite($id,$cad);
		
	fclose ($id);
	
	include "notas/$ini_u"."ArchivoFactura.txt";
}

}//function

*/


function buscardf($acceso,$id_pago){
	//echo "SELECT id_pago FROM pagos where id_pago='$id_pago'";
	$acceso->objeto->ejecutarSql("SELECT id_pago FROM pagos where id_pago='$id_pago'");
		if($row=row($acceso)){
			$id_pago=trim($row['id_pago']);

	$cad_fiscal='';
	$caden=array("Ñ","Á","É","Í","Ó","Ú",",","ñ","á","é","í","ó","ú");
	$mejor=array("N","A","E","I","O","U"," ","N","A","E","I","O","U");
	
	$select="SELECT pagos.desc_pago, pagos.id_caja_cob,pagos.id_pago,pagos.fecha_pago, pagos.hora_pago,pagos.monto_pago,pagos.nro_factura, 
  contrato_servicio_pagado.id_contrato, contrato_servicio_pagado.fecha_inst, contrato_servicio_pagado.cant_serv, contrato_servicio_pagado.costo_cobro
  ,contrato.nro_contrato, vista_cliente.cedula AS cedulacli, vista_cliente.nombre AS nombrecli, vista_cliente.apellido AS apellidocli
  , vista_servicios.nombre_servicio, vista_servicios.tipo_costo 
   , contrato_servicio_pagado.descu
   FROM pago_servicio, pagos, contrato_servicio_pagado, vista_servicios, contrato, vista_cliente
  WHERE pagos.id_pago = pago_servicio.id_pago AND pago_servicio.id_cont_serv = contrato_servicio_pagado.id_cont_serv and contrato_servicio_pagado.id_serv = vista_servicios.id_serv AND contrato_servicio_pagado.id_contrato = contrato.id_contrato  and contrato.cli_id_persona = vista_cliente.id_persona and  pagos.id_pago='$id_pago'
ORDER BY pagos.fecha_pago, pagos.hora_pago;";
		$pago=lectura($acceso,$select);
		$id_contrato=trim($pago[0]['id_contrato']);
		$cont=lectura($acceso,"SELECT numero_piso,edificio,direc_adicional,numero_casa,nombre_zona,nombre_sector,nombre_calle,numero_casa,telefono FROM vista_contrato where id_contrato='$id_contrato' LIMIT 1 offset 0");
	
		$t_pago=lectura($acceso,"SELECT tipo_pago.tipo_pago, detalle_tipopago.banco,detalle_tipopago.numero FROM tipo_pago,detalle_tipopago where id_pago='$id_pago' and detalle_tipopago.id_tipo_pago = tipo_pago.id_tipo_pago");
		
		$id_caja_cob=trim($pago[0]['id_caja_cob']);
		$cob_caja=lectura($acceso,"SELECT vista_cobrador.nro_cobrador,caja.nombre_caja,caja.tipo_caja FROM vista_cobrador,caja_cobrador,caja where vista_cobrador.id_persona=caja_cobrador.id_persona and caja_cobrador.id_caja=caja.id_caja and caja_cobrador.id_caja_cob='$id_caja_cob'");
		$nro_cobrador=trim($cob_caja[0]['nro_cobrador']);
		$nombre_caja=trim($cob_caja[0]['nombre_caja']);
		$tipo_caja=trim($cob_caja[0]['tipo_caja']);

			$id_franq='1';
			$id_contrato=trim($pago[0]['id_contrato']);
			$desc_pago=trim($pago[0]['desc_pago']);
			$fecha=trim($pago[0]['fecha_pago']);
			$hora_pago=trim($pago[0]['hora_pago']);
			$fechaN=explode("-",$fecha);
			$hora_pago=substr($hora_pago, 0,5);
			$anio=substr($fechaN[0], 2,2);
			$fecha_pago= $fechaN[2].'/'.$fechaN[1].'/'.$anio;
			
			$monto_pago=trim($pago[0]['monto_pago']);
			$nro_factura=trim($pago[0]['nro_factura']);
			$cedulacli=trim($pago[0]['cedulacli']);
			$nombrecli=substr(utf8_decode(trim($pago[0]['apellidocli'])." ".trim($pago[0]['nombrecli'])),0,29);
			$nro_contrato=trim($pago[0]['nro_contrato']);
		
		
		
//		$acceso->objeto->ejecutarSql("SELECT nombre_zona,nombre_sector,nombre_calle,numero_casa,telefono FROM vista_contrato where id_contrato='$id_contrato' LIMIT 1 offset 0");
		//if($row=row($acceso)){
			$nombre_zona=utf8_decode(trim($cont[0]['nombre_zona']));
			$nombre_sector=utf8_decode(trim($cont[0]['nombre_sector']));
			$nombre_calle=utf8_decode(trim($cont[0]['nombre_calle']));
			$numero_casa=utf8_decode(trim($cont[0]['numero_casa']));
			$telefono=utf8_decode(trim($cont[0]['telefono']));
			
			$numero_piso=utf8_decode(trim($cont[0]['numero_piso']));
			$edificio=utf8_decode(trim($cont[0]['edificio']));
			$direc_adicional=utf8_decode(trim($cont[0]['direc_adicional']));
			$numero_casa=utf8_decode(trim($cont[0]['numero_casa']));
		//}
		
//		echo "<br><br>SELECT tipo_pago.tipo_pago, detalle_tipopago.banco,detalle_tipopago.numero FROM tipo_pago,detalle_tipopago where id_pago='$id_pago' and detalle_tipopago.id_tipo_pago = tipo_pago.id_tipo_pago";
		//$acceso->objeto->ejecutarSql("SELECT tipo_pago.tipo_pago, detalle_tipopago.banco,detalle_tipopago.numero FROM tipo_pago,detalle_tipopago where id_pago='$id_pago' and detalle_tipopago.id_tipo_pago = tipo_pago.id_tipo_pago");
		//if($row=row($acceso)){
			$tipo_pago=utf8_decode(trim($t_pago[0]['tipo_pago']));
			$banco=trim($t_pago[0]['banco']);
			$numero=trim($t_pago[0]['numero']);
			
			
		//}
		$acceso->objeto->ejecutarSql("SELECT *FROM parametros where id_franq='$id_franq' and id_param='2'");
		
		if($row=row($acceso)){
			$por_iva=trim($row['valor_param']);
		}
		$cad="$id_pago=@$nro_factura=@$cedulacli=@$nombrecli=@$nro_contrato=@$nombre_zona=@$nombre_sector=@$nombre_calle=@$numero_casa=@$telefono=@$edificio=@$numero_piso=@$tipo_pago=@$banco=@$numero=@$nro_cobrador=@$nombre_caja=@$por_iva=@$tipo_caja=@$fecha_pago=@$hora_pago=@$desc_pago=@-Class-";
		for($j=0;$j<count($caden);$j++){
			$a=$caden[$j];
			$b=$mejor[$j];
			$cad=str_replace($a,$b,$cad);
		}
	//	echo $cad;
		$cad_fiscal=$cad_fiscal.$cad;
		//echo "$id_pago=@$nro_factura=@$cedulacli=@$nombrecli=@$nro_contrato=@$nombre_zona=@$nombre_sector=@$nombre_calle=@$numero_casa=@$telefono=@$edificio=@$numero_piso=@$tipo_pago=@$banco=@$numero=@$nro_cobrador=@$nombre_caja=@$por_iva=@$tipo_caja=@-Class-";
		
		
		for($i=0;$i<count($pago);$i++){
			$nombre_servicio=utf8_decode(trim($pago[$i]['nombre_servicio']));
			$tipo_costo=trim($pago[$i]['tipo_costo']);
			$descu=trim($pago[$i]['descu'])+0;
			$fecha=trim($pago[$i]['fecha_inst']);
			$fechaN=explode("-",$fecha);
			$mes=formato_mes($fechaN[1]);
			$anio=$fechaN[0];
			if($tipo_costo=='COSTO MENSUAL'){
				if($nombre_servicio=='MENSUALIDAD' || $nombre_servicio=='MENSUALIDAD NUEVA')
					$nombre_servicio='CABLE';
				else if($nombre_servicio=='PUNTOS ADICIONALES')
					$nombre_servicio='P.A.';
					
				$nombre_servicio=$mes." ".$anio." (".$nombre_servicio.")";
			}
			
			$cant_serv=trim($pago[$i]['cant_serv']);
			$costo_cobro=trim($pago[$i]['costo_cobro']);
			$total=$cant_serv*$costo_cobro;
			$suma=$suma+$total;
			
			$costo_cobro=number_format($costo_cobro, 2, ',', '.');
			//$total=number_format($total, 2, ',', '.');
			
			//$alto+=$inter;
			//$this->add("$nombre_servicio",$x1,$alto);
			//$this->add("$cant_serv",304,$alto);
			//$this->add("$costo_cobro",360,$alto);
			//$this->add("$total",430,$alto);
			//echo str_replace(",","","=@$nombre_servicio=@$total-Class-");
			$cad="=@$nombre_servicio=@$total=@1=@$descu=@-Class-";
			for($j=0;$j<count($caden);$j++){
				$a=$caden[$j];
				$b=$mejor[$j];
				$cad=str_replace($a,$b,$cad);
			}
			//echo $cad;
			$cad_fiscal=$cad_fiscal.$cad;
			//echo "=@$nombre_servicio=@$total-Class-";
		}
		echo $cad_fiscal."-Fiscal-";
		
		
$acceso->objeto->ejecutarSql("select *from parametros where id_param='42' and id_franq='1'");
$row=row($acceso);
$tipo_facturacion=trim($row['valor_param']);
		if(tipo_facturacion=="BIXOLON"){
			crearticket($cad_fiscal);
		}
		else if(tipo_facturacion=="EPSON"){
			crearticket_epson($cad_fiscal);
		}
		
	}
}

function crearticket_epson($cad_fiscal){
session_start();
$ini_u = $_SESSION["$ini_u"]; 
$cad = $cad_fiscal;
//echo ":$nombre_empresa:";
$items=explode("-Class-",$cad);

$datos=explode("=@",$items[0]);
$sesion=trim($datos[18]);
if($sesion=='PRINCIPAL'){
  
  $dir='DIR: '.$datos[6].'; '.$datos[7].' N'.$datos[8];
  
  $dir=substr($dir,0,36);
  $dir=str_replace(",",";",$dir);
  
  $id = fopen("notas/$ini_u"."ArchivoFactura.txt","w+");	
 // $id = fopen("inif.txt","w+");		
	$cad='<ABRIR_CF,'.substr($datos[3],0,25).','.$datos[2].'>
<TEXTO_CF,CONTRATO: '.$datos[4].'       REF: '.$datos[1].',0>
<TEXTO_CF,'.$dir.',0>';
if(trim($datos[12])!='EFECTIVO'){
	//$cad=$cad.'<TEXTO_CF,BANCO: '.$datos[13].' NRO: '.$datos[14].',0>';
}
$cad=$cad.'
<TEXTO_CF,VEND: '.$datos[15].'       '.$datos[16].',0>';

$porc_iva=trim($datos[17]);
  $por=$porc_iva/100;
  for($i=1;$i<count($items)-1;$i++){
	$dato=explode("=@",$items[$i]);
	
	
	$total_c=$dato[2]*$dato[3];
	$cant="1000";
	
	//$total_c=1;
	$porc=$por+1;
	$base=$total_c/$porc;
	$base=number_format($base, 2, '', '');
	
	$cad=$cad.'
<ITEM_CF,'.substr($dato[1],0,18).','.$cant.','.$base.',2,0>';
  }
  



$cad=$cad.'
<CERRAR_CF>
<END>
	';
	fwrite($id,$cad);
		
	fclose ($id);
	
//echo exec("C:\wamp\www\fiscal\POSFIS.EXE");
	include "notas/$ini_u"."ArchivoFactura.txt";
}
}

function crearticket($cad_fiscal){
$ini_u = $_SESSION["ini_u"]; 
$cad = $cad_fiscal;
//echo ":$nombre_empresa:";
$items=explode("-Class-",$cad);

$datos=explode("=@",$items[0]);
$sesion=trim($datos[18]);
if($sesion=='PRINCIPAL'){
  
  $id = fopen("notas/$ini_u"."ArchivoFactura.txt","w+");		
	$cad='i01Cliente:
i02'.substr($datos[3],0,40).'
i03CEDULA/RIF: '.$datos[2].'  Codigo: '.$datos[4].'
i04Dir: '.substr($datos[6].'; '.$datos[7].'; '.$datos[8],0,40).'
i05REF: '.$datos[1].'
i06Forma de Pago: '.$datos[12].'
i07Cob: '.$datos[15].'; '.$datos[16].'';
if(trim($datos[12])!='EFECTIVO'){
	//$cad=$cad.'<TEXTO_CF,BANCO: '.$datos[13].' NRO: '.$datos[14].',0>';
}

$porc_iva=trim($datos[17]);
  $por=$porc_iva/100;
  for($i=1;$i<count($items)-1;$i++){
	$dato=explode("=@",$items[$i]);

	$total_c=$dato[2]*$dato[3];
//	$total_c=$total_c/1.12;
	$descuen=$dato[4];
	$descu=$dato[4];
	$descu=number_format($descu,2, '', '');
	
	//$porc= ($descu/$total_c)*100;
	//$porc_des=number_format($porc+0,2, '', '');

	$cant="00001000";

	//$total_c=1;
	//$porc=$por+1;
	$base=$total_c;
	
	$base1=$base+0;
	//echo ";$base;$base1;";
	$base=number_format($base,2, '', '');
	
	//$base1=number_format($base,2, '', '.');
	$cont='';
	//echo ":$base:$base1:";
		if($base1<=9.9999){
			$cont="0".$cont;
		}
		if($base1<=99.9999){
			$cont="0".$cont;
		}
		if($base1<=999.9999){
			$cont="0".$cont;
		}
		if($base1<=9999.9999){
			$cont="0".$cont;
		}
		if($base1<=99999.9999)
			$cont="0".$cont;
		if($base1<=999999.9999)
			$cont="0".$cont;
		if($base1<=9999999.9999)
			$cont="0".$cont;

		//ECHO "<br>:$cont:$base:$cant:";	
/*
$monto_iva = $datos[22]+0;		
if($monto_iva>0){
*/
	$cad=$cad.'
!'.$cont.''.$base.$cant.$dato[1].'';
/*
}else{
		$cad=$cad.'
| |'.$cont.''.$base.$cant.$dato[1].'';
}
*/


		$conta='';
		if($descuen<10)
			$conta="0".$conta;
		if($descuen<100)
			$conta="0".$conta;
		if($descuen<1000)
			$conta="0".$conta;
		if($descuen<10000)
			$conta="0".$conta;
		if($descuen<100000)
			$conta="0".$conta;
		if($descuen<1000000)
			$conta="0".$conta;
		
 if($descu>0){
 
		$cad=$cad.'
q-'.$conta.$descu.'';
	}
		
		
/*
 if($desc_pago>0){
$cad=$cad.'
p-0500';
}
*/
  }
 /*
$desc_pago = $datos[21]+0;
$descuen = $datos[21]+0;

echo "desc:$desc_pago:";


		$conta='';
		if($descuen<10)
			$conta="0".$conta;
		if($descuen<100)
			$conta="0".$conta;
		if($descuen<1000)
			$conta="0".$conta;
		if($descuen<10000)
			$conta="0".$conta;
		if($descuen<100000)
			$conta="0".$conta;
		if($descuen<1000000)
			$conta="0".$conta;
		
 if($desc_pago>0){
 
		$cad=$cad.'
q-'.$conta.$desc_pago.'';
	}
*/
 if($datos[12]=="CHEQUE"){
	$cad=$cad.'
102
	';
 }
 else if($datos[12]=="TARJETA DE DEBITO"){
	$cad=$cad.'
103
	';
 }else if($datos[12]=="TARJETA DE CREDITO"){
	$cad=$cad.'
104
	';
 }
 else if($datos[12]=="DEPOSITO"){
	$cad=$cad.'
105
	';
 }
 else if($datos[12]=="TRANSFERENCIA"){
	$cad=$cad.'
106
	';
 }
 else if($datos[12]=="DOMICILIACIONES"){
	$cad=$cad.'
107
	';
 }
 else{
$cad=$cad.'
101
	';
}
	fwrite($id,$cad);
		
	fclose ($id);
	
	include "notas/$ini_u"."ArchivoFactura.txt";
}

}//function


?>