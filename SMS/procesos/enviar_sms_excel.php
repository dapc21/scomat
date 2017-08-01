<?php
require_once("../procesos.php");  $ini_u = $_SESSION["ini_u"]; 
require_once "../Clases/sms.php";
$sms = $_GET['sms'];
	
	$objeto=new sms();
	$acce=conexion();
  $acceso->objeto->ejecutarSql("select *from sms_excel order by ids");
	$i=0;
	
   
   echo '
			<table border="0" width="100%" align="CENTER" >
				<tr>
					<td >
						<span class="fuenteN">Nro</span>
					</td>
					<td >
						<span class="fuenteN">tel</span>
					</td>
					<td >
						<span class="fuenteN">ced</span>
					</td>
					<td >
						<span class="fuenteN">nom</span>
					</td>
					<td >
						<span class="fuenteN">ape</span>
					</td>
					
				</tr>
   ';
   
	while($row=row($acceso)){
		$ids=trim($row["ids"]);
		$tel=trim($row["tel"]);
		$telefono=trim($row["tel"]);
		$ced=trim($row["ced"]);
		$nom=trim($row["nom"]);
		$ape=trim($row["ape"]);
		$c1=trim($row["c1"]);
		$c2=trim($row["c2"]);
		$c3=trim($row["c3"]);
		$c4=trim($row["c4"]);
		
						if(strlen($telefono)==10){
							$telefono="0".$telefono;
						}
						
						if(strlen($telefono)!=11){
							$telefono="";
						}
						
		if($telefono!="" && $telefono!="00000000000"){
			$i++;
			eval('$mensaje="'.$sms.'";');
		//	$dato=$objeto->obtenerSmsCon($acce,$id_contrato);
		//	$mensaje=$objeto->obtenerMensajeSms($acce,$dato,$mensaje);
		//	$mensaje=strtoupper(utf8_decode($mensaje));			
			$objeto->EnviarSMSUnico($acce,$telefono,$mensaje,'');
			
			echo '
				<tr>
					<td >
						<span class="fuente">'.$i.'</span>
					</td>
					<td >
						<span class="fuente">'.$telefono.'</span>
					</td>
					<td >
						<span class="fuente">'.$ced.'</span>
					</td>
					<td >
						<span class="fuente">'.$nom.'</span>
					</td>
					<td >
						<span class="fuente">'.$ape.'</span>
					</td>
				</tr>
		';
		}
	}

?>
