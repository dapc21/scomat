<?php
require_once "procesos.php"; 
class conv_con
{
	private $id_conv_cont;
	private $id_conv;
	private $id_cont_serv;
	private $fecha_ven;
	private $dato;

	function __construct($id_conv_cont,$id_conv,$id_cont_serv,$fecha_ven,$dato='')
	{
		$this->id_conv_cont = $id_conv_cont;
		$this->id_conv = $id_conv;
		$this->id_cont_serv = $id_cont_serv;
		$this->fecha_ven = $fecha_ven;
		$this->dato = $dato;
	}
	public function verid_conv_cont(){
		return $this->id_conv_cont;
	}
	public function verdato(){
		return $this->dato;
	}
	public function verfecha_ven(){
		return $this->fecha_ven;
	}
	public function verid_cont_serv(){
		return $this->id_cont_serv;
	}
	public function verid_conv(){
		return $this->id_conv;
	}
	public function validaExistencia($acceso)
	{
		$acceso->objeto->ejecutarSql("select * from conv_con where id_conv='$this->id_conv' and  id_cont_serv='$this->id_cont_serv'");
		if($acceso->objeto->registros>0)
			return true;
		else
			return false;
	}
	public function incluirconv_con($acceso)
	{
		$ini_u = $_SESSION["ini_u"]; 
		$acceso->objeto->ejecutarSql("select *from conv_con where (id_conv_cont ILIKE '$ini_u%')  ORDER BY id_conv_cont desc"); 
		$this->id_conv_cont = $ini_u.verCo($acceso,"id_conv_cont");
		
		$acceso->objeto->ejecutarSql("select * from contrato_servicio_deuda where id_cont_serv='$this->id_cont_serv'");
		if($row=$acceso->objeto->devolverRegistro()){		
			$id_serv = trim($row['id_serv']);
			$fecha_inst = trim($row['fecha_inst']);
			$status_con_ser = 'DEUDA';
			$costo_cobro = trim($row['costo_cobro']);
		}
		
		 $acceso->objeto->ejecutarSql("insert into conv_con(id_conv_cont,id_conv,id_cont_serv,fecha_ven,id_serv,fecha_inst,status_con_ser,costo_cobro) values ('$this->id_conv_cont','$this->id_conv','$this->id_cont_serv','$this->fecha_ven','$id_serv','$fecha_inst','$status_con_ser','$costo_cobro')");			
		
	}
	public function modificarconv_con($acceso)
	{
		
		 $acceso->objeto->ejecutarSql("Update conv_con Set id_conv='$this->id_conv', id_cont_serv='$this->id_cont_serv', fecha_ven='$this->fecha_ven', dato='$this->dato' Where id_conv_cont='$this->id_conv_cont'");	
		
	}
	public function eliminarconv_con($acceso)
	{
		
		 $acceso->objeto->ejecutarSql("delete from conv_con where id_conv='$this->id_conv' and id_conv_cont='$this->id_conv_cont'");
		
	}
}
?>