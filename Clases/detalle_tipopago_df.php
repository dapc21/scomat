<?php
class detalle_tipopago_df
{
	private $id_dbf;
	private $id_tipo_pago;
	private $id_cuba;
	private $id_df_tp;
	private $fecha_dbf;
	private $refer_dbf;
	private $monto_dbf;
	private $obser_dbf;
	private $status_dbf;
	private $hora_dbf;
	private $login_dbf;
	

	function __construct($id_dbf,$id_tipo_pago,$id_cuba,$id_df_tp,$fecha_dbf,$refer_dbf,$monto_dbf,$obser_dbf,$status_dbf,$hora_dbf,$login_dbf)
	{
		$this->id_dbf = $id_dbf;
		$this->id_tipo_pago = $id_tipo_pago;
		$this->id_cuba = $id_cuba;
		$this->id_df_tp = $id_df_tp;
		$this->fecha_dbf = $fecha_dbf;
		$this->refer_dbf = $refer_dbf;
		$this->monto_dbf = $monto_dbf;
		$this->obser_dbf = $obser_dbf;
		$this->status_dbf = $status_dbf;
		$this->hora_dbf = $hora_dbf;
		$this->login_dbf = $login_dbf;
		
	}
	public function verid_dbf(){
		return $this->id_dbf;
	}
	public function verdato(){
		return $this->dato;
	}
	public function verlogin_dbf(){
		return $this->login_dbf;
	}
	public function verhora_dbf(){
		return $this->hora_dbf;
	}
	public function verstatus_dbf(){
		return $this->status_dbf;
	}
	public function verobser_dbf(){
		return $this->obser_dbf;
	}
	public function vermonto_dbf(){
		return $this->monto_dbf;
	}
	public function verrefer_dbf(){
		return $this->refer_dbf;
	}
	public function verfecha_dbf(){
		return $this->fecha_dbf;
	}
	public function verid_df_tp(){
		return $this->id_df_tp;
	}
	public function verid_cuba(){
		return $this->id_cuba;
	}
	public function verid_tipo_pago(){
		return $this->id_tipo_pago;
	}

	public function validaExistencia($acceso)
	{
		$acceso->objeto->ejecutarSql("select * from detalle_tipopago_df where id_dbf='$this->id_dbf'");
		if($acceso->objeto->registros>0)
			return true;
		else
			return false;
	}
	public function incluirdetalle_tipopago_df($acceso)
	{
		$acceso->objeto->ejecutarSql("insert into detalle_tipopago_df(id_dbf,id_tipo_pago,id_cuba,id_df_tp,fecha_dbf,refer_dbf,monto_dbf,obser_dbf,status_dbf,hora_dbf,login_dbf,exportado) values ('$this->id_dbf','$this->id_tipo_pago','$this->id_cuba','$this->id_df_tp','$this->fecha_dbf','$this->refer_dbf','$this->monto_dbf','$this->obser_dbf','$this->status_dbf','$this->hora_dbf','$this->login_dbf','NO')");	
		require_once "procesos.php";
		conciliar_pago_franq($acceso,$this->id_dbf);
		$acceso->objeto->ejecutarSql("select status_dbf from detalle_tipopago_df where id_dbf='$this->id_dbf'");
		if($row=$acceso->objeto->devolverRegistro()){		
			if(trim($row["status_dbf"])=='REGISTRADO'){
				conciliar_pago_franq_semejante_fecha($acceso,$this->id_dbf);
			}
		}
	}
	public function modificardetalle_tipopago_df($acceso)
	{
		$acceso->objeto->ejecutarSql("Update detalle_tipopago_df Set id_tipo_pago='$this->id_tipo_pago', id_cuba='$this->id_cuba', id_df_tp='$this->id_df_tp', fecha_dbf='$this->fecha_dbf', refer_dbf='$this->refer_dbf', monto_dbf='$this->monto_dbf', obser_dbf='$this->obser_dbf', status_dbf='$this->status_dbf', hora_dbf='$this->hora_dbf', login_dbf='$this->login_dbf' Where id_dbf='$this->id_dbf'");	
		require_once "procesos.php";
		conciliar_pago_franq($acceso,$this->id_dbf);
	}
	public function eliminardetalle_tipopago_df($acceso)
	{
		return $acceso->objeto->ejecutarSql("delete from detalle_tipopago_df where id_dbf='$this->id_dbf'");
	}
}
?>