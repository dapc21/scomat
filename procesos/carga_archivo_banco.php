<?php
$id_ctb=$_POST['id_ctb'];
$nombre_archivo = $_FILES['foto']['name'];
$nombre_arc = $_FILES['foto']['name'];
$tipo_archivo = $_FILES['foto']['type'];
$tamano_archivo = $_FILES['foto']['size'];
/*
if (file_exists('../archivo_estado_cuenta\\'.$id_ctb.'.xlsx'))
unlink('../archivo_estado_cuenta\\'.$id_ctb.'.xlsx');
if (file_exists('../archivo_estado_cuenta\\'.$id_ctb.'.XLSX'))
unlink('../archivo_estado_cuenta\\'.$id_ctb.'.XLSX');
if (file_exists('../archivo_estado_cuenta\\'.$id_ctb.'.XLS'))
unlink('../archivo_estado_cuenta\\'.$id_ctb.'.XLS');
if (file_exists('../archivo_estado_cuenta\\'.$id_ctb.'.xls'))
unlink('../archivo_estado_cuenta\\'.$id_ctb.'.xls');
if (file_exists('../archivo_estado_cuenta\\'.$id_ctb.'.csv'))
unlink('../archivo_estado_cuenta\\'.$id_ctb.'.csv');
if (file_exists('../archivo_estado_cuenta\\'.$id_ctb.'.CSV'))
unlink('../archivo_estado_cuenta\\'.$id_ctb.'.CSV');
if (file_exists('../archivo_estado_cuenta\\'.$id_ctb.'.TXT'))
unlink('../archivo_estado_cuenta\\'.$id_ctb.'.TXT');
if (file_exists('../archivo_estado_cuenta\\'.$id_ctb.'.txt'))
unlink('../archivo_estado_cuenta\\'.$id_ctb.'.txt');
*/
$extensiones = array("csv", "CSV");
    $f = $nombre_archivo;
    $ftmp = explode(".",$f);
    $fExt = strtolower($ftmp[count($ftmp)-1]);
	
	if(!in_array($fExt,$extensiones)){
        echo "<script> alert('El formato válido es: documento SEPADOR POR COMA (.CSV)');history.go(-1);</script> ";
    }
	else{
    if (move_uploaded_file($_FILES['foto']['tmp_name'], '../archivo_estado_cuenta/'.$id_ctb.'.'.$fExt.'')){
		$_FILES[$tipo_archivo];	
		echo "<script> alert('CARGA COMPLETADA CON EXITO VUELVA A ATRAS');window.close();</script> ";
	}else{
		echo '../archivo_estado_cuenta/'.$id_ctb.'.'.$fExt.':';
   	echo "<script> alert('Ocurrió algún error al subir el fichero. No pudo guardarse.');history.go(-1);</script> ";
	 }
}
 
?>