<?php session_start();
require_once "procesos.php"; $ini_u = $_SESSION["ini_u"];  
require_once "Seguridad/Usuario.php";
$obj=new Usuario('','','','','');
//if($obj->permisoModulo($acceso,strtoupper('actualizar_campo')))
if($obj->permisoModulo($acceso,strtoupper('pagos')))
{

$id_cont_serv=$_GET['id_cont_serv'];
$descu=$_GET['descu'];
//echo "select * from contrato_servicio_deuda where id_cont_serv='$id_cont_serv'";
$acceso->objeto->ejecutarSql("select * from contrato_servicio_deuda where id_cont_serv='$id_cont_serv'");
	$cad='';
	if($row=row($acceso)){
		$id_serv = trim($row["id_serv"]);
		$id_contrato = trim($row["id_contrato"]);
		$fecha_inst = trim($row["fecha_inst"]);
		$cant_serv = trim($row["cant_serv"]);
		$status_con_ser = trim($row["status_con_ser"]);
		$costo_cobro = trim($row["costo_cobro"])*$cant_serv;
		$descu = trim($row["descu"]);
		$total=$costo_cobro-$descu;
	}

?>

		<link rel="stylesheet" type="text/css" href="estilos/reset.css">
			<link rel="stylesheet" type="text/css" href="estilos/css.css">
			<script language="JavaScript" type="text/javascript" src="javascript/validacion.js"> </script>
			<script language="JavaScript" type="text/javascript" src="javascript/js_corto/ajax.js"></script>
			<script language="JavaScript" type="text/javascript" src="javascript/js_corto/validacionAjax.js"></script>
			<script language="JavaScript" type="text/javascript" src="javascript/js_corto/controlador.js"></script> 
			
<body bgcolor="#ffffff">
<BR><div class="cabe">aplicar descuento</div>

<form name="f1" >
<table border="0" width="450px" align="CENTER" > 
 <tr>
  <td>
	<fieldset >
	<table border="0" width="100%" align="CENTER"  cellpadding="4" cellspacing="4">
		<tr>
			<td width="200px">
				<span class="fuente">sub-total</span>
			</td>
			<td>
				<input type="HIDDEN" name="id_cont_serv" maxlength="8" style="width: 150px;"  value="<?php echo $id_cont_serv;?>">
				<input type="HIDDEN" name="id_contrato" maxlength="8" style="width: 150px;"  value="<?php echo $id_contrato;?>">
				<input disabled type="text" name="monto" maxlength="8" style="width: 150px;" onchange="<?php echo $validam;?>" value="<?php echo $costo_cobro;?>">
			</td>
		</tr>
		<tr>
			<td width="200px">
				<span class="fuente">descuento</span>
			</td>
			<td>
				<input onKeyUp="aplicaDesc();" type="text" name="monto1" maxlength="8" style="width: 150px;" onchange="" value="<?php echo $descu;?>">
				
			</td>
		</tr>
		<tr>
			<td width="200px">
				<span class="fuente">Total</span>
			</td>
			<td>
				<input disabled type="text" name="monto2" maxlength="8" style="width: 150px;" onchange="" value="<?php echo $total;?>">
			</td>
		</tr>
		<tr>
			<td colspan="2" rowspan="1">
				<div align="center">
					<input  type="BUTTON" name="registrar" value="aplicar descuento" onclick="incluirDesc()">
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
	document.f1.monto1.select();
	var monto=parseInt("<?php echo $_GET['valor']?>");
	function validaMontoDeb(){
		if(parseInt(document.f1.campo.value)<monto){
			alert("Aviso, usted solo tiene permiso para crear notas de debito")
			document.f1.campo.value=monto;
		}
	}
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