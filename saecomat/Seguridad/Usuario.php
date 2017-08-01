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
		$acceso->objeto->ejecutarSql("select * from usuario where login='$this->login' and password='$this->password' and statususuario='ACTIVO'");		
		if($acceso->objeto->registros>0){
			$row=$acceso->objeto->devolverRegistro();
			//asigno perfil y cedula de la persona que inicia la sesion
			$this->codigoPerfil = trim($row['codigoperfil']);
			$this->codigoEmpleado = trim($row['codigoEmpleado']);
			//creo las variables de sesion
			$_SESSION["autenticacion"]='On';
			$_SESSION["permisologia"]=$permiso;
			$_SESSION["login"]= $this->login;
			return $this->cargarModulos_mat($acceso);
		}
		else{
			return false;
		}
	}
	//funcion para cerrar la sesion
	public function cerrarSesion_mat()
	{
		session_unset();
		session_destroy();
		return "true";
	}
	//permite cargar todos los modulos asignado a un determinado perfil
	function cargarModulos_mat($acceso){
	
	//echo '<li id="imagen"><a href="#" onclick="conexionPHP_mat(\'formulario.php\',\'Modulo\')">Modulo</a></li><li id="imagen"><a href="#" onclick="conexionPHP_mat(\'formulario.php\',\'Perfil\')">Perfil</a></li><li id="imagen"><a href="#" onclick="conexionPHP_mat(\'formulario.php\',\'Usuario\')">Usuario</a></li><li id="imagen"><a href="#" onclick="conexionPHP_mat(\'formulario.php\',\'Persona\')">Persona</a></li><li id="imagen"><a href="#" onclick="conexionPHP_mat(\'Programador/creaFormulario.php\',\'CreaFormulario\')">CreaFormulario</a></li><li id="imagen"><a href="#" onclick="conexionPHP_mat(\'Programador/creaFormulario.php\',\'VerDatos\')">VerDatos</a></li><li id="imagen"><a href="#" onclick="conexionPHP_mat(\'Programador/creaFormulario.php\',\'LimpiarProyecto\')">LimpiarProyecto</a></li><li id="imagen"><a href="#" onclick="conexionPHP_mat(\'Programador/creaFormulario.php\',\'GenerarReportes\')">Generar Reportes</a></li><li id="imagen"><a href="#" onclick="conexionPHP_mat(\'formulario.php\',\'motivo_inv\')">motivo_inv</a></li><li id="imagen"><a href="#" onclick="conexionPHP_mat(\'formulario.php\',\'familia\')">familia</a></li><li id="imagen"><a href="#" onclick="conexionPHP_mat(\'formulario.php\',\'inventario_materiales\')">inventario_materiales</a></li><li id="imagen"><a href="#" onclick="conexionPHP_mat(\'formulario.php\',\'deposito\')">deposito</a></li><li id="imagen"><a href="#" onclick="conexionPHP_mat(\'formulario.php\',\'unidad_medida\')">unidad_medida</a></li><li id="imagen"><a href="#" onclick="conexionPHP_mat(\'formulario.php\',\'tipo_movimiento\')">tipo_movimiento</a></li><li id="imagen"><a href="#" onclick="conexionPHP_mat(\'formulario.php\',\'movimiento\')">movimiento</a></li><li id="imagen"><a href="#" onclick="conexionPHP_mat(\'formulario.php\',\'proveedor\')">proveedor</a></li><li id="imagen"><a href="#" onclick="conexionPHP_mat(\'formulario.php\',\'pedido\')">pedido</a></li><li id="imagen"><a href="#" onclick="conexionPHP_mat(\'formulario.php\',\'materiales\')">materiales</a></li><li id="imagen"><a href="#" onclick="conexionPHP_mat(\'formulario.php\',\'mov_mat\')">mov_mat</a></li><li id="imagen"><a href="#" onclick="conexionPHP_mat(\'formulario.php\',\'mat_prov\')">mat_prov</a></li><li id="imagen"><a href="#" onclick="conexionPHP_mat(\'formulario.php\',\'mat_ped\')">mat_ped</a></li><li id="imagen"><a href="#" onclick="conexionPHP_mat(\'formulario.php\',\'confir_pedido\')">confir_pedido</a></li><li id="imagen"><a href="#" onclick="conexionPHP_mat(\'formulario.php\',\'Rep_reportepedido\')">reportepedido</a></li><li id="imagen"><a href="#" onclick="conexionPHP_mat(\'formulario.php\',\'realizar_compra\')">registrar_compra</a></li><li id="imagen"><a href="#" onclick="conexionPHP_mat(\'formulario.php\',\'inventario\')">inventario</a></li><li id="imagen"><a href="#" onclick="conexionPHP_mat(\'formulario.php\',\'aprobarinventario\')">aprobar inventario</a></li><li id="imagen"><a href="#" onclick="conexionPHP_mat(\'formulario.php\',\'mat_padre\')">mat_padre</a></li>-Class-Administrador=@administrador de la aplicacion=@Modulo,Modulo,true,true,true=@Perfil,Perfil,true,true,true=@Usuario,Usuario,true,true,true=@Persona,Persona,true,true,true=@CreaFormulario,CreaFormulario,true,true,true=@VerDatos,VerDatos,true,true,true=@LimpiarProyecto,LimpiarProyecto,true,true,true=@Generar Reportes,GenerarReportes,true,true,true=@motivo_inv,motivo_inv,true,true,true=@familia,familia,true,true,true=@inventario_materiales,inventario_materiales,true,true,true=@deposito,deposito,true,true,true=@unidad_medida,unidad_medida,true,true,true=@tipo_movimiento,tipo_movimiento,true,true,true=@movimiento,movimiento,true,true,true=@proveedor,proveedor,true,true,true=@pedido,pedido,true,true,true=@materiales,materiales,true,true,true=@mov_mat,mov_mat,true,true,true=@mat_prov,mat_prov,true,true,true=@mat_ped,mat_ped,true,true,true=@confir_pedido,confir_pedido,true,true,true=@reportepedido,Rep_reportepedido,true,true,true=@registrar_compra,realizar_compra,true,true,true=@inventario,inventario,true,true,true=@aprobar inventario,aprobarinventario,true,true,true=@mat_padre,mat_padre,true,true,true=@';
	
		$modulos="";
		$acceso->objeto->ejecutarSql("select * from vistamodulo where codigoperfil='$this->codigoPerfil' ORDER BY codigomodulo");		
		while($row=$acceso->objeto->devolverRegistro()){
			//esta condicion es propia de AplicaTem
			if(trim($row["namemodulo"])=='CreaFormulario' || trim($row["namemodulo"])=='LimpiarProyecto' || trim($row["namemodulo"])=='VerDatos' || trim($row["namemodulo"])=='GenerarReportes')
				$modulos=$modulos.'<li id="imagen"><a href="#" onclick="conexionPHP_mat(\'Programador/creaFormulario.php\',\''.trim($row["namemodulo"]).'\')">'.trim($row["nombremodulo"]).'</a></li>';					
			else
				$modulos=$modulos.'<li id="imagen"><a href="#" onclick="conexionPHP_mat(\'formulario.php\',\''.trim($row["namemodulo"]).'\')">'.trim($row["nombremodulo"]).'</a></li>';					
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