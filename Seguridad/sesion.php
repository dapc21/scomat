<?php

/*clase para manejar los datos de los Usuarios, asi como tambien inclui, modificar, cambiar cntraseña,*/
class Usuario
{
	private $login;
	private $password;
	private $status;
	private $codigoPerfil;
	private $id_persona;
	public $in;
	public $mo;
	public $el;
	public $id_franq;
	public $id_servidor;
	public $inicial;
 
	function __construct($login,$password,$status,$codigoPerfil,$id_persona,$id_franq='0',$id_servidor='0')
	{
		$this->login = $login;
		$this->password = strtoupper(md5(strtoupper($password)));
		$this->status = $status;
		$this->codigoPerfil = $codigoPerfil;
		$this->id_persona = $id_persona;		
		$this->id_franq = $id_franq;		
		$this->id_servidor = $id_servidor;		
	}
	
	function parametros($login,$password,$status,$codigoPerfil,$id_persona)
	{
		$this->login = $login;
		$this->password = $password;
		$this->status = $status;
		$this->codigoPerfil = $codigoPerfil;
		$this->id_persona = $id_persona;		
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
	public function verid_persona(){
		return $this->id_persona;
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
		
		require_once "Clases/trans_pago.php";
		$obj_trans=new trans_pago();
		$obj_trans->begin($acceso);
		session_start();
			 $ini_u = $_SESSION["ini_u"]; 
			$acceso->objeto->ejecutarSql("select *from usuario  where (id_usuario ILIKE '$ini_u%')  ORDER BY id_usuario desc"); 

			$id_usuario=$ini_u.verCo($acceso,"id_usuario");
			
		$inicial='';
		//echo "insert into usuario(login,codigoperfil,id_persona,password,statususuario,inicial) values ('$this->login','$this->codigoPerfil','$this->id_persona','$this->password','$this->status','$inicial')";
		$acceso->objeto->ejecutarSql("insert into usuario(login,codigoperfil,id_persona,password,statususuario,inicial,id_franq,id_servidor,id_usuario) values ('$this->login','$this->codigoPerfil','$this->id_persona','$this->password','$this->status','$inicial','$this->id_franq','$this->id_servidor','$id_usuario')");			
		$this->incluriInicial($acceso);
		$obj_trans->commit($acceso);			 
		
	}
	public function incluriInicial($acceso)
	{
		require_once("procesos.php");
		$servi=lectura($acceso,"select id_servidor from servidor  where status_ser='ACTIVO'");
		$k=1;
				$login=$this->login;
				for($j=0;$j<count($servi);$j++)
				{
					$id_servidor=$servi[$j]['id_servidor'];
					$acceso->objeto->ejecutarSql("select id_inicial_id,inicial from inicial_id  where id_servidor='$id_servidor' and status='DISPONIBLE' ORDER BY id_inicial_id");
					if($row=row($acceso)){
						$inicial=trim($row['inicial']);
						$id_inicial_id=trim($row['id_inicial_id']);
						$acceso->objeto->ejecutarSql("insert into usuario_inicial(login,id_servidor,inicial) values ('$login','$id_servidor','$inicial');");
						$acceso->objeto->ejecutarSql("Update inicial_id Set status='ASIGNADO' Where id_inicial_id='$id_inicial_id';");
					}
				}
	}
	public function modificarUsuario($acceso)
	{
		
		require_once "Clases/trans_pago.php";
		$obj_trans=new trans_pago();
		$obj_trans->begin($acceso);
		
			
		$acceso->objeto->ejecutarSql("Update usuario Set codigoperfil='$this->codigoPerfil', statususuario='$this->status' ,password='$this->password',id_franq='$this->id_franq' ,id_servidor='$this->id_servidor' Where login='$this->login'");		
			$obj_trans->commit($acceso);			 
	
	}
	public function cambiarConUsuario($acceso)
	{
		//echo " :$this->password:";
		$acceso->objeto->ejecutarSql("select * from usuario where login='$this->login' and password='$this->password'");		
		if($acceso->objeto->registros>0){
			$this->status = strtoupper(md5(strtoupper($this->status)));
			$acceso->objeto->ejecutarSql("Update usuario Set password='$this->status' Where login='$this->login' and password='$this->password'");		
		}
		else{
			echo utf8_encode(" La contraseña actual no coincide con el Usuario.");
		}
	}	
	public function eliminarUsuario($acceso)
	{
		
		require_once "Clases/trans_pago.php";
		$obj_trans=new trans_pago();
		$obj_trans->begin($acceso);
		
			$acceso->objeto->ejecutarSql("delete from usuario where login='$this->login'");
		$obj_trans->commit($acceso);			 
	}
	//	funcion que permite iniciar una sesion 
	public function iniciarSesion($acceso)
	{
					require_once("../procesos.php"); 
		$respuesta = array();
		$acceso->objeto->ejecutarSql("select * from usuario where login='$this->login' and password='$this->password' and statususuario='ACTIVO'");		
		if($acceso->objeto->registros>0){
			$respuesta["success"] = true;

			$row=$acceso->objeto->devolverRegistro();
			//asigno perfil y cedula de la persona que inicia la sesion
			$this->codigoPerfil = trim($row['codigoperfil']);
			//echo ":$this->codigoPerfil:";
			$this->id_persona = trim($row['id_persona']);
			$this->id_franq = trim($row['id_franq']);
			//creo las variables de sesion
			$_SESSION["autenticacion"]='On';
			$_SESSION["perfil"]=$this->codigoPerfil;
			$_SESSION["id_persona"]=$this->id_persona;
			$_SESSION["login"]=$this->login;
			$_SESSION["id_caja_cob"]='';
			//$_SESSION["ini_u"]=trim($row['inicial']);
			//$this->inicial=trim($row['inicial']);
			$_SESSION["id_franq"]=trim($row['id_franq']);
			
			$acceso->objeto->ejecutarSql("select serie from franquicia where id_franq='$this->id_franq'");
			$row=$acceso->objeto->devolverRegistro();
			$this->inicial = trim($row["serie"]);
			$_SESSION["serie"]=trim($row['serie']);
			
			$acceso->objeto->ejecutarSql("select inicial from usuario_inicial,servidor where usuario_inicial.id_servidor=servidor.id_servidor  and login='$this->login' and servidor.status_servidor='LOCAL'");
			$row=$acceso->objeto->devolverRegistro();
			$_SESSION["ini_u"]=trim($row["inicial"]);
			//echo ":".$_SESSION["ini_u"];
			
			require_once "../Clases/auditoria.php";
			$objeto=new auditoria("Inicio de Sesion",$_SESSION["login"],"");
			$objeto->incluirauditoria($acceso);

			$respuesta["mensualidad"] = $this->verificaMensualidad($acceso);
			$respuesta["resultado"] = $this->cargarModulos($acceso);
		}
		else{
			$respuesta["success"] = false;
			$respuesta["error"] = "Intento de Violación de Seguridad, debe iniciar sesion.";
		}
		
		header('Content-type: application/json; charset=utf-8');
		echo json_encode($respuesta, JSON_FORCE_OBJECT);

	}
	
	//funcion para cerrar la sesion
	public function cerrarSesion($acceso)
	{
		require_once "../Clases/auditoria.php";
		$objeto=new auditoria("Cierre de Sesion",$_SESSION["login"],"");
		$objeto->incluirauditoria($acceso);
		session_unset();
		session_destroy();
		return "true";
	}
	public function verificaMensualidad($acceso)
	{
		require_once("../procesos.php");  $ini_u = $_SESSION["ini_u"]; 
		$fec=date("Y-m-01");
		$registro=false;
		
		  $acceso->objeto->ejecutarSql("select *from mensualidad where fecha_mens='$fec'"); 
		  if(!row($acceso)){
			return "cargarMensualidad";
		  }
		  else{
		  
			return "cargada";
		  }
		 // verificamen($acceso);
		 
	}

	//permite cargar todos los modulos asignado a un determinado perfil
	function cargarModulos($acceso){
		$acceso->objeto->ejecutarSql("select * from personausuario where login='$this->login'");		
		$row=$acceso->objeto->devolverRegistro();
		$nombre_persona=ucwords(strtolower(trim($row["nombre"])." ". trim($row["apellido"])));
		$nombre_perf=ucwords(strtolower(trim($row["nombreperfil"])));
		$result = array();
		$usuario = array("nombreperfil"=>trim($row["nombreperfil"]),"id_franq"=>trim($row["id_franq"]),"codigoperfil"=>trim($row["codigoperfil"]),"cedula"=>trim($row["cedula"]),"nombre"=>trim($row["nombre"]),"apellido"=>trim($row["apellido"]),"id_persona"=>trim($row["id_persona"]),"inicial"=>$this->inicial);

	
		$profile='<ul class="nav pull-right top-menu">
									
						<li class="dropdown logout-user">
							<a class="dropdown-toggle" href="#" data-toggle="dropdown">
								<img src="bootstrap/img/avatar-mini_per.jpg" alt="">
								<span class="username">'.$nombre_persona.'</span>
								<b class="caret"></b>
							</a>
							<ul class="dropdown-menu extended logout">
							<div class="log-arrow-up"></div>
								<li><a href="#"><i class="glyphicon fa fa-user"></i>'.strtoupper($this->login).'</a></li>
								<li><a href="#"><i class="glyphicon fa fa-suitcase"></i>'.$nombre_perf.'</a></li>
								<li><a href="#" onclick="conexionPHP(\'Seguridad/Seguridad.php\',\'CerrarSesion\')"><i class="glyphicon glyphicon-lock"></i> Cerrar Sesion</a></li>
							</ul>
						</li>
					</ul>';
		$result = array("usuario"=>$usuario,"profile"=>$profile);
		return $result;
	}
	
	public function cargarMenu($acceso)
	{
		$acceso->objeto->ejecutarSql("select * from vistamodulo where codigoperfil='$this->codigoPerfil' ORDER BY codigomodulo");		
		while($row=$acceso->objeto->devolverRegistro()){
			//esta condicion es propia de AplicaTem
			if(trim($row["namemodulo"])=='CreaFormulario' || trim($row["namemodulo"])=='LimpiarProyecto' || trim($row["namemodulo"])=='VerDatos' || trim($row["namemodulo"])=='GenerarReportes')
				$modulos=$modulos.'<li id="imagen"><a href="#" onclick="conexionPHP(\'Programador/creaFormulario.php\',\''.trim($row["namemodulo"]).'\')">'.trim($row["nombremodulo"]).'</a></li>';					
			else
				$modulos=$modulos.'<li id="imagen"><a href="#" onclick="conexionPHP(\'formulario.php\',\''.trim($row["namemodulo"]).'\')">'.trim($row["nombremodulo"]).'</a></li>';					
			$acceso->objeto->siguienteRegistro();
		}
	}
	public function autenticarUsuario($acceso)
	{
		if($_SESSION["autenticacion"]=="On"){
			//echo "como:".$_SESSION["perfil"].":".$_SESSION["login"].":";
			if($_SESSION["perfil"]!="" && $_SESSION["login"]!=""){
				//echo "como";
				return true;
			}
			else{
				return false;
			}
		}
		else{
			return false;
		}
	}
	public function permisoModulo($acceso,$modulo)
	{
		$ope=array("TRUE"=>"button","FALSE"=>"hidden");
			//echo "entro";
		if($this->autenticarUsuario($acceso)==true){
			$perfil=$_SESSION["perfil"];
			//echo  "select * from vistamodulo where codigoperfil='$perfil' and namemodulo='$modulo'  LIMIT 1 offset 0";
			$acceso->objeto->ejecutarSql("select * from vistamodulo where codigoperfil='$perfil' and namemodulo='$modulo'  LIMIT 1 offset 0");		
			if($row=$acceso->objeto->devolverRegistro()){
				
				$this->in=$ope[strtoupper(trim($row["incluir"]))];
				$this->mo=$ope[strtoupper(trim($row["modificar"]))];
				$this->el=$ope[strtoupper(trim($row["eliminar"]))];
				return true;
			}
			else{
				return false;
			}
		}
		else{
			return false;
		}
	}
	public function permisoIncluir($acceso,$modulo)
	{
		if($this->autenticarUsuario($acceso)==true){
			$perfil=$_SESSION["perfil"];
			$acceso->objeto->ejecutarSql("select * from vistamodulo where codigoperfil='$perfil' and namemodulo='$modulo' ORDER BY codigomodulo");		
			$row=$acceso->objeto->devolverRegistro();
			if(trim($row["incluir"])=="true"){
				return true;
			}
			else{
				return false;
			}
		}
		else{
			return false;
		}
	}
	public function permisoModificar($acceso,$modulo)
	{
		if($this->autenticarUsuario($acceso)==true){
			$perfil=$_SESSION["perfil"];
			$acceso->objeto->ejecutarSql("select * from vistamodulo where codigoperfil='$perfil' and namemodulo='$modulo' ORDER BY codigomodulo");		
			$row=$acceso->objeto->devolverRegistro();
			if(trim($row["modificar"])=="true"){
				return true;
			}
			else{
				return false;
			}
		}
		else{
			return false;
		}
	}
	public function permisoEliminar($acceso,$modulo)
	{
		if($this->autenticarUsuario($acceso)==true){
			$perfil=$_SESSION["perfil"];
			$acceso->objeto->ejecutarSql("select * from vistamodulo where codigoperfil='$perfil' and namemodulo='$modulo' ORDER BY codigomodulo");		
			$row=$acceso->objeto->devolverRegistro();
			if(trim($row["eliminar"])=="true"){
				return true;
			}
			else{
				return false;
			}
		}
		else{
			return false;
		}
	}
}//fin de la class Usuario 
?>