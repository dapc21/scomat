<?php
class Channel
{
	private $channelId;
	private $channelDs;
	private $broadcasterId;
	private $parentalType;
	private $inExportable;
	private $inFreeAccess;
	private $tipoCanal;

	function __construct($channelId,$channelDs,$broadcasterId,$parentalType,$inExportable,$inFreeAccess,$tipoCanal)
	{
		$this->channelId = $channelId;
		$this->channelDs = $channelDs;
		$this->broadcasterId = $broadcasterId;
		$this->parentalType = $parentalType;
		$this->inExportable = $inExportable;
		$this->inFreeAccess = $inFreeAccess;
		$this->tipoCanal = $tipoCanal;
	}
	public function verchannelId(){
		return $this->channelId;
	}
	public function vertipoCanal(){
		return $this->tipoCanal;
	}
	public function verinFreeAccess(){
		return $this->inFreeAccess;
	}
	public function verinExportable(){
		return $this->inExportable;
	}
	public function verparentalType(){
		return $this->parentalType;
	}
	public function verbroadcasterId(){
		return $this->broadcasterId;
	}
	public function verchannelDs(){
		return $this->channelDs;
	}
	public function validaExistencia($acceso)
	{
		$acceso->objeto->ejecutarSql("select * from Channel where channelId='$this->channelId'");
		if($acceso->objeto->registros>0)
			return true;
		else
			return false;
	}
	public function incluirChannel($acceso)
	{
		return $acceso->objeto->ejecutarSql("insert into Channel(channelId,channelDs,broadcasterId,parentalType,inExportable,inFreeAccess,tipoCanal) values ('$this->channelId','$this->channelDs','$this->broadcasterId','$this->parentalType','$this->inExportable','$this->inFreeAccess','$this->tipoCanal')");			
	}
	public function modificarChannel($acceso)
	{
		return $acceso->objeto->ejecutarSql("Update Channel Set channelDs='$this->channelDs', broadcasterId='$this->broadcasterId', parentalType='$this->parentalType', inExportable='$this->inExportable', inFreeAccess='$this->inFreeAccess', tipoCanal='$this->tipoCanal' Where channelId='$this->channelId'");
	}
	public function eliminarChannel($acceso)
	{
		return $acceso->objeto->ejecutarSql("delete from Channel where channelId='$this->channelId'");
	}
}
?>