<?php
class convenio_pago
{
	private $id_conv;
	private $fecha_conv;
	private $obser_conv;
	private $login;
	private $status_conv;
	private $id_contrato;

	function __construct($id_conv,$fecha_conv,$obser_conv,$login,$status_conv,$id_contrato)
	{
		$this->id_conv = $id_conv;
		$this->fecha_conv = $fecha_conv;
		$this->obser_conv = $obser_conv;
		$this->login = $login;
		$this->status_conv = $status_conv;
		$this->id_contrato = $id_contrato;
	}
	public function verid_conv(){
		return $this->id_conv;
	}
	public function verid_contrato(){
		return $this->id_contrato;
	}
	public function verstatus_conv(){
		return $this->status_conv;
	}
	public function verlogin(){
		return $this->login;
	}
	public function verobser_conv(){
		return $this->obser_conv;
	}
	public function verfecha_conv(){
		return $this->fecha_conv;
	}

	public function validaExistencia($acceso)
	{
		$acceso->objeto->ejecutarSql("select * from convenio_pago where id_conv='$this->id_conv'");
		if($acceso->objeto->registros>0)
			return true;
		else
			return false;
	}
	public function incluirconvenio_pago($acceso)
	{
		return $acceso->objeto->ejecutarSql("insert into convenio_pago(id_conv,fecha_conv,obser_conv,login,status_conv,id_contrato) values ('$this->id_conv','$this->fecha_conv','$this->obser_conv','$this->login','$this->status_conv','$this->id_contrato')");			
	}
	public function modificarstatusconvenio_pago($acceso)
	{
		
		 $acceso->objeto->ejecutarSql("Update convenio_pago Set status_conv='INACTIVO' Where id_conv='$this->id_conv'");	
		
	}
	public function modificarconvenio_pago($acceso)
	{
		
		 $acceso->objeto->ejecutarSql("Update convenio_pago Set fecha_conv='$this->fecha_conv', obser_conv='$this->obser_conv', login='$this->login', status_conv='$this->status_conv', id_contrato='$this->id_contrato' Where id_conv='$this->id_conv'");	
		
	}
	public function eliminarconvenio_pago($acceso)
	{
		
		 $acceso->objeto->ejecutarSql("delete from convenio_pago where id_conv='$this->id_conv'");
		
	}
}
?>