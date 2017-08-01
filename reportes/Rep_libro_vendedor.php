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
$modo = $_GET['modo'];
$id_persona = $_GET['id_persona'];
//echo ":$id_persona:";
if($id_persona!="" && $id_persona!="TODOS"){
	$where_c= " and id_persona='$id_persona'";
}
//echo ":$where_c:";



$x->setQuery("id_contrato,nro_contrato,cedula,(nombre || ' ' || apellido) as nombre,fecha_contrato, status_contrato, costo_contrato,nombre_sector,nombre_zona","vista_contrato","","fecha_contrato between '$desde' and '$hasta' $where_c");
$x->hideColumn('inicial_doc');
$x->setColumnHeader("cedula", _("cedula"));
$x->setColumnHeader("id_persona", _("deuda"));
$x->setColumnHeader("nro_contrato", _("nro Cont"));
$x->setColumnHeader("cedula,", _("cedula"));
$x->setColumnHeader("nombre", _("cliente"));
$x->setColumnHeader("status_contrato", _("status"));
$x->setColumnHeader('nombre_calle', _("Calle"));
$x->setColumnHeader('nombre_sector', _("sector"));
$x->setColumnHeader('nombre_zona', _("zona"));
$x->setColumnHeader('nombre_zona', _("municipio"));
$x->setColumnHeader('nombre_zona', _("Zona"));
$x->setColumnHeader('nombre_franq', _("franquicia"));
$x->setColumnHeader('fecha_contrato', _("fecha"));
$x->setColumnHeader('costo_contrato', _("costo"));



$x->setColumnType('costo', EyeDataGrid::TYPE_MONTO, '',true);
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

		$acceso->objeto->ejecutarSql("select sum(costo_contrato) as total_p from contrato where fecha_contrato between '$desde' and '$hasta' $where_c");
		$row=row($acceso);
		$total_p=trim($row["total_p"]);
		
		$comision=($total_p*$com)/100;
		
		
		if($modo!='EXCEL'){
echo '<br>
<table border="1" width="350px" align="center" cellspacing="0" cellpadding="0" > 
			<tr>
			  <td class="cabe"  colspan="2" align="center">
				'. _('resumen general').'
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
	}
?>
