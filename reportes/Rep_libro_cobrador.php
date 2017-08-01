<?php
require_once("../procesos.php");  $ini_u = $_SESSION["ini_u"]; 
require '../include/eyedatagrid/class.eyepostgresadap.inc.php';
require '../include/eyedatagrid/class.eyedatagrid.inc.php';
$x = new EyeDataGrid($db);

//$tipo_caja=verCajaPrincipal($acceso);
//echo $tipo_caja;

	session_start();
	$id_f = $_SESSION["id_franq"]; 
	
	if($id_f!='0'){
		$consult=" and id_franq='$id_f'";
	}
	
$desde = $_GET['desde'];
$hasta = $_GET['hasta'];
$com = $_GET['com'];
$id_persona_cob = $_GET['id_persona'];
if($id_persona_cob!="TODOS" && $id_persona_cob!=""  && $id_persona_cob!="0" ){
	$where_c= " and id_persona_cob='$id_persona_cob'";
}
//echo "hola:$id_persona_cob:";



$x->setQuery("id_contrato,inicial_doc,fecha_pago,nro_factura,cedulacli,nombrecli,monto_pago,monto_pago as base,monto_pago as iva,status_pago,tipo_cliente","vista_pago_cont","","fecha_pago between '$desde' and '$hasta' $where_c $consult");
$x->hideColumn('inicial_doc');
$x->setColumnHeader("fecha_pago", _("fecha"));
$x->setColumnHeader("nro_factura", _("nro factura"));
$x->setColumnHeader("cedulacli", _("rif / cedula"));
$x->setColumnHeader("nombrecli", _("nombre"));
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

		
		
