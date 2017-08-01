
		<!--AplicaTem-->
			<link rel="stylesheet" type="text/css" href="estilos/reset.css">
			<link rel="stylesheet" type="text/css" href="estilos/css.css">
			<script language="JavaScript" type="text/javascript" src="javascript/validacion.js"> </script>
			<script language="JavaScript" type="text/javascript" src="javascript/js_corto/ajax.js"></script>
			<script language="JavaScript" type="text/javascript" src="javascript/js_corto/validacionAjax.js"></script>
			<script language="JavaScript" type="text/javascript" src="javascript/js_corto/controlador.js"></script>  
		<!--Fin AplicaTem-->

<body bgcolor="#ffffff">
<?php
$clase=$_GET['clase'];
$dato=$_GET['dato'];
include "add/$clase.php";

?>
</body>
<?php

switch($clase){
	case calle:
?>
		<script type="text/javascript">
			document.f1.id_sector.value="<?php echo $dato;?>";
			traerZona_solo()
		</script>
<?php
	break;
	case sector:
?>
		<script type="text/javascript">
			document.f1.id_zona.value="<?php echo $dato;?>";
			traerFranq()
		</script>
<?php
	break;
	case edificio:
?>
		<script type="text/javascript">
			document.f1.id_calle.value="<?php echo $dato;?>";
			traerSector()
		</script>
<?php
	break;
	case asig_orden:
?>
		<script type="text/javascript">
			document.f1.id_contrato.value="<?php echo $_GET['id_contrato'];?>";
			//conexionPHP("validarExistencia.php","1=@vista_contrato","id_contrato=@");
		</script>
<?php
	break;

}
?>