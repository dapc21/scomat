<?php
require_once("../procesos.php");  $ini_u = $_SESSION["ini_u"]; 
require '../include/eyedatagrid/class.eyepostgresadap.inc.php';
require '../include/eyedatagrid/class.eyedatagrid.inc.php';
$x = new EyeDataGrid($db);

$id_contrato=$_GET['id_contrato'];
	$acceso->objeto->ejecutarSql("select *from vista_contrato where id_contrato='$id_contrato'");
	if($row=row($acceso))
	{
		$nro_contrato=trim($row["nro_contrato"]);
		$cedula=trim($row["cedula"]);
		$nombre=trim($row["nombre"]);
		$apellido=trim($row["apellido"]);
		$telefono=trim($row["telefono"]);
		$telf_casa=trim($row["telf_casa"]);
		$email=trim($row["email"]);
		$direc_adicional=trim($row["direc_adicional"]);
		$numero_casa=trim($row["numero_casa"]);
		$nombre_calle=trim($row["nombre_calle"]);
		$nombre_sector=trim($row["nombre_sector"]);
		$nombre_zona=trim($row["nombre_zona"]);
		$nombre_franq=trim($row["nombre_franq"]);
		$edificio=trim($row["edificio"]);
		$numero_piso=trim($row["numero_piso"]);
		$telf_adic=trim($row["telf_adic"]);
		$fecha_contrato=formatofecha(trim($row["fecha_contrato"]));
		$status_contrato=trim($row["status_contrato"]);
		$status_contrato=trim($row["status_contrato"]);
		$etiqueta=trim($row["etiqueta"]);
		
$modo = $_GET['modo'];
if($modo!="EXCEL"){

echo '
	<hr>
	<fieldset >
	  <legend >'. _('datos personales').'</legend>
		
<table border="0" width="100%" align="CENTER"> 
		<tr>
			<td width="15%">
				<span class="fuente">'. _('nro abonado').':</span>
			</td>
			<td width="25%">
				<span class="fuente">'.$nro_contrato.'</span>
			</td>
			<td width="10%">
				<span class="fuente">'. _('fecha').':</span>
			</td>
			<td width="20%">
				<span class="fuente">'.$fecha_contrato.'</span>
			</td>
			<td width="10%">
				<span class="fuente">'. _('status').':</span>
			</td>
			<td width="15%">
				<span class="fuente">'.$status_contrato.'</span>
			</td>
			
		</tr>
		
		<tr>
			<td width="12%">
				<span class="fuente">'. _('rif / cedula').':</span>
			</td>
			<td width="18%">
				<span class="fuente">'.$cedula.'</span>
			</td>
			<td>
				<span class="fuente">'. _('nombre').':</span>
			</td>
			<td>
				<span class="fuente">'.$nombre.'</span>
			</td>
			<td>
				<span class="fuente">'. _('apellido').':</span>
			</td>
			<td>
				<span class="fuente">'.$apellido.'</span>
			</td>
			
		</tr>
		<tr>
			<td>
				<span class="fuente">'. _('telefono').':</span>
			</td>
			<td>
				<span class="fuente">'.$telefono.'</span>
			</td>
			<td>
				<span class="fuente">'. _('telf casa').':</span>
			</td>
			<td>
				<span class="fuente">'.$telf_casa.'</span>
			</td>
			<td>
				<span class="fuente">'. _('telf adic').':</span>
			</td>
			<td>
				<span class="fuente">'.$telf_adic.'</span>
			</td>
		</tr>
		<tr>
			<td>
				<span class="fuente">'. _('email').':</span>
			</td>
			<td>
				<span class="fuente">'.$email.'</span>
			</td>
			<td>
				<span class="fuente">'. _('etiqueta').':</span>
			</td>
			<td>
				<span class="fuente">'.$etiqueta.'</span>
			</td>
			
		</tr>
	 </table>
	</fieldset >
	<br>
	
	<fieldset >
	  <legend >'. _('datos de ubicaci&oacute').';n</legend>
		
<table border="0" width="100%" align="CENTER"> 
		<tr>
			<td width="15%">
				<span class="fuente">'. _('franquicia').':</span>
			</td>
			<td width="25%">
				<span class="fuente">'.$nombre_franq.'</span>
			</td>
			<td width="10%">
				<span class="fuente">'. _('zona').':</span>
			</td>
			<td width="20%">
				<span class="fuente">'.$nombre_zona.'</span>
			</td>
			<td width="10%">
				<span class="fuente">'. _('sector').':</span>
			</td>
			<td width="15%">
				<span class="fuente">'.$nombre_sector.'</span>
			</td>
			
		</tr>
		
		<tr>
			<td >
				<span class="fuente">'. _('calle').':</span>
			</td>
			<td colspan="3">
				<span class="fuente">'.$nombre_calle.'</span>
			</td>
			<td>
				<span class="fuente">'. _('nro casa').':</span>
			</td>
			<td>
				<span class="fuente">'.$numero_casa.'</span>
			</td>
			
		</tr>
		<tr>
			<td>
				<span class="fuente">'. _('edificio').':</span>
			</td>
			<td colspan="3">
				<span class="fuente">'.$edificio.'</span>
			</td>
			<td>
				<span class="fuente">'. _('nro piso').':</span>
			</td>
			<td>
				<span class="fuente">'.$numero_piso.'</span>
			</td>
			
		</tr>
		<tr>
			<td>
				<span class="fuente">'. _('referencia').':</span>
			</td>
			<td colspan="5">
				<span class="fuente">'.$direc_adicional.'</span>
			</td>
			
		</tr>
	 </table>
	</fieldset >
	<BR>
	<fieldset >
	  <legend >ASIGNACIONES</legend>
	 ';
	
}

$x->setQuery("fecha_orden,nombre_tipo_orden,nombre_det_orden,prioridad,status_orden,fecha_final,comentario_orden","vista_orden","","id_contrato='$id_contrato'");
$x->setColumnHeader("fecha_orden", _("fecha"));
$x->setColumnHeader("nombre_tipo_orden", _("tipo orden"));
$x->setColumnHeader("nombre_det_orden", _("nombre orden"));
$x->setColumnHeader("prioridad", _("prioridad"));
$x->setColumnHeader("fecha_final", _("fecha final"));
$x->setColumnHeader("status_orden", _("status"));
$x->setColumnHeader("comentario_orden", _("comentario"));

//$x->hideOrder();
$x->setColumnType('fecha_orden', EyeDataGrid::TYPE_DATE, 'd/m/Y',true);
$x->setColumnType('fecha_final', EyeDataGrid::TYPE_DATE, 'd/m/Y',true);
$x->allowFilters();
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
echo '</fieldset >';
echo '<br><div align="center"><input  type="button" name="registrar" value="'. _('imprimir').'" onclick="ImprimirRep_estadocuenta(\''.$id_contrato.'\')"> 
<input  type="button" name="registrar" value="'. _('guardar').'" onclick="GuardarRep_estadocuenta(\''.$id_contrato.'\')"></div>';

}
else{
	echo '<div class="error"><br>'. _('error, el numero de contrato o la cedula no estan registrados').'</div>';
}
?>
