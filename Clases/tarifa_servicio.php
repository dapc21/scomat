<?php
require_once "procesos.php";
class tarifa_servicio
{
	private $id_tar_ser;
	private $id_serv;
	private $fecha_tar_ser;
	private $hora_tar_ser;
	private $obser_tarifa_ser;
	private $status_tarifa_ser;
	private $tarifa_ser;
	private $tarifas;

	function __construct($dat)
	{
		$this->id_tar_ser = $dat['id_tar_ser'];
		$this->id_serv = $dat['id_serv'];
		$this->fecha_tar_ser = formatfecha($dat['fecha_tar_ser']);
		$this->hora_tar_ser = $dat['hora_tar_ser'];
		$this->obser_tarifa_ser = $dat['obser_tarifa_ser'];
		$this->status_tarifa_ser = $dat['status_tarifa_ser'];
		$this->tarifa_ser = $dat['tarifa_ser'];
		$this->tarifas = $dat['tarifas'];
	}
	public function verid_tar_ser(){
		return $this->id_tar_ser;
	}
	public function vertarifa_ser(){
		return $this->tarifa_ser;
	}
	public function verstatus_tarifa_ser(){
		return $this->status_tarifa_ser;
	}
	public function verobser_tarifa_ser(){
		return $this->obser_tarifa_ser;
	}
	public function verhora_tar_ser(){
		return $this->hora_tar_ser;
	}
	public function verfecha_tar_ser(){
		return $this->fecha_tar_ser;
	}
	public function verid_serv(){
		return $this->id_serv;
	}
	public function validaExistencia($acceso)
	{
		$acceso->objeto->ejecutarSql("select * from tarifa_servicio where id_tar_ser='$this->id_tar_ser'");
		if($acceso->objeto->registros>0)
			return true;
		else
			return false;
	}
	public function incluir($acceso)
	{
		
		session_start();
		$ini_u = $_SESSION["ini_u"];  
		$login = $_SESSION["login"];  

			$acceso->objeto->ejecutarSql("select id_cont_serv from contrato_servicio  where (id_cont_serv ILIKE '$ini_u%')  ORDER BY id_cont_serv desc LIMIT 1 offset 0 "); 
			$id_cont_serv= $ini_u.verCodLong($acceso,"id_cont_serv");

		for ($i=0; $i < count($this->tarifas); $i++){
			$id_serv=$this->tarifas[$i]['id_serv'];
			$tarifa_ser=$this->tarifas[$i]['tarifa_ser'];
			

			$acceso1=conexion();
			$acceso1->objeto->ejecutarSql("select * from contrato_servicio where id_serv='$id_serv' and (status_con_ser='CONTRATO' or status_con_ser='SUSPENDIDO') ");
			while($row=row($acceso1)){
				$id_cont_serv_v= trim($row["id_cont_serv"]);
				$id_serv= trim($row["id_serv"]);
				$fecha_inst= trim($row["fecha_inst"]);
				$cant_serv= trim($row["cant_serv"]);
				$status_con_ser= trim($row["status_con_ser"]);
				$costo_cobro= trim($row["costo_cobro"]);
				$id_contrato= trim($row["id_contrato"]);

					$acceso->objeto->ejecutarSql("update contrato_servicio set status_con_ser='INACTIVO' where id_cont_serv='$id_cont_serv_v'");
					$acceso->objeto->ejecutarSql("insert into contrato_servicio(id_cont_serv,id_serv,id_contrato,fecha_inst,cant_serv,status_con_ser,costo_cobro,obser,login,fecha) values ('$id_cont_serv','$id_serv','$id_contrato','$this->fecha_tar_ser','$cant_serv','$status_con_ser','$tarifa_ser','Cambio de Tarifa','$login','now()')");
					$id_cont_serv=$ini_u.verCodLongInc($acceso,$id_cont_serv);
				}

			$acceso->objeto->ejecutarSql("Update tarifa_servicio Set status_tarifa_ser='INACTIVO' Where id_serv='$id_serv'");
			$acceso->objeto->ejecutarSql("insert into tarifa_servicio(id_tar_ser,id_serv,fecha_tar_ser,status_tarifa_ser,tarifa_ser) values ('$this->id_tar_ser','$id_serv','$this->fecha_tar_ser','ACTIVO','$tarifa_ser')");
			$this->id_tar_ser=$ini_u.verCo_inc($this->id_tar_ser); 
		}
			
	}
	public function modificar($acceso)
	{
		
		 $acceso->objeto->ejecutarSql("Update tarifa_servicio Set id_serv='$this->id_serv', fecha_tar_ser='$this->fecha_tar_ser', hora_tar_ser='$this->hora_tar_ser', obser_tarifa_ser='$this->obser_tarifa_ser', status_tarifa_ser='$this->status_tarifa_ser', tarifa_ser='$this->tarifa_ser' Where id_tar_ser='$this->id_tar_ser'");	
				
	}
	public function eliminar($acceso)
	{
		
		 $acceso->objeto->ejecutarSql("delete from tarifa_servicio where id_tar_ser='$this->id_tar_ser'");
			
	}
}
?>