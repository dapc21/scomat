<?php require_once "procesos.php"; $ini_u = $_SESSION["ini_u"];  
require_once "Seguridad/Usuario.php";
$obj=new Usuario('','','','','');
if($obj->permisoModulo($acceso,strtoupper('cirre_diario')))
{

	$fecha= date("Y-m-d");
	
$acceso->objeto->ejecutarSql("select * from cirre_diario where fecha_cierre='$fecha'");
if($acceso->objeto->registros>0)
	echo '<div class="error"><br>'._("Error, ya se realiz&oacute; el cierre de d&iacute;a").'</div>';
else{
	
	$acceso->objeto->ejecutarSql("select * from vista_caja where fecha_caja='$fecha' and status_caja_cob='Abierta'");
	if($acceso->objeto->registros>0)
		echo '<div class="error"><br>'._("Error, para realizar el cierre diario se debe cerrar todos los puntos de cobros").'</div>';
	else{
	
?>
<BR><div class="cabe"><?php echo _("cierre diario");?></div>
<form name="f1" >

<table border="0" width="97%" align="CENTER"> 
 <tr>
  <td>
	<fieldset >
	  <legend ><?php echo _("datos de cierre");?></legend>
		<table border="0" width="97%" align="CENTER" cellpadding="4" cellspacing="4"> 
		<input  type="hidden" name="id_cierre" maxlength="12" size="30"onChange="validarcirre_diario()" value="<?php $acceso->objeto->ejecutarSql("select *from cirre_diario  where (id_cierre ILIKE '$ini_u%') ORDER BY id_cierre desc"); echo $ini_u.verCodLong($acceso,"id_cierre")?>">
		<tr>
			<td>
				<span class="fuente"><?php echo _("fecha");?>
				</span>
			</td>
			<td>
				<input disabled type="text" name="fecha_cierre" id="fecha_cierre" maxlength="10" size="10" value="<?php echo date("d/m/Y");?>" >
			</td>
			<td>
				<span class="fuente"><?php echo _("hora");?>
				</span>
			</td>
			<td>
				<input disabled type="text" name="hora_cierre" maxlength="10" size="10" value="<?php echo date("H:i:s");?>" >
			</td>
			<td>
				<span class="fuente"><?php echo _("monto");?>
				</span>
			</td>
			<td>
				<input  disabled type="text" name="monto_total" maxlength="10" size="10" value="<?php echo calMontoCD($acceso,date("Y-m-d")); ?>" >
			</td>
		
		</tr>
		<tr>
			
			<td>
				<span class="fuente"><?php echo _("reporte fiscal z");?></span>
			</td>
			<td COLSPAN="5">
				<input type="text" name="dato" maxlength="10" size="20" value="">
			</td>
		</tr>
		<tr>
			
			<td>
				<span class="fuente"><?php echo _("observacion");?></span>
			</td>
			<td COLSPAN="5">
				<textarea name="obser_cierre" cols="95" rows="1"></textarea>
			</td>
		</tr>
	</table>
	</fieldset>
  </td>		
 </tr>
		
		<tr>
			<td colspan="4" rowspan="1">
				<br>
				<div align="center">
					<input  type="<?php echo $obj->in; ?>" name="registrar" value="<?php echo _("registrar cierre");?>" onclick="verificar('incluir','cirre_diario')">&nbsp;
					<input  type="hidden" name="modificar" value="<?php echo _("modificar");?>" onclick="verificar('modificar','cirre_diario')">&nbsp;
					<input  type="hidden" name="eliminar" value="<?php echo _("eliminar");?>" onclick="verificar('eliminar','cirre_diario')">&nbsp;
					<input  type="button" name="salir" onclick="conexionPHP('formulario.php','cirre_diario1')" value="<?php echo _("limpiar");?>">
				</div>
			</td>
		</tr>

<tr>
  <td>
  <?php
  $fecha=date("Y-m-d");
  
  echo '
<table border="0" width="97%" align="CENTER"> 
<tr>
  <td width="350px">
	<fieldset >
		<legend >'._("resumen por servicio").'</legend>
			<table border="0" width="350px" align="left"> 
			<tr>
			  <td class="fuenteN" width="200px">
				'._("servicio").'
			  </td>		
			  <td class="fuenteN" ALIGN="center" width="50px">
				'._("cant").'
			  </td>	
			  <td class="fuenteN" ALIGN="right" width="80px">
				'._("total").'
			  </td>	
			 </tr>
			 ';
			 $dato=lectura($acceso,"SELECT *FROM servicios where status_serv='ACTIVO'");
			 $totalG=0;
			for($k=0;$k<count($dato);$k++){
				$id_serv=trim($dato[$k]["id_serv"]);
				$acceso->objeto->ejecutarSql("SELECT costo_cobro,cant_serv FROM vista_pago_ser where fecha_pago='$fecha' and id_serv='$id_serv' and status_pago='PAGADO'");
				$suma=0;
				$cont=0;
				while ($row=row($acceso))
				{
					$cant=trim($row["cant_serv"]);
					$tar=trim($row["costo_cobro"]);
					$suma=$suma+($cant*$tar);
					$cont=$cont+$cant;
				}
				$total=$suma;
				$totalG=$totalG+$total;
				if($total>0){
					echo '<tr><td class="fuente">
							'.strtoupper(utf8_decode(trim($dato[$k]["nombre_servicio"]))).'
						  </td>		
						  <td class="fuente" ALIGN="center">
							'.$cont.'
						  </td>	
						  <td class="fuente" ALIGN="right">
							'.number_format($total+0, 2, ',', '.').'
						  </td>	
						  </tr>';
					
					
				}
			}
		echo '
			<tr>
			  <td class="fuenteN" width="200px" >
				'._("total").'
			  </td>		
			  <td class="fuenteN" ALIGN="center" width="50px">
				
			  </td>	
			  <td class="fuenteN" ALIGN="right" width="80px">
				'.number_format($totalG+0, 2, ',', '.').'
			  </td>	
			 </tr>
		</table>
	</fieldset>
  </td>		
  <td width="30px">
	&nbsp;&nbsp;&nbsp;
  </td>		
 
 <td width="320px" valign="top">
	<fieldset >
		<legend >'._("resumen por forma de pago").'</legend>
			<table border="0" width="350px" align="CENTER"> 
			<tr>
			  <td class="fuenteN" width="220px">
				'._("forma de pago").'
			  </td>		
			  <td class="fuenteN" ALIGN="right" width="100px">
				'._("total").'
			  </td>	
			 </tr>
			 ';
			 $dato=lectura($acceso,"SELECT *FROM tipo_pago where status_pago='ACTIVO'");
			for($k=0;$k<count($dato);$k++){
				$id_tipo_pago=trim($dato[$k]["id_tipo_pago"]);
				$acceso->objeto->ejecutarSql("SELECT sum(monto_tp) as monto_tp FROM vista_tipopago where fecha_pago='$fecha' and id_tipo_pago='$id_tipo_pago' and status_pago='PAGADO'");
				$suma=0;
				if($row=row($acceso))
				{
					$suma=$suma+trim($row["monto_tp"]);
				}
				$total=$suma;
				if($total>0){
					
					echo '<tr><td class="fuente">
							'.trim($dato[$k]["tipo_pago"]).'
						  </td>		
						  
						  <td class="fuente" ALIGN="right">
							'.number_format($total+0, 2, ',', '.').'
						  </td>	
						  </tr>';
				}
			}
		echo '
			 <tr>
			  <td class="fuenteN" width="200px" >
				'._("total").'
			  </td>		
			  
			  <td class="fuenteN" ALIGN="right" width="80px">
				'.number_format($totalG+0, 2, ',', '.').'
			  </td>	
			 </tr>
			</table>		
	</fieldset>
  </td>		
 </tr>
</table>


';
  ?>
  
  
  
	<br>
	<fieldset >
		<legend ><?php echo _("detalles de los puntos de cobros");?></legend>
			<div id="datagrid" class="data">
<?php
require 'include/eyedatagrid/class.eyepostgresadap.inc.php';
require 'include/eyedatagrid/class.eyedatagrid.inc.php';
$x = new EyeDataGrid($db);

$x->setQuery("id_caja_cob,nombre_caja,apellido,monto_acum,nombre,fecha_caja,apertura_caja,cierre_caja","vista_caja","","fecha_caja='$fecha' and status_caja_cob='CERRADA'");
$x->hideColumn('id_caja_cob');
$x->hideColumn('apellido');
$x->setColumnHeader("nombre_caja", _("punto de cobro"));
$x->setColumnHeader("monto_acum", _("monto"));
$x->setColumnHeader("nombre", _("cobrador"));
$x->setColumnHeader("fecha_caja", _("fecha"));
$x->setColumnHeader("apertura_caja", _("hora apertura"));
$x->setColumnHeader("cierre_caja", _("hora cierre"));

$x->setColumnType('fecha_caja', EyeDataGrid::TYPE_DATE, 'd/m/Y',true);

$x->setClase("CierreDiario");
//$x->addRowSelect("ImprimirRep_detcob('%id_caja_cob%')");
//$x->addStandardControl(EyeDataGrid::STDCTRL_PRINT, "ImprimirRep_detcob('%id_caja_cob%')");
$x->addStandardControl(EyeDataGrid::STDCTRL_SAVE, "GuardarRep_detcob('%id_caja_cob%')");

$x->hideOrder();
$x->showRowNumber();

//mostrar resultados por pagina
if(isset($_GET['tblresul'])){
	if (trim($_GET['tblresul'])>0) {
	   $x->setResultsPerPage(trim($_GET['tblresul']));
	}
}
else{
	$acceso=conexion();
	$acceso->objeto->ejecutarSql("select valor_param from parametros where id_param='9'");
	if($row=$acceso->objeto->devolverRegistro()){
		if(trim($row["valor_param"])>0) {
		   $x->setResultsPerPage(trim($row["valor_param"]));
		}
	}
}

$x->printTable();				

//echo '<br><div align="center"><input  type="button" name="imprimir" value="IMPRIMIR PUNTOS DE COBROS" onclick="ImprimirRep_CierreDiario()">&nbsp;</div>';
?>
				</div>			
	</fieldset>
  </td>		
 </tr>
</table>
</form>
<?php 
}
}
?>

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