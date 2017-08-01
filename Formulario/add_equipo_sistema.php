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
		$nombre_modelo=trim($row["nombre_modelo"]);
		$id_ues=trim($row["id_ues"]);
		$codigo_es=trim($row["codigo_es"]);
		$tipo_es=trim($row["tipo_es"]);
		$status_es=trim($row["status_es"]);
		$obser_es=trim($row["obser_es"]);
		$codigo_adic=trim($row["codigo_adic"]);
		$estado_fisico=trim($row["estado_fisico"]);
		$id_marca=trim($row["id_marca"]);
		//echo ":$obser_es:";
	}
	$acceso->objeto->ejecutarSql("select *from equipo_sistema where id_es='$id_es'");
	if ($row=row($acceso))
	{
		$obser_es=trim($row["obser_es"]);
		$ubicacion=trim($row["ubicacion"]);
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
					<label>codigo</label>
					<input    class="form-control" type="text" name="codigo_es" id="codigo_es" maxlength="20" onchange="buscar_equipo_s()"> 
				</div>
				<div class="form-group col-lg-3 col-md-6 col-sm-6 col-xs-12">
					<label>ubicacion</label>
					<input   class="form-control" type="text" name="ubicacion" id="ubicacion" maxlength="30"  value="<?php echo $ubicacion; ?>" >
				</div>
				<div class="form-group col-lg-3 col-md-6 col-sm-6 col-xs-12">
					<label>modelo</label>
					<input disabled class="form-control" type="text" name="nombre_modelo" id="nombre_modelo" value="<?php echo $nombre_modelo; ?>" >
				</div>
				<div class="form-group col-lg-3 col-md-6 col-sm-6 col-xs-12">
					<label>sistema</label>
						<input  type="hidden" name="id_tse" id="id_tse"  value="" >				
					<input disabled  class="form-control" type="text" name="sistema" id="sistema"  value="<?php echo $sistema; ?>" >					
				</div>
					<div class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12">
						<label>paquete</label>
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
					</div>	
		<tr>
			
			<div class="form-btn col-lg-12 col-md-12 col-sm-12 col-xs-12" align="center">
				<button disabled name="add_es" id="add_es" class="btn btn-warning" type="button" type="" class="boton" value="<?php echo _("modificar");?>" onclick="gestion_equipo_sistema_ext('modificar_add','equipo_sistema')"><i class="glyphicon glyphicon-refresh"></i> Guardar</button>
				<button class="btn btn-info" type="button" name="salfir" id="saflir" onclick="cerrar_ventana_externa_orden()" value=""><i class="fa fa-plus"></i></i> Cerrar</button>
			</div>	
		<!-- CABECERA O T?ULO DEL PANEL (EQUIVALENTE A UN FIELDSET SIN SERLO) -->
		
		<header class="panel-heading">Equipos Agregados</header>
			<div class="panel-body">
				<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
					
					<div id="terminales">
						
					</div>
					
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

