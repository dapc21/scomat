<?php
class promo_contrato
{
	private $id_promo_con;
	private $id_contrato;
	private $id_promo;
	private $inicio_promo;
	private $fin_promo;
	private $login;
	private $status_promo_con;
	private $dato;

	function __construct($id_promo_con,$id_contrato,$id_promo,$inicio_promo,$fin_promo,$login,$status_promo_con,$dato)
	{
		$this->id_promo_con = $id_promo_con;
		$this->id_contrato = $id_contrato;
		$this->id_promo = $id_promo;
		$this->inicio_promo = $inicio_promo;
		$this->fin_promo = $fin_promo;
		$this->login = $login;
		$this->status_promo_con = $status_promo_con;
		$this->dato = $dato;
	}
	public function verid_promo_con(){
		return $this->id_promo_con;
	}
	public function verdato(){
		return $this->dato;
	}
	public function verstatus_promo_con(){
		return $this->status_promo_con;
	}
	public function verlogin(){
		return $this->login;
	}
	public function verfin_promo(){
		return $this->fin_promo;
	}
	public function verinicio_promo(){
		return $this->inicio_promo;
	}
	public function verid_promo(){
		return $this->id_promo;
	}
	public function verid_contrato(){
		return $this->id_contrato;
	}

	public function validaExistencia($acceso)
	{
		$acceso->objeto->ejecutarSql("select * from promo_contrato where id_promo_con='$this->id_promo_con'");
		if($acceso->objeto->registros>0)
			return true;
		else
			return false;
	}
	public function incluirpromo_contrato($acceso)
	{
		$acceso->objeto->ejecutarSql("insert into promo_contrato(id_promo_con,id_contrato,id_promo,inicio_promo,fin_promo,login,status_promo_con,dato) values ('$this->id_promo_con','$this->id_contrato','$this->id_promo','$this->inicio_promo','$this->fin_promo','$this->login','$this->status_promo_con','$this->dato')");			
		
	}
	public function modificarpromo_contrato($acceso)
	{
		
		 $acceso->objeto->ejecutarSql("Update promo_contrato Set id_contrato='$this->id_contrato', id_promo='$this->id_promo', inicio_promo='$this->inicio_promo', fin_promo='$this->fin_promo', login='$this->login', status_promo_con='$this->status_promo_con', dato='$this->dato' Where id_promo_con='$this->id_promo_con'");	
		
	}
	public function eliminarpromo_contrato($acceso)
	{
		
		 $acceso->objeto->ejecutarSql("delete from promo_contrato where id_promo_con='$this->id_promo_con'");
		
	}
}
?>