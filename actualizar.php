<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" lang="en" xml:lang="en">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
</head>
		<!--AplicaTem-->
			<link rel="stylesheet" type="text/css" href="estilos/reset.css">
			<link rel="stylesheet" type="text/css" href="estilos/css.css">
			<script language="JavaScript" type="text/javascript" src="javascript/js_corto/validacion.js"> </script>
			<script language="JavaScript" type="text/javascript" src="javascript/js_corto/ajax.js"></script>
			<script language="JavaScript" type="text/javascript" src="javascript/js_corto/validacionAjax.js"></script>
			<script language="JavaScript" type="text/javascript" src="javascript/js_corto/controlador.js"></script> 
			<script type="text/javascript" src="javascript/file_js.php"></script>			

<body bgcolor="#ffffff">
<?php
$clase=$_GET['clase'];
include "Formulario/$clase.php";
?>
</body>
</html>
<?php

switch($clase)
{
	case act_datos:
?>
		<script type="text/javascript">
			conexionPHP("validarExistencia.php","1=@vista_contrato","id_contrato=@<?php echo $_GET['id_contrato'];?>");
		</script>
<?php
	break;
	case asig_orden:
?>
		<script type="text/javascript">
			document.f1.id_contrato.value="<?php echo $_GET['id_contrato'];?>";
			conexionPHP('informacion.php',"verificaOrden",id_contrato());
			//conexionPHP("validarExistencia.php","1=@vista_contrato","id_contrato=@");
		</script>
<?php
	break;
	case visitas:
?>
		
	<!--Temas calendar-->
			<link rel="stylesheet" type="text/css" href="include/dhtmlx/commonCalendar/codebase/dhtmlxcalendar.css"></link>
			<link rel="stylesheet" type="text/css" href="include/dhtmlx/commonCalendar/codebase/skins/dhtmlxcalendar_dhx_skyblue.css"></link>
			<script src="include/dhtmlx/commonCalendar/codebase/dhtmlxcalendar.js"></script>  
		<!--calendar-->
		<!--DataGrid-->
			<link rel="stylesheet" type="text/css" href="include/eyedatagrid/table.css" >
			<script type="text/javascript" src="include/eyedatagrid/eyedatagrid.js"></script>
		<!-- fin DataGrid -->
		
		<script type="text/javascript">
			
			myCalendar = new dhtmlXCalendarObject(["fecha_visita"]);
			claseGlobal="final_ordenes_tecnicos";
			document.f1.id_orden.value="<?php echo $_GET['id_orden'];?>";
			
						divDataGrid="datagrid"; params = ''; tblpage = ''; tblorder = ''; tblfilter = '';
						archivoDataGrid="procesos/datagrid_visitas.php?&id_orden="+id_orden()+"&";
						updateTable();
		</script>
<?php
	break;
	case verVisitas:
?>
		
	
		<!--DataGrid-->
			<link rel="stylesheet" type="text/css" href="include/eyedatagrid/table.css" >
			<script type="text/javascript" src="include/eyedatagrid/eyedatagrid.js"></script>
		<!-- fin DataGrid -->
		
		<script type="text/javascript">
			
			
						divDataGrid="datagrid"; params = ''; tblpage = ''; tblorder = ''; tblfilter = '';
						archivoDataGrid="procesos/datagrid_verVisitas.php?&id_orden=<?php echo $_GET['id_orden'];?>&";
						updateTable();
		</script>
<?php
	break;
	case asig_orden1:
?>
		<script type="text/javascript">
			document.f1.id_contrato.value="<?php echo $_GET['id_contrato'];?>";
			claseGlobal="ordenes_tecnicos"
			conexionPHP("validarExistencia.php","1=@vista_contrato","id_contrato=@"+document.f1.id_contrato.value);
		</script>
<?php
	break;
	case cargar_d:
?>
		<script type="text/javascript">
			document.f1.id_contrato.value="<?php echo $_GET['id_contrato'];?>";
			claseGlobal="cargar_deuda";
			conexionPHP("validarExistencia.php","1=@vista_contrato","id_contrato=@"+document.f1.id_contrato.value);
		</script>
<?php
	break;


}
?>