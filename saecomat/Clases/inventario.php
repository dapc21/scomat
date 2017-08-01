<?php
class inventario
{
	private $id_inv;
	private $id_motivo;
	private $fecha_inv;
	private $hora_inv;
	private $obser_inv;
	private $tipo_inv;
	private $id_dep;
	private $id_fam;
	private $status_inv;
	private $dato;

	function __construct($id_inv,$id_motivo,$fecha_inv,$hora_inv,$obser_inv,$tipo_inv,$id_dep,$id_fam,$status_inv,$dato)
	{
		$this->id_inv = $id_inv;
		$this->id_motivo = $id_motivo;
		$this->fecha_inv = $fecha_inv;
		$this->hora_inv = $hora_inv;
		$this->obser_inv = $obser_inv;
		$this->tipo_inv = $tipo_inv;
		$this->id_dep = $id_dep;
		$this->id_fam = $id_fam;
		$this->status_inv = $status_inv;
		$this->dato = $dato;
	}
	public function verid_inv(){
		return $this->id_inv;
	}
	public function verdato(){
		return $this->dato;
	}
	public function status_inv(){
		return $this->status_inv;
	}
	public function verid_fam(){
		return $this->id_fam;
	}
	public function verid_dep(){
		return $this->id_dep;
	}
	public function vertipo_inv(){
		return $this->tipo_inv;
	}
	public function verobser_inv(){
		return $this->obser_inv;
	}
	public function verhora_inv(){
		return $this->hora_inv;
	}
	public function verfecha_inv(){
		return $this->fecha_inv;
	}
	public function verid_motivo(){
		return $this->id_motivo;
	}

	public function validaExistencia($acceso)
	{
		$acceso->objeto->ejecutarSql("select * from inventario where id_inv='$this->id_inv'");
		if($acceso->objeto->registros>0)
			return true;
		else
			return false;
	}
	public function incluirinventario($acceso)
	{
		session_start();
		$login=$_SESSION["login"];
	//	echo "insert into inventario(id_inv,id_motivo,fecha_inv,hora_inv,obser_inv,tipo_inv,id_dep,id_fam) values ('$this->id_inv','$this->id_motivo','$this->fecha_inv','$this->hora_inv','$this->obser_inv','$this->tipo_inv','$this->id_dep','$this->id_fam')";
		return $acceso->objeto->ejecutarSql("insert into inventario(id_inv,id_motivo,fecha_inv,hora_inv,obser_inv,tipo_inv,id_dep,id_fam,status_inv,login_reg) values ('$this->id_inv','$this->id_motivo','$this->fecha_inv','$this->hora_inv','$this->obser_inv','$this->tipo_inv','$this->id_dep','$this->id_fam','$this->status_inv','$login')");			
	}
	public function modificarinventario($acceso)
	{
		session_start();
		$login=$_SESSION["login"];
		return $acceso->objeto->ejecutarSql("Update inventario Set id_motivo='$this->id_motivo', fecha_inv='$this->fecha_inv', hora_inv='$this->hora_inv', obser_inv='$this->obser_inv', tipo_inv='$this->tipo_inv', id_dep='$this->id_dep', id_fam='$this->id_fam', status_inv='$this->status_inv', login_aju='$login' Where id_inv='$this->id_inv'");	
	}
	public function eliminarinventario($acceso)
	{
		return $acceso->objeto->ejecutarSql("delete from inventario where id_inv='$this->id_inv'");
	}
	
}
?>