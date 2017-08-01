<?php
class Smartcard
{
	private $SMCid;
	private $broadcasterId;
	private $total;
	private $statusId;
	private $nmIPPVbalance;
	private $statusDate;
	private $dato;

	function __construct($SMCid,$broadcasterId,$total,$statusId,$nmIPPVbalance,$statusDate,$dato)
	{
		$this->SMCid = $SMCid;
		$this->broadcasterId = $broadcasterId;
		$this->total = $total+0;
		$this->statusId = $statusId;
		$this->nmIPPVbalance = $nmIPPVbalance;
		$this->statusDate = $statusDate;
		$this->dato = $dato;
	}
	public function verSMCid(){
		return $this->SMCid;
	}
	public function verdato(){
		return $this->dato;
	}
	public function verstatusDate(){
		return $this->statusDate;
	}
	public function vernmIPPVbalance(){
		return $this->nmIPPVbalance;
	}
	public function verstatusId(){
		return $this->statusId;
	}
	public function vertotal(){
		return $this->total;
	}
	public function verbroadcasterId(){
		return $this->broadcasterId;
	}

	public function validaExistencia($acceso)
	{
		//echo "select * from Smartcard where SMCid='$this->SMCid'";
		$acceso->objeto->ejecutarSql("select * from Smartcard where SMCid='$this->SMCid'");
		if($acceso->objeto->registros>0)
			return true;
		else
			return false;
	}
	public function incluirSmartcard($acceso)
	{
		$this->SMCid=verCodTarjeta($acceso,$this->SMCid);
		for($i=0; $i<$this->total;$i++){
			$acceso->objeto->ejecutarSql("insert into Smartcard(SMCid,broadcasterId,total,statusId,nmIPPVbalance,statusDate) values ('$this->SMCid','$this->broadcasterId','$this->total','$this->statusId','$this->nmIPPVbalance','$this->statusDate')");
			$this->SMCid++;
			$this->SMCid=verCodTarjeta($acceso,$this->SMCid);
		}
	}
	public function modificarSmartcard($acceso)
	{
		return $acceso->objeto->ejecutarSql("Update Smartcard Set broadcasterId='$this->broadcasterId', total='$this->total', statusId='$this->statusId', nmIPPVbalance='$this->nmIPPVbalance', statusDate='$this->statusDate' Where SMCid='$this->SMCid'");	
	}
	public function decreaseIPPVbalanceSmartcard($acceso)
	{
		return $acceso->objeto->ejecutarSql("Update Smartcard Set  nmIPPVbalance=nmIPPVbalance - $this->nmIPPVbalance Where SMCid='$this->SMCid'");	
	}
	public function increaseIPPVbalanceSmartcard($acceso)
	{
		return $acceso->objeto->ejecutarSql("Update Smartcard Set  nmIPPVbalance=nmIPPVbalance + $this->nmIPPVbalance Where SMCid='$this->SMCid'");	
	}
	public function activateSMCSmartcard($acceso)
	{
		return $acceso->objeto->ejecutarSql("Update Smartcard Set statusId='$this->statusId' Where SMCid='$this->SMCid'");	
	}
	public function eliminarSmartcard($acceso)
	{
		return $acceso->objeto->ejecutarSql("delete from Smartcard where SMCid='$this->SMCid'");
	}
}


function verCodTarjeta($acceso,$val){
	$cont=$val;
		
		if($cont<10)
			$cont="0".$cont;
		if($cont<100)
			$cont="0".$cont;	
		if($cont<1000)
			$cont="0".$cont;
		if($cont<10000)
			$cont="0".$cont;
		if($cont<100000)
			$cont="0".$cont;
		if($cont<1000000)
			$cont="0".$cont;
		if($cont<100000000)
			$cont="0".$cont;
		if($cont<1000000000)
			$cont="0".$cont;
		if($cont<1000000000)
			$cont="0".$cont;
		if($cont<10000000000)
			$cont="0".$cont;
		if($cont<100000000000)
			$cont="0".$cont;
	return $cont;	
}
?>