<?php require_once "../procesos.php"; $ini_u = $_SESSION["ini_u"];  
require_once "../Seguridad/Usuario.php";
$obj=new Usuario('','','','','');
if($obj->permisoModulo($acceso,strtoupper('equipo_sistema'))) //validar privilegios
{
?>

<!-- COLUMNA GENERAL, DENOTA EL ANCHO DEL FORMULARIO -->
<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">

<!-- INICIO DEL FORMULARIO. DEBE CONSERVAR SIEMPRE EL role="form" (BOOTSTRAP) Y name="f1" (FUNCIONAMIENTO SAECO) -->
<form role="form" name="f1" id="f1"  data-parsley-validate=""  >
		
	<!-- TITULO DEL FORMULARIO (DEBE SER IGUAL AL NOMBRE DEL ITEM DEL MEN? -->
	<div class="border-head"><h3>administracion de equipos</h3></div>
	
	<!-- ?EA DE PANEL O PANELES -->
	<section class="panel">
	
		<!-- CABECERA O T?ULO DEL PANEL (EQUIVALENTE A UN FIELDSET SIN SERLO) -->
		<header class="panel-heading">datos a registrar</header>
			<div class="panel-body">
				<input  type="hidden" name="id_es" id="id_es" maxlength="" size=""  value="<?php $acceso->objeto->ejecutarSql("select *from equipo_sistema  where (id_es ILIKE '$ini_u%') ORDER BY id_es desc"); echo $ini_u.verCodLong($acceso,"id_es")?>">
					<div class="form-group col-lg-3 col-md-6 col-sm-12 col-xs-12">
						<label>sistema</label>
						<select class="form-control" name="id_tse" id="id_tse" onchange="cargar_marca_modelo();cargar_serv_sist_equipo();">
							<?php echo ver_tipo_sist_equipo($acceso);?>
						</select>
					</div>
				<div class="form-group col-lg-3 col-md-6 col-sm-6 col-xs-12">
					<label>codigo</label>
					<input data-parsley-id="codigo_es" required=""    class="form-control" type="text" name="codigo_es" id="codigo_es" maxlength="20"  value="" onchange="buscar_codigo_es()" >
					<ul id="parsley-id-codigo_es" class="parsley-errors-list"></ul>							
				</div>
				<div class="form-group col-lg-3 col-md-6 col-sm-6 col-xs-12">
					<label>codigo adicional</label>
					<input data-parsley-id="codigo_adic" required=""  data-parsley-type="alphanum"  class="form-control" type="text" name="codigo_adic" id="codigo_adic" maxlength="20"  value="" >
					<ul id="parsley-id-codigo_adic" class="parsley-errors-list"></ul>							
				</div>

					<div class="form-group col-lg-3 col-md-6 col-sm-6 col-xs-12">
						<label>status</label>
						<select disabled data-parsley-id="status_es" required=""   class="form-control" name="status_es" id="status_es" onchange="">
							<option value="DISPONIBLE">DISPONIBLE</option>
							<option value="ACTIVO" >ACTIVO</option>
							<option value="SUSPENDIDO" >SUSPENDIDO</option>
						</select>
						<ul id="parsley-id-status_es" class="parsley-errors-list"></ul>			
					</div>

					<div class="form-group col-lg-3 col-md-4 col-sm-6 col-xs-12">
						<label>marca</label>													
							<select  class="form-control" name="id_marca" id="id_marca" onchange="cargar_modelo_m()" >
								<?php echo ver_marca($acceso); ?>
							</select>
					</div>
					<div class="form-group col-lg-3 col-md-6 col-sm-6 col-xs-12">
						<label>modelo</label>
						<select data-parsley-id="id_modelo" required=""   class="form-control" name="id_modelo" id="id_modelo" onchange="traer_sistema_marca()">
							<?php echo ver_modelo($acceso);?>
						</select>
						<ul id="parsley-id-id_modelo" class="parsley-errors-list"></ul>			
					</div>

					<div class="form-group col-lg-3 col-md-6 col-sm-6 col-xs-12">
						<label>ubicacion</label>
						<select data-parsley-id="id_ues" required=""   class="form-control" name="id_ues" id="id_ues" onchange="">
							<?php echo ver_ubicacion_equipo_sist($acceso);?>
						</select>
						<ul id="parsley-id-id_ues" class="parsley-errors-list"></ul>			
					</div>

				
					
					
					<div class="form-group col-lg-3 col-md-6 col-sm-6 col-xs-12">
						<label>estado fisico</label>
						<select data-parsley-id="estado_fisico" required=""   class="form-control" name="estado_fisico" id="estado_fisico" onchange="">
							<option value="BUENO">BUENO</option>
							<option value="DAÑADO">DAÑADO</option>
						</select>
						<ul id="parsley-id-estado_fisico" class="parsley-errors-list"></ul>			
					</div>

					<div class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12">
						<label>observacion</label>
						<textarea data-parsley-id="obser_es"    data-parsley-type="alphanum" class="form-control" name="obser_es" id="obser_es"  rows="1"></textarea>
						<ul id="parsley-id-obser_es" class="parsley-errors-list"></ul>
					</div>
					<div class="form-group col-lg-3 col-md-6 col-sm-6 col-xs-12">
						<label>dato adicional tipo</label>
						<select data-parsley-id="tipo_es"  class="form-control" name="tipo_es" id="tipo_es" onchange="">
							<option value="">Seleccione...</option>
							<option value="36">36</option>
							<option value="43">43</option>
						</select>
						<ul id="parsley-id-tipo_es" class="parsley-errors-list"></ul>			
					</div>
				
				<input data-parsley-id="id_contrato" required=""  data-parsley-type="alphanum"  class="form-control" type="hidden" name="id_contrato" id="id_contrato" maxlength="10"  value="" >	

				<input  type="hidden" value="dato" name="dato" id="dato">
		<tr>
			</div> <!-- FIN DEL PANEL -->	
	</section>


	<!-- ÁREA DE PANEL O PANELES -->
	<section class="panel">
		<!-- CABECERA O TÍTULO DEL PANEL (EQUIVALENTE A UN FIELDSET SIN SERLO) -->
		<header class="panel-heading">Datos del Abonado</header>
		<div class="panel-body">

			<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
			<div class="form-group col-lg-3 col-md-4 col-sm-6 col-xs-12">
				<label>Nº de Abonado</label>
				<div class="input-group">
				<input data-parsley-id="nro_contrato" required="" class="form-control" type="text" name="nro_contrato" id="nro_contrato" onChange="validarcontrato()" maxlength="11" size="12" value="">
				<div class="input-group-btn">
					<button type="button" class="btn btn-info" id="buscar_abonado" onclick=""><i class="fa fa-search"></i></button>	
				</div>
				</div>
				<ul id="parsley-id-nro_contrato" class="parsley-errors-list"></ul>
			</div>							
			<div class="form-group col-lg-3 col-md-3 col-sm-3 col-xs-12">
				<label>Nombre(s)</label>
				<input data-parsley-id="nombre" required=""  class="form-control" readonly type="text" name="nombre" id="nombre"  value="" >
				<ul id="parsley-id-nombre" class="parsley-errors-list"></ul>
			</div>
			<div class="form-group col-lg-3 col-md-3 col-sm-3 col-xs-12">
				<label>Apellido(s)</label>
				<input data-parsley-id="apellido" required=""  class="form-control" readonly type="text" name="apellido" id="apellido"  value="" >
				<ul id="parsley-id-apellido" class="parsley-errors-list"></ul>
			</div>
			<div class="form-group col-lg-3 col-md-3 col-sm-3 col-xs-12">
				<label>Estatus</label>
				<input data-parsley-id="status_contrato" required="" class="form-control" readonly type="text" name="status_contrato" id="status_contrato" value="" >
				<ul id="parsley-id-status_contrato" class="parsley-errors-list"></ul>
			</div>
			</div>

		</div> <!-- FIN DEL PANEL -->
	
	</section>
	<!-- ?EA DE PANEL O PANELES -->
	<!-- ÁREA DE PANEL O PANELES -->
	<section class="panel">
		<!-- CABECERA O TÍTULO DEL PANEL (EQUIVALENTE A UN FIELDSET SIN SERLO) -->
		<header class="panel-heading">Datos del servicio (Solo para pruebas)</header>
		<div class="panel-body">

		<div id="datagrid_servicio">
			
			<?php 
				$acceso1=conexion();
						$acceso1->objeto->ejecutarSql("select *from tipo_sist_equipo  order By id_tse");
						$i=1;
						while ($row1=row($acceso1))
						{
							$id_tse=trim($row1["id_tse"]);
							$sistema=trim($row1["sistema"]);
							$ubicacion=trim($row1["ubicacion"]);
							
							echo '<br><div style="width:220px; display: inline-block;" ><input  type="checkbox" name="tipo_sistema" value="" id="'.$id_tse.'ts" onclick="activacheckf_ts(\''.$id_tse.'\')">
							<label><header class="panel-heading">Interfaz '.$sistema.' '.$ubicacion.'</header></label></div>';
						
							$acceso->objeto->ejecutarSql("select *from servicios_sistema WHERE status_serv_sist='ACTIVO' and id_tse='$id_tse' order By abrev_serv_sist");
							$i=1;
							while ($row=row($acceso))
							{
								if($i==5){
								//	echo "<br>";
									$i=0;
								}	
								$i++;
								echo '<div style="width:110px; display: inline-block;" ><input  type="checkbox" name="servicio" id="'.$id_tse.trim($row["id_serv_sist"]).'ts" value="'.trim($row["id_serv_sist"]).'">
						<label> '.trim($row["abrev_serv_sist"]).'</label></div>';
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
				<button class="btn btn-success" type="button" type="<?php echo $obj->in; ?>" class="boton" name="registrar" id="registrar" value="<?php echo _("registrar");?>" onclick="gestionar_equipo_sistema('incluir','equipo_sistema')"><i class="glyphicon glyphicon-ok"></i> Registrar</button>		
				<button disabled name="modificar" id="modificar" class="btn btn-warning" type="button" type="<?php echo $obj->mo; ?>" class="boton" value="<?php echo _("modificar");?>" onclick="gestionar_equipo_sistema('modificar','equipo_sistema')"><i class="glyphicon glyphicon-refresh"></i> Modificar</button>
				<button disabled class="btn btn-danger" type="button" type="<?php echo $obj->el; ?>" class="boton" name="eliminar" id="eliminar" value="<?php echo _("eliminar");?>" onclick="gestionar_equipo_sistema('eliminar','equipo_sistema')"><i class="glyphicon glyphicon-trash"></i> Eliminar</button>
				<button class="btn btn-info" type="button" name="salir" id="salir" onclick="cargar_form_equipo_sistema()" value="<?php echo _("limpiar");?>"><i class="glyphicon glyphicon-repeat"></i> Limpiar</button>
			</div>	
		</div> <!-- FIN DEL PANEL -->	
	</section>	
	
	<!-- ?EA DE PANEL O PANELES -->
	<section class="panel">		
		<!-- CABECERA O T?ULO DEL PANEL (EQUIVALENTE A UN FIELDSET SIN SERLO) -->
		<header class="panel-heading">Datos Agregados</header>
			<div class="panel-body">
				<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
					
					<div id="datagrid"></div>
					
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

