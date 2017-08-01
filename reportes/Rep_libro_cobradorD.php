<?php
require_once("../procesos.php");  $ini_u = $_SESSION["ini_u"]; 
require '../include/eyedatagrid/class.eyepostgresadap.inc.php';
require '../include/eyedatagrid/class.eyedatagrid.inc.php';
$x = new EyeDataGrid($db);

//$tipo_caja=verCajaPrincipal($acceso);
//echo $tipo_caja;	

$desde = $_GET['desde'];
$hasta = $_GET['hasta'];
$id_persona_cob = $_GET['id_persona'];
if($id_persona_cob!="TODOS"){
	$where_c= " and id_persona_cob='$id_persona_cob'";
}
//echo "hola:$id_persona_cob:";


$x->setQuery("id_caja_cob,nombre_caja,apellido,monto_acum,nombre,fecha_caja,apertura_caja,cierre_caja","vista_caja","","fecha_caja between '$desde' and '$hasta' $where_c and status_caja_cob='CERRADA'");
$x->hideColumn('id_caja_cob');
$x->hideColumn('apellido');
$x->setColumnHeader("nombre_caja", _("punto de cobro");
$x->setColumnHeader("monto_acum", _("monto");
$x->setColumnHeader("nombre", _("cobrador");
$x->setColumnHeader("fecha_caja", _("fecha");
$x->setColumnHeader("apertura_caja", _("hora apertura");
$x->setColumnHeader("cierre_caja", _("hora cierre");

$x->setColumnType('fecha_caja', EyeDataGrid::TYPE_DATE, 'd/m/Y',true);

$x->setClase("CierreDiario");
//$x->addRowSelect("ImprimirRep_detcob('%id_caja_cob%')");
$x->addStandardControl(EyeDataGrid::STDCTRL_PRINT, "ImprimirRep_detcob('%id_caja_cob%')");
$x->addStandardControl(EyeDataGrid::STDCTRL_SAVE, "GuardarRep_detcob('%id_caja_cob%')");
$x->hideOrder();
$x->showRowNumber();

//mostrar resultados por pagina
if(isset($_GET['tblresul'])){
	if (trim($_GET['tblresul'])>0) {
	   $x->setResultsPerPage(trim($_GET['tblresul']));
	}
}
else{
	$acceso=conexion();
	$acceso->objeto->ejecutarSql("select valor_param from parametros where id_param='9'");
	if($row=$acceso->objeto->devolverRegistro()){
		if(trim($row["valor_param"])>0) {
		   $x->setResultsPerPage(trim($row["valor_param"]));
		}
	}
}

$x->printTable();		



$x->setQuery("inicial_doc,fecha_pago,nro_factura,cedulacli,nombrecli,monto_pago,monto_pago as base,monto_pago as iva,status_pago,tipo_cliente","vista_pago_cont","","fecha_pago between '$desde' and '$hasta' $where_c");
$x->hideColumn('inicial_doc');
$x->setColumnHeader("fecha_pago", -("fecha"));
$x->setColumnHeader("nro_factura", _("nro factura"));
$x->setColumnHeader("cedulacli", _("rif / cedula"));
$x->setColumnHeader("nombrecli", -("nombre"));
$x->setColumnHeader("monto_pago", _("total"));
$x->setColumnHeader("base", _("base"));
$x->setColumnHeader("iva", _("debito fiscal"));
$x->setColumnHeader("status_pago", _("status"));
$x->setColumnHeader("tipo_cliente", _("tipo cliente"));

$x->setColumnType('base', EyeDataGrid::TYPE_MONTO, '',true);
$x->setColumnType('iva', EyeDataGrid::TYPE_MONTO, '',true);
$x->setColumnType('monto_pago', EyeDataGrid::TYPE_MONTO, '',true);

$x->setColumnType('fecha_pago', EyeDataGrid::TYPE_DATE, 'd/m/Y',true);

$x->desde=$desde;
$x->hasta=$hasta;

//$x->setClase("rep_libroventa");
$x->allowFilters();
$x->showRowNumber();

//mostrar resultados por pagina
if(isset($_GET['tblresul'])){
	if (trim($_GET['tblresul'])>0) {
	   $x->setResultsPerPage(trim($_GET['tblresul']));
	}
}
else{
	$acceso=conexion();
	$acceso->objeto->ejecutarSql("select valor_param from parametros where id_param='9'");
	if($row=$acceso->objeto->devolverRegistro()){
		if(trim($row["valor_param"])>0) {
		   $x->setResultsPerPage(trim($row["valor_param"]));
		}
	}
}

$x->printTable();

		$acceso->objeto->ejecutarSql("SELECT *FROM parametros where id_param='2'");
		if($row=row($acceso)){
			$por_iva=trim($row['valor_param']);
		}

		$acceso->objeto->ejecutarSql("select sum(monto_pago) as total_p from vista_pago_cont where status_pago='PAGADO' and fecha_pago between '$desde' and '$hasta' $where_c");
		$row=row($acceso);
		$total_p=trim($row["total_p"]);
		
		$porc=($por_iva/100)+1;
		$base=$total_p/$porc;
		$iva=($base*$por_iva)/100;

echo '<br>
<table border="1" width="350px" align="center" cellspacing="0" cellpadding="0" > 
			<tr>
			  <td class="cabe"  colspan="2" align="center">
				'. _('resumen general').'
			  </td>		
			  			 
			 </tr>
			 <tr>
			  <td class="fuenteN" width="200px">
				'. _('total base').':
			  </td>		
			  <td class="fuenteN" ALIGN="right" >
			'.number_format($base+0, 2, ',', '.').'
			  </td>	
			 
			 </tr>
			 <tr>
			  <td class="fuenteN" width="200px">
				'. _('total iva').':
			  </td>		
			  <td class="fuenteN" ALIGN="right" >
				'.number_format($iva+0, 2, ',', '.').'
			  </td>	
			 
			 </tr>
			 <tr>
			  <td class="fuenteN" width="200px">
				'. _('total general').':
			  </td>		
			  <td class="fuenteN" ALIGN="right" >
			  
				';
				if($total_p!=0){ 
					echo number_format($total_p+0, 2, ',', '.');
				}
				else{
					echo "0,00";
				}
				echo '
			  </td>	
			 
			 </tr>
</table>
';
?>
