<?php
class recibe_recibo
{
	private $id_rec;
	private $id_cobrador;
	private $fecha_rec;
	private $obser_rec;
	private $login_rec;
	private $tipo;
	private $recibos;

	function __construct($dat)
	{
		$this->id_rec =$dat['id_rec'];
		$this->id_cobrador =$dat['id_cobrador'];
		$this->fecha_rec =$dat['fecha_rec'];
		$this->obser_rec =$dat['obser_rec'];
		$this->login_rec =$dat['login_rec'];
		$this->tipo =$dat['tipo'];
		$this->recibos =$dat['recibos'];
	}
	public function verid_rec(){
		return $this->id_rec;
	}
	public function vertipo(){
		return $this->tipo;
	}
	public function verlogin_rec(){
		return $this->login_rec;
	}
	public function verobser_rec(){
		return $this->obser_rec;
	}
	public function verfecha_rec(){
		return $this->fecha_rec;
	}
	public function verid_cobrador(){
		return $this->id_cobrador;
	}
	public function validaExistencia($acceso)
	{
		$acceso->objeto->ejecutarSql("select * from recibe_recibo where id_rec='$this->id_rec'");
		if($acceso->objeto->registros>0)
			return true;
		else
			return false;
	}
	public function incluir($acceso)
	{
		$acceso->objeto->ejecutarSql("insert into recibe_recibo(id_rec,id_cobrador,fecha_rec,obser_rec,login_rec,tipo) values ('$this->id_rec','$this->id_cobrador','$this->fecha_rec','$this->obser_rec','$this->login_rec','$this->tipo')");
		require_once "recibos.php";
		for ($i=0; $i < count($this->recibos); $i++){
			$obj_tp=new recibos($this->recibos[$i]);
			$obj_tp->modificar($acceso);
		}
		
	}
	public function liberar_recibos($acceso)
	{
		
		require_once "recibos.php";
		for ($i=0; $i < count($this->recibos); $i++){
			$obj_tp=new recibos($this->recibos[$i]);
			$obj_tp->eliminar($acceso);
		}
	}
	public function eliminar($acceso)
	{
		$acceso->objeto->ejecutarSql("delete from recibe_recibo where id_rec='$this->id_rec'");
		
	}
}
?>