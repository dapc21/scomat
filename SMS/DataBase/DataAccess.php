<?php
// patron factory permite crear clases que construyen clases.
 // require_once("Postgres.php");
class DataAccess
{
	public   $motor='';
	public   $objeto=null;
	public   $host='';
	public   $user='';
	public   $password='';
	public   $database='';
	
	function __construct()
	{
	}
	function conectar($motor, $host, $user, $password, $database){
		$this->motor=$motor;
		//importo el archivo con el motor de base de datos
		require_once $this->motor.".php";		
		if (class_exists($this->motor))
		{
			//creo la clase con el motor de la 
			$this->objeto=new $this->motor();
			//conecta con la base de datos
			$this->objeto->conectarDataBase($host, $user, $password, $database);
			if ($this->objeto->conectado){
				return true;
			} else {
			   return false;	
			}
		}
		else{
			return false;
		}
	}
	
	function &devolver_recordset() {
		return $this->objeto->devolverRegistro();
	}
	
	function __get( $propiedad ) {
		return $this->objeto->$propiedad;
	}
	
	function __call($methodname, $args)
	{
		if ($this->objeto->conectado)
		{
			if (method_exists($this->objeto, $methodname))
			{
				switch (count($args))
					{
					Case 0: 
						$a=$this->objeto->$methodname();
						break;
					case 1:
						$a=$this->objeto->$methodname($args[0]);
						break;
					case 2:
						$a=$this->objeto->$methodname($args[0],$args[1]);
						break;
					case 3:
						$a=$this->objeto->$methodname($args[0],$args[1],$args[2]);
						break;
					case 4:
						$a=$this->objeto->$methodname($args[0],$args[1],$args[2],$args[3]);
						break;
					}
				return $a;
			}
		}
	}

} // fin de clase
?>
