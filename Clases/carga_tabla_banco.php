<?php
class carga_tabla_banco
{
	private $id_ctb;
	private $id_cuba;
	private $fecha_ctb;
	private $hora_ctb;
	private $login_ctb;
	private $fecha_desde_ctb;
	private $fecha_hasta_ctb;
	private $status_ctb;
	private $formato_ctb;
	

	function __construct($dat)
	{
		$this->id_ctb =$dat['id_ctb'];
		$this->id_cuba =$dat['id_cuba'];
		$this->fecha_ctb =$dat['fecha_ctb'];
		$this->hora_ctb =$dat['hora_ctb'];
		$this->login_ctb =$dat['login_ctb'];
		$this->fecha_desde_ctb =$dat['fecha_desde_ctb'];
		$this->fecha_hasta_ctb =$dat['fecha_hasta_ctb'];
		$this->status_ctb =$dat['status_ctb'];
		$this->formato_ctb =$dat['formato_ctb'];
		
	}
	public function verid_ctb(){
		return $this->id_ctb;
	}
	public function verdato(){
		return $this->dato;
	}
	public function verstatus_ctb(){
		return $this->status_ctb;
	}
	public function verfecha_hasta_ctb(){
		return $this->fecha_hasta_ctb;
	}
	public function verfecha_desde_ctb(){
		return $this->fecha_desde_ctb;
	}
	public function verlogin_ctb(){
		return $this->login_ctb;
	}
	public function verhora_ctb(){
		return $this->hora_ctb;
	}
	public function verfecha_ctb(){
		return $this->fecha_ctb;
	}
	public function verid_cuba(){
		return $this->id_cuba;
	}

	public function validaExistencia($acceso)
	{
		$acceso->objeto->ejecutarSql("select * from carga_tabla_banco where id_ctb='$this->id_ctb'");
		if($acceso->objeto->registros>0)
			return true;
		else
			return false;
	}
	public function incluir($acceso)
	{	
		
			$acceso->objeto->ejecutarSql("insert into carga_tabla_banco(id_ctb,id_cuba,fecha_ctb,hora_ctb,login_ctb,fecha_desde_ctb,fecha_hasta_ctb,status_ctb,formato_ctb) values ('$this->id_ctb','$this->id_cuba','$this->fecha_ctb','$this->hora_ctb','$this->login_ctb','$this->fecha_desde_ctb','$this->fecha_hasta_ctb','$this->status_ctb','$this->formato_ctb')");	
			require_once 'tabla_bancos.php';
			$data = new tabla_bancos($this->id_ctb);
			$data->cargartabla_bancos($acceso,$this->fecha_desde_ctb,$this->fecha_hasta_ctb,$this->formato_ctb);
		
			
	}
	public function modificar($acceso)
	{
		
		$acceso->objeto->ejecutarSql("Update carga_tabla_banco Set id_cuba='$this->id_cuba', fecha_ctb='$this->fecha_ctb', hora_ctb='$this->hora_ctb', login_ctb='$this->login_ctb', fecha_desde_ctb='$this->fecha_desde_ctb', fecha_hasta_ctb='$this->fecha_hasta_ctb', status_ctb='$this->status_ctb' , formato_ctb='$this->formato_ctb' Where id_ctb='$this->id_ctb'");	
		require_once 'tabla_bancos.php';
		$data = new tabla_bancos($this->id_ctb);
		$data->cargartabla_bancos($acceso,$this->fecha_desde_ctb,$this->fecha_hasta_ctb,$this->formato_ctb);
		
				
	}
	public function eliminar($acceso)
	{
		
		$acceso->objeto->ejecutarSql("delete from tabla_bancos where id_ctb='$this->id_ctb'");
		$acceso->objeto->ejecutarSql("delete from carga_tabla_banco where id_ctb='$this->id_ctb'");
		
	}
}
?>