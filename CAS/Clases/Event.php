<?php
class Event
{
	private $eventId;
	private $title;
	private $broadcastBegin;
	private $broadcastEnd;
	private $channelId;
	private $genreId;
	private $subgenreId;
	private $parentalType;
	private $previewType;
	private $previewDuration;
	private $inScrambled;
	private $dato;

	function __construct($eventId,$title,$broadcastBegin,$broadcastEnd,$channelId,$genreId,$subgenreId,$parentalType,$previewType,$previewDuration,$inScrambled,$dato)
	{
		$this->eventId = $eventId;
		$this->title = $title;
		$this->broadcastBegin = $broadcastBegin;
		$this->broadcastEnd = $broadcastEnd;
		$this->channelId = $channelId;
		$this->genreId = $genreId;
		$this->subgenreId = $subgenreId;
		$this->parentalType = $parentalType;
		$this->previewType = $previewType;
		$this->previewDuration = $previewDuration;
		$this->inScrambled = $inScrambled;
		$this->dato = $dato;
	}
	public function vereventId(){
		return $this->eventId;
	}
	public function verdato(){
		return $this->dato;
	}
	public function verinScrambled(){
		return $this->inScrambled;
	}
	public function verpreviewDuration(){
		return $this->previewDuration;
	}
	public function verpreviewType(){
		return $this->previewType;
	}
	public function verparentalType(){
		return $this->parentalType;
	}
	public function versubgenreId(){
		return $this->subgenreId;
	}
	public function vergenreId(){
		return $this->genreId;
	}
	public function verchannelId(){
		return $this->channelId;
	}
	public function verbroadcastEnd(){
		return $this->broadcastEnd;
	}
	public function verbroadcastBegin(){
		return $this->broadcastBegin;
	}
	public function vertitle(){
		return $this->title;
	}

	public function validaExistencia($acceso)
	{
		$acceso->objeto->ejecutarSql("select * from Event where eventId='$this->eventId'");
		if($acceso->objeto->registros>0)
			return true;
		else
			return false;
	}
	public function incluirEvent($acceso)
	{
		return $acceso->objeto->ejecutarSql("insert into Event(eventId,title,broadcastBegin,broadcastEnd,channelId,genreId,subgenreId,parentalType,previewType,previewDuration,inScrambled) values ('$this->eventId','$this->title','$this->broadcastBegin','$this->broadcastEnd','$this->channelId','$this->genreId','$this->subgenreId','$this->parentalType','$this->previewType','$this->previewDuration','$this->inScrambled')");			
	}
	public function modificarEvent($acceso)
	{
		return $acceso->objeto->ejecutarSql("Update Event Set title='$this->title', broadcastBegin='$this->broadcastBegin', broadcastEnd='$this->broadcastEnd', channelId='$this->channelId', genreId='$this->genreId', subgenreId='$this->subgenreId', parentalType='$this->parentalType', previewType='$this->previewType', previewDuration='$this->previewDuration', inScrambled='$this->inScrambled' Where eventId='$this->eventId'");	
	}
	public function eliminarEvent($acceso)
	{
		return $acceso->objeto->ejecutarSql("delete from Event where eventId='$this->eventId'");
	}
}
?>