<?php
class CASSTBBean
{
	private $stbTypeId;
	private $stbManufacturerId;
	private $broadcasterId;
	private $serialNumber;
	private $barcode;
	private $inMaster;
	private $stbMasterTypeId;
	private $stbMasterManufacturerId;
	private $serialNumberMaster;
	private $dato;

	function __construct($stbTypeId,$stbManufacturerId,$broadcasterId,$serialNumber,$barcode,$inMaster,$stbMasterTypeId,$stbMasterManufacturerId,$serialNumberMaster,$dato)
	{
		$this->stbTypeId = $stbTypeId;
		$this->stbManufacturerId = $stbManufacturerId;
		$this->broadcasterId = $broadcasterId;
		$this->serialNumber = $serialNumber;
		$this->barcode = $barcode;
		$this->inMaster = $inMaster;
		$this->stbMasterTypeId = $stbMasterTypeId;
		$this->stbMasterManufacturerId = $stbMasterManufacturerId;
		$this->serialNumberMaster = $serialNumberMaster;
		$this->dato = $dato;
	}
	public function verstbTypeId(){
		return $this->stbTypeId;
	}
	public function verdato(){
		return $this->dato;
	}
	public function verserialNumberMaster(){
		return $this->serialNumberMaster;
	}
	public function verstbMasterManufacturerId(){
		return $this->stbMasterManufacturerId;
	}
	public function verstbMasterTypeId(){
		return $this->stbMasterTypeId;
	}
	public function verinMaster(){
		return $this->inMaster;
	}
	public function verbarcode(){
		return $this->barcode;
	}
	public function verserialNumber(){
		return $this->serialNumber;
	}
	public function verbroadcasterId(){
		return $this->broadcasterId;
	}
	public function verstbManufacturerId(){
		return $this->stbManufacturerId;
	}

	public function validaExistencia($acceso)
	{
		$acceso->objeto->ejecutarSql("select * from CASSTBBean where stbTypeId='$this->stbTypeId'");
		if($acceso->objeto->registros>0)
			return true;
		else
			return false;
	}
	public function incluirCASSTBBean($acceso)
	{
		return $acceso->objeto->ejecutarSql("insert into CASSTBBean(stbTypeId,stbManufacturerId,broadcasterId,serialNumber,barcode,inMaster,stbMasterTypeId,stbMasterManufacturerId,serialNumberMaster) values ('$this->stbTypeId','$this->stbManufacturerId','$this->broadcasterId','$this->serialNumber','$this->barcode','$this->inMaster','$this->stbMasterTypeId','$this->stbMasterManufacturerId','$this->serialNumberMaster')");			
	}
	public function modificarCASSTBBean($acceso)
	{
		return $acceso->objeto->ejecutarSql("Update CASSTBBean Set stbManufacturerId='$this->stbManufacturerId', broadcasterId='$this->broadcasterId', serialNumber='$this->serialNumber', barcode='$this->barcode', inMaster='$this->inMaster', stbMasterTypeId='$this->stbMasterTypeId', stbMasterManufacturerId='$this->stbMasterManufacturerId', serialNumberMaster='$this->serialNumberMaster' Where stbTypeId='$this->stbTypeId'");	
	}
	public function eliminarCASSTBBean($acceso)
	{
		return $acceso->objeto->ejecutarSql("delete from CASSTBBean where stbTypeId='$this->stbTypeId'");
	}
}
?>