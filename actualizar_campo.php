<?php session_start();
require_once "procesos.php"; $ini_u = $_SESSION["ini_u"];  
require_once "Seguridad/Usuario.php";
$obj=new Usuario('','','','','');
//if($obj->permisoModulo($acceso,strtoupper('actualizar_campo')))
if($obj->permisoModulo($acceso,strtoupper('actualizar_campo')))
{

$valor_ant=$_GET['valor'];
$id_cont_serv=$_GET['condicion'];
//echo ":$id_cont_serv:";

if($obj->el=="hidden"){
	$validam="validaMontoDeb()";
}
else{
	$validam='';
}

	$acceso->objeto->ejecutarSql("select tarifa_ser from vista_tarifa,contrato_servicio_deuda where vista_tarifa.id_serv=contrato_servicio_deuda.id_serv and id_cont_serv='$id_cont_serv'");
	if($row=row($acceso))
	{
		$tarifa_ser=trim($row["tarifa_ser"]);
	}

?>

		<!--AplicaTem-->
			<link rel="stylesheet" type="text/css" href="estilos/reset.css">
			<link rel="stylesheet" type="text/css" href="estilos/css.css">
			<script language="JavaScript" type="text/javascript" src="javascript/validacion.js"> </script>
			<script language="JavaScript" type="text/javascript" src="javascript/ajax.js"></script>
			<script language="JavaScript" type="text/javascript" src="javascript/validacionAjax.js"></script>
			<script language="JavaScript" type="text/javascript" src="javascript/controlador.js"></script>  
			<script language="JavaScript" type="text/javascript" src="Programador/script.js"></script>
		<!--Fin AplicaTem-->
		<!--datepicker  epoch-->
			<link rel="stylesheet" type="text/css" href="include/epoch/epoch_styles.css" >
			<script type="text/javascript" src="include/epoch/epoch_classes.js"></script>
		<!--fin datepicker epoch-->
		<!--DataGrid-->
			<link rel="stylesheet" type="text/css" href="include/eyedatagrid/table.css" >
			<script type="text/javascript" src="include/eyedatagrid/eyedatagrid.js"></script>
		<!-- fin DataGrid -->
<body bgcolor="#ffffff">
<BR><div class="cabe"><?php echo _("actualizar cargo");?></div>

<form name="f1" >
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
					<input  type="radio" name="tipo_nota" value="NOTA CREDITO" <?php if($obj->in=="button"){ ECHO "CHECKED";}else{ echo " DISABLED";};?>  onchange="aplica_nota()"><?php echo _("NOTA CREDITO");?>&nbsp;&nbsp;&nbsp;
					<input  type="radio" name="tipo_nota" value="NOTA DEBITO"  <?php if($obj->in!="button"){ ECHO "CHECKED";};?>  onchange="aplica_nota();"><?php echo _("NOTA DEBITO");?>
				</span>
			</td>
			
		</tr>
		<tr>
			<td width="200px">
				<span class="fuente"><?php echo _("monto cargo");?></span>
			</td>
			<td>
				<input disabled type="text" name="monto_resta" maxlength="8" style="width: 125px;" onchange="<?php echo $validam;?>" value="<?php echo $_GET['valor']?>">
				<input disabled type="hidden" name="costo_cargo" maxlength="8" style="width: 125px;" value="<?php echo $tarifa_ser;?>">
			</td>
			
		</tr>
		<tr>
			<td width="200px">
				<span class="fuente"><?php echo _("monto debito/credito");?></span>
			</td>
			<td>
				<input onKeyUp="aplica_nota();" type="text" name="monto_dc" maxlength="8" style="width: 125px;" onchange="<?php echo $validam;?>" value="0">
			
				
				<input disabled type="text" name="campo" maxlength="8" style="width: 100px;" onchange="<?php echo $validam;?>" value="<?php echo $_GET['valor']?>">
			</td>
			
		</tr>
		<tr>
			<td>
				<span class="fuente"><?php echo _("dias a descontar");?>
				</span>
			</td>
			<td>
				<select name="dias" id="dias" onchange="calcula_dias_cargo()" style="width: 250px;">
					<?php echo "<option value='0'>SELECCIONE SI ES POR DIA</option><option value='1'>1 D&iacute;a</option>";
					for($i=2;$i<=30;$i++){echo "<option value='$i'>$i D&iacute;as</option>"; }?>
				</select>
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
				<textarea name="comentario" style="width: 250px; height: 40px;"></textarea>
			</td>
		</tr>
		<tr>
			<td colspan="2" rowspan="1">
				
				<div align="center">
					<input  type="<?php echo $obj->mo;?>" name="registrar" value="Actualizar" onclick="RespActualizarCampo('<?php echo $_GET['tabla']?>','<?php echo $_GET['campo']?>','<?php echo $_GET['valor']?>','<?php echo $_GET['condicion']?>','<?php echo $_GET['validacion']?>')">
				</div>
			</td>
		</tr>
		
	</table>
	</fieldset>
  </td>		
 </tr>
	
</table>
</form>
<script>
	var monto=parseInt("<?php echo $_GET['valor']?>");
	function validaMontoDeb(){
		if(parseInt(document.f1.campo.value)<monto){
			alert("Aviso, usted solo tiene permiso para crear notas de debito")
			document.f1.campo.value=monto;
		}
	}
	document.f1.monto_dc.select();
//alert('<?php echo $_GET['tabla']?>'+":"+'<?php echo $_GET['campo']?>'+":"+'<?php echo $_GET['valor']?>'+":"+'<?php echo $_GET['condicion']?>')
</script>

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