<?php
class tabla_bancos
{	

	private $id_ctb;
	function __construct($id_ctb)
	{
		$this->id_ctb = $id_ctb;
		
	}
	
	public function cargartabla_bancos($acceso,$desde,$hasta,$formato)
	{
		
		//echo "select banco_cuba from carga_tabla_banco,cuenta_bancaria where carga_tabla_banco.id_cuba=cuenta_bancaria.id_cuba and id_ctb='$this->id_ctb'";
		$acceso->objeto->ejecutarSql("select banco_cuba,cuenta_bancaria.id_cuba,abrev_cuba from carga_tabla_banco,cuenta_bancaria where carga_tabla_banco.id_cuba=cuenta_bancaria.id_cuba and id_ctb='$this->id_ctb'");
		if($row=$acceso->objeto->devolverRegistro()){
			$banco_cuba=trim($row["banco_cuba"]);
			$abrev_cuba=trim($row["abrev_cuba"]);
			$id_cuba=trim($row["id_cuba"]);
			//	echo ":$banco_cuba:";
			if($banco_cuba=='BANESCO'){
				$this->cargar_tabla_banesco($acceso,$id_cuba,$abrev_cuba);
			} else if($banco_cuba=='PROVINCIAL'){
				
				if($formato=="NORMAL"){
					$this->cargar_tabla_provincial($acceso,$id_cuba,$abrev_cuba);
				} else if($formato=="PROVINCIAL CONSULTA"){
					$this->cargar_tabla_provincial_consulta($acceso,$id_cuba,$abrev_cuba);
				}
				
			} else if($banco_cuba=='BANCO DEL TESORO'){
				$this->cargar_tabla_tesoro($acceso,$id_cuba,$abrev_cuba);
			} else if($banco_cuba=='FONDO COMUN'){
				$this->cargar_tabla_bfc($acceso,$id_cuba,$abrev_cuba);
			} else if($banco_cuba=='EXTERIOR'){
				
				if($formato=="NORMAL"){
					$this->cargar_tabla_exterior($acceso,$id_cuba,$abrev_cuba);
				} else if($formato=="EXTERIOR UNION"){
					$this->cargar_tabla_exterior_union($acceso,$id_cuba,$abrev_cuba);
				}
			} else if($banco_cuba=='MERCANTIL'){
				$this->cargar_tabla_mercantil($acceso,$id_cuba,$abrev_cuba);
			}else if($banco_cuba=='BANCO SOFITASA'){
				if($formato=="NORMAL"){
					$this->cargar_tabla_sofitasa($acceso,$id_cuba,$abrev_cuba,$desde,$hasta);
				} else if($formato=="SOFITASA FORMATO 1"){
					$this->cargar_tabla_sofitasa_f1($acceso,$id_cuba,$abrev_cuba,$desde,$hasta);
				}
				
			}else if($banco_cuba=='BICENTENARIO'){
				$this->cargar_tabla_bicentenario($acceso,$id_cuba,$abrev_cuba,$desde,$hasta);
			}else if($banco_cuba=='VENEZUELA'){
				$this->cargar_tabla_venezuela($acceso,$id_cuba,$abrev_cuba,$desde,$hasta);
			}else if($banco_cuba=='BOD'){
				if($formato=="NORMAL"){
					$this->cargar_tabla_bod($acceso,$id_cuba,$abrev_cuba,$desde,$hasta);
				} else if($formato=="PLANILLA BOD"){
					$this->cargar_tabla_planilla_bod($acceso,$id_cuba,$abrev_cuba,$desde,$hasta);
				}
			}
		//	$this->compactarRegistros($acceso);
		}
	}
	
	public function cargar_tabla_planilla_bod($acceso,$id_cuba,$abrev_cuba,$desde,$hasta)
	{
		require_once "procesos.php";
		
		list($ano,$mes,$dia)=explode("-",$desde);
		
		$ini_u='AA';
		 $acceso->objeto->ejecutarSql("select *from tabla_bancos  where (id_tb ILIKE '$ini_u%') ORDER BY id_tb desc"); 
		 $id_tb=$ini_u.verCoo($acceso,"id_tb");
		 
			// echo "archivo_estado_cuenta/".$this->id_ctb.".csv";
		if (($gestor = fopen("archivo_estado_cuenta/".$this->id_ctb.".csv", "r")) !== FALSE) {
			fgetcsv($gestor, 500, ";");
			fgetcsv($gestor, 500, ";");
			fgetcsv($gestor, 500, ";");
			fgetcsv($gestor, 500, ";");
			fgetcsv($gestor, 500, ";");
			$datos = fgetcsv($gestor, 500, ";");
			$fecha = trim($datos[0]);
			//ECHO ":$fecha:<br>";
			$fecha=trim(substr($fecha, 15, 10));
			//ECHO ":$fecha:<br>";
			fgetcsv($gestor, 500, ";");
			fgetcsv($gestor, 500, ";");
			fgetcsv($gestor, 500, ";");
			fgetcsv($gestor, 500, ";");
			
			
			while (($datos = fgetcsv($gestor, 500, ";")) !== FALSE) {
				//echo ":".count($datos).":";
				$var = trim($datos[0]);
				$variable=trim(substr($var, 0, 5));
			//	ECHO "\nvariable:$variable:<br>";
				if($variable=="TOTAL"){
					break;
				} else if(count($datos)!=1){
					$acceso->objeto->sql_error=$acceso->objeto->sql_error."<br>".count($datos).":";
					$acceso->objeto->sql_error=$acceso->objeto->sql_error."<br> Archivo no contiene el formato para este banco<br>";
					
					return;
				}
				
				$fecha_tb = formatfecha($fecha);
				
				
				
				
				$referencia_tb = trim(substr($var, 0, 15));
				$descrip_tb = trim(substr($var, 15, 20));
				$monto_tb =  trim(substr($var, 85, 14))+0;
			//	ECHO "\n:$monto_tb:<br>";
				$monto_tb = str_replace(".","",$monto_tb);
				$monto_tb = str_replace(",",".",$monto_tb);
				$monto_tb = $monto_tb+0;
				
				$saldo = 0;
				$saldo = str_replace(".","",$saldo);
				$saldo = str_replace(",",".",$saldo);
				$saldo = $saldo+0;
				
			//	echo "\ninsert into tabla_bancos(id_tb,id_ctb,fecha_tb,tipo_tb,referencia_tb,monto_tb,descrip_tb,status_tb,saldo) values ('$id_tb','$this->id_ctb','$fecha_tb','','$referencia_tb','$monto_tb','$descrip_tb','REGISTRADO','$saldo')";
				if(!$this->validacion_existencia($acceso,$id_cuba,$abrev_cuba,$fecha_tb,$referencia_tb,$monto_tb,$descrip_tb,$saldo)){
					
					return;
				}
				else if($monto_tb<=0){
					continue;
				}
				else {
					$acceso->objeto->ejecutarSql("insert into tabla_bancos(id_tb,id_ctb,fecha_tb,tipo_tb,referencia_tb,monto_tb,descrip_tb,status_tb,saldo) values ('$id_tb','$this->id_ctb','$fecha_tb','','$referencia_tb','$monto_tb','$descrip_tb','REGISTRADO','$saldo')");	
					$id_tb=$ini_u.verCoo_inc($acceso,$id_tb);
				}
				
			}
			fclose($gestor);
		}
		else{
			$acceso->objeto->sql_error=$acceso->objeto->sql_error."<br> Archivo esta cargado en el sistema";
			
		}
		
	}
	
