<?php require_once "../procesos.php"; $ini_u = $_SESSION["ini_u"];
require_once "../Seguridad/Usuario.php";
$obj=new Usuario('','','','','');
if($obj->permisoModulo($acceso,strtoupper('cerrar_caja')))
{
	$acceso->objeto->ejecutarSql("select valor_param from parametros where id_param='35'");
	$row=row($acceso);
	$habilitado = trim($row["valor_param"]);
	
	
$fecha= date("Y-m-d");
$id_persona=$_SESSION["id_persona"];

	$acceso->objeto->ejecutarSql("select * from vista_caja where id_persona='$id_persona' and fecha_caja='$fecha' and status_caja_cob='Abierta'");
	if(!$row=row($acceso)){
		echo '<div class="alert alert-danger alert-block col-lg-12 col-md-12 col-sm-12 col-xs-12" >
		<h4 class="titulo-alerta"><i class="fa fa-times-circle"></i> <strong> Error! </strong> </h4>
		<ul class="contenido-alerta">
		<li>Usted no posee un punto de cobro abierto</li> 
		<ul>
		</p>
		</div>';
	}
	else{
	$id_caja_cob=trim($row['id_caja_cob']);
	$id_est=trim($row['id_est']);
	$nombre=trim($row["nombre_caja"]);
	$nombre_est=trim($row["nombre_est"]);
	
		$estacion=opcion(trim($row["id_est"]),trim($row["nombre_est"]));
		
	$acceso->objeto->ejecutarSql("select * from persona where id_persona='$id_persona'");
	if($row=row($acceso)){
		$nombre_cobrador=trim($row["nombre"])." ".trim($row["apellido"]);
	}
	$acceso->objeto->ejecutarSql("select * from caja_cobrador where id_caja_cob='$id_caja_cob'");
	if($row=row($acceso)){
		$id_caja=trim($row["id_caja"]);
		$apertura_caja=trim($row["apertura_caja"]);
	}
	$monto=0.0;
	$acceso->objeto->ejecutarSql("select sum(monto_pago) as monto from pagos where id_caja_cob='$id_caja_cob' and status_pago='PAGADO' AND tipo_doc='PAGO' ");
	if($row=row($acceso)){
				$monto=trim($row["monto"]);
	}

?>
<!-- INICIO DEL FORMULARIO. DEBE CONSERVAR SIEMPRE EL role="form" (BOOTSTRAP) Y name="f1" (FUNCIONAMIENTO SAECO) -->
<form role="form" name="f1" id="f1" data-parsley-validate="">
<!-- COLUMNA GENERAL, DENOTA EL ANCHO DEL FORMULARIO -->
<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">


		
	<!-- TITULO DEL FORMULARIO (DEBE SER IGUAL AL NOMBRE DEL ITEM DEL MENÚ) -->
	<div class="border-head"><h3>Cerrar Caja</h3></div>
	
	<!-- ÁREA DE PANEL O PANELES -->
	<section class="panel">

		<!-- CABECERA O TÍTULO DEL PANEL (EQUIVALENTE A UN FIELDSET SIN SERLO) -->
		<header class="panel-heading">Datos del Cierre de Caja</header>
		
		<div class="panel-body">

			<input class="form-control" type="hidden" name="id_caja" id="id_caja" maxlength="10" size="10" value="<?php echo $id_caja;?>">

			<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
			
			<div class="form-group col-lg-3 col-md-4 col-sm-6 col-xs-12">
			
			<label>Estación de Trabajo</label>
			<select class="form-control" disabled name="id_est" id="id_est" onchange="">
			<?php echo $estacion?>
			</select>
			
			</div>
			<div class="form-group col-lg-3 col-md-4 col-sm-6 col-xs-12">
			
			<label>Caja</label>
			<select class="form-control" name="id_caja_cob" id="id_caja_cob" onchange="validarcaja_cobrador()">
			<?php echo '<option value="'.$id_caja_cob.'">'.$nombre.'</option>'//echo verCajaAbierta($acceso); ?>
			</select>
			
			</div>
			<div class="form-group col-lg-3 col-md-4 col-sm-6 col-xs-12">
			
			<label>Cobrador</label>
			<select class="form-control" disabled name="id_persona" id="id_persona" onchange="">
			<?php echo '<option value="'.$id_persona.'">'.$nombre_cobrador.'</option>' ?>
			</select>
			
			</div>
			<div class="form-group col-lg-3 col-md-4 col-sm-6 col-xs-12">
			
			<label>Fecha</label>
			<input class="form-control" disabled type="text" name="fecha_caja" id="fecha_caja" maxlength="10" size="10" value="<?php echo date("d/m/Y");?>" >
			
			</div>
			<div class="form-group col-lg-3 col-md-4 col-sm-6 col-xs-12">
			
			<label>Monto Acumulado</label>
			<input class="form-control" disabled type="text" name="monto_acum" id="monto_acum" maxlength="10" size="10" value="<?php echo $monto;?>" >
			
			</div>
			<div class="form-group col-lg-3 col-md-4 col-sm-6 col-xs-12">
			
			<label>Hora de Apertura</label>
			<input class="form-control" disabled type="text" name="apertura_caja" id="apertura_caja" maxlength="8" size="10" value="<?php echo $apertura_caja;?>">
			
			</div>
			<div class="form-group col-lg-3 col-md-4 col-sm-6 col-xs-12">
			
			<label>Hora de Cierre</label>
			<input class="form-control" disabled type="text" name="cierre_caja" id="cierre_caja" maxlength="8" size="10" value="<?php echo date("H:i:s");?>" >
			</div>
			
			</div>

			<input class="form-control" type="hidden" name="status_caja" id="status_caja" maxlength="15" size="10" value="CERRADA" >
			<input class="form-control" type="hidden" value="dato" name="dato" id="dato">

		</div> <!-- FIN DEL PANEL -->
				
	</section>
	<section class="panel">			

		<div class="panel-body">
			
				<div class="form-btn col-lg-12 col-md-12 col-sm-12 col-xs-12" align="center">
					<button class="btn btn-info" type="<?php echo $obj->in; ?>" name="registrar" id="registrar" value="" onclick="gestionar_caja_cobrador('cerrar','caja_cobrador')"><i class="glyphicon glyphicon-ok"></i> Cerrar Caja</button>
					<button class="btn btn-success" type="button" name="salir" id="salir" onclick="cargar_form_cerrar_caja()" value="<?php echo _("limpiar");?>"><i class="glyphicon glyphicon-repeat"></i> Limpiar</button>
				</div>
		</div> <!-- FIN DEL PANEL -->
	</section> <!-- FIN DEL ÁREA DE PANEL O PANELES -->
</div> <!-- FIN DE LA COLUMNA GENERAL PARA EL FORMULARIO -->
			<div id="datagrid" class="data"></div>
</form> <!-- FIN DEL FORMULARIO -->
<?php 
	}//caja cobrador
//}//estacion
	}
	else{
		echo '<p align="center"><img   style="background:#FFFFFF" src="imagenes/Error.jpg" width="255px" height="255px" /></p><br>
		<div align="center">
					<input  type="button" name="iniciar_sesion" value="INICIAR SESI&Oacute;N" onclick="conexionPHP(\'formulario.php\',\'Sesion\')">&nbsp;
				</div>
		';
	}
?>