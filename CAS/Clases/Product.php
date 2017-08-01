<?php
class Product
{
	private $productId;
	private $productDs;
	private $broadcasterId;
	private $validityDateBegin;
	private $validityDateEnd;
	private $purchaseDateBegin;
	private $purchaseDateEnd;
	private $genreId;
	private $subgenreId;
	private $price;
	private $maxEvents;
	private $ippv;
	private $dato;

	function __construct($productId,$productDs,$broadcasterId,$validityDateBegin,$validityDateEnd,$purchaseDateBegin,$purchaseDateEnd,$genreId,$subgenreId,$price,$maxEvents,$ippv,$dato)
	{
		$this->productId = $productId;
		$this->productDs = $productDs;
		$this->broadcasterId = $broadcasterId;
		$this->validityDateBegin = $validityDateBegin;
		$this->validityDateEnd = $validityDateEnd;
		$this->purchaseDateBegin = $purchaseDateBegin;
		$this->purchaseDateEnd = $purchaseDateEnd;
		$this->genreId = $genreId;
		$this->subgenreId = $subgenreId;
		$this->price = $price;
		$this->maxEvents = $maxEvents;
		$this->ippv = $ippv;
		$this->dato = $dato;
	}
	public function verproductId(){
		return $this->productId;
	}
	public function verdato(){
		return $this->dato;
	}
	public function verippv(){
		return $this->ippv;
	}
	public function vermaxEvents(){
		return $this->maxEvents;
	}
	public function verprice(){
		return $this->price;
	}
	public function versubgenreId(){
		return $this->subgenreId;
	}
	public function vergenreId(){
		return $this->genreId;
	}
	public function verpurchaseDateEnd(){
		return $this->purchaseDateEnd;
	}
	public function verpurchaseDateBegin(){
		return $this->purchaseDateBegin;
	}
	public function vervalidityDateEnd(){
		return $this->validityDateEnd;
	}
	public function vervalidityDateBegin(){
		return $this->validityDateBegin;
	}
	public function verbroadcasterId(){
		return $this->broadcasterId;
	}
	public function verproductDs(){
		return $this->productDs;
	}

	public function validaExistencia($acceso)
	{
		$acceso->objeto->ejecutarSql("select * from Product where productId='$this->productId'");
		if($acceso->objeto->registros>0)
			return true;
		else
			return false;
	}
	public function incluirProduct($acceso)
	{
		return $acceso->objeto->ejecutarSql("insert into Product(productId,productDs,broadcasterId,validityDateBegin,validityDateEnd,purchaseDateBegin,purchaseDateEnd,genreId,subgenreId,price,maxEvents,ippv) values ('$this->productId','$this->productDs','$this->broadcasterId','$this->validityDateBegin','$this->validityDateEnd','$this->purchaseDateBegin','$this->purchaseDateEnd','$this->genreId','$this->subgenreId','$this->price','$this->maxEvents','$this->ippv')");			
	}
	public function modificarProduct($acceso)
	{
		return $acceso->objeto->ejecutarSql("Update Product Set productDs='$this->productDs', broadcasterId='$this->broadcasterId', validityDateBegin='$this->validityDateBegin', validityDateEnd='$this->validityDateEnd', purchaseDateBegin='$this->purchaseDateBegin', purchaseDateEnd='$this->purchaseDateEnd', genreId='$this->genreId', subgenreId='$this->subgenreId', price='$this->price', maxEvents='$this->maxEvents', ippv='$this->ippv' Where productId='$this->productId'");	
	}
	public function eliminarProduct($acceso)
	{
		return $acceso->objeto->ejecutarSql("delete from Product where productId='$this->productId'");
	}
}
?>