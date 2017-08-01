<?php require_once "procesos.php"; $ini_u = $_SESSION["ini_u"];
require_once "Seguridad/Usuario.php";
$obj=new Usuario('','','','','');
if($obj->permisoModulo($acceso,strtoupper('BANCO')))
{
$acceso->objeto->ejecutarSql("select id_inicial_id from inicial_id  where (id_inicial_id ILIKE '$ini_u%')   ORDER BY id_inicial_id desc LIMIT 1 offset 0 ");
	$id_inicial_id=$ini_u.verCoo($acceso,"id_inicial_id");
?>

<!-- COLUMNA GENERAL, DENOTA EL ANCHO DEL FORMULARIO -->
<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">

<!-- INICIO DEL FORMULARIO. DEBE CONSERVAR SIEMPRE EL role="form" (BOOTSTRAP) Y name="f1" (FUNCIONAMIENTO SAECO) -->
<form role="form" name="f1" id="inicial_id" >
		
	<!-- TITULO DEL FORMULARIO (DEBE SER IGUAL AL NOMBRE DEL ITEM DEL MEN? -->
	<div class="border-head"><h3>Inicial para Usuarios</h3></div>
	
	<!-- ?EA DE PANEL O PANELES -->
	<section class="panel">
	
		<!-- CABECERA O T?ULO DEL PANEL (EQUIVALENTE A UN FIELDSET SIN SERLO) -->
		<header class="panel-heading">Datos de la Inicial para Usuarios</header>
		
		<div class="panel-body">

			<input class="form-control" type="HIDDEN" name="id_inicial_id" maxlength="8" size="30"onChange="validarinicial_id()" value="<?php echo $id_inicial_id;?>">
			
			<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
			
				<div class="form-group col-lg-6 col-md-6 col-sm-12 col-xs-12">
					<label>Servidor</label>
					<select class="form-control" name="id_servidor" id="id_servidor" onchange="">
						<?php echo verServidor($acceso);?>
					</select>
				</div>
				
				<div class="form-group col-lg-6 col-md-6 col-sm-12 col-xs-12">
					<label>Inicial ID</label>
					<select class="form-control" name="inicial" id="inicial" onchange="">
						<option value="AD">A - D</option>
						<option value="EH">E - H</option>
						<option value="IL">I - L</option>
						<option value="MP">M - P</option>
						<option value="QT">Q - T</option>
						<option value="UX">U - X</option>
						<option value="YZ">Y - ]</option>
					</select>
				</div>
			
			</div>
			
		<input class="form-control" type="hidden" value="dato" name="dato">
		<input class="form-control" type="hidden" name="status" maxlength="15" size="30" value="DISPONIBLE" >	
		
		</div> <!-- FIN DEL PANEL -->	
	</section>
			
	<!-- ?EA DE PANEL O PANELES -->
	<section class="panel">
		
		<div class="panel-body">
			
			<div class="form-btn col-lg-12 col-md-12 col-sm-12 col-xs-12" align="center">
				<button class="btn btn-success" type="button" type="<?php echo $obj->in; ?>" class="boton" name="registrar" value="<?php echo _("registrar");?>" onclick="verificar('incluir','inicial_id')"><i class="glyphicon glyphicon-ok"></i> Registrar</button>		
				<button class="btn btn-info" type="button" name="salir" onclick="conexionPHP('formulario.php','inicial_id')" value="<?php echo _("limpiar");?>"><i class="glyphicon glyphicon-repeat"></i> Limpiar</button>
				<input class="form-control" type="hidden" name="modificar" value="<?php echo _("modificar");?>" onclick="verificar('modificar','inicial_id');">
				<input class="form-control" type="hidden" name="eliminar" value="<?php echo _("eliminar");?>" onclick="verificar('eliminar','inicial_id');">
			</div>
			
		</div> <!-- FIN DEL PANEL -->
	
	</section>		
		
	<section class="panel" id="tabla-inicial-id">		
		<!-- CABECERA O T?ULO DEL PANEL (EQUIVALENTE A UN FIELDSET SIN SERLO) -->
		<header class="panel-heading">Datos de las Iniciales para Usuarios Registrados</header>
		
			<div class="panel-body">	
				<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
					
					<div id="datagrid" class="data"></div>						
					
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
					<input  type="button" name="iniciar_sesion" value="INICIAR SESI&Oacute;N" onclick="conexionPHP(\'formulario.php\',\'Sesion\')">&nbsp;
				</div>
		';
	}
?>
