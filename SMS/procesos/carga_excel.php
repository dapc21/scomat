<?php
$codigoresgistro=$_POST['codigoresgistro'];
$nombre_archivo = $_FILES['foto']['name'];
$nombre_arc = $_FILES['foto']['name'];
$tipo_archivo = $_FILES['foto']['type'];
$tamano_archivo = $_FILES['foto']['size'];

$extensiones = array("xlsx", "XLSX");
    $f = $nombre_archivo;
    $ftmp = explode(".",$f);
    $fExt = strtolower($ftmp[count($ftmp)-1]);
	
	if(!in_array($fExt,$extensiones)){
        echo "<script> alert('El formato válido es: documento Excel 2007 (xlsx)');history.go(-1);</script> ";
    }
	else{
    if (move_uploaded_file($_FILES['foto']['tmp_name'], '../archivo_sms_excel\\listadosms.xlsx')){
		$_FILES[$tipo_archivo];	
		echo "<script> alert('CARGA COMPLETADA CON EXITO VUELVA A ATRAS');parent.cerrarVenCarga()</script> ";
	}else{
		echo "<script> alert('Ocurrió algún error al subir el fichero. No pudo guardarse.');history.go(-1);</script> ";
    }
}
 
?>