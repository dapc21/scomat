<?php
class empresa
{
	private $id_emp;
	private $rif_emp;
	private $razon_social_emp;
	private $nombre_comercial_emp;
	private $telefono_emp;
	private $correo_emp;
	private $logo_emp;
	private $infor_adic_emp;
	private $direccion_emp;
	private $obsrv_emp;
	private $dato;

	function __construct($dat)
	{
		$this->id_emp = $dat['id_emp'];
		$this->rif_emp = $dat['rif_emp'];
		$this->razon_social_emp = $dat['razon_social_emp'];
		$this->nombre_comercial_emp = $dat['nombre_comercial_emp'];
		$this->telefono_emp = $dat['telefono_emp'];
		$this->correo_emp = $dat['correo_emp'];
		$this->logo_emp = $dat['logo_emp'];
		$this->infor_adic_emp = $dat['infor_adic_emp'];
		$this->direccion_emp = $dat['direccion_emp'];
		$this->obsrv_emp = $dat['obsrv_emp'];
		$this->dato = $dat['dato'];
	}
	public function verid_emp(){
		return $this->id_emp;
	}
	public function verdato(){
		return $this->dato;
	}
	public function verobsrv_emp(){
		return $this->obsrv_emp;
	}
	public function verdireccion_emp(){
		return $this->direccion_emp;
	}
	public function verinfor_adic_emp(){
		return $this->infor_adic_emp;
	}
	public function verlogo_emp(){
		return $this->logo_emp;
	}
	public function vercorreo_emp(){
		return $this->correo_emp;
	}
	public function vertelefono_emp(){
		return $this->telefono_emp;
	}
	public function vernombre_comercial_emp(){
		return $this->nombre_comercial_emp;
	}
	public function verrazon_social_emp(){
		return $this->razon_social_emp;
	}
	public function verrif_emp(){
		return $this->rif_emp;
	}

	public function validaExistencia($acceso)
	{
		$acceso->objeto->ejecutarSql("select * from empresa where id_emp='$this->id_emp'");
		if($acceso->objeto->registros>0)
			return true;
		else
			return false;
	}
	public function incluir($acceso)
	{
		return $acceso->objeto->ejecutarSql("insert into empresa(id_emp,rif_emp,razon_social_emp,nombre_comercial_emp,telefono_emp,correo_emp,logo_emp,infor_adic_emp,direccion_emp,obsrv_emp) values ('$this->id_emp','$this->rif_emp','$this->razon_social_emp','$this->nombre_comercial_emp','$this->telefono_emp','$this->correo_emp','$this->logo_emp','$this->infor_adic_emp','$this->direccion_emp','$this->obsrv_emp')");			
	}
	public function modificar($acceso)
	{
		return $acceso->objeto->ejecutarSql("Update empresa Set rif_emp='$this->rif_emp', razon_social_emp='$this->razon_social_emp', nombre_comercial_emp='$this->nombre_comercial_emp', telefono_emp='$this->telefono_emp', correo_emp='$this->correo_emp', logo_emp='$this->logo_emp', infor_adic_emp='$this->infor_adic_emp', direccion_emp='$this->direccion_emp', obsrv_emp='$this->obsrv_emp' Where id_emp='$this->id_emp'");	
	}
	public function eliminar($acceso)
	{
		return $acceso->objeto->ejecutarSql("delete from empresa where id_emp='$this->id_emp'");
	}
}
?>