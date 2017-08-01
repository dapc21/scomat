<?php
class cuenta_bancaria
{
	private $id_cuba;
	private $numero_cuba;
	private $banco_cuba;
	private $abrev_cuba;
	private $desc_cuba;
	private $status_cuba;
	private $conc_cliente;
	private $conc_franq;
	private $formato_archivo;
	private $comision_pv;
	private $comision_pv_c;

	function __construct($dat)
	{
		$this->id_cuba = $dat['id_cuba'];
		$this->numero_cuba =$dat['numero_cuba'];
		$this->banco_cuba =$dat['banco_cuba'];
		$this->abrev_cuba =$dat['abrev_cuba'];
		$this->desc_cuba =$dat['desc_cuba'];
		$this->status_cuba =$dat['status_cuba'];
		$this->conc_cliente =$dat['conc_cliente'];
		$this->conc_franq =$dat['conc_franq'];
		$this->formato_archivo =$dat['formato_archivo'];
		$this->comision_pv =$dat['comision_pv'];
		$this->comision_pv_c =$dat['comision_pv_c'];
	}
	public function verid_cuba(){
		return $this->id_cuba;
	}
	public function verdesc_cuba(){
		return $this->desc_cuba;
	}
	public function verabrev_cuba(){
		return $this->abrev_cuba;
	}
	public function verbanco_cuba(){
		return $this->banco_cuba;
	}
	public function vernumero_cuba(){
		return $this->numero_cuba;
	}
	public function validaExistencia($acceso)
	{
		$acceso->objeto->ejecutarSql("select * from cuenta_bancaria where id_cuba='$this->id_cuba'");
		if($acceso->objeto->registros>0)
			return true;
		else
			return false;
	}
	public function incluir($acceso)
	{
				
		
		 $acceso->objeto->ejecutarSql("insert into cuenta_bancaria(id_cuba,numero_cuba,banco_cuba,abrev_cuba,desc_cuba,status_cuba,conc_cliente,conc_franq,formato_archivo,comision_pv,comision_pv_c) values ('$this->id_cuba','$this->numero_cuba','$this->banco_cuba','$this->abrev_cuba','$this->desc_cuba','$this->status_cuba','$this->conc_cliente','$this->conc_franq','$this->formato_archivo','$this->comision_pv','$this->comision_pv_c')");			
				
	}
	public function modificar($acceso)
	{
		
		
		
		 $acceso->objeto->ejecutarSql("Update cuenta_bancaria Set status_cuba='$this->status_cuba',conc_cliente='$this->conc_cliente',conc_franq='$this->conc_franq',formato_archivo='$this->formato_archivo', numero_cuba='$this->numero_cuba', banco_cuba='$this->banco_cuba', abrev_cuba='$this->abrev_cuba', desc_cuba='$this->desc_cuba', comision_pv='$this->comision_pv', comision_pv_c='$this->comision_pv_c'   Where id_cuba='$this->id_cuba'");	
				
	}
	public function eliminar($acceso)
	{
		
		
		
		 $acceso->objeto->ejecutarSql("delete from cuenta_bancaria where id_cuba='$this->id_cuba'");
			
	}
}
?>