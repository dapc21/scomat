<?php
class variables_sms
{
	private $id_var;
	private $variable;
	private $tipo_var;
	private $descrip_var;
	private $status_var;
	private $id_franq;
	private $dato;

	function __construct($id_var,$variable,$tipo_var,$descrip_var,$status_var,$id_franq,$dato)
	{
		$this->id_var = $id_var;
		$this->variable = $variable;
		$this->tipo_var = $tipo_var;
		$this->descrip_var = $descrip_var;
		$this->status_var = $status_var;
		$this->id_franq = $id_franq;
		$this->dato = $dato;
	}
	public function verid_var(){
		return $this->id_var;
	}
	public function verdato(){
		return $this->dato;
	}
	public function verid_franq(){
		return $this->id_franq;
	}
	public function verstatus_var(){
		return $this->status_var;
	}
	public function verdescrip_var(){
		return $this->descrip_var;
	}
	public function vertipo_var(){
		return $this->tipo_var;
	}
	public function vervariable(){
		return $this->variable;
	}

	public function validaExistencia($acceso)
	{
		$acceso->objeto->ejecutarSql("select * from variables_sms where id_var='$this->id_var'");
		if($acceso->objeto->registros>0)
			return true;
		else
			return false;
	}
	public function incluirvariables_sms($acceso)
	{
		//ECHO "insert into variables_sms(id_var,variable,tipo_var,descrip_var,status_var,id_franq) values ('$this->id_var','$this->variable','$this->tipo_var','$this->descrip_var','$this->status_var','$this->id_franq')";
		return $acceso->objeto->ejecutarSql("insert into variables_sms(id_var,variable,tipo_var,descrip_var,status_var,id_franq) values ('$this->id_var','$this->variable','$this->tipo_var','$this->descrip_var','$this->status_var','$this->id_franq')");			
	}
	public function modificarvariables_sms($acceso)
	{
		return $acceso->objeto->ejecutarSql("Update variables_sms Set variable='$this->variable', tipo_var='$this->tipo_var', descrip_var='$this->descrip_var', status_var='$this->status_var', id_franq='$this->id_franq' Where id_var='$this->id_var'");	
	}
	public function eliminarvariables_sms($acceso)
	{
		return $acceso->objeto->ejecutarSql("delete from variables_sms where id_var='$this->id_var'");
	}
}
?>