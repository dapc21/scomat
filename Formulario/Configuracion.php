<?php
	copy("DataBase/Acceso.php","copia");
	$fp = fopen("copia","r");
	while ($linea= fgets($fp))
	{
		if(strstr($linea,'$manejador=')){
			$valor=explode("'",$linea);
			$manejador=trim($valor[1]);
		}
		else if(strstr($linea,'$host=')){
			$valor=explode("'",$linea);
			$host=trim($valor[1]);
		}
		else if(strstr($linea,"$usuario='")){
			$valor=explode("'",$linea);
			$usuario=trim($valor[1]);
		}
		else if(strstr($linea,"$clave='")){
			$valor=explode("'",$linea);
			$clave=trim($valor[1]);
		}
		else if(strstr($linea,'$data_base=')){
			$valor=explode("'",$linea);
			$data_base=trim($valor[1]);
		}
	}
	fclose ($fp);
	unlink('copia');

?>
<br>
<font color="red"><?php echo _("error, la aplicacion no ha sido configurada para conectarse con un manejador de base de datos");?></font>
<H3 align="center">
	<strong><?php echo _("configuracion del manejador de base de datos");?>
	</strong>
</H3>
<form name="f1" >
	<table class="borde" border="1" width="350px" align="CENTER" cellpadding="5">  
		<tr>
			<td>
				<span class="fuente"><?php echo _("manejador");?></span>
			</td>
			<td>
				<span class="fuente">
					<input  type="radio" name="manejador" value="Postgres" checked><?php echo _("PostgreSQL");?>&nbsp;&nbsp;&nbsp;
					<input  type="radio" name="manejador" value="MySql" checked><?php echo _("MySQL");?>&nbsp;&nbsp;&nbsp;
				</span>
			</td>
		</tr>
		<tr>
			<td>
				<span class="fuente"><?php echo _("servidor");?></span>
			</td>
			<td>
				<input  type="text" name="servidor" maxlength="25" size="25" value="<?php echo $host?>">
			</td>
		</tr>
		<tr>
			<td>
				<span class="fuente"><?php echo _("usuario");?></span>
			</td>
			<td>
				<input  type="text" name="login" maxlength="25" size="25" value="<?php echo $usuario?>">
			</td>
		</tr>
		<tr>
			<td>
				<span class="fuente"><?php echo _("contrasena");?></span>
			</td>
			<td>
				<input  type="password" name="password" maxlength="25" size="25" value="<?php echo $clave?>">
			</td>
		</tr>
		<tr>
			<td>
				<span class="fuente"><?php echo _("base de datos");?></span>
			</td>
			<td>
				<input  type="text" name="database" maxlength="25" size="25" value="<?php echo $data_base?>">
			</td>
		</tr>
		<tr>
			<td colspan="2">
				<input name="datagrid" type="checkbox" value=""> <span class="fuente"><?php echo _("restaurar base de datos si no existe");?></span>
			</td>
		</tr>
		<tr>
			<td colspan="2" rowspan="1">
				<br>
				<div align="center">
					<input class="boton"  type="hidden" name="registrar" value="Configurar" onclick="verificar('cambiar','Configuracion')">&nbsp;
					<input  type="hidden" value="" name="<?php echo _("registrar");?>">&nbsp;
					<input  type="hidden" value="" name="<?php echo _("modificar");?>">&nbsp;
					<input  type="hidden" value="" name="<?php echo _("eliminar");?>">
				</div>
			</td>
		</tr></font>
	</table>
</form>	<br>
