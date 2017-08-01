<?php
   
      /**********************************************************
      CLASE ENCARGADA DE REALIZAR LA CONEXION DIRECTA CON EL 
      MANEJADOR DE BDD, ADEMAS DE REALIZAR LAS CONSUTAS.
      LA DOCUMENTACION DE SUS METODOS SE ENCUENTRA EN EL ARCHIVO 
      'DataBaseMetodos.php'
      ***********************************************************/
	 // include "DataBaseMetodos.php";
      class ODBC extends DataAccess 
      {
      	public   $rowset;
      	public   $conexion=null;
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
      		$this->conexion=@odbc_connect("$database","$user","$password");
      		if ($this->conexion)
      		{
      			$this->conectado=true;			
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
      			//odbc_ close($this->conexion);
      		}
      	}
      	function seleccionarDataBase($database)
      	{
      		if ($this->conectado)
      		{
      			$sql='use $database';
      			odbc_exec($sql, $this->conexion);
      			if ($database==pg_dbname($this->conexion))
      				return true;
      			else
      				return false;
      		}
      	}
      	
      	public function ejecutarSql($sql)
      	{	
			//ECHO "entro a sql";
			$sql=strtolower($sql);
			//echo ":$sql:";
      		if ($this->conectado)
      		{      		   
					
      			if($this->resultado=@odbc_exec($this->conexion, $sql))
      			{
      				//if($num=odbc_fetch_row($this->resultado)>=0)
      				//{						
      				  $this->rowset=odbc_fetch_array($this->resultado);
      				  $this->registros=odbc_num_rows($this->resultado);					 
      				  return true; 
      				//}
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
      			if($this->resultado=@odbc_exec($this->conexion, $sql))
      			{
      				//if($num=odbc_fetch_row($this->resultado)>=0)
      				//{						
      				  $this->rowset=odbc_fetch_array($this->resultado);
      				  $this->registros=odbc_num_rows($this->resultado);					 
      				  return true; 
      				//}
      			}
      		}
      	}
      	public function ejecutarSqlMin($sql)
      	{	
			if ($this->conectado)
      		{      		   
      			if($this->resultado=@odbc_exec($this->conexion, $sql))
      			{
      				if($num=odbc_fetch_row($this->resultado)>=0)
      				{						
      				  $this->rowset=odbc_fetch_array($this->resultado);
      				  $this->registros=odbc_num_rows($this->resultado);					 
      				  return true; 
      				}
      			}
      		}
      	}
      	function limpiarConexion()
      	{
      		if ($this->conectado)
      		{
      			if ($this->resultado)
      			{
      				//odbc_ free_ result($this->resultado);
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
							$this->rowset=odbc_fetch_array($this->resultado);
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
      			odbc_result($this->resultado,$id);
      			$this->rowset=odbc_fetch_array($this->resultado);
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
			return odbc_error($this->conexion);
		}
		function getManejador(){
			//return "ODBC";
		}
		function num_fields(){
			//return odbc_num_fields($this->resultado);
		}
		function fetch_field($i){
			//return odbc_ field_ name($this->resultado,$i);
		}
		function fetch_field_type($i){
			//return odbc_ field_ type($this->resultado,$i);
		}
		function result($i){
			//return odbc_ result($this->resultado,$i);
		}
		function validarSql($sql){
			$this->resultado=odbc_exec($this->conexion, $sql);
				
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
