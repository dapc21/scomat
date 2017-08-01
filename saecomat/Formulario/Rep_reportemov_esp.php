<?php require_once "procesos.php";  $ini_u = $_SESSION["ini_u"];  
require_once "../Seguridad/Usuario.php";
$obj=new Usuario('','','','','');
if($obj->permisoModulo($acceso,strtoupper('REP_REPORTEMOVIMIENTO'))){
?>


<BR><div class="cabe"><?php echo _("reporte de movimientos Acumulados Especifico");?></div>

<form name="f1">
	<table border="0" width="97%" align="CENTER" > 
	<tr>
		<td>
			<fieldset >
			  <legend ><?php echo _("datos pedido");?></legend>				
				<table border="0" width="97%" align="CENTER" cellpadding="4" cellspacing="4"> 
					
					<tr>
						<td>
							<span class="fuente"><?php echo _("deposito");?>
							</span>
						</td>
						<td>
							<select name="id_dep" id="id_dep" onchange="filtraReporMov_esp();"style="width: 150px;">
								<?php echo verSoloDeposito($acceso);?>
							</select>
						</td>
					</tr>
					<tr>
							<td>
								<span class="fuente" ><?php echo _("fecha desde");?>
								</span>
							</td>
							<td>
								<input  type="text"  name="	" id="fechades"maxlength="12" size="20" value="<?php echo date("d/m/Y");?>" >
							</td>
							<td>
								<span class="fuente"><?php echo _("fecha hasta");?>
								</span>
							</td>
							<td>
								<input  type="text"  name="fechahas" id="fechahas"  maxlength="12" size="20" value="<?php echo date("d/m/Y");?>" >
							</td>
					</tr>
					<tr>
						<td>
							<span class="fuente"><?php echo _("tipos");?>
							</span>
						</td>
						<td>
							<select name="tipo_ent_sal" id="tipo_ent_sal" onchange="traerTipomov();" style="width: 150px;">
								<option value="0"><?php echo _("seleccione...");?></option>
								<option value="ENTRADA"><?php echo _("ENTRADA");?></option>
								<option value="SALIDA"><?php echo _("SALIDA");?></option>
							</select>
							
						</td>
						<td>
						<span class="fuente"><?php echo _("tipo de movimiento");?>
						</span>
					</td>
					<td>
						<select name="id_tm" id="id_tm" onchange="traerTM()" style="width: 150px;">
							<?php echo verTipoMovimentoCompleto($acceso);?>
						</select>
						
					</td>
					</tr>
					<tr>
					<td>
							<span class="fuente"><?php echo _("tipo contraparte");?>
							</span>
						</td>
						<td>
							<select name="id_te" id="id_te" onchange="traerTipocon();" style="width: 150px;">
								<?php echo verTipoEntidad1($acceso);?>
							</select>
						</td>
					
					<td>
						<span class="fuente"><?php echo _("contraparte");?>
						</span>
						
					</td>
					<td>
						<select name="id_persona" id="id_persona" onchange="traerTC()" style="width: 150px;">
							<?php echo verEntidad1($acceso);?>
						</select>
					</td>
				</tr>				
								
					<input  type="hidden" value="dato" name="dato">
				</table>
			</fieldset>
		</td>		
	</tr>
	<tr>	
		<td colspan="4">
			<center>
				<input  type="button" name="buscar" onclick="filtraReporMov_esp()" value="<?php echo _("buscar");?>">
				<input  type="button" name="imprimir" onclick="imprimirReporMov_esp()" value="<?php echo _("imprimir");?>">
				<input  type="button" name="salir" onclick="conexionPHP_mat('formulario.php','Rep_reportemov_esp')" value="<?php echo _("limpiar");?>">
			</center>
		</td>
	</tr>
	</table>
	<table border="0" width="100%" align="CENTER"> 
		<tr>
			<td colspan="2">
				<div id="datagrid">
					
				</div>
			</td>
		</tr>
		<tr>
			<td colspan="2">
				<br>
				
				<div align="center">
					<input  type="hidden" name="registrar" value="IMPRIMIR REPORTE" onclick="ImprimirRep_reportemovimiento()">&nbsp;
					<input  type="hidden" name="modificar" value="CANCELAR">
					<input  type="hidden" name="eliminar" value="CANCELAR">
					<input  type="hidden" name="Resetear" value="CANCELAR">
				</div>
			</td>
		</tr>
	</table>
</form>
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