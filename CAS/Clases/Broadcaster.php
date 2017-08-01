<?php
class Broadcaster
{
	private $broadcasterId;
	private $broadcasterDs;
	private $dato;

	function __construct($broadcasterId,$broadcasterDs,$dato)
	{
		$this->broadcasterId = $broadcasterId;
		$this->broadcasterDs = $broadcasterDs;
		$this->dato = $dato;
	}
	public function verbroadcasterId(){
		return $this->broadcasterId;
	}
	public function verdato(){
		return $this->dato;
	}
	public function verbroadcasterDs(){
		return $this->broadcasterDs;
	}

	public function validaExistencia($acceso)
	{
		$acceso->objeto->ejecutarSql("select * from Broadcaster where broadcasterId='$this->broadcasterId'");
		if($acceso->objeto->registros>0)
			return true;
		else
			return false;
	}
	public function incluirBroadcaster($acceso)
	{
		return $acceso->objeto->ejecutarSql("insert into Broadcaster(broadcasterId,broadcasterDs) values ('$this->broadcasterId','$this->broadcasterDs')");			
	}
	public function modificarBroadcaster($acceso)
	{
		return $acceso->objeto->ejecutarSql("Update Broadcaster Set broadcasterDs='$this->broadcasterDs' Where broadcasterId='$this->broadcasterId'");	
	}
	public function eliminarBroadcaster($acceso)
	{
		return $acceso->objeto->ejecutarSql("delete from Broadcaster where broadcasterId='$this->broadcasterId'");
	}
}
?>