	public function cargar_tabla_bod($acceso,$id_cuba,$abrev_cuba,$desde,$hasta)
	{
		require_once "procesos.php";
		
		list($ano,$mes,$dia)=explode("-",$desde);
		
		$ini_u='AA';
		 $acceso->objeto->ejecutarSql("select *from tabla_bancos  where (id_tb ILIKE '$ini_u%') ORDER BY id_tb desc"); 
		 $id_tb=$ini_u.verCoo($acceso,"id_tb");
		 
			// echo "archivo_estado_cuenta/".$this->id_ctb.".csv";
		if (($gestor = fopen("archivo_estado_cuenta/".$this->id_ctb.".csv", "r")) !== FALSE) {
			fgetcsv($gestor, 500, ";");
			
			
			while (($datos = fgetcsv($gestor, 500, ";")) !== FALSE) {
				//echo ":".count($datos).":";
				if(count($datos)!=7){
					$acceso->objeto->sql_error=$acceso->objeto->sql_error."<br>".count($datos).":";
					$acceso->objeto->sql_error=$acceso->objeto->sql_error."<br>Archivo no contiene el formato para este banco";
					
					return;
				}
				
				$fecha_tb = formatfecha(trim($datos[0]));
				$referencia_tb = trim($datos[2]);
				$tipo = trim($datos[5]);
				$descrip_tb = utf8_decode(trim($datos[3]));
				$monto_tb = trim($datos[4])+0;
				//ECHO "\n'monto_tb:$monto_tb'";
				/*
				$monto_tb = str_replace(".","",$monto_tb);
				$monto_tb = str_replace(",",".",$monto_tb);
				$monto_tb = $monto_tb+0;
				*/
				$saldo = trim($datos[6])+0;
				/*
				$saldo = str_replace(".","",$saldo);
				$saldo = str_replace(",",".",$saldo);
				$saldo = $saldo+0;
				*/
				if(!$this->validacion_existencia($acceso,$id_cuba,$abrev_cuba,$fecha_tb,$referencia_tb,$monto_tb,$descrip_tb,$saldo)){
					
					return;
				}
				else if($monto_tb<=0){
					continue;
				}
				else if($tipo=='DP'){
				//	ECHO "\n'$tipo'";
					$acceso->objeto->ejecutarSql("insert into tabla_bancos(id_tb,id_ctb,fecha_tb,tipo_tb,referencia_tb,monto_tb,descrip_tb,status_tb,saldo) values ('$id_tb','$this->id_ctb','$fecha_tb','','$referencia_tb','$monto_tb','$descrip_tb','REGISTRADO','$saldo')");	
					$id_tb=$ini_u.verCoo_inc($acceso,$id_tb);
				}
				
			}
			fclose($gestor);
		}
		else{
			$acceso->objeto->sql_error=$acceso->objeto->sql_error."<br>Archivo esta cargado en el sistema";
			
		}
		
	}
	public function cargar_tabla_bicentenario($acceso,$id_cuba,$abrev_cuba,$desde,$hasta)
	{
		require_once "procesos.php";
		
		list($ano,$mes,$dia)=explode("-",$desde);
		
		$ini_u='AA';
		 $acceso->objeto->ejecutarSql("select *from tabla_bancos  where (id_tb ILIKE '$ini_u%') ORDER BY id_tb desc"); 
		 $id_tb=$ini_u.verCoo($acceso,"id_tb");
		 
			// echo "archivo_estado_cuenta/".$this->id_ctb.".csv";
		if (($gestor = fopen("archivo_estado_cuenta/".$this->id_ctb.".csv", "r")) !== FALSE) {
			fgetcsv($gestor, 500, ";");
			fgetcsv($gestor, 500, ";");
			fgetcsv($gestor, 500, ";");
			fgetcsv($gestor, 500, ";");
			fgetcsv($gestor, 500, ";");
			fgetcsv($gestor, 500, ";");
			fgetcsv($gestor, 500, ";");
			fgetcsv($gestor, 500, ";");
			fgetcsv($gestor, 500, ";");
			fgetcsv($gestor, 500, ";");
			//fgetcsv($gestor, 500, ";");
			$feccha = trim($datos[0]);
			//$mes=substr($feccha, -1, 3);
			
			while (($datos = fgetcsv($gestor, 500, ";")) !== FALSE) {
				
			//	$fecha_tb = "$ano-$mes-".trim($datos[1]);
				$fecha_tb = formatfecha(trim($datos[1]));
				$referencia_tb = trim($datos[2]);
				$tipo = '';
				$descrip_tb = utf8_decode(trim($datos[3]));
				$monto_tb = trim($datos[5]);
				
			//	$monto_tb = str_replace(".","",$monto_tb);
			//	$monto_tb = str_replace(",",".",$monto_tb);
				$monto_tb = $monto_tb+0;
				
				$saldo = trim($datos[5]);
			//	$saldo = str_replace(".","",$saldo);
			//	$saldo = str_replace(",",".",$saldo);
				$saldo = $saldo+0;
				
				
				if($monto_tb<=0){
					continue;
				}else if(!$this->validacion_existencia($acceso,$id_cuba,$abrev_cuba,$fecha_tb,$referencia_tb,$monto_tb,$descrip_tb,$saldo)){
				
				//	return;
				}
				else {
					$acceso->objeto->ejecutarSql("insert into tabla_bancos(id_tb,id_ctb,fecha_tb,tipo_tb,referencia_tb,monto_tb,descrip_tb,status_tb,saldo) values ('$id_tb','$this->id_ctb','$fecha_tb','','$referencia_tb','$monto_tb','$descrip_tb','REGISTRADO','$saldo')");	
					$id_tb=$ini_u.verCoo_inc($acceso,$id_tb);
				}
				
			}
			fclose($gestor);
		}
		else{
			$acceso->objeto->sql_error=$acceso->objeto->sql_error."<br>Archivo esta cargado en el sistema";
			
		}
		
	}
	public function cargar_tabla_sofitasa_f1($acceso,$id_cuba,$abrev_cuba,$desde,$hasta)
	{
			//echo "entro a f1";

		require_once "procesos.php";


		
		list($ano,$mes,$dia)=explode("-",$desde);
		
		$ini_u='AA';
		 $acceso->objeto->ejecutarSql("select *from tabla_bancos  where (id_tb ILIKE '$ini_u%') ORDER BY id_tb desc"); 
		 $id_tb=$ini_u.verCoo($acceso,"id_tb");
		 
			// echo "archivo_estado_cuenta/".$this->id_ctb.".csv";
		if (($gestor = fopen("archivo_estado_cuenta/".$this->id_ctb.".csv", "r")) !== FALSE) {
			fgetcsv($gestor, 500, ";");
			fgetcsv($gestor, 500, ";");
			fgetcsv($gestor, 500, ";");
			fgetcsv($gestor, 500, ";");
			fgetcsv($gestor, 500, ";");
			$feccha = trim($datos[0]);
			//$mes=substr($feccha, -1, 3);
			
			while (($datos = fgetcsv($gestor, 500, ";")) !== FALSE) {
				//echo ":".count($datos).":";
				if(count($datos)==1){
					continue;
				} else if(count($datos)!=8){
					$acceso->objeto->sql_error=$acceso->objeto->sql_error."<br>Archivo no contiene el formato para este banco<br>";
					
					return;
				}
				
				$fecha_tb = "$ano-$mes-".trim($datos[0]);
				$referencia_tb = trim($datos[1]);
				$tipo = trim($datos[2]);
				$descrip_tb = utf8_decode(trim($datos[2]));
				$monto_tb = trim($datos[4]);
				
				$monto_tb = str_replace(".","",$monto_tb);
				$monto_tb = str_replace(",",".",$monto_tb);
				$monto_tb = $monto_tb+0;
				
				$saldo = trim($datos[6]);
				$saldo = str_replace(".","",$saldo);
				$saldo = str_replace(",",".",$saldo);
				$saldo = $saldo+0;
				
				if(!$this->validacion_existencia($acceso,$id_cuba,$abrev_cuba,$fecha_tb,$referencia_tb,$monto_tb,$descrip_tb,$saldo)){
					
					return;
				}
				else if($monto_tb<=0){
					continue;
				}
				else if($tipo=='DP' or $tipo=='NC'){
					$acceso->objeto->ejecutarSql("insert into tabla_bancos(id_tb,id_ctb,fecha_tb,tipo_tb,referencia_tb,monto_tb,descrip_tb,status_tb,saldo) values ('$id_tb','$this->id_ctb','$fecha_tb','','$referencia_tb','$monto_tb','$descrip_tb','REGISTRADO','$saldo')");	
					$id_tb=$ini_u.verCoo_inc($acceso,$id_tb);
				}
				
			}
			fclose($gestor);
		}
		else{
			$acceso->objeto->sql_error=$acceso->objeto->sql_error."<br>Archivo esta cargado en el sistema<br>";
			
		}
		
	}

