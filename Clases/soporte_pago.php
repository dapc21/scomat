<?php
class soporte_pago
{
	private $id_pd;
	private $id_cuba;
	private $id_contrato;
	private $monto_dep;
	private $fecha_reg;
	private $fecha_dep;
	private $numero_ref;
	private $status_pd;
	private $tipo_dt;
	private $telefono;
	private $dato;

	function __construct($dat)
	{
		$this->id_pd = $dat['id_pd'];
		$this->id_cuba = $dat['id_cuba'];
		$this->id_contrato = $dat['id_contrato'];
		$this->monto_dep = $dat['monto_dep'];
		$this->fecha_reg = $dat['fecha_reg'];
		$this->fecha_dep = $dat['fecha_dep'];
		$this->numero_ref = $dat['numero_ref'];
		$this->status_pd = $dat['status_pd'];
		$this->tipo_dt = $dat['tipo_dt'];
		$this->telefono = $dat['telefono'];
		$this->dato = $dat['dato'];
	}
	public function verid_pd(){
		return $this->id_pd;
	}
	public function verdato(){
		return $this->dato;
	}
	public function vertelefono(){
		return $this->telefono;
	}
	public function vertipo_dt(){
		return $this->tipo_dt;
	}
	public function verstatus_pd(){
		return $this->status_pd;
	}
	public function vernumero_ref(){
		return $this->numero_ref;
	}
	public function verfecha_dep(){
		return $this->fecha_dep;
	}
	public function verfecha_reg(){
		return $this->fecha_reg;
	}
	public function vermonto_dep(){
		return $this->monto_dep;
	}
	public function verid_contrato(){
		return $this->id_contrato;
	}
	public function verid_cuba(){
		return $this->id_cuba;
	}

	public function validaExistencia($acceso)
	{
		$acceso->objeto->ejecutarSql("select * from soporte_pago where id_pd='$this->id_pd'");
		if($acceso->objeto->registros>0)
			return true;
		else
			return false;
	}
	public function incluir($acceso)
	{
		return $acceso->objeto->ejecutarSql("insert into soporte_pago(id_pd,id_cuba,id_contrato,monto_dep,fecha_reg,fecha_dep,numero_ref,status_pd,tipo_dt,telefono) values ('$this->id_pd','$this->id_cuba','$this->id_contrato','$this->monto_dep','$this->fecha_reg','$this->fecha_dep','$this->numero_ref','$this->status_pd','$this->tipo_dt','$this->telefono')");			
	}
	public function modificar($acceso)
	{
		return $acceso->objeto->ejecutarSql("Update soporte_pago Set id_cuba='$this->id_cuba', id_contrato='$this->id_contrato', monto_dep='$this->monto_dep', fecha_reg='$this->fecha_reg', fecha_dep='$this->fecha_dep', numero_ref='$this->numero_ref', status_pd='$this->status_pd', tipo_dt='$this->tipo_dt', telefono='$this->telefono' Where id_pd='$this->id_pd'");	
	}
	public function eliminar($acceso)
	{
		return $acceso->objeto->ejecutarSql("delete from soporte_pago where id_pd='$this->id_pd'");
	}
}
?>