<?php
/*clase para manejar los datos de los Usuarios, asi como tambien inclui, modificar, cambiar cntraseña,*/
class Usuario
{
	private $login;
	private $password;
	private $status;
	private $codigoPerfil;
	private $codigoEmpleado;
	
	function __construct($login,$password,$status,$codigoPerfil,$codigoEmpleado)
	{
		$this->login = $login;
		$this->password = $password;
		$this->status = $status;
		$this->codigoPerfil = $codigoPerfil;
		$this->codigoEmpleado = $codigoEmpleado;		
	}
	public function verLogin(){
		return $this->login;
	}
	public function verPassword(){
		return $this->password;
	}
	public function verStatus(){
		return $this->status;
	}
	public function verCodigoPerfil(){
		return $this->codigoPerfil;
	}	
	public function verCodigoEmpleado(){
		return $this->CodigoEmpleado;
	}

	public function validaExistencia($acceso)
	{				
		$acceso->objeto->ejecutarSql("select * from usuario where login='$this->login'");		
		if($acceso->objeto->registros>0)
			return true;				
		else
			return false;	
	}	
	public function incluirUsuario($acceso)
	{	
		$acceso->objeto->ejecutarSql("insert into usuario(login,codigoperfil,cedulaempleado,password,statususuario) values ('$this->login','$this->codigoPerfil','$this->codigoEmpleado','$this->password','$this->status')");			
		return true;		
	}	
	public function modificarUsuario($acceso)
	{
		$acceso->objeto->ejecutarSql("Update usuario Set codigoperfil='$this->codigoPerfil', statususuario='$this->status' ,password='$this->password' Where login='$this->login'");		
		return true;			
	}	
	public function eliminarUsuario($acceso)
	{	
		$acceso->objeto->ejecutarSql("delete from usuario where login='$this->login'");					
			return true;		
	}
	//	funcion que permite iniciar una sesion 
	public function iniciarSesion($acceso)
	{
		//compruebo la veracidad de los datos del usuario
		$acceso->objeto->ejecutarSql("select * from usuario where login='$this->login' and password='$this->password' and statususuario='Activo'");		
		if($acceso->objeto->registros>0){
			$row=$acceso->objeto->devolverRegistro();
			//asigno perfil y cedula de la persona que inicia la sesion
			$this->codigoPerfil = trim($row['codigoperfil']);
			$this->codigoEmpleado = trim($row['codigoEmpleado']);
			//creo las variables de sesion
			$_SESSION["autenticacion"]='On';
			$_SESSION["permisologia"]=$permiso;
			$_SESSION["login"]= $this->login;
			return $this->cargarModulos($acceso);
		}
		else{
			return false;
		}
	}
	//funcion para cerrar la sesion
	public function cerrarSesion()
	{
		session_unset();
		session_destroy();
		return "true";
	}
	//permite cargar todos los modulos asignado a un determinado perfil
	function cargarModulos($acceso){
		$modulos="";
		$acceso->objeto->ejecutarSql("select * from vistamodulo where codigoperfil='$this->codigoPerfil' ORDER BY codigomodulo");		
		while($row=$acceso->objeto->devolverRegistro()){
			//esta condicion es propia de AplicaTem
			if(trim($row["namemodulo"])=='CreaFormulario' || trim($row["namemodulo"])=='LimpiarProyecto' || trim($row["namemodulo"])=='VerDatos' || trim($row["namemodulo"])=='GenerarReportes')
				$modulos=$modulos.'<li id="imagen"><a href="#" onclick="conexionPHP_cas(\'Programador/creaFormulario.php\',\''.trim($row["namemodulo"]).'\')">'.trim($row["nombremodulo"]).'</a></li>';					
			else
				$modulos=$modulos.'<li id="imagen"><a href="#" onclick="conexionPHP_cas(\'formulario.php\',\''.trim($row["namemodulo"]).'\')">'.trim($row["nombremodulo"]).'</a></li>';					
			$acceso->objeto->siguienteRegistro();
		}
		echo $modulos."-Class-".$this->cargarOperaciones($acceso);
		return true;
	}
	//permite cargar todas las operaciones asignado a los modulos de un determinado perfil
	function cargarOperaciones($acceso){
		$cadena="";
		$acceso->objeto->ejecutarSql("select * from vistamodulo where codigoperfil='$this->codigoPerfil' ORDER BY codigomodulo");		
		$row=$acceso->objeto->devolverRegistro();
		$cadena=trim($row["nombreperfil"]).'=@'.trim($row["descripcionperfil"]).'=@';
		do{
			$cadena=$cadena.trim($row["nombremodulo"]).','.trim($row["namemodulo"]).','.trim($row["incluir"]).','.trim($row["modificar"]).','.trim($row["eliminar"]).'=@';
			$acceso->objeto->siguienteRegistro();
		}while($row=$acceso->objeto->devolverRegistro()	);
		return $cadena;
	}
}//fin de la class Usuario 
?>