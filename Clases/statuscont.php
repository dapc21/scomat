<?php
class statuscont
{
	private $status_contrato;
	private $nombrestatus;
	private $abrev;
	private $penet;
	private $tipo_sta;
	private $status;
	private $color;

	function __construct($dat)
	{
		$this->status_contrato = $dat['status_contrato'];
		$this->nombrestatus = $dat['nombrestatus'];
		$this->abrev = $dat['abrev'];
		$this->penet = $dat['penet'];
		$this->tipo_sta = $dat['tipo_sta'];
		$this->status = $dat['status'];
		$this->color = $dat['color'];
	}
	public function verstatus_contrato(){
		return $this->status_contrato;
	}
	public function vercolor(){
		return $this->color;
	}
	public function verstatus(){
		return $this->status;
	}
	public function vertipo_sta(){
		return $this->tipo_sta;
	}
	public function verpenet(){
		return $this->penet;
	}
	public function verabrev(){
		return $this->abrev;
	}
	public function vernombrestatus(){
		return $this->nombrestatus;
	}

	public function validaExistencia($acceso)
	{
		$acceso->objeto->ejecutarSql("select * from statuscont where status_contrato='$this->status_contrato'");
		if($acceso->objeto->registros>0)
			return true;
		else
			return false;
	}
	public function incluir($acceso)
	{
		return $acceso->objeto->ejecutarSql("insert into statuscont(status_contrato,nombrestatus,abrev,penet,tipo_sta,status,color) values ('$this->status_contrato','$this->nombrestatus','$this->abrev','$this->penet','$this->tipo_sta','$this->status','$this->color')");			
	}
	public function modificar($acceso)
	{
		return $acceso->objeto->ejecutarSql("Update statuscont Set nombrestatus='$this->nombrestatus', abrev='$this->abrev', penet='$this->penet', tipo_sta='$this->tipo_sta', status='$this->status', color='$this->color' Where status_contrato='$this->status_contrato'");	
	}
	public function eliminar($acceso)
	{
		return $acceso->objeto->ejecutarSql("delete from statuscont where status_contrato='$this->status_contrato'");
	}
}
?>