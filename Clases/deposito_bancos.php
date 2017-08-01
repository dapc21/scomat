<?php
class deposito_bancos
{
	private $id_db;
	private $id_contrato;
	private $fecha_db;
	private $tipo_db;
	private $referencia_db;
	private $monto_db;
	private $obser_db;
	private $status_db;
	private $dato;

	function __construct($id_db,$id_contrato,$fecha_db,$tipo_db,$referencia_db,$monto_db,$obser_db,$status_db,$dato)
	{
		$this->id_db = $id_db;
		$this->id_contrato = $id_contrato;
		$this->fecha_db = $fecha_db;
		$this->tipo_db = $tipo_db;
		$this->referencia_db = $referencia_db;
		$this->monto_db = $monto_db;
		$this->obser_db = $obser_db;
		$this->status_db = $status_db;
		$this->dato = $dato;
	}
	public function verid_db(){
		return $this->id_db;
	}
	public function verdato(){
		return $this->dato;
	}
	public function verstatus_db(){
		return $this->status_db;
	}
	public function verobser_db(){
		return $this->obser_db;
	}
	public function vermonto_db(){
		return $this->monto_db;
	}
	public function verreferencia_db(){
		return $this->referencia_db;
	}
	public function vertipo_db(){
		return $this->tipo_db;
	}
	public function verfecha_db(){
		return $this->fecha_db;
	}
	public function verid_contrato(){
		return $this->id_contrato;
	}

	public function validaExistencia($acceso)
	{
		$acceso->objeto->ejecutarSql("select * from deposito_bancos where id_db='$this->id_db'");
		if($acceso->objeto->registros>0)
			return true;
		else
			return false;
	}
	public function incluirdeposito_bancos($acceso)
	{
		return $acceso->objeto->ejecutarSql("insert into deposito_bancos(id_db,id_contrato,fecha_db,tipo_db,referencia_db,monto_db,obser_db,status_db,dato) values ('$this->id_db','$this->id_contrato','$this->fecha_db','$this->tipo_db','$this->referencia_db','$this->monto_db','$this->obser_db','$this->status_db','$this->dato')");			
	}
	public function modificardeposito_bancos($acceso)
	{
		return $acceso->objeto->ejecutarSql("Update deposito_bancos Set id_contrato='$this->id_contrato', fecha_db='$this->fecha_db', tipo_db='$this->tipo_db', referencia_db='$this->referencia_db', monto_db='$this->monto_db', obser_db='$this->obser_db', status_db='$this->status_db', dato='$this->dato' Where id_db='$this->id_db'");	
	}
	public function eliminardeposito_bancos($acceso)
	{
		return $acceso->objeto->ejecutarSql("delete from deposito_bancos where id_db='$this->id_db'");
	}
}
?>