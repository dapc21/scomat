<?php require_once "../procesos.php"; $ini_u = $_SESSION["ini_u"];  
require_once "../Seguridad/Usuario.php";
$obj=new Usuario('','','','','');
if($obj->permisoModulo($acceso,strtoupper('equipo_sistema'))) //validar privilegios
{
	$id_es=$_GET['id_es'];
	$acceso->objeto->ejecutarSql("select *from vista_equipo_sistema where id_es='$id_es'");
	if ($row=row($acceso))
	{
		$id_tse=trim($row["id_tse"]);
		$id_contrato=trim($row["id_contrato"]);
		$sistema=trim($row["sistema"]);
		$id_modelo=trim($row["id_modelo"]);
		$id_ues=trim($row["id_ues"]);
		$codigo_es=trim($row["codigo_es"]);
		$tipo_es=trim($row["tipo_es"]);
		$status_es=trim($row["status_es"]);
		$obser_es=trim($row["obser_es"]);
		$codigo_adic=trim($row["codigo_adic"]);
		$estado_fisico=trim($row["estado_fisico"]);
		$id_marca=trim($row["id_marca"]);
		echo ":$obser_es:";
	}
	$acceso->objeto->ejecutarSql("select *from equipo_sistema where id_es='$id_es'");
	if ($row=row($acceso))
	{
		$obser_es=trim($row["obser_es"]);
	}
?>

<!-- COLUMNA GENERAL, DENOTA EL ANCHO DEL FORMULARIO -->
<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">

<!-- INICIO DEL FORMULARIO. DEBE CONSERVAR SIEMPRE EL role="form" (BOOTSTRAP) Y name="f1" (FUNCIONAMIENTO SAECO) -->
<form role="form" name="f3" id="f3"  >
		
	<!-- ?EA DE PANEL O PANELES -->
	<section class="panel">
	
		<!-- CABECERA O T?ULO DEL PANEL (EQUIVALENTE A UN FIELDSET SIN SERLO) -->
		
			<div class="panel-body">
				<input  type="hidden" name="id_es" id="id_es" maxlength="" size=""  value="<?php echo $id_es; ?>">
				
				<div class="form-group col-lg-3 col-md-6 col-sm-6 col-xs-12">
					<label>sistema</label>
					<input disabled  class="form-control" type="text" name="id_tse" id="id_tse" maxlength="20"  value="<?php echo $sistema; ?>" >					
				</div>
				<div class="form-group col-lg-3 col-md-6 col-sm-6 col-xs-12">
					<label>codigo</label>
					<input disabled   class="form-control" type="text" name="codigo_es" id="codigo_es" maxlength="20"  value="<?php echo $codigo_es; ?>" >	
				</div>
				<div class="form-group col-lg-3 col-md-6 col-sm-6 col-xs-12">
					<label>codigo adicional</label>
					<input  disabled class="form-control" type="text" name="codigo_adic" id="codigo_adic" maxlength="20"  value="<?php echo $codigo_adic; ?>" >
				</div>
				<div class="form-group col-lg-3 col-md-6 col-sm-6 col-xs-12">
					<label>status</label>
					<input disabled class="form-control" type="text" name="status" id="status" maxlength="20"  value="<?php echo $estado_fisico; ?>" >
				</div>
					<div class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12">
						<label>observacion</label>
						<textarea   class="form-control" name="obser_es" id="obser_es"  rows="1"> <?php echo $obser_es; ?> </textarea>
					</div>	
		<tr>
			</div> <!-- FIN DEL PANEL -->	
	</section>
	<!-- ÁREA DE PANEL O PANELES -->
	<section class="panel">
		<!-- CABECERA O TÍTULO DEL PANEL (EQUIVALENTE A UN FIELDSET SIN SERLO) -->
		<header class="panel-heading">paquetes disponible segun suscripción</header>
		<div class="panel-body">

		<div id="datagrid_servicio">
			<?php 
				$acceso1=conexion();
				$acceso2=conexion();
						$acceso1->objeto->ejecutarSql("select *from tipo_sist_equipo where id_tse='$id_tse' order By id_tse");
						$i=1;
						while ($row1=row($acceso1))
						{
							$id_tse=trim($row1["id_tse"]);
							$sistema=trim($row1["sistema"]);
							$ubicacion=trim($row1["ubicacion"]);
							
							echo '<br><div style="width:220px; display: inline-block;" ><input  type="checkbox" name="servicio" value="" id="'.$id_tse.'ts" onclick="activacheckf_ts_f3(\''.$id_tse.'\')">
							<label><header class="panel-heading">Interfaz '.$sistema.' '.$ubicacion.'</header></label></div>';
						
							$acceso->objeto->ejecutarSql("select *from servicios_sistema WHERE status_serv_sist='ACTIVO' and id_tse='$id_tse' order By abrev_serv_sist");
							$i=1;
							while ($row=row($acceso))
							{
								$id_serv_sist=trim($row["id_serv_sist"]);
								if($i==5){
								//	echo "<br>";
									$i=0;
								}	
								$acceso2->objeto->ejecutarSql("select *from vista_cont_serv_sist_paq where id_contrato='$id_contrato' and id_serv_sist='$id_serv_sist' ");
								if (row($acceso2))
								{
									$checked='';
									//echo "select *from serv_sist_equipo where id_es='$id_es' and id_serv_sist='$id_serv_sist'";
									$acceso2->objeto->ejecutarSql("select *from serv_sist_equipo where id_es='$id_es' and id_serv_sist='$id_serv_sist'");
									if(row($acceso2)){
										$checked=' checked';
									}

									$i++;
									echo '<div style="width:110px; display: inline-block;" ><input  type="checkbox" name="servicio" id="'.$id_tse.trim($row["id_serv_sist"]).'ts" value="'.trim($row["id_serv_sist"]).'" '.$checked.'>
									<label> '.trim($row["abrev_serv_sist"]).'</label></div>';
								}
							}
						}
					?>
		</div>
		</div> <!-- FIN DEL PANEL -->
	
	</section>
	<!-- ?EA DE PANEL O PANELES -->
	<section class="panel">		
		<div class="panel-body">	
			<div class="form-btn col-lg-12 col-md-12 col-sm-12 col-xs-12" align="center">
				<button  name="modificar_e" id="modificar_e" class="btn btn-warning" type="button" type="" class="boton" value="<?php echo _("modificar");?>" onclick="gestion_equipo_sistema_ext('modificar_edit','equipo_sistema')"><i class="glyphicon glyphicon-refresh"></i> guardar</button>
				<button class="btn btn-info" type="button" name="salfir" id="saflir" onclick="cerrar_ventana_externa()" value=""><i class="glyphicon glyphicon-repeat"></i> Cerrar</button>
			</div>	
		</div> <!-- FIN DEL PANEL -->	
	</section>	
	
</form> <!-- FIN DEL FORMULARIO -->

</div> <!-- FIN DE LA COLUMNA GENERAL PARA EL FORMULARIO -->

	
<?php 
	}
	else{
		echo '<p align="center"><img   style="background:#FFFFFF" src="imagenes/Error.jpg" width="255px" height="255px" /></p><br>
		<div align="center">
					<input  type="button" class="boton" name="iniciar_sesion" value="INICIAR SESI&Oacute;N" onclick="conexionPHP(\'formulario.php\',\'Sesion\')">&nbsp;
				</div>
		';
	}
?>

