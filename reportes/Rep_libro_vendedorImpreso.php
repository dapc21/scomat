<?php
require_once("../procesos.php");  $ini_u = $_SESSION["ini_u"]; 
require '../include/eyedatagrid/class.eyepostgresadap.inc.php';
require '../include/eyedatagrid/class.eyedatagrid.inc.php';
$x = new EyeDataGrid($db);

//$tipo_caja=verCajaPrincipal($acceso);
//echo $tipo_caja;	

$desde = $_GET['desde'];
$hasta = $_GET['hasta'];
$com = $_GET['com'];
$id_persona_cob = $_GET['id_persona'];	
if($id_persona_cob!="TODOS"){
	$where_c= " and id_persona='$id_persona_cob'";
}
//echo "hola:$id_persona_cob:";



$x->setQuery("id_contrato,cedula,(nombre || ' ' || apellido) as nombrecli,fecha_contrato,nombre_zona, nombre_sector","vista_contrato","","fecha_contrato between '$desde' and '$hasta' $where_c");
$x->hideColumn('inicial_doc');
$x->setColumnHeader("fecha_contrato", _("fecha"));
$x->setColumnHeader("nro_factura", _("nro factura"));
$x->setColumnHeader("cedula", _("rif / cedula"));
$x->setColumnHeader("nombrecli", _("cliente"));
$x->setColumnHeader("monto_pago", _("total"));
$x->setColumnHeader("base", _("base"));
$x->setColumnHeader("iva", _("debito fiscal"));
$x->setColumnHeader("status_pago", _("status"));
$x->setColumnHeader("tipo_cliente", _("tipo cliente"));

$x->setColumnType('base', EyeDataGrid::TYPE_MONTO, '',true);
$x->setColumnType('iva', EyeDataGrid::TYPE_MONTO, '',true);
$x->setColumnType('monto_pago', EyeDataGrid::TYPE_MONTO, '',true);

$x->hideColumn('id_contrato');
$x->addStandardControl(EyeDataGrid::STDCTRL_VDATOS, "respRefActCont('%id_contrato%')");

$x->setColumnType('fecha_contrato', EyeDataGrid::TYPE_DATE, 'd/m/Y',true);

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
		$comision=($base*$com)/100;
		
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
				'. _('total iva ').'(12%):
			  </td>		
			  <td class="fuenteN" ALIGN="right" >
				'.number_format($iva+0, 2, ',', '.').'
			  </td>	
			 
			 </tr>
			  <tr>
			  <td class="fuenteN" width="200px">
				'. _('comision').' ('.$com.'%):
			  </td>		
			  <td class="fuenteN" ALIGN="right" >
				'.number_format($comision+0, 2, ',', '.').'
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
