<?php require_once "../procesos.php"; $ini_u = $_SESSION["ini_u"];  
	
	session_start();
	$id_f = $_SESSION["id_franq"]; 
	$consult=" and id_franq='$id_f'";
	if($id_f!='0'){
		$consult=" and  id_franq='$id_f'";
	}
	else{
		$consult=" and  id_franq='1'";
	}
	
	//echo $consult;
require_once "../Seguridad/Usuario.php";
$obj=new Usuario('','','','','');
if($obj->permisoModulo($acceso,strtoupper('CAJA_COBRADOR')))
{
	$ip_est = $_SERVER['REMOTE_ADDR'];
	$ip_est = '127.0.0.1';
//	echo $ip_est;
	/*
	$acceso->objeto->ejecutarSql("select * from estacion_trabajo where ip_est='$ip_est' and status_est='IMPRESORAFISCAL'");
	if(!$row=row($acceso)){
		echo '<div class="alert alert-danger alert-block col-lg-12 col-md-12 col-sm-12 col-xs-12" >
		<h4 class="titulo-alerta"><i class="fa fa-times-circle"></i> <strong> Error! </strong> </h4>
		<ul class="contenido-alerta">
		<li> La Estación de Trabajo no está asociada a una Impresora Fiscal. </li> 
		 <ul>
		</p>
		</div>';
	}else{
		*/
		$id_est=trim($row["id_est"]);
		$estacion=opcion(trim($row["id_est"]),trim($row["nombre_est"]));
		
	$fecha= date("Y-m-d");
	$id_persona=$_SESSION["id_persona"];
	//echo verCobradores_id($acceso,$id_persona);

	//echo ":$id_persona:";
	$acceso->objeto->ejecutarSql("select * from cirre_diario where fecha_cierre='$fecha'  and  id_franq='0'");
	if($acceso->objeto->registros>0){
		echo '<div class="alert alert-danger alert-block col-lg-12 col-md-12 col-sm-12 col-xs-12" >
		<h4 class="titulo-alerta"><i class="fa fa-times-circle"></i> <strong> Error! </strong> </h4>
		<ul class="contenido-alerta">
		<li> Ya se realizó el Cierre Diario General. No se pueden abrir Puntos de Cobro (Cajas) por el día de hoy. </li> 
		 <ul>
		</p>
		</div>';
	}else{
	
	$acceso->objeto->ejecutarSql("select * from cirre_diario where fecha_cierre='$fecha' $consult");
	if($acceso->objeto->registros>0){
		echo '<div class="alert alert-danger alert-block col-lg-12 col-md-12 col-sm-12 col-xs-12" >
		<h4 class="titulo-alerta"><i class="fa fa-times-circle"></i> <strong> Error! </strong> </h4>
		<ul class="contenido-alerta">
		<li> Ya se realizó el Cierre Diario de la Franquicia. No se pueden abrir Puntos de Cobro (Cajas) por el día de hoy. </li> 
		 <ul>
		</p>
		</div>';

	}else{
	
//	echo "select * from cirre_diario_et where fecha_cierre='$fecha' and id_est='$id_est' $consult";
	$acceso->objeto->ejecutarSql("select * from cirre_diario_et where fecha_cierre='$fecha' and id_est='$id_est' $consult");
	if($acceso->objeto->registros>0){
		echo '<div class="alert alert-danger alert-block col-lg-12 col-md-12 col-sm-12 col-xs-12" >
		<h4 class="titulo-alerta"><i class="fa fa-times-circle"></i> <strong> Error! </strong> </h4>
		<ul class="contenido-alerta">
		<li> Ya se realizo el Cierre de Estación. No se pueden abrir Puntos de Cobro (Cajas) por el día de hoy en esta Estación de Trabajo. </li> 
		 <ul>
		</p>
		</div>';
	}else{
	//ECHO "select * from vista_caja where id_persona='$id_persona' and fecha_caja='$fecha' and status_caja_cob='ABIERTA' ";
		$acceso->objeto->ejecutarSql("select * from vista_caja where id_persona='$id_persona' and fecha_caja='$fecha' and status_caja_cob='Abierta' ");
		if($acceso->objeto->registros>0){
			echo '<div class="alert alert-danger alert-block col-lg-12 col-md-12 col-sm-12 col-xs-12" >
			<h4 class="titulo-alerta"><i class="fa fa-times-circle"></i> <strong> Error! </strong> </h4>
			<ul class="contenido-alerta">
			<li> Tiene un Punto de Cobro  Abierto. Debe cerrarlo para poder aperturar otro. NOTA: Para cerrar el Punto de Cobro  ubíquese en el menú lateral: <a href="javascript:conexionPHP(\'formulario.php\',\'cerrar_caja\');" class="alert-link">Cobranza -> Cerrar Caja</a>. </li>  </li> 
			 <ul>
			</p>
			</div>';
		
		$row=row($acceso);
		$id_caja_cob=trim($row['id_caja_cob']);	
		$fecha_sugerida=date("d/m/Y", strtotime(trim($row['fecha_sugerida'])));

		
		}else{
			
?>

<!-- COLUMNA GENERAL, DENOTA EL ANCHO DEL FORMULARIO -->
<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">

<!-- INICIO DEL FORMULARIO. DEBE CONSERVAR SIEMPRE EL role="form" (BOOTSTRAP) Y name="f1" (FUNCIONAMIENTO SAECO) -->
<form role="form" id="f1"  data-parsley-validate="">
		
	<!-- TITULO DEL FORMULARIO (DEBE SER IGUAL AL NOMBRE DEL ITEM DEL MENÚ) -->
	<div class="border-head"><h3>Abrir Caja</h3></div>
	
	<!-- ÁREA DE PANEL O PANELES -->
	<section class="panel">
		
		<!-- CABECERA O TÍTULO DEL PANEL (EQUIVALENTE A UN FIELDSET SIN SERLO) -->
		<header class="panel-heading">Datos de la Caja</header>
		
		<!-- INICIO DEL PANEL -->
		<div class="panel-body">
				
			<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
				
				<input  class="form-control" type="hidden" id="id_caja_cob" maxlength="10" size="30"onChange="validarcaja_cobrador()" value="<?php $acceso->objeto->ejecutarSql("select * from caja_cobrador  where (id_caja_cob ILIKE '$ini_u%') ORDER BY id_caja_cob desc"); echo $ini_u.verCodLong($acceso,"id_caja_cob")?>">

				<div class="form-group col-lg-3 col-md-4 col-sm-6 col-xs-12">
						<label>Caja</label >
						<select  data-parsley-id="1" required="" class="form-control" id="id_caja" onchange="">
						<?php echo verCajaActiva($acceso);?>
						</select>
						<ul id="parsley-id-1" class="parsley-errors-list"></ul>
				</div>
				<div class="form-group col-lg-3 col-md-4 col-sm-6 col-xs-12">
						<label>Cobrador</label >
						<select disabled data-parsley-id="2" required="" class="form-control" id="id_persona" onchange="">
						<?php echo verCobradores_id($acceso,$id_persona);?>
						</select>			
						<ul id="parsley-id-2" class="parsley-errors-list"></ul>
				</div>
				<div class="form-group col-lg-3 col-md-4 col-sm-6 col-xs-12">
						<label>Estación de Trabajo</label >
						<select data-parsley-id="3" required="" id="id_est" onchange="" class="form-control">
						<?php echo verEstacionT($acceso);?>
						</select>
						<ul id="parsley-id-3" class="parsley-errors-list"></ul>
				</div>
				<div class="form-group col-lg-3 col-md-4 col-sm-6 col-xs-12">
						<label>Fecha</label >
						<input data-parsley-id="4" required="" class="form-control" disabled type="text" id="fecha_caja" maxlength="10" size="10" value="<?php echo date("d/m/Y");?>" >						
						<ul id="parsley-id-4" class="parsley-errors-list"></ul>
				</div>

						<input data-parsley-id="5" required="" class="form-control" disabled type="hidden" id="apertura_caja" maxlength="8" size="10" value="<?php echo date("H:i:s");?>" >

						<input disabled class="form-control form-control-inline input-medium default-date-picker" type="hidden" id="fecha_sugerida" maxlength="10" size="10" value="<?php echo date("d/m/Y");?>" >
			</div>

		</div> <!-- FIN DEL PANEL -->
				
	</section>
	<section class="panel">
	
				<input type="hidden" id="cierre_caja" maxlength="8" size="30" value="" >
				<input type="hidden" id="monto_acum" maxlength="10" size="30" value="" >
				<input type="hidden" id="status_caja" maxlength="15" size="30" value="Abierta" >
				<input type="hidden" value="dato" id="dato">

		<div class="panel-body">
			
				<div class="form-btn col-lg-12 col-md-12 col-sm-12 col-xs-12" align="center">
					<button class="btn btn-info" type="<?php echo $obj->in; ?>" id="registrar" value="<?php echo _("Abrir Punto");?>" onclick="gestionar_caja_cobrador('aperturar','caja_cobrador')"><i class="glyphicon glyphicon-ok"></i> Abrir</button>
					<button class="btn btn-success" type="button" id="salir" onclick="cargar_form_caja_cobrador()" value="<?php echo _("Limpiar");?>"><i class="glyphicon glyphicon-repeat"></i> Limpiar</button>
				</div>
				
			
		</div> <!-- FIN DEL PANEL -->
		
	
	</section> <!-- FIN DEL ÁREA DE PANEL O PANELES -->

</form> <!-- FIN DEL FORMULARIO -->

</div> <!-- FIN DE LA COLUMNA GENERAL PARA EL FORMULARIO -->

<?php 
}//caja cobrador
}//cierre general
}//cierre franquici
}//if estacion
//}//if estacion

?>

<?php 
	}else{
		echo '<p align="center"><img   style="background:#FFFFFF" src="imagenes/Error.jpg" width="255px" height="255px" /></p><br>
		<div align="center">
					<input  type="button" name="iniciar_sesion" value="INICIAR SESI&Oacute;N" onclick="conexionPHP(\'formulario.php\',\'Sesion\')">&nbsp;
				</div>
		';
	}
?>