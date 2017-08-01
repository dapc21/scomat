<?php
require_once 'DataBaseMetodos.php';

require_once 'DataAccess.php';
function  __autoload($class_name)
	{
	require_once $class_name . '.php';
	}
	
class MySql extends DataAccess implements DataBaseMetodos
	{
	public   $rowset=0;
	public   $conexion=null;
	public   $conectado=false;
	public   $registros=0;
	public   $resultado=null;
	
	function __construct()
		{}
	function __destruct()
		{
		if ($this->conectado)
			{
			$this->desconectar();
			}
		}
	function conectarDataBase($host, $user, $password, $database)
	{
			$this->conexion=@mysql_connect($host,$user,$password);
		if ($this->conexion){
				if($db_selected=@mysql_select_db($database,$this->conexion)){
					$this->conectado=true;
					return true;
				}
				else
				{
					$this->conectado=false;
					return false;
				}
		} else {
			$this->conectado=false;
			return false;
		}
		
	}
		
	function desconectarDataBase()
		{
		if ($this->conectado)
			{
			$this->conexion->close();
			}
		}

	function seleccionarDataBase($database){
		if ($this->conectado){
			if ($this->conexion->select_db($database)) {
				return true;
			}else {
				return false;
			}
		}
	}
	function ejecutarSql($sql)
	{
		//$sql=strtolower($sql);
		if ($this->conectado)
		{
			$this->resultado=mysql_query($sql,$this->conexion);
			
			if ($this->resultado){
				$sql=strtolower($sql);
				$res=strstr($sql,"select");
				if($res==false)
				{
					$this->registros=@mysql_num_rows($this->resultado);
					$this->rowset=0;
					$resultado=null;
					return false;
				}
				else{
					$this->rowset=@mysql_fetch_array($this->resultado);
					$this->registros=@mysql_num_rows($this->resultado);
					return true;
				}
			}
			else{
				return false;
			}
		}
	}
	function limpiarConexion()
	{
		if ($this->conectado)
		{
			mysql_free_result($this->resultado);
			unset($this->resultado);
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
		if ($this->conectado)
		{		
			if ($this->resultado)
			{
				if ($this->rowset){
				$this->rowset=mysql_fetch_array($this->resultado);
				return true;
				} else {
				return false;	
				}
			}
		} 
	}
	function seekRegistro($id)
		{
		if ($this->resultado)
			{
			if ($this->registros>$id)
				{
				mysql_data_seek($this->resultado,$id);
				$this->rowset=mysql_fetch_array($this->resultado);
				return true;
				}
			}
		}
	function anteriorRegistro() {}
	
	function getManejador(){
		return "MySql";
	}
	function num_fields(){
		return mysql_num_fields($this->resultado);
	}
	function fetch_field($i){
		return mysql_fetch_field($this->resultado,$i);
	}
	function result($i){
		return mysql_result($this->resultado,$i);
	}
	function validarSql($sql){
		$this->resultado=mysql_query($sql,$this->conexion);
			
		if ($this->resultado){
			return true;
		}
		else{
			return false;
			
		}
	}
}//fin de la clase 
?>
