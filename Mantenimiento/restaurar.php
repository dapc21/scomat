<?php session_start();

require_once("../DAtaBase/Acceso.php");
// scrypt for backup and restore postgres database
require_once "../Seguridad/Usuario.php";
$obj=new Usuario('','','','','');
if($obj->permisoModulo($acceso,strtoupper('RESTAURAR')))
{

function dl_file($file){
  if (!is_file($file)) { die("<b>404 File not found!</b>"); }
  $len = filesize($file);
  $filename = basename($file);
  $file_extension = strtolower(substr(strrchr($filename,"."),1));
  $ctype="application/force-download";
  header("Pragma: public");
  header("Expires: 0");
  header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
  header("Cache-Control: public");
  header("Content-Description: File Transfer");
  header("Content-Type: $ctype");
  $header="Content-Disposition: attachment; filename=".$filename.";";
  header($header );
  header("Content-Transfer-Encoding: binary");
  header("Content-Length: ".$len);
  @readfile($file);
  exit;
}



$action  = $_POST["actionButton"];
$ficheiro=$_FILES["path"]["name"];
switch ($action) {
   case "RESTAURAR":
    global $host;
	global $usuario;
	global $clave;
	global $data_base;
	$dbname = $data_base; //database name
	

$dbconn = pg_pconnect("host=$host port=5432 dbname=$dbname user=$usuario password=$clave"); //connectionstring

     if (!$dbconn){
       echo "Can't connect.\n";
       exit;
     }
     $back = fopen($ficheiro,"r");
     $contents = fread($back, filesize($ficheiro));
     $res = pg_query(utf8_encode($contents));
     echo "<SCRIPT>alert('Base de datos Restaurada con Exito')</SCRIPT>";
     fclose($back);
 break;
 case "Export":
	global $host;
	global $usuario;
	global $clave;
	global $data_base;
	$dbname = $data_base; //database name
	

$dbconn = pg_pconnect("host=$host port=5432 dbname=$dbname user=$usuario password=$clave"); //connectionstring

 if (!$dbconn) {
   echo "Can't connect.\n";
 exit;
 }
 $back = fopen("$dbname.sql","w");
 $res = pg_query(" select relname as tablename
                   from pg_class where relkind in ('r')

and relname not like 'pg_%' and relname not like 'sql_%' order by tablename");

 $str="";


$orden=array("franquicia","parametros","zona","sector","calle","tipo_servicio","servicios","tarifa_servicio","persona","tecnico","cliente","vendedor","cobrador","pago_comisiones","tipo_orden","detalle_orden","materiales","ent_sal_mat","inventario_materiales","inventario","tipo_pago","cirre_diario","modulo","perfil","modulo_perfil","usuario","caja","caja_cobrador","cierre_pago","comentario_cliente","reclamo_denuncia","contrato","ordenes_tecnicos","contrato_servicio","pagos","pago_servicio","detalle_tipopago");
 $str .= "\n--Deleting Data\n";
 
for($i=count($orden)-1;$i>=0;$i--)
{
	$table = $orden[$i];
	$str .= "\ndelete from $table;\n";
}


 for($i=0;$i<count($orden);$i++)
 {
	
   $table = $orden[$i];

   $str .= "\n--\n";
   $str .= "-- Creating data for '$table'";
   $str .= "\n--\n\n";


$res3 = pg_query("SELECT * FROM $table");

   while($r = pg_fetch_row($res3))
   {
     $sql = "INSERT INTO $table VALUES ('";
     $sql .= utf8_decode(implode("','",$r));
     $sql .= "');";
     $str = str_replace("''","NULL",$str);

$str .= $sql; $str .= "\n";

   }

}



fwrite($back,$str);

 fclose($back);
 dl_file("$dbname.sql");
 break;
}

?>

<html>
<head>
	<link rel="stylesheet" type="text/css" href="../estilos/reset.css">
	<link rel="stylesheet" type="text/css" href="../estilos/css.css">
</head>
<body>

<form id="dataForm" name="dataForm" method="post" enctype="multipart/form-data" action="">
  <BR><div class="cabe">RESTAURAR DATOS</div>
<fieldset >
<table border="0" width="450px" align="CENTER"> 
 
		<tr>
			<td>
				<span class="fuenteN">Seleccione el respaldo Generado por la aplicacion</span>
			</td>
		</tr>
		<tr>
			<td align="center">
				<br>
				 <input type="file" name="path" id="path" style="width:300px"/>

				<input type="submit" value="RESTAURAR" name="actionButton" id="actionButton" >
			</td>
		</tr>
	</table>
</fieldset >
</form>
</body>
</html>



<?php 
	}
	else{
		echo '<p align="center"><img   style="background:#FFFFFF" src="../imagenes/Error.jpg" width="255px" height="255px" /></p><br>
		<div align="center">
					
				</div>
		';
	}
?>

