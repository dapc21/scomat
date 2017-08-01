<?php session_start();
exec("C:\Archivos de programa\PostgreSQL\8.4\bin\respaldo.bat");

require_once("../procesos.php");  $ini_u = $_SESSION["ini_u"]; 
require_once "../Seguridad/Usuario.php";
$obj=new Usuario('','','','','');
if($obj->permisoModulo($acceso,strtoupper('RESPALDAR')))
{

// scrypt for backup and restore postgres database


function dl_files($file){
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

 case "RESPALDAR":
	
	global $host;
	global $usuario;
	global $clave;
	global $data_base;
	$dbname = $data_base; //database name
	
	//echo "host=$host port=5432 dbname=$dbname user=$usuario password=$clave";

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

 //$orden=array("0"=>"franquicia","1"=>"parametros","2"=>"zona","3"=>"sector","4"=>"calle","5"=>"tipo_servicio","6"=>"servicios","7"=>"tarifa_servicio","8"=>"persona","9"=>"tecnico","10"=>"cliente","11"=>"vendedor","12"=>"cobrador","13"=>"pago_comisiones","14"=>"tipo_orden","15"=>"detalle_orden","16"=>"materiales","17"=>"ent_sal_mat","18"=>"inventario_materiales","19"=>"inventario","20"=>"tipo_pago","21"=>"cirre_diario","22"=>"modulo","23"=>"perfil","24"=>"modulo_perfil","25"=>"usuario","26"=>"caja","27"=>"caja_cobrador","28"=>"cierre_pago","29"=>"comentario_cliente","30"=>"reclamo_denuncia","31"=>"contrato","32"=>"ordenes_tecnicos","33"=>"contrato_servicio","34"=>"pagos","35"=>"pago_servicio","36"=>"detalle_tipopago");
/*
 $dato=array();
 $i=0;
 while($row = pg_fetch_row($res)){
		$dato[$i]=$row[0];
		//echo "$ii:$dato[$i]:<br>";
		$i++;
}
*/
$orden=array("franquicia","parametros","zona","sector","calle","tipo_servicio","servicios","tarifa_servicio","persona","tecnico","cliente","vendedor","cobrador","pago_comisiones","tipo_orden","detalle_orden","materiales","ent_sal_mat","inventario_materiales","inventario","tipo_pago","cirre_diario","modulo","perfil","modulo_perfil","usuario");
//$orden=array("variables_sms");
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
 dl_files("$dbname.sql");
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
	<BR><div class="cabe">RESPALDAR DATOS</div>
<fieldset >
<table border="0" width="450px" align="CENTER"> 
 <tr>
  <td>
		<tr>
			<td>
				<span class="fuenteN">Se descargara un archivo en la ruta seleccionada por su navegador.</span>
			</td>
		</tr>
		<tr>
			<td align="center">
				<br>
				<!--<input type="file" name="path" id="path" style="width:300px"/>

				<input type="submit" value="Import" name="actionButton" id="actionButton" > --><input type="submit" value="RESPALDAR" name="actionButton" id="actionButton" onclick="activarGif()">
				
			</td>
		</tr>
	</table>
   
<br><div id="gif" class="cabe"></div>
<br>
<br>
</fieldset >


</form>
</body>
</html>
<script>
function activarGif(){
	document.getElementById("gif").innerHTML='GENERANDO ARCHIVO DE RESPALDO POR FAVOR ESPERE!!! <span class="fuente"><br>Esto puede Tardar varios minitos<br><img id="loading" src="../imagenes/loading.gif"></span>';
}
</script>



<?php 
	}
	else{
		echo '<p align="center"><img   style="background:#FFFFFF" src="../imagenes/Error.jpg" width="255px" height="255px" /></p><br>
		<div align="center">
					
				</div>
		';
	}
?>
