<?php
class SubscriptionChannel
{
	private $subscriptionId;
	private $channelId;
	private $dato;

	function __construct($subscriptionId,$channelId,$dato)
	{
		$this->subscriptionId = $subscriptionId;
		$this->channelId = $channelId;
		$this->dato = $dato;
	}
	public function versubscriptionId(){
		return $this->subscriptionId;
	}
	public function verdato(){
		return $this->dato;
	}
	public function verchannelId(){
		return $this->channelId;
	}

	public function validaExistencia($acceso)
	{
		$acceso->objeto->ejecutarSql("select * from SubscriptionChannel where subscriptionId='$this->subscriptionId' and channelId='$this->channelId'");
		if($acceso->objeto->registros>0)
			return true;
		else
			return false;
	}
	public function incluirSubscriptionChannel($acceso)
	{
		return $acceso->objeto->ejecutarSql("insert into SubscriptionChannel(subscriptionId,channelId) values ('$this->subscriptionId','$this->channelId')");			
	}
	public function eliminarSubscriptionChannel($acceso)
	{
		return $acceso->objeto->ejecutarSql("delete from SubscriptionChannel where subscriptionId='$this->subscriptionId' and channelId='$this->channelId'");
	}
}
?>