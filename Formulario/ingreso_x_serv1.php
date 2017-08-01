<?php 	session_start();
require_once "procesos.php"; $ini_u = $_SESSION["ini_u"];   
require_once "Seguridad/Usuario.php";
$obj=new Usuario('','','','','');
if($obj->permisoModulo($acceso,strtoupper('REP_LIBROVENTA')))
{
?>
<br>
<div class="cabe"><?php echo _("ingresos por cargos");?></div>
<form name="f1" >

<table border="0" width="97%" align="CENTER"> 
 <tr>
  <td>
	<fieldset >
	  <legend ><?php echo _("ingresos");?></legend>
	  <table border="0" width="97%" align="CENTER" cellpadding="4" cellspacing="4"> 
		<tr>
			<td>
				<span class="fuente"><?php echo _("mes a analizar");?></span>
			</td>
			<td>
				<select name="mes" id="mes" onchange="" style="width: 146px;">
					<?php echo verMesCorte();?>
				</select>
			</td>
			<td>
				<span class="fuente"><?php echo _("nro meses ant.");?></span>
			</td>
			<td>
				<select name="mes_a" id="mes_a" onchange="" style="width: 50px;">
					<option value="0"><?php echo _("0");?></option>
					<option value="1"><?php echo _("1");?></option>
					<option value="2"><?php echo _("2");?></option>
					<option value="3"><?php echo _("3");?></option>
					<option value="4"><?php echo _("4");?></option> 
					
				</select>
			</td>
			<td>
				<span class="fuente"><?php echo _("nro Meses pos.");?></span>
			</td>
			<td>
				<select name="mes_p" id="mes_p" onchange="" style="width: 50px;">
					<option value="0"><?php echo _("0");?></option>
					<option value="1"><?php echo _("1");?></option>
					<option value="2"><?php echo _("2");?></option>
					<option value="3"><?php echo _("3");?></option>
					<option value="4"><?php echo _("4");?></option> 
				</select>
			</td>
			
			
			
		</tr>
		<tr>
			
			<td  align="right">
				<span class="fuente"><?php echo _("con fecha desde");?></span>
			</td>
			<td>
				<input type="text" name="desde" id="desde" maxlength="10" size="10" value="<?php echo date("d/m/Y");?>" >
			</td>
			<td>
				<span class="fuente"><?php echo _("hasta");?></span>
			</td>
			<td>
				<input type="text" name="hasta" id="hasta" maxlength="10" size="10" value="<?php echo date("d/m/Y");?>" >
			</td>
			<td >
			<!--	<input  type="button" name="registrar" value="Buscar" onclick="buscar_rep_libroventa()">&nbsp; -->
			</td>
		</tr>
	</table>
	</fieldset>
  </td>		
 </tr>
		<tr>
			<td colspan="5">
				<br>
				
				<div align="center">
					<input  type="hidden" name="registrar" value="<?php echo _("imprimir reporte");?>" onclick="ImprimirRep_libroventa()">&nbsp;
					<input  type="<?php echo $obj->in;?>" name="registrarf" value="<?php echo _("descargar reporte");?>" onclick="DescargarRep_ingreso_x_serv1()">&nbsp;
					<input  type="hidden" name="modificar" value="<?php echo _("cancelar");?>">
					<input  type="hidden" name="eliminar" value="<?php echo _("eliminar");?>">
					<input  type="hidden" name="Resetear" value="<?php echo _("resetear");?>">
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