echo '
<table border="0" width="960px" align="CENTER"> 
<tr>
  
  
  <td width50%" valign="top">
	<fieldset >
		<legend >'. _('resumen de facturacion').'</legend>
			<table border="0" width="95%" align="left"> 
			<tr>
			  <td class="fuenteN" width="50%">
				'. _('descripcion').'
			  </td>		
			  <td class="fuenteN" ALIGN="center" width="25%">
				'. _('cant').'
			  </td>	
			  <td class="fuenteN" ALIGN="right" width="25%">
				'. _('total').'
			  </td>
			 </tr>
			 ';
				
				$acceso->objeto->ejecutarSql("SELECT count(*) cant, sum(base_imp + desc_pago ) as excento FROM pagos,vista_caja where pagos.id_caja_cob=vista_caja.id_caja_cob and id_persona='$id_persona_cob' and monto_iva=0 and fecha_pago between '$desde' and '$hasta' ");
				if($row=row($acceso)){
					$cant=trim($row["cant"]);
					$excento=trim($row["excento"]);
				}
		echo '
			<tr>
			  <td class="fuente" width="50%">
				'. _('FACTURAS (EXCENTAS)').'
			  </td>		
			  <td class="fuente" ALIGN="center" width="25%">
				'. $cant.'
			  </td>	
			  <td class="fuente" ALIGN="right" width="25%">
				'.number_format($excento+0, 2, ',', '.').'
			  </td>
			 </tr>';
			 
			 
			 $acceso->objeto->ejecutarSql("SELECT count(*) cant, sum(base_imp + desc_pago ) as base_imp, sum(monto_iva) as monto_iva FROM pagos,vista_caja where pagos.id_caja_cob=vista_caja.id_caja_cob and id_persona='$id_persona_cob' and  monto_iva>0 and fecha_pago between '$desde' and '$hasta' ");
			 
				if($row=row($acceso)){
					$cant=trim($row["cant"]);
					$base_imp=trim($row["base_imp"]);
					
				}
		echo '
			<tr>
			  <td class="fuente" width="50%">
				'. _('FACTURAS (BASE IMPONIBLE)').'
			  </td>		
			  <td class="fuente" ALIGN="center" width="25%">
				'. $cant.'
			  </td>	
			  <td class="fuente" ALIGN="right" width="25%">
				'.number_format($base_imp+0, 2, ',', '.').'
			  </td>
			 </tr>';
			 
				$acceso->objeto->ejecutarSql("SELECT count(*) cant,  sum(monto_iva) as monto_iva FROM pagos,vista_caja where pagos.id_caja_cob=vista_caja.id_caja_cob and id_persona='$id_persona_cob' and  monto_iva>0 and fecha_pago between '$desde' and '$hasta' ");
			 
				if($row=row($acceso)){
					$cant=trim($row["cant"]);
					$monto_iva=trim($row["monto_iva"]);
				}
		echo '
			<tr>
			  <td class="fuente" width="50%">
				'. _('IVA (12%)').'
			  </td>		
			  <td class="fuente" ALIGN="center" width="25%">
				'. $cant.'
			  </td>	
			  <td class="fuente" ALIGN="right" width="25%">
				'.number_format($monto_iva+0, 2, ',', '.').'
			  </td>
			 </tr>';
		
			$acceso->objeto->ejecutarSql("SELECT count(*) cant, sum(base_imp + monto_iva ) as total_nc FROM pagos,vista_caja where pagos.id_caja_cob=vista_caja.id_caja_cob and id_persona='$id_persona_cob' and fecha_pago between '$desde' and '$hasta' and  status_pago='ANULADO'");
				if($row=row($acceso)){
					$cant=trim($row["cant"]);
					$total_nc=trim($row["total_nc"]);
				}
		echo '
			<tr>
			  <td class="fuente" width="50%">
				'. _('NOTAS DE CREDITOS').'
			  </td>		
			  <td class="fuente" ALIGN="center" width="25%">
				'. $cant.'
			  </td>	
			  <td class="fuente" ALIGN="right" width="25%">-
				'.number_format($total_nc+0, 2, ',', '.').'
			  </td>
			 </tr>';
			 
			 $acceso->objeto->ejecutarSql("SELECT count(*) cant, sum(desc_pago) as desc_pago FROM pagos,vista_caja where pagos.id_caja_cob=vista_caja.id_caja_cob and id_persona='$id_persona_cob' and  desc_pago>0 and fecha_pago between '$desde' and '$hasta'");
				if($row=row($acceso)){
					$cant=trim($row["cant"]);
					$desc_pago=trim($row["desc_pago"]);
				}
		echo '
			<tr>
			  <td class="fuente" width="50%">
				'. _('DESCUENTOS').'
			  </td>		
			  <td class="fuente" ALIGN="center" width="25%">
				'. $cant.'
			  </td>	
			  <td class="fuente" ALIGN="right" width="25%">-
				'.number_format($desc_pago+0, 2, ',', '.').'
			  </td>
			 </tr>';
			
			$total_facturado=$excento+$base_imp+$monto_iva-$desc_pago-$total_nc;
		echo '
			<tr>
			  <td class="fuenteN" width="50%">
				'. _('TOTAL facturado').'
			  </td>		
			  <td class="fuenteN" ALIGN="center" width="25%">
				
			  </td>	
			  <td class="fuenteN" ALIGN="right" width="25%">
				'.number_format($total_facturado+0, 2, ',', '.').'
			  </td>
			 </tr>
			 
			 
			 </table>		
	</fieldset>
  </td>		
 
 <tr>
	<td width="50%" valign="top">
	<fieldset>
		<legend >'. _('resumen por servicios').'</legend>
			<table border="0" width="95%" align="left"> 
			<tr>
			  <td class="fuenteN" width="30%">
				'. _('servicio').'
			  </td>		
			  <td class="fuenteN" ALIGN="center" width="10%">
				'. _('cant').'
			  </td>	
			  <td class="fuenteN" ALIGN="right" width="20%">
				'. _('costo').'
			  </td>
			  <td class="fuenteN" ALIGN="right" width="20%">
				'. _('base imp').'
			  </td>
			  <td class="fuenteN" ALIGN="right" width="20%">
				'. _('total').'
			  </td>
			 </tr>
			 ';
			 $dato=lectura($acceso,"SELECT *FROM servicios where status_serv='ACTIVO'");
			 $totalG=0;
				$suma_c=0;
				$suma_d=0;
				$suma_can=0;
				$suma_base=0;
			for($k=0;$k<count($dato);$k++){
				$id_serv=trim($dato[$k]["id_serv"]);
				//echo "SELECT sum(costo_cobro*cant_serv) as costo_cobro,sum(descu) as descu, count(*) as cant FROM vista_pago_ser where  and id_persona='$id_persona_cob'  and fecha_pago between '$desde' and '$hasta' and id_serv='$id_serv'  and status_pago='PAGADO'";
				$acceso->objeto->ejecutarSql("SELECT sum(costo_cobro*cant_serv) as costo_cobro,sum(descu) as descu, count(*) as cant FROM vista_pago_ser where  id_persona='$id_persona_cob'  and fecha_pago between '$desde' and '$hasta' and id_serv='$id_serv'  and status_pago='PAGADO'");
				
				$cont=0;
				if($row=row($acceso)){
					$cant=trim($row["cant"]);
					$costo_cobro=trim($row["costo_cobro"])+0;
					$descu=trim($row["descu"]);
					$base=$costo_cobro-$descu;
					$total=$costo_cobro-$descu;
					$suma_c+=$costo_cobro;
					$suma_d+=$descu;
					$suma_base+=$base;
					$suma_can+=$cant;
				
				
					if($total>0){
						echo '<tr><td class="fuente">
							'.strtoupper(utf8_decode(trim($dato[$k]["nombre_servicio"]))).'
						  </td>
						  <td class="fuente" ALIGN="center">
							'.$cant.'
						  </td>	
						  <td class="fuente" ALIGN="right">
							'.number_format($costo_cobro+0, 2, ',', '.').'
						  </td>	
						  <td class="fuente" ALIGN="right">
							'.number_format($base+0, 2, ',', '.').'
						  </td>	
						  <td class="fuente" ALIGN="right">
							'.number_format($total+0, 2, ',', '.').'
						  </td>	
						  </tr>';
					
					
					}
				}
			}
			$total=$suma_c-$suma_d;
		echo '
			<tr>
			  <td class="fuenteN" width="200px" >
				'. _('total servicios').'
			  </td>		
			  <td class="fuenteN" ALIGN="center" width="50px">
				'.$suma_can.'
			  </td>	
			  <td class="fuenteN" ALIGN="right" width="80px">
				'.number_format($suma_c+0, 2, ',', '.').'
			  </td>		
			  <td class="fuenteN" ALIGN="right" width="80px">
				'.number_format($suma_base+0, 2, ',', '.').'
			  </td>		
			  <td class="fuenteN" ALIGN="right" width="80px">
				'.number_format($total+0, 2, ',', '.').'
			  </td>	
			 </tr>
			 ';
				$acceso->objeto->ejecutarSql("SELECT  sum(monto_iva) as monto_iva FROM pagos,vista_caja where pagos.id_caja_cob=vista_caja.id_caja_cob and id_persona='$id_persona_cob' and  monto_iva>0 and fecha_pago between '$desde' and '$hasta' and status_pago='PAGADO' ");
				if($row=row($acceso)){
					$monto_iva=trim($row["monto_iva"]);
				}
			 
			 ECHO '
			 
			 
			 
		</table>
	</fieldset>
  </td>		
 
  
 </tr>
 
 
</table>


';

		
		
		
?>
