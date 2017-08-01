<?php require_once "procesos.php"; $ini_u = $_SESSION["ini_u"];  
require_once "../Seguridad/Usuario.php";
$obj=new Usuario('','','','','');
if($obj->permisoModulo($acceso,strtoupper('MOVIMIENTO'))){
?>
<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">

<form role="form" name="f1" id="form_material" action="javascript:func_vacia();">
	
	<div class="border-head"><h3>Administración de Movimientos de Entradas/Salidas</h3></div>
	
	<!-- AREA DE PANEL O PANELES -->
	<section class="panel">
		
		<!-- CABECERA O TÍTULO DEL PANEL (EQUIVALENTE A UN FIELDSET SIN SERLO) -->
		<header class="panel-heading">Datos de los Materiales</header>
		
		<!-- INICIO DEL PANEL -->
		<div class="panel-body">

			<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
			
			<input  type="hidden" name="id_mov2" id="id_mov2" maxlength="10" size="30"onChange="validarmovimiento()" value="<?php $acceso->objeto->ejecutarSql("select * from movimiento where (id_mov ILIKE '$ini_u%') ORDER BY id_mov desc LIMIT 1 offset 0"); echo $ini_u.verCodLong2($acceso,"id_mov")?>">
			<input  type="hidden" name="id_tmaunmento" id="id_tmaunmento" maxlength="10" size="30" value="A0000006">
			<input  type="hidden" name="id_tmdescuento" id="id_tmdescuento" maxlength="10" size="30" value="A0000005">
			<input  type="hidden" name="auxi" id="auxi" maxlength="10" size="30" value="0">

			<div class="form-group col-lg-3 col-md-6 col-sm-12 col-xs-12">
				<label>Nº de Movimiento</label>
				<input class="form-control" type="text"  name="id_mov" id="id_mov" maxlength="10" size="25"onChange="validarmovimiento()" value="<?php $acceso->objeto->ejecutarSql("select *from movimiento where (id_mov ILIKE '$ini_u%') ORDER BY id_mov desc LIMIT 1 offset 0"); echo $ini_u.verCodLong($acceso,"id_mov")?>">
			</div>
			
			<div class="form-group col-lg-3 col-md-6 col-sm-12 col-xs-12">
				<label><i class="fa fa-edit label-blanco"></i></label>
				<div> 
				<input type="checkbox" name="checkboxTrans" id="checkboxTrans" onclick="validaTransfer(this.id); checkRadio();" checked />
					Transferencias
				</div>
			</div>
			
			<div class="form-group col-lg-3 col-md-6 col-sm-12 col-xs-12">
				<label>Tipo de Movimiento</label>
				<select class="form-control" DISABLED name="id_tm" id="id_tm" onchange="">
					<?php echo verTipoMovimento2($acceso);?>
				</select>
			</div>
			
			<div class="form-group col-lg-3 col-md-6 col-sm-12 col-xs-12">
				<label>Fecha del Pedido</label>
				<input class="form-control form-control-inline input-medium default-date-picker" data-mask="99/99/9999" type="text"  name="fecha_ent_sal" id="fecha_ent_sal" maxlength="10" size="30" value="<?php echo date("d/m/Y");?>" >
			</div>
			
			<input  type="hidden" disabled name="hora_ent_sal" maxlength="15" size="10" value="<?php echo date("H:i:s");?>" >
			<input  type="hidden" name="referencia" maxlength="15" size="30" value="" >
			<input  type="hidden" name="tipo_mov" maxlength="20" size="30" value="MATERIALES" >
			<input  type="hidden" value="dato" name="dato">
			
			<div class="form-group col-lg-3 col-md-6 col-sm-12 col-xs-12">
				<label>Contraparte</label>
				<select class="form-control" name="id_persona" id="id_persona" onchange="">
					<?php echo verEntidad($acceso);?>
				</select>
			</div>
			
			<div class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12">
				<label>Observación</label>
				<textarea class="form-control" name="observacion" cols="1" rows="2"></textarea>
			</div>
			
			</div>
			

		</div> <!-- FIN DEL PANEL --> 

	</section>
	<section class="panel">
		
		<!-- CABECERA O TÍTULO DEL PANEL (EQUIVALENTE A UN FIELDSET SIN SERLO) -->
		<header class="panel-heading">Datos de los Movimientos de Entradas/Salidas</header>
		
		<!-- INICIO DEL PANEL -->
		<div class="panel-body">

			<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
			
			<div class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12">
				<table border="0" width="97%" align="CENTER" cellpadding="4" cellspacing="4"> 
					<tr>
						<td>						
							<span class="fuente"><?php echo _("deposito");?>
							</span>&nbsp;&nbsp;&nbsp;						
							<select name="iddep" id="iddep" onchange="valIqualD();traermat();" style="width: 250px;">
								<?php echo verDeposito02($acceso);?>
							</select>&nbsp;&nbsp;&nbsp;	&nbsp;&nbsp;&nbsp;	<img class="imagen" src="imagenes/buscar.png" height="20px" width="20px"href="#" onclick="Busqueda_mat_avan_new()" />
						</td>
						
										
						<td colspan="2">
							<div id="iddepdesti" style="display:none;">
								<span class="fuente"><?php echo _("deposito destino");?>
								</span>	&nbsp;&nbsp;&nbsp;						
								<select name="iddep2" id="iddep2" onchange="valIqualD();" style="width: 250px;">
									<?php echo verDeposito02($acceso);?>
								</select>
							</div>
						</td>
					
					</tr>
					
				</table>
			</div>
	<!-- 		
			<input  type="hidden" name="numero_m" id="numero_m" maxlength="50" size="30" value="" onchange="agregar_ma_movit();">
			
			<div class="form-group col-lg-2 col-md-2 col-sm-4 col-xs-12">
				<label>Número</label>
				<input class="form-control" id="numero_mat" onChange="validarmat_padre_mov_mat02();" type="text" size="5" maxlength="10" value="" name="numero_mat">
			</div>
			
			<div class="form-group col-lg-4 col-md-4 col-sm-8 col-xs-12">
				<label>Nombre</label>
				<input class="form-control" id="nombre_mat" onChange="" type="text" size="25" maxlength="50" value="" name="nombre_mat">
			</div>
			
			<div class="form-group col-lg-2 col-md-2 col-sm-4 col-xs-12">
				<label>Cantidad</label>
				<input class="form-control" id="cantidad_mat" onChange="" type="text" size="25" maxlength="50" value="" name="cantidad_mat" disabled>
			</div>
			
			<div class="form-group col-lg-2 col-md-2 col-sm-4 col-xs-12">
				<label>Stock</label>
				<input class="form-control" type="text" name="stock" disabled maxlength="8" size="20" value="0" style="text-align: left;">
			</div>
			
			<div class="form-group col-lg-2 col-md-2 col-sm-4 col-xs-12">
				<label>Min Stock</label>
				<input class="form-control" type="text" name="minver" maxlength="4" onKeyPress="return validar_numeros(event);"  size="20" value="" style="text-align: left;">
			</div>
 --> 
			
		<div class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12">
		
		<input  type="hidden" name="numero_m" id="numero_m" maxlength="50" size="30" value="" onchange="agregar_ma_movit();">
						
				<table width="97%" cellspacing="1" cellpadding="1" border="0" align="CENTER">
					<tr>
						<td style="width: 10%;">
							<span class="fuente"><?php echo _("nro");?>
							</span>
						
						</td>
						<td style="width: 25%;">
							<span class="fuente"><?php echo _("nombre");?>
							</span>
						
						</td>
						<td style="width: 25%;">
							<span class="fuente"><?php echo _("cantidad");?>
							</span>
						</td>
						<td style="width: 25%;">
							<span class="fuente"><?php echo _("stock");?>
							</span>
						</td>
						<td style="width: 15%;">
							<span class="fuente"><?php echo _("stock min");?>
							</span>
						</td>
						
				</tr>
				</table>
				
					<div id="mov">
							<table width="97%" cellspacing="1" cellpadding="1" border="0" align="CENTER">
								<tr>
									<td style="width: 10%;">
										<input id="numero_mat" onChange="validarmat_padre_mov_mat02();" type="text" size="5" maxlength="10" value="" name="numero_mat">
									</td>
									<td style="width: 25%;">
										  <input id="nombre_mat" onChange="" type="text" size="25" maxlength="50" value="" name="nombre_mat">
									</td>
									<td style="width: 25%;">
										<input type="text" size="25" maxlength="30"  disabled>
									</td>
									<td style="width: 25%;">
										<input type="text" size="25" maxlength="30"  disabled>
									</td>
									<td style="width: 15%;">
										<input id="minver" type="text" size="5" maxlength="10" value="0" name="minver" onkeypress="return validar_numeros(event)" disabled="">
									
									</td>
								</tr>
					
							</table>			
					</div>	
			
			</div>			
			
			
			
			<input  type="hidden" name="idfam" id="idfam" >
			<input  type="hidden" name="id_unidad" id="id_unidad" >
			<input  type="hidden" name="uni_id_unidad" id="uni_id_unidad" >
			<input  type="hidden" name="c_uni_ent" id="c_uni_ent"  onKeyPress="return validar_numeros(event);"  onchange="pasaRvalorCan();" maxlength="4" size="5" value="1" style="text-align: left;">
			<input  type="hidden" name="c_uni_sal" id="c_uni_sal" >
			<input  type="hidden" name="id_fam" id="id_fam" >	
			
			</div>
			
			
		<div class="form-btn col-lg-12 col-md-12 col-sm-12 col-xs-12" align="center">
		
			<div align="center" style=" float:center; width: 100%;">
								
									
									<div  style="display:block;width: 48%;float:left;border:1px; background-color: white;">
										<div id="idregis1" style="display:block;width: auto;float:right;">
											<input  type="<?php echo $obj->in;?>" name="registrar" id="registrar" value="<?php echo _("agregar");?>" onclick="verificar_mat('incluir','movimiento')">
										</div>
										<div id="idregis2" style="display:none;width: auto;float:right;">
											<input  type="<?php echo $obj->in;?>" name="registrar" id="registrar" value="<?php echo _("agregar");?>" onclick="verificar_mat('incluir','movimiento_transferencia')">&nbsp;
										</div>
									</div>
									<div style="display:block;width: 48%;float:left;background-color: white;">
										<div  style="width: auto;float:left;">							
										
										&nbsp;&nbsp;<input  type="button" name="salir1" onclick="limpiarmov_mat()" value="<?php echo _("limpiar");?>">
										</div>
									</div>			
							</div>
							<div  style="display:none;">
								&nbsp;<input  type="button" name="modificar" value="<?php echo _("modificar");?>" onclick="verificar_mat('modificar','movimiento')">
								<input  type="button" name="eliminar" value="<?php echo _("eliminar");?>" onclick="verificar_mat('eliminar','movimiento')">
							</div>
			
		</div>

		</div> <!-- FIN DEL PANEL --> 

	</section>

	<section class="panel">
	
		<header class="panel-heading">Datos de los materiales  Registrados</header>
	
		<div class="panel-body">	
		<div id="datagrid" class="data"></div>	
		</div> <!-- FIN DEL PANEL --> 
		
	</section>
	<section class="panel">
	
		<div class="panel-body">	
			<div class="form-btn col-lg-12 col-md-12 col-sm-12 col-xs-12" align="center">
				<input  disabled type="hidden" name="imprimir"id="imprimir" onclick="ImprimirRep_reportemovimiento_new()" value="<?php echo _("imprimir");?>">
				<button class="btn btn-warning" disabled type="button" name="imprimir1"id="imprimir1" onclick="ImprimirRep_reportemovimiento_new()" value="<?php echo _("imprimir movimiento");?>"><i class="glyphicon glyphicon-print"></i> Imprimir</button>
				<button class="btn btn-info"  type="button" name="salir" onclick="conexionPHP_mat('formulario.php','movimiento')" value="<?php echo _("limpiar");?>"><i class="glyphicon glyphicon-repeat"></i> Limpiar</button>
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
<!-- 
traer_mov_mat_transferA
traer_mov_mat_transferD
FUNCIONES UBICADAS EN CONTRIOLADOR ALLI ESTAN LOS CODIGO DE ID_MOV FIJOS EN A0000005 PARA DESCUENTO, Y A0000006 PARA AUMENTO EN MOV_MAT
-->