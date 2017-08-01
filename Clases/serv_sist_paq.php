<?php
class serv_sist_paq
{
	private $id_serv;
	private $id_serv_sist;
	private $dato;

	function __construct($dat)
	{
		$this->id_serv = $dat['id_serv'];
		$this->id_serv_sist = $dat['id_serv_sist'];
		$this->dato = $dat['dato'];
	}
	public function verid_serv(){
		return $this->id_serv;
	}
	public function verdato(){
		return $this->dato;
	}
	public function verid_serv_sist(){
		return $this->id_serv_sist;
	}
	public function validaExistencia($acceso){
		return false;
		$acceso->objeto->ejecutarSql("select * from serv_sist_paq where id_serv='$this->id_serv' and id_serv_sist='$this->id_serv_sist'");
		if($acceso->objeto->registros>0){
			return true;
			}
		else{
			return false;
			}
	}
	public function incluirserv_sist_paq($acceso)
	{
		
		if(!$acceso->objeto->ejecutarSql("insert into serv_sist_paq(id_serv,id_serv_sist) values ('$this->id_serv','$this->id_serv_sist')")){
			echo "<br>insert into serv_sist_paq(id_serv,id_serv_sist) values ('$this->id_serv','$id_serv_sist')";
			echo '<br>'.$acceso->objeto->error().'<br>';
		}
		
		return true;
	}
	public function modificarserv_sist_paq($acceso)
	{
		return $acceso->objeto->ejecutarSql("Update serv_sist_paq Set id_serv_sist='$this->id_serv_sist' Where id_serv='$this->id_serv' and id_serv_sist='$this->id_serv_sist'");	
	}
	public function eliminarserv_sist_paq($acceso)
	{
		return $acceso->objeto->ejecutarSql("delete from serv_sist_paq where id_serv='$this->id_serv' ");
	}
	
}
?>