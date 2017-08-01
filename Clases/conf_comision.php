<?php
class conf_comision
{
	private $id_confc;
	private $id_franq;
	private $fecha_confc;
	private $status_confc;
	private $porc_acord;
	private $porc_com_reca;
	private $porc_com_venta;
	private $porc_ret_iva;
	private $porc_ret_islr;
	private $descuento_conf;
	private $tipo_e_p;
	private $empresa_confc;
	private $rif_empresa;
	private $represen_confc;
	private $cedula_rep;
	private $desc_confc;
	private $dato;

	function __construct($id_confc,$id_franq,$fecha_confc,$status_confc,$porc_acord,$porc_com_reca,$porc_com_venta,$porc_ret_iva,$porc_ret_islr,$descuento_conf,$tipo_e_p,$empresa_confc,$rif_empresa,$represen_confc,$cedula_rep,$desc_confc,$dato)
	{
		$this->id_confc = $id_confc;
		$this->id_franq = $id_franq;
		$this->fecha_confc = $fecha_confc;
		$this->status_confc = $status_confc;
		$this->porc_acord = $porc_acord;
		$this->porc_com_reca = $porc_com_reca;
		$this->porc_com_venta = $porc_com_venta;
		$this->porc_ret_iva = $porc_ret_iva;
		$this->porc_ret_islr = $porc_ret_islr;
		$this->descuento_conf = $descuento_conf;
		$this->tipo_e_p = $tipo_e_p;
		$this->empresa_confc = $empresa_confc;
		$this->rif_empresa = $rif_empresa;
		$this->represen_confc = $represen_confc;
		$this->cedula_rep = $cedula_rep;
		$this->desc_confc = $desc_confc;
		$this->dato = $dato;
	}
	public function verid_confc(){
		return $this->id_confc;
	}
	public function verdato(){
		return $this->dato;
	}
	public function verdesc_confc(){
		return $this->desc_confc;
	}
	public function vercedula_rep(){
		return $this->cedula_rep;
	}
	public function verrepresen_confc(){
		return $this->represen_confc;
	}
	public function verrif_empresa(){
		return $this->rif_empresa;
	}
	public function verempresa_confc(){
		return $this->empresa_confc;
	}
	public function vertipo_e_p(){
		return $this->tipo_e_p;
	}
	public function verdescuento_conf(){
		return $this->descuento_conf;
	}
	public function verporc_ret_islr(){
		return $this->porc_ret_islr;
	}
	public function verporc_ret_iva(){
		return $this->porc_ret_iva;
	}
	public function verporc_com_venta(){
		return $this->porc_com_venta;
	}
	public function verporc_com_reca(){
		return $this->porc_com_reca;
	}
	public function verporc_acord(){
		return $this->porc_acord;
	}
	public function verstatus_confc(){
		return $this->status_confc;
	}
	public function verfecha_confc(){
		return $this->fecha_confc;
	}
	public function verid_franq(){
		return $this->id_franq;
	}
	public function validaExistencia($acceso)
	{
		$acceso->objeto->ejecutarSql("select * from conf_comision where id_confc='$this->id_confc'");
		if($acceso->objeto->registros>0)
			return true;
		else
			return false;
	}
	public function incluirconf_comision($acceso)
	{
		//echo "insert into conf_comision(id_confc,id_franq,fecha_confc,status_confc,porc_acord,porc_com_reca,porc_com_venta,porc_ret_iva,porc_ret_islr,descuento_conf,tipo_e_p,empresa_confc,rif_empresa,represen_confc,cedula_rep,desc_confc,dato) values ('$this->id_confc','$this->id_franq','$this->fecha_confc','$this->status_confc','$this->porc_acord','$this->porc_com_reca','$this->porc_com_venta','$this->porc_ret_iva','$this->porc_ret_islr','$this->descuento_conf','$this->tipo_e_p','$this->empresa_confc','$this->rif_empresa','$this->represen_confc','$this->cedula_rep','$this->desc_confc','$this->dato')";
		return $acceso->objeto->ejecutarSql("insert into conf_comision(id_confc,id_franq,fecha_confc,status_confc,porc_acord,porc_com_reca,porc_com_venta,porc_ret_iva,porc_ret_islr,descuento_conf,tipo_e_p,empresa_confc,rif_empresa,represen_confc,cedula_rep,desc_confc,dato) values ('$this->id_confc','$this->id_franq','$this->fecha_confc','$this->status_confc','$this->porc_acord','$this->porc_com_reca','$this->porc_com_venta','$this->porc_ret_iva','$this->porc_ret_islr','$this->descuento_conf','$this->tipo_e_p','$this->empresa_confc','$this->rif_empresa','$this->represen_confc','$this->cedula_rep','$this->desc_confc','$this->dato')");			
	}
	public function modificarconf_comision($acceso)
	{
		return $acceso->objeto->ejecutarSql("Update conf_comision Set id_franq='$this->id_franq', fecha_confc='$this->fecha_confc', status_confc='$this->status_confc', porc_acord='$this->porc_acord', porc_com_reca='$this->porc_com_reca', porc_com_venta='$this->porc_com_venta', porc_ret_iva='$this->porc_ret_iva', porc_ret_islr='$this->porc_ret_islr', descuento_conf='$this->descuento_conf', tipo_e_p='$this->tipo_e_p', empresa_confc='$this->empresa_confc', rif_empresa='$this->rif_empresa', represen_confc='$this->represen_confc', cedula_rep='$this->cedula_rep', desc_confc='$this->desc_confc', dato='$this->dato' Where id_confc='$this->id_confc'");	
	}
	public function eliminarconf_comision($acceso)
	{
		return $acceso->objeto->ejecutarSql("delete from conf_comision where id_confc='$this->id_confc'");
	}
}
?>