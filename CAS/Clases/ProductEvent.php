<?php
class ProductEvent
{
	private $eventId;
	private $productId;
	private $dato;

	function __construct($eventId,$productId,$dato)
	{
		$this->eventId = $eventId;
		$this->productId = $productId;
		$this->dato = $dato;
	}
	public function vereventId(){
		return $this->eventId;
	}
	public function verdato(){
		return $this->dato;
	}
	public function verproductId(){
		return $this->productId;
	}

	public function validaExistencia($acceso)
	{
		$acceso->objeto->ejecutarSql("select * from ProductEvent where eventId='$this->eventId' and productId='$this->productId'");
		if($acceso->objeto->registros>0)
			return true;
		else
			return false;
	}
	public function incluirProductEvent($acceso)
	{
		return $acceso->objeto->ejecutarSql("insert into ProductEvent(eventId,productId) values ('$this->eventId','$this->productId')");			
	}
	public function modificarProductEvent($acceso)
	{
		return $acceso->objeto->ejecutarSql("Update ProductEvent Set productId='$this->productId' Where eventId='$this->eventId'");	
	}
	public function eliminarProductEvent($acceso)
	{
		return $acceso->objeto->ejecutarSql("delete from ProductEvent where eventId='$this->eventId' and productId='$this->productId'");
	}
}
?>