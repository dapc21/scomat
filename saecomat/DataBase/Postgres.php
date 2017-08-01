<?php
   
      /**********************************************************
      CLASE ENCARGADA DE REALIZAR LA CONEXION DIRECTA CON EL 
      MANEJADOR DE BDD, ADEMAS DE REALIZAR LAS CONSUTAS.
      LA DOCUMENTACION DE SUS METODOS SE ENCUENTRA EN EL ARCHIVO 
      'DataBaseMetodos.php'
      ***********************************************************/
	  include "DataBaseMetodos.php";
      class Postgres extends DataAccess implements DataBaseMetodos
      {
      	public   $rowset;
      	public   $conexion=null;
      	public   $conexion_alt=null;
      	public   $conectado=false;
      	public   $registros=0;
      	public   $resultado=null;
      	
      	function __construct(){}
      	
            function __destruct()
      	{
      	/*	if ($this->conectado)
      		{
            		$this->desconectar();
      		}*/
      	}		
      	function conectarDataBase($host, $user, $password, $database)
      	{
      		$this->conexion=@pg_connect("dbname=$database host=$host port=5432 user=$user password=$password");
      		if ($this->conexion)
      		{
      			$this->conectado=true;	
      		//	$this->conexion_alt=@pg_connect("dbname=$database host=$host port=5432 user=$user password=$password");	
				
      			return true;
      		}
      		else
      		{
      		    $this->conectado=false;
      		}
      	}
      	function desconectarDataBase()
      	{
      		if ($this->conectado)
      		{
      			pg_close($this->conexion);
      		}
      	}
      	function seleccionarDataBase($database)
      	{
      		if ($this->conectado)
      		{
      			$sql='use $database';
      			pg_query($sql, $this->conexion);
      			if ($database==pg_dbname($this->conexion))
      				return true;
      			else
      				return false;
      		}
      	}
      	
      	public function registro_auditoria($sql)
      	{
			$valort=explode(" ",$sql);
			$tipo_sql=trim($valort[0]);
			//if($tipo_sql=='INSERT' || $tipo_sql=='DELETE' || $tipo_sql=='UPDATE' || $tipo_sql=='BEGIN;' || $tipo_sql=='COMMIT;' || $tipo_sql=='ROLLBACK;'){
			if($tipo_sql=='INSERT' || $tipo_sql=='DELETE' || $tipo_sql=='UPDATE'){
				
				session_start();
				$ini_u = $_SESSION["ini_u"];  
				
				$login = strtoupper(trim($_SESSION["login"]));
				$fecha = date("Y-m-d");
				$hora = date("H:i:s");
				$dir_ip = $_SERVER['REMOTE_ADDR'];
				$nom_equipo = $_SERVER['REMOTE_HOST'];
				$valort=explode(" ",$sql);
				$tipo_sql=trim($valort[0]);
				if($tipo_sql=='INSERT'){
					$valor=explode("INTO",$sql);
					$tabla=trim($valor[1]);
					$valor=explode("(",$tabla);
					$tabla=trim($valor[0]);
				}
				else if($tipo_sql=='DELETE'){
					$valor=explode("FROM",$sql);
					$tabla=trim($valor[1]);
					$valor=explode(" ",$tabla);
					$tabla=trim($valor[0]);
				}
				else if($tipo_sql=='UPDATE'){
					$tabla=trim($valort[1]);
					$valor=explode("SET",$tabla);
					$tabla=trim($valor[0]);
				}
				$refer='';
				$sql_comp=$sql;
				$sql_comp = str_replace("'", "''", $sql_comp);
				if($tabla!=strtoupper("SINCRONIZACION_SERVI") && $tabla!=strtoupper("SERVIDOR") && $tabla!=strtoupper("auditoria_comp")){
				//	echo "<BR>\n:$tipo_sql : $tabla:";
					$res=@pg_query($this->conexion, "insert into auditoria_comp(login,dir_ip,nom_equipo,fecha,hora,tipo_sql,tabla,refer,sql_comp) values ('$login','$dir_ip','$nom_equipo','$fecha','$hora','$tipo_sql','$tabla','$refer','$sql_comp')");
				}
			}
			return $tipo_sql;
      	}
      	public function ejecutarSql($sql)
      	{
			$sql=strtoupper($sql);
			if ($this->conectado)
      		{
				//echo "<BR>:sql:$sql";
				$tipo_sql=$this->registro_auditoria($sql);
				if($this->resultado=@pg_query($this->conexion, $sql))
      			{
      				if($num=pg_affected_rows($this->resultado)>=0)
      				{						
      				  $this->rowset=pg_fetch_array($this->resultado);
      				  $this->registros=pg_num_rows($this->resultado);		 
      				  return true; 
      				}
      			}
				else{
					$error ="\n(ERROR DE BASE DE DATOS: \n $sql <br>\n".pg_errormessage($this->conexion).")\n";
					//echo $error;
					$id = fopen("error_pg_saeco.txt","a+");
					fwrite($id,"\n\n$error \n");
					fclose ($id);
				}
      		}
      	}
      	public function ejecutarSql_solo($sql)
      	{
			//ECHO "entro a sql";
			$sql=strtoupper($sql);
			//echo ":$sql:";
      		if ($this->conectado)
      		{
      			if($this->resultado=@pg_query($this->conexion, $sql))
      			{
      				if($num=pg_affected_rows($this->resultado)>=0)
      				{						
      				  $this->rowset=pg_fetch_array($this->resultado);
      				  $this->registros=pg_num_rows($this->resultado);					 
      				  return true; 
      				}
      			}
				else{
				//	echo ":\n:(ERROR DE BASE DE DATOS: \n $sql <br>\n".pg_errormessage($this->conexion).")\n";
				}
      		}
      	}
		public function ejecutarSql1($sql)
      	{
			//ECHO "entro a sql";
			//$sql=strtoupper($sql);
			//echo ":$sql:";
      		if ($this->conectado)
      		{
				$tipo_sql=$this->registro_auditoria($sql);
				if($this->resultado=@pg_query($this->conexion, $sql))
      			{
      				if($num=pg_affected_rows($this->resultado)>=0)
      				{						
      				  $this->rowset=pg_fetch_array($this->resultado);
      				  $this->registros=pg_num_rows($this->resultado);		 
      				  return true; 
      				}
      			}
				else{
					$error ="\n(ERROR DE BASE DE DATOS: \n $sql <br>\n".pg_errormessage($this->conexion).")\n";
					echo $error;
					$id = fopen("error_pg_saeco.txt","a+");
					fwrite($id,"\n\n$error \n");
					fclose ($id);
				}
      		}
      	}
      	public function ejecutarSqlMin($sql)
      	{	
			if ($this->conectado)
      		{      		   
				$tipo_sql=$this->registro_auditoria($sql);
				if($this->resultado=@pg_query($this->conexion, $sql))
      			{
      				if($num=pg_affected_rows($this->resultado)>=0)
      				{						
      				  $this->rowset=pg_fetch_array($this->resultado);
      				  $this->registros=pg_num_rows($this->resultado);		 
      				  return true; 
      				}
      			}
				else{
					$error ="\n(ERROR DE BASE DE DATOS: \n $sql <br>\n".pg_errormessage($this->conexion).")\n";
					echo $error;
					$id = fopen("error_pg_saeco.txt","a+");
					fwrite($id,"\n\n$error \n");
					fclose ($id);
				}
      		}
      	}
      	function limpiarConexion()
      	{
      		if ($this->conectado)
      		{
      			if ($this->resultado)
      			{
      				pg_free_result($this->resultado);
      				$this->resultado=null;
      			}
      		}
      	}
      			
      	function &devolverRegistro()           
      	{
      		if ($this->conectado)
      		{		
      			if ($this->resultado)
      			{
      				return $this->rowset;
      			}
      		}
      	}
      	function siguienteRegistro()
     	{
      		if($this->conectado)
     			{
      			if ($this->resultado)
     				{
						if ($this->rowset)
						{	
							$this->rowset=pg_fetch_array($this->resultado);
							return true;
						}
						else
           				{
      					return false;	
      				}
      			}
      		}
      	}
      	function seekRegistro($id)
      	{
      		if ($this->registros>$id)
      		{
      			pg_result_seek($this->resultado,$id);
      			$this->rowset=pg_fetch_array($this->resultado);
      			return true;
      		}
      	}
      	function anteriorRegistro() 
		{
			if ($this->conectado)
     			{		
      			if ($this->resultado)
     				{
      				if ($this->rowset)
     					{	
							$this->rowset;
							return true;
     					}
           				else
           				{
      					return false;	
      				}
      			}
      		}
		}
		function error()
		{
			return pg_errormessage($this->conexion);
		}
		function getManejador(){
			return "Postgres";
		}
		function num_fields(){
			return pg_num_fields($this->resultado);
		}
		function fetch_field($i){
			return pg_field_name($this->resultado,$i);
		}
		function fetch_field_type($i){
			return pg_field_type($this->resultado,$i);
		}
		function result($i){
			return pg_result($this->resultado,$i);
		}
		function validarSql($sql){
			$this->resultado=pg_query($this->conexion, $sql);
				
			if ($this->resultado){
				return true;
			}
			else{
				return false;
				
			}
		}
      } // fin de la clase
      // @: desabilita el error
      // pg_errno (postgre)
      // $mysqli->errno	   	  
	
?>
