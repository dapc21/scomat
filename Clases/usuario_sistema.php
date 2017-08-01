<?php

/*clase para manejar los datos de los Usuarios, asi como tambien inclui, modificar, cambiar cntraseña,*/
require_once "Clases/persona.php";
class usuario_sistema extends Persona
{
	private $login;
	private $password;
	private $status;
	private $codigoperfil;
	private $id_persona;
	public $id_franq;
	public $id_servidor;
 
	function __construct($dat)
	{
		parent::__construct($dat);
		$this->login = $dat['login'];
		$this->password = strtoupper(md5(strtoupper($dat['password'])));
		$this->status = $dat['status'];
		$this->codigoperfil = $dat['codigoperfil'];
		$this->id_persona = $dat['id_persona'];		
		$this->id_franq = $dat['id_franq'];		
		$this->id_servidor = $dat['id_servidor'];		
	}
	
	public function incluir($acceso)
	{
		session_start();
			 $ini_u = $_SESSION["ini_u"]; 
			$acceso->objeto->ejecutarSql("select *from usuario  where (id_usuario ILIKE '$ini_u%')  ORDER BY id_usuario desc"); 

			$id_usuario=$ini_u.verCo($acceso,"id_usuario");
			
		$inicial='';
		parent::incluir($acceso);

		$acceso->objeto->ejecutarSql("insert into usuario(login,codigoperfil,id_persona,password,statususuario,inicial,id_franq,id_servidor,id_usuario) values ('$this->login','$this->codigoperfil','$this->id_persona','$this->password','$this->status','$inicial','$this->id_franq','$this->id_servidor','$id_usuario')");
		$this->incluriInicial($acceso);
		
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
						$acceso->objeto->ejecutarSql("Update inicial_id Set status='CREADO' Where id_inicial_id='$id_inicial_id';");
					}
				}
	}
	public function modificar($acceso)
	{
		
		$acceso->objeto->ejecutarSql("Update usuario Set codigoperfil='$this->codigoperfil', statususuario='$this->status' ,password='$this->password',id_franq='$this->id_franq' ,id_servidor='$this->id_servidor' Where login='$this->login'");		
		
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
	public function eliminar($acceso)
	{
		$acceso->objeto->ejecutarSql("delete from usuario where login='$this->login'");
			 
	}
	
}//fin de la class Usuario 
?>