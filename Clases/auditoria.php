<?php
class auditoria
{
	private $id_auditoria;
	private $login;
	private $fecha;
	private $hora;
	private $tipo;
	private $marca;
	private $dir_ip;
	private $comentario;

	function __construct($tipo,$marca,$comentario)
	{
		session_start();
		$this->login = $_SESSION["login"];
		$this->fecha = date("Y-m-d");
		$this->hora = date("H:i:s");
		$this->dir_ip = $_SERVER['REMOTE_ADDR'];
		$this->tipo = $tipo;
		$this->marca = $marca;
		$this->comentario = $comentario;
		
	}
	public function verid_auditoria(){
		return $this->id_auditoria;
	}
	public function vercomentario(){
		return $this->comentario;
	}
	public function verdir_ip(){
		return $this->dir_ip;
	}
	public function vermarca(){
		return $this->marca;
	}
	public function vertipo(){
		return $this->tipo;
	}
	public function verhora(){
		return $this->hora;
	}
	public function verfecha(){
		return $this->fecha;
	}
	public function verlogin(){
		return $this->login;
	}

	public function incluirauditoria($acceso)
	{
		
		session_start();
		$ini_u = $_SESSION["ini_u"];
		$acceso->objeto->ejecutarSql("select  id_auditoria from auditoria  where (id_auditoria ILIKE '$ini_u%')   ORDER BY id_auditoria desc LIMIT 1 offset 0 ");
		$this->id_auditoria=$ini_u.verCodLong($acceso,"id_auditoria");
		 $acceso->objeto->ejecutarSql("insert into auditoria(id_auditoria,login,fecha,hora,tipo,marca,dir_ip,comentario) values ('$this->id_auditoria','$this->login','$this->fecha','$this->hora','$this->tipo','$this->marca','$this->dir_ip','$this->comentario')");			
	
	}
	public function modificarauditoria($acceso)
	{
		
		 $acceso->objeto->ejecutarSql("Update auditoria Set login='$this->login', fecha='$this->fecha', hora='$this->hora', tipo='$this->tipo', marca='$this->marca', dir_ip='$this->dir_ip', comentario='$this->comentario' Where id_auditoria='$this->id_auditoria'");	
	
	}
	public function eliminarauditoria($acceso)
	{
		
		 $acceso->objeto->ejecutarSql("delete from auditoria where id_auditoria='$this->id_auditoria'");
		
	}
}
?>