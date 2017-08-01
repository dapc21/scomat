<?php
require_once "procesos.php"; $ini_u = $_SESSION["ini_u"];
class servicio_franquicia
{
	private $id_franq;
	private $id_serv;
	private $dato;

	function __construct($id_franq,$id_serv)
	{
		$this->id_franq = $id_franq;
		$this->id_serv = $id_serv;
		
	}
	public function verid_franq(){
		return $this->id_franq;
	}
	public function verdato(){
		return $this->dato;
	}
	public function verid_serv(){
		return $this->id_serv;
	}
	public function validaExistencia($acceso){
		return false;
		$acceso->objeto->ejecutarSql("select * from servicio_franquicia where id_franq='$this->id_franq' and id_serv='$this->id_serv'");
		if($acceso->objeto->registros>0){
			return true;
			}
		else{
			return false;
			}
	}
	public function incluirservicio_franquicia($acceso)
	{
		
		if(!$acceso->objeto->ejecutarSql("insert into servicio_franquicia(id_franq,id_serv) values ('$this->id_franq','$this->id_serv')")){
			echo "<br>insert into servicio_franquicia(id_franq,id_serv) values ('$this->id_franq','$id_serv')";
			echo '<br>'.$acceso->objeto->error().'<br>';
		}
		
		return true;
	}
	public function modificarservicio_franquicia($acceso)
	{
		return $acceso->objeto->ejecutarSql("Update servicio_franquicia Set id_serv='$this->id_serv' Where id_franq='$this->id_franq' and id_serv='$this->id_serv'");	
	}
	public function eliminarservicio_franquicia($acceso)
	{
		return $acceso->objeto->ejecutarSql("delete from servicio_franquicia where id_serv='$this->id_serv''");
	}
	
}
?>