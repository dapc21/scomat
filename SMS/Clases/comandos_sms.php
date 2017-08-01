<?php
class comandos_sms
{
	private $id_com;
	private $id_franq;
	private $tipo_com;
	private $nombre_com;
	private $descrip_com;
	private $status_com;
	private $sms_resp;
	private $tipo_variable;
	private $sms_error;
	private $status_error;
	private $resp_correo;

	function __construct($id_com,$id_franq,$tipo_com,$nombre_com,$descrip_com,$status_com,$sms_resp,$tipo_variable,$sms_error,$status_error,$resp_correo)
	{
		$this->id_com = $id_com;
		$this->id_franq = $id_franq;
		$this->tipo_com = $tipo_com;
		$this->nombre_com = $nombre_com;
		$this->descrip_com = $descrip_com;
		$this->status_com = $status_com;
		$this->sms_resp = $sms_resp;
		$this->tipo_variable = $tipo_variable;
		$this->sms_error = $sms_error;
		$this->status_error = $status_error;
		//$this->resp_correo = $resp_correo;
		$this->resp_correo = str_replace ("|-and-|", "&", $resp_correo);
	}
	public function verid_com(){
		return $this->id_com;
	}
	public function versms_resp(){
		return $this->sms_resp;
	}
	public function verstatus_com(){
		return $this->status_com;
	}
	public function verdescrip_com(){
		return $this->descrip_com;
	}
	public function vernombre_com(){
		return $this->nombre_com;
	}
	public function vertipo_com(){
		return $this->tipo_com;
	}
	public function verid_franq(){
		return $this->id_franq;
	}

	public function validaExistencia($acceso)
	{
		$acceso->objeto->ejecutarSql("select * from comandos_sms where id_com='$this->id_com'");
		if($acceso->objeto->registros>0)
			return true;
		else
			return false;
	}
	public function incluircomandos_sms($acceso)
	{
		return $acceso->objeto->ejecutarSql("insert into comandos_sms(id_com,id_franq,tipo_com,nombre_com,descrip_com,status_com,sms_resp,tipo_variable,sms_error,status_error,resp_correo) values ('$this->id_com','$this->id_franq','$this->tipo_com','$this->nombre_com','$this->descrip_com','$this->status_com','$this->sms_resp','$this->tipo_variable','$this->sms_error','$this->status_error','$this->resp_correo')");			
	}
	public function modificarcomandos_sms($acceso)
	{
		//echo "Update comandos_sms Set id_franq='$this->id_franq', tipo_com='$this->tipo_com', nombre_com='$this->nombre_com', descrip_com='$this->descrip_com', status_com='$this->status_com', sms_resp='$this->sms_resp', tipo_variable='$this->tipo_variable', sms_error='$this->sms_error', status_error='$this->status_error', resp_correo='$this->resp_correo' Where id_com='$this->id_com'";
		return $acceso->objeto->ejecutarSql("Update comandos_sms Set id_franq='$this->id_franq', tipo_com='$this->tipo_com', nombre_com='$this->nombre_com', descrip_com='$this->descrip_com', status_com='$this->status_com', sms_resp='$this->sms_resp', tipo_variable='$this->tipo_variable', sms_error='$this->sms_error', status_error='$this->status_error', resp_correo='$this->resp_correo' Where id_com='$this->id_com'");	
	}
	public function guardarcomandos_sms($acceso)
	{
		return $acceso->objeto->ejecutarSql("Update comandos_sms Set status_com='$this->status_com', status_error='$this->status_error' Where id_com='$this->id_com'");	
	}
	public function eliminarcomandos_sms($acceso)
	{
		return $acceso->objeto->ejecutarSql("delete from comandos_sms where id_com='$this->id_com'");
	}
}
?>