	public function cargar_tabla_sofitasa($acceso,$id_cuba,$abrev_cuba,$desde,$hasta)
	{

		require_once "procesos.php";


		
		list($ano,$mes,$dia)=explode("-",$desde);
		
		$ini_u='AA';
		 $acceso->objeto->ejecutarSql("select *from tabla_bancos  where (id_tb ILIKE '$ini_u%') ORDER BY id_tb desc"); 
		 $id_tb=$ini_u.verCoo($acceso,"id_tb");
		 
			// echo "archivo_estado_cuenta/".$this->id_ctb.".csv";
		if (($gestor = fopen("archivo_estado_cuenta/".$this->id_ctb.".csv", "r")) !== FALSE) {
			fgetcsv($gestor, 500, ";");
			fgetcsv($gestor, 500, ";");
			fgetcsv($gestor, 500, ";");
			fgetcsv($gestor, 500, ";");
			fgetcsv($gestor, 500, ";");
			$feccha = trim($datos[0]);
			//$mes=substr($feccha, -1, 3);
			
			while (($datos = fgetcsv($gestor, 500, ";")) !== FALSE) {
				//echo ":".count($datos).":";
				if(count($datos)==1){
					continue;
				} else if(count($datos)!=6){
					$acceso->objeto->sql_error=$acceso->objeto->sql_error."<br>Archivo no contiene el formato para este banco<br>";
					
					return;
				}
				
				$fecha_tb = "$ano-$mes-".trim($datos[0]);
				$referencia_tb = trim($datos[1]);
				$tipo = trim($datos[2]);
				$descrip_tb = utf8_decode(trim($datos[2]));
				$monto_tb = trim($datos[4]);
				
				$monto_tb = str_replace(".","",$monto_tb);
				$monto_tb = str_replace(",",".",$monto_tb);
				$monto_tb = $monto_tb+0;
				
				$saldo = trim($datos[5]);
				$saldo = str_replace(".","",$saldo);
				$saldo = str_replace(",",".",$saldo);
				$saldo = $saldo+0;
				
				if(!$this->validacion_existencia($acceso,$id_cuba,$abrev_cuba,$fecha_tb,$referencia_tb,$monto_tb,$descrip_tb,$saldo)){
					
					return;
				}
				else if($monto_tb<=0){
					continue;
				}
				else if($tipo=='DP' or $tipo=='NC'){
					$acceso->objeto->ejecutarSql("insert into tabla_bancos(id_tb,id_ctb,fecha_tb,tipo_tb,referencia_tb,monto_tb,descrip_tb,status_tb,saldo) values ('$id_tb','$this->id_ctb','$fecha_tb','','$referencia_tb','$monto_tb','$descrip_tb','REGISTRADO','$saldo')");	
					$id_tb=$ini_u.verCoo_inc($acceso,$id_tb);
				}
				
			}
			fclose($gestor);
		}
		else{
			$acceso->objeto->sql_error=$acceso->objeto->sql_error."<br>Archivo esta cargado en el sistema<br>";
			
		}
		
	}
	public function cargar_tabla_venezuela($acceso,$id_cuba,$abrev_cuba)
	{

		require_once "procesos.php";


		
		$ini_u='AA';
		 $acceso->objeto->ejecutarSql("select *from tabla_bancos  where (id_tb ILIKE '$ini_u%') ORDER BY id_tb desc"); 
		 $id_tb=$ini_u.verCoo($acceso,"id_tb");
		 
			// echo "archivo_estado_cuenta/".$this->id_ctb.".csv";
		if (($gestor = fopen("archivo_estado_cuenta/".$this->id_ctb.".csv", "r")) !== FALSE) {
			//fgetcsv($gestor, 500, ";");
			fgetcsv($gestor, 500, ";");
			
			while (($datos = fgetcsv($gestor, 500, ";")) !== FALSE) {
				if(count($datos)!=9){
					$acceso->objeto->sql_error=$acceso->objeto->sql_error."<br>Archivo no contiene el formato para este banco<br>";
					
					return;
				}
				
				$fecha_tb = formatfecha2(trim($datos[1]));
				$referencia_tb = trim($datos[2]);
				$tipo = trim($datos[7]);
				$descrip_tb = utf8_decode(trim($datos[3]));
				$monto_tb = trim($datos[5]);
				
				$monto_tb = str_replace(".","",$monto_tb);
				$monto_tb = str_replace(",",".",$monto_tb);
				$monto_tb = $monto_tb+0;
				
				$saldo = trim($datos[6]);
				$saldo = str_replace(".","",$saldo);
				$saldo = str_replace(",",".",$saldo);
				$saldo = $saldo+0;
				
				if(!$this->validacion_existencia($acceso,$id_cuba,$abrev_cuba,$fecha_tb,$referencia_tb,$monto_tb,$descrip_tb,$saldo)){
					
					return;
				}
				else if($monto_tb<=0){
					continue;
				}
				else if($tipo=='DP' or $tipo=='NC'){
					$acceso->objeto->ejecutarSql("insert into tabla_bancos(id_tb,id_ctb,fecha_tb,tipo_tb,referencia_tb,monto_tb,descrip_tb,status_tb,saldo) values ('$id_tb','$this->id_ctb','$fecha_tb','','$referencia_tb','$monto_tb','$descrip_tb','REGISTRADO','$saldo')");	
					$id_tb=$ini_u.verCoo_inc($acceso,$id_tb);
				}
				
			}
			fclose($gestor);
		}
		else{
			$acceso->objeto->sql_error=$acceso->objeto->sql_error."<br>Archivo esta cargado en el sistema<br>";
			
		}
		
	}
	public function cargar_tabla_mercantil($acceso,$id_cuba,$abrev_cuba)
	{

		require_once "procesos.php";


		
		$ini_u='AA';
		 $acceso->objeto->ejecutarSql("select *from tabla_bancos  where (id_tb ILIKE '$ini_u%') ORDER BY id_tb desc"); 
		 $id_tb=$ini_u.verCoo($acceso,"id_tb");
		 
			// echo "archivo_estado_cuenta/".$this->id_ctb.".csv";
		if (($gestor = fopen("archivo_estado_cuenta/".$this->id_ctb.".csv", "r")) !== FALSE) {
			//fgetcsv($gestor, 500, ";");
			//fgetcsv($gestor, 500, ";");
			
			while (($datos = fgetcsv($gestor, 500, ";")) !== FALSE) {
				if(count($datos)!='10'){
					$acceso->objeto->sql_error=$acceso->objeto->sql_error."<br>Archivo no contiene el formato para este banco<br>";
					
					return;
				}
				
				$fecha_tb = formatfecha2(trim($datos[3]));
				$referencia_tb = trim($datos[4]);
				$tipo = trim($datos[5]);
				$descrip_tb = utf8_decode(trim($datos[6]));
				$monto_tb = trim($datos[7]);
				
				$monto_tb = str_replace(".","",$monto_tb);
				$monto_tb = str_replace(",",".",$monto_tb);
				$monto_tb = $monto_tb+0;
				
				$saldo = trim($datos[8]);
				$saldo = str_replace(".","",$saldo);
				$saldo = str_replace(",",".",$saldo);
				$saldo = $saldo+0;
				
				if(!$this->validacion_existencia($acceso,$id_cuba,$abrev_cuba,$fecha_tb,$referencia_tb,$monto_tb,$descrip_tb,$saldo)){
					
					return;
				}
				else if($monto_tb<=0){
					continue;
				}
				else if($tipo=='DP' or $tipo=='NC'){
					$acceso->objeto->ejecutarSql("insert into tabla_bancos(id_tb,id_ctb,fecha_tb,tipo_tb,referencia_tb,monto_tb,descrip_tb,status_tb,saldo) values ('$id_tb','$this->id_ctb','$fecha_tb','','$referencia_tb','$monto_tb','$descrip_tb','REGISTRADO','$saldo')");	
					$id_tb=$ini_u.verCoo_inc($acceso,$id_tb);
				}
				
			}
			fclose($gestor);
		}
		else{
			$acceso->objeto->sql_error=$acceso->objeto->sql_error."<br>Archivo esta cargado en el sistema<br>";
			
		}
		
	}
	
