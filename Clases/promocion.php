<?php
class promocion
{
	private $id_promo;
	private $nombre_promo;
	private $fecha_promo;
	private $inicio_promo;
	private $fin_promo;
	private $mes_promo;
	private $tipo_promo;
	private $descuento_promo;
	private $login;
	private $status_promo;
	private $dato;

	function __construct($id_promo,$nombre_promo,$fecha_promo,$inicio_promo,$fin_promo,$mes_promo,$tipo_promo,$descuento_promo,$login,$status_promo,$dato)
	{
		$this->id_promo = $id_promo;
		$this->nombre_promo = $nombre_promo;
		$this->fecha_promo = $fecha_promo;
		$this->inicio_promo = $inicio_promo;
		$this->fin_promo = $fin_promo;
		$this->mes_promo = $mes_promo;
		$this->tipo_promo = $tipo_promo;
		$this->descuento_promo = $descuento_promo;
		$this->login = $login;
		$this->status_promo = $status_promo;
		$this->dato = $dato;
	}
	public function verid_promo(){
		return $this->id_promo;
	}
	public function verdato(){
		return $this->dato;
	}
	public function verstatus_promo(){
		return $this->status_promo;
	}
	public function verlogin(){
		return $this->login;
	}
	public function verdescuento_promo(){
		return $this->descuento_promo;
	}
	public function vertipo_promo(){
		return $this->tipo_promo;
	}
	public function vermes_promo(){
		return $this->mes_promo;
	}
	public function verfin_promo(){
		return $this->fin_promo;
	}
	public function verinicio_promo(){
		return $this->inicio_promo;
	}
	public function verfecha_promo(){
		return $this->fecha_promo;
	}
	public function vernombre_promo(){
		return $this->nombre_promo;
	}

	public function validaExistencia($acceso)
	{
		$acceso->objeto->ejecutarSql("select * from promocion where id_promo='$this->id_promo'");
		if($acceso->objeto->registros>0)
			return true;
		else
			return false;
	}
	public function incluirpromocion($acceso)
	{
		
		
		$acceso->objeto->ejecutarSql("delete from promo_serv where id_promo='$this->id_promo'");
		 $acceso->objeto->ejecutarSql("insert into promocion(id_promo,nombre_promo,fecha_promo,inicio_promo,fin_promo,mes_promo,tipo_promo,descuento_promo,login,status_promo,dato) values ('$this->id_promo','$this->nombre_promo','$this->fecha_promo','$this->inicio_promo','$this->fin_promo','$this->mes_promo','$this->tipo_promo','$this->descuento_promo','$this->login','$this->status_promo','$this->dato')");			
		
	}
	public function modificarpromocion($acceso)
	{
		
		$acceso->objeto->ejecutarSql("delete from promo_serv where id_promo='$this->id_promo'");
		 $acceso->objeto->ejecutarSql("Update promocion Set nombre_promo='$this->nombre_promo', fecha_promo='$this->fecha_promo', inicio_promo='$this->inicio_promo', fin_promo='$this->fin_promo', mes_promo='$this->mes_promo', tipo_promo='$this->tipo_promo', descuento_promo='$this->descuento_promo', login='$this->login', status_promo='$this->status_promo', dato='$this->dato' Where id_promo='$this->id_promo'");	
		
	}
	public function eliminarpromocion($acceso)
	{
		
		$acceso->objeto->ejecutarSql("delete from promo_serv where id_promo='$this->id_promo'");
		 $acceso->objeto->ejecutarSql("delete from promocion where id_promo='$this->id_promo'");
		
	}
}
?>