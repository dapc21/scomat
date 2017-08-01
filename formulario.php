<?php
require_once("DataBase/Acceso.php");
$acceso=conexion();
if($acceso)
{
	session_start();
	$valor=explode("=@",$_POST['d']);
	$clase=$valor[0];
	if($_SESSION["autenticacion"]!="On"){
		if($clase=='Sesion')
			include "Formulario/Sesion.php";
		else
			echo "SecurityFalse";
	}
	else{
		switch($clase)
		{
		
		case Sesion:
			include "Formulario/Sesion.php";
			break;
		case Usuario:
			include "Formulario/Usuario.php";
			break;
		case Perfil:
			include "Formulario/Perfil.php";
			break;
		case Modulo:
			include "Formulario/Modulo.php";
			break;
		case Persona:
			include "Formulario/Persona.php";
			break;
		case cobrador:
			include "Formulario/cobrador.php";
			break;
		case vendedor:
			include "Formulario/vendedor.php";
			break;
		case cliente:
			include "Formulario/cliente.php";
			break;
		case tecnico:
			include "Formulario/tecnico.php";
			break;
		case tipo_orden:
			include "Formulario/tipo_orden.php";
			break;
		case detalle_orden:
			include "Formulario/detalle_orden.php";
			break;
		case ordenes_tecnicos:
			include "Formulario/ordenes_tecnicos.php";
			break;
		case franquicia:
			include "Formulario/franquicia.php";
			break;
		case parametros:
			include "Formulario/parametros.php";
			break;
		case calle:
			include "Formulario/calle.php";
			break;
		case sector:
			include "Formulario/sector.php";
			break;
		case zona:
			include "Formulario/zona.php";
			break;
		case tipo_servicio:
			include "Formulario/tipo_servicio.php";
			break;
		case servicios:
			include "Formulario/servicios.php";
			break;
		case tarifa_servicio:
			include "Formulario/tarifa_servicio.php";
			break;
		case contrato_servicio:
			include "Formulario/contrato_servicio.php";
			break;
		case contrato:
			include "Formulario/contrato.php";
			break;
		case pago_servicio:
			include "Formulario/pago_servicio.php";
			break;
		case pagos:
			include "Formulario/pagos.php";
			break;
		case detalle_tipopago:
			include "Formulario/detalle_tipopago.php";
			break;
		case tipo_pago:
			include "Formulario/tipo_pago.php";
			break;
		case cirre_diario:
			include "Formulario/cirre_diario.php";
			break;
		case cierre_pago:
			include "Formulario/cierre_pago.php";
			break;
		case caja:
			include "Formulario/caja.php";
			break;
		case caja_cobrador:
			include "Formulario/caja_cobrador.php";
			break;
		case reclamo_denuncia:
			include "Formulario/reclamo_denuncia.php";
			break;
		case comentario_cliente:
			include "Formulario/comentario_cliente.php";
			break;
		case pago_comisiones:
			include "Formulario/pago_comisiones.php";
			break;
		case Rep_detallecobros:
			include "Formulario/Rep_detallecobros.php";
			break;
		case Rep_CierreDiario:
			include "Formulario/Rep_CierreDiario.php";
			break;
		case Rep_orden:
			include "Formulario/Rep_orden.php";
			break;
		case status_contrato:
			include "Formulario/status_contrato.php";
			break;
		case Rep_libroventa:
			include "Formulario/Rep_libroventa.php";
			break;
		case Rep_totalclientes:
			include "Formulario/Rep_totalclientes.php";
			break;
		case edificio:
			include "Formulario/edificio.php";
			break;
		case banco:
			include "Formulario/banco.php";
			break;
		case Rep_estadocuenta:
			include "Formulario/Rep_estadocuenta.php";
			break;
		case Rep_historialpago:
			include "Formulario/Rep_historialpago.php";
			break;
		case Rep_PERFILES:
			include "Formulario/Rep_PERFILES.php";
			break;
		case Rep_zona:
			include "Formulario/Rep_zona.php";
			break;
		case Rep_sector:
			include "Formulario/Rep_sector.php";
			break;
		case Rep_calle:
			include "Formulario/Rep_calle.php";
			break;
		case Rep_ORDENESTECNICOS:
			include "Formulario/Rep_ORDENESTECNICOS.php";
			break;
		case grupo_trabajo:
			include "Formulario/grupo_trabajo.php";
			break;
		case grupo_tecnico:
			include "Formulario/grupo_tecnico.php";
			break;
		case orden_grupo:
			include "Formulario/orden_grupo.php";
			break;
		case sms:
			include "Formulario/sms.php";
			break;
		case envio_aut:
			include "Formulario/envio_aut.php";
			break;
		case comandos_sms:
			include "Formulario/comandos_sms.php";
			break;
		case formato_sms:
			include "Formulario/formato_sms.php";
			break;
		case config_sms:
			include "Formulario/config_sms.php";
			break;
		case gerentes_permitidos:
			include "Formulario/gerentes_permitidos.php";
			break;
		case variables_sms:
			include "Formulario/variables_sms.php";
			break;
		case otros_datos:
			include "Formulario/otros_datos.php";
			break;
		case familia:
			include "Formulario/familia.php";
			break;
		case graficoIngresoDeuda:
			include "Formulario/graficoIngresoDeuda.php";
			break;
		case graficoIngresoDeudaMes:
			include "Formulario/graficoIngresoDeudaMes.php";
			break;
		case graficoAbonado:
			include "Formulario/graficoAbonado.php";
			break;
		case graficoAbonadoMes:
			include "Formulario/graficoAbonadoMes.php";
			break;
		case graficoOrdenAsignada:
			include "Formulario/graficoOrdenAsignada.php";
			break;
		case graficoOrdenAsignadaMes:
			include "Formulario/graficoOrdenAsignadaMes.php";
			break;
		case graficoOrdenImpresa:
			include "Formulario/graficoOrdenImpresa.php";
			break;
		case graficoOrdenImpresaMes:
			include "Formulario/graficoOrdenImpresaMes.php";
			break;
		case graficoOrdenFinalizada:
			include "Formulario/graficoOrdenFinalizada.php";
			break;
		case graficoOrdenFinalizadaMes:
			include "Formulario/graficoOrdenFinalizadaMes.php";
			break;
		default:
			include "Formulario/$clase.php";
		}
		
	}
}
else{
	include "Formulario/Configuracion.php";
}
?>