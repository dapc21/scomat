<?php 	session_start();
require_once "procesos.php"; $ini_u = $_SESSION["ini_u"];   
require_once "Seguridad/Usuario.php";
$obj=new Usuario('','','','','');
if($obj->permisoModulo($acceso,strtoupper('REP_LIBROVENTA')))
{
?>
<br>
<div class="cabe"><?php echo _("reporte de cobro");?></div>
<form name="f1" >

<table border="0" width="97%" align="CENTER"> 
 <tr>
  <td>
	<fieldset >
	  <legend ><?php echo _("datos requerido");?></legend>
	  <table border="0" width="97%" align="CENTER" cellpadding="4" cellspacing="4"> 
		<tr>
			<td >
				<span class="fuente"><?php echo _("desde");?></span>
			</td>
			<td>
				<input type="text" name="desde" id="desde" maxlength="10" size="20" value="<?php echo date("d/m/Y");?>" >
			</td>
			<td>
				<span class="fuente"><?php echo _("hasta");?></span>
			</td>
			<td>
				<input type="text" name="hasta" id="hasta" maxlength="10" size="20" value="<?php echo date("d/m/Y");?>" >
			</td>
			<td>
				<span class="fuente"><?php echo _("cobradores");?></span>
			</td>
			<td>
				<select name="id_persona" id="-1" onchange="" style="width: 150px;">
					<?php echo vercob($acceso);?>
				</select>
			</td>
		</tr>
		
		<tr>
			<td COLSPAN="6" ALIGN="CENTER">
				<input  type="button" name="registrar" value="<?php echo _("buscar");?>" onclick="buscar_rep_cobro()">&nbsp;
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
					<input  type="<?php echo $obj->in;?>" name="registrar" value="<?php echo _("imprimir reporte");?>" onclick="ImprimirRep_libroventa()">&nbsp;
					<input  type="<?php echo $obj->in;?>" name="registrarf" value="<?php echo _("descargar reporte");?>" onclick="DescargarRep_libroventa()">&nbsp;
					<input  type="hidden" name="modificar" value="CANCELAR">
					<input  type="hidden" name="eliminar" value="CANCELAR">
					<input  type="hidden" name="Resetear" value="CANCELAR">
				</div>
			</td>
		</tr>
<tr>
  <td>
	<br>
	<fieldset >
		<legend ><?php echo _("facturas encontradas");?></legend>
			<div id="datagrid" class="data"></div>			
	</fieldset>
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