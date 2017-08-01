<?php
class proveedor
{
	private $id_prov;
	private $rif_prov;
	private $nombre_prov;
	private $direccion_prov;
	private $telefonos_prov;
	private $fax_prov;
	private $web_prov;
	private $email_prov;
	private $obser_prov;
	private $forma_pago;
	private $banco;
	private $cuenta;
	private $contacto;
	private $status_prov;
	private $dato;

	function __construct($dat)
	{
		$this->id_prov = $dat['id_prov'];
		$this->rif_prov = $dat['rif_prov'];
		$this->nombre_prov = $dat['nombre_prov'];
		$this->direccion_prov = $dat['direccion_prov'];
		$this->telefonos_prov = $dat['telefonos_prov'];
		$this->fax_prov = $dat['fax_prov'];
		$this->web_prov = $dat['web_prov'];
		$this->email_prov = $dat['email_prov'];
		$this->obser_prov = $dat['obser_prov'];
		$this->forma_pago = $dat['forma_pago'];
		$this->banco = $dat['banco'];
		$this->cuenta = $dat['cuenta'];
		$this->contacto = $dat['contacto'];
		$this->status_prov = $dat['status_prov'];
		$this->dato = $dat['dato'];
	}
	public function verid_prov(){
		return $this->id_prov;
	}
	public function verdato(){
		return $this->dato;
	}
	public function verstatus_prov(){
		return $this->status_prov;
	}
	public function vercontacto(){
		return $this->contacto;
	}
	public function vercuenta(){
		return $this->cuenta;
	}
	public function verbanco(){
		return $this->banco;
	}
	public function verforma_pago(){
		return $this->forma_pago;
	}
	public function verobser_prov(){
		return $this->obser_prov;
	}
	public function veremail_prov(){
		return $this->email_prov;
	}
	public function verweb_prov(){
		return $this->web_prov;
	}
	public function verfax_prov(){
		return $this->fax_prov;
	}
	public function vertelefonos_prov(){
		return $this->telefonos_prov;
	}
	public function verdireccion_prov(){
		return $this->direccion_prov;
	}
	public function vernombre_prov(){
		return $this->nombre_prov;
	}
	public function verrif_prov(){
		return $this->rif_prov;
	}

	public function validaExistencia($acceso)
	{
		$acceso->objeto->ejecutarSql("select * from proveedor where id_prov='$this->id_prov'");
		if($acceso->objeto->registros>0)
			return true;
		else
			return false;
	}
	public function incluir($acceso)
	{
		return $acceso->objeto->ejecutarSql("insert into proveedor(id_prov,rif_prov,nombre_prov,direccion_prov,telefonos_prov,fax_prov,web_prov,email_prov,obser_prov,forma_pago,banco,cuenta,contacto,status_prov) values ('$this->id_prov','$this->rif_prov','$this->nombre_prov','$this->direccion_prov','$this->telefonos_prov','$this->fax_prov','$this->web_prov','$this->email_prov','$this->obser_prov','$this->forma_pago','$this->banco','$this->cuenta','$this->contacto','$this->status_prov')");			
	}
	public function modificar($acceso)
	{
		return $acceso->objeto->ejecutarSql("Update proveedor Set rif_prov='$this->rif_prov', nombre_prov='$this->nombre_prov', direccion_prov='$this->direccion_prov', telefonos_prov='$this->telefonos_prov', fax_prov='$this->fax_prov', web_prov='$this->web_prov', email_prov='$this->email_prov', obser_prov='$this->obser_prov', forma_pago='$this->forma_pago', banco='$this->banco', cuenta='$this->cuenta', status_prov='$this->status_prov', contacto='$this->contacto' Where id_prov='$this->id_prov'");	
	}
	public function eliminar($acceso)
	{
		return $acceso->objeto->ejecutarSql("delete from proveedor where id_prov='$this->id_prov'");
	}
	public function eliminarMatProvproveedor($acceso)
	{
		return $acceso->objeto->ejecutarSql("delete from mat_prov where id_prov='$this->id_prov'");
	}
}
?>