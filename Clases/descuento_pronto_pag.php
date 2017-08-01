<?php
class descuento_pronto_pag
{
	private $id_dpp;
	private $id_franq;
	private $dia_dpp;
	private $monto_dpp;
	private $id_serv_dpp;
	private $status_dpp;
	private $obser_dpp;
	private $dato;

	function __construct($id_dpp,$id_franq,$dia_dpp,$monto_dpp,$id_serv_dpp,$status_dpp,$obser_dpp,$dato)
	{
		$this->id_dpp = $id_dpp;
		$this->id_franq = $id_franq;
		$this->dia_dpp = $dia_dpp;
		$this->monto_dpp = $monto_dpp;
		$this->id_serv_dpp = $id_serv_dpp;
		$this->status_dpp = $status_dpp;
		$this->obser_dpp = $obser_dpp;
		$this->dato = $dato;
	}
	public function verid_dpp(){
		return $this->id_dpp;
	}
	public function verdato(){
		return $this->dato;
	}
	public function verobser_dpp(){
		return $this->obser_dpp;
	}
	public function verstatus_dpp(){
		return $this->status_dpp;
	}
	public function verid_serv_dpp(){
		return $this->id_serv_dpp;
	}
	public function vermonto_dpp(){
		return $this->monto_dpp;
	}
	public function verdia_dpp(){
		return $this->dia_dpp;
	}
	public function verid_franq(){
		return $this->id_franq;
	}

	public function validaExistencia($acceso)
	{
		$acceso->objeto->ejecutarSql("select * from descuento_pronto_pag where id_dpp='$this->id_dpp'");
		if($acceso->objeto->registros>0)
			return true;
		else
			return false;
	}
	public function incluirdescuento_pronto_pag($acceso)
	{
		return $acceso->objeto->ejecutarSql("insert into descuento_pronto_pag(id_dpp,id_franq,dia_dpp,monto_dpp,id_serv_dpp,status_dpp,obser_dpp,dato) values ('$this->id_dpp','$this->id_franq','$this->dia_dpp','$this->monto_dpp','$this->id_serv_dpp','$this->status_dpp','$this->obser_dpp','$this->dato')");			
	}
	public function modificardescuento_pronto_pag($acceso)
	{
		return $acceso->objeto->ejecutarSql("Update descuento_pronto_pag Set id_franq='$this->id_franq', dia_dpp='$this->dia_dpp', monto_dpp='$this->monto_dpp', id_serv_dpp='$this->id_serv_dpp', status_dpp='$this->status_dpp', obser_dpp='$this->obser_dpp', dato='$this->dato' Where id_dpp='$this->id_dpp'");	
	}
	public function eliminardescuento_pronto_pag($acceso)
	{
		return $acceso->objeto->ejecutarSql("delete from descuento_pronto_pag where id_dpp='$this->id_dpp'");
	}
}
?>