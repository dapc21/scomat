<?php
class cierre_pago
{
	private $id_cont_serv;
	private $id_cierre;
	private $dato;

	function __construct($id_cont_serv,$id_cierre,$dato)
	{
		$this->id_cont_serv = $id_cont_serv;
		$this->id_cierre = $id_cierre;
		$this->dato = $dato;
	}
	public function verid_cont_serv(){
		return $this->id_cont_serv;
	}
	public function verdato(){
		return $this->dato;
	}
	public function verid_cierre(){
		return $this->id_cierre;
	}

	public function validaExistencia($acceso)
	{
		$acceso->objeto->ejecutarSql("select * from cierre_pago where id_cont_serv='$this->id_cont_serv' and id_cierre='$this->id_cierre'");
		if($acceso->objeto->registros>0)
			return true;
		else
			return false;
	}
	public function incluircierre_pago($acceso)
	{
		return $acceso->objeto->ejecutarSql("insert into cierre_pago(id_cont_serv,id_cierre) values ('$this->id_cont_serv','$this->id_cierre')");			
	}
	public function modificarcierre_pago($acceso)
	{
		return $acceso->objeto->ejecutarSql("Update cierre_pago Set id_cierre='$this->id_cierre' Where id_cont_serv='$this->id_cont_serv' and id_cierre='$this->id_cierre'");	
	}
	public function eliminarcierre_pago($acceso)
	{
		return $acceso->objeto->ejecutarSql("delete from cierre_pago where id_cont_serv='$this->id_cont_serv' and id_cierre='$this->id_cierre'");
	}
}
?>