<?php
session_start();
class interfaz_cablemodem
{
	private $id_accquery;
	private $serial_deco;
	private $comando_acc;
	private $status_accquery;
	private $fecha_accquery;
	private $dato;

	function __construct($id_accquery,$serial_deco,$comando_acc,$status_accquery='FALSE',$fecha_accquery='',$dato='')
	{
		$this->id_accquery = $id_accquery;
		$this->serial_deco = $serial_deco;
		$this->comando_acc = $comando_acc;
		$this->status_accquery = $status_accquery;
		$this->fecha_accquery = date("Y-m-d");
		$this->dato = $dato;
	}
	public function verid_accquery(){
		return $this->id_accquery;
	}
	public function verdato(){
		return $this->dato;
	}
	public function verfecha_accquery(){
		return $this->fecha_accquery;
	}
	public function verstatus_accquery(){
		return $this->status_accquery;
	}
	public function vercomando_acc(){
		return $this->comando_acc;
	}
	public function verserial_deco(){
		return $this->serial_deco;
	}
	public function validaExistencia($acceso)
	{
		$acceso->objeto->ejecutarSql("select * from interfaz_cablemodem where id_accquery='$this->id_accquery'");
		if($acceso->objeto->registros>0)
			return true;
		else
			return false;
	}
	public function incluirinterfaz_cablemodem($acceso)
	{
		$fecha = date("Y-m-d");
		$login= $_SESSION["login"];
		$hora=date("H:i:s");
	//	echo "insert into interfaz_cablemodem(id_accquery,serial_deco,comando_acc,status_accquery,fecha_accquery,login,fecha,hora) values ('$this->id_accquery','$this->serial_deco','$this->comando_acc','$this->status_accquery','$this->fecha_accquery','$login','$fecha','$hora')";
		$acceso->objeto->ejecutarSql("insert into interfaz_cablemodem(id_accquery,serial_deco,comando_acc,status_accquery,fecha_accquery,login,fecha,hora) values ('$this->id_accquery','$this->serial_deco','$this->comando_acc','$this->status_accquery','$this->fecha_accquery','$login','$fecha','$hora')");	
	//	$this->enviar_comando_interfaz($acceso);
	}
	public function modificarinterfaz_cablemodem($acceso)
	{
		$acceso->objeto->ejecutarSql("Update interfaz_cablemodem Set serial_deco='$this->serial_deco', comando_acc='$this->comando_acc', status_accquery='$this->status_accquery', fecha_accquery='$this->fecha_accquery' Where id_accquery='$this->id_accquery'");	
		
	}
	public function eliminarinterfaz_cablemodem($acceso)
	{
		return $acceso->objeto->ejecutarSql("delete from interfaz_cablemodem where id_accquery='$this->id_accquery'");
	}
	public function enviar_comando_interfaz($acceso)
	{
		//echo "entro a enviar comando: ";
		if($this->comando_acc=='ACTV'){
			$metodo = "activar";
		}else if($this->comando_acc=='DESC'){
			$metodo = "desconectar";
		}
		$autoriza = 'ADMIN';
		
		$mac = $this->serial_deco;
		$contrato="";
		$nodo="";
		$plan="";
		//$estado="ACTV";
		$estado="DESC";
		$dato_cliente="";
		$server="";
		$securelevel="";
		$firma = "";
		
		if($this->comando_acc!=''){
			$resp = $this->enviarcomandocm($autoriza,$firma,$metodo,$mac,$contrato,$nodo,$plan,$estado,$dato_cliente,$server,$securelevel);
			echo $resp;
		}
	}
	
	function enviarcomandocm($autoriza,$firma,$metodo,$mac,$contrato,$nodo,$plan,$estado,$dato_cliente,$server,$securelevel){
		//set_time_limit(5);
	//	echo ":entro a enviarcomandocm: d";
		require_once("encriptacion.php");
		//echo "\n:$metodo:";
		$obj=new encriptacion();
		//echo "\n:$metodo:";
		$autoriza=$obj->zend_enc($autoriza);
		$metodo=$obj->zend_enc($metodo);
		$mac=$obj->zend_enc($mac);
		$contrato=$obj->zend_enc($contrato);
		$nodo=$obj->zend_enc($nodo);
		$plan=$obj->zend_enc($plan);
		$estado=$obj->zend_enc($estado);
		$dato_cliente=$obj->zend_enc($dato_cliente);
		$server=$obj->zend_enc($server);
		$securelevel=$obj->zend_enc($securelevel);
		$firma=$obj->zend_enc($firma);

		$ch = curl_init();
		if($ch){
		//	echo ":entro a enviarcomandocm: http://172.17.1.2/interface_modem/interfazcm.php?autoriza=$autoriza&firma=$firma&metodo=$metodo&mac=$mac&contrato=$contrato&nodo=$nodo&plan=$plan&estado=$estado&dato_cliente=$dato_cliente&server=$server&securelevel=$securelevel";
				curl_setopt($ch, CURLOPT_URL, "http://172.17.1.2/interface_modem/interfazcm.php?autoriza=$autoriza&firma=$firma&metodo=$metodo&mac=$mac&contrato=$contrato&nodo=$nodo&plan=$plan&estado=$estado&dato_cliente=$dato_cliente&server=$server&securelevel=$securelevel");	
				curl_setopt($ch, CURLOPT_TIMEOUT,5);
				curl_setopt($ch, CURLOPT_RETURNTRANSFER,TRUE);
				curl_setopt($ch, CURLOPT_HEADER, 0);

				$resultado = curl_exec($ch);
				curl_close($ch);
				return $resultado;
				
		}
		else{
			return "<br>error al crear Curl_init";
		}
	}
}
?>