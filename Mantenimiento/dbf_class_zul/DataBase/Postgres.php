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
      		$this->conexion=@pg_connect("dbname=$database host=$host user=$user password=$password");
      		if ($this->conexion){
      			$this->conectado=true;			
      			return true;
      		}
      		else{
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
      	
      	public function ejecutarSql($sql)
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
      		}
      	}
      	public function ejecutarSqlMin($sql)
      	{	
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
