<?php
class mat_padre
{
	private $id_m;
	private $id_unidad;
	private $uni_id_unidad;
	private $id_fam;
	private $numero_mat;
	private $nombre_mat;
	private $precio_u_p;
	private $c_uni_ent;
	private $c_uni_sal;
	private $impresion;

	function __construct($id_m,$id_unidad,$uni_id_unidad,$id_fam,$numero_mat,$nombre_mat,$precio_u_p,$c_uni_ent,$c_uni_sal,$impresion)
	{
		$this->id_m = $id_m;
		$this->id_unidad = $id_unidad;
		$this->uni_id_unidad = $uni_id_unidad;
		$this->id_fam = $id_fam;
		$this->numero_mat = $numero_mat;
		$this->nombre_mat = $nombre_mat;
		$this->precio_u_p = $precio_u_p;
		$this->c_uni_ent = $c_uni_ent;
		$this->c_uni_sal = $c_uni_sal;
		$this->impresion = $impresion;
	}
	public function verid_m(){
		return $this->id_m;
	}
	public function verimpresion(){
		return $this->impresion;
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
	public function veruni_id_unidad(){
		return $this->uni_id_unidad;
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
		$acceso->objeto->ejecutarSql("select * from mat_padre where id_m='$this->id_m'");
		if($acceso->objeto->registros>0){
			$this->modificarmat_padre($acceso);
		}
		else{
			return $acceso->objeto->ejecutarSql("insert into mat_padre(id_m,id_unidad,id_fam,numero_mat,nombre_mat,precio_u_p,c_uni_ent,c_uni_sal,uni_id_unidad,impresion) values ('$this->id_m','$this->id_unidad','$this->id_fam','$this->numero_mat','$this->nombre_mat','$this->precio_u_p','$this->c_uni_ent','$this->c_uni_sal','$this->uni_id_unidad','$this->impresion')");		
		}
			
	}
	public function modificarmat_padre($acceso)
	{
		return $acceso->objeto->ejecutarSql("Update mat_padre Set id_unidad='$this->id_unidad', id_fam='$this->id_fam', numero_mat='$this->numero_mat', nombre_mat='$this->nombre_mat', precio_u_p='$this->precio_u_p', c_uni_ent='$this->c_uni_ent', c_uni_sal='$this->c_uni_sal', uni_id_unidad='$this->uni_id_unidad', impresion='$this->impresion' Where id_m='$this->id_m'");	
	}
	public function eliminarmat_padre($acceso)
	{
		$acceso->objeto->ejecutarSql("delete from materiales where id_m='$this->id_m'");
		return $acceso->objeto->ejecutarSql("delete from mat_padre where id_m='$this->id_m'");
	}
}
?>