<?php
class orden_tabla_cortes
{
	private $id_tc;
	private $id_orden;
	private $dato;

	function __construct($id_tc,$id_orden,$dato)
	{
		$this->id_tc = $id_tc;
		$this->id_orden = $id_orden;
		$this->dato = $dato;
	}
	public function verid_tc(){
		return $this->id_tc;
	}
	public function verdato(){
		return $this->dato;
	}
	public function verid_orden(){
		return $this->id_orden;
	}

	public function validaExistencia($acceso)
	{
		$acceso->objeto->ejecutarSql("select * from orden_tabla_cortes where id_tc='$this->id_tc'");
		if($acceso->objeto->registros>0)
			return true;
		else
			return false;
	}
	public function incluirorden_tabla_cortes($acceso)
	{
		return $acceso->objeto->ejecutarSql("insert into orden_tabla_cortes(id_tc,id_orden,dato) values ('$this->id_tc','$this->id_orden','$this->dato')");			
	}
	public function modificarorden_tabla_cortes($acceso)
	{
		return $acceso->objeto->ejecutarSql("Update orden_tabla_cortes Set id_orden='$this->id_orden', dato='$this->dato' Where id_tc='$this->id_tc'");	
	}
	public function eliminarorden_tabla_cortes($acceso)
	{
		return $acceso->objeto->ejecutarSql("delete from orden_tabla_cortes where id_tc='$this->id_tc'");
	}
}
?>