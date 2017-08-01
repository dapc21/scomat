<?php
require_once "Clases/mat_padre.php";
include "procesos.php";
class materiales extends mat_padre
{
	private $id_mat;
	private $id_m;
	private $id_dep;
	private $stock;
	private $stock_min;
	private $observacion;
	private $dato;

	function __construct($id_mat,$numero_mat,$nombre_mat,$id_unidad,$uni_id_unidad,$id_dep,$id_fam,$stock,$stock_min,$observacion,$precio_u_p,$c_uni_ent,$c_uni_sal,$id_m,$impresion)
	{
		parent::__construct($id_m,$id_unidad,$uni_id_unidad,$id_fam,$numero_mat,$nombre_mat,$precio_u_p,$c_uni_ent,$c_uni_sal,$impresion);
		$this->id_m = $id_m;
		$this->id_mat = $id_mat;
		$this->id_dep = $id_dep;
		$this->stock = $stock;
		$this->stock_min = $stock_min;
		$this->observacion = $observacion;
		$this->dato = $dato;
	}
	public function verid_mat(){
		return $this->id_mat;
	}
	public function verdato(){
		return $this->dato;
	}
	public function verc_uni_sal(){
		return $this->c_uni_sal;
	}
	public function verc_uni_ent(){
		return $this->c_uni_ent;
	}
	public function verprecio_u_p(){
		return $this->precio_u_p;
	}
	public function verobservacion(){
		return $this->observacion;
	}
	public function verstock_min(){
		return $this->stock_min;
	}
	public function verstock(){
		return $this->stock;
	}
	public function verid_fam(){
		return $this->id_fam;
	}
	public function verid_dep(){
		return $this->id_dep;
	}
	public function veruni_id_unidad(){
		return $this->uni_id_unidad;
	}
	public function verid_unidad(){
		return $this->id_unidad;
	}
	public function vernombre_mat(){
		return $this->nombre_mat;
	}
	public function verid_m(){
		return $this->id_m;
	}

	public function validaExistencia($acceso)
	{
		$acceso->objeto->ejecutarSql("select * from materiales where id_mat='$this->id_mat'");
		if($acceso->objeto->registros>0)
			return true;
		else
			return false;
	}
	public function incluirmateriales($acceso)
	{
		parent::incluirmat_padre($acceso);
		$acceso->objeto->ejecutarSql("select *from materiales where id_m='$this->id_m' and id_dep='A0000001' ORDER BY id_mat desc LIMIT 1 offset 0"); 
		if($acceso->objeto->registros>0){		
			$acceso->objeto->ejecutarSql("insert into materiales(id_mat,id_m,id_dep,stock,stock_min,observacion) values ('$this->id_mat','$this->id_m','$this->id_dep','$this->stock','$this->stock_min','$this->observacion')");			
	    	return true;			
		}else{
			$acceso->objeto->ejecutarSql("insert into materiales(id_mat,id_m,id_dep,stock,stock_min,observacion) values ('$this->id_mat','$this->id_m','$this->id_dep','$this->stock','$this->stock_min','$this->observacion')");			
			session_start();
			$ini_u = $_SESSION["ini_u"];  
			$acceso->objeto->ejecutarSql("select  id_mat from materiales  where (id_mat ILIKE '$ini_u%')   ORDER BY id_mat desc LIMIT 1 offset 0 ");
			$i_ma=$ini_u.verCodLong($acceso,"id_mat");	
			/*
	    	$acceso->objeto->ejecutarSql("select * from materiales where (id_mat ilike 'A%') ORDER BY id_mat desc LIMIT 1 offset 0"); 
			$i_ma="AX".verCodLong($acceso,"id_mat");
			*/			
			return  $acceso->objeto->ejecutarSql("insert into materiales(id_mat,id_m,id_dep,stock,stock_min,observacion) values ('$i_ma','$this->id_m','A0000001','$this->stock','$this->stock_min','CREADO POR EL SISTEMA')");			
		}
		
		
	}
	public function modificarmateriales($acceso)
	{
		parent::modificarmat_padre($acceso);
		return $acceso->objeto->ejecutarSql("Update materiales Set id_m='$this->id_m', id_dep='$this->id_dep', stock='$this->stock', stock_min='$this->stock_min', observacion='$this->observacion' Where id_mat='$this->id_mat'");	
	}
	public function eliminarmateriales($acceso)
	{
		parent::eliminarmat_padre($acceso);
		return $acceso->objeto->ejecutarSql("delete from materiales where id_mat='$this->id_mat'");
	}
}
?>