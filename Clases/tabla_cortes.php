<?php
class tabla_cortes
{
	private $id_tc;
	private $id_franq;
	private $fecha_tc;
	private $id_gt;
	private $obser_tc;
	private $status_tc;
	private $dato;

	function __construct($id_tc,$id_franq,$fecha_tc,$id_gt,$obser_tc,$status_tc,$dato)
	{
		$this->id_tc = $id_tc;
		$this->id_franq = $id_franq;
		$this->fecha_tc = $fecha_tc;
		$this->id_gt = $id_gt;
		$this->obser_tc = $obser_tc;
		$this->status_tc = $status_tc;
		$this->dato = $dato;
	}
	public function verid_tc(){
		return $this->id_tc;
	}
	public function verdato(){
		return $this->dato;
	}
	public function verstatus_tc(){
		return $this->status_tc;
	}
	public function verobser_tc(){
		return $this->obser_tc;
	}
	public function verid_gt(){
		return $this->id_gt;
	}
	public function verfecha_tc(){
		return $this->fecha_tc;
	}
	public function verid_franq(){
		return $this->id_franq;
	}

	public function validaExistencia($acceso)
	{
		$acceso->objeto->ejecutarSql("select * from tabla_cortes where id_tc='$this->id_tc'");
		if($acceso->objeto->registros>0)
			return true;
		else
			return false;
	}
	public function incluirtabla_cortes($acceso)
	{
		return $acceso->objeto->ejecutarSql("insert into tabla_cortes(id_tc,id_franq,fecha_tc,id_gt,obser_tc,status_tc,dato) values ('$this->id_tc','$this->id_franq','$this->fecha_tc','$this->id_gt','$this->obser_tc','$this->status_tc','$this->dato')");			
	}
	public function modificartabla_cortes($acceso)
	{
		return $acceso->objeto->ejecutarSql("Update tabla_cortes Set id_franq='$this->id_franq', fecha_tc='$this->fecha_tc', id_gt='$this->id_gt', obser_tc='$this->obser_tc', status_tc='$this->status_tc', dato='$this->dato' Where id_tc='$this->id_tc'");	
	}
	public function eliminartabla_cortes($acceso)
	{
		return $acceso->objeto->ejecutarSql("delete from tabla_cortes where id_tc='$this->id_tc'");
	}
}
?>