	public function cargar_tabla_exterior_union($acceso,$id_cuba,$abrev_cuba)
	{

		require_once "procesos.php";


		
		$ini_u='AA';
		 $acceso->objeto->ejecutarSql("select *from tabla_bancos  where (id_tb ILIKE '$ini_u%') ORDER BY id_tb desc"); 
		 $id_tb=$ini_u.verCoo($acceso,"id_tb");
		 
			// echo "archivo_estado_cuenta/".$this->id_ctb.".csv";
		if (($gestor = fopen("archivo_estado_cuenta/".$this->id_ctb.".csv", "r")) !== FALSE) {
			//fgetcsv($gestor, 500, ";");
			//fgetcsv($gestor, 500, ";");
			
			while (($datos = fgetcsv($gestor, 500, ";")) !== FALSE) {
				if(count($datos)!='7'){
					$acceso->objeto->sql_error=$acceso->objeto->sql_error."<br>Archivo no contiene el formato para este banco<br>";
					
					return;
				}

				$fecha_tb = formatfecha(trim($datos[1]));
				$referencia_tb = trim($datos[2]);
				$descrip_tb = utf8_decode(trim($datos[3]));
				$monto_tb = trim($datos[5]);
				
				$monto_tb = str_replace(".","",$monto_tb);
				$monto_tb = str_replace(",",".",$monto_tb);
				$monto_tb = $monto_tb+0;
				
				$saldo = trim($datos[6]);
				$saldo = str_replace(".","",$saldo);
				$saldo = str_replace(",",".",$saldo);
				$saldo = $saldo+0;
				
				if(!$this->validacion_existencia($acceso,$id_cuba,$abrev_cuba,$fecha_tb,$referencia_tb,$monto_tb,$descrip_tb,$saldo)){
					
					return;
				}
				else if($monto_tb<=0){
					continue;
				}
				else{
					$acceso->objeto->ejecutarSql("insert into tabla_bancos(id_tb,id_ctb,fecha_tb,tipo_tb,referencia_tb,monto_tb,descrip_tb,status_tb,saldo) values ('$id_tb','$this->id_ctb','$fecha_tb','','$referencia_tb','$monto_tb','$descrip_tb','REGISTRADO','$saldo')");	
					$id_tb=$ini_u.verCoo_inc($acceso,$id_tb);
				}
			}
			fclose($gestor);
		}
		else{
			$acceso->objeto->sql_error=$acceso->objeto->sql_error."<br>Archivo esta cargado en el sistema<br>";
			
		}
		
	}
	
