<?php
if ($conn_access = odbc_connect ( "platinium_petare", "", "")){ 
	$ssql = "select *from zona order by secnro"; 
   	if($rs_access = odbc_exec ($conn_access, $ssql)){ 
      	 
 
      	 
while ($fila = odbc_fetch_array($rs_access)){ 
         	 echo "<br>:" . $fila['desczona'].":"; 
			 /*$nombre=trim($fila->NombreCompletoAbonado);
			 $deuda=trim($fila->ImporteAdeudado);
			 $det_deuda=trim($fila->DetalleDeuda);
			 */
      	 } 	
/*		 
while ($fila = odbc_fetch_object($rs_access)){ 
         	 echo "<br>:" . $fila->SecNro .":". $fila->SecDsc .":". $fila->SecCnt .":"; 
			
      	 } 
		 */
   	}
	else{
		echo "error de consulta";
	}
} else{ 
   	echo "Error en la conexión con la base de datos"; 
} 
?>