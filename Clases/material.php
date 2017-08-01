<?php
class material
{
	private $id_mat;
	private $id_fam;
	private $codigo_mat;
	private $nombre_mat;
	private $cant_uni_ent;
	private $id_uni;
	private $cant_uni_sal;
	private $uni_id_uni;
	private $impreso;

	function __construct($dat)
	{
		$this->id_mat = $dat['id_mat'];
		$this->id_fam = $dat['id_fam'];
		$this->codigo_mat = $dat['codigo_mat'];
		$this->nombre_mat = $dat['nombre_mat'];
		$this->cant_uni_ent = $dat['cant_uni_ent'];
		$this->id_uni = $dat['id_uni'];
		$this->cant_uni_sal = $dat['cant_uni_sal'];
		$this->uni_id_uni = $dat['uni_id_uni'];
		$this->impreso = $dat['impreso'];
	}
	public function verid_mat(){
		return $this->id_mat;
	}
	public function verimpreso(){
		return $this->impreso;
	}
	public function veruni_id_uni(){
		return $this->uni_id_uni;
	}
	public function vercant_uni_sal(){
		return $this->cant_uni_sal;
	}
	public function verid_uni(){
		return $this->id_uni;
	}
	public function vercant_uni_ent(){
		return $this->cant_uni_ent;
	}
	public function vernombre_mat(){
		return $this->nombre_mat;
	}
	public function vercodigo_mat(){
		return $this->codigo_mat;
	}
	public function verid_fam(){
		return $this->id_fam;
	}

	public function validaExistencia($acceso)
	{
		$acceso->objeto->ejecutarSql("select * from material where id_mat='$this->id_mat' and id_estatus_reg = 1");
		if($acceso->objeto->registros>0)
			return true;
		else
			return false;
	}
	public function incluir($acceso)
	{
		return $acceso->objeto->ejecutarSql("insert into material(id_mat,id_fam,codigo_mat,nombre_mat,cant_uni_ent,id_uni,cant_uni_sal,uni_id_uni,impreso) values ('$this->id_mat','$this->id_fam','$this->codigo_mat','$this->nombre_mat','$this->cant_uni_ent','$this->id_uni','$this->cant_uni_sal','$this->uni_id_uni','$this->impreso')");			
	}
	public function modificar($acceso)
	{
		return $acceso->objeto->ejecutarSql("Update material Set id_fam='$this->id_fam', codigo_mat='$this->codigo_mat', nombre_mat='$this->nombre_mat', cant_uni_ent='$this->cant_uni_ent', id_uni='$this->id_uni', cant_uni_sal='$this->cant_uni_sal', uni_id_uni='$this->uni_id_uni', impreso='$this->impreso' Where id_mat='$this->id_mat'");	
	}
	public function eliminar($acceso)
	{
		return $acceso->objeto->ejecutarSql("update material set id_estatus_reg = 2 where id_mat='$this->id_mat'");
	}
}
?>