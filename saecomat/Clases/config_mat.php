<?php
class config_mat
{
	private $id_c_mat;
	private $id_franq;
	private $hab_alerta_min;
	private $hab_desc_alm_gru;
	private $hab_desc_alm_gen;
	private $hab_mat_orden;
	private $id_deposito;
	private $hab_imp_mat;

	function __construct($id_c_mat,$id_franq,$hab_alerta_min,$hab_desc_alm_gru,$hab_desc_alm_gen,$hab_mat_orden,$id_deposito,$hab_imp_mat)
	{
		
		$this->id_c_mat = $id_c_mat;
		$this->id_franq = $id_franq;
		$this->hab_alerta_min = $hab_alerta_min;
		$this->hab_desc_alm_gru = $hab_desc_alm_gru;
		$this->hab_desc_alm_gen = $hab_desc_alm_gen;
		$this->hab_mat_orden = $hab_mat_orden;
		$this->id_deposito = $id_deposito;
		$this->hab_imp_mat = $hab_imp_mat;
	}
	public function verid_c_mat(){
		return $this->id_c_mat;
	}
	public function verhab_imp_mat(){
		return $this->hab_imp_mat;
	}
	public function verid_deposito(){
		return $this->id_deposito;
	}
	public function verhab_mat_orden(){
		return $this->hab_mat_orden;
	}
	public function verhab_desc_alm_gen(){
		return $this->hab_desc_alm_gen;
	}
	public function verhab_desc_alm_gru(){
		return $this->hab_desc_alm_gru;
	}
	public function verhab_alerta_min(){
		return $this->hab_alerta_min;
	}
	public function verid_franq(){
		return $this->id_franq;
	}

	public function validaExistencia($acceso)
	{
		$acceso->objeto->ejecutarSql("select * from config_mat where id_c_mat='$this->id_c_mat'");
		if($acceso->objeto->registros>0)
			return true;
		else
			return false;
	}
	public function incluirconfig_mat($acceso)
	{
		return $acceso->objeto->ejecutarSql("insert into config_mat(id_c_mat,id_franq,hab_alerta_min,hab_desc_alm_gru,hab_desc_alm_gen,hab_mat_orden,id_deposito,hab_imp_mat) values ('$this->id_c_mat','$this->id_franq','$this->hab_alerta_min','$this->hab_desc_alm_gru','$this->hab_desc_alm_gen','$this->hab_mat_orden','$this->id_deposito','$this->hab_imp_mat')");			
	}
	public function modificarconfig_mat($acceso)
	{
		return $acceso->objeto->ejecutarSql("Update config_mat Set id_franq='$this->id_franq', hab_alerta_min='$this->hab_alerta_min', hab_desc_alm_gru='$this->hab_desc_alm_gru', hab_desc_alm_gen='$this->hab_desc_alm_gen', hab_mat_orden='$this->hab_mat_orden', id_deposito='$this->id_deposito', hab_imp_mat='$this->hab_imp_mat' Where id_c_mat='$this->id_c_mat'");	
	}
	public function eliminarconfig_mat($acceso)
	{
		return $acceso->objeto->ejecutarSql("delete from config_mat where id_c_mat='$this->id_c_mat'");
	}
}
?>