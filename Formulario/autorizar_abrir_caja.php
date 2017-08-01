<?php session_start();require_once "procesos.php"; $ini_u = $_SESSION["ini_u"];  
$login= $_SESSION["login"];  
require_once "Seguridad/Usuario.php";
$obj=new Usuario('','','','','');
if($obj->permisoModulo($acceso,strtoupper('AUTORIZARABRIRCAJA')))
{
?>
<BR><div class="cabe"><?php echo _("AUTORIZAR APERTURA DE CAJA");?></div>
<form name="f1" action="javascript:;">
<table border="0" width="97%" align="CENTER" > 
 <tr>
  <td>
	<fieldset >
	  <legend ><?php echo _("datos a registrar");?></legend>
		
		<table border="0" width="97%" align="CENTER" cellpadding="4" cellspacing="4">
		
		<tr>
			<td>
				<span class="fuente">franquicias
				</span>
			</td>
			<td COLSPAN="3"> 
				<select name="id_franq" id="id_franq" onchange="" style="width: 500px;">
					<?php echo verFranq($acceso);?>
				</select>
			</td>
		</tr>
		
		
		</table>
		</fieldset>
</td>		
 </tr>
		<tr>
			<td colspan="2" rowspan="1">
				<br>
				<div align="center">
					<input  type="<?php echo $obj->in; ?>" name="registrar" value="AUTORIZAR APERTURA" onclick="verificar('incluir','autorizar_abrir_caja')">&nbsp;
					<input  type="HIDDEN" name="modificar" value="MODIFICAR" onclick="verificar('modificar','autorizar_abrir_caja')">&nbsp;
					<input  type="HIDDEN" name="eliminar" value="ELIMINAR" onclick="verificar('eliminar','autorizar_abrir_caja')">&nbsp;
					<input  type="button" name="salir" onclick="conexionPHP('formulario.php','autorizar_abrir_caja')" value="<?php echo _("limpiar");?>">
				</div>
			</td>
		</tr>
		
 <tr>
  <td>
	<br>
	<fieldset >
		<legend ><?php echo _("franquicias autorizadas manualmente");?></legend>
			<div id="datagrid" class="data">
		
		
			</div>			
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