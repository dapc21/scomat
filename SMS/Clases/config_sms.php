<?php
class config_sms
{
	private $id_conf_sms;
	private $id_franq;
	private $cod_telf_pais;
	private $telefono_serv;
	private $puerto;
	private $correo_emp;
	private $clave_correo;
	private $asunto_correo;
	private $per_telf_fijo;
	private $env_todos_telf;
	private $act_resp_aut;
	private $cod_ope_movil;
	private $conex;
	private $bits;
	private $sms_resp_aut;
	private $marca;
	private $modelo;
	private $ruta_archivo;

	function __construct($id_conf_sms,$id_franq,$cod_telf_pais,$telefono_serv,$puerto,$correo_emp,$clave_correo,$asunto_correo,$per_telf_fijo,$env_todos_telf,$act_resp_aut,$cod_ope_movil,$conex,$bits,$sms_resp_aut,$marca,$modelo,$ruta_archivo)
	{
		$this->id_conf_sms = $id_conf_sms;
		$this->id_franq = $id_franq;
		$this->cod_telf_pais = $cod_telf_pais;
		$this->telefono_serv = $telefono_serv;
		$this->puerto = $puerto;
		$this->correo_emp = $correo_emp;
		$this->clave_correo = $clave_correo;
		$this->asunto_correo = $asunto_correo;
		$this->per_telf_fijo = $per_telf_fijo;
		$this->env_todos_telf = $env_todos_telf;
		$this->act_resp_aut = $act_resp_aut;
		$this->cod_ope_movil = $cod_ope_movil;
		$this->conex = $conex;
		$this->bits = $bits;
		$this->sms_resp_aut = $sms_resp_aut;
		$this->marca = $marca;
		$this->modelo = $modelo;
		$this->ruta_archivo = str_replace ("\\", "\\\\", $ruta_archivo);
	}
	public function verid_conf_sms(){
		return $this->id_conf_sms;
	}
	public function versms_resp_aut(){
		return $this->sms_resp_aut;
	}
	public function verbits(){
		return $this->bits;
	}
	public function verconex(){
		return $this->conex;
	}
	public function vercod_ope_movil(){
		return $this->cod_ope_movil;
	}
	public function veract_resp_aut(){
		return $this->act_resp_aut;
	}
	public function verenv_todos_telf(){
		return $this->env_todos_telf;
	}
	public function verper_telf_fijo(){
		return $this->per_telf_fijo;
	}
	public function verasunto_correo(){
		return $this->asunto_correo;
	}
	public function verclave_correo(){
		return $this->clave_correo;
	}
	public function vercorreo_emp(){
		return $this->correo_emp;
	}
	public function verpuerto(){
		return $this->puerto;
	}
	public function vertelefono_serv(){
		return $this->telefono_serv;
	}
	public function vercod_telf_pais(){
		return $this->cod_telf_pais;
	}
	public function verid_franq(){
		return $this->id_franq;
	}

	public function validaExistencia($acceso)
	{
		$acceso->objeto->ejecutarSql("select * from config_sms where id_conf_sms='$this->id_conf_sms'");
		if($acceso->objeto->registros>0)
			return true;
		else
			return false;
	}
	public function incluirconfig_sms($acceso)
	{
		$acceso->objeto->ejecutarSql("insert into config_sms(id_conf_sms,id_franq,cod_telf_pais,telefono_serv,puerto,correo_emp,clave_correo,asunto_correo,per_telf_fijo,env_todos_telf,act_resp_aut,sms_resp_aut,cod_ope_movil,conex,bits,marca,modelo) values ('$this->id_conf_sms','$this->id_franq','$this->cod_telf_pais','$this->telefono_serv','$this->puerto','$this->correo_emp','$this->clave_correo','$this->asunto_correo','$this->per_telf_fijo','$this->env_todos_telf','$this->act_resp_aut','$this->sms_resp_aut','$this->cod_ope_movil','$this->conex','$this->bits','$this->marca','$this->modelo')");			
		return $acceso->objeto->ejecutarSql1("Update config_sms Set ruta_archivo='$this->ruta_archivo' Where id_conf_sms='$this->id_conf_sms'");	
	}
	public function modificarconfig_sms($acceso)
	{
		$acceso->objeto->ejecutarSql("Update config_sms Set id_franq='$this->id_franq', cod_telf_pais='$this->cod_telf_pais', telefono_serv='$this->telefono_serv', puerto='$this->puerto', correo_emp='$this->correo_emp', clave_correo='$this->clave_correo', asunto_correo='$this->asunto_correo', per_telf_fijo='$this->per_telf_fijo', env_todos_telf='$this->env_todos_telf', act_resp_aut='$this->act_resp_aut', sms_resp_aut='$this->sms_resp_aut', cod_ope_movil='$this->cod_ope_movil', conex='$this->conex', bits='$this->bits', marca='$this->marca', modelo='$this->modelo'  Where id_conf_sms='$this->id_conf_sms'");	
		//echo "$this->ruta_archivo";
		return $acceso->objeto->ejecutarSql1("Update config_sms Set ruta_archivo='$this->ruta_archivo' Where id_conf_sms='$this->id_conf_sms'");	
	}
	public function eliminarconfig_sms($acceso)
	{
		return $acceso->objeto->ejecutarSql("delete from config_sms where id_conf_sms='$this->id_conf_sms'");
	}
}
?>