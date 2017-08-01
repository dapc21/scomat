<?php
class cablemodem
{
	private $id_cm;
	private $id_contrato;
	private $codigo_cm;
	private $marca_cm;
	private $modelo_cm;
	private $prov_cm;
	private $status_cm;
	private $fecha_act_cm;
	private $obser_cm;
	private $nota1;
	private $nota2;
	private $nota3;
	private $dato;

	function __construct($id_cm,$id_contrato,$codigo_cm,$marca_cm,$modelo_cm,$prov_cm,$status_cm,$fecha_act_cm,$obser_cm,$nota1,$nota2,$nota3,$dato)
	{
		$this->id_cm = $id_cm;
		$this->id_contrato = $id_contrato;
		$this->codigo_cm = $codigo_cm;
		$this->marca_cm = $marca_cm;
		$this->modelo_cm = $modelo_cm;
		$this->prov_cm = $prov_cm;
		$this->status_cm = $status_cm;
		$this->fecha_act_cm = $fecha_act_cm;
		$this->obser_cm = $obser_cm;
		$this->nota1 = $nota1;
		$this->nota2 = $nota2;
		$this->nota3 = $nota3;
		$this->dato = $dato;
	}
	public function verid_cm(){
		return $this->id_cm;
	}
	public function verdato(){
		return $this->dato;
	}
	public function vernota3(){
		return $this->nota3;
	}
	public function vernota2(){
		return $this->nota2;
	}
	public function vernota1(){
		return $this->nota1;
	}
	public function verobser_cm(){
		return $this->obser_cm;
	}
	public function verfecha_act_cm(){
		return $this->fecha_act_cm;
	}
	public function verstatus_cm(){
		return $this->status_cm;
	}
	public function verprov_cm(){
		return $this->prov_cm;
	}
	public function vermodelo_cm(){
		return $this->modelo_cm;
	}
	public function vermarca_cm(){
		return $this->marca_cm;
	}
	public function vercodigo_cm(){
		return $this->codigo_cm;
	}
	public function verid_contrato(){
		return $this->id_contrato;
	}

	public function validaExistencia($acceso)
	{
		$acceso->objeto->ejecutarSql("select * from cablemodem where id_cm='$this->id_cm'");
		if($acceso->objeto->registros>0)
			return true;
		else
			return false;
	}
	public function incluircablemodem($acceso)
	{
		
		return $acceso->objeto->ejecutarSql("insert into cablemodem(id_cm,id_contrato,codigo_cm,marca_cm,modelo_cm,prov_cm,status_cm,fecha_act_cm,obser_cm,nota1,nota2,nota3) values ('$this->id_cm','$this->id_contrato','$this->codigo_cm','$this->marca_cm','$this->modelo_cm','$this->prov_cm','$this->status_cm','$this->fecha_act_cm','$this->obser_cm','$this->nota1','$this->nota2','$this->nota3')");			
	}
	public function modificarcablemodem($acceso)
	{
		return $acceso->objeto->ejecutarSql("Update cablemodem Set id_contrato='$this->id_contrato', codigo_cm='$this->codigo_cm', marca_cm='$this->marca_cm', modelo_cm='$this->modelo_cm', prov_cm='$this->prov_cm', status_cm='$this->status_cm', fecha_act_cm='$this->fecha_act_cm', obser_cm='$this->obser_cm', nota1='$this->nota1', nota2='$this->nota2', nota3='$this->nota3' Where id_cm='$this->id_cm'");	
	}
	public function agregarcablemodem($acceso)
	{
		return $acceso->objeto->ejecutarSql("Update cablemodem Set id_contrato='$this->id_contrato', status_cm='I',  nota1='CLIENTE' Where id_cm='$this->id_cm'");	
	}
	public function eliminarcablemodem($acceso)
	{
		return $acceso->objeto->ejecutarSql("delete from cablemodem where id_cm='$this->id_cm'");
	}
}
?>