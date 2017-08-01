<?php
class pedido
{
	private $id_ped;
	private $id_prov;
	private $fecha_ped;
	private $fecha_ent;
	private $status_ped;
	private $obser_ped;
	private $nro_fact_ped;
	private $porc_desc;
	private $desc_ped;
	private $base_ped;
	private $iva_ped;
	private $total_ped;
	private $dato;

	function __construct($id_ped,$id_prov,$fecha_ped,$fecha_ent,$status_ped,$obser_ped,$nro_fact_ped,$porc_desc,$desc_ped,$base_ped,$iva_ped,$total_ped,$dato)
	{
		$this->id_ped = $id_ped;
		$this->id_prov = $id_prov;
		$this->fecha_ped = $fecha_ped;
		$this->fecha_ent = $fecha_ent;
		$this->status_ped = $status_ped;
		$this->obser_ped = $obser_ped;
		$this->nro_fact_ped = $nro_fact_ped;
		$this->porc_desc = $porc_desc;
		$this->desc_ped = $desc_ped;
		$this->base_ped = $base_ped;
		$this->iva_ped = $iva_ped;
		$this->total_ped = $total_ped;
		$this->dato = $dato;
	}
	public function verid_ped(){
		return $this->id_ped;
	}
	public function verdato(){
		return $this->dato;
	}
	public function vertotal_ped(){
		return $this->total_ped;
	}
	public function veriva_ped(){
		return $this->iva_ped;
	}
	public function verbase_ped(){
		return $this->base_ped;
	}
	public function verdesc_ped(){
		return $this->desc_ped;
	}
	public function verporc_desc(){
		return $this->porc_desc;
	}
	public function vernro_fact_ped(){
		return $this->nro_fact_ped;
	}
	public function verobser_ped(){
		return $this->obser_ped;
	}
	public function verstatus_ped(){
		return $this->status_ped;
	}
	public function verfecha_ent(){
		return $this->fecha_ent;
	}
	public function verfecha_ped(){
		return $this->fecha_ped;
	}
	public function verid_prov(){
		return $this->id_prov;
	}

	public function validaExistencia($acceso)
	{
		$acceso->objeto->ejecutarSql("select * from pedido where id_ped='$this->id_ped'");
		if($acceso->objeto->registros>0)
			return true;
		else
			return false;
	}
	public function incluirpedido($acceso)
	{
		session_start();
		$login_sol=$_SESSION["login"];
		return $acceso->objeto->ejecutarSql("insert into pedido(id_ped,id_prov,fecha_ped,fecha_ent,status_ped,obser_ped,nro_fact_ped,porc_desc,desc_ped,base_ped,iva_ped,total_ped,login_sol) values ('$this->id_ped','$this->id_prov','$this->fecha_ped','$this->fecha_ent','$this->status_ped','$this->obser_ped','$this->nro_fact_ped','$this->porc_desc','$this->desc_ped','$this->base_ped','$this->iva_ped','$this->total_ped','$login_sol')");			
	}
	public function modificarpedido($acceso)
	{
		session_start();
		$login=$_SESSION["login"];
		if($this->status_ped=='APROBADO' || $this->status_ped=='DENEGADO'){
			$acceso->objeto->ejecutarSql("Update pedido Set login_apr='$login' Where id_ped='$this->id_ped'");	
		}
		else if($this->status_ped=='COMPRADO'){
			$acceso->objeto->ejecutarSql("Update pedido Set login_com='$login' Where id_ped='$this->id_ped'");	
		}
		
		return $acceso->objeto->ejecutarSql("Update pedido Set id_prov='$this->id_prov', fecha_ped='$this->fecha_ped', fecha_ent='$this->fecha_ent', status_ped='$this->status_ped', obser_ped='$this->obser_ped', nro_fact_ped='$this->nro_fact_ped', porc_desc='$this->porc_desc', desc_ped='$this->desc_ped', base_ped='$this->base_ped', iva_ped='$this->iva_ped', total_ped='$this->total_ped' Where id_ped='$this->id_ped'");	
	}
	public function eliminarpedido($acceso)
	{
		return $acceso->objeto->ejecutarSql("delete from pedido where id_ped='$this->id_ped'");
	}
	public function eliminarMatPedidopedido($acceso)
	{
		return $acceso->objeto->ejecutarSql("delete from mat_ped where id_ped='$this->id_ped'");
	}
}
?>