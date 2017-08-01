<?php require_once "procesos.php"; $ini_u = $_SESSION["ini_u"];  
require_once "../Seguridad/Usuario.php";
$obj=new Usuario('','','','','');
if($obj->permisoModulo($acceso,strtoupper('CONFIG_SMS')))
{
?>

<!-- COLUMNA GENERAL, DENOTA EL ANCHO DEL FORMULARIO -->
<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">

<!-- INICIO DEL FORMULARIO. DEBE CONSERVAR SIEMPRE EL role="form" (BOOTSTRAP) Y name="f1" (FUNCIONAMIENTO SAECO) -->
<form role="form" name="f1" id="config_sms" >
		
	<!-- TITULO DEL FORMULARIO (DEBE SER IGUAL AL NOMBRE DEL ITEM DEL MEN? -->
	<div class="border-head"><h3>Configuración General de SMS</h3></div>
	
	<!-- ?EA DE PANEL O PANELES -->
	<section class="panel">
	
		<!-- CABECERA O T?ULO DEL PANEL (EQUIVALENTE A UN FIELDSET SIN SERLO) -->
		<header class="panel-heading">Datos de la Configuración General de SMS</header>
			
			<div class="panel-body">
		
				<input class="form-control" type="hidden" name="id_conf_sms" maxlength="8" size="30"onChange="validarconfig_sms()" value="<?php $acceso->objeto->ejecutarSql("select *from config_sms  where (id_conf_sms ILIKE '$ini_u%') ORDER BY id_conf_sms desc"); echo $ini_u.verCodigo($acceso,"id_conf_sms")?>">
				
				<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
					
					<div class="form-group col-lg-4 col-md-4 col-sm-12 col-xs-12">
						<label>Franquicia</label>																																		
						<select class="form-control" name="id_franq" id="-1" onchange="">
							<option value='1'>todas
							<option>
						</select>
					</div>		
						
					<div class="form-group col-lg-4 col-md-4 col-sm-12 col-xs-12">
						<label>Permitir Teléfono Fijo</label>
						<div>																
							<input type="radio" name="per_telf_fijo" value="t"CHECKED /> Si &nbsp;&nbsp;											
							<input  type="radio" name="per_telf_fijo" value="f" /> No
						</div>
					</div>											
					
					<div class="form-group col-lg-4 col-md-4 col-sm-12 col-xs-12">						
						<label>Enviar a Todos los Móviles</label>													
						<div>									
							<input  type="radio" name="env_todos_telf" value="t"CHECKED /> Si &nbsp;&nbsp;		
							<input  type="radio" name="env_todos_telf" value="f" /> No
						</div>	
						
					</div>
					
				</div>
				<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
					
					<div class="form-group col-lg-4 col-md-4 col-sm-12 col-xs-12">
						<label>Códigos de Operadoras Móviles</label>																																		
						<input class="form-control" type="text" name="conf_campo1" maxlength="50" value="" >
					</div>
					
					<div class="form-group col-lg-8 col-md-8 col-sm-12 col-xs-12">						
						<label>Responder a Teléfono Desconocido</label>													
						<div>								
							<input  type="radio" name="act_resp_aut" value="t"CHECKED onchange="hab_text_sms()"/> Si &nbsp;&nbsp;		
							<input  type="radio" name="act_resp_aut" value="f" /> No
						</div>	
						
					</div>

				</div>
				<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">					
					
					<div class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12">						
						<label>Mensaje</label>												
						<textarea class="form-control" name="sms_resp_aut" rows="2" onKeyUp="cuenta_carac_d();"></textarea>
						Caracteres: <label id="cant_car_d">15</label> / <label id="cant_sms_d">1</label>	
					</div>

				</div>	
				
			</div> <!-- FIN DEL PANEL -->	
			
	</section>
	
	<section class="panel">		
		<!-- CABECERA O T?ULO DEL PANEL (EQUIVALENTE A UN FIELDSET SIN SERLO) -->
		<header class="panel-heading">Datos de Módem/Teléfono</header>
			<div class="panel-body">	
			
				<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
															
					<div class="form-group col-lg-4 col-md-4 col-sm-12 col-xs-12">
						<label>Código Tlf. de País</label>						
						<div class="input-group m-bot15">
							<span class="input-group-addon">+</span>
							<input class="form-control" type="text" name="cod_telf_pais" maxlength="5" size="3" value="">
						</div>	
					</div>											
					
					<div class="form-group col-lg-4 col-md-4 col-sm-12 col-xs-12">
						<label>Conexión</label>						
						<input class="form-control" type="text" name="conf_campo2" maxlength="11" size="10" value="" >
					</div>	
					
					<div class="form-group col-lg-4 col-md-4 col-sm-12 col-xs-12">
						<label>Puerto COM</label>						
						<input class="form-control" type="text" name="id_canal_sms" maxlength="10" size="10" value="" >
					</div>
					
				</div>
				<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
					
					<div class="form-group col-lg-4 col-md-4 col-sm-12 col-xs-12">
						<label>Bits por Segundo</label>						
						<input class="form-control" type="text" name="conf_campo3" maxlength="10" size="10" value="" >
					</div>	
					
					<div class="form-group col-lg-4 col-md-4 col-sm-12 col-xs-12">
						<label>Número</label>						
						<input class="form-control" type="text" name="telefono_serv" maxlength="20" size="20" value="" >
					</div>
															
					<div class="form-group col-lg-4 col-md-4 col-sm-12 col-xs-12">
						<label>Marca</label>						
						<input class="form-control" type="text" name="marca" maxlength="11" size="30" value="" >
					</div>
					
				</div>
				<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
				
					<div class="form-group col-lg-4 col-md-4 col-sm-12 col-xs-12">
						<label>Modelo</label>						
						<input class="form-control" type="text" name="modelo" maxlength="10" size="30" value="" >
					</div>	
					
					<div class="form-group col-lg-8 col-md-8 col-sm-12 col-xs-12">
						<label>Ruta Archivo</label>						
						<input class="form-control" type="text" name="ruta_archivo" id="ruta_archivo" size="100" onBlur="">
						Ej:C:\Users\Administrador\AppData\Roaming\PC Suite\012999005400493\PCCSSMS.db<br>
						Ej:C:\Documents and Settings\Administrador\Datos de programa\PC Suite\356251046341474\PCCSSMS.db
					</div>	
										
				</div>		
				
			</div> <!-- FIN DEL PANEL -->	
	</section>	
		
	<!-- ?EA DE PANEL O PANELES -->
	<section class="panel">		
		<!-- CABECERA O T?ULO DEL PANEL (EQUIVALENTE A UN FIELDSET SIN SERLO) -->
		<header class="panel-heading">Datos de Correo</header>
		
			<div class="panel-body">
			
				<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
															
					<div class="form-group col-lg-3 col-md-4 col-sm-12 col-xs-12">
						<label>correo principal</label>						
						<input class="form-control" type="text" name="correo_emp" maxlength="50" size="30" value="" >
					</div>
						
					<div class="form-group col-lg-3 col-md-4 col-sm-12 col-xs-12">
						<label>clave correo</label>						
						<input class="form-control" type="password" name="clave_correo" maxlength="50" size="30" value="" >
					</div>
						
					<div class="form-group col-lg-6 col-md-4 col-sm-12 col-xs-12">
						<label>asunto correo</label>						
						<input class="form-control" type="text" name="asunto_correo" maxlength="100" size="30" value="" >
					</div>										
					
				</div>		
				
				<input class="form-control" type="hidden" value="dato" name="dato">		
		</div> <!-- FIN DEL PANEL -->	
	</section>			
		
			
	<!-- ?EA DE PANEL O PANELES -->
	<section class="panel">		
		<div class="panel-body">
			<div class="form-btn col-lg-12 col-md-12 col-sm-12 col-xs-12" align="center">
				<input class="form-control" type="hidden" name="registrar" value="<?php echo _("registrar");?>" onclick="verificar_sms('incluir','config_sms')">
				<input class="form-control" type="hidden" name="modificar" value="<?php echo _("registrar");?>" onclick="verificar_sms('incluir','config_sms')">
				<button class="btn btn-warning" type="button" name="modifidfdfdfcar" value="<?php echo _("guardar");?>" onclick="verificar_sms('modificar','config_sms')"><i class="glyphicon glyphicon-refresh"></i> Modificar</button>
				<input class="form-control" type="hidden" name="eliminar" value="<?php echo _("eliminar");?>" onclick="verificar_sms('eliminar','config_sms')">
				<input class="form-control" type="hidden" name="Resetear" value="<?php echo _("cancelar");?>">						
			</div>	
		</div> <!-- FIN DEL PANEL -->	
	</section>		
	
	<section class="panel">				
			<div class="panel-body">	
				<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
					
					<div id="datagrid" class="data"></div>
					
				</div>		
		</div> <!-- FIN DEL PANEL -->	
	</section>	 
 
</form> <!-- FIN DEL FORMULARIO -->		
	
</div><!-- FIN DE LA COLUMNA GENERAL PARA EL FORMULARIO -->		

					

<?php 
	}
	else{
		echo '<p align="center"><img   style="background:#FFFFFF" src="imagenes/Error.jpg" width="255px" height="255px" /></p><br>
		<div align="center">
					<input  type="button" name="iniciar_sesion" value="INICIAR SESI&Oacute;N" onclick="conexionPHP_sms(\'formulario.php\',\'Sesion\')">&nbsp;
				</div>
		';
	}
?>