	public function cargar_tabla_exterior($acceso,$id_cuba,$abrev_cuba)
	{

		require_once "procesos.php";


		
		$ini_u='AA';
		 $acceso->objeto->ejecutarSql("select *from tabla_bancos  where (id_tb ILIKE '$ini_u%') ORDER BY id_tb desc"); 
		 $id_tb=$ini_u.verCoo($acceso,"id_tb");
		 
			// echo "archivo_estado_cuenta/".$this->id_ctb.".csv";
		if (($gestor = fopen("archivo_estado_cuenta/".$this->id_ctb.".csv", "r")) !== FALSE) {
			//fgetcsv($gestor, 500, ";");
			//fgetcsv($gestor, 500, ";");
			
			while (($datos = fgetcsv($gestor, 500, ";")) !== FALSE) {
				if(count($datos)!='15'){
					$acceso->objeto->sql_error=$acceso->objeto->sql_error."<br>Archivo no contiene el formato para este banco<br>";
					
					return;
				}
				
				$fecha_tb = formatfecha1(trim($datos[3]));
				$referencia_tb = trim($datos[9]);
				$descrip_tb = utf8_decode(trim($datos[7]));
				$monto_tb = trim($datos[11]);
				
				$monto_tb = str_replace(".","",$monto_tb);
				$monto_tb = str_replace(",",".",$monto_tb);
				$monto_tb = $monto_tb+0;
				
				$saldo = trim($datos[13]);
				$saldo = str_replace(".","",$saldo);
				$saldo = str_replace(",",".",$saldo);
				$saldo = $saldo+0;
				
				if(!$this->validacion_existencia($acceso,$id_cuba,$abrev_cuba,$fecha_tb,$referencia_tb,$monto_tb,$descrip_tb,$saldo)){
					
					return;
				}
				else if($monto_tb<=0){
					continue;
				}
				else{
					$acceso->objeto->ejecutarSql("insert into tabla_bancos(id_tb,id_ctb,fecha_tb,tipo_tb,referencia_tb,monto_tb,descrip_tb,status_tb,saldo) values ('$id_tb','$this->id_ctb','$fecha_tb','','$referencia_tb','$monto_tb','$descrip_tb','REGISTRADO','$saldo')");	
					$id_tb=$ini_u.verCoo_inc($acceso,$id_tb);
				}
			}
			fclose($gestor);
		}
		else{
			$acceso->objeto->sql_error=$acceso->objeto->sql_error."<br>Archivo esta cargado en el sistema<br>";
			
		}
		
	}
	
