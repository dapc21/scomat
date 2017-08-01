<?php
class mat_padre
{
	private $id_m;
	private $id_unidad;
	private $id_fam;
	private $numero_mat;
	private $nombre_mat;
	private $precio_u_p;
	private $c_uni_ent;
	private $c_uni_sal;
	private $dato;

	function __construct($id_m,$id_unidad,$id_fam,$numero_mat,$nombre_mat,$precio_u_p,$c_uni_ent,$c_uni_sal,$dato)
	{
		$this->id_m = $id_m;
		$this->id_unidad = $id_unidad;
		$this->id_fam = $id_fam;
		$this->numero_mat = $numero_mat;
		$this->nombre_mat = $nombre_mat;
		$this->precio_u_p = $precio_u_p;
		$this->c_uni_ent = $c_uni_ent;
		$this->c_uni_sal = $c_uni_sal;
		$this->dato = $dato;
	}
	public function verid_m(){
		return $this->id_m;
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
	public function vernombre_mat(){
		return $this->nombre_mat;
	}
	public function vernumero_mat(){
		return $this->numero_mat;
	}
	public function verid_fam(){
		return $this->id_fam;
	}
	public function verid_unidad(){
		return $this->id_unidad;
	}

	public function validaExistencia($acceso)
	{
		$acceso->objeto->ejecutarSql("select * from mat_padre where id_m='$this->id_m'");
		if($acceso->objeto->registros>0)
			return true;
		else
			return false;
	}
	public function incluirmat_padre($acceso)
	{
		return $acceso->objeto->ejecutarSql("insert into mat_padre(id_m,id_unidad,id_fam,numero_mat,nombre_mat,precio_u_p,c_uni_ent,c_uni_sal) values ('$this->id_m','$this->id_unidad','$this->id_fam','$this->numero_mat','$this->nombre_mat','$this->precio_u_p','$this->c_uni_ent','$this->c_uni_sal'ç)");			
	}
	public function modificarmat_padre($acceso)
	{
		return $acceso->objeto->ejecutarSql("Update mat_padre Set id_unidad='$this->id_unidad', id_fam='$this->id_fam', numero_mat='$this->numero_mat', nombre_mat='$this->nombre_mat', precio_u_p='$this->precio_u_p', c_uni_ent='$this->c_uni_ent', c_uni_sal='$this->c_uni_sal' Where id_m='$this->id_m'");	
	}
	public function eliminarmat_padre($acceso)
	{
		return $acceso->objeto->ejecutarSql("delete from mat_padre where id_m='$this->id_m'");
	}
}
?>