<?php require_once "procesos.php"; $ini_u = $_SESSION["ini_u"];  
session_start();
	$id_f = $_SESSION["id_franq"]; 
	$consult=" and (id_franq='$id_f' or id_franq='0' )";
	//echo $consult;
require_once "Seguridad/Usuario.php";
$obj=new Usuario('','','','','');
if($obj->permisoModulo($acceso,strtoupper('CIERRE_ESTACION')))
{

$id_persona=$_SESSION["id_persona"];
	$fecha= date("Y-m-d");
	$fecha1=formatofecha($fecha);
	
	
	$fecha= date("Y-m-d");
	
	
	$acceso->objeto->ejecutarSql("select * from vista_caja where id_persona='$id_persona' and fecha_caja='$fecha'");
	if(!$row=row($acceso)){
		echo '<div class="error"><br>Error, la estacion de trabajo no esta asociada a una impresora fiscal</div>';
	}else{
		$id_est=trim($row["id_est"]);
		$estacion=opcion(trim($row["id_est"]),trim($row["nombre_est"]));
	}	
		
	$acceso->objeto->ejecutarSql("select * from estacion_trabajo where id_est='$id_est' and status_est='IMPRESORAFISCAL'");
	if(!$row=row($acceso)){
		echo '<div class="alert alert-danger alert-block col-lg-12 col-md-12 col-sm-12 col-xs-12" >
		<h4 class="titulo-alerta"><i class="fa fa-times-circle"></i> <strong> Error! </strong> </h4>
		<ul class="contenido-alerta">
		<li> La Estación de Trabajo no está asociada a una Impresora Fiscal. </li> 
		 <ul>
		</p>
		</div>';
	}else{
		$id_est=trim($row["id_est"]);
		$estacion=opcion(trim($row["id_est"]),trim($row["nombre_est"]));
		
		
$acceso->objeto->ejecutarSql("select * from cirre_diario where fecha_cierre='$fecha' $consult");
if($acceso->objeto->registros>0)
		echo '<div class="alert alert-danger alert-block col-lg-12 col-md-12 col-sm-12 col-xs-12" >
		<h4 class="titulo-alerta"><i class="fa fa-times-circle"></i> <strong> Error! </strong> </h4>
		<ul class="contenido-alerta">
		<li> Se realizó el cierre del día. </li> 
		 <ul>
		</p>
		</div>';
else{
		
$acceso->objeto->ejecutarSql("select * from cirre_diario_et where fecha_cierre='$fecha' and id_est='$id_est'  $consult");
if($acceso->objeto->registros>0)
		echo '<div class="alert alert-danger alert-block col-lg-12 col-md-12 col-sm-12 col-xs-12" >
		<h4 class="titulo-alerta"><i class="fa fa-times-circle"></i> <strong> Error! </strong> </h4>
		<ul class="contenido-alerta">
		<li> Se realizó el cierre de esta Estación de Trabajo. </li> 
		 <ul>
		</p>
		</div>';
else{
	
	$acceso->objeto->ejecutarSql("select reporte_z from cirre_diario_et,estacion_trabajo where cirre_diario_et.id_est=estacion_trabajo.id_est and ip_est='$ip_est' order by reporte_z desc LIMIT 1 offset 0 ");
	$reporte_z = verCF($acceso,"reporte_z");
	
?>
<!-- INICIO DEL FORMULARIO. DEBE CONSERVAR SIEMPRE EL role="form" (BOOTSTRAP) Y name="f1" (FUNCIONAMIENTO SAECO) -->
<form role="form" name="f1" id="form_cerrar_caja" >
<!-- COLUMNA GENERAL, DENOTA EL ANCHO DEL FORMULARIO -->
<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
		
	<!-- TITULO DEL FORMULARIO (DEBE SER IGUAL AL NOMBRE DEL ITEM DEL MENÚ) -->
	<div class="border-head"><h3>Cerrar Estación de Trabajo</h3></div>
	
	<!-- ÁREA DE PANEL O PANELES -->
	<section class="panel"> 
	
		<!-- CABECERA O TÍTULO DEL PANEL (EQUIVALENTE A UN FIELDSET SIN SERLO) -->
		<header class="panel-heading">Datos del Cierre de Estación de Trabajo</header>
	
		<div class="panel-body">

			<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
			
			<input class="form-control" type="hidden" name="id_cierre" maxlength="12" size="30"onChange="validarcirre_diario()" value="<?php $acceso->objeto->ejecutarSql("select * from cirre_diario_et  where (id_cierre ILIKE '$ini_u%') ORDER BY id_cierre desc"); echo $ini_u.verCodLong($acceso,"id_cierre")?>">

			<div class="form-group col-lg-2 col-md-4 col-sm-6 col-xs-12">
			<label>Fecha</label>
			<input class="form-control" disabled type="text" name="fecha_cierre" id="fecha_cierre" maxlength="10" size="10" value="<?php echo date("d/m/Y");?>" >
			</div>

			<div class="form-group col-lg-2 col-md-4 col-sm-6 col-xs-12">
			<label>Hora</label>
			<input class="form-control" disabled type="text" name="hora_cierre" maxlength="10" size="10" value="<?php echo date("H:i:s");?>" >
			</div>

			<div class="form-group col-lg-2 col-md-4 col-sm-6 col-xs-12">
			<label>Monto</label>
			<input class="form-control" type="text" name="monto_total" maxlength="10" size="10" value="<?php echo calMontoCDCA_est($acceso,date("Y-m-d"),$id_est); ?>" >
			</div>

			<div class="form-group col-lg-3 col-md-4 col-sm-6 col-xs-12">
			<label>Reporte Fiscal Z</label>
			<input class="form-control" type="text" name="dato" maxlength="10" size="20" value="<?php echo $reporte_z;?>">
			</div>

			<div class="form-group col-lg-3 col-md-4 col-sm-6 col-xs-12">
			<label>estacion</label>
			<select class="form-control" disabled name="id_est" id="id_est" onchange="">
				<?php echo $estacion?>
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
	$acceso->objeto->ejecutarSql("select * from vista_caja where fecha_caja='$fecha' and id_est='$id_est' and status_caja_cob='Abierta' ");
	if($acceso->objeto->registros>0){
		echo '<div class="alert alert-danger alert-block col-lg-12 col-md-12 col-sm-12 col-xs-12" >
		<h4 class="titulo-alerta"><i class="fa fa-times-circle"></i> <strong> Error! </strong> </h4>
		<ul class="contenido-alerta">
		<li> Para realizar el Cierre Diario se deben cerrar los demás Puntos de Cobro (Cajas). </li> 
		 <ul>
		</p>
		</div>';
	}else{
?>
<button class="btn btn-info" type="<?php echo $obj->in; ?>" name="registrar" value="<?php echo _("registrar cierre");?>" onclick="verificar('incluir','cirre_diario_et')"><i class="glyphicon glyphicon-ok"></i> Cerrar Estación</button>
<?php 
	}
?>
					<input class="btn btn-warning" type="hidden" name="modificar" value="<?php echo _("modificar");?>" onclick="verificar('modificar','cirre_diario_et')">
					<input class="btn btn-danger" type="hidden" name="eliminar" value="<?php echo _("eliminar");?>" onclick="verificar('eliminar','cirre_diario_et')">
					<button class="btn btn-success" type="button" name="salir" onclick="conexionPHP('formulario.php','cirre_diario_et')" value="<?php echo _("limpiar");?>"><i class="glyphicon glyphicon-repeat"></i> Limpiar</button>
				</div>

		</div> <!-- FIN DEL PANEL -->
				
	</section> <!-- FIN DEL ÁREA DE PANEL O PANELES -->
</div> <!-- FIN DE LA COLUMNA GENERAL PARA EL FORMULARIO -->	

</form> <!-- FIN DEL FORMULARIO -->
				
				
  <?php
  
  $tipo_caja=verCajaPrincipal($acceso);
  
  $fecha=date("Y-m-d");
  

////////////////////////////////////////////////////////////////////////////
/** CONSULTAS ***************/
//EXENTAS
$acceso->objeto->ejecutarSql("SELECT count(*) cant, sum(monto_pago) as exento FROM pagos,caja_cobrador where pagos.id_caja_cob=caja_cobrador .id_caja_cob and  monto_iva=0 and  id_est='$id_est' and fecha_pago='$fecha'   AND status_pago='PAGADO' ");
if($row=row($acceso)){
	$cantexento=trim($row["cant"]);
	$exento=trim($row["exento"]);
}

//BASE IMPONIBLE
$acceso->objeto->ejecutarSql("SELECT count(*) cant, sum(base_imp) as base_imp, sum(monto_iva) as monto_iva FROM pagos,caja_cobrador where pagos.id_caja_cob=caja_cobrador .id_caja_cob and  monto_iva>0 and  id_est='$id_est' and fecha_pago='$fecha'  AND status_pago='PAGADO' ");
if($row=row($acceso)){
	$cantbase_imp=trim($row["cant"]);
	$base_imp=trim($row["base_imp"]);
	
}

//IVA
$acceso->objeto->ejecutarSql("SELECT count(*) cant,  sum(monto_iva) as monto_iva FROM pagos ,caja_cobrador where pagos.id_caja_cob=caja_cobrador .id_caja_cob and  monto_iva>0 and  id_est='$id_est' and fecha_pago='$fecha'   AND status_pago='PAGADO' ");
if($row=row($acceso)){
	$cantmonto_iva=trim($row["cant"]);
	$monto_iva=trim($row["monto_iva"]);
}

//TOTAL INGRESO
$cant_ingreso = $cantbase_imp + $cantmonto_iva + $cantexento;
$total_ingreso = $base_imp + $monto_iva + $exento;

//NOTAS DE CRÉDITO DEL DÍA
$acceso->objeto->ejecutarSql("SELECT count(*) cant, sum(base_imp + monto_iva ) as total_nc FROM pagos,caja_cobrador where pagos.id_caja_cob=caja_cobrador .id_caja_cob and id_est='$id_est' and fecha_pago='$fecha' and fecha_factura='$fecha' and  status_pago='NOTA CREDITO'");
if($row=row($acceso)){
	$canttotal_nc_dia=trim($row["cant"]);
	$total_nc_dia=trim($row["total_nc"]);
}

//NOTAS DE CRÉDITO DE DÍAS ANTERIORES
$acceso->objeto->ejecutarSql("SELECT count(*) cant, sum(base_imp + monto_iva ) as total_nc FROM pagos ,caja_cobrador where pagos.id_caja_cob=caja_cobrador .id_caja_cob and  id_est='$id_est' and fecha_pago='$fecha' and fecha_factura<'$fecha' and  status_pago='NOTA CREDITO'");
if($row=row($acceso)){
	$canttotal_nc=trim($row["cant"]);
	$total_nc=trim($row["total_nc"]);
}

//TOTAL FACTURADO
$total_facturado = $total_ingreso - $total_nc - $total_nc_dia;

echo '
<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">

<section class="panel">

<header class="panel-heading">Resúmen de Facturación</header>
	
	<div class="panel-body">
	
	<table class="table table-condensed">
		<thead>
		<tr class="titulo-tabla">
		  <th>DESCRIPCIÓN</th>
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
		$acceso->objeto->ejecutarSql("SELECT sum(monto_tp) as monto_tp, count(*) as cant FROM vista_tipopago where id_est='$id_est' and fecha_pago='$fecha' and id_tipo_pago='$id_tipo_pago' and status_pago='PAGADO'   and obser_pago<>'NOTA CREDITO' ");
		$suma=0;
		if($row=row($acceso))
		{
			$monto_tp=trim($row["monto_tp"])+0;
			$cant=trim($row["cant"])+0;
			$suma_c+=$monto_tp;
			$suma_can+=$cant;

echo '<tr>
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
				

?> 

<?php
require 'include/eyedatagrid/class.eyepostgresadap.inc.php';
require 'include/eyedatagrid/class.eyedatagrid.inc.php';
$x = new EyeDataGrid($db);

$x->setQuery("id_caja_cob,nombre_caja,nombre_est,(apellido || ' ' || nombre) as nombre,monto_acum,fecha_caja,apertura_caja,cierre_caja,
(select (sum(pagos.monto_pago)-sum(pagos.desc_pago))  from pagos where pagos.id_caja_cob=vista_caja.id_caja_cob and status_pago='PAGADO') as total
","vista_caja","","id_est='$id_est' and  fecha_caja='$fecha' and status_caja_cob='CERRADA' and tipo_caja='PRINCIPAL' ");
$x->hideColumn('id_caja_cob');
$x->hideColumn('apellido');
$x->setColumnHeader("nombre_est", _("Estacion"));
$x->setColumnHeader("nombre_caja", _("Caja"));
$x->setColumnHeader("monto_acum", _("monto"));
$x->setColumnHeader("nombre", _("cobrador"));
$x->setColumnHeader("fecha_caja", _("fecha"));
$x->setColumnHeader("apertura_caja", _("hora apertura"));
$x->setColumnHeader("cierre_caja", _("hora cierre"));

$x->setColumnType('fecha_caja', EyeDataGrid::TYPE_DATE, 'd/m/Y',true);

$x->setClase("CierreDiario");
//$x->addRowSelect("ImprimirRep_detcob('%id_caja_cob%')");
//$x->addStandardControl(EyeDataGrid::STDCTRL_PRINT, "ImprimirRep_detcob('%id_caja_cob%')");
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

echo '
<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">

<section id="tabla-caja" class="panel">

<header class="panel-heading">Datos de los Puntos de Cobro (Cajas)</header>
	
	<div class="panel-body">';
$x->printTable();
echo '
	
	</div>
	
</section>
	
</div>
';			

//echo '<br><div align="center"><input  type="button" name="imprimir" value="IMPRIMIR PUNTOS DE COBROS" onclick="ImprimirRep_CierreDiario()">&nbsp;</div>';
?>

<?php 
}
}
?>

<?php 
}//estacion
	}
	else{
		echo '<p align="center"><img   style="background:#FFFFFF" src="imagenes/Error.jpg" width="255px" height="255px" /></p><br>
		<div align="center">
					<input  type="button" name="iniciar_sesion" value="INICIAR SESI&Oacute;N" onclick="conexionPHP(\'formulario.php\',\'Sesion\')">&nbsp;
				</div>
		';
	}
?>