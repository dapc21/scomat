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
<font color="red">Error, la aplicaci&oacute;n no ha sido configurada para conectarse con un manejador de base de datos</font>
<H3 align="center">
	<strong>Configuraci&oacute;n del Manejador de Base de Datos
	</strong>
</H3>
<form name="f1">
	<table class="borde" border="1" width="350px" align="CENTER" cellpadding="5">  
		<tr>
			<td>
				<span class="fuente">Manejador</span>
			</td>
			<td>
				<span class="fuente">
					<input  type="radio" name="manejador" value="Postgres" checked>PostgreSQL&nbsp;&nbsp;&nbsp;
					<input  type="radio" name="manejador" value="MySql" checked>MySQL&nbsp;&nbsp;&nbsp;
				</span>
			</td>
		</tr>
		<tr>
			<td>
				<span class="fuente">Servidor</span>
			</td>
			<td>
				<input  type="text" name="servidor" maxlength="25" size="25" value="<?php echo $host?>">
			</td>
		</tr>
		<tr>
			<td>
				<span class="fuente">Usuario</span>
			</td>
			<td>
				<input  type="text" name="login" maxlength="25" size="25" value="<?php echo $usuario?>">
			</td>
		</tr>
		<tr>
			<td>
				<span class="fuente">Contrase&ntilde;a</span>
			</td>
			<td>
				<input  type="password" name="password" maxlength="25" size="25" value="<?php echo $clave?>">
			</td>
		</tr>
		<tr>
			<td>
				<span class="fuente">Base de Datos</span>
			</td>
			<td>
				<input  type="text" name="database" maxlength="25" size="25" value="<?php echo $data_base?>">
			</td>
		</tr>
		<tr>
			<td colspan="2">
				<input name="datagrid" type="checkbox" value=""> <span class="fuente">Restaurar Base de Datos si no existe</span>
			</td>
		</tr>
		<tr>
			<td colspan="2" rowspan="1">
				<br>
				<div align="center">
					<input class="boton"  type="button" name="registrar" value="Configurar" onclick="verificar_mat('cambiar','Configuracion')">&nbsp;
					<input  type="hidden" value="" name="registrar">&nbsp;
					<input  type="hidden" value="" name="modificar">&nbsp;
					<input  type="hidden" value="" name="eliminar">
				</div>
			</td>
		</tr></font>
	</table>
</form>	<br>
