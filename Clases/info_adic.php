<?php
class info_adic
{
	private $id_inf_a;
	private $id_contrato;
	private $info_a;
	private $desc_a;
	private $dato;

	function __construct($id_inf_a,$id_contrato,$info_a,$desc_a,$dato)
	{
		$this->id_inf_a = $id_inf_a;
		$this->id_contrato = $id_contrato;
		$this->info_a = $info_a;
		$this->desc_a = $desc_a;
		$this->dato = $dato;
	}
	public function verid_inf_a(){
		return $this->id_inf_a;
	}
	public function verdato(){
		return $this->dato;
	}
	public function verdesc_a(){
		return $this->desc_a;
	}
	public function verinfo_a(){
		return $this->info_a;
	}
	public function verid_contrato(){
		return $this->id_contrato;
	}

	public function validaExistencia($acceso)
	{
		$acceso->objeto->ejecutarSql("select * from info_adic where id_inf_a='$this->id_inf_a'");
		if($acceso->objeto->registros>0)
			return true;
		else
			return false;
	}
	public function incluirinfo_adic($acceso)
	{
		$fecha=date("Y-m-d");
		$hora=date("H:i:s");
		$login = strtoupper(trim($_SESSION["login"]));
		//echo "insert into info_adic(id_inf_a,id_contrato,info_a,desc_a,fecha,hora) values ('$this->id_inf_a','$this->id_contrato','$this->info_a','$this->desc_a','$fecha','$hora')";
		$acceso->objeto->ejecutarSql("insert into info_adic(id_inf_a,id_contrato,info_a,desc_a,fecha,hora,login) values ('$this->id_inf_a','$this->id_contrato','$this->info_a','$this->desc_a','$fecha','$hora','$login')");			
			
	}
	public function modificarinfo_adic($acceso)
	{
		$acceso->objeto->ejecutarSql("Update info_adic Set id_contrato='$this->id_contrato', info_a='$this->info_a', desc_a='$this->desc_a' Where id_inf_a='$this->id_inf_a'");	
				
	}
	public function eliminarinfo_adic($acceso)
	{
		$acceso->objeto->ejecutarSql("delete from info_adic where id_inf_a='$this->id_inf_a'");
				
	}
}
?>