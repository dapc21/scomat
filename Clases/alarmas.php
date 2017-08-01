<?php
class alarmas
{
	private $id_accquery;
	private $serial_deco;
	private $comando_acc;
	private $fecha_accquery;
	private $status_accquery;
	private $ref_alarma;
	private $status_alarma;
	private $dato;

	function __construct($id_accquery,$serial_deco,$comando_acc,$fecha_accquery,$status_accquery,$ref_alarma='',$status_alarma='',$dato='')
	{
		$this->id_accquery = $id_accquery;
		$this->serial_deco = $serial_deco;
		$this->comando_acc = $comando_acc;
		$this->fecha_accquery = $fecha_accquery;
		$this->status_accquery = $status_accquery;
		$this->ref_alarma = $ref_alarma;
		$this->status_alarma = $status_alarma;
		$this->dato = $dato;
	}
	public function verid_accquery(){
		return $this->id_accquery;
	}
	public function verdato(){
		return $this->dato;
	}
	public function verstatus_alarma(){
		return $this->status_alarma;
	}
	public function verref_alarma(){
		return $this->ref_alarma;
	}
	public function verstatus_accquery(){
		return $this->status_accquery;
	}
	public function verfecha_accquery(){
		return $this->fecha_accquery;
	}
	public function vercomando_acc(){
		return $this->comando_acc;
	}
	public function verserial_deco(){
		return $this->serial_deco;
	}

	public function validaExistencia($acceso)
	{
		$acceso->objeto->ejecutarSql("select * from interfazacc where id_accquery='$this->id_accquery'");
		if($acceso->objeto->registros>0)
			return true;
		else
			return false;
	}
	public function incluiralarmas($acceso)
	{
		//ECHO "insert into interfazacc(id_accquery,serial_deco,comando_acc,fecha_accquery,status_accquery) values ('$this->id_accquery','$this->serial_deco','$this->comando_acc',now(),'$this->status_accquery')";
		return $acceso->objeto->ejecutarSql("insert into interfazacc(id_accquery,serial_deco,comando_acc,fecha_accquery,status_accquery) values ('$this->id_accquery','$this->serial_deco','$this->comando_acc',now(),'$this->status_accquery')");			
	}
	public function modificaralarmas($acceso)
	{
		return $acceso->objeto->ejecutarSql("Update interfazacc Set serial_deco='$this->serial_deco', comando_acc='$this->comando_acc', fecha_accquery=now(), status_accquery='$this->status_accquery' Where id_accquery='$this->id_accquery'");	
	}
	public function eliminaralarmas($acceso)
	{
		return $acceso->objeto->ejecutarSql("delete from interfazacc where id_accquery='$this->id_accquery'");
	}
}
?>