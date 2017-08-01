<?php require_once "procesos.php"; $ini_u = $_SESSION["ini_u"];  
session_start();

	$id_f = $_SESSION["id_franq"]; 
	//echo ":$id_f:";
	$consult="";
	$acceso->objeto->ejecutarSql("SELECT nombre_franq FROM franquicia where id_franq='$id_f' ");
	if($row=row($acceso)){
		$nombre_franq=trim($row["nombre_franq"]);
	}
				
	if($id_f!='0'){
		$consult=" and  id_franq='$id_f'";
		$consult_g=" and  (id_franq='$id_f' or id_franq='0') ";
		$consult_fw=" where id_franq='$id_f'";
		$titulo_cierre="CIERRE DIARIO DE $nombre_franq";
	}
	else{
		$titulo_cierre='CIERRE DIARIO GENERAL';
	//	echo ":$id_f:";
		$consult_g=" and  id_franq='0'";
	}
	
	
//	echo $consult;
require_once "Seguridad/Usuario.php";
$obj=new Usuario('','','','','');

if($obj->permisoModulo($acceso,strtoupper('cirre_diario')))
{

	$fecha= date("Y-m-d");
$acceso->objeto->ejecutarSql("select * from cirre_diario where fecha_cierre='$fecha' $consult_g");
if($acceso->objeto->registros>0)
	echo '<div class="alert alert-danger alert-block col-lg-12 col-md-12 col-sm-12 col-xs-12" >
		<h4 class="titulo-alerta"><i class="fa fa-times-circle"></i> <strong> Error! </strong> </h4>
		<ul class="contenido-alerta">
		<li> Ya se realizó el Cierre del día de hoy. </li> 
		<ul>
		</p>
		</div>';
else{

	$cable=conexion();
	$cierre_est_abi=false;
	$cable->objeto->ejecutarSql("SELECT id_franq,id_est FROM caja_cobrador,caja where caja_cobrador.id_caja=caja.id_caja and fecha_caja='$fecha' $consult group by id_franq,id_est");
		while($row=row($cable)){
			$id_est=trim($row["id_est"]);
			$id_franq=trim($row["id_franq"]);
			$acceso->objeto->ejecutarSql("select * from cirre_diario_et where fecha_cierre='$fecha' $consult ");
			if(!$acceso->objeto->registros>0){
				$cierre_est_abi=true;
					/*
					echo '<div class="alert alert-danger alert-block col-lg-12 col-md-12 col-sm-12 col-xs-12" >
		<h4 class="titulo-alerta"><i class="fa fa-times-circle"></i> <strong> Error! </strong> </h4>
		<ul class="contenido-alerta">
		<li> debe realizar los Cierres de Estacion para poder realizar el Cierre Ciario </li> 
		<ul>
		</p>
		</div>';
					*/
					
			//	return;
			}
		}
	
?>
<form role="form" name="f1" id="form_cierre_diario" >

<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">

	<div class="border-head"><h3>Cierre Diario General</h3></div>
	
	<section class="panel">

		<header class="panel-heading">Datos del <?php echo $titulo_cierre;?></header>
		
		<div class="panel-body">
		
		<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
		
		<input  type="hidden" name="id_f" maxlength="12" size="30" value="<?php  echo $id_f; ?>">
		<input  type="hidden" name="id_cierre" maxlength="12" size="30"onChange="validarcirre_diario();" value="<?php $acceso->objeto->ejecutarSql("select * from cirre_diario  where (id_cierre ILIKE '$ini_u%') ORDER BY id_cierre desc"); echo $ini_u.verCodLong($acceso,"id_cierre")?>">
		
		<div class="form-group col-lg-3 col-md-6 col-sm-6 col-xs-12">
		<label>Fecha</label>
		<input class="form-control" disabled type="text" name="fecha_cierre" id="fecha_cierre" maxlength="10" size="10" value="<?php echo date("d/m/Y");?>" >
		</div>
		
		<div class="form-group col-lg-3 col-md-6 col-sm-6 col-xs-12">
		<label>Hora</label>
		<input class="form-control" disabled type="text" name="hora_cierre" maxlength="10" size="10" value="<?php echo date("H:i:s");?>" >
		</div>
		
		<div class="form-group col-lg-3 col-md-6 col-sm-6 col-xs-12">
		<label>Monto</label>
		<input class="form-control" disabled type="text" name="monto_total" maxlength="10" size="10" value="<?php echo calMontoCDCA($acceso,date("Y-m-d"),$id_f); ?>" >
		</div>
		
		<input type="hidden" name="dato" maxlength="10" size="20" value="">
		
		<div class="form-group col-lg-3 col-md-6 col-sm-6 col-xs-12">
		<label>Franquicia</label>
		<select class="form-control" disabled name="id_franq" id="id_franq">
			<?php echo verFranquicia($acceso);?>
		</select>
		</div>
		
		<div class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12">
		<label>Observación</label>
		<textarea class="form-control" name="obser_cierre" cols="1" rows="2"></textarea>
		</div>
		
		</div>
		
		</div> <!-- FIN DEL PANEL -->
				
	</section>
	<section class="panel">
	
		<div class="panel-body">

			<div class="form-btn col-lg-12 col-md-12 col-sm-12 col-xs-12" align="center">
			<?php
				$acceso->objeto->ejecutarSql("select * from vista_caja where fecha_caja='$fecha' and status_caja_cob='Abierta' $consult");
				if($acceso->objeto->registros>0){
					echo '<div class="alert alert-danger alert-block col-lg-12 col-md-12 col-sm-12 col-xs-12" >
					<h4 class="titulo-alerta"><i class="fa fa-times-circle"></i> <strong> Error! </strong> </h4>
					<ul class="contenido-alerta">
					<li> Para realizar el Cierre Diario se deben cerrar los demás Puntos de Cobro (Cajas). </li> 
					<ul>
					</p>
					</div>';
				}else{
					if($cierre_est_abi==true){
						echo '<div class="alert alert-danger alert-block col-lg-12 col-md-12 col-sm-12 col-xs-12" >
						<h4 class="titulo-alerta"><i class="fa fa-times-circle"></i> <strong> Error! </strong> </h4>
						<ul class="contenido-alerta">
						<li> Para realizar el Cierre Diario se deben cerrar todas las Estaciones de Trabajo. </li> 
						<ul>
						</p>
						</div>';
					}
					else{
			?>
				<button class="btn btn-success" type="<?php echo $obj->in; ?>" name="registrar" value="<?php echo _("registrar cierre");?>" onclick="verificar('incluir','cirre_diario')"><i class="glyphicon glyphicon-ok"></i> Registrar Cierre</button>
			<?php
					}
				}
			?>
				<input type="hidden" name="modificar" value="<?php echo _("modificar");?>" onclick="verificar('modificar','cirre_diario')">
				<input type="hidden" name="eliminar" value="<?php echo _("eliminar");?>" onclick="verificar('eliminar','cirre_diario')">
				<button class="btn btn-info" type="button" name="salir" onclick="conexionPHP('formulario.php','cirre_diario')" value="<?php echo _("limpiar");?>"><i class="glyphicon glyphicon-repeat"></i> Limpiar</button>
				<button class="btn btn-warning" type="<?php echo $obj->in; ?>" name="registrar" value="<?php echo _("IMPRIMIR PAGOS");?>" onclick="verpagosrealizado();"><i class="glyphicon glyphicon-print"></i> Imprimir Pagos</button>
			</div>
			
		</div> <!-- FIN DEL PANEL -->
	
	</section>
	
</div> <!-- FIN DE LA COLUMNA GENERAL PARA EL FORMULARIO -->

</form> <!-- FIN DEL FORMULARIO -->		

  <?php
	//$acceso->objeto->ejecutarSql("SELECT count(*) cant, sum(base_imp + desc_pago ) as exento FROM pagos,caja_cobrador, caja where caja_cobrador.id_caja= caja.id_caja $consult  and pagos.id_caja_cob=caja_cobrador.id_caja_cob and monto_iva=0  and fecha_pago='$fecha' ");
	$tipo_caja=verCajaPrincipal($acceso);

	$acceso->objeto->ejecutarSql("SELECT count(*) cant, sum(monto_pago) as exento FROM pagos,caja_cobrador , caja where caja_cobrador.id_caja= caja.id_caja $consult and pagos.id_caja_cob=caja_cobrador .id_caja_cob and  monto_iva=0  and fecha_pago='$fecha'   AND status_pago='PAGADO' ");
	if($row=row($acceso)){
		$cant=trim($row["cant"]);
		$exento=trim($row["exento"]);
	}

	$acceso->objeto->ejecutarSql("SELECT count(*) cant, sum(base_imp) as base_imp, sum(monto_iva) as monto_iva FROM pagos,caja_cobrador , caja where caja_cobrador.id_caja= caja.id_caja $consult and  pagos.id_caja_cob=caja_cobrador .id_caja_cob and  monto_iva>0  and fecha_pago='$fecha'   AND status_pago='PAGADO' ");

	if($row=row($acceso)){
		$cant=trim($row["cant"]);
		$base_imp=trim($row["base_imp"]);
	}
	
	$acceso->objeto->ejecutarSql("SELECT count(*) cant,  sum(monto_iva) as monto_iva FROM pagos ,caja_cobrador , caja where caja_cobrador.id_caja= caja.id_caja $consult and  pagos.id_caja_cob=caja_cobrador .id_caja_cob and  monto_iva>0  and fecha_pago='$fecha'   AND status_pago='PAGADO' ");

	if($row=row($acceso)){
		$cant=trim($row["cant"]);
		$monto_iva=trim($row["monto_iva"]);
	}
				
	$total_ingreso=$base_imp+$monto_iva+$exento;
	
	$acceso->objeto->ejecutarSql("SELECT count(*) cant, sum(base_imp + monto_iva ) as total_nc FROM pagos,caja_cobrador , caja where caja_cobrador.id_caja= caja.id_caja $consult and  pagos.id_caja_cob=caja_cobrador .id_caja_cob and id_est='$id_est' and fecha_pago='$fecha' and fecha_factura='$fecha' and  status_pago='NOTA CREDITO'");
	if($row=row($acceso)){
		$cant=trim($row["cant"]);
		$total_nc_dia=trim($row["total_nc"]);
	}
				
	$acceso->objeto->ejecutarSql("SELECT count(*) cant, sum(base_imp + monto_iva ) as total_nc FROM pagos ,caja_cobrador , caja where caja_cobrador.id_caja= caja.id_caja $consult and  pagos.id_caja_cob=caja_cobrador .id_caja_cob  and fecha_pago='$fecha' and fecha_factura<'$fecha' and  status_pago='NOTA CREDITO'");
	if($row=row($acceso)){
		$cant=trim($row["cant"]);
		$total_nc=trim($row["total_nc"]);
	}
	
	$total_facturado=$total_ingreso-$total_nc-$total_nc_dia;
  
 // $fecha=date("Y-m-d");
echo '
<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">

<section class="panel">

<header class="panel-heading">Resúmen de Facturación</header>
	
	<div class="panel-body">
	
	<table class="table table-condensed">
	  <thead>
	  <tr class="titulo-tabla">
		  <th>SERVICIO</th>
		  <th class="numeric">CANTIDAD</th>
		  <th class="numeric">TOTAL</th>
	  </tr>
	  </thead>
	  <tbody>
	  <tr>
		  <td>FACTURAS (EXENTAS)</td>
		  <td class="numeric">'.$cantexento.'</td>
		  <td class="numeric">'.number_format($exento+0, 2, ',', '.').'</td>
		</tr>
		<tr>
		  <td>FACTURAS (BASE IMPONIBLE)</td>
		  <td class="numeric">'.$cantbase_imp.'</td>
		  <td class="numeric">'.number_format($base_imp+0, 2, ',', '.').'</td>
		</tr>
		<tr>
		  <td>IVA (12%)</td>
		  <td class="numeric">'.$cantmonto_iva.'</td>
		  <td class="numeric">'.number_format($monto_iva+0, 2, ',', '.').'</td>
		</tr>
		<tr class="total-tabla">
		  <td>TOTAL INGRESO</td>
		  <td class="numeric">'.$cant_ingreso.'</td>
		  <td class="numeric">'.number_format($total_ingreso+0, 2, ',', '.').'</td>
		</tr>
		<tr>
		  <td>NOTAS DE CREDITOS DEL DÍA</td>
		  <td class="numeric">'.$canttotal_nc_dia.'</td>
		  <td class="numeric">-'.number_format($total_nc_dia+0, 2, ',', '.').'</td>
		</tr>
		<tr>
		  <td>NOTAS DE CREDITOS DE DIAS ANTERIORES</td>
		  <td class="numeric">'.$canttotal_nc.'</td>
		  <td class="numeric">-'.number_format($total_nc+0, 2, ',', '.').'</td>
		</tr>
		<tr class="total-tabla">
		  <td>TOTAL FACTURADO</td>
		  <td class="numeric"> </td>
		  <td class="numeric">'.number_format($total_facturado+0, 2, ',', '.').'</td>
		</tr>

		</tbody>
		</table>
	
	</div>
	
</section>
	
</div>
';

echo '
<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">

<section class="panel">

<header class="panel-heading">Resúmen por Forma de Pago</header>
	
	<div class="panel-body">
	
	<table class="table table-condensed">
	  <thead>
	  <tr class="titulo-tabla">
		  <th>FORMA DE PAGO</th>
		  <th class="numeric">CANTIDAD</th>
		  <th class="numeric">TOTAL</th>
	  </tr>
	  </thead>
	  <tbody>';
			 
	$dato=lectura($acceso,"SELECT *FROM tipo_pago ORDER BY id_tipo_pago");
	$suma_c=0;
	$suma_can=0;
			 
	for($k=0;$k<count($dato);$k++){
		$id_tipo_pago=trim($dato[$k]["id_tipo_pago"]);
		$acceso->objeto->ejecutarSql("SELECT sum(monto_tp) as monto_tp, count(*) as cant FROM vista_tipopago where fecha_pago='$fecha'  $consult and id_tipo_pago='$id_tipo_pago' and status_pago='PAGADO'   and obser_pago<>'NOTA CREDITO' ");
		$suma=0;
		if($row=row($acceso))
		{
			$monto_tp=trim($row["monto_tp"])+0;
			$cant=trim($row["cant"])+0;
			$suma_c+=$monto_tp;
			$suma_can+=$cant;

			echo '
			<tr>
				<td>'.trim($dato[$k]["tipo_pago"]).'</td>
				<td class="numeric">'.$cant.'</td>
				<td class="numeric">'.number_format($monto_tp+0, 2, ',', '.').'</td>
			</tr>';
	  
		}
	}

echo '
	  <tr class="total-tabla">
		  <td>TOTAL FORMA DE PAGO</td>
		  <td class="numeric">'.$suma_can.'</td>
		  <td class="numeric">'.number_format($suma_c+0, 2, ',', '.').'</td>
	  </tr>
	  
	  </tbody>
	</table>
	
	</div>
	
</section>
	
</div>
';


require 'include/eyedatagrid/class.eyepostgresadap.inc.php';
require 'include/eyedatagrid/class.eyedatagrid.inc.php';
$x = new EyeDataGrid($db);

$x->setQuery("id_cierre,nombre_est,reporte_z,fecha_cierre,hora_cierre,monto_total","estacion_trabajo,cirre_diario_et",""," estacion_trabajo.id_est=cirre_diario_et.id_est and fecha_cierre='$fecha' $consult ");
$x->hideColumn('id_cierre');
$x->hideColumn('apellido');
$x->setColumnHeader("nombre_est", _("Estación"));
$x->setColumnHeader("reporte_z", _("Rep. Z"));
$x->setColumnHeader("hora_cierre", _("Hora"));
$x->setColumnHeader("fecha_cierre", _("Fecha"));
$x->setColumnHeader("apertura_caja", _("Hora Apertura"));
$x->setColumnHeader("cierre_caja", _("Hora Cierre"));
$x->setColumnHeader("monto_total", _("TOTAL"));

$x->setColumnType('fecha_caja', EyeDataGrid::TYPE_DATE, 'd/m/Y',true);

$x->setClase("CierreDiario");
$x->addStandardControl(EyeDataGrid::STDCTRL_SAVE, "ImprimirRep_CierreEquipo('%id_cierre%')");
$x->hideOrder();
//$x->showRowNumber();
$x->setResultsPerPage(10);

echo '
	<div class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12">
		<section class="panel" id="tabla-cierre-dario-general">
		<header class="panel-heading">Datos de las Estaciones de Trabajo</header>
		<div class="panel-body">
	 ';
	$x->printTable();
echo '
		</div>
		</section>
	</div>
';			
 
}
 
	}
	else{
		echo '<p align="center"><img   style="background:#FFFFFF" src="imagenes/Error.jpg" width="255px" height="255px" /></p><br>
		<div align="center">
					<input  type="button" name="iniciar_sesion" value="INICIAR SESI&Oacute;N" onclick="conexionPHP(\'formulario.php\',\'Sesion\')">&nbsp;
				</div>
		';
	}
?>