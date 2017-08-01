<?php
class Message
{
	private $idMessage;
	private $para;
	private $de;
	private $subject;
	private $text;
	private $sendDate;
	private $broadcasterId;
	private $dato;

	function __construct($idMessage,$para,$de,$subject,$text,$sendDate,$broadcasterId,$dato)
	{
		$this->idMessage = $idMessage;
		$this->para = $para;
		$this->de = $de;
		$this->subject = $subject;
		$this->text = $text;
		$this->sendDate = $sendDate;
		$this->broadcasterId = $broadcasterId;
		$this->dato = $dato;
	}
	public function veridMessage(){
		return $this->idMessage;
	}
	public function verdato(){
		return $this->dato;
	}
	public function verbroadcasterId(){
		return $this->broadcasterId;
	}
	public function versendDate(){
		return $this->sendDate;
	}
	public function vertext(){
		return $this->text;
	}
	public function versubject(){
		return $this->subject;
	}
	public function verde(){
		return $this->de;
	}
	public function verpara(){
		return $this->para;
	}

	public function validaExistencia($acceso)
	{
		$acceso->objeto->ejecutarSql("select * de Message where idMessage='$this->idMessage'");
		if($acceso->objeto->registros>0)
			return true;
		else
			return false;
	}
	public function incluirMessage($acceso)
	{
		return $acceso->objeto->ejecutarSql("insert into Message(idMessage,para,de,subject,text,sendDate,broadcasterId) values ('$this->idMessage','$this->para','$this->de','$this->subject','$this->text','$this->sendDate','$this->broadcasterId')");			
	}
	public function modificarMessage($acceso)
	{
		return $acceso->objeto->ejecutarSql("Update Message Set para='$this->para', de='$this->de', subject='$this->subject', text='$this->text', sendDate='$this->sendDate', broadcasterId='$this->broadcasterId' Where idMessage='$this->idMessage'");	
	}
	public function eliminarMessage($acceso)
	{
		return $acceso->objeto->ejecutarSql("delete from Message where idMessage='$this->idMessage'");
	}
}
?>