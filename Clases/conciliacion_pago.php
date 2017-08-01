<?php
class conciliacion_pago
{
	private $id_conc;
	private $id_franq;
	private $fecha_conc;
	private $banco;
	private $refer_conc;
	private $monto_conc;
	private $status_conc;
	private $login_conc;
	private $obser_conc;
	private $dato;

	function __construct($id_conc,$id_franq,$fecha_conc,$banco,$refer_conc,$monto_conc,$status_conc,$login_conc,$obser_conc,$dato)
	{
		$this->id_conc = $id_conc;
		$this->id_franq = $id_franq;
		$this->fecha_conc = $fecha_conc;
		$this->banco = $banco;
		$this->refer_conc = $refer_conc;
		$this->monto_conc = $monto_conc;
		$this->status_conc = $status_conc;
		$this->login_conc = $login_conc;
		$this->obser_conc = $obser_conc;
		$this->dato = $dato;
	}
	public function verid_conc(){
		return $this->id_conc;
	}
	public function verdato(){
		return $this->dato;
	}
	public function verobser_conc(){
		return $this->obser_conc;
	}
	public function verlogin_conc(){
		return $this->login_conc;
	}
	public function verstatus_conc(){
		return $this->status_conc;
	}
	public function vermonto_conc(){
		return $this->monto_conc;
	}
	public function verrefer_conc(){
		return $this->refer_conc;
	}
	public function verbanco(){
		return $this->banco;
	}
	public function verfecha_conc(){
		return $this->fecha_conc;
	}
	public function verid_franq(){
		return $this->id_franq;
	}

	public function validaExistencia($acceso)
	{
		$acceso->objeto->ejecutarSql("select * from conciliacion_pago where id_conc='$this->id_conc'");
		if($acceso->objeto->registros>0)
			return true;
		else
			return false;
	}
	public function incluirconciliacion_pago($acceso)
	{
		return $acceso->objeto->ejecutarSql("insert into conciliacion_pago(id_conc,id_franq,fecha_conc,banco,refer_conc,monto_conc,status_conc,login_conc,obser_conc,dato) values ('$this->id_conc','$this->id_franq','$this->fecha_conc','$this->banco','$this->refer_conc','$this->monto_conc','$this->status_conc','$this->login_conc','$this->obser_conc','$this->dato')");			
	}
	public function modificarconciliacion_pago($acceso)
	{
		return $acceso->objeto->ejecutarSql("Update conciliacion_pago Set id_franq='$this->id_franq', fecha_conc='$this->fecha_conc', banco='$this->banco', refer_conc='$this->refer_conc', monto_conc='$this->monto_conc', status_conc='$this->status_conc', login_conc='$this->login_conc', obser_conc='$this->obser_conc', dato='$this->dato' Where id_conc='$this->id_conc'");	
	}
	public function eliminarconciliacion_pago($acceso)
	{
		return $acceso->objeto->ejecutarSql("delete from conciliacion_pago where id_conc='$this->id_conc'");
	}
}
?>