	public function cargar_tabla_bfc($acceso,$id_cuba,$abrev_cuba)
	{

		require_once "procesos.php";


		
		$ini_u='AA';
		 $acceso->objeto->ejecutarSql("select *from tabla_bancos  where (id_tb ILIKE '$ini_u%') ORDER BY id_tb desc"); 
		 $id_tb=$ini_u.verCoo($acceso,"id_tb");
		 
			// echo "archivo_estado_cuenta/".$this->id_ctb.".csv";
		if (($gestor = fopen("archivo_estado_cuenta/".$this->id_ctb.".csv", "r")) !== FALSE) {
			fgetcsv($gestor, 500, ";");
			fgetcsv($gestor, 500, ";");
			while (($datos = fgetcsv($gestor, 500, ";")) !== FALSE) {
				if(count($datos)!='5'){
					$acceso->objeto->sql_error=$acceso->objeto->sql_error."<br>Archivo no contiene el formato para este banco<br>";
					
					return;
				}
				$fecha_tb = formatfecha(trim($datos[0]));
				$referencia_tb = trim($datos[2]);
				$descrip_tb = utf8_decode(trim($datos[3]));
				$monto_tb = trim($datos[4]);
				
				$monto_tb = str_replace(".","",$monto_tb);
				$monto_tb = str_replace(",",".",$monto_tb);
				$monto_tb = $monto_tb+0;
				
				$saldo = trim($datos[4]);
				$saldo = str_replace(".","",$saldo);
				$saldo = str_replace(",",".",$saldo);
				$saldo = $saldo+0;
				
				if(!$this->validacion_existencia($acceso,$id_cuba,$abrev_cuba,$fecha_tb,$referencia_tb,$monto_tb,$descrip_tb,$saldo)){
					
					return;
				}
				else if($monto_tb<=0){
					continue;
				}
				else{
					$acceso->objeto->ejecutarSql("insert into tabla_bancos(id_tb,id_ctb,fecha_tb,tipo_tb,referencia_tb,monto_tb,descrip_tb,status_tb,saldo) values ('$id_tb','$this->id_ctb','$fecha_tb','','$referencia_tb','$monto_tb','$descrip_tb','REGISTRADO','$saldo')");	
					$id_tb=$ini_u.verCoo_inc($acceso,$id_tb);
				}
				
			}
			fclose($gestor);
		}
		else{
			$acceso->objeto->sql_error=$acceso->objeto->sql_error."<br>Archivo esta cargado en el sistema<br>";
			
		}
		
	}
	
	public function cargar_tabla_tesoro($acceso,$id_cuba,$abrev_cuba)
	{

		require_once "procesos.php";


		
		$ini_u='AA';
		 $acceso->objeto->ejecutarSql("select *from tabla_bancos  where (id_tb ILIKE '$ini_u%') ORDER BY id_tb desc"); 
		 $id_tb=$ini_u.verCoo($acceso,"id_tb");
		 
			 
		if (($gestor = fopen("archivo_estado_cuenta/".$this->id_ctb.".csv", "r")) !== FALSE) {
			fgetcsv($gestor, 500, ";");
			while (($datos = fgetcsv($gestor, 500, ";")) !== FALSE) {
				if(count($datos)!=5){
					$acceso->objeto->sql_error=$acceso->objeto->sql_error."<br>Archivo no contiene el formato para este banco:<br>".count($datos).":";
					
					return;
				}
				$fecha = trim($datos[0]);
				$fecha_tb = formatfecha(trim($datos[0]));
				$referencia_tb = trim($datos[2]);
				
				$monto_tb = trim($datos[4]);
				$monto_tb = str_replace(".","",$monto_tb);
				$monto_tb = str_replace(",",".",$monto_tb);
				$monto_tb = $monto_tb+0;
				
				$saldo = trim($datos[5]);
				$saldo = str_replace(".","",$saldo);
				$saldo = str_replace(",",".",$saldo);
				$saldo = $saldo+0;
				
				
				//echo ":".$datos[3].":".$monto_tb.":";
				$descrip_tb = utf8_decode(trim($datos[1]));
				if(!$this->validacion_existencia($acceso,$id_cuba,$abrev_cuba,$fecha_tb,$referencia_tb,$monto_tb,$descrip_tb,$saldo)){
					
					return;
				}
				else if($monto_tb<=0){
					continue;
				}
				else{
					$acceso->objeto->ejecutarSql("insert into tabla_bancos(id_tb,id_ctb,fecha_tb,tipo_tb,referencia_tb,monto_tb,descrip_tb,status_tb,saldo) values ('$id_tb','$this->id_ctb','$fecha_tb','','$referencia_tb','$monto_tb','$descrip_tb','REGISTRADO','$saldo')");	
					$id_tb=$ini_u.verCoo_inc($acceso,$id_tb);
				}
				
			}
			fclose($gestor);
		}
		else{
			$acceso->objeto->sql_error=$acceso->objeto->sql_error."<br>Archivo esta cargado en el sistema<br>";
			
		}
		
	}
	
