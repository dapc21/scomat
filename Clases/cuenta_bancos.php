<?php
class cuenta_bancos
{
	private $id_cb;
	private $banco;
	private $fecha_cb;
	private $tipo_db;
	private $referencia_db;
	private $monto_db;
	private $descrip_db;
	private $status_db;
	private $tipo_cb;
	private $relacion_cb;
	private $login_conf;
	private $fecha_reg;
	private $dato;

	function __construct($id_cb,$banco,$fecha_cb,$tipo_db,$referencia_db,$monto_db,$descrip_db,$status_db,$tipo_cb,$relacion_cb,$login_conf,$fecha_reg,$dato)
	{
		$this->id_cb = $id_cb;
		$this->banco = $banco;
		$this->fecha_cb = $fecha_cb;
		$this->tipo_db = $tipo_db;
		$this->referencia_db = $referencia_db;
		$this->monto_db = $monto_db;
		$this->descrip_db = $descrip_db;
		$this->status_db = $status_db;
		$this->tipo_cb = $tipo_cb;
		$this->relacion_cb = $relacion_cb;
		$this->login_conf = $login_conf;
		$this->fecha_reg = $fecha_reg;
		$this->dato = $dato;
	}
	public function verid_cb(){
		return $this->id_cb;
	}
	public function verdato(){
		return $this->dato;
	}
	public function verfecha_reg(){
		return $this->fecha_reg;
	}
	public function verlogin_conf(){
		return $this->login_conf;
	}
	public function verrelacion_cb(){
		return $this->relacion_cb;
	}
	public function vertipo_cb(){
		return $this->tipo_cb;
	}
	public function verstatus_db(){
		return $this->status_db;
	}
	public function verdescrip_db(){
		return $this->descrip_db;
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
	public function verfecha_cb(){
		return $this->fecha_cb;
	}
	public function verbanco(){
		return $this->banco;
	}

	public function validaExistencia($acceso)
	{
		$acceso->objeto->ejecutarSql("select * from cuenta_bancos where id_cb='$this->id_cb'");
		if($acceso->objeto->registros>0)
			return true;
		else
			return false;
	}
	public function incluircuenta_bancos($acceso)
	{
		return $acceso->objeto->ejecutarSql("insert into cuenta_bancos(id_cb,banco,fecha_cb,tipo_db,referencia_db,monto_db,descrip_db,status_db,tipo_cb,relacion_cb,login_conf,fecha_reg,dato) values ('$this->id_cb','$this->banco','$this->fecha_cb','$this->tipo_db','$this->referencia_db','$this->monto_db','$this->descrip_db','$this->status_db','$this->tipo_cb','$this->relacion_cb','$this->login_conf','$this->fecha_reg','$this->dato')");			
	}
	public function modificarcuenta_bancos($acceso)
	{
		return $acceso->objeto->ejecutarSql("Update cuenta_bancos Set banco='$this->banco', fecha_cb='$this->fecha_cb', tipo_db='$this->tipo_db', referencia_db='$this->referencia_db', monto_db='$this->monto_db', descrip_db='$this->descrip_db', status_db='$this->status_db', tipo_cb='$this->tipo_cb', relacion_cb='$this->relacion_cb', login_conf='$this->login_conf', fecha_reg='$this->fecha_reg', dato='$this->dato' Where id_cb='$this->id_cb'");	
	}
	public function eliminarcuenta_bancos($acceso)
	{
		return $acceso->objeto->ejecutarSql("delete from cuenta_bancos where id_cb='$this->id_cb'");
	}
}
?>