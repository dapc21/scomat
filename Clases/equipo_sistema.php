<?php
class equipo_sistema
{
	private $id_es;
	private $id_modelo;
	private $id_ues;
	private $id_contrato;
	private $codigo_es;
	private $tipo_es;
	private $status_es;
	private $obser_es;
	private $codigo_adic;
	private $estado_fisico;
	private $dato;
	private $serv_sist_equipo;
	private $ubicacion;

	function __construct($dat)
	{
		$this->id_es = $dat['id_es'];
		$this->id_modelo = $dat['id_modelo'];
		$this->id_ues = $dat['id_ues'];
		$this->id_contrato = $dat['id_contrato'];
		$this->codigo_es = $dat['codigo_es'];
		$this->tipo_es = $dat['tipo_es'];
		$this->status_es = $dat['status_es'];
		$this->obser_es = $dat['obser_es'];
		$this->codigo_adic = $dat['codigo_adic'];
		$this->estado_fisico = $dat['estado_fisico'];
		$this->ubicacion = $dat['ubicacion'];
		$this->dato = $dat['dato'];
		$this->serv_sist_equipo = $dat['serv_sist_equipo'];
	}
	public function verid_es(){
		return $this->id_es;
	}
	public function verdato(){
		return $this->dato;
	}
	public function verestado_fisico(){
		return $this->estado_fisico;
	}
	public function vercodigo_adic(){
		return $this->codigo_adic;
	}
	public function verobser_es(){
		return $this->obser_es;
	}
	public function verstatus_es(){
		return $this->status_es;
	}
	public function vertipo_es(){
		return $this->tipo_es;
	}
	public function vercodigo_es(){
		return $this->codigo_es;
	}
	public function verid_contrato(){
		return $this->id_contrato;
	}
	public function verid_ues(){
		return $this->id_ues;
	}
	public function verid_modelo(){
		return $this->id_modelo;
	}

	public function validaExistencia($acceso)
	{
		$acceso->objeto->ejecutarSql("select * from equipo_sistema where id_es='$this->id_es'");
		if($acceso->objeto->registros>0)
			return true;
		else
			return false;
	}
	public function incluir($acceso)
	{
		
		 $acceso->objeto->ejecutarSql("insert into equipo_sistema(id_es,id_modelo,id_ues,id_contrato,codigo_es,tipo_es,status_es,obser_es,codigo_adic,estado_fisico) values ('$this->id_es','$this->id_modelo','$this->id_ues','$this->id_contrato','$this->codigo_es','$this->tipo_es','$this->status_es','$this->obser_es','$this->codigo_adic','$this->estado_fisico')");			

		 $acceso->objeto->ejecutarSql("DELETE from  serv_sist_equipo where id_es='$this->id_es'");
		 for ($i=0; $i < count($this->serv_sist_equipo); $i++) {
			$id_serv_sist=$this->serv_sist_equipo[$i]['id_serv_sist'];
			$acceso->objeto->ejecutarSql("insert into serv_sist_equipo(id_es,id_serv_sist,status_sse) values ('$this->id_es','$id_serv_sist','ACTIVO')");
		}
		
	}
	public function modificar($acceso)
	{
		
		$acceso->objeto->ejecutarSql("Update equipo_sistema Set id_modelo='$this->id_modelo', id_ues='$this->id_ues', id_contrato='$this->id_contrato', codigo_es='$this->codigo_es', tipo_es='$this->tipo_es', status_es='$this->status_es', obser_es='$this->obser_es', codigo_adic='$this->codigo_adic', estado_fisico='$this->estado_fisico' Where id_es='$this->id_es'");	

		 $acceso->objeto->ejecutarSql("DELETE from  serv_sist_equipo where id_es='$this->id_es'");
		 for ($i=0; $i < count($this->serv_sist_equipo); $i++) {
			$id_serv_sist=$this->serv_sist_equipo[$i]['id_serv_sist'];
			$acceso->objeto->ejecutarSql("insert into serv_sist_equipo(id_es,id_serv_sist,status_sse) values ('$this->id_es','$id_serv_sist','ACTIVO')");
		}
		
	}
	public function modificar_edit($acceso)
	{
		
		$acceso->objeto->ejecutarSql("Update equipo_sistema Set obser_es='$this->obser_es' Where id_es='$this->id_es'");	

		 $acceso->objeto->ejecutarSql("DELETE from  serv_sist_equipo where id_es='$this->id_es'");
		 for ($i=0; $i < count($this->serv_sist_equipo); $i++) {
			$id_serv_sist=$this->serv_sist_equipo[$i]['id_serv_sist'];
			$acceso->objeto->ejecutarSql("insert into serv_sist_equipo(id_es,id_serv_sist,status_sse) values ('$this->id_es','$id_serv_sist','ACTIVO')");
		}
		
	}
	public function modificar_add($acceso)
	{
		$acceso->objeto->ejecutarSql("Update equipo_sistema Set ubicacion='$this->ubicacion', id_contrato='$this->id_contrato', status_es='ACTIVO' Where id_es='$this->id_es'");	

		 $acceso->objeto->ejecutarSql("DELETE from  serv_sist_equipo where id_es='$this->id_es'");
		 for ($i=0; $i < count($this->serv_sist_equipo); $i++) {
			$id_serv_sist=$this->serv_sist_equipo[$i]['id_serv_sist'];
			$acceso->objeto->ejecutarSql("insert into serv_sist_equipo(id_es,id_serv_sist,status_sse) values ('$this->id_es','$id_serv_sist','ACTIVO')");
		}
		
	}
	public function eliminar($acceso)
	{
		$acceso->objeto->ejecutarSql("delete from serv_sist_equipo where id_es='$this->id_es'");
		 $acceso->objeto->ejecutarSql("delete from equipo_sistema where id_es='$this->id_es'");
		
	}
}
?>