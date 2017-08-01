<?php
class CASTimeRangeBean
{
	private $idCASTimeRangeBean;
	private $subscriptionId;
	private $day;
	private $broadcastTimeBegin;
	private $broadcastTimeEnd;
	private $dato;

	function __construct($idCASTimeRangeBean,$subscriptionId,$day,$broadcastTimeBegin,$broadcastTimeEnd,$dato)
	{
		$this->idCASTimeRangeBean = $idCASTimeRangeBean;
		$this->subscriptionId = $subscriptionId;
		$this->day = $day;
		$this->broadcastTimeBegin = $broadcastTimeBegin;
		$this->broadcastTimeEnd = $broadcastTimeEnd;
		$this->dato = $dato;
	}
	public function veridCASTimeRangeBean(){
		return $this->idCASTimeRangeBean;
	}
	public function verdato(){
		return $this->dato;
	}
	public function verbroadcastTimeEnd(){
		return $this->broadcastTimeEnd;
	}
	public function verbroadcastTimeBegin(){
		return $this->broadcastTimeBegin;
	}
	public function verday(){
		return $this->day;
	}
	public function versubscriptionId(){
		return $this->subscriptionId;
	}

	public function validaExistencia($acceso)
	{
		$acceso->objeto->ejecutarSql("select * from CASTimeRangeBean where idCASTimeRangeBean='$this->idCASTimeRangeBean'");
		if($acceso->objeto->registros>0)
			return true;
		else
			return false;
	}
	public function incluirCASTimeRangeBean($acceso)
	{
		return $acceso->objeto->ejecutarSql("insert into CASTimeRangeBean(idCASTimeRangeBean,subscriptionId,day,broadcastTimeBegin,broadcastTimeEnd) values ('$this->idCASTimeRangeBean','$this->subscriptionId','$this->day','$this->broadcastTimeBegin','$this->broadcastTimeEnd')");			
	}
	public function modificarCASTimeRangeBean($acceso)
	{
		return $acceso->objeto->ejecutarSql("Update CASTimeRangeBean Set subscriptionId='$this->subscriptionId', day='$this->day', broadcastTimeBegin='$this->broadcastTimeBegin', broadcastTimeEnd='$this->broadcastTimeEnd' Where idCASTimeRangeBean='$this->idCASTimeRangeBean'");	
	}
	public function eliminarCASTimeRangeBean($acceso)
	{
		return $acceso->objeto->ejecutarSql("delete from CASTimeRangeBean where idCASTimeRangeBean='$this->idCASTimeRangeBean'");
	}
}
?>