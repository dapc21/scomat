<?php
class promo_serv
{
	private $id_serv;
	private $id_promo;
	private $dato;

	function __construct($id_serv,$id_promo,$dato='')
	{
		$this->id_serv = $id_serv;
		$this->id_promo = $id_promo;
		$this->dato = $dato;
	}
	public function verid_serv(){
		return $this->id_serv;
	}
	public function verdato(){
		return $this->dato;
	}
	public function verid_promo(){
		return $this->id_promo;
	}

	public function validaExistencia($acceso)
	{
		$acceso->objeto->ejecutarSql("select * from promo_serv where id_serv='$this->id_serv' and id_promo='$this->id_promo'");
		if($acceso->objeto->registros>0)
			return true;
		else
			return false;
	}
	public function incluirpromo_serv($acceso)
	{
		
		 $acceso->objeto->ejecutarSql("insert into promo_serv(id_serv,id_promo,dato) values ('$this->id_serv','$this->id_promo','$this->dato')");			
		
	}
	public function modificarpromo_serv($acceso)
	{
		
		
		 $acceso->objeto->ejecutarSql("Update promo_serv Set id_promo='$this->id_promo', dato='$this->dato' Where id_serv='$this->id_serv'");	
		
	}
	public function eliminarpromo_serv($acceso)
	{
		
		$acceso->objeto->ejecutarSql("delete from promo_serv where id_serv='$this->id_serv'");
		
	}
}
?>