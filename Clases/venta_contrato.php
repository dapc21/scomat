<?php
class venta_contrato
{
	private $id_venta;
	private $id_persona;
	private $id_serv;
	private $costo_venta;
	private $login_venta;
	private $fecha_venta;
	private $id_contrato;

	function __construct($dat)
	{
		$this->id_contrato = $dat['id_contrato'];
		$this->id_venta = $dat['id_venta'];
		$this->id_persona = $dat['vendedor_id_persona'];
		$this->id_serv = $dat['id_serv_v'];
		$this->costo_venta = 0;
		session_start();
		$this->login_venta = strtoupper(trim($_SESSION["login"]));
		$this->fecha_venta = date("Y-m-d");
	}
	public function verid_venta(){
		return $this->id_venta;
	}
	public function verdato(){
		return $this->dato;
	}
	public function vermotivo(){
		return $this->motivo;
	}
	public function verfecha_venta(){
		return $this->fecha_venta;
	}
	public function verlogin_venta(){
		return $this->login_venta;
	}
	public function vercosto_venta(){
		return $this->costo_venta;
	}
	public function verid_serv(){
		return $this->id_serv;
	}
	public function verid_persona(){
		return $this->id_persona;
	}
	public function validaExistencia($acceso)
	{
		$acceso->objeto->ejecutarSql("select * from venta_contrato where id_venta='$this->id_venta'");
		if($acceso->objeto->registros>0)
			return true;
		else
			return false;
	}
	public function incluir($acceso)
	{
		session_start();
		$ini_u = $_SESSION["ini_u"]; 
		$acceso->objeto->ejecutarSql("select  id_venta from venta_contrato  where (id_venta ILIKE '$ini_u%')   ORDER BY id_venta desc LIMIT 1 offset 0 ");
		$id_venta=$ini_u.verCodLong($acceso,"id_venta");
		$acceso1=conexion();
		$acceso1->objeto->ejecutarSql("select * from cargar_deuda where id_contrato='$this->id_contrato' ");
		while($row=row($acceso1)){
			$id_cd= trim($row["id_cd"]);
			$id_serv= trim($row["id_serv"]);
			$cant_venta= trim($row["cantidad"]);
			$costo_venta= trim($row["costo"]);
			//echo "insert into venta_contrato(id_venta,id_persona,id_serv,costo_venta,login_venta,fecha_venta,cant_venta) values ('$id_venta','$this->id_persona','$id_serv','$costo_venta','$this->login_venta','now()','$cant_venta')";
			$acceso->objeto->ejecutarSql("insert into venta_contrato(id_venta,id_persona,id_serv,costo_venta,login_venta,fecha_venta,cant_venta,id_contrato) values ('$id_venta','$this->id_persona','$id_serv','$costo_venta','$this->login_venta','now()','$cant_venta','$this->id_contrato')");
			$id_venta=$ini_u.verCodLongInc($acceso,$id_venta);
		}

	}
	public function modificar($acceso)
	{
		return $acceso->objeto->ejecutarSql("Update venta_contrato Set id_persona='$this->id_persona', id_serv='$this->id_serv', costo_venta='$this->costo_venta', login_venta='$this->login_venta', fecha_venta='$this->fecha_venta'  Where id_venta='$this->id_venta'");	
	}
	public function eliminar($acceso)
	{
		return $acceso->objeto->ejecutarSql("delete from venta_contrato where id_venta='$this->id_venta'");
	}
	public function agregar_cargo_afiliacion($acceso)
	{	
		$ini_u = $_SESSION["ini_u"]; 
		$acceso->objeto->ejecutarSql("select valor_param from parametros where id_param='10'");
		if($row=row($acceso)){
			$valor_param= trim($row["valor_param"]);
		}
		 if($valor_param=="1"){
			agregar_factura_unico_cargar_deuda($acceso,$this->id_contrato);
			$acceso->objeto->ejecutarSql("delete from cargar_deuda where id_contrato='$this->id_contrato'");
		 }
	}
}
?>