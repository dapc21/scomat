<?php
session_start();
class envio_aut
{
	private $id_envio;
	private $id_franq;
	private $tipo_envio;
	private $nombre_envio;
	private $envio_sms;
	private $envio_email;
	private $descripcion_envio;
	private $tipo_variable;
	private $resp_correo;

	function __construct($id_envio,$id_franq,$tipo_envio,$nombre_envio,$envio_sms,$envio_email,$descripcion_envio,$tipo_variable,$resp_correo)
	{
		$this->id_envio = $id_envio;
		$this->id_franq = $id_franq;
		$this->tipo_envio = $tipo_envio;
		$this->nombre_envio = $nombre_envio;
		$this->envio_sms = $envio_sms;
		$this->envio_email = $envio_email;
		$this->descripcion_envio = $descripcion_envio;
		$this->tipo_variable = $tipo_variable;
		$this->resp_correo = str_replace ("|-and-|", "&", $resp_correo);
	}
	public function verid_envio(){
		return $this->id_envio;
	}
	public function vertipo_variable(){
		return $this->tipo_variable;
	}
	public function verdescripcion_envio(){
		return $this->descripcion_envio;
	}
	public function verenvio_email(){
		return $this->envio_email;
	}
	public function verenvio_sms(){
		return $this->envio_sms;
	}
	public function vernombre_envio(){
		return $this->nombre_envio;
	}
	public function vertipo_envio(){
		return $this->tipo_envio;
	}
	public function verid_franq(){
		return $this->id_franq;
	}

	public function validaExistencia($acceso)
	{
		//return true;
		$acceso->objeto->ejecutarSql("select * from envio_aut where id_envio='$this->id_envio'");
		if($acceso->objeto->registros>0)
			return true;
		else
			return false;
	}
	public function incluirenvio_aut($acceso)
	{
		return $acceso->objeto->ejecutarSql("insert into envio_aut(id_envio,id_franq,tipo_envio,nombre_envio,envio_sms,envio_email,descripcion_envio,tipo_variable,resp_correo) values ('$this->id_envio','$this->id_franq','$this->tipo_envio','$this->nombre_envio','$this->envio_sms','$this->envio_email','$this->descripcion_envio','$this->tipo_variable','$this->resp_correo')");			
	}
	public function modificarenvio_aut($acceso)
	{
		//ECHO "Update envio_aut Set id_franq='$this->id_franq', tipo_envio='$this->tipo_envio', nombre_envio='$this->nombre_envio', envio_sms='$this->envio_sms', envio_email='$this->envio_email', descripcion_envio='$this->descripcion_envio', tipo_variable='$this->tipo_variable', resp_correo='$this->resp_correo' Where id_envio='$this->id_envio'";
		return $acceso->objeto->ejecutarSql("Update envio_aut Set id_franq='$this->id_franq', tipo_envio='$this->tipo_envio', nombre_envio='$this->nombre_envio', envio_sms='$this->envio_sms', envio_email='$this->envio_email', descripcion_envio='$this->descripcion_envio', tipo_variable='$this->tipo_variable', resp_correo='$this->resp_correo' Where id_envio='$this->id_envio'");	
	}
	public function eliminarenvio_aut($acceso)
	{
		return $acceso->objeto->ejecutarSql("delete from envio_aut where id_envio='$this->id_envio'");
	}
	public function guardarenvio_aut($acceso)
	{
		return $acceso->objeto->ejecutarSql("Update envio_aut Set envio_sms='$this->envio_sms', envio_email='$this->envio_email' Where id_envio='$this->id_envio'");	
	}
	public function cargarenvio_aut($acceso)
	{
		require_once "procesos.php"; $ini_u = $_SESSION["ini_u"]; 
		$dato=lectura($acceso,"select *from detalle_orden order By id_tipo_orden");
		//$acceso->objeto->ejecutarSql("select *from detalle_orden order By id_tipo_orden");
		for($i=0;$i<count($dato);$i++){
			$id_det_orden=trim($dato[$i]["id_det_orden"]);
			$nombre_det_orden=trim($dato[$i]["nombre_det_orden"]);
					
			$this->id_franq = "1";
			$this->tipo_envio = "PARA CLIENTES";
			$this->envio_sms = "FALSE";
			$this->envio_email = "FALSE";
			$this->descripcion_envio = "";
			
			$acceso->objeto->ejecutarSql("select *from envio_aut  where (id_envio ILIKE '%ENV%') ORDER BY id_envio  desc LIMIT 1 offset 0 "); 
			$this->id_envio = "ENV".verCo($acceso,"id_envio");
			$this->nombre_envio = "AL GENERAR ORDEN DE ".$nombre_det_orden;
			if(strlen($this->nombre_envio)>50){
				$this->nombre_envio=substr($this->nombre_envio,0,49);
			}
			
			$acceso->objeto->ejecutarSql("select * from envio_aut where ref_envio='$id_det_orden'");
			if($acceso->objeto->registros==0)
				$acceso->objeto->ejecutarSql("insert into envio_aut(id_envio,id_franq,tipo_envio,nombre_envio,envio_sms,envio_email,descripcion_envio,ref_envio,tipo_variable) values ('$this->id_envio','$this->id_franq','$this->tipo_envio','$this->nombre_envio','$this->envio_sms','$this->envio_email','$this->descripcion_envio','$id_det_orden','ORDEN')");
			
			$acceso->objeto->ejecutarSql("select *from envio_aut  where (id_envio ILIKE '%ENV%') ORDER BY id_envio  desc LIMIT 1 offset 0 "); 
			$this->id_envio = "ENV".verCo($acceso,"id_envio");
			$this->nombre_envio = "AL FINALIZAR ORDEN DE ".$nombre_det_orden;
			if(strlen($this->nombre_envio)>50){
				$this->nombre_envio=substr($this->nombre_envio,0,49);
			}
			
			$acceso->objeto->ejecutarSql("select * from envio_aut where ref_envio='$id_det_orden'");
			if($acceso->objeto->registros==1)
				$acceso->objeto->ejecutarSql("insert into envio_aut(id_envio,id_franq,tipo_envio,nombre_envio,envio_sms,envio_email,descripcion_envio,ref_envio) values ('$this->id_envio','$this->id_franq','$this->tipo_envio','$this->nombre_envio','$this->envio_sms','$this->envio_email','$this->descripcion_envio','$id_det_orden')");
		}
		
	}
}
?>