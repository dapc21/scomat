<?php
class formato_sms
{
	private $id_form;
	private $id_franq;
	private $nombre_form;
	private $formato;
	private $status;
	private $dato;

	function __construct($id_form,$id_franq,$nombre_form,$formato,$status,$dato)
	{
		$this->id_form = $id_form;
		$this->id_franq = $id_franq;
		$this->nombre_form = $nombre_form;
		$this->formato = $formato;
		$this->status = $status;
		$this->dato = $dato;
	}
	public function verid_form(){
		return $this->id_form;
	}
	public function verdato(){
		return $this->dato;
	}
	public function verstatus(){
		return $this->status;
	}
	public function verformato(){
		return $this->formato;
	}
	public function vernombre_form(){
		return $this->nombre_form;
	}
	public function verid_franq(){
		return $this->id_franq;
	}

	public function validaExistencia($acceso)
	{
		$acceso->objeto->ejecutarSql("select * from formato_sms where id_form='$this->id_form'");
		if($acceso->objeto->registros>0)
			return true;
		else
			return false;
	}
	public function incluirformato_sms($acceso)
	{
		if(strtoupper($this->status)=="ACTIVO"){
			$acceso->objeto->ejecutarSql("Update formato_sms Set status='INACTIVO'");
		}
		return $acceso->objeto->ejecutarSql("insert into formato_sms(id_form,id_franq,nombre_form,formato,status) values ('$this->id_form','$this->id_franq','$this->nombre_form','$this->formato','$this->status')");			
	}
	public function modificarformato_sms($acceso)
	{
		//ECHO strtoupper($this->status);
		if(strtoupper($this->status)=="ACTIVO"){
			$acceso->objeto->ejecutarSql("Update formato_sms Set status='INACTIVO'");
		}
		return $acceso->objeto->ejecutarSql("Update formato_sms Set id_franq='$this->id_franq', nombre_form='$this->nombre_form', formato='$this->formato', status='$this->status' Where id_form='$this->id_form'");	
	}
	public function eliminarformato_sms($acceso)
	{
		
		return $acceso->objeto->ejecutarSql("delete from formato_sms where id_form='$this->id_form'");
	}
}
?>