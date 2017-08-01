<?php require_once "../procesos.php"; $ini_u = $_SESSION["ini_u"];  
require_once "../Seguridad/Usuario.php";
$obj=new Usuario('','','','','');
if($obj->permisoModulo($acceso,strtoupper('interfaz_equipos'))) //validar privilegios
{
?>

<!-- COLUMNA GENERAL, DENOTA EL ANCHO DEL FORMULARIO -->
<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">

<!-- INICIO DEL FORMULARIO. DEBE CONSERVAR SIEMPRE EL role="form" (BOOTSTRAP) Y name="f1" (FUNCIONAMIENTO SAECO) -->
<form role="form" name="f1" id="f1"  data-parsley-validate=""  >
		
	<!-- TITULO DEL FORMULARIO (DEBE SER IGUAL AL NOMBRE DEL ITEM DEL MEN? -->
	<div class="border-head"><h3>interfaz equipos</h3></div>
	
	<section class="panel">
	
		<!-- CABECERA O T?ULO DEL PANEL (EQUIVALENTE A UN FIELDSET SIN SERLO) -->
		<header class="panel-heading">datos del decodificador</header>
			<div class="panel-body">	
				
				<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
				
					<div class="form-group col-lg-3 col-md-6 col-sm-12 col-xs-12">
						<label>sistema</label>
						<select class="form-control" name="id_tse" id="id_tse" onchange="cargar_comandos_interfaz()">
							<?php echo ver_tipo_sist_equipo($acceso);?>
						</select>
					</div>
					<div class="form-group col-lg-3 col-md-6 col-sm-6 col-xs-12">
						<label>codigo</label>
						<input data-parsley-id="codigo_es" required=""    class="form-control" type="text" name="codigo_es" id="codigo_es" maxlength="20"  value="" onchange="buscar_equipo_s()">
						<ul id="parsley-id-codigo_es" class="parsley-errors-list"></ul>							
					</div>
				
					<div class="form-group col-lg-3 col-md-6 col-sm-6 col-xs-12">
						<label>codigo adicional</label>
						<input  disabled  data-parsley-type="alphanum"  class="form-control" type="text" name="codigo_adic" id="codigo_adic" maxlength="20"  value="" >
						<ul id="parsley-id-codigo_adic" class="parsley-errors-list"></ul>							
					</div>
				
					<div class="form-group col-lg-3 col-md-4 col-sm-6 col-xs-12">
						<label>status equipo</label>													
							<input disabled data-parsley-id="status_es" required=""  data-parsley-type="alphanum"  class="form-control" type="text" name="status_es" id="status_es" maxlength="20"  value="" >
						<ul id="parsley-id-status_es" class="parsley-errors-list"></ul>
					</div>
				
		
				
					<div class="form-group col-lg-3 col-md-4 col-sm-6 col-xs-12">
						<label>nro abonado</label>													
						<input class="form-control" disabled type="text" name="nro_contrato" id="nro_contrato" onChange="" maxlength="10" size="10" value="" >		
					</div>
				
					<div class="form-group col-lg-3 col-md-4 col-sm-6 col-xs-12">
						<label>rif / cedula</label>													
						<input class="form-control" disabled type="text" name="cedula" id="cedula" maxlength="10" size="10" value="" onChange="buscarXcedula()">	
					</div>
					<div class="form-group col-lg-3 col-md-4 col-sm-6 col-xs-12">
						<label>nombre cliente</label>													
						<input class="form-control" disabled type="text" name="nombre" id="nombre"  value="" >	
					</div>
				
					<div class="form-group col-lg-3 col-md-4 col-sm-6 col-xs-12">
						<label>status contrato</label>													
						<input class="form-control" disabled type="text" name="status_contrato" id="status_contrato" maxlength="30" size="30" value="" >
					</div>
				
		
					
				
				</div>
				<input data-parsley-id="id_contrato" required=""  data-parsley-type="alphanum"  class="form-control" type="hidden" name="id_contrato" id="id_contrato" maxlength="10"  value="" >	
			</div> <!-- FIN DEL PANEL -->	
	</section>


	<!-- ?EA DE PANEL O PANELES -->
	<section class="panel">
	
		<!-- CABECERA O T?ULO DEL PANEL (EQUIVALENTE A UN FIELDSET SIN SERLO) -->
		<header class="panel-heading">comando a enviar</header>
			<div class="panel-body">
				<input  type="hidden" name="id_inte" id="id_inte" maxlength="" size=""  value="<?php $acceso->objeto->ejecutarSql("select *from interfaz_equipos  where (id_inte ILIKE '$ini_u%') ORDER BY id_inte desc"); echo $ini_u.verCoo($acceso,"id_inte")?>">
					
					<div class="form-group col-lg-3 col-md-6 col-sm-6 col-xs-12">
						
						<select data-parsley-id="id_com_int" required=""   class="form-control" name="id_com_int" id="id_com_int" onchange="">
							<option value="">Seleccione...</option>
							<?php //echo ver_comando_interfaz($acceso);?>
							
						</select>
						<ul id="parsley-id-id_com_int" class="parsley-errors-list"></ul>			
					</div>

				
					<input data-parsley-id="id_es" required=""  data-parsley-type="alphanum"  class="form-control" type="hidden" name="id_es" id="id_es" maxlength="10"  value="" >
					

				<input  type="hidden" value="dato" name="dato" id="dato">
		<tr>
			</div> <!-- FIN DEL PANEL -->	
	</section>

	<!-- ?EA DE PANEL O PANELES -->
	<section class="panel">		
		<div class="panel-body">	
			<div class="form-btn col-lg-12 col-md-12 col-sm-12 col-xs-12" align="center">
				<button class="btn btn-success" type="button" type="<?php echo $obj->in; ?>" class="boton" name="registrar" id="registrar" disabled value="<?php echo _("registrar");?>" onclick="gestionar_interfaz_equipos('incluir','interfaz_equipos')"><i class="glyphicon glyphicon-ok"></i> Enviar Comando</button>		
				
				<button class="btn btn-info" type="button" name="salir" id="salir" onclick="cargar_form_interfaz_equipos()" value="<?php echo _("limpiar");?>"><i class="glyphicon glyphicon-repeat"></i> Limpiar</button>
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

