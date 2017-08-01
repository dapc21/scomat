<?php
//echo ":".$_SERVER['REMOTE_HOST'].":";
?>
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
	<title>Generar Reporte</title>
	<!--AplicaTem-->
		<link rel="stylesheet" type="text/css" href="Programador/estilos/css.css">
		<script language="JavaScript" type="text/javascript" src="javascript/validacion.js"> </script>
		<script language="JavaScript" type="text/javascript" src="javascript/ajax.js"></script>
		<script language="JavaScript" type="text/javascript" src="javascript/validacionAjax.js"></script>
		<script language="JavaScript" type="text/javascript" src="javascript/controlador.js"></script>  
		<script language="JavaScript" type="text/javascript" src="Programador/script.js"></script>
	<!--Fin AplicaTem-->
</head>
<body>
<div id="contenedor">
		<div id="principal">
			<script>
				conexionPHP('formulario.php','Modulo');	
			</script>
		</div>
	</div>
</body>
</html>
