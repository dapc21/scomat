<?php session_start();
require_once "procesos.php"; $ini_u = $_SESSION["ini_u"];  
require_once "Seguridad/Usuario.php";
$obj=new Usuario('','','','','');
//if($obj->permisoModulo($acceso,strtoupper('actualizar_campo')))
if($obj->permisoModulo($acceso,strtoupper('actualizar_campo')))
{

//$id_cont_serv=$_GET['id_cont_serv'];
$id_cont_serv = trim($_POST['id_cont_serv']);

if($obj->el=="hidden"){
	$validam="validaMontoDeb()";
}
else{
	$validam='';
}

	$acceso->objeto->ejecutarSql("select tarifa_ser,costo_cobro from vista_tarifa,contrato_servicio_deuda where vista_tarifa.id_serv=contrato_servicio_deuda.id_serv and id_cont_serv='$id_cont_serv'");
	if($row=row($acceso))
	{
		$tarifa_ser=trim($row["tarifa_ser"]);
		$costo_cobro=trim($row["costo_cobro"]);
	}

?>

		<!--
			<link rel="stylesheet" type="text/css" href="estilos/reset.css">
			<link rel="stylesheet" type="text/css" href="estilos/css.css">
			<script language="JavaScript" type="text/javascript" src="javascript/validacion.js"> </script>
			<script language="JavaScript" type="text/javascript" src="javascript/js_corto/ajax.js"></script>
			<script language="JavaScript" type="text/javascript" src="javascript/js_corto/controlador.js"></script>
		-->
		
<body bgcolor="#ffffff">
<BR><div class="cabe"><?php echo _("Solicitar NOTA CREDITO / DEBITO");?></div>

<table border="0" width="450px" align="CENTER" > 
 <tr>
  <td>
	<fieldset >
	<table border="0" width="100%" align="CENTER"  cellpadding="4" cellspacing="4">
		<tr>
			<td width="150px">
				<span class="fuente"><?php echo _("tipo");?>
				</span>
			</td>
			<td width="170px">
				<span class="fuente">
					<input  type="radio" name="tipo_nota" id="tipo_nota1" value="NOTA DE CREDITO" <?php if($obj->in=="button"){ ECHO "CHECKED";}else{ echo " DISABLED";};?>  onchange="aplica_nota_dc()"><?php echo _("NOTA DE CREDITO");?>&nbsp;&nbsp;&nbsp;
					<input  type="radio" name="tipo_nota" id="tipo_nota2" value="NOTA DE DEBITO"  <?php if($obj->in!="button"){ ECHO "CHECKED";};?>  onchange="aplica_nota_dc();"><?php echo _("NOTA DE DEBITO");?>
				</span>
			</td>
			
		</tr>
		<tr>
			<td width="200px">
				<span class="fuente"><?php echo _("monto cargo");?></span>
			</td>
			<td>
				<input disabled type="text" name="monto_resta" id="monto_resta" maxlength="8" style="width: 125px;" onchange="<?php echo $validam;?>" value="<?php echo $costo_cobro; ?>">
				<input disabled type="hidden" name="costo_cargo" id="costo_cargo" maxlength="8" style="width: 125px;" value="<?php echo $tarifa_ser;?>">
				<input disabled type="hidden" name="dias" id="dias" maxlength="8" style="width: 125px;" value="0">
				<input type="hidden" id="id_cont_serv" maxlength="8" style="width: 125px;" value="<?php echo $id_cont_serv;?>">
			</td>
			
		</tr>
		<tr>
			<td width="200px">
				<span class="fuente"><?php echo _("monto debito/credito");?></span>
			</td>
			<td>
				<input onKeyUp="aplica_nota_dc();" type="text" name="monto_dc" id="monto_dc" maxlength="8" style="width: 125px;" onchange="<?php echo $validam;?>" value="0">
			
				
				<input disabled type="text" name="campo" id="campo" maxlength="8" style="width: 100px;" onchange="<?php echo $validam;?>" value="<?php echo $costo_cobro; ?>">
			</td>
			
		</tr>
		<tr>
			<td>
				<span class="fuente"><?php echo _("clasificacion motivo");?></span>
			</td>
			<td>
				<select name="motivo" id="motivo" onchange="" style="width: 250px;">
					<?php echo verMotivoNotas($acceso);?>
				</select>
			</td>
			
		</tr>
		<tr>
			<td width="120px">
				<span class="fuente"><?php echo _("describa motivo");?></span>
			</td>
			<td>
				<textarea name="comentario" id="comentario" style="width: 250px; height: 40px;"></textarea>
			</td>
		</tr>
		
		
	</table>
	</fieldset>
  </td>		
 </tr>
	
</table>



</body>
<?php 
	}
	else{
		echo '<p align="center"><img   style="background:#FFFFFF" src="imagenes/Error.jpg" width="255px" height="255px" /></p><br>
		<div align="center">
					<input  type="button" name="registrar" value="INICIAR SESI&Oacute;N" onclick="conexionPHP(\'formulario.php\',\'Sesion\')">&nbsp;
				</div>
		';
	}
?>