	public function cargar_tabla_provincial_consulta($acceso,$id_cuba,$abrev_cuba)
	{

		require_once "procesos.php";


		
		$ini_u='AA';
		 $acceso->objeto->ejecutarSql("select *from tabla_bancos  where (id_tb ILIKE '$ini_u%') ORDER BY id_tb desc"); 
		 $id_tb=$ini_u.verCoo($acceso,"id_tb");
		
			 
		if (($gestor = fopen("archivo_estado_cuenta/".$this->id_ctb.".csv", "r")) !== FALSE) {
			fgetcsv($gestor, 500, ";");
			fgetcsv($gestor, 500, ";");
		 fgetcsv($gestor, 500, ";");
		 fgetcsv($gestor, 500, ";");
		 fgetcsv($gestor, 500, ";");
		 fgetcsv($gestor, 500, ";");
		 fgetcsv($gestor, 500, ";");
		 fgetcsv($gestor, 500, ";");
		 fgetcsv($gestor, 500, ";");
		 fgetcsv($gestor, 500, ";");
		 fgetcsv($gestor, 500, ";");
		 fgetcsv($gestor, 500, ";");
		 fgetcsv($gestor, 500, ";");
		 fgetcsv($gestor, 500, ";");
		 fgetcsv($gestor, 500, ";");
			while (($datos = fgetcsv($gestor, 500, ";")) !== FALSE) {
				if(count($datos)!=7){
					$acceso->objeto->sql_error=$acceso->objeto->sql_error."<br>Archivo no contiene el formato para este banco columnas".count($datos)."  y deben ser 7 <br>";
					
					return;
				}
				$fecha = trim($datos[0]);
				if($fecha==''){
					continue;
				}
				
				$fecha_tb = formatfecha(trim($datos[0]));
				$referencia_tb = str_replace("'","",trim($datos[3]));
				
				$monto_tb = trim($datos[5]);
				$monto_tb = str_replace(".","",$monto_tb);
				$monto_tb = str_replace(",",".",$monto_tb);
				$monto_tb = $monto_tb+0;
				
				
				$saldo = trim($datos[5]);
				$saldo = str_replace(".","",$saldo);
				$saldo = str_replace(",",".",$saldo);
				$saldo = 0;
				
				//echo ":".$datos[3].":".$monto_tb.":";
				$descrip_tb = utf8_decode(trim($datos[4]));
				if(!$this->validacion_existencia($acceso,$id_cuba,$abrev_cuba,$fecha_tb,$referencia_tb,$monto_tb,$descrip_tb,$saldo)){
					
					return;
				}
				else if($monto_tb<=0){
					continue;
				}
				else{
					$acceso->objeto->ejecutarSql("insert into tabla_bancos(id_tb,id_ctb,fecha_tb,tipo_tb,referencia_tb,monto_tb,descrip_tb,status_tb,saldo) values ('$id_tb','$this->id_ctb','$fecha_tb','','$referencia_tb','$monto_tb','$descrip_tb','REGISTRADO','$saldo')");	
					$id_tb=$ini_u.verCoo_inc($acceso,$id_tb);
				}
				
			}
			fclose($gestor);
		}
		else{
			$acceso->objeto->sql_error=$acceso->objeto->sql_error."<br>Archivo esta cargado en el sistema<br>";
			
		}
		
	}
	
	public function cargar_tabla_provincial($acceso,$id_cuba,$abrev_cuba)
	{

		require_once "procesos.php";


		
		$ini_u='AA';
		 $acceso->objeto->ejecutarSql("select *from tabla_bancos  where (id_tb ILIKE '$ini_u%') ORDER BY id_tb desc"); 
		 $id_tb=$ini_u.verCoo($acceso,"id_tb");
		 
			 
		if (($gestor = fopen("archivo_estado_cuenta/".$this->id_ctb.".csv", "r")) !== FALSE) {
			fgetcsv($gestor, 500, ";");
			while (($datos = fgetcsv($gestor, 500, ";")) !== FALSE) {
				if(count($datos)!=5){
					$acceso->objeto->sql_error=$acceso->objeto->sql_error."<br>Archivo no contiene el formato para este banco columnas".count($datos)."  y deben ser 5 <br>";
					
					return;
				}
				$fecha = trim($datos[0]);
				$fecha_tb = formatfecha(trim($datos[0]));
				$referencia_tb = trim($datos[1]);
				
				$monto_tb = trim($datos[3]);
				$monto_tb = str_replace(".","",$monto_tb);
				$monto_tb = str_replace(",",".",$monto_tb);
				$monto_tb = $monto_tb+0;
				
				
				$saldo = trim($datos[4]);
				$saldo = str_replace(".","",$saldo);
				$saldo = str_replace(",",".",$saldo);
				$saldo = $saldo+0;
				
				//echo ":".$datos[3].":".$monto_tb.":";
				$descrip_tb = utf8_decode(trim($datos[2]));
				if(!$this->validacion_existencia($acceso,$id_cuba,$abrev_cuba,$fecha_tb,$referencia_tb,$monto_tb,$descrip_tb,$saldo)){
					
					return;
				}
				else if($monto_tb<=0){
					continue;
				}
				else{
					$acceso->objeto->ejecutarSql("insert into tabla_bancos(id_tb,id_ctb,fecha_tb,tipo_tb,referencia_tb,monto_tb,descrip_tb,status_tb,saldo) values ('$id_tb','$this->id_ctb','$fecha_tb','','$referencia_tb','$monto_tb','$descrip_tb','REGISTRADO','$saldo')");	
					$id_tb=$ini_u.verCoo_inc($acceso,$id_tb);
				}
				
			}
			fclose($gestor);
		}
		else{
			$acceso->objeto->sql_error=$acceso->objeto->sql_error."<br>Archivo esta cargado en el sistema<br>";
			
		}
		
	}
	
