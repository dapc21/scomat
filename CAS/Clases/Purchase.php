<?php
class Purchase
{
	private $idPurchase;
	private $operationType;
	private $productId;
	private $subscriptionId;
	private $SMCid;
	private $statusId;
	private $statusDate;
	private $dato;

	function __construct($idPurchase,$operationType,$productId,$subscriptionId,$SMCid,$statusId,$statusDate,$dato)
	{
		$this->idPurchase = $idPurchase;
		$this->operationType = $operationType;
		$this->productId = $productId;
		$this->subscriptionId = $subscriptionId;
		$this->SMCid = $SMCid;
		$this->statusId = $statusId;
		$this->statusDate = $statusDate;
		$this->dato = $dato;
	}
	public function veridPurchase(){
		return $this->idPurchase;
	}
	public function verdato(){
		return $this->dato;
	}
	public function verstatusDate(){
		return $this->statusDate;
	}
	public function verstatusId(){
		return $this->statusId;
	}
	public function verSMCid(){
		return $this->SMCid;
	}
	public function versubscriptionId(){
		return $this->subscriptionId;
	}
	public function verproductId(){
		return $this->productId;
	}
	public function veroperationType(){
		return $this->operationType;
	}

	public function validaExistencia($acceso)
	{
		$acceso->objeto->ejecutarSql("select * from Purchase where idPurchase='$this->idPurchase'");
		if($acceso->objeto->registros>0)
			return true;
		else
			return false;
	}
	public function incluirPurchase($acceso)
	{
		
		
		return $acceso->objeto->ejecutarSql("insert into Purchase(idPurchase,productId,subscriptionId,SMCid,statusId,statusDate) values ('$this->idPurchase','$this->productId','$this->subscriptionId','$this->SMCid','$this->statusId','$this->statusDate')");			
	}
	public function modificarPurchase($acceso)
	{
		return $acceso->objeto->ejecutarSql("Update Purchase Set  productId='$this->productId', subscriptionId='$this->subscriptionId', SMCid='$this->SMCid', statusId='$this->statusId', statusDate='$this->statusDate' Where idPurchase='$this->idPurchase'");	
	}
	public function eliminarPurchase($acceso)
	{
		return $acceso->objeto->ejecutarSql("delete from Purchase where idPurchase='$this->idPurchase'");
	}
}
?>