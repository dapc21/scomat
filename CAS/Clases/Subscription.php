<?php
class Subscription
{
	private $subscriptionId;
	private $subscriptionDs;
	private $channelId;
	private $purchaseDateBegin;
	private $purchaseDateEnd;
	private $price;
	private $ippv;
	private $dato;

	function __construct($subscriptionId,$subscriptionDs,$channelId,$purchaseDateBegin,$purchaseDateEnd,$price,$ippv,$dato)
	{
		$this->subscriptionId = $subscriptionId;
		$this->subscriptionDs = $subscriptionDs;
		$this->channelId = $channelId;
		$this->purchaseDateBegin = $purchaseDateBegin;
		$this->purchaseDateEnd = $purchaseDateEnd;
		$this->price = $price;
		$this->ippv = $ippv;
		$this->dato = $dato;
	}
	public function versubscriptionId(){
		return $this->subscriptionId;
	}
	public function verdato(){
		return $this->dato;
	}
	public function verippv(){
		return $this->ippv;
	}
	public function verprice(){
		return $this->price;
	}
	public function verpurchaseDateEnd(){
		return $this->purchaseDateEnd;
	}
	public function verpurchaseDateBegin(){
		return $this->purchaseDateBegin;
	}
	public function verchannelId(){
		return $this->channelId;
	}
	public function versubscriptionDs(){
		return $this->subscriptionDs;
	}

	public function validaExistencia($acceso)
	{
		$acceso->objeto->ejecutarSql("select * from Subscription where subscriptionId='$this->subscriptionId'");
		if($acceso->objeto->registros>0)
			return true;
		else
			return false;
	}
	public function incluirSubscription($acceso)
	{
		$acceso->objeto->ejecutarSql("insert into Subscription(subscriptionId,subscriptionDs,channelId,purchaseDateBegin,purchaseDateEnd,price,ippv) values ('$this->subscriptionId','$this->subscriptionDs','$this->channelId','$this->purchaseDateBegin','$this->purchaseDateEnd','$this->price','$this->ippv')");			
		$acceso->objeto->ejecutarSql("insert into SubscriptionChannel(subscriptionId,channelId) values ('$this->subscriptionId','$this->channelId')");
	}
	public function modificarSubscription($acceso)
	{
		return $acceso->objeto->ejecutarSql("Update Subscription Set subscriptionDs='$this->subscriptionDs', channelId='$this->channelId', purchaseDateBegin='$this->purchaseDateBegin', purchaseDateEnd='$this->purchaseDateEnd', price='$this->price', ippv='$this->ippv' Where subscriptionId='$this->subscriptionId'");	
	}
	public function eliminarSubscription($acceso)
	{
		return $acceso->objeto->ejecutarSql("delete from Subscription where subscriptionId='$this->subscriptionId'");
	}
}
?>