<?php
class servicios
{
	private $id_serv;
	private $id_tipo_servicio;
	private $nombre_servicio;
	private $status_serv;
	private $tipo_costo;
	private $tipo_paq;
	private $obser_serv;
	private $tipo_serv;
	private $tarifa_esp;
	private $id_paq;
	private $id_cant;
	private $tarifa_ser;
	private $id_tar_ser;
	private $serv_sist_paq;
	private $servicio_franquicia;

	function __construct($dat)
	{
		$this->id_serv = $dat['id_serv'];
		$this->id_tipo_servicio = $dat['id_tipo_servicio'];
		$this->nombre_servicio = $dat['nombre_servicio'];
		$this->status_serv = $dat['status_serv'];
		$this->tipo_costo = $dat['tipo_costo'];
		$this->tipo_paq = $dat['tipo_paq'];
		$this->obser_serv = $dat['obser_serv'];
		$this->tipo_serv = $dat['tipo_serv'];
		$this->tarifa_esp = $dat['tarifa_esp'];
		$this->id_paq = $dat['id_paq'];
		$this->id_cant = $dat['id_cant'];
		$this->id_tar_ser = $dat['id_tar_ser'];
		$this->tarifa_ser = $dat['tarifa_ser'];
		$this->serv_sist_paq = $dat['serv_sist_paq'];
		$this->servicio_franquicia = $dat['servicio_franquicia'];
	}
	public function verid_serv(){
		return $this->id_serv;
	}
	public function vertipo_costo(){
		return $this->tipo_costo;
	}
	public function verstatus_serv(){
		return $this->status_serv;
	}
	public function vernombre_servicio(){
		return $this->nombre_servicio;
	}
	public function verid_tipo_servicio(){
		return $this->id_tipo_servicio;
	}
	public function validaExistencia($acceso)
	{
		$acceso->objeto->ejecutarSql("select * from servicios where id_serv='$this->id_serv'");
		if($acceso->objeto->registros>0)
			return true;
		else
			return false;
	}
	public function incluir($acceso)
	{
		$acceso->objeto->ejecutarSql("insert into servicios(id_serv,id_tipo_servicio,nombre_servicio,status_serv,tipo_costo,tipo_paq,obser_serv,tipo_serv,tarifa_esp,id_paq,id_cant) values ('$this->id_serv','$this->id_tipo_servicio','$this->nombre_servicio','$this->status_serv','$this->tipo_costo','$this->tipo_paq','$this->obser_serv','$this->tipo_serv','$this->tarifa_esp','$this->id_paq','$this->id_cant')");
		$fecha_tar_ser=date("Y-m-d");
		$hora_tar_ser=date("H:i:s");
		$acceso->objeto->ejecutarSql("insert into tarifa_servicio(id_tar_ser,id_serv,fecha_tar_ser,hora_tar_ser,obser_tarifa_ser,status_tarifa_ser,tarifa_ser) values ('$this->id_tar_ser','$this->id_serv','$fecha_tar_ser','$hora_tar_ser','','ACTIVO','$this->tarifa_ser')");

		for ($i=0; $i < count($this->serv_sist_paq); $i++) {
			$id_serv_sist=$this->serv_sist_paq[$i]['id_serv_sist'];
			$acceso->objeto->ejecutarSql("insert into serv_sist_paq(id_serv,id_serv_sist) values ('$this->id_serv','$id_serv_sist')");
		}
		for ($i=0; $i < count($this->servicio_franquicia); $i++) {
			$id_franq=$this->servicio_franquicia[$i]['id_franq'];
			///echo "insert into servicio_franquicia(id_franq,id_serv) values ('$id_franq','$this->id_serv')";
			$acceso->objeto->ejecutarSql("insert into servicio_franquicia(id_franq,id_serv) values ('$id_franq','$this->id_serv')");
		}

	}
	public function modificar($acceso)
	{
		
		$acceso->objeto->ejecutarSql("Update servicios Set id_tipo_servicio='$this->id_tipo_servicio', nombre_servicio='$this->nombre_servicio', status_serv='$this->status_serv', tipo_costo='$this->tipo_costo' , tipo_paq='$this->tipo_paq' , obser_serv='$this->obser_serv' , tipo_serv='$this->tipo_serv'  , tarifa_esp='$this->tarifa_esp' , id_paq='$this->id_paq' , id_cant='$this->id_cant' Where id_serv='$this->id_serv'");
		 $acceso->objeto->ejecutarSql("delete from servicio_franquicia where id_serv='$this->id_serv'");
		 $acceso->objeto->ejecutarSql("delete from serv_sist_paq where id_serv='$this->id_serv' ");

		for ($i=0; $i < count($this->serv_sist_paq); $i++) {
			$id_serv_sist=$this->serv_sist_paq[$i]['id_serv_sist'];
			$acceso->objeto->ejecutarSql("insert into serv_sist_paq(id_serv,id_serv_sist) values ('$this->id_serv','$id_serv_sist')");
		}
		for ($i=0; $i < count($this->servicio_franquicia); $i++) {
			$id_franq=$this->servicio_franquicia[$i]['id_franq'];
			///echo "insert into servicio_franquicia(id_franq,id_serv) values ('$id_franq','$this->id_serv')";
			$acceso->objeto->ejecutarSql("insert into servicio_franquicia(id_franq,id_serv) values ('$id_franq','$this->id_serv')");
		}

	}
	public function eliminar($acceso)
	{
		
			$acceso->objeto->ejecutarSql("delete from tarifa_servicio where id_serv='$this->id_serv'");
			$acceso->objeto->ejecutarSql("delete from servicio_franquicia where id_serv='$this->id_serv'");
		 	$acceso->objeto->ejecutarSql("delete from serv_sist_paq where id_serv='$this->id_serv' ");
		 $acceso->objeto->ejecutarSql("delete from servicios where id_serv='$this->id_serv'");
			
	}
}
?>