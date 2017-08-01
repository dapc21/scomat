<?php require_once "procesos.php"; $ini_u = $_SESSION["ini_u"];
require_once "Seguridad/Usuario.php";
$obj=new Usuario('','','','','');
if($obj->permisoModulo($acceso,strtoupper('BANCO')))
{

?>

<!-- COLUMNA GENERAL, DENOTA EL ANCHO DEL FORMULARIO -->
<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">

<!-- INICIO DEL FORMULARIO. DEBE CONSERVAR SIEMPRE EL role="form" (BOOTSTRAP) Y name="f1" (FUNCIONAMIENTO SAECO) -->
<form role="form" name="f1" id="descuento_pronto_pago" >
		
	<!-- TITULO DEL FORMULARIO (DEBE SER IGUAL AL NOMBRE DEL ITEM DEL MEN? -->
	<div class="border-head"><h3>Descuentos por Pronto Pago</h3></div>
	
	<!-- ?EA DE PANEL O PANELES -->
	<section class="panel">
	
		<!-- CABECERA O T?ULO DEL PANEL (EQUIVALENTE A UN FIELDSET SIN SERLO) -->
		<header class="panel-heading">Datos del Pago</header>
			<div class="panel-body">	

				<input class="form-control" type="hidden" name="id_dpp" maxlength="8" size="30"onChange="validardescuento_pronto_pag()" value="<?php $acceso->objeto->ejecutarSql("select *from descuento_pronto_pag  where (id_dpp ILIKE '$ini_u%') ORDER BY id_dpp desc"); echo $ini_u.verCo($acceso,"id_dpp")?>">
				
				<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
				
					<div class="form-group col-lg-4 col-md-4 col-sm-12 col-xs-12">
						<label>Franquicia</label>																					
						<select class="form-control" name="id_franq" id="-1" onchange="verServiciosCheck()">
							<?php echo verFranquicia($acceso);?>
						</select>
								
					</div>
					
					<div class="form-group col-lg-4 col-md-4 col-sm-12 col-xs-12">
						<label>Estatus</label>
						<div>																
							<input type="radio" name="status_dpp" value="ACTIVO"CHECKED /> Activo													
							<input  type="radio" name="status_dpp" value="INACTIVO" /> Inactivo
						</div>
					</div>																		
					
					<div class="form-group col-lg-4 col-md-4 col-sm-12 col-xs-12">
						<label>Hasta el día</label>
						<select class="form-control" name="dia_dpp" id="-1" onchange="">
							<option value="0">Seleccione...</option>
							<option value="01">01</option>
							<option value="02">02</option>
							<option value="03">03</option>
							<option value="04">04</option>
							<option value="05">05</option>
							<option value="06">06</option>
							<option value="07">07</option>
							<option value="08">08</option>
							<option value="09">09</option>
							<option value="10">10</option>
							<option value="11">11</option>
							<option value="12">12</option>
							<option value="13">13</option>
							<option value="14">14</option>
							<option value="15">15</option>
							<option value="16">16</option>
							<option value="17">17</option>
							<option value="18">18</option>
							<option value="19">19</option>
							<option value="20">20</option>
							<option value="21">21</option>
							<option value="22">22</option>
							<option value="23">23</option>
							<option value="24">24</option>
							<option value="25">25</option>
							<option value="26">26</option>
							<option value="27">27</option>
							<option value="28">28</option>
							<option value="29">29</option>
							<option value="30">30</option>
							<option value="31'">31</option>
						</select>
								
					</div>
					
					<div class="form-group col-lg-6 col-md-6 col-sm-12 col-xs-12">
						<label>Monto Descuento</label >
						<div class="input-group">						
						<input class="form-control" type="text" name="monto_dpp" maxlength="10" size="25" value="" >
						<span class="input-group-addon">BsF</span>
						</div>
						<!--span class="campo_oblig">&nbsp;*&nbsp;</span-->
					</div>
					
					<div class="form-group col-lg-6 col-md-6 col-sm-12 col-xs-12">								
						<label>Servicios</label>
						<div>
						<input type="checkbox" name="id_serv_dpp" value="">
							Seleccionar Todo
						</div>
					</div>		
															
				</div>	
				
				
			</div> <!-- FIN DEL PANEL -->	
			
	</section>
		
					
	<section class="panel">		
		
			<div class="panel-body">	
				<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
					
					<div id="id_check_serv">
						<?php 
							session_start();
							$id_f = $_SESSION["id_franq"]; 
							if($id_f!='0'){
								echo verServiciosCheck($acceso);
							}
							
						?>					
					</div>
					
				</div>		
				
			</div> <!-- FIN DEL PANEL -->	
	</section>	 
		
	<section class="panel">		
		
			<div class="panel-body">	
				<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
					
					<div class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12">
						<label>observación</label >		
						<textarea class="form-control" name="obser_dpp" cols="100" rows="1"></textarea>
					</div>
					
				</div>		
				
				<input class="form-control" type="hidden" value="dato" name="dato">		
			</div> <!-- FIN DEL PANEL -->	
	</section>		
			
	<!-- ?EA DE PANEL O PANELES -->
	<section class="panel">		
		<div class="panel-body">
			<div class="form-btn col-lg-12 col-md-12 col-sm-12 col-xs-12" align="center">
				<button class="btn btn-success" type="button" type="<?php echo $obj->in; ?>" class="boton" name="registrar" value="<?php echo _("registrar");?>" onclick="verificar('incluir','descuento_pronto_pag')"><i class="glyphicon glyphicon-ok"></i> Registrar</button>		
				<button class="btn btn-warning" type="button" type="<?php echo $obj->mo; ?>" class="boton" name="modificar" value="<?php echo _("modificar");?>" onclick="verificar('modificar','descuento_pronto_pag')"><i class="glyphicon glyphicon-refresh"></i> Modificar</button>
				<button class="btn btn-danger" type="button" type="<?php echo $obj->el; ?>" class="boton" name="eliminar" value="<?php echo _("eliminar");?>" onclick="verificar('eliminar','descuento_pronto_pag')"><i class="glyphicon glyphicon-trash"></i> Eliminar</button>
				<button class="btn btn-info" type="button" name="salir" onclick="conexionPHP('formulario.php','descuento_pronto_pag')" value="<?php echo _("limpiar");?>"><i class="glyphicon glyphicon-repeat"></i> Limpiar</button>
			</div>
		</div> <!-- FIN DEL PANEL -->	
	</section>			
		
			
	<section class="panel" id="tabla-descuento-pronto-pago">		
		<!-- CABECERA O T?ULO DEL PANEL (EQUIVALENTE A UN FIELDSET SIN SERLO) -->
		<header class="panel-heading">Datos de Bancos Registrados</header>
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
					<input  type="button" name="iniciar_sesion" value="INICIAR SESI&Oacute;N" onclick="conexionPHP(\'formulario.php\',\'Sesion\')">&nbsp;
				</div>
		';
	}
?>
		
		