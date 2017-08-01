<?php require_once "procesos.php"; $ini_u = $_SESSION["ini_u"];  
require_once "Seguridad/Usuario.php";
$obj=new Usuario('','','','','');
if($obj->permisoModulo($acceso,strtoupper('ent_sal_mat')))
{
?>
<BR><div class="cabe">ENTRADA de materiales</div>
<form name="f1" >

<table border="0" width="97%" align="CENTER"> 

		<tr>
			<td>
			<fieldset >
				<legend >Datos del Material</legend>
				
	<table border="0" width="500px" align="CENTER" bordercolor="" > 
		<input  type="hidden" name="id_mat" maxlength="10" size="10" value="<?php $acceso->objeto->ejecutarSql("select *from materiales  where (id_mat ILIKE '$ini_u%') ORDER BY id_mat desc"); echo $ini_u.verCodLong($acceso,"id_mat")?>">
		<tr>
			<td>
				<span class="fuente">Nro Material
				</span>
			</td>
			<td colspan="3">
				<input type="text" name="numero_mat" maxlength="8" onChange="validarmateriales()" size="10" value="<?php $acceso->objeto->ejecutarSql("select *from materiales ORDER BY numero_mat desc"); echo verNumero($acceso,"numero_mat")?>" >
				<a href="#" onclick="abrirBusq_cont_avanz_mat()" >Listado de Materiales</a>
			</td>
		</tr>
		<tr>
			<td>
				<span class="fuente">Nombre
				</span>
			</td>
			<td colspan="3">
				<input disabled type="text" name="nombre_mat" maxlength="50" size="56" value="" >
			</td>
		</tr>
		<tr>
			<td>
				<span class="fuente">Medida
				</span>
			</td>
			<td>
				<select disabled name="unidad_mat" id="-1" onchange=""  style="width: 116px;">
					<option value="UNIDAD">UNIDAD</option>
					<option value="PAQUETE">PAQUETE</option>
					<option value="METRO">METRO</option>
					<option value="ROLLO">ROLLO</option>
				</select>
			</td>
		
			<td>
				<span class="fuente">Abreviatura
				</span>
			</td>
			<td>
				<input  disabled type="text" name="abrevia_unidad" maxlength="10" size="15" value="u" >
			</td>
		</tr>
		<tr>
			<td>
				<span class="fuente">Cant Existencia
				</span>
			</td>
			<td>
				<input  disabled type="text" name="cant_existencia" maxlength="8" size="15" value="0" >
			</td>
		
			<td>
				<span class="fuente">tipo</span>
			</td>
			<td>
				<input  disabled type="text" name="precio" maxlength="10" size="15" value="0.00" >
			</td>
		</tr>
		
	</table>	
				
			</fieldset>
			</td>		
		</tr>
		<tr>
			<td>
			<br>
	<fieldset >
	<legend >Datos de Entrada</legend>


	<table border="0" width="500px" align="CENTER" bordercolor="" > 
		<input  type="hidden" name="id_ent_sal" maxlength="10" size="15"onChange="validarent_sal_mat()" value="<?php $acceso->objeto->ejecutarSql("select *from ent_sal_mat  where (id_ent_sal ILIKE '$ini_u%') ORDER BY id_ent_sal desc"); echo $ini_u.verCodlong($acceso,"id_ent_sal")?>">
		<input  type="hidden" name="tipo_ent_sal" maxlength="10" size="15" value="Entrada" >
		<tr>
			<td>
				<span class="fuente">Fecha
				</span>
			</td>
			<td>
				<input type="text" name="fecha_ent_sal" id="fecha_ent_sal" maxlength="10" size="15" value="<?php echo date("d/m/Y");?>" >
			</td>
		
			<td>
				<span class="fuente">Hora
				</span>
			</td>
			<td>
				<input disabled type="text" name="hora_ent_sal" maxlength="8" size="15" value="<?php echo date("H:i:s");?>" >
			</td>
		</tr>
		<tr>
			<td>
				<span class="fuente">Cantidad
				</span>
			</td>
			<td>
				<input  type="text" name="cant_ent_sal" maxlength="4" size="15" value="" >
			</td>
		
			<input  type="hidden" name="precio_compra" maxlength="10" size="15" value="0.00" >
			
		</tr>
		<tr>
			<td>
				<span class="fuente">Observacion
				</span>
			</td>
			<td colspan="3">
				<textarea name="observacion" style="width: 348px;" rows="1"></textarea>
			</td>
		</tr>
		<input  type="hidden" value="dato" name="dato">
		
	</table>
	
	</fieldset>
	</td>		
</tr>
		<tr>
			<td colspan="2" rowspan="1">
				<br>
				<div align="center">
					<input  type="<?php echo $obj->in;?>" name="registrar" value="REGISTRAR" onclick="verificar('incluir','ent_sal_mat')">&nbsp;
					<input  type="<?php echo $obj->mo;?>" name="modificar" value="MODIFICAR" onclick="verificar('modificar','ent_sal_mat')">&nbsp;
					<input  type="<?php echo $obj->el;?>" name="eliminar" value="ELIMINAR" onclick="verificar('eliminar','ent_sal_mat')">&nbsp;
					<input  type="button" name="salir" onclick="conexionPHP('formulario.php','ent_sal_mat')" value="LIMPIAR">
				</div>
			</td>
		</tr>
<tr>
  <td>
	<br>
	<fieldset >
		<legend >ENTRADAS RECIENTES</legend>
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