	public function cargar_tabla_banesco($acceso,$id_cuba,$abrev_cuba)
	{

		require_once "procesos.php";


		
		$ini_u='AA';
		 $acceso->objeto->ejecutarSql("select *from tabla_bancos  where (id_tb ILIKE '$ini_u%') ORDER BY id_tb desc"); 
		 $id_tb=$ini_u.verCoo($acceso,"id_tb");
		 
			 
		if (($gestor = fopen("archivo_estado_cuenta/".$this->id_ctb.".csv", "r")) !== FALSE) {
			fgetcsv($gestor, 500, ";");
			while (($datos = fgetcsv($gestor, 500, ";")) !== FALSE) {
				//echo ":".count($datos).":";
				if(count($datos)!='5'){
					$acceso->objeto->sql_error=$acceso->objeto->sql_error."<br>Archivo no contiene el formato para este banco<br>";
					
					return;
				}
				$fecha = trim($datos[0]);
				$fecha_tb = formatfecha(trim($datos[0]));
				$referencia_tb = trim($datos[1]);
				
				$monto_tb = trim($datos[3]);
				$monto_tb = str_replace(".","",$monto_tb);
				$monto_tb = str_replace(",",".",$monto_tb);
				$monto_tb = $monto_tb+0;
				
				
				$saldo = trim($datos[4]);
				$saldo = str_replace(".","",$saldo);
				$saldo = str_replace(",",".",$saldo);
				$saldo = $saldo+0;
				
				//echo ":".$datos[3].":".$monto_tb.":";
				$descrip_tb = utf8_decode(trim($datos[2]));
				if(!$this->validacion_existencia($acceso,$id_cuba,$abrev_cuba,$fecha_tb,$referencia_tb,$monto_tb,$descrip_tb,$saldo)){
					
					return;
				}
				else if($monto_tb<=0){
					continue;
				}
				else{
					$acceso->objeto->ejecutarSql("insert into tabla_bancos(id_tb,id_ctb,fecha_tb,tipo_tb,referencia_tb,monto_tb,descrip_tb,status_tb,saldo) values ('$id_tb','$this->id_ctb','$fecha_tb','','$referencia_tb','$monto_tb','$descrip_tb','REGISTRADO','$saldo')");	
					$id_tb=$ini_u.verCoo_inc($acceso,$id_tb);
				}
				
			}
			fclose($gestor);
		}
		else{
			$acceso->objeto->sql_error=$acceso->objeto->sql_error."<br>Archivo esta cargado en el sistema<br>";
			
		}
		
	}
	
	public function validacion_existencia($acceso,$id_cuba,$abrev_cuba,$fecha_tb,$referencia_tb,$monto_tb,$descrip_tb,$saldo)
	{
		$acceso->objeto->ejecutarSql("select * from tabla_bancos,carga_tabla_banco where tabla_bancos.id_ctb=carga_tabla_banco.id_ctb and id_cuba='$id_cuba' and fecha_tb='$fecha_tb' and referencia_tb='$referencia_tb' and monto_tb='$monto_tb'  and descrip_tb='$descrip_tb'  and saldo='$saldo' ");
		if($acceso->objeto->registros>0){
			//echo "select * from tabla_bancos,carga_tabla_banco where tabla_bancos.id_ctb=carga_tabla_banco.id_ctb and id_cuba='$id_cuba' and fecha_tb='$fecha_tb' and referencia_tb='$referencia_tb' and monto_tb='$monto_tb'  and descrip_tb='$descrip_tb'   and saldo='$saldo' ";
			$fecha=formatofecha($fecha_tb);
			$acceso->objeto->sql_error=$acceso->objeto->sql_error."<br>El siguiente registro ya esta cargado en la tabla  \n
					Banco: $abrev_cuba 
					Fecha: $fecha 
					Referencia: $referencia_tb 
					Monto: $monto_tb 
					Descripcion: $descrip_tb \n
					";
			return false;
		}
		else{
			return true;
		}
	}

	public function compactarRegistros($acceso)
	{	
		$acceso1=conexion();
		//echo "select * from tabla_bancos where (select count(*) from tabla_bancos as t where tabla_bancos.id_ctb=t.id_ctb  and tabla_bancos.fecha_tb=t.fecha_tb and tabla_bancos.referencia_tb=t.referencia_tb and tabla_bancos.monto_tb=t.monto_tb  and tabla_bancos.descrip_tb=t.descrip_tb  and tabla_bancos.saldo<>t.saldo ";
		$acceso1->objeto->ejecutarSql(" select * from tabla_bancos where tabla_bancos.id_ctb='$this->id_ctb' and (select count(*) from tabla_bancos as t where t.id_ctb=tabla_bancos.id_ctb   and tabla_bancos.fecha_tb=t.fecha_tb and tabla_bancos.referencia_tb=t.referencia_tb 
 and tabla_bancos.monto_tb=t.monto_tb  and tabla_bancos.descrip_tb=t.descrip_tb  )>1");
		while($row=row($acceso1)){
			$id_tb=trim($row["id_tb"]);
			$fecha_tb=trim($row["fecha_tb"]);
			$referencia_tb=trim($row["referencia_tb"]);
			$monto_tb=trim($row["monto_tb"]);
			$descrip_tb=trim($row["descrip_tb"]);
			//echo "\n\n update tabla_bancos set monto_tb = (select sum(monto_tb) from tabla_bancos as t where t.id_ctb='$this->id_ctb' and t.fecha_tb='$fecha_tb' and t.referencia_tb='$referencia_tb' and t.monto_tb='$monto_tb'  and t.descrip_tb='$descrip_tb'  ) where id_tb='$id_tb';";
			//echo "\ndelete from tabla_bancos where id_ctb='$this->id_ctb' and fecha_tb='$fecha_tb' and referencia_tb='$referencia_tb' and monto_tb='$monto_tb'  and descrip_tb='$descrip_tb'   and  id_tb<>'$id_tb';";
			$acceso->objeto->ejecutarSql("update tabla_bancos set monto_tb = (select sum(monto_tb) from tabla_bancos as t where t.id_ctb='$this->id_ctb' and t.fecha_tb='$fecha_tb' and t.referencia_tb='$referencia_tb' and t.monto_tb='$monto_tb'  and t.descrip_tb='$descrip_tb'  ) where id_tb='$id_tb' ");
			$acceso->objeto->ejecutarSql("delete from tabla_bancos where id_ctb='$this->id_ctb' and fecha_tb='$fecha_tb' and referencia_tb='$referencia_tb' and monto_tb='$monto_tb'  and descrip_tb='$descrip_tb'   and  id_tb<>'$id_tb' ");
			
		}
		
	}
}
?>