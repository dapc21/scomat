<?php
require_once "procesos.php"; $ini_u = $_SESSION["ini_u"];
class serv_acc
{
	private $id_serv;
	private $id_serv_acc;
	private $dato;

	function __construct($id_serv,$id_serv_acc,$dato)
	{
		$this->id_serv = $id_serv;
		$this->id_serv_acc = $id_serv_acc;
		$this->dato = $dato;
	}
	public function verid_serv(){
		return $this->id_serv;
	}
	public function verdato(){
		return $this->dato;
	}
	public function verid_serv_acc(){
		return $this->id_serv_acc;
	}
	public function validaExistencia($acceso){
		return false;
		$acceso->objeto->ejecutarSql("select * from serv_acc where id_serv='$this->id_serv' and id_serv_acc='$this->id_serv_acc'");
		if($acceso->objeto->registros>0){
			return true;
			}
		else{
			return false;
			}
	}
	public function incluirserv_acc($acceso)
	{
		
		if(!$acceso->objeto->ejecutarSql("insert into serv_acc(id_serv,id_serv_acc) values ('$this->id_serv','$this->id_serv_acc')")){
			echo "<br>insert into serv_acc(id_serv,id_serv_acc) values ('$this->id_serv','$id_serv_acc')";
			echo '<br>'.$acceso->objeto->error().'<br>';
		}
		
		return true;
	}
	public function modificarserv_acc($acceso)
	{
		return $acceso->objeto->ejecutarSql("Update serv_acc Set id_serv_acc='$this->id_serv_acc' Where id_serv='$this->id_serv' and id_serv_acc='$this->id_serv_acc'");	
	}
	public function eliminarserv_acc($acceso)
	{
		return $acceso->objeto->ejecutarSql("delete from serv_acc where id_serv='$this->id_serv' ");
	}
	
}
?>